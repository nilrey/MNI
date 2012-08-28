
function MakeArray(n) {
    this.length = n;
    return this;
}

var execTime = "13:16 20.12.2006";

regionNames = new MakeArray(22);
regionNames['world'] = "Мировой океан";
regionNames['russia'] = "Моря России";
regionNames['north_atlant'] = "Северная часть Атлантического океана";
regionNames['south_atlant'] = "Южная часть Атлантического океана";
regionNames['indian'] = "Индийский океан";
regionNames['north'] = "Северный Ледовитый океан";
regionNames['south'] = "Южный океан";
regionNames['north_pacific'] = "Северная часть Тихого океана";
regionNames['south_pacific'] = "Южная часть Тихого океана";
regionNames['caspian'] = "Каспийское море";
regionNames['azov'] = "Азовское море";
regionNames['black'] = "Черное море";
regionNames['baltic'] = "Балтийское море";
regionNames['baren'] = "Баренцево море";
regionNames['beloe'] = "Белое море";
regionNames['berin'] = "Берингово море";
regionNames['chukot'] = "Чукотское море";
regionNames['v-sib'] = "Восточно-Сибирское море";
regionNames['lapt'] = "Море Лаптевых";
regionNames['karsk'] = "Карское море";
regionNames['okhot'] = "Охотское море";
regionNames['japan'] = "Японское море";

topicNames = new MakeArray(17);
topicNames[1] = "Морская среда";
topicNames[2] = "Морская деятельность";
topicNames[3] = "Социально-экономическая информация";
topicNames[4] = "Правовая информация";
topicNames[5] = "Нормативно-методические документы";
topicNames[6] = "Научно-техническая информация";
topicNames[7] = "Новости СМИ";
topicNames[8] = "Метеорология";
topicNames[9] = "Гидродинамика";
topicNames[10] = "Загрязнение";
topicNames[11] = 'Гидрология устьев рек';
topicNames[12] = "Гидробиология";
topicNames[13] = "Морские перевозки";
topicNames[14] = "Мировой морской флот";
topicNames[15] = "Освоение минеральных<br> ресурсов";
topicNames[16] = "Морская геология-геофизика";
topicNames[17] = "Промышленное рыболовство";

topicLinks = new MakeArray(17);
topicLinks[1] = "1422";
topicLinks[2] = "1423";
topicLinks[3] = "1424";
topicLinks[4] = "1425";
topicLinks[5] = "1426";
topicLinks[6] = "1427";
topicLinks[7] = "1428";
topicLinks[8] = "1429";
topicLinks[9] = "1431";
topicLinks[10] = "1434";
topicLinks[11] = '1430';
topicLinks[12] = "1436";
topicLinks[13] = "1439";
topicLinks[14] = "1441";
topicLinks[15] = "1443";
topicLinks[16] = "1437";
topicLinks[17] = "1442";

var regionCoordsFull = new MakeArray(22);
regionCoordsFull['world'] = new Array("bx1=-180&bx2=180&by1=90&by2=-90");
regionCoordsFull['russia'] = new Array("bx1=-7&bx2=178&by1=33&by2=82");
regionCoordsFull['north_atlant'] = new Array("bx1=-189.8&bx2=19.8&by1=0&by2=82.4");
regionCoordsFull['south_atlant'] = new Array("bx1=-72&bx2=37.9&by1=0&by2=82.3");
regionCoordsFull['indian'] = new Array("bx1=16.6&bx2=153.2&by1=33.5&by2=-70");
regionCoordsFull['north'] = new Array("bx1=-180&bx2=180&by1=65&by2=90");
regionCoordsFull['south'] = new Array("bx1=180&bx2=-180&by1=-66&by2=90");
regionCoordsFull['north_pacific'] = new Array("bx1=97.6&bx2=-60.8&by1=0&by2=89");
regionCoordsFull['south_pacific'] = new Array("bx1=95.9&bx2=-60.&by1=0&by2=-89");
regionCoordsFull['caspian'] = new Array("bx1=46&bx2=55&by1=36&by2=48");
regionCoordsFull['azov'] = new Array("bx1=33&bx2=40&by1=45&by2=48");
regionCoordsFull['black'] = new Array("bx1=27&bx2=42&by1=40&by2=47");
regionCoordsFull['baltic'] = new Array("bx1=7&bx2=31&by1=52&by2=67");
regionCoordsFull['baren'] = new Array("bx1=10&bx2=80&by1=66&by2=82");
regionCoordsFull['beloe'] = new Array("bx1=32&bx2=45&by1=63&by2=68");
regionCoordsFull['berin'] = new Array("bx1=161&bx2=-160&by1=50&by2=67");
regionCoordsFull['chukot'] = new Array("bx1=178&bx2=155&by1=65&by2=77");
regionCoordsFull['v-sib'] = new Array("bx1=140&bx2=180&by1=68&by2=82");
regionCoordsFull['lapt'] = new Array("bx1=95&bx2=145&by1=70&by2=82");
regionCoordsFull['karsk'] = new Array("bx1=55&bx2=108&by1=66&by2=82");
regionCoordsFull['okhot'] = new Array("bx1=134&bx2=166&by1=43&by2=63");
regionCoordsFull['japan'] = new Array("bx1=127&bx2=143&by1=33&by2=53");

