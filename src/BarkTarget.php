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

class BarkTarget extends Target
{
    /**
     * @var string
     */
    public $gateway = 'https://api.day.app/%s/%s/%s';

    /**
     * @var string
     */
    public $secret;

    /**
     * @var string
     */
    public $sound;

    /**
     * @var int
     */
    public $isArchive = 1;

    /**
     * @var int
     */
    public $isAutomaticallyCopy = 0;

    /**
     * @var int
     */
    public $isEnableCopy = 0;

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
    }

    /**
     * {@inheritDoc}
     */
    public function export()
    {
        $title = $this->messages[0][0];
        // $content = implode("\n", array_map([$this, 'formatMessage'], $this->messages))."\n";
        $fullUrl = sprintf($this->gateway, $this->secret, $title, $title);
        $data = [
            'isArchive' => $this->isArchive,
            'automaticallyCopy' => $this->isAutomaticallyCopy,
        ];
        $this->isEnableCopy && $data['copy'] = $title;
        $this->sound && $data['sound'] = $this->sound;

        $client = new Client();
        $client->createRequest()
            ->setMethod('GET')
            ->setUrl($fullUrl)
            ->setData($data)
            ->send();
    }
}
