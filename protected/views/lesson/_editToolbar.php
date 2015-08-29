<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 19.05.2015
 * Time: 16:30
 */
?>
<?php if($editMode){?>
<div class="editToolbar">
    <img src="<?php echo StaticFilesHelper::createPath('image', 'editor', 'up.png');?>" class="editIco"
         onclick="upBlock(<?php echo $idLecture;?>, <?php echo $order;?>, <?php echo $idBlock;?>);">
    <img src="<?php echo StaticFilesHelper::createPath('image', 'editor', 'down.png');?>" class="editIco"
         onclick="downBlock(<?php echo $idLecture;?>, <?php echo $order;?>, <?php echo $idBlock;?>);">
    <img src="<?php echo StaticFilesHelper::createPath('image', 'editor', 'delete.png');?>" class="editIco"
         onclick="deleteBlock(<?php echo $idLecture;?>, <?php echo $order;?>, <?php echo $idBlock;?>);">
</div>
<?php }?>

<script type="text/javascript">
       function upBlock(idLecture, order, idBlock){
                $.ajax({
                    type: "POST",
                        url: "/lesson/upElement",
                        data: {'idLecture':idLecture, 'order':order, 'idBlock':idBlock},
                   success: function(){
                            $.fn.yiiListView.update('blocks_list');
                            return false;
                        }
                });
        }

        function downBlock(idLecture, order, idBlock){
                $.ajax({
                    type: "POST",
                        url: "/lesson/downElement",
                       data: {'idLecture':idLecture, 'order':order, 'idBlock':idBlock},
                    success: function(){
                            $.fn.yiiListView.update('blocks_list');
                            return false;
                        }
                });
        }

            function deleteBlock(idLecture, order, idBlock){
                    $.ajax({
                        type: "POST",
                            url: "/lesson/deleteElement",
                            data: {'idLecture':idLecture, 'order':order, 'idBlock':idBlock},
                        success: function(){
                                $.fn.yiiListView.update('blocks_list');
                                return false;
                            }
                    });
        }
</script>
