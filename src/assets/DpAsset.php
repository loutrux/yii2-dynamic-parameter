<?php
namespace loutrux\dp\assets;

use yii\base\Exception;
use yii\web\AssetBundle;

/**
 * Dynamic parameters AssetBundle
 * @since 0.1
 */
class DpAsset extends AssetBundle
{
    public $sourcePath = '@loutrux/dp/assets';
    public $css = [
        'css/style.css'
		
    ];
    public $js = [
		'js/index.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
    }
}
