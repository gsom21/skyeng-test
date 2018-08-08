<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<div class="site-index">
    <div class="body-content">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">

                <?php $form = ActiveForm::begin(); ?>
                <?= $form->field($user, 'firstName') ?>
                <?= $form->field($user, 'secondName') ?>
                <?= $form->field($user, 'patronymic') ?>
                <?= $form->field($user, 'mail') ?>
                <?= $form->field($individual, 'inn') ?>
                <div class="form-group">
                    <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
