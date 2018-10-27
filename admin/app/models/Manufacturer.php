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
								  VALUES (:id, :manufacturer_name, :page_name, :address, :zip, :phone, :fax, :title_tag, :description_tag, :keywords_tag, :contact_name, :contact_email, :contact_phone, :about, :website, :logo, :lead_time, :priority, :status, :image, :homepageOrder)
								  ");
			$this->db->bind(':id',NULL);
			$this->db->bind(':manufacturer_name',$datas['name']);
			$this->db->bind(':page_name',$datas['manufacturer_name']);
			$this->db->bind(':address','');
			$this->db->bind(':zip','');
			$this->db->bind(':phone','');
			$this->db->bind(':fax','');
			$this->db->bind(':title_tag',$datas['titleTag']);
			$this->db->bind(':description_tag',$datas['description']);
			$this->db->bind(':keywords_tag',$datas['keywordTag']);
			$this->db->bind(':contact_name','');
			$this->db->bind(':contact_email','');
			$this->db->bind(':contact_phone','');
			$this->db->bind(':about',$datas['about']);
			$this->db->bind(':website','');
			$this->db->bind(':logo','');
			$this->db->bind(':lead_time','');
			$this->db->bind(':priority',1);
			$this->db->bind(':status','active');
			$this->db->bind(':image',$datas['image']);
			$this->db->bind(':about',$datas['about']);
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
								  manufacturers SET name = :manufacturer_name, page_name = :page_name, title_tag = :title_tag, description_tag = :description_tag, keywords_tag = :keywords_tag, about = :about, image = :image
								  WHERE id = :id
								  ");
			$this->db->bind(':id',$datas['id']);
			$this->db->bind(':manufacturer_name',$datas['name']);
			$this->db->bind(':page_name',$datas['page_name']);
			$this->db->bind(':title_tag',$datas['titleTag']);
			$this->db->bind(':description_tag',$datas['description']);
			$this->db->bind(':keywords_tag',$datas['keywordTag']);
			$this->db->bind(':about',$datas['about']);
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