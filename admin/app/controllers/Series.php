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
			$datas['name'] = $_POST['name'];
			$datas['manufacturerID'] = $_POST['manufacturerID'];
			$datas['description'] = $_POST['description'];
			$datas['shortDescription'] = $_POST['shortDescription'];
			$datas['descriptionTag'] = $_POST['descriptionTag'];
			$datas['keywordTag'] = $_POST['keywordTag'];
			$datas['titleTag']= $_POST['titleTag'];
			$datas['imageFormat'] = '.'.$_POST['imageFormat'];
			$datas['seriesName'] = str_replace(" ", "-", $datas['name']);

			/*
			 * Image name is set as given series name by the user
			 * with replacing white spaces to - and added format
			 * at the end
			 * */

			$datas['image']= strtolower($datas['seriesName'] . $datas['imageFormat']);

			if ($this->seriesModel->createSeries($datas)){
				echo json_encode( TRUE );
			}else{
				echo json_encode( FALSE );
			}
		}

		/*Update a series by id*/

		public function update($id)
		{

			/*
			 * Check if it is requested
			 * to show a particular series
			 * */

			if($_GET['status'] =='show'){
				$series = $this->seriesModel->getSeriesById($id);
				return $this->view('series.edit',$series);
			}

			header( "Content-Type: application/json");
			/*
			 * Store information from the post data
			 * */
			$datas = [];
			$datas['seriesID'] = $id;
			$datas['name'] = $_POST['name'];
			$datas['description'] = $_POST['description'];
			$datas['shortDescription'] = $_POST['shortDescription'];
			$datas['keywordTag'] = $_POST['keywordTag'];
			$datas['pageName'] = $_POST['pageName'];
			$datas['titleTag']= $_POST['titleTag'];

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
				$datas['seriesName'] = str_replace(" ", "-", $datas['name']);
				$datas['image']= strtolower($datas['seriesName'] . $datas['imageFormat']);
			}

			/*
			 * Call the series model
			 * with reference method()
			 * */

			if($this->seriesModel->updateSeriesById($datas)){
				echo json_encode( TRUE );
			}else{
				echo json_encode( FALSE );
			}
		}

	}