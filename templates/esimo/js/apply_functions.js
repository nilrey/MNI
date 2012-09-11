var counterShipBlock = 0;
var counterParticipBlock = 0;
var counterRootBlock =  0;
var counterShipRootBlock = 0;
var counterPortsBlock = 0;
var counterEquipBlock = 0;
var counterEquipCoord = 0;
var counterMNITypeBlock = 0;
var server_host = '';

var inputSize = 8;
var txtHeight = 22;
var txtWidth = 500;
var newHeight = 140;

function liFormat (row, i, num) {
	var result = row[0] ; //+ '<p class=qnt>' + row[1] + ' тыс.чел.</p>';
	return result;
}
function selectItem(li) {
/*
extra[0] = name
extra[1] = id
extra[2] = Counter
extra[3] = short_name
extra[4] = address
extra[5] = city
extra[6] = country
extra[7] = phone
extra[8] = fax
extra[9] = email
*/

//	$('#participant_fullname'+li.extra[2]).val(li.extra[0]);
	$('#participant_country'+li.extra[2]+" [value='"+li.extra[6]+"']").attr("selected", "selected");
	$('#participant_city'+li.extra[2]).val(li.extra[5]);
	$('#participant_legaladdress'+li.extra[2]).val(li.extra[4]);
	$('#participant_phone'+li.extra[2]).val(li.extra[7]);
	$('#participant_fax'+li.extra[2]).val(li.extra[8]);
	$('#participant_email'+li.extra[2]).val(li.extra[9]);

	//alert(" [0]: " + li.extra[0] + " [1]: " + li.extra[1] + " [2]: " + li.extra[2] + " [7]: " + li.extra[7]);
}
function selectItemApplicant(li) {
//	$('#applicant_fullname').val(li.extra[0]);
	$("#applicant_country [value='"+li.extra[6]+"']").attr("selected", "selected");
	$('#applicant_city').val(li.extra[5]);
	$('#applicant_legaladdress').val(li.extra[4]);
	$('#applicant_phone').val(li.extra[7]);
	$('#applicant_fax').val(li.extra[8]);
	$('#applicant_email').val(li.extra[9]);

}
function selectItemExecutant(li) {
//	$('#executant_fullname').val(li.extra[0]);
	$("#executant_country [value='"+li.extra[6]+"']").attr("selected", "selected");
	$('#executant_city').val(li.extra[5]);
	$('#executant_legaladdress').val(li.extra[4]);
	$('#executant_phone').val(li.extra[7]);
	$('#executant_fax').val(li.extra[8]);
	$('#executant_email').val(li.extra[9]);

}

function selectItemShipowner(li) {
	counter = li.extra[2];
	$("#shipowner_country__"+counter+" [value='"+li.extra[6]+"']").attr("selected", "selected");
	$('#shipowner_city__'+counter).val(li.extra[5]);
	$('#shipowner_legaladdress__'+counter).val(li.extra[4]);
	$('#shipowner_phone__'+counter).val(li.extra[7]);
	$('#shipowner_fax__'+counter).val(li.extra[8]);
	$('#shipowner_email__'+counter).val(li.extra[9]);

}

function selectItemPort(li) {
	counter = li.extra[2];
	$('#ports'+li.extra[2]+'port').val(li.extra[0]);
}

function selectItemTransportPort(li) {
	counter = li.extra[2];
	$('#homeport__'+li.extra[2]).val(li.extra[0]);
}

// TRANSPORT

function selectItemTransport(li) {
//	alert(" [0]: " + li.extra[0] + " [2]: " + li.extra[2]);
	counter = li.extra[2];
	$('#shipname__'+counter).val( li.extra[0]);
	$("#nation__"+counter+" [value='"+li.extra[3]+"']").attr("selected", "selected");
//	$('#shipowner__'+counter).val( li.extra[4]);
//	$('#homeport__'+counter).val( li.extra[5] );
	$('#func__'+counter).val( li.extra[6]);
	$('#length__'+counter).val( li.extra[7]);
	$('#width__'+counter).val( li.extra[8]);
	$('#draught__'+counter).val( li.extra[9]);
	$('#seaworth__'+counter).val( li.extra[10]);
	$('#displace__'+counter).val( li.extra[11]);
	$('#generator__'+counter).val( li.extra[12]);
	$('#rdfreq__'+counter).val( li.extra[13]);
	$('#rdsign__'+counter).val( li.extra[14]);
//			$('#capt__'+counter).val( li.extra[0]);
//			$('#crew__'+counter).val( li.extra[0]);
//			$('#researchers__'+counter).val( li.extra[0]);
//			$('#head__'+counter).val( li.extra[0]);
}

