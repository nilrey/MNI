<script>
// VARIABLES
counterShipBlock = <?=(count($arResult['TRANSPORT'])+2)?>;
counterParticipBlock = <?=count($arResult['PARTICIPANT'])?>;
counterShipRootBlock = <?=count($arResult['COORDS']['shiproot'])+1?>;
counterPortsBlock = <?=count($arResult['PORTS']['ports'])+1?>;
counterMNITypeBlock = <?=count($arResult['MNITYPE'])+1?>;
server_host = '<?=$_SERVER["HTTP_HOST"]?>';

var cMaxDate = '<?=$arResult['EXPEDITION']['date_end']?>';
var cMinDate = '<?=$arResult['EXPEDITION']['date_start']?>';

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

function getOrgByMniType(idLetter){
	switch (idLetter){
<?
		$strOrgs = '';
		if(!empty($arResult['REFBOOK']['mnitypeGroups'] )){
			foreach (array('M', 'H', 'D', 'P', 'B', 'G', 'C', 'I', 'L', 'S', 'F') as $letter){
				$strOrgs = '';
				echo "\t\tcase '{$letter}':";
				foreach ($arResult['REFBOOK']['mnitypeGroups'][$letter] as $item) {
					$strOrgs .= ",'{$item['name']}'";
				}
				echo "\n\t\t\tvar arOrgs = [".substr($strOrgs, 1)."];";
				echo "\n\t\tbreak;";
			}
		}?>

		default:
			var arOrgs = [];
		break;
	}
	return arOrgs;
}

function setValueToUseResult(){
	$('#exp_use_result').empty();
	var tmpValue = '';
	$('#tablemnitypes > tbody tr').each( function(){
		tmpValue = $(this).find('[id$=_mnitype]');
		if(tmpValue.length > 0){
			var arOrgs = getOrgByMniType(tmpValue.val()) ;
				for(var i = 0; i< arOrgs.length; i++){
					var strValue = $('#exp_use_result').val();
					if (strValue.indexOf(arOrgs[i]) == -1 ){
						$('#exp_use_result').append(arOrgs[i]+'\n');
					}
				}
		}
	});
	return true;
}

function generateMNISort(type, counter, elementId, placer){
//	alert(type +', '+ counter +' , '+ elementId +' , '+placer);
	setValueToUseResult();
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
	<?foreach ($arResult['REFBOOK']['mniunit'] as $item) {
		?>
	row += '<option value="<?=$item['id']?>"><?=$item['name']?>';
		<?
	}?>
	row += '</select>';

	return row;
}
// END

$(function(){
	//hover states on the static widgets
	$('#dialog_link, ul#icons li').hover(
		function() { $(this).addClass('ui-state-hover'); },
		function() { $(this).removeClass('ui-state-hover'); }
	);

});

