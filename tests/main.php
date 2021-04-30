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
                    'class' => \yii\log\FileTarget::class,
                    'levels' => ['error', 'warning'],
                ],
                // Chanify
                [
                    'class' => \Guanguans\YiiLogTarget\ChanifyTarget::class,
                    'levels' => ['error', 'warning'],
                    'token' => 'CIDfh4gGEiJBQVdIWlVKS1JORVY0UlVETFZYVVpRTlNLTlVZVlZPT1JFGhR7vAyf8Uj5UQhhK4n6QfVzih96QyIECAEQAQ',
                ],
                // Server 酱
                [
                    'class' => \Guanguans\YiiLogTarget\ServerChanTarget::class,
                    'levels' => ['error', 'warning'],
                    'token' => 'SCU75615Tf04742ed61955993cb1cd045505b326f5e0ef51',
                ],
            ],
        ],
    ],
];

return $config;
