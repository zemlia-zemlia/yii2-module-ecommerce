<?php
/**
 * Created by PhpStorm.
 * User: floor12
 * Date: 13/10/2018
 * Time: 11:13
 *
 * @var $this \yii\web\View
 * @var $model \floor12\ecommerce\models\Item
 * @var $categories array
 *
 */

use floor12\files\components\FileInputWidget;
use floor12\pages\components\Summernote;
use kartik\form\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\Html;

$form = ActiveForm::begin([
    'options' => ['class' => 'modaledit-form'],
    'enableClientValidation' => true
]);


?>
<div class="modal-header">
    <h2><?= Yii::t('app.f12.ecommerce', $model->isNewRecord ? 'Create item' : 'Item updating'); ?></h2>
</div>
<div class="modal-body">

    <?= $form->errorSummary($model); ?>

    <div class="row">
        <div class="col-md-2">
            <?= $form->field($model, 'price', ['addon' => ['append' => ['content' => Yii::$app->getModule('shop')->currencyLabel]]]) ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'price_discount', ['addon' => ['append' => ['content' => Yii::$app->getModule('shop')->currencyLabel]]]) ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'availible') ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'external_id') ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'status')->checkbox() ?>
        </div>
    </div>

</div>
<div class="modal-footer">
    <?= Html::a(Yii::t('app.f12.ecommerce', 'Cancel'), '', ['class' => 'btn btn-default modaledit-disable']) ?>
    <?= Html::submitButton(Yii::t('app.f12.ecommerce', $model->isNewRecord ? 'Create' : 'Save'), ['class' => 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end(); ?>