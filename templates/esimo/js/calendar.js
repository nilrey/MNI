c_m = 9;
c_y = 1999;
c_d = 0;
URL = 'system/instance/date.jsp';
ld = new Date();
real_d = ld.getDate();
real_m = ld.getMonth() + 1;
real_y = ld.getYear();
if (real_y > 100 && real_y < 1900) real_y += 1900;
r_ts = real_d + real_m * 100 + real_y * 10000;
c_m = real_m;
c_y = real_y;
stripe_code = '/' + URL + '?';
qs = '<!--#echo var="QUERY_STRING"-->';
qs_a = qs.split('&amp;');
for (i = 0; i < qs_a.length; i++) {
    qs_ap = qs_a[i].split('=');
    if (qs_ap[0] == 'xmlv_d1__publish_time') c_d = qs_ap[1] - 0;
    if (qs_ap[0] == 'xmlv_m1__publish_time') c_m = qs_ap[1] - 0;
    if (qs_ap[0] == 'xmlv_y1__publish_time') c_y = qs_ap[1] - 0;
}
qs = location.href;
if ((s_p = qs.indexOf(stripe_code)) != -1) {
    s_p += stripe_code.length + 5;
    c_d = qs.substr(s_p, 2) - 0;
    c_m = qs.substr(s_p + 3, 2) - 0;
    c_y = qs.substr(s_p + 6, 4) - 0;
}
cr_ts = c_d ? c_d + c_m * 100 + c_y * 10000 : 0;
mnames_ru = new Array("Январь", "Февраль", "Март", "Апрель", "Май", "Июнь", "Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь");
dnames_ru = new Array("пн", "вт", "ср", "чт", "пт", "сб", "вс");

mnames_en = new Array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
dnames_en = new Array("mon", "tue", "wed", "thu", "fri", "sat", "sun");

mdays = new Array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
header_s = '<table width=100% cellspacing=1 cellpadding=1 border=0 style="background-color: #ACCADB;" class="main_content">' +
           '<tr><td colspan=4>' +
           '<select onchange="reforma(-1, this.value)">::m_options::</select></td>';

table_e = '</table>';
r_s = '<tr align=center>';
r_e = '</tr>';
function write_layer(layer_name, what) {
    if (document.all) {
        document.all[layer_name].innerHTML = what;
    } else {
        var xx = document.getElementById(layer_name);
        xx.innerHTML = what;
    }
}
function fd(nd) {
    return (nd < 10 ? '0' : '') + nd;
}
function redo_calendar(lang, page) {
    if (!page) page = getURL();
    if (lang == "ru") {
        mnames = mnames_ru;
        dnames = dnames_ru;
    }
    if (lang == "en") {
        mnames = mnames_en;
        dnames = dnames_en;
    }
    stripe_code = '/' + page + '?';
    setURL(page);
    header_e = ' <td align=right colspan=3><select onchange="reforma(this.value, -1)">::y_options::</select>' + '</td></tr>' + '<tr align=center>';
    for (k = 0; k < 7; k++) {
        header_e += '<td>' + dnames[k] + '</td>';
    }
    header_e += '</tr>';
    s = '';
    m_options = '';
    for (i = 0; i < mnames.length; i++) m_options += "<option value=" + (i + 1) + (i == (c_m - 1) ? " selected" : "") + ">" + mnames[i] + "</options>\n";
    y_options = '';
    for (i = 2001; i < 2010; i++) y_options += "<option value=" + i + (i == c_y ? " selected" : "") + ">" + i + "</options>\n";
    s += header_s.replace("::m_options::", m_options);
    s += header_e.replace("::y_options::", y_options);
    s_delta = 3;
    ld = new Date();
    ld.setDate(1);
    ld.setMonth(c_m - 1);
    ld.setYear(c_y)
    cs = -ld.getDay() + 2;
    if (cs > 1) cs -= 7;
    td = mdays[c_m - 1] + ((c_y % 4) || (c_m != 2) ? 0 : 1);
    al = new Array();
    for (i = cs; i <= td; i += 7) {
        s += r_s;
        for (j = i; j < i + 7; j++) {
            future = 0;
            c_ts = j + c_m * 100 + c_y * 10000;
            if (c_ts > r_ts) future = 1;
            if (c_ts < r_ts) future = -1;
            got_link = c_ts < 20010101 ? 0 : 1;
            if (j < 1 || j > td) {
                s += "<td class='cal_date'><br></td>";
            } else {
                if (future < 1) {
                    mycal_d = j;
                    mycal_m = c_m;
                    mycal_y = c_y;
                    if (got_link) {
                        zee_data = "<a href='" + stripe_code + "date=" + fd(j) + '-' + fd(c_m) + '-' + c_y + "' id=db>" + j + "</a>";
                    } else {
                        zee_data = j;
                    }
                } else {
                    zee_data = j;
                }
                s += "<td class=" + (future ? (cr_ts == c_ts ? "selectedDay" : "otherDay") : "currentDay") + ">" + zee_data + "</td>";
            }
        }
        s += r_e;
    }
    s += table_e;
    write_layer("writehere", s);
}
function move_month(arg) {
    c_m += arg;
    if (c_m > 12) {
        c_m = 1;
        c_y++;
    }
    if (c_m < 1) {
        c_m = 12;
        c_y--;
    }
    redo_calendar();
}
function reforma(ny, nm) {
    if (ny != -1) c_y = ny;
    if (nm != -1) c_m = nm;
    redo_calendar();
}
function setURL(page) {
    URL = page;
}
function getURL() {
    return URL;
}
