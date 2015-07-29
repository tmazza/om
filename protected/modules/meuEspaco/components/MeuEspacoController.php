<?php

/**
 * Description of MonitorController
 *
 * @author tiago
 */
class MeuEspacoController extends EditorController {


    public function beforeAction($action) {
        $this->layout = 'meuEspaco.views.layouts.main';
        return parent::beforeAction($action);
    }
        /**
     *
     * @return type
     */
    protected function getCursosMatriculados() {
        return Curso::getCursosMatriculados();
    }

    /**
     * Retorna model de aluno logado
     * @return type
     */
    public function getAluno() {
        return $this->getUserPerfil();
    }
   
}
