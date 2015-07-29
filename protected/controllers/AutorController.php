<?php

class AutorController extends MonitorController {

    public function actions() {
        return array(
            'loadArv' => array(
                'class' => 'application.components.actions.LoadArvore',
            ),
        );
    }

    public function actionIndex($username) {
        $this->layout = 'inbox';
        $autor = User::model()->findByAttributes(array('username' => $username));
        if (is_null($autor)) {
            Yii::app()->user->setFlash('e-msg', 'Não encontrado.');
            $this->redirect($this->createUrl('site/index'));
        }
        $nodoRaiz = TaxItem::model()->findByAttributes(array(
            'user_id' => $autor->username,
            'tipo' => TaxItem::TipoRaizAutor,
        ));
        
        $this->render('index', array(
            'user' => $autor,
            'nodoRaiz' => $nodoRaiz,
        ));
    }

}
