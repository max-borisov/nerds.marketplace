<?php
use yii\helpers\Html;
use yii\helpers\Url;
use app\components\HelperBase;
?>
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <p class="lead">There are <span class="badge"><?= $pages->totalCount ?></span> <?= $type ?> in the catalog.</p>
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
            $counter = $pages->getPage() * $pages->getPageSize() + 1;
            foreach ($data as $item) {
                echo "<tr>";
                echo "<td>", $counter++, "</td>";
                echo "<td>";
                if (HelperBase::isZeroDate($item['post_date'])) {
                    echo 'Unknown';
                } else {
                    echo HelperBase::formatDate($item['post_date']);
                }
                echo "</td>";
                echo "<td>", Html::a($item['title'], Url::to($url . $item->id)), "</td>";
                echo "</tr>";
            }
            ?>
            </tbody>
        </table>
        <?= $this->render('../shared/linkPager', ['pages' => $pages]) ?>
    </div>
</div>