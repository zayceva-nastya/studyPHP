<?php

namespace Models\Articles;

use Models\ActiveRecordEntity;
use Models\Users\Users;

class Article extends ActiveRecordEntity
{
    protected $authorId;
    protected $name;
    protected $text;
    protected $createdAt;


    /**
     * @return mixed
     */

    public function getName()
    {
        return $this->name;
    }

    public function getText()
    {
        return $this->text;
    }

    public function getAuthor(): Users
    {
        return Users::getById($this->authorId);
    }

    /**
     * @return mixed
     */
    public function getAuthorId(): int
    {
        return (int)$this->authorId;
    }

    protected static function getTableName(): string
    {
        return 'articles';
    }


}