<?php

/*=======================
    HashRaf
=========================*/

    class Faqs extends Controller 
    {
        public function __construct()
        {
            $this->faqModel = $this->model('faq');
        }

        public function index()
        {
            $faqs = $this->faqModel->getAllFaq();
            return $this->view('faqs', $faqs);
        }

        public function create()
        {
            header( "Content-Type: application/json");
            if ($this->faqModel->addFaq($_POST['d'])) {
                echo json_encode( TRUE );
			}else{
				echo json_encode( FALSE );
			}
        }

        public function remove()
        {
            header( "Content-Type: application/json");
            if ($this->faqModel->deleteFaq()) {
                echo json_encode( TRUE );
			}else{
				echo json_encode( FALSE );
			}
        }

        public function update()
        {
            header( "Content-Type: application/json");
            $err = FALSE;
            $data = $_POST['d'];
            if(count($data) != 0) {
                for ($i = 1; $i <= count($data) / 2; $i++) {
                    if (!$err) {
                        if ($this->faqModel->updateFaq($data['q' . $i], $data['a' . $i], $i)) {
                            $err = FALSE;
                        }
                        else{
                            $err = TRUE;
                        }
                    }
                }
            }

            if (! $err) {
                echo json_encode( TRUE );
			}else{
				echo json_encode( FALSE );
			}
        }


    }