<?php

namespace app\models;

use MyUtility\MyUtility;
use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class LoginForm extends Model
{
		public $login;
		public $password;
		public $rememberMe = true;

		private $_user = false;


		/**
		 * @return array the validation rules.
		 */
		public function rules()
		{
				return [
						// email and password are both required
						[['login', 'password'], 'required'],
						// rememberMe must be a boolean value
						['rememberMe', 'boolean'],
						// password is validated by validatePassword()
						['password', 'validatePassword'],
				];
		}

		/**
		 * Validates the password.
		 * This method serves as the inline validation for password.
		 *
		 * @param string $attribute the attribute currently being validated
		 * @param array $params the additional name-value pairs given in the rule
		 */
		public function validatePassword($attribute, $params)
		{
				if (!$this->hasErrors()) {
						$user = $this->getUser();
						if (!$user || !$user->validatePassword($this->password)) {
						    $this->addError($attribute, 'Incorrect login or password.');
						}
				}
		}

		/**
		 * Logs in a user using the provided email and password.
		 * @return bool whether the user is logged in successfully
		 */
		public function login()
		{

				if ($this->validate()) {

                    $session = Yii::$app->session;
                    $cookies = Yii::$app->response->cookies;
                    $session->set('authToken', hash('sha256', $this->password));
                    $session->set('login', $this->login);

                    $cookies->add(new \yii\web\Cookie([
                        'name' => 'authToken',
                        'value' => hash('sha256', $this->password),
                        'expire' => time() + 30*24*60*60
                    ]));

                    $cookies->add(new \yii\web\Cookie([
                        'name' => 'login',
                        'value' => $this->login,
                        'expire' => time() + 30*24*60*60
                    ]));

                    return true;
//						return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600*24*30 : 0);
				}
				return false;
		}

		/**
		 * Finds user by [[email]]
		 *
		 * @return User|null
		 */
		public function getUser()
		{
				if ($this->_user === false) {
						$this->_user = User::findBylogin($this->login);
				}

				return $this->_user;
		}
}