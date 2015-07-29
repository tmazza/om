<?php

class MeuEspacoModule extends CWebModule {

    public $modulosHabilitados = array();

    public function init() {
        $this->setModulePath(Yii::getPathOfAlias('shared.modules'));
        $this->setModules($this->modulosHabilitados);
        $this->setImport(array(
            'meuEspaco.components.*',
        ));
    }


    /**
     * Define controle de acesso para cada action, no formato controler.action => permissao
     * Asterisco para action significa que todas as actinons SEM nível de permissão atribuído
     * receberão tal permissão.
     */
    public function getControleDeAcesso() {
        return array(
            // Controller default
            'default.*' => false,
            // Controller site
            'site.*' => false,
        );
    }

}
