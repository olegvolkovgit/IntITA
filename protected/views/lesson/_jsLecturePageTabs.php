<?php
/**
 * Created by PhpStorm.
 * User: Wizlight
 * Date: 03.11.2015
 * Time: 14:22
 */
?>

<div name="lecturePage">
    <div ng-cloak class="tabsWidget">
        <ng-view>
        </ng-view>
    </div>
</div>
<link type="text/css" rel="stylesheet" href="<?php echo StaticFilesHelper::fullPathTo('css', 'cjuitabs.css'); ?>"/>