function tdCounter(value){
	return '<td>'+value+'</td>';
}

function tdInput(name, id, cssClass){
	return '<td><input type="text" name="'+name+'" id="'+id+'" value="" class='+cssClass+'></td>';
}

function tdTextArea(name, id, cssClass){
	return '<td><textarea name="'+name+'" id="'+id+'" class="'+cssClass+'"></textarea></td>';
}

function tdCountries(name, id, selValue, cssClass){
	output = '<td>';
	output += getCountriesSelect(name, id, selValue, cssClass);
	output += '</td>';
	return output;
}

function getCountriesSelect(name, id, selValue, cssClass){
	output = '<select name="'+name+'" id="'+id+'" class="'+cssClass+'">';
	output += '<option value="">';
	var countries = getCountries();
	if( !$.isNumeric(selValue)) selValue = 0;
	for(i in countries ){
		selected = '';
		if(i == selValue)	selected = ' selected ';
		output += '<option value="'+i+'" '+selected+'>'+countries[i];
	}
	return output;

}

function tdCalendar(name, id){
	return '<td><input type="text" name="'+name+'" id="'+id+'" value="" size="7"></td>';
}

function tdButtonDelete(rowNmbr, type, addJSCode){
	return '<td><input type="button" '+addJSCode+' value="Удалить"></td>';
}

function jsAddonButtonDelete(type){
	return 'onclick="if(confirmDelete()){prepareDeleteTr(this, \''+type+'\')" }';
}

function jsAddonButtonDeleteAndRecount(type){
	return 'onclick="if(confirmDelete()){prepareDeleteTr(this, \''+type+'\'); setValueToUseResult() }" ';
}

function tdCoordLat(name, id){
	output = '<td>';
	output += '<input type="text" name="'+name+'[lat_grad]" id="'+id+'lat_grad" size=1 onkeyup="checkCoordinate(\''+id+'lat_grad\')" >';
	output += '&#176&nbsp;&nbsp;&nbsp;';
	output += '<input type="text" name="'+name+'[lat_min]" id="'+id+'lat_min" size=3 onkeyup="checkCoordinate(\''+id+'lat_min\')" >';
	output += '&#39 с.ш.';
	output += '</td>';
	return output;
}

function tdCoordLang(name, id){
	output = '<td>';
	output += '<input type="text" name="'+name+'[lang_grad]" id="'+id+'lang_grad" size=1 onkeyup="checkCoordinate(\''+id+'lang_grad\')" >';
	output += '&#176&nbsp;&nbsp;&nbsp;';
	output += '<input type="text" name="'+name+'[lang_min]" id="'+id+'lang_min" size=3 onkeyup="checkCoordinate(\''+id+'lang_min\')" >';
	output += '&#39';
	output += '<input type="radio" name="'+name+'[lang_type]" value="в.д." checked>в.д.';
	output += '<input type="radio" name="'+name+'[lang_type]" value="з.д.">з.д.';
	output += '</td>';
	//checkCoordinate
	return output;
}
