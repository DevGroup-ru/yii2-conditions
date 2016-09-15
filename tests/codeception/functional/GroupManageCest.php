<?php


use DevGroup\Conditions\models\ConditionGroup;
use DevGroup\Conditions\Tests\codeception\fixtures\ConditionGroupFixture;

class GroupManageCest
{
    public function _before(FunctionalTester $I)
    {
        $I->haveFixtures(['groups' => ConditionGroupFixture::class]);
        $I->amOnPage(['conditions/manage-group/index']);
    }

    public function _after(FunctionalTester $I)
    {
    }


    public function create(FunctionalTester $I)
    {
        $I->see('Add group');
        $I->click(['class' => 'add-group']);
        $I->submitForm('#form-group', ['ConditionGroup[name]' => 'test-functional-group']);
        $I->seeRecord(ConditionGroup::class, ['name' => 'test-functional-group']);
    }

    /**
     * @depends create
     */
    public function update(FunctionalTester $I)
    {
        $I->click('edit');
        $I->submitForm('#form-group', ['ConditionGroup[name]' => 'test-functional-group-another']);
        $I->seeRecord(ConditionGroup::class, ['name' => 'test-functional-group-another']);
    }

    /**
     * @depends update
     */
    public function delete(FunctionalTester $I)
    {
        $I->click('delete');
        $I->dontSeeRecord(ConditionGroup::class, ['name' => 'test-functional-group-another']);
    }
}
