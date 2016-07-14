<?php

/**
 * Recebe uma lista de objetos que deve possuir os campos:
 * chave,valor,categoria.
 * Agrupa por categorias aplicando a view definida em $template
 *
 * @author tiago
 */
class ViewTeclado extends CWidget {

    public $inputID = null;
    public $tecladoID = null;
    public $template = 'template1';
    public $script = '_default';
    protected $categorias = array();

    public function init() {
        if (is_null($this->inputID)) {
            throw new Exception("'inputID' não definido. Informe qual o elemento que receberá o texto.");
        }
        if (is_null($this->tecladoID)) {
            throw new Exception("'tecladoID' não definido. Informe qual o elemento que reverá o texto.");
        }
        $this->publicaArquivos();
        $teclado = Teclado::model()->findByPk($this->tecladoID);
        if (is_null($teclado)) {
            throw new Exception("Teclado {$this->tecladoID}' não encontrado.");
        }
        $this->categorias = $teclado->categorias;
    }

    public function run() {
        $this->render($this->template, array(
            'categorias' => $this->categorias,
        ));
    }

    private function publicaArquivos() {
        $assetsPath = Yii::app()->assetManager->publish(__DIR__ . '/assets');
        Yii::app()->clientScript->registerCssFile($assetsPath . '/css/teclado-comandos-estilo.css');
    }

    public function getTeclas() {
        return $this->teclas;
    }

    public function getCategorias() {
        return $this->categorias;
    }

}
