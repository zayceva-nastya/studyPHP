<?php

namespace Controller;

use Exeptions\NotFoundExeption;
use Models\Articles\Article;
use Models\Users\Users;
use View\View;
use Services\Db;

class ArticleController
{

    private $view;


    public function __construct()
    {
        $this->view = new View(__DIR__ . '/../templates');

    }

    public function view(int $articleId)
    {
        $article = Article::getById($articleId);

        if ($article === []) {
            throw new NotFoundExeption('Статья с ид не найдена');
        }

        $this->view
            ->renderHtml(
                'articles/view.php',
                [
                    'article' => $article,
                ]
            );
    }

    public function edit($articleId)
    {
        $article = Article::getById($articleId);
        if ($article === null) {
            throw new NotFoundExeption('Статья для редактирования не найдена');
        }
        $article->setName('new name');
        $article->setText('new text');
        var_dump($article);
        $article->save();

        $this->view->renderHtml('articles/edit.php');

    }

    public function add()
    {
        $author = Users::getById(1);
        $article = new Article();
        $article->setAuthorId($author);
        $article->setName('jhkjd');
        $article->setText('dfgdfgdf');
        $article->save();
        var_dump($article);
        $this->view->renderHtml('articles/insert.php');

    }

    public function delete($articleId)
    {
        $article = Article::getById($articleId);
        if ($article != null) {
            $article->delete();
            var_dump($article);

        }

        echo "статья уже удалена";

    }

}