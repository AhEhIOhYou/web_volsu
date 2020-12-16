<?php

$outtext = "";

$num = $_POST['num'];

$dir = glob('tmp/*');

//собираем весь текст со всех файлов в директории tmp
foreach ($dir as $fname) {
    $text = file_get_contents($fname);
    $text = strip_tags($text);
    $outtext = $outtext . $text;
}

//чистим от пунктуации и цифр
$outtext = preg_replace('/[^\w\s]/u', ' ', $outtext);
$outtext = preg_replace('/[0-9]+/', ' ', $outtext);
//делим на массив по пробелам
$array = preg_split('/[\s]+/', $outtext);
//записываем в массив типа [значение - повторения]
$result = array_count_values($array);
array_shift($result);

echo '<form action="where.php" method="POST">';
foreach ($result as $key =>$val) {
    if ($val > $num) {
        echo '<button name="word" value = "' . $key . '">'. $key . ' - ' . $val .'</button><br>';
    }
}
echo '</form>';
echo '<a href="index.php">Назад</a>';
?>