function deleteBlockTransport(nmbr){
	$('#placerTransport'+nmbr).remove();
	$('#delTransport'+nmbr).remove();
	$('#descTransport'+nmbr).remove();
}

function deleteBlockTransportComplete(id, type, nmbr){
	$.post("http://"+server_host+"/ajax.php", { type: type, elementId: id, action: "deleteTransport" }, function() {}, "json");
	deleteBlockTransport(nmbr);
}

function getTransportType(elem, counter, placer){
	$.post("http://"+server_host+"/ajax.php", { name: elem.value, counter: counter, action: "getTransport" },
	   function(data) {
//			$("#name"+counter).attr({ value: data.name_eng });

			$('#descTransport'+counter).empty(); // очистим область записи
//			$('#'+placer).append('<div id="descTransport'+counter+'"></div>'); // добавим область записи
			if( data.fields.length > 0){
//				$('#descTransport'+counter).addClass( "descTransport" );
				$('#descTransport'+counter).append( data.fields );
			}

	   }, "json");
}

function getTransportNewType(elem, counter, placer){
	$.post("http://"+server_host+"/ajax.php", { name: elem.value, counter: counter, action: "getTransportNew" },
	   function(data) {
//			$("#name"+counter).attr({ value: data.name_eng });

			$('#descTransport'+counter).empty(); // очистим область записи
//			$('#'+placer).append('<div id="descTransport'+counter+'"></div>'); // добавим область записи
			if( data.fields.length > 0){
//				$('#descTransport'+counter).addClass( "descTransport" );
				$('#descTransport'+counter).append( data.fields );
			}

	   }, "json");
}

function getShipInfo(elem, counter){
	$.post("http://"+server_host+"/ajax.php", { elementId: elem.value, counter: counter, action: "shipInfo" },
	   function(data) {
//	   	alert(data.name );
			$('#nation__'+counter).val( data.nation);
//			$('#shipowner__'+counter).val( data.shipowner);
			$('#homeport__'+counter).val( data.nation);
			$('#func__'+counter).val( data.homeport);
			$('#length__'+counter).val( data.length);
			$('#width__'+counter).val( data.width);
			$('#draught__'+counter).val( data.draught);
			$('#seaworth__'+counter).val( data.seaworth);
			$('#displace__'+counter).val( data.displace);
			$('#generator__'+counter).val( data.generator);
			$('#rdfreq__'+counter).val( data.rdfreq);
			$('#rdsign__'+counter).val( data.rdsign);
			$('#capt__'+counter).val( data.capt);
			$('#crew__'+counter).val( data.crew);
			$('#researchers__'+counter).val( data.researchers);
			$('#head__'+counter).val( data.head);

	   }, "json");
}

function newTransportBlock(placer){
//	var strInput = '<div id="block'+counterShipBlock+'"><input type="text" name="" id="id'+counterShipBlock+'" value="value'+counterShipBlock+'"><input type="button" onclick="deleteBlockTransport('+counterShipBlock+')" value="delete '+counterShipBlock+'"></div>';
	strOutput = '<p><div id="placerTransport'+counterShipBlock+'">';
	strOutput += 'Тип транспорта: <select name="TRANSPORT_NEW['+counterShipBlock+'][type]" id="selTransport'+counterShipBlock+'" onchange="getTransportNewType(this, '+counterShipBlock+', \'transp2\')"><option value=0 /><option value="ship">Судно<option value="other">Другое ТС</select>';
	strOutput += '<input type="button" id="delTransport'+counterShipBlock+'" onclick=" if(confirmDeleteRecord()) deleteBlockTransport('+counterShipBlock+')" value="Удалить">';
	strOutput += '</div>';
	strOutput += '<div id="descTransport'+counterShipBlock+'">';
	strOutput += '</div></p>';
	$('#'+placer).append( strOutput);
//	$('#'+transBlockName).append( addShipParams(counterShipBlock));
	counterShipBlock++;
}

// ROOT

function newRootBlock(){
   counterRootBlock++;
	$.post("http://"+server_host+"/ajax_root.php", { counter: counterRootBlock, action: "getShipRoot" },
	   function(data) {
			$('#areaShipRoot').append('<div id="blockShipRoot'+counterRootBlock+'"></div>'); // добавим область записи
			$('#blockShipRoot'+counterRootBlock).append( data.fields );
	   }, "json");
}

