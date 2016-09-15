<?php


namespace tests\codeception\unit\behaviors;

use Codeception\Test\Unit;
use DevGroup\Conditions\models\Condition;
use DevGroup\Conditions\Tests\codeception\fixtures\ConditionFixture;
use DevGroup\Conditions\Tests\codeception\fixtures\TestModelConditionFixture;
use DevGroup\Conditions\Tests\codeception\fixtures\TestModelFixture;
use DevGroup\Conditions\Tests\handlers\TestFirstHandler;
use DevGroup\Conditions\Tests\handlers\TestSecondHandler;
use DevGroup\Conditions\Tests\models\TestModel;

class ConditionBehaviorTest extends Unit
{
    use \Codeception\Specify;
    /**
     * @var \UnitTester
     */
    protected $tester;

    protected function _before()
    {
        $this->tester->haveFixtures(
            [
                'testModels' => TestModelFixture::class,
                'conditions' => ConditionFixture::class,
                'testModelsConditions' => TestModelConditionFixture::class,
            ]
        );
        parent::_before();
    }

    public function testAttach()
    {
        $model = TestModel::findOne(1);
        $this->assertArrayHasKey('conditions', $model->behaviors);
    }

    public function testGetConditions()
    {
        $models = TestModel::find()->all();
        $this->specify(
            'Test models with first condition',
            function () use ($models) {
                $modelConditions = $models[0]->conditions;
                $this->assertCount(1, $modelConditions);
                $this->assertEquals(TestFirstHandler::class, $modelConditions[0]->handler_class_name);
                $modelConditions = $models[1]->conditions;
                $this->assertCount(1, $modelConditions);
                $this->assertEquals(TestFirstHandler::class, $modelConditions[0]->handler_class_name);
                $modelConditions = $models[2]->conditions;
                $this->assertCount(1, $modelConditions);
                $this->assertEquals(TestFirstHandler::class, $modelConditions[0]->handler_class_name);
            }
        );
        $this->specify(
            'Test models with second condition',
            function () use ($models) {
                $modelConditions = $models[3]->conditions;
                $this->assertCount(1, $modelConditions);
                $this->assertEquals(TestSecondHandler::class, $modelConditions[0]->handler_class_name);
                $modelConditions = $models[4]->conditions;
                $this->assertCount(1, $modelConditions);
                $this->assertEquals(TestSecondHandler::class, $modelConditions[0]->handler_class_name);
                $modelConditions = $models[5]->conditions;
                $this->assertCount(1, $modelConditions);
                $this->assertEquals(TestSecondHandler::class, $modelConditions[0]->handler_class_name);
            }
        );
        $this->specify(
            'Test models with first and second conditions',
            function () use ($models) {
                $modelConditions = $models[6]->conditions;
                $this->assertCount(2, $modelConditions);
                $this->assertEquals(TestFirstHandler::class, $modelConditions[0]->handler_class_name);
                $this->assertEquals(TestSecondHandler::class, $modelConditions[1]->handler_class_name);
                $modelConditions = $models[7]->conditions;
                $this->assertCount(2, $modelConditions);
                $this->assertEquals(TestFirstHandler::class, $modelConditions[0]->handler_class_name);
                $this->assertEquals(TestSecondHandler::class, $modelConditions[1]->handler_class_name);
                $modelConditions = $models[8]->conditions;
                $this->assertCount(2, $modelConditions);
                $this->assertEquals(TestFirstHandler::class, $modelConditions[0]->handler_class_name);
                $this->assertEquals(TestSecondHandler::class, $modelConditions[1]->handler_class_name);
                $modelConditions = $models[9]->conditions;
                $this->assertCount(2, $modelConditions);
                $this->assertEquals(TestFirstHandler::class, $modelConditions[0]->handler_class_name);
                $this->assertEquals(TestSecondHandler::class, $modelConditions[1]->handler_class_name);
            }
        );
        $this->specify(
            'Test models with no conditions',
            function () use ($models) {
                $modelConditions = $models[10]->conditions;
                $this->assertCount(0, $modelConditions);
            }
        );
    }

