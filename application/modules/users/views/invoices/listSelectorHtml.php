<script>
    var clients = {};
    var items = {};
</script>
<div class="well">
    <div class="input-group search-field">
        <input type="text" name="SearchDualList" class="form-control" placeholder="<?= lang('search') ?>" />
        <span class="input-group-addon glyphicon glyphicon-search"></span>
    </div>
    <ul class="list-group list-ajax-results">
        <?php
        $i = 1;
        foreach ($result as $res) {
            ?>
            <li class="list-group-item" onclick="<?= isset($res['client_name']) ? 'getClient(' . $i . ')' : 'getItem(' . $i . ')' ?>">
                <?php if (isset($res['client_name'])) { ?>
                    <h3><?= $res['client_name'] ?></h3>
                    <p><?= $res['is_to_person'] == 0 ? lang('bulstat') . ' ' . $res['client_bulstat'] : lang('ident_num') . ' ' . $res['client_ident_num'] ?></p>
                    <script>
            clients[<?= $i ?>] = <?= json_encode($res) ?>
                    </script>
                <?php } else { ?>
                    <h3><?= $res['name'] ?></h3>
                    <p><?= lang('amount') . ' ' . $res['single_price'] . $res['currency'] ?></p>
                    <script>
                        items[<?= $i ?>] = <?= json_encode($res) ?>
                    </script>
                <?php } ?>
            </li> 
            <?php
            $i++;
        }
        ?>
    </ul>
</div> 