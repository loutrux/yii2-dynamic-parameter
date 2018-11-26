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
class BaseInput extends BaseWidget{

	public $field;
	public $input;
	public $inputOptions;
	public $fieldAttribute;
	public $label;
	public $hint;
	
	public function init(){
        
		parent::init();
		$this->field = new DpField;

		$class 			= ArrayHelper::getValue($this->fieldOptions,['class'],'form-control').' dp-widget-event-blur';
		$placeholder 	= ArrayHelper::getValue($this->fieldOptions,['placeholder'], null);
		$style 			= ArrayHelper::getValue($this->fieldOptions,['style'], null);
		$this->label	= ArrayHelper::getValue($this->fieldOptions,['label'], null);
		$this->hint		= ArrayHelper::getValue($this->fieldOptions,['hint'], null);

		$this->inputOptions = [	'name' 			=> 'value',
								'class' 		=> $class, 
								'placeholder' 	=> $placeholder,
								'style' 		=> $style];

		unset($this->fieldOptions['class']);
		unset($this->fieldOptions['label']);
		unset($this->fieldOptions['hint']);
		unset($this->fieldOptions['placeholder']);
		unset($this->fieldOptions['style']);
	}
	

	public function run(){

		// before baseDpWidget
		parent::run();
	}


	

}