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
			$name = $_POST['name'];
			imageUpload($name);
		}

		public function bulkImageUpload(){
			$selectedItems = explode(',',$_POST['selectedItems']);
			$format = explode('.',$_POST['imageName']);
			$status = false;
			foreach ($selectedItems as $selectedItem){
				$stored_information =  explode('|',$selectedItem);
				$status = $this->imageModel->updateBulkImageName($stored_information,end($format));
			}
			imageUpload('bulkImage');
		}
	}