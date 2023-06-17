<?php

declare(strict_types=1);

namespace Database;

use PDO;
use PDOException;
use Core\{Logger, ViewCreator};

class Database
{
    protected PDO $pdo;
    protected Logger $logger;

    public function __construct(string $host, string $dbname, string $user, string $password)
    {
        $this->pdo = $this->connect($host, $dbname, $user, $password);
        $this->logger = new Logger('log/product-repository.log');
    }

    private function connect(string $host, string $dbname, string $user, string $password): PDO
    {
        $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";

        $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
        ];
        try {
            $pdo = new PDO($dsn, $user, $password, $options);
        } catch (PDOException $e) {
            $this->logger->log("Error: Can not connect to the database :.$e.");
            ViewCreator::render('View/exceptions/internal-error.php', []);
            exit;
        }
        return $pdo;
    }

    public function __call($method, $args)
    {
        if (!method_exists($this->pdo, $method)) {
            throw new \BadMethodCallException("Method $method does not exist");
            $this->logger->log("Error: Method $method does not exist");
            ViewCreator::render('View/exceptions/internal-error.php', []);
            exit;
        }

        try {
            return call_user_func_array([$this->pdo, $method], $args);
        } catch (PDOException $e) {
            $this->logger->log("Error: Can not get the product list :.$e.");
            ViewCreator::render('View/exceptions/internal-error.php', []);
            exit;
        }
    }
}