regionNumbers = new MakeArray(22);
//regionNames[имя] = new Array(кол-во центров, поставщиков, ресурсов, приложений, запросов);
regionNumbers['world'] = new Array(14, 21, 12, 602, 15680);
regionNumbers['russia'] = new Array(13, 20, 11, 602, 15670);
regionNumbers['north_atlant'] = new Array(12, 19, 10, 602, 15660);
regionNumbers['south_atlant'] = new Array(11, 18, 9, 602, 15650);
regionNumbers['indian'] = new Array(10, 17, 8, 602, 15640);
regionNumbers['north'] = new Array(9, 16, 7, 602, 15630);
regionNumbers['south'] = new Array(8, 15, 6, 602, 15620);
regionNumbers['north_pacific'] = new Array(7, 14, 8, 602, 15610);
regionNumbers['south_pacific'] = new Array(6, 13, 9, 602, 15600);
regionNumbers['caspian'] = new Array(5, 12, 9, 602, 15590);
regionNumbers['azov'] = new Array(4, 11, 10, 602, 15580);
regionNumbers['black'] = new Array(3, 10, 11, 602, 15570);
regionNumbers['baltic'] = new Array(2, 9, 10, 602, 15560);
regionNumbers['baren'] = new Array(5, 8, 9, 602, 15550);
regionNumbers['beloe'] = new Array(6, 9, 8, 602, 15540);
regionNumbers['berin'] = new Array(7, 10, 7, 602, 15530);
regionNumbers['chukot'] = new Array(8, 11, 6, 602, 15520);
regionNumbers['v-sib'] = new Array(9, 12, 5, 602, 15510);
regionNumbers['lapt'] = new Array(10, 13, 4, 602, 15500);
regionNumbers['karsk'] = new Array(11, 14, 7, 602, 15490);
regionNumbers['okhot'] = new Array(12, 15, 8, 602, 15480);
regionNumbers['japan'] = new Array(13, 16, 9, 602, 15470);

