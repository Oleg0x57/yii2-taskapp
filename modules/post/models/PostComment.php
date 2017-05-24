<?php

namespace app\modules\post\models;

use app\modules\comment\interfaces\CommentInterface;
use Yii;

/**
 * This is the model class for table "post_comment".
 *
 * @property integer $id
 * @property string $message
 * @property string $date
 * @property integer $post_id
 * @property integer $status
 *
 * @property Post $post
 */
class PostComment extends \yii\db\ActiveRecord implements CommentInterface
{
    const STATUS_DRAFT = 0;
    const STATUS_MODERATED = 1;

    static $statuses = [
        0 => 'На проверке',
        1 => 'Опубликован',
    ];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'post_comment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['message', 'post_id'], 'required'],
            [['date'], 'safe'],
            [['post_id', 'status'], 'integer'],
            [['message'], 'string', 'max' => 255],
            [
                ['post_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Post::className(),
                'targetAttribute' => ['post_id' => 'id']
            ],
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
            'post_id' => 'Post ID',
            'status' => 'Статус',
        ];
    }

    /**
     * @return bool
     */
    public function publish()
    {
        $this->status = self::STATUS_MODERATED;
        return $this->save();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPost()
    {
        return $this->hasOne(Post::className(), ['id' => 'post_id']);
    }
}
