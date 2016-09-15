<?php


namespace DevGroup\Conditions\Tests\handlers;

use DevGroup\Conditions\handlers\AbstractChecker;
use yii\widgets\ActiveForm;

class TestFirstHandler extends AbstractChecker
{
    public $leftBorder;
    public $rightBorder;

    /**
     * @param mixed $data
     *
     * @return bool
     */
    public function checkCondition($data)
    {
        $array = range($this->leftBorder, $this->rightBorder);
        return in_array($data, $array);
    }

    /**
     * @param ActiveForm $form
     */
    public static function renderField($form)
    {
        // TODO: Implement renderField() method.
    }
}
