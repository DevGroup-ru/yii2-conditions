<?php


namespace DevGroup\Conditions\actions;

use DevGroup\Conditions\handlers\AbstractChecker;
use Yii;
use yii\base\Action;
use yii\base\InvalidParamException;
use yii\web\NotFoundHttpException;

class FormSelectionAction extends Action
{
    /**
     * @param string $className
     * @param array $selection
     *
     * @throws NotFoundHttpException
     */
    public function run($className = '', $selection = [])
    {
        if (Yii::$app->request->isAjax === false) {
            throw new  NotFoundHttpException();
        }
        if (class_exists($className) === false) {
            throw new InvalidParamException();
        }
        $obj = new $className;
        if ($obj instanceof AbstractChecker === false) {
            throw new InvalidParamException();
        }
    }
}
