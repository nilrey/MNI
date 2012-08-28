<?php

function userPrepareValue($fieldName, &$fieldValue){
	if($fieldName == 'COUNTRY_ENG'){
		global $DB;
		$query = sprintf("SELECT id FROM mon_rb_countries WHERE name_eng='%s' ",
	          $DB->real_escape_string($fieldValue));
		$res = $DB->getRecord($query);
		$fieldValue = $res['id'];
	}
}

if(!empty($_FILES['import_file']) && !empty($arParams['FILE_FIELDS'])){
//	var_dump($_FILES);
	$cont = file_get_contents($_FILES["import_file"]["tmp_name"]);

	global $DB;
	global $XMLMapping;
	$arDataMapping = $XMLMapping->getXMLDataMapping($arParams['MAPPING_CODE']);
	$DB->query("TRUNCATE TABLE {$arDataMapping['MYSQL_TABLE_NAME']}");
	$sql = "INSERT INTO {$arDataMapping['MYSQL_TABLE_NAME']} (##STRFIELDS##) VALUES (##STRVALUES##)";
	$arFields = array();
	$arValues = array();
	$counter = 0;
	
	$reader = new XMLReader(); 
  $reader->open($_FILES["import_file"]["tmp_name"]); 
	while ($reader->read()) { 
	 switch ($reader->nodeType) { 
	   case (XMLREADER::ELEMENT): 
	   //var_dump($reader->name);
				$fieldName = $reader->name; 
				if ( in_array($fieldName , $arParams['FILE_FIELDS']) &&  array_key_exists($fieldName ,$arDataMapping)){ 
					if(!in_array($arDataMapping[$fieldName], $arFields)){
						$arFields[] = $arDataMapping[$fieldName]; 
						$reader->read();
						$fieldValue = prepareRefBooksValue($reader->value); 
						if(!empty($arDataMapping['USER_FUNCTION'])){
							$arDataMapping['USER_FUNCTION']($fieldName, &$fieldValue);
						}
						$arValues[] = $fieldValue;
					}
				}elseif ($reader->name == $arParams['PARENT_TAG'] ){
//					var_dump(count($arValues));
//					var_dump(count($arFields));
					if(count($arValues) > 0 && count($arValues) == count($arFields)){
						$strFields = implode(", ", $arFields);
						$strValues = "'".implode("', '", $arValues)."'";

						$query = str_replace(array('##STRFIELDS##', '##STRVALUES##'), array($strFields, $strValues), $sql);
						echo '<p>Row: '.++$counter;
						$res = $DB->setRecord($query);
						if( intval($res) < 1 ){
							echo ' error</p>';
							$arError[] = $query;
						}else {
							echo " success</p>";
						}
					}
					$arFields = array();
					$arValues = array();
				}
			break; 
	
		}
	}
	if($arParams['DEBUG']){
		echo '<pre>'. print_r($arError).'</pre>';
	}
	
}
?>