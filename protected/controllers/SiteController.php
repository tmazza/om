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
        $this->layout = 'index';
        $this->showMainSearch = true;
        // Topicos paginados
        $criteria = new CDbCriteria;
        $criteria->condition = "publicado = 1 AND publico = 1"; // TODO: quando user logado acesso a não público
        $criteria->with = array(
            'autor' => array(
                'condition' => "tipo = 'autor'",
            ),
        );
        $criteria->order = "comDestaque DESC"; // TODO: quando user logado acesso a não público
        $total = Topico::model()->count($criteria);

        $pages = new CPagination($total);
        $pages->pageSize = 10;
        $pages->applyLimit($criteria);
        $topicos = Topico::model()->findAll($criteria);
        $this->render('index', array(
            'topicos' => $topicos,
            'pages' => $pages,
        ));
    }

    public function actionTopicos() {
        $this->render('autores', array(
            'autores' => Autor::model()->findAll(),
        ));
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
                echo $error['message'];
            }
        } else {
            $this->render('error', array(
                'message' => $msg,
                'code' => '---',
            ));
        }
    }

    public function actionLogin() {
        $this->layout = 'semColunas';
        $model = new LoginForm;

        if (isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];
            if ($model->validate() && $model->login()) {
                $this->redirect($this->createUrl('meuEspaco/default/index'));
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
    public function actionCadastro() {
        $this->layout = 'semColunas';
        $model = new ShCadastro;
        $form = new CForm(ShCadastro::getForm(), $model);

        if ($form->submitted('cadastro') && $form->validate()) {
            $model->attributes = $_POST['ShCadastro'];
            if (Aluno::salvaNovoAluno($model)) {
                $user = User::model()->findByAttributes(array(
                    'username' => $model->username,
                ));
                if ($model->logaUsuario($user)) {
                    $this->redirect($this->createUrl('/meuEspaco/default/index'));
                } else {
                    $this->rediect($this->createUrl('site/index'));
                }
            } else {
                Yii::app()->user->setFlash('msg-e', 'Bem vindo!');
                $this->redirect($this->createUrl('site/index'));
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
                'username' => $_POST['destino'],
            ));
            if (!is_null($user) && ShMsg::enviar($user->id, $_POST['mensagem']))
                echo 1;
            else
                echo 0;
        }else {
            echo 0;
        }
    }

    public function actionTeste() {
        $this->layout = 'semColunas';

        $this->render('aa');
    }

}
