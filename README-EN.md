# yii-log-target

[简体中文](README.md) | [ENGLISH](README-EN.md)

> A `yii-log-target` of collection(Bark、Chanify、DingTalk、FeiShu、ServerChan、WeWork、XiZhi). - 集合了多种 `yii-log-target`(Bark、Chanify、钉钉群机器人、飞书群机器人、Server 酱、企业微信群机器人、息知)。

> Monitor system error exception and send error exception notification through multiple channels. - 监控系统错误异常并且多渠道发送错误异常信息通知。

[![Tests](https://github.com/guanguans/yii-log-target/workflows/Tests/badge.svg)](https://github.com/guanguans/yii-log-target/actions)
[![Check & fix styling](https://github.com/guanguans/yii-log-target/workflows/Check%20&%20fix%20styling/badge.svg)](https://github.com/guanguans/yii-log-target/actions)
[![codecov](https://codecov.io/gh/guanguans/yii-log-target/branch/main/graph/badge.svg?token=URGFAWS6S4)](https://codecov.io/gh/guanguans/yii-log-target)
[![Latest Stable Version](https://poser.pugx.org/guanguans/yii-log-target/v)](//packagist.org/packages/guanguans/yii-log-target)
[![Total Downloads](https://poser.pugx.org/guanguans/yii-log-target/downloads)](//packagist.org/packages/guanguans/yii-log-target)
[![License](https://poser.pugx.org/guanguans/yii-log-target/license)](//packagist.org/packages/guanguans/yii-log-target)

## Requirement

* PHP >= 7.2
* yiisoft/yii2 > 2.0

## Installation

``` bash
$ composer require guanguans/yii-log-target --prefer-dist -vvv
```

## Configuration

Add to the log components of the Yii2 configuration file `config/main.php`:

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

## Usage

``` php
Yii::error('test');
```

## Testing

``` bash
$ composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

* [guanguans](https://github.com/guanguans)
* [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.
