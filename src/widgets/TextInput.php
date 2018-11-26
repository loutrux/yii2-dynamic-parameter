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
class TextInput extends BaseInput{

	public function init(){
        
		parent::init();

		$this->field->scenario = DpField::SCENARIO_TEXT ;
		$this->fieldAttribute = 'text';
		$this->field->text = $this->value;
		
	}
	

	public function run(){


		$this->input = $this->form->field($this->field, $this->fieldAttribute, $this->fieldOptions);
		$this->input->textInput($this->inputOptions);

		if ($this->hint !== null) 	$this->input->hint($this->hint);
		if ($this->label !== null) 	$this->input->label($this->label);


		echo $this->input;
		// before baseDpWidget
		parent::run();

	}


	

}