# yii-log-target

[简体中文](README.md) | [ENGLISH](README-EN.md)

> Multiple channels of Yii exception notification(Bark、Chanify、DingTalk、FeiShu、ServerChan、WeWork、XiZhi). - 多种通道的 Yii 异常通知(Bark、Chanify、钉钉群机器人、飞书群机器人、Server 酱、企业微信群机器人、息知)。

[![Tests](https://github.com/guanguans/yii-log-target/workflows/Tests/badge.svg)](https://github.com/guanguans/yii-log-target/actions)
[![Check & fix styling](https://github.com/guanguans/yii-log-target/workflows/Check%20&%20fix%20styling/badge.svg)](https://github.com/guanguans/yii-log-target/actions)
[![codecov](https://codecov.io/gh/guanguans/yii-log-target/branch/main/graph/badge.svg?token=URGFAWS6S4)](https://codecov.io/gh/guanguans/yii-log-target)
[![Latest Stable Version](https://poser.pugx.org/guanguans/yii-log-target/v)](//packagist.org/packages/guanguans/yii-log-target)
[![Total Downloads](https://poser.pugx.org/guanguans/yii-log-target/downloads)](//packagist.org/packages/guanguans/yii-log-target)
[![License](https://poser.pugx.org/guanguans/yii-log-target/license)](//packagist.org/packages/guanguans/yii-log-target)

## 环境要求

* PHP >= 7.2
* yiisoft/yii2 > 2.0

## 安装

``` bash
$ composer require guanguans/yii-log-target --prefer-dist -vvv
```

## 配置

Yii2 配置文件 `config/main.php` 的日志组件中配置:

``` php
'log' => [
    'traceLevel' => YII_DEBUG ? 3 : 0,
    'targets' => [
        [
            'class' => 'yii\log\FileTarget',
            'levels' => ['error', 'warning'],
        ],

        // // Bark
        // [
        //     'class' => \Guanguans\YiiLogTarget\BarkTarget::class,
        //     'levels' => ['error'],
        //     // 'debug' => true,
        //     'token' => 'PXb8KDj9dHStfQ5cGJ5',
        // ],
        //
        // // Chanify
        // [
        //     'class' => \Guanguans\YiiLogTarget\ChanifyTarget::class,
        //     'levels' => ['error'],
        //     // 'debug' => true,
        //     'token' => 'P3IgGEiJBQVdIWlVKS1JORVY0UlVETFZYVVpRTlNLTlVZVlZPT1JFGhR7vAyf8Uj5UQhhK4n6QfVzih96QyIECAEQAQ.G4z2i0VZP7lOiCKYif4LOXu3cBdizl-PLWYn_7zrGXQ',
        // ],
        //
        // 钉钉群机器人
        [
            'class'   => \Guanguans\YiiLogTarget\DingTalkTarget::class,
            'levels'  => ['error'],
            // 'debug'   => true,
            // 'debugLogFile' => '@runtime/logs/debug-exception-target.log',
            // 'envs' => ['prod'],
            // 'excludeExceptions' => [],
            'keyword' => 'keyword',
            'token'   => 'fec1ddaa8a833156efb77b7865d62ae13775418030d94d05da08bfca73eeb',
            // 'secret'  => 'SECc32bb7345c0f73da2b9786f0f7dd5083bd768a29b82e6d460149d730eee51730',
        ],
        //
        // // 飞书群机器人
        // [
        //     'class'   => \Guanguans\YiiLogTarget\FeiShuTarget::class,
        //     'levels'  => ['error'],
        //     // 'debug'   => true,
        //     'keyword' => 'keyword',
        //     'token'   => 'b70d9-6e19-4f87-af48-348b0281866c',
        //     // 'secret'  => 'iigDOvnsIn6aFS1pYHHEHh',
        // ],
        //
        // // Server 酱
        // [
        //     'class'   => \Guanguans\YiiLogTarget\ServerChanTarget::class,
        //     'levels'  => ['error'],
        //     // 'debug'   => true,
        //     'token'   => '35149Thtf1g2Bc14QJuQ6HFpW5YGXm',
        // ],
        //
        // // 企业微信群机器人
        // [
        //     'class'   => \Guanguans\YiiLogTarget\WeWorkTarget::class,
        //     'levels'  => ['error'],
        //     // 'debug'   => true,
        //     'token'   => '3d5a3-ceff-4da8-bcf3-ff5891778fb7',
        // ],
        //
        // // 息知
        // [
        //     'class'   => \Guanguans\YiiLogTarget\XiZhiTarget::class,
        //     'levels'  => ['error'],
        //     // 'debug'   => true,
        //     'token'   => '60aea56567ae39a1b1920cbc42bb5bd',
        // ],
    ],
],
```

## 使用

``` php
Yii::error('测试');
```

![example](./docs/example.png)

## 测试

``` bash
$ composer test
```

## 变更日志

请参阅 [CHANGELOG](CHANGELOG.md) 获取最近有关更改的更多信息。

## 贡献指南

请参阅 [CONTRIBUTING](.github/CONTRIBUTING.md) 有关详细信息。

## 安全漏洞

请查看[我们的安全政策](../../security/policy)了解如何报告安全漏洞。

## 贡献者

* [guanguans](https://github.com/guanguans)
* [所有贡献者](../../contributors)

## 协议

MIT 许可证（MIT）。有关更多信息，请参见[协议文件](LICENSE)。
