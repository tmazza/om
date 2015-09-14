<?php
class InstrucoesController extends MonitorController{


  public function actionIndex(){
    $instrucoes = Instrucao::model()->with('nomes')->findAll(array(
      'condition' => 'publicado = 1',
      'alias' => 't',
      'order' => 't.descricao ASC',
    ));

    $this->render('index', array(
      'instrucoes' => $instrucoes,
    ));
  }
}
