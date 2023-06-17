<?php


declare(strict_types=1);

namespace ScandiwebProject;

require_once 'autoload.php';
require_once 'Database/config.php';

use Router\{Request, Router};

;
use Controller\ProductController;
use Repository\ProductRepository;
use Database\Database;
use Core\Logger;

$db = new Database(DB_HOST, DB_NAME, DB_USER, DB_PASS);
$loggerRouter = new Logger('log/router.log');
$controller = new ProductController(new ProductRepository($db));

$router = new Router(new Request(), $loggerRouter);
$router->addRoute('GET', '/index.php', $controller, 'index');
$router->addRoute('GET', '/add-product', $controller, 'add');
$router->addRoute('POST', '/add-product', $controller, 'create');
$router->addRoute('POST', '/index.php', $controller, 'delete');
$router->handle();
