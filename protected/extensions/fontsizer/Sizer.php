<?php

/**
 * Fontsizer extension for Yii.
 *
 * jQuery Fontsizer extension for Yii, for changing the font size on the pages without refreshes.
 * Its a wrapper of  https://github.com/Mottie/tablesorter
 *
 * @author Nachi <innovativenachi@gmail.com>
 * @link https://github.com/Mottie/tablesorter
 * @link https://github.com/innovativenachi/fontsizer
 * @version 0.1
 *
 */
class Sizer extends CWidget {

    public function init() {
        //Fontsizer was intialized
    }

    //Register CSS and Jquery
    public function registerClientScript() {
        $bu = Yii::app()->assetManager->publish(dirname(__FILE__) . '/assets/');
        $cs = Yii::app()->clientScript;
        //Intialize CSS
        $cs->registerCssFile($bu . '/css/font-sizer.css');
        //Intialize Jquery
        $cs->registerScriptFile($bu . '/js/jquery-latest.js');
        $cs->registerScriptFile($bu . '/js/font-sizer.js');
    }

    public function runSizer() {
        $bu = Yii::app()->assetManager->publish(dirname(__FILE__) . '/assets/');
        $this->render('_core', array(
            'bu' => $bu,
        ));
    }

    //Runs after the widget is intialized
    public function run() {
        $this->registerClientScript();
        $this->runSizer();
    }

}
