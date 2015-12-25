<?php
foreach ($newMessages as $record) {
    ?>
    <li>
        <a href="#">
            <div>
                <strong><?= $record['id_message']; ?></strong>
                <span class="pull-right text-muted">
                    <em>Topic</em>
                </span>
            </div>
            <div>Message subject</div>
        </a>
    </li>
    <?php
}
?>
<a class="text-center" href="#">
    <strong><a href="#">Всі повідомлення</a></strong>
    <i class="fa fa-angle-right"></i>
</a>
</li>