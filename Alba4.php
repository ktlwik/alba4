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
						<a class="btn btn-primary btnPrevious">Previous</a>
						<span id"timetableno">1</span> up to 3
						<a class="btn btn-primary btnNext">Next</a>
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
					Tab C
				</div>

				<!-- The content of tab 4 (settings)-->
				<div class="tab-pane fade" id="settingstab">
					Tab D
				</div>			
			</div>
		</div>

		<script>
			<!-- Change tab content -->
			$(document).ready(function(){
    			$(".nav-tabs a").click(function(){
        			$(this).tab('show');
    			});
			});


		</script>


	</body>
</html>


