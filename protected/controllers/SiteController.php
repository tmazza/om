<?php

class SiteController extends MainController {

    public function actions() {
        return array(
            'loadType' => array(
                'class' => 'shared.actions.ParseString'
            ),
            'updateWidgetView' => array(
                'class' => 'shared.actions.UpdateWidgetView'
            ),
        );
    }

    public function actionIndex() {
        $this->layout = 'main';
        $this->render('index', array(
            'comoUsar' => $this->getComoUsar(),
        ));
    }

    private function getComoUsar(){
      return $this->org->como_usar;
    }

    public function actionAleatorio(){
      $exemplos = CHtml::listData(ExemplosSearch::model()->findAll("publicado = 1"),'id','valor');
      $ids = array_keys($exemplos);
      $sel = rand(0,count($ids)-1);
      $this->redirect($this->createUrl('site/index',array(
        'q' => $exemplos[$ids[$sel]],
      )));
    }

    public function actionError($msg = null) {
        if (is_null($msg)) {
            if ($error = Yii::app()->errorHandler->error) {
                  $this->render('error', array(
                      'error' => Yii::app()->errorHandler->error,
                      'message' => $error['message'],
                      'code' => $error['code'],
                  ));
            }
        } else {
            $this->render('error', array(
                'message' => $msg,
                'code' => '',
            ));
        }
    }

    public function actionExemplos(){
      $exemplos = ExemplosSearchCategoria::model()->findAll(array(
        'order'=>'ordem',
        'condition' => 'pai_id IS NULL',
      ));
      $this->renderPartial('/site/exemplos',[
        'exemplos'=>$exemplos,
      ]);
    }

}
