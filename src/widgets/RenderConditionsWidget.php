<?php


namespace DevGroup\Conditions\widgets;

use DevGroup\Conditions\models\Condition;
use DevGroup\Conditions\models\ConditionConditionGroup;
use yii\base\InvalidParamException;
use yii\base\Widget;
use yii\db\ActiveRecord;
use yii\db\Query;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

/**
 * use widget in admin area to add conditions to model
 *  <?= DevGroup\Conditions\widgets\RenderConditionsWidget::widget(
 *      [
 *          'conditionGroupId' => 1,
 *          'model' => $model,
 *          'form' => $form,
 *      ]
 * ) ?>
 *
 * Class RenderConditionsWidget
 * @package DevGroup\Conditions\widgets
 */
class RenderConditionsWidget extends Widget
{
    /**
     * @var int
     */
    public $conditionGroupId = null;
    /**
     * @var ActiveRecord
     */
    public $model = null;
    /**
     * @var ActiveForm
     */
    public $form = null;

    public function init()
    {
        if (is_null($this->conditionGroupId) || is_null($this->model) || $this->form instanceof ActiveForm === false) {
            throw new InvalidParamException('Set all correct variables');
        }
    }

    public function run()
    {

        $conditionsArray = (new Query())->select(['id', 'name'])->from(Condition::tableName())->where(
            (new Query())->from(ConditionConditionGroup::tableName())->select('condition_id')->where(
                ['condition_group_id' => $this->conditionGroupId]
            )->column()
        )->all();
        $dropdown = ArrayHelper::map($conditionsArray, 'id', 'name');
        return $this->form->field($this->model, 'attachedConditions')->dropDownList($dropdown);
    }
}
