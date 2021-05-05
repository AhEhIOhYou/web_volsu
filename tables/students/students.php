<?php

//Хлебные крошки и название страницы
$breadcrumb = array(
    "Студенты"  => ""
);

//база данных
require_once "../../include/db_connection.php";
require_once "../../src/student_c.php";
require_once "../../src/subject_c.php";
require_once "../../src/rating_c.php";

$database = new Database(require '../../include/config.php');
$db = $database->getConnection();

// создадим экземпляры классов
$student = new Student($db);
$students_list = $student->readData();

//header
require_once "../../include/header.php";
?>
    <table class="table">
        <thead>
        <tr>
            <td>ID</td>
            <td>Имя</td>
            <td>Группа</td>
            <td>Действия</td>
        </tr>
        </thead>
        <tbody>
        <? foreach ($students_list as $item):?>
            <tr>
                <td><? echo $item['id'] ?></td>
                <td><? echo $item['name'] ?></td>
                <td><? echo $item['g_name'] ?></td>
                <td>
                    <form method="get" action="/tables/students/update_student.php" style="display: inline-block">
                        <button type="submit" name="update_id" value="<?echo $item['id'] ?>" class="btn btn-primary">Редактировать</button>
                    </form>
                    <form method="get" action="/tables/delete.php" style="display: inline-block">
                        <input name="table" value="<?echo $student->getTableName() ?>" style="display: none">
                        <button type="submit" name="delete_id" onclick="return  confirm('Удалить?')" value="<?echo $item['id'] ?>" class="btn btn-danger">Удалить</button>
                    </form>
                </td>
            </tr>
        <? endforeach; ?>
        </tbody>
    </table>

    <div class='right-button-margin'>
        <a href="/tables/students/create_student.php" class='btn btn-success pull-center'>Создать студента</a>
    </div>

<br>

<?php
//footer
require_once "../../include/footer.php";
?>