<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 12.04.2015
 * Time: 2:05
 */
?>
<br>
<?php
    for ($i = count($data); $i > 0; $i--){

        switch ($data['id_type']){
            case 1:
                $this->renderPartial('/editor/imperavi/_textBlock', array('data'=>$data, 'editMode' => $editMode));
                break;
            case 3:
                $this->renderPartial('/editor/imperavi/_exampleBlock', array('data'=>$data, 'editMode' => $editMode));
                break;
            case 4:
                $this->renderPartial('/editor/imperavi/_codeBlock', array('data'=>$data, 'editMode' => $editMode));
                break;
            case 7:
                $this->renderPartial('/editor/imperavi/_instructionBlock', array('data'=>$data, 'editMode' => $editMode));
                break;
            default:
        }
    }
?>
