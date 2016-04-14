<!-- The content of tab 2 (view timetable)-->
<div class="tab-pane fade" id="viewtimetabletab">
	<center>
		<button type="button" class="btn btn-default" id="previousTimetableButton" 
		onClick="loadPreviousTimetable()">Previous</button>
		<span id="timetableno">1</span> up to <span id="timetabletotal">3</span>
		<button type="button" class="btn btn-default" id="nextTimetableButton" onClick="loadNextTimetable()">Next</button>
	</center>
	<?php 
		include("BusinessAccessLayer/timetableManager.php");
		$times = array("0830", "0900", "0930", "1000", "1030", "1100", "1130", "1200", "1230", "1300", "1330", "1400", "1430", "1500", "1530", "1600", "1630", "1700", "1730", "1800", "1830", "1900", "1930", "2000", "2030", "2100", "2130", "2200", "2230", "2300", "2330");
		$days = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday");
		
			if (sizeof($tables) >= 0) {
			//Repeat for n timetables
			for ($i=0; $i < sizeof($tables); $i++) { ?>
			<div id="<?php echo "table-".($i+1);?>" style="display:none;">
				<table class="table table-striped table-bordered" >
					<tr>
						<td>Time/Day</td>
						<td>Monday</td>
						<td>Tuesday</td>
						<td>Wednesday</td>
						<td>Thursday</td>
						<td>Friday</td>
						<td>Saturday</td>
					</tr>
				<?php for ($j=0; $j < sizeof($times)-1; $j++) { //Repeat for 30 rows ?>
					<tr>
						<td><?php echo $times[$j]; ?> - <?php echo $times[$j+1]; ?></td>
						<?php for ($k=0; $k < 6; $k++) { //Repeat for 6 days 
							$output_text = "";
							$num_row = 0;
							$num_course = 0;
							$class_above=false;
							for ($l = 1; $l <= count ($tables[$i]); ++$l) { //Repeat for all course in that timetable (timetable index start from 1) 
								$index = $tables[$i][$l];					//Find the course in that slot
								for ($m = 0; $m < count($startTime[$index]); ++$m) {	//Repeat for all index in that particular course
									//To define number of row to be spanned
									$class_start_time = $startTime[$index][$m];
									$class_end_time = $endTime[$index][$m];
									for ($p=0; $p < sizeof($times)-1; $p++) {
										if ($class_start_time == $times[$p]) {
											$class_start_slot = $p;
										}
										if ($class_end_time == $times[$p]) {
											$class_end_slot = $p;
											break;
										}
									}
									if (($class_start_slot < $j) && ($class_end_slot > $j) && (strtolower($day[$index][$m]) == strtolower(substr($days[$k], 0, 3))))  {
										$class_above = true;		//Whether there is a class in the slot above and spanned to this cell
										break;						//If so, the declaration of <td></td> will not be executed
									}
									if (($startTime[$index][$m] == $times[$j]) && (strtolower($day[$index][$m]) == strtolower(substr($days[$k], 0, 3)))) {
										$num_course++;
										$num_row++;
										$course_info = $CourseID[$index]." ".$ctype[$index][$m]." ".$cgroup[$index][$m]." ".$venue[$index][$m]." ".$remarks[$index][$m];
										if (strlen($output_text) == 0) {
											$output_text = $course_info;
										}
										else if (strpos($output_text, $course_info) === false) {
											$output_text .= $course_info;
										}
										for ($n = $j+1; $n < sizeof($times)-1; $n++) {		//To define number of rowspan
											if ($times[$n] != $endTime[$index][$m]) {
												$num_row++;
											} else break;											
										}
									} 
								}
							}
							if (!$class_above) {	
						?>
							<td rowspan="<?php echo $num_row/$num_course; ?>"><?php echo $output_text; ?></td>
						<?php	}	
							}
						?>
						</tr>
						<?php		
						}
						?>
					</table>
				</div>
		<?php		
				}
			}
		?>
</div>