<?php
session_start();

require_once dirname(__DIR__) . '/config/config.php';
require_once dirname(__DIR__) . '/core/Database.php';
require_once dirname(__DIR__) . '/core/Controller.php';
require_once dirname(__DIR__) . '/core/Upload.php';
require_once dirname(__DIR__) . '/core/Router.php';

$url = $_GET['url'] ?? '';
$router = new Router();
$router->dispatch($url);