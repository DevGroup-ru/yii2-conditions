<?php

use yii\helpers\ArrayHelper;

$dbConfig = [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=yii2-conditions-test',
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8',
];

$localName = 'db-local.php';
if (file_exists(__DIR__ . DIRECTORY_SEPARATOR . $localName)) {
    $dbConfig = ArrayHelper::merge($dbConfig, require(__DIR__ . DIRECTORY_SEPARATOR . $localName));
}

return $dbConfig;
