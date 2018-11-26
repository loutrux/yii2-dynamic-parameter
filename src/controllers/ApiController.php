<?php

namespace loutrux\dp\controllers;

use yii\rest\Controller;
use yii\filters\auth\HttpBearerAuth;
use yii\helpers\ArrayHelper;

/**
 * Default controller for the `dp` module
 */
class ApiController extends Controller
{
    public $component;

    public function init()
    {
        parent::init();
        \Yii::$app->user->enableSession = false;
        $this->component = ArrayHelper::getValue(\Yii::$app,$this->module->componentName);
    }
    
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => HttpBearerAuth::className(),
        ];
        return $behaviors;
    }

    /**
     * Set parameter's value
     * @param string $oid POST
     * @param string $key POST
     * @param string $value POST
     * @return boolean
     */
    public function actionSet()
    {
        if (($post = \Yii::$app->request->bodyParams) != null) 
            return  $this->component->set(ArrayHelper::getValue($post,'oid'), 
                                                ArrayHelper::getValue($post,'key'), 
                                                ArrayHelper::getValue($post,'value'));
        
        return  null;       
    }

    /**
     * Get parameter's value
     * @param string $oid POST
     * @param string $key POST
     * @return mixed
     */
    public function actionGet()
    {
        if (($post = \Yii::$app->request->bodyParams) != null) 
            return  $this->component->get(ArrayHelper::getValue($post,'oid'), ArrayHelper::getValue($post,'key'));
        
        return  null;
    }

    public function actionTest(){
        //$component = ArrayHelper::getValue(\Yii::$app,$this->module->componentName);
        return $this->component->dbms;
        //return $this->module->componentName; 
        //return \Yii::$app->parameters->api;
    }
}
