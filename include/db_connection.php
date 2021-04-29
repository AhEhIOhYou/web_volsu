<?php

class Database
{
    private $db_host = 'phpmyadmin.ivdev.ru';
    private $db_name   = 'dbvladimirov';
    private $db_user = 'uservladimirov';
    private $db_pass = '6WeIYpLcAOLS7Tp';
    public $conn;

    //Коннекшн
    public function getConnection()
    {
        $this->conn = null;
        try
        {
            $this->conn = new PDO("mysql:host=" . $this->db_host . ";dbname=" . $this->db_name, $this->db_user, $this->db_pass);
        }
        catch (PDOException $exception)
        {
            echo "Ошибка подключпения к БД!: "  . $exception->getMessage() . " ~lol";
        }
        return $this->conn;
    }
}
