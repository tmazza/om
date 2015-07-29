<?php

/**
 * Description of MenuListaTopicos
 *
 * @author tiago
 */
class MenuMultiLevel extends CWidget {

    public $title = 'Menu';
    public $items = array();

    public function init() {
        
    }

    public function run() {
        $this->render('main', array(
            'a' => $this->items,
        ));
    }

}
