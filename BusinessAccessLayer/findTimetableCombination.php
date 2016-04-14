<?php
    function swap(&$a, &$b) {
        $tmp = $a;
        $a = $b;
        $b = $tmp;
    }

   function getWeek ($word) {
     $result = array(1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1);
      if ($word[0] != 'W') return $result;
     $result = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
        $word = substr($word, 2);
     $pieces = explode(",", $word);
     for ($i = 0; $i < count ($pieces); ++$i) {
       $sub = $pieces[$i];
       $spie = explode ("-", $sub);
       if (count ($spie) == 1) $result[(int)$spie[0]] = 1;
       else for ($j = (int)$spie[0]; $j <= (int) $spie[1]; ++$j) $result[$j] = 1;
     }

      return $result;
   }

  function cmp ($word1, $word2) {
    $res1 = getWeek ($word1);
    $res2 = getWeek ($word2);
    for ($i = 1; $i <= 13; ++$i) if ($res1[$i] == $res2[$i] && $res1[$i] == 1) return 0;
    return 1;
  }
     
   function is_collapse($i) {
      global $day, $startTime, $endTime;
      for ($ind = 0; $ind < count ($day[$i]); ++$ind) {
        $Day = $day[$i][$ind];
        $res = mysql_query("SELECT * FROM `settings` WHERE `day` = '$Day'");
        if ($res) $arg = mysql_fetch_array($res);
        while (!empty($arg['day'])) {
          $time = $arg['time'];
          if ($startTime[$i][$ind] <= $time && $endTime[$i][$ind] > $time) return 1;
          $arg = mysql_fetch_array($res);
        }
      }
      return 0; // I need to check whether my course clash with the selected times
   }

   function check ($dayI, $dayJ, $startTimeI, $startTimeJ, $endTimeI, $endTimeJ, $remarksI, $remarksJ) {
     $clash = cmp ($remarksI, $remarksJ);
     if ($dayI != $dayJ) return 0;
     $a = (($endTimeI < $startTimeJ && $startTimeJ < $startTimeI) || ($endTimeJ < $startTimeI && $startTimeI < $startTimeJ)); 
     if ($a || (!$a && $clash == 1)) return 0;
     return 1; // checks if 2 courses clash or not
   }
  
   function clash ($i, $j) {
      global $day, $startTime, $endTime, $remarks;
      for ($ind1 = 0; $ind1 < count ($day[$i]); ++$ind1) {
        for ($ind2 = 0; $ind2 < count ($day[$j]); ++$ind2)
          if (check ($day[$i][$ind1], $day[$j][$ind2], $startTime[$i][$ind1], $startTime[$j][$ind2], $endTime[$i][$ind1], $endTime[$j][$ind2], $remarks[$i][$ind1], $remarks[$j][$ind2]) == 1) {
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
        for ($i = 1; $i <= $len; ++$i) {
          if (is_collapse ($ID[$i]) == 1) return;
        }
        // if it succeed until this stage then this is good timetable 
        array_push($tables, $ID); // all the available timetable ids will be stored in tables
        return ;
      }
      $course = $unique_courses[$index - 1];
    //  print $left[$course]."<br>". $sz[$course];
      for ($i = $left[$course]; $i <= $left[$course] + $sz[$course] - 1; ++$i) {
        $ID[$index] = $i;// assigning indexes
        solve ($index + 1, $len);
      }
   }
   include("DataAccessLayer/startDatabase.php");
   $referenceID = 1; // < --- need to change
   $timetableID = 4; // constant for calculation 
   $res = mysql_query("SELECT * FROM `timetable` WHERE `referenceID` = '$referenceID' 
                                            AND `timetableID` = '$timetableID' AND `flag` = '1'");
  if ($res) $arg = mysql_fetch_array($res);
  $n = 0;
  while(!empty($arg['courseID'])) {
       $CourseID[++$n] = $arg['courseID'];
       $ClassID[$n] = $arg['classID'];  
       $arg = mysql_fetch_array($res);        
  }
  $courses = array();
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
      $venue[$i] = array();
      $cgroup[$i] = array();
      $ctype[$i] = array();
      $remarks[$i] = array();
    while(!empty($arg['courseID'])) {
      array_push($startTime[$i], $arg['startTime']);
      array_push($endTime[$i], $arg['endTime']);
      array_push($day[$i],$arg['day']);
      array_push($venue[$i], $arg['venue']);
      array_push($cgroup[$i], $arg['cgroup']);
      array_push($ctype[$i], $arg['type']);
      array_push($remarks[$i], $arg['remark']);
      $arg = mysql_fetch_array($res);
    }
  }
// sorting 
  for ($i = 1; $i <= $n; ++$i) {
        for ($j = $i + 1; $j <= $n; ++$j) {
            if ($CourseID[$j] < $CourseID[$i]) {
                swap ($CourseID[$j], $CourseID[$i]);
                swap ($ClassID[$i], $ClassID[$j]);
                swap ($startTime[$i], $startTime[$j]);
                swap ($endTime[$i], $endTime[$j]);
                swap ($day[$i], $day[$j]);
                swap ($venue[$i], $venue[$j]);
                swap ($cgroup[$i], $cgroup[$j]);
                swap ($ctype[$i], $ctype[$j]);
                swap ($remarks[$i], $remarks[$j]);
            }
        }
    }
    
    $len = $n; // length of all uniques courses
    sort($courses);
    $unique_courses = array_unique($courses);
    $unique_courses = array_values($unique_courses);
    $len = count ($unique_courses);
    $sz = array();
    $left = array();
   // print_r ($unique_courses);
    
  for ($i = 1; $i <= $n; ++$i) {
   if (empty($left[$CourseID[$i]])) { // finding left index of specific course ID
      $left[$CourseID[$i]] = $i;
    }
    if (empty ($sz[$CourseID[$i]])) $sz[$CourseID[$i]] = 1;
    else $sz[$CourseID[$i]] ++;
  }
  $tables = array();
  solve (1); 
  ?>