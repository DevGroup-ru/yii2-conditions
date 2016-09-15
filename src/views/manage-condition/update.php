<?php

/* @var $this yii\base\View */
/* @var $model  Condition */

use DevGroup\Conditions\models\Condition;
use DevGroup\Conditions\models\ConditionGroup;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$model->groupArray = ArrayHelper::merge($model->groupArray, (array) Yii::$app->request->get('conditionGroupId', []));
?>

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'name'); ?>
<?= $form->field($model, 'handler_class_name'); ?>

<?= $form->field($model, 'groupArray')->checkboxList(
    ConditionGroup::find()->select(['name', 'id'])->indexBy('id')->column()
) ?>

<?= Html::submitButton() ?>

<?php ActiveForm::end();

