<?php
	/**
	 * Created by PhpStorm.
	 * User: htcm
	 * Date: 24-Oct-18
	 * Time: 3:26 AM
	 */

	class Manufacturer
	{
		private $db;

		public function __construct()
		{
			$this->db = new Database();
		}

		public function getAllManufacturers()
		{
			$this->db->query("SELECT *
								  FROM manufacturers
								  WHERE homepageOrder != 0
								  ORDER BY homepageOrder");

			return $this->db->resultSet();

		}

		public function getInactiveManufacturers(){
			$this->db->query("SELECT *
								  FROM manufacturers
								  WHERE homepageOrder = 0
								  ORDER BY id");
			return $this->db->resultSet();
		}

		public function createManufacturer($datas){
			$this->db->query("INSERT INTO
								  manufacturers (id, name, page_name, address, zip, phone, fax, title_tag, description_tag, keywords_tag, contact_name, contact_email, contact_phone, about, website, logo, lead_time, priority, status, image, homepageOrder)
								  VALUES (:id, :manufacturerName, :pageName, :address, :zip, :phone, :fax, :titleTag, :descriptionTag, :keywordTag, :contactName, :contactEmail, :contactPhone, :description, :website, :logo, :leadTime, :priority, :status, :image, :homepageOrder)
								  ");
			$this->db->bind(':id',NULL);
			$this->db->bind(':manufacturerName',$datas['name']);
			$this->db->bind(':pageName',$datas['manufacturerName']);
			$this->db->bind(':address','');
			$this->db->bind(':zip','');
			$this->db->bind(':phone','');
			$this->db->bind(':fax','');
			$this->db->bind(':titleTag',$datas['titleTag']);
			$this->db->bind(':descriptionTag',$datas['descriptionTag']);
			$this->db->bind(':keywordTag',$datas['keywordTag']);
			$this->db->bind(':contactName','');
			$this->db->bind(':contactEmail','');
			$this->db->bind(':contactPhone','');
			$this->db->bind(':description',$datas['description']);
			$this->db->bind(':website','');
			$this->db->bind(':logo','');
			$this->db->bind(':leadTime','');
			$this->db->bind(':priority',1);
			$this->db->bind(':status','active');
			$this->db->bind(':image',$datas['image']);
			$this->db->bind(':homepageOrder',0);

			if($this->db->execute()){
				return true;
			}
			return false;

		}
		
		public function getManufacturerById($id)
		{
			$this->db->query("SELECT *
								  FROM manufacturers
								  WHERE id = :manufacturer_id");
			$this->db->bind(':manufacturer_id',$id);
			return $this->db->single();
		}

		public function updateManufacturerById($datas){
			
			$this->db->query("UPDATE
								  manufacturers SET name = :manufacturerName, page_name = :pageName, title_tag = :titleTag, description_tag = :descriptionTag, keywords_tag = :keywordTag, about = :description, image = :image
								  WHERE id = :id
								  ");
			$this->db->bind(':id',$datas['id']);
			$this->db->bind(':manufacturerName',$datas['name']);
			$this->db->bind(':pageName',$datas['pageName']);
			$this->db->bind(':titleTag',$datas['titleTag']);
			$this->db->bind(':descriptionTag',$datas['descriptionTag']);
			$this->db->bind(':keywordTag',$datas['keywordTag']);
			$this->db->bind(':description',$datas['description']);
			$this->db->bind(':image',$datas['image']);


			if($this->db->execute()){
				return true;
			}
			return false;
		}


		public function updateHomePageOrderById($id)
		{
			$manufacturer = $this->getManufacturerById(id);
			$pageOrder = $manufacturer->homepageOrder;
			$this->db->query("UPDATE
								  manufacturers 
								  SET homepageOrder=0
								  WHERE id = :manufacturer_id");
			$this->db->bind(':manufacturer_id',$id);
			if ($this->db->execute()){
				$this->db->query("UPDATE
									  manufacturers
									  SET homepageOrder=homepageOrder-1
									  WHERE homepageOrder!=0
									  AND homepageOrder > :page_order");
				$this->db->bind(':page_order',$pageOrder);

				if($this->db->execute()){
					return true;
				}
				else{
					return false;
				}
			}
		}

		public function placeBefore($firstNumber,$secondNumber)
		{
			$manufacturer = $this->getManufacturerById($firstNumber);
			$pageOrder = $manufacturer->homepageOrder;

			$this->db->query("SELECT *
								  FROM manufacturers
								  WHERE homepageOrder > 0");
			$manufacturers = $this->db->single();

			if ($pageOrder == ''){
				$this->db->query("UPDATE manufacturers 
									  SET homepageOrder = homepageOrder+1 
									  WHERE homepageOrder != 0 
									  AND homepageOrder >= 1");

				if ($this->db->execute()){
					$this->db->query("UPDATE manufacturers 
									  SET homepageOrder = 1 
									  WHERE id = :manufacturer_id 
									  ");
					$this->db->bind(':manufacturer_id', $secondNumber);
					if ($this->db->execute()){
						return true;
					}
					return false;
				}
				return false;
			}
			$this->db->query("UPDATE manufacturers 
								  SET homepageOrder = homepageOrder+1 
								  WHERE homepageOrder != 0 
								  AND homepageOrder >= :page_order");
			$this->db->bind('page_order',$pageOrder);
			if ($this->db->execute()){
				$this->db->query("UPDATE manufacturers 
									  SET homepageOrder = :page_order 
									  WHERE id = :manufacturer_id 
									  ");
				$this->db->bind(':page_order',$pageOrder);
				$this->db->bind(':manufacturer_id',$secondNumber);

				if ($this->db->execute()){
					return true;
				}
				return false;
			}
			return false;
		}

		public function deleteManufacturerById($id){
			$this->db->query('DELETE 
								  manufacturers,
								  series,
								  products 
								  FROM manufacturers 
								  INNER JOIN 
								  series ON series.manufacturers_id = manufacturers.id 
								  INNER JOIN products ON products.manufacturers_id = manufacturers.id 
								  WHERE manufacturers.id = :id');
			$this->db->bind(':id',$id);

			if ($this->db->execute()){
				return true;
			}
			return false;
		}

	}