<?php

namespace app\models;


interface CommentableInterface
{
    public function addComment($comment);

    public function getComments();

    public function getId();
}