<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \backend\models\PasswordResetRequestForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->title = Yii::t('app', 'Request a password reset');

$fieldOptions1 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-envelope form-control-feedback'></span>"
];
?>

<div class="login-box">
    <div class="login-logo">
        <a href="#"><b>Motion</b>Control</a>
    </div>

    <div class="login-box-body">
        <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form', 'enableClientValidation' => false]); ?>

        <?= $form
            ->field($model, 'email', $fieldOptions1)
            ->label(false)
            ->textInput(['placeholder' => $model->getAttributeLabel('email')]) ?>

        <div class="row">
            <div class="col-xs-8">
                <a href="<?= Url::to(['site/signup']) ?>">Register a new membership</a><br>
                <a href="<?= Url::to(['site/login']) ?>">I already have a membership</a>
            </div>
            <div class="col-xs-4">
                <?= Html::submitButton(Yii::t('app', 'Send'), ['class' => 'btn btn-primary btn-block btn-flat']) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>
    </div>

</div>