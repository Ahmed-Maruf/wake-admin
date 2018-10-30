<?php
	//include 'layouts/header.layout.php';
	require_once 'layouts/header.layout.php';
	include "layouts/sidebar.layout.php";
?>

<div class="pusher" style="max-width: 70%; margin-left: 1em;">
	<div class="ui vertical segment">
		<div class="ui grid" >
			<div class="row">
				<div class="sixteen wide column">
					<div class="ui segment">
						<div class="ui header">
							Insert New Product
						</div>
						<form class="ui form" id="newProductForm">
							<div class="field">
								<select name="productManufacturer" id="productManufacturer" class="ui dropdown">
									<?php
										foreach ($datas['manufacturers'] as $data) {
											?>
											<option value="<?php echo $data->id?>"><?php echo $data->name?></option>
											<?php
										}
									?>
								</select>
							</div>
							<div class="field" id="" style="display: <?=$show?>">
								<select name="ser" id="productSeries" class="ui dropdown">
									<option value="">Please select a series</option>
									<?php
										foreach($datas['series'] as $ser) {
											?>
											<option value="<?php echo $ser->id?>"><?php echo $ser->name ?></option>
											<?php
										}
									?>
								</select>
							</div>
							<div class="field">
								<input type="text" name="partNumber" id="partNumber" placeholder="Part Number">
							</div>
							<div class="field">
								<label>Description</label>
								<textarea name="desc" id="desc"></textarea>
							</div>
							<div class="field">
								<label>Series Description</label>
								<textarea name="serdesc" id="serdesc"></textarea>
							</div>
							<div class="field">
								<label>Title Tag</label>
								<textarea name="titletag" id="titletag"></textarea>
							</div>
							<div class="field">
								<label>Description Tag</label>
								<textarea name="desctag" id="desctag"></textarea>
							</div>
							<div class="field">
								<label>Keywords Tag</label>
								<textarea name="keywords" id="keywords"></textarea>
							</div>
							
							<div class="field" style="padding-top: 2rem">
								<div class="ui checkbox">
									<input type="checkbox" name="revisions" id="revisions">
									<Label style="font-size: large">Create Revisions A-Z</Label>
								</div>
							</div>
							
							<div class="field">
								<input type="text" name="reInv" id="reInv" placeholder="Remanufactured Inventory">
							</div>
							
							<div class="field">
								<input type="text" name="rePrice" id="rePrice" placeholder="Remanufactured Price">
							</div>
							
							<div class="field">
								<input type="text" name="newInv" id="newInv" placeholder="New Inventory">
							</div>
							
							<div class="field">
								<input type="text" name="newPrice" id="newPrice" placeholder="New Price">
							</div>
							
							<select class="ui dropdown" id="stock">
								<option value="">Stock Level</option>
								<option value="Available">Available</option>
								<option value="In StockShips 3-5 Days">In StockShips 3-5 Days</option>
								<option value="In StockShips Today">In StockShips Today</option>
								<option value="N/A">N/A</option>
								<option value="Obsolete">Obsolete</option>
								<option value="ut Of Stock">Out Of Stock</option>
								<option value="Ships 2-4 Weeks">Ships 2-4 Weeks</option>
							</select>
							
							<div style="margin-top: 3rem">
								<label style="font-style: bold; font-size: 130%;">Upload Main Image</label>
							</div>
							<div style=" margin-bottom: 3rem;">
								Select image to upload:
								<input type="file" name="filename" id="file">
								<div style="margin-top: 2.5rem">
									<div><img id="blah" src="/assets/img/products/Placeholder.png" alt="your image" /></div>
									<input id="filesubmit" type="button" value="Upload Image" name="button">
								</div>
							</div>
							
							<div style="margin-top: 3rem">
								<label style="font-style: bold; font-size: 130%;">Upload Secondary Image</label>
							</div>
							<div style=" margin-bottom: 3rem;">
								Select image to upload:
								<input type="file" name="filename" id="file2">
								<div style="margin-top: 2.5rem">
									<div><img id="blah2" src="/assets/img/products/Placeholder.png" alt="your image" /></div>
									<input id="filesubmit2" type="button" value="Upload Image" name="button">
								</div>
							</div>
							
							<div style="margin-top: 3rem">
								<label style="font-style: bold; font-size: 130%;">Upload pdf</label>
							</div>
							<div style=" margin-bottom: 3rem;">
								Select pdf to upload:
								<input type="file" name="filename" id="file3">
								<div style="margin-top: 2.5rem">
									<input id="filesubmit3" type="button" value="Upload pdf" name="button">
								</div>
							</div>
							<div class="ui positive button" id="createProduct">Create</div>
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
