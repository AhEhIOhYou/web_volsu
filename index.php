<?php
//заголовок для этой страницы
$title = "Рейтинг студентов";

//база данных
require_once "include/db_connection.php";
$database = new Database();
$db = $database->getConnection();

//header
require_once "include/header.php";

//классы
require_once "src/Subject.php";
require_once "src/Rating.php";
require_once "src/Student.php";
require_once "src/GroupsAndSubjects.php";


$stud = new Student($db);
$rating = new Rating($db);
$subj = new GroupsAndSubjects($db);

$subject = new Subject($db);
$subj_list = $subject->readAll()
?>

    <select class='form-control' name='category_id'
        <option>Выбрать группу...</option>

    <?php foreach ($subj_list as $item) {
    echo "<option value='". $item['id'] . "'></option>";
    } ?>

    </select>


<?php
if (isset($_GET['gr_id'])) {

    $rate_result = $rating->readByGroup(2);

    foreach ($rate_result as $res) {
        print_r($res);
        echo "<br>";
    }
    $subj_list = $subj->readByGroup(2);

    echo "<table class='table'>
        <thead>
            <tr>
                <th>Студенты</th>";
    foreach ($subj_list as $res) {
        echo "<th>" . $res['title'] . "<th>";
    }
    echo "</tr>
        </thead>
        <tbody>
            <tr>
                <th>Имя</th>
            </tr>
        </tbody>
    </table>";
}
?>

<?php
//footer
require_once "include/footer.php";
?>