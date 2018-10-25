<?php
	require_once 'layouts/header.layout.php';
	include "layouts/sidebar.layout.php";
	include "layouts/pageorder.layout.php";
?>
<style>
    div {
        word-break: break-word;
    }
</style>
<style>
    .ui.color1.segment{
        border-color: #1F2585;
    }
</style>

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
									$total = count($datas);
									$counter = 0;
									foreach($datas as $data) {
										$about = $data->about;
										$about = str_replace("<p>", "", $about);
										$about = str_replace("</p>", "", $about);
										if($counter == 0){
										    echo '<div class="row">';
                                        }
                                        $counter++;
										?>
                                        <div class="column">
                                            <div class="ui color1 segment">
                                                <div style="height: 20rem" onmouseleave="transback('<?php echo $data->id?>')"
                                                     onmouseenter="trans('<?php echo $data->id?>')">
                                                    <p style="position: absolute; display: none" id="<?php echo $data->id?>"><?php echo $about?></p>
                                                    <div class="center aligned">
                                                        <img style="height: 17.3rem; margin-left: auto; margin-right: auto"
                                                             class="ui <?php echo $data->id?> image"
                                                             src="<?php echo URLROOT?>admin/public/img/manufacturerImages/<?php echo $data->image?>" >
                                                    </div>
                                                    <a href="manufacturer.php"
                                                       style="display: block;padding-top: 1.2rem; font-weight: bold; font-size: 120%"><?php echo $data->name?></a>
                                                </div>
                                            </div>
                                        </div>
										<?php
										if($counter == 3) {
										    $counter = 0;
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
