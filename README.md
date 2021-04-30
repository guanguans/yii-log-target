# package-skeleton

[简体中文](README-CN.md) | [ENGLISH](README.md)

> A `yii-log-target` of collection(Slack、DingTalk、Bark、Telegram、Server 酱、WeChat、息知). - 集合了多种 `yii-log-target`(Slack、DingTalk、Bark、Telegram、Server 酱、WeChat、息知)。

[![Tests](https://github.com/guanguans/yii-log-target/workflows/Tests/badge.svg)](https://github.com/guanguans/yii-log-target/actions)
[![Check & fix styling](https://github.com/guanguans/yii-log-target/workflows/Check%20&%20fix%20styling/badge.svg)](https://github.com/guanguans/yii-log-target/actions)
[![codecov](https://codecov.io/gh/guanguans/yii-log-target/branch/main/graph/badge.svg?token=URGFAWS6S4)](https://codecov.io/gh/guanguans/yii-log-target)
[![Latest Stable Version](https://poser.pugx.org/guanguans/yii-log-target/v)](//packagist.org/packages/guanguans/yii-log-target)
[![Total Downloads](https://poser.pugx.org/guanguans/yii-log-target/downloads)](//packagist.org/packages/guanguans/yii-log-target)
[![License](https://poser.pugx.org/guanguans/yii-log-target/license)](//packagist.org/packages/guanguans/yii-log-target)

## Requirement

* PHP >= 7.2

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
            'class' => \yii\log\FileTarget::class,
            'levels' => ['error', 'warning'],
        ],
        // Chanify
        [
            'class' => \Guanguans\YiiLogTarget\ChanifyTarget::class,
            'levels' => ['error', 'warning'],
            'token' => 'CIDfh4gGEiJBQVdIWlVKS1JORVY0UlVETFZYVVpRTlNLTlVZVlZPT1JFGhR7vAyf8Uj5UQhhK4n6QfVzih96QyIECAEQAQ',
        ],
    ],
]
```

## Usage

``` php
Yii::error(sprintf('测试: %s', \Guanguans\YiiLogTarget\ChanifyTarget::class));
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
