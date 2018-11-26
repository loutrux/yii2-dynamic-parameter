<?php

namespace loutrux\dp\controllers;

use yii\web\Controller;
use yii\helpers\ArrayHelper;

/**
 * Default controller for the `dp` module
 */
class WidgetController extends Controller
{
    public $component;

    public function init()
    {
        parent::init();
        $this->component = ArrayHelper::getValue(\Yii::$app,$this->module->componentName);
    }

    public function actionTest(){
        return $this->render('test');
    }
    public function actionUpdate($config = []){
        
        if (($post = \Yii::$app->request->bodyParams) != null) 
        $this->component->set(  ArrayHelper::getValue($post,'oid'), 
                                ArrayHelper::getValue($post,'key'), 
                                ArrayHelper::getValue($post,'value'));

        if ($config) $config = json_decode($config,true);
        $config['value'] = ArrayHelper::getValue($post,'value');
        return $this->renderAjax('update',['config' => $config]);
        
    }
}
