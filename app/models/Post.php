<?php

declare(strict_types=1);

namespace app\models;

use manchenkov\yii\database\ActiveRecord;
use manchenkov\yii\database\traits\SafeModel;
use yii\db\ActiveQuery;
use yii\web\Linkable;

/**
 * Class Post
 *
 * @property int $id
 * @property string $title
 * @property string $body
 * @property int $user_id
 *
 * @package app\models
 */
class Post extends ActiveRecord implements Linkable
{
    use SafeModel;

    public static function tableName(): string
    {
        return 'post';
    }

    public function rules(): array
    {
        return [
            [['user_id'], 'integer'],
            ['user_id', 'exist', 'targetRelation' => 'author'],
            [['title', 'body'], 'string'],
        ];
    }

    /**
     * @inheritDoc
     */
    public function getLinks(): array
    {
        return [
            'self' => url(['post/view', 'id' => $this->id]),
            'author' => url(['user/view', 'id' => $this->id]),
        ];
    }

    /**
     * Returns User instance
     * @return ActiveQuery
     */
    public function getAuthor(): ActiveQuery
    {
        return $this->belongsTo(User::class);
    }
}