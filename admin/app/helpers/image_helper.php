<?php
	/**
	 * Created by PhpStorm.
	 * User: SKYLINK COMPUTERS
	 * Date: 10/24/2018
	 * Time: 2:09 PM
	 */
	
	function imageUpload(){
		if(isset($_FILES['file'])){
			$file = $_FILES['file'];
			$fileName = $_FILES['file']['name'];
			$customFileName = strtolower(str_replace(" ", "-", $_POST['name']));
			$fileTempName = $_FILES['file']['tmp_name'];
			$fileSize = $_FILES['file']['size'];
			$fileError = $_FILES['file']['error'];
			$fileType = $_FILES['file']['type'];
			$imageFolder = $_POST['imageFolder'];
			$fileExtension = explode('.',$fileName);
			
			$fileActualExtension = strtolower(end($fileExtension));
			$allowedFileType = array('jpg','jpeg','png');
			
			if (in_array($fileActualExtension,$allowedFileType)){
				if(!$fileError){
					if ($fileSize < 500000){
						$newFileName = $customFileName.".".$fileActualExtension;
						$fileDestination = 'img/'.$imageFolder.'/' . $newFileName;
						move_uploaded_file($fileTempName,$fileDestination);
						echo 'File uploaded successfully';
					}else{
						echo 'Your file is too big';
					}
				}else{
					echo 'There was an error uploading your file';
				}
			}else{
				echo 'You cannot upload files of this type';
			}
		}else{
			echo 'Please upload an image';
		}
	}