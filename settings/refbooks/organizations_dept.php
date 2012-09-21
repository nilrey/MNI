<?require($_SERVER["DOCUMENT_ROOT"]."/header.php");
$PAGE->setPageAccess(array(1));
?>

<?
/*$arr1 = array('field1','field2','field3','field4');
$arr2 = array('value1','value2','value3','value4');
$res = array_combine($arr1, $arr2);
$str1 = '#FIELD#="'. implode('", #FIELD#="', $arr2) .'"';
$res = str_replace(array('#FIELD#'), $arr1, $str1);
echo $res;*/
$PAGE->IncludeComponent('refbooks.import',
array(
	"FILE_FIELDS" => array("ORG_ID", "DEPT_ID"),
	"MAIN_FIELD" => "ORG_ID",
	"PARENT_TAG" => "ROW",
	"MAPPING_CODE" => "arOrgDepartments",
	"IS_UPDATE" => "Y",
	"DEBUG" => false)
); ?>

<?require($_SERVER["DOCUMENT_ROOT"]."/footer.php");?>