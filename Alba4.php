<?php

	include("DataAccessLayer/DataObjectFactory.php");
	
	$datafactory = new DataObjectFactory();
	$dataobject = $datafactory->getDataObject();
	$dataobject->create();

	include("PresentationLayer/templates/header.html");
	
	include("PresentationLayer/addCourseUI.php");
	include("PresentationLayer/timetableUI.php");
	include("PresentationLayer/planUI.php");
	include("PresentationLayer/settingsUI.php");
	

	include ("PresentationLayer/templates/footer.html");

?>