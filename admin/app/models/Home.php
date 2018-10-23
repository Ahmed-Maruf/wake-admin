<?php
	/**
	 * Created by PhpStorm.
	 * User: htcm
	 * Date: 23-Oct-18
	 * Time: 11:15 PM
	 */

	class Home
	{
		/*
 * DataTables example server-side processing script.
 *
 * Please note that this script is intentionally extremely simply to show how
 * server-side processing can be implemented, and probably shouldn't be used as
 * the basis for a large complex system. It is suitable for simple use cases as
 * for learning.
 *
 * See http://datatables.net/usage/server-side for full details on the server-
 * side processing requirements of DataTables.
 *
 * @license MIT - http://datatables.net/license_mit
 */

		/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
		 * Easy set variables
		 */

		// DB table to use
		public function getTableData()
		{
			$table = 'products';

			// Table's primary key
			$primaryKey = 'part_number';

			// Array of database columns which should be read and sent back to DataTables.
			// The `db` parameter represents the column name in the database, while the `dt`
			// parameter represents the DataTables column identifier. In this case simple
			// indexes
			$columns = array(array('db' => 'part_number', 'dt' => 0), array('db' => 'remanufactured_inventory', 'dt' => 1), array('db' => 'remanufactured_price', 'dt' => 2), array('db' => 'new_inventory', 'dt' => 3), array('db' => 'new_price', 'dt' => 4), array('db' => 'stock_level', 'dt' => 5),);

			// SQL server connection information
			$sql_details = array('user' => 'root', 'pass' => 'mysql', 'db' => 'wake', 'host' => 'localhost');


			/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
			 * If you just want to use the basic configuration for DataTables with PHP
			 * server-side, there is no need to edit below this line.
			 */
			require( APPROOT . '/SSP.php');

			echo json_encode(SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns));
		}
	}