regionTopics = new MakeArray(22);
//regionTopics[имя] = new Array(17 рубрик - сколько ресурсов в каждом);
regionTopics['azov'] = new Array(36, 31, 0, 1, 0, 0, 2, 13, 2, 6, 1, 2, 2, 2, 1, 11, 4, 10);
regionTopics['baltic'] = new Array(43, 29, 1, 1, 0, 0, 2, 18, 2, 7, 1, 2, 2, 0, 0, 10, 4, 10);
regionTopics['baren'] = new Array(52, 37, 1, 1, 0, 0, 2, 19, 6, 10, 1, 6, 2, 2, 1, 10, 4, 10);
regionTopics['beloe'] = new Array(46, 36, 1, 1, 0, 0, 2, 18, 3, 8, 1, 3, 2, 2, 1, 10, 4, 10);
regionTopics['berin'] = new Array(37, 26, 0, 1, 0, 0, 2, 14, 2, 5, 1, 2, 2, 0, 0, 10, 4, 10);
regionTopics['v-sib'] = new Array(43, 34, 0, 1, 0, 0, 2, 14, 3, 7, 1, 3, 3, 2, 1, 10, 4, 10);
regionTopics['karsk'] = new Array(45, 34, 0, 1, 0, 0, 2, 16, 3, 9, 1, 3, 2, 2, 1, 10, 4, 10);
regionTopics['caspian'] = new Array(39, 30, 0, 1, 0, 0, 2, 15, 2, 7, 1, 2, 2, 2, 1, 10, 4, 10);
regionTopics['lapt'] = new Array(43, 35, 0, 1, 0, 0, 2, 14, 3, 8, 1, 3, 4, 2, 1, 10, 4, 11);
regionTopics['okhot'] = new Array(42, 30, 0, 1, 0, 0, 2, 14, 2, 7, 2, 2, 3, 2, 1, 10, 4, 10);
regionTopics['black'] = new Array(39, 31, 0, 1, 0, 0, 2, 15, 2, 7, 1, 2, 2, 2, 1, 11, 4, 10);
regionTopics['chukot'] = new Array(41, 30, 0, 1, 0, 0, 2, 14, 3, 7, 1, 3, 2, 0, 0, 10, 4, 10);
regionTopics['japan'] = new Array(40, 30, 0, 1, 0, 0, 2, 13, 2, 7, 3, 2, 3, 2, 1, 10, 4, 10);
regionTopics['world'] = new Array(77, 42, 1, 1, 0, 0, 2, 30, 6, 16, 3, 6, 5, 2, 1, 11, 4, 12);
regionTopics['north_atlant'] = new Array(52, 34, 0, 1, 0, 0, 2, 16, 3, 13, 1, 3, 4, 0, 0, 11, 4, 12);
regionTopics['south_atlant'] = new Array(49, 30, 0, 1, 0, 0, 2, 22, 2, 8, 1, 2, 4, 0, 0, 10, 4, 12);
regionTopics['north_pacific'] = new Array(60, 40, 1, 1, 0, 0, 2, 21, 6, 14, 1, 6, 3, 2, 1, 11, 4, 11);
regionTopics['south_pacific'] = new Array(47, 29, 0, 1, 0, 0, 2, 22, 2, 7, 1, 2, 3, 0, 0, 10, 4, 11);
regionTopics['indian'] = new Array(51, 31, 0, 1, 0, 0, 2, 22, 2, 8, 2, 2, 5, 0, 0, 11, 4, 12);
regionTopics['russia'] = new Array(67, 41, 1, 1, 0, 0, 2, 21, 6, 15, 3, 6, 5, 2, 1, 11, 4, 12);
regionTopics['north'] = new Array(52, 37, 1, 1, 0, 0, 2, 18, 3, 10, 1, 3, 4, 2, 1, 10, 4, 11);
regionTopics['south'] = new Array(40, 27, 0, 1, 0, 0, 2, 20, 2, 4, 1, 2, 2, 0, 0, 10, 4, 10);


regionCoords = new MakeArray(22);
//regionTopics[имя] = new Array(координаты района);
regionCoords['world'] = new Array("180° з.д.", "180° в.д.", "90° с.ш.", "90° ю.ш.");
regionCoords['russia'] = new Array("7° з.д.", "178° в.д.", "33° с.ш.", "82° c.ш.");
regionCoords['north_atlant'] = new Array("89,8° з.д.", "19,8° в.д.", "0° с.ш.", "82,4° с.ш.");
regionCoords['south_atlant'] = new Array("72° з.д.", "37,9° в.д.", "0° ю.ш.", "82,3° ю.ш.");
regionCoords['indian'] = new Array("16,6° в.д.", "153,2° в.д.", "33,5° с.ш.", "70° ю.ш.");
regionCoords['north'] = new Array("180° з.д.", "180° в.д.", "65°  с.ш.", "90° с.ш.");
regionCoords['south'] = new Array("180° в.д.", "180° з.д.", "66°  ю.ш.", "90° ю.ш.");
regionCoords['north_pacific'] = new Array("97,6° в.д.", "60,8° з.д.", "0° с.ш.", "89° с.ш.");
regionCoords['south_pacific'] = new Array("95,9° в.д.", "60,5° з.д.", "0° ю.ш.", "89° ю.ш.");
regionCoords['caspian'] = new Array("46° в.д.", "55° в.д.", "36° с.ш.", "48° с.ш.");
regionCoords['azov'] = new Array("33° в.д.", "40° в.д.", "45° с.ш.", "48° с.ш.");
regionCoords['black'] = new Array("27° в.д.", "42° в.д.", "40° с.ш.", "47° с.ш.");
regionCoords['baltic'] = new Array("7° в.д.", "31° в.д.", "52° с.ш.", "67° с.ш.");
regionCoords['baren'] = new Array("10° в.д.", "80° в.д.", "66° с.ш.", "82° с.ш.");
regionCoords['beloe'] = new Array("32° в.д.", "45° в.д.", "63° с.ш.", "68° с.ш.");
regionCoords['berin'] = new Array("161° в.д.", "160° з.д.", "50° с.ш.", "67° с.ш.");
regionCoords['chukot'] = new Array("178° в.д.", "155° з.д.", "65° с.ш.", "77° с.ш.");
regionCoords['v-sib'] = new Array("140° в.д.", "180° в.д.", "68° с.ш.", "82° с.ш.");
regionCoords['lapt'] = new Array("95° в.д.", "145° в.д.", "70° с.ш.", "82° с.ш.");
regionCoords['karsk'] = new Array("55° в.д.", "108° в.д.", "66° с.ш.", "82° с.ш.");
regionCoords['okhot'] = new Array("134° в.д.", "166° в.д.", "43° с.ш.", "63° с.ш.");
regionCoords['japan'] = new Array("127° в.д.", "143° в.д.", "33° с.ш.", "53° с.ш.");

