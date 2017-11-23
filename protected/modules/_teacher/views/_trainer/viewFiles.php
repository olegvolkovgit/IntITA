<?php
/**
 * Created by PhpStorm.
 * User: Adm
 * Date: 23.11.2017
 * Time: 20:06
 */
?>
<div ng-controller="studentsProjectsCtrl">
    <button ng-click="getFileContent()">getfile</button>
    <div style="height: 80%;  width: 100%; border: 1px solid; overflow: auto;">
<pre>
    {{file}}
</pre>
    </div>
<div id="files">

</div>
</div>