<?php
	/**
	 * Created by PhpStorm.
	 * User: SKYLINK COMPUTERS
	 * Date: 10/23/2018
	 * Time: 6:48 PM
	 */
	
	class Core
	{
		//@ - Attributes
		protected $currentCrontroller = "Homes";
		protected $currentMethod = "index";
		protected $params = [];
		//@ - Methods
		public function __construct()
		{
			//print_r($this->getUrl());
			$url = $this->getUrl();
			//@- Look in controllers for first value
			if(file_exists('../app/controllers/' . ucwords($url[0]) . '.php')){
				$this->currentCrontroller = ucwords($url[0]);
				//@- Unset 0 index
				unset($url[0]);
			}
			//@- Require the controller
			require_once '../app/controllers/' . $this->currentCrontroller . '.php';
			//@- Instantiate controller Class
			$this->currentCrontroller = new $this->currentCrontroller;
			//@- Check for the second part of the url
			if(isset($url[1])){
				//@- Check to see if method exists in controller
				if(method_exists($this->currentCrontroller, $url[1])){
					$this->currentMethod = $url[1];
					//@- Unset 1 index
					unset($url[1]);
				}
			}
//        echo $this->currentMethod;
			//@- Get params
			$this->params = $url ? array_values($url) : [];
			//@- Call a callback with array of params
			call_user_func_array([$this->currentCrontroller,$this->currentMethod], $this->params);
		}
		//@- Get requested url
		public function getUrl()
		{
			if(isset($_GET['url']))
			{
				//@ - Sanitizing the URL
				$url = rtrim($_GET['url'],'/');
				$url = filter_var($url,FILTER_SANITIZE_URL);
				$url = explode('/',$url);
				return $url;
			}
		}
	}