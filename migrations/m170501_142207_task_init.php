<?php

use yii\db\Migration;

class m170501_142207_task_init extends Migration
{
    public function safeUp()
    {
        $this->createTable('task', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'description' => $this->text(),
            'date_start' => $this->dateTime(),
            'date_finish' => $this->dateTime(),
            'duration' => $this->integer()->defaultValue(0),
            'status' => $this->integer()->defaultValue(0),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('task');
        return true;
    }
}
