<?php
	/**
	 * Created by PhpStorm.
	 * User: htcm
	 * Date: 24-Oct-18
	 * Time: 3:24 AM
	 */

	class Manufacturers extends Controller
	{
		public function __construct()
		{
			$this->manufacturerModel = $this->model('Manufacturer');
		}

		public function index(){
			$manufacturers = $this->manufacturerModel->getAllManufacturers();
			return $this->view('manufacturer',$manufacturers);
		}

		public function add()
		{
			header( "Content-Type: application/json");
			$datas = [];
			$datas['name'] = $_POST['n'];
			$datas['description'] = $_POST['d'];
			$datas['keywordTag'] = $_POST['k'];
			$datas['titleTag']= $_POST['t'];
			$datas['about'] = $_POST['a'];
			$datas['manufacturer_name'] = str_replace(" ", "-", $datas['name']);
			$datas['image']= strtolower($datas['manufacturer_name'] . '.png');
			if($_POST['image'] == ""){
				$datas['image'] = "";
			}
			if ($this->manufacturerModel->createManufacturer($datas)){
				echo json_encode( TRUE );
			}else{
				echo json_encode( FALSE );
			}
		}

	}