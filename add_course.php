<?php
 echo "Big brother's here!!!";
if(!empty($_POST['courseid']) && !empty($_POST['classid'])) {
	$courseID = $_POST['courseid'];
	$classID = $_POST['classid'];
	$referenceID = 1;// < --- need to change
	$timetableID = 4;

	include("bd.php");
	$res = mysql_query("SELECT * FROM `timetable` WHERE `classID` = '$classID' AND `referenceID` = '$referenceID' 
		                                        AND `timetableID` = '$timetableID' AND `courseID` = '$courseID'");
	if ($res) $arg = mysql_fetch_array($res);
	if(!empty($arg['courseID']))  {header("Location: Alba4.php"); die();}
	$res = mysql_query("INSERT INTO `timetable` (`classID`, `courseID`, `referenceID`, `timetableID`) VALUES ('$classID', '$courseID', '$referenceID', '$timetableID')");
    {header("Location: Alba4.php"); die();}
}

?>