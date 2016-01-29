<?php
for ($i = count($data); $i > 0; $i--){
    switch ($data['id_type']){
        case 1:
            $this->renderPartial('_textBlock', array('data'=>$data));
            break;
        case 3:
            $this->renderPartial('_exampleBlock', array('data'=>$data));
            break;
        case 4:
            $this->renderPartial('_codeBlock', array('data'=>$data));
            break;
        case 7:
            $this->renderPartial('_instructionBlock', array('data'=>$data));
            break;
        default:
            break;
    }
}
?>
