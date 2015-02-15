<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $confirmation_hash
 * @property integer $confirmation_timestamp
 * @property integer $created_at
 * @property integer $updated_at
 */
class User extends \app\components\ActiveRecord implements \yii\web\IdentityInterface
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
            [['name', 'email', 'password'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name:',
            'email' => 'Email:',
            'password' => 'Password:',
            'confirmation_hash' => 'Confirmation Hash:',
            'confirmation_timestamp' => 'Confirmation Timestamp:',
            'created_at' => 'Created At:',
            'updated_at' => 'Updated At:',
        ];
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    public static function findByUsername($username)
    {
        return static::findOne(['name' => $username]);
    }

    public static function findByEmail($email)
    {
        return static::findOne(['email' => $email]);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }

    /**
     * Get all items posted by active user
     * @return ActiveQuery
     */
    public function getItems()
    {
        return $this
            ->hasMany(Item::className(), ['user_id' => 'user_id'])
            ->where('category_id > 0')
            ->orderBy('created_at DESC');
    }

    /**
     * Check if a user has posted some items
     * @param int $uid User id
     * @return bool
     */
    public function hasItems($uid = 0)
    {
        return (new \yii\db\Query())
            ->select('*')
            ->from('item')
            ->where('user_id = :uid', [':uid' => $uid])
            ->andWhere('category_id > 0')
            ->exists();
    }

    public static function findUser($uid)
    {
        return self::find()->where('user_id = :uid', [':uid' => $uid])->one();
    }

    public static function confirmEmail($hash)
    {
        $user = User::find()->where('confirmation_hash = :hash', [':hash' => $hash])->one();
        if (!$user) {
            throw new Exception('Incorrect hash.');
        }
        // User is already activated
        if ($user->confirmation_timestamp) {
            return true;
        } else {
            $user->confirmation_hash        = '';
            $user->confirmation_timestamp   = time();
            return (bool)$user->update(false);
        }
    }
}