// PARTICIPANT
function newParticipBlock(){
//	var elements = $('div[id^=blockParticip]');
//	elements.length;
   counterParticipBlock++;
	$.post("http://"+server_host+"/ajax_particip.php", { counter: counterParticipBlock, action: "getParticip" },
	   function(data) {
			$('#areaParticipant').append('<div id="blockParticip'+counterParticipBlock+'"></div>'); // добавим область записи
			//$('#blockParticip'+counterParticipBlock).addClass( "border2px" );
			$('#blockParticip'+counterParticipBlock).append( data.fields );
//			$('#blockParticip'+counterParticipBlock).append( data.ac );

	   }, "json");
}
function deleteParticipBlock(nmbr){
	$('#blockParticip'+nmbr).remove();
}
function deleteParticipBlockComplete(nmbr, id, type){
	$.post("http://"+server_host+"/ajax_particip.php", { type: type, elementId: id, action: "deleteParticip" }, function() {}, "json");
	deleteParticipBlock(nmbr);
}

$(document).ready(function(){
// --- Автозаполнение ---
	$("#applicant_fullname").autocomplete("/ajax_particip.php", {
		delay:10,
		minChars:2,
		matchSubset:1,
		autoFill:false,
		matchContains:1,
		cacheLength:10,
		selectFirst:true,
		formatItem:liFormat,
		maxItemsToShow:10,
		onItemSelect:selectItemApplicant
	});
	$("#executant_fullname").autocomplete("/ajax_particip.php", {
		delay:10,
		minChars:2,
		matchSubset:1,
		autoFill:false,
		matchContains:1,
		cacheLength:10,
		selectFirst:true,
		formatItem:liFormat,
		maxItemsToShow:10,
		onItemSelect:selectItemExecutant
	});
});

function deleteTr(nmbr, type){
	$('#table'+type+' > tbody #tr'+nmbr).remove();
	for( i=1; i< $('#table'+type+' > tbody tr').length; i++){
		$('#table'+type+' > tbody tr:eq('+i+') td:first').text(i);
		$('#table'+type+' > tbody tr:eq('+i+') #'+type+'_num').val(i);
	}
}
function deleteTrComplete(nmbr, type, id){
	$.post("http://"+server_host+"/ajax.php", { type: type, elementId: id, action: "deleteCoord" }, function() {}, "json");
	deleteTr(nmbr, type);
}

function addCoordsBlock(type){

	var tblLength = $('#table'+type+' > tbody tr').length;
		if	( tblLength === 1 ||
			( $('#table'+type+' > tbody tr:eq('+(tblLength-1)+') td:eq(2)').find('[id *=lat_grad]').val().length > 0
			&& $('#table'+type+' > tbody tr:eq('+(tblLength-1)+') td:eq(3)').find('[id *=lang_grad]').val().length > 0
			&& $('#table'+type+' > tbody tr:eq('+(tblLength-1)+') td:eq(1)').find('[id *=landing_date]').val().length > 0 ) ){
			var counter = tblLength+1;
			var newRow = '<tr id="tr'+counter+'">';
			newRow += '<td>'+counter+'</td>';
			newRow += '<td><input type="hidden" name="COORDS['+type+']['+counter+'][num]" id="'+type+'_num" value="">';
			newRow += '<input type="text" name="COORDS['+type+']['+counter+'][landing_date]" id="'+type+counter+'landing_date" value=""  onchange="dpFormatValue(this)">';
			newRow += '</td>';

			newRow += '<td>';
				newRow += '<input type="text" size="1" name="COORDS['+type+']['+counter+'][lat_grad]" id="'+type+counter+'lat_grad" onkeyup="checkCoord(\''+type+counter+'lat_grad\', \''+type+counter+'lat_min\')"  maxlength="3">&#176&nbsp;&nbsp;&nbsp;';
				newRow += '<input type="text" size="3" name="COORDS['+type+']['+counter+'][lat_min]" id="'+type+counter+'lat_min" onkeyup="checkCoord(\''+type+counter+'lat_min\', \'\')"  maxlength="6">&#39 с.ш.';
			newRow += '</td>';
			newRow += '<td>';
				newRow += '<input type="text" size="1" name="COORDS['+type+']['+counter+'][lang_grad]" id="'+type+counter+'lang_grad" onkeyup="checkCoord(\''+type+counter+'lang_grad\', \''+type+counter+'lang_min\')"  maxlength="3">&#176&nbsp;&nbsp;&nbsp;';
				newRow += '<input type="text" size="3" name="COORDS['+type+']['+counter+'][lang_min]" id="'+type+counter+'lang_min" onkeyup="checkCoord(\''+type+counter+'lang_min\', \'\')"  maxlength="6">&#39';
			newRow += '<input type="radio" name="COORDS['+type+']['+counter+'][lang_type]" value="в.д." checked>в.д.';
			newRow += '<input type="radio" name="COORDS['+type+']['+counter+'][lang_type]" value="з.д.">з.д.';
			newRow += '</td>';
			newRow += '<td>';
				newRow += '<input type="button" onclick=" if(confirmDelete()) deleteTr('+counter+', \''+type+'\')" value="Удалить">';
			newRow += '</td>';
			newRow += '</tr>';
			$("#table"+type+" > tbody").append(newRow);
			for( i=1; i< $('#table'+type+' > tbody tr').length; i++){
				$('#table'+type+' > tbody tr:eq('+i+') td:first').text(i);
				$('#table'+type+' > tbody tr:eq('+i+') #'+type+'_num').val(i);
			}

			if( tblLength > 1 ){
				curMinDate =  $('#table'+type+' > tbody tr:eq('+(tblLength-1)+') td:eq(1)').find('[id *=landing_date]').val() ;
			}else{
				curMinDate = cMinDate;
			}

			$('#'+type+counter+'landing_date').datepick({ minDate: curMinDate, maxDate: cMaxDate, showTrigger: '#calImg'});

//			counter++;

		}else{
			alert('Поля обязательные для заполнения отмечены звездочкой!');
		}

}

