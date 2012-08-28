function create_window(e,w,h,url)
{
	var padding = 20;
	var l = e.clientX + padding;
	var t = e.clientY + padding;
	var r = l + w;
	var b = t + h;

	oCanvas = document.getElementsByTagName((document.compatMode && document.compatMode == "CSS1Compat") ? "HTML" : "BODY")[0];

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

	return window.open(url,'faq','left='+l+',top='+t+',width='+w+',height='+h+',toolbar=no,statusbar=no,scrollbars=yes');
}


// попап окно с текстом пояснения вопроса 
function open_help(question, help, e, w,h)
{
  var wW = w | 250;
  var wH = h | 200;
	var whelp = create_window(e,wW,wH,'');
	whelp.document.writeln('\
		<html>\
			<head>\
				<title>Пояснение</title>\
				<link rel="Stylesheet" href="/css/main.css">\
			</head>\
			<body style="font-size:75%; margin:10px;" bgcolor="#FFFFFF">\
				<a href="javascript:window.close();"><img src="/img/close.bmp" width="13" height="13" alt="Закрыть" border="0" align="right"></a>\
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
