<?php


namespace DevGroup\Conditions\handlers;

use yii\base\Object;
use yii\db\ActiveRecord;

/**
 * Class AbstractChecker
 * @package DevGroup\Conditions\handlers
 */
abstract class AbstractChecker extends Object implements CheckerInterface
{
    /**
     * @var ActiveRecord
     */
    public $model;
}
