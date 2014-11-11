<?php
use app\components\HelperMarketPlace;
/* @var $this yii\web\View */
?>
<p>
<form class="form-horizontal" role="form">
    <div class="form-group">
        <label for="sort" class="col-md-1 control-label">Sort:</label>
        <div class="col-md-2">
            <?= HelperMarketPlace::generateSortDropDown($this) ?>
        </div>
    </div>
</form>
<div class="clearfix"></div>
</p>