<?php


namespace DevGroup\Conditions\actions;

use Yii;
use yii\base\Action;

/**
 * Class UpdateAction
 * @package DevGroup\Conditions\actions
 */
class UpdateAction extends Action
{
    /**
     * @param null $id
     *
     * @return string|\yii\web\Response
     */
    public function run($id = null)
    {
        $model = $this->controller->findModel($id);
        if ($model->load(Yii::$app->request->post()) === true) {
            $isSaved = $model->save();
            if ($isSaved === true) {
                return $this->controller->redirect([$this->id, 'id' => $model->id]);
            }
        }
        return $this->controller->render('update', ['model' => $model]);
    }
}
