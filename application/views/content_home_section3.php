<section id="s3">
    <?php
    $validationError_firstHalf = '<div class="validationError-container"><div class="tab-input-border dark-grey"></div><div class="validationError-icon-container"><div class="validationError-icon"></div></div><div class="fullWidth-validationError" ><p>';
    $validationError_secondHalf = '</p></div><div class="validationError-closeBtn-container"><input type="button" class="validationError-removeBtn"/></div><div class="tab-input-border dark-grey"></div></div><div class="clearer"></div>';

    $totalSpecificationTitle = (isset($specification_title)==TRUE?count($specification_title):0);
    $totalSpecificationLabel = (isset($totalSpecificationLabel)==TRUE?count($specification_label):0);
    $totalRows = ($totalSpecificationTitle>=$totalSpecificationLabel?$totalSpecificationTitle:$totalSpecificationLabel);
    $toggle = (isset($specification_toggle)?$specification_toggle:0);
    ?>
    <?php echo form_error('specification_title[]', $validationError_firstHalf, $validationError_secondHalf); ?>
    <?php echo form_error('specification_label[]', $validationError_firstHalf, $validationError_secondHalf); ?>
    <div id="specifications-list">
        <?php for($i=0;$i<=$totalRows;$i++): ?>
        <?php if($i==0): ?>
        <div class="mt18">
            <div class="left w475">
                <div class="tab-input-border cream"></div>
                <input type="text" name="specification_title[]" class="left w471 p9" value="<?php echo ((isset($specification_title) == TRUE) && ($specification_title[0] !== NULL) ? $specification_title[0] : "Enter new label name i.e.: Dimensions"); ?>"/>
                <div class="tab-input-border cream"></div>
            </div>
            <div class="left w475 ml10">
                <div class="tab-input-border cream"></div>
                <input type="text" name="specification_label[]" class="left w471 p9" value="<?php echo ((isset($specification_label) == TRUE) && ($specification_label[0] !== NULL) ? $specification_label[0] : "10.3 x 4.2 x 13.3 inches"); ?>"/>
                <div class="tab-input-border cream"></div>
            </div>
        </div>
        <div class="clearer"></div>
        <?php elseif(($i!==0) && ($i!==$totalRows)): ?>
        <div class="left mt18 specification">
            <div class="left w456">
                <div class="tab-input-border cream"></div>
                <input type="text" name="specification_title[]" class="left w434 p9" value="<?php echo $specification_title[$i];?>"/>
                <div class="tab-input-border cream"></div>
            </div>
            <div class="left w456 ml10">
                <div class="tab-input-border cream"></div>
                <input type="text" name="specification_label[]" class="left w434 p9" value="<?php echo $specification_label[$i];?>"/>
                <div class="tab-input-border cream"></div>
            </div>
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
        <input type="button" class="left w956 p9 black cream-font bold" id="add-specification" value="Add One More Specification"/>
        <div class="tab-input-border black"></div>
    </div>
    <div class="clearer"></div>
    <!-- Pseudo Fieldset -->
    <?php echo form_error('specification_toggle', $validationError_firstHalf, $validationError_secondHalf); ?>
    <div class="fieldset-top"></div>
    <p class="fieldset-legend">User Options</p>
    <div class="clearer"></div>
    <div style="float:left;background-color:#4a4a4a;width:960px;margin:-11px 0px 0px 0px;">
        <div class="left w956 ml2 grey">
            <div class="row mt9">
                <h3 class="userOptions-title">Want to turn this section off?</h3>
            </div>
            <div class="clearer"></div>
            <div class="row">
                <p class="radio">
                    <input type="radio" name="specification_toggle" value="false" id="r6" <?php echo setToggle($toggle,"false","true"); ?>/>
                    <label for="r6" class="mt4">Yes</label>
                </p>
                <p class="radio">
                    <input type="radio" name="specification_toggle" value="true" id="r7" <?php echo setToggle($toggle,"true","true"); ?>/>
                    <label for="r7" class="mt4">No</label>
                </p>
            </div>
            <div class="clearer"></div>
            <div style="float:left;width:600px;padding:2px 0px 8px 8px;">
                <!-- INSERT AD COPY -->
            </div>
            <div style="float:left;width:316px;margin:9px 0px 0px 20px;padding-bottom:16px;">
                <div class="tab-input-next-border dark-grey"></div>
                <input type="button" class="left w312 p13 dark-grey cream-font bold nextButton" id="next3" value="Next"/>
                <div class="tab-input-next-border dark-grey"></div>
            </div>
        </div>
        <div class="clearer"></div>
    </div>
    <div class="clearer"></div>
    <div class="left w956 h2 ml2 black"></div>
    <div class="clearer"></div>
</section>