<?php
/**
 * @var $data LectureElement
 */
switch ($data->id_type) {
    case LectureElement::TEXT:
        $this->renderPartial('/lesson/_textBlock', array('data' => $data));
        break;
    case LectureElement::CODE:
        $this->renderPartial('/lesson/_codeBlock', array('data' => $data));
        break;
    case LectureElement::EXAMPLE:
        $this->renderPartial('/lesson/_exampleBlock', array('data' => $data));
        break;
    case LectureElement::INSTRUCTION:
        $this->renderPartial('/lesson/_instructionBlock', array('data' => $data));
        break;
    default:
        break;
}
?>
