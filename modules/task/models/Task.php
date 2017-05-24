<?php

namespace app\modules\task\models;
use app\modules\comment\interfaces\CommentableInterface;

use Yii;

/**
 * This is the model class for table "task".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property string $date_start
 * @property string $date_finish
 * @property integer $duration
 * @property integer $status
 *
 * @property TaskComment[] $comments
 */
class Task extends \yii\db\ActiveRecord implements CommentableInterface
{
    const STATUS_WAIT = 0;
    const STATUS_PROCESS = 1;
    const STATUS_FINISH = 2;

    static $statuses = [
        0 => 'Ожидает',
        1 => 'В работе',
        2 => 'Завершена',
    ];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'task';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['description'], 'string'],
            [['date_start', 'date_finish'], 'safe'],
            [['duration', 'status'], 'integer'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Заголовок',
            'description' => 'Описание',
            'date_start' => 'Дата начала работы',
            'date_finish' => 'Дата завершения',
            'duration' => 'Длительность',
            'status' => 'Статус',
        ];
    }

    /**
     * @return bool
     */
    public function stop()
    {
        $this->status = self::STATUS_WAIT;
        $this->duration += time() - strtotime($this->date_start);
        return $this->save();
    }

    /**
     * @return bool
     */
    public function start()
    {
        $this->status = self::STATUS_PROCESS;
        $this->date_start = date('Y-m-d H:i:s');
        return $this->save();
    }

    /**
     * @return bool
     */
    public function finish()
    {
        $this->status = self::STATUS_FINISH;
        $this->date_finish = date('Y-m-d H:i:s');
        return $this->save();
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(TaskComment::className(), ['task_id' => 'id']);
    }

    /**
     * @param $comment
     */
    public function addComment($comment)
    {
        $this->link('comments', $comment);
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
}
