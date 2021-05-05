<table class="table">
    <thead class="thead-dark">
    <tr>
        <th scope="col">Студенты</th>
        <? foreach ($result['subjects'] as $item) : ?>
            <th><? echo $item ?></th>
        <? endforeach;?>
    </tr>
    </thead>
    <tbody>
    <? foreach($result['students'] as $item) : ?>
    <tr>
        <th scope="row"><? echo $item ?></th>
        <? foreach($result['subjects'] as $item2) : ?>
            <td><? $result['marks'][$item][$item2]; ?></td>
        <? endforeach; ?>
    </tr>
    <? endforeach; ?>
    </tbody>
</table>