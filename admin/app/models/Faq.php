<?php

/*=================
    HashRaf
==================*/

    class Faq
    {
        private $db;

        public function __construct()
        {
            $this->db = new Database();
        }

        public function getAllFaq()
        {
            $this->db->query("SELECT * 
                                FROM faq ORDER BY `order`");

            return $this->db->resultSet();
        }

        public function addFaq($data)
        {
            
            $order = count((array) $this->getAllFaq()) + 1;
            $this->db->query("INSERT INTO
								  faq (id, question, answer, `order`, `status` )
								  VALUES (:id, :question, :answer, :order, :sts )
                                  ");
            $this->db->bind(':id', NULL);
            $this->db->bind(':question', $data['q']);
            $this->db->bind(':answer', $data['a']);
            $this->db->bind(':order', $order);
            $this->db->bind(':sts', 'active');

            if($this->db->execute()){
				return true;
			}
			return false;

        }

        public function deleteFaq()
        {
            $order = count((array) $this->getAllFaq());
            $this->db->query("DELETE FROM faq WHERE `order` = :order");

            $this->db->bind(':order', $order);
            
            if ($this->db->execute()) {
                return true;
            }

            return false;
        }

        public function updateFaq($q, $a, $order)
        {
            
            $this->db->query("UPDATE
                                  faq SET question = :question, answer = :answer 
                                  WHERE `order` = :order");
            $this->db->bind(':question', $q);
            $this->db->bind(':answer', $a);
            $this->db->bind(':order', $order);
        
            if ($this->db->execute()) {
                return true;
            }
            return false;
        }
    }