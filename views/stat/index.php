<div class="row">
    <div class="col-md-6">
        <table class="table">
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
                <tr>
                    <td>Total:</td>
                    <td><?= $data['itemsTotal'] ?></td>
                    <td><?= $data['newsTotal'] ?></td>
                    <td><?= $data['reviewsTotal'] ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>