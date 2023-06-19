<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\components;

use hail812\adminlte\widgets\Menu;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

class Nav extends Menu {

    public function renderItems($items, $li = false) {
        $iduser = Yii::$app->user->getId();
        $n = count($items);
        $lines = [];
        
        foreach ($items as $i => $item) {
            $options = array_merge($this->itemOptions, ArrayHelper::getValue($item, 'options', []));

            // if (isset($item['items']) && $item['items']) {
            //     foreach ($item['items'] as $key => $menu) {
            //         if ($iduser == 'LMT001' && isset($menu['visible']) && $menu['visible']) {
            //             continue;
            //         }

            //         $route = isset($menu['url'][0]) ? explode('/', $menu['url'][0]) : [];
            //         unset($route[0]);
            //         $route = implode("/", $route);

            //         if (Yii::$app->user->can($route)) {
            //             continue;
            //         } else {
            //             unset($item['items'][$key]);
            //         }
            //     }
                
            // }

            if (isset($item['items'])) {
                Html::addCssClass($options, 'has-treeview');
            }else{
                
            }

            if (isset($item['header']) && $item['header']) {
                Html::removeCssClass($options, 'nav-item');
                Html::addCssClass($options, 'nav-header');
            }


            $tag = ArrayHelper::remove($options, 'tag', 'li');
            $class = [];

            if ($item['active']) {
                $class[] = $this->activeCssClass;
            }

            if ($i === 0 && $this->firstItemCssClass !== null) {
                $class[] = $this->firstItemCssClass;
            }

            if ($i === $n - 1 && $this->lastItemCssClass !== null) {
                $class[] = $this->lastItemCssClass;
            }
            Html::addCssClass($options, $class);

            $menu = $this->renderItem($item);

            if (!empty($item['items'])) {
                $treeTemplate = ArrayHelper::getValue($item, 'treeTemplate', $this->treeTemplate);
                $menu .= strtr($treeTemplate, [
                    '{items}' => $this->renderItems($item['items'], true),
                ]);
                if ($item['active']) {
                    $options['class'] .= ' menu-open';
                }
            }
            if ($li) {
                $lines[] = Html::tag($tag, $menu, $options);
            } elseif (!empty($item['items'])) {
                $lines[] = Html::tag($tag, $menu, $options);
            }
        }

        return implode("\n", $lines);
    }

}
