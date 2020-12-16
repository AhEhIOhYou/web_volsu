<?php
    $word = $_POST['word'];

    $outtext = "";
    $dir = glob('tmp/*');
    
    foreach ($dir as $fname) {
        $text = file_get_contents($fname);
        $text = strip_tags($text);
        $outtext = $text;
	    if(preg_match("/$word/", $outtext)) {
        echo "Слово «". $word ."» найдено в файле <a href=" . $fname . ">" . $fname . "</a><br>";
	    }
    }
    echo '<a href="index.php">На главную</a>';
?>