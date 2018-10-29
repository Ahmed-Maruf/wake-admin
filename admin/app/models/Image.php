<?php
	/**
	 * Created by PhpStorm.
	 * User: SKYLINK COMPUTERS
	 * Date: 10/24/2018
	 * Time: 1:33 PM
	 */
	
	class Image
	{
		private $db;
		
		public function __construct()
		{
			$this->db = new Database();
		}
		
		
		public function updateBulkImageName($stored_information,$format)
		{
			$name = 'bulkImage' . '.' . $format;
			$productId = $stored_information[0];
			$seriesId = $stored_information[2];
			$this->db->query("UPDATE
								  images SET  name = :imageName
								  WHERE products_id = :productID
								  ");
			$this->db->bind(':imageName',$name);
			$this->db->bind(':productID',$productId);
			
			if($this->db->execute()){
				return true;
			}
			return false;
		}
	
	}