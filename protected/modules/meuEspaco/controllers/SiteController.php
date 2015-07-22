<?php

/**
 * Description of SiteController
 *
 * @author tiago
 */
class SiteController extends MeuEspacoController {

    public function beforeAction($action) {
        return parent::beforeAction($action);
    }

    public function actionIndex() {
        $aluno = $this->getAluno();
        $this->render('index', array(
            'aluno' => $aluno,
        ));
    }

}
