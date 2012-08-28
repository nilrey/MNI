<?php
function getReferenceBook($rb_name, $order=''){
	if(empty($order)) $order = 'name';
	global $DB;
	$query = "SELECT * FROM mon_rb_{$rb_name} WHERE active=1 ORDER BY {$order}";
	$result = $DB->getRecordsAssoc($query);
	return $result;
}
?>