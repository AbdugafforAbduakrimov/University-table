<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Teachers Subjects';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teachers-subject-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Teachers Subject', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'teachers_id',
            'subjects_id',
            'rooms_id',
            'group_id',
            //'pair',
            //'lesson_date',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
