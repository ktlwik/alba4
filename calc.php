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

   function check ($dayI, $dayJ, $startTimeI, $startTimeJ, $endTimeI, $endTimeJ) {
     if ($dayI != $dayJ) return 0;
     if (($endTimeI < $startTimeJ) || ($endTimeJ < $startTimeI)) return 0;
     return 1; // checks if 2 courses clash or not
   }
  

   function clash ($i, $j) {
      global $day, $startTime, $endTime;
      for ($ind1 = 0; $ind1 < count ($day[$i]); ++$ind1) {
        for ($ind2 = 0; $ind2 < count ($day[$j]); ++$ind2)
          if (check ($day[$i][$ind1], $day[$j][$ind2], $startTime[$i][$ind1], $startTime[$j][$ind2], $endTime[$i][$ind1], $endTime[$j][$ind2]) == 1) {
            return 1;
          }
      }
      return 0;
   }
    
    function solve ($index) {
      global $len, $tables, $ID, $unique_courses, $left, $sz;
     // print ($index);
   		if ($index > $len) {
   			for ($i = 1; $i <= $len; ++$i) {
   				for ($j = $i + 1; $j <= $len; ++$j) {
    				if (clash ($ID[$i], $ID[$j]) == 1) return;
   				}
   			}
        print_r ($ID);
        print "<br>";
   			/*for ($i = 1; $i <= $len; ++$i) {
   				if (is_collapse ($ID[$i]) == 1) return;
   			}*/
   			// if it succeed until this stage then this is good timetable 
   			array_push($tables, $ID); // all the available timetable ids will be stored in tables
        return ;
   		}
   		$course = $unique_courses[$index];
    //  print $left[$course]."<br>". $sz[$course];
   		for ($i = $left[$course]; $i <= $left[$course] + $sz[$course] - 1; ++$i) {
   			$ID[$index] = $i;// assigning indexes
   			solve ($index + 1, $len);
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
  for ($i = 1; $i <= $n; ++$i) {
  	$classID = $ClassID[$i];
  	$courseID = $CourseID[$i];
  	$courses[$i] = $courseID;
  	$res = mysql_query("SELECT * FROM `classes` WHERE `id` = '$classID' 
		                                        AND `courseID` = '$courseID'");
  	if ($res) $arg = mysql_fetch_array($res);
      $startTime[$i] = array();
      $endTime[$i] = array();
      $day[$i] = array();
  	while(!empty($arg['courseID'])) {
      array_push($startTime[$i], $arg['startTime']);
   	  array_push($endTime[$i], $arg['endTime']);
      array_push($day[$i],$arg['day']);
      $arg = mysql_fetch_array($res);
    }
  }

  for ($i = 1; $i <= $n; ++$i) {
        for ($j = $i + 1; $j <= $n; ++$j) {
            if ($CourseID[$j] < $CourseID[$i]) {
                swap ($CourseID[$j], $CourseID[$i]);
                swap ($classID[$i], $classID[$j]);
                swap ($startTime[$i], $startTime[$j]);
                swap ($endTime[$i], $endTime[$j]);
                swap ($day[$i], $day[$j]);
            }
        }
    }
    
    $len = $n; // length of all uniques courses
    $unique_courses = array_unique($courses);
    $len = count ($unique_courses);
    $sz = array();
    $left = array();
    
 	for ($i = 1; $i <= $n; ++$i) {
   if (empty($left[$CourseID[$i]])) { // finding left index of specific course ID
 			$left[$CourseID[$i]] = $i;
 		}
    if (empty ($sz[$CourseID[$i]])) $sz[$CourseID[$i]] = 1;
 		else $sz[$CourseID[$i]] ++;
 	}
  $tables = array();
  solve (1);
//
  print_r ($tables);  
  ?>