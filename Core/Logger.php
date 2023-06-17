<?php

declare(strict_types=1);

namespace Core;

class Logger
{
    private string $logFile;

    public function __construct(string $logFile)
    {
        $this->logFile = $logFile;
        if (!file_exists($this->logFile)) {
            $fp = fopen($this->logFile, 'w');
            fclose($fp);
        }
    }

    public function log(string $message)
    {
        $fp = fopen($this->logFile, 'a');
        fwrite($fp, $message . "\n");
        fclose($fp);
    }
}
