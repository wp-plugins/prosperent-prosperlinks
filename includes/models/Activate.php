<?php
require_once(PROSPERLINKS_MODEL . '/Base.php');
/**
 * Base Abstract Model
 *
 * @package Model
 */
class Model_Links_Activate extends Model_Links_Base
{
	protected $_options;
	
	public function prosperActivate()
	{
		$this->_options = $this->getOptions();	
	}
	
	public function prosperDeactivate()
	{		

	}
	
	public function prosperOptionActivateAdd() 
	{
		add_option('prosperLinksActivationRedirect', true);
	}

	public function prosperActivateRedirect() 
	{
		if (get_option('prosperLinksActivationRedirect', false)) 
		{
			delete_option('prosperLinksActivationRedirect');
			if(!isset($_GET['activate-multi']))
			{
				wp_redirect( admin_url( 'admin.php?page=prosperlinks_general' ) );
			}
		}
	}
}
