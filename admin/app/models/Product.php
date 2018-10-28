<?php
	/**
	 * Created by PhpStorm.
	 * User: htcm
	 * Date: 27-Oct-18
	 * Time: 3:06 PM
	 */

	class Product
	{
		private $db;

		public function __construct()
		{
			$this->db = new Database();
		}

		public function searchProduct($productToSearch){

			$q = $productToSearch;

			$origQ = $q;
			$q = str_replace( ' ', "", $q);
			$q = str_replace( '-', '', $q);
			$q = implode( '-?', str_split( $q));

			$replaceQuery = '';
			foreach(str_split(strtolower($q)) as $queryC)
			{
				switch($queryC)
				{
					case "b":
						$replaceQuery .= "[b8]";
						break;
					case "8":
						$replaceQuery .= "[b8]";
						break;
					case "l":
						$replaceQuery .= "[1l]";
						break;
					case "1":
						$replaceQuery .= "[1li]";
						break;
					case "5":
						$replaceQuery .= "[s5]";
						break;
					case "s":
						$replaceQuery .= "[s5]";
						break;
					case "o":
						$replaceQuery .= "[o0]";
						break;
					case "0":
						$replaceQuery .= "[o0]";
						break;
					case "3":
						$replaceQuery .= "[e3]";
						break;
					case "e":
						$replaceQuery .= "[e3]";
						break;
					case "i":
						$replaceQuery .= "[1li]";
						break;
					default:
						$replaceQuery .= $queryC;
				}
			}

			$q = $replaceQuery;
			$this->db->query("SELECT * 
								  FROM products 
								  WHERE part_number RLIKE :matching_product");
			$this->db->bind(':matching_product',$q);

			$matchedProducts = $this->db->resultSet();
			$results = [];
			$r = [];
			foreach ( $matchedProducts as $product ) {
				$r[] = [
					'title' => $product->part_number,
					'url' => 'wake/admin/editPage.php?p='.$product->part_number
				];
			}

			$results = ['results' => $r];

			return $results;
		}

		public function getAllProducts()
		{
			$this->db->query("SELECT *
								  FROM products");

			return $this->db->resultSet();
		}
	}