function addMniregionBlock(type){
	var tblLength = $('#table'+type+' > tbody tr').length;
		if	( tblLength === 1 ||
			( $('#table'+type+' > tbody tr:eq('+(tblLength-1)+') td:eq(1)').find('[id *=lat_grad]').val().length > 0
			&& $('#table'+type+' > tbody tr:eq('+(tblLength-1)+') td:eq(2)').find('[id *=lang_grad]').val().length > 0
			) ){
			var counter = tblLength+1;
			var newRow = '<tr id="tr'+counter+'" class="trHighLighted">';
			newRow += '<td>'+counter+'<input type="hidden" name="COORDS['+type+']['+counter+'][num]" id="'+type+'_num" value=""></td>';
			newRow += '<td>';
				newRow += '<input type="text" size="1" name="COORDS['+type+']['+counter+'][lat_grad]" id="'+type+counter+'lat_grad" onkeyup="checkCoord(\''+type+counter+'lat_grad\', \''+type+counter+'lat_min\')"  maxlength="3">&#176&nbsp;&nbsp;&nbsp;';
				newRow += '<input type="text" size="3" name="COORDS['+type+']['+counter+'][lat_min]" id="'+type+counter+'lat_min" onkeyup="checkCoord(\''+type+counter+'lat_min\', \'\')"  maxlength="6">&#39 с.ш.';
			newRow += '</td>';
			newRow += '<td>';
				newRow += '<input type="text" size="1" name="COORDS['+type+']['+counter+'][lang_grad]" id="'+type+counter+'lang_grad" onkeyup="checkCoord(\''+type+counter+'lang_grad\', \''+type+counter+'lang_min\')"  maxlength="3">&#176&nbsp;&nbsp;&nbsp;';
				newRow += '<input type="text" size="3" name="COORDS['+type+']['+counter+'][lang_min]" id="'+type+counter+'lang_min" onkeyup="checkCoord(\''+type+counter+'lang_min\', \'\')"  maxlength="6">&#39';
			newRow += '<input type="radio" name="COORDS['+type+']['+counter+'][lang_type]" value="в.д." checked>в.д.';
			newRow += '<input type="radio" name="COORDS['+type+']['+counter+'][lang_type]" value="з.д.">з.д.';
			newRow += '</td>';
			newRow += '<td>';
				newRow += '<input type="button" onclick=" if(confirmDelete()) deleteTr('+counter+', \''+type+'\')" value="Удалить">';
			newRow += '</td>';
			newRow += '</tr>';
			$("#table"+type+" > tbody").append(newRow);
			for( i=1; i< $('#table'+type+' > tbody tr').length; i++){
				$('#table'+type+' > tbody tr:eq('+i+') td:first').text(i);
				$('#table'+type+' > tbody tr:eq('+i+') #'+type+'_num').val(i);
			}

			if( tblLength > 1 ){
				curMinDate =  $('#table'+type+' > tbody tr:eq('+(tblLength-1)+') td:eq(1)').find('[id *=landing_date]').val() ;
			}else{
				curMinDate = cMinDate;
			}

			$('#'+type+counter+'landing_date').datepick({ minDate: curMinDate, maxDate: cMaxDate, showTrigger: '#calImg'});

//			counter++;

		}else{
			alert('Поля обязательные для заполнения отмечены звездочкой!');
		}

}

