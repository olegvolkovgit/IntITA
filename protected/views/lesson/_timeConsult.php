<script language="javascript" type="text/javascript">
    /*значення таблиці з интервалом 20хв в ширину 3*/
    function timeInterval(a,b,c) {
        var delta=60/c;

        t1=a+parseInt(b/delta);
        t2=b*c;
        t3=a+parseInt((b+1)/delta);
        t4=(b+1)*c;
        if(t4==60) t4=0;

        if(t1.toString().length==1) t1='0'+ t1;
        if(t2.toString().length==1) t2='0'+ t2;
        if(t3.toString().length==1) t3='0'+ t3;
        if(t4.toString().length==1) t4='0'+ t4;

        t=t1+':'+t2+'-'+t3+':'+t4;
        return t;
    }
</script>

<p id="timeTitle">Виберіть годину</p>
<p  id="timeDate"></p>
<script>
    document.write("<table id='timeGrid'>");
    for (var i = 9; i < 23; i++) {
        document.write("<tr>");
        for (var j = 0; j < 3; j++) {
            document.write("<td class='<?php  echo '' ?>'>");
            document.write(timeInterval(i,j,20));
            document.write("</td>");
        }
        document.write("</tr>");
    }
    document.write("</table>");
</script>

<div id="timeInfo">
    Ви можете вибрать декілька консультацій.
    Використовуйте клавіші <span class="colorP">Ctrl</span> або <span class="colorP">Shift</span>.
</div>

<button id="consultationBack">Назад</button>
<button id="consultationNext">Далі</button>