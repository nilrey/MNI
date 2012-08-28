<?require($_SERVER["DOCUMENT_ROOT"]."/header.php");
$PAGE->setPageAccess(array(1));
?>

<? $PAGE->IncludeComponent('refbooks.import', 
array(
	"FILE_FIELDS" => array("ORG_ID", "NAME", "SHORT_NAME", "NAME_ENG", "SHORT_NAME_ENG", "COUNTRY", "COUNTRY_ENG", "ADDRESS1", "CITY", "ADDRESS1_ENG", "CITY_ENG", "POSTAL_CODE", "PHONE1", "FAX1", "URL1", "MEMO"), 
	"PARENT_TAG" => "ROW", 
	"MAPPING_CODE" => "arOrganizations", 
	"DEBUG" => false)
); ?>

<?require($_SERVER["DOCUMENT_ROOT"]."/footer.php");?>