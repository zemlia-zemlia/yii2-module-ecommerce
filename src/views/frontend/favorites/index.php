<?php
/**
 * Created by PhpStorm.
 * User: evgenygoryaev
 * Date: 14/08/2017
 * Time: 15:47
 * @var $this \yii\web\View
 */

use yii\helpers\Html;

?>

<div class="modal-header">
    <div class="pull-right">
        <?= \floor12\editmodal\EditModalHelper::btnClose() ?>
    </div>
    <h2><?= Yii::t('app.f12.ecommerce', 'Favorites') ?></h2>
</div>
<div class="modal-body row">

</div>
<div class="modal-footer">
    <?= Html::a(Yii::t('app.f12.ecommerce', 'Close'), '', ['class' => 'btn btn-default modaledit-disable-silent']) ?>
</div>
