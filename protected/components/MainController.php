<?php

/**
 * Utilizado por todos controllers da da aplicação
 */
class MainController extends CController {

    public $faceData = false;


    const INFO_FLASH = 'msg';
    const ERRO_FLASH = 'msg-e';
    const SUCS_FLASH = 'msg-s';

    public $pageTitle;
    public $descricao;
    public $org;

    protected function beforeAction($action) {
        $this->pageTitle = 'O Monitor - Resolve, confere e ilustra';
        $this->descricao = 'O Monitor é uma interface para o programa Sage cujas capacidades simbólica e numérica garantem respostas desde contas simples até o cálculo simbólico, envolvendo conceitos avançados. As capacidades gráficas permitem exibir imagens e animações interativas.';
        $this->org = Organizacao::model()->findByAttributes(['orgID'=>'monitor']);


        if (Yii::app()->request->isAjaxRequest) {
            Yii::app()->clientScript->scriptMap['jquery.js'] = false;
            Yii::app()->clientScript->scriptMap['jquery.min.js'] = false;
            Yii::app()->clientScript->scriptMap['jquery-ui.js'] = false;
            Yii::app()->clientScript->scriptMap['jquery-ui.min.js'] = false;
        } else {
            $sharedAssets = Yii::app()->assetManager->publish(Yii::getPathOfAlias('webroot.webroot'), false, -1, YII_DEBUG);

            Yii::app()->clientScript->registerCssFile($sharedAssets . '/css/sage-templates.css');

            Yii::app()->clientScript->registerScript('sagecell-autoload', 'sagecell.makeSagecell({inputLocation: " .sage-auto",autoeval: true,evalButtonText: "Resolver",hide:["editor","language","evalButton","permalink","done","sessionFiles"]});');

            Yii::app()->clientScript->registerScriptFile('https://sagecell.sagemath.org/static/embedded_sagecell.js');
        }
        return parent::beforeAction($action);
    }

}
