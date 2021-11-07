<?php

/**
 * This file is part of the guanguans/yii-log-target.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\YiiLogTarget;

use Guanguans\YiiLogTarget\Traits\ExceptionContext;
use Throwable;
use Yii;
use yii\helpers\VarDumper;

abstract class Target extends \yii\log\Target
{
    use ExceptionContext;

    protected const MARKDOWN_TEMPLATE = <<<'md'
```plain text
%s
```
md;

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
    public $envs = ['*'];

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
        $context = implode(PHP_EOL, array_map([$this, 'formatMessage'], $this->messages));
        if (isset($this->messages[0][0]) && $this->messages[0][0] instanceof Throwable) {
            $context .= PHP_EOL.PHP_EOL.$this->getContextAsString($this->messages[0][0]);
        }

        return $context;
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
        return ! $this->shouldntExecute();
    }

    protected function shouldntExecute(): bool
    {
        if (! in_array(YII_ENV, $this->envs) && ! in_array('*', $this->envs)) {
            return true;
        }

        if (! isset($this->messages[0][0])) {
            return true;
        }

        foreach ($this->excludeExceptions as $exceptionClass) {
            if ($this->messages[0][0] instanceof $exceptionClass) {
                return true;
            }
        }

        return false;
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
            if ($this->shouldntExecute()) {
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
