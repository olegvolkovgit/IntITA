<?php
/**
 * Created by PhpStorm.
 * User: Adm
 * Date: 23.11.2017
 * Time: 20:06
 */
?>
<div ng-controller="studentsProjectsCtrl">
<pre>
    {{file}}
</pre>
    <div
            data-angular-treeview="true"
            data-tree-id="projectFiles"
            data-tree-model="files"
            data-node-id="id"
            data-node-label="name"
            data-node-children="children" >
    </div>
</div>