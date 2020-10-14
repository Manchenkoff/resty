<?php

declare(strict_types=1);

use _generated\ApiTesterActions;
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
    use ApiTesterActions;

    /**
     * Checks is response status OK
     */
    public function seeResponseSuccessful()
    {
        $this->seeResponseIsJson();
        $this->assertTrue($this->grabResponseStatus());
    }

    /**
     * Returns response status
     * @return bool
     */
    public function grabResponseStatus(): bool
    {
        $response = $this->grabResponseAsArray();

        return $response['success'];
    }

    /**
     * Returns response as array
     * @return array
     */
    public function grabResponseAsArray(): array
    {
        return json_decode($this->grabResponse(), true);
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
     * Returns response errors as array
     * @return array
     */
    public function grabResponseErrors(): array
    {
        $errors = [];

        foreach ($this->grabResponseData() as $error) {
            $key = $error['field'];
            $message = $error['message'];

            $errors[$key] = $message;
        }

        return $errors;
    }

    /**
     * Returns response data as array
     * @return array
     */
    public function grabResponseData(): array
    {
        $response = $this->grabResponseAsArray();

        return $response['data'];
    }
}
