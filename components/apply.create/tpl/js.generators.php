<?/*
<script>

// --------------------------------------------------- JS CODE GENERATORS ---------------------------------------------------------------------

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
	var separator = '\n';
	var exp_use_result = $('#exp_use_result');
	if($.browser.msie){
		separator = '\n\r';
	}
	var tmpValue = '';
	var preText = 'Список организаций получающих обязательный экземпляр отчета:'+separator;

	exp_use_result.empty();
	if($('#tablemnitypes > tbody tr').length > 1){
		exp_use_result.append(preText);
	}

	$('#tablemnitypes > tbody tr').each( function(){
		tmpValue = $(this).find('[id$=_mnitype]');
		if(tmpValue.length > 0){
			var arOrgs = getOrgByMniType(tmpValue.val()) ;
			for(var i = 0; i< arOrgs.length; i++){
				var strValue = $('#exp_use_result').val();
				if (strValue.indexOf(arOrgs[i]) == -1 ){
					exp_use_result.append(arOrgs[i]+separator);
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

$(function(){
	//hover states on the static widgets
	$('#dialog_link, ul#icons li').hover(
		function() { $(this).addClass('ui-state-hover'); },
		function() { $(this).removeClass('ui-state-hover'); }
	);

});

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

function getDepartments(){
	var departments = new Array();
<?
if(!empty($arResult['REFBOOK']['departments']) && count($arResult['REFBOOK']['departments']) > 0 ){
	foreach ($arResult['REFBOOK']['departments'] as $arDepartment) {
		echo "departments[{$arDepartment['id']}] = \"{$arDepartment['name']}\";\n";
	}
}
?>
	return countries;
}

// --------------------------------------------------- \ JS CODE GENERATORS ---------------------------------------------------------------------
</script>

*/?>
