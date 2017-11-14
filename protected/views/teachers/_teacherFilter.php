<?php
/**
 * Created by PhpStorm.
 * User: Админ
 * Date: 20.06.2017
 * Time: 12:19
 */
?>

<div style="text-align: right" ng-controller="filterTeacherCtrl">
    <table class="graduatesFilter">
        <tr>
            <td>
                <div >
                    <a href="#" class="unselectedFilter" ng-class="{'selectedFilter': selector == 'az'}">
                        <label>
                            <input ng-cloak="" type="radio" ng-model="selector" value="az" ng-hide="1" ng-click="selectFilter()">
                            <?php echo Yii::t('graduates', '0609'); ?>
                        </label>
                    </a>
                </div>
            </td>
            <td>
                <div>
                    <a href="#" class="unselectedFilter" ng-class="{'selectedFilter': selector != 'az'}">
                        <label>
                            <input ng-cloak="" type="radio" ng-model="selector" value="rating" ng-hide="1" ng-click="selectFilter()">
                            <?php echo Yii::t('graduates', '0611'); ?>
                        </label>
                    </a>
                </div>
            </td>
            <td>
                <div>
                    <input type="search" id="search_input" ng-model="input" ng-keyup="searchInput()" placeholder="<?php echo Yii::t('teachers', '0983'); ?>"/>
                </div>
            </td>
        </tr>
    </table>
</div>
