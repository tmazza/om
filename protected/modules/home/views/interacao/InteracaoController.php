<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DefaultController
 *
 * @author tiago
 */
class InteracaoController extends HomeController {

    public function actionIndex() {
      $order = 'dataEdicao DESC';
      $notes = Notebook::model()->doAutor()->findAll(array(
          'order' => $order,
      ));
      $this->render('index', array(
          'notes' => $notes,
      ));
    }

    public function actionNovaInteracao($tipo) {
        $note = Notebook::criarNova($tipo);
        if ($note->save()) {
            echo $this->renderPartial('_interacao', array('note' => $note), true, true);
        } else {
            echo 'Falaha ao criar.';
        }
    }
    //
    // public function actionLoad($id) {
    //     $note = Notebook::model()->doAutor()->findByPk($id);
    //     echo $this->renderPartial('_interacao', array('note' => $note), true, true);
    // }
    //
    // public function actionDelete($id) {
    //     Notebook::model()->deleteByPk($id, "user_id = '" . Yii::app()->user->id . "'");
    // }
    //
    // public function actionSave($id, $code) {
    //     $note = Notebook::model()->doAutor()->findByPk($id);
    //     if (!is_null($note)) {
    //         $note->codigo = addslashes($code);
    //         $note->dataEdicao = time();
    //         echo $note->update(array('codigo', 'dataEdicao')) == 1 ? 'Salvo!' : 'Falha ao salvar.';
    //     } else {
    //         echo "Falha ao atualizar.";
    //     }
    // }
    //
    // public function actionFavoritar($id) {
    //     if (Notebook::model()->updateByPk($id, array('favorito' => 1), "user_id = '" . Yii::app()->user->id . "'")) {
    //         echo $this->renderPartial('_favorito', array('note' => Notebook::model()->doAutor()->findByPk($id)), true, true);
    //     } else {
    //         echo $this->renderPartial('_naoFavorito', array('note' => Notebook::model()->doAutor()->findByPk($id)), true, true);
    //     }
    // }
    //
    // public function actionDesfavoritar($id) {
    //     if (Notebook::model()->updateByPk($id, array('favorito' => 0), "user_id = '" . Yii::app()->user->id . "'")) {
    //         echo $this->renderPartial('_naoFavorito', array('note' => Notebook::model()->doAutor()->findByPk($id)), true, true);
    //     } else {
    //         echo $this->renderPartial('_favorito', array('note' => Notebook::model()->doAutor()->findByPk($id)), true, true);
    //     }
    // }
    //
    // public function actionShare($id) {
    //     $note = Notebook::model()->doAutor()->findByPk($id);
    //     if (!is_null($note)) {
    //         echo $this->renderPartial('_share', array(
    //             'note' => $note,
    //             'users' => CHtml::listData(User::model()->findAll(), 'id', 'perfil.nome'),
    //                 ), true, true);
    //     } else {
    //         echo 'Erro ao carregar anotação.';
    //     }
    // }
    //
    // public function actionParaPublica($id) {
    //     $note = Notebook::model()->doAutor()->findByPk($id);
    //     $note->paraPublica();
    //     echo $this->renderPartial('_share', array(
    //         'note' => $note,
    //         'users' => CHtml::listData(User::model()->findAll(), 'id', 'perfil.nome'),
    //             ), true, false);
    // }
    //
    // public function actionParaPrivada($id) {
    //     $note = Notebook::model()->doAutor()->findByPk($id);
    //     if ($note->paraPrivada()) {
    //         Yii::app()->user->setFlash(self::SUCS_FLASH, 'Link destruído.');
    //     } else {
    //         Yii::app()->user->setFlash(self::ERRO_FLASH, 'Falha ao destruir link.');
    //     }
    //     $this->redirect($this->createUrl('default/index'));
    // }
    //
    // public function actionSend() {
    //     if (isset($_POST['id']) && isset($_POST['destinos']) && is_array($_POST['destinos'])) {
    //         $note = Notebook::model()->doAutor()->findByPk((int) $_POST['id']);
    //         if (!is_null($note)) {
    //             $count = 0;
    //             foreach ($_POST['destinos'] as $d) {
    //                 $user = User::model()->findByAttributes(array('id' => $d));
    //                 if (!is_null($user)) {
    //                     Yii::app()->user->setFlash(self::SUCS_FLASH, 'Compartilhado.');
    //                     if(ShMsg::enviar($d, Yii::app()->user->nome . " compartilhou " . CHtml::link('uma interação', $note->linkPublico) . ' com você.')){
    //                       $count++;
    //                     }
    //                 }
    //             }
    //             Yii::app()->user->setFlash(self::SUCS_FLASH, $count . ($count > 1 ? ' mensagens' : ' mensagem') . ' enviada(s).');
    //         } else {
    //             Yii::app()->user->setFlash(self::ERRO_FLASH, 'Anotação não encontrada.');
    //         }
    //     }
    //     $this->redirect($this->createUrl('default/index'));
    // }
    //
}