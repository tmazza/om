<?php

/**
 * Description of Widget
 *
 * @author tiago
 */
class WidgetView extends CWidget {

    public $str;
    public $data;
    public $showParametros = false;
    public $showPreview = true;
    public $url = null;

    public function init() {
        if (is_null($this->url)) {
            $this->url = Yii::app()->controller->createUrl('updateWidgetView');
        }
    }

    public function run() {
        $this->render('main', array(
            'params' => ShView::extraiParametros($this->str),
            'code' => ShView::mergeDataToTemplate($this->str, $this->data),
        ));
    }

}
