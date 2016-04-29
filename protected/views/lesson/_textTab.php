<?php
for ($i = count($data); $i > 0; $i--){
    switch ($data['id_type']){
        case 1:
            $this->renderPartial('/lesson/_textBlock', array('data'=>$data));
            break;
        case 3:
            $this->renderPartial('/lesson/_codeBlock', array('data'=>$data));
            break;
        case 4:
            $this->renderPartial('/lesson/_exampleBlock', array('data'=>$data));
            break;
        case 7:
            $this->renderPartial('/lesson/_instructionBlock', array('data'=>$data));
            break;
        default:
            break;
    }
}
?>
