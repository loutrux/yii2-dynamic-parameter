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
use yii\base\Module;

/**
 *  Parameters Api main module.
 *
 * To configure it only if you want open server side API REST for loutrux\yii2-parameters
 * To configure it you need to do :
 * - add a module configuration entry:
 *     'modules' => [
 *        'parameters' => 'loutrux\dp\ParametersApi',
 *     ]
 *   or optionally with configuration:
 *     'modules' => [
 *        'parameters' => [
 *            'class' => 'loutrux\dp\ParametersApi',
 *            'componentName' => 'parameters', //Default is 'parameters' but you can specify other component name implementing loutrux\dp\Parameters class
 *              
 *     ]
 *
 * 
 * @package loutrux\dp
 * 
 * */

class ParametersApi extends Module
{
    /** Name of the component to be used */
    public $componentName = 'parameters';
    
}