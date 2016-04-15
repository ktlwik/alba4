<!-- The content of tab 1 (add course)-->
	<div class="tab-pane fade in active" id="addcoursetab">
		<form role="form" action = "BusinessAccessLayer/courseSelectionManager.php" method = "POST">
			<div class="form-group">
				<label for="course">Course :</label>
				<input class="form-control" id="courseID" type = "text"  name = "courseid" placeholder = "Enter course :"></input>
			</div>
			<button type="submit" name="addCourseSubmitBtn" class="btn btn-default" >Add course</button>
		</form>
		<form role="form" action = "BusinessAccessLayer/courseSelectionManager.php" method = "POST">
		<?php
			
			$sqlstatement = "SELECT * FROM `timetable` WHERE `referenceID` = '1' AND `timetableID` = '4'";
			$result = $dataobject->execute($sqlstatement);
			$arg = $dataobject->fetch($result);
			
			$prev = "";
			while(!empty($arg['courseID'])) {
				if ($arg['courseID'] == $prev) { ?>
				<div class="item">
					<label><input type="checkbox" name="courseindex[]" value="<?php echo $arg['courseID']."-".$arg['classID']; ?>" checked><?php echo $arg['classID']. " "; ?></input></label>
				</div>
				<?php
					$arg = $dataobject->fetch($result); continue;
				}
				echo "<br>".$arg['courseID'];
				?>
			    <a href = "<?php echo "BusinessAccessLayer/courseSelectionManager.php?courseid=".$arg['courseID']; ?>" name= "deleteCourseButton" id="deleteCourseButton"> <img src = "images/delete.png" name = "delimg" id ="delimg"> </a>
					<div class="item">
						<label><input type="checkbox" name="courseindex[]" value="<?php echo $arg['courseID']."-".$arg['classID']; ?>" checked><?php echo $arg['classID']. " "; ?></input></label>
				</div>
				<?php
					$prev = $arg['courseID'];
					$arg = $arg = $dataobject->fetch($result);
				}
		?>  
			<button type="submit" name="editIndexSubmitBtn" class="btn btn-default" >Re-calculate timetable</button>
		</form>
	</div>