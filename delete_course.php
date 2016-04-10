<?php

   include ("bd.php");
 $courseID = $_GET['courseid'];

 $referenceID = 1;// < --- need to change
 $timetableID = 4;



 $res = mysql_query ("DELETE FROM `timetable` WHERE `referenceID` = '$referenceID' 
		                                        AND `timetableID` = '$timetableID' AND `courseID` = '$courseID'");
 {header("Location: Alba4.php"); die();}

?>