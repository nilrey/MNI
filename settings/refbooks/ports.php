<?require($_SERVER["DOCUMENT_ROOT"]."/header.php");
$PAGE->setPageAccess(array(1));
?>

<? $PAGE->IncludeComponent('refbooks.import', array("FILE_FIELDS" => array("PORT_ID", "NAME", "NAME_ENG", "NORTH", "SOUTH", "WEST", "EAST"), "PARENT_TAG" => "ROW", "MAPPING_CODE" => "arPorts", "DEBUG" => false)); ?>

<?require($_SERVER["DOCUMENT_ROOT"]."/footer.php");?>