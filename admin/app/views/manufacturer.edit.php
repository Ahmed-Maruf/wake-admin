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
                                Update Manufacturer
                            </div>
                            <form class="ui form" id="editForm">
                                <div class="field">
                                    <label>Name</label>
                                    <?php var_dump($datas)?>
                                    <input type="text" name="name" id="name" placeholder="Name"
                                           value="<?php echo $datas->name?>">
                                </div>
                                <div class="field">
                                    <label>Page Name</label>
                                    <input type="text" name="page-name" id="page-name" placeholder="Page Name"
                                           value="<?php echo $datas->page_name?>">
                                </div>
                                <div class="field">
                                    <label>Title Tag</label>
                                    <input type="text" name="titleTag" id="titleTag" placeholder="Title Tag"
                                           value="<?php echo $datas->title_tag?>">
                                </div>
                                <div class="field">
                                    <label>Description Tag</label>
                                    <input type="text" name="descTag" id="descTag" placeholder="Description Tag"
                                           value="<?php echo $datas->description_tag?>">
                                </div>
                                <div class="field">
                                    <label>Keywords Tag</label>
                                    <input type="text" name="keyTag" id="keyTag" placeholder="Keywords Tag"
                                           value="<?php echo $datas->keywords_tag?>">
                                </div>
                                <div class="field">
                                    <label>About Tab</label>
                                    <textarea name="about" id="about"><?php echo $datas->about?></textarea>
                                </div>
                                <div style="margin-top: 3rem">
                                    <label style="font-style: bold; font-size: 130%;">Upload an Image</label>
                                </div>
                                <div style=" margin-bottom: 3rem;">
                                    Select image to upload:
                                    <input type="file" name="filename" id="file">
                                    <div style="margin-top: 2.5rem">
                                        <?php if ($datas->image == '') $datas->image = 'Placeholder.png'?>
                                        <div><img id="blah" src="<?php echo URLROOT?>admin/public/img/manufacturerImages/<?php echo $datas->image?>"
                                                  alt="your image"/>
                                        </div>

                                        <input id="filesubmit" type="button" value="Upload Image" name="button">
                                    </div>
                                </div>
                                <input type="hidden" name="id" id="id" value="">
								<input type = "hidden" name="manufacturer_id" id="manufacturer_id" value="<?php echo $datas->id?>">
								<input type = "hidden" name="update" value="update" id="manufacturer_cru">
								<div class = "ui positive button" id = "manufacturer_event" >Update!</div >
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