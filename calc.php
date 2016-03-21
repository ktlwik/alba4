<?php

   include ("bd.php");
   $referenceID = 1; // < --- need to change
   $timetableID = 4; // constant for calculation 

   $res = mysql_query("SELECT * FROM `timetable` WHERE `referenceID` = '$referenceID' 
		                                        AND `timetableID` = '$timetableID'");

  if ($res) $arg = mysql_fetch_array($res);
  while(!empty($arg['courseID'])) {
						