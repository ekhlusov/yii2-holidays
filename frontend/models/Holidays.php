<?php

namespace app\models;

use common\models\User;
use Yii;

/**
 * This is the model class for table "holidays".
 *
 * @property int $id
 * @property int $user_id Id сотрудника
 * @property string $date_start Дата начала отпуска
 * @property string $date_end Дата окончания отпуска
 * @property int $approved Подтверждение отпуска
 * @property int $created_at
 * @property int $updated_at
 *
 * @property User $user
 */
class Holidays extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'holidays';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'date_start', 'date_end'], 'required'],
            [['user_id', 'approved', 'created_at', 'updated_at'], 'integer'],
            [['date_start', 'date_end'], 'safe'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'Id сотрудника',
            'date_start' => 'Дата начала отпуска',
            'date_end' => 'Дата окончания отпуска',
            'approved' => 'Подтверждение отпуска',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
