<?php
	include("startDatabase.php");
	$res = mysql_query("DELETE FROM `settings` ");
	foreach ($_POST['Mondaychecklist'] as $time) {
		$day = substr($time, 0, 3);
		$t = substr($time, 3, 7);
		$res = mysql_query("INSERT INTO `Settings` (`day`, `time`) VALUES ('$day', '$t')");
	}
	foreach ($_POST['Tuesdaychecklist'] as $time) {
		$day = substr($time, 0, 3);
		$t = substr($time, 3, 7);
		$res = mysql_query("INSERT INTO `Settings` (`day`, `time`) VALUES ('$day', '$t')");
	}
	foreach ($_POST['Wednesdaychecklist'] as $time) {
		$day = substr($time, 0, 3);
		$t = substr($time, 3, 7);
		$res = mysql_query("INSERT INTO `Settings` (`day`, `time`) VALUES ('$day', '$t')");
	}
	foreach ($_POST['Thursdaychecklist'] as $time) {
		$day = substr($time, 0, 3);
		$t = substr($time, 3, 7);
		$res = mysql_query("INSERT INTO `Settings` (`day`, `time`) VALUES ('$day', '$t')");
	}
	foreach ($_POST['Fridaychecklist'] as $time) {
		$day = substr($time, 0, 3);
		$t = substr($time, 3, 7);
		$res = mysql_query("INSERT INTO `Settings` (`day`, `time`) VALUES ('$day', '$t')");
	}
	foreach ($_POST['Saturdaychecklist'] as $time) {
		$day = substr($time, 0, 3);
		$t = substr($time, 3, 7);
		$res = mysql_query("INSERT INTO `Settings` (`day`, `time`) VALUES ('$day', '$t')");

	}
	{header("Location: Alba4.php"); die();}

?>