<?require($_SERVER["DOCUMENT_ROOT"]."/header.php");
$PAGE->setPageAccess(array(1));
?>

<? $PAGE->IncludeComponent('refbooks.import', array("FILE_FIELDS" => array(
"ORG_ID",
"NAME",
"NAME_ENG",
"SHORT_NAME",
"SHORT_NAME_ENG",
), "PARENT_TAG" => "ROW", "MAPPING_CODE" => "arDepartments", "DEBUG" => false)); ?>

<?require($_SERVER["DOCUMENT_ROOT"]."/footer.php");?>