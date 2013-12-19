<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier contient les réglages de configuration suivants : réglages MySQL,
 * préfixe de table, clefs secrètes, langue utilisée, et ABSPATH.
 * Vous pouvez en savoir plus à leur sujet en allant sur 
 * {@link http://codex.wordpress.org/Editing_wp-config.php Modifier
 * wp-config.php} (en anglais). C'est votre hébergeur qui doit vous donner vos
 * codes MySQL.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d'installation. Vous n'avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en "wp-config.php" et remplir les
 * valeurs.
 *
 * @package WordPress
 */


// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define('DB_NAME', 'votre_nom_de_bdd');

/** Utilisateur de la base de données MySQL. */
define('DB_USER', 'votre_utilisateur_de_bdd');

/** Mot de passe de la base de données MySQL. */
define('DB_PASSWORD', 'votre_mdp_de_bdd');

/** Adresse de l'hébergement MySQL. */
define('DB_HOST', 'localhost');

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define('DB_CHARSET', 'utf8');

/** Type de collation de la base de données. 
  * N'y touchez que si vous savez ce que vous faites. 
  */
define('DB_COLLATE', '');

/**#@+
 * Clefs uniques d'authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant 
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clefs secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n'importe quel moment, afin d'invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'TR)o<QotrL{Mt);#^wokDFz)LB/w/uqumH1A-LGZUgz8N_GfZx(8m}uO/g^*26ca');
define('SECURE_AUTH_KEY',  ']2`Ym=/=:+d=tG)wK-lw3.vD&5JDvMT0R(L2FE_h?[_vP6`dVSt{xhrt8*r`laFR');
define('LOGGED_IN_KEY',    'lNSP+9l]3yV}Bt(1e&Dq]E|qGqRpVD_k70F.m.u1^DcDdafCmVT,Iwz6AEZYasaL');
define('NONCE_KEY',        'q$E{wA^hCS,Oh@)r~ir_0HW,H`~}f0gpM-,lbTu-uH!Nc?u&assx]Ml~>yytIIr?');
define('AUTH_SALT',        'Jkdwch>1NMv+&|Dq>H57-i7f0w]$1Xigt+3^xEb<cs-ul}lmHuIQL&zM(}cb1/JR');
define('SECURE_AUTH_SALT', 'Is[B9~8/z9y$*`#CkQs63rUZ>Qj+SJ+UF$Zxo?gHA1[.Qht1n~!GV(:y>^K;2ZP2');
define('LOGGED_IN_SALT',   '&GC-~w2ux5UW!}j6v)Dgm@jl#8xW|eHx{[3q#)hXq1I>GeSbcuw<WY.K)H%mB0Uv');
define('NONCE_SALT',       'x#~>FR}Bl]-r^[zc7xd7^]L-cp%/a-~FKqg#1}%@aP]!uV`3KF.[J{_!|7&F<>-f');
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique. 
 * N'utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés!
 */
$table_prefix  = 'wp_';

/**
 * Langue de localisation de WordPress, par défaut en Anglais.
 *
 * Modifiez cette valeur pour localiser WordPress. Un fichier MO correspondant
 * au langage choisi doit être installé dans le dossier wp-content/languages.
 * Par exemple, pour mettre en place une traduction française, mettez le fichier
 * fr_FR.mo dans wp-content/languages, et réglez l'option ci-dessous à "fr_FR".
 */
define('WPLANG', 'fr_FR');

/** 
 * Pour les développeurs : le mode deboguage de WordPress.
 * 
 * En passant la valeur suivante à "true", vous activez l'affichage des
 * notifications d'erreurs pendant votre essais.
 * Il est fortemment recommandé que les développeurs d'extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de 
 * développement.
 */ 
define('WP_DEBUG', false); 

/* C'est tout, ne touchez pas à ce qui suit ! Bon blogging ! */

/** Chemin absolu vers le dossier de WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once(ABSPATH . 'wp-settings.php');