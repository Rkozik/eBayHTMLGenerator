<?php echo form_open('download/newsletter'); ?>
<section id="s0" xmlns="http://www.w3.org/1999/html">
        <div class="tab-content-wrapper">
            <?php echo form_error('email'); ?>
            <?php echo form_error('email_confirmation'); ?>
            <div id="download-templateWait" class="one-whole left" style="<?php echo ($login_status == "FALSE"?'':'display:none;'); ?>">
                <div class="one-half left">
                    <p class="pl0 pt12 pb6">
                        <em>
                            We're sorry, in order to keep this service free user's who are not logged in must wait a minute for
                            their download to begin. Don't have the time? <b>Sign-up for our newsletter to download instantly!</b>
                        </em>
                    </p>
                    <div class="fieldset-btn-container">
                        <div class="fieldset-btn-border-leftRight"></div>
                        <input id="downloadTemplate-free" class="fieldset-btn-content" type="button" value="Please wait . . . 60 seconds"/>
                        <div class="fieldset-btn-border-leftRight"></div>
                    </div>
                </div>
                <div class="one-half right mt18">
                    <div class="one-half left">
                        <div class="tab-input-border cream"></div>
                        <input type="text" class="left w448 p9" name="email" value="Enter your@email.com"/>
                        <div class="tab-input-border cream"></div>
                    </div>
                    <div class="left w475 mt18">
                        <div class="tab-input-border cream"></div>
                        <input type="text" class="left w448 p9" name="email_confirmation" value="Re-enter your@email.com"/>
                        <div class="tab-input-border cream"></div>
                    </div>
                    <div class="left w475 mt18">
                        <div class="tab-input-border blue-dark"></div>
                        <input type="submit" class="left w466 p9 blue-dark cream-font bold" value="Download Now"/>
                        <div class="tab-input-border blue-dark"></div>
                    </div>
                </div>
            </div>
            <div id="download-templateNow" class="one-whole left" style="<?php echo ($login_status == "FALSE"?'display:none;':''); ?>">
                <div class="tab-textarea-border cream"></div>
                <textarea class="left w940 h120 mt18 p9" id="templateTextarea"><?php echo $template; ?></textarea>
                <div class="left one-whole mt18">
                    <div class="tab-input-border black"></div>
                    <input type="button" class="left w956 p9 black cream-font bold" id="copyToClipboard" value="Click To Highlight HTML"/>
                    <div class="tab-input-border black"></div>
                </div>
            </div>
        </div>
    </section>
</form>
</article>
<div class="clearer"></div>
<!-- End Contact Form -->