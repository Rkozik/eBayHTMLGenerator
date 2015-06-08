<?php
# =============
# Content: Home
# =============
#
?>
<!-- Flavor Text -->
<main>
    <div id="main-wrapper">
        <section class="one-half left">
            <p>
                Just like so many of you out there I've got a ton of valuable items stashed around my house that
                haven't been used in god knows when, so I swung on over to eBay for the first time in roughly a decade to
                put my belongings up for auction. Go figure, they made listing an item easier just to leave the default
                design looking like a sketchy Craigslist post.
            </p>
            <p>
                <span class="dropcap1 dropcap2">Q:</span> If you walked into a shop's electronics section and their display hasn't been maintained or updated since the late
                1990s are you really going to be eager to get your wallet out?
            </p>
        </section>
        <section class="one-half left first-col">
            <p>
                <span class="dropcap1 dropcap2">A:</span> Not a chance, nobody would. Marketing departments know that professional-looking design sells, and that's
                why I put aside the time to create this eBay HTML template generator.
            </p>
            <p>
                Your things are worth money, and <span class="underline-dotted">people on eBay are looking for deal. But that doesn't mean you should let them
                    take you for a ride.</span> Our eBay HTML template generator gives you the freedom to create beautiful customized eBay listings that will
                earn you top dollar for very little effort on your own part. No sign-up necessary.
            </p>
        </section>
        <?php if(!isset($login_status) || $login_status==false): ?>
        <section class="one-whole left">
            <p>Just complete each tabbed section below and hit 'preview' or keep hitting 'next', but if you only want to do a little bit of it now or comeback with a fresh set of eyes to refine your custom eBay HTML template you'll need to <a id="createAccount-link" href="<?php echo base_url().'create-new-account/'; ?>" title="Register new account">register an account</a>.</p>
        </section>
        <?php endif; ?>
    </div>
</main>
<div class="clearer"></div>
<!-- Tabbed Navigation -->
<nav id="middle-bar">
    <div id="tab-wrapper">
        <!-- current tab -->
        <div class="tab-border black" id="tbl-0"></div>
        <div class="tab-content black" id="tab-0">
            <span class="tab-title cream-font">Description</span>
        </div>
        <div class="divider-tab" id="tbr-0"></div>
        <!-- 2 -->
        <div id="tbl-1"></div>
        <div class="tab-content black" id="tab-1">
            <span class="tab-title cream-font">Features</span>
        </div>
        <div class="divider-tab" id="tbr-1"></div>
        <!-- 3 -->
        <div id="tbl-2"></div>
        <div class="tab-content black" id="tab-2">
            <span class="tab-title cream-font">Photos</span>
        </div>
        <div class="divider-tab" id="tbr-2"></div>
        <!-- 3 -->
        <div id="tbl-3"></div>
        <div class="tab-content black" id="tab-3">
            <span class="tab-title cream-font">Specifications</span>
        </div>
        <div class="divider-tab" id="tbr-3"></div>
        <!-- Third Tab -->
        <div id="tbl-4"></div>
        <div class="tab-content black" id="tab-4">
            <span class="tab-title cream-font">Shipping</span>
        </div>
        <div class="tab-border black" id="tbr-4"></div>
        <!-- Second Tab -->
        <div class="tab-border blue-dark" id="tbl5"></div>
            <div class="tab-content blue-dark" id="editor-submit">
                <span class="tab-title cream-font" title="Preview eBay Template">Preview</span>
            </div>
        <div class="tab-border blue-dark" id="tbr5"></div>
    </div>


</nav>
<!-- Tabbed Item One -->

<article>
    <?php
    $validationError_firstHalf = '<div class="validationError-container"><div class="tab-input-border dark-grey"></div><div class="validationError-icon-container"><div class="validationError-icon"></div></div><div class="fullWidth-validationError" ><p>';
    $validationError_secondHalf = '</p></div><div class="validationError-closeBtn-container"><input type="button" class="validationError-removeBtn"/></div><div class="tab-input-border dark-grey"></div></div><div class="clearer"></div>';

    $attributes = array('class'=>'tab-content-wrapper','id'=>'editor');
    echo form_open('home/',$attributes);
    ?>