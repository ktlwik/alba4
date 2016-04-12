<html>
	<head>
		<title>Alba4 - Your Timetable Generator!</title>
		
		<link rel="icon" href="icon.png">

		<link rel="stylesheet" type="text/css" href="style/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="style/styles.css">

		<script src="script/jquery-1.12.2.min.js"></script>
		<script src="script/bootstrap.min.js"></script>

	</head>
	<body>
		<div class="container">

			<!-- The navigation tab-->
			<ul class="nav nav-tabs nav-justified">
				<li class="active"><a data-toggle="tab" href="#addcoursetab">Add Course</a></li>
				<li><a data-toggle="tab" href="#viewtimetabletab">View Timetable</a></li>
				<li><a data-toggle="tab" href="#loadtimetabletab">Load Timetable</a></li>
				<li><a data-toggle="tab" href="#settingstab">Settings</a></li>
			</ul>

			<div class="tab-content">
				<!-- The content of tab 1 (add course)-->
				<div class="tab-pane fade in active" id="addcoursetab">
					<form role="form" action = "add_course.php" method = "POST">
						<div class="form-group">
							<label for="course">Course :</label>
							<input class="form-control" id="courseID" type = "text"  name = "courseid" placeholder = "Enter course :"></input>
						</div>

						<button type="submit" class="btn btn-default" >Add course</button>
					</form>
					<form role="form" action = "editIndex.php" method = "POST">
					<?php
						include ("bd.php");
						$res = mysql_query("SELECT * FROM `timetable` WHERE `referenceID` = '1' AND `timetableID` = '4'");
						if ($res) $arg = mysql_fetch_array($res);
						$prev = "";
						while(!empty($arg['courseID'])) {
							if ($arg['courseID'] == $prev) {
							$arg = mysql_fetch_array($res); ?>
							<div class="item">
								<label><input type="checkbox" name="courseindex[]" value="<?php echo $arg['classID']; ?>"><?php echo $arg['classID']. " "; ?></input></label>
							</div>
							<?php continue;
							}
							echo "<br>".$arg['courseID'];
						?>
			            <a href = "<?php echo "delete_course.php?courseid=".$arg['courseID']; ?>" id = "del"> <img src = "images/delete.png" id = "delimg"> </a>
						<div class="item">
								<label><input type="checkbox" name="courseindex[]" value="<?php echo $arg['classID']; ?>" ><?php echo $arg['classID']. " "; ?></input></label>
						</div>
						<?php
							$prev = $arg['courseID'];
							$arg = mysql_fetch_array($res);
							}
						?>  
						<button type="submit" class="btn btn-default" >Re-calculate timetable</button>
					</form>
				</div>
			<!-- The content of tab 2 (view timetable)-->
				<div class="tab-pane fade" id="viewtimetabletab">
					<center>
						<button type="button" class="btn btn-default" id="previousTimetableButton" 
						onClick="loadPreviousTimetable()">Previous</button>
						<span id="timetableno">1</span> up to <span id="timetabletotal">3</span>
						<button type="button" class="btn btn-default" id="nextTimetableButton" onClick="loadNextTimetable()">Next</button>
					</center>
					<?php 
						include("calc.php");
						$times = array("0830", "0900", "0930", "1000", "1030", "1100", "1130", "1200", "1230", "1300", "1330", "1400", "1430", "1500", "1530", "1600", "1630", "1700", "1730", "1800", "1830", "1900", "1930", "2000", "2030", "2100", "2130", "2200", "2230", "2300", "2330");
						$days = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday");
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

						<?php for ($j=0; $j < sizeof($times)-1; $j++) { //Repeat for 30 rows 
								?>
								<tr>
									<td><?php echo $times[$j]; ?> - <?php echo $times[$j+1]; ?></td>
									<?php for ($k=0; $k < 6; $k++) { //Repeat for 6 days 
										$output_text = "";
										$num_row = 1;
										$class_above=false;
										for ($l = 1; $l <= count ($tables[$i]); ++$l) { //Repeat for all class in that timetable (timetable index start from 1) 
											$index = $tables[$i][$l];					//Find the course in that slot
											for ($m = 0; $m < count($startTime[$index]); ++$m) {
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
												if (($class_start_slot < $j) && ($class_end_slot >= $j+1) && (strtolower($day[$index][$m]) == strtolower(substr($days[$k], 0, 3))))  {
													$class_above = true;		//Whether there is a class in the slot above and spanned to this cell
													break;						//If so, the declaration of <td></td> will not be executed
												}
												if (($startTime[$index][$m] == $times[$j]) && (strtolower($day[$index][$m]) == strtolower(substr($days[$k], 0, 3)))) {
													$output_text = $CourseID[$index]." ".$ctype[$index][$m]." ".$cgroup[$index][$m]." ".$venue[$index][$m]." ".$remarks[$index][$m];
													for ($n = $j+1; $n < sizeof($times)-1; $n++) {		//To define number of rowspan
														if ($times[$n] != $endTime[$index][$m]) {
															$num_row++;
														} else break;											
													}
													break;
												} 
											}
										}
									if (!$class_above) {	
									?>
									<td rowspan="<?php echo $num_row; ?>"><?php echo $output_text; ?></td>
								
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
						?>
				</div>

				<!-- The content of tab 3 (load timetable)-->
				<div class="tab-pane fade" id="loadtimetabletab">
					<table class="table">
						<tr>
							<td>
								<button type="button" class="btn btn-default" id="loadPlan1" onClick="loadPlan(1)"><strong>Plan 1</strong></button>
							</td>
							<td>
								<button type="button" class="btn btn-default" id="loadPlan2" onClick="loadPlan(2)"><strong>Plan 2</strong></button>
							</td>
							<td>
								<button type="button" class="btn btn-default" id="loadPlan2" onClick="loadPlan(3)"><strong>Plan 3</strong></button>
							</td>
						</tr>
					</table>
				</div>

				<!-- The content of tab 4 (settings)-->
				<div class="tab-pane fade" id="settingstab">
					<p id="settings-header-text">Please tick the slot that you want it to be free time!</p>
					<form name="settingsform" action="updateSettings.php" method="POST">
						<table class="table">
							<tr>
							<?php 	
								$timepreference = array(array());			
								for ($w = 0; $w < sizeof($days); $w++) {
									for ($x = 0; $x < sizeof($times)-1; $x++) {
										$timepreference[$w][$x] = true;					//Initially all timeslots are selected
									}
								}
								for ($y = 0; $y< sizeof($days); $y++) { ?>
								<td>
									<p id="settings-day"><?php echo $days[$y];?></p>
									<?php for ($z = 0; $z < sizeof($times)-1; $z++) { ?>
										<div class="item">
										<label><input type="checkbox" name="<?php echo $days[$y]."checklist[]" ?>" value="<?php echo strtoupper(substr($days[$y], 0, 3)).$times[$z]; ?>"><?php echo $times[$z]; ?> - <?php echo $times[$z+1]; ?></input></label>
										</div>
									<?php	} ?>
										<div>
											<button type="button" class="btn btn-default" onClick="<?php echo "selectAll(document.settingsform['".$days[$y]."checklist[]'])"?>">Select All</button>

										</div>
										<div>
											<button type="button" class="btn btn-default" onClick="<?php echo "deselectAll(document.settingsform['".$days[$y]."checklist[]'])"?>">Deselect All</button>
										</div>
								 </td> 
							<?php } ?>
							
							</tr>

						</table>
						<button type="submit" class="btn btn-default" >Save</button>
					</form>
				</div>			
			</div>
		</div>

		<script>
			<!-- Change tab content -->
			$(document).ready(function() {
    			$(".nav-tabs a").click(function() {
        			$(this).tab('show');
    			});
    			$('.nav-tabs a').on('show.bs.tab', function(){
        			document.getElementById("timetabletotal").innerHTML = <?php echo json_encode(sizeof($tables)); ?>;
    			});
    			document.getElementById("table-1").style = "display: visible;";
			});	
			
			function selectAll(chkbox) {
				for (i = 0; i < chkbox.length; i++) {
					chkbox[i].checked = true;
				}
				
			}
			function deselectAll(chkbox) {
				for (i = 0; i < chkbox.length; i++) {
					chkbox[i].checked = false;
				}
			}
			function loadPlan(planNo) {
				alert("Plan " + planNo + " loaded successfully!");
			}
			function loadPreviousTimetable() {
				var current = document.getElementById("timetableno").innerHTML;
				var previous = Number(current) - 1;
				if (previous == 0) {
					alert("There is no more previous timetable");
					return;
				} else {
					document.getElementById("timetableno").innerHTML = previous;
					document.getElementById("table-"+current).style = "display: none;";
					document.getElementById("table-"+previous).style = "display: visible;";
				}
			}
			function loadNextTimetable() {
				var current = document.getElementById("timetableno").innerHTML;
				var next = Number(current) + 1;
				if (next > document.getElementById("timetabletotal").innerHTML) {
					alert("There is no more next timetable");
				} else {
					document.getElementById("timetableno").innerHTML = next;
					document.getElementById("table-"+current).style = "display: none;";
					document.getElementById("table-"+next).style = "display: visible;";
				}
			}
			function changeSetting(chkbox) {
				var id = chkbox.id;
				$.ajax({
        			url: 'Alba4.php',
        			type: 'POST',
        			data: {option : selectedValue},
        			success: function() {
            			console.log("Data sent!");
        			}
    			});
			}
		</script>


	</body>
</html>
