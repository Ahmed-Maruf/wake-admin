<?php
	/**
	 * Created by PhpStorm.
	 * User: htcm
	 * Date: 27-Oct-18
	 * Time: 3:05 PM
	 */

	require APPROOT . '/models/Manufacturer.php';
	require APPROOT . '/models/serie.php';


	class Products extends Controller
	{
		public function __construct()
		{
			$this->productModel = $this->model('Product');
		}
		
		public function index()
		{
			$manufacturers = new Manufacturer();
			$manufacturersInfo = $manufacturers->getAllManufacturers();
			$series = new serie();
			$seriesInfo = $series->getAllSeriesByManufacturerId($manufacturersInfo[0]->id);
			$datas['manufacturers'] = $manufacturersInfo;
			$datas['series'] = $seriesInfo;

			return $this->view('product',$datas);
		}

		public function searchProduct()
		{
			$productToSearch = $_GET['q'];

			$matchedProducts = $this->productModel->searchProduct($productToSearch);

			header( "Content-Type: application/json" );
			echo json_encode($matchedProducts);
		}

		public function bulkImageUpload()
		{
			$products = $this->productModel->getAllProducts();
			return $this->view('buildImageUpload',$products);
		}
	}