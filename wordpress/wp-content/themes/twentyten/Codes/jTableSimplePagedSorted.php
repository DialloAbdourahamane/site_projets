<?php
    /*Template Name: Encadrant add projet 13*/
    get_header();
	
	global $user_ID;
	get_currentuserinfo();

	global $wpdb;
    $membre_id = $wpdb->get_row("SELECT id_membre FROM `wp_id_group_membres` WHERE id_membre=$user_ID");
	
	
?>
<html>
  <head>

	

     <link href="<?php echo get_stylesheet_directory_uri();?>/Codes/themes/redmond/jquery-ui-1.8.16.custom.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo get_stylesheet_directory_uri();?>/Codes/scripts/themes/metro/blue/jtable.css" rel="stylesheet" type="text/css" />
    
    

    <!-- Import CSS file for validation engine (in Head section of HTML) -->
	<link href="<?php echo get_stylesheet_directory_uri();?>/Codes/scripts/validationEngine.jquery.css" rel="stylesheet" type="text/css" />
	 
	<style>
    	
    	    @import "<?php echo get_stylesheet_directory_uri(); ?>/media/themes/ui-darkness/jquery-ui-1.10.2.custom.css";
    	    .couleurBleu{
    	    	color: #336699;
    	    	font-weight:bold;
    	    }
    	    #affecter{
    	    	
    	    	width: 150px; height: 20px; position: relative; 
    	    	background-color:green;
    	    }
    		
    		
    </style>

	    <script src="<?php echo get_stylesheet_directory_uri();?>/Codes/scripts/jquery-1.6.4.min.js" type="text/javascript"></script>
  </head>
  <body>
  	
  	<form id="affecter_projet" method="POST"></form>
  	
  	<div id="dialog-confirm" title="S'ajouter dans ce groupe?">
  			<p id="hide"><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;">
  				
  			</span>Etes vous sure de vouloire affecter ce projet a ce groupe?</p>
	</div>
  	
	<div id="PeopleTableContainer" style="width: 940px;"></div>
	
	<script type="text/javascript">

		$(document).ready(function () {

		    //Prepare jTable
			$('#PeopleTableContainer').jtable({
				title: 'Liste de vos projets',
				paging: true,
				pageSize: 10,
				sorting: true,
				defaultSorting: 'numero ASC',
				actions: {
						    listAction: '<?php print get_stylesheet_directory_uri(); ?>/Codes/PersonActionsPagedSorted.php?action=list&membreID=<?php echo $user_ID;?>',
		                    createAction:'<?php print get_stylesheet_directory_uri(); ?>/Codes/PersonActionsPagedSorted.php?action=create&membreID=<?php echo $user_ID;?>',
		                    updateAction: '<?php print get_stylesheet_directory_uri(); ?>/Codes/PersonActionsPagedSorted.php?action=update' ,
		                    deleteAction: '<?php print get_stylesheet_directory_uri(); ?>/Codes/PersonActionsPagedSorted.php?action=delete'
		               		
		               		
				},
				fields: {
					numero: {
						key: true,
						create: false,
						edit: false,
						list: true
					},
					titre: {
						title: 'Titre',
						width: '20%'
					},
					tailleEq: {
						title: 'TailleEq',
						width: '10%',
						
						list:true,
						options:{
							'1': '1', 
                       		'2': '2', 
                       		'3': '3',
                       		'4': '4',
                       		'5': '5'
						}
					},
					
					specialite:{
						title:'Specialite',
						width:'10%',
						options: { '1': 'DL/IHM/CAMSI/IM/IARF', '2': 'IHM', '3': 'CAMSI',
						'4':'IARF','5':'IM','6':'DL/IHM','7':'DL/IHM/IM','8':'DL/IHM/IM/CAMSI',
						'9':'DL','10':'Autres'}
					},
					langage:{
						title:'Langage',
						width:'15%',
						options: { '1': 'JAVA/JEE', '2': 'C/C++/PYTHON', '3': 'Developpement Web','4':'Android/Ios',
						'5':'developpement mobile','6':'HTML5/CSS3/JavaScript','7':'OCAML/Prolog','8':'Autres'}
					},
					
					description: {
						title: 'Description',
						width: '40%',
						type:'textarea'
					}
				}
				,
				
					//Initialize validation logic when a form is created
				formCreated: function (event, data) {
					data.form.find('input[name="titre"]').addClass('validate[required]');
					//data.form.find('input[name="description"]').addClass('validate[required]');
				   
					data.form.validationEngine();
				},
				//Validate form when it is being submitted
				formSubmitting: function (event, data) {
					return data.form.validationEngine('validate');
				},
				//Dispose validation logic when form is closed
				formClosed: function (event, data) {
					data.form.validationEngine('hide');
					data.form.validationEngine('detach');
				}
			});

			//Load person list from server
			$('#PeopleTableContainer').jtable('load');

		});

	</script>
 	</br>
 	</br>
 	</br>
 	
 	<h2>Les groupes ayant choisi vos projets :</h2>
 	</br>
 	
 		<div id="accordion">
 		<?php 
			
			$query = "SELECT id,nomGroupe,numero,titre,affecteAuGroupe FROM  wp_group g,wp_id_groupe_projet gp,wp_tab_sujets s
					WHERE s.numero=gp.id_projet and gp.id_groupe=g.id and s.idEncadrant=$user_ID
					";
			$page= get_permalink('364');
			
			$tab_groups= $wpdb->get_results($query);
			//echo "ttttttttttt".count($tab_groups)."$user_ID";
			$j=0;
			for($i=0;$i<count($tab_groups);$i++){
				$j++;
		?>
 			
			  <h3>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo "$j.".$tab_groups[$i]->nomGroupe; ?>
			  	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			  	
			  </h3>
			  <div>
			  	  	</br>
			  	<span>
					<?php 
						$val='id_group='.$tab_groups[$i]->id;
						$ref=$page.'&'.$val;				
						?>				

			  		<b><em><a href='<?php print $ref;?>'>Contacter ce groupe</a></em></b>
			  		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			  		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			  		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			  		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			  		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

			  		<span id="btn">
			  			<button id="<?php echo $tab_groups[$i]->numero;?>" class="button">Affecter</button> </span>
			  	</span>
			  	</br>	
			  	</br>
			  	</br>
			  	<p>
			  		<span>
			  			<span class="couleurBleu">Projet choisi par ce groupe :</span><b><?php echo '   '.$tab_groups[$i]->numero.".".'  '.$tab_groups[$i]->titre?></b>
			  		</span>
			  	</p>
			
			    <p  class="couleurBleu">Les membres de ce groupe :</p>
			    <p>
			    	<ol>
			    	<?php
			    
					    $q="SELECT user_nicename FROM wp_users u, wp_id_group_membres igm WHERE igm.id_membre=u.ID
					    	and igm.id_groupe='".$tab_groups[$i]->id."'";
							
							$tab_membres_groupe=$wpdb->get_results($q);
							
							foreach ($tab_membres_groupe as $membre) {
						?>
							
						<li><?php echo '<a href="#">'.$membre->user_nicename.'</a>';?></li>
						
							
					<?php }?>
					</ol>
			     </p>
			    
			    <?php if (!is_null($tab_groups[$i]->affecteAuGroupe)) echo '<div id="affecter">Ce projet est affecté</div>';?>
			   </br>
			   
			  </div>
			
		<?php } ?>	
		</div>
		</br>
		</br>
			<script>
		  		$(function() {
		    		$( "#accordion" ).accordion({
		      		collapsible: true
		    });
		  });
  		</script>
  		
  		
  		
  		<script type="text/javascript">

			$(document).ready(function () {
				
				$('#hide').hide();
				
				$('.button').click(function(){
					
					var numero_projet=$(this).attr('id');
					//$("#"+numero_projet).attr("disabled",true);
					
					$('#hide').show();
					
					
				  $( '#dialog-confirm' ).dialog({
				  	
			      resizable: false,
			      height:140,
			      modal: true,
			      buttons: {
			        'Confirmer': function() {
			        
			        $input = $('<input type="text" name="numero_projet" class="cache"/>').val(numero_projet);
					$('#affecter_projet').append($input);
					
					 //$idEncadrant = $('<input type="text" name="id_encadrant" class="cache"/>').val(<?php echo $user_ID;?>);
					//$('#affecter_projet').append($idEncadrant);
					$('.cache').hide();	
						var request = $.ajax({
						  url: '<?php echo get_stylesheet_directory_uri(); ?>/ajax/affecter_projet.php',
						  type: 'POST',
						  data:$('#affecter_projet').serialize(),
						  dataType: 'html'
						});
						 
						request.done(function(msg) {
							
						  $("#"+numero_projet).hide();		
						  alert(msg);
						});
						 
						request.fail(function(jqXHR, textStatus) {
						  alert( 'Request failed: ' + textStatus );
						});
									         
						$( this ).dialog( 'close' );
					},
			        Cancel: function() {
			          $( this ).dialog( 'close' );
			          $("#"+id).removeAttr('disabled');
			          
			        }
			      }
			    });//Fin dialog
			

					
					//alert(id);
				});//Fin click button
			});//Fin ready
		</script>
		
	

    <script src="<?php echo get_stylesheet_directory_uri();?>/Codes/scripts/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>
    <script src="<?php echo get_stylesheet_directory_uri();?>/Codes/scripts/jquery.jtable.js" type="text/javascript"></script>



	<!-- Import Javascript files for validation engine (in Head section of HTML) -->
	<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri();?>/Codes/scripts/jquery.validationEngine.js"></script>
	<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri();?>/Codes/scripts/jquery.validationEngine-fr.js"></script>
	 
		
		
		
  </body>
</html>
<?php get_footer(); ?>
