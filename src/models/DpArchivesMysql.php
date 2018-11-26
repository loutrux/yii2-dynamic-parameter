<?php

namespace loutrux\dp\models;

use Yii;

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
class DpArchivesMysql extends \loutrux\dp\components\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dp_archives';
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

}
