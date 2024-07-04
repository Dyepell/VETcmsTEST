<?php

namespace app\models;

use MyUtility\MyUtility;
use phpDocumentor\Reflection\Types\This;
use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $name
 * @property string $login
 * @property string $password
 * @property integer $isAdmin
 * @property string $photo
 *
 * @property Comment[] $comments
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{
		/**
		 * @inheritdoc
		 */
		public static function tableName()
		{
				return 'user';
		}

		/**
		 * @inheritdoc
		 */
		public function rules()
		{
				return [
						[['isAdmin'], 'integer'],
						[['name', 'login', 'password', 'photo'], 'string', 'max' => 255],
				];
		}

		/**
		 * @inheritdoc
		 */
		public function attributeLabels()
		{
				return [
						'id' => 'ID',
						'name' => 'Name',
						'login' => 'Login',
						'password' => 'Password',
						'isAdmin' => 'Is Admin',
						'photo' => 'Photo',
                        'authToken' => 'Token'
				];
		}

		/**
		 * @return \yii\db\ActiveQuery
		 */

		public static function findIdentity($id)
		{
				return User::findOne($id);
		}
		public function getId()
		{
				return $this->id;
		}

		public function getAuthKey()
		{
				// TODO: Implement getAuthKey() method.
		}

		public function validateAuthKey($authKey)
		{
				// TODO: Implement validateAuthKey() method.
		}

		public static function findIdentityByAccessToken($token, $type = null)
		{
				// TODO: Implement findIdentityByAccessToken() method.
		}

		public static function findByLogin($login)
		{
				return User::find()->where(['login'=>$login])->one();
		}

		public function validatePassword($password)
		{
		    return ($this->password == hash('sha256', $password) ) ? true : false;
		}

		public function create()
		{
				return $this->save(false);
		}

		public function saveFromVk($uid, $name, $photo)
		{
				$user = User::findOne($uid);
				if($user)
				{
						return Yii::$app->user->login($user);
				}

				$this->id = $uid;
				$this->name = $name;
				$this->photo = $photo;
				$this->create();

				return Yii::$app->user->login($this);
		}

		public function getImage()
		{
				return $this->photo;
		}

		public function findByToken($token)
        {
            return User::find()->where(['password'=>$token])->one();
        }
}