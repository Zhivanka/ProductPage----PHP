<?php

//declare(strict_types=1);

namespace Router;

use Core\{ViewCreator, Logger};

class Router
{
    private Request $request;
    private Logger $logger;
    private $routes = [];

    public function __construct(Request $request, Logger $logger)
    {
        $this->request = $request;
        $this->logger = $logger;
    }

    public function addRoute(string $method, string $path, $controller, string $controllerMethod): void
    {
        $this->routes[] = [
            'method' => $method,
            'path' => $path,
            'controller' => $controller,
            'controllerMethod' => $controllerMethod
        ];
    }

    public function handle(): void
    {
        foreach ($this->routes as $route) {
            if ($route['method'] !== $this->request->getMethod() || $route['path'] !== $this->request->getPath()) {
                continue;
            }

            $controller = $route['controller'];
            $controllerMethod = $route['controllerMethod'];

            if (!method_exists($controller, $controllerMethod)) {
                $this->logger->log('Invalid controller method: {$controller}->{$controllerMethod}');
                ViewCreator::render('View/exceptions/internal-error.php', []);
                exit;
            }

            if($controllerMethod=='create') {
                $input = $this->request->getParam();
                $controller->$controllerMethod($input);
                return;
            }

            $controller->$controllerMethod();
            return;
        }

        $this->logger->log('Page not found!'.$this->request->getPath());
        ViewCreator::render('View/exceptions/page-not-found.php', []);
        exit;
    }
}
