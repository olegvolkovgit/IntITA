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
                $this->renderPartial('_textBlock', array('data'=>$data, 'editMode' => $editMode));
                break;
            case 3:
                $this->renderPartial('_exampleBlock', array('data'=>$data, 'editMode' => $editMode));
                break;
            case 4:
                $this->renderPartial('_codeBlock', array('data'=>$data, 'editMode' => $editMode));
                break;
            case 5:
               // $this->renderPartial('_taskBlock', array('data'=>$data, 'editMode' => $editMode, 'user' => $user));
                break;
            case 6:
                break;
            case 7:
                $this->renderPartial('_instructionBlock', array('data'=>$data, 'editMode' => $editMode));
                break;
            case 8:
                $this->renderPartial('_labelBlock', array('data'=>$data, 'editMode' => $editMode));
                break;
            case 9:
                $this->renderPartial('_imageBlock', array('data'=>$data, 'editMode' => $editMode));
                break;
            case 10:
                $this->renderPartial('_formulaBlock', array('data'=>$data, 'editMode' => $editMode));
                break;
            case 11:
                $this->renderPartial('_tableBlock', array('data'=>$data, 'editMode' => $editMode));
                break;
            case 12:
                //$this->renderPartial('_testBlock', array('data'=>$data, 'editMode' => $editMode, 'user' => $user));
                break;
            case 13:
                break;
            default:
                echo $data['html_block'];
        }
    }
?>
