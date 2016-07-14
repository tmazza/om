<?php

/**
 * Description of MainSageCell
 *
 * @author davi
 */
class EquationResults extends CWidget {

    public $orgID = 'monitor';
    public $cod = null;
    public $eq;

    public function init() {
        $org = Organizacao::model()->findByAttributes(array(
            'orgID' => $this->orgID,
        ));

        if (!is_null($org)) {
            $this->cod = stripslashes(unserialize($org->traducoes)) . "\r\n";
            $this->cod .= ShView::mergeDataToTemplate(stripslashes(unserialize($org->equationResults)), array(
                        'funcao' => array('valor' => $this->eq),
            ));
        }
    }

    public function run() {
        $this->render('_equationResults');
    }

}
