<?php
require_once "main_class.php";

class Groups_and_Subjects extends Main_Class
{
    protected $table_name = "group_and_subject";

    public $group_id;
    public $subject_id;
    function create() {

        $query = "INSERT INTO $this->table_name (`group_id`, `subject_id`)
                        VALUES(?, ?)";
        $stmt = $this->conn->prepare($query);

        if ($stmt->execute([$this->group_id, $this->subject_id])) {
            return true;
        } else {
            return false;
        }
    }

    function readAllTitles() {
        $query = "SELECT  $this->table_name.id, subjects.title
                    FROM $this->table_name
                    JOIN subjects ON $this->table_name.subject_id = subjects.id ";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchall(PDO::FETCH_ASSOC);
    }

    function readOne() {

        $query = "SELECT
                group_id, subject_id
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

        $this->group_id = $row['group_id'];
        $this->subject_id = $row['subject_id'];
    }

    function readData() {
        $query = "SELECT  $this->table_name.id, st_groups.g_name, subjects.title
                    FROM $this->table_name
                    JOIN subjects ON $this->table_name.subject_id = subjects.id
                    JOIN st_groups ON $this->table_name.group_id = st_groups.id
                    ";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchall(PDO::FETCH_ASSOC);
    }

    function update() {

        $query =  "UPDATE 
                        " . $this->table_name . "  
                   SET 
                        `group_id` = ?, `subject_id` = ? 
                   WHERE 
                        " . $this->table_name . " .`id` = ?";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $this->group_id);
        $stmt->bindParam(2, $this->subject_id);
        $stmt->bindParam(3, $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}