<?php

spl_autoload_register(function (string $className) {
    require_once __DIR__ . '/src/' . str_replace('\\', '/', $className) . '.php';
});

$main = new Controller\MainController();

$route = $_GET['route'] ?? '';
$routes = require __DIR__ . '/src/routes.php';
$isRouteFound = false;
foreach ($routes as $pattern => $controllerAndAction) {
    preg_match($pattern, $route, $matches);
    if (!empty($matches)) {
        $isRouteFound = true;
        break;
    }
}

if (!$isRouteFound) {
    echo 'Страница не найдена!';
    return;
}

//var_dump($controllerAndAction);
//var_dump($matches);
unset($matches[0]);

$controllerName = $controllerAndAction[0];
$actionName = $controllerAndAction[1];

$controller = new $controllerName();
$controller->$actionName(...$matches);