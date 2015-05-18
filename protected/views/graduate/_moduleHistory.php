<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 14.05.2015
 * Time: 18:51
 */
?>
<div class="profileMyRatting">
    <p><?php echo $moduleTitle;?>:
        <?php
        for ($i = 0; $i < 9; $i++) {
            ?>
            <img src="<?php echo StaticFilesHelper::createPath('image', 'common', 'starFull.png');?>">
        <?php
        }
        for ($i = 0; $i < 1; $i++) {
            ?>
            <img src="<?php echo StaticFilesHelper::createPath('image', 'common', 'starEmpty.png');?>">
        <?php
        }
        ?>
        <br><span class="colorP"><?php echo $moduleTitle;?>. Модульне око, модульний ніс</span></p>
</div>