function addMnirootBlock(type){
	var tblLength = $('#table'+type+' > tbody tr').length;
		if	( tblLength === 1 ||
			( $('#table'+type+' > tbody tr:eq('+(tblLength-1)+') td:eq(2)').find('[id *=lat_grad]').val().length > 0
			&& $('#table'+type+' > tbody tr:eq('+(tblLength-1)+') td:eq(3)').find('[id *=lang_grad]').val().length > 0
			&& $('#table'+type+' > tbody tr:eq('+(tblLength-1)+') td:eq(1)').find('[id *=landing_date]').val().length > 0 ) ){
			var counter = tblLength+1;
			var composeName = 'COORDS['+type+']['+counter+']';
			var composeId = type+counter;

			var newRow = '<tr id="tr'+counter+'">';
			newRow += '<td>'+counter+'</td>';
			newRow += '<td><input type="hidden" name="COORDS['+type+']['+counter+'][num]" id="'+type+'_num" value="">';
			newRow += '<input type="text" name="COORDS['+type+']['+counter+'][landing_date]" id="'+type+counter+'landing_date" value=""  onchange="dpFormatValue(this)">';
			newRow += '</td>';

			newRow += '<td>';
				newRow += '<input type="text" size="1" name="COORDS['+type+']['+counter+'][lat_grad]" id="'+type+counter+'lat_grad" onkeyup="checkCoord(\''+type+counter+'lat_grad\', \''+type+counter+'lat_min\')"  maxlength="3">&#176&nbsp;&nbsp;&nbsp;';
				newRow += '<input type="text" size="3" name="COORDS['+type+']['+counter+'][lat_min]" id="'+type+counter+'lat_min" onkeyup="checkCoord(\''+type+counter+'lat_min\', \'\')"  maxlength="6">&#39 с.ш.';
			newRow += '</td>';
			newRow += '<td>';
				newRow += '<input type="text" size="1" name="COORDS['+type+']['+counter+'][lang_grad]" id="'+type+counter+'lang_grad" onkeyup="checkCoord(\''+type+counter+'lang_grad\', \''+type+counter+'lang_min\')"  maxlength="3">&#176&nbsp;&nbsp;&nbsp;';
				newRow += '<input type="text" size="3" name="COORDS['+type+']['+counter+'][lang_min]" id="'+type+counter+'lang_min" onkeyup="checkCoord(\''+type+counter+'lang_min\', \'\')"  maxlength="6">&#39';
			newRow += '<input type="radio" name="COORDS['+type+']['+counter+'][lang_type]" value="в.д." checked>в.д.';
			newRow += '<input type="radio" name="COORDS['+type+']['+counter+'][lang_type]" value="з.д.">з.д.';
			newRow += '</td>';
			newRow += tdTextArea(composeName+'[info]', composeId+'info', 'textarea185');
			newRow += '<td>';
				newRow += '<input type="button" onclick=" if(confirmDelete()) deleteTr('+counter+', \''+type+'\')" value="Удалить">';
			newRow += '</td>';
			newRow += '</tr>';
			$("#table"+type+" > tbody").append(newRow);
			for( i=1; i< $('#table'+type+' > tbody tr').length; i++){
				$('#table'+type+' > tbody tr:eq('+i+') td:first').text(i);
				$('#table'+type+' > tbody tr:eq('+i+') #'+type+'_num').val(i);
			}

			if( tblLength > 1 ){
				curMinDate =  $('#table'+type+' > tbody tr:eq('+(tblLength-1)+') td:eq(1)').find('[id *=landing_date]').val() ;
			}else{
				curMinDate = cMinDate;
			}

			$('#'+type+counter+'landing_date').datepick({ minDate: curMinDate, maxDate: cMaxDate, showTrigger: '#calImg'});
			setTextareaResizeNew(composeId+'info', 185, txtHeight, 300, newHeight);

		}else{
			alert('Поля обязательные для заполнения отмечены звездочкой!');
		}

}

