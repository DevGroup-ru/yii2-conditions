<?php

namespace DevGroup\Conditions\models;

use DevGroup\Conditions\helpers\ConditionHelper;
use Yii;
use yii\data\ActiveDataProvider;
use yii\db\Query;
use yiister\mappable\ActiveRecordTrait;

/**
 * This is the model class for table "{{%devgroup_condition}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $handler_class_name
 * @property ConditionGroup[] $groups
 * @property array $groupArray
 */
class Condition extends \yii\db\ActiveRecord
{
    use ActiveRecordTrait;

    private $_groupArray = [];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%devgroup_condition}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'handler_class_name'], 'required'],
            [['name', 'handler_class_name'], 'string', 'max' => 100],
            [['groupArray'], 'safe'],
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
            'handler_class_name' => ConditionHelper::t('Handler Class Name'),
        ];
    }

    /**
     * @param $params
     * @param $groupId
     *
     * @return ActiveDataProvider
     */
    public function search($params, $groupId)
    {
        $this->load($params);
        $query = static::find()->where(
            [
                'id' => (new Query)->select('condition_id')->from(ConditionConditionGroup::tableName())->where(
                    ['condition_group_id' => $groupId]
                )->column(),
            ]
        );
        $partialAttributes = ['name', 'handler_class_name'];
        foreach ($this->attributes as $key => $value) {
            if (in_array($key, $partialAttributes)) {
                $query->andFilterWhere(['like', $key, $value]);
            } else {
                $query->andFilterWhere([$key => $value]);
            }
        }
        return new ActiveDataProvider(
            [
                'query' => $query,
            ]
        );
    }

    public function getGroupArray()
    {
        if (empty($this->_groupArray)) {
            $this->_groupArray = $this->getGroups()->select('id')->column();
        }
        return $this->_groupArray;
    }

    public function setGroupArray($groupArray)
    {
        $this->_groupArray = (array) $groupArray;
    }

    public function getGroups()
    {
        return $this->hasMany(ConditionGroup::class, ['id' => 'condition_group_id'])->viaTable(
            '{{%devgroup_condition_condition_group}}',
            ['condition_id' => 'id']
        );
    }

    public function afterSave($insert, $changedAttributes)
    {
        $this->updateGroups();
        parent::afterSave($insert, $changedAttributes);
    }

    private function updateGroups()
    {
        $currentGroupsIds = $this->getGroups()->select('id')->column();
        $newGroupsIds = $this->groupArray;
        foreach (array_filter(array_diff($newGroupsIds, $currentGroupsIds)) as $groupId) {
            /** @var ConditionGroup $group */
            if ($group = ConditionGroup::findOne($groupId)) {
                $this->link('groups', $group);
            }
        }
        foreach (array_filter(array_diff($currentGroupsIds, $newGroupsIds)) as $groupId) {
            /** @var ConditionGroup $tag */
            if ($group = ConditionGroup::findOne($groupId)) {
                $this->unlink('groups', $group, true);
            }
        }
    }
}
