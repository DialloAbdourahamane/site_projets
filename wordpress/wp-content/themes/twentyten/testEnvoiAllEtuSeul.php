<?php 
$mailexpediteur=$_POST['mailexpediteur'];
$nomexpediteur=$_POST['nomexpediteur'];

$mes_etu=$_POST['mes_etu'];
$tab = unserialize(stripslashes($_POST['mes_etu']));

$msg_erreur = "Erreur. Les champs suivants doivent etre obligatoirement remplis :<br/><br/>";
$msg_ok = "Votre message a bien ete envoye.";
$message = $msg_erreur; 
$to='';

for($i=0;$i<sizeof($tab);$i++){
	$to .=$tab[$i]. ', ';
	}
	
define('MAIL_DESTINATAIRE',$to); 
define('MAIL_SUJET',$_POST['objet']); 
// vérification des champs 
if (empty($_POST['objet'])) {
$message .= "Le champ objet est vide !!<br/>"; 
}
if (empty($_POST['zone_texte'])) {
$message .= "Le champ messsage est vide !!<br/>"; 
}
if (strlen($message) > strlen($msg_erreur)) { 
echo $message; 

} 

else { 
foreach($_POST as $index => $valeur) {
$$index = stripslashes(trim($valeur));
} 
 
//Préparation de l entête du mail:
$mail_entete = "MIME-Version: 1.0\r\n";
$mail_entete .= "From: ".$nomexpediteur."< ".$mailexpediteur." >\r\n";
$mail_entete .= "Reply-To:".$mailexpediteur." \r\n";
$mail_entete .= 'Content-Type: text/plain; charset="iso-8859-1"';
$mail_entete .= "\r\nContent-Transfer-Encoding: 8bit\r\n";
$mail_entete .= 'X-Mailer:PHP/' . phpversion()."\r\n"; 


// préparation du corps du mail
$mail_corps = $_POST['zone_texte'];

 
// envoi du mail
if (mail(MAIL_DESTINATAIRE,MAIL_SUJET,$mail_corps,$mail_entete)) { 
//Le mail est bien expédié
echo $msg_ok;
} else { 
//Le mail n a pas été expédié
echo 'Suite à un problème technique, votre message n a pas été envoyé';
}

}
?> 