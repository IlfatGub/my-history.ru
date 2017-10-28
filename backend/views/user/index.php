<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\models\User;
use yii\widgets\Pjax;

?>
<?php
$script = <<< JS
    $("#input-user-search").change (function () {
          $("#btn-user-search").trigger("click");
    });
JS;
?>


<?php Pjax::begin(['enablePushState' => false]); ?>

<?php $this->registerJs($script); ?>

<div style="margin-bottom: 10px">
    <?= Html::beginForm(['index'], 'post', ['data-pjax' => '']); ?>
    <div class="input-group">
        <?= Html::input('text', 'string', Yii::$app->request->post('string'), ['class' => 'form-control input-sm', 'id' => 'input-user-search']) ?>
        <span class="input-group-btn">
            <?= Html::submitButton('<span class="glyphicon glyphicon-search"></span>', ['class' => 'btn btn-sm btn-primary', 'id' => 'btn-user-search']) ?>
        </span>
    </div>
    <?= Html::endForm() ?>

</div>
<table class="table table-bordered table-striped" id="userTable">
    <tr class="label-info">
        <td>Логин</td>
        <td>Email</td>
        <td>Status</td>
        <td>Role</td>
    </tr>

    <?php foreach ($model as $item) : ?>
        <tr>
            <td><?= $item->username ?></td>
            <td><?= $item->email ?></td>
            <td><?= $item->getStatusName() ?></td>
            <td><?= $item->getRoleName() ?></td>
        </tr>
    <?php endforeach ?>
</table>

<?php Pjax::end(); ?>
