
<?php
   
try
{
	
	$con = mysql_connect("localhost","root","");

	mysql_select_db("wp11", $con);

	
	//Getting records (listAction)
	if($_GET["action"] == "list")
	{
		//Get record count
		$result = mysql_query("SELECT COUNT(*) AS RecordCount FROM wp_group;");
		$row = mysql_fetch_array($result);
		$recordCount = $row['RecordCount'];

		//Get records from database
		$result = mysql_query("SELECT * FROM wp_group WHERE membresID='". $_GET["membreID"] ."' ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
		
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
		
		$result= mysql_query("INSERT INTO wp_group(membresID,nomGroupe)
		VALUES(
		'". $_GET["membreID"] ."',
		
		'". $_POST["nomGroupe"] ."'
		);");
		
	
		
		//Get last inserted record (to return to jTable)
		$result = mysql_query("SELECT * FROM wp_group WHERE id = LAST_INSERT_ID();");
		
			//insert celui qui a inscrit dans le groupe
		
		mysql_query("INSERT INTO wp_id_group_membres(id_membre,id_groupe)
		VALUES(
		'". $_GET["membreID"] ."',
		
		LAST_INSERT_ID()
		);");
		
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
		$result = mysql_query("UPDATE wp_group 
		SET 
		nomGroupe = '" . $_POST["nomGroupe"] . "' 
		
		WHERE id = '". $_POST["id"] . "';");

		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		print json_encode($jTableResult);
	}
	//Deleting a record (deleteAction)
	else if($_GET["action"] == "delete")
	{
		//Delete from database
		$result = mysql_query("DELETE FROM 	wp_group WHERE id = '". $_POST["id"] ."';");

		mysql_query("DELETE FROM 	wp_id_group_membres WHERE id_groupe = '". $_POST["id"] ."';");
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