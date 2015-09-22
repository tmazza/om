<?php
class QuestionariosController extends MonitorController{

  public $questionario;
  public $template = '2';

  public function actions() {
      return array(
          'CorrigirQuestao' => array(
            'class' => 'shared.actions.CorrigirQuestao',
            'salvarResposta' => true,
          ),
          'updateOpcao' => array(
            'class' => 'shared.actions.QuestaoUpdateOpcao',
          ),
      );
  }

  public function actionIndex(){
    $this->pageTitle = 'Questionários - O Monitor';
    $questionarios = Questionario::model()->findAll();
    $this->render('index',array(
      'questionarios' => $questionarios,
    ));
  }

  public function actionVer($id){
    $qst = Questionario::model()->findByPk((int)$id);
    if(is_null($qst)){
      $this->redirect($this->createUrl('site/index'));
    }

    $this->pageTitle = 'Questionário ' . lcfirst($qst->nome) . ' - O Monitor';

    $this->render('ver',array(
      'qst' => $qst,
    ));
  }

}
