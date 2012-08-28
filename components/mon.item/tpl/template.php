<? $PAGE->setPageTitle('Запрос на экспедицию');?>
<?
//var_dump($arResult);
$act = '';
if($_REQUEST['act'] === 'copy'){
	$act = $_REQUEST['act'];
}elseif ($_REQUEST['act'] === 'save'){
	$act = $_REQUEST['act'];
	$message = 'Данные успешно сохранены';
	$_SERVER['REQUEST_URI'] = str_replace('&act=save', '', $_SERVER['REQUEST_URI']);
}
//global $DB;
//$query = 'SELECT * FROM  mon_rb_organizations WHERE name like \'%Росс%\' OR name_eng like \'%Росс%\' ';
//$resource = $DB->getRecordsAssoc($query);
//foreach ($resource as $arr){
//	echo $arr['name'].'<br>';
//}
?>

<script>
// VARIABLES
var counterShipBlock = <?=(count($arResult['TRANSPORT'])+2)?>;
var counterParticipBlock = <?=count($arResult['PARTICIPANT'])?>;
var counterRootBlock =  <?=count($arResult['ROOTS'])?>;
var counterShipRootBlock = <?=count($arResult['COORDS']['shiproot'])+1?>;
var counterPortsBlock = <?=count($arResult['PORTS']['ports'])+1?>;
var counterEquipBlock = <?=count($arResult['EQUIP'])+1?>;
var counterMNITypeBlock = <?=count($arResult['MNITYPE'])+1?>;
//


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

