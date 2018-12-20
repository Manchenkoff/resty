<?php
/**
 * Created by Artem Manchenkov
 * artyom@manchenkoff.me
 * manchenkoff.me © 2018
 */

namespace app\models;

use yii\db\ActiveRecord;
use yii\helpers\Url;
use yii\web\Link;
use yii\web\Linkable;

/**
 * Class Post
 *
 * @property int $id
 * @property string $title
 * @property string $body
 * @property int $author_id
 *
 * @package app\models
 */
class Post extends ActiveRecord implements Linkable
{
    /**
     * Model database table name
     * @return string
     */
    public static function tableName()
    {
        return '{{%post}}';
    }

    /**
     * Model object attributes (json)
     * @return array
     */
    public function fields()
    {
        return [
            'id',
            'title',
            'body',
            //'author',
            'author' => function () {
                return $this->author->username;
            },
            // user fields
            'title_big' => function ($item) {
                return strtoupper($item->title);
            },
        ];
    }

    /**
     * API object links
     * @return array
     */
    public function getLinks()
    {
        return [
            Link::REL_SELF => Url::to(['post/view', 'id' => $this->id], true),
        ];
    }

    public function getAuthor()
    {
        return $this->hasOne(User::class, ['id' => 'author_id']);
    }
}