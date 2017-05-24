<?php

namespace app\modules\task\models;

use Yii;
use app\modules\comment\interfaces\CommentInterface;

/**
 * This is the model class for table "task_comment".
 *
 * @property integer $id
 * @property string $message
 * @property string $date
 * @property integer $task_id
 *
 * @property Task $task
 */
class TaskComment extends \yii\db\ActiveRecord implements CommentInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'task_comment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['message', 'task_id'], 'required'],
            [['date'], 'safe'],
            [['task_id'], 'integer'],
            [['message'], 'string', 'max' => 255],
            [['task_id'], 'exist', 'skipOnError' => true, 'targetClass' => Task::className(), 'targetAttribute' => ['task_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'message' => 'Комментарий',
            'date' => 'Дата',
            'task_id' => 'Task ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTask()
    {
        return $this->hasOne(Task::className(), ['id' => 'task_id']);
    }
}
