<?php
    function is_type($s) {
    	if ($s == "LEC/STUDIO" || $s == "SEM" || $s == "TUT" || $s == "LAB") return 1;
    	return 0;
    }
    function from_numbers($s) {

    	if (strlen($s) != 5) return 0;
    	for ($i = 0; $i < strlen ($s); ++$i)
    		if ($s[$i] < '0' || $s[$i] > '9') return 0;
    	return 1;
    }

	include("startDatabase.php");
	$dir    = './courses';
	$files = scandir($dir, 0);
	for ($j = 2; $j < count($files); ++$j) {
		$len = 0;
		$myfile = fopen("./courses/".$files[$j], "r") or die("Unable to open file!");
    	unset ($str);
		$str = array();
		while(!feof($myfile)) {
 			// echo fgets($myfile) . "<br>";
 			 $cur = fgets($myfile);
 		 	$str[$len] = $cur;
 		 	++$len;
 		}
 		$str = array_values(array_filter($str, "trim"));
 		$len = count ($str);
 		for ($i = 1; $i < $len; ++$i) 
 			$str[$i] = trim ($str[$i]);
 		echo "Suceess!". "<br>";
 		for ($i = 1; $i < $len; ++$i) {
 			if ($str[$i] == "INDEX" && $i > 3) {
 				$courseID = $str[$i - 3];
 				$courseName = $str[$i - 2];
 				$AU = $str[$i - 1];	
 				$res = mysql_query("INSERT INTO `course` (`courseID`, `courseName`, `AU`) VALUES ('$courseID', '$courseName', '$AU')");
 
 				//$courseID, $courseName, $AU -> update courses
 				/*echo "courseID: " . $courseID . "<br>" . "course Name: " . $courseName . "<br>" . "AU: " . $AU ."<br>";
 				echo "---------------<br>";*/
 			}
 			else if (from_numbers($str[$i ]) == 1) {
 				$classID = $str[$i];
 				//echo "***NEW CLASS ID***" . $classID. "<br>";
 			}
 			else if (is_type($str[$i]) == 1) {
 			//	print ("Cool");
 		    	$type = $group = $day = $time = $venue = $remark = "NONE";
 				$type = $str[$i];
 				++$i;
 				if ($i >= $len || is_type ($str[$i]) == 1) goto finish;
 				$group = $str[$i];
 				++$i;
 				if ($i >= $len || is_type ($str[$i]) == 1) goto finish; 
 				$day = $str[$i];
 				++$i;
 				if ($i >= $len || is_type ($str[$i]) == 1) goto finish; 
 				$time = $str[$i];
 				++$i;
 				if ($i >= $len || is_type ($str[$i]) == 1) goto finish; 
 				$venue = $str[$i]; 
 				++$i;
 				if ($i >= $len || from_numbers($str[$i])) {
 					--$i;
 					goto finish;
 				}
 		    	if ($i >= $len || is_type ($str[$i]) == 1) goto finish; 
 				$remark = $str[$i];

 				finish :
 				if ($time == "NONE") {
 					$startTime = "NONE";
 					$endTIme = "NONE";
 				}
 				else {
 					$startTime = $time[0].$time[1].$time[2].$time[3];  	
 					$endTime = $time[5].$time[6].$time[7].$time[8];  
 			
 				}
				/*$res = mysql_query("INSERT INTO `classes` (`id`, `name`, `startTime`, `endTime`, `type`, `cgroup`, `day`, `venue`, `courseID`, `remark`) VALUES ('$classID', '$courseName', '$startTime', '$endTime', '$type', '$group', '$day', '$venue', '$courseID', '$remark')");*/
 				//'$classID', '$courseName', '$startTime', '$endTime', '$type', '$group', '$day', '$venue', '$courseID', '$remark' -> update classes
 				/*echo "Course ID: " . $courseID . "<br>" . "Type : " . $type . "<br>". "Group: ". $group. "<br>". "Day: ". $day. "<br>". "startTime: ". $startTime. "<br>". "endTime: ". $endTime. "<br>". "Venue: ". $venue. "<br>". "Remark: ". $remark. "<br>" . "^^^^^^^^^^^^^^^^^^^^^". "<br>";*/
 			}
 		}
 	}
 		
?>