function addMnishoreBlock(type){
	var tblLength = $('#table'+type+' > tbody tr').length;
		if	( tblLength === 1 ||
			( $('#table'+type+' > tbody tr:eq('+(tblLength-1)+') td:eq(2)').find('[id *=lat_grad]').val().length > 0
			&& $('#table'+type+' > tbody tr:eq('+(tblLength-1)+') td:eq(3)').find('[id *=lang_grad]').val().length > 0
			&& $('#table'+type+' > tbody tr:eq('+(tblLength-1)+') td:eq(1)').find('[id *=info]').val().length > 0 ) ){
			var counter = tblLength+1;
			var composeName = 'COORDS['+type+']['+counter+']';
			var composeId = type+counter;

			var newRow = '<tr id="tr'+counter+'">';
			newRow += '<td>'+counter+'<input type="hidden" name="COORDS['+type+']['+counter+'][num]" id="'+type+'_num" value=""></td>';

			newRow += tdInput(composeName+'[info]', composeId+'info');
			newRow += '<td>';
				newRow += '<input type="text" size="1" name="COORDS['+type+']['+counter+'][lat_grad]" id="'+type+counter+'lat_grad" onkeyup="checkCoord(\''+type+counter+'lat_grad\', \''+type+counter+'lat_min\')"  maxlength="3">&#176&nbsp;&nbsp;&nbsp;';
				newRow += '<input type="text" size="3" name="COORDS['+type+']['+counter+'][lat_min]" id="'+type+counter+'lat_min" onkeyup="checkCoord(\''+type+counter+'lat_min\', \'\')"  maxlength="6">&#39 с.ш.';
			newRow += '</td>';
			newRow += '<td>';
				newRow += '<input type="text" size="1" name="COORDS['+type+']['+counter+'][lang_grad]" id="'+type+counter+'lang_grad" onkeyup="checkCoord(\''+type+counter+'lang_grad\', \''+type+counter+'lang_min\')"  maxlength="3">&#176&nbsp;&nbsp;&nbsp;';
				newRow += '<input type="text" size="3" name="COORDS['+type+']['+counter+'][lang_min]" id="'+type+counter+'lang_min" onkeyup="checkCoord(\''+type+counter+'lang_min\', \'\')"  maxlength="6">&#39';
			newRow += '<input type="radio" name="COORDS['+type+']['+counter+'][lang_type]" value="в.д." checked>в.д.';
			newRow += '<input type="radio" name="COORDS['+type+']['+counter+'][lang_type]" value="з.д.">з.д.';
			newRow += '</td>';
			newRow += '<td>';
				newRow += '<input type="button" onclick=" if(confirmDelete()) deleteTr('+counter+', \''+type+'\')" value="Удалить">';
			newRow += '</td>';
			newRow += '</tr>';
			$("#table"+type+" > tbody").append(newRow);
			for( i=1; i< $('#table'+type+' > tbody tr').length; i++){
				$('#table'+type+' > tbody tr:eq('+i+') td:first').text(i);
				$('#table'+type+' > tbody tr:eq('+i+') #'+type+'_num').val(i);
			}

			if( tblLength > 1 ){
				curMinDate =  $('#table'+type+' > tbody tr:eq('+(tblLength-1)+') td:eq(1)').find('[id *=landing_date]').val() ;
			}else{
				curMinDate = cMinDate;
			}

			$('#'+type+counter+'landing_date').datepick({ minDate: curMinDate, maxDate: cMaxDate, showTrigger: '#calImg'});
//			setTextareaResizeNew(composeId+'info', 185, txtHeight, 185, newHeight);

		}else{
			alert('Поля обязательные для заполнения отмечены звездочкой!');
		}

}

