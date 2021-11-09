<?php

namespace app\controllers;

use Yii;

use app\models\TeachersSubject;
use app\models\Teachers;
use app\models\Groups;
use app\models\Rooms;
use app\models\Subjects;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TeachersSubjectController implements the CRUD actions for TeachersSubject model.
 */
class TeachersSubjectController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all TeachersSubject models.
     * @return mixed
     */
    public function actionIndex()
    {
        $sql = "
            SELECT  
              ts.pair as pair, 
              r.title as room, 
              ts.rooms_id, 
              ts.subjects_id, 
              s.title as subject,
              g.id as group_id,
              g.title as groups,
              ts.group_id,
              ts.lesson_date,
              t.full_name as teacher
            FROM teachers_subject AS ts 
            INNER JOIN rooms AS r ON ts.rooms_id = r.id 
            INNER JOIN subjects AS s ON s.id = ts.subjects_id
            INNER JOIN groups AS g ON ts.group_id = g.id 
            INNER JOIN teachers AS t ON ts.teachers_id = t.id 
            ORDER BY ts.pair ASC
        ";

        $command = Yii::$app->db->createCommand($sql)->queryAll();

        // echo "<pre>";
        // print_r($command);
        // die();
        $model = Groups::find()->all();
        $week = [1 => 'Dushanba', 2=> 'Seshanba', 3=>'Chorshanba', 4=>'Payshanba', 5=>'Juma', 6=>"Shanba"];

        $arr = [];
        $aaaa = [];
        if (isset($command) && !empty($command)) {
            $con = 0;
            for ($d = 1; $d <= 6; $d++) {
                if (isset($d) && isset($command[$con]['lesson_date']) && $d == $command[$con]['lesson_date']) {
                    $aaaa[$week[$d]][$command[$con]['group_id']][$command[$con]['pair']]['room'] = $command[$con]['room'];
                    $aaaa[$week[$d]][$command[$con]['group_id']][$command[$con]['pair']]['subject'] = $command[$con]['subject'];
                    $aaaa[$week[$d]][$command[$con]['group_id']][$command[$con]['pair']]['teacher'] = $command[$con]['teacher'];
                    $aaaa[$week[$d]][$command[$con]['group_id']][$command[$con]['pair']]['group_id'] = $command[$con]['group_id'];

                    $con++;
                    if (isset($d) && isset($command[$con]['lesson_date']) && $d == $command[$con]['lesson_date']) {
                        $aaaa[$week[$d]][$command[$con]['group_id']][$command[$con]['pair']]['room'] = $command[$con]['room'];
                        $aaaa[$week[$d]][$command[$con]['group_id']][$command[$con]['pair']]['subject'] = $command[$con]['subject'];
                        $aaaa[$week[$d]][$command[$con]['group_id']][$command[$con]['pair']]['teacher'] = $command[$con]['teacher'];
                        $aaaa[$week[$d]][$command[$con]['group_id']][$command[$con]['pair']]['group_id'] = $command[$con]['group_id'];
                        $con++;
                        if (isset($d) && isset($command[$con]['lesson_date']) && $d == $command[$con]['lesson_date']) {
                            $d = $d - 1;
                        }
                    }
                } 
                else {
                    $aaaa[$week[$d]] = [];
                }
            }
        } else {
            for ($g=0; $g <= 6; $g++) { 
                $aaaa[$week[$g]] = [];
            }
        }

        // echo "<pre>";
        // print_r($aaaa);
        // die();
        // echo $week[$d]
        $groups = Groups::find()->all();
        $time_arr = [];
        if (isset($groups) && !empty($groups)) {
            foreach ($groups as $group) {
                $time_arr[$group->id] = $group->title;
            }
        }
        $groups = $time_arr;


        $teachers = Teachers::find()->all();
        $time_arr = [];
        if (isset($teachers) && !empty($teachers)) {
            foreach ($teachers as $teacher) {
                $time_arr[$teacher->id] = $teacher->full_name;
            }
        }
        $teachers = $time_arr;


        $rooms = Rooms::find()->all();
        $time_arr = [];
        if (isset($rooms) && !empty($rooms)) {
            foreach ($rooms as $room) {
                $time_arr[$room->id] = $room->title;
            }
        }
        $rooms = $time_arr;



        $subjects = Subjects::find()->all();
        $time_arr = [];
        if (isset($subjects) && !empty($subjects)) {
            foreach ($subjects as $subject) {
                $time_arr[$subject->id] = $subject->title;
            }
        }
        $subjects = $time_arr;

        // echo "<pre>";
        // print_r($aaaa);
        // die();

        return $this->render('index_2', [
            'command' => $aaaa,
            'model' => $model,
            'subjects' => $subjects,
            'rooms' => $rooms,
            'teachers' => $teachers,
            'groups' => $groups,
        ]);
    }



    public function actionFilter()
    {
        if (Yii::$app->request->isAjax) {
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

            $error = [];
            $part_sql = ' WHERE  ';
            if (!empty($_GET['teachers'])) {
                $teachers_id = $_GET['teachers'];
                $part_sql .= ' ts.teachers_id = '.$teachers_id;

            }
            else{
                $part_sql .= ' ts.id IS NOT NULL';
                $error[] = 'teacher_error';
            }

            if(isset($_GET['groups']) && !empty($_GET['groups'])){
                $groups_id = $_GET['groups'];
                $part_sql .= ' AND ts.group_id = '.$groups_id;
            }
            else{
                $part_sql .= ' AND ts.id IS NOT NULL';
                $error[] = 'group_error';
            }

            if(isset($_GET['subjects']) && !empty($_GET['subjects'])){
                $subjects_id = $_GET['subjects'];
                $part_sql .= ' AND ts.subjects_id = '.$subjects_id ;
            }
            else{
                $part_sql .= ' AND ts.id IS NOT NULL';
                $error[] = 'subject_error';
            }


            if(isset($_GET['rooms']) && !empty($_GET['rooms'])){
                $rooms_id = $_GET['rooms'];
                $part_sql .= ' AND ts.rooms_id = '.$rooms_id;
            }
            else{
                $part_sql .= ' AND ts.id IS NOT NULL';
                $error[] = 'room_error';
            }
            // if(empty($error)){
                $sql = "
                    SELECT  
                      ts.pair as pair, 
                      r.title as room, 
                      ts.rooms_id, 
                      ts.subjects_id, 
                      s.title as subject,
                      g.id as group_id,
                      g.title as groups,
                      ts.group_id,
                      ts.lesson_date,
                      t.full_name as teacher
                    FROM teachers_subject AS ts 
                    INNER JOIN rooms AS r ON ts.rooms_id = r.id 
                    INNER JOIN subjects AS s ON s.id = ts.subjects_id
                    INNER JOIN groups AS g ON ts.group_id = g.id 
                    INNER JOIN teachers AS t ON ts.teachers_id = t.id
                    ".$part_sql." ORDER BY ts.pair ASC";

                // echo $sql;
                // die();
                $command = Yii::$app->db->createCommand($sql)->queryAll();

                if(!empty($_GET['groups_id'])){
                    $model = Groups::find()->where(['id' => $groups_id])->all();
                }
                else{
                    $model = Groups::find()->all();   
                }
                $week = [1 => 'Dushanba', 2=> 'Seshanba', 3=>'Chorshanba', 4=>'Payshanba', 5=>'Juma', 6=>"Shanba"];

                $arr = [];
                $aaaa = [];
                if (isset($command) && !empty($command)) {
                    $con = 0;
                    for ($d = 1; $d <= 6; $d++) {
                        if (isset($d) && isset($command[$con]['lesson_date']) && $d == $command[$con]['lesson_date']) {
                            $aaaa[$week[$d]][$command[$con]['group_id']][$command[$con]['pair']]['room'] = $command[$con]['room'];
                            $aaaa[$week[$d]][$command[$con]['group_id']][$command[$con]['pair']]['subject'] = $command[$con]['subject'];
                            $aaaa[$week[$d]][$command[$con]['group_id']][$command[$con]['pair']]['teacher'] = $command[$con]['teacher'];
                            $aaaa[$week[$d]][$command[$con]['group_id']][$command[$con]['pair']]['group_id'] = $command[$con]['group_id'];

                            $con++;
                            if (isset($d) && isset($command[$con]['lesson_date']) && $d == $command[$con]['lesson_date']) {
                                $aaaa[$week[$d]][$command[$con]['group_id']][$command[$con]['pair']]['room'] = $command[$con]['room'];
                                $aaaa[$week[$d]][$command[$con]['group_id']][$command[$con]['pair']]['subject'] = $command[$con]['subject'];
                                $aaaa[$week[$d]][$command[$con]['group_id']][$command[$con]['pair']]['teacher'] = $command[$con]['teacher'];
                                $aaaa[$week[$d]][$command[$con]['group_id']][$command[$con]['pair']]['group_id'] = $command[$con]['group_id'];
                                $con++;
                                if (isset($d) && isset($command[$con]['lesson_date']) && $d == $command[$con]['lesson_date']) {
                                    $d = $d - 1;
                                }
                            }
                        } 
                        else {
                            $aaaa[$week[$d]] = [];
                        }
                    }
                } else {
                    for ($g=0; $g <= 6; $g++) { 
                        $aaaa[$week[$g]] = [];
                    }
                }
                
                // echo "<pre>";
                // print_r($aaaa);
                // die();
            // }
            
            return [
                'status' => 'success',
                'content' => $this->renderAjax('filter.php', [
                    'command' => $aaaa,
                    'model' => $model
                ]),
            ];            

        }
    }



    public function actionInfo()
    {
        if (Yii::$app->request->isAjax) {
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

            // echo "<pre>";
            // print_r($_GET);
            // die();

            $sql = "
                SELECT 
                    t.full_name as teacher,
                    s.title as subject,
                    r.title as room,
                    r.number as room_num,
                    r.title as room,
                    g.title as groups,
                    ts.pair as pair
                FROM teachers_subject AS ts
                INNER JOIN teachers AS t on t.id = ts.teachers_id
                INNER JOIN subjects AS s on s.id = ts.subjects_id
                INNER JOIN rooms AS r on r.id = ts.rooms_id
                INNER JOIN groups AS g on g.id = ts.group_id
                WHERE s.title = '".$_GET['subject']."' AND t.full_name = '".$_GET['teacher']."' AND ts.pair = ".$_GET['pair'];

            $query = Yii::$app->db->createCommand($sql)
            ->queryOne();
            
            return [
                'status' => 'success',
                'content' => $this->renderAjax('info.php', [
                    'query' => $query
                ]),
            ];            

        }
    }


  
    /**
     * Displays a single TeachersSubject model.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new TeachersSubject model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TeachersSubject();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $sql = "SELECT * FROM teachers_subject WHERE pair = ".$model->pair." AND lesson_date = ".$model->lesson_date." AND group_id = ".$model->group_id;
                // echo $sql;
                // die();
                $query = Yii::$app->db->createCommand($sql)->queryAll();
                if(!(isset($query) && !empty($query))){
                    $model->save();
                    return $this->redirect(['index', 'id' => $model->id]);
                }
                $message = "Haftaning bu kunida juftlikda dars mavjud!";
                $model->addError('lesson_date', $message);
                return $this->render('create', [
                    'model' => $model
                ]);

            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing TeachersSubject model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing TeachersSubject model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TeachersSubject model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return TeachersSubject the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TeachersSubject::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
