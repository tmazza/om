<?php

/**
 * Description of SobreController
 *
 * @author tiago
 */
class SobreController extends MonitorController {

    protected function beforeAction($action) {
        if (parent::beforeAction($action)) {
            $this->titleMenuContexto = 'O Monitor';
            $this->showMenuConteudo = false;
            $this->menuContexto = array(
                ShCode::makeItem('Apresentação', $this->createUrl('sobre/apresentacao')),
                ShCode::makeItem('Modo de usar', $this->createUrl('sobre/modoDeusar')),
                ShCode::makeItem('Plataformas', $this->createUrl('sobre/plataformas')),
                ShCode::makeItem('Referências', $this->createUrl('sobre/referencias')),
                // ShCode::makeItem('Parceiros', $this->createUrl('sobre/parceiros')),
            );
            return true;
        } else {
            return false;
        }
    }

    public function actionApresentacao() {
        $this->pageTitle = 'Apresentação - O Monitor';
        $this->render('paginaSimples', array(
            'org' => $this->getOrg(),
            'attr' => 'apresentacao',
        ));
    }

    public function actionModoDeUsar() {
        $this->pageTitle = 'Modo de usar - O Monitor';
        $this->render('paginaSimples', array(
            'org' => $this->getOrg(),
            'attr' => 'modoDeUsar',
        ));
    }

    public function actionPlataformas() {
        $this->pageTitle = 'Plataformas - O Monitor';
        $this->render('paginaSimples', array(
            'org' => $this->getOrg(),
            'attr' => 'plataformas',
        ));
    }

    public function actionReferencias() {
        $this->pageTitle = 'Referências - O Monitor';
        $this->render('paginaSimples', array(
            'org' => $this->getOrg(),
            'attr' => 'referencias',
        ));
    }

    // public function actionParceiros() {
    //     $this->pageTitle = 'Parceiros - O Monitor';
    //     $this->render('paginaSimples', array(
    //         'org' => $this->getOrg(),
    //         'attr' => 'parceiros',
    //     ));
    // }

    private function getOrg() {
        return Organizacao::model()->findByAttributes(array(
                    'orgID' => 'monitor'
        ));
    }

}
