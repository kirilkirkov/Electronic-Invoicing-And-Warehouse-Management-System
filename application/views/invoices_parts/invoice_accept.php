<div class="container">
    <div class="inv-accept"> 
        <a href="<?= base_url() ?>" class="logo">
            <img src="<?= base_url('assets/public/imgs/logo.png') ?>" alt="PMInvoice">
        </a>
        <hr>
        <div>
            <?php
            $typeTranslate = '';
            if ($invoice['inv_type'] == 'tax_inv') {
                $typeTranslate = $invoice['translation']['invoice'];
            }
            if ($invoice['inv_type'] == 'prof') {
                $typeTranslate = $invoice['translation']['pro_forma'];
            }
            if ($invoice['inv_type'] == 'debit') {
                $typeTranslate = $invoice['translation']['debit_note'];
            }
            if ($invoice['inv_type'] == 'credit') {
                $typeTranslate = $invoice['translation']['credit_note'];
            }
            ?>
            <h1><?= $invoice['translation']['receive_inv'] . ' ' . $typeTranslate . ' ' . $invoice['translation']['receive_inv_from'] ?> <?= $invoice['firm']['name'] ?></h1>
        </div>
        <div class="view-container">
            <div class="pageDelivery hidden"></div>
            <div class="invoice-box">
                <?php include $templateFile; ?>
            </div>
        </div>
        <?php if ($invoice['status'] != 'accepted' && $invoice['status'] != 'refused') { ?>
            <form method="POST" action="" id="invReceiveAction">
                <input type="hidden" name="action" value="">
                <div class="row">
                    <div class="col-sm-6">
                        <a href="javascript:void(0);" onclick="invReceiveAction('accepted')" class="btn btn-success action">
                            <i class="fa fa-2x fa-check-circle-o" aria-hidden="true"></i>
                            <span><?= $invoice['translation']['i_accept'] ?></span>
                        </a>
                    </div>
                    <div class="col-sm-6">
                        <a href="javascript:void(0);" onclick="invReceiveAction('refused')" class="btn btn-danger action">
                            <i class="fa fa-2x fa-times-circle-o" aria-hidden="true"></i>
                            <span><?= $invoice['translation']['i_refuse'] ?></span>
                        </a>
                        <textarea name="refuse_reason" class="refuse-reason" placeholder="<?= lang('p_reason') ?>"></textarea>
                    </div>
                </div>
            </form>
        <?php } if ($invoice['status'] == 'accepted' || $invoice['status'] == 'refused') { ?>
            <div class="status-label <?= $invoice['status'] == 'accepted' ? 'bg-success' : 'bg-danger' ?>">
                <?= lang('status_' . $invoice['status']) ?>
            </div>
        <?php } ?>
        <hr>
        <p class="footer-text">
            <?= lang('create_and_send_inv_with') ?> - 
            <a href="">
                pminvoice.com
            </a>
        </p>
    </div>
</div>