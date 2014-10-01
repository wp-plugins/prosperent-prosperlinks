<?php
require_once(PROSPERLINKS_MODEL . '/Admin.php');
$prosperAdmin = new Model_Links_Admin();

$options = get_option('prosperSuite');

$prosperAdmin->adminHeader( __( 'General Settings', 'prosperent-suite' ), true, 'prosperent_options', 'prosperSuite' );

echo '<p class="prosper_settingDesc">' . __( 'Go to <a href="http://wordpress.prosperentdemo.com">WordPress Prosperent Demo</a> for more information and tutorials.', 'prosperent-suite' ) . '</p>';

echo '<h2 class="prosper_h2">' . __( 'Your Settings (Required)', 'prosperent-suite' ) . '</h2>';
echo __( '<ol><li><a href="http://prosperent.com/join" target="_blank">Sign Up (It\'s free)</a>, if you haven\'t already.</li><li>Go to the <a href="http://prosperent.com/account/wordpress" target="_blank">Prosperent WordPress Install</a> screen.</li><li>Either Create a New Installation or use the API Key from a previous setup.</li><li>Copy the API Key, and paste it into the box below.</li><li>Save your Settings!</li></ol>', 'prosperent-suite' );

echo $prosperAdmin->textinput( 'Api_Key', __( '<strong>Prosperent API Key</strong>', 'prosperent-suite' ), '');
echo '<p class="prosper_desc">' . __( '', 'prosperent-suite' ) . '</p>';

$prosperAdmin->adminFooter();