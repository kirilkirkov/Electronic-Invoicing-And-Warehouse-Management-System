<div class="row">
    <div class="col-sm-6">
        <h3>Frequently Asked Questions</h3>
    </div>
    <div class="col-sm-6">
        <a href="<?= base_url('admin/addquestion') ?>" class="btn btn-default pull-right">Add Question</a>
    </div>
</div>
<div class="row">
    <div class="col-xs-12">
        <div class="x_panel"> 
            <div class="x_content">
                <?php
                if (!empty($questions)) {
                    ?>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Question</th>
                                    <th>Answer</th>
                                    <th>Position</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($questions as $question) {
                                    ?>
                                    <tr>
                                        <td><?= $question['question'] ?></td>
                                        <td><?= $question['answer'] ?></td>
                                        <td><?= $question['position'] ?></td>
                                        <td>
                                            <a href="<?= base_url('admin/addquestion?edit=' . $question['id']) ?>" class="btn btn-xs btn-primary">Edit</a>
                                            <a href="?delete=<?= $question['id'] ?>" class="btn btn-xs btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                                        </td>
                                    </tr>
                                <?php }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <?php
                } else {
                    ?>
                    No Frequently Asked Questions
                <?php } ?>
            </div>
        </div>
    </div>
</div> 