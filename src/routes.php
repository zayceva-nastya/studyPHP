<?php
return [
    '~^hello/(.*)$~' => [\Controller\MainController::class, 'sayHello'],
    '~^$~' => [\Controller\MainController::class, 'main'],
    '~^bye/(.*)$~' => [\Controller\MainController::class, 'sayBye'],
];