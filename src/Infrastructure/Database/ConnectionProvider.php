<?php
declare(strict_types=1);

require_once __DIR__. '/../Config.php';

class ConnectionProvider
{
    public static function ConnectDatabase(): PDO
    {
        // Создаёт объект PDO, представляющий подключение к MySQL
        // Использует фиксированные параметры dsn, username, password.
        return new PDO(Config::getDatabaseDsn(), Config::getDatabaseUser(), Config::getDatabasePassword());
    }
}