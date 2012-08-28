var countries = new Array();
var orgs = new Array();

var orgNameVar = new Array();
var countryNameVar = new Array();
var selectedOrgVar = new Array();
var selectedCountryVar = new Array();

function init(id, orgName, countryName, selectedOrg, selectedCountry) {
    orgNameVar[id] = orgName;
    countryNameVar[id] = countryName;
    selectedOrgVar[id] = selectedOrg;
    selectedCountryVar[id] = selectedCountry;
    drawCountry(id);
}

function drawCountry(id) {
    try {
        var str = "<select name=\"" + countryNameVar[id] + "\" onchange=\"setCountry('" + id + "', this.value); drawOrgs('" + id + "');\">";
        str += '<option value=""> </option>';

        for (var i = 0; i < countries.length; i++) {
            var countr = countries[i];
            if (countr[0] == selectedCountryVar[id])
                str += '<option value="' + countr[0] + '" selected>' + countr[1] + '</option>';
            else
                str += '<option value="' + countr[0] + '">' + countr[1] + '</option>';
        }
        str += "</select>";
        document.getElementById(countryNameVar[id]).innerHTML = str;
        drawOrgs(id);
    } catch (err) {
        alert("drawCountry()=" + err);
    }

    return true;
}

function drawOrgs(id) {
    try {
        var str = "<select name=\"" + orgNameVar[id] + "\" onchange=\"setOrg('" + id + "', this.value)\">";
        str += '<option value=""> </option>';
        if (selectedCountryVar[id] && orgs[selectedCountryVar[id]]) {
            var orgTemp = orgs[selectedCountryVar[id]];
            if (orgTemp != null) {
                for (var i = 0; i < orgTemp.length; i++) {
                    var org = orgTemp[i];
                    if (org != null) {
                        if (org[0] == selectedOrgVar[id])
                            str += '<option value="' + org[0] + '" selected>' + org[1] + '</option>';
                        else
                            str += '<option value="' + org[0] + '">' + org[1] + '</option>';
                    }
                }
            }
        }
        str += "</select>";
        document.getElementById(orgNameVar[id]).innerHTML = str;
    } catch (err) {
        alert("drawOrgs()" + err);
    }
}

function setCountry(id, value) {
    selectedCountryVar[id] = value;
}

function setOrg(id, value) {
    selectedOrgVar[id] = value;
}