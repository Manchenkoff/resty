<?php
/**
 * Created by Artem Manchenkov
 * artyom@manchenkoff.me
 * manchenkoff.me © 2019
 */

use app\core\interfaces\Mailer;
use app\core\services\MailService;

return [
    /**
     * DI Container definitions
     */
    'definitions' => [
        //'SomeClassInterface::class' => 'SomeClassImplementation::class',

        Mailer::class => MailService::class,
    ],
];