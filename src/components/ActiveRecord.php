<?php
/**
 * Base model for the parameters classes containing getDb function.
 */

namespace loutrux\dp\components;

use loutrux\dp\Parameters;
use yii;
use yii\db\Connection;
use yii\di\Instance;

/**
 * ActiveRecord
 * @package loutrux\dp\models
 */
class ActiveRecord extends \yii\db\ActiveRecord
{

    public static $db = 'db';

    public static function setDb($db)
    {
        self::$db = $db;
    }

    public static function getDb()
    {
        return Yii::$app->{self::$db};
    }
    
}
