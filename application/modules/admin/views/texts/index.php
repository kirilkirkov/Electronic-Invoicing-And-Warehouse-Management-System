<script src="<?= base_url('assets/ckeditor/ckeditor.js') ?>"></script>
<div class="right_col" id="texts-pages" role="main"> 
    <div class="page-title">
        <div class="title_left">
            <h3>Pages Texts</h3>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-xs-12">
            <div class="x_panel"> 
                <div class="x_content">
                    <a href="javascript:void(0);" data-toggle="modal" data-target="#addText" class="btn btn-primary btn-xs pull-right"><b>+</b> Add text</a>
                    <div class="clearfix"></div>
                    <div class="panel-group" id="faqAccordion">
                        <?php
                        $i = 0;
                        foreach ($texts as $text) {
                            ?>
                            <div class="panel panel-default">
                                <div class="panel-heading accordion-toggle question-toggle collapsed" data-toggle="collapse" data-parent="#faqAccordion" data-target="#question<?= $text['id'] ?>">
                                    <h4 class="panel-title">
                                        <a href="javascript:void(0);" class="ing"><?= $text['info'] ?></a>
                                    </h4>
                                </div>
                                <div id="question<?= $text['id'] ?>" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <form method="POST" action="">
                                            <input type="hidden" value="<?= $text['id'] ?>" name="edit_id">
                                            <input type="hidden" value="<?= $text['info'] ?>" name="info">
                                            <?php
                                            foreach ($text['translations'] as $abbr => $translate) {
                                                ?>
                                                <input type="hidden" name="abbr[]" value="<?= $abbr ?>">
                                                <div class="form-group">
                                                    <label for="text_e<?= $i ?>">Text (<?= $abbr ?>)</label>
                                                    <textarea name="text_e[]" class="form-control" id="text_e<?= $i ?>"><?= $translate ?></textarea>
                                                </div>
                                                <script>
                                                    CKEDITOR.replace('text_e<?= $i ?>');
                                                </script>
                                                <?php
                                                $i++;
                                            }
                                            ?>
                                            <input type="submit" class="btn btn-primary" value="Save">
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div> 
</div>
<!-- Add Text -->
<div class="modal fade" id="addText" tabindex="-1" role="dialog" aria-labelledby="addText">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="" method="POST">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Add Text</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="admin_info">Admin Info</label>
                        <input type="text" name="admin_info" class="form-control" id="admin_info">
                    </div>
                    <div class="form-group">
                        <label for="my_key">Page Key</label>
                        <input type="text" name="my_key" class="form-control" id="my_key">
                    </div>
                    <?php
                    $i = 0;
                    foreach ($languages->result() as $language) {
                        ?>
                        <input type="hidden" name="abbr[]" value="<?= $language->abbr ?>">
                        <div class="form-group">
                            <label for="text<?= $i ?>">Text (<?= ucfirst($language->name) ?><img src="<?= base_url('attachments/langflags/' . $language->flag) ?>" class="flag" alt="">)</label>
                            <textarea name="text[]" class="form-control" id="text<?= $i ?>"></textarea>
                        </div>
                        <script>
                            CKEDITOR.replace('text<?= $i ?>');
                        </script>
                        <?php
                        $i++;
                    }
                    ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>