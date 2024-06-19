<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "feedback".
 *
 * @property int $id
 * @property string $full_name
 * @property string $phone
 * @property string $text
 * @property string $image
 */
class Feedback extends \yii\db\ActiveRecord
{
    public $imageFile;
    public $agree;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'feedback';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['full_name', 'phone', 'text', 'image'], 'required'],
            [['full_name', 'phone', 'image'], 'string', 'max' => 255],
            [['text'], 'string', 'min' => 20],
            ['full_name', 'match', 'pattern' => '/^(?=.*[А-ЯЁ]).+[а-яё\-]+\s[а-яё\-]+\s[а-яё\-\s]+$/u'],
            ['text', 'match', 'pattern' => '/^[а-яё\s\-]+$/ui'],
            ['agree', 'required', 'requiredValue' => true],
            ['phone', 'match', 'pattern' => '/^\+7\(\d{3}\)\-\d{3}\-\d{2}\-\d{2}$/'],
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'jpeg, jpg, png'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'full_name' => 'ФИО',
            'phone' => 'Телефон',
            'text' => 'Отзыв',
            'imageFile' => 'Фото',
            'agree' => 'Согласие на обработку персональных данных',
        ];
    }
    public function upload()
    {
        $this->image =  Yii::$app->security->generateRandomString() . '.' . $this->imageFile->extension;
        if ($this->validate()) {
            $this->imageFile->saveAs('uploads/' . $this->image);
            return true;
        } else {
            return false;
        }
    }
}
