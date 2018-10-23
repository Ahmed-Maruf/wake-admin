<?php
	/**
	 * Created by PhpStorm.
	 * User: SKYLINK COMPUTERS
	 * Date: 10/23/2018
	 * Time: 8:07 PM
	 */

	class Homes extends Controller
	{
		public function __construct()
		{
			$this->homeModel = $this->model('Home');

		}
		public function index()
		{
			$this->view('index');
		}
		public function check(){
			$this->homeModel->getTableData();
		}
	}