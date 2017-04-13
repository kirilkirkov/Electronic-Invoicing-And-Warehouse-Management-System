<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * Return error message
 */

function geterror($input)
{
    if (is_array($input)) {
        $output = implode('<br>', $input);
    } else {
        $output = $input;
    }
    ?>
    <div class="alert-errors">
        <?= $output ?>
        <a href="javascript:void(0);" class="close-alert">
            <i class="fa fa-times" aria-hidden="true"></i>
        </a>
    </div>
    <?php
}
