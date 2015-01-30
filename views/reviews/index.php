<?php
use yii\helpers\Html;
use yii\helpers\Url;
use app\components\HelperBase;

$this->params['isReviewsPage'] = true;
?>
<div class="row">
    <div class="col-md-8 col-md-offset-2">
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
            $counter = 1;
            foreach ($data as $reviewItem) {
                echo "<tr>";
                    echo "<td>", $counter++, "</td>";
                    echo "<td>", HelperBase::formatDate($reviewItem['post_date']), "</td>";
                    echo "<td>", $reviewItem->type['title'], "</td>";
                    echo "<td>", Html::a($reviewItem['title'], Url::to('/reviews/view/' . $reviewItem->id)), "</td>";
                echo "</tr>";
            }
            ?>
            </tbody>
        </table>
        <?= $this->render('../shared/linkPager', ['pages' => $pages]) ?>
    </div>
</div>