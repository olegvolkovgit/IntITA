/**
 * Created by Wizlight on 14.01.2016.
 */
function CheckFile(file)
{
    var msg;
    var error=0;
    var maxSize=1024*1024*5;
    if(file.files[0].size>maxSize)
    error=error+1;
    var filesExt = ['jpg', 'gif', 'png','jpeg'];
    var parts = $(file).val().split('.');
    if(filesExt.join().search(parts[parts.length - 1]) == -1){
        error=error+2;
    }
    if(error!=0){
        switch (error) {
            case 1:
                msg='Файл перевищує 5 Мб';
                break;
            case 2:
                msg='Неправильний формат файлу';
                break;
            case 3:
                msg='Файл перевищує 5 Мб. Неправильний формат файлу';
                break;
        }
        $(file).next('.errorMessage').text(msg);
        $(file).next('.errorMessage').show();
        $('#submitButton').attr('disabled','true');
    }else{
        $(file).next('.errorMessage').hide();
        $('#submitButton').removeAttr('disabled');
    }
}