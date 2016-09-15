<?php


namespace DevGroup\Conditions\handlers;

use yii\widgets\ActiveForm;

/**
 * Interface CheckerInterface
 * @package DevGroup\Conditions\handlers
 */
interface CheckerInterface
{

    /**
     * @param mixed $data
     *
     * @return bool
     */
    public function checkCondition($data);

    /**
     * @param ActiveForm $form
     */
    public static function renderField($form);
}
