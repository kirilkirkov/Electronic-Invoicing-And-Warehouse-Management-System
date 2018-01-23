<h3>Plan Payment Requests</h3>
<hr>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>user id</th>
            <th>request number</th>
            <th>plan type</th>
            <th>must pay</th>
            <th colspan="2">date generated</th> 
        </tr>
    </thead>
    <tbody>
        <?php
        if (!empty($requests)) {
            foreach ($requests as $request) {
                ?>
                <tr>
                    <td><?= $request['for_user'] ?></td>
                    <td><?= $request['req_num'] ?></td>
                    <td><?= $request['plan_type'] ?></td>
                    <td>
                        <?php if ($request['plan_type'] == 'CUSTOM') { ?>
                            <?= $request['price'] ?>
                        <?php } else { ?>
                            <?= $defaultPlans[$request['plan_type']]['PRICE'] ?>
                        <?php } ?>
                    </td>
                    <td><?= date('d.m.Y', $request['date_generated']) ?></td>
                    <td class="text-right">
                        <a href="<?= base_url('admin/plans/requests?activate=' . $request['id']) ?>" onclick="return confirm('Are you sure?')" class="btn btn-success">Activate</a>
                    </td>
                </tr>
                <?php
            }
        } else {
            ?>
            <tr>
                <td colspan="5">No payment requests</td>
            </tr>
        <?php } ?>
    </tbody>
</table>
<?= $links_pagination ?>