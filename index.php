<?php

$breadcrumb = array(
    "Рейтинг студентов" => ""
);

//база данных
require_once "include/db_connection.php";
$database = new Database(require 'include/config.php');
$db = $database->getConnection();

//header
require_once "include/header.php";

//классы
require_once "src/group.php";
require_once "src/rating_c.php";

$gr = new Group($db);
$group_list = $gr->readAll();
?>
    <br><br>
    <form method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label >Выбери группу</label>
        <select class="form-control" name="gr_id">
            <? foreach ($group_list as $group): ?>
            <option value="<? echo $group['id'] ?>"><? echo $group['g_name']; ?></option>
            <? endforeach;?>
        </select>
        <br>
        <button type="submit" class="btn btn-primary">Показать рейтинг</button>
    </form>
<br>
<?php
if (isset($_GET['gr_id'])) {

    $rating = new Rating($db);
    $rate_result = $rating->readByGroup($_GET['gr_id']);
    echo '<pre>' . __FILE__ . ':' . __LINE__ . ':<br>' . print_r($rate_result, true) . '</pre>';

    $rate = array();
    $students = array();
    $subjects = array();

    $result = [];

    foreach ($rate_result as $item) {
        $result['students'][$item['student_id']] = $item['name'];
        $result['subjects'][$item['subject_id']] = $item['title'];
        $result['marks'][$item['student_id']][$item['subject_id']] = $item['val'];
    }

    echo '<pre>' . __FILE__ . ':' . __LINE__ . ':<br>' . print_r($result, true) . '</pre>';

    foreach ($result['students'] as $item => $value) {
        foreach ($result['subjects'] as $item2 => $value2) {
            foreach ($result[$item][$item2] as $m) {
                print_r($m);
            }
        }
    }


    require_once "rating.php";

}
?>

<?php
//footer
require_once "include/footer.php";
?>