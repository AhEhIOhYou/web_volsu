<?php

require_once "main_class.php";

class Student extends Main_Class
{
    protected $table_name = "students";

    public $name;
    public $group_id;

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

    function readData() {
        $query = "SELECT $this->table_name.id, $this->table_name.name, st_groups.g_name
                    FROM $this->table_name
                    JOIN st_groups ON $this->table_name.group_id = st_groups.id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchall(PDO::FETCH_ASSOC);
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