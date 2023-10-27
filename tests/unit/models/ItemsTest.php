<?php
namespace Unit\models;

use app\models\Item;

class ItemsTest extends \Codeception\Test\Unit
{

    protected function _createTestItem()
    {
        $item = new Item();
        $item->name = 'Test item';
        $item->description = 'Test item description';
        $item->price = 5.99;
        return $item->save();
    }

    public function testCreateItem()
    {
        verify($this->_createTestItem())->true();
    }

    public function testCreateItemNotValid()
    {
        $item = new Item();
        verify($item->validate())->false();
    }

    public function testUpdateItem()
    {
        $this->_createTestItem();

        $item = Item::findOne(['name' => 'Test Item']);
        verify(isset($item))->true();

        $item->name = 'updated name';
        verify($item->save())->true();

        $updatedItem1 = Item::findOne(['name' => 'updated name']);
        verify(isset($updatedItem1))->true();

        $item->price = 88.88;
        verify($item->save())->true();

        $updatedItem2 = Item::findOne(['price' => 88.88]);
        verify(isset($updatedItem2))->true();
    }

    public function testDeleteItem()
    {
        $this->_createTestItem();

        $item = Item::findOne(['name' => 'Test Item']);
        verify($item->delete())->isInt();
    }

}
