<?php

/**
 * Description of MenuListaTopicos
 *
 * @author tiago
 */
class MenuListaTopicos extends CWidget {

    // Define se o titulo será mostrado caso não haja nenhum item
    public $showEmpty = false;
    public $title = null;
    // Atributos:
    //  Obrigatório: label, url
    //  Opcionais: likes
    public $items = array();

    public function init() {
        
    }

    public function run() {
        $this->render('_menuListaTopicos');
    }

}
