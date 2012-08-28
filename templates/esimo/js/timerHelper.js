months = new Array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
    
minYear = new Array();
minMonth = new Array();
minDay = new Array();
maxYear = new Array();
maxMonth = new Array();
maxDay = new Array();
tempYear = new Array();
tempMonth = new Array();
tempDay = new Array();

iYearId = new Array();
iMonthId = new Array();
iDayId = new Array();


// функция для отрисовки начальной даты
function initTime(key, initDateMin, initDateMax, selectedDate, yearId, monthId, dayId) {
    try {
        //"01/03/2004", "10/01/2006"
        minYear[key] = getYear(initDateMin);
        minMonth[key] = getMonth(initDateMin);
        minDay[key] = getDay(initDateMin);
        maxYear[key] = getYear(initDateMax);
        maxMonth[key] = getMonth(initDateMax);
        maxDay[key] = getDay(initDateMax);

        iYearId[key] = yearId;
        iMonthId[key] = monthId;
        iDayId[key] = dayId;

//        if (key == 'start') {
//            tempYear[key] = minYear[key];
//            tempMonth[key] = minMonth[key];
//            tempDay[key] = minDay[key];
//        }
//        if (key == 'stop') {
//            tempYear[key] = maxYear[key];
//            tempMonth[key] = maxMonth[key];
//            tempDay[key] = maxDay[key];
//        }
        if (selectedDate != null) {
            tempYear[key] = getYear(selectedDate);
            tempMonth[key] = getMonth(selectedDate);
            tempDay[key] = getDay(selectedDate);
        } else {
            tempYear[key] = 0;
            tempMonth[key] = 0;
            tempDay[key] = 0;
        }

        drawAll(key);
    } catch(err) {
        alert("initTime()" + err);
    }
}

function drawAll(key) {
    try {
        drawYearSelect(key);
        drawMonthSelect(key);
        drawDaySelect(key);
    } catch (err) {
        alert("drawAll" + err);
    }
}

function drawYearSelect(key) {
    if (document.getElementById(iYearId[key]) != null) {
        document.getElementById(iYearId[key]).innerHTML = "<select name='" + iYearId[key] + "'  onchange=\"setYear('" + key + "'); drawMonthSelect('" + key + "'); drawDaySelect('" + key + "');\">" + drawYear(key, minYear[key], maxYear[key]) + "</select>";
    } else {
        alert("no year found");
    }
}

function drawMonthSelect(key) {
    if (document.getElementById(iMonthId[key]) != null) {
        document.getElementById(iMonthId[key]).innerHTML = "<select name='" + iMonthId[key] + "'  onchange=\"setMonth('" + key + "'); drawDaySelect('" + key + "');\">" + drawMonth(key) + "</select>";
    } else {
        alert("no month found");
    }
}

function drawDaySelect(key) {
    if (document.getElementById(iDayId[key]) != null) {
        document.getElementById(iDayId[key]).innerHTML = "<select name='" + iDayId[key] + "'>" + drawDay(key) + "</select>";
    } else {
        alert("no day found");
    }
}

// выбираем год из строки dd/mm/yyyy
function getYear(date) {
    var result = '2000';
    try {
        if (date != null && date.length == 10) {
            result = date.substring(6, 10);
        } else {
            alert('Необходимо верно указать дату. Год.');
        }
    } catch (err) {
        alert("getYear() " + err);
    }
    return result;
}

// выбираем год из строки dd/mm/yyyy
function getMonth(date) {
    var result = '1';
    try {
        if (date != null && date.length == 10) {
            result = date.substring(3, 5);

            if (result > 12)
                result = '12';
            if (result < 1)
                result = '1';
        } else {
            alert('Необходимо верно указать дату. Месяц.');
        }
    } catch (err) {
        alert("getMonth() " + err);
    }
    return result;
}

// выбираем год из строки dd/mm/yyyy
function getDay(date) {
    var result = '01';
    try {
        var year = getYear(date);
        var month = getMonth(date);
        var maxValue = getMaxDay(year, month);
        if (date != null && date.length == 10) {
            result = date.substring(0, 2);

            if (result > maxValue)
                result = maxValue;
            if (result < 1)
                result = '1';
        } else {
            alert('Необходимо верно указать дату. День.');
        }
    } catch (err) {
        alert("getDay()" + err);
    }
    return result;
}

// выбираем год из строки dd/mm/yyyy
function getMaxDay(year, month) {
    var result = '31';
    try {
        result = maxValue = (month == 2 && year % 4 == 0) ? 29 : months[(month - 1)];
    } catch (err) {
        alert("getMaxDay() " + err);
    }
    return result;
}

function drawYear(key, minYear, maxYear) {
    var result = "";
    result += "<option value=''>&nbsp;&nbsp;&nbsp;&nbsp;</option>";
    try {
        for (var i = minYear; i <= maxYear; i++) {
            if (i == tempYear[key])
                result += "<option value='" + i + "' selected>" + i + "</option>";
            else
                result += "<option value='" + i + "'>" + i + "</option>";
        }
    } catch (err) {
        alert("drawYear() " + err);
    }

    return result;
}

