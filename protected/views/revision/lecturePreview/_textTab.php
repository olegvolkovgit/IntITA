<?php
foreach ($data as $block) {
    switch ($block['id_type']){
        case 1:
            $this->renderPartial('lecturePreview/_textBlock', array('data'=>$block));
            break;
        case 3:
            $this->renderPartial('lecturePreview/_codeBlock', array('data'=>$block));
            break;
        case 4:
            $this->renderPartial('lecturePreview/_exampleBlock', array('data'=>$block));
            break;
        case 7:
            $this->renderPartial('lecturePreview/_instructionBlock', array('data'=>$block));
            break;
        default:
            $this->renderPartial('lecturePreview/_textBlock', array('data'=>$block));
            break;
    }
}
?>
