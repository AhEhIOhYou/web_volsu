<?php

class Rating
{
    private $conn;
    private $table_name = "rating";

    public $id;
    public $student_id;
    public $gr_subject_id;
    public $val;

    public function __construct($db) {
        $this->conn = $db;
    }

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

        $query = "SELECT r.student_id, stud.name, grs.subject_id, subj.title, r.val FROM group_and_subject grs
                LEFT JOIN rating r ON grs.id = r.gr_subject_id 
                INNER JOIN subjects subj ON grs.subject_id = subj.id
                LEFT JOIN students stud ON r.student_id = stud.id

                WHERE grs.group_id = $gr_id
                ";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchall(PDO::FETCH_ASSOC);
    }

    function readAll() {
        $query = "SELECT id, student_id, gr_subject_id, val FROM " . $this->table_name;
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