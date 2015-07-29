<?php

/**
 * Description of SearchBox
 *
 * @author tiago
 */
class ButtonHideShowMenu extends CWidget {

    public $enable = true;

    public function init() {
        $publicPath = Yii::app()->assetManager->publish(__DIR__ . '/assets/');
        Yii::app()->clientScript->registerScriptFile($publicPath . '/js/jquery.sticky.js', CClientScript::POS_BEGIN);
        Yii::app()->clientScript->registerCssFile($publicPath . '/css/main.css', CClientScript::POS_BEGIN);
//        Yii::app()->clientScript->registerScript('testeteste','$(".sticky-menu").sticky({topSpacing: 40});', CClientScript::POS_LOAD);
        parent::init();
    }

    public function run() {
        $this->render('_core');
    }

}
