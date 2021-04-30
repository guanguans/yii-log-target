<?php

/**
 * This file is part of the guanguans/yii-log-target.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\YiiLogTarget;

use yii\httpclient\Client;
use yii\log\Target;

class ChanifyTarget extends Target
{
    /**
     * @var string
     */
    public $gateway = 'https://api.chanify.net/v1/sender/';

    /**
     * @var string
     */
    public $token;

    /**
     * {@inheritDoc}
     */
    public function init()
    {
        parent::init();
    }

    /**
     * {@inheritDoc}
     */
    public function export()
    {
        array_pop($this->messages);
        $text = implode("\n", array_map([$this, 'formatMessage'], $this->messages))."\n";

        $client = new Client(['baseUrl' => $this->gateway]);
        $client->createRequest()
            ->setMethod('POST')
            ->setUrl($this->token)
            ->setData([
                'text' => $text,
            ])
            ->send();
    }
}
