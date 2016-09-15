<?php

use yii\helpers\ArrayHelper;

$acceptanceConfig = [
    'id' => 'acceptance-tests',
    'basePath' => dirname(__DIR__),
    'components' => [
        'request' => [
            'cookieValidationKey' => 'test',
            'enableCsrfValidation' => false,
        ],
    ],
];
$localName = 'acceptance-local.php';
if (file_exists(__DIR__ . DIRECTORY_SEPARATOR . $localName)) {
    $acceptanceConfig = ArrayHelper::merge($acceptanceConfig, require(__DIR__ . DIRECTORY_SEPARATOR . $localName));
}
return ArrayHelper::merge(require(__DIR__ . DIRECTORY_SEPARATOR . 'common.php'), $acceptanceConfig);
