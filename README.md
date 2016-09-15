Yii2 conditions system
======================
Yii2 conditions system

> *WARNING*: This extension is under active development. Don't use it in production!

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist devgroup/yii2-conditions "*"
```

or add

```
"devgroup/yii2-conditions": "*"
```

to the require section of your `composer.json` file.

Usage
-----
```php
'module' => [
    'conditions' => [
        'class' => ConditionsModule::class,
    ],
],
```
`./yii conditions/generate app\\models\\Page`