params = new MakeArray(22);
params['azov'] = new Array('', '', '', '', '13', '9.0', '1.0', '4.3', '12', '1.0', '0.0', '0.5', '13', '9.0', '1.0', '4.2');
params['baltic'] = new Array('19', '8.4', '5.6', '7.3', '35', '36.0', '-2.0', '6.8', '8', '3.0', '0.0', '1.6', '13', '18.0', '1.0', '6.3');
params['baren'] = new Array('17', '8.1', '-1.4', '4.5', '65', '36.0', '-24.0', '-1.1', '10', '4.0', '0.0', '1.8', '35', '18.0', '1.0', '5.2');
params['beloe'] = new Array('4', '5.0', '3.0', '4.0', '27', '21.0', '-19.0', '-2.8', '2', '4.0', '1.0', '2.5', '18', '10.0', '2.0', '4.8');
params['berin'] = new Array('65', '6.0', '3.4', '4.5', '42', '6.0', '-3.2', '0.6', '4', '9.0', '4.0', '6.0', '', '', '', '');
params['v-sib'] = new Array('', '', '', '', '10', '4.9', '-32.0', '-24.4', '', '', '', '', '', '', '', '');
params['karsk'] = new Array('1', '4.9', '-1.4', '-1.4', '9', '4.9', '-24.0', '-10.6', '', '', '', '', '4', '8.0', '2.0', '4.2');
params['caspian'] = new Array('26', '16.0', '9.9', '13.9', '5', '7.0', '4.0', '5.8', '5', '2.0', '0.0', '0.6', '5', '7.0', '0.0', '2.6');
params['lapt'] = new Array('', '', '', '', '79', '4.9', '-32.6', '-29.1', '', '', '', '', '1', '18.0', '18.0', '18.0');
params['okhot'] = new Array('60', '14.0', '2.0', '6.3', '57', '19.0', '-25.0', '-7.5', '20', '5.0', '0.0', '1.3', '42', '15.0', '0.0', '3.5');
params['black'] = new Array('', '', '', '', '16', '9.0', '1.0', '4.3', '15', '1.0', '0.0', '0.6', '16', '9.0', '1.0', '4.1');
params['chukot'] = new Array('', '', '', '', '104', '4.9', '-32.3', '-29.5', '', '', '', '', '', '', '', '');
params['japan'] = new Array('155', '28.0', '0.3', '15.0', '55', '19.0', '-20.0', '1.9', '12', '4.0', '0.0', '1.2', '26', '7.0', '0.0', '2.8');
params['world'] = new Array('20619', '35.0', '-1.8', '19.7', '3811', '36.0', '-39.2', '8.2', '265', '20.0', '0.0', '3.9', '795', '25.0', '0.0', '9.9');
params['north_atlant'] = new Array('4826', '35.0', '-1.0', '18.6', '1317', '31.6', '-32.3', '13.0', '114', '12.0', '0.0', '3.4', '141', '21.0', '0.0', '11.2');
params['south_atlant'] = new Array('3306', '33.0', '-1.8', '18.9', '158', '35.0', '-3.2', '21.8', '1', '7.0', '7.0', '7.0', '47', '18.0', '5.0', '11.8');
params['north_pacific'] = new Array('5622', '32.3', '0.0', '20.8', '1930', '32.5', '-39.2', '-0.2', '158', '20.0', '0.0', '4.2', '317', '25.0', '0.0', '10.2');
params['south_pacific'] = new Array('5683', '32.1', '-1.1', '20.3', '420', '36.0', '-2.2', '25.4', '7', '6.0', '3.0', '4.2', '182', '20.0', '1.0', '10.8');
params['indian'] = new Array('4166', '32.3', '-1.7', '19.4', '512', '36.0', '-3.8', '25.2', '8', '7.0', '3.0', '5.3', '129', '25.0', '1.0', '7.8');
params['russia'] = new Array('733', '28.0', '-1.4', '13.5', '321', '36.0', '-25.0', '4.8', '60', '9.0', '0.0', '1.7', '105', '18.0', '0.0', '4.4');
params['north'] = new Array('45', '9.1', '-1.4', '5.4', '818', '21.0', '-39.2', '-27.8', '14', '9.0', '1.0', '5.2', '21', '18.0', '2.0', '5.6');
params['south'] = new Array('25', '0.6', '-1.8', '-0.7', '19', '4.0', '-3.8', '-1.1', '', '', '', '', '', '', '', '');






