<?php


namespace DevGroup\Conditions\actions;

use DevGroup\Conditions\models\Condition;
use DevGroup\Conditions\models\ConditionGroup;
use Yii;
use yii\base\Action;
use yii\helpers\Html;

/**
 * Class ListAction
 * @package DevGroup\Conditions\actions
 */
class ListAction extends Action
{
    /**
     * @param null $conditionGroupId
     *
     * @return string
     */
    public function run($conditionGroupId = null)
    {
        $tabs = [];
        $groups = ConditionGroup::find()->asArray(true)->all();
        if (is_null($conditionGroupId) === true) {
            $firstGroup = reset($groups);
            $conditionGroupId = $firstGroup['id'];
        }

        foreach ($groups as $group) {
            $headerOptions = [];
            if ($conditionGroupId === $group['id']) {
                Html::addCssClass($headerOptions, 'active');
            }
            $item = [
                'label' => $group['name'],
                'items' => [
                    ['label' => 'show', 'url' => ['index', 'conditionGroupId' => $group['id']]],
                    ['label' => 'edit', 'url' => ['group-edit', 'id' => $group['id']]],
                    ['label' => 'delete', 'url' => ['group-delete', 'id' => $group['id']]],
                ],
                'headerOptions' => $headerOptions,
            ];
            $tabs[] = $item;
        }

        $model = new Condition(['scenario' => 'search']);

        return $this->controller->render(
            'index',
            ['tabs' => $tabs, 'dataProvider' => $model->search(Yii::$app->request->get(), $conditionGroupId)]
        );
    }
}
