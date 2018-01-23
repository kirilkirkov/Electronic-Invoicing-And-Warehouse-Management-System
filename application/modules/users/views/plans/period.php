<div class="selected-page">
    <div class="inner">
        <h1> 
            <?= lang('plans_period') ?>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= lang_url('user') ?>"><?= lang('home') ?></a></li> 
            <li><a href="<?= lang_url('user/plans') ?>"><?= lang('plans') ?></a></li>
            <li class="active"><?= lang('plan_period') ?></li>
        </ol>
    </div> 
</div>
<?php if ($this->permissions->hasPerm('perm_view_plans_page')) { ?>
    <div class="row">
        <div class="col-sm-6 col-sm-offset-3 col-md-6 col-md-offset-3">
            <form method="POST" action="">
                <input type="hidden" name="type" value="<?= strtoupper($planType) ?>">
                <div class="plan-container">
                    <div class="plan-header">
                        <div class="icon-box"><i class="fa fa-users icon"></i></div>
                        <h2><?= lang('plan_' . $planType) ?></h2>
                        <p><?= $plans[strtoupper($planType)]['PRICE'] . CURRENCY ?>/<?= lang('plans_year') ?></p>
                    </div>
                    <div class="plan-details">
                        <ul>
                            <li class="option-li">
                                <?= lang('plan_period') ?>
                                <select class="selectpicker" name="period"> 
                                    <option value="12" selected="">1 <?= lang('plan_period_year') ?></option>
                                    <option value="24">2 <?= lang('plan_period_years') ?></option>
                                    <option value="36">3 <?= lang('plan_period_years') ?></option>
                                    <option value="48">4 <?= lang('plan_period_years') ?></option>
                                </select>
                            </li>
                            <li class="option-li hidden">
                                <?= lang('plan_payment_type') ?> 
                                <select class="selectpicker" name="payment_type"> 
                                    <option value="bank" selected=""><?= lang('plan_payment_bank') ?></option>
                                    <?php /*
                                      <option value="easypay"><?= lang('plan_payment_easypay') ?></option>
                                      <option value="sms"><?= lang('plan_payment_sms') ?></option>
                                     */
                                    ?>
                                    <option value="paypal"><?= lang('plan_payment_paypal') ?></option>
                                </select>
                            </li>
                        </ul>
                        <button type="submit" class="button-confirm">
                            <?= lang('confirm_plan_requiest') ?> 
                            <i class="fa fa-arrow-right"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php } else { ?>
    <h1 class="no-permissions"><?= lang('no_permissions') ?></h1>
<?php } ?>