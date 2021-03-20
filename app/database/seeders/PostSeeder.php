<?php

declare(strict_types=1);

namespace app\database\seeders;

use app\models\Post;
use Exception;
use manchenkov\yii\console\Command;
use yii\base\Action;

/**
 * Class PostSeeder
 * @package App\Database\Seeders
 *
 * @property-read Command $controller
 */
final class PostSeeder extends Action
{
    /**
     * Creates default posts
     */
    public function run(): void
    {
        $posts = [
            new Post(
                [
                    'title' => 'First post',
                    'body' => 'First post content sample',
                    'user_id' => 2 // manager
                ]
            ),

            new Post(
                [
                    'title' => 'Second post',
                    'body' => 'Second post content sample',
                    'user_id' => 3 // user
                ]
            ),
        ];

        try {
            foreach ($posts as $post) {
                if ($post->save()) {
                    $this->controller->info("Post #{$post->id} was created");
                } else {
                    $this->controller->error("An error occurred while creating a post");
                }
            }
        } catch (Exception $exception) {
            $this->controller->error($exception->getMessage());
        }
    }
}
