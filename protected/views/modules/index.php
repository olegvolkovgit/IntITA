
<h2>Всі модулі</h2>
<?php
$this->widget('zii.widgets.CListView', array(
    'dataProvider'=>$dataProvider,
    'itemView'=>'_moduleBlock',
    'summaryText' =>'',
    )
);