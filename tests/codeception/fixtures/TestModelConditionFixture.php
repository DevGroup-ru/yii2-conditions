<?php


namespace DevGroup\Conditions\Tests\codeception\fixtures;

use DevGroup\Conditions\helpers\ConditionHelper;
use DevGroup\Conditions\Tests\models\TestModel;
use yii\test\ActiveFixture;

class TestModelConditionFixture extends ActiveFixture
{
    public function init()
    {
        $this->tableName = ConditionHelper::getRelatedTableName(TestModel::tableName());
        parent::init();
    }
}
