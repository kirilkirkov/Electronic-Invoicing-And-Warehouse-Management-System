<h3>Custom Plan Requests</h3>
<hr>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>user id</th>
            <th>invoices</th>
            <th>companies</th>
            <th colspan="2">time</th> 
        </tr>
    </thead>
    <tbody>
        <?php
        if (!empty($requests)) {
            foreach ($requests as $request) {
                ?>
                <tr>
                    <td><?= $request['for_user'] ?></td>
                    <td><?= $request['invoices'] ?></td>
                    <td><?= $request['companies'] ?></td>
                    <td><?= date('d.m.Y', $request['time']) ?></td>
                    <td class="text-right">
                        <form action="" id="myForm" method="GET">
                            <input type="hidden" name="activate" value="<?= $request['id'] ?>">
                            <input type="hidden" name="for_user" value="<?= $request['for_user'] ?>">
                            <input type="text" name="price" style="border:1px solid #e9e9e9; height: 35px;" placeholder="Set Price">
                        </form>
                        <a href="javascript:void(0);" onclick="document.getElementById('myForm').submit();" class="btn btn-success">Activate</a>
                        <a href="<?= base_url('admin/plans/individual/request?reject=' . $request['id']) ?>" onclick="return confirm('Are you sure?')" class="btn btn-danger">Reject</a>
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