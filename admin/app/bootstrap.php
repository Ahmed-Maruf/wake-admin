<?php
	/**
	 * Created by PhpStorm.
	 * User: SKYLINK COMPUTERS
	 * Date: 10/23/2018
	 * Time: 6:44 PM
	 */
	
	// Load Config
	require_once 'config/config.php';
	// Load Helpers
	require_once 'helpers/url_helper.php';
	require_once 'helpers/session_helper.php';
	require_once 'helpers/image_helper.php';
	// Autoload Core Libraries
	spl_autoload_register(function($className){
		require_once 'libraries/' . $className . '.php';
	});