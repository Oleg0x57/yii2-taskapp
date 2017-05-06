<?php

namespace app\models;

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
 */
class Task extends \yii\db\ActiveRecord
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
}