function changeImg(regionName, isRussia) {
    try {
        pic = document.getElementById('pict');

        pic_wind = document.getElementById('pict_wind');
        pic_temp = document.getElementById('pict_temp');
        pic_tempW = document.getElementById('pict_tempW');
        pic_hw = document.getElementById('pict_hw');

        var s = '/img/seas_4/' + regionName + '_580_414.gif';
        var s_pic_wind = "/img/seas_4/params/empty.gif";
        var s_pic_temp = "/img/seas_4/params/empty.gif";
        var s_pic_tempW = "/img/seas_4/params/empty.gif";
        var s_pic_hw = "/img/seas_4/params/empty.gif";
        if (regionName != 'russia' && regionName != 'north' && regionName != 'south') {
            s_pic_wind = '/img/seas_4/params/' + regionName + '_wind_580_414.gif';
            s_pic_temp = '/img/seas_4/params/' + regionName + '_tmp_580_414.gif';
            s_pic_tempW = '/img/seas_4/params/' + regionName + '_tmpw_580_414.gif';
            s_pic_hw = '/img/seas_4/params/' + regionName + '_hw_580_414.gif';
        }

        var map = "";

        if (regionName == 'russia') {
            map = "#Russia";
        } else if(regionName == 'world') {
            map = "#Map";
        } else {
            map = "";
        }

        pic.useMap = map;
        pic_wind.useMap = map;
        pic_temp.useMap = map;
        pic_tempW.useMap = map;
        pic_hw.useMap = map;

        pic.src = s;
        pic_wind.src = s_pic_wind;
        pic_temp.src = s_pic_temp;
        pic_tempW.src = s_pic_tempW;
        pic_hw.src = s_pic_hw;

    } catch (err) {
        alert("changeImg() " + err);
    }
}

function getHeaderBlack(regionName, isRussia) {
    try {
        var regionText = regionNames[regionName];
        span = document.getElementById('header_black');
        if (span != null) {
            var str = "";
            if (regionName.length > 0) {
                if (isRussia) {
                    str += "&nbsp;&raquo; <a href=\"#\" onclick=\"getHeaderBlack('russia', false); getNumbers('russia'); setRegion('russia'); changeImg('russia', false);\" class=\"subtitle\">Моря России</a>";
                }
                str += '&nbsp;&raquo; ' + regionText;
            }
            span.innerHTML = str;
            getHeaderGrey('');
        }
    } catch (err) {
        //alert("getHeaderBlack()" + err);
    }
}

function getHeaderGrey(regionName) {
    try {
        if (document.getElementById('header_grey') != null) {
            var str = "";
            if (regionName.length > 0) {
                var regionText = regionNames[regionName];
                str = "&nbsp;<span class='subtitle_grey'>&raquo; " + regionText + "</span>";
            } else {
                str = "";
            }

            document.getElementById('header_grey').innerHTML = str;
        }
    } catch (err) {
        //alert("getHeaderGrey()" + err + regionName);
    }
}

function getNumbers(region) {
    getNumbersMain(region);
    getNumbersTopics(region);
    getParams(region);
    getCoords(region);
    setDate();
}

function getNumbersMain(region) {
    try {
        if (regionNumbers[region] != null) {
            var numbers = regionNumbers[region];
            var text = 'Центров ЕСИМО: <b><a href="http://">' + numbers[0] + ' &raquo;</a></b><br>' +
                       'Поставщиков данных: <b><a href="http://">' + numbers[1] + ' &raquo;</a></b><br>' +
                       'Приложений: <b><a href="/applications/">' + numbers[2] + ' &raquo;</a></b><br>' +
                       'Информационных ресурсов: <b><a href="/system/">' + numbers[3] + '&raquo;</a></b><br>';

            document.getElementById('numbers_text').innerHTML = text;
        }
    } catch (ex) {
        //alert("getNumbersMain() " + ex);
    }
}

