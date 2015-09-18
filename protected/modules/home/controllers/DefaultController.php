<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DefaultController
 *
 * @author tiago
 */
class DefaultController extends HomeController {

    public function actionIndex() {
      $notes = Notebook::model()->doAutor()->findAll(array(
        'condition' => 'sharing = 1',
        'order' => 'dataEdicao DESC',
      ));
      $this->render('index',array(
        'notes' => $notes,
      ));
    }

}
