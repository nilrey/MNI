<?require($_SERVER["DOCUMENT_ROOT"]."/header.php");
$PAGE->setPageAccess(array(1));
?>

<? $PAGE->IncludeComponent('refbooks.import', array("FILE_FIELDS" => array("name", "fullname", "english", "iso", "location", "location-precise"), "PARENT_TAG" => "country", "MAPPING_CODE" => "arCountry", "DEBUG" => false)); ?>

<?require($_SERVER["DOCUMENT_ROOT"]."/footer.php");?>