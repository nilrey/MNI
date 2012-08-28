// Each string in array == "id","image_file"
var pictParams = new Array(
        "login_over", "/templates/esimo/images/login_btn_02.gif",
        "login_out", "/templates/esimo/images/login_btn_01.gif",
        "search_01_over", "/templates/esimo/images/search_btn_02.gif",
        "search_01_out", "/templates/esimo/images/search_btn_01.gif",
        "search_02_over", "/templates/esimo/images/search_btn_04.gif",
        "search_02_out", "/templates/esimo/images/search_btn_03.gif",
         "search_03_over", "/templates/esimo/images/search_btn_05.gif",
        "search_03_out", "/templates/esimo/images/search_btn_06.gif"
        );

function PreloadImg(params) {
    /* Формирует массив картинок pictArr для анимации меню */
    try {
        var doc = document;
        if ((doc.images) && (params)) {
            if (!doc.pictArr) doc.pictArr = new Array();
            for (var i = 0; i < (params.length - 1); i += 2) {
                doc.pictArr[params[i]] = new Image;
                doc.pictArr[params[i]].src = params[i + 1];
            }
        }
    } catch (err) {
        //alert("PreloadImg() err");
    }
}

function ChangeImg(obj, id) {
    try {
        /* Заменяет картинку в изображении obj на картинку изображения id */
        var doc = document;
        if (!doc.pictArr) doc.pictArr = new Array();
        if ((doc.images[obj]) && (doc.pictArr[id])) {
            doc.images[obj].src = doc.pictArr[id].src;
        }
    } catch (err) {
        //alert("ChangeImg() err");
    }
}

function treeExpand(oObj, trname) {
    var tr = document.getElementById(trname);
    var d;
    if (tr.style.display == '') {
        d = 'none';
    } else {
        d = '';
    }
    tr.style.display = d;
    return true;
}

function treeExpandImg(oObj, trname) {
    var tr = document.getElementById(trname);
    var d, s;
    var img = document.getElementById('img_' + trname);
    if (tr.style.display == '') {
        d = 'none';
        s = '/templates/esimo/images/submenu_ico_plus.gif';
    } else {
        d = '';
        s = '/templates/esimo/images/submenu_ico_minus.gif';
    }
    tr.style.display = d;
    img.src = s;
    return true;
}


function create_window(e, w, h, url)
{
    var padding = 20;
    var l = e.clientX + padding;
    var t = e.clientY + padding;
    var r = l + w;
    var b = t + h;

    var oCanvas = document.getElementsByTagName((document.compatMode && document.compatMode == "CSS1Compat") ? "HTML" : "BODY")[0];

    var w_width = (window.innerWidth ? window.innerWidth + window.pageXOffset : oCanvas.clientWidth + oCanvas.scrollLeft) - padding * 2;
    var w_height = (window.innerHeight ? window.innerHeight + window.pageYOffset : oCanvas.clientHeight + oCanvas.scrollTop) - padding * 2;

    var margin_right = w_width - r;
    if (margin_right < 0) {
        l += margin_right - padding;
    }
    var margin_bottom = w_height - b;
    if (margin_bottom < 0) {
        t += margin_bottom;
    }

    return window.open(url, 'faq', 'left=' + l + ',top=' + t + ',width=' + w + ',height=' + h + ',toolbar=no,statusbar=no,scrollbars=yes');
}


// попап окно с текстом пояснения вопроса
function open_help(question, help, e, w, h)
{
    var wW = w | 250;
    var wH = h | 200;
    var whelp = create_window(e, wW, wH, '');
    whelp.document.writeln('\
		<html>\
			<head>\
				<title>Пояснение</title>\
				<link rel="Stylesheet" href="/css/main.css">\
			</head>\
			<body style="font-size:75%; margin:10px;" bgcolor="#FFFFFF">\
				<a href="javascript:window.close();"><img src="/templates/esimo/images/close.bmp" width="13" height="13" alt="Закрыть" border="0" align="right"></a>\
				<p>\
					<b>\
						' + question + '\
					</b>\
				</p>\
				<p>\
					' + help + '\
				</p>\
				<form>\
					<input type="button" value="Закрыть" onclick="window.close();">\
				</form>\
			</body>\
		</html>\
	');
    whelp.focus();
    return whelp;
}

