<?php

namespace Controller;

use View\View;

class MainController
{
    private $view;

    public function __construct()
    {
        $this->view = new View(__DIR__ . '/../templates');
    }

    public function main()
    {
        $articles = [
            ['name' => 'Статья 1', 'text' => 'Текст статьи 1111111'],
            ['name' => 'Статья 2', 'text' => 'Текст статьи 2222222'],
        ];
        $this->view->renderHtml('main/main.php', ['articles' => $articles,'title'=>'Main']);
    }

    public function sayHello($name)
    {
        $this->view->renderHtml('main/hello.php', ['name' => $name,'title'=>'Страница приветствия']);
    }

    public function sayBye($name)
    {
        echo "Bye " . $name;
    }

}