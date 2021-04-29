<?php
$activePage = basename($_SERVER['PHP_SELF'], ".php");
?>


<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><? echo $title; ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
</head>

<body>

<div class="container">
    <div class="card text-center">
        <div class="card-header">
            <ul class="nav nav-pills card-header-pills">
                <li class="nav-item">
                    <a class="<?php if ($activePage == "index") {echo "nav-link active"; } else  {echo "nav-link";}?>" href="/index.php/">Рейтинг студентов</a>
                </li>
                <li class="nav-item">
                    <a class="<?php if ($activePage == "groups") {echo "nav-link active"; } else  {echo "nav-link";}?>"  href="/tables/groups.php/">Группы</a>
                </li>
                <li class="nav-item">
                    <a class="<?php if ($activePage == "students") {echo "nav-link active"; } else  {echo "nav-link";}?>"  href="/tables/students.php/">Студенты</a>
                </li>
                <li class="nav-item">
                    <a class="<?php if ($activePage == "marks") {echo "nav-link active"; } else  {echo "nav-link";}?>"  href="/tables/marks.php/">Оценки</a>
                </li>
                <li class="nav-item">
                    <a class="<?php if ($activePage == "subjects") {echo "nav-link active"; } else  {echo "nav-link";}?>"  href="/tables/subjects.php/">Предметы</a>
                </li>
                <li class="nav-item">
                    <a class="<?php if ($activePage == "grs") {echo "nav-link active"; } else  {echo "nav-link";}?>"  href="/tables/grs.php/">Связь: группы-предметы</a>
                </li>
            </ul>
        </div>
    </div>

    <br>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?echo "/" . $activePage . ".php";?>"><? echo $title;?></a></li>
        </ol>
    </nav>
