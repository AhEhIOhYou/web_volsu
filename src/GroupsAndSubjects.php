<?php


class GroupsAndSubjects
{
    private $conn;
    private $table_name = "group_and_subject";

    public $id;
    public $group_id;
    public $subject_id;

    public function __construct($db) {
        $this->conn = $db;
    }

    function create() {

//        подготовка запроса на вставку
        $query = "INSERT INTO $this->table_name (`group_id`, `subject_id`)
                        VALUES(?, ?)";
        $stmt = $this->conn->prepare($query);

//        исполнение
        if ($stmt->execute([$this->group_id, $this->subject_id])) {
            return true;
        } else {
            return false;
        }
    }

    function readAll() {
        $query = "SELECT id, group_id, subject_id FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchall(PDO::FETCH_ASSOC);
    }

    function readByGroup($gr_id) {
        $query = "SELECT 
                    subjects.title
                  FROM 
                       " . $this->table_name . "
                  INNER JOIN 
                        subjects
                  ON
                        " . $this->table_name . ".subject_id =  subjects.id
                  WHERE
                        " . $this->table_name . ".group_id = $gr_id
                  "
        ;
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

    function update() {

        $query =  "UPDATE 
                        " . $this->table_name . "  
                   SET 
                        `group_id` = ?, `subject_id` = ? 
                   WHERE 
                        " . $this->table_name . " .`id` = ?";

        $stmt = $this->conn->prepare($query);

        echo $this->group_id;
        die();

        $stmt->bindParam(1, $this->group_id);
        $stmt->bindParam(2, $this->subject_id);
        $stmt->bindParam(3, $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}