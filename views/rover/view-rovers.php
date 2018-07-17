
<table class="table table-striped table-bordered">
    <tr>
        <th>№ Ровера</th>
        <th>X</th>
        <th>Y</th>
        <th>Направление</th>
        <th>Количество собранных камней</th>
    </tr>
    <?php
    foreach ($rovers as $key => $rover) {
        ?>
        <tr>
            <td><?= $key + 1 ?></td>
            <td><?= $rover->getX() ?></td>
            <td><?= $rover->getY() ?></td>
            <td><?= $rover->getHeading() ?></td>
            <td><?= $rover->getStones() ?></td>
        </tr>

    <?php } ?>

</table>    