<?php

namespace app\models;


use Yii;
use yii\base\Model;

class IndividualForm extends Model
{
    public $inn;

    public function rules()
    {
        return [
            ['inn', 'validateInn'],
        ];
    }

    public function validateInn($attribute){
        if(!ctype_digit($this->$attribute) || strlen($this->$attribute) != 12){
            $this->addError($attribute, 'Inn not correct !');
        }
        if(Yii::$app->db->createCommand('SELECT id FROM "individual" WHERE inn = :inn UNION SELECT id FROM "legal" WHERE inn = :inn')
            ->bindParam('inn', $this->$attribute)
            ->queryOne()){
            $this->addError($attribute, 'Inn already exists !');

        }
    }
}