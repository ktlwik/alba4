<?php

	interface DataObjectInterface {
	
		public function create();
		public function execute($sqlstatement);
		public function fetch($result);
	
	}


?>