<?php
	session_start();
	/*Template Name: all project*/

get_header();
?>
<?php
	
   $mysqli = new mysqli("localhost", "your data name", "your passe word", "your db name");
   

    /* Vérification de la connexion */
    if (mysqli_connect_errno()) {
        printf("Echec de la connexion  : %s\n", mysqli_connect_error());
        exit();
    }

	$query = "SELECT count(*)  FROM wp_sujets";
	$result = $mysqli->query($query);
			
	$nbsujet=$result->fetch_array(MYSQLI_NUM);
	
	$_SESSION['nbsujet']=$nbsujet[0];		
	
	$result->free();
	
    $query = "SELECT * FROM wp_sujets";
    $result = $mysqli->query($query);
	
	

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
       
	   
		
		<script src="<?php echo get_stylesheet_directory_uri(); ?>/reveal/jquery.reveal.js" type="text/javascript"></script>
	
		
         <style type="text/css">
			
			
            @import "<?php echo get_stylesheet_directory_uri(); ?>/media/css/demo_table_jui.css";
            @import "<?php echo get_stylesheet_directory_uri(); ?>/media/themes/smoothness/jquery-ui-1.9.2.custom.min.css";
			@import "<?php echo get_stylesheet_directory_uri(); ?>/reveal/reveal.css";


 
        </style>
        
        
        
         <script type="text/javascript" charset="utf-8">


		 
		   $(document).ready(function(){
		  
					
                $('#myDataTable').dataTable({
                    "sPaginationType":"full_numbers",
                    "aaSorting":[[2, "desc"]],
                    "bJQueryUI":true,
					
					 
						 
                }).makeEditable({
				
                           
                            sAddURL: "<?php echo get_stylesheet_directory_uri(); ?>/AddData.php",
                            sDeleteURL: "<?php echo get_stylesheet_directory_uri(); ?>/DeleteData.php",
							sUpdateURL: "<?php echo get_stylesheet_directory_uri(); ?>/UpdateData.php",
							
					
                            oAddNewRowButtonOptions: { 
				label: "Ajouter un nouveau projet...",
                                icons: { primary: 'ui-icon-plus' }
                            },
                            oDeleteRowButtonOptions: {
				label: "Remove",
                                icons: { primary: 'ui-icon-trash' }
                            },
				
                            oAddNewRowOkButtonOptions: {
				label: "Ajouter",
                                icons: { primary: 'ui-icon-check' },
                                name: "action",
                                value: "add-new"
                            },
                            oAddNewRowCancelButtonOptions: { 
				label: "Annuler",
                                class: "back-class",
                                name: "action",
                                value: "cancel-add",
                                icons: { primary: 'ui-icon-close' }
                            },
                            oAddNewRowFormOptions: {
				title: 'Formulaire d\'ajout de projet',
                                show: "blind",
                                hide: "explode",
								width: 520                            

								}
        });
		
	
            });
			
			
/*			
			var oTable;

$(document).ready(function() {
	$('#action').submit( function() {
		var sData = $('input', oTable.fnGetNodes()).serialize();
		alert( "The following data would have been submitted to the server: \n\n"+sData );
		return false;
	} );
	
	oTable = $('#myDataTable').dataTable();
} );
		
		*/
/*
$(document).ready( function () {
	$('#myDataTable').dataTable().makeEditable({
                       	sUpdateURL: "UpdateData.php",
                       	"aoColumns": [
                    				null,
                    				{
                    				},
                    				{
                						indicator: 'Saving platforms...',
                						tooltip: 'Click to edit platforms',
                						type: 'textarea',
                						submit:'Save changes',
                						fnOnCellUpdated: function(sStatus, sValue, settings){
                							alert("(Cell Callback): Cell is updated with value " + sValue);
                						}
                    				},
                    				{
                						//indicator: 'Saving Engine Version...',
                						tooltip: 'Click to select engine version',
                						loadtext: 'loading...',
                						type: 'select',
                						onblur: 'cancel',
                						submit: 'Ok',
                						loadurl: 'index.php',
                						loadtype: 'POST',
                						sUpdateURL: "index.php"
                    				},
                    				{
                						indicator: 'Saving CSS Grade...',
                						tooltip: 'Click to select CSS Grade',
                						loadtext: 'loading...',
                						type: 'select',
                						onblur: 'submit',
                						data: "{'':'Please select...', 'A':'A','B':'B','C':'C'}",
                						sUpdateURL: function(value, settings){
                							alert("Custom function for posting results");
                							return value;

                						}
                					}
					]									
				});
	})
	*/
	
	/*
	  $(document).ready(function () {
        var oTable = $('#myDataTable').dataTable().makeEditable({
                            sUpdateURL: "UpdateData.php",
                            sAddURL: "AddData.php",
                            sDeleteURL: "DeleteData.php",
                            oAddNewRowButtonOptions: { 
				label: "Add...",
                                icons: { primary: 'ui-icon-plus' }
                            },
                            oDeleteRowButtonOptions: {
				label: "Remove",
                                icons: { primary: 'ui-icon-trash' }
                            },
                            oAddNewRowOkButtonOptions: {
				label: "Confirm",
                                icons: { primary: 'ui-icon-check' },
                                name: "action",
                                value: "add-new"
                            },
                            oAddNewRowCancelButtonOptions: { 
				label: "Close",
                                class: "back-class",
                                name: "action",
                                value: "cancel-add",
                                icons: { primary: 'ui-icon-close' }
                            },
                            oAddNewRowFormOptions: {
				title: 'Add a new browser - form',
                                show: "blind",
                                hide: "explode",
								width: 400                            

								}
        });

    });
	
		*/


        </script>
		
		
		 <script>
