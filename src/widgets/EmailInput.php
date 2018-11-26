<?php
namespace loutrux\dp\widgets;

use yii\base\Widget;
use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

use loutrux\dp\ParametersLiveUpdate;
use loutrux\dp\widgets\BaseDpWidget;
use loutrux\dp\models\DpField;

/**
 * UserParam widget 
 * You can set this widget as following:
 *
 * ```php
 *  echo DP::widget([ 
 *       'mode'		=> 'set', 
 *       'key'		=> 'param0.misc', 
 *       'value'  	=> 'my value'
 * ]);
 * ```
 *
 *
 * @author Vincent Galante <vincent.galante@cosante.com>
 */
class EmailInput extends TextInput{

	public function init(){
        
		parent::init();

		$this->field->scenario = DpField::SCENARIO_EMAIL ;
		$this->fieldAttribute = 'email';
		$this->field->email = $this->value;
	}
	

	public function run(){
		// before baseDpWidget
		parent::run();
	}


	

}