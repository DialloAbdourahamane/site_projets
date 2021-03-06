<?php
/*
Simple:Press
Admin Components Smileys Form
$LastChangedDate: 2012-11-18 11:04:10 -0700 (Sun, 18 Nov 2012) $
$Rev: 9312 $
*/

if (preg_match('#'.basename(__FILE__).'#', $_SERVER['PHP_SELF'])) die('Access denied - you cannot directly call this file');

define('SFUPLOADER', SFHOMEURL."index.php?sp_ahah=uploader&sfnonce=".wp_create_nonce('forum-ahah'));

function spa_components_smileys_form() {
	global $SPPATHS;
?>
<script type= "text/javascript">/*<![CDATA[*/
jQuery(document).ready(function(){
    jQuery('#sfsmileysform').ajaxForm({
        target: '#sfmsgspot',
        success: function() {
            jQuery('#sfreloadsm').click();
            jQuery('#sfmsgspot').fadeIn();
            jQuery('#sfmsgspot').fadeOut(6000);
        }
    });

	jQuery("#sfsmileytable").tableDnD({
		dragHandle: "dragHandle",
		onDragClass: "tdDragClass"
	});

	jQuery("#sfsmileytable tr").hover(function() {
		jQuery(this.cells[0]).addClass('showDragHandle');
	}, function() {
		jQuery(this.cells[0]).removeClass('showDragHandle');
	});

	var button = jQuery('#sf-upload-button'), interval;
	new AjaxUpload(button,{
		action: '<?php echo SFUPLOADER; ?>',
		name: 'uploadfile',
	    data: {
		    saveloc : '<?php echo addslashes(SF_STORE_DIR."/".$SPPATHS['smileys']."/"); ?>'
	    },
		onSubmit : function(file, ext){
            /* check for valid extension */
			if (! (ext && /^(jpg|png|jpeg|gif|JPG|PNG|JPEG|GIF)$/.test(ext))){
				jQuery('#sf-upload-status').html('<p class="sf-upload-status-text"><?php echo esc_js(spa_text('Only JPG, PNG or GIF files are allowed!')); ?></p>');
				return false;
			}
			/* change button text, when user selects file */
			utext = '<?php echo esc_js(spa_text('Uploading')); ?>';
			button.text(utext);
			/* If you want to allow uploading only 1 file at time, you can disable upload button */
			this.disable();
			/* Uploding -> Uploading. -> Uploading... */
			interval = window.setInterval(function(){
				var text = button.text();
				if (text.length < 13){
					button.text(text + '.');
				} else {
					button.text(utext);
				}
			}, 200);
		},
		onComplete: function(file, response){
			jQuery('#sf-upload-status').html('');
			button.text('<?php echo esc_js(spa_text('Browse')); ?>');
			window.clearInterval(interval);
			/* re-enable upload button */
			this.enable();
			/* add file to the list */
			if (response==="success"){
                site = "<?php echo SFHOMEURL; ?>index.php?sp_ahah=components&amp;sfnonce=<?php echo wp_create_nonce('forum-ahah'); ?>&amp;action=delsmiley&amp;file=" + file;
				var count = document.getElementById('smiley-count');
				var scount = parseInt(count.value) + 1;
				jQuery('<table width="100%"></table>').appendTo('#sf-smiley-imgs').html('<tr><td width="5%" align="center"><img class="spSmiley" src="<?php echo SFSMILEYS; ?>' + file + '" alt="" /></td><td class="sflabel" align="center" width="30%"><input type="hidden" name="smfile[]" value="' + file + '" />' + file + '</td><td width="30%" align="center"><input type="text" class="sfpostcontrol" size="20" name="smname[]" value="" /></td><td width="25%" align="center"><input type="text" class="sfpostcontrol" size="20" name="smcode[]" value="" /></td><td width="5%" class="sflabel" align="center"><label for="sf-new-'+scount+'"></label><input class="sfnewradio'+scount+'" type="checkbox" name="sminuse-new-'+scount+'" id="sf-new-'+scount+'" checked="checked"/></td><td class="sflabel" align="center" width="5%"><img src="<?php echo SFCOMMONIMAGES; ?>' + 'delete.png' + '" title="<?php echo esc_js(spa_text('Delete Smiley')); ?>" alt="" onclick="spjDelRowReload(\'' + site + '\', \'sfreloadsm\');var x=jQuery(\'#smiley-count\').val();jQuery(\'#smiley-count\').val(parseInt(x)- 1);" /></td></tr>');
                jQuery("input.sfnewradio"+scount).prettyCheckboxes();
				jQuery('#smiley-count').val(scount);
				jQuery('#sf-upload-status').html('<p class="sf-upload-status-success"><?php echo esc_js(spa_text('Smiley uploaded!')); ?></p>');
			} else if (response==="invalid"){
				jQuery('#sf-upload-status').html('<p class="sf-upload-status-fail"><?php echo esc_js(spa_text('Sorry, the file has an invalid format!')); ?></p>');
			} else if (response==="exists") {
				jQuery('#sf-upload-status').html('<p class="sf-upload-status-fail"><?php echo esc_js(spa_text('Sorry, the file already exists!')); ?></p>');
			} else {
				jQuery('#sf-upload-status').html('<p class="sf-upload-status-fail"><?php echo esc_js(spa_text('Error uploading file!')); ?></p>');
			}
		}
	});
});/*]]>*/</script>

<?php
	$sfcomps = spa_get_smileys_data();

    $ahahURL = SFHOMEURL.'index.php?sp_ahah=components-loader&amp;sfnonce='.wp_create_nonce('forum-ahah').'&amp;saveform=smileys';
?>
	<form action="<?php echo $ahahURL; ?>" method="post" id="sfsmileysform" name="sfsmileys" enctype="multipart/form-data">
	<?php echo sp_create_nonce('forum-adminform_smileys'); ?>
<?php

	spa_paint_options_init();

#== SMILEYS Tab ============================================================

	spa_paint_open_tab(spa_text('Components').' - '.spa_text('Smileys'));

		spa_paint_open_panel();

		spa_paint_open_panel();
			spa_paint_open_fieldset(spa_text('Smiley Options'), true, 'smiley-options');
				spa_paint_checkbox(spa_text('Allow smileys'), 'sfsmallow', $sfcomps['sfsmallow'], false, true, true);
			spa_paint_close_fieldset();
		spa_paint_close_panel();

		do_action('sph_components_smileys_left_panel');

	spa_paint_tab_right_cell();

		spa_paint_open_panel();
			spa_paint_open_fieldset(spa_text('Custom Smiley Upload'), true, 'smiley-upload');
				$loc = SF_STORE_DIR.'/'.$SPPATHS['smileys'].'/';
				spa_paint_file(spa_text('Select smiley file to upload'), 'newsmileyfile', false, true, $loc);
			spa_paint_close_fieldset();
		spa_paint_close_panel();

		echo '</td>';
		echo '</tr>';
		echo '</table>';

		spa_paint_open_panel();
			spa_paint_open_fieldset(spa_text('Custom Smileys'), true, 'custom-smileys', true);
			echo '<p><b>'.spa_text('To re-order your Smileys drag and drop using the grab handle on the left of each row').'</b></p>';
			spa_paint_custom_smileys();
			spa_paint_close_fieldset(true);
		spa_paint_close_panel();

		spa_paint_close_panel();

		do_action('sph_components_smileys_right_panel');

	spa_paint_close_tab();

?>
	<div class="sfform-submit-bar">
	<input type="submit" class="button-primary" id="updatesmileys" name="saveit" value="<?php spa_etext('Update Smileys Component'); ?>" />
	</div>
	</form>
<?php
}
?>