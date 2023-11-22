<?php

namespace Controller;

use Models\Articles\Article;
use Models\Users\Users;
use View\View;
use Services\Db;

class ArticleController
{

    private $view;
    private $db;

    public function __construct()
    {
        $this->view = new View(__DIR__ . '/../templates');
        $this->db = new Db();
    }

    public function view(int $articleId)
    {
        $article = Article::getById($articleId);
        if ($article === []) {
            $this->view->renderHtml('errors/404.php', [], 404);
            return;
        }
//        var_dump($article);
        $articleAuthor = Users::getById($article->getAuthorId());
        $this->view->renderHtml('articles/view.php',
            [
                'article' => $article,
            ]
        );
    }

}