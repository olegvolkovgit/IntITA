<?php
/**
 * Created by PhpStorm.
 * User: Wizlight
 * Date: 08.09.2015
 * Time: 22:40
 */
?>
<div style="text-align: right">
    <table class="graduatesFilter">
        <tr>
            <td>
                <div>
                    <?php
                    echo CHtml::ajaxLink(Yii::t('graduates', '0609'), CController::createUrl('graduate/UpdateAjaxFilter',
                        array('selector' => 'az')),
                        array('update' => '#graduateBlock'),
                        array('class' => 'unselectedFilter', "onclick" => "selectFilter(this)"));
                    ?>
                </div>
            </td>
            <td>
                <div>
                    <?php
                    echo CHtml::ajaxLink(Yii::t('graduates', '0610'), CController::createUrl('graduate/UpdateAjaxFilter',
                        array('selector' => 'date')),
                        array('update' => '#graduateBlock'),
                        array('class' => 'unselectedFilter', "onclick" => "selectFilter(this)"));
                    ?>
                </div>
            </td>
            <td>
                <div>
                    <?php
                    echo CHtml::ajaxLink(Yii::t('graduates', '0611'), CController::createUrl('graduate/UpdateAjaxFilter',
                        array('selector' => 'rating')),
                        array('update' => '#graduateBlock'),
                        array('class' => 'unselectedFilter selectedFilter', "onclick" => "selectFilter(this)"));
                    ?>
                </div>
            </td>
            <td>
                <div>
                    <?php echo CHtml::textField('Text', 'search',
                        array('id'=>'searchStudent',
                            'width'=>300,
                            'maxlength'=>100)
                        ); ?>
                    <?php
                        echo CHtml::button('Пошук');
                    ?>
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