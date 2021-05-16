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
use Guanguans\Notify\Messages\BarkMessage;
use Yii;

class BarkTarget extends Target
{
    /**
     * @var BarkClient
     */
    protected $client;

    /**
     * @var BarkMessage
     */
    protected $message;

    /**
     * {@inheritDoc}
     */
    public function init()
    {
        parent::init();

        $this->message = Yii::createObject(BarkMessage::class, $this->messageOptions);
        $this->message->setText($this->getShortLogContext());

        $this->client = Yii::createObject(BarkClient::class, ['token' => $this->token]);
        $this->client->setMessage($this->message);
        $this->baseUri && $this->client->setBaseUri($this->baseUri);
    }
}
