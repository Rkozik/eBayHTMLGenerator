<section id="s2">
    <?php
    $validationError_firstHalf = '<div class="validationError-container" id="errorPhotos"><div class="tab-input-border dark-grey"></div><div class="validationError-icon-container"><div class="validationError-icon"></div></div><div class="fullWidth-validationError" ><p>';
    $validationError_secondHalf = '</p></div><div class="validationError-closeBtn-container"><input type="button" class="validationError-removeBtn"/></div><div class="tab-input-border dark-grey"></div></div><div class="clearer"></div>';
    $totalPhotos = (isset($photos)== TRUE ? count($photos) : 0);
    $toggle = (isset($photos_toggle)?$photos_toggle:0);
    ?>
    <?php echo form_error('photos[]', $validationError_firstHalf, $validationError_secondHalf); ?>
    <div id="photo-list">
        <?php for($i=0;$i<=$totalPhotos;$i++):?>
            <?php if($i==0):?>
            <div class="mt18">
                <div class="tab-input-border cream"></div>
                <input type="text" name="photos[]" class="left w938 p9" value="<?php echo ((isset($photos) == TRUE) && ($photos[0] !== NULL) ? $photos[0] : "Enter one direct link to an image i.e.: http://imgur.com/12x432.jpg per line to add photos to your template."); ?>" />
                <div class="tab-input-border cream"></div>
            </div>
            <div class="clearer"></div>
            <?php elseif(($i!==0) && ($i!==$totalPhotos)): ?>
            <div class="left mt18 photo">
                <div class="tab-input-border cream"></div>
                <input type="text" name="photos[]" class="left w900 p9" value="<?php echo $photos[$i]; ?>" />
                <div class="tab-input-border cream"></div>
                <div class="remove-item-wrapper">
                    <input type="button" class="remove-item-icon" />
                </div>
            </div>
            <div class="clearer"></div>
            <?php endif; ?>
        <?php endfor; ?>
    </div>

    <div class="mt18">
        <div class="tab-input-border black"></div>
        <input type="button" id="add-photo" class="left w956 p9 black cream-font bold" value="Add Another Picture To The Carousel"/>
        <div class="tab-input-border black"></div>
    </div>
    <div class="clearer"></div>
    <!-- Pseudo Fieldset -->
    <?php echo form_error('photos_toggle', $validationError_firstHalf, $validationError_secondHalf); ?>
    <div class="fieldset-top"></div>
    <p class="fieldset-legend">User Options</p>
    <div class="clearer"></div>
    <div style="float:left;background-color:#4a4a4a;width:960px;margin:-11px 0px 0px 0px;">
        <div class="left w956 ml2 grey">
            <div class="row mt9">
                <h3 class="userOptions-title">Would you like to disable the photo carousel?</h3>
            </div>
            <div class="clearer"></div>
            <div class="row">
                <p class="radio">
                    <input type="radio" name="photos_toggle" value="false" id="r4" <?php echo setToggle($toggle,"false","true"); ?>/>
                    <label for="r4" class="mt4">Yes</label>
                </p>
                <p class="radio">
                    <input type="radio" name="photos_toggle" value="true" id="r5" <?php echo setToggle($toggle,"true","true"); ?>/>
                    <label for="r5" class="mt4">No</label>
                </p>
            </div>
            <div class="clearer"></div>
            <div style="float:left;width:600px;padding:2px 0 8px 0;">
                <div class="row">
                    <em class="userOptions-title">Note: Square photos work best.</em>
                </div>
            </div>
            <div style="float:left;width:316px;margin:9px 0px 0px 20px;padding-bottom:16px;">
                <div class="tab-input-next-border dark-grey"></div>
                <input type="button" class="left w312 p13 dark-grey cream-font bold nextButton" id="next2" value="Next"/>
                <div class="tab-input-next-border dark-grey"></div>
            </div>
        </div>
        <div class="clearer"></div>
    </div>
    <div class="clearer"></div>
    <div class="left w956 h2 ml2 black"></div>
    <div class="clearer"></div>
</section>