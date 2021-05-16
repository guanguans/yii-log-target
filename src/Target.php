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
use yii\helpers\VarDumper;

class Target extends \yii\log\Target
{
    /**
     * @var bool
     */
    public $debug = false;

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
        return isset($this->messages[0]) ? $this->formatMessage($this->messages[0]) : '';
    }

    protected function getLogContext(): string
    {
        return implode("\n", array_map([$this, 'formatMessage'], $this->messages));
    }

    /**
     * {@inheritDoc}
     */
    public function export()
    {
        try {
            $ret = $this->client->send();

            $this->debug && VarDumper::dump($this->client->getRequestUrl().PHP_EOL);
            $this->debug && VarDumper::dump($this->client->getRequestParams());
            $this->debug && VarDumper::dump($ret);
        } catch (Throwable $e) {
            $this->debug && VarDumper::dump($e->getFile().PHP_EOL);
            $this->debug && VarDumper::dump($e->getLine().PHP_EOL);
            $this->debug && VarDumper::dump($e->getMessage().PHP_EOL);
        }
    }
}
