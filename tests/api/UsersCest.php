<?php

declare(strict_types=1);

namespace tests\api;

use ApiTester;
use app\models\User;

class UsersCest
{
    public function deleteUserAsUser(ApiTester $I)
    {
        $tempUser = new User(
            [
                'email' => 'user1@example.com',
                'password' => '12345678',
                'first_name' => 'Simple',
                'last_name' => 'User',
            ]
        );

        $I->assertTrue($tempUser->save());

        $user = User::findIdentity(3);

        $I->sendDELETE("users/{$tempUser->id}?token={$user->token}");

        $I->seeResponseFailed();

        $I->assertEquals(
            '403',
            $I->grabResponseData()['status']
        );
    }

    public function deleteUserAsManager(ApiTester $I)
    {
        $tempUser = new User(
            [
                'email' => 'user2@example.com',
                'password' => '12345678',
                'first_name' => 'Simple',
                'last_name' => 'User',
            ]
        );

        $I->assertTrue($tempUser->save());

        $user = User::findIdentity(2);

        $I->sendDELETE("users/{$tempUser->id}?token={$user->token}");

        $I->seeResponseSuccessful();
    }

    public function updateUserData(ApiTester $I)
    {
        $user = User::findIdentity(1);

        $newLastName = "UPD_" . time();

        $I->sendPOST(
            "users/{$user->id}?token={$user->token}",
            [
                'last_name' => $newLastName,
            ]
        );

        $I->seeResponseSuccessful();

        $user->refresh();

        $I->assertEquals($newLastName, $user->last_name);
    }
}
