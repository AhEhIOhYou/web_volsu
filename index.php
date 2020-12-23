<!DOCTYPE html>
<html lang="ru">
    <head>
        <title>AJAX</title>
        <meta charset="utf-8">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
        <script>
            $(document).ready(function() {
                $("#load").bind("click", function () {
                    var name = "Ты";
                     $.ajax({
                        url: "content.php",
                        type: "POST",
                        data: ({send_name: name}),
                        dataType: "html",
                        success: out
                    });
                });
            })
            function out(data) {
                $("#information").text(data);
            }
        </script>
    </head>
    <body>
        <main>
            <h1>Здесь будет ваш AJAX</h1>
                <button id="load">Вывести без перезагрузки</button>
                <div id="information" ></div>
        </main>
    </body>
</html>