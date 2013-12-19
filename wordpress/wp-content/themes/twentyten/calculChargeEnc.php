<?php global $user_ID ?>

<?php global $current_user ?>

<?php
/**
 Template Name: charge encadrant
 */

get_header(); 
global $wpdb;
global $nbEtu;
global $ctotal;

?>

<html>
<head>


</head>

<body>
<h2>Calcul des charges </h2>
</br>

	<div>
		 
		   <title>DataTables</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <script src="<?php echo get_stylesheet_directory_uri(); ?>/media/js/jquery-1.4.4.min.js" type="text/javascript"></script>
        <script src="<?php echo get_stylesheet_directory_uri(); ?>/media/js/jquery.dataTables.min.js" type="text/javascript"></script>
        
        <style type="text/css">
            @import "<?php echo get_stylesheet_directory_uri(); ?>/media/css/demo_table_jui.css";
            @import "<?php echo get_stylesheet_directory_uri(); ?>/media/themes/smoothness/jquery-ui-1.9.2.custom.min.css";
        </style>
        
        <style>
            *{
                font-family:arial;
            }
        </style>
		


</style>
        <script type="text/javascript" charset="utf-8">
            $(document).ready(function(){
                $('#datatables').dataTable({
                    "sPaginationType":"full_numbers",
                    "aaSorting":[[2, "desc"]],
                    "bJQueryUI":true
                });
            })
			
			$(document).ready(function(){
						   		   
	//When you click on a link with class of poplight and the href starts with a # 
	$('a.poplight[href^=#]').click(function() {
		var popID = $(this).attr('rel'); //Get Popup Name
		var popURL = $(this).attr('href'); //Get Popup href to define size
				
		//Pull Query & Variables from href URL
		var query= popURL.split('?');
		var dim= query[1].split('&');
		var popWidth = dim[0].split('=')[1]; //Gets the first query string value

		//Fade in the Popup and add close button
		$('#' + popID).fadeIn().css({ 'width': Number( popWidth ) }).prepend('<a href="#" class="close"><img src="close.png" class="btn_close" title="Close Window" alt="Close" /></a>');
		
		//Define margin for center alignment (vertical + horizontal) - we add 80 to the height/width to accomodate for the padding + border width defined in the css
		var popMargTop = ($('#' + popID).height() + 80) / 2;
		var popMargLeft = ($('#' + popID).width() + 80) / 2;
		
		//Apply Margin to Popup
		$('#' + popID).css({ 
			'margin-top' : -popMargTop,
			'margin-left' : -popMargLeft
		});
		
		//Fade in Background
		$('body').append('<div id="fade"></div>'); //Add the fade layer to bottom of the body tag.
		$('#fade').css({'filter' : 'alpha(opacity=80)'}).fadeIn(); //Fade in the fade layer 
		
		return false;
	});
	
	
	//Close Popups and Fade Layer
	$('a.close, #fade').live('click', function() { //When clicking on the close or fade layer...
	  	$('#fade , .popup_block').fadeOut(function() {
                $('#fade, a.close').remove();  
	}); //fade them both out
		
		return false;
	});

	
});

        </script>
		
            <table id="datatables" class="display">
                <thead>
                    <tr>
                        <th>Nom</th>
						<th>Prenom</th>
						<th>Nombre de groupes</th>
						<th>Nombre Etudiants encadrés</th>
						<th>Charge par encadrant</th>
                        <th>Charge totale</th>
                    </tr>
                </thead>
                <tbody>
                   <?php 
				  		$nbEtu=0;
						$ctotal=0;
						   $users = get_users('role=encadrant');
						  		
						   foreach( $users as $user ) { 
								 $nbGrp= $wpdb->get_var("SELECT count(affecteAuGroupe) FROM wp_tab_sujets
										where idEncadrant=$user->ID");
								$grpID= $wpdb->get_results("SELECT affecteAuGroupe FROM wp_tab_sujets
								       where idEncadrant=$user->ID 
									   and affecteAuGroupe<>' '");
								
					
						  ?>
							  <tr>
								  <td><?php echo the_author_meta('last_name',$user->ID ); ?></td>
								  <td><?php echo $user->display_name ?></td>
								   <td><?php echo $nbGrp; 
								   
								   ?></td>
								   <td><?php 
								   
								   foreach($grpID as $c){
								   $val=$c->affecteAuGroupe;
								   	
										$nb= $wpdb->get_results("SELECT * FROM wp_group "); 
										 foreach($nb as $a){
										 if($val === $a->nomGroupe) {
											/*$nb1= $wpdb->get_var("select count(id_membre) from wp_id_group_membres G,wp_id_groupe_projet P
											where P.id_groupe=$a->id
											and P.id_groupe=G.id_groupe");
											$nbEtu=$nbEtu+$nb1;
											echo $nb1;*/
											$nb1= $wpdb->get_var("select id_groupe from wp_id_group_membres P
											where P.id_membre=$a->membresID
											");
											$nb2= $wpdb->get_var("select count(id_membre) from wp_id_group_membres 
											where id_groupe=$nb1");
											$nbEtu=$nbEtu+$nb2;
											}
										}
											
									}
									echo $nbEtu;
												
								   
								   ?></td>
								   <td><?php echo 2*$nbEtu; 
											$ctotal=$ctotal+(2*$nbEtu);?></td>
								    <td></td>
							  </tr>
							 
							
						  <?php	
						  }
                       ?>
					  		 <tr>
								  <td></td>
								  <td></td>
								   <td></td>
								   <td></td>
								   <td></td>
								   <td><?php echo $ctotal; ?></td>
							  </tr>
							   
                </tbody>
            </table>
        </div>
	</br>
	</br>

</body>
</html>
<?php get_footer(); ?>

 
