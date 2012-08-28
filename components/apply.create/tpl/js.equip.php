<script>
counterEquipBlock = <?=count($arResult['EQUIP'])?>;
counterEquipCoords = <?=count($arResult['COORDS']['equip'])?>;

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

function tdButtonDelete(rowNmbr, type){
	return '<td><input type="button" onclick=" if(confirmDelete()) prepareDeleteTr(this, \''+type+'\')" value="Удалить"></td>';
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

function prepareDeleteTr(elem, type){
	 deleteEquipTr(  $(elem).closest('table'), $(elem).closest('tr').attr('id'), type);
}

function deleteEquipTr(tbl, rowId, type){
	$(tbl).find('#'+rowId).remove();
	orderTable(tbl, type);
}

function deleteEquipTrComplete(nmbr, type, id, elem){
	$.post("http://"+server_host+"/ajax.php", { type: type, elementId: id, action: "deleteCoord" }, function() {}, "json");
	deleteEquipTr(  $(elem).closest('table'), $(elem).closest('tr').attr('id'), type);
}

function orderTable(obTable, type){
	for( i=1; i< obTable.find('tr').length; i++){
		obTable.find('tr:eq('+i+') td:first').text(i);
		obTable.find('tr:eq('+i+') #'+type+'_num').val(i);
	}
}

function addCoordsEquipTr(cnt){
	var tblLength = $('#blockEquip'+cnt+' #tableequip > tbody tr').length;
	type = 'equip';
		if	( tblLength === 1 ||
		//$('#blockEquip'+cnt+' #tableequip tbody tr:eq('+(tblLength-1)+') td:eq(1)').find('[id *=usage_place]').val().length > 0
			( $('#table'+type+' > tbody tr:eq('+(tblLength-1)+') td:eq(2)').find('[id *=lat_grad]').val().length > 0
			&& $('#table'+type+' > tbody tr:eq('+(tblLength-1)+') td:eq(3)').find('[id *=lang_grad]').val().length > 0
			)
		){
			counterEquipCoords++;
			composeName = 'COORDS['+type+']['+counterEquipCoords+']';
			composeId = type+counterEquipCoords;

			var newRow = '<tr id="trEq'+counterEquipCoords+'">';
			newRow += '<input type="hidden" name="'+composeName+'[block]" id="'+composeId+'_block" value="'+cnt+'">';
			newRow += '<input type="hidden" name="'+composeName+'[num]" id="'+type+'_num" value="">';
			newRow += tdCounter(counterEquipCoords);
			newRow += tdInput(composeName+'[info]', composeId+'usage_place', 'input100');
			newRow += tdCoordLat(composeName, composeId);
			newRow += tdCoordLang(composeName, composeId);
			newRow += tdCalendar(composeName+'[equip_install]', composeId+'equip_install')
			newRow += tdCalendar(composeName+'[equip_deinstall]', composeId+'equip_deinstall')
			newRow += tdTextArea(composeName+'[time_usage]', composeId+'time_usage', 'textarea185');
			newRow += tdButtonDelete(counterEquipCoords, type);

			newRow += '</tr>';

			$('#blockEquip'+cnt+' #tableequip > tbody').append(newRow);


			resortCoordsBlockIds();
			orderTable($('#blockEquip'+cnt+' #tableequip'), type);

			$('#'+composeId+'equip_install').datepick({ minDate: cMinDate, maxDate: cMaxDate, showTrigger: '#calImg'});
			$('#'+composeId+'equip_deinstall').datepick({ minDate: cMinDate, maxDate: cMaxDate, showTrigger: '#calImg'});
			setTextareaResizeNew(composeId+'time_usage', 185, txtHeight, txtWidth, newHeight);

		}else{
			alert('Последняя строка заполнена не полностью!');
		}
}

function checkCoordinate(elementId){
	if(elementId.length > 0){
		$('#'+elementId).val($('#'+elementId).val().replace(',', '.') );
		$('#'+elementId).val($('#'+elementId).val().replace(' ', '') );
		last = $('#'+elementId).val().charAt($('#'+elementId).val().length-1);
		if( !( $.isNumeric(last) || last == '.') ){
			$('#'+elementId).val($('#'+elementId).val().substring(0, $('#'+elementId).val().length-1) )
		}
	}
}

function resortCoordsBlockIds(){
	$('div[id^=blockEquip]').each(
	function(index, item){
			$(this).find('table[id^=tableequip]').each(
				function(){
					$(this).find('input[id$=_block]').each(function(){
						$(this).val(index)
					}
					);
				}
			);
		}
	);
}

function deleteEquipBlock(nmbr, type){
	$('#blockEquip'+nmbr).remove();
	resortCoordsBlockIds();
}
function deleteEquipBlockComplete(nmbr, tableType, id){
//	alert(nmbr +' ' + tableType + ' ' + id);
	$.post("http://"+server_host+"/ajax.php", { elementId: id, action: "deleteEquip" }, function() {}, "json");
//	$('#blockEquip'+nmbr).remove();
	deleteEquipBlock(nmbr, tableType);
}
//

function addEquipBlock(type){
	type = 'equip';
	counterEquipBlock++;
	composeName = 'EQUIP['+counterEquipBlock+']';
	composeId = type+counterEquipBlock;
	var newBlock = '<div id="blockEquip'+counterEquipBlock+'">';
	newBlock += '<div class="border2px">';
	newBlock += '<input type="hidden" name="EQUIP['+counterEquipBlock+'][eid]" value="0">';
	newBlock += '<table border="0" cellspacing="0" cellpadding="0" class="tab">';
	newBlock += '<tr class="trHighLighted">';
	newBlock += '<td width="30%">а) <a name=\'#anc_equip_coord'+counterEquipBlock+'\'></a><span id=\'req_equip_coord'+counterEquipBlock+'\'>основные характеристики&nbsp;<span class=\'reqFieldMark\'>*</span></span>&nbsp;:</td>';
	newBlock += tdTextArea('EQUIP['+counterEquipBlock+'][basic]', 'equip_basic'+counterEquipBlock, 'textarea500');
	newBlock += '</tr>';
	newBlock += '<tr class="trHighLighted">';
	newBlock += '<td width="30%">б) характер получаемой информации и способ ее передачи:</td>';
	newBlock += tdTextArea('EQUIP['+counterEquipBlock+'][infotype]', 'equip_infotype'+counterEquipBlock, 'textarea500');
	newBlock += '</tr>';
	newBlock += '<tr>';
	newBlock += '<td colspan="2"><p>в) географические координаты (в градусах, минутах и долях минут) района использования (места постановки):</p>';

	newBlock += '<table id="tableequip" class="tab">';
	newBlock += '<tbody>';
	newBlock += '<tr>';
	newBlock += '<td class="head">№ точки</td>';
	newBlock += '<td class="head">Район<br />использования</td>';
	newBlock += '<td class="head">Географическая<br />широта<br />(в градусах,<br />минутах и<br />долях<br />минут)</td>';
	newBlock += '<td class="head">Географическая<br />долгота<br />(в градусах, минутах и<br />долях<br />минут)</td>';
	newBlock += '<td class="head">Дата<br />постановки</td>';
	newBlock += '<td class="head">Дата<br />демонтажа</td>';
	newBlock += '<td class="head">Время<br />действия</td>';
	newBlock += '<td class="head">&nbsp</td>';
	newBlock += '</tr>';
	newBlock += '</tbody>';
	newBlock += '</table>';
	newBlock += '<input type="button" onclick="addCoordsEquipTr('+counterEquipBlock+')" value="Добавить запись">';

	newBlock += '</td>';
	newBlock += '</tr>';
	newBlock += '<tr><td colspan="2"><p>д) официальное наименование и юридический адрес владельца:</p></td></tr>';
	newBlock += '<tr class="trHighLighted">';
	newBlock += '<td>Наименование организации:</td>';
	newBlock += tdTextArea(composeName+'[equipowner]', 'equipowner'+counterEquipBlock, 'textarea500');
	newBlock += '</tr>';
	newBlock += '<tr class="trHighLighted">';
	newBlock += '<td>Страна:</td>';
	newBlock += tdCountries(composeName+'[equipowner_country]', 'equipowner_country'+counterEquipBlock, '', 'input185');
	newBlock += '</tr>';
	newBlock += '<tr class="trHighLighted">';
	newBlock += '<td>Город:</td>';
	newBlock += tdInput(composeName+'[equipowner_city]', 'equipowner_city'+counterEquipBlock, 'input185');
	newBlock += '</tr>';
	newBlock += '<td>Юр. адрес организации:</td>';
	newBlock += tdTextArea(composeName+'[equipowner_legaladdress]', 'equipowner_legaladdress'+counterEquipBlock, 'textarea500');
	newBlock += '</tr>';
	newBlock += '<tr class="trHighLighted">';
	newBlock += '<td>Телефон:</td>';
	newBlock += tdInput(composeName+'[equipowner_phone]', 'equipowner_phone'+counterEquipBlock, 'input185');
	newBlock += '</tr>';
	newBlock += '<tr class="trHighLighted">';
	newBlock += '<td>Факс:</td>';
	newBlock += tdInput(composeName+'[equipowner_fax]', 'equipowner_fax'+counterEquipBlock, 'input185');
	newBlock += '</tr>';
	newBlock += '<tr class="trHighLighted">';
	newBlock += '<td>E-mail:</td>';
	newBlock += tdInput(composeName+'[equipowner_email]', 'equipowner_email'+counterEquipBlock, 'input185');
	newBlock += '</tr>';
	newBlock += '</table>';
	newBlock += '</div>';
	newBlock += '<input type="button" onclick=" if(confirmDeleteRecord()) deleteEquipBlock('+counterEquipBlock+', \'equip\')" value="Удалить оборудование">';
	newBlock += '<br /><br />';
	newBlock += '</div>';
	$('#equipmentArea').append(newBlock);

	setTextareaResizeNew('equip_basic'+counterEquipBlock, txtWidth, txtHeight, txtWidth, newHeight);
	setTextareaResizeNew('equip_infotype'+counterEquipBlock, txtWidth, txtHeight, txtWidth, newHeight);
	setTextareaResizeNew('equipowner'+counterEquipBlock, txtWidth, txtHeight, txtWidth, newHeight);
	setTextareaResizeNew('equipowner_legaladdress'+counterEquipBlock, txtWidth, txtHeight, txtWidth, newHeight);

}


</script>