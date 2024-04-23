<?php
require __DIR__. '/src/controller/UserController.php';

$controller = new UserController();
$controller->index();