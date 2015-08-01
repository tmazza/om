<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class LoginForm extends CFormModel {

    public $username;
    public $password;
    public $rememberMe;
    private $_identity;

    /**
     * Declares the validation rules.
     * The rules state that id and password are required,
     * and password needs to be authenticated.
     */
    public function rules() {
        return array(
            array('username, password', 'required'),
            array('rememberMe', 'boolean'),
            array('password', 'authenticate'),
        );
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels() {
        return array(
            'username' => 'Usuário',
            'password' => 'Senha',
        );
    }

    /**
     * Authenticates the password.
     * This is the 'authenticate' validator as declared in rules().
     */
    public function authenticate($attribute, $params) {
        if (!$this->hasErrors()) {
            $this->_identity = new ShUserIdentity($this->username, $this->password);
            if (!$this->_identity->authenticate())
                $this->addError('password', 'Username ou senha incorreta.');
        }
    }

    /**
     * Logs in the user using the given id and password in the model.
     * @return boolean whether login is successful
     */
    public function login() {
        if ($this->_identity === null) {
            $this->_identity = new ShUserIdentity($this->username, $this->password);
            $this->_identity->authenticate();
        }
        if ($this->_identity->errorCode === ShUserIdentity::ERROR_NONE) {
            $duration = $this->rememberMe ? 3600 * 24 * 30 : 0; // 30 days
            Yii::app()->user->login($this->_identity, $duration);
            return true;
        } else
            return false;
    }

    public function socialLogin($provider){
		
        try
        {
            $haComp = new HybridAuthIdentity();

            if (!$haComp->validateProviderName($_GET['provider']))
                throw new CHttpException ('500', 'Operação inválida. Tente novamente.');
			
            $haComp->adapter = $haComp->hybridAuth->authenticate($provider);
            $haComp->userProfile = $haComp->adapter->getUserProfile();

            if(User::usuarioExistente($haComp->userProfile->email)){
                User::logaUsuarioSocial($haComp->userProfile->email);
            }else{
                User::salvaAlunoImportadoDeRedeSocial($haComp);
                User::logaUsuarioSocial($haComp->userProfile->email);
            }

        }
        catch (Exception $e)
        {
   			ShEmail::send('tiagomdepaula@gmail.com','Falha de login/signin','OMonitor','sistema@omonitor.io','MSG: ' . $e->getMessage());
   			ShEmail::send('davi646@gmail.com','Falha de login/signin','OMonitor','sistema@omonitor.io','MSG: ' . $e->getMessage());
            Yii::app()->controller->redirect(array('/site/login'));
        }
    }

}