function getNumbersTopics(region) {
     try {
        if (regionTopics[region] != null) {
            var topics = regionTopics[region];
            var i = 0;
            for (i = 0; i < topicNames.length; i++) {
                if (document.getElementById('topic_' + (i + 1))) {
                    if (topics[i] > 0)
                        document.getElementById('topic_' + (i + 1)).innerHTML = "<a href='/system/?action=search&selected=" + topicLinks[i + 1] + "&" + regionCoordsFull[region] + "'>" + topicNames[i + 1] + " (" + topics[i] + ")</a>";
                    else
                        document.getElementById('topic_' + (i + 1)).innerHTML = topicNames[i + 1] + " (" + topics[i] + ")";
                }
            }
        }
    } catch (ex) {
        //alert("getNumbersTopics() " + ex);
    }

}

function setRegion(regionName) {
    try {
        document.checksForm.region.value = regionName;
    } catch(err) {
        //alert("setRegion() " + err);
    }
}

function getRegion() {
    var regionName = "";
    try {
        regionName = document.checksForm.region.value;
    } catch(err) {
        //alert("getRegion() " + err);
    }
    return regionName;
}

function getOver(regionName, isRussia) {
    // меняем серый заголовок
    getHeaderGrey(regionName);

    // меняем все значения
    getNumbers(regionName);
}

function getOut(regionName, isRussia) {
    // убираем район в заголовке
    getHeaderGrey('');

    // возвращаем все значения к предыдущему состоянию по hiddenu
    getNumbers(getRegion());
}

function getClick(regionName, isRussia) {
    // выставляем регион в hidden поле формы
    setRegion(regionName);

    // меняем картинку
    changeImg(regionName, isRussia)

    // фиксируем район в заголовке
    getHeaderBlack(regionName, isRussia);

    // меняем кол-во центров и поставщиков
    // меняем кол-во ресурсов в рубрике
    // меняем значения параметров
}

function changeNumbers(regionName) {
    // меняем кол-во центров и поставщиков
    // меняем кол-во ресурсов в рубрике
    // меняем значения параметров
}

function switchVis(id) {
    try {
        var div = document.getElementById(id);
        var vis = div.style.display;
        if (vis == 'block')
            vis = 'none';
        else
            vis = 'block';
        div.style.display = vis;
    } catch (ex) {
        //alert("switchVis " + ex);
    }
}

function getParams(region) {
     try {
        if (params[region] != null) {
            var param = params[region];
            var typeArray = new Array();
            typeArray[0] = 2;
            typeArray[4] = 0;
            typeArray[8] = 1;
            typeArray[12] = 3;

            var i = 0;
            for (i = 0; i < param.length; i++) {
                if (param[i] == '')

                        document.getElementById('par_' + i).innerHTML = "н/д";

                else {

                        if (i % 4 == 0) {
                            document.getElementById('par_' + i).innerHTML = "<a href='#' onclick='showNewWindow(\"/system/datasInfo.jsp?region=" + region + "&type=" + typeArray[i] + "\", 500, 450); return false;'><b>" + param[i] + "</b></a>";
                        } else {
                            document.getElementById('par_' + i).innerHTML = param[i];
                        }
                    
                }
            }
        }
    } catch (ex) {
        //alert("getNumbersTopics() " + ex);
    }

}

function getCoords(region) {
     try {
        if (regionCoords[region] != null) {
            var coords = regionCoords[region];

            document.getElementById('coord_name').innerHTML = regionNames[region];
            document.getElementById('coord_0').innerHTML = coords[0];
            document.getElementById('coord_1').innerHTML = coords[1];
            document.getElementById('coord_2').innerHTML = coords[2];
            document.getElementById('coord_3').innerHTML = coords[3];
        }
    } catch (ex) {
        //alert("getNumbersTopics() " + ex);
    }

}
function showNewWindow(path, width, height) {
        window.open(path, null, 'scrollbars=yes,resizable=yes,menubar=no,status=yes,toolbar=no,left=250,top=100,width=' + width + ',height=' + height + '');
}

function setDate() {
    var gstDate = document.getElementById("gstDate");
    var infoDate = document.getElementById("infoDate");
    var infoDate2 = document.getElementById("infoDate2");
    if (gstDate)
        gstDate.innerHTML = execTime;
    if (infoDate)
        infoDate.innerHTML = execTime.substring(6);
    if (infoDate2)
        infoDate2.innerHTML = execTime.substring(6);

    return true;
}