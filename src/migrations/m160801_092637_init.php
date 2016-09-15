<?php

use yii\db\Migration;

class m160801_092637_init extends Migration
{
    public function up()
    {
        $tableOptions = $this->db->driverName === 'mysql' ? 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB' : null;

        $this->createTable(
            '{{%devgroup_condition}}',
            [
                'id' => $this->primaryKey(),
                'name' => $this->string(100)->notNull(),
                'handler_class_name' => $this->string(100)->notNull(),
            ],
            $tableOptions
        );

        $this->createTable(
            '{{%devgroup_condition_group}}',
            ['id' => $this->primaryKey(), 'name' => $this->string(100)->notNull()],
            $tableOptions
        );

        $this->createTable(
            '{{%devgroup_condition_condition_group}}',
            [
                'id' => $this->primaryKey(),
                'condition_id' => $this->integer()->notNull(),
                'condition_group_id' => $this->integer()->notNull(),
            ],
            $tableOptions
        );

        $this->addForeignKey(
            'fk-condition_condition_group-condition',
            '{{%devgroup_condition_condition_group}}',
            'condition_id',
            '{{%devgroup_condition}}',
            'id',
            'CASCADE',
            'RESTRICT'
        );

        $this->addForeignKey(
            'fk-condition_condition_group-condition_group',
            '{{%devgroup_condition_condition_group}}',
            'condition_group_id',
            '{{%devgroup_condition_group}}',
            'id',
            'CASCADE',
            'RESTRICT'
        );
    }

    public function down()
    {
        $this->dropTable('{{%devgroup_condition_condition_group}}');
        $this->dropTable('{{%devgroup_condition_group}}');
        $this->dropTable('{{%devgroup_condition}}');
    }
}
