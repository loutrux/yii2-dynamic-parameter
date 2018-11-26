<?php

use yii\db\Schema;
use loutrux\dp\components\Migration;

class m180929_235536_dynamic_parameter_init_tables extends Migration
{
    const TABLE_DATAS = '{{%dp_datas}}';
    const TABLE_ARCHIVES = '{{%dp_archives}}';

    public function up()
    {
        $this->createTable(self::TABLE_DATAS, [
            'id'                => Schema::TYPE_PK,
            'parent'			=> Schema::TYPE_INTEGER,
            'key'               => Schema::TYPE_STRING . '(255) NULL',
            'type'              => Schema::TYPE_STRING . '(255) NULL',
            'value_integer'     => Schema::TYPE_INTEGER,
            'value_double'      => Schema::TYPE_DOUBLE,
            'value_boolean'     => Schema::TYPE_BOOLEAN,
            'value_string'      => Schema::TYPE_BINARY,
            'value_datetime'    => Schema::TYPE_DATETIME,
            'oid'               => Schema::TYPE_STRING . '(255) NULL',
            'trace'             => Schema::TYPE_TEXT,
            'created'		    => Schema::TYPE_DATETIME,
        ]); 

        $this->createTable(self::TABLE_ARCHIVES, [
            'id'                => Schema::TYPE_PK,
            'parent'			=> Schema::TYPE_INTEGER,
            'key'               => Schema::TYPE_STRING . '(255) NULL',
            'type'              => Schema::TYPE_STRING . '(255) NULL',
            'value_integer'     => Schema::TYPE_INTEGER,
            'value_double'      => Schema::TYPE_DOUBLE,
            'value_boolean'     => Schema::TYPE_BOOLEAN,
            'value_string'      => Schema::TYPE_BINARY,
            'value_datetime'    => Schema::TYPE_DATETIME,
            'oid'               => Schema::TYPE_STRING . '(255) NULL',
            'trace'             => Schema::TYPE_TEXT,
            'created'		    => Schema::TYPE_DATETIME,
        ]); 
        

        $this->createIndex(
            'idx-dp-datas-oid',
            self::TABLE_DATAS,
            ['oid']
        );

        $this->createIndex(
            'idx-dp-datas-key',
            self::TABLE_DATAS,
            ['key']
        );

        $this->createIndex(
            'idx-dp-archives-oid',
            self::TABLE_ARCHIVES,
            ['oid']
        );

        $this->createIndex(
            'idx-dp-archives-key',
            self::TABLE_ARCHIVES,
            ['key']
        );


    }

    public function down()
    {
        echo "m180929_235536_dynamic_parameter_init_tables being reverted.\n";

        $this->dropIndex('idx-dp-datas-oid',self::TABLE_DATAS);
        $this->dropIndex('idx-dp-datas-key',self::TABLE_DATAS);
        $this->dropIndex('idx-dp-archives-oid',self::TABLE_ARCHIVES);
        $this->dropIndex('idx-dp-archives-key',self::TABLE_ARCHIVES);
      
		$this->dropTable(self::TABLE_DATAS);
        $this->dropTable(self::TABLE_ARCHIVES);
        
        return true;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
