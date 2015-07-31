<?php

/**
 * Description of SearchController
 *
 * @author tiago
 */
class SearchController extends MonitorController {

    public $palavrasOriginais = array();


    public function actions() {
        return array(
            'ParseInstrucao' => 'shared.actions.ParseInstrucao',
            'AutocompleteInstrucao' => 'shared.actions.AutocompleteInstrucao',
        );
        
    }

    public function actionResults($s) {
        $this->showMainSearch  = false;
        $this->layout = "semColunas";
        if (strlen($s) >= 1) {
            if (substr($s, 0, 1) === '=') {
                $this->redirect($this->createUrl('ResultEq', array('s' => substr($s, 1, strlen($s) - 1))));
            } else {
                $this->render('searchResults', array(
                    'search' => $s,
                    'palavras' => $this->getPalavras($s),
                    'topicos' => $this->getItems($s, 40),
                ));
            }
        } else {
            $this->render('searchResults', array(
                'search' => $s,
                'palavras' => array(),
                'topicos' => array(),
            ));
        }
    }

    public function actionResultEq() {
		$this->faceData = true;
        $this->showMainSearch  = false;
        $this->layout = "search";
        $this->render('equationResults');
    }
    
    public function actionExemplos($c){
		$cat = ExemplosSearchCategoria::model()->findByPk((int) $c);
		if(is_null($cat)){
			echo '...';
		} else {
			$this->renderPartial('exemplos', array(
				'nome' => $cat->nome,
				'exemplos' => $cat->exemplos,
			));
		}
	}

    /**
     * Resultados ajax da busca principal
     * @param type $term
     */
    public function actionAjaxMainResults($s) {
        echo $this->renderPartial('menuSearchTemplate', array(
            'topicos' => $this->getItems($s),
                ), true);
    }

    /**
     * Resultados ajax da busca do menu
     * @param type $term
     */
    public function actionAjaxMenuResults($s, $limit = 10) {
        echo $this->renderPartial('menuSearchTemplate', array(
            'topicos' => $this->getItems($s, $limit),
                ), true);
    }

    /**
     * Retorna conjunto de items que se aplicam a busca.
     * Busca sendo realizada somente em Topico.nome
     * @param type $search
     * @return type
     */
    private function getItems($search, $limit = 10) {
        $resultados = $this->realizaBusca($search);
        $merged = array();
        foreach ($resultados as $u) {
            $merged[$u->id] = $u;
        }
        return array_slice($merged, 0, $limit);
    }

    /**
     * Remove conectores da string.
     * Para cada palavra busca resultados.
     */
    private function realizaBusca($search) {
        $this->palavrasOriginais = $palavras = $this->getPalavras($search);
        $resultados = array();
        foreach ($palavras as $p) {
            $resultados = array_merge($resultados, $this->buscaPalavra($p));
        }
        return $resultados;
    }

    /**
     * Remove conectores.
     * TODO: melhorar!
     * @param type $palavras
     */
    private function getPalavras($search) {
        $palavras = explode(' ', $search);
        foreach ($palavras as $k => $p) {
            if (strlen($p) < 3) {
                unset($palavras[$k]);
            }
        }
        return $palavras;
    }

    /**
     * Para cada palavra busca ocorrencia em tópico e em subnbtopico
     */
    private function buscaPalavra($palavra) {
        $porNome = Topico::buscaPorNome($palavra);
        $porSubTopico = Topico::buscaTituloSubTopico($palavra);
        return array_merge($porNome, $porSubTopico);
    }
    
    /**
     * Salvar link de processamento da busca
     */
    public function actionSave($q){
		if(Yii::app()->user->isGuest){
			$this->renderPartial('_loginSearch');
		} else {
			if(SearchLinks::inclui($q)){
				$this->renderPartial('_savedSearch');
			} else {
				echo 'Não foi possível salvar.';
			}			 
		}
	}

}
