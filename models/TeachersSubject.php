<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "teachers_subject".
 *
 * @property int $id
 * @property int|null $teachers_id
 * @property int|null $subjects_id
 * @property int|null $rooms_id
 * @property int|null $group_id
 * @property int|null $pair
 * @property string|null $lesson_date
 */
class TeachersSubject extends \yii\db\ActiveRecord
{
    // public $pair;
    // public $lesson_date;

    public static function tableName()
    {
        return 'teachers_subject';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['teachers_id', 'subjects_id', 'rooms_id', 'group_id', 'pair'], 'integer'],
            [['lesson_date'], 'safe'],
        ];

    }


    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'teachers_id' => 'Oqituvchilar',
            'subjects_id' => 'Fanlar',
            'rooms_id' => 'Xonalar',
            'group_id' => 'Guruhlar',
            'pair' => 'Juftliklar',
            'lesson_date' => 'Hafta kuni',
        ];
    }


    public function getTeacher()
    {
        return $this->hasOne(Teachers::className(), ['id' => 'teachers_id']);
    }


    public function getGroup()
    {
        return $this->hasOne(Groups::className(), ['id' => 'group_id']);
    }

    public function getRoom()
    {
        return $this->hasOne(Rooms::className(), ['id' => 'rooms_id']);
    }


    public function getSubject()
    {
        return $this->hasOne(Subject::className(), ['id' => 'subjects_id']);
    }
}
