<div class="ui visible left sidebar inverted vertical menu">
    <a href="<?php echo URLROOT . 'admin'?>" class="item"><i class="rocket icon"></i> Home</a>
    <div class="ui inverted accordion item">
        <i class="settings icon"></i>
        <div class="title">Manage <i class="dropdown icon"></i></div>
        <div class="content">
            <div class="ui animated list">
                <a href="<?php echo URLROOT . 'admin/manufacturers'?>" class="link item">Manage Manufacturers</a>
                <a href="/admin/manageSeries.php" class="link item">Manage Series</a>
                <a href="/admin/manageProducts.php" class="link item">Manage Products</a>
                <a href="/admin/manageHomepage.php" class="link item">Manage Homepage</a>
                <!--<a href="/admin/manageRevs.php" class="link item">Manage Revisions</a>-->
                <a href="/admin/manageFAQ.php" class="link item">Manage FAQs</a>
                <a href="/admin/manageAboutUs.php" class="link item">Manage About Us</a>
            </div>
        </div>
    </div>
    <div class="ui inverted accordion item">
        <i class="settings icon"></i>
        <div class="title">Repairs<i class="dropdown icon"></i></div>
        <div class="content">
            <div class="ui animated list">
                <a href="/admin/repairInfo.php" class="link item">Repair Info</a>
                <a href="/admin/repairProducts.php" class="link item">Repair Products</a>
            </div>
        </div>
    </div>
    <a href=""></a>
    <a href="/admin/uploadProducts.php" class="item"><i class="upload icon"></i>Upload Products</a>
    <a href="/admin/uploadImage.php" class="item"><i class="cloud upload icon"></i>Upload Images</a>
    <div class="ui search item" id="editPageSearch">
        <div class="ui icon input">
            <input class="prompt" type="text" placeholder="Edit pages...">
            <i class="search icon"></i>
        </div>
        <div class="results"></div>
    </div>
</div>