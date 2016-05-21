<?php
/**
 * @var $counters array
 */
?>
<div class="panel panel-default">
    <div class="panel-body">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs">
            <li class="active"><a href="#countries" data-toggle="tab">Країни</a>
            </li>
            <li><a href="#cities" data-toggle="tab">Міста</a>
            </li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
            <div class="tab-pane fade in active" id="countries">
                <?php $this->renderPartial('_countriesTable');?>
            </div>
            <div class="tab-pane fade" id="cities">
                <?php $this->renderPartial('_citiesTable');?>
            </div>
        </div>
    </div>
</div>

<script>
    $jq(document).ready(function () {
        initCountriesList();
        initCitiesList();
    });
</script>




