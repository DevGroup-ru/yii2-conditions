<?php

/* @var $this yii\base\View */
/* @var $model  ConditionGroup */

use DevGroup\Conditions\models\ConditionGroup;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<?php $form = ActiveForm::begin(['id' => 'form-group']); ?>

<?= $form->field($model, 'name'); ?>
<?= Html::submitButton() ?>

<?php ActiveForm::end();

