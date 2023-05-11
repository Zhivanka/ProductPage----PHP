<?php

declare(strict_types=1);

namespace Core;

class ViewCreator 
{
    public static function render($viewFile, $variables) 
    {
        extract($variables);
        if (file_exists($viewFile)) {
            include_once $viewFile;
        } else {
            include_once "View/exceptions/page-not-found.php";
        }
    }
}