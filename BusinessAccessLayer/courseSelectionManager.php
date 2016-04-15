<?php
	include("../DataAccessLayer/DataObjectFactory.php");
	
	if (isset($_POST['addCourseSubmitBtn'])) {
		addCourse();
	} else if (isset($_POST['editIndexSubmitBtn'])) {
		editIndex();
	} else {
		dropCourse();
	}

	function addCourse() {	
		$datafactory = new DataObjectFactory();
		$dataobject = $datafactory->getDataObject();
		$dataobject->create();
		if(!empty($_POST['courseid'])) {
			$courseID = $_POST['courseid'];
			$referenceID = 1;// < --- need to change
			$timetableID = 4;

			$sqlstatement = "SELECT * FROM `timetable` WHERE `referenceID` = '$referenceID' 
											AND `timetableID` = '$timetableID' AND `courseID` = '$courseID'";
			$result = $dataobject->execute($sqlstatement);
			$arg = $dataobject->fetch($result);
			
			if(!empty($arg['courseID']))  {header("Location: ../Alba4.php"); die();}
			
			$sqlstatement = "SELECT * FROM `classes` WHERE `courseID` = '$courseID'";
			$result = $dataobject->execute($sqlstatement);
			$arg = $dataobject->fetch($result);
			
			$classes = array();
			$n = 0;
			while (!empty($arg['courseID'])) {
				$classID = $arg['id'];
				++$n;
				$classes[$n] = $classID;
				$arg = $dataobject->fetch($result);
			}
			$class = array_unique($classes);
			$class = array_values($class);
			$len = count ($class);
			for ($i = 0; $i < $len; ++$i) {
				$classID = $class[$i];
				$sqlstatement = "INSERT INTO `timetable` (`classID`, `courseID`, `referenceID`, `timetableID`, `flag`) VALUES ('$classID', '$courseID', '$referenceID', '$timetableID', '1')";
					$result = $dataobject->execute($sqlstatement);
			} 
			{header("Location: ../Alba4.php"); die();}
		}
	}
	
	function dropCourse() {	
		$datafactory = new DataObjectFactory();
		$dataobject = $datafactory->getDataObject();
		$dataobject->create();
		 $courseID = $_GET['courseid'];

		 $referenceID = 1;// < --- need to change
		 $timetableID = 4;

		 $sqlstatement = "DELETE FROM `timetable` WHERE `referenceID` = '$referenceID' 
						AND `timetableID` = '$timetableID' AND `courseID` = '$courseID'";
		$result = $dataobject->execute($sqlstatement);
		 include("../DataAccessLayer/databaseSettings.php");
		$database = new PDO($database_server_name, $database_username, $database_password);
		 {header("Location: ../Alba4.php"); die();}
	}
	
	function editIndex() {	
		$datafactory = new DataObjectFactory();
		$dataobject = $datafactory->getDataObject();
		$dataobject->create();
		  $referenceID = 1;// < --- need to change
		  $timetableID = 4;
	
		$sqlstatement = "UPDATE `timetable` SET `flag` = '0' WHERE `referenceID` = '$referenceID' AND `timetableID` = '$timetableID'";
		$result = $dataobject->execute($sqlstatement);
			
		foreach ($_POST['courseindex'] as $info) {
			$pieces = explode("-", $info);
			$courseID = $pieces[0];
			$classID = $pieces[1];
			
			$sqlstatement = "UPDATE `timetable` SET `flag` = '1' WHERE `referenceID` = '$referenceID' 
			  AND `timetableID` = '$timetableID' AND `classID` = '$classID' AND `courseID` = '$courseID'";
			$result = $dataobject->execute($sqlstatement);
		}
		  
		{header("Location: ../Alba4.php"); die();}
	}

?>