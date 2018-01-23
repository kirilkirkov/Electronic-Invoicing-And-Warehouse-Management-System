<div class="selected-page">
    <div class="inner">
        <h1> 
            <?= lang('plans') ?>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= lang_url('user') ?>"><?= lang('home') ?></a></li> 
            <li class="active"><?= lang('plans') ?></li>
        </ol>
    </div> 
</div>
<?php
if ($this->permissions->hasPerm('perm_view_plans_page')) {
    if (!empty($myCurrentPlans)) {
        ?>
        <div class="my-active-plans">
            <h2><?= lang('my_active_plans') ?></h2>
            <?php foreach ($myCurrentPlans as $activePlan) { ?>
                <div class="active-plan">
                    <?= lang('plan_type') ?>:  <b><?= lang('plan_' . strtolower($activePlan['plan_type'])) ?></b>
                    <?= lang('started_from') ?> <b><?= date('d.m.Y', $activePlan['from_date']) ?></b>
                    <?= lang('active_to') ?> <b><?= date('d.m.Y', $activePlan['to_date']) ?></b>
                    <?= lang('left_inv_from_plan') ?> <b><?= $activePlan['num_invoices'] ?></b>
                    <?= lang('num_companies_plan') ?> <b><?= $activePlan['num_firms'] ?></b>
                </div>
            <?php } ?>
        </div>
    <?php } ?>
    <div class="plans row">
        <div class="col-xs-12 col-md-4 col-lg-3">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title"><?= lang('plan_pro') ?></h3>
                </div>
                <div class="panel-body">
                    <div class="the-price">
                        <h1>
                            <?= $plans['PRO']['PRICE'] . CURRENCY ?><span class="subscript">/<?= lang('plans_year') ?></span>
                        </h1>
                    </div>
                    <table class="table">
                        <tr>
                            <td>
                                <?= $plans['PRO']['NUM_INVOICES'] ?> <?= lang('plans_num_inv') ?>/<?= lang('plans_month') ?>
                            </td>
                        </tr>
                        <tr class="active">
                            <td>
                                <?= $plans['PRO']['NUM_FIRMS'] ?> <?= lang('plans_num_firms') ?>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="panel-footer">
                    <a href="<?= lang_url('user/plan/pro') ?>" class="btn btn-success" role="button"><?= lang('plans_choose') ?></a> <?= lang('plans_one_m_bonus') ?></div>
            </div>
        </div>
        <div class="col-xs-12 col-md-4 col-lg-3">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title"><?= lang('plan_custom') ?></h3>
                </div>
                <div class="panel-body">
                    <div class="the-price">
                        <h1><?= $individualPlan == null ? '?' : $individualPlan['price'] . CURRENCY ?><span class="subscript">/<?= lang('plans_year') ?></span></h1>
                    </div>
                    <table class="table">
                        <tr>
                            <td>
                                <?= $individualPlan == null ? '?' : $individualPlan['num_invoices'] ?> <?= lang('plans_num_inv') ?>/<?= lang('plans_month') ?>
                            </td>
                        </tr>
                        <tr class="active">
                            <td>
                                <?= $individualPlan == null ? '?' : $individualPlan['num_firms'] ?>  <?= lang('plans_num_firms') ?>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="panel-footer">
                    <?php if ($individualPlan != null) { ?>
                        <a href="<?= lang_url('user/plan/custom') ?>" class="btn btn-success" role="button"><?= lang('plans_choose') ?></a>
                    <?php } ?>
                    <a href="javascript:void(0);" data-toggle="modal" data-target="#modalCustomPlanReq" class="btn <?= $individualPlan != null ? 'btn-xs' : '' ?> btn-success" role="button"><?= $individualPlan != null ? lang('plans_make_new_request') : lang('plans_make_request') ?></a></div>
            </div>
        </div>
    </div>
    <!-- Modal Custom Plan Email Send Request -->
    <div class="modal fade" id="modalCustomPlanReq" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel"><?= lang('plan_send_us_req') ?></h4>
                </div>
                <div class="modal-body">
                    <form class="site-form" action="" method="POST" id="formMakePlanReq">
                        <div class="form-group">
                            <label><?= lang('plan_req_inv_per_mon') ?></label>
                            <input type="text" name="inv_per_month" class="form-control field">
                        </div>
                        <div class="form-group">
                            <label><?= lang('plan_req_companies') ?></label>
                            <input type="text" name="want_companies" class="form-control field">
                        </div>
                    </form>
                    <div class="alert alert-info"><?= lang('when_we_see_plan_req') ?></div>
                    <?php
                    if ($requestForIndividualPlan != null) {
                        $alreadyHave = str_replace("%num_inv%", $requestForIndividualPlan['invoices'], lang('already_have_req'));
                        $alreadyHave = str_replace("%companies%", $requestForIndividualPlan['companies'], $alreadyHave);
                        ?>
                        <div class="alert alert-danger"><?= $alreadyHave ?></div>
                    <?php } ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><?= lang('close') ?></button>
                    <button type="button" class="btn btn-primary" onclick="makePlanRequest()"><?= lang('send_plan_req') ?></button>
                </div>
            </div>
        </div>
    </div>
<?php } else { ?>
    <h1 class="no-permissions"><?= lang('no_permissions') ?></h1>
<?php } ?>