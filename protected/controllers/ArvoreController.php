<?php

/**
 * Description of ArvoreController
 *
 * @author tiago
 */
class ArvoreController extends MonitorController {

    public function actions() {
        return array(
            'loadArv' => array(
                'class' => 'application.components.actions.LoadArvore',
            ),
        );
    }

    public function beforeAction($action) {
        $this->showArvoreConteudo = false;
        return parent::beforeAction($action);
    }

    public function actionVer3() {
        $this->layout = "semColunas";
        $cs = Yii::app()->clientScript;
        $cs->registerScriptFile(Yii::app()->baseUrl . '/webroot/autor/plugin-d3/js/d3.js');
        $this->render('ver3', array());
    }

    public function actionVer4() {
        $this->layout = "semColunas";
        $this->render('ver4', array());
    }

}
