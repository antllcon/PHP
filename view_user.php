<?php
declare(strict_types=1);

require_once __DIR__ . '/src/controller/UserController.php';

$controller = new UserController();
$controller->viewUser((int) $_GET['id']);
