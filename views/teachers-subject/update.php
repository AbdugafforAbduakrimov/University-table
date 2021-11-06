<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TeachersSubject */

$this->title = 'Update Teachers Subject: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Teachers Subjects', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="teachers-subject-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
