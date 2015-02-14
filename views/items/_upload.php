<?php
use yii\helpers\Html;

echo '<hr>';
echo Html::beginForm(
    '/item/upload',
    'post',
    ['enctype' => 'multipart/form-data', 'id' => 'form-upload-images', 'class' => 'form-horizontal']) ?>
        <?= Html::activeHiddenInput($model, 'item_id', ['value' => $item->id]); ?>

        <div class="form-group">
        <?php
        if (YII_ENV === 'test') {
            echo Html::activeFileInput($model, 'file[0]', ['id' => 'fileupload', 'multiple' => '']);
            echo Html::submitInput('Upload');
        } else {
            echo '<label class="col-sm-2 control-label">Previews:</label>';
            echo '<div class="col-sm-8">';
                echo Html::activeFileInput($model, 'file[]', ['id' => 'fileupload', 'multiple' => '']);
            echo '</div>';
        }
        ?>
        </div>
<?= Html::endForm() ?>