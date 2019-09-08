<?php 

class SiteCest
{
    public function homePageTest(ApiTester $I)
    {
        $I->sendGET('/');

        $I->seeResponseIsJson();

        $I->seeResponseContains('Resty is working!');
    }
}