function selectItemTransport(li) {
//	alert(" [0]: " + li.extra[0] + " [2]: " + li.extra[2]);
	counter = li.extra[2];
	$('#shipname__'+counter).val( li.extra[0]);
	$("#nation__"+counter+" [value='"+li.extra[3]+"']").attr("selected", "selected");
//	$('#shipowner__'+counter).val( li.extra[4]);
	$('#homeport__'+counter).val( li.extra[5] );
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
//
// TABULATION

(function($) {
$(function() {

  $('div.tabs').each(function() {
    $(this).find('span').each(function(i) {
      $(this).click(function(){
        $(this).addClass('current').siblings().removeClass('current')
          .parents('div.section').find('div.box').hide().end().find('div.box:eq('+i+')').fadeIn(150);
      });
    });
  });

})
})(jQuery)

// TRANSPORT
function deleteBlockTransport(nmbr){
	$('#placerTransport'+nmbr).remove();
	$('#delTransport'+nmbr).remove();
	$('#descTransport'+nmbr).remove();
}

function deleteBlockTransportComplete(id, type, nmbr){
	$.post("http://mni/ajax.php", { type: type, elementId: id, action: "deleteTransport" }, function() {}, "json");
	deleteBlockTransport(nmbr);
}

function getTransportType(elem, counter, placer){
	$.post("http://mni/ajax.php", { name: elem.value, counter: counter, action: "getTransport" },
	   function(data) {
//			$("#name"+counter).attr({ value: data.name_eng });
			
			$('#descTransport'+counter).remove(); // очистим область записи
			$('#'+placer).append('<div id="descTransport'+counter+'"></div>'); // добавим область записи
			if( data.fields.length > 0){
				$('#descTransport'+counter).addClass( "descTransport" );
				$('#descTransport'+counter).append( data.fields );
			}
      
	   }, "json");
}

function getTransportNewType(elem, counter, placer){
	$.post("http://mni/ajax.php", { name: elem.value, counter: counter, action: "getTransportNew" },
	   function(data) {
//			$("#name"+counter).attr({ value: data.name_eng });
			
			$('#descTransport'+counter).remove(); // очистим область записи
			$('#'+placer).append('<div id="descTransport'+counter+'"></div>'); // добавим область записи
			if( data.fields.length > 0){
				$('#descTransport'+counter).addClass( "descTransport" );
				$('#descTransport'+counter).append( data.fields );
			}
      
	   }, "json");
}

function getShipInfo(elem, counter){
	$.post("http://mni/ajax.php", { elementId: elem.value, counter: counter, action: "shipInfo" },
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

function getPlaneInfo(elem, counter){
	$.post("http://mni/ajax.php", { elementId: elem.value, counter: counter, action: "planeInfo" },
	   function(data) {
//			$('#func__'+counter).val( data.homeport);
			$('#rdsign__'+counter).val( data.rdsign);
			$('#crew__'+counter).val( data.crew);
			$('#researchers__'+counter).val( data.researchers);
			$('#head__'+counter).val( data.head);
      
	   }, "json");
}
//
function newTransportBlock(placer){
//	var strInput = '<div id="block'+counterShipBlock+'"><input type="text" name="" id="id'+counterShipBlock+'" value="value'+counterShipBlock+'"><input type="button" onclick="deleteBlockTransport('+counterShipBlock+')" value="delete '+counterShipBlock+'"></div>';
	strOutput = '<div id="placerTransport'+counterShipBlock+'">';
	strOutput += 'Тип транспорта: <select name="TRANSPORT_NEW['+counterShipBlock+'][type]" id="selTransport'+counterShipBlock+'" onchange="getTransportNewType(this, '+counterShipBlock+', \'transp2\')"><option value=0 /><option value="ship">Судно<option value="other">Другое ТС</select>';
	strOutput += '<input type="button" id="delTransport'+counterShipBlock+'" onclick=" deleteBlockTransport('+counterShipBlock+')" value="Удалить">';
	strOutput += '</div>';
	strOutput += '<div id="descTransport'+counterShipBlock+'">';
	strOutput += '</div>';
	$('#'+placer).append( strOutput);
//	$('#'+transBlockName).append( addShipParams(counterShipBlock));
	counterShipBlock++;
}

// ROOT

function newRootBlock(){
   counterRootBlock++;
	$.post("http://mni/ajax_root.php", { counter: counterRootBlock, action: "getShipRoot" },
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
	$.post("http://mni/ajax_particip.php", { counter: counterParticipBlock, action: "getParticip" },
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
	$.post("http://mni/ajax_particip.php", { type: type, elementId: id, action: "deleteParticip" }, function() {}, "json");
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
	$.post("http://mni/ajax.php", { type: type, elementId: id, action: "deleteCoord" }, function() {}, "json");
	deleteTr(nmbr, type);
} 
function addCoordsBlock(type){	
	var newRow = '<tr id="tr'+counterShipRootBlock+'">';
	newRow += '<td>'+counterShipRootBlock+'</td>';
	newRow += '<td><input type="hidden" name="COORDS['+type+']['+counterShipRootBlock+'][num]" id="'+type+'_num" value="">';
	newRow += '<input type="text" name="COORDS['+type+']['+counterShipRootBlock+'][landing_date]" id="'+type+counterShipRootBlock+'landing_date" value=""  onchange="dpFormatValue(this)">';
	newRow += '</td>';
	
	newRow += '<td>';
		newRow += '<input type="text" size="1" name="COORDS['+type+']['+counterShipRootBlock+'][lat_grad]" id="'+type+counterShipRootBlock+'lat_grad" onkeyup="checkCoord(\''+type+counterShipRootBlock+'lat_grad\', \''+type+counterShipRootBlock+'lat_min\')"  maxlength="3">&#176&nbsp;&nbsp;&nbsp;';
		newRow += '<input type="text" size="3" name="COORDS['+type+']['+counterShipRootBlock+'][lat_min]" id="'+type+counterShipRootBlock+'lat_min" onkeyup="checkCoord(\''+type+counterShipRootBlock+'lat_min\', \'\')"  maxlength="6">&#39 с.ш.';
	newRow += '</td>';
	newRow += '<td>';
		newRow += '<input type="text" size="1" name="COORDS['+type+']['+counterShipRootBlock+'][lang_grad]" id="'+type+counterShipRootBlock+'lang_grad" onkeyup="checkCoord(\''+type+counterShipRootBlock+'lang_grad\', \''+type+counterShipRootBlock+'lang_min\')"  maxlength="3">&#176&nbsp;&nbsp;&nbsp;';
		newRow += '<input type="text" size="3" name="COORDS['+type+']['+counterShipRootBlock+'][lang_min]" id="'+type+counterShipRootBlock+'lang_min" onkeyup="checkCoord(\''+type+counterShipRootBlock+'lang_min\', \'\')"  maxlength="6">&#39';
	newRow += '<input type="radio" name="COORDS['+type+']['+counterShipRootBlock+'][lang_type]" value="в.д." checked>в.д.';
	newRow += '<input type="radio" name="COORDS['+type+']['+counterShipRootBlock+'][lang_type]" value="з.д.">з.д.';
	newRow += '</td>';
	newRow += '<td>';
		newRow += '<input type="button" onclick="deleteTr('+counterShipRootBlock+', \''+type+'\')" value="Удалить">';
	newRow += '</td>';
	newRow += '</tr>';
	$("#table"+type+" > tbody").append(newRow);
	for( i=1; i< $('#table'+type+' > tbody tr').length; i++){
		$('#table'+type+' > tbody tr:eq('+i+') td:first').text(i);
		$('#table'+type+' > tbody tr:eq('+i+') #'+type+'_num').val(i);
	}
	
	$('#'+type+counterShipRootBlock+'landing_date').datepick();
	
	counterShipRootBlock++;
}

function addPortsBlock(type){	
	var newRow = '<tr id="tr'+counterPortsBlock+'">';
	newRow += '<td>'+counterPortsBlock+'</td>';
	newRow += '<td><input type="hidden" name="PORTS['+type+']['+counterPortsBlock+'][num]" id="'+type+'_num" value="">';
	newRow += '<input type="text" name="PORTS['+type+']['+counterPortsBlock+'][landing_date]" id="'+type+counterPortsBlock+'landing_date" onchange="dpFormatValue(this)" value="">';
	newRow += '</td>';
	
	newRow += '<td>';
	newRow += '<input type="text" name="PORTS['+type+']['+counterPortsBlock+'][port]" id="'+type+counterPortsBlock+'port">';
	newRow += '</td>';
	newRow += '<td>';
	newRow += '<textarea name="PORTS['+type+']['+counterPortsBlock+'][comment]" id="'+type+counterPortsBlock+'comment"></textarea>';
	newRow += '</td>';
	newRow += '<td>';
		newRow += '<input type="button" onclick="deleteTr('+counterPortsBlock+', \''+type+'\')" value="Удалить">';
	newRow += '</td>';
	newRow += '</tr>';
	$("#table"+type+" > tbody").append(newRow);
	for( i=1; i< $('#table'+type+' > tbody tr').length; i++){
		$('#table'+type+' > tbody tr:eq('+i+') td:first').text(i);
		$('#table'+type+' > tbody tr:eq('+i+') #'+type+'_num').val(i);
	}
	
	$('#'+type+counterPortsBlock+'landing_date').datepick();
	
	counterPortsBlock++;
}

function deleteTrPortComplete(nmbr, type, id){
	$.post("http://mni/ajax.php", { type: type, elementId: id, action: "deletePort" }, function() {}, "json");
	deleteTr(nmbr, type);
} 

function checkCoord(parent, child){
	if(parent.length > 0){
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

function deleteEquipTr(nmbr, type){
	$('#table'+type+' > tbody #tr'+nmbr).remove();
	for( i=1; i< $('#table'+type+' > tbody tr').length; i++){
		$('#table'+type+' > tbody tr:eq('+i+') td:first').text(i);
		$('#table'+type+' > tbody tr:eq('+i+') #'+type+'_num').val(i);
	}
} 
function deleteEquipTrComplete(nmbr, tableType, id){
	$.post("http://mni/ajax.php", { elementId: id, action: "deleteEquip" }, function() {}, "json");
	deleteTr(nmbr, tableType);
} 
//

function addEquipBlock(type){	
	var newRow = '<tr id="tr'+counterEquipBlock+'">';
	newRow += '<td>'+counterEquipBlock+'</td>';
	newRow += '<td><input type="hidden" name="EQUIP['+counterEquipBlock+'][num]" id="'+type+'_num" value="">';
	newRow += '<textarea cols="15" rows="5" name="EQUIP['+counterEquipBlock+'][basic]" ></textarea></td>';
	newRow += '<td><textarea cols="15" rows="5" name="EQUIP['+counterEquipBlock+'][infotype]" ></textarea></td>';
	newRow += '<td><textarea cols="15" rows="5" name="EQUIP['+counterEquipBlock+'][coord]" ></textarea></td>';
	newRow += '<td><textarea cols="15" rows="5" name="EQUIP['+counterEquipBlock+'][dates]" ></textarea></td>';
	newRow += '<td><textarea cols="15" rows="5" name="EQUIP['+counterEquipBlock+'][owner]" ></textarea></td>';
	newRow += '<td><input type="button" onclick="deleteTr('+counterEquipBlock+', \''+type+'\')" value="Удалить"></td>';
	newRow += '</tr>';
	$("#table"+type+" > tbody").append(newRow);
	for( i=1; i< $('#table'+type+' > tbody tr').length; i++){
		$('#table'+type+' > tbody tr:eq('+i+') td:first').text(i);
		$('#table'+type+' > tbody tr:eq('+i+') #'+type+'_num').val(i);
	}
	
	counterEquipBlock++;
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
		newRow += '<input type="button" onclick="deleteTr('+counterMNITypeBlock+', \''+type+'\')" value="Удалить">';
	newRow += '</td>';
	newRow += '</tr>';
	$("#table"+type+" > tbody").append(newRow);
	for( i=1; i< $('#table'+type+' > tbody tr').length; i++){
		$('#table'+type+' > tbody tr:eq('+i+') td:first').text(i);
		$('#table'+type+' > tbody tr:eq('+i+') #'+type+'_num').val(i);
	}
	
	counterMNITypeBlock++;
	
}

function generateMNIType(type){
	var row = '<select  name="MNITYPE['+type+']['+counterMNITypeBlock+'][mnitype]" id="'+type+counterMNITypeBlock+'_mnitype" onchange="generateMNISort(\''+type+'\', \''+counterMNITypeBlock+'\', \''+type+counterMNITypeBlock+'_mnitype\', \'placer'+type+counterMNITypeBlock+'\')"><option value="">';
	<?foreach ($arResult['REFBOOK']['mnitype'] as $item) {
		?>
	row += '<option value="<?=$item['code']?>"><?=$item['name']?>';
		<?
	}?>
	row += '</select>';

	return row;
}

function generateMNISort(type, counter, elementId, placer){
//	alert(type +', '+ counter +' , '+ elementId +' , '+placer);
	var id = $('#'+elementId).val();
	if(id.length == 1){
		var row = '<select  name="MNITYPE['+type+']['+counter+'][mnisort]" id="'+type+counter+'_mnisort"><option value="">';
		switch (id){
			case 'M':
		<?
		$letter = 'M';
		if(is_array($arResult['REFBOOK']['mnisort_ord'][$letter])){
			foreach ($arResult['REFBOOK']['mnisort_ord'][$letter] as $item) {
				?>
			row += '<option value="<?=$item['code']?>"><?=$item['name']?>';
				<?
			}
		}?>
			break;
			case 'H':
		<?
		$letter = 'H';
		if(is_array($arResult['REFBOOK']['mnisort_ord'][$letter])){
			foreach ($arResult['REFBOOK']['mnisort_ord'][$letter] as $item) {
				?>
			row += '<option value="<?=$item['code']?>"><?=$item['name']?>';
				<?
			}
		}?>
			break;
			case 'D':
		<?
		$letter = 'D';
		if(is_array($arResult['REFBOOK']['mnisort_ord'][$letter])){
			foreach ($arResult['REFBOOK']['mnisort_ord'][$letter] as $item) {
				?>
			row += '<option value="<?=$item['code']?>"><?=$item['name']?>';
				<?
			}
		}?>
			break;
			case 'P':
		<?
		$letter = 'P';
		if(is_array($arResult['REFBOOK']['mnisort_ord'][$letter])){
			foreach ($arResult['REFBOOK']['mnisort_ord'][$letter] as $item) {
				?>
			row += '<option value="<?=$item['code']?>"><?=$item['name']?>';
				<?
			}
		}?>
			break;
			case 'B':
		<?
		$letter = 'B';
		if(is_array($arResult['REFBOOK']['mnisort_ord'][$letter])){
			foreach ($arResult['REFBOOK']['mnisort_ord'][$letter] as $item) {
				?>
			row += '<option value="<?=$item['code']?>"><?=$item['name']?>';
				<?
			}
		}?>
			break;
			case 'G':
		<?
		$letter = 'G';
		if(is_array($arResult['REFBOOK']['mnisort_ord'][$letter])){
			foreach ($arResult['REFBOOK']['mnisort_ord'][$letter] as $item) {
				?>
			row += '<option value="<?=$item['code']?>"><?=$item['name']?>';
				<?
			}
		}?>
			break;
			case 'C':
		<?
		$letter = 'C';
		if(is_array($arResult['REFBOOK']['mnisort_ord'][$letter])){
			foreach ($arResult['REFBOOK']['mnisort_ord'][$letter] as $item) {
				?>
			row += '<option value="<?=$item['code']?>"><?=$item['name']?>';
				<?
			}
		}?>
			break;
			case 'I':
		<?
		$letter = 'I';
		if(is_array($arResult['REFBOOK']['mnisort_ord'][$letter])){
			foreach ($arResult['REFBOOK']['mnisort_ord'][$letter] as $item) {
				?>
			row += '<option value="<?=$item['code']?>"><?=$item['name']?>';
				<?
			}
		}?>
			break;
			case 'L':
		<?
		$letter = 'L';
		if(is_array($arResult['REFBOOK']['mnisort_ord'][$letter])){
			foreach ($arResult['REFBOOK']['mnisort_ord'][$letter] as $item) {
				?>
			row += '<option value="<?=$item['code']?>"><?=$item['name']?>';
				<?
			}
		}?>
			break;
			case 'S':
		<?
		$letter = 'S';
		if(is_array($arResult['REFBOOK']['mnisort_ord'][$letter])){
			foreach ($arResult['REFBOOK']['mnisort_ord'][$letter] as $item) {
				?>
			row += '<option value="<?=$item['code']?>"><?=$item['name']?>';
				<?
			}
		}?>
			break;
			case 'F':
		<?
		$letter = 'F';
		if(is_array($arResult['REFBOOK']['mnisort_ord'][$letter])){
			foreach ($arResult['REFBOOK']['mnisort_ord'][$letter] as $item) {
				?>
			row += '<option value="<?=$item['code']?>"><?=$item['name']?>';
				<?
			}
		}?>
			break;
			
		}		
		row += '</select>';
		$('#'+placer).empty();
		$('#'+placer).append(row);
		
		return false;
		}
}

function generateMNIUnit(type){
	var row = '<select  name="MNITYPE['+type+']['+counterMNITypeBlock+'][mniunit]" id="'+type+counterMNITypeBlock+'_mniunit"><option value="">';
	row += '<option value="2">Вертикальное зондирование';
	row += '<option value="13">Визуальные наблюдения';
	row += '<option value="8">Геологический образец';
	row += '<option value="17">Документ (отчет,карточка,сводка,сообщение...)';
	row += '<option value="12">Инструментальная запись';
	row += '<option value="14">Инструментальное измерение';
	row += '<option value="11">Кадр, снимок, изображение';
	row += '<option value="16">Карта,схема';
	row += '<option value="20">Керн';
	row += '<option value="9">Километр';
	row += '<option value="10">Миля';
	row += '<option value="1">Океанографическая станция';
	row += '<option value="6">Определение';
	row += '<option value="5">Проба';
	row += '<option value="3">Разрез';
	row += '<option value="23">Респондент';
	row += '<option value="4">Серия измерений в точке';
	row += '<option value="19">Скважина';
	row += '<option value="21">Спил';
	row += '<option value="7">Траление';
	row += '<option value="22">Час';
	row += '<option value="18">Шурф';
	row += '<option value="15">Экземпляр';
	row += '</select>';

	return row;
}

function showCommentField(value){
	$('#reclaimFile').hide();
	if(value == 11){
		$('#reclaimFile').show();
	}
}

function checkRequiredFields(){
	document.applicationForm.submit()
	return true;
}

<?=(!empty($message) ? "$(document).ready(function(){ alert('{$message}'); });" : '')?>
// END

	$(function(){
		//hover states on the static widgets
		$('#dialog_link, ul#icons li').hover(
			function() { $(this).addClass('ui-state-hover'); },
			function() { $(this).removeClass('ui-state-hover'); }
		);
		
	});
	
	function dpFormatValue(elem){
		var substr = elem.value.split('/');
		elem.value = substr[2]+'-'+substr[0]+'-'+substr[1];
		return true;
	}
</script>

<? if(!empty($arResult['REPORT_FILE']['NAME'])){
		if(is_file($_SERVER['DOCUMENT_ROOT'].$arResult['REPORT_FILE']['PATH'])){
			?>

<div class="modal hide" id="myModal">
  <div class="modal-header">
    <h3>Сохранить заявку</h3>
  </div>
  <div class="modal-body">
<!--  	<p>Уважаемый, пользователь <?=$USER->getUserName()?></p>-->
  	<p>Файл заявки сохранен в формате DOCX и упакован в архив ZIP</p>
    <p><a href="<?=$arResult['REPORT_FILE']['PATH']?>"><b>Скачать файл в архиве</b></a> </p>
  </div>
  <div class="modal-footer">
    <a href="#" class="btn" data-dismiss="modal">Закрыть</a>
  </div>
</div>
<script>$('#myModal').modal("show");</script>
			<?
		}
}
?>

<br>
<div class="section">
  <div class="tabs"">
    <span class="current">Организации</span>
    <span>Транспорт</span>
    <span>Маршрут</span>
    <span>Программа</span>
    <span>Технические средства</span>
    <span>Другое</span>
  </div>
    <span style="padding-left: 30px;"></span>
    <input type="button" class="btn" name="submit" value="Сохранить изменения" onclick="checkRequiredFields()"> 
    <span style="padding-left: 30px;"></span>
    <input type="button" class="btn" name="submit" value="Сохранить в файл" onclick="window.location.href='<?=$arResult['BASE_URL'].'&print=1'?>'"> 
<br>

<!---------------------- ORGANIZATIONS --------------------------------->

  <div class="box visible">
		<? include_once('inc.appllicant.php')?>
<br>
<br>
		<? include_once('inc.executor.php')?>
<br>
<br>
		<? include_once('inc.participant.php')?>
<br>
<br>


  </div>

<!---------------------- TRANSPORT ------------------------------------->

  <div class="box">
		<? include_once('inc.transport.php')?>
  </div>

<!---------------------- ROOT ------------------------------------------>

  <div class="box ">
  	<? include_once('inc.root.php')?>
  </div>

<!---------------------- PROGRAM --------------------------------------->

  <div class="box ">
  	<? include_once('inc.prog.php')?>
  </div>

<!---------------------- DEVICES AND EQUIPMENT ------------------------->

  <div class="box ">
  	<? include_once('inc.tech.php')?>
  </div>

<!---------------------- OTHER ---------------------------------------->

<!---------------------- FORM ------------------------------------------>

<form name="applicationForm" method="POST" action="<?=$_SERVER['REQUEST_URI']?>" enctype="multipart/form-data">
<input type="hidden" name="eid" value="<?=$arResult['EXPEDITION']['id']?>">
<input type="hidden" name="act" value="<?=$act?>">

  <div class="box">
	  <? include_once('inc.other.php')?>
  </div>
</div><!-- .section -->

</form>

<!---------------------- \ FORM ---------------------------------------->
