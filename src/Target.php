<?php

/**
 * This file is part of the guanguans/yii-log-target.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\YiiLogTarget;

class Target extends \yii\log\Target
{
    /**
     * @var string
     */
    public $token;

    /**
     * @var string
     */
    public $secret;

    /**
     * @var string
     */
    public $baseUri;

    /**
     * @var \Guanguans\Notify\Clients\Client
     */
    protected $client;

    /**
     * @var \Guanguans\Notify\Messages\Message
     */
    protected $message;

    /**
     * @var array
     */
    public $messageOptions = [];

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
        $this->client->send();
    }
}
