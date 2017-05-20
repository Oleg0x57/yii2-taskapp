<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "post".
 *
 * @property integer $id
 * @property string $title
 * @property string $text
 * @property string $date
 * @property integer $status
 *
 * @property PostComment[] $comments
 */
class Post extends \yii\db\ActiveRecord implements CommentableInterface
{
    const STATUS_DRAFT = 0;
    const STATUS_PUBLISHED = 1;

    static $statuses = [
        0 => 'Черновик',
        1 => 'Опубликована',
    ];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'post';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['text'], 'string'],
            [['date'], 'safe'],
            [['status'], 'integer'],
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
            'text' => 'Текст',
            'date' => 'Дата публикации',
            'status' => 'Статус',
        ];
    }

    /**
     * @return bool
     */
    public function publish()
    {
        $this->status = self::STATUS_PUBLISHED;
        return $this->save();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(PostComment::className(), ['post_id' => 'id']);
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
