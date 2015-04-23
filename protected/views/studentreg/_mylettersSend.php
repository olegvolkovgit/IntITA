<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/profile.css" />

<div>
<p class="tabHeader">Листування</p>
</div>

<div class="box_tabs">
    <ul class="box_tab-links">
        <li style="margin-right: 0px;" class="active_box"><a style="width: 80px; text-align: center;" href="#box_tab1">Вхідні</a></li>
        <li style="margin-right: 0px; margin-left: 0px;"><a style="width: 80px; text-align: center;" href="#box_tab2">Вихідні</a></li>
        <li style="margin-right: 0px; margin-left: 0px;"><a style="width: 80px; text-align: center;" href="#box_tab3">Архів</a></li>
        <li style="margin-right: 0px; margin-left: 0px;"><a style="width: 80px; text-align: center;" href="#box_tab4">Чернетки</a></li>
        <li style="margin-right: 0px; margin-left: 0px;">
            <a style="width: 110px; height: 30px; text-align:center; background: #4b70a3; color: white;" href="#box_tab5">
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/send.jpg"/>Створити</a></li>
    </ul>

    <div class="box_tab-content">
        <div id="box_tab1" class="box_tab active">
            <h1>Вхідні</h1>
        </div>

        <div id="box_tab2" class="box_tab2">
            <h1>Вихідні</h1>
        </div>

        <div id="box_tab3" class="box_tab3">
            <h1>Архів</h1>
        </div>

        <div id="box_tab4" class="box_tab4">
            <h1>Чернетки</h1>
        </div>

        <div id="box_tab5" class="box_tab5">

            <script src="//tinymce.cachefly.net/4.1/tinymce.min.js"></script>
            <script>tinymce.init({selector:'textarea'});</script>

            <div>
                <form method="post" action="<?php echo Yii::app()->request->baseUrl; ?>/?r=studentreg/sendletter">
                    <label for="letterTheme">Кому:</label>
                    <input required type="text" id="letterTheme" name="letterTheme" /></br> </br>
                    <label for="letterTheme">Тема:</label>
                    <input required type="text" id="letterTheme" name="letterTheme" /></br> </br>
                    <label for="send_letter">Повідомлення:</label>
                    <textarea required id="send_letter" name="send_letter"></textarea></br>
                    <Button class="Btn_Msg" style="margin-left: 480px;"><img src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/send2.jpg"/>Відправити</Button>
                </form>
                <?php if(Yii::app()->user->hasFlash('messagemail')):
                    echo Yii::app()->user->getFlash('messagemail');
                endif; ?>
            </div>

        </div>
    </div>

</div>

<script>
    jQuery(document).ready(function() {
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

