$(window).load(
    function() {
        var ukrMonthTitles = {
            'January': 'січня',
            'February': 'лютого',
            'March': 'березня',
            'April': 'квітня',
            'May': 'травня',
            'June': 'червня',
            'July': 'липня',
            'August': 'серпня',
            'September': 'вересня',
            'October': 'жовтня',
            'November': 'листопада',
            'December': 'грудня'
        };
        $('#month').text(ukrMonthTitles[$('#month').text()]);
        $('#summaLetters').text(toPhrase(summa));
    }
);
function sendData()
{
    window.location.search = '&nolayout=print';
}

function toPhrase(summa) {
    var x = parseFloat(summa).toFixed(2);
    if (x < 0 || x > 999999999999999.99) return false;

    var currency = 'UAH';
    if (currency != 'RUB' && currency != 'USD' && currency != 'EUR'  && currency != 'UAH')
        return false;

    var groups = [];
    groups[0] = [];
    groups[1] = [];
    groups[2] = [];
    groups[3] = [];
    groups[4] = [];
    groups[9] = [];

// рубли
// по умолчанию
    groups[0][-1] = {'RUB': 'рублів', 'USD': 'доларів США', 'EUR': 'євро', 'UAH': 'гривень'};
//исключения
    groups[0][1] = {'RUB': 'рубль', 'USD': 'долар США', 'EUR': 'євро', 'UAH': 'гривня'};
    groups[0][2] = {'RUB': 'рубля', 'USD': 'доларів США', 'EUR': 'євро', 'UAH': 'гривень'};
    groups[0][3] = {'RUB': 'рубля', 'USD': 'долара США', 'EUR': 'євро', 'UAH': 'гривні'};
    groups[0][4] = {'RUB': 'рубля', 'USD': 'долара США', 'EUR': 'євро', 'UAH': 'гривні'};

// тысячи
// по умолчанию
    groups[1][-1] = 'тисяч';
//исключения
    groups[1][1] = 'тисяча';
    groups[1][2] = 'тисячі';
    groups[1][3] = 'тисячі';
    groups[1][4] = 'тисячі';

// миллионы
// по умолчанию
    groups[2][-1] = 'мільйонів';
//исключения
    groups[2][1] = 'мільйон';
    groups[2][2] = 'мільйона';
    groups[2][3] = 'мільйона';
    groups[2][4] = 'мільйона';

// миллиарды
// по умолчанию
    groups[3][-1] = 'мільярдів';
//исключения
    groups[3][1] = 'мільярд';
    groups[3][2] = 'мільярда';
    groups[3][3] = 'мільярда';
    groups[3][4] = 'мільярда';

// триллионы
// по умолчанию
    groups[4][-1] = 'трильйонів';
//исключения
    groups[4][1] = 'трильйон';
    groups[4][2] = 'трильйона';
    groups[4][3] = 'трильйона';
    groups[4][4] = 'трильйона';

// копейки
// по умолчанию
    groups[9][-1] = {'RUB': 'копеек', 'USD': 'центів', 'EUR': 'центів', 'UAH': 'копійок'};
//исключения
    groups[9][1] = {'RUB': 'копейка', 'USD': 'цент', 'EUR': 'цент', 'UAH': 'копійка'};
    groups[9][2] = {'RUB': 'копейки', 'USD': 'центи', 'EUR': 'центи', 'UAH': 'копійки'};
    groups[9][3] = {'RUB': 'копейки', 'USD': 'центи', 'EUR': 'центи', 'UAH': 'копійки'};
    groups[9][4] = {'RUB': 'копейки', 'USD': 'центи', 'EUR': 'центи', 'UAH': 'копійки'};

// цифры и числа
// либо просто строка, либо 4 строки в хэше
    var names = [];
    names[1] = {0: 'один', 1: 'одна', 2: 'один', 3: 'один', 4: 'один'};
    names[2] = {0: 'дві', 1: 'дві', 2: 'дві', 3: 'дві', 4: 'дві'};
    names[3] = 'три';
    names[4] = 'чотири';
    names[5] = 'п\'ять';
    names[6] = 'шість';
    names[7] = 'сім';
    names[8] = 'вісім';
    names[9] = 'дев\'ять';
    names[10] = 'десять';
    names[11] = 'одинадцять';
    names[12] = 'дванадцять';
    names[13] = 'тринадцять';
    names[14] = 'чотирнадцять';
    names[15] = 'п\'ятнадцять';
    names[16] = 'шістнадцять';
    names[17] = 'сімнадцять';
    names[18] = 'вісімнадцять';
    names[19] = 'дев\'ятнадцять';
    names[20] = 'двадцять';
    names[30] = 'тридцять';
    names[40] = 'сорок';
    names[50] = 'п\'ятдесят';
    names[60] = 'шістдесят';
    names[70] = 'сімдесят';
    names[80] = 'вісімдесят';
    names[90] = 'дев\'яносто';
    names[100] = 'сто';
    names[200] = 'двісті';
    names[300] = 'триста';
    names[400] = 'чотириста';
    names[500] = 'п\'ятсот';
    names[600] = 'шістсот';
    names[700] = 'сімсот';
    names[800] = 'вісімсот';
    names[900] = 'дев\'ятсот';

    var r = '';
    var i, j;

    var y = Math.floor(x);

// если НЕ ноль рублей
    if (y > 0) {
        // выделим тройки с руб., тыс., миллионами, миллиардами и триллионами
        var t = [];

        for (i = 0; i <= 4; i++) {
            t[i] = y % 1000;
            y = Math.floor(y / 1000);
        }
        var d = [];
        // выделим в каждой тройке сотни, десятки и единицы
        for (i = 0; i <= 4; i++) {
            d[i] = [];
            d[i][0] = t[i] % 10; // единицы
            d[i][10] = t[i] % 100 - d[i][0]; // десятки
            d[i][100] = t[i] - d[i][10] - d[i][0]; // сотни
            d[i][11] = t[i] % 100; // две правых цифры в виде числа
        }

        for (i = 4; i >= 0; i--) {
            if (t[i] > 0) {
                if (names[d[i][100]])
                    r += ' ' + ((typeof(names[d[i][100]]) == 'object') ? (names[d[i][100]][i]) : (names[d[i][100]]));

                if (names[d[i][11]])
                    r += ' ' + ((typeof(names[d[i][11]]) == 'object') ? (names[d[i][11]][i]) : (names[d[i][11]]));
                else {
                    if (names[d[i][10]]) r += ' ' + ((typeof(names[d[i][10]]) == 'object') ? (names[d[i][10]][i]) : (names[d[i][10]]));
                    if (names[d[i][0]]) r += ' ' + ((typeof(names[d[i][0]]) == 'object') ? (names[d[i][0]][i]) : (names[d[i][0]]));
                }

                if (names[d[i][11]])  // если существует числительное
                    j = d[i][11];
                else
                    j = d[i][0];

                if (groups[i][j]) {
                    if (i == 0)
                        r += ' ' + groups[i][j][currency];
                    else
                        r += ' ' + groups[i][j];
                }
                else {
                    if (i == 0)
                        r += ' ' + groups[i][-1][currency];
                    else
                        r += ' ' + groups[i][-1];
                }
            }
        }
        if (t[0] == 0)
            r += ' ' + groups[0][-1][currency];
    }
    else
        r = 'Нуль ' + groups[0][-1][currency];

    y = Math.round((x - Math.floor(x)) * 100);
    if (y < 10) y = '0' + y;

    r = r.trim();
    r = r.substr(0, 1).toUpperCase() + r.substr(1);
    r += ' ' + y;

    y = y * 1;

    if (names[y])  // если существует числительное
        j = y;
    else
        j = y % 10;

    if (groups[9][j])
        r += ' ' + groups[9][j][currency];
    else
        r += ' ' + groups[9][-1][currency];

    return r;
}

