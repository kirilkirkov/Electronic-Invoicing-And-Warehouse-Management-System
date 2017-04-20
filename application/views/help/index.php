<div id="subpage">
    <div class="container">
        <h1><img src="<?= base_url('assets/public/imgs/pm-subpages.png') ?>" alt="pm:"><?= lang('help') ?></h1>
    </div>
</div>
<div class="container">
    <h1><?= lang('support_questions') ?></h1>  
    <div class="panel-group" id="faqAccordion">
        <?php
        $i = 0;
        foreach ($questions as $question) {
            ?>
            <div class="panel panel-default">
                <div class="panel-heading accordion-toggle question-toggle collapsed" data-toggle="collapse" data-parent="#faqAccordion" data-target="#question<?= $i ?>">
                    <h4 class="panel-title">
                        <a href="javascript:void(0);" class="ing"><?= $question['question'] ?></a>
                    </h4>
                </div>
                <div id="question<?= $i ?>" class="panel-collapse collapse">
                    <div class="panel-body">
                        <h5><span class="label label-red"><?= lang('answer') ?></span></h5>
                        <p>
                            <?= $question['answer'] ?>
                        </p>
                    </div>
                </div>
            </div>
            <?php
            $i++;
        }
        ?>
    </div> 
</div>