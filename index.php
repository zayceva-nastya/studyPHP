<?php
//echo phpinfo();
try {
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
        throw new \Exeptions\NotFoundExeption('Нет такой страницы');
    }

    unset($matches[0]);

    $controllerName = $controllerAndAction[0];
    $actionName = $controllerAndAction[1];

    $controller = new $controllerName();
    $controller->$actionName(...$matches);
} catch (\Exeptions\DbExeption $e) {
    $view = new \View\View(__DIR__ . '/src/templates/errors/');
    $view->renderHtml('500.php', ['error' => $e->getMessage()], 500);
} catch (\Exeptions\NotFoundExeption $e) {
    $view = new \View\View(__DIR__ . '/src/templates/errors');
    $view->renderHtml('404.php', ['error' => $e->getMessage()], 404);
}