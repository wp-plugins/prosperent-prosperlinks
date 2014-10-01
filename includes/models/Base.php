<?php
/**
 * Base Abstract Model
 *
 * @package Model
 */
abstract class Model_Links_Base
{
	protected $_options;
	
	protected $_version;
	
	public function init()
	{
		$this->_options = $this->getOptions();
		$this->_version = $this->getVersion();
	
		if ($this->_options['Api_Key'] && strlen($this->_options['Api_Key']) == 32)
		{ 		
			add_action('wp_head', array($this, 'prosperHeaderScript'));
		}
	}
	
	public function getVersion()
	{
		if ( ! function_exists( 'get_plugins' ) )
			require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
			
		$pluginFolder = get_plugins('/' . PROSPERLINKS_FOLDER);				
		return $pluginFolder[PROSPERLINKS_FILE]['Version'];
	}

	/**
	 * Retrieve all the options
	 *
	 * @return array of options
	 */
	public function getOptions($option = null)
	{
		if (!isset($this->_options))
		{
			$this->_options = array();
			foreach ($this->getProsperOptionsArray() as $opt)
			{ 
				$this->_options = array_merge($this->_options, (array) get_option($opt));
			}
		}

		return $this->_options;
	}
	
	public function prosperBadSettings()
	{			
		if ( isset( $_GET['page'] ) && 'prosperlinks_general' == $_GET['page'] )
		{		
			$url = admin_url( 'admin.php?page=prosperlinks_general' );
			echo '<div class="error" style="padding:6px 0;">';
			echo _e( '<span style="font-size:14px; padding-left:10px;">Your <strong>API Key</strong> is either incorrect or missing. </span></br>', 'my-text-domain' );
			echo _e('<span style="font-size:14px; padding-left:10px;">Please enter your <strong>Prosperent API Key</strong>.</span></br>', 'my-text-domain' ); 
			echo _e('<span style="font-size:14px; padding-left:10px;">Go to the Prosperent Suite <a href="' . $url . '">General Settings</a> and follow the directions to get your API Key.</span>', 'my-text-domain' );
			echo '</div>';		
		}
	}

	/**
	 * Retrieve an array of all the options the plugin uses. It can't use only one due to limitations of the options API.
	 *
	 * @return array of options.
	 */
	public function getProsperOptionsArray()
	{
		$optarr = array('prosperSuite', 'prosper_prosperLinks');
        return apply_filters( 'prosper_options', $optarr );
	}

	public function doOutputBuffer()
	{
		ob_start();
	}
	
	public function prosperHeaderScript()
	{				
		echo '<script type="text/javascript">var _prosperent={"campaign_id":"' . $this->_options['Api_Key'] . '", "pl_active":1, "pl_phraselinker_active":0, "pl_linkoptimizer_active":' . ($this->_options['PL_LinkOpt'] ? 1 : 0) . ', "pl_linkaffiliator_active":' . ($this->_options['PL_LinkAff'] ? 1 : 0) . ', "platform":"wordpress"};</script><script async type="text/javascript" src="http://prosperent.com/js/prosperent.js"></script>';
	}
}
