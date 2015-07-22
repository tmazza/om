<?php

/**
 * Description of PerfilController
 *
 * @author tiago
 */
class PerfilController extends MonitorController {

    public function actionAutor($nome) {
        $autor = Autor::model()->findByPk($nome);
        $this->render('autor', array(
            'autor' => $autor,
        ));
    }

}
