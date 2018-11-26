<?php

namespace loutrux\dp\models;

use Yii;
use yii\base\Model;
use yii\helpers\ArrayHelper;
use linslin\yii2\curl;

use frontend\models\Licences;

/**
 * Signup form
 */
class DpApi extends Model 
{
    private $url;
    private $auth_token;

    public function __construct($config){
        $this->url          = ArrayHelper::getValue($config,'url');
        $this->auth_token   = ArrayHelper::getValue($config,'auth_token');
    }

    public function get($oid, $key = null){

        $curl     = new curl\Curl();
        $response = $curl->setHeaders(['Authorization' => 'Bearer '.$this->auth_token ])
                         ->setPostParams([ 'oid' => $oid, 'key' => $key ])
                         ->post($this->url.'/get');
        if ($curl->errorCode === null) {
            return json_decode($response);}
        return null;
    }

    public function set($oid, $key, $value){

            $curl     = new curl\Curl();
            $response = $curl->setHeaders(['Authorization' => 'Bearer '.$this->auth_token ])
                            ->setPostParams([ 'oid' => $oid, 'key' => $key , 'value' => $value ])
                            ->post($this->url.'/set');
            if ($curl->errorCode === null) {
                return json_decode($response);}
            return null;
    }

}