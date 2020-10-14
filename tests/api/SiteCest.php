<?php

declare(strict_types=1);

namespace tests\api;

use ApiTester;

class SiteCest
{
    public function homePageTest(ApiTester $I)
    {
        $I->sendGET('/');

        $I->seeResponseIsJson();

        $I->seeResponseContains('Resty is working!');
    }
}
