<?php
/**
 * Created by Artem Manchenkov
 * artyom@manchenkoff.me
 * manchenkoff.me © 2018
 */

use yii\helpers\StringHelper;
use yii\helpers\Url;

/**
 * Prints clear string into the console with new line char at the end
 *
 * @param string $message
 */
function alert(string $message)
{
    echo $message . PHP_EOL;
}

/**
 * Generates URL by Yii component
 *
 * @param string|array $url
 * @param bool $absolute
 *
 * @return string
 */
function url($url = '', bool $absolute = false)
{
    return Url::to($url, $absolute);
}

/**
 * Dump and die (Laravel alternative)
 *
 * @param $value
 */
function dd($value)
{
    var_dump($value);
    die();
}

/**
 * Proxy for app user object
 * @return mixed|\yii\web\User
 */
function user()
{
    return Yii::$app->user;
}

/**
 * Simple debug call
 *
 * @param string|array $message
 * @param string $category
 */
function debug($message, $category = 'application')
{
    Yii::debug($message, $category);
}

/**
 * Truncates string by $length
 *
 * @param string $string
 * @param int $length
 *
 * @return string
 */
function truncate(string $string, int $length)
{
    return StringHelper::truncate(
        $string,
        $length
    );
}

/**
 * Returns app config value by $key of false
 *
 * @param string $key
 *
 * @return bool|mixed
 */
function config(string $key)
{
    return (isset(Yii::$app->params[$key])) ? Yii::$app->params[$key] : false;
}

/**
 * Proxy for app request object
 * @return \yii\console\Request|\yii\web\Request
 */
function request()
{
    return Yii::$app->request;
}

/**
 * Proxy for Yii::getAlias()
 *
 * @param string $alias
 *
 * @return bool|string
 */
function alias(string $alias)
{
    return Yii::getAlias($alias);
}

/**
 * Sets or returns value from cache
 *
 * @param string $key
 * @param null $value
 *
 * @return bool|mixed
 */
function cache(string $key, $value = null)
{
    if (!is_null($value)) {
        return Yii::$app->cache->set($key, $value);
    }

    return Yii::$app->cache->get($key);
}