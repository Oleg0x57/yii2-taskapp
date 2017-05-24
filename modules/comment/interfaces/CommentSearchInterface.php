<?php

namespace app\modules\comment\interfaces;


interface CommentSearchInterface
{
    /**
     * @param array $params
     * @return mixed
     */
    public function search($params);
}