<?php
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $item app\models\Category */

use app\components\HelperPage;

$this->params['isCategoryPage'] = true;

echo $this->render('../shared/header', ['header' => HelperPage::CATEGORIES_PAGE_HEADER]);

if (Yii::$app->session->hasFlash('category_create_success')) {
    echo $this->render(
        '../shared/flashSuccess',
        ['message' => Yii::$app->session->getFlash('category_create_success')]
    );
}

if (Yii::$app->session->hasFlash('category_update_success')) {
    echo $this->render(
        '../shared/flashSuccess',
        ['message' => Yii::$app->session->getFlash('category_update_success')]
    );
}

if (Yii::$app->session->hasFlash('category_delete_success')) {
    echo $this->render(
        '../shared/flashSuccess',
        ['message' => Yii::$app->session->getFlash('category_delete_success')]
    );
}

if (Yii::$app->session->hasFlash('category_delete_error')) {
    echo $this->render(
        '../shared/flashError',
        ['message' => Yii::$app->session->getFlash('category_delete_error')]
    );
}
?>

<p>
    <?= Html::a('New category', '/category/create', ['type' => 'button', 'class' => 'btn btn-primary']) ?>
</p>

<table class="table table-striped table-hover category-table">
    <thead>
        <tr>
            <th>Num.</th>
            <th>Category title</th>
            <th>Attached items</th>
            <th>Created</th>
            <th>Updated</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $counter = 0;
        foreach ($data as $item) {
            echo "<tr>";
                echo '<td>' , ++$counter , '</td>';
                echo '<td>' , Html::encode($item->title) , '</td>';
                echo '<td>' , count($item->attachedItems) , '</td>';
                echo '<td>' , date('d/m/Y H:i:s', $item->created_at) , '</td>';
                echo '<td>' , date('d/m/Y H:i:s', $item->updated_at) , '</td>';
                echo '<td>'
                    , Html::a('Update', Url::to(['category/update', 'id' => $item->id]), ['id' => $counter == 1 ? 'first-link' : ''])
                    , '&nbsp;&nbsp;|&nbsp;&nbsp;'
                    , Html::a('Delete', Url::to(['category/delete', 'id' => $item->id]), ['class' => 'delete-category-link'])
                    ,'</td>';
            echo "</tr>";
        }
        ?>
    </tbody>
</table>