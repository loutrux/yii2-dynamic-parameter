<?php
/**
 * This serves as both the Module for the MVC part of the audit and the configuration/entry point for the actual
 * audit process.
 *
 * @author    Loutrux <loutrux@gmail.com>
 * @package   com.loutrux.yii2.parameter
 * @copyright 2018 Loutrux
 */

namespace loutrux\dp;

use Yii;
use yii\base\Component;
use yii\helpers\ArrayHelper;

/**
 * Dynamic Parameters component.
 *
 * To configure it you need to do :
 * - add a module configuration entry:
 *     'components' => [
 *        'parameters' => 'loutrux\dp\DynamicParameter',
 *     ]
 *   or optionally with configuration:
 *     'components' => [
 *        'parameters' => [
 *            'class' => 'loutrux\dp\Parameters',
 *            'dbms' => 'mysql', // "mysql" is default 
 *            'db' => 'db', // "db" is default 
 *     ]
 *
 *   or if you have activate the Parameters Module API on a distant server is using this Component:
 *     'components' => [
 *        'parameters' => [
 *            'class' => 'loutrux\dp\Parameters',
 *            'dbms' => 'api', // "mysql" is default 
 *            'api'   => [
 *                'url'          => 'https://wwwmydomain.com/parameters/api',
 *                'auth_token'    => '1mYcmJb1XEG8bE4hvnUICOb4d665W1JB'
 *           ],
 *     ]
 *
 * @package loutrux\dp
 * 
 * */

class Parameters extends Component
{

    /**
     * @var string name of the  database management system (default = mysql)
     */
    public $dbms = 'mysql';

    /**
     * @var string name of the component to use for database access
     */
    public $db = 'db';

    /**
     * @var array api modality access
     */
    public $api;

    /**
     * @var array api modality access
     */
    private $dpModel;

    public function init()
    {
        parent::init();
        switch ($this->dbms) {
            case 'mysql':
               \loutrux\dp\models\DpDatasMysql::setDb($this->db);
                \loutrux\dp\models\DpArchivesMysql::setDb($this->db);
				$this->dpModel = new \loutrux\dp\models\DpDatasMysql;
                break;
                
            case 'api':
                $this->dpModel = new \loutrux\dp\models\DpApi($this->api);
                break;
			
			default:
                $this->dpModel = new \loutrux\dp\models\DpDatasMysql;
				break;
		}
    }


    /**
     * for mysql connection
     * @return \yii\db\Connection the database connection.
     */
    public function getDb()
    {
        return Yii::$app->{$this->db};
    }

    public function get($oid, $key = null){
        return $this->dpModel->get($oid, $key);
    }

    public function set($oid,$key,$value){
        return $this->dpModel->set($oid, $key, $value);
    }
    
}