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
						<div class="form-group">
							<label for="course">Index :</label>
							<input class="form-control" id="indexID" type = "text" name = "classid" placeholder = "Enter index :"></input>
						</div>

						<button type="submit" class="btn btn-default">Submit</button>
					</form>
					<?php
						include ("bd.php");
						$res = mysql_query("SELECT * FROM `timetable` WHERE `referenceID` = '1' AND `timetableID` = '4'");
						if ($res) $arg = mysql_fetch_array($res);
						while(!empty($arg['courseID'])) {
							echo $arg['courseID'] ;
						?>
							<a href = "<?php echo "delete_course.php?courseid=".$arg['courseID']."&c=".$arg['classID']; ?>" id = "del"> <img src = "images/delete.png" id = "delimg"> </a>
						<?php
							echo "<br>"; 
							$arg = mysql_fetch_array($res);
							}
						?>  
				</div>

				<!-- The content of tab 2 (view timetable)-->
				<div class="tab-pane fade" id="viewtimetabletab">
					<center>
						<button type="button" class="btn btn-default" id="previousTimetableButton" 
						onClick="loadPreviousTimetable()">Previous</button>
						<span id="timetableno">1</span> up to <span id="timetabletotal">3</span>
						<button type="button" class="btn btn-default" id="nextTimetableButton" onClick="loadNextTimetable()">Next</button>
					</center>
					<table class="table table-striped table-bordered ">
						<tr>
							<td>Time/Day</td>
							<td>Monday</td>
							<td>Tuesday</td>
							<td>Wednesday</td>
							<td>Thursday</td>
							<td>Friday</td>
							<td>Saturday</td>
						</tr>
						<tr>
							<td>08:30 - 09:30</td>
							<td>CZ3006 - LEC</td>
						</tr>
						<tr>
							<td>09:30 - 10:30</td>
							<td>CZ1007 - TUT</td>

						</tr>
					</table>
				</div>

				<!-- The content of tab 3 (load timetable)-->
				<div class="tab-pane fade" id="loadtimetabletab">
					<table class="table">
						<tr>
							<td>
								<button type="button" class="btn btn-default" id="loadPlan1" onClick="loadPlan(1)">Plan 1</button>
							</td>
							<td>
								<button type="button" class="btn btn-default" id="loadPlan2" onClick="loadPlan(2)">Plan 2</button>
							</td>
							<td>
								<button type="button" class="btn btn-default" id="loadPlan2" onClick="loadPlan(3)">Plan 3</button>
							</td>
						</tr>
					</table>
				</div>

				<!-- The content of tab 4 (settings)-->
				<div class="tab-pane fade" id="settingstab">
					<p id="settings-header-text">Please untick the slot that you want it to be free time!</p>
					<form name="settingsform" action="update-settings.php">
						<table class="table">
							<tr>
							<td>
								<!-- First column, Monday-->
								<p id="settings-day">Monday</p>
								<div class="item">
									<label><input type="checkbox" name="mondayChecklist" value="Monday-0830" checked>0830 - 0930</input></label>
								</div>
								<div class="item">
									<label><input type="checkbox" name="mondayChecklist" value="Monday-0930" checked>0930 - 1030</input></label>
								</div>
								<div class="item">
									<label><input type="checkbox" name="mondayChecklist" value="Monday-1030" checked>1030 - 1130</input></label>
								</div>
								<div class="item">
									<label><input type="checkbox" name="mondayChecklist" value="Monday-1130" checked>1130 - 1230</input></label>
								</div>
								<div class="item">
									<label><input type="checkbox" name="mondayChecklist" value="Monday-1230" checked>1230 - 1330</input></label>
								</div>
								<div class="item">
									<label><input type="checkbox" name="mondayChecklist" value="Monday-1330" checked>1330 - 1430</input></label>
								</div>
								<div class="item">
									<label><input type="checkbox" name="mondayChecklist" value="Monday-1430" checked>1430 - 1530</input></label>
								</div>
								<div class="item">
									<label><input type="checkbox" name="mondayChecklist" value="Monday-1530" checked>1530 - 1630</input></label>
								</div>
								<div class="item">
									<label><input type="checkbox" name="mondayChecklist" value="Monday-1630" checked>1630 - 1730</input></label>
								</div>
								<div class="item">
									<label><input type="checkbox" name="mondayChecklist" value="Monday-1730" checked>1730 - 1830</input></label>
								</div>
								<div class="item">
									<label><input type="checkbox" name="mondayChecklist" value="Monday-1830" checked>1830 - 1930</input></label>
								</div>
								<div class="item">
									<label><input type="checkbox" name="mondayChecklist" value="Monday-1930" checked>1930 - 2030</input></label>
								</div>
								<div class="item">
									<label><input type="checkbox" name="mondayChecklist" value="Monday-2030" checked>2030 - 2130</input></label>
								</div>
								<div class="item">
									<label><input type="checkbox" name="mondayChecklist" value="Monday-2130" checked>2130 - 2230</input></label>
								</div>
								<div class="item">
									<label><input type="checkbox" name="mondayChecklist" value="Monday-2230" checked>2230 - 2330</input></label>
								</div>
								<div>
									<button type="button" class="btn btn-default" name="monday-selectall" onClick="selectAll(document.settingsform.mondayChecklist)">Select All</button>
								</div>
								<div>
									<button type="button" class="btn btn-default" name="monday-deselectall" onClick="deselectAll(document.settingsform.mondayChecklist)">Deselect All</button>
								</div>
							</td>
							<td>
								<!-- Second column, Tuesday-->
								<p id="settings-day">Tuesday</p>
								<div class="item">
									<label><input type="checkbox" name="tuesdayChecklist" value="Tuesday-0830" checked>0830 - 0930</input></label>
								</div>
								<div class="item">
									<label><input type="checkbox" name="tuesdayChecklist" value="Tuesday-0930" checked>0930 - 1030</input></label>
								</div>
								<div class="item">
									<label><input type="checkbox" name="tuesdayChecklist" value="Tuesday-1030" checked>1030 - 1130</input></label>
								</div>
								<div class="item">
									<label><input type="checkbox" name="tuesdayChecklist" value="Tuesday-1130" checked>1130 - 1230</input></label>
								</div>
								<div class="item">
									<label><input type="checkbox" name="tuesdayChecklist" value="Tuesday-1230" checked>1230 - 1330</input></label>
								</div>
								<div class="item">
									<label><input type="checkbox" name="tuesdayChecklist" value="Tuesday-1330" checked>1330 - 1430</input></label>
								</div>
								<div class="item">
									<label><input type="checkbox" name="tuesdayChecklist" value="Tuesday-1430" checked>1430 - 1530</input></label>
								</div>
								<div class="item">
									<label><input type="checkbox" name="tuesdayChecklist" value="Tuesday-1530" checked>1530 - 1630</input></label>
								</div>
								<div class="item">
									<label><input type="checkbox" name="tuesdayChecklist" value="Tuesday-1630" checked>1630 - 1730</input></label>
								</div>
								<div class="item">
									<label><input type="checkbox" name="tuesdayChecklist" value="Tuesday-1730" checked>1730 - 1830</input></label>
								</div>
								<div class="item">
									<label><input type="checkbox" name="tuesdayChecklist" value="Tuesday-1830" checked>1830 - 1930</input></label>
								</div>
								<div class="item">
									<label><input type="checkbox" name="tuesdayChecklist" value="Tuesday-1930" checked>1930 - 2030</input></label>
								</div>
								<div class="item">
									<label><input type="checkbox" name="tuesdayChecklist" value="Tuesday-2030" checked>2030 - 2130</input></label>
								</div>
								<div class="item">
									<label><input type="checkbox" name="tuesdayChecklist" value="Tuesday-2130" checked>2130 - 2230</input></label>
								</div>
								<div class="item">
									<label><input type="checkbox" name="tuesdayChecklist" value="Tuesday-2230" checked>2230 - 2330</input></label>
								</div>
								<div>
									<button type="button" class="btn btn-default" name="tuesday-selectall" onClick="selectAll(document.settingsform.tuesdayChecklist)">Select All</button>
								</div>
								<div>
									<button type="button" class="btn btn-default" name="tuesday-deselectall" onClick="deselectAll(document.settingsform.tuesdayChecklist)">Deselect All</button>
								</div>
							</td>
							<td>
								<!-- Third column, Wednesday-->
								<p id="settings-day">Wednesday</p>
								<div class="item">
									<label><input type="checkbox" name="wednesdayChecklist" value="Wednesday-0830" checked>0830 - 0930</input></label>
								</div>
								<div class="item">
									<label><input type="checkbox" name="wednesdayChecklist" value="Wednesday-0930" checked>0930 - 1030</input></label>
								</div>
								<div class="item">
									<label><input type="checkbox" name="wednesdayChecklist" value="Wednesday-1030" checked>1030 - 1130</input></label>
								</div>
								<div class="item">
									<label><input type="checkbox" name="wednesdayChecklist" value="Wednesday-1130" checked>1130 - 1230</input></label>
								</div>
								<div class="item">
									<label><input type="checkbox" name="wednesdayChecklist" value="Wednesday-1230" checked>1230 - 1330</input></label>
								</div>
								<div class="item">
									<label><input type="checkbox" name="wednesdayChecklist" value="Wednesday-1330" checked>1330 - 1430</input></label>
								</div>
								<div class="item">
									<label><input type="checkbox" name="wednesdayChecklist" value="Wednesday-1430" checked>1430 - 1530</input></label>
								</div>
								<div class="item">
									<label><input type="checkbox" name="wednesdayChecklist" value="Wednesday-1530" checked>1530 - 1630</input></label>
								</div>
								<div class="item">
									<label><input type="checkbox" name="wednesdayChecklist" value="Wednesday-1630" checked>1630 - 1730</input></label>
								</div>
								<div class="item">
									<label><input type="checkbox" name="wednesdayChecklist" value="Wednesday-1730" checked>1730 - 1830</input></label>
								</div>
								<div class="item">
									<label><input type="checkbox" name="wednesdayChecklist" value="Wednesday-1830" checked>1830 - 1930</input></label>
								</div>
								<div class="item">
									<label><input type="checkbox" name="wednesdayChecklist" value="Wednesday-1930" checked>1930 - 2030</input></label>
								</div>
								<div class="item">
									<label><input type="checkbox" name="wednesdayChecklist" value="Wednesday-2030" checked>2030 - 2130</input></label>
								</div>
								<div class="item">
									<label><input type="checkbox" name="wednesdayChecklist" value="Wednesday-2130" checked>2130 - 2230</input></label>
								</div>
								<div class="item">
									<label><input type="checkbox" name="wednesdayChecklist" value="Wednesday-2230" checked>2230 - 2330</input></label>
								</div>
								<div>
									<button type="button" class="btn btn-default" name="wednesday-selectall" onClick="selectAll(document.settingsform.wednesdayChecklist)">Select All</button>
								</div>
								<div>
									<button type="button" class="btn btn-default" name="wednesday-deselectall" onClick="deselectAll(document.settingsform.wednesdayChecklist)">Deselect All</button>
								</div>
							</td>
							<td>
								<!-- Fourth column, Thursday-->
								<p id="settings-day">Thursday</p>
								<div class="item">
									<label><input type="checkbox" name="thursdayChecklist" value="Thursday-0830" checked>0830 - 0930</input></label>
								</div>
								<div class="item">
									<label><input type="checkbox" name="thursdayChecklist" value="Thursday-0930" checked>0930 - 1030</input></label>
								</div>
								<div class="item">
									<label><input type="checkbox" name="thursdayChecklist" value="Thursday-1030" checked>1030 - 1130</input></label>
								</div>
								<div class="item">
									<label><input type="checkbox" name="thursdayChecklist" value="Thursday-1130" checked>1130 - 1230</input></label>
								</div>
								<div class="item">
									<label><input type="checkbox" name="thursdayChecklist" value="Thursday-1230" checked>1230 - 1330</input></label>
								</div>
								<div class="item">
									<label><input type="checkbox" name="thursdayChecklist" value="Thursday-1330" checked>1330 - 1430</input></label>
								</div>
								<div class="item">
									<label><input type="checkbox" name="thursdayChecklist" value="Thursday-1430" checked>1430 - 1530</input></label>
								</div>
								<div class="item">
									<label><input type="checkbox" name="thursdayChecklist" value="Thursday-1530" checked>1530 - 1630</input></label>
								</div>
								<div class="item">
									<label><input type="checkbox" name="thursdayChecklist" value="Thursday-1630" checked>1630 - 1730</input></label>
								</div>
								<div class="item">
									<label><input type="checkbox" name="thursdayChecklist" value="Thursday-1730" checked>1730 - 1830</input></label>
								</div>
								<div class="item">
									<label><input type="checkbox" name="thursdayChecklist" value="Thursday-1830" checked>1830 - 1930</input></label>
								</div>
								<div class="item">
									<label><input type="checkbox" name="thursdayChecklist" value="Thursday-1930" checked>1930 - 2030</input></label>
								</div>
								<div class="item">
									<label><input type="checkbox" name="thursdayChecklist" value="Thursday-2030" checked>2030 - 2130</input></label>
								</div>
								<div class="item">
									<label><input type="checkbox" name="thursdayChecklist" value="Thursday-2130" checked>2130 - 2230</input></label>
								</div>
								<div class="item">
									<label><input type="checkbox" name="thursdayChecklist" value="Thursday-2230" checked>2230 - 2330</input></label>
								</div>
								<div>
									<button type="button" class="btn btn-default" name="thursday-selectall" onClick="selectAll(document.settingsform.thursdayChecklist)">Select All</button>
								</div>
								<div>
									<button type="button" class="btn btn-default" name="thursday-deselectall" onClick="deselectAll(document.settingsform.thursdayChecklist)">Deselect All</button>
								</div>
							</td>
							<td>
								<!-- Fifth column, Friday-->
								<p id="settings-day">Friday</p>
								<div class="item">
									<label><input type="checkbox" name="fridayChecklist" value="Friday-0830" checked>0830 - 0930</input></label>
								</div>
								<div class="item">
									<label><input type="checkbox" name="fridayChecklist" value="Friday-0930" checked>0930 - 1030</input></label>
								</div>
								<div class="item">
									<label><input type="checkbox" name="fridayChecklist" value="Friday-1030" checked>1030 - 1130</input></label>
								</div>
								<div class="item">
									<label><input type="checkbox" name="fridayChecklist" value="Friday-1130" checked>1130 - 1230</input></label>
								</div>
								<div class="item">
									<label><input type="checkbox" name="fridayChecklist" value="Friday-1230" checked>1230 - 1330</input></label>
								</div>
								<div class="item">
									<label><input type="checkbox" name="fridayChecklist" value="Friday-1330" checked>1330 - 1430</input></label>
								</div>
								<div class="item">
									<label><input type="checkbox" name="fridayChecklist" value="Friday-1430" checked>1430 - 1530</input></label>
								</div>
								<div class="item">
									<label><input type="checkbox" name="fridayChecklist" value="Friday-1530" checked>1530 - 1630</input></label>
								</div>
								<div class="item">
									<label><input type="checkbox" name="fridayChecklist" value="Friday-1630" checked>1630 - 1730</input></label>
								</div>
								<div class="item">
									<label><input type="checkbox" name="fridayChecklist" value="Friday-1730" checked>1730 - 1830</input></label>
								</div>
								<div class="item">
									<label><input type="checkbox" name="fridayChecklist" value="Friday-1830" checked>1830 - 1930</input></label>
								</div>
								<div class="item">
									<label><input type="checkbox" name="fridayChecklist" value="Friday-1930" checked>1930 - 2030</input></label>
								</div>
								<div class="item">
									<label><input type="checkbox" name="fridayChecklist" value="Friday-2030" checked>2030 - 2130</input></label>
								</div>
								<div class="item">
									<label><input type="checkbox" name="fridayChecklist" value="Friday-2130" checked>2130 - 2230</input></label>
								</div>
								<div class="item">
									<label><input type="checkbox" name="fridayChecklist" value="Friday-2230" checked>2230 - 2330</input></label>
								</div>
								<div>
									<button type="button" class="btn btn-default" name="friday-selectall" onClick="selectAll(document.settingsform.fridayChecklist)">Select All</button>
								</div>
								<div>
									<button type="button" class="btn btn-default" name="friday-deselectall" onClick="deselectAll(document.settingsform.fridayChecklist)">Deselect All</button>
								</div>
							</td>
							<td>
								<!-- Sixth column, Saturday-->
								<p id="settings-day">Saturday</p>
								<div class="item">
									<label><input type="checkbox" name="saturdayChecklist" value="Saturday-0830" checked>0830 - 0930</input></label>
								</div>
								<div class="item">
									<label><input type="checkbox" name="saturdayChecklist" value="Saturday-0930" checked>0930 - 1030</input></label>
								</div>
								<div class="item">
									<label><input type="checkbox" name="saturdayChecklist" value="Saturday-1030" checked>1030 - 1130</input></label>
								</div>
								<div class="item">
									<label><input type="checkbox" name="saturdayChecklist" value="Saturday-1130" checked>1130 - 1230</input></label>
								</div>
								<div class="item">
									<label><input type="checkbox" name="saturdayChecklist" value="Saturday-1230" checked>1230 - 1330</input></label>
								</div>
								<div class="item">
									<label><input type="checkbox" name="saturdayChecklist" value="Saturday-1330" checked>1330 - 1430</input></label>
								</div>
								<div class="item">
									<label><input type="checkbox" name="saturdayChecklist" value="Saturday-1430" checked>1430 - 1530</input></label>
								</div>
								<div class="item">
									<label><input type="checkbox" name="saturdayChecklist" value="Saturday-1530" checked>1530 - 1630</input></label>
								</div>
								<div class="item">
									<label><input type="checkbox" name="saturdayChecklist" value="Saturday-1630" checked>1630 - 1730</input></label>
								</div>
								<div class="item">
									<label><input type="checkbox" name="saturdayChecklist" value="Saturday-1730" checked>1730 - 1830</input></label>
								</div>
								<div class="item">
									<label><input type="checkbox" name="saturdayChecklist" value="Saturday-1830" checked>1830 - 1930</input></label>
								</div>
								<div class="item">
									<label><input type="checkbox" name="saturdayChecklist" value="Saturday-1930" checked>1930 - 2030</input></label>
								</div>
								<div class="item">
									<label><input type="checkbox" name="saturdayChecklist" value="Saturday-2030" checked>2030 - 2130</input></label>
								</div>
								<div class="item">
									<label><input type="checkbox" name="saturdayChecklist" value="Saturday-2130" checked>2130 - 2230</input></label>
								</div>
								<div class="item">
									<label><input type="checkbox" name="saturdayChecklist" value="Saturday-2230" checked>2230 - 2330</input></label>
								</div>
								<div>
									<button type="button" class="btn btn-default" name="saturday-selectall" onClick="selectAll(document.settingsform.saturdayChecklist)">Select All</button>
								</div>
								<div>
									<button type="button" class="btn btn-default" name="saturday-deselectall" onClick="deselectAll(document.settingsform.saturdayChecklist)">Deselect All</button>
								</div>
							</td>
							</tr>

						</table>
						<button type="submit" class="btn btn-default center-block" id="settings-save-button">Save Settings</button>
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
					alert("There is no more previous timetable")
					return;
				} else {
					document.getElementById("timetableno").innerHTML = previous;
				}
			}

			function loadNextTimetable() {
				var current = document.getElementById("timetableno").innerHTML;
				var next = Number(current) + 1;
				if (next == 0) {
					return;
				} else {
					document.getElementById("timetableno").innerHTML = next;
				}
			}


		</script>


	</body>
</html>


