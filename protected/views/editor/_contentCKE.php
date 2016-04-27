<?php
/**
 * @var $data LectureElement
 */
?>
<br>
<?php
switch ($data->id_type) {
    case LectureElement::TEXT:
        $this->renderPartial('/editor/_textBlockCKE', array('data' => $data, 'editMode' => $editMode));
        break;
    case LectureElement::CODE:
        $this->renderPartial('/editor/_codeBlockCKE', array('data' => $data, 'editMode' => $editMode));
        break;
    case LectureElement::EXAMPLE:
        $this->renderPartial('/editor/_exampleBlockCKE', array('data' => $data, 'editMode' => $editMode));
        break;
    case LectureElement::INSTRUCTION:
        $this->renderPartial('/editor/_instructionBlockCKE', array('data' => $data, 'editMode' => $editMode));
        break;
    default:
        break;
}
?>
