<?php

/**
 * Description of MainMenuMeuEspaco
 *
 * @author tiago
 */
class MainMenuMeuEspaco extends CWidget {

    public $menu;

    public function init() {
        foreach ($this->menu as &$c) {
            $qtdLinksVisiveis = 0;
            foreach ($c['items'] as $i) {
                if ($i['visible']) {
                    $qtdLinksVisiveis++;
                }
            }
            $c['visible'] = $qtdLinksVisiveis > 0;
        }
    }

    public function run() {
        $this->render('_menuTemplate');
    }

}
