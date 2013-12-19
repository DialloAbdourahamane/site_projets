<?php
/*
Simple:Press
Users New Posts Popup
$LastChangedDate: 2012-11-18 11:04:10 -0700 (Sun, 18 Nov 2012) $
$Rev: 9312 $
*/

if (preg_match('#'.basename(__FILE__).'#', $_SERVER['PHP_SELF'])) die('Access denied - you cannot directly call this file');

sp_forum_api_support();

global $spThisUser, $spListView, $spThisListTopic;

$popup = 1;

if (!isset($_GET['action'])) die();
if (isset($_GET['popup'])) $popup = $_GET['popup'];

# Individual forum new post listing
if ($_GET['action'] == 'forum') {
	if (isset($_GET['id'])) {
		$fid = (int) $_GET['id'];
		$topics = array();
		for ($x=0; $x<count($spThisUser->newposts['forums']); $x++) {
			if ($spThisUser->newposts['forums'][$x] == $fid) $topics[] = $spThisUser->newposts['topics'][$x];
		}

		if ($popup) echo '<div id="spMainContainer">';
        $first = sp_esc_int($_GET['first']);
		$spListView = new spTopicList($topics, 0, true, '', $first, $popup);

		sp_load_template('spListView.php');
		if($popup) echo '</div>';
	}
}

# All forums (users new post list)
if ($_GET['action'] == 'all') {
	echo '<div id="spMainContainer">';
    $first = sp_esc_int($_GET['first']);
	$spListView = new spTopicList($spThisUser->newposts['topics'], 0, true, '', $first, $popup);

	sp_load_template('spListView.php');
	echo '</div>';
}

die();
?>