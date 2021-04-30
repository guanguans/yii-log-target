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

class XiZhiTarget extends Target
{
    /**
     * @var string
     */
    public $gateway = 'https://xizhi.qqoq.net/%s.send';

    /**
     * @var string
     */
    public $secret;

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
        $this->fullUrl = sprintf($this->gateway, $this->secret);
    }

    /**
     * {@inheritDoc}
     */
    public function export()
    {
        $title = $this->messages[0][0];

        $content = implode("\n", array_map([$this, 'formatMessage'], $this->messages))."\n";

        $client = new Client();
        $client->createRequest()
            ->setMethod('POST')
            ->setUrl($this->fullUrl)
            ->setData([
                'title' => $title,
                'content' => sprintf($this->content, $content),
            ])
            ->send();
    }
}
