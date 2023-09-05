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

class XiZhiTarget extends Target
{
    /**
     * @var string
     */
    public $type = 'single';

    public function export()
    {
        $this->monitor(function () {
            $this->message = \Yii::createObject(XiZhiMessage::class, [$this->getShortLogContext(), sprintf(self::MARKDOWN_TEMPLATE, $this->getLogContext())]);
            $this->message->setOptions($this->messageOptions);

            $this->client = \Yii::createObject(XiZhiClient::class);
            $this->client->setToken($this->token);
            $this->client->setType($this->type);
            $this->client->setMessage($this->message);

            return $this->client->send();
        });
    }
}
