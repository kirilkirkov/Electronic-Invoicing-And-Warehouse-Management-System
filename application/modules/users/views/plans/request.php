<div class="selected-page">
    <div class="inner">
        <h1> 
            <?= lang('my_plan_request') ?>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= lang_url('user') ?>"><?= lang('home') ?></a></li>
            <li class="active"><?= lang('my_plan_request') ?></li>
        </ol>
    </div> 
</div>
<?php if ($this->permissions->hasPerm('perm_view_plans_page')) { ?>
    <div class="plan-req-page">
        <h1><?= lang('payment_awaiting') ?></h1>
        <hr>
        <div class="payment-request">
            <div><b><?= lang('plan_payment_type') ?>:</b> <?= $paymentReq['payment_type'] == 'bank' ? lang('plan_payment_bank') : lang('plan_payment_paypal') ?></div>
            <div>
                <b><?= lang('plan_type') ?>:</b> <?= lang('plan_' . strtolower($paymentReq['plan_type'])) ?>(<?= $plans[$paymentReq['plan_type']]['NUM_INVOICES'] . ' ' . lang('plans_num_inv') . ', ' . $plans[$paymentReq['plan_type']]['NUM_FIRMS'] . ' ' . lang('plans_num_firms') ?>)
            </div>
            <div><b><?= lang('plan_period') ?>:</b> <?= $paymentReq['plan_period'] . ' ' . lang('plan_period_months') ?> (<?= $plans[$paymentReq['plan_type']]['PRICE'] . ' ' . CURRENCY ?> <?= lang('per_12_months') ?> )</div>
            <div><b><?= lang('plan_date_generated') ?>:</b> <?= date('d.m.Y', $paymentReq['date_generated']) ?></div>
            <div><b><?= lang('plan_req_num') ?>:</b> <?= $paymentReq['req_num'] ?></div>
            <div><a href="<?= lang_url('user/myplan/request?payment=cancel') ?>" class="btn btn-default confirm" data-my-message="<?= lang('confirm_cancel_req') ?>"><?= lang('cancel_pay_req') ?></a></div>
        </div>
		<hr>
        <div class="payment-details">
		<div class="text-center pay-type-imgs">
			<img src="<?= base_url('assets/public/imgs/paypal-payment.png') ?>" alt="pminvoice.com paypal payment">
			<img src="<?= base_url('assets/public/imgs/discover-card.png') ?>" alt="pminvoice.com payment">
			<img src="<?= base_url('assets/public/imgs/amex-card.png') ?>" alt="pminvoice.com payment">
			<img src="<?= base_url('assets/public/imgs/visa-debit-card-logo.png') ?>" alt="pminvoice.com payment">
			<img src="<?= base_url('assets/public/imgs/master-card-icon-4.jpg') ?>" alt="pminvoice.com payment">
			<img src="<?= base_url('assets/public/imgs/payment_method_card_visa-512.png') ?>" alt="pminvoice.com payment">
			<img src="<?= base_url('assets/public/imgs/icon_cc-logo_jcb.png') ?>" alt="pminvoice.com payment">
			<img src="<?= base_url('assets/public/imgs/icon_cc-logo_dinersclub.png') ?>" alt="pminvoice.com payment">
		</div> 
        </div>
        <div class="alert alert-info">
            <strong><?= lang('info_box') ?></strong> <?= lang('plan_will_started') ?>
        </div>
    </div>
    <?php
} else {
    ?>
    <h1 class="no-permissions"><?= lang('no_permissions') ?></h1>
<?php } ?>