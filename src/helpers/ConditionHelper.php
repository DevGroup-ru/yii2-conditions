<?php


namespace DevGroup\Conditions\helpers;

use Yii;

/**
 * Class ConditionHelper
 * @package DevGroup\Conditions\helpers
 */
class ConditionHelper
{
    /**
     * @param string $tableName
     *
     * @return string
     */
    public static function getRelatedTableName($tableName)
    {
        return 'devgroup_' . Yii::$app->db->getSchema()->getRawTableName($tableName) . '_conditions';
    }

    /**
     * use this method to translate messages in package
     *
     * @param $message
     *
     * @return string
     */
    public static function t($message)
    {
        return Yii::t('devgroup.conditions', $message);
    }
}
