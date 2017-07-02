<?php
/**
 * Created by PhpStorm.
 * User: Wizlight
 * Date: 08.09.2015
 * Time: 22:40
 */
?>

<div style="text-align: right" ng-controller="filterGraduateCtrl">
    <table class="graduatesFilter">
        <tr>
            <td>
                <div >
                    <a href="#" class="unselectedFilter" onclick="selectFilter(this)">
                        <label>
                            <input ng-cloak="" type="radio" ng-model="selector" value="az" ng-hide="1" ng-click="selectFilter()">
                            <?php echo Yii::t('graduates', '0609'); ?>
                        </label>
                    </a>
                </div>
            </td>
            <td>
                <div>
                    <a href="#" class="unselectedFilter selectedFilter" onclick="selectFilter(this)">
                        <label>
                            <input ng-cloak="" type="radio" ng-model="selector" value="date" ng-hide="1" ng-click="selectFilter()">
                            <?php echo Yii::t('graduates', '0610'); ?>
                        </label>
                    </a>
                </div>
            </td>
<!--            <td>-->
<!--                <div>-->
<!--                    <a href="#" class="unselectedFilter selectedFilter" onclick="selectFilter(this)">-->
<!--                        <label>-->
<!--                            <input ng-cloak="" type="radio" ng-model="selector" value="rating" ng-hide="1" ng-click="selectFilter()">-->
<!--                                --><?php //echo Yii::t('graduates', '0611'); ?>
<!--                        </label>-->
<!--                    </a>-->
<!--                </div>-->
<!--            </td>-->
            <td>
                <div>
                    <input type="search" id="search_input" ng-model="input" ng-keyup="searchInput()" placeholder="пошук випусників"/>
                </div>
            </td>
        </tr>
    </table>
</div>
<script>
    function selectFilter(n) {
        $('.unselectedFilter').removeClass('selectedFilter');
        $(n).addClass('selectedFilter');
    }
</script>