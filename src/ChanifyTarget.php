<?php

/**
 * This file is part of the guanguans/yii-log-target.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\YiiLogTarget;

use Guanguans\Notify\Clients\ChanifyClient;
use Guanguans\Notify\Messages\Chanify\TextMessage;
use Yii;

class ChanifyTarget extends Target
{
    /**
     * @var string
     */
    public $baseUri;

    /**
     * {@inheritDoc}
     */
    public function export()
    {
        $this->monitor(function () {
            $this->message = Yii::createObject(TextMessage::class);
            $this->message->setOptions($this->messageOptions);
            // $this->message->setOption('title', $this->getShortLogContext());
            $this->message->setOption('text', $this->getShortLogContext());

            $this->client = Yii::createObject(ChanifyClient::class);
            $this->baseUri && $this->client->setBaseUri($this->baseUri);
            $this->client->setToken($this->token);
            $this->client->setMessage($this->message);

            return $this->client->send();
        });
    }
}
