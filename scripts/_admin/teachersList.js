function generateEnglishName(first, last, middle) {
    if (document.getElementById("Teacher_first_name_en").value == '') {
        generateFirst(first);
    }
    if (document.getElementById("Teacher_middle_name_en").value == '') {
        generateMiddle(middle);
    }
    if (document.getElementById("Teacher_last_name_en").value == '') {
        generateLast(last);
    }
}

function generateFirst(first){
    $jq("#Teacher_first_name_en").val(toEnglish(first));
}

function generateMiddle(middle){
    $jq("#Teacher_middle_name_en").val(toEnglish(middle));
}

function generateLast(last){
    $jq("#Teacher_last_name_en").val(toEnglish(last));
}

function translateName(source, id, sourceId) {
    if(!source) source = $jq(sourceId).val();
    $jq(id).val(toEnglish(source));
}

function loadAdminTeachersIndex() {
    load(basePath + '/_teacher/_admin/teachers/index', 'Викладачі');
}