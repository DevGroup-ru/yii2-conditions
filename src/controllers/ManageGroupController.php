<?php


namespace DevGroup\Conditions\controllers;

use DevGroup\Conditions\actions\DeleteAction;
use DevGroup\Conditions\actions\ListAction;
use DevGroup\Conditions\actions\UpdateAction;
use DevGroup\Conditions\models\ConditionGroup;
use yii\web\Controller;

/**
 * Class ManageController
 * @package DevGroup\Conditions\controllers
 */
class ManageGroupController extends Controller
{
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'index' => ListAction::class,
            'group-edit' => UpdateAction::class,
            'group-delete' => DeleteAction::class,
        ];
    }

    public function findModel($modelId = null)
    {
        if (is_null($modelId) === true) {
            $model = new ConditionGroup();
            $model->loadDefaultValues();
            return $model;
        }
        return ConditionGroup::getById($modelId);
    }

}
