<?php
require_once "main_class.php";


class Subject extends Main_Class
{
    protected $table_name = "subjects";
    public $title;

    function create() {

        $query = "INSERT INTO $this->table_name (`title`)
                        VALUES(?)";
        $stmt = $this->conn->prepare($query);

        if ($stmt->execute([$this->title])) {
            return true;
        } else {
            return false;
        }
    }

    function readOne() {

        $query = "SELECT
                title
            FROM
                " . $this->table_name . "
            WHERE
                id = ?
            LIMIT
                0,1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->title = $row['title'];
    }

    function update() {

        $query =  "UPDATE 
                        " . $this->table_name . "  
                   SET 
                        `title` = ?
                   WHERE 
                        " . $this->table_name . " .`id` = ?";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $this->title);
        $stmt->bindParam(2, $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}