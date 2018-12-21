<?php
/**
 * Created by Artem Manchenkov
 * artyom@manchenkoff.me
 * manchenkoff.me © 2018
 */

namespace app\common\traits;

use Yii;
use yii\base\InlineAction;
use yii\base\InvalidConfigException;
use yii\base\Module;
use yii\web\BadRequestHttpException;

/**
 * Trait that implements dependency injection for controller actions.
 * It should be bound only to subclasses of controller.
 */
trait ActionDependencyInjection
{
    /**
     * Bind DI dependencies to the Controller action
     *
     * @param $action
     * @param $params
     *
     * @return array
     * @throws BadRequestHttpException
     * @throws InvalidConfigException
     * @throws \ReflectionException
     */
    public function bindActionParams($action, $params)
    {
        $callable = ($action instanceof InlineAction)
            ? [$this, $action->actionMethod]
            : [$action, 'run'];

        $actionParams = [];

        try {
            $args = \Yii::$container->resolveCallableDependencies($callable, $params);
        } catch (InvalidConfigException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        foreach ((new \ReflectionMethod($callable[0], $callable[1]))->getParameters() as $i => $param) {
            $actionParams[$param->getName()] = $args[$i];
        }

        if (property_exists($this, 'actionParams')) {
            $this->actionParams = $actionParams;
        }

        // NOTE: Don't put injected  params in requestedParams, this breaks the debugger.
        foreach ($actionParams as $key => $value) {
            if (is_object($value)) {
                /** @var Module $module */
                $module = $this->module;

                if ($module->has($key, true) && $value === $module->get($key)) {
                    $value = "Component: $key";
                } else {
                    $value = "DI: " . get_class($value);
                }
            }

            Yii::$app->requestedParams[$key] = $value;
        }

        return $args;
    }
}