<?php
namespace loutrux\dp\widgets;

use yii\base\Widget;
use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

use loutrux\dp\ParametersLiveUpdate;

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
class BaseWidget extends Widget{

    /**
     * @var string mode du wiget 
	 * "render" pour afficher le bouton de choix
	 * "get" pour avoir la valeur de la préférence
	 * "set" pour mettre à jour la valeur
     */
	public $mode;

	/**
	 * @var string key reference du paramètre
	 */
	public $key;

	/**
	 * @var string oid   paramètre
	 */
	public $oid;

	/**
	 * @var string value valeur à associer
	 * uniquement pour le mode set
	 */
	public $value;

	/**
	 * @var array map est un tableau associatif qui défini les keys et les valeurs attandues.
	 * pour chaque valeurs de key il est possible d'associer une description
	 * ```php
	 * $map = [
	 * 		'my-string-key' => [
	 * 			'my-first-value' => 'my first description',
	 * 			'my-second-value' => 'my second description',	
	 * 		],
	 * 		'my-integer-key => [
	 * 			'description for 0',
	 * 			'description for 1',
	 * 			'description for 2',
	 * 			'description for 3',
	 * 		]
	 * ]
	 * ``` 
	 * uniquement pour le mode set
	 */
	public $map;
	
	/**
	 * @var array messages est la valeur correspondant à $map[$key]
	 */
	public $messages;


    /**
     * @var DpInterface DpDatas model 
	 * 
     */
	private $dpDatas;
	
	/**
     * @var string dbms the module dbms 
	 * 
     */
	private $dbms;

	
	/**
     * @var string  DynamicParameter module id 
	 * 
     */
	private $module_id;


	private $config = [];

	public $widgetClass;
	public $unique_id;
	public $formSelector;
	public $form;
	public $fieldOptions;
	public $items;
	public $defaultValue;

	
	public function init(){
		parent::init();

		// get the dynamic parameter module id 
		if (($module = \Yii::$app->getModule(ParametersLiveUpdate::findModuleIdentifier())) !== null)
			$this->module_id = $module->id;

		if (!isset($this->oid)) 		$this->oid = '';
		if (!isset($this->key)) 		$this->key = 'undefined';
		if (!isset($this->value)) 		$this->value = \Yii::$app->{$module->componentName}->get($this->oid,$this->key);
			else \Yii::$app->{$module->componentName}->set($this->oid,$this->key,$this->value);
		if (isset($this->defaultValue) && ($this->value === null))	{ 
				$this->value = $this->defaultValue; 
				\Yii::$app->{$module->componentName}->set($this->oid,$this->key,$this->value);
			}
		if (!isset($this->map)) 		$this->map = [$this->key => ['no set', 'set']];
		if (!isset($this->messages)) 	$this->messages = $this->map[$this->key];
		if (!isset($this->fieldOptions)) 	$this->fieldOptions = [];
		if (!isset($this->items)) 		$this->items = [];


		// get de widget class name end store the config
		$this->widgetClass = explode('\\', get_class($this) );
		$this->widgetClass = end($this->widgetClass );
		$this->config['widgetClass'] = $this->widgetClass;
		foreach (['oid','key','value','map','messages','fieldOptions','items'] as $attribute)
			$this->config[$attribute] = ArrayHelper::getValue($this,$attribute);

		
		$this->start_render();

	}
	

	public function run(){

		$this->end_render();

	}
	
	public function start_render(){
		$this->unique_id = \Yii::$app->security->generateRandomString(5);
		$this->formSelector = '#dpform_'.$this->unique_id;

		Pjax::begin([	'id' 					=> 'dp_'.$this->unique_id, 
						'enablePushState' 		=> false, 
						'enableReplaceState' 	=> false, 
						'timeout' 				=> 0, 
						//'linkSelector' 			=> 'dplink_'.$this->unique_id,
						'formSelector' 			=> '#dpform_'.$this->unique_id]);	 
		

     $this->form = ActiveForm::begin([
		'id'=>'dpform_'.$this->unique_id,
        'action' => ['/'.$this->module_id.'/widget/update','config' => json_encode($this->config)],
		'method' => 'post',
		'options' => ['enctype' => 'multipart/form-data', 'data-pjax' => '#dp_'.$this->unique_id,]
    ]); 

		echo Html::input('hidden','oid',$this->oid);
		echo Html::input('hidden','key',$this->key);

	}
	
	public function end_render(){
		echo Html::submitButton('', ['style' => 'display:none;']) ;
		ActiveForm::end(); 
		Pjax::end();
	}
}