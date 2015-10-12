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
                $this->renderPartial('/lesson/_textBlock', array('data'=>$data, 'editMode' => $editMode));
                break;
            case 3:
                $this->renderPartial('/lesson/_exampleBlock', array('data'=>$data, 'editMode' => $editMode));
                break;
            case 4:
                $this->renderPartial('/lesson/_codeBlock', array('data'=>$data, 'editMode' => $editMode));
                break;
            case 7:
                $this->renderPartial('/lesson/_instructionBlock', array('data'=>$data, 'editMode' => $editMode));
                break;
            case 8:
                $this->renderPartial('/lesson/_labelBlock', array('data'=>$data, 'editMode' => $editMode));
                break;
            case 9:
                $this->renderPartial('/lesson/_imageBlock', array('data'=>$data, 'editMode' => $editMode));
                break;
            case 10:
                $this->renderPartial('/lesson/_formulaBlock', array('data'=>$data, 'editMode' => $editMode));
                break;
            case 11:
                $this->renderPartial('/lesson/_tableBlock', array('data'=>$data, 'editMode' => $editMode));
                break;
            default:
        }
    }
?>
