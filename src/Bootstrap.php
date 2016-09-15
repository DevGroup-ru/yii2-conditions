<?php


namespace DevGroup\Conditions;

use yii\base\Application;
use yii\base\BootstrapInterface;

/**
 * Class Bootstrap
 * @package DevGroup\Conditions
 */
class Bootstrap implements BootstrapInterface
{

    /**
     * Bootstrap method to be called during application bootstrap stage.
     *
     * @param Application $app the application currently running
     */
    public function bootstrap($app)
    {
        $app->i18n->translations['devgroup.conditions'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => 'en-US',
            'basePath' => '@DevGroup/Conditions/messages',
        ];
    }
}