function checkAppForm(){
	$result = true;
	tab = 0;
	id = 'applicant_fullname';
	if( !checkRequiredField(tab, id ) && $result ){ $result = false; selectRequiredField(tab, id); }

	tab = 2;
	id = 'date_start';
	if( !checkRequiredField(tab, id) && $result ){ $result = false; selectRequiredField(tab, id); }
	id = 'date_end';
	if( !checkRequiredField(tab, id) && $result ){ $result = false; selectRequiredField(tab, id); }

	tab = 3;
	id = 'mni_name';
	if( !checkRequiredField(tab, id) && $result ){ $result = false; selectRequiredField(tab, id); }
	id = 'mni_aim';
	if( !checkRequiredField(tab, id) && $result ){ $result = false; selectRequiredField(tab, id); }

	if($("#statusExpedition").val() == 10 || $("#statusExpedition").val() == 12){

		tab = 0;
		id = 'applicant_country';
		if( !checkRequiredField(tab, id ) && $result ){ $result = false; selectRequiredField(tab, id); }
		id = 'applicant_city';
		if( !checkRequiredField(tab, id) && $result ){ $result = false; selectRequiredField(tab, id); }
		id = 'applicant_legaladdress';
		if( !checkRequiredField(tab, id) && $result ){ $result = false; selectRequiredField(tab, id); }
		id = 'applicant_phone';
		if( !checkRequiredField(tab, id) && $result ){ $result = false; selectRequiredField(tab, id); }
		id = 'applicant_email';
		if( !checkRequiredField(tab, id) && $result ){ $result = false; selectRequiredField(tab, id); }

		if($('#isExecutor')[0].checked == true){
			id = 'executant_fullname';
			if( !checkRequiredField(tab, id ) && $result ){ $result = false; selectRequiredField(tab, id); }
			id = 'executant_country';
			if( !checkRequiredField(tab, id ) && $result ){ $result = false; selectRequiredField(tab, id); }
			id = 'executant_legaladdress';
			if( !checkRequiredField(tab, id ) && $result ){ $result = false; selectRequiredField(tab, id); }
			id = 'executant_phone';
			if( !checkRequiredField(tab, id ) && $result ){ $result = false; selectRequiredField(tab, id); }
			id = 'executant_email';
			if( !checkRequiredField(tab, id ) && $result ){ $result = false; selectRequiredField(tab, id); }

		}

		checkAppDynBlockParticipant();

		tab = 1;
		checkAppDynBlockTransport();

		tab = 2;
		id = 'tablemniregion';
		if( !checkRequiredTable(tab, id) && $result ){ $result = false; selectRequiredField(tab, id); }
		id = 'tablemniroot';
		if( !checkRequiredTable(tab, id) && $result ){ $result = false; selectRequiredField(tab, id); }

		tab = 3;
		id = 'tablemnitypes';
		if( !checkRequiredTable(tab, id) && $result ){ $result = false; selectRequiredField(tab, id); }
		id = 'mni_spec';
		if( !checkRequiredField(tab, id) && $result ){ $result = false; selectRequiredField(tab, id); }

		tab = 4;
		checkAppDynBlockEquipment();

		tab = 5;
		id = 'exp_ecology';
		if( !checkRequiredField(tab, id) && $result ){ $result = false; selectRequiredField(tab, id); }
		id = 'exp_particip_rf';
		if( !checkRequiredField(tab, id) && $result ){ $result = false; selectRequiredField(tab, id); }
		id = 'exp_use_result';
		if( !checkRequiredField(tab, id) && $result ){ $result = false; selectRequiredField(tab, id); }

	}else if ($("#statusExpedition").val() == '13'){
		 if( ! confirm("Запрос будет заблокирован для дальнейшего редактирования.\nВы действительно хотите отменить данный запрос?") ){
		 	return false;
		 }
	}
	if($result){
		document.applicationForm.submit();
	}
}

function checkAppDynBlockEquipment(){
	$('div[id^=blockEquip]').each(
		function(index, value){
			tab = 4;
					id = getDynnamicFieldId(this, 'equip_basic');
					if( !checkRequiredField(tab, id) && $result ){ $result = false; selectRequiredField(tab, id); }
					id = getDynnamicFieldId(this, 'equip_infotype');
					if( !checkRequiredField(tab, id) && $result ){ $result = false; selectRequiredField(tab, id); }
					id = getDynnamicFieldId(this, 'equipowner');
					if( !checkRequiredField(tab, id) && $result ){ $result = false; selectRequiredField(tab, id); }
					id = getDynnamicFieldId(this, 'equipowner_country');
					if( !checkRequiredField(tab, id) && $result ){ $result = false; selectRequiredField(tab, id); }
					id = getDynnamicFieldId(this, 'equipowner_city');
					if( !checkRequiredField(tab, id) && $result ){ $result = false; selectRequiredField(tab, id); }
					id = getDynnamicFieldId(this, 'equipowner_legaladdress');
					if( !checkRequiredField(tab, id) && $result ){ $result = false; selectRequiredField(tab, id); }

			}
		)
}


function checkAppDynBlockParticipant(){
//	alert($('div[id^=blockParticip]').find('input[id^=ab]').val() );

//	var cnt = $('div[id^=blockParticip]').size() ;

	$('div[id^=blockParticip]').each(
		function(index, value){
			tab = 0;

			 curBlockId = $(this).attr("id");
			 selTypeId = curBlockId.replace('blockParticip', 'rdChooseParticipant');
			 selTypeVal = $('#'+selTypeId+':checked').val();
			 if(selTypeVal > 0){
				 if( selTypeVal == '1'){
					id = getDynnamicFieldId(this, 'participant_fullname');
					if( !checkRequiredField(tab, id) && $result ){ $result = false; selectRequiredField(tab, id); }
					id = getDynnamicFieldId(this, 'participant_country');
					if( !checkRequiredField(tab, id) && $result ){ $result = false; selectRequiredField(tab, id); }
					id = getDynnamicFieldId(this, 'participant_city');
					if( !checkRequiredField(tab, id) && $result ){ $result = false; selectRequiredField(tab, id); }
					id = getDynnamicFieldId(this, 'participant_legaladdress');
					if( !checkRequiredField(tab, id) && $result ){ $result = false; selectRequiredField(tab, id); }
					id = getDynnamicFieldId(this, 'participant_phone');
					if( !checkRequiredField(tab, id) && $result ){ $result = false; selectRequiredField(tab, id); }
					id = getDynnamicFieldId(this, 'participant_email');
					if( !checkRequiredField(tab, id) && $result ){ $result = false; selectRequiredField(tab, id); }
			 	}else if(selTypeVal == '2'){
					id = getDynnamicFieldId(this, 'participant_fio');
					if( !checkRequiredField(tab, id) && $result ){ $result = false; selectRequiredField(tab, id); }
					id = getDynnamicFieldId(this, 'participant_sitizen');
					if( !checkRequiredField(tab, id) && $result ){ $result = false; selectRequiredField(tab, id); }
					id = getDynnamicFieldId(this, 'participant_workaddress');
					if( !checkRequiredField(tab, id) && $result ){ $result = false; selectRequiredField(tab, id); }
					id = getDynnamicFieldId(this, 'participant_activity');
					if( !checkRequiredField(tab, id) && $result ){ $result = false; selectRequiredField(tab, id); }
			 }
			}
		}
	);
}

