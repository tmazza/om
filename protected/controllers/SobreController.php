<?php

/**
 * Description of SobreController
 *
 * @author tiago
 */
class SobreController extends MainController {

    public function actionApresentacao() {
        $this->renderPage('apresentacao','Apresentação - O Monitor');
    }

    public function actionModoDeUsar() {
        $this->renderPage('modoDeUsar','Modo de usar - O Monitor');
    }

    public function actionPlataformas() {
        $this->renderPage('plataformas','Plataformas - O Monitor');
    }

    public function actionReferencias() {
        $this->renderPage('referencias','Referências - O Monitor');
    }

    public function actionComentarios() {
        $this->renderPage('comentarios','Primeiras Impressões - O Monitor');
    }

    private function renderPage($attr,$titulo){        
        $this->pageTitle = $titulo;
        $this->render('paginaSimples', array(
            'org' => Organizacao::model()->findByAttributes(['orgID' => 'monitor']),
            'attr' => $attr,
        ));
    }

}
