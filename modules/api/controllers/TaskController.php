<?php

namespace app\modules\api\controllers;


use yii\rest\ActiveController;

class TaskController extends ActiveController
{
    public $modelClass = 'app\modules\task\models\Task';
}