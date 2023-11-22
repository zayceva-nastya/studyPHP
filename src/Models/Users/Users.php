<?php

namespace Models\Users;

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


    protected static function getTableName(): string
    {
        return 'users';
    }
}