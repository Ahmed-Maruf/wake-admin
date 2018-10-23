<?php
	//include 'layouts/header.layout.php';
	require_once 'layouts/header.layout.php';
    include "layouts/sidebar.layout.php";
	?>
		<div class="ui pusher" style="max-width: 70%; margin-left: 3em;">
			<div class="ui vertical segment">
				<div class="ui grid container">
					<div class="row">
						<div class="sixteen wide column">
							<table id="inventory-table" cellpadding="0" cellspacing="0" border="1" class="display ui table" style="float: right; width: 100%;" >
								<thead>
								<tr>
									<th>Part #</th>
									<th>Remanufactured Inv.</th>
									<th>Remanufactured Price</th>
									<th>New Inv.</th>
									<th>New Price</th>
									<th>Stock Level</th>
								</tr>
								
								</thead>
								<tbody>
								
								</tbody>
							</table>
							<button class="ui button" id="submit">Submit</button>
						</div>
					</div>
				</div>
			</div>
		
		</div>
<?php
    include 'layouts/footer.layout.php'
?>