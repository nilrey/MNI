<?php
class XMLDataMapping{
	var $arOrganizations = array(
		"MYSQL_TABLE_NAME" => 'mon_rb_organizations',
		"USER_FUNCTION" => 'userPrepareValue',
		"ORG_ID" => 'org_id',
		"NAME" => 'name',
		"SHORT_NAME" => 'short_name',
		"NAME_ENG" => 'name_eng',
		"SHORT_NAME_ENG" => 'short_name_eng',
		"COUNTRY_ENG" => 'country',
		"ADDRESS1" => 'address',
		"CITY" => 'city',
		"ADDRESS1_ENG" => 'address_eng',
		"CITY_ENG" => 'city_eng',
		"POSTAL_CODE" => 'postal_code',
		"PHONE1" => 'phone',
		"FAX1" => 'fax',
		"URL1" => 'www',
		"MEMO" => 'email'
	);

	var $arPorts = array(
		"MYSQL_TABLE_NAME" => 'mon_rb_ports',
//		"USER_FUNCTION" => 'userPrepareValue',
		"PORT_ID" => 'port_id',
		"NAME" => 'name',
		"NAME_ENG" => 'name_eng',
		"NORTH" => 'north',
		"SOUTH" => 'south',
		"WEST" => 'west',
		"EAST" => 'east',
	);

	var $arShips = array(
		"MYSQL_TABLE_NAME" => 'mon_rb_ships',
		"SHIP_ID" => 'ship_id',
		"NAME_RUS_" => 'name',
//		"NAME_ENG_" => '',
		"CALL_SIGN_" => 'rdsign',
		"SHORT_NAME_RU" => 'short_name',
//		"ORG_ID" => '',
//		"PLATFORM_ID" => '',
//		"START_DATE" => '',
		"LENGTH" => 'length',
		"BREADTH" => 'width',
		"DRAFT" => 'draught',
		"DISPLACEMANT" => 'displace',
//		"CRUISING_SPEED" => '',
		"IMO_NUMBER" => 'id',
//		"MEMO" => '',
	);

	var $arOrgDepartments = array(
		"MYSQL_TABLE_NAME" => 'mon_rb_organizations',
		"ORG_ID" => "org_id",
		"DEPT_ID" => "dept_id",
	);

	var $arDepartments = array(
		"MYSQL_TABLE_NAME" => 'mon_rb_departments',
		"ORG_ID" => "org_id",
		"NAME" => "name",
		"NAME_ENG" => "name_eng",
		"SHORT_NAME" => "short_name",
		"SHORT_NAME_ENG" => "short_name_eng",
	);

	var $arCountry = array(
		"MYSQL_TABLE_NAME" => 'mon_rb_countries',
		"name" => "name",
		"fullname" => "fullname",
		"english" => "name_eng",
		"iso" => "id",
//		"iso" => "iso",
		"location" => "location",
		"location-precise" => "region",
	);


	function getXMLDataMapping($name){
		return $this->$name;
	}
}
?>