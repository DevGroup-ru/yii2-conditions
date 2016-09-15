<?php

use yii\helpers\ArrayHelper;

$unitConfig = [
    'id' => 'unit-tests',
    'basePath' => dirname(__DIR__),
    'class' => 'yii\console\Application',
];

$localName = 'unit-local.php';
if (file_exists(__DIR__ . DIRECTORY_SEPARATOR . $localName)) {
    $unitConfig = ArrayHelper::merge($unitConfig, require(__DIR__ . DIRECTORY_SEPARATOR . $localName));
}

return ArrayHelper::merge(require(__DIR__ . DIRECTORY_SEPARATOR . 'common.php'), $unitConfig);
