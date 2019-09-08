<?php

use app\models\User;

class AuthCest
{
    public function _before()
    {
        User::deleteAll([
            'email' => 'user@example.com',
        ]);
    }

    public function signUpUser(ApiTester $I)
    {
        // prepare user data
        $userData = [
            'email' => 'user@example.com',
            'password' => '12345678',
            'first_name' => 'Simple',
            'last_name' => 'User',
        ];

        $I->sendPOST('users', $userData);

        $I->seeResponseSuccessful();

        $response = $I->grabResponseData();

        $I->assertArrayHasKey('id', $response);
        $I->assertEquals($userData['email'], $response['email']);
    }

    public function signUpInvalidUser(ApiTester $I)
    {
        // prepare user data
        $userData = [
            'email' => 'user@example.com',
            'password' => '',
            'first_name' => 'Simple',
            'last_name' => 'User',
        ];

        $I->sendPOST('users', $userData);

        $I->seeResponseFailed();

        $I->assertArrayHasKey('password', $I->grabResponseErrors());
    }

    public function loginAsUser(ApiTester $I)
    {
        $id = 1;
        $token = User::findIdentity($id)->token;

        $I->sendGET("users/{$id}", ['token' => $token]);

        $I->seeResponseSuccessful();

        $user = $I->grabResponseData();

        $I->assertEquals('1', $user['id']);
    }
}
