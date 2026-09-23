<?php

class Database
{
    private string $host = "localhost";
    private string $username = "root";
    private string $password = "";
    private string $database = "NobannoAgro";

    private ?mysqli $connection = null;

    public function connect(): mysqli
    {
        if ($this->connection === null) {

            $this->connection = new mysqli(
                $this->host,
                $this->username,
                $this->password,
                $this->database
            );

            if ($this->connection->connect_error) {
                die(
                    "Database connection failed: " .
                    $this->connection->connect_error
                );
            }

            $this->connection->set_charset("utf8mb4");
        }

        return $this->connection;
    }
}