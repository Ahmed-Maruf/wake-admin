<?php
	//include 'layouts/header.layout.php';
	require_once 'layouts/header.layout.php';
	include "layouts/sidebar.layout.php";
?>
	<div class = "right pusher" style = "max-width: 70%; margin-left: 1em;" >
		<div class = "ui vertical segment" >
			<div class = "ui grid" >
				<div class = "row" >
					<div class = "sixteen wide column" >
						<div class = "ui segment" >
							<div class = "ui header" >Create Series</div >
							<form class = "ui form" id = "seriesCreate" >
								<div class = "field" >
									<select name = "manufacturer" id = "currentManufacturer" class = "ui dropdown" >
										<?php
											foreach ($datas['manufacturers'] as $data):
												?>
												<option value = "<?php echo $data->id ?>" ><?php echo $data->name . ' | ' . $data->id ?></option >
											<?php
											endforeach;
										?>
									</select >

								</div >

								<div class = "field" >
									<input type = "text" name = "name" id = "name" placeholder = "Name" >
								</div >

								<div class = "field" >
									<label >Description</label >
									<textarea name = "description" id = "description" ></textarea >
								</div >

								<div class = "field" >
									<label >Short Description</label >
									<textarea name = "shortDescription" id = "shortDescription" ></textarea >
								</div >

								<div class = "field" >
									<input type = "text" id = "titleTag" name = "titleTag" placeholder = "Title Tag" >
								</div >

								<div class = "field" >
									<input type = "text" id = "descriptionTag" name = "descriptionTag"
										   placeholder = "Description Tag" >
								</div >

								<div class = "field" >
									<input type = "text" id = "keywordTag" name = "keywordTag" placeholder = "Keywords Tag" >
								</div >

								<div style = "margin-top: 3rem" >
									<label style = "font-style: bold; font-size: 130%;" >Upload an Image</label >
								</div >

								<div style = " margin-bottom: 3rem;" >
									Select image to upload:
									<input type = "hidden" name = "seriesImages" value = "seriesImages"
										   id = "imageFolder" >
									<input type = "file" name = "filename" id = "file" >

									<div style = "margin-top: 2.5rem" >
										<div >
											<img id = "blah"
												   src = "<?php echo URLROOT ?>admin/public/img/Placeholder.png"
												   alt = "your image" />
										</div >
										<input id = "imageUpload" type = "button" value = "Upload Image"
											   name = "button" >
									</div >
								</div >
								<input type = "hidden" name="create" value="create" id="seriesActivity">
								<div class = "ui positive button " id = "series_event">Create Series</div >
								<!-- <div class="ui positive button" id="createSer">Create Series</div>-->
							</form >
						</div >

						<div class = "ui segment" >
							<form class = "ui form" id = "seriesUpdate" >
								<div class = "field" >
									<select name = "currentSeries" id = "currentSeries" class = "ui search dropdown" >
										<?php
											foreach ($datas['series'] as $data):
												?>
												<option value = "<?php echo $data->id ?>" ><?php echo $data->name . ' | ' . $data->id ?></option >
											<?php
											endforeach;
										?>
									</select >
								</div >
								<div class = "ui positive button" id = "findButton" >Edit Series</div >
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