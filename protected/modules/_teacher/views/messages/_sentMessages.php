<?php
/**
 * @var $sentMessages Array
 * @var $message UserMessages
 */
?>
<div class="dataTable_wrapper">
    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
        <tbody>
        <?php
            foreach($sentMessages as $message){?>
                <tr class="odd gradeX">
                    <td><?=$message->subject; ?></td>
                    <td><?=$message->text; ?></td>
                    <td class="center"><?=$message["id_message"]; ?></td>
                </tr>
            <?php
            }
        ?>
        </tbody>
    </table>
</div>