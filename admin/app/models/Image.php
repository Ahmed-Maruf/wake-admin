<?php
	/**
	 * Created by PhpStorm.
	 * User: SKYLINK COMPUTERS
	 * Date: 10/24/2018
	 * Time: 1:33 PM
	 */
	
	class Image
	{
		private $db;
		
		public function __construct()
		{
			$this->db = new Database();
		}
		
		public function uploadImage(){
			var_dump($_POST['name']);
		}
	
	}