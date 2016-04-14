<?php 

class PDOFactory {
	
	private $dataobject;
	private $statements;
	
	public function create() {
		include("databaseSettings.php");
		
		$this->dataobject = new PDO($database_server_name, $database_username, $database_password);
		
		return $this->dataobject;
		
	}
	
	public function execute($sqlstatements) {
		
		try {
			$this->statements = $this->dataobject->query($sqlstatements);
		} catch (PDOException $e) {
			echo "Connection failed: ". $e.getMessage();
		}
		return $this->statements;
		
	}
	
	public function fetch($result) {
		
		if ($result) {
			return $this->statements->fetch();
		} else return;
		
	}
	
	
}

?>