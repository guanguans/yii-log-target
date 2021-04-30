# package-skeleton

[简体中文](README-CN.md) | [ENGLISH](README.md)

> A `yii-log-target` of collection(Slack、DingTalk、Bark、Telegram、Server 酱、WeChat、息知). - 集合了多种 `yii-log-target`(Slack、DingTalk、Bark、Telegram、Server 酱、WeChat、息知)。

[![Tests](https://github.com/guanguans/yii-log-target/workflows/Tests/badge.svg)](https://github.com/guanguans/yii-log-target/actions)
[![Check & fix styling](https://github.com/guanguans/yii-log-target/workflows/Check%20&%20fix%20styling/badge.svg)](https://github.com/guanguans/yii-log-target/actions)
[![codecov](https://codecov.io/gh/guanguans/yii-log-target/branch/main/graph/badge.svg?token=URGFAWS6S4)](https://codecov.io/gh/guanguans/yii-log-target)
[![Latest Stable Version](https://poser.pugx.org/guanguans/yii-log-target/v)](//packagist.org/packages/guanguans/yii-log-target)
[![Total Downloads](https://poser.pugx.org/guanguans/yii-log-target/downloads)](//packagist.org/packages/guanguans/yii-log-target)
[![License](https://poser.pugx.org/guanguans/yii-log-target/license)](//packagist.org/packages/guanguans/yii-log-target)

## 环境要求

* PHP >= 7.2

## 安装

``` bash
$ composer require guanguans/yii-log-target --prefer-dist -vvv
```

## 配置

Yii2 配置文件 `config/main.php` 的日志组件中添加:

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

## 使用

``` php
Yii::error(sprintf('测试: %s', \Guanguans\YiiLogTarget\ChanifyTarget::class));
```

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
