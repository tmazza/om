<?php
class InstrucoesController extends MainController{

    public function actionVer($id){
      $instrucao = Instrucao::model()->with('nomes')->findByPk((int)$id,array(
        'condition' => 'publicado = 1',
      ));
      if(is_null($instrucao)){
        $this->redirect($this->createUrl('/site/index'));
      }

      $this->pageTitle = ucfirst($instrucao->descricao) . ' - O Monitor';
      $this->descricao = 'InstruÃ§Ã£o ' . $instrucao->descricao;

      $this->render('ver', array(
        'instrucao' => $instrucao,
      ));
    }
}
