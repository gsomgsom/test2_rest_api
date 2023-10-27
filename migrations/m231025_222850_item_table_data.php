<?php

use yii\db\Migration;

class m231025_222850_item_table_data extends Migration
{
    public function safeUp()
    {
        $this->insert('{{%item}}', [
            'id' => 1,
            'name' => 'test 1',
            'description' => 'test 1 description',
            'price' => 11.11,
        ]);

        $this->insert('{{%item}}', [
            'id' => 2,
            'name' => 'test 2',
            'description' => 'test 2 description',
            'price' => 22.22,
        ]);

        $this->insert('{{%item}}', [
            'id' => 3,
            'name' => 'test 3',
            'description' => 'test 3 description',
            'price' => 33.33,
        ]);

        $this->insert('{{%item}}', [
            'id' => 4,
            'name' => 'test 4',
            'description' => 'test 4 description',
            'price' => 44.44,
        ]);
    }

    public function safeDown()
    {
        $this->truncateTable('{{%item}}');
    }
}
