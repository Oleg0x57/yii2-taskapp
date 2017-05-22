<?php

namespace app\models;


interface CommentSearchInterface
{
    /**
     * @param array $params
     * @return mixed
     */
    public function search($params);
}