<?php

class Template extends CWidget {

    public $template;
    public $data;
    public $conteudo;
    public $url = 'template/preview';
    public $update = 'preview-template';
    
    public $title = null;

    public function run() {
        $this->render('main', array(
            'template' => $this->template,
            'data' => $this->data,
            'conteudo' => $this->conteudo,
        ));
    }

}
