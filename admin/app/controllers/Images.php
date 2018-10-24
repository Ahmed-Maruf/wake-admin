<?php
	/**
	 * Created by PhpStorm.
	 * User: SKYLINK COMPUTERS
	 * Date: 10/24/2018
	 * Time: 1:27 PM
	 */
	
	class Images extends Controller
	{
		public function __construct()
		{
			$this->imageModel = $this->model('image');
		}
		
		public function upload()
		{
			imageUpload();
		}
	}