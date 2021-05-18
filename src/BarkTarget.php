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
     * @var string
     */
    public $baseUri;

    /**
     * {@inheritDoc}
     */
    public function export()
    {
        $this->monitor(function () {
            $this->message = Yii::createObject(BarkMessage::class);
            $this->message->setOptions($this->messageOptions);
            $this->message->setOption('text', $this->getShortLogContext());

            $this->client = Yii::createObject(BarkClient::class);
            $this->baseUri && $this->client->setBaseUri($this->baseUri);
            $this->client->setToken($this->token);
            $this->client->setMessage($this->message);

            return $this->client->send();
        });
    }
}
