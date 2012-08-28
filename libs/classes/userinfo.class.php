<?php
class CUser{
	private $name = '';
	private $login = '';
	private $id = 0;
	private $group = array();
	private $authorization_error = false;
	private $authorization_message = false;
	private $secureHash = '';
	private $arUserParams = array();

	public function isAuthorizationError(){
		return $this->authorization_error;
	}

	public function getAuthorizationErrorMessage(){
		return $this->authorization_message;
	}

	public function setAuthorizationError($value){
		if($value === true){
			$this->authorization_error = true;
		}else{
			$this->authorization_error = false;
		}
		return ;
	}

	public function setAuthorizationErrorMessage($value){
		$this->authorization_message = $value;
		return ;
	}

	//

	public function __construct() {
		$this->group = array( $this->getDefultGroup() );
	}

	function getDefultGroup(){
		return 2;
	}

	private function getAdminGroup(){
		return 1;
	}

	function setUserId($value){
		$this->id = intval($value);
	}
	function getUserId(){
		return $this->id;
	}
	function setUserName($value){
		$this->name = $value;
	}
	function getUserName(){
		return $this->name;
	}
	function setGroups($value){
		if(empty($value)) {
			$value = array( $this->getDefultGroup() );
		}elseif (is_array($value) && count($value) > 0 ){
			foreach ($value as $group) {
				$this->group[] = $group;
			}
		}else if(is_numeric($value)){
			$this->group = array($group);
		}
	}
	function getGroups(){
		return $this->group;
	}
	function setLogin($value){
		$this->login = $value;
	}
	function getLogin(){
		return $this->login;
	}
	function isAdmin(){
		$adminGroup = array( $this->getAdminGroup() );
		foreach ($this->group as $group){
			if( in_array($group , $adminGroup) ){
				return true;
			}
		}
		return false;
	}

	private function setSecure($value){
		$this->secureHash = $value;
		return false;
	}
	public function getSecure(){
		return $this->secureHash;
	}

	private function setUserParams($arInfo){
		$arUserParams["id"] = $arInfo["id"];
		$arUserParams["name"] = $arInfo["name"];
		$arUserParams["orgNameFull"] = $arInfo["orgNameFull"];
		$arUserParams["orgNameShort"] = $arInfo["orgNameShort"];
		$arUserParams["orgDepartment"] = $arInfo["orgDepartment"];
		$arUserParams["country"] = $arInfo["country"];
		$arUserParams["city"] = $arInfo["city"];
		$arUserParams["legalAddress"] = $arInfo["legalAddress"];
		$arUserParams["phone"] = $arInfo["phone"];
		$arUserParams["fax"] = $arInfo["fax"];
		$arUserParams["telex"] = $arInfo["telex"];
		$arUserParams["contactPhone"] = $arInfo["contactPhone"];
		$arUserParams["contactEmail"] = $arInfo["contactEmail"];

		$this->arUserParams =	$arUserParams;
	}

	function refreshUserParamsSession($arInfo){
		$_SESSION['CUSER']["id"] = $arInfo["id"];
		$_SESSION['CUSER']["name"] = $arInfo["name"];
		$_SESSION['CUSER']["orgNameFull"] = $arInfo["orgNameFull"];
		$_SESSION['CUSER']["orgNameShort"] = $arInfo["orgNameShort"];
		$_SESSION['CUSER']["orgDepartment"] = $arInfo["orgDepartment"];
		$_SESSION['CUSER']["country"] = $arInfo["country"];
		$_SESSION['CUSER']["city"] = $arInfo["city"];
		$_SESSION['CUSER']["legalAddress"] = $arInfo["legalAddress"];
		$_SESSION['CUSER']["phone"] = $arInfo["phone"];
		$_SESSION['CUSER']["fax"] = $arInfo["fax"];
		$_SESSION['CUSER']["telex"] = $arInfo["telex"];
		$_SESSION['CUSER']["contactPhone"] = $arInfo["contactPhone"];
		$_SESSION['CUSER']["contactEmail"] = $arInfo["contactEmail"];
	}

 function getUserParams(){
		return $this->arUserParams;
	}

	function authorizeUser($login, $password){
		// проверка на посторонние символы
		$arRes = array();
		if( preg_match("/[`~!@#$%^&*()-+=<>\\?\'|\"]+/i", $login) > 0){
			return false;
		}else	if( preg_match("/[`~!@#$%^&*()-+=<>\\?\'|\"]+/i", $password) > 0){
			return false;
		}
		// проверка в БД
		global $DB;
		$query = sprintf("SELECT * FROM mon_users WHERE login='%s' AND pass='%s' AND active=1",
            $DB->real_escape_string($login),
            md5($password));
//            var_dump($query);
		$arRes = $DB->getRecord($query);

		if(intval($arRes['id']) > 0){
			$query = sprintf("SELECT group_id FROM mon_usergroups WHERE user_id='%d'", intval($arRes['id']) );
			$arRes['groups'] = $DB->getSingleFieldArray($query);
			$arRes['SECURE_HASH'] = md5(rand());
			$this->fillInfo($arRes);
			$this->fillInfo($arRes);
		}else{
			return false;
		}
		return $arRes;
	}

	function fillInfo($arInfo){
		$this->setUserName($arInfo['name']);
		$this->setUserId($arInfo['id']);
		$this->setGroups($arInfo['groups']);
		$this->setSecure($arInfo['SECURE_HASH']);
		$this->setUserParams($arInfo);
		$_SESSION['CUSER'] = $arInfo;
	}

}
?>