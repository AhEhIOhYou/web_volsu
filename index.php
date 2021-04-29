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
require_once "src/Group.php";
require_once "src/Rating.php";

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

    $rate = array();
    $students = array();
    $subjects = array();

    $i = 0;
    foreach ($rate_result as $item) {
        $students[$i] = $item['name'];
        $subjects[$i] = $item['title'];
        $i++;
    }

    $subjects = array_unique($subjects);
    $students = array_unique($students);

    $subjects = array_values($subjects );
    $students = array_values($students);

    echo "<br>";
    for ($i = 0; $i < count($students); $i++)
    {
        for ($j = 0;$j < count($subjects); $j++)
        {
            foreach ($rate_result as $item)
            {
                if ($item['name'] == $students[$i] && $item['title'] == $subjects[$j])
                {
                    $rate[$i][$j] = $item['val'];
                }
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