<?php
return [
    '~^articles/(\d+)$~' => [\Controller\ArticleController::class, 'view'],
    '~^$~' => [\Controller\MainController::class, 'main'],
];