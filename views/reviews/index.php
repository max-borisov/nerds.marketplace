<?php
use yii\helpers\Html;
use yii\helpers\Url;
use app\components\HelperBase;
use app\models\ReviewType;

$this->params['isReviewsPage'] = true;
?>
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <p class="lead">There are <span class="badge"><?= $pages->totalCount ?></span> reviews in the catalog.</p>
        <?php
        if ($category) {
            $categoryTitle = ReviewType::find()->where('id = :category', [':category' => $category])->one()->title;
        ?>
            <p class="lead">
                Reviews category - <strong><?= $categoryTitle ?>.</strong>
                <a href="/reviews" class="btn btn-primary">Reset filter</a>
            </p>
        <?php } ?>
        <?= $this->render('../shared/linkPager', ['pages' => $pages]) ?>
        <table class="table table-striped table-hover news-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Date</th>
                    <th>Category</th>
                    <th>Title</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $counter = $pages->getPage() * $pages->getPageSize() + 1;
            foreach ($data as $reviewItem) {
                echo "<tr>";
                    echo "<td>", $counter++, "</td>";
                    echo "<td>", HelperBase::formatDate($reviewItem['post_date']), "</td>";
                    echo "<td>", Html::a($reviewItem->type['title'], '?category=' . $reviewItem->type['id']), "</td>";
                    echo "<td>", Html::a($reviewItem['title'], Url::to('/reviews/view/' . $reviewItem->id)), "</td>";
                echo "</tr>";
            }
            ?>
            </tbody>
        </table>
        <?= $this->render('../shared/linkPager', ['pages' => $pages]) ?>
    </div>
</div>