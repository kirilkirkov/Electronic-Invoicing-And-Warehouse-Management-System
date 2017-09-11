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
            <div><b><?= lang('plan_period') ?>:</b> <?= $paymentReq['plan_period'] . ' ' . lang('plan_period_months') ?> x <?= $plans[$paymentReq['plan_type']]['PRICE'] . ' ' . CURRENCY ?></div>
            <div><b><?= lang('plan_date_generated') ?>:</b> <?= date('d.m.Y', $paymentReq['date_generated']) ?></div>
            <div><b><?= lang('plan_req_num') ?>:</b> <?= $paymentReq['req_num'] ?></div>
            <div><a href="<?= lang_url('user/myplan/request?payment=cancel') ?>" class="btn btn-default confirm" data-my-message="<?= lang('confirm_cancel_req') ?>"><?= lang('cancel_pay_req') ?></a></div>
        </div>
        <div class="payment-details">
            <h3 class="text-center"><?= lang('payment_details') ?></h3>
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
            <?php if ($paymentReq['payment_type'] == 'bank') { ?>
                <div class="text-center">
                    <img src="<?= base_url('assets/public/imgs/card_icons.png') ?>" style="height: 20px; margin-bottom: 10px;" alt="visa, mastercard,amex,discover,maestro">
                </div>
                <div class="text-center">
                    <a href="javascript:void(0);" class="btn btn-default" data-toggle="collapse" style="margin-bottom: 10px;" data-target="#bank-details"><?= lang('pay_elsewhere') ?></a>
                </div>
                <div class="row collapse" id="bank-details">
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
            <?php } ?>
            <?php /* elseif ($paymentReq['payment_type'] == 'bank') { ?>
              <form class="site-form">
              <div class="person-details">
              <input type="hidden" name="card_amt" value="<?= CURRENCY_KEY ?>">
              <input type="hidden" name="card_currency" value="<?= $mustPayAmount ?>">
              <div class="form-group">
              <label>card_creditcardtype</label>
              <select>
              <option value="visa">visa</option>
              <option value="mastercard">mastercard</option>
              <option value="amex">amex</option>
              <option value="discover">discover</option>
              <option value="maestro">maestro</option>
              </select>
              </div>
              <div class="form-group">
              <label>card_firstname</label>
              <input type="text" name="card_firstname" value="">
              </div>
              <div class="form-group">
              <label>card_lastname</label>
              <input type="text" name="card_lastname" value="">
              </div>
              <div class="form-group">
              <label>card_street</label>
              <input type="text" name="card_street" value="">
              </div>
              <div class="form-group">
              <label>card_city</label>
              <input type="text" name="card_city" value="">
              </div>
              <div class="form-group">
              <label>card_state</label>
              <input type="text" name="card_state" value="">
              </div>
              <div class="form-group">
              <label>card_zip</label>
              <input type="text" name="card_zip" value="">
              </div>
              <div class="form-group">
              <label>card_countrycode</label>
              <input type="text" name="card_countrycode" value="">
              </div>
              </div>
              <div class="credit-cards-box">
              <div class="icons">
              Credit card <img src="<?= base_url('assets/public/imgs/card_icons.png') ?>" class="cards-icons" alt="visa, mastercard,amex,discover,maestro">
              </div>
              <div class="card-fields">
              <p>Pay with your credit card. </p>
              <div class="form-group">
              <label>Card number</label>
              <input type="text" class="form-control field" placeholder="**** **** **** ****" name="card_acct" value="">
              </div>
              <div class="row">
              <div class="col-sm-6">
              <div class="form-group">
              <label>Expiration Date</label>
              <div>
              <select class="selectpicker" name="month" title="Month">
              <?php
              $i = 1;
              while ($i <= 12) {
              ?>
              <option value="<?= $i < 10 ? '0' . $i : $i ?>"><?= $i < 10 ? '0' . $i : $i ?></option>
              <?php
              $i++;
              }
              ?>
              </select>
              <select class="selectpicker" name="year" title="Year">
              <?php
              $date = date('Y-m-d');
              $end_date = date('Y-m-d', strtotime('+30 years', time()));
              while (strtotime($date) <= strtotime($end_date)) {
              ?>
              <option><?= date('Y', strtotime($date)) ?></option>
              <?php
              $date = date("Y-m-d", strtotime("+1 year", strtotime($date)));
              }
              ?>
              </select>
              </div>
              </div>
              </div>
              <div class="col-sm-6">
              <label>Card Security Code</label>
              <input type="text" class="form-control field" maxlength="5" name="card_state" placeholder="CVC" value="">
              </div>
              </div>
              </div>
              <div class="border"></div>
              <a href="javascript:void(0);" class="btn btn-green" onclick="makeBankPayment()">Place order</a>
              <a href="javascript:void(0);" class="btn btn-default" data-toggle="collapse" data-target="#bank-details">I want to pay elsewhere. Show me bank details.</a>
              </div>
              </form>
              <div class="row collapse" id="bank-details">
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
              <?php } */
            ?>
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