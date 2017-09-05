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
    <h1><?= lang('payment_awaiting') ?></h1>
    <hr>
    <div class="payment-request">
        <div><b><?= lang('plan_payment_type') ?>:</b> <?= $paymentReq['payment_type'] == 'bank' ? lang('plan_payment_bank') : lang('plan_payment_paypal') ?></div>
        <div>
            <b><?= lang('plan_type') ?>:</b> <?= lang('plan_' . strtolower($paymentReq['plan_type'])) ?>(<?= $plans[$paymentReq['plan_type']]['NUM_INVOICES'] . ' ' . lang('plans_num_inv') . ', ' . $plans[$paymentReq['plan_type']]['NUM_FIRMS'] . ' ' . lang('plans_num_firms') ?>)
        </div>
        <div><b><?= lang('plan_period') ?>:</b> <?= $paymentReq['plan_period'] . ' ' . lang('plan_period_months') ?> x <?= $plans[$paymentReq['plan_type']]['PRICE'] . ' ' . CURRENCY ?></div>
        <div><b><?= lang('plan_date_generated') ?>:</b> <?= date('d.m.Y', $paymentReq['date_generated']) ?></div>
        <div><b><?= lang('plan_req_num') ?>:</b> <?= $paymentReq['req_num'] ?></div>
        <div><a href="<?= lang_url('user/myplan/request?payment=cancel') ?>" class="btn btn-default confirm" data-my-message="<?= lang('confirm_cancel_req') ?>"><?= lang('cancel_pay_req') ?></a></div>
    </div>
    <div class="payment-details">
        <h3 class="text-center"><?= lang('payment_details') ?></h3>
        <?php if ($paymentReq['payment_type'] == 'paypal') { ?>
            <form action="https://www.paypal.com/cgi-bin/webscr" id="formPayPal" method="post" target="_top">
                <input type="hidden" name="cmd" value="_cart">
                <input type="hidden" value="kiro_tyson@abv.bg" name="business">
                <input type="hidden" name="upload" value="1"> 

                <input type="hidden" name="item_name_1" value="<?= lang('plan_' . strtolower($paymentReq['plan_type'])) ?>">
                <input type="hidden" name="amount_1" value="<?= $plans[$paymentReq['plan_type']]['PRICE'] ?>">
                <input type="hidden" name="quantity_1" value="<?= $paymentReq['plan_period'] ?>">

                <input type="hidden" name="currency_code" value="<?= CURRENCY_KEY ?>">
                <input type="hidden" name="custom" value="<?= $paymentReq['req_num'] ?>">

                <input type="hidden" value="utf-8" name="charset">
                <input type="hidden" value="<?= base_url('checkout/paypal_success') ?>" name="return">
                <input type="hidden" value="<?= base_url('checkout/paypal_cancel') ?>" name="cancel_return">
                <input type="hidden" value="authorization" name="paymentaction">
                <div class="text-center">
                    <a href="javascript:void(0);" onclick="document.getElementById('formPayPal').submit();">
                        <img src="<?= base_url('assets/users/imgs/paypal-pay-now.png') ?>">
                    </a>
                </div>
            </form>
        <?php } elseif ($paymentReq['payment_type'] == 'bank') { ?>
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td><b><?= lang('pay_det_name_of_rec') ?></b></td>
                                <td>#RZXZD#@!DSDQ#@</td>
                            </tr>
                            <tr>
                                <td><b><?= lang('pay_det_iban') ?></b></td>
                                <td>Moe</td>
                            </tr>
                            <tr>
                                <td><b><?= lang('pay_det_bic') ?></b></td>
                                <td>Dooley</td>
                            </tr>
                            <tr>
                                <td><b><?= lang('pay_det_to_bank') ?></b></td>
                                <td>Dooley</td>
                            </tr>
                            <tr>
                                <td><b><?= lang('pay_det_sum') ?></b></td>
                                <td><?= $mustPayAmount . ' ' . CURRENCY ?></td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <p class="text-danger"><?= lang('dont_forget_req_num') ?> - <b><?= $paymentReq['req_num'] ?></b></p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php }
        ?>
    </div>
    <div class="alert alert-info">
        <strong><?= lang('info_box') ?></strong> <?= lang('plan_will_started') ?>
    </div>
    <?php
} else {
    ?>
    <h1 class="no-permissions"><?= lang('no_permissions') ?></h1>
<?php } ?>