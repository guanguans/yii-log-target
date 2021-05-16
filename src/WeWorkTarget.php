<?php

/**
 * This file is part of the guanguans/yii-log-target.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\YiiLogTarget;

use Guanguans\Notify\Clients\WeWorkClient;
use Guanguans\Notify\Messages\WeWork\TextMessage;
use Yii;

class WeWorkTarget extends Target
{
    /**
     * @var WeWorkClient
     */
    protected $client;

    /**
     * @var TextMessage
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
        $this->message->setOption('content', $this->getLogContext());

        $this->client = Yii::createObject(WeWorkClient::class);
        $this->client->setToken($this->token);
        $this->client->setMessage($this->message);
    }
}