var startday = new Date();
var clockStart = startday.getTime();
function initStopwatch() {
    var myTime = new Date();
    return((myTime.getTime() - clockStart) / 1000);
}
function getSecs() {
    var tSecs = Math.round(initStopwatch());
    var iSecs = tSecs % 60;
    var iMins = Math.round((tSecs - 30) / 60);
    if (iMins >= 60) iMins = iMins % 60;
    var iHours = Math.round((tSecs - 1800) / 3600);
    var sSecs = "" + ((iSecs > 9) ? iSecs : "0" + iSecs);
    var sMins = "" + ((iMins > 9) ? iMins : "0" + iMins);
    var sHours = "" + ((iHours > 9) ? iHours : "0" + iHours);
    if (tSecs > 720 && tSecs % 10 > 4)
        document.getElementById('seconds').innerHTML = "<font style='color: #B90000'>" + sHours + ":" + sMins + "." + sSecs + "</font>";
    else
        document.getElementById('seconds').innerHTML = sHours + ":" + sMins + "." + sSecs;

    window.setTimeout('getSecs()', 5000);
}

function MakeArray(n) {
    this.length = n;
    return this;
}

var monthNames = new MakeArray(12);
monthNames[1] = "ЯНВАРЯ";
monthNames[2] = "ФЕВРАЛЯ";
monthNames[3] = "МАРТА";
monthNames[4] = "АПРЕЛЯ";
monthNames[5] = "МАЯ";
monthNames[6] = "ИЮНЯ";
monthNames[7] = "ИЮЛЯ";
monthNames[8] = "АВГУСТА";
monthNames[9] = "СЕНТЯБРЯ";
monthNames[10] = "ОКТЯБРЯ";
monthNames[11] = "НОЯБРЯ";
monthNames[12] = "ДЕКАБРЯ";
var dayNames = new MakeArray(7);
dayNames[1] = "ВОСКРЕСЕНЬЕ";
dayNames[2] = "ПОНЕДЕЛЬНИК";
dayNames[3] = "ВТОРНИК";
dayNames[4] = "СРЕДА";
dayNames[5] = "ЧЕТВЕРГ";
dayNames[6] = "ПЯТНИЦА";
dayNames[7] = "СУББОТА";

function customDateString() {
    var currentDate = new Date();
    var theDay = dayNames[currentDate.getDay() + 1];
    var theMonth = monthNames[currentDate.getMonth() + 1];

    return "<SPAN class='date_03'>" + currentDate.getDate() + "</SPAN> " + theMonth + ", " + theDay;
    //return "Сегодня " + theDay + ", " + currentDate.getDate() + "&nbsp;" + theMonth;
}

function doDelete() {
    var txt = 'Вы уверены, что хотите удалить эту запись?';
    return confirm(txt);
}

function submit_button() {
    var frm = document.subDisable;
    if (frm)
        frm.submit.disabled = 1;
}

function collapseTopMenu() {
    var d;
    var text = document.getElementById('collapseString');
    var tr = document.getElementById('logoImage');
    var nav = document.getElementById('navLine');
    var searchTable = document.getElementById('searchTable');
    var topMenu = document.getElementById('topMenuTable');
    var blueImg = document.getElementById('blueImg');

    if (tr != null) {
        if (tr.style.display == '') {
            text.innerHTML = '<img src="/templates/esimo/images/arrowDown.gif" width="7" height="4" alt="Нажмите, чтобы свернуть/развернуть логотип" border="0">&nbsp;&nbsp;раскрыть';
            d = 'none';
        } else {
            text.innerHTML = '<img src="/templates/esimo/images/arrowUp.gif" width="7" height="4" alt="Нажмите, чтобы свернуть/развернуть логотип" border="0">&nbsp;&nbsp;свернуть';
            d = '';
        }
        tr.style.display = d;
    }
    if (nav != null)
        nav.style.display = d;
    if (searchTable != null)
        searchTable.style.display = d;
    if (topMenu != null)
        topMenu.style.display = d;

    if (blueImg != null) {
        if (d == '')
            blueImg.style.height = '7';
        else
            blueImg.style.height = '1';
    }

    return true;
}

function setCookieAll() {
    var display = getCookie('displayTopMenu');
    if (display && display == 'none') {
        setCookie('displayTopMenu', '', false, '/');
    } else {
        setCookie('displayTopMenu', 'none', false, '/');
    }
}

function checkCookie() {
    var display = getCookie('displayTopMenu');
    //alert(display);
    if (display != null) {
        if (display == 'none')
            collapseTopMenu();
    }
}

function setCookie(name, value, expires, path, domain, secure) {
  var curCookie = name + "=" + escape(value) +
      ((expires) ? "; expires=" + expires.toGMTString() : "") +
      ((path) ? "; path=" + path : "") +
      ((domain) ? "; domain=" + domain : "") +
      ((secure) ? "; secure" : "");
  document.cookie = curCookie;
}

