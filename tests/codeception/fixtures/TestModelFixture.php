<?php


namespace DevGroup\Conditions\Tests\codeception\fixtures;

use DevGroup\Conditions\Tests\models\TestModel;
use yii\test\ActiveFixture;

class TestModelFixture extends ActiveFixture
{
    public $modelClass = TestModel::class;

    public function getData()
    {
        return array_fill(0, 11, []);
    }
}
