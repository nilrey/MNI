<?php session_start();

if(empty($_SESSION['CUSER']['SECURE_HASH'])){
	die();
}

include_once('config.php');
include_once('libs/classes/mysql.class.php');
include_once('libs/functions/hdDatabase.php');
include_once('libs/functions/support.php');
header("Cache-Control: no-cache");
header("Content-Type: text/html; charset=UTF-8");
$CONF = new Config();
$DB = new clMySQLi($CONF->mysqlHost, $CONF->mysqlUser, $CONF->mysqlPass, $CONF->mysqlDb);
$DB->set_charset("utf8");
$fields = '';
$arCountries = getReferenceBook('countries');

if(!empty($_REQUEST['action'])){

	$counter = intval($_REQUEST['counter']);

	if ($_REQUEST['action'] == 'getTransportNew' || $_REQUEST['action'] == 'getTransport'){
		$NEW = '';
		if($_REQUEST['action'] == 'getTransportNew'){
			$NEW = '_NEW';
		}
		$countriesList = '';
		foreach ($arCountries as $country){
			$countriesList .= "<option value='{$country['id']}'>{$country['name']}";
		}

		switch ($_REQUEST['name']){
		case 'other':
			$query = 'SELECT * FROM  mon_rb_planes ' ;
			$fields .= '<tr onmouseover="this.style.background=\'#E6E6FA\'" onmouseout="this.style.background=\'#fff\'"><td>'.requiredTitle('Название', 'transport_name__'.$counter).':</td><td><input type="text" name="TRANSPORT'.$NEW.'['.$counter.'][transport_name]" id="transport_name__'.$counter.'" size="100"></td></tr>';
			$fields .= '<tr onmouseover="this.style.background=\'#E6E6FA\'" onmouseout="this.style.background=\'#fff\'"><td>'.requiredTitle('Капитан', 'capt__'.$counter).':</td><td><input type="text" name="TRANSPORT'.$NEW.'['.$counter.'][capt]" id="capt__'.$counter.'" size="70"></td></tr>';
			$fields .= '<tr onmouseover="this.style.background=\'#E6E6FA\'" onmouseout="this.style.background=\'#fff\'"><td>'.requiredTitle('Команда', 'crew__'.$counter).':</td><td><input type="text" name="TRANSPORT'.$NEW.'['.$counter.'][crew]" id="crew__'.$counter.'"></td></tr>';
			$fields .= '<tr onmouseover="this.style.background=\'#E6E6FA\'" onmouseout="this.style.background=\'#fff\'"><td>'.requiredTitle('Экспедиционный состав', 'researchers__'.$counter).':</td><td><input type="text" name="TRANSPORT'.$NEW.'['.$counter.'][researchers]" id="researchers__'.$counter.'"></td></tr>';
			$fields .= '<tr onmouseover="this.style.background=\'#E6E6FA\'" onmouseout="this.style.background=\'#fff\'"><td>'.requiredTitle('Руководитель морских научных исследований', 'head__'.$counter).':</td><td><input type="text" name="TRANSPORT'.$NEW.'['.$counter.'][head]" id="head__'.$counter.'" size="70"></td></tr>';
			break;
		case 'ship':
			$query = 'SELECT * FROM  mon_rb_ships ';
			$fields .= '<tr onmouseover="this.style.background=\'#E6E6FA\'" onmouseout="this.style.background=\'#fff\'"><td>'.requiredTitle('Название', 'shipname__'.$counter).':</td><td><input type="text" name="TRANSPORT'.$NEW.'['.$counter.'][shipname]" id="shipname__'.$counter.'" size="100"></td></tr>';
			$fields .= '<tr onmouseover="this.style.background=\'#E6E6FA\'" onmouseout="this.style.background=\'#fff\'"><td>'.requiredTitle('Национальность', 'nation__'.$counter).':</td><td><select class=\"input_text\"  name="TRANSPORT'.$NEW.'['.$counter.'][nation]" id="nation__'.$counter.'"><option value=\"\">'.$countriesList.'</select></td></tr>';
			$fields .= '<tr onmouseover="this.style.background=\'#E6E6FA\'" onmouseout="this.style.background=\'#fff\'"><td>'.requiredTitle('Судовладелец', 'shipowner__'.$counter).':</td><td><input type="text" name="TRANSPORT'.$NEW.'['.$counter.'][shipowner]" id="shipowner__'.$counter.'" size="80"></td></tr>';

			$fields .= '<tr onmouseover="this.style.background=\'#E6E6FA\'" onmouseout="this.style.background=\'#fff\'"><td class=\'shiftLeft20\'>'.requiredTitle('Государство', 'shipowner_country__'.$counter).':</td><td>
			<select class=\"input_text\"  name="TRANSPORT'.$NEW.'['.$counter.'][shipowner_country]" id="shipowner_country__'.$counter.'"><option value=\"\">'.$countriesList.'</select></td></tr>';
			$fields .= '<tr onmouseover="this.style.background=\'#E6E6FA\'" onmouseout="this.style.background=\'#fff\'"><td class=\'shiftLeft20\'>'.requiredTitle('Город', 'shipowner_city__'.$counter).':</td><td><input type="text" name="TRANSPORT'.$NEW.'['.$counter.'][shipowner_city]" id="shipowner_city__'.$counter.'"></td></tr>';
			$fields .= '<tr onmouseover="this.style.background=\'#E6E6FA\'" onmouseout="this.style.background=\'#fff\'"><td class=\'shiftLeft20\'>'.requiredTitle('Юридический адрес', 'shipowner_legaladdress__'.$counter).':</td><td><input type="text" name="TRANSPORT'.$NEW.'['.$counter.'][shipowner_legaladdress]" id="shipowner_legaladdress__'.$counter.'"></td></tr>';
			$fields .= '<tr onmouseover="this.style.background=\'#E6E6FA\'" onmouseout="this.style.background=\'#fff\'"><td class=\'shiftLeft20\'>'.requiredTitle('Телефон', 'shipowner_phone__'.$counter).':</td><td><input type="text" name="TRANSPORT'.$NEW.'['.$counter.'][shipowner_phone]" id="shipowner_phone__'.$counter.'" size="70"></td></tr>';
			$fields .= '<tr onmouseover="this.style.background=\'#E6E6FA\'" onmouseout="this.style.background=\'#fff\'"><td class=\'shiftLeft20\'>Телефакс:</td><td><input type="text" name="TRANSPORT'.$NEW.'['.$counter.'][shipowner_fax]" id="shipowner_fax__'.$counter.'" size="70"></td></tr>';
			$fields .= '<tr onmouseover="this.style.background=\'#E6E6FA\'" onmouseout="this.style.background=\'#fff\'"><td class=\'shiftLeft20\'>Телекс:</td><td><input type="text" name="TRANSPORT'.$NEW.'['.$counter.'][shipowner_telex]" id="shipowner_telex__'.$counter.'" size="70"></td></tr>';
			$fields .= '<tr onmouseover="this.style.background=\'#E6E6FA\'" onmouseout="this.style.background=\'#fff\'"><td class=\'shiftLeft20\'>'.requiredTitle('E-mail', 'shipowner_email__'.$counter).':</td><td><input type="text" name="TRANSPORT'.$NEW.'['.$counter.'][shipowner_email]" id="shipowner_email__'.$counter.'" size="70"></td></tr>';
			$fields .= '<tr onmouseover="this.style.background=\'#E6E6FA\'" onmouseout="this.style.background=\'#fff\'"><td>'.requiredTitle('Порт приписки', 'homeport__'.$counter).':</td><td><input type="text" name="TRANSPORT'.$NEW.'['.$counter.'][homeport]" id="homeport__'.$counter.'" size="70"></td></tr>';
			$fields .= '<tr onmouseover="this.style.background=\'#E6E6FA\'" onmouseout="this.style.background=\'#fff\'"><td>'.requiredTitle('Назначение', 'func__'.$counter).':</td><td><input type="text" name="TRANSPORT'.$NEW.'['.$counter.'][func]" id="func__'.$counter.'" size="70"></td></tr>';
			$fields .= '<tr onmouseover="this.style.background=\'#E6E6FA\'" onmouseout="this.style.background=\'#fff\'"><td>'.requiredTitle('Наибольшая длина', 'length__'.$counter).':</td><td><input type="text" name="TRANSPORT'.$NEW.'['.$counter.'][length]" id="length__'.$counter.'"></td></tr>';
			$fields .= '<tr onmouseover="this.style.background=\'#E6E6FA\'" onmouseout="this.style.background=\'#fff\'"><td>'.requiredTitle('Наибольшая ширина', 'width__'.$counter).':</td><td><input type="text" name="TRANSPORT'.$NEW.'['.$counter.'][width]" id="width__'.$counter.'"></td></tr>';
			$fields .= '<tr onmouseover="this.style.background=\'#E6E6FA\'" onmouseout="this.style.background=\'#fff\'"><td>'.requiredTitle('Наибольшая осадка', 'draught__'.$counter).':</td><td><input type="text" name="TRANSPORT'.$NEW.'['.$counter.'][draught]" id="draught__'.$counter.'"></td></tr>';
			$fields .= '<tr onmouseover="this.style.background=\'#E6E6FA\'" onmouseout="this.style.background=\'#fff\'"><td>'.requiredTitle('Мореходность', 'seaworth__'.$counter).':</td><td><input type="text" name="TRANSPORT'.$NEW.'['.$counter.'][seaworth]" id="seaworth__'.$counter.'" size="70"></td></tr>';
			$fields .= '<tr onmouseover="this.style.background=\'#E6E6FA\'" onmouseout="this.style.background=\'#fff\'"><td>'.requiredTitle('Полное водоизмещение', 'displace__'.$counter).':</td><td><input type="text" name="TRANSPORT'.$NEW.'['.$counter.'][displace]" id="displace__'.$counter.'"></td></tr>';
			$fields .= '<tr onmouseover="this.style.background=\'#E6E6FA\'" onmouseout="this.style.background=\'#fff\'"><td>'.requiredTitle('Тип и мощность главной энергетической установки', 'generator__'.$counter).':</td><td><input type="text" name="TRANSPORT'.$NEW.'['.$counter.'][generator]" id="generator__'.$counter.'" size="70"></td></tr>';
			$fields .= '<tr onmouseover="this.style.background=\'#E6E6FA\'" onmouseout="this.style.background=\'#fff\'"><td>'.requiredTitle('Радиочастоты', 'rdfreq__'.$counter).':</td><td><input type="text" name="TRANSPORT'.$NEW.'['.$counter.'][rdfreq]" id="rdfreq__'.$counter.'" size="70"></td></tr>';
			$fields .= '<tr onmouseover="this.style.background=\'#E6E6FA\'" onmouseout="this.style.background=\'#fff\'"><td>'.requiredTitle('Радиопозывные', 'rdsign__'.$counter).':</td><td><input type="text" name="TRANSPORT'.$NEW.'['.$counter.'][rdsign]" id="rdsign__'.$counter.'" size="70"></td></tr>';
			$fields .= '<tr><td  CLASS="head">Экипаж:</td><td  CLASS="head">&nbsp;</td></tr>';
			$fields .= '<tr onmouseover="this.style.background=\'#E6E6FA\'" onmouseout="this.style.background=\'#fff\'"><td>'.requiredTitle('Капитан', 'capt__'.$counter).':</td><td><input type="text" name="TRANSPORT'.$NEW.'['.$counter.'][capt]" id="capt__'.$counter.'" size="70"></td></tr>';
			$fields .= '<tr onmouseover="this.style.background=\'#E6E6FA\'" onmouseout="this.style.background=\'#fff\'"><td>'.requiredTitle('Команда', 'crew__'.$counter).':</td><td><input type="text" name="TRANSPORT'.$NEW.'['.$counter.'][crew]" id="crew__'.$counter.'"></td></tr>';
			$fields .= '<tr onmouseover="this.style.background=\'#E6E6FA\'" onmouseout="this.style.background=\'#fff\'"><td>'.requiredTitle('Экспедиционный состав', 'researchers__'.$counter).':</td><td><input type="text" name="TRANSPORT'.$NEW.'['.$counter.'][researchers]" id="researchers__'.$counter.'"></td></tr>';
			$fields .= '<tr onmouseover="this.style.background=\'#E6E6FA\'" onmouseout="this.style.background=\'#fff\'"><td>'.requiredTitle('Руководитель морских научных исследований', 'head__'.$counter).':</td><td><input type="text" name="TRANSPORT'.$NEW.'['.$counter.'][head]" id="head__'.$counter.'" size="70"></td></tr>';
	}
	if(strlen($fields) > 0){
	$fields = '<div><TABLE CELLSPACING="0" CELLPADDING="0" CLASS="tab" STYLE="border: 1px solid #cdcdcd">'.$fields.'</table></div>';

	if($_REQUEST['name'] === 'ship'){

		$fields .= "
<script type=\"text/javascript\">
	$(document).ready(function(){
	// --- Автозаполнение ---

	$(\"#shipname__{$counter}\").autocomplete(\"/ajax.php\", {
		delay:10,
		minChars:2,
		matchSubset:1,
		autoFill:false,
		matchContains:1,
		cacheLength:10,
		selectFirst:true,
		formatItem:liFormat,
		maxItemsToShow:10,
		onItemSelect:selectItemTransport,
		action:'getShipInfo',
		Counter:'{$counter}'
			});
	});
	$(document).ready(function(){
	// --- Автозаполнение ---

	$(\"#homeport__{$counter}\").autocomplete(\"/ajax.php\", {
		delay:10,
		minChars:2,
		matchSubset:1,
		autoFill:false,
		matchContains:1,
		cacheLength:10,
		selectFirst:true,
		formatItem:liFormat,
		maxItemsToShow:10,
		onItemSelect:selectItemTransportPort,
		action:'getPortsList',
		Counter:'{$counter}'
			});
	});
</script>
<script type=\"text/javascript\">
	$(document).ready(function(){
	// --- Автозаполнение ---

	$(\"#shipowner__{$counter}\").autocomplete(\"/ajax_particip.php\", {
		delay:10,
		minChars:2,
		matchSubset:1,
		autoFill:false,
		matchContains:1,
		cacheLength:10,
		selectFirst:true,
		formatItem:liFormat,
		maxItemsToShow:10,
		onItemSelect:selectItemShipowner,
		action:'getParticipName',
		Counter:'{$counter}'
			});
	});
</script>";
	}
	}
