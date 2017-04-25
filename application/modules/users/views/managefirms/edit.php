<div class="selected-page">
    <div class="inner">
        <h1>
            <i class="fa fa-cog" aria-hidden="true"></i>
            <?= lang('selected_manage_firms') ?>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#">Home</a></li>
            <li><a href="#">Library</a></li>
            <li class="active">Data</li>
        </ol>
    </div>
    <div class="border"></div>
</div>
<div class="row">
    <div class="col-md-4 col-sm-6">
        <form class="site-form" method="POST" action=""> 
            <div class="form-group">
                <label><?= lang('firm_bulstat') ?></label>
                <input type="text" name="firm_bulstat" value="<?= $companyInfo['company']['bulstat'] ?>" class="form-control field">
            </div>
            <button type="submit" class="btn btn-default"><?= lang('save_changes') ?></button>
        </form>
        <h2><?= lang('firms_translations') ?></h2>
        <hr>
        <?php foreach ($companyInfo['translations'] as $translate) { ?> 
            <a href="<?= lang_url('user/managefirms/edit/' . $companyInfo['company']['id'] . '/' . $translate['id']) ?>"> 
                <?= $translate['trans_name'] ?>
                <?php if ($translate['is_default'] == 1) { ?>
                    <span class="label label-success"><?= lang('translation_is_default') ?></span>
                <?php } ?>
            </a>
            <?php if ($translate['is_default'] == 0) { ?>
                <a href="<?= lang_url('user/managefirms/edit/' . $companyInfo['company']['id'] . '?makeDefault=' . $translate['id']) ?>"><?= lang('make_translation_default') ?></a>
            <?php } ?>
            <br>
        <?php } ?>  
        <br>
        <a href="javascript:void(0);" data-toggle="modal" data-target="#modalAddTranslation" class="btn btn-default"><?= lang('add_translation') ?></a>
    </div> 
    <div class="col-md-4 col-sm-6"> 
        <form class="site-form" method="POST" action="" enctype="multipart/form-data"> 
            <input type="hidden" name="translation_id" value="<?= $companyTranslate['id'] ?>">
            <div class="form-group">
                <label><?= lang('trans_name') ?></label>
                <input type="text" name="trans_name" class="form-control field" value="<?= $companyTranslate['trans_name'] ?>">
            </div> 
            <div class="form-group">
                <label><?= lang('firm_name') ?></label>
                <input type="text" name="firm_name" class="form-control field" value="<?= $this->session->flashdata('firm_name') != null ? $this->session->flashdata('firm_reg_address') : $companyTranslate['name'] ?>">
            </div> 
            <div class="form-group">
                <label><?= lang('firm_reg_address') ?></label>
                <textarea name="firm_reg_address" class="form-control field"><?= $this->session->flashdata('firm_reg_address') != null ? $this->session->flashdata('firm_reg_address') : $companyTranslate['address'] ?></textarea>
            </div>
            <div class="form-group">
                <label><?= lang('firm_city') ?></label>
                <input type="text" name="firm_city" value="<?= $this->session->flashdata('firm_city') != null ? $this->session->flashdata('firm_city') : $companyTranslate['city'] ?>" class="form-control field">
            </div>
            <div class="form-group">
                <label><?= lang('firm_mol') ?></label>
                <input type="text" name="firm_mol" value="<?= $this->session->flashdata('firm_mol') != null ? $this->session->flashdata('firm_mol') : $companyTranslate['mol'] ?>" class="form-control field">
            </div>
            <div class="form-group">
                <input type="hidden" name="old_image" value="<?= $companyTranslate['image'] ?>">
                <div><img src="<?= base_url('attachments/' . COMPANIES_IMAGES_DIR . '/' . $companyInfo['company']['id'] . '/' . $companyTranslate['image']) ?>" alt="<?= lang('no_image') ?>"></div>
                <label><?= lang('firm_image') ?></label>
                <input type="file" name="input_file">
            </div> 
            <button type="submit" name="saveTranslate" class="btn btn-default"><?= lang('save_translation') ?></button>
        </form>
    </div>
</div>
<!-- Modal Add Translation -->
<div class="modal fade" id="modalAddTranslation" tabindex="-1" role="dialog" aria-labelledby="modalAddTranslation">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="site-form" method="POST" action="" enctype="multipart/form-data"> 
                <input type="hidden" name="addFirm" value="">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel"><?= lang('add_new_translation') ?></h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label><?= lang('trans_name') ?></label>
                        <input type="text" name="trans_name" class="form-control field" value="<?= trim($this->session->flashdata('trans_name')) ?>">
                    </div>
                    <div class="form-group">
                        <label><?= lang('firm_name') ?></label>
                        <input type="text" name="firm_name" class="form-control field" value="<?= trim($this->session->flashdata('firm_name')) ?>">
                    </div>
                    <div class="form-group">
                        <label><?= lang('firm_reg_address') ?></label>
                        <textarea name="firm_reg_address" class="form-control field"><?= trim($this->session->flashdata('firm_reg_address')) ?></textarea>
                    </div>
                    <div class="form-group">
                        <label><?= lang('firm_city') ?></label>
                        <input type="text" name="firm_city" value="<?= trim($this->session->flashdata('firm_city')) ?>" class="form-control field">
                    </div>
                    <div class="form-group">
                        <label><?= lang('firm_mol') ?></label>
                        <input type="text" name="firm_mol" value="<?= trim($this->session->flashdata('firm_mol')) ?>" class="form-control field">
                    </div>
                    <div class="form-group"> 
                        <label><?= lang('firm_image') ?></label>
                        <input type="file" name="input_file">
                    </div> 
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><?= lang('close') ?></button>
                    <button type="submit" name="add_new_translation" class="btn btn-primary"><?= lang('add_new_translation') ?></button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
if ($this->session->flashdata('addNewTranslationErr') == '1') {
    ?>
    <script>
        $(document).ready(function () {
            $('#modalAddTranslation').modal('show');
        });
    </script>
    <?php
}
?>