<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <?= $this->render('../shared/linkPager', ['pages' => $pages]) ?>
        <table class="table table-striped table-hover news-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Date</th>
                    <th>Title</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $counter = 1;
            foreach ($data as $newsItem) {
                echo "<tr>";
                    echo "<td>", $counter++, "</td>";
                    echo "<td>", $newsItem['post_date'],"</td>";
                    echo "<td>", Html::a($newsItem['title'], Url::to('/news/view/' . $newsItem->id)), "</td>";
                echo "</tr>";
            }
            ?>
            </tbody>
        </table>
        <?= $this->render('../shared/linkPager', ['pages' => $pages]) ?>
    </div>
</div>