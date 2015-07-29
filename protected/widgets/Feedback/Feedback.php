<?php
/**
 * Created by PhpStorm.
 * User: davi
 * Date: 18/06/15
 * Time: 22:56
 */
class Feedback extends CWidget {

    public $topico;
    public $autor_nome;
    public $autor_id;

    public function init() {

    }

    public function run() {
        $mensagem = "Tópico: {$this->topico}<br>Autor: {$this->autor_nome}<br>";
        $this->render('feedback',array("autor_id"=>$this->autor_id,"mensagem"=>$mensagem));
    }

}
