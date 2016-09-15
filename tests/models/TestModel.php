<?php


namespace DevGroup\Conditions\Tests\models;

use DevGroup\Conditions\behaviors\ConditionBehavior;
use yii\db\ActiveRecord;

class TestModel extends ActiveRecord
{
    public function behaviors()
    {
        return [
            'conditions' => ['class' => ConditionBehavior::class],
        ];
    }
}
