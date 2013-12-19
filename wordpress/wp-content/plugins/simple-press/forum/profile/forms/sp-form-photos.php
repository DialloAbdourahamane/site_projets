<?php
/*
Simple:Press
Profile Photos Form
$LastChangedDate: 2012-12-30 19:26:22 -0700 (Sun, 30 Dec 2012) $
$Rev: 9634 $
*/

if (preg_match('#'.basename(__FILE__).'#', $_SERVER['PHP_SELF'])) die('Access denied - you cannot directly call this file');

# double check we have a user
if (empty($userid)) return;
?>
<script type="text/javascript">
jQuery(document).ready(function() {
	/* ajax form and message */
	jQuery('#spProfileFormPhotos').ajaxForm({
        dataType: 'json',
		success: function(response) {
			jQuery('#spProfileMenu-edit-photos').click();
            if (response.type == 'success') {
        	   spjDisplayNotification(0, response.message);
            } else {
        	   spjDisplayNotification(1, response.message);
            }
		}
	});
})
</script>
<?php
$out = '';
$out.= '<p>';
$out.= sp_text('On this panel, you may reference some personal photos or images that can be displayed in your profile.');
$out.= '</p>';
$out.= '<hr>';

$out.= '<div class="spProfilePhotos">';

if ($spProfileOptions['photosmax'] < 1) {
	$out.= '<p class="spProfileLabel">'.sp_text('Profile photos are not enabled on this forum').'</p>';
} else {
    $ahahURL = SFHOMEURL.'index.php?sp_ahah=profile-save&amp;sfnonce='.wp_create_nonce('forum-ahah')."&amp;form=$thisSlug&amp;userid=$userid";
	$out.= '<form action="'.$ahahURL.'" method="post" name="spProfileFormPhotos" id="spProfileFormPhotos" class="spProfileForm">';
	$out.= sp_create_nonce('forum-profile');

	$out = apply_filters('sph_ProfileFormTop', $out, $userid, $thisSlug);
	$out = apply_filters('sph_ProfilePhotosFormTop', $out, $userid);

	for ($x=0; $x < $spProfileOptions['photosmax']; $x++) {
    	$out.= '<div class="spColumnSection spProfileLeftCol">';
		$out.= '<p class="spProfileLabel">'.sp_text('Url to Photo').' '.($x+1).'</p>';
    	$out.= '</div>';
    	$out.= '<div class="spColumnSection spProfileSpacerCol"></div>';
        $photo = (!empty($spProfileUser->photos[$x])) ? $spProfileUser->photos[$x] : '';
    	$out.= '<div class="spColumnSection spProfileRightCol">';
		$out.= "<p class='spProfileLabel'><input class='spControl' type='text' name='photo$x' value='$photo' /></p>";
    	$out.= '</div>';
	}

	$out = apply_filters('sph_ProfilePhotosFormBottom', $out, $userid);
	$out = apply_filters('sph_ProfileFormBottom', $out, $userid, $thisSlug);

	$out.= '<div class="spProfileFormSubmit">';
	$out.= '<input type="submit" class="spSubmit" name="formsubmit" value="'.sp_text('Update Photos').'" />';
	$out.= '</div>';
	$out.= '</form>';
}
$out.= '</div>'."\n";

$out = apply_filters('sph_ProfilePhotosForm', $out, $userid);
echo $out;
?>