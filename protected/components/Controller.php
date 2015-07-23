<?php

/**
 * Utilizado por todos os da aplicação
 */
class Controller extends CController implements IRootController {

    public $pageTitle = '';
    private $orgID = 'monitor';
    protected $activeSagecell = true;
    protected $processaLatex = true;
    // Se o botao para resolver problemas deve aparever ou não
    public $showSolver = true;
    protected $lite = true;

    protected function beforeAction($action) {
        if (!Yii::app()->request->isAjaxRequest) {
            $sharedAssets = Yii::app()->assetManager->publish(Yii::getPathOfAlias('shared.webroot'), false, -1, true);
            Yii::app()->clientScript->registerCssFile($sharedAssets . '/css/sage-templates.css');
            Yii::app()->clientScript->registerScript('sagecell-default', 'sagecell.makeSagecell({inputLocation: " .sage",hide:["evalButton","permalink"]});');
            Yii::app()->clientScript->registerScript('sagecell-em-edicao', 'sagecell.makeSagecell({inputLocation: " .sage-edit",evalButtonText: "Processar",hide:["permalink"]});');
            Yii::app()->clientScript->registerScript('singular-em-edicao', 'sagecell.makeSagecell({languages:["singular"],inputLocation: " .singular-edit",evalButtonText: "Processar",hide:["permalink"]});');
            Yii::app()->clientScript->registerScript('r-em-edicao', 'sagecell.makeSagecell({languages:["r"],inputLocation: " .r-edit",evalButtonText: "Processar",hide:["permalink"]});');
            Yii::app()->clientScript->registerScript('sagecell-autoload', 'sagecell.makeSagecell({inputLocation: " .sage-auto",autoeval: true,evalButtonText: "Resolver",hide:["editor","language","evalButton","permalink","done","sessionFiles"]});');

            if ($this->activeSagecell) {
                if ($this->processaLatex) { // Inclui em todas as views, exceto na edição
                    Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/js/embedded_sagecell.js");
                } else {// Inclui em todas as views, exceto na edição
                    Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/js/embedded_sagecell_no_mathJax.js");
                }
            }
        } else {
            Yii::app()->clientScript->scriptMap['jquery.js'] = false;
            Yii::app()->clientScript->scriptMap['jquery.min.js'] = false;
            Yii::app()->clientScript->scriptMap['jquery-ui.js'] = false;
            Yii::app()->clientScript->scriptMap['jquery-ui.min.js'] = false;
        }
        return parent::beforeAction($action);
    }

    public function getOrgID() {
        return $this->orgID;
    }

    public function actionError() {
        echo '<pre>';
        print_r(Yii::app()->errorHandler->error);
        exit;
        echo '<pre>';
        print_r('Erro');
        exit;
    }

}
