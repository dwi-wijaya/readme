<?php

namespace app\models;

use Exception;
use Yii;
use yii\rbac\Item;
use mdm\admin\components\Helper;

/**
 * This is the model class for table "auth_item".
 *
 * @property string $name
 * @property int $type
 * @property string|null $description
 * @property string|null $rule_name
 * @property resource|null $data
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property AuthAssignment[] $authAssignments
 * @property AuthItemChild[] $authItemChildren
 * @property AuthItemChild[] $authItemChildren0
 * @property AuthItem[] $children
 * @property AuthItem[] $parents
 * @property AuthRule $ruleName
 */
class AuthItem extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    const TYPE_ROLE = 1;
    const TYPE_PERMISSION = 2;

    public static function tableName()
    {
        return 'auth_item';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'type'], 'required'],
            [['type', 'created_at', 'updated_at'], 'default', 'value' => null],
            [['type', 'created_at', 'updated_at'], 'integer'],
            [['description', 'data'], 'string'],
            [['name', 'rule_name'], 'string', 'max' => 64],
            [['name'], 'unique'],
            [['rule_name'], 'exist', 'skipOnError' => true, 'targetClass' => AuthRule::class, 'targetAttribute' => ['rule_name' => 'name']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Name',
            'type' => 'Type',
            'description' => 'Description',
            'rule_name' => 'Rule Name',
            'data' => 'Data',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[AuthAssignments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAuthAssignments()
    {
        return $this->hasMany(AuthAssignment::class, ['item_name' => 'name']);
    }

    /**
     * Gets query for [[AuthItemChildren]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAuthItemChildren()
    {
        return $this->hasMany(AuthItemChild::class, ['parent' => 'name']);
    }

    /**
     * Gets query for [[AuthItemChildren0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAuthItemChildren0()
    {
        return $this->hasMany(AuthItemChild::class, ['child' => 'name']);
    }

    /**
     * Gets query for [[Children]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getChildren()
    {
        return $this->hasMany(AuthItem::class, ['name' => 'child'])->viaTable('auth_item_child', ['parent' => 'name']);
    }

    /**
     * Gets query for [[Parents]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getParents()
    {
        return $this->hasMany(AuthItem::class, ['name' => 'parent'])->viaTable('auth_item_child', ['child' => 'name']);
    }

    /**
     * Gets query for [[RuleName]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRuleName()
    {
        return $this->hasOne(AuthRule::class, ['name' => 'rule_name']);
    }
    public function getItems()
    {
        // $manager = Configs::authManager();
        // $advanced = Configs::instance()->advanced;
        $available = [];
        // echo '<pre>';print_r($this);die;
        if ($this->type == Item::TYPE_ROLE) {
            $roles = AuthItem::find()->where(['type' => self::TYPE_ROLE])->asArray()->indexBy('name')->all();
            foreach (array_keys($roles) as $name) {
                $available[$name] = 'role';
            }
        }
        // echo '<pre>';print_r($available);die;
        $permission = AuthItem::find()->where(['type' => self::TYPE_PERMISSION])->asArray()->indexBy('name')->all();

        foreach (array_keys($permission) as $name) {
            $available[$name] = $name[0] == '/' ? 'route' : 'permission';
        }
        $assigned = [];
        $children = AuthItem::find()->alias('auth')->innerJoin(['child' => AuthItemChild::tableName()], 'auth.name=child.child')->where(['child.parent' => $this->name])->asArray()->indexBy('name')->all();


        foreach ($children as $item) {
            $assigned[$item['name']] = $item['type'] == 1 ? 'role' : ($item['name'][0] == '/'
                ? 'route' : 'permission');
            unset($available[$item['name']]);
        }
        unset($available[$this->name]);
        ksort($available);
        ksort($assigned);
        return [
            'available' => $available,
            'assigned' => $assigned,
        ];
    }
    public function getUsers(){
        // echo '<pre>';print_r($this);die;
        $users = AuthAssignment::find()->where(['item_name' => $this->name])->asArray()->all();
        return $users;
    }
    public function add($item)
    {
        $this->type = AuthItem::TYPE_PERMISSION;
        $this->name = $item;
        // echo '<pre>';print_r($this);die;

        $this->save();
    }
    public function addChildren($items)
    {
        $success = 0;
        
        if ($this) {
            foreach ($items as $name) {
                $model = new AuthItemChild();
            //    echo '<pre>';print_r($this);die;
            $model->addChild($this, $name);
                try {
                    $success++;
                } catch (\Exception $exc) {
                    Yii::error($exc->getMessage(), __METHOD__);
                }
            }
        }
        if ($success > 0) {
            Helper::invalidate();
        }
        return $success;
    }
    
    public function removeChildren($items)
    {
        $children = AuthItemChild::findAll(['child' => $items, 'parent' => $this->name]);
        // echo '<pre>';print_r($children);die;
        foreach ($children as $child) {
            try {
                $child->delete();
            } catch (Exception $exc) {
                Yii::error($exc->getMessage(), __METHOD__);
            }
        }
        Helper::invalidate();
    }
}
