<?php
  include("bd.php");
  $referenceID = 1;// < --- need to change
  $timetableID = 4;
  $res = mysql_query("UPDATE `timetable` SET `flag` = '0' WHERE `referenceID` = '$referenceID' AND `timetableID` = '$timetableID'");
  	
  foreach ($_POST['courseindex'] as $info) {
  	//echo $info. "<br>";
  	$pieces = explode("-", $info);
  	$courseID = $pieces[0];
  	$classID = $pieces[1];
  	//echo $courseID. " ". $classID. "<br>";
  //  $res = mysql_query ("UPDATE `users` SET `name`='$name',`surname`='$surname',`class`='$class' WHERE `login`='$login'");
  
    $res = mysql_query("UPDATE `timetable` SET `flag` = '1' WHERE `referenceID` = '$referenceID' 
      AND `timetableID` = '$timetableID' AND `classID` = '$classID' AND `courseID` = '$courseID'");
  }
  {header("Location: Alba4.php"); die();}
?>