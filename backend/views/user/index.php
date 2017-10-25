
<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\models\User;
use yii\widgets\Pjax;
?>
<script>
    $(document).ready(function () {
    }
</script>


<?php Pjax::begin(['enablePushState' => false]); ?>
<?= Html::beginForm(['index'], 'post', ['data-pjax' => '', 'class' => 'form-inline']); ?>
<?= Html::input('text', 'string', Yii::$app->request->post('string'), ['class' => 'form-control input-sm', 'id' => 'input-user-search']) ?>
<?= Html::submitButton(' ? ', ['class' => 'btn btn-sm btn-primary', 'id' => 'btn-user-search']) ?>
<?= Html::endForm() ?>

<table class="table table-bordered table-striped" id = "userTable">
    <tr class="label-info">
        <td>Логин</td>
        <td>Email</td>
        <td>Status</td>
        <td>Role</td>
    </tr>
    <?php  foreach($model as $item) : ?>
        <tr>
            <td><?= $item->username ?></td>
            <td><?= $item->email ?></td>
            <td><?= $item->status ?></td>
            <td><?= $item->role ?></td>
        </tr>
    <?php endforeach ?>
</table>


<?php Pjax::end(); ?>


