<?php
	/**
	 * Created by PhpStorm.
	 * User: SKYLINK COMPUTERS
	 * Date: 10/23/2018
	 * Time: 6:48 PM
	 */
	
	class Controller
	{
		//@- Load model
		public function model($model){
			//Require model file
			require_once '../app/models/'. $model . '.php';
			// Instantiate Model
			return new $model();
		}
		//@- Load view
		public function view($view, $datas = []){
			// Check for the view file
			if(file_exists('../app/views/'.$view.'.php')){
				require_once '../app/views/'.$view.'.php';
			}else{
				//View does not exits
				die('View does not exits');
			}
		}
	}