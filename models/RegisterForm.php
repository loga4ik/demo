<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class RegisterForm extends Model
{
    public $full_name;
    public $login;
    public $email;
    public $phone;
    public $password;
    public $category_id;
    public $pasport;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['full_name', 'login', 'email', 'phone', 'password', 'category_id', 'pasport'], 'required'],
            ['email', 'email'],
            ['password', 'string', 'min' => 6],
            [['login', 'email'], 'unique', 'targetClass' => User::class],
            ['full_name', 'match', 'pattern' => '/^[а-яё\s]+$/ui'],
            ['login', 'match', 'pattern' => '/^[a-z]+$/i'],
            ['password', 'match', 'pattern' => '/^[a-z\d]+$/i'],
            ['pasport', 'match', 'pattern' => '/^\d{4}\s\d{6}$/'],
            ['phone', 'match', 'pattern' => '/^\+7\(\d{3}\)\-\d{3}\-\d{2}\-\d{2}$/'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'full_name' => 'ФИО',
            'login' => 'логин',
            'email' => 'email',
            'phone' => 'телефон',
            'password' => 'пароль',
            'category_id' => 'категория',
            'pasport' => 'паспорт',
            'role_id' => 'Role ID',
            'auth_key' => 'Auth Key',
        ];
    }

    public function register()
    {
        if ($this->validate()) {
            $user = new User();
            $user->attributes = $this->attributes;
            $user->role_id = 1;
            $user->password = Yii::$app->security->generatePasswordHash($this->password);
            $user->auth_key = Yii::$app->security->generateRandomString();
            if (!$user->save()) {
                Yii::$app->session->setFlash('danger', 'регистрация не завершена');
            }
        }
        return $user ?? false;
    }
}
