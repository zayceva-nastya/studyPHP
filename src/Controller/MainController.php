<?php

namespace Controller;

use Services\Db;
use View\View;
use Models\Articles\Article;

class MainController
{
    private $view;


    public function __construct()
    {
        $this->view = new View(__DIR__ . '/../templates');
    }

    public function main()
    {

        $articles = Article::findAll();
        $this->view->renderHtml('main/main.php', ['articles' => $articles, 'title' => 'Main']);
    }

    public function sayHello($name)
    {
        $this->view->renderHtml('main/hello.php', ['name' => $name, 'title' => 'Страница приветствия']);
    }

    public function sayBye($name)
    {
        echo "Bye " . $name;
    }

}