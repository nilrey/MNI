<?php

class clMySQLi extends mysqli {
    public function __construct($host, $user, $pass, $db) {
        parent::__construct($host, $user, $pass, $db);

        if (mysqli_connect_error()) {
            die('Connect Error (' . mysqli_connect_errno() . ') '
                    . mysqli_connect_error());
        }
    }
    public function setQuery($query){
    	$this->query($query);
    	return ;
    }
    public function getRecord($query){
    	$result = array();
    	$resource = $this->query($query);
			if( $row = $resource->fetch_assoc() ){
        $result = $row;
    	}
			$resource->close();
    	return $result;
    }
    public function getRecordsAssoc($query){
    	$result = array();
    	$resource = $this->query($query);
			while( $row = $resource->fetch_assoc() ){
        $result[] = $row;
    	}
			$resource->close();
    	return $result;
    }

    public function getRecordsArray($query){
    	$result = array();
    	$resource = $this->query($query);
			while( $row = $resource->fetch_row() ){
        $result[] = $row; //printf("%s (%s)\n", $row['name'], $row['login']);
    	}
			$resource->close();
    	return $result;
    }

    public function getSingleFieldArray($query){
    	$result = array();
    	$resource = $this->query($query);
			while( $row = $resource->fetch_row() ){
        $result[] = $row[0];
    	}
			$resource->close();
    	return $result;
    }

    public function setRecord($query){
    	$result = array();
    	$this->query($query);
    	$id = $this->insert_id;
    	if( intval($id) < 1){
    		return false;
    	}
    	return $id;
    }

    public function updateRecord($query){
    	$result = array();
    	$this->query($query);
    	return true;
    }

    public function getTableFields($tableName){
    	if(strlen($tableName) > 0){
    		$query = " describe {$tableName}";
	    	$resource = $this->query($query);
				while( $row = $resource->fetch_row() ){
	        $result[] = $row[0];
	    	}
				$resource->close();
    	}
    	return $result;
    }

}




class clMySQL {
	var $connect ;
	public function __construct($host, $user, $pass, $db) {
		$this->connect = mysql_connect($host, $user, $pass);
		mysql_select_db($db, $this->connect);
		mysql_query("SET NAMES 'utf8'", $this->connect);
	}

	function query($query){
		$resource = mysql_query($query, $this->connect);
		return true;
	}
  public function getRecord($query){
  	$result = array();
  	$resource = mysql_query($query, $this->connect);
		if( $row = mysql_fetch_assoc($resource) ){
      $result = $row;
  	}
  	return $result;
  }
  public function getRecordsAssoc($query){
  	$result = array();
  	$resource = mysql_query($query, $this->connect);
		if( $row = mysql_fetch_assoc($resource) ){
      $result[] = $row;
  	}
  	return $result;
  }
  public function getRecordsArray($query){
  	$result = array();
  	$resource = mysql_query($query, $this->connect);
		if( $row = mysql_fetch_row($resource) ){
      $result[] = $row[0]; //printf("%s (%s)\n", $row['name'], $row['login']);
  	}
  	return $result;
  }

}

?>