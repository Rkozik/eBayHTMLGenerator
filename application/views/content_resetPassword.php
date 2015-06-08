<?php
// set fail codes
$set_failUsername = (isset($fail_username)?$fail_username:false);
$set_failEmail    = (isset($fail_email)?$fail_email:false);
$set_failMatch    = (isset($fail_match)?$fail_match:false);
$set_failReset    = (isset($fail_reset)?$fail_reset:false);

function controllerErrorSet($set_error)
{
    $validationError_firstHalf = '<div class="validationError-container"><div class="tab-input-border dark-grey"></div><div class="validationError-icon-container"><div class="validationError-icon"></div></div><div class="fullWidth-validationError" ><p>';
    $validationError_secondHalf = '</p></div><div class="validationError-closeBtn-container"><input type="button" class="validationError-removeBtn"/></div><div class="tab-input-border dark-grey"></div></div><div class="clearer"></div>';

    return ($set_error!=false?$validationError_firstHalf.$set_error.$validationError_secondHalf:'');
}
?>
<!-- Breadcrumbs -->
<nav id="breadcrumbs">
    <div id="breadcrumbs-container">
        <ul>
            <li id="breadcrumbs-home" class="li-margineNone-paddingNone"><a href="<?php echo base_url(); ?>">home</a> :: </li>
            <li id="breadcrumbs-currentPage" class="li-margineNone-paddingNone"> create account</li>
        </ul>
    </div>
</nav>
<!-- Flavor Text -->
<main style="margin-top:0">
    <div id="main-wrapper">
        <section class="one-half left">
            <p>
                The 'default' experience selling on eBay is far from seller-friendly. In fact, they've designed it in
                such a way that without coding skills your listing will look sloppy and unprofessional. Which subconsciously
                makes bidders assume two things:
            </p>
            <ul>
                <li><b>A)</b> You don't know what you're doing.</li>
                <li><b>B)</b> There might be something wrong with the item.</li>
            </ul>
            <p>
                <b class="underline-on fontWeight-normal">The only way around that issue while selling on eBay is to use templates.</b> Virtually every other web site out there
                requires you to edit HTML or pay money &ndash; not here. We handle all of that for you at no cost.
            </p>
        </section>
        <section class="one-half left first-col">
            <h2>Free eBay Templates</h2>
            <p>
                In the not so distant future we're going to offer premium eBay templates that are going to cost between $3 and $5 a piece,
                but <b class="underline-dotted fontWeight-normal">if you sign-up right now your account will be grandfathered in to recieve free eBay templates for life!</b>
            </p>
            <ul>
                <li>Create listings that will earn top dollar.</li>
                <li>Work on your eBay templates at your leisure.</li>
                <li>Easily re-list items you have previously sold.</li>
                <ul>
                    <li><em>Algorithmically driven suggestions</em></li>
                    <li><em>Swap look-and-feel in seconds</em></li>
                </ul>
                <li>We'll highlight your eBay listing's potential weak spots.</li>
            </ul>
        </section>
    </div>
</main>
<div class="clearer"></div>
<!-- Tabbed Navigation -->
<nav id="middle-bar">
    <div id="tab-wrapper">
        <!-- current tab -->
        <div class="tab-border black" id="tbl-0"></div>
        <div class="tab-content black" id="tab-0">
            <span class="tab-title cream-font">Reset Password</span>
        </div>
        <div class="tab-border black" id="tbr-0"></div>
    </div>
</nav>
<!-- Begin Sign-up Form -->
<?php
    $validationError_firstHalf = '<div class="validationError-container"><div class="tab-input-border dark-grey"></div><div class="validationError-icon-container"><div class="validationError-icon"></div></div><div class="fullWidth-validationError" ><p>';
    $validationError_secondHalf = '</p></div><div class="validationError-closeBtn-container"><input type="button" class="validationError-removeBtn"/></div><div class="tab-input-border dark-grey"></div></div><div class="clearer"></div>';
    $attributes = array('class'=>'tab-content-wrapper');
