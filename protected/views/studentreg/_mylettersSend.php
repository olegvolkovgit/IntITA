<script src="<?php echo StaticFilesHelper::fullPathTo('js', 'spoilerLetter.js');?>"></script>
<p class="tabHeader"><?php echo Yii::t("letter", "0531") ?></p>

<div class="box_tabs">
    <ul class="box_tab-links">
        <li><a href="#box_tab1"><?php echo Yii::t("letter", "0532") ?></a></li>
        <li><a href="#box_tab2"><?php echo Yii::t("letter", "0533") ?></a></li>
        <li class="active_box">
            <a class='createLetter' href="#box_tab5">
                <img src="<?php echo StaticFilesHelper::createImagePath('common', 'send.jpg');?>"/><?php echo Yii::t("letter", "0534") ?>
            </a>
        </li>
    </ul>

    <div class="box_tab-content">
        <div id="box_tab1" class="box_tab">
            <?php
            $this->widget('zii.widgets.CListView', array(
                'dataProvider'=>$receivedLettersProvider,
                'itemView'=>'/letters/_receivedLetters',
                'viewData' => array('respletter'=>$letter),
                'template'=>'{items}{pager}',
                'emptyText'=>Yii::t("letter", "0535"),
                'pager' => array(
                    'firstPageLabel'=>'<<',
                    'lastPageLabel'=>'>>',
                    'prevPageLabel'=>'<',
                    'nextPageLabel'=>'>',
                    'header'=>'',
                ),
            ));
            ?>
        </div>

        <div id="box_tab2" class="box_tab2">
            <?php
            $this->widget('zii.widgets.CListView', array(
                'dataProvider'=>$sentLettersProvider,
                'itemView'=>'/letters/_sentLetters',
                'viewData' => array('model'=>$letter),
                'template'=>'{items}{pager}',
                'emptyText'=>Yii::t("letter", "0536"),
                'pager' => array(
                    'firstPageLabel'=>'<<',
                    'lastPageLabel'=>'>>',
                    'prevPageLabel'=>'<',
                    'nextPageLabel'=>'>',
                    'header'=>'',
                ),
            ));
            ?>
        </div>
        <div id="box_tab5" class="box_tab5">
<!---->
<!--            <script src="//tinymce.cachefly.net/4.1/tinymce.min.js"></script>-->
<!--            <script>tinymce.init({selector:'textarea'});</script>-->
            <div>
                <?php $this->renderPartial('/letters/_form', array('model'=>$letter)); ?>
<!--                --><?php //if(Yii::app()->user->hasFlash('messagemail')):
//                    echo Yii::app()->user->getFlash('messagemail');
//                endif; ?>
            </div>

        </div>
    </div>

</div>

<script>
    jQuery(document).ready(function() {
        jQuery('.box_tabs ' + '#box_tab5').show().siblings().hide();
        jQuery('.box_tabs .box_tab-links a').on('click', function(e)  {
            var currentAttrValue = jQuery(this).attr('href');

            // Show/Hide Tabs
            jQuery('.box_tabs ' + currentAttrValue).show().siblings().hide();

            // Change/remove current tab to active
            jQuery(this).parent('li').addClass('active_box').siblings().removeClass('active_box');

            e.preventDefault();
        });
    });
</script>

