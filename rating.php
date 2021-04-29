<table class="table">
    <thead class="thead-dark">
    <tr>
        <th scope="col">Студенты</th>
        <? foreach ($subjects as $item) : ?>
            <th><? echo $item ?></th>
        <? endforeach;?>
    </tr>
    </thead>
    <tbody>
    <? for ($i = 0; $i < count($students); $i++) : ?>
    <tr>
        <th scope="row"><? echo $students[$i] ?></th>
        <? for ($j = 0; $j < count($subjects); $j++) : ?>
            <td><? echo $rate[$i][$j]; ?></td>
        <? endfor; ?>
    </tr>
    <? endfor; ?>
    </tbody>
</table>