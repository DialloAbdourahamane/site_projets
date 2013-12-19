
<?php

	
try
{
	
  
	$con = mysql_connect("db454829920.db.1and1.com", "dbo454829920", "gtaimemama10", "db454829920");
	mysql_select_db("db454829920", $con);
	
	//Getting records (listAction)
	if($_GET["action"] == "list")
	{
		//Get record count
		$result = mysql_query("SELECT COUNT(*) AS RecordCount FROM wp_tab_sujets;");
		$row = mysql_fetch_array($result);
		$recordCount = $row['RecordCount'];

		//Get records from database
		$result = mysql_query("SELECT * FROM  `wp_tab_sujets`  WHERE idEncadrant='". $_GET["membreID"] ."' ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
		
		//Add all records to an array
		$rows = array();
		while($row = mysql_fetch_array($result))
		{
		    $rows[] = $row;
		}

		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		$jTableResult['TotalRecordCount'] = $recordCount;
		$jTableResult['Records'] = $rows;
		print json_encode($jTableResult);
	}
	//Creating a new record (createAction)
	else if($_GET["action"] == "create")
	{
	
	
		//Insert record into database
		 
		$result= mysql_query("INSERT INTO `wp_tab_sujets` (titre, tailleEq,specialite,langage,description,idEncadrant)
		VALUES('" . stripslashes($_POST["titre"]) . "', 
		'" . stripslashes($_POST["tailleEq"]) . "',
		'" . stripslashes($_POST["specialite"]) . "',
		'". stripslashes($_POST["langage"]) ."',
		'". stripslashes($_POST["description"]) ."',
		 '". stripslashes($_GET["membreID"]) ."');");
		
		//Get last inserted record (to return to jTable)
		$result = mysql_query("SELECT * FROM `wp_tab_sujets` WHERE numero = LAST_INSERT_ID();");
		$row = mysql_fetch_array($result);

		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		$jTableResult['Record'] = $row;
		print json_encode($jTableResult);
	
	}
	//Updating a record (updateAction)
	else if($_GET["action"] == "update")
	{
		//Update record in database
		$result = mysql_query("UPDATE `wp_tab_sujets` 
		SET titre = '" . $_POST["titre"] . "', 
		tailleEq = '" . $_POST["tailleEq"] . "',
		specialite = '" . $_POST["specialite"] . "',
		langage ='". $_POST["langage"]."', 
		description = '" . $_POST["description"] . "' 
		
		WHERE numero = '". $_POST["numero"] . "';");

		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		print json_encode($jTableResult);
	}
	//Deleting a record (deleteAction)
	else if($_GET["action"] == "delete")
	{
		//Delete from database
		$result = mysql_query("DELETE FROM `wp_tab_sujets` WHERE numero = '". $_POST["numero"] ."';");

		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		print json_encode($jTableResult);
	}

	//Close database connection
	mysql_close($con);

}
catch(Exception $ex)
{
    //Return error message
	$jTableResult = array();
	$jTableResult['Result'] = "ERROR";
	$jTableResult['Message'] = $ex->getMessage();
	print json_encode($jTableResult);
}
	
?>