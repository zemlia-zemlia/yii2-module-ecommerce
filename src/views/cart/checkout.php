<?php
/**
 * Created by PhpStorm.
 * User: floor12
 * Date: 27/10/2018
 * Time: 12:30
 * @var $this \yii\web\View
 * @var $model \floor12\ecommerce\models\Order
 */

use floor12\ecommerce\models\enum\DeliveryType;
use kartik\form\ActiveForm;
use yii\helpers\Html;
use yii\widgets\MaskedInput;

$this->title = Yii::t('app.f12.ecommerce', 'Order checkout');
$this->params['breadcrumbs'][] = $this->title;


$form = ActiveForm::begin([
    'enableClientValidation' => false
]);
?>


    <h1><?= $this->title ?></h1>

    <div class="row">

        <div class="col-md-7">
            <table class="table table-striped table-bordered table-cart">
                <tbody>
                <tr>
                    <th><?= Yii::t('app.f12.ecommerce', 'Item title') ?></th>
                    <th><?= Yii::t('app.f12.ecommerce', 'Parameters') ?></th>
                    <th><?= Yii::t('app.f12.ecommerce', 'Quantity') ?></th>
                    <th><?= Yii::t('app.f12.ecommerce', 'Price') ?></th>
                    <th><?= Yii::t('app.f12.ecommerce', 'Sum') ?></th>
                </tr>
                <?php if ($model->cart->rows) foreach ($model->cart->rows as $row) echo $this->render('_index', ['row' => $row, 'editable' => false]) ?>
                </tbody>
            </table>
            <div class="cart-total">
                <?= Yii::t('app.f12.ecommerce', 'Total') ?>: <span><?= $model->cart->total ?></span>
            </div>
        </div>

        <div class="col-md-5">

            <?= $form->field($model, 'fullname')
                ->textInput([
                    'data-description' => Yii::t('app.f12.ecommerce', 'Enter the name here.'),
                    'data-description-show' => 'true'
                ]); ?>

            <div class="row">
                <div class="col-xs-6">
                    <?= $form->field($model, 'email')->textInput([
                        'data-description' => Yii::t('app.f12.ecommerce', 'We need your email so that we can send the details of the order and contact you.'),
                        'data-description-show' => 'true'
                    ]); ?>
                </div>
                <div class="col-xs-6">
                    <?= $form->field($model, 'phone')->widget(MaskedInput::class, [
                        'mask' => '+9 (999) 999-99-99'
                    ])->textInput([
                        'data-description' => Yii::t('app.f12.ecommerce', 'We need your phone number to clarify delivery issues.'),
                        'data-description-show' => 'true'
                    ]); ?>
                </div>
            </div>

            <?= $form->field($model, 'delivery_type_id')->dropDownList(DeliveryType::listData()) ?>

            <?= $form->field($model, 'address')->textarea([
                'data-description' => Yii::t('app.f12.ecommerce', 'Please enter a valid shipping address.'),
                'data-description-show' => 'true'
            ]) ?>

            <?= $form->field($model, 'comment')
                ->label( Yii::t('app.f12.ecommerce', 'Additional comment'))
                ->textarea([
                'data-description' => Yii::t('app.f12.ecommerce', 'If you have additional comments or wished, please describe them here.'),
                'data-description-show' => 'true'
            ]) ?>

            <?= Html::submitButton(Yii::t('app.f12.ecommerce', 'Send'), ['class' => 'btn btn-primary']) ?>


        </div>
    </div>

<?php ActiveForm::end() ?>