<?require($_SERVER["DOCUMENT_ROOT"]."/header.php");
$PAGE->setPageAccess(array(5, 6, 7, 8, 9, 10));
?>
<? $PAGE->IncludeComponent('zod.list');?>

<?require($_SERVER["DOCUMENT_ROOT"]."/footer.php");?>