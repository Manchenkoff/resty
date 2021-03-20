<?php

declare(strict_types=1);

namespace app\models;

use manchenkov\yii\database\ActiveRecord;
use manchenkov\yii\database\traits\SoftDelete;
use yii\base\Exception;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\web\IdentityInterface;

/**
 * @property int $id [int(11)]
 * @property string $email [varchar(255)]
 * @property string $password_hash [varchar(255)]
 * @property string $token [varchar(32)]
 * @property bool $is_active [bool]
 * @property string $first_name [varchar(255)]
 * @property string $last_name [varchar(255)]
 * @property int $created_at [int(11)]
 * @property int $updated_at [int(11)]
 * @property int $deleted_at [int(11)]
 * @property string $data [json]
 *
 * @property string $password
 * @property string $authKey
 */
class User extends ActiveRecord implements IdentityInterface
{
    use SoftDelete;

    /**
     * @inheritdoc
     */
    public static function tableName(): string
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return self::findOne($id);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return self::findOne(['token' => $token]);
    }

    /**
     * Finds a user by 'email' value
     *
     * @param string $email
     *
     * @return User|null
     */
    public static function findIdentityByEmail(string $email): ?User
    {
        return self::findOne(['email' => $email]);
    }

    /**
     * Model behaviors array
     * @return array
     */
    public function behaviors(): array
    {
        return [
            TimestampBehavior::class,
        ];
    }

    /**
     * Model basic validation rules
     * @return array
     */
    public function rules(): array
    {
        return [
            [['email', 'password', 'first_name', 'last_name'], 'required'],
            [['password', 'token', 'first_name', 'last_name'], 'string'],
            ['email', 'email'],
            ['is_active', 'boolean'],
            [['created_at', 'updated_at', 'deleted_at'], 'integer'],
            ['data', 'safe'] // json field
        ];
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
    public function getAuthKey(): string
    {
        return $this->token;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey): bool
    {
        return $this->token === $authKey;
    }

    /**
     * Returns original password value
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password_hash;
    }

    /**
     * Sets new value with encoding
     *
     * @param string $value
     *
     * @throws Exception
     */
    public function setPassword(string $value): void
    {
        if (!empty($value)) {
            $this->password_hash = app()->security->generatePasswordHash($value);
        }
    }

    /**
     * Validates user password with a given value
     *
     * @param string $password
     *
     * @return bool
     */
    public function validatePassword(string $password): bool
    {
        return app()->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Updates user password
     *
     * @param string $newPassword
     *
     * @return bool
     * @throws Exception
     */
    public function updatePassword(string $newPassword): bool
    {
        $this->password = $newPassword;
        $this->generateToken();

        return $this->save();
    }

    /**
     * Generates a new token for current user
     * @throws Exception
     */
    public function generateToken(): void
    {
        $this->token = app()->security->generateRandomString();
    }

    /**
     * Activates user account
     * @return bool
     * @throws Exception
     */
    public function activate(): bool
    {
        $this->is_active = true;
        $this->generateToken();

        return $this->save();
    }

    /**
     * Returns User posts
     * @return ActiveQuery
     */
    public function getPosts(): ActiveQuery
    {
        return $this->hasMany(Post::class, ['author_id' => 'id']);
    }
}
