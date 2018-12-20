<?php
/**
 * Created by Artem Manchenkov
 * artyom@manchenkoff.me
 * manchenkoff.me © 2018
 */

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "{{%user}}".
 *
 * @property int $id
 * @property string $username
 * @property string $name
 * @property string $auth_key
 * @property string $access_token
 * @property string $password
 * @property string $password_reset_token
 * @property string $email
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 */
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_INACTIVE = 10;
    const STATUS_ACTIVE = 20;

    const SCENARIO_REGISTER = 'register';
    const SCENARIO_CREATE = 'create';
    const SCENARIO_LOGIN = 'login';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['auth_key' => $token]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne([
            'id' => $id,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Find user by username
     *
     * @param $username
     *
     * @return null|static
     */
    public static function findByUsername($username)
    {
        return static::findOne([
            'username' => $username,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'password', 'email', 'created_at', 'updated_at'], 'required'],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['username', 'name', 'email'], 'string', 'max' => 255],
            [['email'], 'unique'],
            [['username'], 'unique'],
            ['status', 'default', 'value' => self::STATUS_INACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        $scenarios = parent::scenarios();

        $scenarios[self::SCENARIO_REGISTER] = ['username', 'password', 'email', 'name'];
        $scenarios[self::SCENARIO_CREATE] = ['username', 'password', 'email'];
        $scenarios[self::SCENARIO_LOGIN] = ['username', 'password'];

        return $scenarios;
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
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * Generates auth key and token
     *
     * @throws \yii\base\Exception
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Activates user status
     */
    public function activate()
    {
        $this->status = self::STATUS_ACTIVE;
    }

    /**
     * Get all posts of current user
     * @return \yii\db\ActiveQuery
     */
    public function getPosts()
    {
        return $this->hasMany(Post::class, ['id' => 'author_id']);
    }

    /**
     * Custom API response fields
     */
    public function fields()
    {
        $fields = parent::fields();

        $unset_fields = [
            'created_at',
            'updated_at',
            'password',
            'auth_key',
            'access_token',
        ];

        foreach ($unset_fields as $f) {
            unset($fields[$f]);
        }

        return $fields;
    }

    /**
     * Extra fields by request
     * @return array
     */
    public function extraFields()
    {
        return [
            'access_token',
            'password',
        ];
    }
}

