<?php


namespace DevGroup\Conditions\controllers;

use DevGroup\Conditions\actions\DeleteAction;
use DevGroup\Conditions\actions\UpdateAction;
use DevGroup\Conditions\models\Condition;
use yii\web\Controller;

/**
 * Class ManageConditionsController
 * @package DevGroup\Conditions\controllers
 */
class ManageConditionController extends Controller
{
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'condition-edit' => UpdateAction::class,
            'condition-delete' => DeleteAction::class,
        ];
    }

    public function actionIndex()
    {
        return $this->redirect(['manage-group/index']);
    }

    /**
     * @param int $modelId
     *
     * @return Condition|null
     */
    public function findModel($modelId = null)
    {
        if (is_null($modelId) === true) {
            $model = new Condition();
            $model->loadDefaultValues();
            return $model;
        }
        return Condition::getById($modelId);
    }
}
