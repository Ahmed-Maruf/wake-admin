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

		public function create()
		{
			header( "Content-Type: application/json");
			$datas = [];
			$datas['name'] = $_POST['name'];
			$datas['description'] = $_POST['description'];
			$datas['keywordTag'] = $_POST['keywordTag'];
			$datas['pageName'] = $_POST['pageName'];
			$datas['titleTag']= $_POST['titleTag'];
			$datas['imageFormat'] = '.'.$_POST['imageFormat'];
			$datas['manufactureName'] = str_replace(" ", "-", $datas['name']);
			
			/*
			 * Image name is set as given manufacturer name by the user
			 * with replacing white spaces to - and added format
			 * at the end
			 * */
			
			$datas['image']= strtolower($datas['manufacturer_name'] . $datas['imageFormat']);
			
			if ($this->manufacturerModel->createManufacturer($datas)){
				echo json_encode( TRUE );
			}else{
				echo json_encode( FALSE );
			}
		}
		
		public function update($id)
		{
			
			if($_GET['status'] =='show'){
				$manufacturer = $this->manufacturerModel->getManufacturerById($id);
				return $this->view('manufacturer.edit',$manufacturer);
			}
			
			header( "Content-Type: application/json");
			$datas = [];
			$datas['id'] = $id;
			$datas['name'] = $_POST['name'];
			$datas['description'] = $_POST['description'];
			$datas['keywordTag'] = $_POST['keywordTag'];
			$datas['pageName'] = $_POST['pageName'];
			$datas['titleTag']= $_POST['titleTag'];
			$datas['descriptionTag'] = $_POST['descriptionTag'];
			
			/*
			 * If not empty then
			 * already an image info stored in db
			 * pick this as priority
			 * */
			if ($_POST['image'] !== '')
				$datas['image'] = $_POST['image'];
			
			
			/*
			 * If a new image is uploaded
			 * pick this as priority
			 * */
			if ($_POST['imageFormat'])
			{
				$datas['imageFormat'] = '.'.$_POST['imageFormat'];
				$datas['manufacturerName'] = str_replace(" ", "-", $datas['name']);
				$datas['image']= strtolower($datas['manufacturerName'] . $datas['imageFormat']);
			}
			
			if($this->manufacturerModel->updateManufacturerById($datas)){
				echo json_encode( TRUE );
			}else{
				echo json_encode( FALSE );
			}
		}

		public function updateHomePageOrderById(){
			$id = $_POST['numb'];
			if($this->manufacturerModel->updateHomePageOrderById($id)){
				echo json_encode(true);
			}else json_encode(false);
		}

		public function control(){

			$activeManufacturers = $this->manufacturerModel->getAllManufacturers();
			$inactiveManufacturers = $this->manufacturerModel->getInactiveManufacturers();

			$datas[] = $activeManufacturers;
			$datas[] = $inactiveManufacturers;
			//die(var_dump($datas));
			return $this->view('manufacturer.control',$datas);
		}

		public function placeBefore()
		{
			$firstNumber = $_POST['numb'];
			$secondNumber = $_POST['numb2'];

			if ($this->manufacturerModel->placeBefore($firstNumber,$secondNumber)){
				echo json_encode(true);
			}else{
				echo json_encode(false);
			}
		}

		public function deleteManufacturerById(){
			$id = $_GET['id'];
			if ($this->manufacturerModel->deleteManufacturerById($id)){
				echo json_encode(true);
			}else{
				echo json_encode(false);
			}
		}



	}