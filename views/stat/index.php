<?php
$this->params['isStatPage'] = true;
?>
<div class="row">
    <div class="col-md-12">
        <h1 class="text-center">Stat</h1>
        <table class="table table-bordered stat-table table-hover">
            <thead>
                <tr>
                    <th></th>
                    <th>Items</th>
                    <th>News</th>
                    <th>Reviews</th>
                    <th>Games</th>
                    <th>TV</th>
                    <th>Music</th>
                    <th>Movies</th>
                    <th>Media</th>
                    <th>Radio</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>HiFi4all.dk</td>
                    <td><?= $data['itemsHiFi'] ?></td>
                    <td><?= $data['newsHiFi'] ?></td>
                    <td><?= $data['reviewsHiFi'] ?></td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                </tr>
                <tr>
                    <td>Recordere.dk</td>
                    <td>0</td>
                    <td><?= $data['newsRec'] ?></td>
                    <td><?= $data['reviewsRec'] ?></td>
                    <td><?= $data['gamesRec'] ?></td>
                    <td><?= $data['tvRec'] ?></td>
                    <td><?= $data['musicRec'] ?></td>
                    <td><?= $data['moviesRec'] ?></td>
                    <td><?= $data['mediaRec'] ?></td>
                    <td><?= $data['radioRec'] ?></td>
                </tr>
                <tr>
                    <td>dba.dk</td>
                    <td><?= $data['itemsDba'] ?></td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                </tr>
                <tr class="warning">
                    <td>Total:</td>
                    <td><?= $data['itemsTotal'] ?></td>
                    <td><?= $data['newsTotal'] ?></td>
                    <td><?= $data['reviewsTotal'] ?></td>
                    <td><?= $data['gamesRec'] ?></td>
                    <td><?= $data['tvRec'] ?></td>
                    <td><?= $data['musicRec'] ?></td>
                    <td><?= $data['moviesRec'] ?></td>
                    <td><?= $data['mediaRec'] ?></td>
                    <td><?= $data['radioRec'] ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>