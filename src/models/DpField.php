<?php
namespace loutrux\dp\models;

use Yii;
use yii\base\Model;


class DpField extends Model 
{
    public $text;
    public $textRequire;
    public $email;

	const SCENARIO_TEXT                 = 'text';
	const SCENARIO_TEXT_REQUIRE         = 'text-require';
    const SCENARIO_EMAIL                = 'email';

    public function scenarios()
    {
        return [
            self::SCENARIO_TEXT                 => ['text'],
            self::SCENARIO_TEXT_REQUIRE         => ['textRequire'],
            self::SCENARIO_EMAIL                 => ['email'],
        ];
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['text' ,       'safe'],
            ['textRequire', 'required', 'message'=> 'merci de renseigner cette information'],
            ['email',       'email'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'text'           => '',
            'textRequire'    => '',
            'email'           => ''
        ];
    }
    /**
     * {@inheritdoc}
     */
    public function hints()
    {
        return array_merge(parent::hints(), [
            
            'text' => 'Merci de renseigner cette information']);
    }

}
