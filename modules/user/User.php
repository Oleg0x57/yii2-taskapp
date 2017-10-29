<?php

namespace app\modules\user;

use Yii;
use yii\base\NotSupportedException;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $email
 * @property string $password
 * @property string $auth_key
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
            [['email', 'password', 'auth_key'], 'string', 'max' => 255],
            [['auth_key'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'Email',
            'password' => 'Password',
            'auth_key' => 'Auth Key',
        ];
    }

    public function getId()
    {
        return $this->id;
    }

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    public function beforeSave($insert)
    {
        $return = parent::beforeSave($insert);
        if ($this->isNewRecord) {
            $this->auth_key = Yii::$app->security->generateRandomString(255);
        }
        if ($this->isAttributeChanged('password')) {
            $this->password = Yii::$app->security->generatePasswordHash($this->password);
        }
        return $return;
    }

    /**
     * TODO: Use password hashing before checking
     */
    public function validatePassword($password)
    {
        if ($password == $this->password) {
            return true;
        }
        return false;
    }
}
