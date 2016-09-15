<?php

use DevGroup\Conditions\ConditionsModule;
use yii\console\controllers\MigrateController;
use yii\console\controllers\ServeController;
use yii\helpers\ArrayHelper;

$commonConfig = [
    'id' => 'tests',
    'basePath' => dirname(dirname(__DIR__)),
    'layout' => false,
    'components' => [
        'db' => require(__DIR__ . DIRECTORY_SEPARATOR . 'db.php'),
        'i18n' => [
            'translations' => [
                'devgroup.conditions' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'sourceLanguage' => 'en-US',
                    'basePath' => '@DevGroup/Conditions/messages',
                ],
            ],
        ],
    ],
    'modules' => [
        'conditions' => [
            'class' => ConditionsModule::class,
        ],
    ],
    'aliases' => require(__DIR__ . DIRECTORY_SEPARATOR . 'aliases.php'),
];

$localName = 'common-local.php';
if (file_exists(__DIR__ . DIRECTORY_SEPARATOR . $localName)) {
    $commonConfig = ArrayHelper::merge($commonConfig, require(__DIR__ . DIRECTORY_SEPARATOR . $localName));
}

return $commonConfig;
