<?php
/**
 * Created by Artyom Manchenkov
 * Copyright © 2015-2018 [DeepSide Interactive]
 */

namespace resty\models;

use yii\db\ActiveRecord;
use yii\helpers\Url;
use yii\web\Link;
use yii\web\Linkable;

class Post extends ActiveRecord implements Linkable {

    /**
     * Model database table name
     * @return string
     */
    public static function tableName() {
        return '{{%post}}';
    }

    /**
     * Model object attributes (json)
     * @return array
     */
    public function fields() {
        return [
            'id',
            'title',
            'body',

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
    public function getLinks() {
        return [
            Link::REL_SELF => Url::to(['post/view', 'id' => $this->id], true),
        ];
    }
}