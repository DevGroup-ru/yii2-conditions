<?php

namespace DevGroup\Conditions\models;

use DevGroup\Conditions\helpers\ConditionHelper;
use yiister\mappable\ActiveRecordTrait;

/**
 * This is the model class for table "{{%devgroup_condition_group}}".
 *
 * @property integer $id
 * @property string $name
 */
class ConditionGroup extends \yii\db\ActiveRecord
{
    use ActiveRecordTrait;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%devgroup_condition_group}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => ConditionHelper::t('ID'),
            'name' => ConditionHelper::t('Name'),
        ];
    }
}
