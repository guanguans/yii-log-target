<?php

/**
 * This file is part of the guanguans/yii-log-target.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\YiiLogTarget;

use Guanguans\Notify\Clients\XiZhiClient;
use Guanguans\Notify\Messages\XiZhiMessage;
use Yii;

class XiZhiTarget extends Target
{
    /**
     * @var string
     */
    public $type = 'single';

    /**
     * {@inheritDoc}
     */
    public function init()
    {
        parent::init();

        $this->message = Yii::createObject(XiZhiMessage::class, [$this->getShortLogContext(), $this->getLogContext()]);
        $this->message->setOptions($this->messageOptions);

        $this->client = Yii::createObject(XiZhiClient::class);
        $this->client->setToken($this->token);
        $this->client->setType($this->type);
        $this->client->setMessage($this->message);
    }
}
