
<?php 
use app\models\Sections;
use kartik\datetime\DateTimePicker;
use kartik\select2\Select2;
use yii\helpers\Html;
 ?>



<div class="container">

    <p>
        <?= Html::a('Jadvalga yangi dars biriktirish', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <div class="row">
        <div class="col-md-2">
            <label for="category">Fanlar</label>
            <?= Select2::widget([
                'name' => 'subjects',
                'data' => $subjects,
                'size' => Select2::MEDIUM,
                'options' => [
                    'required' => true,
                    'id' => 'subjects',
                    'placeholder' => 'Fam tanlang'
                ],
                'pluginOptions' => [],
            ]) ?>
        </div>
        <div class="col-md-2">
            <label for="category">Oqituvchilar</label>
            <?= Select2::widget([
                'name' => 'teachers',
                'data' => $teachers,
                'size' => Select2::MEDIUM,
                'options' => [
                    'required' => true,
                    'id' => 'teachers',
                    'placeholder' => 'O`qituvchi tanlang'
                ],
                'pluginOptions' => [],
            ]) ?>
        </div>
        <div class="col-md-2">
            <label for="category">Xonalar</label>
            <?= Select2::widget([
                'name' => 'rooms',
                'data' => $rooms,
                'size' => Select2::MEDIUM,
                'options' => [
                    'required' => true,
                    'id' => 'rooms',
                    'placeholder' => 'Xona tanlang'
                ],
                'pluginOptions' => [],
            ]) ?>
        </div>
        <div class="col-md-2">
            <label for="category">Guruhlar</label>
            <?= Select2::widget([
                'name' => 'groups',
                'data' => $groups,
                'size' => Select2::MEDIUM,
                'options' => [
                    'required' => true,
                    'id' => 'groups',
                    'placeholder' => 'Guruh tanlang'
                ],
                'pluginOptions' => [],
            ]) ?>
        </div>
        <div class="col-md-2">
            <center>
                <button style="margin-top: 22px;" class=" filter btn btn-success">Filter</button>
            </center>
        </div>
    </div>

<style type="text/css">
    .container{
        overflow: auto;
    }
</style>

	<table style="margin-top: 50px;" class="table sort_table table-bordered border-striped" id="month_table" style="margin-top: 15px">
        <tr>
            <th>Hafta kunlari \ Guruhlar</th>
            <?php
            $arr = [];
            
            foreach ($model as $key => $value) {
                echo "<th>" . $value->title . " - guruh</th>";
                $arr[] = $value->id;
            }
            ?>
        </tr>
        <?php
        // $current_date = date('Y-m-d');
        if (isset($command) && !empty($command)) {
            foreach ($command as $key => $value) {
                $i = 0;
                echo "<tr>";
                echo "<td>" . $key . "</td>";
                $time = $key;
                if (!empty($value)) {
                    $yes = 0;
                    foreach ($value as $teamKey => $teamValue) {
                        if (isset($teamKey) && isset($arr[$i]) && $teamKey == $arr[$i]) {
                            $yes++;     
                            $i++;
                                echo "<td>";
                            foreach ($teamValue as $key11 => $teamValue1) {
                                echo "<span pair='".$key11."' teacher='".$teamValue1['teacher']."' subject='".$teamValue1['subject']."' data-toggle='modal' data-target='#modal-default' style='cursor: pointer;'  class='view label label-primary'>".$key11."- para | ".$teamValue1['subject']." - fan | ".$teamValue1['teacher']." - o`qituvchi</span><br>";
                            }
                                echo "</td>";
                        } else {
                            $i = 0;
                            for ($t = 0; $t <= count($arr); $t++) {
                                $yes++;
                                if (isset($teamKey) && isset($arr[$i]) && $teamKey == $arr[$i]) {
                                    echo "<td>";
                                    foreach ($teamValue as $key11 => $teamValue1) {
                                         echo "<span pair='".$key11."' teacher='".$teamValue1['teacher']."' subject='".$teamValue1['subject']."' data-toggle='modal' data-target='#modal-default' style='cursor: pointer;' class='view label label-primary'>".$key11."- para | ".$teamValue1['subject']." - fan | ".$teamValue1['teacher']." - o`qituvchi</span><br>";
                                    }
                                    echo "</td>";
                                } else {
                                    if ($yes < count($arr)) {
                                        echo "<td></td>";
                                    }
                                }
                                $i++;
                            }
                        }
                    }
                    if ($yes < count($arr)) {
                        for ($y = $yes; $y < count($arr); $y++) {
                            echo "<td></td>";
                        }
                    }
                } else {
                    for ($t = 0; $t < count($arr); $t++) {
                        echo "<td></td>";
                    }
                }
                echo "</tr>";
            }
        } else {
            foreach ($command as $key => $value) {
                echo "<tr>";
                echo "<td>" . date('d-m-Y', strtotime($key)) . "</td>";
                echo "</tr>";
            }
        }

        ?>
    </table>
</div>
 

</div>



<?php

$js = <<<JS


    // open_modal
    $(document).on("click",".view",function(){
        $('#modal-default .modal-body').html(`<div class="overlay">
              <i class="fa fa-refresh fa-spin"></i>
            </div>`)
        let subject = $(this).attr("subject")
        let teacher = $(this).attr("teacher")
        let pair = $(this).attr("pair")
        $.ajax({
            url: 'info',
            dataType: 'json',
            type: 'GET',
            data:{
                pair: pair,
                subject: subject,
                teacher: teacher
            },
            success: function (response) {
                if (response.status == 'success') {
                    $('#modal-default .modal-body').html(response.content)
                    $('#modal-default .modal-header').html(response.header)
                }
            }
        });

    });


	$(document).on('click', '.filter', function() {
		// alert('ss')
		// die()
	  var groups = $('#groups').val();
	  var rooms = $('#rooms').val();
      var subjects = $('#subjects').val();
	  var teachers = $('#teachers').val();
	  $.ajax({	
	        url: 'filter',
	        data: {
	            teachers: teachers,
	            groups: groups,
	            rooms: rooms,
                subjects: subjects
	        },
	        type: 'get',
	        dataType: 'json',
	        success:function(response){
	            if(response.status == "success"){
		            $(".sort_table").empty()
		            $(".sort_table").html(response.content)	                
	            }
	            else{
	            	// location.reload();
	            	alert('Boshlanish va tugash sana kiritilishi kerak!')
	            }
	        }
	    })
	});



JS;
$this->registerJs($js);
?> 


