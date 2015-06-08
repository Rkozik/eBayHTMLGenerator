<?php
    $attributes = array('class'=>'tab-content-wrapper','id'=>'saveCurrentTemplate');
    $attributes2 = array('class'=>'tab-content-wrapper','id'=>'startNewTemplate');
?>
<section id="s0">
    <?php echo form_open('dashboard/saveTemplate/',$attributes);?>
        <div class="mt18">
            <div class="tab-input-border cream"></div>
            <input type="text" class="left w938 p9 disabled" value="<?php echo "Currently working on: ".($currentTemplateName==""?"A new listing.":$currentTemplateName); ?>" disabled="disabled"/>
            <div class="tab-input-border cream"></div>
        </div>
        <div class="clearer"></div>
        <div class="mt18">
            <div class="tab-input-border cream"></div>
            <input type="text" name="template_name" class="left w938 p9" value="<?php echo (strlen($currentTemplateName)>0?$currentTemplateName:"Give this template a name!"); ?>"/>
            <div class="tab-input-border cream"></div>
        </div>
        <div class="clearer"></div>
        <div class="left one-whole mt18">
            <div class="tab-input-border black"></div>
            <input type="button" class="left w956 p9 black cream-font bold" id="saveTemplate" value="Save Current Template"/>
            <div class="tab-input-border black"></div>
        </div>
        <div class="clearer"></div>
    <?php echo form_close(); ?>
    <?php echo form_open('dashboard/startNewTemplate/',$attributes2);?>
        <div class="left one-whole mt18">
            <div class="tab-input-border dark-grey"></div>
            <input type="button" class="left w956 p9 dark-grey cream-font bold" id="newTemplate" value="Start Over"/>
            <div class="tab-input-border dark-grey"></div>
        </div>
    <?php echo form_close(); ?>
</section>