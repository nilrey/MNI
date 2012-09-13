<?php
$showPost = false ;
global $DB;
$arError = array();
$arResult['REFBOOK']['countries'] = getReferenceBook('countries');
$arResult['REFBOOK']['departments'] = getReferenceBook('departments');
$arResult['REFBOOK']['org_particip'] = getReferenceBook('org_particip', 'id');
$arResult['REFBOOK']['mnitype'] = getReferenceBook('mnitype');
$arResult['REFBOOK']['mnisort'] = getReferenceBook('mnisort');
foreach ($arResult['REFBOOK']['mnisort'] as $arValue) {
	$arResult['REFBOOK']['mnisort_ord'][$arValue['mnitype']][] = $arValue;
}
$arResult['REFBOOK']['mniunit'] = getReferenceBook('mniunit');
$arResult['REFBOOK']['mnitypeGroups'] = getReferenceBookMTG();

if(!empty($_POST) && ( !empty($_POST['APPLICANT']['fullname']) || !empty($_POST['APPLICANT']['fio'] )) ){
	// SET EXPEDITION RECORD FIRST

//	spyMail('apply.create Form is posted.');

	$EXPEDITION_ID = intval($_POST['eid']);
	$arOrganizations = false;
	$arFields['date_start'] = getDateFormated($_POST['EXPEDITION']['date_start']);
	$arFields['date_end'] = getDateFormated($_POST['EXPEDITION']['date_end']);
	$arFields['mni_name'] = prepareValue($_POST['EXPEDITION']['mni_name']);
	$arFields['mni_aim'] = prepareValue($_POST['EXPEDITION']['mni_aim']);
	$arFields['mni_spec'] = prepareValue($_POST['EXPEDITION']['mni_spec']);
	$arFields['exp_ecology'] = prepareValue($_POST['EXPEDITION']['ecology']);
	$arFields['exp_particip_rf'] = prepareValue($_POST['EXPEDITION']['particip_rf']);
	$arFields['exp_use_result'] = prepareValue($_POST['EXPEDITION']['use_result']);
	if( checkStringDate($_POST['EXPEDITION']['report_date']) ) {
		$arFields['exp_report_date'] = $_POST['EXPEDITION']['report_date'];
	}else{
		$date = new DateTime($arFields['date_end']);
		$arFields['exp_report_date'] = date("Y-m-d", mktime(0, 0, 0, $date->format('m') + 1, $date->format('d'), $date->format('Y')));
	}
	$arFields['status'] = intval($_POST['EXPEDITION']['statusExpedition']);
	$table_name = 'mon_expedition';
	$arTableFields =  $DB->getTableFields($table_name);

	if($_REQUEST['act'] === 'copy' || $EXPEDITION_ID === 0){
		$arFields['user_id'] = $USER->getUserId();
		$EXPEDITION_ID = constructQueryInsert(false, $table_name, $arFields, $arTableFields, $arError );
		$_POST['TRANSPORT_NEW'] = $_POST['TRANSPORT'];
		unset($_POST['TRANSPORT']);
		$_POST['PARTICIPANT_NEW'] = $_POST['PARTICIPANT'];
		unset($_POST['PARTICIPANT']);
		$_POST['APPLICANT']['eid'] = 0;
		$_POST['EXECUTOR']['eid'] = 0;
		$_POST['TECH']['eid'] = 0;

	}elseif ($EXPEDITION_ID > 0){
		$query = "UPDATE {$table_name} SET ##UPDATE_FIELDS## WHERE id={$EXPEDITION_ID}";
		if(!$USER->isAdmin()){
			$query .= " AND user_id={$USER->getUserId()}";
		}
		constructQueryUpdate( $query, $table_name, $arFields, $arTableFields, $arError  );

		// Add Pre Report File
//		var_dump($_FILES["preReportFile"]["size"]);
		if(!empty($_FILES["preReportFile"]) && $_FILES["preReportFile"]["size"] > 0 && $_FILES["preReportFile"]["size"] < 10000000){
			$newFileName = date(U).substr($_FILES['preReportFile']['name'], strrpos($_FILES['preReportFile']['name'], chr(46)));
			$newFilePath = $_SERVER['DOCUMENT_ROOT'].'/files/prereports/'.$newFileName;
			if(copy($_FILES['preReportFile']['tmp_name'], $newFilePath ) ){
				$table_name = 'mon_exp_files';
				$arTableFields =  $DB->getTableFields($table_name);
				deleteQuery( "DELETE FROM {$table_name} WHERE exp_id={$EXPEDITION_ID}", false, false );
				// add unset for files !
				$arFields = array();
				$arFields['exp_id'] = $EXPEDITION_ID;
				$arFields['name'] = $newFileName;
				$arFields['create_date'] = date('Y-m-d');
				$arFields['orig_name'] = $_FILES['preReportFile']['name'];
//				$arFields['comments'] = htmlspecialchars($_POST['reclaimComments']);
				constructQueryInsert(false, $table_name, $arFields, $arTableFields, $arError );
			}
		}elseif($_FILES["preReportFile"]["size"] >= 10000000){
				$ERR[] = 'FILE_SIZE_ERROR';
				$ERR[] = "File size is too big (". intval($_FILES["preReportFile"]["size"] / 1000 )." Kb)";
				$arError[] = $ERR;
		}
	}

	if( intval($EXPEDITION_ID) >0 ){

	$arFields = array();

	$query = "SELECT * FROM mon_exp_transp WHERE exp_id={$EXPEDITION_ID} ";

	$arTransportExistIds = $DB->getRecordsAssoc($query);

	foreach ($_POST as $blockKey=>$value){
		$table_name = '';
		$arFields = array();
		$arTableFields = array();
		$itemId = 0;
		switch ($blockKey){
			case 'APPLICANT':
				$arFields['exp_id'] = $EXPEDITION_ID;
				$arFields['record_type'] = 'APP';
				$arFields['fullname'] = prepareValue($_POST[$blockKey]['fullname']);
				if(!empty($arFields['fullname'])){
					$itemId = intval($_POST[$blockKey]['eid']);
					$arFields['country'] = prepareValue($_POST[$blockKey]['country']);
					$arFields['department'] = prepareValue($_POST[$blockKey]['department']);
					$arFields['city'] = prepareValue($_POST[$blockKey]['city']);
					$arFields['legaladdress'] = prepareValue($_POST[$blockKey]['legaladdress']);
					$arFields['phone'] = prepareValue($_POST[$blockKey]['phone']);
					$arFields['fax'] = prepareValue($_POST[$blockKey]['fax']);
					$arFields['telex'] = prepareValue($_POST[$blockKey]['telex']);
					$arFields['email'] = prepareValue($_POST[$blockKey]['email']);
					$arFields['org_particip'] = prepareValue($_POST[$blockKey]['org_particip']);
					$arFields['org_particip_oth'] = prepareValue($_POST[$blockKey]['org_particip_oth']);
					$arFields['org_particip_ammount'] = prepareValue($_POST[$blockKey]['org_particip_ammount']);
					$arFields['org_particip_type'] = prepareValue($_POST[$blockKey]['org_particip_type']);
					$table_name = 'mon_exp_org';
					$arTableFields =  $DB->getTableFields($table_name);
					if( $itemId > 0){
						constructQueryUpdate(false, $table_name, $arFields, $arTableFields, $arError , $itemId );
					}else {
						constructQueryInsert(false, $table_name, $arFields, $arTableFields, $arError  );
					}
				}
				break;
			case 'EXECUTOR':
					$arFields['exp_id'] = $EXPEDITION_ID;
					$arFields['record_type'] = 'EXC';
					$itemId = intval($_POST[$blockKey]['eid']);
					$table_name = null;
					if( empty($_POST[$blockKey]['isExecutor'])){ $deleteAll = true; }else{ $deleteAll = false;}

					if($_POST[$blockKey]['curType'] != $_POST[$blockKey]['type'] || $deleteAll){
						if ($_POST[$blockKey]['curType'] == 1 || $deleteAll){
							deleteQuery(false, 'mon_exp_org', $itemId );
						}else if ($_POST[$blockKey]['curType'] == 2 || $deleteAll){
							deleteQuery(false, 'mon_exp_pers', $itemId );
						}
						$itemId = 0;
					}

					if(!$deleteAll){
						if ($_POST[$blockKey]['type'] == 1 ){
							$arFields['fullname'] = prepareValue($_POST[$blockKey]['fullname']);
							if(!empty($arFields['fullname'])){
								$arFields['country'] = prepareValue($_POST[$blockKey]['country']);
								$arFields['department'] = prepareValue($_POST[$blockKey]['department']);
								$arFields['city'] = prepareValue($_POST[$blockKey]['city']);
								$arFields['legaladdress'] = prepareValue($_POST[$blockKey]['legaladdress']);
								$arFields['phone'] = prepareValue($_POST[$blockKey]['phone']);
								$arFields['fax'] = prepareValue($_POST[$blockKey]['fax']);
								$arFields['telex'] = prepareValue($_POST[$blockKey]['telex']);
								$arFields['email'] = prepareValue($_POST[$blockKey]['email']);
								$arFields['org_particip'] = prepareValue($_POST[$blockKey]['org_particip']);
								$arFields['org_particip_oth'] = prepareValue($_POST[$blockKey]['org_particip_oth']);
								$arFields['org_particip_ammount'] = prepareValue($_POST[$blockKey]['org_particip_ammount']);
								$arFields['org_particip_type'] = prepareValue($_POST[$blockKey]['org_particip_type']);
								$table_name = 'mon_exp_org';
							}
						}elseif ($_POST[$blockKey]['type'] == 2 ){
							$arFields['fio'] = prepareValue($_POST[$blockKey]['fio']);
							if(!empty($arFields['fio'])){
								$arFields['country'] = prepareValue($_POST[$blockKey]['sitizen']);
								$arFields['workaddress'] = prepareValue($_POST[$blockKey]['workaddress']);
								$arFields['particip'] = prepareValue($_POST[$blockKey]['particip']);
								$table_name = 'mon_exp_pers';
							}

						}
					}
					if(!empty($table_name)){
						$arTableFields =  $DB->getTableFields($table_name);
						if( $itemId > 0){
							constructQueryUpdate(false, $table_name, $arFields, $arTableFields, $arError , $itemId );
						}else {
							constructQueryInsert(false, $table_name, $arFields, $arTableFields, $arError  );
						}
					}
				break;
			case 'TRANSPORT':
				$arFields['exp_id'] = $EXPEDITION_ID;
				$arDelIds = $arTransportExistIds;
				$num = 0;
/*				ECHO '<PRE>';
				print_r($_POST[$blockKey]);
				ECHO '</PRE>';*/

				foreach ($_POST[$blockKey] as $id => $arItem) {
					$itemId = intval($arItem['eid']);

					if(count($arDelIds) > 0 ){
						foreach ($arDelIds as $key=> $arRow) {
							if($arRow['type'] == $arItem['type'] && $arRow['trs_id'] == $arItem['eid']){
								unset($arDelIds[$key]);
							}
						}
					}

					switch ($arItem['type']){
						case 'ship':
							$table_name = 'mon_exp_ships';
							$arTableFields =  $DB->getTableFields($table_name);
							$arFields['name'] = prepareValue($arItem['shipname']);
							if(!empty($arFields['name'])){
								$arFields['nation'] = prepareValue($arItem['nation']);
								$arFields['shipowner'] = prepareValue($arItem['shipowner']);
								$arFields['shipowner_country'] = $arItem['shipowner_country'];
								$arFields['shipowner_city'] = prepareValue($arItem['shipowner_city']);
								$arFields['shipowner_legaladdress'] = prepareValue($arItem['shipowner_legaladdress']);
								$arFields['shipowner_phone'] = prepareValue($arItem['shipowner_phone']);
								$arFields['shipowner_fax'] = prepareValue($arItem['shipowner_fax']);
								$arFields['shipowner_telex'] = prepareValue($arItem['shipowner_telex']);
								$arFields['shipowner_email'] = prepareValue($arItem['shipowner_email']);
								$arFields['homeport'] = prepareValue($arItem['homeport']);
								$arFields['func'] = prepareValue($arItem['func']);
								$arFields['length'] = prepareValue($arItem['length']);
								$arFields['width'] = prepareValue($arItem['width']);
								$arFields['draught'] = prepareValue($arItem['draught']);
								$arFields['seaworth'] = prepareValue($arItem['seaworth']);
								$arFields['displace'] = prepareValue($arItem['displace']);
								$arFields['generator'] = prepareValue($arItem['generator']);
								$arFields['rdfreq'] = prepareValue($arItem['rdfreq']);
								$arFields['rdsign'] = prepareValue($arItem['rdsign']);
								$arFields['capt'] = prepareValue($arItem['capt']);
								$arFields['crew'] = prepareValue($arItem['crew']);
								$arFields['researchers'] = prepareValue($arItem['researchers']);
								$arFields['head'] = prepareValue($arItem['head']);
							}
							break;
						case 'other':
							$table_name = 'mon_exp_transports';
							$arFields['name'] = prepareValue($arItem['transport_name']);
							if(!empty($arFields['name'])){
								$arFields['capt'] = prepareValue($arItem['capt']);
								$arFields['crew'] = intval($arItem['crew']);
								$arFields['researchers'] = intval($arItem['researchers']);
								$arFields['head'] = prepareValue($arItem['head']);
								$arTableFields =  $DB->getTableFields($table_name);
							}
							break;
					}

					if(!empty($table_name)){

						if( $itemId > 0){
							constructQueryUpdate(false, $table_name, $arFields, $arTableFields, $arError , $itemId );
						}else {
							$itemId = constructQueryInsert(false, $table_name, $arFields, $arTableFields, $arError  );

							$arFields = array();
							$arFields['exp_id'] = $EXPEDITION_ID;
							$arFields['type'] = prepareValue($arItem['type']);
							$arFields['trs_id'] = $itemId;
							$arFields['main_trs'] = intval($arItem['main_trs']);
							$arFields['num'] = $num++; //$id;
							$table_name = 'mon_exp_transp';
							$arTableFields =  $DB->getTableFields($table_name);
							constructQueryInsert(false, $table_name, $arFields, $arTableFields, $arError );
						}
					}

				} // end foreach

				if( count($arDelIds) > 0){
					foreach ($arDelIds as $arItem) {
						$query = "DELETE FROM mon_exp_transp WHERE exp_id={$EXPEDITION_ID} AND type='{$arItem['type']}' AND trs_id={$arItem['trs_id']}";
						deleteQuery($query);
						switch ($arItem['type']){
							case 'ship':
								deleteQuery(false, 'mon_exp_ships', $arItem['trs_id'] );
								break;
							case 'other':
								deleteQuery(false, 'mon_exp_transports', $arItem['trs_id'] );
								break;
						}
					}
				}

				break;
			case 'TRANSPORT_NEW':
				$arFields['exp_id'] = $EXPEDITION_ID;
				$arTmp =  $DB->getRecord("SELECT COUNT(num) as num FROM mon_exp_transp WHERE exp_id = {$EXPEDITION_ID}") ;
				$num = $arTmp['num'];
				foreach ($_POST[$blockKey] as $id => $arItem) {
					switch ($arItem['type']){
						case 'ship':
							$table_name = 'mon_exp_ships';
							$arFields['name'] = prepareValue($arItem['shipname']);
							$arFields['nation'] = prepareValue($arItem['nation']);
							$arFields['shipowner'] = prepareValue($arItem['shipowner']);
							$arFields['shipowner_country'] = $arItem['shipowner_country'];
							$arFields['shipowner_city'] = prepareValue($arItem['shipowner_city']);
							$arFields['shipowner_legaladdress'] = prepareValue($arItem['shipowner_legaladdress']);
							$arFields['shipowner_phone'] = prepareValue($arItem['shipowner_phone']);
							$arFields['shipowner_fax'] = prepareValue($arItem['shipowner_fax']);
							$arFields['shipowner_telex'] = prepareValue($arItem['shipowner_telex']);
							$arFields['shipowner_email'] = prepareValue($arItem['shipowner_email']);
							$arFields['homeport'] = prepareValue($arItem['homeport']);
							$arFields['func'] = prepareValue($arItem['func']);
							$arFields['length'] = prepareValue($arItem['length']);
							$arFields['width'] = prepareValue($arItem['width']);
							$arFields['draught'] = prepareValue($arItem['draught']);
							$arFields['seaworth'] = prepareValue($arItem['seaworth']);
							$arFields['displace'] = prepareValue($arItem['displace']);
							$arFields['generator'] = prepareValue($arItem['generator']);
							$arFields['rdfreq'] = prepareValue($arItem['rdfreq']);
							$arFields['rdsign'] = prepareValue($arItem['rdsign']);

							break;
						case 'other':
							$table_name = 'mon_exp_transports';
							$arFields['name'] = prepareValue($arItem['transport_name']);
							break;
					}
					if(!empty($table_name)){
						$arTableFields =  $DB->getTableFields($table_name);
						if(!empty($arFields['name'])){
							$arFields['capt'] = prepareValue($arItem['capt']);
							$arFields['crew'] = prepareValue($arItem['crew']);
							$arFields['researchers'] = prepareValue($arItem['researchers']);
							$arFields['head'] = prepareValue($arItem['head']);
							$item_id = constructQueryInsert(false, $table_name, $arFields, $arTableFields, $arError );
							if($item_id > 0){
								$arFields = array();
								$arFields['exp_id'] = $EXPEDITION_ID;
								$arFields['trs_id'] = $item_id;
								$arFields['main_trs'] = intval($arItem['main_trs']);
								$arFields['num'] = ++$num; //$id;
								$arFields['type'] = prepareValue($arItem['type']);
								$table_name = 'mon_exp_transp';
								$arTableFields =  $DB->getTableFields($table_name);
								constructQueryInsert(false, $table_name, $arFields, $arTableFields, $arError );

							}
						}
					}
				}

				break;
				case 'PARTICIPANT':
				$arFields['exp_id'] = $EXPEDITION_ID;
				$arFields['record_type'] = 'PTC';
				foreach ($_POST[$blockKey] as $id => $arItem) {
					$itemId = intval($arItem['eid']);
					if ($arItem['curType'] == 1){
						$arFields['fullname'] = prepareValue($arItem['fullname']);
						if(!empty($arFields['fullname'])){
							$arFields['country'] = prepareValue($arItem['country']);
							$arFields['department'] = prepareValue($arItem['department']);
							$arFields['city'] = prepareValue($arItem['city']);
							$arFields['legaladdress'] = prepareValue($arItem['legaladdress']);
							$arFields['phone'] = prepareValue($arItem['phone']);
							$arFields['fax'] = prepareValue($arItem['fax']);
							$arFields['telex'] = prepareValue($arItem['telex']);
							$arFields['email'] = prepareValue($arItem['email']);
							$arFields['org_particip'] = prepareValue($arItem['org_particip']);
							$arFields['org_particip_oth'] = prepareValue($_POST[$blockKey]['org_particip_oth']);
							$arFields['org_particip_ammount'] = prepareValue($arItem['org_particip_ammount']);
							$arFields['org_particip_type'] = prepareValue($arItem['org_particip_type']);
							$table_name = 'mon_exp_org';
						}
					}elseif ($arItem['curType'] == 2){
						$arFields['fio'] = prepareValue($arItem['fio']);
						if(!empty($arFields['fio'])){
							$arFields['country'] = prepareValue($arItem['sitizen']);
							$arFields['workaddress'] = prepareValue($arItem['workaddress']);
							$arFields['particip'] = prepareValue($arItem['particip']);
							$table_name = 'mon_exp_pers';
						}
					}
					if(!empty($table_name)){
						$arTableFields =  $DB->getTableFields($table_name);
						if( $itemId > 0){
							constructQueryUpdate(false, $table_name, $arFields, $arTableFields, $arError , $itemId );
						}else {
							constructQueryInsert(false, $table_name, $arFields, $arTableFields, $arError  );
						}
					}

				}
				break;
			case 'PARTICIPANT_NEW':
				$arFields['exp_id'] = $EXPEDITION_ID;
				$arFields['record_type'] = 'PTC';
				foreach ($_POST[$blockKey] as $id => $arItem) {
					if(empty($arItem['type'])) $arItem['type'] = $arItem['curType'];
					switch ($arItem['type'] ){
						case "1":
							$arFields['fullname'] = prepareValue($arItem['fullname']);
							if(!empty($arFields['fullname'])){
								$arFields['country'] = prepareValue($arItem['country']);
								$arFields['city'] = prepareValue($arItem['city']);
								$arFields['legaladdress'] = prepareValue($arItem['legaladdress']);
								$arFields['phone'] = prepareValue($arItem['phone']);
								$arFields['fax'] = prepareValue($arItem['fax']);
								$arFields['telex'] = prepareValue($arItem['telex']);
								$arFields['email'] = prepareValue($arItem['email']);
								$arFields['org_particip'] = prepareValue($arItem['org_particip']);
								$arFields['org_particip_oth'] = prepareValue($_POST[$blockKey]['org_particip_oth']);
								$arFields['org_particip_ammount'] = prepareValue($arItem['org_particip_ammount']);
								$arFields['org_particip_type'] = prepareValue($arItem['org_particip_type']);
								$table_name = 'mon_exp_org';
							}
						break;
						case "2":
							$arFields['fio'] = prepareValue($arItem['fio']);
							if(!empty($arFields['fio'])){
								$arFields['country'] = prepareValue($arItem['sitizen']);
								$arFields['workaddress'] = prepareValue($arItem['workaddress']);
								$arFields['particip'] = prepareValue($arItem['particip']);
								$table_name = 'mon_exp_pers';
							}
						break;
					}
					if(!empty($table_name)){
						$arTableFields =  $DB->getTableFields($table_name);
						if( !constructQueryInsert(false, $table_name, $arFields, $arTableFields, $arError ) ){
	//							var_dump($arError);
//								echo '<p>ERROR: add PARTICIPANT_NEW </p><pre>', print_r($arFields), '</pre>';
						}
					}
				}
				break;
			case 'COORDS':
// DELETE ALL RECORDS
				$table_name = 'mon_exp_equip_dates';
				deleteQuery("DELETE FROM {$table_name} WHERE exp_id={$EXPEDITION_ID}", '', '' );
				$table_name = 'mon_exp_coords';
				$arTableFields =  $DB->getTableFields($table_name);
				deleteQuery("DELETE FROM {$table_name} WHERE exp_id={$EXPEDITION_ID}", '', '' );

				foreach ($_POST[$blockKey] as $code => $arItems) {
					$cnt = 0;
					foreach ($arItems as $arItem) {
//						$arHash = '';
//array_walk_recursive($arItem, 'getArrayHash', $arHash);
//var_dump($arHash);
								$arFields['exp_id'] = $EXPEDITION_ID;
								$arFields['record_type'] = prepareValue($code);
								!empty($arItem['block']) ? $arFields['block'] = $arItem['block'] : $arFields['block'] = 0;
								!empty($arItem['info']) ? $arFields['info'] = $arItem['info'] : $arFields['info'] = '';
								$arFields['num'] = $cnt++;
								if( !empty($arItem['lat_grad']) && !empty($arItem['lang_grad']) ){
									$arFields['landing_date'] = $arItem['landing_date'];
									$arFields['latitiude'] = floatval($arItem['lat_grad']).';'.floatval($arItem['lat_min']);
									$arFields['langitude'] = floatval($arItem['lang_grad']).';'.floatval($arItem['lang_min']).';'.prepareValue($arItem['lang_type']);
									$coordId = constructQueryInsert(false, $table_name, $arFields, $arTableFields, $arError );
									if( intval($coordId) > 0 && (
											 !empty($arItem['equip_install'] )
										|| !empty($arItem['equip_deinstall'] )
										|| !empty($arItem['time_usage'] ) )
									){
										$arFields = array(
											"exp_id" => $EXPEDITION_ID,
											"block" => $arItem['block'],
											"coord_id" => $coordId,
											"equip_install" => $arItem['equip_install'],
											"equip_deinstall" => $arItem['equip_deinstall'],
											"time_usage" => $arItem['time_usage'],
										);
										constructQueryInsert(false, 'mon_exp_equip_dates', $arFields, $DB->getTableFields('mon_exp_equip_dates'), $arError );
									}
								}
					}
				}
				break;
				case 'TABLES_COMMENT':
				$table_name = 'mon_exp_tables_comment';
				$arTableFields =  $DB->getTableFields($table_name);
				foreach ($_POST[$blockKey] as $code=>$arItems) {
					$arFields = array(
						"exp_id" => $EXPEDITION_ID,
						'table_type' => prepareValue($code),
						"comment" => $arItems['comment'],
					);
					deleteQuery("DELETE FROM {$table_name} WHERE exp_id={$EXPEDITION_ID} AND table_type='{$arFields['table_type']}'" , '', '' );
					constructQueryInsert(false, $table_name, $arFields, $arTableFields, $arError );
				}

				break;
			case 'PORTS':
// DELETE ALL RECORDS
				$table_name = 'mon_exp_ports';
				$arTableFields =  $DB->getTableFields($table_name);
				deleteQuery("DELETE FROM {$table_name} WHERE exp_id={$EXPEDITION_ID}", '', '' );
				foreach ($_POST[$blockKey] as $arItems) {
					$cnt = 0;
					foreach ($arItems as $id => $arItem) {
						$arFields['exp_id'] = $EXPEDITION_ID;
						//$arFields['record_type'] = prepareValue($id);
						$arFields['record_type'] = 'ports';
						$arFields['num'] = $cnt++;
						if( !empty($arItem['landing_date']) && $arItem['landing_date'] != '0000-00-00'){
							$arFields['landing_date'] = $arItem['landing_date'];
							$arFields['port'] = prepareValue($arItem['port']);
							$arFields['comment'] = prepareValue($arItem['comment']);
							constructQueryInsert(false, $table_name, $arFields, $arTableFields, $arError );
						}
					}
				}
				break;
			case 'MNITYPE':
// DELETE ALL RECORDS
				$table_name = 'mon_exp_mnitype';
				$arTableFields =  $DB->getTableFields($table_name);
				deleteQuery("DELETE FROM {$table_name} WHERE exp_id={$EXPEDITION_ID}", '', '' );
				foreach ($_POST[$blockKey] as $arItems) {
					$cnt = 0;
					foreach ($arItems as $id => $arItem) {
						$arFields['exp_id'] = $EXPEDITION_ID;
						$arFields['num'] = $cnt++;
						$arFields['mnitype'] = prepareValue($arItem['mnitype']);
						$arFields['mnisort'] = prepareValue($arItem['mnisort']);
						$arFields['mniunit'] = prepareValue($arItem['mniunit']);
						$arFields['amount'] = intval($arItem['amount']);
						constructQueryInsert(false, $table_name, $arFields, $arTableFields, $arError );
					}
				}
				break;
			case 'EQUIP':
// DELETE ALL RECORDS
/*				echo '<pre>';
				print_r($_POST[$blockKey]);
				echo '</pre>';*/
				$table_name = 'mon_exp_equip';
				$arTableFields =  $DB->getTableFields($table_name);
				deleteQuery("DELETE FROM {$table_name} WHERE exp_id={$EXPEDITION_ID}", '', '' );
				$cnt = 0;
				if( empty($_POST[$blockKey]['isEquipment'])){ $deleteAll = true; }else{ $deleteAll = false; unset($_POST[$blockKey]['isEquipment']);}

				if( !$deleteAll ){
					foreach ($_POST[$blockKey] as $record_type => $arItem) {
						$arFields['exp_id'] = $EXPEDITION_ID;
						$arFields['record_type'] = prepareValue($record_type);
						$arFields['block'] = $cnt++;
						$arFields['basic'] = ($arItem['basic']);
						$arFields['infotype'] = ($arItem['infotype']);
						$arFields['coord'] = ($arItem['coord']);
						$arFields['dates'] = ($arItem['dates']);
						$arFields['equipowner'] = ($arItem['equipowner']);
						$arFields['equipowner_country'] = ($arItem['equipowner_country']);
						$arFields['equipowner_city'] = ($arItem['equipowner_city']);
						$arFields['equipowner_legaladdress'] = ($arItem['equipowner_legaladdress']);
						$arFields['equipowner_phone'] = ($arItem['equipowner_phone']);
						$arFields['equipowner_fax'] = ($arItem['equipowner_fax']);
						$arFields['equipowner_telex'] = ($arItem['equipowner_telex']);
						$arFields['equipowner_email'] = ($arItem['equipowner_email']);
						$arFields['comments'] = ($arItem['comments']);
						if(!empty($arFields['basic']) && !empty($arFields['infotype'])){
							constructQueryInsert(false, $table_name, $arFields, $arTableFields, $arError );
						}
					}
				}
				break;
			case 'TECH':
				$table_name = 'mon_exp_tech';
				$arTableFields =  $DB->getTableFields($table_name);
				$itemId = intval($_POST[$blockKey]['eid']);
				$arFields['hydrograph'] = prepareValue($_POST[$blockKey]['hydrograph']);
				$arFields['hydroacustic'] = prepareValue($_POST[$blockKey]['hydroacustic']);
				$arFields['magnitometr'] = prepareValue($_POST[$blockKey]['magnitometr']);
				$arFields['seismic'] = prepareValue($_POST[$blockKey]['seismic']);
				$arFields['meteorolog'] = prepareValue($_POST[$blockKey]['meteorolog']);
				$arFields['oceanograph'] = prepareValue($_POST[$blockKey]['oceanograph']);
				$arFields['bioresearch'] = prepareValue($_POST[$blockKey]['bioresearch']);
				$arFields['probation'] = prepareValue($_POST[$blockKey]['probation']);
				$arFields['divingdev'] = prepareValue($_POST[$blockKey]['divingdev']);
				$arFields['ancoreddev'] = prepareValue($_POST[$blockKey]['ancoreddev']);
				$arFields['coupleddev'] = prepareValue($_POST[$blockKey]['coupleddev']);
				$arFields['submarine'] = prepareValue($_POST[$blockKey]['submarine']);
				$arFields['planes'] = prepareValue($_POST[$blockKey]['planes']);
				$arFields['otherdev'] = prepareValue($_POST[$blockKey]['otherdev']);
				if( $itemId > 0){
					constructQueryUpdate("UPDATE {$table_name} SET ##UPDATE_FIELDS## WHERE exp_id={$itemId}", $table_name, $arFields, $arTableFields, $arError , $itemId );
				}else {
					$arFields['exp_id'] = $EXPEDITION_ID;
					constructQueryInsert(false, $table_name, $arFields, $arTableFields, $arError  );
				}

				break;
		}

		$arFields = array();

	}


	if(!$showPost ){
		$redirect = $PAGE->getBasePageUrl()."?eid={$EXPEDITION_ID}";

		if(!empty($_REQUEST['atab']) && intval($_REQUEST['atab']) > 0){
			$redirect.='&atab='.intval($_REQUEST['atab']);
		}
		//if(empty($_POST['eid']) ){
			$redirect.='&act=save';
		//}
		header("location: {$redirect}");
	}else if(count($arError) > 0){
		var_dump($arError);
	}

	if($showPost){
				echo '<pre>';
				print_r($_POST);
				echo '</pre>';
	}

	}
}
function getArrayHash($item, $key, $arHash){
	$arHash .= (string) $item;
	//echo "$key holds $item<br>\n";
}

