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
                                    <input type = "text" id = "descriptionTag" name = "descriptionTag"
                                           placeholder = "Description Tag" >
                                </div >

                                <div class = "field" >
                                    <input type = "text" id = "keywordTag" name = "keywordTag" placeholder = "Keywords Tag" >
                                </div >

                                <div class = "field" >
                                    <label >Description</label >
                                    <textarea name = "description" id = "description" ></textarea >
                                </div >

								<div style = "margin-top: 3rem" >
									<label style = "font-style: italic; font-size: 130%;" >Upload an Image</label >
								</div >
								<div style = " margin-bottom: 3rem;" >
									Select image to upload:
									<input type = "hidden" name="manufacturerImages" value="manufacturerImages" id="imageFolder">
									<input type = "file" name = "filename" id = "file" >
									<div style = "margin-top: 2.5rem" >
										<div >
                                            <img id = "blah" src = "<?php echo URLROOT?>admin/public/img/Placeholder.png"
												   alt = "your image" />
                                        </div >
										<input id = "imageUpload" type = "button" value = "Upload Image"
											   name = "button" >
									</div >
								</div >

								<input type = "hidden" name="create" value="create" id="manufacturerActivity">
								<div class = "ui positive button" id = "manufacturer_event" >Create!</div >
							</form >
						</div >
						<div class = "ui segment" >
							<div class = "ui header" >Edit Manufacturer</div >
							<form class = "ui form" id = "manufacturerUpdate">
								<div class = "field" >
									<select name = "currentManufacturer" id = "currentManufacturer" class = "ui dropdown" >
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

								<div class = "ui positive button" id = "DeleteButton" >Delete!</div >

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