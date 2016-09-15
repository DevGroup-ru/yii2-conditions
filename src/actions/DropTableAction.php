<?php


namespace DevGroup\Conditions\actions;

use DevGroup\Conditions\helpers\ConditionHelper;
use yii\base\Action;
use yii\base\InvalidParamException;
use yii\db\ActiveRecord;
use yii\db\Migration;

class DropTableAction extends Action
{
    /**
     * @param $className
     *
     * @return int
     */
    public function run($className)
    {
        if (class_exists($className) === true) {
            /**
             * @var ActiveRecord
             */
            $model = new $className;
            if ($model instanceof ActiveRecord) {
                $tableName = ConditionHelper::getRelatedTableName($model::tableName());
                $db = $model::getDb();
                $migration = new Migration(['db' => $db]);

                $migration->dropTable($tableName);

                return 0;
            }
        }
        throw new InvalidParamException(ConditionHelper::t('Set correct class name'));
    }
}
