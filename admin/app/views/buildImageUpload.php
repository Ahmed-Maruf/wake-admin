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
							<div class = "ui header" >Upload Products</div >
							<select class = "ui fluid search dropdown" multiple = "" >

								<option value = "" >Products</option >
								<?php
									foreach ($datas as $data):
										?>
										<option value = "<?php echo $data->id?>|<?php echo $data->manufacturers_id?>|<?php echo $data->series_id?>" ><?php echo $data->part_number?></option >
									<?php
									endforeach;
								?>
							</select >
						</div >
						<div style = " margin-bottom: 3rem;" >
							Select image to upload:
							<input type = "hidden" name = "productImages" value = "productImages"
								   id = "imageFolder" >
							<input type = "file" name = "filename" id = "file" >
							<div style = "margin-top: 2.5rem" >
								<input id = "bulkImageUpload" type = "button" value = "Upload Image" name = "button" >
							</div >
						</div >

					</div >

				</div >
			</div >
		</div >
	</div >

<?php
	include 'layouts/footer.layout.php'
?>