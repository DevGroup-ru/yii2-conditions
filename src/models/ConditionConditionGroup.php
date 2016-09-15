<?php

namespace DevGroup\Conditions\models;

use DevGroup\Conditions\helpers\ConditionHelper;
use Yii;

/**
 * This is the model class for table "{{%devgroup_condition_condition_group}}".
 *
 * @property integer $id
 * @property integer $condition_id
 * @property integer $condition_group_id
 */
class ConditionConditionGroup extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%devgroup_condition_condition_group}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['condition_id', 'condition_group_id'], 'required'],
            [['condition_id', 'condition_group_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => ConditionHelper::t('ID'),
            'condition_id' => ConditionHelper::t('Condition ID'),
            'condition_group_id' => ConditionHelper::t('Condition Group ID'),
        ];
    }
}
