<?php
require_once "main_class.php";


class Rating extends Main_Class
{
    protected $table_name = "rating";

    public $student_id;
    public $gr_subject_id;
    public $val;

    function create() {

        $query = "INSERT INTO $this->table_name (`student_id`,`gr_subject_id`,`val`)
                        VALUES(?, ?, ?)";
        $stmt = $this->conn->prepare($query);

        if ($stmt->execute([$this->student_id, $this->gr_subject_id, $this->val])) {
            return true;
        } else {
            return false;
        }
    }

    function readByGroup($gr_id) {


        $query2 = "SELECT  students.id, students.name, group_and_subject.subject_id, subjects.title, rating.val
                    FROM rating
                    LEFT JOIN group_and_subject ON group_and_subject.group_id = $gr_id
                    JOIN subjects ON group_and_subject.subject_id = subjects.id
                    JOIN students ON students.id = rating.student_id
                    WHERE students.group_id = $gr_id
                    ";

        $stmt = $this->conn->prepare($query2);
        $stmt->execute();
        return $stmt->fetchall(PDO::FETCH_ASSOC);
    }

    function readOne() {

        $query = "SELECT
                student_id, gr_subject_id, val
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

        $this->student_id = $row['student_id'];
        $this->gr_subject_id = $row['gr_subject_id'];
        $this->val = $row['val'];
    }

    function readData() {
        $query = "SELECT  $this->table_name.id, students.name, subjects.title, $this->table_name.val
                    FROM $this->table_name
                    JOIN students ON $this->table_name.student_id = students.id
                    JOIN group_and_subject ON $this->table_name.gr_subject_id = group_and_subject.id
                    JOIN subjects ON group_and_subject.subject_id = subjects.id
                    ";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchall(PDO::FETCH_ASSOC);
    }

    function update() {

        $query =  "UPDATE 
                        " . $this->table_name . "  
                   SET 
                        `student_id` = ?, `gr_subject_id` = ?, `val` = ? 
                   WHERE 
                        " . $this->table_name . " .`id` = ?";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $this->student_id);
        $stmt->bindParam(2, $this->gr_subject_id);
        $stmt->bindParam(3, $this->val);
        $stmt->bindParam(4, $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}