    public function testGetChecks()
    {
        $models = TestModel::find()->all();
        $this->specify(
            'Test models with first condition',
            function () use ($models) {
                $modelChecks = $models[0]->checks;
                $this->assertCount(1, $modelChecks);
                $this->assertInstanceOf(TestFirstHandler::class, $modelChecks[0]);
                $modelChecks = $models[1]->checks;
                $this->assertCount(1, $modelChecks);
                $this->assertInstanceOf(TestFirstHandler::class, $modelChecks[0]);
                $modelChecks = $models[2]->checks;
                $this->assertCount(1, $modelChecks);
                $this->assertInstanceOf(TestFirstHandler::class, $modelChecks[0]);
            }
        );
        $this->specify(
            'Test models with second condition',
            function () use ($models) {
                $modelChecks = $models[3]->checks;
                $this->assertCount(1, $modelChecks);
                $this->assertInstanceOf(TestSecondHandler::class, $modelChecks[0]);
                $modelChecks = $models[4]->checks;
                $this->assertCount(1, $modelChecks);
                $this->assertInstanceOf(TestSecondHandler::class, $modelChecks[0]);
                $modelChecks = $models[5]->checks;
                $this->assertCount(1, $modelChecks);
                $this->assertInstanceOf(TestSecondHandler::class, $modelChecks[0]);
            }
        );
        $this->specify(
            'Test models with first and second conditions',
            function () use ($models) {
                $modelChecks = $models[6]->checks;
                $this->assertCount(2, $modelChecks);
                $this->assertInstanceOf(TestFirstHandler::class, $modelChecks[0]);
                $this->assertInstanceOf(TestSecondHandler::class, $modelChecks[1]);
                $modelChecks = $models[7]->checks;
                $this->assertCount(2, $modelChecks);
                $this->assertInstanceOf(TestFirstHandler::class, $modelChecks[0]);
                $this->assertInstanceOf(TestSecondHandler::class, $modelChecks[1]);
                $modelChecks = $models[8]->checks;
                $this->assertCount(2, $modelChecks);
                $this->assertInstanceOf(TestFirstHandler::class, $modelChecks[0]);
                $this->assertInstanceOf(TestSecondHandler::class, $modelChecks[1]);
                $modelChecks = $models[9]->checks;
                $this->assertCount(2, $modelChecks);
                $this->assertInstanceOf(TestFirstHandler::class, $modelChecks[0]);
                $this->assertInstanceOf(TestSecondHandler::class, $modelChecks[1]);
            }
        );
        $this->specify(
            'Test models with no conditions',
            function () use ($models) {
                $modelChecks = $models[10]->checks;
                $this->assertCount(0, $modelChecks);
            }
        );
    }

    public function testCheckConditions()
    {
        $models = TestModel::find()->all();
        $this->specify(
            'Test one right condition',
            function () use ($models) {
                $this->assertTrue($models[0]->checkConditions(1));
                $this->assertTrue($models[1]->checkConditions(2));
                $this->assertTrue($models[2]->checkConditions(3));
                $this->assertTrue($models[3]->checkConditions(1));
                $this->assertTrue($models[4]->checkConditions(2));
                $this->assertTrue($models[5]->checkConditions(3));
            }
        );
        $this->specify(
            'Test one wrong condition',
            function () use ($models) {
                $this->assertFalse($models[0]->checkConditions(0));
                $this->assertFalse($models[1]->checkConditions(1));
                $this->assertFalse($models[2]->checkConditions(2));
                $this->assertFalse($models[3]->checkConditions(4));
                $this->assertFalse($models[4]->checkConditions(5));
                $this->assertFalse($models[5]->checkConditions(6));
            }
        );
        $this->specify(
            'Test two right conditions',
            function () use ($models) {
                $this->assertTrue($models[6]->checkConditions(8));
                $this->assertTrue($models[7]->checkConditions(10));
                $this->assertTrue($models[8]->checkConditions(11));
            }
        );
        $this->specify(
            'Test first condition is wrong but second is right',
            function () use ($models) {
                $this->assertFalse($models[6]->checkConditions(13));
                $this->assertFalse($models[7]->checkConditions(14));
                $this->assertFalse($models[8]->checkConditions(15));
                $this->assertFalse($models[9]->checkConditions(16));
            }
        );
        $this->specify(
            'Test second condition is wrong but first is right',
            function () use ($models) {

                $this->assertFalse($models[7]->checkConditions(11));
                $this->assertFalse($models[8]->checkConditions(13));
                $this->assertFalse($models[9]->checkConditions(14));
            }
        );
        $this->specify(
            'Test first condition is wrong and second is wrong',
            function () use ($models) {
                $this->assertFalse($models[6]->checkConditions(11));
                $this->assertFalse($models[7]->checkConditions(12));
                $this->assertFalse($models[8]->checkConditions(14));
            }
        );
    }

    protected function _after()
    {
        parent::_after();
    }
}
