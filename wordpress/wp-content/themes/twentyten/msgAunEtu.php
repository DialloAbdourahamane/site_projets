<?php
/**
 Template Name: Envoyer message a un etudiant
 */

get_header();
$current_user= wp_get_current_user();
$expMail=$current_user->user_email;
$expNom=$current_user->user_lastname ;
$expPrenom=$current_user->user_login;
$exp=$expPrenom.' '.$expNom;

 ?>
 
 <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 
<style type="text/css"> 
  .style-fieldset{border:solid 1px black; border-radius:10px; background-color:#F2F2F2; width:700px; padding:10px 10px 10px 30px; font-family:verdana; font-size:12px; margin-left:100px;} 
   .style-legend{font-family:verdana; font-size:14px; font-weight:bold;} 
   .txt-formulaire{border:solid 1px black; font-family:arial; font-size:12px; padding-left:4px; width:140px;} 
   .txt-formulaire:hover{border:solid 1px #AAAAAA;} 
   .lbl-formulaire{font-family:verdana; font-size:12px; width:120px; display:inline-block;} 
   .btn-formulaire{padding:5px 10px 5px 10px; cursor:pointer;} 
   .btn-formulaire:hover{color:firebrick;}
     </style>
</head> 
<body> 

<?php
$users = get_users('role=etudiant');
	?>
 <form name="mail_form" method="post" action="<?php echo get_stylesheet_directory_uri(); ?>/testEnvoiProf.php" target="target"> 
  	<fieldset class="style-fieldset" > 
   <legend class="style-legend"> Envoyer un message à un étudiant </legend> 
	<label class="lbl-formulaire" for="txt-destinataire">Destinataire :</label> 
        
<select name="destinataire">
 <?php
 // on alimente le menu déroulant 

	foreach( $users as $user ) { 
	echo '<option value="' , $user->user_email , '">' , stripslashes(htmlentities(trim($user->user_email ))) , '</option>';
		
	 } 
	 
?>
</select>
<br />
<input type="hidden" name="nomexpediteur" value="<?php echo $exp; ?>">
<input type="hidden" name="mailexpediteur" value="<?php echo $expMail; ?>">

 <label class="lbl-formulaire" for="txt-objet">Objet :</label> 
 <input type="text" name="objet" value="<?php if (isset($_POST['objet'])) echo stripslashes(htmlentities(trim($_POST['objet']))); ?>"><br />
  <label class="lbl-formulaire" for="txt-message" style="vertical-align:top;">Message :</label>  
<textarea id="txt-message" class="txt-formulaire" name="zone_texte"  rows="20" cols="200" style="width:460px !important;"><?php if (isset($_POST['message'])) echo stripslashes(htmlentities(trim($_POST['message']))); ?></textarea><br />
</fieldset> 
<table width="624" border="0" align="center"> 
<tr> 
      <td valign="top"><input name="nbre_champs_texte" type="hidden" id="nbre_champs_texte" value="1" /> 
        <input name="nbre_zones_texte" type="hidden" value="1" /> 
<input name="nbre_zone_email" type="hidden" value="0" /> 
<input name="titre_champ1" type="hidden" value="Objet" /> 
<input name="titre_zone" type="hidden" value="Message" /></td>
</tr> 
  </table> 
   <div style="text-align:center;"> 
   <input type="submit" name="envoi" value="Envoyer" class="btn-formulaire" />
   <input type="reset" name="Reset" value="Effacer" class="btn-formulaire" />
  
   </div>
  </form> 
   <iframe arc="0" style="border:none;" name="target" id="target" ></iframe> 
  </body>
  </html>
  <?php get_footer(); ?>