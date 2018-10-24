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

	}