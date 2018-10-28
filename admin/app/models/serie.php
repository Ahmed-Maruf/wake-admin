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

		/*Create a new series*/

		public function createSeries($datas){

			$this->db->query("INSERT INTO
								  series (id,manufacturers_id, `name`, page_name, description, short_description, image, title_tag, description_tag, keywords_tag, status)
								  VALUES (:id, :manufacturerId, :seriesName, :pageName, :description, :shortDescription, :image, :titleTag, :descriptionTag, :keywordTag, :status)
								  ");
			$this->db->bind(':id',NULL);
			$this->db->bind(':manufacturerId',$datas['manufacturerID']);
			$this->db->bind(':seriesName',$datas['name']);
			$this->db->bind(':pageName',str_replace("/", "-", str_replace(" ", "-", str_replace("&", "and", strtolower($datas['name'])))));
			$this->db->bind(':description',$datas['description']);
			$this->db->bind('shortDescription',$datas['shortDescription']);
			$this->db->bind(':image',$datas['image']);
			$this->db->bind(':titleTag',$datas['titleTag']);
			$this->db->bind(':descriptionTag',$datas['descriptionTag']);
			$this->db->bind(':keywordTag',$datas['keywordTag']);
			$this->db->bind(':status','active');

			if($this->db->execute()){
				return true;
			}
			return false;
		}

		public function getSeriesById($id)
		{
			$this->db->query("SELECT *
								  FROM series
								  WHERE id = :series_id");
			$this->db->bind(':series_id',$id);
			return $this->db->single();
		}

		public function updateSeriesById($datas){
			/*$datas = [];
			$datas['seriesId'] = $id;
			$datas['name'] = $_POST['name'];
			$datas['description'] = $_POST['description'];
			$datas['shortDescription'] = $_POST['shortDescription'];
			$datas['keywordTag'] = $_POST['keywordTag'];
			$datas['pageName'] = $_POST['pageName'];
			$datas['titleTag']= $_POST['titleTag'];
			$datas['imageFormat'] = '.'.$_POST['imageFormat'];
			$datas['seriesName'] = str_replace(" ", "-", $datas['name']);
			$datas['image']= strtolower($datas['seriesName'] . $datas['imageFormat']);*/

			$this->db->query("UPDATE
								  series SET name = :seriesName, page_name = :pageName, title_tag = :titleTag, description_tag = :descriptionTag, keywords_tag = :keywordTag, description = :description, short_description = :shortDescription, image = :image
								  WHERE id = :id
								  ");
			$this->db->bind(':id',$datas['seriesID']);
			$this->db->bind(':seriesName',$datas['name']);
			$this->db->bind(':pageName',$datas['pageName']);
			$this->db->bind(':titleTag',$datas['titleTag']);
			$this->db->bind(':descriptionTag',$datas['descriptionTag']);
			$this->db->bind(':keywordTag',$datas['keywordTag']);
			$this->db->bind(':description',$datas['description']);
			$this->db->bind(':shortDescription',$datas['shortDescription']);
			$this->db->bind(':image',$datas['image']);

			if($this->db->execute()){
				return true;
			}
			return false;
		}
	}