<section id="s0">
    <?php
    $validationError_firstHalf =    '<div class="validationError-container" id="errorDescription"><div class="tab-input-border dark-grey"></div><div class="validationError-icon-container"><div class="validationError-icon"></div></div><div class="fullWidth-validationError" ><p>';
    $validationError_secondHalf =   '</p></div><div class="validationError-closeBtn-container"><input type="button" class="validationError-removeBtn"/></div><div class="tab-input-border dark-grey"></div></div><div class="clearer"></div>';
    $sellerNotes_toggle_default = 'checked="checked"';
    ?>
    <?php echo form_error('description_title', $validationError_firstHalf, $validationError_secondHalf); ?>
    <div class="mt18">
        <div class="tab-input-border cream"></div>
        <input type="text" class="left w938 p9" name="description_title" value="<?php echo set_value('description_title',((isset($description_title) == TRUE) && ($description_title !== NULL) ? $description_title : "Please enter the title of your auction.")); ?>"/>
        <div class="tab-input-border cream"></div>
    </div>
    <div class="clearer"></div>
    <?php echo form_error('description_sellerNotes', $validationError_firstHalf, $validationError_secondHalf); ?>
    <div class="tab-textarea-border cream"></div>
    <textarea name="description_sellerNotes" class="left w940 h120 mt18 p9"><?php echo ((isset($description_sellerNotes) == TRUE) && ($description_sellerNotes !== NULL) ? $description_sellerNotes : "Write a brief paragraph describing the item."); ?></textarea>
    <div class="clearer"></div>
    <!-- Pseudo Fieldset -->
    <?php echo form_error('description_paymentOptions[]', $validationError_firstHalf, $validationError_secondHalf); ?>
    <?php echo form_error('description_sellerNotes_toggle', $validationError_firstHalf, $validationError_secondHalf); ?>
    <div class="fieldset-top"></div>
    <p class="fieldset-legend">User Options</p>
    <div class="clearer"></div>
    <!--<div class="left w2 mt-11 h131 black"></div>-->
    <div style="float:left;background-color:#4a4a4a;width:960px;margin:-11px 0px 0px 0px;">
        <div class="left w956 ml2 grey">
            <div class="row mt9">
                <h3 class="userOptions-title">Mark-off each payment options do you accept:</h3>
                <div class="clearer"></div>
                <p class="checkbox">
                    <input type="checkbox" name="description_paymentOptions[]" value="credit-card" <?php echo ((isset($description_paymentOptions)) && (!is_bool($description_paymentOptions)) && in_array("credit-card",$description_paymentOptions)?'checked="checked"':'');?> id="c0"/>
                    <label for="c0" class="mt4">Credit-card</label>
                </p>
                <p class="checkbox">
                    <input type="checkbox" name="description_paymentOptions[]" value="paypal"  <?php echo ((isset($description_paymentOptions)!== false) && (!is_bool($description_paymentOptions)) && in_array("paypal",$description_paymentOptions)?'checked="checked"':'');?><?php echo (!isset($description_paymentOptions)?'checked="checked"':'');?> id="c1"/>
                    <label for="c1" class="mt4">Paypal</label>
                </p>
            </div>
            <div class="clearer"></div>
            <h3 class="userOptions-title">Do you want to include seller notes?</h3>
            <div class="clearer"></div>
            <div class="row">
                <p class="radio">
                    <input type="radio" name="description_toggle" value="true" id="r0" <?php echo (isset($description_sellerNotes_toggle) && ($description_sellerNotes_toggle == "true") ? 'checked="checked"' :$sellerNotes_toggle_default); ?>/>
                    <label for="r0" class="mt4">Yes</label>
                </p>
                <p class="radio">
                    <input type="radio" name="description_toggle" value="false" id="r1" <?php echo (isset($description_sellerNotes_toggle) && ($description_sellerNotes_toggle == "false") ? 'checked="checked"' :''); ?>/>
                    <label for="r1" class="mt4">No</label>
                </p>
            </div>
            <div class="clearer"></div>
            <div style="float:left;width:607px;padding:2px 0 8px 9px;">
                <!-- AD BLOCK HERE -->
            </div>
            <div style="float:left;width:316px;margin:9px 0px 0px 12px;padding-bottom:16px;">
                <div class="tab-input-next-border dark-grey"></div>
                <input type="button" class="left w312 p13 dark-grey cream-font bold nextButton" id="next0" value="Next"/>
                <div class="tab-input-next-border dark-grey"></div>
            </div>
        </div>
        <div class="clearer"></div>
    </div>
    <!--<div class="left w2 mt-11 h131 black"></div>-->
    <div class="clearer"></div>
    <div class="left w956 h2 ml2 black"></div>
    <div class="clearer"></div>
</section>