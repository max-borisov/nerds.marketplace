<?php

use yii\helpers\Html;

?>

<!-- The fileinput-button span is used to style the file input field as button -->
<form method="post" enctype="multipart/form-data" action="/item/upload" id="form-upload-images">
<?= Html::beginForm(
    '/upload',
    'post',
    ['enctype' => 'multipart/form-data', 'id' => 'form-upload-images']) ?>
    <span class="btn btn-success fileinput-button">
    <i class="glyphicon glyphicon-plus"></i>
    <span>Select files...</span>
    <!-- The file input field used as target for the file upload widget -->
<!--    <input id="fileupload" type="file" name="files[]" multiple="">-->
    <?= Html::activeHiddenInput($model, 'item_id', ['value' => $item->id]); ?>
    <?= Html::activeFileInput($model, 'file[]', ['id' => 'fileupload', 'multiple' => '']); ?>
</span>
</form>