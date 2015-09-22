<?php
class InstrucoesController extends MonitorController{

  public function actionIndex(){
      $this->pageTitle = 'Instruções - O Monitor';
      $instrucoes = Instrucao::model()->with('nomes')->findAll(array(
        'condition' => 'publicado = 1',
        'alias' => 't',
        'order' => 't.descricao ASC',
      ));

      $this->render('index', array(
        'instrucoes' => $instrucoes,
      ));
    }

    public function actionVer($id){


      $instrucao = Instrucao::model()->with('nomes')->findByPk((int)$id,array(
        'condition' => 'publicado = 1',
      ));
      if(is_null($instrucao)){
        $this->redirect($this->createUrl('/site/index'));
      }

      $this->pageTitle = lcfirst($instrucao->descricao) . ' - O Monitor';

      $this->render('ver', array(
        'instrucao' => $instrucao,
      ));
    }
}