?>
<article>
    <section id="s0">
        <?php echo form_open('user/resetPassword/',$attributes); ?>

        <?php echo controllerErrorSet($set_failUsername); ?>
        <?php echo controllerErrorSet($set_failEmail); ?>
        <?php echo controllerErrorSet($set_failMatch); ?>
        <?php echo controllerErrorSet($set_failReset); ?>

        <?php echo form_error('username_forgot', $validationError_firstHalf, $validationError_secondHalf);?>
        <?php echo form_error('email_forgot', $validationError_firstHalf, $validationError_secondHalf);?>
        <div class="mt18">
            <div class="left w475">
                <div class="tab-input-border cream"></div>
                <input type="text" class="left w471 p9" name="username_forgot" value="Enter Username"/>
                <div class="tab-input-border cream"></div>
            </div>
            <div class="left w475 ml10">
                <div class="tab-input-border cream"></div>
                <input type="text" class="left w471 p9" name="email_forgot" value="Enter E-mail"/>
                <div class="tab-input-border cream"></div>
            </div>
        </div>
        <div class="clearer"></div>
        <?php echo form_error('newPassword', $validationError_firstHalf, $validationError_secondHalf);?>
        <?php echo form_error('newPasswordConf', $validationError_firstHalf, $validationError_secondHalf);?>
        <div class="mt18">
            <div class="left w475">
                <div class="tab-input-border cream"></div>
                <input type="text" class="left w471 p9" name="newPassword" value="New Password"/>
                <div class="tab-input-border cream"></div>
            </div>
            <div class="left w475 ml10">
                <div class="tab-input-border cream"></div>
                <input type="text" class="left w471 p9" name="newPasswordConf" value="Re-enter New Password"/>
                <div class="tab-input-border cream"></div>
            </div>
        </div>
        <div class="clearer"></div>
        <!-- Pseudo Fieldset -->
        <div class="fieldset-top"></div>
        <p class="fieldset-legend">Requirements</p>
        <div class="clearer"></div>
        <div style="float:left;background-color:#4a4a4a;width:960px;margin:-11px 0px 0px 0px;">
            <div class="left w956 ml2 grey">
                <div class="row mt9" id="">
                    <p class="newAccount-requirements w938 mt4">
                        You have to enter BOTH the username and its correct corresponding e-mail account.
                    </p>
                </div>
                <div class="clearer"></div>
                <div class="row">
                    <h3 class="userOptions-title">Password</h3>
                    <div class="clearer"></div>
                    <p class="newAccount-requirements">
                        Is a minimum of 8 characters in length.
                    </p>
                    <p class="newAccount-requirements">
                        Has both letters AND numbers
                    </p>
                    <p class="newAccount-requirements">
                        Dashes and underscores ARE allowed.
                    </p>
                </div>
                <div class="clearer"></div>
                <div class="row">
                    <h3 class="userOptions-title">Lost access to your e-mail account?</h3>
                    <div class="clearer"></div>
                    <p class="newAccount-requirements w938">
                        shoot me an e-mail at: <a href="mailto:support@ebayHTMLgenerator.com" class="cream-font">support@ebayHTMLgenerator.com</a>
                    </p>
                </div>
                <div class="clearer"></div>
                <div style="float:left;width:600px;padding:2px 0px 8px 8px;"></div>
            </div>
            <div class="clearer"></div>
        </div>
        <div class="clearer"></div>
        <div class="left w956 h2 ml2 black"></div>
        <div class="clearer"></div>

        <div class="mt18">
            <div class="tab-input-border dark-grey"></div>
            <input type="submit" class="left w956 p9 dark-grey cream-font bold" value="Reset Password"/>
            <div class="tab-input-border dark-grey"></div>
        </div>
        <?php echo form_close();?>
    </section>
</article>
<div class="clearer"></div>
<!-- End Sign-up Form -->