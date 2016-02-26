<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 14.04.2015
 * Time: 18:37
 */
?>
<div class="element">
    <div id="<?php echo "t" . $data['block_order'];?>">
        <pre>
            <code>
                <div ng-non-bindable>
                    <?php echo $data['html_block'];?>
                </div>
            </code>
        </pre>
    </div>
</div>
