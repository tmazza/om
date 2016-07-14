<?php

/**
 * Description of Arquimedes
 *
 * @author tiago
 */
class Arquimedes extends CWidget {

    public $action = null;
    public $term = 'q';
    public $query = null;
    public $exp = null;
    public $tecladoTemplate = 'template1';
    public $ajaxUrl = null;
    public $ajaxUpdate = null;
    public $showSearchInput = true;
	  private $erro = false;
	  private $erroMsg = null;
    public $instructionOn = false;
    public $template = false;


    public function init() {
        $this->defineActionEnvio();
        $this->incluiAssets();
        $this->extraiConsulta();
    }

    public function run() {

		$this->exp = $this->organizaString($this->query);
		$instrucao = $this->defineInstrucao($this->exp);


		if($this->erro){
			$view = 'invalida';
			$code = $this->erroMsg;
		} else {
			if ($instrucao) {
				$view = 'instrucao';
				$code = $instrucao;
				SearchTerms::add($this->query,$code,$this->instructionOn->id);
			} else {
				$code = $this->exp = $this->organizaExpressao($this->exp);
				$view = 'geral';
				SearchTerms::add($this->query,$code,false);
			}
		}

    $viewName = $this->template ? $this->template : 'main';

    $this->render($viewName, array(
			'view' => $view,
			'code' => $code,
      ));
    }

    private function defineInstrucao() {
		$s = $this->exp;

        $matchs = array();
        preg_match('/^[a-zA-Z]{3,}/', $s, $matchs);

        if (count($matchs) > 0) {
            $c = $matchs[0];

            $strComando = substr($c, 0, strlen($c));
            $nomeInstrucao = InstrucaoNome::model()->findByPk($strComando);

            if (!is_null($nomeInstrucao)) {

                $exp = trim(substr($s, strlen($strComando), strlen($s) - strlen($strComando)));

        				// TODO: (erro) Separação de parâmetros em uma função serão interpretadas como separação de parâmetros de uma instrução
        				// e.g: integral derivada x^2,2 + 1. Será integral(derivada(x^2),2+1) ao invés de integal(derivada(x^2,2)+1)

                $params = explode(',', $exp);

				        $this->removeParentesesExternos($params);
                $data = array();
                foreach ($params as $k => $v) {
                    $data['p' . $k] = array('valor' => $this->organizaString($this->organizaExpressao($v)));
                }
                $instrucao = $nomeInstrucao->instrucao;
                if ($instrucao->publicado) {
                    $this->instructionOn = $instrucao;
                    return $instrucao->montar($data, count($data) <= 0);
                } else {
			               return false;
                }
            }
        } else {
            return false;
        }
    }

    /**
     * @param type $s
     */
    private function organizaString($s) {
        $s = rtrim($s);
        $this->removeEspacosDuplos($s);
        $this->removeEspacosProximosDeParenteses($s);
        $this->removeEspacosProximosVirgulas($s);
        // TODO: englobar caracteres especiais 'x','y','z' e outros entre parenteses? para possibilitar xsinx ???
        $this->ajustaSintaxeMultiplicacao($s);
        $this->ajustaSintaxeExponencial($s);
        return $s;
    }

    /**
     * Considera cada abertura e fechamento de parenteses como um conjunto identpendente,
     * para cada conjunto trata os espacos tentando obter uma expressão sage válida.
     * @param type $s
     */
    private function organizaExpressao($str) {
        $qtd = $this->contaParenteses($str);

        if ($qtd !== 0) {
            $this->expressaoInvalida("Número de parênteses inválido.");
        }

        $matchs = array();
        // Considera expressoes alfabeticas maiores do que dois como funções
        // e engloba conteúdo separado por espaços com parenteses
        preg_match_all('/[a-zA-Z]{2,}\s/U', $str, $matchs);

        // Método iniciando na expressão mais a direita
        if (count($matchs[0] > 0)) {

            krsort($matchs[0]);

            $offset = strlen($str);

            foreach ($matchs[0] as $m) {
                // strrpos busca a ultima ocorrencia da string
                $start = $i = strrpos(substr($str, 0, $offset), $m) + strlen($m);
                $offset = $start - 1;

                $end = null;
                do {
                    if ($str[$i] == ' ') {
                        $end = $i;
                    }
                    $i++;
                } while ($i < strlen($str) - 1 && is_null($end));

                if (is_null($end) && $i < strlen($str)) {
                    $end = $i + 1;
                } elseif (is_null($end)) {
                    $end = $i;
                }

                /**
                 * Evita ma formação de expressao
                 * sin x+ 2. Para evitar sin(x+)2, testa se o caracter anted do fim é um operados
                 * (+,-,*,/,outros?) e se for inclui o parentes uma posição antes.
                 */
                $str[$start - 1] = '(';
                if (in_array($str[$end - 1], array('+', '-', '*', '/'))) {
                    $aux = $str[$end - 1];
                    $str[$end - 1] = ')';
                    $str[$end] = $aux;
                } else {
                    $str[$end] = ')';
                }
            }
        }
        return $str;
    }

