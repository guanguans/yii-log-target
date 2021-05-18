<?php

/**
 * This file is part of the guanguans/yii-log-target.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\YiiLogTarget;

use Guanguans\Notify\Clients\ServerChanClient;
use Guanguans\Notify\Messages\ServerChanMessage;
use Yii;

class ServerChanTarget extends Target
{
    /**
     * {@inheritDoc}
     */
    public function export()
    {
        $this->monitor(function () {
            $this->message = Yii::createObject(ServerChanMessage::class, [$this->getShortLogContext(), $this->getLogContext()]);

            $this->client = Yii::createObject(ServerChanClient::class);
            $this->client->setToken($this->token);
            $this->client->setMessage($this->message);

            return $this->client->send();
        });
    }
}
