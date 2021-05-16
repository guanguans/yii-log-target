<?php

/**
 * This file is part of the guanguans/yii-log-target.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\YiiLogTarget;

use Guanguans\Notify\Clients\BarkClient;
use Guanguans\Notify\Clients\ChanifyClient;
use Guanguans\Notify\Messages\Chanify\TextMessage;
use Yii;

class ChanifyTarget extends Target
{
    /**
     * @var BarkClient
     */
    protected $client;

    /**
     * @var \Guanguans\Notify\Messages\Chanify\TextMessage
     */
    protected $message;

    /**
     * {@inheritDoc}
     */
    public function init()
    {
        parent::init();

        $this->message = Yii::createObject(TextMessage::class);
        $this->message->setOptions($this->messageOptions);
        $this->message->setOption('title', $this->getShortLogContext());
        $this->message->setOption('text', $this->getLogContext());

        $this->client = Yii::createObject(ChanifyClient::class);
        $this->client->setToken($this->token);
        $this->baseUri && $this->client->setBaseUri($this->baseUri);
        $this->client->setMessage($this->message);
    }
}
