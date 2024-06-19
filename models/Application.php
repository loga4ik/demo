<?php

namespace app\models;

use Yii;
use yii\db\Query;
use yii\helpers\VarDumper;

/**
 * This is the model class for table "application".
 *
 * @property int $id
 * @property int $user_id
 * @property int $department_id
 * @property int $status_id
 * @property string $description
 * @property string $date
 * @property string $created_at
 *
 * @property Department $department
 * @property Status $status
 * @property User $user
 */
class Application extends \yii\db\ActiveRecord
{
    public $time;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'application';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'department_id', 'status_id', 'description', 'date', 'time'], 'required'],
            [['user_id', 'department_id', 'status_id'], 'integer'],
            [['description'], 'string', 'min' => 20],
            [['date', 'created_at'], 'safe'],
            [['department_id'], 'exist', 'skipOnError' => true, 'targetClass' => Department::class, 'targetAttribute' => ['department_id' => 'id']],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => Status::class, 'targetAttribute' => ['status_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => '№',
            'user_id' => 'ФИО',
            'department_id' => 'отдел',
            'status_id' => 'статус',
            'description' => 'описание',
            'date' => 'Дата приема',
            'created_at' => 'Дата создания',
        ];
    }

    /**
     * Gets query for [[Department]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDepartment()
    {
        return $this->hasOne(Department::class, ['id' => 'department_id']);
    }

    /**
     * Gets query for [[Status]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(Status::class, ['id' => 'status_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
    public function validateDate()
    {
        $target = (new Query())
            ->from('application')
            ->where(['date' => $this->date])
            ->andWhere(['department_id' => $this->department_id])
            ->andWhere(['in', 'status_id', ['2', '3']])
            ->count();
        if ($target) {
            $this->addError('time', 'Это время у отдела уже занято');
            # code...
            return false;
        }
        return true;
    }
}
