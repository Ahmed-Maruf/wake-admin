<?php
	//include 'layouts/header.layout.php';
	require_once 'layouts/header.layout.php';
	include "layouts/sidebar.layout.php";
?>
	<div class = "pusher" style = "max-width: 70%; margin-left: 1em;" >
		<div class = "ui vertical segment" >
			<div class = "ui grid" >
				<div class = "row" >
					<div class = "sixteen wide column" >
						<div class = "ui segment" >
							<div class = "ui header" >
								Insert New Manufacturer
							</div >
							<form class = "ui form" id = "newManfForm" >
								<div class = "field" >
									<input type = "text" name = "name" id = "name" placeholder = "Name" >
								</div >
								<div class = "field" >
									<input type = "text" name = "titleTag" id = "titleTag" placeholder = "Title Tag" >
								</div >
								<div class = "field" >
									<input type = "text" name = "descTag" id = "descTag"
										   placeholder = "Description Tag" >
								</div >
								<div class = "field" >
									<input type = "text" name = "keyTag" id = "keyTag" placeholder = "Keywords Tag" >
								</div >
								<div class = "field" >
									<textarea name = "about" id = "about" ></textarea >
								</div >

								<div style = "margin-top: 3rem" >
									<label style = "font-style: italic; font-size: 130%;" >Upload an Image</label >
								</div >
								<div style = " margin-bottom: 3rem;" >
									Select image to upload:
									<input type = "file" name = "filename" id = "file" >
									<div style = "margin-top: 2.5rem" >
										<div ><img id = "blah" src = "<?php echo URLROOT?>admin/public/img/Placeholder.png"
												   alt = "your image" /></div >
										<input id = "filesubmit" type = "button" value = "Upload Image"
											   name = "button" >
									</div >
								</div >

								<div class = "ui positive button" id = "createManf" >Create!</div >
							</form >
						</div >
						<div class = "ui segment" >
							<div class = "ui header" >Edit Manufacturer</div >
							<form class = "ui form" id = "findManfForm" method = "post"
								  onsubmit = "return confirm('Do you really want to delete this selected manufacturer?');" >
								<div class = "field" >
									<select name = "findManf" id = "findManf" class = "ui dropdown" >
										<?php
											foreach ($datas as $data):
												?>
												<option value = "<?php echo $data->id ?>" ><?php echo $data->name . ' | ' . $data->id ?></option >
											<?php
											endforeach;
										?>
									</select >
								</div >
								<div class = "ui positive button" id = "findButton" >Edit!</div >


								<input type = "submit" id = "deleteButton" name = "delete" value = "Delete!"
									   style = "height: 35px; width: 64px; color: red;" >

								<!---->

							</form >
						</div >
					</div >
				</div >
			</div >
		</div >

	</div >

<?php
	include 'layouts/footer.layout.php'
?>