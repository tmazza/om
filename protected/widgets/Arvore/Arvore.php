<?php

/**
 * Description of Arvore
 *
 * @author tiago
 */
class Arvore extends CWidget {

    public $url = null;
    public $raiz = null;

    public function init() {
        $cs = Yii::app()->clientScript;
        $cs->registerScriptFile(Yii::app()->baseUrl . '/webroot/autor/plugin-d3/js/d3.js');
        $cs->registerScriptFile(Yii::app()->baseUrl . '/webroot/autor/plugin-d3/js/d3-la.js');
        if (is_null($this->url)) {
            $this->url = Yii::app()->controller->createUrl(Yii::app()->controller->id . '/loadArv');
            if (!is_null($this->raiz)) {
                $this->url .= '/raiz/' . $this->raiz;
            }
        }
    }

    public function run() {
        $this->render('main');
    }

}
