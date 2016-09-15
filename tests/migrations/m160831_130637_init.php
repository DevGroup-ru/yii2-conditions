<?php

use DevGroup\Conditions\Tests\models\TestModel;
use yii\db\Migration;

class m160831_130637_init extends Migration
{
    public function up()
    {
        $this->createTable(TestModel::tableName(), ['id' => $this->primaryKey()]);
    }

    public function down()
    {
        $this->dropTable(TestModel::tableName());
    }
}
