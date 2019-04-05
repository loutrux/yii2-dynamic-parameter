<?php
use yii\helpers\ArrayHelper;

switch (ArrayHelper::getValue($config,'widgetClass')) {
    case 'TextInput':   echo loutrux\dp\widgets\TextInput::widget($config); break;
    case 'EmailInput':  echo loutrux\dp\widgets\EmailInput::widget($config); break;
    case 'RadioList':  echo loutrux\dp\widgets\RadioList::widget($config); break;
    case 'DateInput':  echo loutrux\dp\widgets\DateInput::widget($config); break;
    case 'DateText':  echo loutrux\dp\widgets\DateText::widget($config); break;
    case 'CheckBox':  echo loutrux\dp\widgets\CheckBox::widget($config); break;

}

//echo 'Saved';