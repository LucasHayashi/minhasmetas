<?php

/**
 * Simple PHP PDO Class
 * @author Miks Zvirbulis (twitter.com/MiksZvirbulis)
 * @version 1.1
 * 1.0 - First version launched. Allows access to one database and a few regular functions have been created.
 * 1.1 - Added a constructor which allows multiple databases to be called on different variables.
 */

class Database
{
    # Database driver, defined in construction.
    protected $driver;
    # Database host address, defined in construction.
    protected $host;
    # Username for authentication, defined in construction.
    protected $username;
    # Password for authentication, defined in construction.
    protected $password;
    # Database name, defined in construction.
    protected $database;

    # Connection variable. DO NOT CHANGE!
    protected $connection;

    # @bool default for this is to be left to FALSE, please. This determines the connection state.
    public $connected = false;

    # @bool this controls if the errors are displayed. By default, this is set to true.
    private $errors = true;

    function __construct($driver, $db_host, $db_username, $db_password, $db_database)
    {
        try {
            $this->driver = $driver;
            $this->host = $db_host;
            $this->username = $db_username;
            $this->password = $db_password;
            $this->database = $db_database;

            $this->connection = new PDO($this->driver . ":host=" . $this->host . ";dbname=" . $this->database, $this->username, $this->password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $this->connected = false;
            if ($this->errors === true) {
                return $this->error($e->getMessage());
            } else {
                return false;
            }
        }
    }

    function getConnection()
    {
        return $this->connection;
    }

    public function error($error)
    {
        http_response_code(500);
        die(json_encode(array("error" => $error)));
    }
}
