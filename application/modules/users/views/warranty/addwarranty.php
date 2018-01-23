<script src="<?= base_url('assets/plugins/math.min.js') ?>"></script>
<div class="selected-page">
    <div class="inner">
        <h1>
            <?= lang('add_warranty') ?>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= lang_url('user') ?>"><?= lang('home') ?></a></li> 
            <li><a href="<?= lang_url('user/warranties') ?>"><?= lang('warranties') ?></a></li>  
            <li class="active"><?= lang('add_warranty') ?></li>
        </ol>
    </div> 
</div>
<?php if ($this->permissions->hasPerm('perm_add_warranty')) { ?>
    <form action="" id="setWarrantyForm" class="site-form" method="POST"> 
        <?php if ($editId > 0) { ?>
            <input type="hidden" name="editId" value="<?= $editId ?>">
            <input type="hidden" name="onLoadItems" value="<?= implode(',', $currentItems) ?>">
        <?php } ?> 
        <div class="row">
            <div class="col-sm-6">  
                <div class="choose-translation">
                    <p><?= lang('explain_war_translation') ?></p>
                    <select class="selectpicker" name="warranty_translation" title="<?= lang('choose_war_translation') ?>">
                        <option value="2" selected=""><?= lang('default_inv_lang_fr') ?></option>
                        <option value="1"><?= lang('default_inv_lang_en') ?></option>
                        <?php
                        if (!empty($warrantiesLanguages)) {
                            foreach ($warrantiesLanguages as $waLanguage) {
                                ?>
                                <option value="<?= $waLanguage['id'] ?>"><?= $waLanguage['language_name'] ?>(<?= $waLanguage['id'] ?>)</option>
                                <?php
                            }
                        }
                        ?> 
                    </select>
                    <a href="javascript:void(0);" data-toggle="modal" data-target="#modalAddNewTranslation" class="btn btn-default">
                        <?= lang('add_war_translation') ?>
                    </a>
                    <a href="javascript:void(0);" data-toggle="modal" data-target="#modalExplainTranslation">
                        <i class="fa fa-question-circle" aria-hidden="true"></i>
                    </a>
                </div>
            </div> 
            <div class="col-sm-6">
                <div class="pull-right">  
                    <div class="choose-firm-translation">
                        <p><?= lang('explain_firm_translation') ?></p>
                        <select class="selectpicker" name="warranty_firm_translation"> 
                            <?php
                            foreach ($allForFirm['translations'] as $theFirm) {
                                ?>
                                <option value="<?= $theFirm['id'] ?>" <?= $theFirm['is_default'] == 1 ? 'selected="selected"' : '' ?>><?= $theFirm['trans_name'] ?></option>
                                <?php
                            }
                            ?> 
                        </select>
                    </div>
                </div>
            </div>
        </div>   
        <div class="create-document">
            <div class="inner">
                <div class="row head-content">
                    <div class="col-sm-6 col-md-5"> 
                        <div class="column-data client">
                            <label><?= lang('create_inv_client') ?></label> 
                            <input type="text" name="client_name" value="<?= isset($_POST['client']['client_name']) ? $_POST['client']['client_name'] : '' ?>" class="form-control field">
                            <a href="javascript:void(0);" data-choose-title="<?= lang('choose_client') ?>" data-selector-type="client" class="choose">
                                <i class="fa fa-bars" aria-hidden="true"></i>
                                <span><?= lang('create_inv_choose') ?></span>
                            </a> 
                            <div>
                                <div class="checkbox">
                                    <label><input type="checkbox" name="is_to_person" <?= isset($_POST['client']['is_to_person']) && $_POST['client']['is_to_person'] == 1 ? 'checked="checked"' : '' ?> id="individual-client" value=""><?= lang('create_inv_individual') ?></label>
                                </div>
                            </div>
                        </div>
                        <div class="column-data client client-company"  <?= isset($_POST['client']['is_to_person']) && $_POST['client']['is_to_person'] == 1 ? 'style="display:none;"' : '' ?>> 
                            <label><?= lang('create_inv_bulstat') ?></label> 
                            <input type="text" name="client_bulstat" value="<?= isset($_POST['client']['client_bulstat']) ? $_POST['client']['client_bulstat'] : '' ?>" class="form-control field">
                            <a href="javascript:void(0);" data-choose-title="<?= lang('choose_client') ?>" data-selector-type="client" class="choose">
                                <i class="fa fa-bars" aria-hidden="true"></i>
                                <span><?= lang('create_inv_choose') ?></span>
                            </a>
                            <div>
                                <div class="checkbox">
                                    <label><input type="checkbox" <?= isset($_POST['client']['client_vat_registered']) && $_POST['client']['client_vat_registered'] == 1 ? 'checked="checked"' : '' ?> name="client_vat_registered" id="client-vat-registered" value=""><?= lang('create_inv_client_vat_registered') ?></label>
                                </div>
                            </div>
                        </div>
                        <div class="column-data client-company client-vat-registered" <?= isset($_POST['client']['is_to_person']) && $_POST['client']['is_to_person'] == 1 ? 'style="display:none;"' : '' ?> <?= isset($_POST['client_vat_registered']) && $_POST['client_vat_registered'] == 1 ? 'style="display:block;"' : '' ?>>
                            <label><?= lang('create_inv_vat_number') ?></label>
                            <input type="text" value="<?= isset($_POST['client']['vat_number']) ? $_POST['client']['vat_number'] : '' ?>" name="vat_number" class="form-control field">
                        </div>
                        <div class="column-data client-company" <?= isset($_POST['client']['is_to_person']) && $_POST['client']['is_to_person'] == 1 ? 'style="display:none;"' : '' ?>>
                            <label><?= lang('create_inv_mol') ?></label>
                            <input type="text" value="<?= isset($_POST['client']['accountable_person']) ? $_POST['client']['accountable_person'] : '' ?>" name="accountable_person" class="form-control field">
                        </div>
                        <div class="column-data client-individial" <?= isset($_POST['client']['is_to_person']) && $_POST['client']['is_to_person'] == 1 ? 'style="display:block;"' : '' ?>>
                            <label><?= lang('create_inv_ident_num') ?></label>
                            <input type="text" value="<?= isset($_POST['client']['client_ident_num']) ? $_POST['client']['client_ident_num'] : '' ?>" name="client_ident_num" class="form-control field">
                        </div>
                        <div class="column-data">
                            <label><?= lang('create_inv_city') ?></label>
                            <input type="text" value="<?= isset($_POST['client']['client_city']) ? $_POST['client']['client_city'] : '' ?>" name="client_city" class="form-control field">
                        </div>
                        <div class="column-data">
                            <label><?= lang('create_inv_address') ?></label>
                            <input type="text" value="<?= isset($_POST['client']['client_address']) ? $_POST['client']['client_address'] : '' ?>" name="client_address" class="form-control field">
                        </div>
                        <div class="column-data">
                            <label><?= lang('create_inv_country') ?></label>
                            <input type="text" value="<?= isset($_POST['client']['client_country']) ? $_POST['client']['client_country'] : '' ?>" name="client_country" class="form-control field">
                        </div>
                        <div class="column-data client-company" <?= isset($_POST['is_to_person']) && $_POST['client']['is_to_person'] == 1 ? 'style="display:none;"' : '' ?>>
                            <label><?= lang('create_inv_recipient') ?></label> 
                            <input type="text" value="<?= isset($_POST['client']['recipient_name']) ? $_POST['client']['recipient_name'] : '' ?>" name="recipient_name" class="form-control field"> 
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-7">
                        <div class="invoice-setting">
                            <div class="column-data">
                                <span class="inv-type-num"><?= lang('create_warranty_id') ?></span> <label>№:</label>
                                <input type="text" name="warranty_number" value="<?= isset($_POST['warranty_number']) ? $_POST['warranty_number'] : $nextWarrantyNumber ?>" class="form-control field">
                            </div>
                            <div class="column-data">
                                <label><?= lang('create_warranty_from_date') ?></label>
                                <input type="text" name="valid_from_date" placeholder="dd.mm.yyyy" value="<?= isset($_POST['valid_from']) ? date('d.m.Y', $_POST['valid_from']) : date('d.m.Y', time()) ?>" class="form-control field datepicker">
                            </div>
                            <div class="column-data">
                                <label><?= lang('create_warranty_to_inv') ?></label>
                                <input type="text" name="to_invoice" placeholder="<?= lang('curr_name_for_int_use') ?>" value="<?= isset($_POST['to_invoice']) ? $_POST['to_invoice'] : '' ?>" class="form-control field">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-items">
                        <thead>
                            <tr>
                                <th></th>
                                <th><?= lang('create_war_item') ?></th>
                                <th><?= lang('create_war_months') ?></th>
                                <th><?= lang('create_war_serial_num') ?></th> 
                            </tr>
                        </thead>
                        <tbody class="body-items">
                            <?php
                            $thisDir = ltrim(str_replace(getcwd(), '', dirname(__FILE__)), '/');
                            if (isset($_POST['items'])) {
                                foreach ($_POST['items'] as $itemPost) {
                                    include $thisDir . '/itemTableTr.php';
                                }
                            } else {
                                include $thisDir . '/itemTableTr.php';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="items-features">
                    <a href="javascript:void(0);" class="add-new-item">
                        <i class="fa fa-plus"></i>
                        <?= lang('add_new_item_to_table') ?>
                    </a>
                </div>
                <div class="form-group">
                    <label><?= lang('warranty_conditions') ?></label>
                    <textarea class="form-control" name="conditions" rows="5"><?= isset($_POST['conditions']) ? $_POST['conditions'] : '' ?></textarea>
                </div> 
                <div class="form-group">
                    <label><?= lang('select_saved_condition') ?></labe>
                        <select class="selectpicker saved-condition"> 
                            <option value="" selected=""></option>
                            <?php
                            foreach ($myConditions as $myCondition) {
                                ?>
                                <option value="<?= $myCondition['id'] ?>"><?= $myCondition['condition_title'] ?></option>
                                <?php
                            }
                            ?> 
                        </select>
                        <?php
                        foreach ($myConditions as $myCondition) {
                            ?>
                            <div class="hidden" data-saved-condition="<?= $myCondition['id'] ?>">
                                <?= $myCondition['condition_description'] ?>
                            </div>
                            <?php
                        }
                        ?> 
                </div>
                <div class="row">
                    <div class="col-sm-5">
                        <div class="form-group">
                            <label><?= lang('warranty_received') ?></label>
                            <input type="text" class="form-control field" name="received" value="<?= isset($_POST['received']) ? $_POST['received'] : '' ?>">
                        </div>
                        <div class="form-group">
                            <label><?= lang('warranty_compiled') ?></label>
                            <input type="text" class="form-control field" name="compiled" value="<?= isset($_POST['compiled']) ? $_POST['compiled'] : '' ?>">
                        </div>
                    </div>
                </div>
                <div class="remarks">
                    <label><?= lang('create_inv_remarks') ?><sup><?= lang('visibile_for_client') ?></sup></label>
                    <textarea class="form-control field area" name="remarks"><?= isset($_POST['remarks']) ? $_POST['remarks'] : '' ?></textarea>
                </div> 
            </div> 
            <a href="javascript:void(0);" onclick="validateWarranty()" class="btn btn-green"><?= lang('create_warranty') ?></a>
            <?= lang('or') ?>
            <a href="<?= lang_url('user/warranties') ?>"><?= lang('open_warranties') ?></a>
        </div>
    </form>
    <?php
    include 'application/modules/users/views/invoices/modals/add_quantity_type.php';
    include 'application/modules/users/views/invoices/modals/add_payment_method.php';
    include 'application/modules/users/views/invoices/modals/selector.php';
    ?>
    <!-- Modal Explain Add Translations -->
    <div class="modal fade" id="modalExplainTranslation" tabindex="-1" role="dialog" aria-labelledby="modalExplainTranslation">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><?= lang('what_mean_new_translate') ?></h4>
                </div>
                <div class="modal-body">
                    <?= lang('what_mean_new_translate_explain') ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><?= lang('close') ?></button> 
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Create New Translation -->
    <div class="modal fade" id="modalAddNewTranslation" tabindex="-1" role="dialog" aria-labelledby="modalAddNewTranslation">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><?= lang('add_new_translation') ?></h4>
                </div>
                <div class="modal-body site-form">
                    <form method="POST" action="" id="formAddNewTranslate">
                        <input type="hidden" name="addNewWarrantyTranslation" value="1">
                        <div class="form-group">
                            <label><?= lang('trans_language_name') ?></label>
                            <input type="text" name="language_name" placeholder="<?= lang('lang_name_internal_use') ?>" value="" class="form-control field field-new-translate">
                        </div>
                        <div class="form-group">
                            <label><?= lang('trans_warranty_card') ?></label>
                            <input type="text" name="warranty_card" placeholder="<?= lang('your_translation') ?>" value="" class="form-control field field-new-translate">
                        </div>
                        <div class="form-group">
                            <label><?= lang('trans_date_valid') ?></label>
                            <input type="text" name="date_valid" placeholder="<?= lang('your_translation') ?>" value="" class="form-control field field-new-translate">
                        </div>
                        <div class="form-group">
                            <label><?= lang('trans_recipient') ?></label>
                            <input type="text" name="recipient" placeholder="<?= lang('your_translation') ?>" value="" class="form-control field field-new-translate">
                        </div>
                        <div class="form-group">
                            <label><?= lang('trans_sender') ?></label>
                            <input type="text" name="sender" placeholder="<?= lang('your_translation') ?>" value="" class="form-control field field-new-translate">
                        </div>
                        <div class="form-group">
                            <label><?= lang('trans_bulstat') ?></label>
                            <input type="text" name="bulstat" placeholder="<?= lang('your_translation') ?>" value="" class="form-control field field-new-translate">
                        </div>
                        <div class="form-group">
                            <label><?= lang('trans_address') ?></label>
                            <input type="text" name="address" placeholder="<?= lang('your_translation') ?>" value="" class="form-control field field-new-translate">
                        </div>
                        <div class="form-group">
                            <label><?= lang('trans_city') ?></label>
                            <input type="text" name="city" placeholder="<?= lang('your_translation') ?>" value="" class="form-control field field-new-translate">
                        </div>
                        <div class="form-group">
                            <label><?= lang('trans_product_name') ?></label>
                            <input type="text" name="product_name" placeholder="<?= lang('your_translation') ?>" value="" class="form-control field field-new-translate">
                        </div>
                        <div class="form-group">
                            <label><?= lang('trans_product_months') ?></label>
                            <input type="text" name="product_months" placeholder="<?= lang('your_translation') ?>" value="" class="form-control field field-new-translate">
                        </div>
                        <div class="form-group">
                            <label><?= lang('trans_product_valid_to') ?></label>
                            <input type="text" name="product_valid_to" placeholder="<?= lang('your_translation') ?>" value="" class="form-control field field-new-translate">
                        </div>
                        <div class="form-group">
                            <label><?= lang('trans_product_serial_num') ?></label>
                            <input type="text" name="product_serial_num" placeholder="<?= lang('your_translation') ?>" value="" class="form-control field field-new-translate">
                        </div>
                        <div class="form-group">
                            <label><?= lang('trans_page') ?></label>
                            <input type="text" name="page" placeholder="<?= lang('your_translation') ?>" value="" class="form-control field field-new-translate">
                        </div>
                        <div class="form-group">
                            <label><?= lang('trans_city') ?></label>
                            <input type="text" name="city" placeholder="<?= lang('your_translation') ?>" value="" class="form-control field field-new-translate">
                        </div>
                        <div class="form-group">
                            <label><?= lang('trans_remarks') ?></label>
                            <input type="text" name="remarks" placeholder="<?= lang('your_translation') ?>" value="" class="form-control field field-new-translate">
                        </div>
                        <div class="form-group">
                            <label><?= lang('trans_received') ?></label>
                            <input type="text" name="received" placeholder="<?= lang('your_translation') ?>" value="" class="form-control field field-new-translate">
                        </div>
                        <div class="form-group">
                            <label><?= lang('trans_compiled') ?></label>
                            <input type="text" name="compiled" placeholder="<?= lang('your_translation') ?>" value="" class="form-control field field-new-translate">
                        </div>
                        <div class="form-group">
                            <label><?= lang('trans_signature') ?></label>
                            <input type="text" name="signature" placeholder="<?= lang('your_translation') ?>" value="" class="form-control field field-new-translate">
                        </div>
                        <div class="form-group">
                            <label><?= lang('trans_warranty_conditions') ?></label>
                            <input type="text" name="warranty_conditions" placeholder="<?= lang('your_translation') ?>" value="" class="form-control field field-new-translate">
                        </div>
                        <div class="form-group">
                            <label><?= lang('trans_vat_number') ?></label>
                            <input type="text" name="vat_number" placeholder="<?= lang('your_translation') ?>" value="" class="form-control field field-new-translate">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <a href="javascript:void(0);" class="btn btn-default" onclick="saveNewTranslation()"><?= lang('save_new_translate') ?></a>
                    <button type="button" class="btn btn-default" data-dismiss="modal"><?= lang('close') ?></button> 
                </div>
            </div>
        </div>
    </div> 
    <?php
    /*
     * if edit warranty and have more from one items
     * show action buttons
     */
    if (isset($_POST['items']) && count($_POST['items']) > 1) {
        ?>
        <style>
            .create-document .actions {display: block;}
        </style>
    <?php }
    ?>
    <script>
        var createDocument = {
            rountTo: <?= $opt_movementRoundTo ?>,
            calculatorStatus: <?= $opt_movementCalculator ?>
        };
    </script>
<?php } else { ?>
    <h1 class="no-permissions"><?= lang('no_permissions') ?></h1>
<?php } ?>
