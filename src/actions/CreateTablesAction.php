<?php


namespace DevGroup\Conditions\actions;

use DevGroup\Conditions\helpers\ConditionHelper;
use DevGroup\Conditions\models\Condition;
use yii\base\Action;
use yii\base\InvalidParamException;
use yii\db\ActiveRecord;
use yii\db\Migration;

/**
 * Class CreateTablesAction
 * @package DevGroup\Conditions\actions
 */
class CreateTablesAction extends Action
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
                $modelTable = $db->getSchema()->getRawTableName($model::tableName());
                $conditionTable = $db->getSchema()->getRawTableName(Condition::tableName());
                $migration = new Migration(['db' => $db]);
                $tableOptions = $db->driverName === 'mysql' ? 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB' : null;
                $migration->createTable(
                    $tableName,
                    [
                        'id' => $migration->primaryKey(),
                        'model_id' => $migration->integer(),
                        'condition_id' => $migration->integer(),
                        'packed_json_data' => $migration->text(),
                    ],
                    $tableOptions
                ); // think about index

                $migration->addForeignKey(
                    "fk-{$tableName}-{$modelTable}",
                    $tableName,
                    'model_id',
                    $modelTable,
                    'id',
                    'CASCADE',
                    'RESTRICT'
                );

                $migration->addForeignKey(
                    "fk-{$tableName}-{$conditionTable}",
                    $tableName,
                    'condition_id',
                    $conditionTable,
                    'id',
                    'CASCADE',
                    'RESTRICT'
                );

                return 0;
            }
        }
        throw new InvalidParamException(ConditionHelper::t('Set correct class name'));
    }
}
