<?php
$validationError_firstHalf = '<div class="validationError-container"><div class="tab-input-border dark-grey"></div><div class="validationError-icon-container"><div class="validationError-icon"></div></div><div class="fullWidth-validationError" ><p>';
$validationError_secondHalf = '</p></div><div class="validationError-closeBtn-container"><input type="button" class="validationError-removeBtn"/></div><div class="tab-input-border dark-grey"></div></div><div class="clearer"></div>';

$attributes = array('class'=>'tab-content-wrapper');
echo form_open('contact/',$attributes);
?>
    <section id="s0">
        <?php echo form_error('contactName',$validationError_firstHalf,$validationError_secondHalf); ?>
        <?php echo form_error('contactEmail',$validationError_firstHalf,$validationError_secondHalf); ?>
        <div class="mt18">
            <div class="left w475">
                <div class="tab-input-border cream"></div>
                <input type="text" class="left w471 p9" name="contactName" value="<?php echo set_value('contactName','Who do you want to be addressed as?');?>"/>
                <div class="tab-input-border cream"></div>
            </div>
            <div class="left w475 ml10">
                <div class="tab-input-border cream"></div>
                <input type="text" class="left w471 p9" name="contactEmail" value="<?php echo set_value('contactEmail','Your.email@provider.com');?>"/>
                <div class="tab-input-border cream"></div>
            </div>
        </div>
        <div class="clearer"></div>
        <?php echo form_error('contactSubject',$validationError_firstHalf,$validationError_secondHalf); ?>
        <div class="mt18">
            <div class="tab-input-border cream"></div>
            <input type="text" class="left w938 p9" name="contactSubject" value="<?php echo set_value('contactSubject','Enter subject of enquiry.');?>"/>
            <div class="tab-input-border cream"></div>
        </div>
        <div class="clearer"></div>
        <?php echo form_error('contactMessage',$validationError_firstHalf,$validationError_secondHalf); ?>
        <div class="tab-textarea-border cream"></div>
        <textarea class="left w940 h120 mt18 p9" name="contactMessage"><?php echo set_value('contactMessage',"Type out what you've got to say.");?></textarea>
        <div class="clearer"></div>
        <div class="mt18">
            <div class="tab-input-border dark-grey"></div>
            <input type="submit" class="left w956 p9 dark-grey cream-font bold pointer" value="I'll get back to you shortly!"/>
            <div class="tab-input-border dark-grey"></div>
        </div>
    </section>
<?php echo form_close(); ?>
</article>
<div class="clearer"></div>
<!-- End Contact Form -->