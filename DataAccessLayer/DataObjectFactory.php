<?php

include("DataObjectInterface.php");
include("PDOInterface.php");

class DataObjectFactory {

	private $dataObjectSelection = "PDO";

	public function getDataObject() {
			if ($this->dataObjectSelection == "PDO") {
				$dataobject = new PDOInterface();
			}	// else ....
			//Open for extensibility
			return $dataobject;
	}

}