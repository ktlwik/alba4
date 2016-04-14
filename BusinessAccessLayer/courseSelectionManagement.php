<?php

	include("../DataAccessLayer/startDatabase.php");
	//if (isset($_POST['delimg'])) echo "1"; else echo "0";
	if (isset($_POST['addCourseSubmitBtn'])) {
		addCourse();
	} else if (isset($_POST['editIndexSubmitBtn'])) {
		editIndex();
	} else {
		dropCourse();
	}

	function addCourse() {
		if(!empty($_POST['courseid'])) {
			$courseID = $_POST['courseid'];
			$referenceID = 1;// < --- need to change
			$timetableID = 4;

			$res = mysql_query("SELECT * FROM `timetable` WHERE `referenceID` = '$referenceID' 
														AND `timetableID` = '$timetableID' AND `courseID` = '$courseID'");
			if ($res) $arg = mysql_fetch_array($res);
			if(!empty($arg['courseID']))  {header("Location: ../Alba4.php"); die();}
			$res = mysql_query("SELECT * FROM `classes` WHERE `courseID` = '$courseID'");
			if ($res) $arg = mysql_fetch_array($res);
			$classes = array();
			$n = 0;
			while (!empty($arg['courseID'])) {
				$classID = $arg['id'];
				++$n;
				$classes[$n] = $classID;
				$arg = mysql_fetch_array($res);
			}
			$class = array_unique($classes);
			$class = array_values($class);
			$len = count ($class);
			for ($i = 0; $i < $len; ++$i) {
				$classID = $class[$i];
				$r = mysql_query("INSERT INTO `timetable` (`classID`, `courseID`, `referenceID`, `timetableID`, `flag`) VALUES ('$classID', '$courseID', '$referenceID', '$timetableID', '1')");
			} 
			{header("Location: ../Alba4.php"); die();}
		}
	}
	
	function dropCourse() {
		 $courseID = $_GET['courseid'];

		 $referenceID = 1;// < --- need to change
		 $timetableID = 4;

		 $res = mysql_query ("DELETE FROM `timetable` WHERE `referenceID` = '$referenceID' 
														AND `timetableID` = '$timetableID' AND `courseID` = '$courseID'");
		 {header("Location: ../Alba4.php"); die();}
	}
	
	function editIndex() {
		include("../DataAccessLayer/startDatabase.php");
		  $referenceID = 1;// < --- need to change
		  $timetableID = 4;
		  $res = mysql_query("UPDATE `timetable` SET `flag` = '0' WHERE `referenceID` = '$referenceID' AND `timetableID` = '$timetableID'");
			
		  foreach ($_POST['courseindex'] as $info) {
			//echo $info. "<br>";
			$pieces = explode("-", $info);
			$courseID = $pieces[0];
			$classID = $pieces[1];
			//echo $courseID. " ". $classID. "<br>";
			//$res = mysql_query ("UPDATE `users` SET `name`='$name',`surname`='$surname',`class`='$class' WHERE `login`='$login'");
		  
			$res = mysql_query("UPDATE `timetable` SET `flag` = '1' WHERE `referenceID` = '$referenceID' 
			  AND `timetableID` = '$timetableID' AND `classID` = '$classID' AND `courseID` = '$courseID'");
		  }
		  
		  {header("Location: ../Alba4.php"); die();}
	}



?>