<?php
    function swap(&$a, &$b) {
        $A = $a;
        $B = $b;
        $a = $B;
        $b = $A;
    }
     
   function is_collapse($i) {
   		return 0; // I need to check whether my course clash with the selected times
   }

   function clash ($i, $j) {
   	return 0;	// checks if 2 courses clash or not
   }

   function solve ($index) {
   		if ($index > $len) {
   			for ($i = 1; $i <= $len; ++$i) {
   				for ($j = $i + 1; $j <= $len; ++j) {
   					if (clash ($ID[$i], $ID[$j]) == 1) return;
   				}
   			}
   			for ($i = 1; $i <= $len; ++$i) {
   				if (is_collapse ($ID[$i]) == 1) return;
   			}
   			// if it succeed until this stage then this is good timetable 
   			array_push($tables, $ID); // all the available timetable ids will be stored in tables
   		}
   		$course = $unique_courses[$index];
   		for ($i = $left[$course]; $i <= $left[$course] + $sz[$course] - 1; ++$i) {
   			$ID[$index] = $i;// assigning indexes
   			solve (index + 1);
   		}

   }

   include ("bd.php");
   $referenceID = 1; // < --- need to change
   $timetableID = 4; // constant for calculation 

   $res = mysql_query("SELECT * FROM `timetable` WHERE `referenceID` = '$referenceID' 
		                                        AND `timetableID` = '$timetableID'");

  if ($res) $arg = mysql_fetch_array($res);
  $n = 0;
  while(!empty($arg['courseID'])) {
    	 $CourseID[++$n] = $arg['courseID'];
   		 $ClassID[$n] = $arg['classID'];  
   		 $arg = mysql_fetch_array($res);  			
  }
  for ($i = 1; $i <= n; ++$i) {
  	$classID = $ClassID[$i];
  	$courseID = $CourseID[$i];
  	$courses[$i] = $courseID;
  	$res = mysql_query("SELECT * FROM `classes` WHERE `id` = '$classID' 
		                                        AND `courseID` = '$courseID'");
  	if ($res) $arg = mysql_fetch_array($res);
  	$startTime[$i] = $arg['startTime'];
  	$endTime[$i] = $arg['endTime'];
  }

  for ($i = 1; $i <= $n; ++$i) {
        for ($j = $i + 1; $j <= $n; ++$j) {
            if ($CourseID[$j] < $CourseID[$i]) {
                swap ($CourseID[$j], $CourseID[$i]);
                swap ($classID[$i], $classID[$j]);
                swap ($startTime[$i], $startTime[$j]);
                swap ($endTime[$i], $endTime[$j]);
            }
        }
    }
    
    $len = n; // length of all uniques courses
    $unique_courses = array_unique($courses);
    $len = count ($unique_courses);

    
 	for ($i = 1; $i <= n; ++$i) {
 		if (empty($left[$CourseID[$i]])) { // finding left index of specific course ID
 			$left[$CourseID[$i]] = $i;
 		}
 		$sz[$CourseID[$i]] ++;
 	}
    solve (1);
    
 ?>