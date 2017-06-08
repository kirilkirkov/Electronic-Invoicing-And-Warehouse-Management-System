<script>
    var clients = {};
    var items = {};
</script>
<div class="well">
    <div class="input-group">
        <input type="text" name="SearchDualList" class="form-control" placeholder="search" />
        <span class="input-group-addon glyphicon glyphicon-search"></span>
    </div>
    <ul class="list-group">
        <?php
        $i = 1;
        foreach ($result as $res) {
            ?>
            <li class="list-group-item" onclick="<?= isset($res['client_name']) ? 'getClient(' . $i . ')' : 'getItem(' . $i . ')' ?>">
                <?php if (isset($res['client_name'])) { ?>
                    <h3><?= $res['client_name'] ?></h3>
                    <p><?= $res['client_bulstat'] ?></p>
                    <script>
            clients[<?= $i ?>] = <?= json_encode($res) ?>
                    </script>
                <?php } else { ?>
                    <h3><?= $res['name'] ?></h3>
                    <p><?= $res['single_price'] . $res['currency'] ?></p>
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