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

class FeiShuTarget extends Target
{
    /**
     * @var string
     */
    public $gateway = 'https://open.feishu.cn/open-apis/bot/v2/hook/%s';

    /**
     * @var string
     */
    public $secret;

    /**
     * @var string
     */
    public $keyword;

    /**
     * @var string
     */
    public $format = 'text';

    /**
     * @var string
     */
    public $fullUrl;

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

        $content = implode("\n", array_map([$this, 'formatMessage'], $this->messages));

        $client = new Client();
        $client->createRequest()
            ->setMethod('POST')
            ->setUrl($this->fullUrl)
            ->setFormat(Client::FORMAT_JSON)
            ->setData([
                'msg_type' => $this->format,
                'content' => [
                    'text' => sprintf("%s:\n %s", $this->keyword, $content),
                ],
            ])
            ->send();
    }
}
