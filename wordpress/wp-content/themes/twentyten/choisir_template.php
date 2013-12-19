<?php
	
	/*Template Name: New Choisir projet 13*/

	get_header();
	global $wpdb;
?>
						


<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
 
        
 
   

       <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/pixelmatrix-uniform-7332ff6/themes/default/css/uniform.default.css" />
       
	
		
		
		
         <style type="text/css">
			
			
            @import "<?php echo get_stylesheet_directory_uri(); ?>/media/css/demo_table_jui.css";
            @import "<?php echo get_stylesheet_directory_uri(); ?>/media/themes/ui-darkness/jquery-ui-1.10.2.custom.min.css";
			@import "<?php echo get_stylesheet_directory_uri(); ?>/reveal/reveal.css";
            
        
            .reveal-modal{
                background-color: #FFFFFF
            }
           
		
           
        </style>
 
       <script src="<?php echo get_stylesheet_directory_uri();?>/Codes/scripts/jquery-1.6.4.min.js" type="text/javascript"></script>

 
    <script>
  
				
			$(document).ready(function() {    
				
			$('#formulaire').hide();	
			

			  $(':checkbox').click(function(){
					var id = $(this).attr('id');
					$('#formulaire').show();
					//var isChecked = $(this).attr('checked'));
					//alert(id);
				//var $button = $(document.createElement('.status'));
				//add class
				//$button.addClass('redButton');
				//call the jquery-ui button function
				//$button.button();
				//rajout de lidentifiant
				
			$input = $('<input type="text" name="id_projet" class="cache_id_projet"/>').val(id);
			$('#formulaire').append($input);
			
			$('.cache_id_projet').hide();
			
			$( '#dialog-confirm' ).dialog({
			      resizable: false,
			      height:140,
			      modal: true,
			      buttons: {
			        'Je choisi': function() {
						var request = $.ajax({
						  url: '<?php echo get_stylesheet_directory_uri(); ?>/ajax/sajouter.php',
						  type: 'POST',
						  data:$('#formulaire').serialize(),
						  dataType: 'html'
						});
						
						request.done(function(msg) {
							
							//if(id==4){		
								$('#'+id).css({ backgroundColor : 'yellow'});
							//}
						 //$("#"+id).attr("value", attrid).attr("checked", false);	
						  alert(msg);
						});
						request.fail(function(jqXHR, textStatus) {
						  alert( 'Request failed: ' + textStatus );
						});			 
						
							
							         
						$( this ).dialog( 'close' );
					},
			        Cancel: function() {
			          $( this ).dialog( 'close' );
			          $('#desactive').removeAttr('disabled');
			          
			        }
			      }
			    });
				});	  
			});
		</script>
 
 
    <script type='text/javascript'>
            // On load, style typical form elements
            $(function () {
                $("select, input,a.button,textarea").uniform();

            });
    </script>
 
 	<!--Debut accordion-->
 	 <script>
		  $(function() {
		    $( "#accordion" ).accordion({
		      collapsible: true
		    });
		  });
  		</script>
  		
  		<!--Fin accordion-->
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
		
		</br>
		<?php 
			$query = "SELECT * FROM  `wp_tab_sujets`";
			$tab_sujets= $wpdb->get_results($query);
			if(count($tab_sujets)>=4){
		?>
			<h2>Les quatres derniers projets ajoutés</h2>
			</br>
			<div id="accordion">
			  <h3><?php echo "1.".$tab_sujets[count($tab_sujets)-1]->titre; ?></h3>
			  <div>
			    <p><?php echo $tab_sujets[count($tab_sujets)-1]->description;?></p>
			  </div>
			  <h3><?php echo "2.".$tab_sujets[count($tab_sujets)-2]->titre; ?></h3>
			  <div>
			    <p><?php echo $tab_sujets[count($tab_sujets)-2]->description;?></p>
			  </div>
			  <h3><?php echo "3.".$tab_sujets[count($tab_sujets)-3]->titre; ?></h3>
			  <div>
			    <p><?php echo $tab_sujets[count($tab_sujets)-3]->description;?></p>
			  
			  </div>
			  <h3><?php echo "4.".$tab_sujets[count($tab_sujets)-4]->titre; ?></h3>
			  <div>
			    <p><?php echo $tab_sujets[count($tab_sujets)-4]->description;?></p>
			  </div>
			</div>
		
		<?php } ?>
		
		</br>
		
		<h2>Liste de tous les projets </h2>
		</br>
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
							<th>Groupe ayant choisi</th>
							<th>affecter au groupe</th>
                        </tr>
                    </thead>
                    <tbody>
						<?php
							
							$query = "SELECT * FROM  `wp_tab_sujets`";
							$tab_sujets= $wpdb->get_results($query);
							
							foreach ( $tab_sujets as $row ) 
							{
							
								
						?>		
								<tr id="<?php echo $row->numero;?>">
								
                                    <td><?php echo $row->numero;?></td>
                                    <td><?php echo $row->titre;?></td>
                                 
                                  
                                    <td><?php echo $row->langage;?></td>
									<td><?php echo $row->tailleEq;?></td>
									<td>
									
										<a href="#"
										data-reveal-id="myModal<?php echo $row->numero;?>"  id="myLink"
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
										<?php
											$query="SELECT id,nomGroupe FROM wp_group g, wp_id_groupe_projet idg
													WHERE g.id=idg.id_groupe and idg.id_projet=$row->numero";
											$nom_groups=$wpdb->get_results($query);
											$i=1;
											$page= get_permalink('364');
											
											foreach ( $nom_groups as $ligne ) 
											{
												print "<a href=\"$page&id_group=$ligne->id\">"."<b>".$i.'  '.$ligne->nomGroupe.'</b></a></br>';
												$i++;
											}
												print '</br>';
										?>
										<!--
										<button class="status" id="btn<?php echo $row->numero;?>" ></button>
										-->
									</td>
									<td>
										<?php 
											echo " $row->affecteAuGroupe";
										 ?>
										<p></p>
									</td>
									<!-- la boite d'affichage du modal"-->
									
									<div id="myModal<?php echo $row->numero;?>" class="reveal-modal">
											<a class="close-reveal-modal">&#215;</a>
											 <h1><?php	echo $row->titre; ?></h1>

												<?php	echo $row->description; ?>
												

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
		
		<div id="dialog-confirm" title="Choisir un projet " >
			
			<!--
  			<p id="hide"><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;">
  			
  				
  			</span>Etes vous sure de vouloire choisir ce projet ?</p>
  		-->
  			<form method="post" id="formulaire">
				
				<label >Selectionnez votre groupe: </label></br>
  			<?php

				
				
				$query = "SELECT * FROM  `wp_group`";
				$tab_groupe= $wpdb->get_results($query);
					
				echo "<select name='groupe_select' >";
				
					echo "<option value='defaut'>"."selectionne". "</option>";
				foreach ( $tab_groupe as $row ) 
				{
				
				    echo "<option value='" . $row->id. "'>" . $row->id. "   " . $row->nomGroupe. "</option>";
				}
				echo "</select>";
				
			?>
			</form>
			
		</div>

		      <script src="<?php echo get_stylesheet_directory_uri(); ?>/Scripts/jquery.DataTables.min.js" type="text/javascript"></script>
       
        <script src="<?php echo get_stylesheet_directory_uri(); ?>/Scripts/jquery-ui.js" type="text/javascript"></script>
 
        <script src="<?php echo get_stylesheet_directory_uri(); ?>/Scripts/jquery.validate.js" type="text/javascript"></script>
       
	   <script src="<?php echo get_stylesheet_directory_uri(); ?>/pixelmatrix-uniform-7332ff6/jquery.uniform.min.js" type="text/javascript"></script>
      
		<script src="<?php echo get_stylesheet_directory_uri(); ?>/reveal/jquery.reveal.js" type="text/javascript"></script>

		
    </body>
    
 

	
</html>
 <?php get_footer(); ?>
