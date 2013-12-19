<?php
    /*Template Name: creer groupe 13*/
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
    
    
    <script src="<?php echo get_stylesheet_directory_uri();?>/Codes/scripts/jquery-1.6.4.min.js" type="text/javascript"></script>
   
	
  </head>
  <body>
  	
  	<form id="envoie_groupe_membre" method="POST"></form>
  	
  	<div id="SelectedRowList">Selectionner le groupe auquel vous voulez vous ajouter !</div>
  </br>
  	<button id="desactive" title="Selectionner un groupe dans lequel s'ajouter ci-dessous">S'ajouter </button>
  	</br>
  	</br>
  	</br>
	<div id="PeopleTableContainer" style="width: 600px;"></div>
	
	<div id="dialog-confirm" title="S'ajouter dans ce groupe?">
  			<p id="hide"><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;">
  				
  			</span>Etes vous sure de vouloir vous inscrire dans ce groupe?</p>
	</div>
  		
  		<div id="commentaires"></div>

	<script type='text/javascript'>

	
		
		$(document).ready(function () {

			var request = $.ajax({
						  url: '<?php echo get_stylesheet_directory_uri(); ?>/ajax/groupe.php',
						  type: 'GET',
						  data:{id_membre: <?php 
						  if ($membre_id->id_membre != null) {
						  echo $membre_id->id_membre;
						} else {
						  echo "2";
						}
						  
						 ?>} ,
						  dataType: 'text'
						});
						
						
						 
		request.done(function(msg) {
					
						  //alert(msg);
						  
			//il sest deja ajouter dans un groupe 			  
			if(msg==0){		  
				
					$('#desactive').hide();
				    //Prepare jTable
					$('#PeopleTableContainer').jtable({
						title: 'Votre Groupe',
						paging: true,
						pageSize: 10,
						sorting: true,
						defaultSorting: 'id ASC',
						  selecting: true, //Enable selecting
		       			//multiselect: true, //Allow multiple selecting
		            	selectingCheckboxes: true, //Show checkboxes on first column
		            	//selectOnRowClick: false, //Enable this to only select using checkboxes
						actions: {
						    listAction: '<?php print get_stylesheet_directory_uri(); ?>/Codes/GroupActions.php?action=list&membreID=<?php echo $user_ID;?>',
		                    updateAction: '<?php print get_stylesheet_directory_uri(); ?>/Codes/GroupActions.php?action=update&membreID=<?php echo $user_ID;?>' ,
		                    deleteAction: '<?php print get_stylesheet_directory_uri(); ?>/Codes/GroupActions.php?action=delete&membreID=<?php echo $user_ID;?>'
		               		
		               		
		               		
						},
						fields: {
							id: {
								key: true,
								create: false,
								edit: false,
								list: true
							},
							nomGroupe: {
								title: 'Nom Groupe',
								create: true,
								edit: true,
								width: '40%'
							}
						},
						
						 //Register to selectionChanged event to hanlde events
		            selectionChanged: function () {
		                //Get all selected rows
		                var $selectedRows = $('#PeopleTableContainer').jtable('selectedRows');
		 
		                $('#SelectedRowList').empty();
		                if ($selectedRows.length > 0) {
		                    //Show selected rows
		                    $selectedRows.each(function () {
		                        var record = $(this).data('record');
		                        
		                        		
								$input = $('<input type="text" name="id_groupe" class="cache"/>').val(record.id);
								$('#envoie_groupe_membre').append($input);
								$('.cache').hide();
								/*
		                        var request = $.ajax({
								  url: '<?php //echo get_stylesheet_directory_uri(); ?>//AddData.php',
								  type: 'GET',
								  data:{id_groupe:record.id} ,
								  dataType: 'html'
								});
								*/
								
		                        $('#SelectedRowList').append(
		                            '<b>Identifiant</b>: ' + record.id +
		                            '<br /><b>Nom du Groupe</b>:' + record.nomGroupe + '<br /><br />'
		                            );
		                    });
		                } else {
		                    //No rows selected
		                    $('#SelectedRowList').append('Aucun groupe selectionné...');
		                    //$('#desactive').show();
		                }
		            }
					});
		
					//Load person list from server
					$('#PeopleTableContainer').jtable('load');

						  
				}
				
				if(msg==1){
					
							
							//Prepare jTable
					$('#PeopleTableContainer').jtable({
						title: 'Votre Groupe',
						paging: true,
						pageSize: 10,
						sorting: true,
						defaultSorting: 'id ASC',
						  selecting: true, //Enable selecting
		       			//multiselect: true, //Allow multiple selecting
		            	selectingCheckboxes: true, //Show checkboxes on first column
		            	//selectOnRowClick: false, //Enable this to only select using checkboxes
						actions: {
						    listAction: '<?php print get_stylesheet_directory_uri(); ?>/Codes/GroupActions.php?action=list&membreID=<?php echo $user_ID;?>',
		                    createAction:'<?php print get_stylesheet_directory_uri(); ?>/Codes/GroupActions.php?action=create&membreID=<?php echo $user_ID;?>',
		
		                    updateAction: '<?php print get_stylesheet_directory_uri(); ?>/Codes/GroupActions.php?action=update&membreID=<?php echo $user_ID;?>' ,
		                    deleteAction: '<?php print get_stylesheet_directory_uri(); ?>/Codes/GroupActions.php?action=delete&membreID=<?php echo $user_ID;?>'
		               		
		               		
		               		
						},
						fields: {
							id: {
								key: true,
								create: false,
								edit: false,
								list: true
							},
							nomGroupe: {
								title: 'Nom Groupe',
								create: true,
								edit: true,
								width: '40%'
							}
						},
						
						 //Register to selectionChanged event to hanlde events
		            selectionChanged: function () {
		                //Get all selected rows
		                var $selectedRows = $('#PeopleTableContainer').jtable('selectedRows');
		 
		                $('#SelectedRowList').empty();
		                if ($selectedRows.length > 0) {
		                    //Show selected rows
		                    $selectedRows.each(function () {
		                        var record = $(this).data('record');
		                        
		                       $input = $('<input type="text" name="id_groupe" class="cache"/>').val(record.id);
								$('#envoie_groupe_membre').append($input);
								$('.cache').hide();
								
		                        $('#SelectedRowList').append(
		                            '<b>Identifiant</b>: ' + record.id +
		                            '<br /><b>Nom du Groupe</b>:' + record.nomGroupe + '<br /><br />'
		                            );
		                    });
		                } else {
		                    //No rows selected
		                    $('#SelectedRowList').append('Aucun groupe selectionné...');
		                }
		            }
					});
		
					//Load person list from server
					$('#PeopleTableContainer').jtable('load');

				}		  
						  
						  
			});
			
				
		});

	</script>
	</br>
 	</br>
 	
 	<script>
 		
 		$(document).ready(function() {
 			
 			$('#desactive').button({
      			icons: {
        		primary: 'ui-icon-plus'
        		}
      		});
 		});
 	</script>
 	
 	<script>
		
		$(document).ready(function() {
   		
			$('#hide').hide();
	 		$('#desactive').click( function(e){
	     			// e.preventDefault();
				$('#desactive').attr('disabled', 'disabled');
				$('#hide').show();
				
				  $( '#dialog-confirm' ).dialog({
				  	
			      resizable: false,
			      height:140,
			      modal: true,
			      buttons: {
			        'S\'ajouter': function() {
			        
			        $input = $('<input type="text" name="id_membre" class="cache"/>').val(<?php echo $user_ID;?>);
					$('#envoie_groupe_membre').append($input);
					$('.cache').hide();	
						var request = $.ajax({
						  url: '<?php echo get_stylesheet_directory_uri(); ?>/AddData.php',
						  type: 'POST',
						  data:$('#envoie_groupe_membre').serialize(),
						  dataType: 'html'
						});
						 
						request.done(function(msg) {
					
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

  	 <script src="<?php echo get_stylesheet_directory_uri();?>/Codes/scripts/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>
    <script src="<?php echo get_stylesheet_directory_uri();?>/Codes/scripts/jquery.jtable.js" type="text/javascript"></script>

  </br>
  </body>
</html>

<?php get_footer(); ?>
