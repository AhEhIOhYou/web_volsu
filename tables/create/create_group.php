<?php
//заголовок для этой страницы
$title = "Создание группы";

//база данных
require_once "../../include/db_connection.php";
$database = new Database();
$db = $database->getConnection();

//header
require_once "../../include/header.php";

//классы
require_once "../../src/Group.php";
$group = new Group($db);

?>

<br><br>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
    <div class="form-group">
        <label >Название группы</label>
        <input type="text" class="form-control" name="title-group" placeholder="Впиши название">
    </div>
    <button type="submit" class="btn btn-primary">Создать</button>
</form>
<br>

<?php
// если форма была отправлена
if ($_POST) {

    $group->g_name = $_POST['title-group'];



    if ($group->create()) {
        header('Location: http://vladimirov.ivdev.ru/tables/groups.php?create_success=0');
    }
    else {
        header('Location: http://vladimirov.ivdev.ru/tables/groups.php?');
    }
}
?>

<?php
//footer
require_once "../../include/footer.php";
?>

