<?php
/**
 * @var $data LectureElement
 */
switch ($data->id_type) {
    case LectureElement::TEXT:
        $this->renderPartial('_textBlock', array('data' => $data));
        break;
    case LectureElement::CODE:
        $this->renderPartial('_codeBlock', array('data' => $data));
        break;
    case LectureElement::EXAMPLE:
        $this->renderPartial('_exampleBlock', array('data' => $data));
        break;
    case LectureElement::INSTRUCTION:
        $this->renderPartial('_instructionBlock', array('data' => $data));
        break;
    default:
        break;
}
?>
