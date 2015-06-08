<?php
/**
 * Created by PhpStorm.
 * User: Bob
 * Date: 1/20/15
 * Time: 11:29 AM
 */
?>
<!-- Breadcrumbs -->
<nav id="breadcrumbs">
    <div id="breadcrumbs-container">
        <ul>
            <li id="breadcrumbs-home"><a href="<?php echo base_url(); ?>">home</a> :: </li>
            <li id="breadcrumbs-currentPage"> My Dashboard :: <?php echo "Current Template - ".$currentTemplateName; ?></li>
        </ul>
    </div>
</nav>
<!-- Flavor Text -->
<main style="margin-top:0;">
    <div id="main-wrapper">
        <section class="one-half left">
            <h2 class="mt18">Recent Updates</h2>
            <p class="">
                <span class="underline-on">April 14th, 2015 :: Version 0.10</span>
            </p>
            <p>
                Believe it or not this is what I consider to be an alpha build, and for the uninitiated that essentially
                means this website is a working proof-of-concept. While I myself have a bunch of ideas for new features I am totally open
                to any suggestions that are sent my way.
            </p>
        </section>
        <section class="one-half left first-col">
            <p class="mt18">
                Here are some of things you can look forward to in the weeks and months to come:
            </p>
            <ul>
                <li>Responsive eBay HTML templates.</li>
                <li>'Photo Carousel' preview bug fix.</li>
                <li>Schedule and post auctions directly to eBay.</li>
                <li>Photo editing and storage.</li>
            </ul>
        </section>
        <section class="one-whole left">
            <p>
                My major focus initially will be on tying up and resolving launch bugs and quirks. Stuff like the 'photo carousel bug',
                UI tweaks like hot-keys, and generally refining the experience. Have any ideas? <a href="<?php echo base_url()."contact-us";?>" class="blue-dark-font">I'd love to hear them</a>.
            </p>
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
            <span class="tab-title cream-font">Save Template</span>
        </div>
        <div class="divider-tab" id="tbr-0"></div>
        <!-- 2 -->
        <div id="tbl-1"></div>
        <div class="tab-content black" id="tab-1">
            <span class="tab-title cream-font">Load a Template</span>
        </div>
        <div class="divider-tab" id="tbr-1"></div>
        <!-- 3 -->
        <div id="tbl-2"></div>
        <div class="tab-content black" id="tab-2">
            <span class="tab-title cream-font">Get  &lt;html&gt;</span>
        </div>
        <div class="tab-border black" id="tbr-2"></div>
        <div class="tab-border blue-dark" id="tbl3"></div>
        <a href="<?php echo base_url(); ?>" title="Generate eBay HTML preview">
            <div class="tab-content blue-dark">
                <span class="tab-title cream-font">Editor</span>
            </div>
        </a>
        <div class="tab-border blue-dark" id="tbr3"></div>

    </div>

</nav>
<!-- Tabbed Item One -->

<article>