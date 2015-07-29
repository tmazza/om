<?php

/**
 * Description of MainSageCell
 *
 * @author davi
 */
class MainSageCell extends CWidget {

    public function init() {
        $funcaoJS = " function mainSageCell(){
                          if($('#mainSageCell').css('display') == 'none'){
                            $('#mainSageCell').show();
                          }else{
                            $('#mainSageCell').hide();
                          }
                      }";
        Yii::app()->clientScript->registerScript('mainSageCellJS',$funcaoJS);
    }

    public function run() {
        $this->render('_mainSageCell');
    }

}
