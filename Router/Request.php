<?php

//declare(strict_types=1);

namespace Router;

class Request
{
    public string $url;
    public string $method;
    public array $params;

    public function __construct()
    {
        $this->url = $_SERVER['REQUEST_URI'];
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->params = array_merge($_GET, $_POST);
    }

    public function getPath(): string
    {
        return $this->url;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getParam(): array
    {
        $parametars = [];
        foreach ($this->params as $key => $value) {
         $filteredValue = filter_input(INPUT_POST, $key, FILTER_SANITIZE_STRING);
         if (isset($filteredValue)) {
            $parametars[$key] = $filteredValue;
        }
        }
        return $parametars;
    }
}
