<?php

/**
 * This file is part of the guanguans/yii-log-target.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

$config = [
    'id' => 'yii2-log-target-app',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'components' => [
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],

                // Bark
                [
                    'class' => \Guanguans\YiiLogTarget\BarkTarget::class,
                    'levels' => ['error'],
                    // 'debug' => true,
                    'token' => 'PXb8KDj9dHStfQ5cGJ5',
                ],

                // Chanify
                [
                    'class' => \Guanguans\YiiLogTarget\ChanifyTarget::class,
                    'levels' => ['error'],
                    // 'debug' => true,
                    'token' => 'P3IgGEiJBQVdIWlVKS1JORVY0UlVETFZYVVpRTlNLTlVZVlZPT1JFGhR7vAyf8Uj5UQhhK4n6QfVzih96QyIECAEQAQ.G4z2i0VZP7lOiCKYif4LOXu3cBdizl-PLWYn_7zrGXQ',
                ],

                // 钉钉群机器人
                [
                    'class' => \Guanguans\YiiLogTarget\DingTalkTarget::class,
                    'levels' => ['error'],
                    // 'debug'   => true,
                    'keyword' => 'keyword',
                    'token' => 'fec1ddaa8a833156efb77b7865d62ae13775418030d94d05da08bfca73eeb',
                    // 'secret'  => 'SECc32bb7345c0f73da2b9786f0f7dd5083bd768a29b82e6d460149d730eee51730',
                ],

                // 飞书群机器人
                [
                    'class' => \Guanguans\YiiLogTarget\FeiShuTarget::class,
                    'levels' => ['error'],
                    // 'debug'   => true,
                    'keyword' => 'keyword',
                    'token' => 'b70d9-6e19-4f87-af48-348b0281866c',
                    // 'secret'  => 'iigDOvnsIn6aFS1pYHHEHh',
                ],

                // Server 酱
                [
                    'class' => \Guanguans\YiiLogTarget\ServerChanTarget::class,
                    'levels' => ['error'],
                    // 'debug'   => true,
                    'token' => '35149Thtf1g2Bc14QJuQ6HFpW5YGXm',
                ],

                // 企业微信群机器人
                [
                    'class' => \Guanguans\YiiLogTarget\WeWorkTarget::class,
                    'levels' => ['error'],
                    // 'debug'   => true,
                    'token' => '3d5a3-ceff-4da8-bcf3-ff5891778fb7',
                ],

                // 息知
                [
                    'class' => \Guanguans\YiiLogTarget\XiZhiTarget::class,
                    'levels' => ['error'],
                    // 'debug'   => true,
                    'token' => '60aea56567ae39a1b1920cbc42bb5bd',
                ],
            ],
        ],
    ],
];

return $config;
