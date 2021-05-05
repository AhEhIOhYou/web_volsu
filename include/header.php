<?php
//получаем тайтл текущей страницы
$activePage = NULL;
foreach ($breadcrumb as $activePage => $activeUrl) {
    break;
}
?>


<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><? echo $activePage; ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
</head>

<body>

<div class="container">
    <div class="card text-center">
        <div class="card-header">
            <ul class="nav nav-pills card-header-pills">
                <li class="nav-item">
                    <a class="<?php if ($activePage == "Рейтинг студентов") {echo "nav-link active"; } else  {echo "nav-link";}?>" href="/index.php">Рейтинг студентов</a>
                </li>
                <li class="nav-item">
                    <a class="<?php if ($activePage == "Группы") {echo "nav-link active"; } else  {echo "nav-link";}?>"  href="/tables/st_groups/st_groups.php">Группы</a>
                </li>
                <li class="nav-item">
                    <a class="<?php if ($activePage == "Студенты") {echo "nav-link active"; } else  {echo "nav-link";}?>"  href="/tables/students/students.php">Студенты</a>
                </li>
                <li class="nav-item">
                    <a class="<?php if ($activePage == "Оценки") {echo "nav-link active"; } else  {echo "nav-link";}?>"  href="/tables/rating/rating.php">Оценки</a>
                </li>
                <li class="nav-item">
                    <a class="<?php if ($activePage == "Предметы") {echo "nav-link active"; } else  {echo "nav-link";}?>"  href="/tables/subjects/subjects.php">Предметы</a>
                </li>
                <li class="nav-item">
                    <a class="<?php if ($activePage == "Связь: группы-предметы") {echo "nav-link active"; } else  {echo "nav-link";}?>"  href="/tables/group_and_subject/group_and_subject.php">Связь: группы-предметы</a>
                </li>
            </ul>
        </div>
    </div>

    <br>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <? foreach ($breadcrumb as $crumb => $url) :?>
                <li class="breadcrumb-item"><a href="<? echo $url ?>"><? echo $crumb ?></a></li>
            <? endforeach; ?>
        </ol>
    </nav>