function getCookie(name) {
  var dc = document.cookie;
  var prefix = name + "=";
  var begin = dc.indexOf("; " + prefix);
  if (begin == -1) {
    begin = dc.indexOf(prefix);
    if (begin != 0) return null;
  } else {
    begin += 2;
  }
  var end = document.cookie.indexOf(";", begin);
  if (end == -1)
    end = dc.length;
  return unescape(dc.substring(begin + prefix.length, end));
}


function deleteCookie(name, path, domain) {
  if (getCookie(name)) {
    document.cookie = name + "=" +
    ((path) ? "; path=" + path : "") +
    ((domain) ? "; domain=" + domain : "") +
    "; expires=Thu, 01-Jan-70 00:00:01 GMT";
  }
}



function checkBDT() {
    if (document.resourceSearch != null && document.resourceSearch.startTime != null) {
        if (document.resourceSearch.startTime.checked == false) {
            document.resourceSearch.bday.disabled = true;
            document.resourceSearch.bmonth.disabled = true;
            document.resourceSearch.byear.disabled = true;
        }
        if (document.resourceSearch.startTime.checked == true) {
            document.resourceSearch.bday.disabled = false;
            document.resourceSearch.bmonth.disabled = false;
            document.resourceSearch.byear.disabled = false;
        }
    }
}

function checkEDT() {
    if (document.resourceSearch != null && document.resourceSearch.endTime != null) {
        if (document.resourceSearch.endTime.checked == false) {
            document.resourceSearch.eday.disabled = true;
            document.resourceSearch.emonth.disabled = true;
            document.resourceSearch.eyear.disabled = true;
        }
        if (document.resourceSearch.endTime.checked == true) {
            document.resourceSearch.eday.disabled = false;
            document.resourceSearch.emonth.disabled = false;
            document.resourceSearch.eyear.disabled = false;
        }
    }
}

function hideAndSeek(id, isInvert) {
    var obj = document.getElementById(id);
    if (obj) {
        if (!isInvert) {
            if (obj.style.display == 'none') {
                obj.style.display = '';
            } else {
                obj.style.display = 'none';
            }
        } else {
             if (obj.style.display == '') {
                obj.style.display = 'none';
            } else {
                obj.style.display = '';
            }
        }
    }

    return true;
}

function hide(id) {
    var obj = document.getElementById(id);
    if (obj) {
        obj.style.display = 'none';
    }

    return true;
}

function show(id) {
    var obj = document.getElementById(id);
    if (obj) {
        obj.style.display = '';
    }

    return true;
}

function switchImg(id, compare) {
     var obj = document.getElementById(id);
     var compareObj = document.getElementById(compare);
     if (obj && compareObj) {
         if (compareObj.style.display == 'none') {
             obj.src = '/templates/esimo/images/submenu_ico_plus.gif';
        } else {
             obj.src = '/templates/esimo/images/submenu_ico_minus.gif'
        }
     }

    return true;
}

function setCookieMap() {
    var display = getCookie('displayMapSearch');
    if (display && display == 'none') {
        setCookie('displayMapSearch', 'yes', false, '/');
    } else {
        setCookie('displayMapSearch', 'none', false, '/');
    }
}

function checkCookieMap() {
    var display = getCookie('displayMapSearch');
    //alert("display=" + display);
    if (display != null) {
        if (display == 'none') {
            hideMap();
        } else {
            showMap();
        }
    }
    switchImg('searchImg', 'table_map');
}

function collapseMap() {
    hideAndSeek('table_map', false);
    hideAndSeek('table_mapset', false);
    hideAndSeek('table_search', false);
    hideAndSeek('search_query', false);
    hideAndSeek('search_results', true);
}

function hideMap() {
    hide('table_map');
    hide('table_mapset');
    hide('table_search');
    hide('search_query');
    show('search_results');
}

function showMap() {
    show('table_map');
    show('table_mapset');
    show('table_search');
    show('search_query');
    hide('search_results');
}

// TABULATION

(function($) {
$(function() {

  $('div.tabs').each(function() {
    $(this).find('span').each(function(i) {
      $(this).click(function(index){
      	$('#atab').val(i);
        $(this).addClass('current').siblings().removeClass('current').parents('div.section').find('div.box').hide().end().find('div.box:eq('+i+')').fadeIn(150);
      });
    });
  });

})
})(jQuery)

function setCurrentTab(i){
	$('div.tabs > span ').each(
		function(){
			$(this).removeClass('current');
		}
	);
	$('div.box').each(
		function(){
			$(this).hide();
		}
	);
	
	$('div.tabs > span:eq('+i+') ').addClass('current') ;
	$('div.box:eq('+i+') ').fadeIn(150) ;
	$('#atab').val(i);
}