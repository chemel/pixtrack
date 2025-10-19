<?php

require_once __DIR__.'/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use App\Controller\IndexController;

$request = Request::createFromGlobals();

$controller = new IndexController();
$response = $controller->index($request);
$response->send();
exit();
