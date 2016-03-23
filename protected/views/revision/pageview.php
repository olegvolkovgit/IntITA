<!--var_dump($lectureRevision);-->
<!--
                        "page" => $page,
                        "video" => $video,
                        "lectureBody" => $lectureBody,
                        "quiz" => $quiz));
-->

<h1>Title</h1>
<?php
    echo CHtml::beginForm("/revision/editpagetitle");
    echo CHtml::textField("title", $page->page_title);
    echo CHtml::hiddenField("idPage", $page->id);
    echo CHtml::submitButton("Title");
    echo CHtml::endForm();
?>


<h1>Video</h1>
<?php
    echo CHtml::beginForm("/revision/addVideo");
    echo CHtml::textField("url", (isset($video)?$video->html_block:""));
    echo CHtml::hiddenField("idPage", $page->id);
    echo CHtml::submitButton("Video");
    echo CHtml::endForm();
?>

<h1>Blocks</h1>
<?php
    if (isset($lectureBody)) {
        echo "<h3>Current blocks</h3>";
        foreach ($lectureBody as $lectureElement) {
            echo CHtml::beginForm("/revision/editLectureElement");
            echo CHtml::dropDownList('idType', $lectureElement->id_type, array(1=>1, 3=>3, 4=>4, 7=>7));
            echo "<br>";
            echo CHtml::textArea("html_block", $lectureElement->html_block);
            echo "<br>";
            echo CHtml::hiddenField("idPage", $page->id);
            echo CHtml::hiddenField("idElement", $lectureElement->id);
            echo "<br>";
            echo CHtml::submitButton("Edit");
            echo CHtml::button("Up", array('onclick' => 'upElement('.$lectureElement->id.',' . $page->id . ')'));
            echo CHtml::button("Down", array('onclick' => 'downElement('.$lectureElement->id.',' . $page->id . ')'));
            echo CHtml::button("Delete", array('onclick' => 'deleteElement('.$lectureElement->id.',' . $page->id . ')'));
            echo CHtml::endForm();
        }
    }

    echo "<h3>Add new</h3>";
    echo CHtml::beginForm("/revision/addLectureElement");
    echo CHtml::dropDownList('idType', '1', array(1=>1, 3=>3, 4=>4, 7=>7));
    echo "<br>";
    echo CHtml::textArea("html_block");
    echo "<br>";
    echo CHtml::hiddenField("idPage", $page->id);
    echo "<br>";
    echo CHtml::submitButton("Add");
    echo CHtml::endForm();
?>

<h1>Quiz</h1>
<?php
?>
