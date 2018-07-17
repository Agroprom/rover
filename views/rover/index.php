<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$form = ActiveForm::begin();
?>
<table class="table table-striped table-bordered">
    <?= $form->field($model, 'quanty')->textInput() ?>
    <?= $form->field($model, 'max_x')->textInput() ?>
    <?= $form->field($model, 'max_y')->textInput() ?>
</table>
<div class="btn-group">
    <?= Html::submitButton('Далее', ['class' => 'btn btn-primary']) ?>
    <?=
    HTML::a('Показать инструкцию', ['show-help'], [
        'title' => 'Показать инструкцию',
        //  'data-pjax' => '0',             
        'data-toggle' => 'modal',
        'data-target' => '#pModal',
        'class' => 'btn btn-primary'
    ]);
    ?>    
</div>
<?php ActiveForm::end(); ?>




<div class="modal remote fade" id="pModal">
    <div class="modal-dialog">

        <div class="modal-content loader-lg">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
            </div>
            <div class="modal-body"></div>   
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
            </div>

        </div>
    </div>
</div>