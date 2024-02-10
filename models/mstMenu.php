<?php

namespace app\models;

use mdm\admin\components\Helper;
use Yii;
use yii\data\ActiveDataProvider;
use yii\db\Expression;
use yii\db\Query;
use yii\debug\models\timeline\DataProvider;
use yii\helpers\ArrayHelper;
use yii\helpers\FileHelper;
use yii\helpers\Inflector;
use yii\helpers\StringHelper;
use yii\helpers\Url;

/**
 * This is the model class for table "mst_menu".
 *
 * @property string|null $idmenu
 * @property string|null $name
 * @property string|null $url
 * @property string|null $order
 * @property string|null $icon
 * @property string|null $type
 */
class mstMenu extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    const TYPE_GUEST = 0;
    const TYPE_AUTHORIZED = 1;

    const PARENT_MENU = 0;
    const DROPDOWN_MENU = 1;

    public static function tableName()
    {
        return 'mst_menu';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idmenu', 'name', 'route', 'parent', 'order', 'icon', 'data', 'type', 'is_dropdown'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idmenu' => 'Idmenu',
            'name' => 'Name',
            'route' => 'Route',
            'parent' => 'parent',
            'order' => 'Order',
            'icon' => 'Icon',
        ];
    }

    public static function getList($type = null)
    {
        $list = [
            self::TYPE_GUEST => 'GUEST',
            self::TYPE_AUTHORIZED => 'AUTHORIZED'
        ];
        if ($type) {
            return isset($list[$type]) ? $list[$type] : '-';
        }
        return $list;
    }
    public static function getParentMenu($parent = null)
    {
        $menu = self::findAll(['is_dropdown' => self::PARENT_MENU]);

        return ArrayHelper::map($menu, 'name', 'name');
    }

    public static function getMenutype($type = null)
    {
        $list = [
            self::PARENT_MENU => 'PARENT MENU',
            self::DROPDOWN_MENU => 'DROPDOWN MENU'
        ];
        if ($type) {
            return isset($list[$type]) ? $list[$type] : '-';
        }
        return $list;
    }
    public static function search($model)
    {
        $query = (new Query())
            ->select('*')
            ->from(self::tableName())
            // ->andFilterWhere(['name' => $model['name']])
        ;
        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);
        return $dataProvider;
    }

    public static function getNativenavbar()
    {
        $guest = mstMenu::find()->where(['like', 'upper(route)', strtoupper('site/')])->orderBy(['order' => SORT_ASC])->all();
        $menu = mstMenu::find()->where('parent is null')->orderBy(['name' => SORT_ASC])->groupBy(['idmenu', 'type'])->all();

        return ['guest' => $guest, 'authorized' => $menu];
    }
    public static function getNavbarLTE()
    {
        $menu = mstMenu::find()->where(['is_dropdown' => self::PARENT_MENU])->orderBy('CAST(`order` AS UNSIGNED) asc')->groupBy(['idmenu', 'type'])->all();
        $child = mstMenu::find()->where(['is_dropdown' => self::DROPDOWN_MENU])->orderBy(['CAST(`order` AS UNSIGNED)' => SORT_ASC])->groupBy(['idmenu', 'type'])->all();
        $items = $menus = [];
        // echo '<pre>';print_r($menu);die;


        foreach ($menu as $i => $nama) {
            $items[$nama['name']]['label'] = $nama['name'];
            $items[$nama['name']]['icon'] = $nama['icon'];
            if ($nama['is_dropdown'] == 1) {
                $items[$nama['name']]['items'] = [];
            } else {
                $items[$nama['name']]['url'][] = $nama['route'] ?: '#';
            }
        }
        foreach ($child as $key => $value) {
            $items[$value->parent]['items'][$key]['label'] = $value->name;
            $items[$value->parent]['items'][$key]['url'][] = $value['route'];
            $items[$value->parent]['items'][$key]['icon'] = 'fa';
        }
        // echo '<pre>';print_r($items);die;

        return Helper::filter($items);
    }
}
