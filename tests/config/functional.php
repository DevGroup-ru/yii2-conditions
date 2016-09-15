<?php

use yii\helpers\ArrayHelper;

$functionalConfig = [
    'id' => 'functional-tests',
    'basePath' => dirname(__DIR__),
    'components' => [
        'request' => [
            'cookieValidationKey' => 'test',
            'enableCsrfValidation' => false,
        ],
    ],
];

$localName = 'functional-local.php';
if (file_exists(__DIR__ . DIRECTORY_SEPARATOR . $localName)) {
    $functionalConfig = ArrayHelper::merge($functionalConfig, require(__DIR__ . DIRECTORY_SEPARATOR . $localName));
}

return ArrayHelper::merge(require(__DIR__ . DIRECTORY_SEPARATOR . 'common.php'), $functionalConfig);
