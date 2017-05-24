<?php

namespace app\modules\comment\interfaces;


interface CommentableInterface
{
    public function addComment($comment);

    public function getComments();

    public function getId();
}