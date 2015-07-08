<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 13.05.2015
 * Time: 15:33
 */
$headerText = Yii::t('mainpage','0002');
$subheaderText = Yii::t('mainpage','0006');
$dropName = Yii::t('mainpage','0004');
?>
<div class="mainAboutBlock">
    <div class="mainAbout">
        <div class="header">
            <?php echo $headerText; ?>
            <p>
                <?php echo $subheaderText; ?>
            </p>
        </div>

        <div class="line1">
            <img src="<?php echo StaticFilesHelper::createPath('image', 'aboutus', 'line1.png');?>">
        </div>

        <?php
        $index=0;
        $anchor=0;
        foreach ($massAbout as $val)
        {
            $index++;
            ?>
            <div class="block">
                <ul>
                    <li>
                        <div class="line2">
                            <img src="<?php echo $val->line2Image;?>">
                        </div>
                        <div class="icon">
                            <img src="<?php echo $val->iconImage;?>">
                        </div>
                        <div class="title" >
                            <div class="aboutTitleLink" onclick="WindowShow(<?php echo $index;?>">
                                <?php echo $val->titleText; ?>
                            </div>
                            <p>
                                <?php echo $val->textAbout; ?>
                        </div>
                    </li>
                </ul>
            </div>

        <?php
        }
        ?>

        <! Script for Drop Down text>
        <script type="text/javascript">
            var width=0;
            if (self.screen)
            {
                width = screen.width
            }
            function centerPage()
            {
                $('.contentCenterBox').css('width', width);
                $('.contentCenterBox').css('left', "50%");
                $('.contentCenterBox').css('margin-left', -width/2);
            }
            function Window()
            {
                $('#dropTextLayer1').css('display', 'inline-block');
            }
            function WindowShow(buttonNumber,anchor)
            {
                if (anchor==1)
                {
                    $("body").animate({"scrollTop":440},"fast");
                }
                if (buttonNumber ==1)
                {
                    $('#dropTextLayer1').css('display', 'inline-block');
                    $('#dropTextLayer2').css('display', 'none');
                    $('#dropTextLayer3').css('display', 'none');
                    $('#dropButton1').css('text-decoration','none');
                    $('#dropButton2').css('text-decoration','underline');
                    $('#dropButton3').css('text-decoration','underline');
                }
                if (buttonNumber ==2)
                {
                    $('#dropTextLayer2').css('display', 'inline-block');
                    $('#dropTextLayer1').css('display', 'none');
                    $('#dropTextLayer3').css('display', 'none');
                    $('#dropButton1').css('text-decoration','underline');
                    $('#dropButton2').css('text-decoration','none');
                    $('#dropButton3').css('text-decoration','underline');
                }
                if (buttonNumber ==3)
                {
                    $('#dropTextLayer3').css('display', 'inline-block');
                    $('#dropTextLayer2').css('display', 'none');
                    $('#dropTextLayer1').css('display', 'none');
                    $('#dropButton1').css('text-decoration','underline');
                    $('#dropButton2').css('text-decoration','underline');
                    $('#dropButton3').css('text-decoration','none');
                }
            }
        </script>

        <! buttons for dropdown  About Us>
        <div id="dropButton1" onclick="WindowShow(1)" >
            <?php  echo  $dropName;   ?>
        </div>
        <div id="dropButton2" onclick="WindowShow(2)">
            <?php  echo  $dropName;   ?>
        </div>
        <div id="dropButton3" onclick="WindowShow(3)">
            <?php  echo  $dropName;   ?>
        </div>


    </div>
</div>