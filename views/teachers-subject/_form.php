<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Teachers;
use app\models\Groups;
use app\models\Rooms;
use app\models\Subjects;

/* @var $this yii\web\View */
/* @var $model app\models\TeachersSubject */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="teachers-subject-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'teachers_id')->dropDownList(ArrayHelper::map(Teachers::find()->all(), 'id', 'full_name'),['prompt'=>'O`qituvchini tanlang']) ?>


    <?= $form->field($model, 'subjects_id')->dropDownList(ArrayHelper::map(Subjects::find()->all(), 'id', 'title'),['prompt'=>'Fan tanlang']) ?>


    <?= $form->field($model, 'rooms_id')->dropDownList(ArrayHelper::map(Rooms::find()->all(), 'id', 'number'),['prompt'=>'Xona tanlang']) ?>


    <?= $form->field($model, 'group_id')->dropDownList(ArrayHelper::map(Groups::find()->all(), 'id', 'title'),['prompt'=>'Guruh tanlang']) ?>


    <?
        $a= [
            '1' => '1 - para', 
            '2' => '2 - para',
            '3' => '3 - para',
            '4' => '4 - para',
            '5' => '5 - para',
            '6' => '6 - para',
            '7' => '7 - para'
        ];
        echo Html::activeDropDownList($model, 'pair', $a, ['class' => 'form-control'])." <br>";
    ?>


    <?
        $a= [
            '1' => 'Dushanba', 
            '2' => 'Seshanba',
            '3' => 'Chorshanba',
            '4' => 'Payshanba',
            '5' => 'Juma',
            '6' => 'Shanba'
            // '7' => 'Yakshanba',
        ];
        echo Html::activeDropDownList($model, 'lesson_date', $a, ['class' => 'form-control'])."<br>" ;
    ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
