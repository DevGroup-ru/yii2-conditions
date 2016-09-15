<?php
use DevGroup\Conditions\Tests\handlers\TestFirstHandler;
use DevGroup\Conditions\Tests\handlers\TestSecondHandler;

return [
    ['name' => 'First', 'handler_class_name' => TestFirstHandler::class],
    ['name' => 'Second', 'handler_class_name' => TestSecondHandler::class],
];
