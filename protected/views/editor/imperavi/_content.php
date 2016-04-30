<?php
/**
 * @var $data LectureElement
 */
?>
<br>
<?php
switch ($data->id_type) {
    case LectureElement::TEXT:
        $this->renderPartial('/editor/imperavi/_textBlock', array('data' => $data, 'editMode' => $editMode));
        break;
    case LectureElement::CODE:
        $this->renderPartial('/editor/imperavi/_codeBlock', array('data' => $data, 'editMode' => $editMode));
        break;
    case LectureElement::EXAMPLE:
        $this->renderPartial('/editor/imperavi/_exampleBlock', array('data' => $data, 'editMode' => $editMode));
        break;
    case LectureElement::INSTRUCTION:
        $this->renderPartial('/editor/imperavi/_instructionBlock', array('data' => $data, 'editMode' => $editMode));
        break;
    default:
}
?>
