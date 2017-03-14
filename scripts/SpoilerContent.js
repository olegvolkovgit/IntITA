/**------------------recall-------------------------*/
// $(document).ready(function() {
//     $('.spoiler-body').hide();
//     $('.spoiler-title').click(function(){
//         $(this).toggleClass('opened').toggleClass('closed').next().slideToggle();
//         if($(this).hasClass('opened')) {
//             var a=document.getElementById('id1').value;
//             $(this).html(a + "\u25B2");
//         }
//         else {
//             var b=document.getElementById('id2').value;
//             $(this).html(b + "\u25BC");
//         }
//     });
// });
// function hideRecall(spoiler){
//     $(spoiler).parent().prev('.spoiler-title').toggleClass('opened').toggleClass('closed').next().slideToggle();
//     if($(spoiler).parent().prev('.spoiler-title').hasClass('opened')) {
//         var a=document.getElementById('id1').value;
//         $(spoiler).parent().prev('.spoiler-title').html(a + "\u25B2");
//     }
//     else {
//         var b=document.getElementById('id2').value;
//         $(spoiler).parent().prev('.spoiler-title').html(b + "\u25BC");
//     }
// }
//celebre
function  diploma_dialog(name, course) {

    bootbox.alert({
        message: '<div id="editor">'+'</div>'+
        '<button id="print-diploma">'+'Save'+'</button>'+
                '<div class="diploma-container">'+
                    '<div class="diploma-logo" >'+
                        '<img class="img-diploma" src="images/diploma/logo_diplom.png" alt="logo_diploma_intita">'+
                    '</div>'+
                    '<h1 class="diploma-header">'+'diploma'+'</h1>'+
                    '<p class="certificate">'+'This Sertifies That:'+'</p>'+
                    '<h2 class="diploma-owner-name">'+name+'</h2>'+
                    '<p class="student_achievements">'+'has successfully completed the requirements for the'+
                        '<br>'+'<span>'+'certificate program'+'</span>'+
                        '<br>'+'in '+'<span>'+'information technologies'+'</span>'+
                        '<br>'+ 'and meets strong junior level of programmer'+'</p>'+
                    '<p class="course">'+'course:'+'</p>'+
                    '<h2 class="diploma-owner-name">'+course+'</h2>'+
                    '<div class="sign">'+
                        '<ul>'+
                            '<li>'+'CEO: Roman Melnyk'+'</li>'+
                            '<li>'+'Date: December, 27, 2017'+'</li>'+
                        '</ul>'+
                        '<img class="img-diploma" src="images/diploma/sing_intita.png" alt="director_sign">'+
                        '<p class="diplom-number">'+'A11 № 000002-001'+'</p>'+
                    '</div>'+
                '</div>',
        size: 'large'
    });
// // do something in the background
   $('.modal-footer > .btn').hide();
}
    var doc = new jsPDF();
    var specialElementHandlers = {
        '#editor': function (element, renderer) {
            return true;
        }
    };
    $('.print-diploma').click(function () {
        doc.fromHTML($('.diploma-container').html(), 15, 15, {
            'width': 170,
            'elementHandlers': specialElementHandlers
        });
        doc.save('sample-file.pdf');
    });

// open comment with click
function openComment(elem) {
    var bodyElem = elem.querySelector('.spoiler-body');
    $(document).ready(function() {
        $(bodyElem).slideToggle().toggleClass('opened');
    })
    elem.classList.toggle('opened');
    // bodyElem.classList.toggle('opened');
    var maximize = elem.querySelector('.maximize').value;
    var minimize = elem.querySelector('.minimize').value;

    (function selectData() {
        var title = elem.querySelector('span');
        if (elem.classList.contains('opened')) {
            title.innerHTML = maximize + "\u25B2";
        } else {
            title.innerHTML = minimize + "\u25BC";
        }
    })();
}

// open comment with click
// celebre