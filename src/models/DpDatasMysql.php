<?php

namespace loutrux\dp\models;

use Yii;
use yii\helpers\ArrayHelper;
use loutrux\dp\models\DpArchivesMysql;

/**
 * This is the model class for table "dp_archives".
 *
 * @property int $id
 * @property int $parent
 * @property string $key
 * @property string $type
 * @property int $value_integer
 * @property double $value_double
 * @property int $value_boolean
 * @property resource $value_string
 * @property string $value_datetime
 * @property string $oid
 * @property string $trace
 * @property string $created
 */
class DpDatasMysql extends \loutrux\dp\components\ActiveRecord
{
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dp_datas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['parent', 'value_integer', 'value_boolean'], 'integer'],
            [['value_double'], 'number'],
            [['value_string', 'trace'], 'string'],
            [['value_datetime', 'created'], 'safe'],
            [['key', 'type', 'oid'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent' => 'Parent',
            'key' => 'Key',
            'type' => 'Type',
            'value_integer' => 'Value Integer',
            'value_double' => 'Value Double',
            'value_boolean' => 'Value Boolean',
            'value_string' => 'Value String',
            'value_datetime' => 'Value Datetime',
            'oid' => 'Oid',
            'trace' => 'Trace',
            'created' => 'Created',
        ];
    }

    public function get($oid, $key = null){
        if (($model = self::search($oid, $key)) !== null){
            if (is_array($model))
                return $model[0]->getValues($model);
            return $model->getValue();
        }
        return null;
    }

    public function set($oid,$key,$value){
        if (($model = self::search($oid,$key)) !== null){
            return $model->setValue($value);
        }
        return null;
    }

    public static function search($oid, $key = null){
        if ($key){
            if (($model = self::findOne(['key' => $key, 'oid' => $oid])) === null){
                    $model = new DpDatasMysql;
                    $model->key = $key;
                    $model->oid = $oid;
                }
            return $model;
       } else return self::findAll(['oid' => $oid]);
    }

    public function getValue(){
        return $this->_get();
    }

    public function getValues($models){
        $result = [];
        foreach ($models as $model)
            $result[$model->key] = $model->_get();
        return $result;
    }

    public function setValue($value){
        if ($this->id){
            $this->archive();
        }
        $this->trace();
        $this->_set($value);
        return $this->save();
    }
    
    private function _set($value){

        $this->value_boolean    = null;
        $this->value_integer    = null;
        $this->value_double     = null;
        $this->value_string     = null;
        $this->value_datetime   = null;
        
        $this->type = gettype($value);
        switch ($this->type) {
            case 'boolean':
                $this->value_boolean = ($value)?1:0;
                break;
 
            case 'integer':
                $this->value_integer = $value;
                break;
 
            case 'double':
                $this->value_double = $value;
                break;
 
            case 'string':
                $this->value_string = $value;
                break;
 
            case 'array':
                $this->value_string = json_encode($value);
                break;
 
            case 'object':
                if (($this->type = get_class($value)) == 'DateTime')
                    $this->value_datetime = $value->format('Y-m-d H:i:s');
                else $this->value_string = json_encode($value);
                break;
            
            default:
                $this->value_string = json_encode($value);
                break;
        }
    }

    private function _get(){
        switch ($this->type) {
            case 'boolean':
                return $this->value_boolean;
                break;
 
            case 'integer':
                return $this->value_integer;
                break;
 
            case 'double':
                return $this->value_double;
                break;
 
            case 'string':
                return $this->value_string;
                break;
 
            case 'array':
                return json_decode($this->value_string,true);
                break;
 
            case 'DateTime':
                    return $this->value_datetime;
                break;
            
            default:
                return json_decode($this->value_string);
                break;
        }
    }

    public function archive(){
        $archive = new DpArchivesMysql;
        foreach ($this->attributes() as $attribute)
            ArrayHelper::setValue($archive,$attribute,ArrayHelper::getValue($this,$attribute));
        $archive->id        = null; 
        $archive->parent    = $this->id;
        return $archive->save();
    }

    public function trace(){
        $trace = [];
        $trace['user'] = Yii::$app->user->identity->username;
        $this->trace = json_encode($trace);
        return true;
    }
}
