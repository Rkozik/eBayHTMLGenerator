<?php
$validationError_firstHalf = '<div class="validationError-container"><div class="tab-input-border dark-grey"></div><div class="validationError-icon-container"><div class="validationError-icon"></div></div><div class="fullWidth-validationError" ><p>';
$validationError_secondHalf = '</p></div><div class="validationError-closeBtn-container"><input type="button" class="validationError-removeBtn"/></div><div class="tab-input-border dark-grey"></div></div><div class="clearer"></div>';

$attributes = array('class'=>'tab-content-wrapper');
?>
<nav id="top-bar">
    <section class="one-half left">
        <a href="<?php echo base_url(); ?>" class="underline-off">
            <h1 class="cream-font">eBay &lt;html&gt; Generator</h1>
        </a>
    </section>
    <section class="one-half right">
        <h1 class="cream-font textAlign-right">Sign-in :: eBay HTML Template</h1>
    </section>
</nav>
<div class="clearer"></div>
<!-- Breadcrumbs -->
<nav id="breadcrumbs">

</nav>
<!-- Flavor Text -->
<main class="mt0 p9">

</main>
<div class="clearer"></div>
<!-- Tabbed Navigation -->
<nav id="middle-bar">
    <div id="tab-wrapper">
        <!-- current tab -->
        <div class="tab-border grey" id="tbl-0"></div>
        <div class="tab-content grey" id="tab-0">
            <span class="tab-title cream-font">Sign-in</span>
        </div>
        <div class="tab-border grey" id="tbr-0"></div>
        <!-- 2 -->
        <div class="tab-border black" id="tbl1"></div>
        <a href="<?php echo base_url().'create-new-account'; ?>" title="Recover your password.">
            <div class="tab-content black" id="t1">
                <span class="tab-title cream-font">Forgot Password</span>
            </div>
        </a>
        <div class="tab-border black" id="tbr1"></div>
        <div class="tab-border blue-dark" id="tbl2"></div>
        <a href="<?php echo base_url().'create-new-account'; ?>" title="Create a new account.">
            <div class="tab-content blue-dark">
                <span class="tab-title cream-font" title="Create New Account">Create New Account</span>
            </div>
        </a>

        <div class="tab-border blue-dark" id="tbr2"></div>
    </div>
</nav>
<!-- Begin Contact Form -->
<article>
        <section id="s0">
        <?php echo form_open('login/', $attributes); ?>
            <?php echo (isset($login_error)?$validationError_firstHalf.$login_error.$validationError_secondHalf:""); ?>
            <?php echo form_error('username', $validationError_firstHalf, $validationError_secondHalf); ?>
            <div class="clearer"></div>
            <div class="mt18">
                <div class="tab-input-border cream"></div>
                <input type="text" class="left w938 p9" name="username" value="Username"/>
                <div class="tab-input-border cream"></div>
            </div>
            <?php echo form_error('password', $validationError_firstHalf, $validationError_secondHalf); ?>
            <div class="clearer"></div>
            <div class="mt18">
                <div class="tab-input-border cream"></div>
                <input type="password" class="left w938 p9 cream" name="password" value="password"/>
                <div class="tab-input-border cream"></div>
            </div>
            <div class="clearer"></div>
            <div class="mt18">
                <div class="tab-input-border dark-grey"></div>
                <a href="<?php echo base_url().'contact-us';?>" title="If you're stuck, shoot me an email!">
                    <input type="button" class="left w465 p9 dark-grey cream-font bold pointer" value="Having trouble logging on?"/>
                </a>
                <div class="tab-input-border dark-grey"></div>
                <div class="tab-input-border black ml12"></div>
                <input type="submit" class="left w475 p9 black cream-font bold pointer" value="Sign-in"/>
                <div class="tab-input-border black"></div>
            </div>
        <?php echo form_close(); ?>
        </section>
</article>
<div class="clearer"></div>
<!-- End Contact Form -->