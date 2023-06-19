<?php

namespace app\models;

use mdm\admin\components\Helper;
use Yii;
use yii\data\ActiveDataProvider;
use yii\db\Query;
use yii\debug\models\timeline\DataProvider;
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
            [['idmenu', 'name', 'route', 'parent', 'order', 'icon', 'data'], 'string'],
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
            'route' => 'Url',
            'parent' => 'parent',
            'order' => 'Order',
            'icon' => 'Icon',
        ];
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
        $menu = mstMenu::find()->where('parent is null')->orderBy(['name' => SORT_ASC])->groupBy(['idmenu', 'type'])->all();
        $child = mstMenu::find()->where('parent is not null')->orderBy(['name' => SORT_ASC])->groupBy(['idmenu', 'type'])->all();
        $items = $menus = [];



        foreach ($menu as $i => $nama) {
            $items[$nama['name']]['label'] = $nama['name'];
            $items[$nama['name']]['icon'] = $nama['icon'];
            if ($nama['type'] == 1) {
                $items[$nama['name']]['items'] = [];
            } else {

                $items[$nama['name']]['url'][] = Url::to(['/' . $nama['route']]);
            }
        }
        foreach ($child as $key => $value) {
            $items[$value->parent]['items'][$key]['label'] = $value->name;
            $items[$value->parent]['items'][$key]['url'][] = Url::to(['/' . $value['route']]);
            $items[$value->parent]['items'][$key]['icon'] = 'fa';
        }
        

        return Helper::filter($items);
    }
}
