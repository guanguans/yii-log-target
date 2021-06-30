<?php

/**
 * This file is part of the guanguans/yii-log-target.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\YiiLogTarget;

use Throwable;
use Yii;
use yii\helpers\VarDumper;

abstract class Target extends \yii\log\Target
{
    /**
     * @var bool
     */
    public $debug = false;

    /**
     * @var string
     */
    public $debugLogFile = '@runtime/logs/debug-exception-target.log';

    /**
     * @var string[]
     */
    public $excludeExceptions = [];

    /**
     * @var string[]
     */
    public $envs = ['prod'];

    /**
     * @var string
     */
    public $token;

    /**
     * @var array
     */
    public $messageOptions = [];

    /**
     * @var \Guanguans\Notify\Clients\Client
     */
    protected $client;

    /**
     * @var \Guanguans\Notify\Messages\Message
     */
    protected $message;

    protected function getShortLogContext(): string
    {
        return $this->formatMessage($this->messages[0]);
    }

    protected function getLogContext(): string
    {
        return implode(PHP_EOL, array_map([$this, 'formatMessage'], $this->messages));
    }

    /**
     * @param string|null $logFile
     */
    public function normalizeLogFile($logFile): string
    {
        if (null === $logFile) {
            return Yii::$app->getRuntimePath().'/logs/debug-exception-target.log';
        }

        return Yii::getAlias($logFile);
    }

    protected function shouldExecute(): bool
    {
        if (! in_array(YII_ENV, $this->envs)) {
            return false;
        }

        if (isset($this->messages[0][0]) && is_object($this->messages[0][0])) {
            foreach ($this->excludeExceptions as $exceptionClass) {
                if ($this->messages[0][0] instanceof $exceptionClass) {
                    return false;
                }
            }
        }

        return true;
    }

    /**
     * @param mixed $data
     *
     * @return false|int
     */
    protected function writeLog($data)
    {
        return file_put_contents($this->normalizeLogFile($this->debugLogFile), VarDumper::dumpAsString($data).PHP_EOL, FILE_APPEND);
    }

    /**
     * @param mixed ...$parameter
     *
     * @return mixed|void
     */
    protected function monitor(callable $callback, ...$parameter)
    {
        try {
            if (! $this->shouldExecute()) {
                return;
            }

            $ret = call_user_func($callback, ...$parameter);

            if ($this->debug) {
                $this->writeLog($this->client->getRequestUrl());
                $this->writeLog($this->client->getRequestParams());
                $this->writeLog($ret);
            }

            return $ret;
        } catch (Throwable $e) {
            $this->debug && $this->writeLog($e);
        }
    }
}
