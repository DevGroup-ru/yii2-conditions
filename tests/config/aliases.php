<?php

use yii\helpers\ArrayHelper;

$aliasesConfig = [
    '@DevGroup/Conditions' => dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'src',
    '@DevGroup/Conditions/Tests' => dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'tests',
    '@bower' => '@vendor/bower-asset',
    '@npm' => '@vendor/npm-asset',
];
$localName = 'aliases-local.php';
if (file_exists(__DIR__ . DIRECTORY_SEPARATOR . $localName)) {
    $aliasesConfig = ArrayHelper::merge($aliasesConfig, require(__DIR__ . DIRECTORY_SEPARATOR . $localName));
}

return $aliasesConfig;
