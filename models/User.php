<?php


namespace app\models;


use app\core\DbModel;

class User extends DbModel
{
    public const STATUS_INACTIVE=0;
    public const STATUS_ACTIVE=1;
    public const STATUS_DELETED=2;

    public string $firstname = '';
    public string $lastname = '';
    public string $email = '';
    public $status = self::STATUS_INACTIVE;
    public string $password = '';
    public string $passwordConfirm = '';

    public function save(){
        $this->password=password_hash($this->password,PASSWORD_DEFAULT);

       return parent::save();
    }

    public function rules(): array
    {
        return [
          'firstname'=>[self::RULE_REQUIRED],
            'lastname'=>[self::RULE_REQUIRED],
            'email'=>[self::RULE_REQUIRED],
            'password'=>[self::RULE_REQUIRED,[self::RULE_MIN,'min'=>'8'],[self::RULE_MAX,'max'=>'16']],
            'passwordConfirm'=>[self::RULE_REQUIRED,[self::RULE_MATCH,'match'=>'password']]
        ];
    }

    public function tableName(): string
    {
        return 'users';
    }

    public function attributes(): array
    {
       return ['firstname','lastname','email','password','status'];
    }
}