<?php
return [
    '~^articles/(\d+)$~' => [\Controller\ArticleController::class, 'view'],
    '~^articles/(\d+)/edit$~' => [\Controller\ArticleController::class, 'edit'],
    '~^articles/add~' => [\Controller\ArticleController::class, 'add'],
    '~^articles/(\d+)/delete~' => [\Controller\ArticleController::class, 'delete'],
    '~^user/register~' => [\Controller\UsersController::class, 'signUp'],
    '~^$~' => [\Controller\MainController::class, 'main'],
];