function drawMonth(key) {
    var result = "";
    var show = "";
    var start = 1;
    var stop = 12;
    var min = minYear[key] + '' + minMonth[key];
    var max = maxYear[key] + '' + maxMonth[key];
    try {
        result += "<option value=''>&nbsp;&nbsp;&nbsp;&nbsp;</option>";
        for (var i = start; i <= stop; i++) {
            show = "" + i + "";
            if (show.length < 2)
                show = "0" + show;

            var temp = tempYear[key] + '' + show;
            if (temp >= min && temp <= max) {
                if (i == tempMonth[key])
                    result += "<option value='" + show + "' selected>" + show + "</option>";
                else
                    result += "<option value='" + show + "'>" + show + "</option>";
            }
        }
    } catch (err) {
        alert("drawMonth() " + err);
    }
    return result;
}

function drawDay(key) {
    var result = "";
    var show = "";

    var start = 1;
    var stop = getMaxDay(tempYear[key], tempMonth[key]);
    var min = minYear[key] + "" + minMonth[key] + "" + minDay[key];
    var max = maxYear[key] + "" + maxMonth[key] + "" + maxDay[key];

    try {
        result += "<option value=''>&nbsp;&nbsp;&nbsp;&nbsp;</option>";
        for (var i = start; i <= stop; i++) {
            show = "" + i + "";
            if (show.length < 2)
                show = "0" + show;

            var temp = tempYear[key] + "" + tempMonth[key] + "" + show;
            if (temp >= min && temp <= max) {
                if (i == tempDay[key])
                    result += "<option value='" + show + "' selected>" + show + "</option>";
                else
                    result += "<option value='" + show + "'>" + show + "</option>";
            }
        }

    } catch (err) {
        alert("drawDay() " + err);
    }

    return result;
}

function setYear(key, year) {
    try {
        var yearVal = 0;
        if (!year && key == 'start') {
            yearVal = document.resourceSearch.bYear.value;
        }
        if (!year && key == 'stop') {
            yearVal = document.resourceSearch.eYear.value;
        }
        if (year) {
            yearVal = year;
        }

        if (key == 'start') {
            tempYear[key] = yearVal;
            tempMonth[key] = document.resourceSearch.bMonth.value;
        }
        if (key == 'stop') {
            tempYear[key] = yearVal;
            tempMonth[key] = document.resourceSearch.eMonth.value;
        }
        if (tempYear[key] == maxYear[key] && tempMonth[key] > maxMonth[key]) {
            tempMonth[key] = maxMonth[key];
            tempDay[key] = maxDay[key];
        }
        else if (tempYear[key] == minYear[key] && tempMonth[key] < minMonth[key]) {
            tempMonth[key] = minMonth[key];
            tempDay[key] = minDay[key];
        }
        else {
            tempMonth[key] = '01';
            tempDay[key] = '01';
        }
    } catch (err) {
        alert("setYear() " + err);
    }

}

function setMonth(key, month) {
    try {
        if (month) {
            tempMonth[key] = month;
        } else {
            if (key == 'start') {
                tempMonth[key] = document.resourceSearch.bMonth.value;
            }
        if (key == 'stop') {
                tempMonth[key] = document.resourceSearch.eMonth.value;
            }
        }
    } catch (err) {
        alert("setMonth() " + err);
    }
}

function setDay(key, day) {
    try {
        tempDay[key] = day;
    } catch (err) {
        alert("setDay() " + err);
    }
}

function setDate(date) {
    var key = 'stop';

    setYear(key, getYear(date));
    setMonth(key, getMonth(date));
    setDay(key, getDay(date));

    drawYearSelect(key);
    drawMonthSelect(key);
    drawDaySelect(key);
}

function setDateMinusToday(date, lastDate) {
    var keyStart = 'start';
    var keyStop = 'stop';

    setYear(keyStart, getYear(date));
    setMonth(keyStart, getMonth(date));
    setDay(keyStart, getDay(date));

    drawYearSelect(keyStart);
    drawMonthSelect(keyStart);
    drawDaySelect(keyStart);

    setYear(keyStop, getYear(lastDate));
    setMonth(keyStop, getMonth(lastDate));
    setDay(keyStop, getDay(lastDate));

    drawYearSelect(keyStop);
    drawMonthSelect(keyStop);
    drawDaySelect(keyStop);
}

function debug(text) {
    //    var result = "minStartYear=" + minStartYear + "<br>"
    //    result += "minStartMonth=" + minStartMonth + "<br>"
    //    result += "minStartDay=" + minStartDay + "<br>"
    //    result += "maxStartYear=" + maxStartYear + "<br>"
    //    result += "maxStartMonth=" + maxStartMonth + "<br>"
    //    result += "maxStartDay=" + maxStartDay + "<br>"
    //    result += "tempStartYear=" + tempStartYear + "<br>"
    //    result += "tempStartMonth=" + tempStartMonth + "<br>"
    //    result += "tempStartDay=" + tempStartDay + "<br>"
    //    result += text;
    //    document.getElementById("debug").innerHTML = result;
}
