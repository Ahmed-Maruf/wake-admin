<?php
	/**
	 * Created by PhpStorm.
	 * User: htcm
	 * Date: 27-Oct-18
	 * Time: 3:05 PM
	 */

	class Products extends Controller
	{
		public function __construct()
		{
			$this->productModel = $this->model('Product');
		}

		public function searchProduct()
		{
			$productToSearch = $_GET['q'];

			$matchedProducts = $this->productModel->searchProduct($productToSearch);

			header( "Content-Type: application/json" );
			echo json_encode($matchedProducts);
		}
	}