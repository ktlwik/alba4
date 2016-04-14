<?php

	include("../DataAccessLayer/PDOFactory.php");
	
	if (isset($_POST['editTimePreferenceSubmitBtn'])) {
		editTimePreference();
	} // else ...
	//open for extensibility (another preferences type)
	
	function editTimePreference() {
		$datafactory = new PDOFactory();
		$datafactory->create();
		$sqlstatement = "DELETE FROM `settings` ";
		$result = $datafactory->execute($sqlstatement);

		foreach ($_POST['Mondaychecklist'] as $time) {
			$day = substr($time, 0, 3);
			$t = substr($time, 3, 7);
			$sqlstatement = "INSERT INTO `Settings` (`day`, `time`) VALUES ('$day', '$t')";
			$result = $datafactory->execute($sqlstatement);
		}
		foreach ($_POST['Tuesdaychecklist'] as $time) {
			$day = substr($time, 0, 3);
			$t = substr($time, 3, 7);
			$sqlstatement = "INSERT INTO `Settings` (`day`, `time`) VALUES ('$day', '$t')";
			$result = $datafactory->execute($sqlstatement);
		}
		foreach ($_POST['Wednesdaychecklist'] as $time) {
			$day = substr($time, 0, 3);
			$t = substr($time, 3, 7);
			$sqlstatement = "INSERT INTO `Settings` (`day`, `time`) VALUES ('$day', '$t')";
			$result = $datafactory->execute($sqlstatement);
		}
		foreach ($_POST['Thursdaychecklist'] as $time) {
			$day = substr($time, 0, 3);
			$t = substr($time, 3, 7);
			$sqlstatement = "INSERT INTO `Settings` (`day`, `time`) VALUES ('$day', '$t')";
			$result = $datafactory->execute($sqlstatement);
		}
		foreach ($_POST['Fridaychecklist'] as $time) {
			$day = substr($time, 0, 3);
			$t = substr($time, 3, 7);
			$sqlstatement = "INSERT INTO `Settings` (`day`, `time`) VALUES ('$day', '$t')";
			$result = $datafactory->execute($sqlstatement);
		}
		foreach ($_POST['Saturdaychecklist'] as $time) {
			$day = substr($time, 0, 3);
			$t = substr($time, 3, 7);
			$sqlstatement = "INSERT INTO `Settings` (`day`, `time`) VALUES ('$day', '$t')";
			$result = $datafactory->execute($sqlstatement);
		}
		{header("Location: ../Alba4.php"); die();}
	}

?>