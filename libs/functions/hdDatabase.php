<?php
function getReferenceBook($rb_name, $order='name'){
	global $DB;
	$query = "SELECT * FROM mon_rb_{$rb_name} WHERE active=1 ORDER BY {$order}";
	$result = $DB->getRecordsAssoc($query);
	return $result;
}

function getMNITypeGroups(){
	global $DB;
	$query = "SELECT t1.*, t2.name FROM `mon_group_mnitype` t1 LEFT JOIN mon_groups t2 ON t1.`group_id` = t2.id WHERE t2.active=1";
	$result = $DB->getRecordsAssoc($query);
	return $result;
}

?>