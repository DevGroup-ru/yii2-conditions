<?php


namespace DevGroup\Conditions\actions;


use yii\base\Action;

class DeleteAction extends Action
{
    public function run($id)
    {
        $model = $this->controller->findModel($id);
        $model->delete();
        return $this->controller->redirect(['index']);
    }
}