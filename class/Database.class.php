<?php

class Database
{
    # Variável que guarda a conexão PDO.
    protected static $db;

    private function __construct()
    {
        $driver = "mysql";
        $host = "localhost";
        $dbname = "test";
        $username = "root";

        try {
            self::$db = new PDO("$driver: host=$host; dbname=$dbname", $username);

            self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
            self::$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function getConexao()
    {
        if (!self::$db) {
            new Database();
        }

        return self::$db;
    }
}
