<?php
	
	/*Template Name: Choisir projet*/

	get_header();
	
?>
						


<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
 
        
        <script src="<?php echo get_stylesheet_directory_uri(); ?>/Scripts/jquery-1.4.4.min.js" type="text/javascript"></script>
        
        <script src="<?php echo get_stylesheet_directory_uri(); ?>/Scripts/jquery.DataTables.min.js" type="text/javascript"></script>
       
        <script src="<?php echo get_stylesheet_directory_uri(); ?>/Scripts/jquery-ui.js" type="text/javascript"></script>
 
        <script src="<?php echo get_stylesheet_directory_uri(); ?>/Scripts/jquery.validate.js" type="text/javascript"></script>
       
	   <script src="<?php echo get_stylesheet_directory_uri(); ?>/pixelmatrix-uniform-7332ff6/jquery.uniform.js" type="text/javascript"></script>
       

       <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/pixelmatrix-uniform-7332ff6/themes/default/css/uniform.default.css" />
       
	
		<script src="<?php echo get_stylesheet_directory_uri(); ?>/reveal/jquery.reveal.js" type="text/javascript"></script>
	
		<script>
			$(document).ready(function() {    
			  $(':checkbox').click(function(){
					var id = $(this).attr('id');
					var isChecked = $(this).attr('checked'));
					
					//if(!isChecked){
						$(id).css("        
							background: #cdeb8e; /* Old browsers */
							background: -moz-linear-gradient(top, #cdeb8e 0%, #a5c956 100%); /* FF3.6+ */
							background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#cdeb8e), color-stop(100%,#a5c956)); /* Chrome,Safari4+ */
							background: -webkit-linear-gradient(top, #cdeb8e 0%,#a5c956 100%); /* Chrome10+,Safari5.1+ */
							background: -o-linear-gradient(top, #cdeb8e 0%,#a5c956 100%); /* Opera 11.10+ */
							background: -ms-linear-gradient(top, #cdeb8e 0%,#a5c956 100%); /* IE10+ */
							background: linear-gradient(top, #cdeb8e 0%,#a5c956 100%); /* W3C */
							filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#cdeb8e', endColorstr='#a5c956',GradientType=0 ); /* IE6-9 */
							");
					//}
					$.get(
					  'getcheckbox.php', 
					  { id: id, isChecked: isChecked },
					  function(data) {
						//return value in getcheckbox.php and use it in on complete function
						var result = data;
					  }
					);
				});    
			});
		</script>
         <style type="text/css">
			
			
            @import "<?php echo get_stylesheet_directory_uri(); ?>/media/css/demo_table_jui.css";
            @import "<?php echo get_stylesheet_directory_uri(); ?>/media/themes/smoothness/jquery-ui-1.9.2.custom.min.css";
			@import "<?php echo get_stylesheet_directory_uri(); ?>/reveal/reveal.css";
            
        
            .reveal-modal{
                background-color: #FFFFFF
            }
			
			.status{
			
			        background: #ff3019; /* Old browsers */
					background: -moz-linear-gradient(top, #ff3019 0%, #cf0404 100%); /* FF3.6+ */
					background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#ff3019), color-stop(100%,#cf0404)); /* Chrome,Safari4+ */
					background: -webkit-linear-gradient(top, #ff3019 0%,#cf0404 100%); /* Chrome10+,Safari5.1+ */
					background: -o-linear-gradient(top, #ff3019 0%,#cf0404 100%); /* Opera 11.10+ */
					background: -ms-linear-gradient(top, #ff3019 0%,#cf0404 100%); /* IE10+ */
					background: linear-gradient(top, #ff3019 0%,#cf0404 100%); /* W3C */
					filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ff3019', endColorstr='#cf0404',GradientType=0 ); /* IE6-9 */

			}
           
        </style>
 
 
    <script type='text/javascript'>
            // On load, style typical form elements
            $(function () {
                $("select, input,a.button,textarea").uniform();
              
            });
    </script>
 
	<script type="text/javascript" charset="utf-8">
            $(document).ready(function(){
                $('#myDataTable').dataTable({
                    "sPaginationType":"full_numbers",
                    "aaSorting":[[2, "desc"]],
                    "bJQueryUI":true
                });
            })
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
							<th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
						<?php
							global $wpdb;
							$query = "SELECT * FROM  `wp_sujets`";
							$tab_sujets= $wpdb->get_results($query);
							
							foreach ( $tab_sujets as $row ) 
							{
							
								
						?>		
								<tr id="<?php echo $row->numero;?>">
								
                                    <td><?php echo $row->numero;?></td>
                                    <td><?php echo $row->titre;?></td>
                                 
                                  
                                    <td><?php echo $row->langage;?></td>
									<td><?php echo $row->tailleEquipe;?></td>
									<td>
									
										<a href="#"
										data-reveal-id="myModal<?php echo $row->numero;?> "  id="myLink"
										data-animation="fadeAndPop" 
										data-animationspeed="300" data-closeonbackgroundclick="true" 
										data-dismissmodalclass="close-reveal-modal">  
										Voir description
		
										</a>

										
		
									</td>
									
									<td>
									
									    <input type="checkbox" id="<?php echo $row->numero;?>" />
									</td>
									
									<td>
										<button class="status" id="<?php echo $row->numero;?>" ></button>
									</td>
									<!-- la boite d'affichage du modal"-->
									
									<div id="myModal<?php echo $row->numero;?>" class="reveal-modal">
											<a class="close-reveal-modal">&#215;</a>
											 <h1><?php	echo $row->titre; ?></h1>

												<?php	echo $row->theme; ?>
												

									</div>
								</tr>
						<?php
							}
						?>
					</tbody>
				</table>
				</br>
				</br>
		</div>
		
		

    </body>
	
</html>
 <?php get_footer(); ?>