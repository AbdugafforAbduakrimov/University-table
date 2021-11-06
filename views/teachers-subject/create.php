<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TeachersSubject */

$this->title = 'Create Teachers Subject';
$this->params['breadcrumbs'][] = ['label' => 'Teachers Subjects', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teachers-subject-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