//	$query = 'SELECT * FROM  mon_rb_ships WHERE id='.$_REQUEST['name'];
//	$arResult = $DB->getRecord($query);
//	$selector = $DB->getRecordsAssoc($query);
//	switch ($_REQUEST['name']){
//		case 'plane':
//			$strSelector = '<select name="planename__'.$counter.'" onchange="getPlaneInfo(this, '.$counter.')"><option value="0">';
//			foreach ($selector as $arValue) {
//				$strSelector .= "<option value='{$arValue['id']}'>{$arValue['name']}";
//			}
//			$strSelector .= '</select>';
//		break;
//		default:
//			$strSelector = '<select name="shipname__'.$counter.'" onchange="getShipInfo(this, '.$counter.')"><option value="0">';
//			foreach ($selector as $arValue) {
//				$strSelector .= "<option value='{$arValue['id']}'>{$arValue['name']}";
//			}
//			$strSelector .= '</select>';
//
//	}
//	$arResult['selector'] = $strSelector;
	$arResult['fields'] = $fields;
	$arResult['request'] = $_REQUEST;

	}else	if ($_REQUEST['action'] == 'shipInfo' && !empty($_REQUEST['elementId']) && intval($_REQUEST['elementId']) > 0){
		$query = 'SELECT * FROM  mon_rb_ships WHERE id='.intval($_REQUEST['elementId']);
		$arResult = $DB->getRecord($query);
		$arResult['query'] = $query;

	}else	if ($_REQUEST['action'] == 'planeInfo' && !empty($_REQUEST['elementId']) && intval($_REQUEST['elementId']) > 0){
		$query = 'SELECT * FROM  mon_rb_planes WHERE id='.intval($_REQUEST['elementId']);
		$arResult = $DB->getRecord($query);
		$arResult['query'] = $query;

	}else	if ($_REQUEST['action'] == 'deleteCoord' && !empty($_REQUEST['elementId']) && intval($_REQUEST['elementId']) > 0){
		$query = 'DELETE FROM  mon_exp_coords WHERE id='.intval($_REQUEST['elementId']);
		$arResult = $DB->setRecord($query);

	}else	if ($_REQUEST['action'] == 'deleteEquip' && !empty($_REQUEST['elementId']) && intval($_REQUEST['elementId']) > 0){
		$query = 'DELETE FROM  mon_exp_equip WHERE id='.intval($_REQUEST['elementId']);
		$arResult = $DB->setRecord($query);

	}else	if ($_REQUEST['action'] == 'deletePort' && !empty($_REQUEST['elementId']) && intval($_REQUEST['elementId']) > 0){
		$query = 'DELETE FROM  mon_exp_ports WHERE id='.intval($_REQUEST['elementId']);
		$arResult = $DB->setRecord($query);

	}else	if ($_REQUEST['action'] == 'deleteTransport' && !empty($_REQUEST['elementId']) && intval($_REQUEST['elementId']) > 0){
		// select exp_id from
		if($_REQUEST['type'] == 'ship'){
			$query = 'DELETE FROM mon_exp_transp WHERE exp_id=( SELECT exp_id FROM  mon_exp_ships WHERE id='.intval($_REQUEST['elementId']).') AND trs_id='.intval($_REQUEST['elementId']).' AND type="ship" ';
			$DB->setRecord($query);



			$query = 'DELETE FROM  mon_exp_ships WHERE id='.intval($_REQUEST['elementId']);
			$DB->setRecord($query);
		}elseif ($_REQUEST['type'] == 'other'){
			$query = 'DELETE FROM mon_exp_transp WHERE exp_id=( SELECT exp_id FROM  mon_exp_transports WHERE id='.intval($_REQUEST['elementId']).') AND trs_id='.intval($_REQUEST['elementId']).' AND type="other" ';
			$arResult = $DB->setRecord($query);

			$query = 'DELETE FROM  mon_exp_transports WHERE id='.intval($_REQUEST['elementId']);
			$arResult = $DB->setRecord($query);
		}

		$arResult['query'] = $query;

	}else	if ($_REQUEST['action'] == 'getShipInfo'){
		if(empty($_REQUEST['counter'])) $_REQUEST['counter'] = 0;
		$src = htmlspecialchars($_REQUEST['q']);
		$query = "SELECT * FROM  mon_rb_ships WHERE name like '%{$src}%' OR short_name like '%{$src}%' ";
		$resource = $DB->getRecordsAssoc($query);
		foreach ($resource as $arr){
			print $arr['name']."|".$arr['id']."|".$_REQUEST['counter']."|".$arr['nation']."|".$arr['shipowner']."|".$arr['homeport']."|".$arr['func']."|".$arr['length']."|".$arr['width']."|".$arr['draught']."|".$arr['seaworth']."|".$arr['displace']."|".$arr['generator']."|".$arr['rdfreq']."|".$arr['rdsign']."|".PHP_EOL;
		}
		die();

	}else	if ($_REQUEST['action'] == 'getPortsList'){
		if(empty($_REQUEST['counter'])) $_REQUEST['counter'] = 0;
		$src = htmlspecialchars($_REQUEST['q']);
		$query = "SELECT * FROM  mon_rb_ports WHERE name like '{$src}%' ";
		$resource = $DB->getRecordsAssoc($query);
		foreach ($resource as $arr){
			print $arr['name']."|".$arr['id']."|".$_REQUEST['counter']."|".PHP_EOL;
		}
		die();

	}else {

	}
//echo $prefixes[rand(0,count($prefixes)-1)] . " is the new "     . $suffixes[rand(0,count($prefixes)-1)];
}


//ECHO json_encode(array("name"=>$arResult['name_eng'],"time"=>$arResult['name']));
ECHO json_encode($arResult);

// Example output: Tagging is the new Web
die();
?>
