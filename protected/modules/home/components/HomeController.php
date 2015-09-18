<?php

/**
 * Description of MonitorController
 *
 * @author tiago
 */
class HomeController extends MonitorController {


    public function beforeAction($action) {
        $this->layout = '/layouts/main';
        return parent::beforeAction($action);
    }

}
