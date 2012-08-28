var themes = new Array();
var process = new Array();

var processNameVar = new Array();
var themeNameVar = new Array();
var selectedProcessVar = new Array();
var selectedThemeVar = new Array();

function init(id, processName, themeName, selectedProcess, selectedTheme) {
    processNameVar[id] = processName;
    themeNameVar[id] = themeName;
    selectedProcessVar[id] = selectedProcess;
    selectedThemeVar[id] = selectedTheme;
    drawTheme(id);
}

function drawTheme(id) {
    try {
        var str = "<select name=\"" + themeNameVar[id] + "\" onchange=\"setTheme('" + id + "', this.value); drawProcesses('" + id + "');\">";
        str += '<option value=""> </option>';

        for (var i = 0; i < themes.length; i++) {
            var the = themes[i];
            if (the[0] == selectedThemeVar[id])
                str += '<option value="' + the[0] + '" selected>' + the[1] + '</option>';
            else
                str += '<option value="' + the[0] + '">' + the[1] + '</option>';
        }
        str += "</select>";
     document.getElementById(themeNameVar[id]).innerHTML= str;
        drawProcesses(id);
    } catch (err) {
        alert("drawTheme()=" + err);
    }

    return true;
}

function drawProcesses(id) {
    try {

        var str = "<select name=\"" + processNameVar[id] + "\" onchange=\"setProcess('" + id + "', this.value)\">";
        str += '<option value=""> </option>';
        if (selectedThemeVar[id] && process[selectedThemeVar[id]]) {

            var proTemp = process[selectedThemeVar[id]];
            if (proTemp != null) {
                for (var i = 0; i < proTemp.length; i++) {
                    var pro = proTemp[i];
                    if (pro != null) {
                        if (pro[0] == selectedProcessVar[id])
                            str += '<option value="' + pro[0] + '" selected>' + pro[1] + '</option>';
                        else
                            str += '<option value="' + pro[0] + '">' + pro[1] + '</option>';
                    }
                }
            }
        }
        str += "</select>";
        document.getElementById(processNameVar[id]).innerHTML = str;
    } catch (err) {
        alert("drawProcesses()" + err);
    }
}

function setTheme(id, value) {
    selectedThemeVar[id] = value;
}

function setProcess(id, value) {
    selectedProcessVar[id] = value;
}