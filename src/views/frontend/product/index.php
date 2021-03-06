<?php
/**
 * Created by PhpStorm.
 * User: floor12
 * Date: 17/10/2018
 * Time: 21:26
 *
 * @var $this \yii\web\View
 * @var $model \floor12\ecommerce\models\filters\FrontendProductFilter
 *
 */

use kartik\form\ActiveForm;
use yii\web\View;
use yii\widgets\ListView;
use yii\widgets\Pjax;


?>

<h1><?= $model->pageTitle ?></h1>
<div class="row">
    <div class="col-md-3">
        <div class="item-filter">

            <?php $form = ActiveForm::begin([
                'method' => 'GET',
                'enableClientValidation' => false,
                'id' => 'f12-eccomerce-product-filter'
            ]);
            ?>

            <?= $form->field($model, "category_id")
                ->label(Yii::t('app.f12.ecommerce', 'Categories'))
                ->widget(\yii\bootstrap\ToggleButtonGroup::class, [
                    'items' => $model->category_list,
                    'type' => 'radio',
                    'options' => ['class' => 'btn-group'],
                    'labelOptions' => ['class' => 'btn btn-default']

                ]); ?>

            <div class="product-additional-filter">
                <button type="button" onclick="$(this).parent().toggleClass('open')" aria-label="Показать или скрыть фильтры"
                        class="filter-toggle btn
                btn-default
                btn-block">
                    <span>Скрыть  фильтры</span>
                    <span>Показать фильтры</span>
                </button>
                <div class="filters">

                    <?= $form->field($model, 'priceMinValue')->label(false)->hiddenInput() ?>
                    <?= $form->field($model, 'priceMaxValue')->label(false)->hiddenInput() ?>


                    <?= $form->field($model, 'price')
                        ->label('Цена')
                        ->widget(\floor12\ecommerce\components\PriceSlider::class, [
                            'lowerValueContainerId' => 'frontendproductfilter-priceminvalue',
                            'upperValueContainerId' => 'frontendproductfilter-pricemaxvalue',
                            'pluginOptions' => [
                                'start' => [$model->priceMinValue, $model->priceMaxValue],
                                'connect' => true,
                                'tooltips' => true,
                                'pips' => [
                                    'mode' => 'steps',
                                    'stepped' => true,
                                    'density' => 4,
                                    'format' > [
                                        'decimals' => 0,
                                    ],
                                ],
                                'range' => [
                                    'min' => $model->priceMin,
                                    'max' => $model->priceMax
                                ]
                            ]
                        ]);
                    ?>



                    <?= $form->field($model, "sort")
                        ->label(Yii::t('app.f12.ecommerce', 'Sorting'))
                        ->widget(\yii\bootstrap\ToggleButtonGroup::class, [
                            'items' => \floor12\ecommerce\models\enum\SortVariations::listData(),
                            'type' => 'radio',
                            'options' => ['class' => 'btn-group'],
                            'labelOptions' => ['class' => 'btn btn-default']

                        ]); ?>



                    <?php foreach ($model->parameters as $parameterId => $parameter) {
                        if (!empty($model->data[$parameterId]))
                            echo $form->field($model, "values[{$parameterId}]")
                                ->label($model->parameters[$parameterId]->title)
                                ->checkboxButtonGroup($model->data[$parameterId]);
                    } ?>

                    <?php if ($model->showDiscountOption): ?>
                        <div data-toggle="buttons">
                            <label class="btn btn-default btn-sm">
                                <input type="checkbox"
                                       autocomplete="off" <?= $model->discount ? "checked=checked" : NULL ?>
                                       name="ItemFrontendFilter[discount]"> <?= Yii::t('app.f12.ecommerce', 'only discounted goods') ?>
                            </label>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <?php ActiveForm::end() ?>

        </div>
    </div>
    <div class="col-md-9">

        <div class="f12-ec-products">
            <div class="row">
                <?php foreach ($model->getProducts() as $product)
                    echo $this->render(Yii::$app->getModule('shop')->viewIndexListItem, ['model' => $product]);
                ?>
            </div>

            <button id="load-more" onclick="f12Listview.next();" class="load-more"
                    style="<?= $model->count() == sizeof($model->getProducts()) ? 'display:none;' : NULL ?>">
                <span class="downloading"><?= Yii::t('app.f12.ecommerce', 'downloading...') ?></span>
                <span class="info"><?= Yii::t('app.f12.ecommerce', 'show more') ?></span>
            </button>
        </div>
    </div>
</div>

<?= $this->params['currentPage']->content ?>
