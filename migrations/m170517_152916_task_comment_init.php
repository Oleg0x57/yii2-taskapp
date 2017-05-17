<?php

use yii\db\Migration;

class m170517_152916_task_comment_init extends Migration
{
    public function safeUp()
    {
        $this->createTable('task_comment', [
            'id' => $this->primaryKey(),
            'message' => $this->string()->notNull(),
            'date' => $this->dateTime()->defaultExpression('NOW()'),
            'task_id' => $this->integer()->notNull(),
        ]);
        $this->addForeignKey('fk_task_comment_task_id', 'task_comment', 'task_id', 'task', 'id');
    }

    public function safeDown()
    {
        $this->dropTable('task_comment');
        return true;
    }
}
