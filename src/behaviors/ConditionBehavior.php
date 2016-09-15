<?php


namespace DevGroup\Conditions\behaviors;

use DevGroup\Conditions\handlers\AbstractChecker;
use DevGroup\Conditions\helpers\ConditionHelper;
use DevGroup\Conditions\models\Condition;
use Yii;
use yii\base\Behavior;
use yii\base\Exception;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\db\Query;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;

/**
 * Class ConditionBehavior
 * @package DevGroup\Conditions\behaviors
 *
 * add this properties doc in model to have IDE autocomplete support
 * @property Condition[] $conditions
 * @property AbstractChecker[] $checkers
 * @todo Behavior depends on AR, think have to remove dependency in future, help need
 */
class ConditionBehavior extends Behavior
{
    /**
     * @param \yii\base\Component $owner
     *
     * @throws Exception
     */
    public function attach($owner)
    {
        parent::attach($owner);
        if ($owner->hasMethod('tableName') === false) {
            throw new Exception(ConditionHelper::t("You can't use behavior. Implement `tableName` method first."));
        }
    }

    /**
     * @return ActiveQuery
     */
    public function getConditions()
    {
        /**
         * @var $model ActiveRecord
         */
        $model = $this->owner;
        $tableName = ConditionHelper::getRelatedTableName($model->tableName());
        return $model->hasMany(Condition::class, ['id' => 'condition_id'])->viaTable($tableName, ['model_id' => 'id']);
    }

    /**
     * @return AbstractChecker[]
     */
    public function getChecks()
    {
        /**
         * @var $conditions Condition[]
         */
        $model = $this->owner;
        $conditions = $model->conditions;
        return array_reduce(
            $conditions,
            function ($carry, Condition $item) use ($model) {
                $tableName = ConditionHelper::getRelatedTableName($model->tableName());
                $jsonColumn = (new Query())->select('packed_json_data')->from($tableName)->where(
                    ['condition_id' => $item->id, 'model_id' => $model->id]
                )->column();
                foreach ($jsonColumn as $json) {
                    $carry[] = Yii::createObject(
                        ArrayHelper::merge(
                            ['class' => $item->handler_class_name, 'model' => $model],
                            Json::decode($json)
                        )
                    );
                }
                return $carry;
            },
            []
        );
    }

    /**
     * check all available conditions
     *
     * @param $data
     *
     * @return bool true if all conditions are satisfied, false if smth is wrong
     */
    public function checkConditions($data)
    {
        /**
         * @var $checks AbstractChecker[]
         */
        $checks = $this->owner->checks;
        foreach ($checks as $check) {
            $result = $check->checkCondition($data);
            if ($result === false) {
                return false;
            }
        }
        return true;
    }
}
