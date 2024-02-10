<?php

namespace app\models;

use app\models\AuthItem;
use Exception;
use mdm\admin\components\Configs;
use mdm\admin\components\Helper;
use mdm\admin\components\RouteRule;
use Yii;
use yii\caching\TagDependency;
use yii\helpers\ArrayHelper;
use yii\helpers\FileHelper;
use yii\helpers\Inflector;
use yii\helpers\VarDumper;

/**
 * Description of Route
 *
 * @author Misbahul D Munir <misbahuldmunir@gmail.com>
 * @since 1.0
 */
class Route extends \yii\db\ActiveRecord
{
    const CACHE_TAG = 'mdm.admin.route';

    const PREFIX_ADVANCED = '@';
    const PREFIX_BASIC = '/';
    const PREFIX_ALL = '*';

    private $_routePrefix;

    /**
     * Assign or remove items
     * @param array $routes
     * @return array
     */
    public static function getRoutes($getRoutes = false)
    {
        //         use yii\helpers\FileHelper;
        // use yii\helpers\StringHelper;

        // Directory where your controllers are stored
        $controllersPath = Yii::getAlias('@app/controllers');

        // Get all PHP files in the controllers directory
        $controllerFiles = FileHelper::findFiles($controllersPath, ['only' => ['*.php']]);
        $registeredRoutes = AuthItem::find()->select('name')->where(['type' => 2])->indexBy('name')->column();

        $routes = [];
        $asigned = [];

        // Iterate through each PHP file (controller) found
        foreach ($controllerFiles as $file) {
            // Extract the controller class name from the file path
            $className = basename($file, '.php');
            $fullClassName = "app\\controllers\\" . $className;

            // Load the controller class
            $controllerClass = Yii::createObject($fullClassName);
            $controllerName = Inflector::camel2id(str_replace('Controller', '', $className));
            // Get all public methods of the controller class
            $methods = get_class_methods($controllerClass);

            // Iterate through each method
            if (!$getRoutes) {
                $all_routes = self::PREFIX_BASIC . $controllerName . self::PREFIX_BASIC . self::PREFIX_ALL;
                $routes[$all_routes] = $all_routes;
            };
            foreach ($methods as $method) {
                // Check if the method is an action (not a constructor or magic method)
                if (strpos($method, 'action') === 0 && $method !== 'actions') {
                    // Extract the route from the method name
                    $route = strtolower(preg_replace('/([a-zA-Z])(?=[A-Z])/', '$1-', substr($method, 6)));

                    // Append the route to the list
                    $routes_name = '/' . $controllerName . '/' . $route;
                    $routes[$routes_name] = $routes_name;
                }
            }
        }

        if ($getRoutes) {
            return $routes;
        }
        foreach (array_keys($registeredRoutes) as $name) {
            if ($name[0] !== self::PREFIX_BASIC) {
                continue;
            }
            $asigned[] = $name;
            unset($routes[$name]);
        }

        return [
            'available' => $routes,
            'assigned' => $asigned,
        ];
    }
    public function addNew($routes)
    {
        // echo '<pre>';print_r($routes);die;

        foreach ($routes as $route) {
            try {
                $model = new AuthItem();
                // $r = explode('&', $route);
                if ($route[0] !== self::PREFIX_BASIC) {
                    $item =  self::PREFIX_BASIC . $route;
                } else {
                    $item =  $route;
                }
                // echo '<pre>';print_r($item);die;
                $model->add($item);
            } catch (Exception $exc) {
                Yii::error($exc->getMessage(), __METHOD__);
            }
        }
        Helper::invalidate();
    }
    public function add($item)
    {
        $this->type = AuthItem::TYPE_PERMISSION;
        $this->name = $item;
        // echo '<pre>';print_r($this);die;

        $this->save();
    }

    /**
     * Assign or remove items
     * @param array $routes
     * @return array
     */
    public function remove($routes)
    {
        $routes = AuthItem::findAll(['name' => $routes]);

        foreach ($routes as $route) {
            try {
                $route->delete();
            } catch (Exception $exc) {
                Yii::error($exc->getMessage(), __METHOD__);
            }
        }
        Helper::invalidate();
    }
}
