<?php
    
    global $wpdb;
	$projets_a_surligner=$wpdb->get_results("SELECT id_projet FROM wp_id_groupe_projet");
	
	echo json_decode($projets_a_surligner);
?>