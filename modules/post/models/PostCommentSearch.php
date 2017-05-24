<?php

namespace app\modules\post\models;

use app\modules\comment\interfaces\CommentableInterface;
use app\modules\comment\interfaces\CommentSearchInterface;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\post\models\PostComment;

/**
 * PostCommentSearch represents the model behind the search form about `app\models\PostComment`.
 */
class PostCommentSearch extends PostComment implements CommentSearchInterface
{
    /**
     * @param CommentableInterface $commentable
     */
    public function __construct(CommentableInterface $commentable)
    {
        parent::__construct();
        $this->post_id = $commentable->getId();
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'post_id', 'status'], 'integer'],
            [['message', 'date'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = PostComment::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'date' => $this->date,
            'post_id' => $this->post_id,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'message', $this->message]);

        return $dataProvider;
    }
}
