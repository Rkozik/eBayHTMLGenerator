<section id="s1">
    <?php
    $validationError_firstHalf = '<div class="validationError-container"><div class="tab-input-border dark-grey"></div><div class="validationError-icon-container"><div class="validationError-icon"></div></div><div class="fullWidth-validationError" ><p>';
    $validationError_secondHalf = '</p></div><div class="validationError-closeBtn-container"><input type="button" class="validationError-removeBtn"/></div><div class="tab-input-border dark-grey"></div></div><div class="clearer"></div>';
    $totalFeatures = (isset($features)== TRUE ? count($features) : 0);
    $toggle = (isset($features_toggle)?$features_toggle:0);
    function setToggle($name,$bool,$default)
    {
        $toggleSet = ($name==0?true:false);

        if($toggleSet==false && $bool==$default)
        {
            return 'checked="checked"';
        }
        elseif($toggleSet==true && $name==$bool)
        {
            return 'checked="checked"';
        }
        else
        {
            return '';
        }
    }
    ?>
    <?php echo form_error('features[]', $validationError_firstHalf, $validationError_secondHalf); ?>
    <div id="features-list">
        <?php for($i=0;$i<=$totalFeatures;$i++):?>
            <?php if($i==0):?>
                <div class="mt18">
                    <div class="tab-input-border cream"></div>
                    <input type="text" name="features[]" class="left w938 p9" value="<?php echo ((isset($features) == TRUE) && ($features[0] !== NULL) ? $features[0] : "Create a bullet point list of features by entering one per line."); ?>" />
                    <div class="tab-input-border cream"></div>
                </div>
                <div class="clearer"></div>
            <?php elseif(($i!==0) && ($i!==$totalFeatures)): ?>
                <div class="left mt18 feature">
                    <div class="tab-input-border cream"></div>
                    <input type="text" name="features[]" class="left w900 p9" value="<?php echo $features[$i]; ?>" />
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
        <input type="button" id="add-feature" class="left w956 p9 black cream-font bold" value="Add Another Feature"/>
        <div class="tab-input-border black"></div>
    </div>
    <div class="clearer"></div>
    <!-- Pseudo Fieldset -->
    <?php echo form_error('features_toggle', $validationError_firstHalf, $validationError_secondHalf); ?>
    <div class="fieldset-top"></div>
    <p class="fieldset-legend">User Options</p>
    <div class="clearer"></div>
    <div style="float:left;background-color:#4a4a4a;width:960px;margin:-11px 0px 0px 0px;">
        <div class="left w956 ml2 grey">
            <div class="row mt9">
                <h3 class="userOptions-title">Would you like to disabled features?</h3>
            </div>
            <div class="clearer"></div>
            <div class="row">
                <p class="radio">
                    <input type="radio" name="features_toggle" value="false" id="r2" <?php echo setToggle($toggle,"false","true"); ?> />
                    <label for="r2" class="mt4">Yes</label>
                </p>
                <p class="radio">
                    <input type="radio" name="features_toggle" value="true" id="r3" <?php echo setToggle($toggle,"true","true"); ?>/>
                    <label for="r3" class="mt4">No</label>
                </p>
            </div>
            <div class="clearer"></div>
            <div style="float:left;width:607px;padding:2px 0 8px 9px;">
                <!-- AD BLOCK HERE -->
            </div>
            <div style="float:left;width:316px;margin:9px 0 0 12px;padding-bottom:16px;">
                <div class="tab-input-next-border dark-grey"></div>
                <input type="button" class="left w312 p13 dark-grey cream-font bold nextButton" id="next1" value="Next"/>
                <div class="tab-input-next-border dark-grey"></div>
            </div>
        </div>
        <div class="clearer"></div>
    </div>
    <div class="clearer"></div>
    <div class="left w956 h2 ml2 black"></div>
    <div class="clearer"></div>
</section>