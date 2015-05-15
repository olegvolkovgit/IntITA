<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 12.04.2015
 * Time: 2:05
 */
?>
<!--Render all parts of lesson content-->
<?php
    for ($i = count($data); $i > 0; $i--){

        switch ($data['id_type']){
            case 1:
                // done
                $this->renderPartial('_textBlock', array('data'=>$data['html_block'], 'order' => $data['block_order']));
                break;
            case 2:
                // done
                $this->renderPartial('_videoBlock', array('data'=>$data['html_block'], 'order' => $data['block_order']));
                break;
            case 3:
                // done
                $this->renderPartial('_exampleBlock', array('data'=>$data['html_block'], 'order' => $data['block_order']));
                break;
            case 4:
                // done
                $this->renderPartial('_codeBlock', array('data'=>$data['html_block'], 'order' => $data['block_order']));
                break;
            case 5:
                // done
                $this->renderPartial('_taskBlock', array('data'=>$data['html_block'], 'order' => $data['block_order']));
                break;
            case 6:
                // done
                $this->renderPartial('_finalTaskBlock', array('data'=>$data['html_block'], 'order' => $data['block_order']));
                break;
            case 7:
                // done
                $this->renderPartial('_instructionBlock', array('data'=>$data['html_block'], 'order' => $data['block_order']));
                break;
            case 8:
                $this->renderPartial('_labelBlock', array('data'=>$data['html_block'], 'order' => $data['block_order']));
                break;
            default:
                echo $data['html_block'];
        }
    }
?>