/*
var oTable;
var giRedraw = false;

$(document).ready(function() {
	/* Add a click handler to the rows - this could be used as a callback */
	/*$("#myDataTable tbody").click(function(event) {
		$(oTable.fnSettings().aoData).each(function (){
			$(this.nTr).removeClass('row_selected');
			//alert("Diallo");
		});
		$(event.target.parentNode).addClass('row_selected');
	});
*/	
	/* Add a click handler for the delete row */
	/*
	$('#delete').click( function() {
		var anSelected = fnGetSelected( oTable );
		oTable.fnDeleteRow( anSelected[0] );
		
		
	} );
	
	/* Init the table */
	//oTable = $('#myDataTable').dataTable( );
//} );



/* Get the rows which are currently selected */

/*
function fnGetSelected( oTableLocal )
{
	var aReturn = new Array();
	var aTrs = oTableLocal.fnGetNodes();
	
	for ( var i=0 ; i<aTrs.length ; i++ )
	{
		if ( $(aTrs[i]).hasClass('row_selected') )
		{
			aReturn.push( aTrs[i] );
		}
	}
	
	return aReturn;
}

*/

 </script>
 
        <title>Data Table Editor</title>
    </head>
    <body >
      
		<!--
        <button id="btnAddNewRow">Add</button>
        <button id="btnDeleteRow">Delete</button>
       
		
        <div class="add_delete_toolbar" />
		-->
        <label id="lblAddError" style="display:none" class="error"></label>
		<div id="processing_message" style="display:none" title="Processing">Please wait while your request is being processed...</div>

       <div id="container">
     
                <table id="myDataTable" cellpadding="0" cellspacing="0" border="0" class="display">
                    <thead>
                        <tr>
                            <th>Numero</th>
                            <th>Titre</th>
                            <!--<th>Auteur</th>-->
                            <th>Nature</th>
                            <th>Langage</th>
							<th>Taille Equipe</th>
							<th>Description</th>
							
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        
                            while ($row = $result->fetch_array(MYSQLI_ASSOC)){
								
                         ?>       
						 
								<tr id="<?php echo $row['numero'];?>">
								
                                    <td><?php echo $row['numero'];?></td>
                                    <td><?php echo $row['titre'];?></td>
                                 
                                    <td><?php echo $row['nature'];?></td>
                                    <td><?php echo $row['langage'];?></td>
									<td><?php echo $row['tailleEquipe'];?></td>
									<td>
									
										<a href="#"
										data-reveal-id="myModal<?php echo $row['numero'];?> "  id="myLink"
										data-animation="fadeAndPop" 
										data-animationspeed="300" data-closeonbackgroundclick="true" 
										data-dismissmodalclass="close-reveal-modal"> 
										Voir description
		
										</a>

										
		
									</td>
									<!-- la boite d'affichage du modal"-->
									
									<div id="myModal<?php echo $row['numero'];?>" class="reveal-modal">
											<a class="close-reveal-modal">&#215;</a>
											 <h1><?php	echo $row['titre']; ?></h1>

												<?php	echo $row['theme']; ?>

									</div>
									
								</tr>
								
								
                         <?php
                            } // Fin du while
							
                            /* Libération des résultats */
                                $result->free();

                                /* Fermeture de la connexion */
                                $mysqli->close();        
                          ?>   
                    </tbody>
            </table>
    </div> 
    
  <form id="formAddNewRow" method="post" action="<?php echo get_stylesheet_directory_uri(); ?>/AddData.php"  onload="document.getElementById('#titre').focus()" >

		<input type="hidden" name="numero" id="numero"  rel="0" 
			value="<?php 
			
				$nbsujet=$_SESSION['nbsujet'];
				
				$nbsujet+=1;
				
				$_SESSION['nbsujet']=$nbsujet;
				
				//echo $nbsujet;
			
									
			?>" /><label for="name"></label>
		</br>
       <input type="text" name="titre" id="titre" class="required" rel="1" placeholder="Titre"/> <label for="name"></label>
     <br/>

        <input type="text" name="nature" id="nature" rel="2" placeholder="Nature"/> <label for="name"></label>
    <br/>
	<input type="text" name="langage" id="langage"  class="required" rel="3" placeholder="Langage"/> <label for="name"></label>
       
        
      <br/>
		<input type="text" name="tailleEquipe" id="tailleEquipe" rel="4" placeholder="Taille Equipe"/> <label for="name"></label>

          <br/>
		  	<input type="text" name="moduleConcerne" id="moduleConcerne" class="required"  placeholder="Module Concerné" /> <label for="name"></label>

		<div id="des">
				 <span>
					<label for="name">Description</label> <label for="name" id="uploadLabel"/>
					<input title="selectionner votre fichier de desc" type="file" /> 
				</span>
				<br/>
				<textarea rel="5" 
					placeholder="Taper ou inserer la description ici" cols="50" rows="4"  
					name="description" id="description"  >
				</textarea>
		</div>
 </form>
 
 </br>
	</br>

    </body>
	
</html>
 <?php get_footer(); ?>