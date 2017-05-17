<?php

use yii\db\Migration;

class m170517_170242_blog_init extends Migration
{
    public function safeUp()
    {
        $this->createTable('post', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'text' => $this->text(),
            'date' => $this->dateTime()->defaultExpression('NOW()'),
            'status' => $this->integer()->defaultValue(0),
        ]);
        $this->createTable('post_comment', [
            'id' => $this->primaryKey(),
            'message' => $this->string()->notNull(),
            'date' => $this->dateTime()->defaultExpression('NOW()'),
            'post_id' => $this->integer()->notNull(),
            'status' => $this->integer()->defaultValue(0),
        ]);
        $this->addForeignKey('fk_post_comment_post_id', 'post_comment', 'post_id', 'post', 'id');
    }

    public function safeDown()
    {
        $this->dropTable('post_comment');
        $this->dropTable('post');
        return true;
    }
}
