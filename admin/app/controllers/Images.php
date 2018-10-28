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

		public function bulkImageUpload(){
			/*
			 * Store information from the post data
			 * */
			$datas = [];
			$datas['selectedItems'] = $_POST['name'];
			$datas['uploadedImage'] = $_POST['uploadedImage'];
			$datas['file'] = $_FILES['image'];
			$datas['imageFolder'] = $_POST['imageFolder'];
			$datas['imageFormat'] = $_POST['imageFormat'];

			bulkImagesUpload($datas);
		}
	}