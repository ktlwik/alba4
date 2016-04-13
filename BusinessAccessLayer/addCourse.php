<?php
 echo "Big brother's here!!!";
if(!empty($_POST['courseid'])) {
	$courseID = $_POST['courseid'];
	$referenceID = 1;// < --- need to change
	$timetableID = 4;

	include("../DataAccessLayer/startDatabase.php");
	$res = mysql_query("SELECT * FROM `timetable` WHERE `referenceID` = '$referenceID' 
		                                        AND `timetableID` = '$timetableID' AND `courseID` = '$courseID'");
	if ($res) $arg = mysql_fetch_array($res);
	if(!empty($arg['courseID']))  {header("Location: Alba4.php"); die();}
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

?>