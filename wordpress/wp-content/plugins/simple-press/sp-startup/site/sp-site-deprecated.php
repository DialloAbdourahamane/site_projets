<?php
/*
Simple:Press
Deprecated - global code
$LastChangedDate: 2013-02-08 11:38:58 -0700 (Fri, 08 Feb 2013) $
$Rev: 9825 $
*/

if (preg_match('#'.basename(__FILE__).'#', $_SERVER['PHP_SELF'])) die('Access denied - you cannot directly call this file');

# ==========================================================================================
#
# 	SITE - This file loads at core level - all page loads
#	SP Deprecated Functions - where deprecated functions come to die
#   Wrappers for old deprecated functions which call the new, appropriate functions
#   Emit a deprecated warning
#   handled like wp deprecations (same logging)
#
# ==========================================================================================

?>