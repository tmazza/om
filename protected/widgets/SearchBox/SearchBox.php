<?php

/**
 * Description of SearchBox
 *
 * @author tiago
 */
class SearchBox extends CWidget {

    public $source;
    public $formAction;
    public $inputName = 's';
    public $enableAjax = true;
    public $title = null;
    public $term = null;


    public function init() {
        // TODO: registrar aqui o script da visão
        parent::init();
    }

    public function run() {
        $this->render('_searchBox');
    }

}
