<?php


namespace test\codeception\unit\helpers;

use Codeception\Test\Unit;
use DevGroup\Conditions\helpers\ConditionHelper;

class ConditionHelperTest extends Unit
{
    use \Codeception\Specify;
    /**
     * @var \UnitTester
     */
    protected $tester;

    protected function _before()
    {
        parent::_before();
    }

    protected function _after()
    {
        parent::_after();
    }

    public function testGetRelatedTableName()
    {
        $testCase = [
            [
                'mess' => 'simple name',
                'tableName' => 'table',
                'result' => 'devgroup_table_conditions',
            ],
            [
                'mess' => 'table name with prefix',
                'tableName' => '{{%table}}',
                'result' => 'devgroup_' . \Yii::$app->db->tablePrefix . 'table_conditions',
            ],
        ];
        foreach ($testCase as $case) {
            $this->specify(
                $case['mess'],
                function () use ($case) {
                    $this->assertEquals($case['result'], ConditionHelper::getRelatedTableName($case['tableName']));
                }
            );
        }
    }
}
