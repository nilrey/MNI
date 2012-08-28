<?
include_once('config.php');
include_once('libs/classes/mysql.class.php');
$CONF = new Config();
$DB = new clMySQLi($CONF->mysqlHost, $CONF->mysqlUser, $CONF->mysqlPass, $CONF->mysqlDb);
$DB->set_charset("utf8");
$DB->query( "INSERT INTO  mon_rb_ships ( `name_eng` ,`name` ,`active`)VALUES ( 'ship_name',  'название судна',  '1')");
$query = "SELECT * FROM  mon_rb_ships ";
$arRes = $DB->getRecordsAssoc($query);
var_dump($arRes);
?>