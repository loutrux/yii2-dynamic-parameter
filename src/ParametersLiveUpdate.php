<?php
/**
 * 
 *
 * @author    Loutrux <loutrux@gmail.com>
 * @package   com.loutrux.yii2.parameter
 * @copyright 2018 Loutrux
 */

namespace loutrux\dp;

use Yii;
use yii\base\Module;

/**
 *  Dynamic Parameters main module.
 *
 * To configure it only if you want open server side API REST for loutrux\yii2-parameters
 * To configure it you need to do :
 * - add a module configuration entry:
 *     'modules' => [
 *        'dparams' => 'loutrux\dp\ParametersLiveUpdate',
 *     ]
 *   or optionally with configuration:
 *     'modules' => [
 *        'parameters' => [
 *            'class' => 'loutrux\dp\ParametersLiveUpdate',
 *            'componentName' => 'parameters', //Default is 'parameters' but you can specify other component name implementing loutrux\dp\Parameters class
 *              
 *     ]
 *
 * 
 * @package loutrux\dp
 * 
 * */

class ParametersLiveUpdate extends Module
{
    /** Name of the component to be used */
    public $componentName = 'parameters';

    public function init()
    {
        parent::init();
        \Yii::setAlias('@loutrux/dp', __DIR__);
        
        // Register asset only once time 
        $assetManager = Yii::$app->assetManager;
        if ($assetManager)
            if (!array_key_exists('loutrux\\dp\\assets\\DpAsset', \yii\helpers\ArrayHelper::getValue($assetManager,'bundles')))
                \loutrux\dp\assets\DpAsset::register( Yii::$app->view);
      }

    /**
     * @return int|null|string
     */
    public static function findModuleIdentifier()
    {
        foreach (Yii::$app->modules as $name => $module) {
            $class = null;
            if (is_string($module))
                $class = $module;
            elseif (is_array($module)) {
                if (isset($module['class']))
                    $class = $module['class'];
            } else
                /** @var Module $module */
                $class = $module::className();

            $parts = explode('\\', $class);
            if ($class && strtolower(end($parts)) == 'parametersliveupdate')
                return $name;
        }
        return null;
    }
    
}