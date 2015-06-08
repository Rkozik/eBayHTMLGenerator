<!DOCTYPE html>
<html>
<head>
    <title>eBay HTML generator - Live Demonstration</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/main.css"/>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>public/js/liveUI.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>public/js/colorTable.js"></script>
    <script type="text/javascript">
        function resizeIframe(obj) {
            obj.style.height = obj.contentWindow.document.body.scrollHeight + 'px';
        }
    </script>
</head>
<body>
<!-- PREVIEW OPTIONS -->
<div class="clear-float"></div>
<header style="margin-top:0 !important;">

</header>
<div class="clear-float"></div>
<main>
    <ul id="ebayListing-tab-container">
        <li id="ebayListing-tab-description">
            Description
        </li>
        <li id="ebayListing-tab-shippingPayments">
            <a href="#">Shipping and payments</a>
        </li>
    </ul>
    <div id="ebayListing-content">
        <div id="itemSpecifics-container">
            <h3 id="itemSpecifics-heading">Item specifics</h3>
            <!-- First Half -->
            <div class="itemSpecifics-oneHalf">
                <div class="itemSpecifics-col1">
                    Condition:
                </div>
                <div class="itemSpecifics-col2">
                    Used: An item that has been used previously. The item may have some signs of
                    cosmetic wear, but is fully<br>
                    <span id="itemSpecifics-smallText"><b id="itemSpecifics-bold">...</b> <a href="#">Read more</a></span>
                </div>
                <div class="clear-float"></div>
            </div>
            <!-- Second Half -->
            <div class="itemSpecifics-oneHalf">
                <div class="itemSpecifics-col1">
                    Brand:
                </div>
                <div class="itemSpecifics-col2">
                    Behringer
                </div>
                <div class="clear-float"></div>
            </div>
        </div>
        <div class="clear-float"></div>
        <div id="customHTML-container">
            <iframe src="<?php echo base_url(); ?>preview/template/<?php echo $themeSelection; ?>" id="customHTML-iframe" onload='javascript:resizeIframe(this);' scrolling="no"></iframe>
        </div>
        <div class="clear-float"></div>
        <div id="questionAnswer-container">
            <div id="questionAnswer-title">
                <h3 id="questionAnswer-heading">Questions and answers about this item</h3>
            </div>
            <div id="questionAnswer-404">
                No questions or answers have been posted about this item.
            </div>
            <div id="questionAnswer-askQuestion">
                <a href="#">Ask a question</a>
            </div>
        </div>
        <div class="clear-float"></div>
    </div>
    <div class="clear-float"></div>
</main>
</body>
</html>