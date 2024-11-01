<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
/*
Plugin Name: Soundcloud sidebar widget
Plugin URI: http://www.wp1stop.com
Description: Allows you to add a Featured track widget
Version: 1.0
Author: PohlMedia
Author URI: http://www.pohlmedia.com
/* ----------------------------------------------*/



?>
<?php

$themetrack = "Featured Track";
$shortname1 = "soundcloud";
$options1 = array (


array(    "name" => "Add a Featured track",
        "type" => "title"),

array(    "type" => "open"),

array(    "name" => "Featured Track Code 1 ",
        "desc" => "Enter the code for the feature track",
        "id" => $shortname1."_featuredtrack",
        "type" => "textarea"),
		
		array(    "name" => "Featured Track Code 2 ",
        "desc" => "Enter the code for the feature track",
        "id" => $shortname1."_featuredtrack2",
        "type" => "textarea"),
		
		array(    "name" => "Featured Track Code 3 ",
        "desc" => "Enter the code for the feature track",
        "id" => $shortname1."_featuredtrack3",
        "type" => "textarea"),
		
		array(    "name" => "Featured Track Code 4 ",
        "desc" => "Enter the code for the feature track",
        "id" => $shortname1."_featuredtrack4",
        "type" => "textarea"),
		

array(    "type" => "close")

);




function mytheme_add_soundcloud() {

    global $themetrack, $shortname1, $options1;

    if ( $_GET['page'] == basename(__FILE__) ) {
    
        if ( 'save' == $_REQUEST['action'] ) {

                foreach ($options1 as $value) {
                    update_option( $value['id'], $_REQUEST[ $value['id'] ] ); }

                foreach ($options1 as $value) {
                    if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); } else { delete_option( $value['id'] ); } }

                header("Location: themes.php?page=soundcloud-widget.php&saved=true");
                die;

        } else if( 'reset' == $_REQUEST['action'] ) {

            foreach ($options1 as $value) {
                delete_option( $value['id'] ); }

            header("Location: themes.php?page=soundcloud-widget.php&reset=true");
            die;

        }
    }

    add_theme_page($themetrack." options1", "".$themetrack." options1", 'edit_themes', basename(__FILE__), 'mytheme_soundcloud');

}

function mytheme_soundcloud() {

    global $themetrack, $shortname1, $options1;

    if ( $_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themetrack.' settings saved.</strong></p></div>';
    if ( $_REQUEST['reset'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themetrack.' settings reset.</strong></p></div>';
    
	
	
	?>
<div class="wrap">
<h2><?php echo $themetrack; ?> settings</h2>

<form method="post">



<?php foreach ($options1 as $value) { 
    
	switch ( $value['type'] ) {
	
		case "open":
		?>
        <table width="100%" border="0" style="background-color:#eef5fb; padding:10px;">
		
        
        
		<?php break;
		
		case "close":
		?>
		
        </table><br />
        
        
		<?php break;
		
		case "title":
		?>
		<table width="100%" border="0" style="background-color:#dceefc; padding:5px 10px;"><tr>
        	<td colspan="2"><h3 style="font-family:Georgia,'Times New Roman',Times,serif;"><?php echo $value['name']; ?></h3></td>
        </tr>
                
        
		<?php break;

		case 'text':
		?>
        
        <tr>
            <td width="20%" rowspan="2" valign="middle"><strong><?php echo $value['name']; ?></strong></td>
            <td width="80%"><input style="width:400px;" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_settings( $value['id'] ) != "") { echo get_settings( $value['id'] ); } else { echo $value['std']; } ?>" /></td>
        </tr>

        <tr>
            <td><small><?php echo $value['desc']; ?></small></td>
        </tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #000000;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>

		<?php 
		break;
		
		case 'textarea':
		?>
        
        <tr>
            <td width="20%" rowspan="2" valign="middle"><strong><?php echo $value['name']; ?></strong></td>
            <td width="80%"><textarea name="<?php echo $value['id']; ?>" style="width:400px; height:200px;" type="<?php echo $value['type']; ?>" cols="" rows=""><?php if ( get_settings( $value['id'] ) != "") { echo stripslashes(get_settings( $value['id'] )); } else { echo stripslashes($value['std']); } ?></textarea></td>
            
        </tr>

        <tr>
            <td><small><?php echo $value['desc']; ?></small></td>
        </tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #000000;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>

		<?php 
		break;
		
		case 'select':
		?>
        <tr>
            <td width="20%" rowspan="2" valign="middle"><strong><?php echo $value['name']; ?></strong></td>
            <td width="80%"><select style="width:240px;" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>"><?php foreach ($value['options1'] as $option) { ?><option<?php if ( get_settings( $value['id'] ) == $option) { echo ' selected="selected"'; } elseif ($option == $value['std']) { echo ' selected="selected"'; } ?>><?php echo $option; ?></option><?php } ?></select></td>
       </tr>
                
       <tr>
            <td><small><?php echo $value['desc']; ?></small></td>
       </tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #000000;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>

		<?php
        break;
            
		case "checkbox":
		?>
            <tr>
            <td width="20%" rowspan="2" valign="middle"><strong><?php echo $value['name']; ?></strong></td>
                <td width="80%"><? if(get_settings($value['id'])){ $checked = "checked=\"checked\""; }else{ $checked = ""; } ?>
                        <input type="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> />
                        </td>
            </tr>
                        
            <tr>
                <td><small><?php echo $value['desc']; ?></small></td>
           </tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #000000;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>
            
        <?php 		break;
	
 
} 
}
?>

<!--</table>-->

<p class="submit">
<input name="save" type="submit" value="Save changes" />    
<input type="hidden" name="action" value="save" />
</p>
</form>
<form method="post">
<p class="submit">
<input name="reset" type="submit" value="Reset" />
<input type="hidden" name="action" value="reset" />
</p>
</form>

<?php
}



add_action('admin_menu', 'mytheme_add_soundcloud'); 


function soundcloudsuper_widget_pohlsound_reg() {
      function widget_soundcloudsuperadder($args) {
          extract($args);
      ?>
              <?php echo $before_widget; ?>
			  <?

?>                  <?php echo $before_title
                      . 'Featured Track'
                      . $after_title; ?>
					  <?
global $options1;
foreach ($options1 as $value) {
    if (get_settings( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_settings( $value['id'] ); }
}
?>
					 
                  <?php echo stripslashes($soundcloud_featuredtrack);  ?>
				  <?php echo stripslashes($soundcloud_featuredtrack2);  ?>
				  <?php echo stripslashes($soundcloud_featuredtrack3);  ?>
				  <?php echo stripslashes($soundcloud_featuredtrack4);  ?>
				  
				 
              <?php echo $after_widget; ?>
			
      <?php
      }
      register_sidebar_widget('SoundCloud Show Wave',
          'widget_soundcloudsuperadder');

  register_sidebar_widget('Soundcloud','widget_soundcloudsuperadder');}
add_action('init', soundcloudsuper_widget_pohlsound_reg);

?>