function checkAppDynBlockTransport(){

//	alert($('[id^=selTransport1]').val());

//alert($('div[id^=descTransport]').size());
	$('div[id^=descTransport]').each(
		function(index, value){
			tab = 1;

			 curBlockId = $(this).attr("id");
			 selTypeId = curBlockId.replace('descTransport', 'selTransport');
			 selTypeVal = $('#'+selTypeId).val();
			 if(selTypeVal != 0){
			 if( selTypeVal == 'ship'){

				id = getDynnamicFieldId(this, 'shipname__');
				if( !checkRequiredField(tab, id) && $result ){ $result = false; selectRequiredField(tab, id); }
				id = getDynnamicFieldId(this, 'nation__');
				if( !checkRequiredField(tab, id) && $result ){ $result = false; selectRequiredField(tab, id); }
				id = getDynnamicFieldId(this, 'shipowner__');
				if( !checkRequiredField(tab, id) && $result ){ $result = false; selectRequiredField(tab, id); }
				id = getDynnamicFieldId(this, 'shipowner_country__');
				if( !checkRequiredField(tab, id) && $result ){ $result = false; selectRequiredField(tab, id); }
				id = getDynnamicFieldId(this, 'shipowner_city__');
				if( !checkRequiredField(tab, id) && $result ){ $result = false; selectRequiredField(tab, id); }
				id = getDynnamicFieldId(this, 'shipowner_legaladdress__');
				if( !checkRequiredField(tab, id) && $result ){ $result = false; selectRequiredField(tab, id); }
				id = getDynnamicFieldId(this, 'shipowner_phone__');
				if( !checkRequiredField(tab, id) && $result ){ $result = false; selectRequiredField(tab, id); }
				id = getDynnamicFieldId(this, 'shipowner_email__');
				if( !checkRequiredField(tab, id) && $result ){ $result = false; selectRequiredField(tab, id); }
				id = getDynnamicFieldId(this, 'homeport__');
				if( !checkRequiredField(tab, id) && $result ){ $result = false; selectRequiredField(tab, id); }
				id = getDynnamicFieldId(this, 'func__');
				if( !checkRequiredField(tab, id) && $result ){ $result = false; selectRequiredField(tab, id); }
				id = getDynnamicFieldId(this, 'length__');
				if( !checkRequiredField(tab, id) && $result ){ $result = false; selectRequiredField(tab, id); }
				id = getDynnamicFieldId(this, 'width__');
				if( !checkRequiredField(tab, id) && $result ){ $result = false; selectRequiredField(tab, id); }
				id = getDynnamicFieldId(this, 'draught__');
				if( !checkRequiredField(tab, id) && $result ){ $result = false; selectRequiredField(tab, id); }
				id = getDynnamicFieldId(this, 'seaworth__');
				if( !checkRequiredField(tab, id) && $result ){ $result = false; selectRequiredField(tab, id); }
				id = getDynnamicFieldId(this, 'displace__');
				if( !checkRequiredField(tab, id) && $result ){ $result = false; selectRequiredField(tab, id); }
				id = getDynnamicFieldId(this, 'generator__');
				if( !checkRequiredField(tab, id) && $result ){ $result = false; selectRequiredField(tab, id); }
				id = getDynnamicFieldId(this, 'rdfreq__');
				if( !checkRequiredField(tab, id) && $result ){ $result = false; selectRequiredField(tab, id); }
				id = getDynnamicFieldId(this, 'rdsign__');
				if( !checkRequiredField(tab, id) && $result ){ $result = false; selectRequiredField(tab, id); }
			 }else if(selTypeVal == 'other'){
				id = getDynnamicFieldId(this, 'transport_name__');
				if( !checkRequiredField(tab, id) && $result ){ $result = false; selectRequiredField(tab, id); }
			 }
			id = getDynnamicFieldId(this, 'capt__');
			if( !checkRequiredField(tab, id) && $result ){ $result = false; selectRequiredField(tab, id); }
			id = getDynnamicFieldId(this, 'crew__');
			if( !checkRequiredField(tab, id) && $result ){ $result = false; selectRequiredField(tab, id); }
			id = getDynnamicFieldId(this, 'researchers__');
			if( !checkRequiredField(tab, id) && $result ){ $result = false; selectRequiredField(tab, id); }
			id = getDynnamicFieldId(this, 'head__');
			if( !checkRequiredField(tab, id) && $result ){ $result = false; selectRequiredField(tab, id); }
			 }
		}
	);
}

