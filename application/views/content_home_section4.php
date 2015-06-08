<section id="s4">
    <?php
    $validationError_firstHalf = '<div class="validationError-container"><div class="tab-input-border dark-grey"></div><div class="validationError-icon-container"><div class="validationError-icon"></div></div><div class="fullWidth-validationError" ><p>';
    $validationError_secondHalf = '</p></div><div class="validationError-closeBtn-container"><input type="button" class="validationError-removeBtn"/></div><div class="tab-input-border dark-grey"></div></div><div class="clearer"></div>';
    $totalQuestions = (isset($FAQ_question)==TRUE?count($FAQ_question):0);
    $toggle = (isset($FAQ_toggle)?$FAQ_toggle:0);
    ?>

    <?php echo form_error('FAQ_question[]', $validationError_firstHalf, $validationError_secondHalf); ?>
    <?php echo form_error('FAQ_answer[]', $validationError_firstHalf, $validationError_secondHalf); ?>
    <div id="shipping-list">
    <?php for($i=0;$i<=$totalQuestions;$i++): ?>
        <?php if($i==0):?>
        <div class="mt18">
            <div class="tab-input-border cream"></div>
            <input type="text" name="FAQ_question[]" class="left w938 p9" value="<?php echo ((isset($FAQ_question) == TRUE) && ($FAQ_question[0] !== NULL) ? $FAQ_question[0] : "Type question, for example: After I buy this item how long will it take to ship?"); ?>"/>
            <div class="tab-input-border cream"></div>
        </div>
        <div class="clearer"></div>
        <div class="tab-textarea-border cream"></div>
        <textarea name="FAQ_answer[]" class="left w940 h120 mt18 p9"><?php echo ((isset($FAQ_answer) == TRUE) && ($FAQ_answer[0] !== NULL) ? $FAQ_answer[0] : "Prior to even listing an item I put together all packing materials aside for the product, so once your payment goes through I can have it shipped within 24 hours. Typically speaking the item gets posted that same day."); ?></textarea>
        <div class="clearer"></div>
        <?php elseif(($i!==0) && ($i!==$totalQuestions)): ?>
        <div class="left mt18 shipping">
            <div class="tab-input-border cream"></div>
            <input type="text" name="FAQ_question[]" class="left w900 p9" value="<?php echo $FAQ_question[$i]; ?>"/>
            <div class="tab-input-border cream"></div>
            <div class="remove-item-wrapper">
                <input type="button" class="remove-item-icon" />
            </div>
            <div class="left w922">
                <div class="tab-textarea-border cream"></div>
                <textarea name="FAQ_answer[]" class="left w902 h120 mt18 p9"><?php echo $FAQ_answer[$i]; ?></textarea>
            </div>
        </div>
        <div class="clearer"></div>
        <?php endif; ?>
    <?php endfor; ?>
    </div>

    <div class="mt18">
        <div class="tab-input-border black"></div>
        <input type="button" class="left w956 p9 black cream-font bold" id="add-shipping" value="Add New Question & Answer"/>
        <div class="tab-input-border black"></div>
    </div>
    <div class="clearer"></div>
    <!-- Pseudo Fieldset -->
    <?php echo form_error('FAQ_toggle', $validationError_firstHalf, $validationError_secondHalf); ?>
    <div class="fieldset-top"></div>
    <p class="fieldset-legend">User Options</p>
    <div class="clearer"></div>
    <div style="float:left;background-color:#4a4a4a;width:960px;margin:-11px 0px 0px 0px;">
        <div class="left w956 ml2 grey">
            <div class="row mt9">
                <h3 class="userOptions-title">Do you want this shipping FAQ turned off?</h3>
            </div>
            <div class="clearer"></div>
            <div class="row">
                <p class="radio">
                    <input type="radio" name="FAQ_toggle" value="false" id="r8" <?php echo setToggle($toggle,"false","true"); ?>/>
                    <label for="r8" class="mt4">Yes</label>
                </p>
                <p class="radio">
                    <input type="radio" name="FAQ_toggle" value="true" id="r9"  <?php echo setToggle($toggle,"true","true"); ?>/>
                    <label for="r9" class="mt4">No</label>
                </p>
            </div>
            <div class="clearer"></div>
            <div style="float:left;width:607px;padding:2px 0 8px 9px;">
                <!-- AD BLOCK HERE -->
            </div>
            <div style="float:left;width:316px;margin:9px 0 0 12px; padding-bottom:16px;">
                <div class="tab-input-next-border dark-grey"></div>
                <input type="submit" class="left w312 p13 dark-grey cream-font bold pointer" title="Preview eBay Template" id="next4" value="Preview"/>
                <div class="tab-input-next-border dark-grey"></div>
            </div>
        </div>
        <div class="clearer"></div>
    </div>
    <div class="clearer"></div>
    <div class="left w956 h2 ml2 black"></div>
    <div class="clearer"></div>
</section>
<div class="tab-content-wrapper">
    <?php echo form_close(); $attributes = array('class'=>'w480 left','id'=>'loadExampleTemplate'); ?>
    <?php echo form_open('home/loadExampleTemplate/',$attributes);
    ?>
    <div class="mt18">
        <div class="tab-input-border dark-grey"></div>
        <input type="button" id="loadExample" class="left w470 p9 dark-grey cream-font bold pointer" value="First time? Click to load an example." title="Load a completed eBay Template"/>
        <div class="tab-input-border dark-grey"></div>
    </div>
    <div class="clearer"></div>
    <?php echo form_close(); $attributes2 = array('class'=>'right','id'=>'startNewTemplate'); ?>
    <?php echo form_open('home/startNewTemplate/',$attributes2);?>
    <div class="mt18">
        <div class="tab-input-border black"></div>
        <input type="button" id="newTemplate" class="left w470 p9 black cream-font bold pointer" value="Create New Template" title="Create new eBay template"/>
        <div class="tab-input-border black"></div>
    </div>
    <div class="clearer"></div>
    <?php echo form_close(); ?>
</div>
</article>
<div class="clearer"></div>
<!-- END Tabbed UI -->