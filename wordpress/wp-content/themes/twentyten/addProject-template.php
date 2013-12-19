<?php
	
	/*Template Name: Choisir projet*/

	get_header();
	global $wpdb;
?>



<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
 
        
        <script src="<?php echo get_stylesheet_directory_uri(); ?>/Scripts/jquery-1.4.4.min.js" type="text/javascript"></script>
        
        <script src="<?php echo get_stylesheet_directory_uri(); ?>/Scripts/jquery.DataTables.min.js" type="text/javascript"></script>
        <script src="<?php echo get_stylesheet_directory_uri(); ?>/Scripts/jquery.jeditable.js" type="text/javascript"></script>
 
        <script src="<?php echo get_stylesheet_directory_uri(); ?>/Scripts/jquery-ui.js" type="text/javascript"></script>
 
        <script src="<?php echo get_stylesheet_directory_uri(); ?>/Scripts/jquery.validate.js" type="text/javascript"></script>
        <script src="<?php echo get_stylesheet_directory_uri(); ?>/Scripts/jquery.DataTables.editable.js" type="text/javascript"></script>
       
	   <script src="<?php echo get_stylesheet_directory_uri(); ?>/pixelmatrix-uniform-7332ff6/jquery.uniform.js" type="text/javascript"></script>
       
       <script src="<?php echo get_stylesheet_directory_uri(); ?>/Scripts/jquery.validate.js" type="text/javascript"></script>

       <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/pixelmatrix-uniform-7332ff6/themes/default/css/uniform.default.css" />
       
	
		<script src="<?php echo get_stylesheet_directory_uri(); ?>/reveal/jquery.reveal.js" type="text/javascript"></script>
	
		
         <style type="text/css">
			
			
            @import "<?php echo get_stylesheet_directory_uri(); ?>/media/css/demo_table_jui.css";
            @import "<?php echo get_stylesheet_directory_uri(); ?>/media/themes/smoothness/jquery-ui-1.9.2.custom.min.css";
			@import "<?php echo get_stylesheet_directory_uri(); ?>/reveal/reveal.css";
            
        
            .reveal-modal{
                background-color: #FFFFFF
            }
           
        </style>
 
 
    <script type='text/javascript'>
            // On load, style typical form elements
            $(function () {
                $("select, input,a.button,textarea").uniform();
              
            });
    </script>
 
      
        <title>Choisir projet</title>
    </head>
    <body >
		
		 <div id="container">
     
                <table id="myDataTable" cellpadding="0" cellspacing="0" border="0" class="display">
                    <thead>
                        <tr>
                            <th>Numero</th>
                           
                            <th>Titre</th>
                            <th>Langage</th>
							<th>Taille Equipe</th>
							<th>Description</th>
							<th>Choisir</th>
                        </tr>
                    </thead>
                    <tbody>
						<?php
							
							$query = "SELECT * FROM wp_sujets";
							$tab_sujets= $wpdb->get_results("SELECT * FROM wp_sujets");
							
							foreach ( $tab_sujets as $row ) 
							{
						?>		
								<tr id="<?php echo $row['numero'];?>">
								
                                    <td><?php echo $row['numero'];?></td>
                                    <td><?php echo $row['titre'];?></td>
                                 
                                  
                                    <td><?php echo $row['langage'];?></td>
									<td><?php echo $row['tailleEquipe'];?></td>
									<td>
									
										<a href="#"
											data-reveal-id="myModal<?php echo $row['numero'];?> "  id="myLink"
											data-animation="fadeAndPop" 
											data-animationspeed="300" data-closeonbackgroundclick="true" 
											data-dismissmodalclass="close-reveal-modal" >  
										Voir description
		
										</a>

										
		
									</td>
									
									<td>
									
									    <input type="checkbox" id="myModifie<?php echo $row['numero'];?>" />
									</td>
									<!-- la boite d'affichage du modal"-->
									
									<div id="myModal<?php echo $row['numero'];?>" class="reveal-modal">
											<a class="close-reveal-modal">&#215;</a>
											 <h1><?php	echo $row['titre']; ?></h1>

												<?php	echo $row['theme']; ?>
												

									</div>
								</tr>
						<?php
							}
						?>
			   </tbody>
            </table>
		</div>
		</br>
		</br>

    </body>
	
</html>
 <?php get_footer(); ?>