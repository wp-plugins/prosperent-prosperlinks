<?php
/*
Plugin Name: Prosperent ProsperLinks
Description: Plugin designed to add a Prosperent ProsperLinks to WordPress.
Version: 1.0
Author: Prosperent Brandon
License: GPL2
*/

/*  Copyright 2012  Prosperent Brandon  (email : brandon@prosperent.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

add_action('wp_enqueue_scripts', 'prosperLinks_css');
add_action('admin_menu', 'prosper_create_link_menu');

function prosperLinks_css() {
    global $wp_styles;

    // ProsperLinks CSS
    wp_register_style( 'prosperLinks_css', plugins_url('/css/prosperLinks.css', __FILE__) );
    wp_enqueue_style( 'prosperLinks_css' );
}

function prosper_create_link_menu()
{
    //create new top-level menu
    add_menu_page('Prosperent ProsperLink Settings', 'ProsperLink Settings', 'administrator', __FILE__, 'prosperLinks_settings_page', plugins_url('/img/prosperent.png', __FILE__));

    //call register settings function
    add_action( 'admin_init', 'register_prosperLinkSettings' );
}


function register_prosperLinkSettings()
{
       //register our settings
	register_setting('prosperLinks-settings-group', 'UID', 'intval');
	register_setting('prosperLinks-settings-group', 'SID');
	register_setting('prosperLinks-settings-group', 'hoverBox');
	register_setting('prosperLinks-settings-group', 'underline', 'intval');
	register_setting('prosperLinks-settings-group', 'linkLimit', 'intval');
}

function prosperLinks_settings_page()
{
    ?>
    <div class="wrap">
        <h2>Prosperent ProsperLinks</h2>

        <form method="post" action="options.php">
            <?php settings_fields('prosperLinks-settings-group'); ?>
            <?php do_settings_sections('prosperLinks-settings-group'); ?>
            <table class="form-table">
                <tr valign="top">
		      <th scope="row"><b>User ID</b> (Enter your User ID)</th>
		      <td><input type="text" name="UID" value="<?php echo get_option('UID'); ?>" /></td>
                </tr>
				
                <tr valign="top">
		      <th scope="row"><b>SID</b> (Optional. Used for commission tracking)</th>
		      <td><input type="text" name="SID" value="<?php echo get_option('SID'); ?>" /></td>
                </tr>
				
		  <tr valign="top">
		      <th scope="row"><b>Hoverbox</b> (Set to TRUE or FALSE. Defaults to FALSE.)</th>
	             <td><input type="text" name="hoverBox" value="<?php echo get_option('hoverBox'); ?>" /></td>
                </tr>
				
		  <tr valign="top">
		      <th scope="row"><b>Underline</b> (Set to 1 for a single underline, 2 for a double underline. Defaults to 1.)</th>
	  	      <td><input type="text" name="underline" value="<?php echo get_option('underline'); ?>" /></td>
                </tr>

                <tr valign="top">
		      <th scope="row"><b>Limit</b> (Maximum number of links to be displayed on a page. Defaults to 5. Max is 10.)</th>
		      <td><input type="text" name="linkLimit" value="<?php echo get_option('linkLimit'); ?>" /></td>
                </tr>
	     </table>
            <p class="submit">
            <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
            </p>

        </form>
    </div>
    <?php
}

function prosperLinks()
{
    if (strtolower(get_option('hoverBox')) == 'true') 
    {
        $hover = 1;
    }
    else 
    {
        $hover = 0;
    }
    ?>
    
    <script type="text/javascript">
        <!--
	     var UID = <?php echo json_encode(get_option('UID')); ?>;
	     var SID = <?php echo json_encode(get_option('SID')); ?>;
	     var hoverBox = <?php echo json_encode($hover); ?>;
	     var underline = <?php echo json_encode(get_option('underline')); ?>;
            var limit = <?php echo json_encode(get_option('linkLimit')); ?>;

	     prosperent_pl_uid = UID;
	     prosperent_pl_sid = SID;
	     prosperent_pl_hoverBox = hoverBox;
	     prosperent_pl_underline = underline;
	     prosperent_pl_limit = limit;
	//-->
    </script>
    <script type="text/javascript" src="http://prosperent.com/js/plink.min.js"></script>
    <?php
}

add_action('wp_head', 'prosperLinks');