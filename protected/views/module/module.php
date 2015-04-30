<!-- Module style -->
<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/module.css" />
<!-- Module style -->
<!-- BD -))) -->
<?php
$this->pageTitle = 'INTITA';
$post=Module::model()->findByPk(1);
?>
<!-- BD -))) -->
<?php
$this->breadcrumbs=array(
    Yii::t('breadcrumbs', '0050')=>Yii::app()->request->baseUrl."/courses",'Програмування для чайників'=>Yii::app()->request->baseUrl."/course",'Основи PHP',
);
?>
<?php
    $moduleName="<b>Мова програмування PhP</b>";
    $moduleNumber=33;
    $moduleDuration=313;
    $arrayNameLessons = array(
                        "Основи PHP",
                        "Семантичне ядро ​​сайту","Зовнішні ресурси в просуванні","Запити HTTP, URL параметри і форми HTML котрі допомога ють справному програмісту","Cookies Урок і сесії",
                        "Робота з файлами","Робота з базою даних","Основи PHP","Семантичне ядро ​​сайту",
                        "Зовнішні ресурси в просуванні","Запити HTTP, URL параметри і форми HTML","Запити HTTP, URL параметри і форми HTML котрі допомо- гають справному програмісту","Робота з файлами",
                        "Робота з базою даних","Робота з файлами","Робота з файлами", "Основи PHP",
        "Семантичне ядро ​​сайту","Зовнішні ресурси в просуванні","Запити HTTP, URL параметри і форми HTML котрі допомога ють справному програмісту","Cookies Урок і сесії",
        "Робота з файлами","Робота з базою даних","Основи PHP","Семантичне ядро ​​сайту",
        "Зовнішні ресурси в просуванні","Запити HTTP, URL параметри і форми HTML","Запити HTTP, URL параметри і форми HTML котрі допомо- гають справному програмісту","Робота з файлами",
        "Робота з базою даних","Робота з файлами","Робота з файлами", "Семантичне ядро ​​сайту","Зовнішні ресурси в просуванні",
    );
    $teacherLastName="Орест Остапович"; $teacherFirstName="Бендер";
    $teacherEmail="orest@intita.org, orest@gmail.com";
    $teacherEmail="orest@intita.org, orest@gmail.com";
    $teacherPhone1="/067/ 56-569-56"; $teacherPhone2="/093/ 123-45-67";
    $teacherSkype="orest.ostapovich";
?>

<div class="ModuleBlock">


    <div class="leftModule">
        <div class="headerLeftModule">
            <table>
                <tr>
                    <td>
                        <img class="moduleImg" src="<?php echo Yii::app()->request->baseUrl.$post->module_img ?>" />
                    </td>
                    <td style="padding-left: 15px;">

                        <span id="titleModule"><?php echo Yii::t('module', '0211'); ?></span>
                        <?php echo $moduleName;?>

                        <div>
                            <span id="titleModule"><?php echo Yii::t('module', '0212'); ?></span>
                            <?php echo "<b>", $moduleNumber, "</b>"; ?>
                            <img class="time" src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/timeIco.png"/>
                            <span id="titleModule"><?php echo Yii::t('module', '0213'); ?></span>
                            <?php echo "<b>", $moduleDuration, "</b> год"; ?>
                            <img class="time" src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/timeIco.png"/>
                        </div>

                        <div>
                            <span id="titleModule"><?php echo Yii::t('module', '0214'); ?></span>
                            <?php echo "сильний початківець"?>

                            <?php
                            for ($i=0; $i<3; $i++)
                            {
                                ?><span>
                                <img src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/ratIco1.png"/>
                                </span><?php
                            }
                            for ($i=0; $i<2; $i++)
                            {
                                ?><span>
                                <img src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/ratIco0.png"/>
                                </span><?php
                            }
                            ?>
                        </div>
                        <div>
                            <span id="titleModule"><?php echo Yii::t('module', '0215'); ?></span>
                            <b>25 <?php echo Yii::t('module', '0216'); ?></b>, <?php echo Yii::t('module', '0217'); ?> - <b>2 <?php echo Yii::t('module', '0218'); ?></b> (3 <?php echo Yii::t('module', '0219'); ?>, 3 <?php echo Yii::t('module', '0220'); ?>)
                        </div>
                        <div>
                            <span id="titleModule"><?php echo Yii::t('module', '0221'); ?></span>
                            3000.00 <?php echo Yii::t('module', '0222'); ?> 1500.00 <?php echo Yii::t('module', '0222'); ?> (<?php echo Yii::t('module', '0223'); ?>)
                        </div>
                        <div>
                            <div >
                                <span id="titleModule"><?php echo Yii::t('module', '0224'); ?></span>
                                <?php
                                for ($i = 0; $i < 9; $i++) {
                                    ?><span>
                                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/starFull.png">
                                    </span><?php
                                }
                                for ($i = 0; $i < 1; $i++) {
                                    ?><span>
                                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/starEmpty.png">
                                    </span><?php
                                }
                                ?>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>

            <div class="lessonModule">
                <h2><?php echo Yii::t('module', '0225'); ?></h2>

                <?php
                for ($i = 0; $i < $moduleNumber; $i++) {
                    ?>
                    <div>
                        <table>
                            <tr>
                                <td style="width: 60px;">
                                    <?php echo Yii::t('module', '0226')," ",$i+1,"."; ?>
                                </td>
                                <td>
                                    <span> <a href="<?php echo Yii::app()->request->baseUrl; ?>/lesson"><?php echo $arrayNameLessons[$i] ;?></a> </span>
                                </td>
                            </tr>
                        </table>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>

    <div class="rightModule">
        <?php
        for ($i = 1; $i <= 4; $i++) {
            ?>
            <div class="teacherBox">
                <table>
                    <tr>
                        <td class="teacherBoxLeft">
                            <img  src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/teacher2.jpg"/>
                            <a href="<?php echo Yii::app()->request->baseUrl; ?>/profile"><?php echo Yii::t('module', '0228'); ?> &#187;</a>
                        </td>
                        <td  class="teacherBoxRight" ">
                        <h2><?php echo Yii::t('module', '0227'); ?></h2>
                        <div style="line-height: 1.2;">
                            <?php echo $teacherLastName,$teacherFirstName;?>
                            <?php echo $teacherEmail;?>
                            <?php echo $teacherPhone1, $teacherPhone2;?>
                            <?php echo $teacherSkype;?>
                        </div>
                        </td>
                    </tr>
                </table>
            </div>
        <?php
        }
        ?>
    </div>
</div>