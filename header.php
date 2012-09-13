<?
session_start();
//session_regenerate_id(true);

if(is_file($_SERVER["DOCUMENT_ROOT"].'/libs/functions/output.php')){
	include_once('libs/functions/output.php');
	if(!outputHandlerOn()){
		die('Cannot find outputHandlerOn() in \'output.php\'');
	}
	outputHandlerOpen();
}else{
	die('Cannot find '.$_SERVER["DOCUMENT_ROOT"].'\'/libs/functions/output.php\'');
}

try{

include_once('const.php');
include_once('config.php');
include_once('libs/classes/logwriter.class.php');
include_once('libs/classes/mysql.class.php');
include_once('libs/classes/XMLDataMapping.class.php');
include_once('libs/classes/userinfo.class.php');
include_once('libs/classes/page.class.php');
include_once('libs/functions/hdDatabase.php');
include_once('libs/functions/support.php');
include_once('libs/functions/mail.php');
include_once('libs/functions/htmlWrapper.php');
//include_once('libs/classes/menu.class.php');

$CONF = new Config();
@$PAGE = new CPage();
$DB = new clMySQLi($CONF->mysqlHost, $CONF->mysqlUser, $CONF->mysqlPass, $CONF->mysqlDb);
$DB->set_charset("utf8");
$XMLMapping = new XMLDataMapping();
$USER = new CUser();

// Authorization
include_once('libs/includes/authorization.php');

$PAGE->setUserParams($USER);
$PAGE->setTemplateMain('esimo');
$PAGE->setPathMainTemplate('templates/'.$PAGE->getTemplateMain().'/');

outputHandlerCut(&$PAGE->arOutput);

}catch (Exception $ex){
	$DB->close();
//	session_destroy();
}
?>