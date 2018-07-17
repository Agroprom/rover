<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$form = ActiveForm::begin();
?>
<table class="table table-striped table-bordered">
    <tr>
        <th>Х координата</th>
        <th>У координата</th>
        <th>Направление </th>
        <th>Список комманд</th>
    </tr>
    <?php foreach ($models as $key => $model) {
        ?>    

        <tr>
            <td> <?= $form->field($model, "[$key]x")->textInput(['value' => ""])->label(false) ?></td>
            <td><?= $form->field($model, "[$key]y")->textInput(['value' => ""])->label(false) ?></td>
            <td><?=
                $form->field($model, "[$key]heading")->dropDownList([
                    0 => 'Юг',
                    1 => 'Восток',
                    2 => 'Север',
                    3 => 'Запад',
                ])->label(false)
                ?></td>
            <td><?= $form->field($model, "[$key]command_line")->textInput(['value' => ""])->label(false) ?></td>
        </tr>   

<?php } ?>

</table>
<?= Html::submitButton('Отправить', ['class' => 'btn btn-primary']) ?>
<?php ActiveForm::end(); ?>

