<?php
    	$con = mysql_connect("db454829920.db.1and1.com", "dbo454829920", "gtaimemama10", "db454829920");
		mysql_select_db("db454829920", $con);
		
		if( !function_exists('json_encode') ) {
		    function json_encode($data) {
		        $json = new Services_JSON();
		        return( $json->encode($data) );
		    }
		}
		
		$tab_projet_num=array();
		
		if(isset($_POST['testAffecter'])){
			$q="SELECT numero,affecteAuGroupe FROM wp_tab_sujets";
			$res=mysql_query($q);
			
			
			while ($row = mysql_fetch_array($res)) {
				
				if(!is_null($row["affecteAuGroupe"])){
					$tab_projet_num[]=$row["numero"];
				}
			}
		}
		
		echo json_encode($tab_projet_num);
		
?>