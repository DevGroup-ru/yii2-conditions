<?php

/* @var $this yii\base\View */
/* @var $tabs array */
/* @var $dataProvider ActiveDataProvider */

use yii\bootstrap\Tabs;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

?>
<?php foreach ($tabs as $tab): ?>
    <?php
    Html::addCssClass($tab['headerOptions'], 'btn-group');
    ?>
    <div <?= Html::renderTagAttributes($tab['headerOptions']) ?>>

        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <?= $tab['label'] ?>
            <span class="caret"></span>
        </button>
        <?= Html::ul(
            $tab['items'],
            [
                'class' => 'dropdown-menu',
                'item' => function ($item, $index) {
                    return Html::tag('li', Html::a($item['label'], $item['url']));
                },
            ]
        ) ?>

    </div>
<?php endforeach; ?>
    <div class="btn-group">

        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Add group
            <span class="caret"></span>
        </button>
        <ul class="dropdown-menu">
            <li><a href="<?= Url::to(['group-edit']) ?>" class="add-group">Add</a></li>
        </ul>

    </div>

<?php Pjax::begin(); ?>
<?= GridView::widget(
    [
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            'name',
            'handler_class_name',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
                'controller' => 'manage-condition',
                'urlCreator' => function ($action, $model, $key, $index, $column) {
                    $paramActionToAction = [
                        'update' => 'condition-edit',
                        'delete' => 'condition-delete',
                    ];
                    $action = $paramActionToAction[$action];
                    $params = is_array($key) ? $key : ['id' => (string) $key];
                    $params[0] = $column->controller . '/' . $action;
                    return Url::toRoute($params);
                },
            ],
        ],

    ]
) ?>
    <div class="btn-group">

        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Add condition
            <span class="caret"></span>
        </button>
        <ul class="dropdown-menu">
            <li><a href="<?= Url::to(
                    [
                        'manage-condition/condition-edit',
                        'conditionGroupId' => Yii::$app->request->get('conditionGroupId'),
                    ]
                ) ?>" class="add-condition">Add</a></li>
        </ul>

    </div>
<?php Pjax::end();
