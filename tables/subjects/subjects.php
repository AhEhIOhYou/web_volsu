<?php

//Хлебные крошки и название страницы
$breadcrumb = array(
    "Предметы"  => ""
);

//база данных
require_once "../../include/db_connection.php";
$database = new Database(require '../../include/config.php');
$db = $database->getConnection();

//header
require_once "../../include/header.php";

//классы
require_once "../../src/subject_c.php";
$subject = new Subject($db);
$subj_list = $subject->readAll();

?>
    <table class="table">
        <thead class="thead-dark">
        <tr>
            <td>ID</td>
            <td>Предмет</td>
            <td>Действия</td>
        </tr>
        </thead>
        <tbody>
        <? foreach ($subj_list as $item):?>
            <tr>
                <td><? echo $item['id'] ?></td>
                <td><? echo $item['title'] ?></td>
                <td>
<!--                    гет запрос-->
                    <form method="get" action="/tables/subjects/update_subject.php" style="display: inline-block">
                        <button type="submit" name="update_id" value="<?echo $item['id'] ?>" class="btn btn-primary">Редактировать</button>
                    </form>
                    <form method="get" action="/tables/delete.php" style="display: inline-block">
                        <input name="table" value="<?echo $subject->getTableName() ?>" style="display: none">
                        <button type="submit" name="delete_id" onclick="return  confirm('Удалить?')" value="<?echo $item['id'] ?>" class="btn btn-danger">Удалить</button>
                    </form>
                </td>
            </tr>
        <? endforeach; ?>
        </tbody>
    </table>

    <div class='right-button-margin'>
        <a href="/tables/subjects/create_subject.php" class='btn btn-success pull-center'>Создать предмет</a>
    </div>
    <br>

<?php
//footer
require_once "../../include/footer.php";
?>