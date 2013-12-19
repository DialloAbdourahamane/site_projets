<?php

	if($_POST['groupe_select']=='defaut'){
		
		echo "selectionnez votre equipe dans la liste deroulante";
	}
	else{
		
			$con = mysql_connect("db454829920.db.1and1.com", "dbo454829920", "gtaimemama10", "db454829920");

			mysql_select_db("db454829920", $con);
		
			//Insert record into database
		
			$result= mysql_query("INSERT INTO wp_id_groupe_projet(id_groupe,id_projet)
			VALUES(
			'".$_POST['groupe_select']."',
			
			'".$_POST['id_projet']."'
			);");
			
			echo "Vous etes du groupe ".$_POST['groupe_select']." et vous avez choisi le projet numero ".$_POST['id_projet'];
			
			//Close database connection
			mysql_close($con);
	}
    
?>