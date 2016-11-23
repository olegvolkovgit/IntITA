function translateName(source, id, sourceId) {
    if(!source) source = $jq(sourceId).val();
    $jq(id).val(toEnglish(source));
}
