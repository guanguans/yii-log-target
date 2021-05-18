<?php

/**
 * This file is part of the guanguans/yii-log-target.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\YiiLogTarget;

use Guanguans\Notify\Clients\FeiShuClient;
use Guanguans\Notify\Messages\FeiShu\TextMessage;
use Yii;

class FeiShuTarget extends Target
{
    /**
     * @var string
     */
    public $secret;

    /**
     * @var string
     */
    public $keyword;

    /**
     * {@inheritDoc}
     */
    public function export()
    {
        $this->monitor(function () {
            $this->message = Yii::createObject(TextMessage::class);
            $this->message->setOptions($this->messageOptions);
            $this->message->setOption('text', sprintf("%s\n%s", $this->keyword, $this->getLogContext()));

            $this->client = Yii::createObject(FeiShuClient::class);
            $this->secret && $this->client->setSecret($this->secret);
            $this->client->setToken($this->token);
            $this->client->setMessage($this->message);

            return $this->client->send();
        });
    }
}
