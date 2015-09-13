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
    $questionarios = Questionario::model()->findAll();
    $this->render('index',array(
      'questionarios' => $questionarios,
    ));
  }

  public function actionVer($id){
    $qst = Questionario::model()->findByPk((int)$id);
    $this->render('ver',array(
      'qst' => $qst,
    ));
  }

}
