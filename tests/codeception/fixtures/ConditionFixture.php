<?php


namespace DevGroup\Conditions\Tests\codeception\fixtures;

use DevGroup\Conditions\models\Condition;
use yii\test\ActiveFixture;

class ConditionFixture extends ActiveFixture
{
    public $modelClass = Condition::class;
}
