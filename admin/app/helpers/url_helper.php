<?php
	/**
	 * Created by PhpStorm.
	 * User: SKYLINK COMPUTERS
	 * Date: 10/23/2018
	 * Time: 7:49 PM
	 */
	
	// Simple page redirect
	function redirect($page){
		header('location: ' . URLROOT . '/' . $page);
	}