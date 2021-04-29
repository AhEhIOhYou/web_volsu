<?php


class Student
{
    private $conn;
    private $table_name = "students";

    public $id;
    public $name;
    public $group_id;

    public function __construct($db) {
        $this->conn = $db;
    }

    function create() {

        $query = "INSERT INTO $this->table_name (`name`,`group_id`)
                        VALUES(?, ?)";
        $stmt = $this->conn->prepare($query);

        if ($stmt->execute([$this->name, $this->group_id])) {
            return true;
        } else {
            return false;
        }
    }

    function readAll() {

        $query = "SELECT id, `name`, group_id FROM " . $this->table_name;
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
                `name`, group_id
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

        $this->name = $row['name'];
        $this->group_id = $row['group_id'];
    }

    function update() {

        $query =  "UPDATE 
                        " . $this->table_name . "  
                   SET 
                        `name` = ?, `group_id` = ?
                   WHERE 
                        " . $this->table_name . " .`id` = ?";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $this->name);
        $stmt->bindParam(2, $this->group_id);
        $stmt->bindParam(3, $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}