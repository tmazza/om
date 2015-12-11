<?php

class LinguagemController extends MonitorController {

    public function actionSage(){
      $this->render('sage');
    }

    public function actionPython(){
      $this->render('python');
    }

    public function actionR(){
      $this->render('r');
    }

    public function actionSingular(){
      $this->render('singular');    
    }

}
