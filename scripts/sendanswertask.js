/**
 * Created by Wizlight on 23.06.2015.
 */
$('.sendAnswer').on('submit', function(){
    var $that = $(this),
        someVars = $('#taskSubmit',$that).data('vars'),
        str = $that.prev('.instrTaskText').attr('id');
    $('[name=task]',$that).val(someVars+'-'+str.substring(1));
});