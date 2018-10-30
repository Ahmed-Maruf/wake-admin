<?php
	//include 'layouts/header.layout.php';
	require_once 'layouts/header.layout.php';
	include "layouts/sidebar.layout.php";
?>
	<div class="pusher" style="max-width: 70%; margin-left: 1em;">
		<div class="ui vertical segment">
			<div class="ui grid">
				<div class="row">
					<div class="sixteen wide column">
						<div class="ui segment">
							<div class="ui header">
								Update Series
							</div>
							<form class="ui form" id="seriesUpdate">

								<div class="field">
									<label>Name</label>
									<input type="text" name="name" id="name" placeholder="Name" value="<?php echo $datas->name ?>">
								</div>

								<div class="field">
									<label>Page Name</label>
									<input type="text" name="pageName" id="pageName" placeholder="Page Name" value="<?php echo $datas->page_name?>">
								</div>

								<div class="field">
									<label>Title Tag</label>
									<input type="text" name="titleTag" id="titleTag" placeholder="Title Tag" value="<?php echo $datas->title_tag ?>">
								</div>

								<div class="field">
									<label>Description Tag</label>
									<input type="text" name="descriptionTag" id="descriptionTag" placeholder="Description Tag" value="<?php echo $datas->description_tag ?>">
								</div>

								<div class="field">
									<label>Keywords Tag</label>
									<input type="text" name="keywordTag" id="keywordTag" placeholder="Keywords Tag" value="<?php echo $datas->keywords_tag ?>">
								</div>

								<div class="field">
									<label>Series Description</label>
									<textarea name="description" id="description"><?php echo $datas->description ?></textarea>
								</div>

								<div class="field">
									<label>Series Short Description</label>
									<textarea name="shortDescription" id="shortDescription"><?php echo $datas->short_description ?></textarea>
								</div>

								<div style="margin-top: 3rem">
									<label style="font-style: bold; font-size: 130%;">Upload an Image</label>
								</div>

								<div style=" margin-bottom: 3rem;">
									Select image to upload:
									<input type = "hidden" name = "seriesImages" value = "seriesImages"
										   id = "imageFolder" >
									<input type="file" name="filename" id="file">
									
                                    <div style="margin-top: 2.5rem">
										<?php if ($datas->image == '') $datas->image = 'Placeholder.png'?>
										<div><img id="blah" src="<?php echo URLROOT?>admin/public/img/seriesImages/<?php echo $datas->image?>"
												  alt="your image"/>
										</div>

										<input id="imageUpload" type="button" value="Upload Image" name="button">
									</div>
								</div>

								<input type = "hidden" name="seriesID" id="seriesID" value="<?php echo $datas->id?>">
								<input type = "hidden" name="seriesImage" id="seriesImage" value="<?php echo $datas->image?>">
								<input type = "hidden" name="update" value="update" id="seriesActivity">
								<div class = "ui positive button" id = "series_event" >Update!</div >
								<input type="submit" id="deleteSer" name="deleteSeries" value="Delete Series!"  style="height: 35px; width: 100px; color: red;">
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php
	include 'layouts/footer.layout.php'
?>