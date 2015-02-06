<div class="row">
    <div class="col-md-8 col-lg-offset-2">
        <h1 class="text-center">Stat</h1>
        <table class="table table-bordered stat-table table-hover">
            <thead>
                <tr>
                    <th></th>
                    <th>Items</th>
                    <th>News</th>
                    <th>Reviews</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>HiFi4all.dk</td>
                    <td><?= $data['items'] ?></td>
                    <td><?= $data['newsHiFi'] ?></td>
                    <td><?= $data['reviewsHiFi'] ?></td>
                </tr>
                <tr>
                    <td>Recordere.dk</td>
                    <td>0</td>
                    <td><?= $data['newsRec'] ?></td>
                    <td><?= $data['reviewsRec'] ?></td>
                </tr>
                <tr class="warning">
                    <td>Total:</td>
                    <td><?= $data['itemsTotal'] ?></td>
                    <td><?= $data['newsTotal'] ?></td>
                    <td><?= $data['reviewsTotal'] ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>