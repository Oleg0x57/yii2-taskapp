<?php

use yii\db\Migration;

class m170910_074202_user_init extends Migration
{
    public function safeUp()
    {
        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'email' => $this->string(),
            'password' => $this->string(),
            'auth_key' => $this->string()->unique(),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('user');
        return true;
    }
}