function getDynnamicFieldId(parent, id){
	return $(parent).find('[id^='+id+']').attr("id");
}

function selectRequiredField(tab, id){
	prefix = 'req_';
	setCurrentTab(tab)
//	alert(id);
	markRequiredField(prefix+id);
	$('#requiredFieldsErrorMessage').fadeIn(150) ;
	$(document).scrollTo( $("#req_"+id), 700);
}

function checkRequiredField(tab, id){
	unmarkRequiredField('req_'+id);
	if ( $.trim($('#'+id).val()).length == 0 ){
		return false;
	}
	return true;
}

function checkIfRequiredField(tab, id){
	unmarkRequiredField('req_'+id);
	if ( $(":radio[name=rd_"+id+"]" ).filter(":checked").val() == 2 ) {
		if( !checkRequiredField(tab, id) ){
			return false;
		}
	}else{
		$('#'+id).val('');
	}
	return true;
}

function checkRequiredTable(tab, id){
	unmarkRequiredField('req_'+id);
	if ( $('#'+id+'  tr').length == 1 ){
		return false;
	}
	return true;
}

function markRequiredField(name){
	$('#'+name).addClass('reqFieldError');
}
function unmarkRequiredField(name){
	$('#'+name).removeClass('reqFieldError');
}

function checkIsExecutor(name, block){
	if($('#'+name)[0].checked ==true){
		$('#'+name)[0].checked = false;
	}else{
		$('#'+name)[0].checked = true;
	}
	showExecutorBlock(name, block);
}

function showExecutorBlock(name, block){
	element = $('#'+name)[0];
	if(element.checked){
		$('#'+block).fadeIn(150) ;
		showAddToButton( block, element.checked );
	}else{
		$('#'+block).fadeOut(150) ;
		showAddToButton( block, element.checked );
	}
}

function showAddToButton(block, show){
	if ($("#addTo_"+block).length > 0){
		if(show){
			$("#addTo_"+block).fadeIn(150) ;
		}else{
			$("#addTo_"+block).fadeOut(150) ;
		}
	}
}

function showMessage(message){
	setTimeout('alert("'+message+'")', 700);
}


$(document).ready( function() {
	$('#date_start').datepick({ onSelect: customRange, maxDate: '<?=$arResult['EXPEDITION']['date_end']?>', minDate: '<?=(date("Y")+1)?>-01-01', showTrigger: '#calImg'});
	$('#date_end').datepick({ onSelect: customRange, minDate: '<?=$arResult['EXPEDITION']['date_start']?>', maxDate: '<?=(date("Y")+1)?>-12-31', showTrigger: '#calImg'});
});

function customRange(dates) {
    if (this.id == 'date_start') {
        $('#date_end').datepick('option', 'minDate', dates[0] || null);
    }
    else {
        $('#date_start').datepick('option', 'maxDate', dates[0] || null);
    }
}

function getCountries(){
	var countries = new Array();
<?
if(!empty($arResult['REFBOOK']['countries']) && count($arResult['REFBOOK']['countries']) > 0 ){
	foreach ($arResult['REFBOOK']['countries'] as $arCountry) {
//echo "<option value='{$arCountry['id']}'>{$arCountry['name']}\n";
echo "countries[{$arCountry['id']}] = \"{$arCountry['name']}\";\n";
	}
}
?>
	return countries;
}

function gotoEndDate(){
	endDate = '#req_date_end';
	setCurrentTab(2);
	$(endDate).addClass('reqFieldHighlight');
	$(document).scrollTo( $(endDate), 700);
}

function confirmDelete(){
	 if( confirm('Удалить строку?') ){
	 	return true;
	 }
	 return false;
}
function confirmDeleteRecord(){
	 if( confirm('Удалить запись?') ){
	 	return true;
	 }
	 return false;
}

</script>
