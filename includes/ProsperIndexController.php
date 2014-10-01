<?php
/**
 * ProsperIndex Controller
 *
 * @package 
 * @subpackage 
 */
class ProsperLinksIndexController
{	
    public function __construct()
    {		
		require_once(PROSPERLINKS_MODEL . '/Activate.php');
		$prosperActivate = new Model_Links_Activate();
		
		register_activation_hook(PROSPERLINKS_PATH . PROSPERLINKS_FILE, array($prosperActivate, 'prosperActivate'));
		register_deactivation_hook(PROSPERLINKS_PATH . PROSPERLINKS_FILE, array($prosperActivate, 'prosperDeactivate'));

		add_action('admin_init', array($prosperActivate, 'prosperActivateRedirect'));
		add_action('init', array($prosperActivate, 'doOutputBuffer'));	
	}
}
 
$prosperLinksIndex = new ProsperLinksIndexController;