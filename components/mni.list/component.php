<?php
global $DB;
$arResult['REFBOOK']['departments'] = getReferenceBook('departments');
$arResult['QSTRING'] = '';

if(!empty($_REQUEST['SEARCH'])){
	$arResult['SEARCH'] = $_REQUEST['SEARCH'];
	$department = '';
	$kw_mni = '';
	$kw_org = '';
	foreach ($arResult['SEARCH'] as $key=>$value){
		$arResult['QSTRING'] .= "&SEARCH[{$key}]={$value}";
		switch ($key){
			case 'kw_mni':
				$arTmp = split(' ', $value);
				$kw_mni = ' AND (';
				$i=0;
				foreach ($arTmp as $value) {
					$i>0 ? $kw_mni .= ' OR ' : $i++;
					$kw_mni .= " mni_name LIKE '%{$value}%' OR mni_aim LIKE '%{$value}%'";
				}
				$kw_mni .= ')';
				break;
			case 'department':
				$department = "AND department=".intval($value);
				$where .= ' AND department IS NOT NULL';
				break;
			case 'kw_org':
				$arTmp = split(' ', $value);
				$kw_org = ' AND (';
				$i=0;
				foreach ($arTmp as $value) {
					$i>0 ? $kw_org .= ' OR ' : $i++;
					$kw_org .= " fullname LIKE '%{$value}%' ";
				}
				$kw_org .= ')';
				
				break;
		}
	}
	$query = "
	SELECT * FROM
	(SELECT * FROM mon_expedition WHERE status IN (20, 21, 22,  30) AND active=1 {$kw_mni}) t1
	LEFT JOIN 
	(SELECT exp_id, fullname, department FROM mon_exp_org WHERE 1=1 {$department} {$kw_org}) t2
	ON t1.id=t2.exp_id WHERE 1=1 {$where} GROUP BY t1.id
	";
}else{
	$query = "SELECT * FROM mon_expedition WHERE status IN (20, 21, 22,  30) AND active=1";
}
//	var_dump($query);


// get statuses depend on user Role
$arResult['STATUS'] = array(0=>'Заполняется', 10=>'Оформлен', 11=>'Возвращен на доработку', 12=>'Доработан', 20=>'Принят', 21=>'Прекращен', 22=>'Приостановлен', 30=>'Выполнен');
$arResult['EXPEDITIONS'] = $DB->getRecordsAssoc($query);
?>