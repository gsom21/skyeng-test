<?php

namespace app\models;


use Yii;
use yii\base\Model;

class UserForm extends Model
{
    public $firstName;
    public $secondName;
    public $patronymic;
    public $mail;

    public function rules()
    {
        return [
            [['firstName', 'secondName', 'mail'], 'required'],
            ['mail', 'email'],
            ['mail', 'validateEmail']
        ];
    }

    /**
     * @param $attribute
     */
    public function validateEmail($attribute)
    {
        if (Yii::$app->db->createCommand('SELECT id FROM "user" WHERE mail = :mail')
            ->bindParam('mail', $this->$attribute)
            ->queryOne()) {
            $this->addError($attribute, 'Email already exists !');

        }
    }
}