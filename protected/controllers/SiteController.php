<?php

class SiteController extends MonitorController {

//    use CamadaHelper;

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
        $exemplos = ExemplosSearchCategoria::model()->findAll(array(
          'order'=>'ordem',
          'condition' => 'pai_id IS NULL',
        ));
        $this->render('index', array(
            'exemplos' => $exemplos,
        ));
    }

    public function actionTopicos() {
        $this->render('autores', array(
            'autores' => Autor::model()->findAll(),
        ));
    }

    public function actionAleatorio(){
      $exemplos = CHtml::listData(ExemplosSearch::model()->findAll(),'id','valor');
      $ids = array_keys($exemplos);
      $sel = rand(0,count($ids)-1);
      $this->redirect($this->createUrl('site/index',array(
        'q' => $exemplos[$ids[$sel]],
      )));
    }

    public function actionAutor($autor) {
        $this->render('index', array(
            'topicos' => Topico::model()
                    ->autor($autor)
                    ->publicados()
                    ->findAll(),
        ));
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
                'code' => '---',
            ));
        }
    }

    //social integration
    public function actionSocialLogin(){
        //reference >>> http://www.yiiframework.com/wiki/459/integrating-hybridauth-directly-into-yii-without-an-extension/
        Yii::import('shared.components.HybridAuthIdentity');
        require_once Yii::getPathOfAlias('shared.extensions') . '/hybridauth-' . HybridAuthIdentity::VERSION . '/hybridauth/index.php';
    }

    public function actionLogin($b=false) {
        $this->pageTitle = 'Login - O Monitor';
        $model = new LoginForm;
        if (isset($_GET['provider'])){
            if($model->socialLogin($_GET['provider'])){
                $this->redirect($this->createUrl('/home/default/index'));
            }else {
                $this->redirect($this->createUrl('site/index'));
            }

        }

        if (isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];
            if ($model->validate() && $model->login()) {
                if($b){
                  $this->redirect(base64_decode($b));
                } else {
                  $this->redirect($this->createUrl('/home/default/index'));
                }
            }
        }
        $this->render('login', array('model' => $model));
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout() {
        Yii::app()->user->logout(FALSE);
        $this->redirect(Yii::app()->homeUrl);
    }

    public function actionSearch() {
        Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/googleSearch.js');
        $this->render("search");
    }

    public function actionSearchResults() {
        $this->render('searchResults');
    }

    public function actionSobre() {
        $org = Organizacao::model()->findByAttributes(array(
            'orgID' => 'monitor',
        ));
        $this->render('sobre', array(
            'org' => $org,
        ));
    }

    public function actionSearchMonitor() {
        $query = ($_GET['q']);
        $topicos = Topico::model()->buscarPublicados($query)->findAll();
        echo $this->renderPartial('searchTemplate', array(
            'topicos' => $topicos,
        ));

        //echo CJSON::encode($resultado);
        Yii::app()->end();
    }

    /**
     * Abre camada
     * @param type $id
     */
    public function actionExpandeCamada($id) {
        $camada = Camada::model()
                ->with('topico', 'tipo')
                ->findByPk($id);
        echo $camada->getTipoView($camada, true, true);
    }

    // Mantido por compatibilidade com links antigos
    public function actionView($id) {
        $this->redirect($this->createUrl('topico/ver', array('id' => $id)));
    }

    public function actionTeclado() {
        $this->render('testeTeclado');
    }

    /**
     * Cadastra novo aluno
     */
    public function actionCadastro($b=false) {
        $this->pageTitle = 'Cadastro - O Monitor';
        $model = new ShCadastro;
        $form = new CForm(ShCadastro::getForm(), $model);

        if ($form->submitted('cadastro') && $form->validate()) {
            $model->attributes = $_POST['ShCadastro'];

            if (User::salvaNovoAluno($model)) {
                $user = User::model()->findByAttributes(array(
                    'email' => $model->email,
                ));
                if ($model->logaUsuario($user)) {
                  if($b){
                    $this->redirect(base64_decode($b));
                  } else {
                    $this->redirect($this->createUrl('/home'));
                  }
                } else {
                    $this->rediect($this->createUrl('/site/index'));
                }
            } else {
                Yii::app()->user->setFlash('msg-e', 'Bem vindo!');
                $this->redirect($this->createUrl('/site/index'));
            }
        } else {
            $this->render('cadastro', array(
                'form' => $form,
            ));
        }
    }

    public function actionFeedback() {
        if (!is_null($_POST['destino']) && !is_null($_POST['mensagem'])) {
            $user = User::model()->findByAttributes(array(
                'id' => $_POST['destino'],
            ));

            $file = Arquivo::uploadFeedbackScreenshot($_POST['screenschot_src']);
            $link = Yii::app()->getBaseUrl(true)."/assets/feedback/".$file;
            $link = "<a href='$link' target='_blank'>Imagem Associada</a>";

            $mensagem = $_POST['email']."<br>".$_POST['mensagem']."<br>".$link;

            if (!is_null($user) && ShMsg::enviar($user->id, $mensagem))
                echo 1;
            else
                echo 0;
        }else {
            echo 0;
        }
    }

    /**
     * Converte de html para pretty_print
     */
    private function htmlToPrettyPrint($code){
      // procura por html("...")
      $pattern = '/html\("(.*)"\)/U';
      $replacement = 'pretty_print(html(\'\1\'))';
      $code = preg_replace($pattern, $replacement, $code);
      // procura por html('...')
      $pattern = "/html\('(.*)'\)/U";
      $replacement = 'pretty_print(html(\'\1\'))';
      $code = preg_replace($pattern, $replacement, $code);

      // ERRO! esta diplicando prittty print em alguns casos

      // procura por html("..."[ ]%
      $pattern = "/html\(\"(.*)\"( )*%(.*)\)/";
      $replacement = 'pretty_print(html("\1" % \3))';
      $code = preg_replace($pattern, $replacement, $code);
      // procura por html('...'[ ]%
      $pattern = "/html\('(.*)'( )*%(.*)\)/";
      $replacement = 'pretty_print(html(\'\1\' % \3))';
      $code = preg_replace($pattern, $replacement, $code);

      return $code;

    }


    // public function actionCb(){
    //   $org = Organizacao::model()->findByAttributes(array('orgID' => 'monitor'));
    //   $code = stripslashes(unserialize($org->equationResults));
    //   $change = $this->htmlToPrettyPrint($code);
    //   $org->equationResults = serialize(addslashes($change));
    //   $org->update(array('equationResults'));
    //   $this->render('aa',array('c'=>$change));
    // }

    //
    // public function actionIt(){
    //   $insts = InstrucaoCodigo::model()->findAll();
    //   foreach ($insts as $i) {
    //     $i->template = addslashes($this->htmlToPrettyPrint(stripslashes($i->template)));
    //     echo $i->id.',';
    //     $i->update(array('template'));
    //   }
    // }

    public function actionRpp(){
      $insts = InstrucaoCodigo::model()->findAll();
      foreach ($insts as $i) {
        $i->template = addslashes($this->removePrettyPrintDuplicados(stripslashes($i->template)));
        echo $i->id.',';
        $i->update(array('template'));
      }
    }

    private function removePrettyPrintDuplicados($code){
      return str_replace('pretty_print(pretty_print(','pretty_print((',$code);
    }


}
