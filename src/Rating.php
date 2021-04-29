<?php

class Rating
{
//    подключение к бд и таблице
    private $conn;
    private $table_name = "rating";

//    свойства объекта
    public $id;
    public $student_id;
    public $gr_subject_id;
    public $val;

    public function __construct($db) {
        $this->conn = $db;
    }

    function create() {

//        подготовка запроса на вставку
        $query = "INSERT INTO $this->table_name (`student_id`,`gr_subject_id`,`val`)
                        VALUES(?, ?, ?)";
        $stmt = $this->conn->prepare($query);

//        исполнение
        if ($stmt->execute([$this->student_id, $this->gr_subject_id, $this->val])) {
            return true;
        } else {
            return false;
        }
    }

    function readByGroup($gr_id) {

        $query = "SELECT stud.id, stud.name, subg.id, subj.title, r.val FROM rating r
                    INNER JOIN students stud ON r.student_id = stud.id
                    INNER JOIN group_and_subject grs ON r.gr_subject_id = grs.id
                    INNER JOIN subjects subj ON grs.subject_id = subj.id
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