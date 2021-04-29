<?php


class Group
{
    private $conn;
    private $table_name = "st_groups";

    public $id;
    public $g_name;

    public function __construct($db) {
        $this->conn = $db;
    }

    function create() {

        $query = "INSERT INTO $this->table_name (`g_name`)
                        VALUES(?)";
        $stmt = $this->conn->prepare($query);

        if ($stmt->execute([$this->g_name])) {
            return true;
        } else {
            return false;
        }
    }


    function readAll() {
        $query = "SELECT id, g_name FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchall(PDO::FETCH_ASSOC);
    }

    function delete() {

        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);

        if ($result = $stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    function readOne() {

        $query = "SELECT
                g_name
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

        $this->g_name = $row['g_name'];
    }

    function update() {

        $query =  "UPDATE 
                        " . $this->table_name . "  
                   SET 
                        `g_name` = ?
                   WHERE 
                        " . $this->table_name . " .`id` = ?";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $this->g_name);
        $stmt->bindParam(2, $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }


}