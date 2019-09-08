<?php

use Codeception\Actor;

/**
 * Inherited Methods
 * @method void wantToTest($text)
 * @method void wantTo($text)
 * @method void execute($callable)
 * @method void expectTo($prediction)
 * @method void expect($prediction)
 * @method void amGoingTo($argumentation)
 * @method void am($role)
 * @method void lookForwardTo($achieveValue)
 * @method void comment($description)
 * @method void pause()
 *
 * @SuppressWarnings(PHPMD)
 */
class ApiTester extends Actor
{
    use _generated\ApiTesterActions;

    /**
     * Returns response as array
     * @return array
     */
    public function grabResponseAsArray()
    {
        return json_decode($this->grabResponse(), true);
    }

    /**
     * Returns response status
     * @return array
     */
    public function grabResponseStatus()
    {
        $response = $this->grabResponseAsArray();

        return $response['success'];
    }

    /**
     * Checks is response status OK
     */
    public function seeResponseSuccessful()
    {
        $this->seeResponseIsJson();
        $this->assertTrue($this->grabResponseStatus());
    }

    /**
     * Checks is response status failed
     */
    public function seeResponseFailed()
    {
        $this->seeResponseIsJson();
        $this->assertFalse($this->grabResponseStatus());
    }

    /**
     * Returns response data as array
     * @return array
     */
    public function grabResponseData()
    {
        $response = $this->grabResponseAsArray();

        return $response['data'];
    }

    /**
     * Returns response errors as array
     * @return array
     */
    public function grabResponseErrors()
    {
        $errors = [];

        foreach ($this->grabResponseData() as $error) {
            $key = $error['field'];
            $message = $error['message'];

            $errors[$key] = $message;
        }

        return $errors;
    }
}
