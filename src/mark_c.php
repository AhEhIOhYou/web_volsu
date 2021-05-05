<?php
require_once "main_class.php";
require_once "src/student_c.php";
require_once "src/subject_c.php";

class Mark extends Main_Class
{
    protected $table_name = "rating";

    public $student_id;
    public $subject_id;
    public $value;

    function create() {

        $query = "INSERT INTO $this->table_name (`student_id`,`subject_id`,`value`)
                        VALUES(?, ?, ?)";
        $stmt = $this->conn->prepare($query);

        if ($stmt->execute([$this->student_id, $this->subject_id, $this->value])) {
            return true;
        } else {
            return false;
        }
    }

    function read() {

        $query = "SELECT
                    id, name
                FROM
                    " . $this->table_name . "
                ORDER BY
                    name";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    function readValue() {

        $query = "SELECT 'value' FROM " . $this->table_name . " ORDER BY subject_id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $res =  $stmt->fetchall(PDO::FETCH_ASSOC);
        print_r($res);
    }

}