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
         onclick="upBlock(<?php echo $idLecture;?>, <?php echo $order;?>);">
    <img src="<?php echo StaticFilesHelper::createPath('image', 'editor', 'down.png');?>" class="editIco"
         onclick="downBlock(<?php echo $idLecture;?>, <?php echo $order;?>);">
    <img src="<?php echo StaticFilesHelper::createPath('image', 'editor', 'delete.png');?>" class="editIco"
         onclick="deleteBlock(<?php echo $idLecture;?>, <?php echo $order;?>);">
</div>
<?php }?>

<script type="text/javascript">
       function upBlock(idLecture, order){
                $.ajax({
                    type: "POST",
                        url: "http://localhost/IntITA/lesson/upElement",
                        //url: "http://intita.itatests.com/lesson/upElement",
                        data: {'idLecture':idLecture, 'order':order},
                   success: function(){
                            $.fn.yiiListView.update('blocks_list');
                            return false;
                        }
                });
        }

        function downBlock(idLecture, order){
                $.ajax({
                    type: "POST",
                    url: "http://localhost/IntITA/lesson/downElement",
                    //url: "http://intita.itatests.com/lesson/downElement",
                       data: {'idLecture':idLecture, 'order':order},
                    success: function(){
                            $.fn.yiiListView.update('blocks_list');
                            return false;
                        }
                });
        }

            function deleteBlock(idLecture, order){
                    $.ajax({
                        type: "POST",
                        url: "http://localhost/IntITA/lesson/deleteElement",
                        //url: "http://intita.itatests.com/lesson/deleteElement",
                            data: {'idLecture':idLecture, 'order':order},
                        success: function(){
                                $.fn.yiiListView.update('blocks_list');
                                return false;
                            }
                    });
        }
</script>