if(!empty($_REQUEST['eid']) && intval($_REQUEST['eid']) > 0 ){

	getEmptySet($arResult);

	$EXPEDITION_ID = intval($_REQUEST['eid']);

	$checkUser = '';
	if(!$USER->isAdmin()){
		$checkUser = "user_id={$USER->getUserId()} AND";
	}

	$query = "SELECT * FROM mon_expedition WHERE {$checkUser} id={$EXPEDITION_ID} ORDER BY date_start DESC , mni_name";
	$arResult['EXPEDITION'] = $DB->getRecord($query);
	if($USER->getUserId() == $arResult['EXPEDITION']['user_id'] || $USER->isAdmin()){

		$arResult['APPLICANT'] = array();
		$query = "SELECT * FROM mon_exp_org WHERE exp_id={$EXPEDITION_ID}";
		$arTmp = $DB->getRecordsAssoc($query);
		foreach ($arTmp as $arItem) {
			$arItem['type'] = 1;
			switch (strtoupper($arItem['record_type']) ){
				case 'APP':
					$arResult['APPLICANT'] = $arItem;
					break;
				case 'EXC':
					$arResult['EXECUTOR'] = $arItem;
					break;
				case 'PTC':
					$arResult['PARTICIPANT'][] = $arItem;
					break;
			}
		}
		$query = "SELECT * FROM mon_exp_pers WHERE exp_id={$EXPEDITION_ID}";
		$arTmp = $DB->getRecordsAssoc($query);
		foreach ($arTmp as $arItem) {
			$arItem['type'] = 2;
			switch (strtoupper($arItem['record_type']) ){
				case 'APP':
					$arResult['APPLICANT'] = $arItem;
					break;
				case 'EXC':
					$arResult['EXECUTOR'] = $arItem;
					break;
				case 'PTC':
					$arResult['PARTICIPANT'][] = $arItem;
					break;
			}
		}

		$arResult['TRANSPORT'] = array();
		$query = "SELECT * FROM mon_exp_transp WHERE exp_id={$EXPEDITION_ID} ORDER BY main_trs DESC, num, id";
		$arTmp = $DB->getRecordsAssoc($query);
		foreach ($arTmp as $arItem){
			switch ($arItem['type']){
				case 'ship':
					$query = "SELECT * FROM mon_exp_ships WHERE id={$arItem['trs_id']} ";
					$arShip = $DB->getRecord($query);
					$arShip['main_trs'] = $arItem['main_trs'];
					$arShip['num'] = $arItem['num'];
					$arShip['type'] = $arItem['type'];
					$arResult['TRANSPORT'][] = $arShip;
					break;
				case 'other':
					$query = "SELECT * FROM mon_exp_transports WHERE id={$arItem['trs_id']} ";
					$arShip = $DB->getRecord($query);
					$arShip['main_trs'] = $arItem['main_trs'];
					$arShip['num'] = $arItem['num'];
					$arShip['type'] = $arItem['type'];
					$arResult['TRANSPORT'][] = $arShip;
					break;
			}
		}

		$arResult['MAINTRANSPORT'] = array();
		if ( count($arResult['TRANSPORT']) > 0 && $arResult['TRANSPORT'][0]['main_trs'] == 1){
			$arResult['MAINTRANSPORT'] = array_shift($arResult['TRANSPORT']);
		}

		$query = "SELECT * FROM mon_exp_coords WHERE exp_id={$EXPEDITION_ID} ORDER BY num, id";
		$arTmp = $DB->getRecordsAssoc($query);
		foreach ($arTmp as $arItem) {
			switch (strtolower($arItem['record_type']) ){
				case 'shiproot':
					$arResult['COORDS']['shiproot'][] = $arItem;
					break;
				case 'mniregion':
					$arResult['COORDS']['mniregion'][] = $arItem;
					break;
				case 'mniroot':
					$arResult['COORDS']['mniroot'][] = $arItem;
					break;
				case 'mnishore':
					$arResult['COORDS']['mnishore'][] = $arItem;
					break;
				case 'mniice':
					$arResult['COORDS']['mniice'][] = $arItem;
					break;
//				case 'equip':
//					$arResult['COORDS']['equip'][] = $arItem;
//					break;
			}
		}
		$query = "SELECT t1.*, t2.equip_install, t2.equip_deinstall, t2.time_usage FROM
								(SELECT * FROM mon_exp_coords WHERE exp_id={$EXPEDITION_ID} AND record_type='equip' ORDER BY num, id) t1 LEFT JOIN
								(SELECT * FROM mon_exp_equip_dates) t2 ON
							t1.id=t2.coord_id";
		$arResult['COORDS']['equip'] = $DB->getRecordsAssoc($query);
//echo '<pre>';
//print_r($arResult['COORDS']['equip']);
//echo '</pre>';
		$query = "SELECT * FROM mon_exp_ports WHERE exp_id={$EXPEDITION_ID} ORDER BY num, id";
		$arTmp = $DB->getRecordsAssoc($query);
		foreach ($arTmp as $arItem) {
			switch (strtolower($arItem['record_type']) ){
				case 'ports':
					$arResult['PORTS']['ports'][] = $arItem;
					break;
			}
		}

		$query = "SELECT * FROM mon_exp_tables_comment WHERE exp_id={$EXPEDITION_ID} ";
		$arTmp = $DB->getRecordsAssoc($query);
		foreach ($arTmp as $arItem) {
				$arResult['TABLES_COMMENT'][$arItem['table_type']] = $arItem['comment'];
		}

		//$arResult['TABLES_COMMENT']

		$query = "SELECT * FROM mon_exp_mnitype WHERE exp_id={$EXPEDITION_ID} ORDER BY num, id";
		$arTmp = $DB->getRecordsAssoc($query);
		foreach ($arTmp as $arItem) {
				$arResult['MNITYPE']['meteo'][] = $arItem;
		}

		$query = "SELECT * FROM mon_exp_tech WHERE exp_id={$EXPEDITION_ID}";
		$arResult['TECH'] = $DB->getRecord($query);
		foreach ($arResult['TECH'] as &$arValue) {
			$arValue = str_replace('\\', '', $arValue);
		}

		$query = "SELECT * FROM mon_exp_equip WHERE exp_id={$EXPEDITION_ID} ORDER BY block, id";
		$arResult['EQUIP'] = $DB->getRecordsAssoc($query);

		$arResult['PREREPORT'] = array();
		$query = "SELECT * FROM mon_exp_files WHERE exp_id={$EXPEDITION_ID} ORDER BY create_date DESC, id DESC" ;
		$arResult['PREREPORT'] = $DB->getRecordsAssoc($query);

		$arResult['RECLAIMS'] = array();
		$query = "SELECT * FROM mon_reclaim_files WHERE exp_id={$EXPEDITION_ID} ORDER BY create_date DESC, id DESC";
		$arResult['RECLAIMS'] = $DB->getRecordsAssoc($query);

		$arResult["STATUS"] = array();
		switch ($arResult["EXPEDITION"]["status"]){
			case 0:
				$arResult["STATUS"] = array(0=>'Заполняется',10=>'Оформлен', 13=>'Отменен');
				break;
			case 10:
				$arResult["STATUS"] = array(10=>'Оформлен', 13=>'Отменен');
				break;
			case 11:
				$arResult["STATUS"] = array(11=>'Возвращен на доработку', 12=>'Доработан', 13=>'Отменен');
				break;
			case 12:
				$arResult["STATUS"] = array(12=>'Доработан', 13=>'Отменен');
				break;
			case 13:
				$arResult["STATUS"] = array(13=>'Отменен');
				break;
			case 20:
				if(date('Y-m-d') < $arResult["EXPEDITION"]["date_start"]){
					$arResult["STATUS"] = array(13=>'Отменен');
				}else{
					$arResult["STATUS"] = array(20=>'Принят');
				}
				break;
		}

		if( !in_array($arResult["EXPEDITION"]["status"], array(11, 0)) ){
			$arParams['template'] = '/readonly/template';
			$arParams['FORM_SEND_ENABLE'] = 'N';
		}
		if(isset($_REQUEST['act']) && $_REQUEST['act'] === 'copy'){
			$arParams['template'] = '';
			$arResult['RECLAIMS'] = array();
			$arResult["EXPEDITION"]["status"] = 0;
			$arResult["STATUS"] = array(0=>'Заполняется',10=>'Оформлен', 13=>'Отменен');
		}

	}
}else{
	$arResult['DEBTS'] = array();
		if(!$USER->isAdmin()){
				$limit_date = date( 'Y-m-d', mktime(0,0,0, date('m'), date('d')-DEADLINE_MAIN_REPORT, date('Y')) );
// This query checks all previous applications which report date (date_end+DEADLINE_MAIN_REPORT days) is overdue and haven't marks from control organizations.
		$query = "SELECT * FROM mon_exp_final_report t4 RIGHT JOIN
							(SELECT t1.exp_id, t1.mni_name, t2.* FROM
								(SELECT a1.mnitype, a1.exp_id, a2.mni_name FROM mon_exp_mnitype a1 left join mon_expedition a2 ON a1.exp_id=a2.id WHERE a2.user_id={$USER->getUserId()} 	AND a2.status =20 AND a2.date_end < '{$limit_date}'	AND a2.active =1	GROUP BY a1.mnitype) t1
								LEFT JOIN mon_group_mnitype t2 ON t1.mnitype=t2.mnitype GROUP BY t2.group_id) t3 ON t4.exp_id=t3.exp_id AND t3.group_id=t4.group_id WHERE t4.final_report IS NULL OR  t4.final_report = 0";
//	var_dump($query);
		$arResult['DEBTS'] = $DB->getRecordsAssoc($query);
		$query = 'SELECT * FROM mon_groups WHERE active=1';
		$arTmp = $DB->getRecordsAssoc($query);
		if(!empty($arTmp)){
			foreach ($arTmp as $arValue) {
				$arResult['USER_GROUPS'][$arValue['id']] = $arValue;
			}
		}else {
			$arResult['USER_GROUPS'] = array();
		}
		$arApplicant = $USER->getUserParams();
		$arResult['APPLICANT']['id'] = 0;
		$arResult['APPLICANT']['fullname'] = $arApplicant['orgNameFull'];
		$arResult['APPLICANT']['department'] = $arApplicant['orgDepartment'];
		$arResult['APPLICANT']['country'] = $arApplicant['country'];
		$arResult['APPLICANT']['city'] = $arApplicant['city'];
		$arResult['APPLICANT']['legaladdress'] = $arApplicant['legalAddress'];
		$arResult['APPLICANT']['phone'] = $arApplicant['phone'];
		$arResult['APPLICANT']['fax'] = $arApplicant['fax'];
		$arResult['APPLICANT']['telex'] = $arApplicant['telex'];
		$arResult['APPLICANT']['email'] = $arApplicant['contactEmail'];
		unset($arApplicant);

		getEmptySet($arResult);

	}
//	var_dump($arResult['USER_GROUPS']);

}

