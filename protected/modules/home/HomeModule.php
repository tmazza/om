<?php

class HomeModule extends CWebModule {

    public $modulosHabilitados = array();

    public function init() {
        $this->setModulePath(Yii::getPathOfAlias('shared.modules'));
        $this->setImport(array(
            'home.components.*',
        ));
    }

}
