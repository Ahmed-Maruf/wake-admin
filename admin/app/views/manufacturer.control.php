
<?php
	require_once 'layouts/header.layout.php';
	include "layouts/sidebar.layout.php";
	include "layouts/pageorder.layout.php";
?>
<div class="left pusher" style="max-width: 50%; margin-left: 26rem">
	<div class="ui vertical segment" style="padding-bottom: 0;">
		<div class="ui sixteen wide grid container">
			<div class="ui row">
				<div class="ui center aligned column">
					<h1 class="ui header" style="font-family: Helvetica; font-weight: 400; min-height: 10rem;">
						Homepage Table
					</h1>
				</div>
			</div>
			<div class="ui vertical segment" style="padding-bottom: 0;">
				<div class="ui grid container">
					<div class="twelve wide column" >
						<div class="ui stackable three column grid">
							<?php
								$counter = 3;
								foreach($manufs as $manuf) {
									$about = $manuf['about'];
									$about = str_replace("<p>", "", $about);
									$about = str_replace("</p>", "", $about);
									if($counter == 2){
										$counter = 0;
										?>
										<div class="row">
										<?php
									}
									$counter++;
									?>
									<div class="column">
										<div class="ui color1 segment">
											<div style="height: 20rem" onmouseleave="transback('<?=$manuf['id']?>')"
												 onmouseenter="trans('<?=$manuf['id']?>')">
												<p style="position: absolute; display: none" id="<?=$manuf['id']?>"><?=$about?></p>
												<div class="center aligned container">
													<img style="height: 17.3rem; margin-left: auto; margin-right: auto"
														 class="ui <?=$manuf['id']?> image"
														 src="/assets/img/manufImages/<?=$manuf['image']?>" >
												</div>
												<a href="manufacturer.php"
												   style="display: block;padding-top: 1.2rem; font-weight: bold; font-size: 120%"><?=$manuf['name']?></a>
											</div>
										</div>
									</div>
									<?php
									if($counter == 3) {
										?>
										</div>
										<?php
									}
								}
							?>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>

<?php
	include 'layouts/footer.layout.php'
?>
