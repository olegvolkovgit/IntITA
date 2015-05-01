/* функция обработки таблицы */
function parseTable($mytable) {
    var arr = [];
    var tbl = document.getElementById($mytable);
    for (var r=0; r<tbl.rows.length; r++) {
        // последовательнный перебор всех рядов в каждой таблице
        for (var c=0; c<tbl.rows[r].cells.length; c++) {
            // последовательный перебор всех ячеек
            var cls = tbl.rows[r].cells[c];
            if(cls.className=='pressedTime'){
                arr.push(cls.innerHTML)
            }
        }
    }
    return intervalConsultationArr(arr); //преобразуем в интервалы
}
/* 1)Заносим соседнее время в ячейки массива 2)Соеденяем соседнии интервалы в один*/
function intervalConsultationArr($allTime) {
/* 1)*/
    var arr = $allTime;
    var arrT = [];
    var i=0;
    for (var t=0; t<arr.length; t++) {
        if(arr.length==1) arrT[i]=arr[t];
        if(arr[t+1] && (arr[t].substr(6,5)==arr[t+1].substr(0,5))){
            if(!arrT[i]) arrT[i]=arr[t];
            arrT[i]=arrT[i]+arr[t+1];
        }
        if((arr[t+1] && (arr[t].substr(6,5)!==arr[t+1].substr(0,5))) || !arr[t+1]){
            if(!arrT[i]) arrT[i]=arr[t];
            arrT[i]=arrT[i];
            i++;
        }
    }
/* 2)*/
    var arrI = [];
    for (var j=0; j<arrT.length; j++) {
        arrI[j]=arrT[j].substr(0,5)+'-'+arrT[j].substr(arrT[j].lastIndexOf('-')+1,6);
    }
    return arrI;
}
