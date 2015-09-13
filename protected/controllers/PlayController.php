<?php

class PlayController extends MonitorController {

    public function actionIndex($id) {
        $note = $this->getNote($id);
        if (is_null($note)) {
            $this->render('falha');
        } else {
            $this->render('interacao', array('note' => $note));
        }
    }

    public function actionCopy($id) {
        $note = $this->getNote($id);
        if (is_null($note)) {
            echo $this->render('falha', array(), true);
        } else {
            if (Yii::app()->user->isGuest) {
                echo $this->renderPartial('_facaLogin', array(), true);
            } else {
                if (Yii::app()->user->id == $note->user_id) {
                    echo $this->renderPartial('_jaESeu', array(), true);
                } else {
                    $note = Notebook::criarNova($note->linguagem, $note->codigo);
                    if ($note->save()) {
                        echo $this->renderPartial('_copiado', array(), true);
                    } else {
                        echo $this->renderPartial('_falhaAoSalvar', array(), true);
                    }
                }
            }
        }
    }

    private function getNote($id) {
        return Notebook::model()->findByAttributes(array(
                    'publicId' => $id,
                    'sharing' => 1,
        ));
    }

}
