<?php


namespace DevGroup\Conditions\commands;

use DevGroup\Conditions\actions\CreateTablesAction;
use DevGroup\Conditions\actions\DropTableAction;
use yii\console\Controller;

/**
 * Class GenerateController
 * @package DevGroup\Conditions\commands
 */
class GenerateController extends Controller
{
    /**
     * @inheritdoc
     */
    public $defaultAction = 'up';

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'up' => CreateTablesAction::class,
            'down' => DropTableAction::class,
        ];
    }
}
