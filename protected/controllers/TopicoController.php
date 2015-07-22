<?php

/**
 * Description of TopicoController
 *
 * @author tiago
 */
class TopicoController extends MonitorController {

    /**
     * Visualização de conteúdo do tópico
     * @param type $id
     */
    public function actionVer($id, $nome = null) {
        $this->redirect(array("topico/conteudo", "id" => $id, 'nome' => $nome));
    }

    public function actionConteudo($id, $nome = null) {
        $this->showHideMenu = true;
        $this->layout = 'colunaDireita';
        $topico = $this->getTopico($id);
        // Camada raiz de tópico não encontrada. Não devia!
        if (is_null($topico->camadaRaiz)) {
            Yii::app()->user->setFlash('alert-error', 'Conteúdo não encontrado. :/');
            $this->redirect($this->createUrl('site/index'));
        }

        // Expande conteúdo interno
        $topico->camadaRaiz->conteudo = $topico->camadaRaiz->expandeCamadasVisualizacao($topico->camadaRaiz->conteudo);

        $this->render('ver', array(
            'topico' => $topico,
        ));
    }

    /**
     * Tópicos relacionados a este
     * @param type $id
     */
    public function actionRelacionados($id) {
        $this->render('relacionados', array(
            'topico' => $this->getTopico($id),
        ));
    }

    /**
     * Principais interações de $id
     * @param type $id
     */
    public function actionPrincipaisInteracoes($id) {
        $this->layout = 'colunaDireita';
        $this->showHideMenu = true;
        $topico = $this->getTopico($id);
        // Expande conteúdo interno
        $topico->camadaRaiz->conteudo = $topico->camadaRaiz->expandeCamadasVisualizacao($topico->camadaRaiz->conteudo);

        $this->render('principaisInteracoes', array(
            'topico' => $topico,
        ));
    }

    /**
     * Visualização de conteúdo do tópico
     * Se usuário não logado: acesso somente aos tópicos publicados e publicos.
     * Se usuário logado e autor: acesso a todos os tópicos de sua autoria 
     * publicado ou não. E acesso aos tópicos como aluno.
     * Se usuário logado e aluno: acesso a tópicos publicos e/ou privado, publicados. 
     * @param type $id
     */
    private function getTopico($id) {
        if (Yii::app()->user->isGuest) {
            $topico = Topico::model()
                    ->somenteDeAutores()
                    ->paraConvidado()
                    ->with('camadaRaiz')
                    ->findByPk((int) $id);
        } else {
            if (Yii::app()->user->perfil == 'autor' || Yii::app()->user->perfil == 'admin') {
                $topico = Topico::model()
                        ->somenteDeAutores()
                        ->paraAutor(Yii::app()->user->id)
                        ->with('camadaRaiz')
                        ->findByPk((int) $id);
            } else {
                $topico = Topico::model()
                        ->somenteDeAutores()
                        ->paraAluno(Yii::app()->user->id)
                        ->with('camadaRaiz')
                        ->findByPk((int) $id);
            }
        }
        // Caso não encontre ou usuário não tenha acesso
        if (!isset($topico) || is_null($topico)) {
            Yii::app()->user->setFlash('alert-error', 'Conteúdo inacessível. :/');
            $this->redirect($this->createUrl('site/index'));
        }
        return $topico;
    }

}