    /**
     * Percorre árvore atribuindo posição do fechamento para cada nodo
     * @param type $nodos
     * @param type $closes
     */
    private function addClose(&$nodos, $closes) {
        foreach ($nodos as $o => &$n) {
            $n['close'] = $closes[$o];
            $this->addClose($n['filhos'], $closes);
        }
    }

    /**
     * Dois ou mais espaços em branco são reduzido para um.
     * @param type $string
     * @return type
     */
    private function removeEspacosDuplos(&$string) {
        $string = preg_replace('/(\s+)/', ' ', $string);
    }

    /**
     * A partir da abertura de um parentese, '(', remove o espaço diretamente conectado à direita, caso exista.
     * O mesmo para o fechametento, ')', porém considerando o espaço à esquerda.
     * @param type $string
     */
    private function removeEspacosProximosDeParenteses(&$string) {
        $string = preg_replace(array(
            '/\(\s/',
            '/\s\)/',
                ), array('(', ')'), $string);
    }

    /**
     * A partir de ',', remove o espaço diretamente conectado à direita ou à esquerda.
     * @param type $string
     */
    private function removeEspacosProximosVirgulas(&$string) {
        $string = preg_replace(array(
            '/,\s/',
            '/\s,/',
                ), array(',', ','), $string);
    }

    /**
     * Inclui o caracter '*' entre cada sequencia de
     * numeros conectadas a uma sequencia de caracteres
     * alfabéticos a-z e A-Z
     *
     * TODO:
     *
     *  x(sin(x)) dever ser considerado multiplicação.
     *
     * @param type $string
     * @return type
     */
    private function ajustaSintaxeMultiplicacao(&$string) {
        $incluiAsterisco = function($match) {
            // Separa a parte numérica da parte de alfabética incluido '*' entre elas
            $separaExpressoes = function ($m) {
                return $m[0] . '*' . str_replace($m[0], '', $m[0]);
            };
            // Presume a existência de somente uma sequência numérica ou alfabética
            return preg_replace_callback('/[0-9]+/', $separaExpressoes, $match[0]);
        };
        // Busca sequancia de números diretamente conectadas a senquência de letras
        $string = preg_replace_callback('/[0-9\)]+[\(a-zA-Z]+/', $incluiAsterisco, $string);
    }

    /**
     * Inclui o caracter '^' sempre que houver um caracter alfabético ou ')' diretamente seguido
     * por uma sequência de números.
     *
     * TODO:
     *
     * expressões trigonmetricas expressas como sin3 x geram erros.
     * Deveria ser sin(x)^3, gera sin^3 x
     *
     *
     * @param type $string
     * @return type
     */
    private function ajustaSintaxeExponencial(&$string) {
        $incluiExponencial = function($match) {
            // Separa a parte numérica da parte de alfabética incluido '*' entre elas
            $separaExpressoes = function ($m) {
                return str_replace($m[0], '', $m[0]) . '^' . $m[0];
            };
            // Presume a existência de somente uma sequência numérica ou alfabética
            return preg_replace_callback('/[0-9]+/U', $separaExpressoes, $match[0]);
        };
        // Busca sequancia de números alfabética ou fechamento de parenteses diretamente conectados a um número
        $string = preg_replace_callback('/[a-zA-Z\)]\d+/U', $incluiExponencial, $string);
    }

	private function contaParenteses($str){
		$caracteres = str_split($str);

        $qtd = 0;
        foreach ($caracteres as $k => $c) {
            if ($c == '(') {
                $qtd++;
            } elseif ($c == ')') {
                $qtd--;
            }
        }
        return $qtd;
	}

	private function removeParentesesExternos(&$params){
		if(count($params) > 1){
			$primeiro = $params[0];
			$ultimo = $params[count($params) - 1];

			if($this->contaParenteses($primeiro) == 1 && $this->contaParenteses($ultimo) == -1) {
				$params[0] = substr($primeiro,1,strlen($primeiro));
				$params[count($params) - 1] = substr($ultimo,0,-1);;
			}
		}
	}

    // Init functions
    private function defineActionEnvio() {
        if (is_null($this->action)) {
            $this->action = Yii::app()->controller->action->id;
        }
    }

    private function incluiAssets() {
        $public = Yii::app()->assetManager->publish(__DIR__ . '/assets',false,-1,true);
        Yii::app()->clientScript->registerScriptFile($public . '/main.js');
        Yii::app()->clientScript->registerCssFile($public . '/css/default.css');
    }

    private function extraiConsulta() {
        $this->query = Yii::app()->request->getQuery($this->term, null);
    }

    private function expressaoInvalida($erro){
		$this->erro = true;
		$this->erroMsg = $erro;
		SearchTerms::add($this->query,$erro,null,false);
	}

}
