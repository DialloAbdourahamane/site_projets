<?php
  	 //get_header();
  	//global $wpdb;
	
	//global $user_ID;
//	get_currentuserinfo();
  	  
  	$con = mysql_connect("db454829920.db.1and1.com", "dbo454829920", "gtaimemama10", "db454829920");

	mysql_select_db("db454829920", $con);
	
	
	$q="SELECT affecteAuGroupe FROM wp_tab_sujets WHERE numero='".$_POST['numero_projet']."'";
	$res=mysql_query($q);
	
	$row = mysql_fetch_array($res);
		    
	$q_groupe=("SELECT nomGroupe FROM wp_group g, wp_id_groupe_projet igp WHERE 
	g.id=igp.id_groupe and igp.id_projet='".$_POST['numero_projet']."'");
	
	$res_groupe=mysql_query($q_groupe);	
	
	$row_groupe = mysql_fetch_array($res_groupe);
	
	//$q_cpt=("SELECT count(*) FROM wp_tab_sujets WHERE ")	
	
			if(is_null($row["affecteAuGroupe"]) && isset($row_groupe["nomGroupe"])){
				
				$q="UPDATE wp_tab_sujets SET affecteAuGroupe='".$row_groupe["nomGroupe"]."' WHERE numero='".$_POST['numero_projet']."'";
			
				$res=mysql_query($q);
				//echo  "ssssssssssssss".$_POST['id_groupe']."     idEncadrat". $_POST['id_encadrant'];
				echo "Projet affecté avec succès au groupe ".$row_groupe["nomGroupe"];
				
			}else{
				echo "Vous avez déja affecté ce projet au groupe ".$row_groupe["nomGroupe"]."!!!";
			}
			
	
	
	//$res=$wpdb->query($q);
	
	//if($res!=false){
		
		//echo "ce projet est affecté au groupe ".$_POST['id_groupe']." avec succès";  
	//}
		//Close database connection
	mysql_close($con);
?>

