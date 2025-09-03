<?php
session_start();
require_once 'app/controllers/GameController.php';

$action = $_GET['action'] ?? 'setup';
$controller = new GameController();

switch ($action) {
    case 'start':
        $controller->start();
        break;
    case 'move':
        $controller->makeMove();
        break;
    case 'reset':
        $controller->reset();
        break;
    default:
        $controller->setup();
}