function addPortsBlock(type){
	var tblLength = $('#table'+type+' > tbody tr').length;
		if	( tblLength === 1 ||  $('#table'+type+' > tbody tr:eq('+(tblLength-1)+') td:eq(1)').find('[id *=landing_date]').val().length > 0 ){

			var newRow = '<tr id="tr'+counterPortsBlock+'">';
			newRow += '<td>'+counterPortsBlock+'</td>';
			newRow += '<td><input type="hidden" name="PORTS['+type+']['+counterPortsBlock+'][num]" id="'+type+'_num" value="">';
			newRow += '<input type="text" name="PORTS['+type+']['+counterPortsBlock+'][landing_date]" id="'+type+counterPortsBlock+'landing_date" value="">';
			newRow += '</td>';

			newRow += '<td>';
			newRow += '<input type="text" name="PORTS['+type+']['+counterPortsBlock+'][port]" id="'+type+counterPortsBlock+'port">';
			newRow += '</td>';
			newRow += '<td>';
			newRow += '<textarea name="PORTS['+type+']['+counterPortsBlock+'][comment]" id="'+type+counterPortsBlock+'comment" rows="1"></textarea>';
			newRow += '</td>';
			newRow += '<td>';
				newRow += '<input type="button" onclick=" if(confirmDelete()) deleteTr('+counterPortsBlock+', \''+type+'\')" value="Удалить">';
			newRow += '</td>';
			newRow += '</tr>';
			$("#table"+type+" > tbody").append(newRow);
			for( i=1; i< $('#table'+type+' > tbody tr').length; i++){
				$('#table'+type+' > tbody tr:eq('+i+') td:first').text(i);
				$('#table'+type+' > tbody tr:eq('+i+') #'+type+'_num').val(i);
			}

			// we check last row in table , take value from calendar input and use it as minimal date for the current new record
			if( tblLength > 1 ){
				curMinDate =  $('#table'+type+' > tbody tr:eq('+(tblLength-1)+') td:eq(1)').find('[id *=landing_date]').val() ;
			}else{
				curMinDate = cMinDate;
			}

			$('#'+type+counterPortsBlock+'landing_date').datepick({ minDate: curMinDate, maxDate: cMaxDate, showTrigger: '#calImg'});
			// end of calendar limitation
			setTextareaResizeNew(type+counterPortsBlock+'comment', 185, txtHeight, txtWidth, newHeight);

			$(document).ready(function(){
					$("#"+type+counterPortsBlock+"port").autocomplete("/ajax.php", {
						delay:10,
						minChars:2,
						matchSubset:1,
						autoFill:false,
						matchContains:1,
						cacheLength:10,
						selectFirst:true,
						formatItem:liFormat,
						maxItemsToShow:10,
						onItemSelect:selectItemPort,
						action:'getPortsList',
						Counter: counterPortsBlock
					});
			});

			counterPortsBlock++;
		}
}

function deleteTrPortComplete(nmbr, type, id){
	$.post("http://"+server_host+"/ajax.php", { type: type, elementId: id, action: "deletePort" }, function() {}, "json");
	deleteTr(nmbr, type);
}


function checkCoord(parent, child){
	if(parent.length > 0){
		// replace comma to dot
		$('#'+parent).val($('#'+parent).val().replace(',', '.') );
		$('#'+parent).val($('#'+parent).val().replace(' ', '') );
		last = $('#'+parent).val().charAt($('#'+parent).val().length-1);
		if( $.isNumeric(last) || last == '.'){
			if($('#'+parent).val().length == 3){
				if(child.length > 0){
					$('#'+ child).focus();
				}
			}
		}else{
			$('#'+parent).val($('#'+parent).val().substring(0, $('#'+parent).val().length-1) )
		}
	}
}

function addMNITypeBlock(type){
	var newRow = '<tr id="tr'+counterMNITypeBlock+'">';
	newRow += '<td>'+counterMNITypeBlock+'</td>';
	newRow += '<td><input type="hidden" name="MNITYPE['+type+']['+counterMNITypeBlock+'][num]" id="'+type+'_num" value="">';
	newRow += generateMNIType(type);
	newRow += '</td>';

	newRow += '<td>';
	newRow += '<div id="placer'+type+counterMNITypeBlock+'"></div>';
	newRow += '</td>';
	newRow += '<td>';
	newRow += generateMNIUnit(type);
	newRow += '</td>';
	newRow += '<td>';
	newRow += '<input type="text" name="MNITYPE['+type+']['+counterMNITypeBlock+'][amount]" id="'+type+counterMNITypeBlock+'_amount">';
	newRow += '</td>';
	newRow += '<td>';
		newRow += '<input type="button" onclick=" if(confirmDelete()) deleteTr('+counterMNITypeBlock+', \''+type+'\'); setValueToUseResult()" value="Удалить">';
	newRow += '</td>';
	newRow += '</tr>';
	$("#table"+type+" > tbody").append(newRow);
	for( i=1; i< $('#table'+type+' > tbody tr').length; i++){
		$('#table'+type+' > tbody tr:eq('+i+') td:first').text(i);
		$('#table'+type+' > tbody tr:eq('+i+') #'+type+'_num').val(i);
	}

	counterMNITypeBlock++;

}
/*
function setTextareaEnlarge(id){
	  $("#"+id).animate({"height": "200px"}, "slow");
}

function setTextareaMinimize(id){
	  $("#"+id).animate({"height": "22px"}, "slow");
}

function setTextareaResize(id){
	$("#"+id).focus(function(){
		setTextareaEnlarge(id);
	});
	$("#"+id).blur(function(){
		setTextareaMinimize(id);
	});
}*/

