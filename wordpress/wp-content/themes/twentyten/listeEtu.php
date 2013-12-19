<?php global $user_ID ?>
<?php if( $user_ID ) : ?>
<?php global $current_user ?>
<?php endif; ?>
<?php
/**
 Template Name: Liste Etu
 */

get_header(); ?>

<html>
<head>


</head>

<body>
<h2>Informations sur les étudiants </h2>
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
						<th>Email</th>
                        
                    </tr>
                </thead>
                <tbody>
                   <?php 
						   $users = get_users('role=etudiant');
						   foreach( $users as $user ) { 
						  
						  ?>
							  <tr>
								  <td><?php echo the_author_meta('last_name',$user->ID ); ?></td>
								  <td><?php echo $user->display_name ?></td>
								   <td><?php echo $user->user_email; ?></td>
							  </tr>
							
						  <?php	
						  }
							  
                       ?>
                </tbody>
            </table>
        </div>

</body>
</html>
<?php get_footer(); ?>

 