<?php


declare(strict_types=1);

function autoload(string $class): void
{
    $vendorDir = __DIR__ ;
    $fileExtension = '.php';
    $parts = explode('\\', $class);
    $className = array_pop($parts);
    $namespace = implode('\\', $parts);
    $path = str_replace('\\', DIRECTORY_SEPARATOR, $namespace);
    $filePath = $vendorDir . DIRECTORY_SEPARATOR . $path . DIRECTORY_SEPARATOR . $className . $fileExtension;
    if (file_exists($filePath)) {
        require $filePath;
    }
}
spl_autoload_register('autoload');
