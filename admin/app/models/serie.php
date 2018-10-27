<?php
	/**
	 * Created by PhpStorm.
	 * User: htcm
	 * Date: 27-Oct-18
	 * Time: 8:58 PM
	 */

	class serie
	{
		private $db;

		public function __construct()
		{
			$this->db = new Database();
		}

		public function getAllSeries()
		{
			$this->db->query("SELECT *
								  FROM series
								  ORDER BY id");

			return $this->db->resultSet();
		}

		public function createSeries($datas){
			$this->db->query("INSERT INTO
								  series (id,manufacturers_id, `name`, page_name, description, image, title_tag, description_tag, keywords_tag, status)
								  VALUES (:id, :manufacturer_id, :series_name, :page_name, :description, :image, :title_tag, :description_tag, :keywords_tag, :status)
								  ");
			$this->db->bind(':id',NULL);
			$this->db->bind(':manufacturer_id',$datas['manufacturer_id']);
			$this->db->bind(':series_name',$datas['name']);
			$this->db->bind(':page_name',str_replace("/", "-", str_replace(" ", "-", str_replace("&", "and", strtolower($datas['name'])))));
			$this->db->bind(':description',$datas['about']);
			$this->db->bind(':image',$datas['image']);
			$this->db->bind(':title_tag',$datas['titleTag']);
			$this->db->bind(':description_tag',$datas['description']);
			$this->db->bind(':keywords_tag',$datas['keywordTag']);
			$this->db->bind(':status','active');

			if($this->db->execute()){
				return true;
			}
			return false;

		}
	}