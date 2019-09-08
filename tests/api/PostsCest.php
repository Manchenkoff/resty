<?php

use app\models\Post;
use app\models\User;

class PostsCest
{
    protected $postData = [
        'title' => 'Test post title',
        'body' => 'Some post content',
        'user_id' => 1,
    ];

    public function createNewPostAsAGuest(ApiTester $I)
    {
        $I->sendPOST('posts', $this->postData);

        $I->seeResponseFailed();

        $I->assertEquals(
            '401',
            $I->grabResponseData()['status']
        );
    }

    public function createNewPostAsAUser(ApiTester $I)
    {
        $user = User::findIdentity(3);

        $I->sendPOST("posts?token={$user->token}", $this->postData);

        $I->seeResponseFailed();

        $I->assertEquals(
            '403',
            $I->grabResponseData()['status']
        );
    }

    public function createNewPost(ApiTester $I)
    {
        $user = User::findIdentity(1);

        $I->sendPOST("posts?token={$user->token}", $this->postData);

        $I->seeResponseSuccessful();

        $I->assertEquals(
            'Test post title',
            $I->grabResponseData()['title']
        );
    }

    public function updatePostData(ApiTester $I)
    {
        $user = User::findIdentity(1);
        $post = Post::find()->orderBy('id desc')->one();

        $newPostTitle = 'UPD_' . time();

        $I->sendPOST("posts/{$post->id}?token={$user->token}", [
            'title' => $newPostTitle,
        ]);

        $I->seeResponseSuccessful();

        $I->assertEquals(
            $newPostTitle,
            $I->grabResponseData()['title']
        );
    }

    public function deletePost(ApiTester $I)
    {
        $user = User::findIdentity(1);
        $post = Post::find()->orderBy('id desc')->one();

        $I->sendDELETE("posts/{$post->id}?token={$user->token}");

        $I->seeResponseSuccessful();
    }

    public function deletePostAsAGuest(ApiTester $I)
    {
        $post = Post::find()->orderBy('id desc')->one();

        $I->sendDELETE("posts/{$post->id}");

        $I->seeResponseFailed();

        $I->assertEquals(
            '401',
            $I->grabResponseData()['status']
        );
    }

    public function deletePostAsAUsesr(ApiTester $I)
    {
        $user = User::findIdentity(3);
        $post = Post::find()->orderBy('id desc')->one();

        $I->sendDELETE("posts/{$post->id}?token={$user->token}");

        $I->seeResponseFailed();

        $I->assertEquals(
            '403',
            $I->grabResponseData()['status']
        );
    }
}
