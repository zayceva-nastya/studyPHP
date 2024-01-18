<?php

namespace Models\Users;

use Exeptions\InvalidUserData;
use Models\ActiveRecordEntity;

class Users extends ActiveRecordEntity
{
    protected $nickname;

    /** @var string */
    protected $email;

    /** @var int */
    protected $isConfirmed;

    /** @var string */
    protected $role;

    /** @var string */
    protected $passwordHash;

    /** @var string */
    protected $authToken;

    /** @var string */
    protected $createdAt;

    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getNickname()
    {
        return $this->nickname;
    }

    public static function signUp($userData)
    {
        if (empty($userData['nickname'])) {
            throw new \Exeptions\InvalidUserData('inter your nickname');
        }
        if(static::findDublicate('nickname',$userData['nickname'])!== null){
            throw new \Exeptions\InvalidUserData('This nickname already exist!');
        }
        if (!preg_match('/^[a-zA-Z0-9]+$/', $userData['nickname'])) {
            throw new InvalidArgumentException('Nickname может состоять только из символов латинского алфавита и цифр');
        }
        if (empty($userData['email'])) {
            throw new \Exeptions\InvalidUserData('inter your email');
        }
        if(static::findDublicate('email',$userData['email'])!== null){
            throw new \Exeptions\InvalidUserData('This email already exist!');
        }
        if(!filter_var($userData['email'], FILTER_VALIDATE_EMAIL)){
            throw new \Exeptions\InvalidUserData('No correct email!');
        }
        if (empty($userData['password'])) {
            throw new \Exeptions\InvalidUserData('inter your password');
        }
        if(mb_strlen($userData['password'])<8){
            throw new \Exeptions\InvalidUserData('Пароль должен содержать минимум 8 символов');
        }
        $user = new Users();
        $user->nickname = $userData['nickname'];
        $user->email = $userData['email'];
        $user->passwordHash = password_hash($userData['password'], PASSWORD_DEFAULT);
        $user->isConfirmed = false;
        $user->role = 'user';
        $user->authToken = sha1(random_bytes(100)) . sha1(random_bytes(100));
        $user->save();
        return $user;

    }


    protected static function getTableName(): string
    {
        return 'users';
    }
}