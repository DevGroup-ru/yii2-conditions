<?php


namespace DevGroup\Conditions;

use Yii;
use yii\base\Module;

/**
 * Main package module
 * add to common app config to use it:
 * 'module' => [
 *   'conditions' => [
 *     'class' => ConditionsModule::class,
 *   ],
 * ],
 *
 * Class ConditionsModule
 * @package DevGroup\Conditions
 */
class ConditionsModule extends Module
{
    public static $moduleId = 'conditions';

    public function init()
    {
        parent::init();
        if (Yii::$app instanceof \yii\console\Application) {
            $this->controllerNamespace = 'DevGroup\Conditions\commands';
        }
    }

    public static function module()
    {
        $module = Yii::$app->getModule(static::$moduleId);
        if (is_null($module) === true) {
            return Yii::createObject(static::class, [static::$moduleId]);
        }
        return $module;
    }
}
