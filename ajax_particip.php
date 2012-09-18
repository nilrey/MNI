<?php session_start();

if(empty($_SESSION['CUSER']['SECURE_HASH'])){
	die();
}

include_once('config.php');
include_once('libs/classes/mysql.class.php');
include_once('libs/functions/hdDatabase.php');
include_once('libs/functions/support.php');
include_once('libs/functions/htmlWrapper.php');
header('Content-Type: text/html; charset=utf-8');
//header("Cache-Control: no-cache");
$CONF = new Config();
$DB = new clMySQLi($CONF->mysqlHost, $CONF->mysqlUser, $CONF->mysqlPass, $CONF->mysqlDb);
$DB->set_charset("utf8");
$fields = '';
$arCountries = getReferenceBook('countries');
$arOrgParticip = getReferenceBook('org_particip', 'id');
if(!empty($_REQUEST['action'])){

	$counter = intval($_REQUEST['counter']);

	if ($_REQUEST['action'] == 'getParticip'){

		$countriesList = '';
		foreach ($arCountries as $country){
			$countriesList .= "<option value='{$country['id']}'>{$country['name']}";
		}
		$selectOrgParticip = htmlWrapper::getSelectSimple($arOrgParticip, "PARTICIPANT_NEW[{$counter}][org_particip]", "participant_org_particip{$counter}", 'onchange="if(this.value==8){$(\'#block_participant_org_particip_oth'.$counter.'\').fadeIn(150)}else{$(\'#block_participant_org_particip_oth'.$counter.'\').fadeOut(150); $(\'#participant_org_particip_oth'.$counter.'\').val(\'\');}"', 0);

			$fields =
"
<br>

		<!--	<p class=\"subtitle\">Участник № {$counter}</p> -->
			<div class=\"border2px\">
			<input type=\"radio\" name=\"PARTICIPANT_NEW[{$counter}][type]\" id=\"rdChooseParticipant{$counter}\" value=\"1\" onchange=\"if(this.value == 1) {document.getElementById('participantOfficial{$counter}').style.display = 'block'; document.getElementById('participantPerson{$counter}').style.display = 'none'; } \"  onclick=\"if(this.value == 1) {document.getElementById('participantOfficial{$counter}').style.display = 'block'; document.getElementById('participantPerson{$counter}').style.display = 'none'; } \" checked>Юридическое
			<input type=\"radio\" name=\"PARTICIPANT_NEW[{$counter}][type]\" id=\"rdChooseParticipant{$counter}\" value=\"2\" onchange=\"if(this.value == 2) {document.getElementById('participantOfficial{$counter}').style.display = 'none'; document.getElementById('participantPerson{$counter}').style.display = 'block'; } \" onclick=\"if(this.value == 2) {document.getElementById('participantOfficial{$counter}').style.display = 'none'; document.getElementById('participantPerson{$counter}').style.display = 'block'; } \">Физическое лицо
<br>
<br>
			<div id=\"participantOfficial{$counter}\">
			<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" class=\"tab\">
				<tr class='trHighLighted'>
					<td>".requiredTitle('Официальное название', 'participant_fullname'.$counter).":</td><td>
					<input type=\"text\" class=\"input_text\" size=\"150\" name=\"PARTICIPANT_NEW[{$counter}][fullname]\" id=\"participant_fullname{$counter}\" value=\"\">
					</td>
				</tr>
				<tr class='trHighLighted'>
					<td>".requiredTitle('Государство', 'participant_country'.$counter).":</td><td>
					<select class=\"input_text\"  name=\"PARTICIPANT_NEW[{$counter}][country]\" id=\"participant_country{$counter}\">
						<option value=\"\">
						{$countriesList}
					</select>
					</td>
				</tr>
				<tr class='trHighLighted'>
					<td>".requiredTitle('Город', 'participant_city'.$counter).":</td><td><input type=\"text\" size=\"70\" class=\"input_text\" name=\"PARTICIPANT_NEW[{$counter}][city]\" id=\"participant_city{$counter}\" value=\"\" size='70'></td>
				</tr>
				<tr class='trHighLighted'>
					<td>".requiredTitle('Юридический адрес', 'participant_legaladdress'.$counter).":</td><td><TEXTAREA COLS=\"40\" ROWS=\"4\" class=\"input_text\" name=\"PARTICIPANT_NEW[{$counter}][legaladdress]\" id=\"participant_legaladdress{$counter}\"></TEXTAREA></td>
				</tr>
				<tr class='trHighLighted'>
					<td>".requiredTitle('Телефон', 'participant_phone'.$counter).":</td><td><input type=\"text\" class=\"input_text\" name=\"PARTICIPANT_NEW[{$counter}][phone]\" id=\"participant_phone{$counter}\" value=\"\" size='70'></td>
				</tr>
				<tr class='trHighLighted'>
					<td>Телефакс:</td><td><input type=\"text\" class=\"input_text\" name=\"PARTICIPANT_NEW[{$counter}][fax]\" id=\"participant_fax{$counter}\" value=\"\" size='70'></td>
				</tr>
				<tr class='trHighLighted'>
					<td>Телекс:</td><td><input type=\"text\" class=\"input_text\" name=\"PARTICIPANT_NEW[{$counter}][telex]\" id=\"participant_telex{$counter}\" value=\"\" size='70'></td>
				</tr>
				<tr class='trHighLighted'>
					<td>".requiredTitle('E-mail', 'participant_email'.$counter).":</td><td><input type=\"text\" class=\"input_text\" name=\"PARTICIPANT_NEW[{$counter}][email]\" id=\"participant_email{$counter}\" value=\"\" size='70'></td>
				</tr>
				<tr class='trHighLighted'>
					<td>Skype:</td><td><input type=\"text\" class=\"input_text\" name=\"PARTICIPANT_NEW[{$counter}][skype]\" id=\"participant_skype{$counter}\" value=\"{$arItem['skype']}\" size='70'></td>
				</tr>
				<tr class='trHighLighted'>
					<td>Форма участия организации:</td><td>".$selectOrgParticip."
					<div id='block_participant_org_particip_oth{$counter}' style='display: none'>
					<input type=\"text\" class=\"input_text\" name=\"PARTICIPANT_NEW[{$counter}][org_particip_oth]\" id=\"participant_org_particip_oth{$counter}\" value=\"\" size='70'>
					</div>
					</td>
				</tr>
				<tr class='trHighLighted'>
					<td>Количество представителей:</td><td><input type=\"text\" class=\"input_text\" name=\"PARTICIPANT_NEW[{$counter}][org_particip_ammount]\" id=\"participant_org_particip_ammount{$counter}\" value=\"\"></td>
				</tr>
				<tr class='trHighLighted'>
					<td>Форма участия представителей:</td><td>
					<input type=\"text\" class=\"input_text\" name=\"PARTICIPANT_NEW[{$counter}][org_particip_type_oth]\" id=\"participant_org_particip_type_oth{$counter}\" value=\"\" size='70'></td>
				</tr>
			</table>
			</div>
			<div id=\"participantPerson{$counter}\" style=\"display: none\">
			<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" class=\"tab\">
				<tr class='trHighLighted'>
					<td>".requiredTitle('Фамилия Имя Отчество', 'participant_fio'.$counter).":</td><td>
					<input type=\"text\" class=\"input_text\" size=\"70\" name=\"PARTICIPANT_NEW[{$counter}][fio]\" id=\"participant_fio{$counter}\" value=\"\">
					</td>
				</tr>
				<tr class='trHighLighted'>
					<td>".requiredTitle('Гражданство', 'participant_sitizen'.$counter).":</td><td>
					<select class=\"input_text\"  name=\"PARTICIPANT_NEW[{$counter}][sitizen]\" id=\"participant_sitizen{$counter}\">
						<option value=\"\">
						{$countriesList}
					</select>
					</td>
				</tr>
				<tr class='trHighLighted'>
					<td>".requiredTitle('Место работы', 'participant_workaddress'.$counter).":</td><td><TEXTAREA COLS=\"40\" ROWS=\"4\" class=\"input_text\" name=\"PARTICIPANT_NEW[{$counter}][workaddress]\" id=\"participant_workaddress{$counter}\"></TEXTAREA></td>
				</tr>
				<tr class='trHighLighted'>
					<td>".requiredTitle('Форма участия', 'participant_activity'.$counter).":</td><td><input type=\"text\" class=\"input_text\" name=\"PARTICIPANT_NEW[{$counter}][particip]\" id=\"participant_activity{$counter}\" value=\"\"></td>
				</tr>
			</table>
			</div> <!-- \ executerPerson -->
			<input type=\"button\" id=\"delParticip{$counter}\" onclick=\" if(confirmDeleteRecord()) deleteParticipBlock({$counter})\" value=\"Удалить участника\">
			</div> <!-- \ border2px -->

<script type=\"text/javascript\">
	$(document).ready(function(){
	// --- Автозаполнение ---

	$(\"#participant_fullname{$counter}\").autocomplete(\"/ajax_particip.php\", {
		delay:10,
		minChars:2,
		matchSubset:1,
		autoFill:false,
		matchContains:1,
		cacheLength:10,
		selectFirst:true,
		formatItem:liFormat,
		maxItemsToShow:10,
		onItemSelect:selectItem,
		action:'getParticipName',
		Counter:'{$counter}'
			});
	});
</script>

<br>
<br>";

		$arResult['fields'] = $fields;
		$arResult['request'] = $_REQUEST;
	}elseif ($_REQUEST['action'] == 'getParticipName'  ){
		if(empty($_REQUEST['counter'])) $_REQUEST['counter'] = 0;
		$src = htmlspecialchars($_REQUEST['q']);
		$query = "SELECT * FROM  mon_rb_organizations WHERE name like '%{$src}%' OR name_eng like '%{$src}%'  OR short_name like '%{$src}%'  OR short_name_eng like '%{$src}%' ";
		$resource = $DB->getRecordsAssoc($query);
		foreach ($resource as $arr){
			//echo $arr['name'].'<br>';
			print $arr['name']."|".$arr['id']."|".$_REQUEST['counter']."|".$arr['short_name']."|".$arr['address']."|".$arr['city']."|".$arr['country']."|".$arr['phone']."|".$arr['fax']."|".$arr['email'].PHP_EOL;
		}
//$fields = 'test|test|test|test'.PHP_EOL.'test2|test2|test2|test2'.PHP_EOL; //."{$query}|{$query}|{$query}|{$query}".PHP_EOL;
//print $fields;
die();
		$arResult['fields'] = $fields;
	}else	if ($_REQUEST['action'] == 'deleteParticip' && !empty($_REQUEST['elementId']) && intval($_REQUEST['elementId']) > 0){

		// проверить права на экспедицию

		if(intval($_REQUEST['type']) === 1){
			$query = 'DELETE FROM  mon_exp_org WHERE id='.intval($_REQUEST['elementId']);
		}elseif (intval($_REQUEST['type']) === 2){
			$query = 'DELETE FROM  mon_exp_pers WHERE id='.intval($_REQUEST['elementId']);
		}
		$arResult = $DB->setRecord($query);
		$arResult['query'] = $query;
	}

}


ECHO json_encode($arResult);

die();
?>
