<?php

namespace app\controllers;

use app\models\LoginForm;
use app\models\SignupForm;
use app\models\User;
use MyUtility\MyUtility;
use Yii;
use yii\web\Controller;

class AuthController extends Controller
{
		public $layout='basic';

		public function actionLogin()
		{
				$model = new LoginForm();
				if ($model->load(Yii::$app->request->post()) && $model->login()) {

				    return $this->redirect('index.php?r=client');
				}
				return $this->render('login', [
						'model' => $model,
				]);
		}

		/**
		 * Logout action.
		 *
		 * @return string
		 */
		public function actionLogout()
		{
//				Yii::$app->user->logout();
            Yii::$app->session->remove('authToken');
            Yii::$app->session->remove('login');
            Yii::$app->response->cookies->remove('authToken');
            Yii::$app->response->cookies->remove('login');
            return $this->redirect('index.php?r=auth/login');
		}


		public function actionSignup()
		{
				$model = new SignupForm();

				if(Yii::$app->request->isPost)
				{
						$model->load(Yii::$app->request->post());
						if($model->signup())
						{
								return $this->redirect(['auth/login']);
						}
				}

				return $this->render('signup', ['model'=>$model]);
		}

		public function actionLoginVk($uid, $first_name, $photo)
		{
				$user = new User();
				if($user->saveFromVk($uid, $first_name, $photo))
				{
						return $this->redirect(['site/index']);
				}
		}

		public function actionTest()
		{
				$user = User::findOne(1);

				Yii::$app->user->logout();

				if(Yii::$app->user->isGuest)
				{
						echo 'Пользователь гость';
				}
				else
				{
						echo 'Пользователь Авторизован';
				}
		}
}