function getEmptySet(&$arResult){
		$arResult['EXECUTOR']['id'] = 0;
		$arResult['EXECUTOR']['fullname'] = '';
		$arResult['EXECUTOR']['country'] = '';
		$arResult['EXECUTOR']['city'] = '';
		$arResult['EXECUTOR']['legaladdress'] = '';
		$arResult['EXECUTOR']['phone'] = '';
		$arResult['EXECUTOR']['fax'] = '';
		$arResult['EXECUTOR']['telex'] = '';
		$arResult['EXECUTOR']['email'] = '';
		$arResult['EXECUTOR']['type'] = '';
		$arResult['EXECUTOR']['fio'] = '';
		$arResult['EXECUTOR']['country'] = '';
		$arResult['EXECUTOR']['workaddress'] = '';
		$arResult['EXECUTOR']['particip'] = '';

		$arResult['EXPEDITION']['status'] = 0;
		$arResult['EXPEDITION']['user_id'] = 0;
		$arResult['EXPEDITION']['mni_aim'] = '';
		$arResult['EXPEDITION']['mni_name'] = '';
		$arResult['EXPEDITION']['date_start'] = '';
		$arResult['EXPEDITION']['date_end'] = '';
		$arResult['EXPEDITION']['mni_spec'] = '';
		$arResult['EXPEDITION']['exp_ecology'] = '';
		$arResult['EXPEDITION']['exp_particip_rf'] = '';
		$arResult['EXPEDITION']['exp_use_result'] = '';

		$arResult['TRANSPORT'] = array();
		$arResult['PARTICIPANT'] = array();
		$arResult['COORDS'] = array("shiproot" =>array(), "mniregion" => array(), "mniroot" => array(), "mnishore" => array(), "mniice" => array(), "equip" => array());
		$arResult['TABLES_COMMENT'] = array();
		$arResult['PORTS'] = array("ports" =>array());
		$arResult['EQUIP'] = array();
		$arResult['MNITYPE'] = array("meteo"=>array());
		$arResult['TECH'] = array("exp_id"=>0);

}

if(!empty($arResult['EXPEDITION']['mni_name'])) { $PAGE->setPageTitle($arResult['EXPEDITION']['mni_name']); }


$arResult['BASE_URL'] = $PAGE->getBasePageUrl().'?1=1'.(isset($EXPEDITION_ID) ? '&eid='.$EXPEDITION_ID : null);

if(!empty($_REQUEST['print'])){	$PAGE->IncludeModule('print', $arResult); }

?>