function setTextareaDefaultValue(id, baseWidth, baseHeight, newWidth, newHeight){
	$("#"+id).focus(function(){
		if( $.trim( $("#"+id).val() ) == 'нет' ){
			$("#"+id).val('');
		}
		setTextareaEnlargeNew(id, newHeight, newWidth);
	});
	$("#"+id).blur(function(){
		if( $.trim( $("#"+id).val() ) == '' ){
			$("#"+id).val('нет');
		}
		setTextareaMinimizeNew(id, baseHeight, baseWidth);
		//$("#"+id).animate({"height": "22px"}, "slow");
	});
}

function setTextareaEnlargeNew(id, newHeight, newWidth){
	  $("#"+id).animate({"height": newHeight+"px"}, "slow");
	  $("#"+id).animate({"width": newWidth+"px"}, "slow");
}

function setTextareaMinimizeNew(id, baseHeight, baseWidth){
	  $("#"+id).animate({"height": baseHeight+"px"}, "slow");
	  $("#"+id).animate({"width": baseWidth+"px"}, "slow");
}

function setTextareaResizeNew(id, baseWidth, baseHeight, newWidth, newHeight){
	$("#"+id).focus(function(){
		setTextareaEnlargeNew(id, newHeight, newWidth);
	});
	$("#"+id).blur(function(){
		setTextareaMinimizeNew(id, baseHeight, baseWidth);
	});
}


$(document).ready( function (){
	newHeight = 140;
	setTextareaDefaultValue('tech_hydrograph', txtWidth, txtHeight, txtWidth, newHeight);
	setTextareaDefaultValue('tech_hydroacustic', txtWidth, txtHeight, txtWidth, newHeight);
	setTextareaDefaultValue('tech_magnitometr', txtWidth, txtHeight, txtWidth, newHeight);
	setTextareaDefaultValue('tech_seismic', txtWidth, txtHeight, txtWidth, newHeight);
	setTextareaDefaultValue('tech_meteorolog', txtWidth, txtHeight, txtWidth, newHeight);
	setTextareaDefaultValue('tech_oceanograph', txtWidth, txtHeight, txtWidth, newHeight);
	setTextareaDefaultValue('tech_bioresearch', txtWidth, txtHeight, txtWidth, newHeight);
	setTextareaDefaultValue('tech_probation', txtWidth, txtHeight, txtWidth, newHeight);
	setTextareaDefaultValue('tech_divingdev', txtWidth, txtHeight, txtWidth, newHeight);
	setTextareaDefaultValue('tech_ancoreddev', txtWidth, txtHeight, txtWidth, newHeight);
	setTextareaDefaultValue('tech_coupleddev', txtWidth, txtHeight, txtWidth, newHeight);
	setTextareaDefaultValue('tech_submarine', txtWidth, txtHeight, txtWidth, newHeight);
	setTextareaDefaultValue('tech_planes', txtWidth, txtHeight, txtWidth, newHeight);
	setTextareaDefaultValue('tech_otherdev', txtWidth, txtHeight, txtWidth, newHeight);
} );

$(document).ready( function (){
	newHeight = 140;
	setTextareaResizeNew('mni_name', txtWidth, txtHeight, txtWidth, newHeight);
	setTextareaResizeNew('mni_aim', txtWidth, txtHeight, txtWidth, newHeight);
	setTextareaDefaultValue('mni_spec', txtWidth, txtHeight, txtWidth, newHeight);
	setTextareaDefaultValue('exp_ecology', txtWidth, txtHeight, txtWidth, newHeight);
	setTextareaDefaultValue('exp_particip_rf', txtWidth, txtHeight, txtWidth, newHeight);
//	setTextareaDefaultValue('exp_use_result', txtWidth, txtHeight, txtWidth, newHeight);
	setTextareaResizeNew('exp_use_result', txtWidth, txtHeight, txtWidth, newHeight);
} );
