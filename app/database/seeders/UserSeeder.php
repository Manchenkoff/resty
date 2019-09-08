<?php
/**
 * Created by Artyom Manchenkov
 * artyom@manchenkoff.me
 * manchenkoff.me © 2019
 */

namespace app\database\seeders;

use app\models\User;
use Exception;
use manchenkov\yii\console\Command;
use yii\base\Action;

/**
 * Class UserSeeder
 * @package App\Database\Seeders
 *
 * @property-read Command $controller
 */
class UserSeeder extends Action
{
    /**
     * Creates default users
     */
    public function run()
    {
        $users = [
            [
                'email' => 'admin@example.com',
                'first_name' => 'super',
                'last_name' => 'user',
                'is_active' => true,
            ],
            [
                'email' => 'manager@example.com',
                'first_name' => 'manager',
                'last_name' => 'user',
                'is_active' => true,
            ],
            [
                'email' => 'user@example.com',
                'first_name' => 'simple',
                'last_name' => 'user',
                'is_active' => true,
            ],
        ];

        try {
            foreach ($users as $userData) {
                $user = new User($userData);

                $user->generateToken();
                $user->password = '123123123#';

                if ($user->save()) {
                    $this->controller->info("User: {$user->email} was created");
                } else {
                    $this->controller->error("An error occurred while creating a user");
                }
            }
        } catch (Exception $exception) {
            $this->controller->error($exception->getMessage());
        }
    }
}