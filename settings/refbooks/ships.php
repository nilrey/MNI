<?require($_SERVER["DOCUMENT_ROOT"]."/header.php");
$PAGE->setPageAccess(array(1));
?>
<? $PAGE->IncludeComponent('refbooks.import', array("FILE_FIELDS" => array(
"SHIP_ID",
"NAME_RUS_",
//"NAME_ENG_",
"CALL_SIGN_",
"SHORT_NAME_RU",
//"ORG_ID",
//"SHORT_NAME_",
//"PLATFORM_ID",
//"START_DATE",
"LENGTH",
"BREADTH",
"DRAFT",
"DISPLACEMANT",
//"CRUISING_SPEED",
"IMO_NUMBER",
//"MEMO",

), "PARENT_TAG" => "ROW", "MAPPING_CODE" => "arShips", "DEBUG" => false)); ?>

<?require($_SERVER["DOCUMENT_ROOT"]."/footer.php");?>