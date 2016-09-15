<?php
use yii\helpers\Json;

return [
    // models form 1 to 3 have first condition
    ['model_id' => 1, 'condition_id' => 1, 'packed_json_data' => Json::encode(['leftBorder' => 1, 'rightBorder' => 3])],
    ['model_id' => 2, 'condition_id' => 1, 'packed_json_data' => Json::encode(['leftBorder' => 2, 'rightBorder' => 4])],
    ['model_id' => 3, 'condition_id' => 1, 'packed_json_data' => Json::encode(['leftBorder' => 3, 'rightBorder' => 5])],
    // models form 4 to 6 have second condition
    ['model_id' => 4, 'condition_id' => 2, 'packed_json_data' => Json::encode(['leftBorder' => 4, 'rightBorder' => 6])],
    ['model_id' => 5, 'condition_id' => 2, 'packed_json_data' => Json::encode(['leftBorder' => 5, 'rightBorder' => 7])],
    ['model_id' => 6, 'condition_id' => 2, 'packed_json_data' => Json::encode(['leftBorder' => 6, 'rightBorder' => 8])],
    // models form 7 to 10 have first and second conditions
    [
        'model_id' => 7,
        'condition_id' => 1,
        'packed_json_data' => Json::encode(['leftBorder' => 7, 'rightBorder' => 9]),
    ],
    [
        'model_id' => 7,
        'condition_id' => 2,
        'packed_json_data' => Json::encode(['leftBorder' => 10, 'rightBorder' => 12]),
    ],
    [
        'model_id' => 8,
        'condition_id' => 1,
        'packed_json_data' => Json::encode(['leftBorder' => 9, 'rightBorder' => 11]),
    ],
    [
        'model_id' => 8,
        'condition_id' => 2,
        'packed_json_data' => Json::encode(['leftBorder' => 11, 'rightBorder' => 13]),
    ],
    [
        'model_id' => 9,
        'condition_id' => 1,
        'packed_json_data' => Json::encode(['leftBorder' => 11, 'rightBorder' => 13]),
    ],
    [
        'model_id' => 9,
        'condition_id' => 2,
        'packed_json_data' => Json::encode(['leftBorder' => 12, 'rightBorder' => 14]),
    ],
    [
        'model_id' => 10,
        'condition_id' => 1,
        'packed_json_data' => Json::encode(['leftBorder' => 13, 'rightBorder' => 15]),
    ],
    [
        'model_id' => 10,
        'condition_id' => 2,
        'packed_json_data' => Json::encode(['leftBorder' => 13, 'rightBorder' => 15]),
    ],
    // model with id 11 have no conditions
];
