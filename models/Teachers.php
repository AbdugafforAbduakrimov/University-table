<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "teachers".
 *
 * @property int $id
 * @property string $full_name
 * @property string|null $phone_number
 * @property int|null $status
 * @property string|null $created_date
 */
class Teachers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'teachers';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['full_name'], 'required'],
            [['status'], 'integer'],
            [['created_date'], 'safe'],
            [['full_name'], 'string', 'max' => 100],
            [['phone_number'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'full_name' => 'F.I.SH',
            'phone_number' => 'Telefon raqam',
            // 'status' => 'Status',
            'created_date' => 'Kiritilgan sana',
        ];
    }
}
