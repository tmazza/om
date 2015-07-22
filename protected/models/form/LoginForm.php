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

}
