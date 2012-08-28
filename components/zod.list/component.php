<?php
global $DB;

if(!$USER->isAdmin()){
	$checkUser = "user_id={$USER->getUserId()} AND status > 0 AND";
}

$limit_date = date( 'Y-m-d', mktime(0,0,0, date('m'), date('d')-DEADLINE_MAIN_REPORT, date('Y')) );
// get statuses depend on user Role
$arResult['STATUS'] = array(0=>'Заполняется', 10=>'Оформлен', 11=>'Возвращен на доработку', 12=>'Доработан', 20=>'Принят', 21=>'Прекращен', 22=>'Приостановлен', 30=>'Выполнен');

$query = "
SELECT t3.*, t4.final_report FROM (
	SELECT t1.*, t2.mnitype FROM mon_expedition t1
		LEFT JOIN (SELECT exp_id, mnitype FROM mon_exp_mnitype WHERE mnitype IN 
		(
		SELECT mnitype FROM mon_group_mnitype WHERE group_id IN (".implode(', ', $USER->getGroups()).")
		) GROUP BY exp_id)t2 
	ON t1.id = t2.exp_id
	WHERE t1.status =20
	AND t1.date_end < '{$limit_date}'
	AND t1.active =1) t3 
LEFT JOIN
( SELECT * FROM mon_exp_final_report WHERE group_id IN (".implode(', ', $USER->getGroups()).")) t4 
ON
t3.id=t4.exp_id
";
//		var_dump($query);
$arResult['EXPEDITIONS'] = $DB->getRecordsAssoc($query);
?>