<?php
declare(strict_types=1);

class Config
{
    public static function getDatabaseDsn(): string
    {
        return "mysql:host=localhost:3306;dbname=php_course";
    }
    
    public static function getDatabaseUser(): string
    {
        return 'rooter';
    }
    
    public static function getDatabasePassword(): string
    {
        return '1111';
    }
    
    
}