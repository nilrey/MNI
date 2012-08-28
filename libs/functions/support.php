<?php
function accessAdminOnly(){
	global $USER;
	if(!$USER->isAdmin()){ 	header("location: /404.php"); }
}

function prepareValue($value){
	if(!empty($value)){
		$value = trim($value);
		$value = str_replace(array('\\', '«', '»'), array('', '"', '"'),  $value);
		$value = mysql_escape_string($value);
//		$value = html_entity_decode($value);
	}else{
		return '';
	}
	return $value;
}

function prepareString($value){
	return htmlspecialchars(stripslashes($value));
}

function requiredTitle($title, $id, $mark = true){
	return "<a name='#anc_{$id}'></a><span id='req_{$id}'>{$title}".($mark ? "&nbsp;".requiredMark()."</span>&nbsp;" : "</span>");
}

function requiredMark(){
	return "<span class='reqFieldMark'>*</span>";
}

function prepareRefBooksValue($value){
	if(!empty($value)){
		$value = trim($value);
		$value = str_replace(array('&lt;a&gt;', '<a>', chr(10), chr(13), '\\'), array('@', '@', ' ', '', ''),  $value);
		$value = mysql_escape_string($value);
		$value = html_entity_decode($value);
	}else{
		return '';
	}
	return $value;
}

function deleteQuery($sql, $table_name='', $id=0 ){
	global $DB;
	if($id>0 && !empty($table_name)){
		$query = "DELETE FROM {$table_name} WHERE id={$id}";
		$res = $DB->setRecord($query);
	}elseif (!empty($sql)){
		$res = $DB->setRecord($sql);
	}
}

function constructQueryInsert($sql, $table_name, $arFieldsValues, $arTableFields, &$arError ){
	global $DB;
	foreach ($arFieldsValues as $field=> $value) {
		if(is_array($arTableFields) && in_array($field, $arTableFields)){
			$arFields[] = trim($field);
			$arValues[] = trim($value);
		}
	}
	if(!empty($table_name) && count($arFields) > 0 && count($arFields)==count($arValues)){
		$strFields = implode(", ", $arFields);
		$strValues = "'".implode("', '", $arValues)."'";
		if(empty($sql)) $sql = "INSERT INTO {$table_name} (##STRFIELDS##) VALUES (##STRVALUES##)";
		$query = str_replace(array('##STRFIELDS##', '##STRVALUES##'), array($strFields, $strValues), $sql);

//		echo '<pre>', print_r($query), '</pre>';

		$res = $DB->setRecord($query);
		if( $res == false ){
				$ERR[] = 'INSERT_ERROR';
				$ERR[] = $query;
				$arError[] = $ERR;
			return 0;
		}
	}

	return $res;
}

function constructQueryUpdate($sql, $table_name, $arFieldsValues, $arTableFields, &$arError, $id = 0 ){
	global $DB;
	$res = 0;
	$id = intval($id);
	if(count($arFieldsValues) > 0 && count($arTableFields) > 0){
		foreach ($arFieldsValues as $strField => $strValue){
			if(in_array($strField, $arTableFields)){
				$arUpdateFields[] = trim($strField)."='".trim($strValue)."'";
			}
		}
		$strUpdateFields = implode(", ", $arUpdateFields);
	}

	if($id > 0){
		if(!empty($table_name)){
			if( empty($sql)) $sql = "UPDATE {$table_name} SET ##UPDATE_FIELDS## WHERE id={$id}";

			$query = str_replace( '##UPDATE_FIELDS##' , $strUpdateFields , $sql);
			$res = $DB->updateRecord($query);
			if( $res == false ){
				$ERR[] = 'UPDATE_ERROR';
				$ERR[] = $query;
				$arError[] = $ERR;
			}
		}
	}elseif (!empty($sql)){
		$query = str_replace( '##UPDATE_FIELDS##' , $strUpdateFields , $sql);
		$res = $DB->setRecord($query);
	}
	return $res;
}

function checkStringDate($stringDate){
	if(empty($stringDate) || $stringDate === '0000-00-00'){
		return false;
	}
	$date = new DateTime($stringDate);
	return checkdate( $date->format('m'), $date->format('d'), $date->format('Y'));
}

function getDateFormated($value, $def=null){
	if( !checkStringDate( $value )){
		if(empty($def)){
			return date('Y').'-01-01';
		}else{
			return $def;
		}
	}
	return $value;
}

?>