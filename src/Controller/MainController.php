<?php

namespace Controller;

class MainController
{

    public function main()
    {
        include __DIR__ . '/../../src/templates/main/main.php';
    }

    public function sayHello($name)
    {
        echo "Hello " . $name;
    }

    public function sayBye($name)
    {
        echo "Bye " . $name;
    }

}