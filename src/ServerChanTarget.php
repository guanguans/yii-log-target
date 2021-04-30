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

class ServerChanTarget extends Target
{
    /**
     * @var string
     */
    public $gateway = 'https://sc.ftqq.com/%s.send';

    /**
     * @var string
     */
    public $token;

    /**
     * @var string
     */
    public $fullUrl;

    /**
     * @var string
     */
    public $content = <<<"content"
``` shell
%s
```
content;

    /**
     * {@inheritDoc}
     */
    public function init()
    {
        parent::init();
        $this->fullUrl = sprintf($this->gateway, $this->token);
    }

    /**
     * {@inheritDoc}
     */
    public function export()
    {
        $title = $this->messages[0][0];

        $description = implode("\n", array_map([$this, 'formatMessage'], $this->messages))."\n";

        $client = new Client();
        $client->createRequest()
            ->setMethod('POST')
            ->setUrl($this->fullUrl)
            ->setData([
                'text' => $title,
                'desp' => sprintf($this->content, $description),
            ])
            ->send();
    }
}
