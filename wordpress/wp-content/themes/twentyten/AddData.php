<?php

	session_start();
	
	
	$con = mysql_connect("localhost", "your data name", "your passe word", "your db name");
	mysql_select_db("your db name", $con);
	/*	
	if(isset($_GET["id_groupe"])){
		
		
		$_SESSION["id_groupe"]=$_GET["id_groupe"];
	}
	//echo $_GET["id_groupe"];
	*/
	
	if(isset($_POST['id_membre']) && isset($_POST["id_groupe"])){
		
		
		$result= mysql_query("INSERT INTO wp_id_group_membres(id_membre,id_groupe)
		VALUES(
		'". $_POST['id_membre']."',
		
		'". $_POST["id_groupe"]."'
		);");
		
		
		echo "vous vous etes ajoute dans le groupe ".$_POST["id_groupe"];
		mysql_close($con);	
	}else{
		
		echo "Selectionner le groupe dans lequel vous voulez vous ajouter !!!";
	}
  	unset ($_SESSION["id_groupe"]);	
  

  
	
?>