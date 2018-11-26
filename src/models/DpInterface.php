<?php

namespace loutrux\dp\models;
/**
 * This de dynamic parameter datas interface
 * 
 */
interface DpInterface
{
    public function get($oid, $key);
    public function set($oid, $key, $value);
}


