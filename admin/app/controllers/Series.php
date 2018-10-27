<?php
	/**
	 * Created by PhpStorm.
	 * User: htcm
	 * Date: 27-Oct-18
	 * Time: 8:55 PM
	 */

	class Series extends Controller
	{
		public function __construct()
		{
			$this->seriesModel = $this->model('serie');
			$this->manufacturerModel = $this->model('manufacturer');
		}

		public function index(){
			$datas = [];
			$datas['manufacturers'] = $this->manufacturerModel->getAllManufacturers();
			$datas['series'] = $this->seriesModel->getAllSeries();

			return $this->view( 'series',$datas);
		}

		public function create()
		{
			header( "Content-Type: application/json");
			$datas = [];
			$datas['name'] = $_POST['n'];
			$datas['manufacturer_id'] = $_POST['i'];
			$datas['description'] = $_POST['d'];
			$datas['keywordTag'] = $_POST['k'];
			$datas['titleTag']= $_POST['t'];
			$datas['about'] = $_POST['a'];
			$datas['imageFormat'] = '.'.$_POST['imageFormat'];
			$datas['series_name'] = str_replace(" ", "-", $datas['name']);
			$datas['image']= strtolower($datas['series_name'] . $datas['imageFormat']);
			if($_POST['image'] == ""){
				$datas['image'] = "";
			}
			if ($this->seriesModel->createSeries($datas)){
				echo json_encode( TRUE );
			}else{
				echo json_encode( FALSE );
			}
		}

	}