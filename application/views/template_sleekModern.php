<?php
$totalFeatures = count($features["features"]);
$totalSpecifications = count($specifications["title"]);
$totalFAQ = count($FAQ["question"]);

$themeSelection = array
(
    'TitleBar' => array
    (
        'BackgroundColor' => (strlen($themeOptions["titleBar"]["BackgroundColor"])>0?
                              $themeOptions["titleBar"]["BackgroundColor"]:
                              $theme["default"]["titleBar"]["BackgroundColor"])
                              ,
        'FontColor' => (strlen($themeOptions["titleBar"]["FontColor"])>0?
                        $themeOptions["titleBar"]["FontColor"]:
                        $theme["default"]["titleBar"]["FontColor"])
    ),
    'SpecificationsTable' => array
    (
        'BackgroundColorRight' => (strlen($themeOptions["specificationsTable"]["BackgroundColorRight"])>0?
                                   $themeOptions["specificationsTable"]["BackgroundColorRight"]:
                                   $theme["default"]["specificationsTable"]["BackgroundColorRight"])
                                   ,
        'FontColorRight' => (strlen($themeOptions["specificationsTable"]["FontColorRight"])>0?
                             $themeOptions["specificationsTable"]["FontColorRight"]:
                             $theme["default"]["specificationsTable"]["FontColorRight"])
                             ,
        'BackgroundColorLeft' => (strlen($themeOptions["specificationsTable"]["BackgroundColorLeft"])>0?
                                  $themeOptions["specificationsTable"]["BackgroundColorLeft"]:
                                  $theme["default"]["specificationsTable"]["BackgroundColorLeft"])
                                  ,
        'FontColorLeft' => (strlen($themeOptions["specificationsTable"]["FontColorLeft"])>0?
                            $themeOptions["specificationsTable"]["FontColorLeft"]:
                            $theme["default"]["specificationsTable"]["FontColorLeft"])

    ),
    'TemplateOptions' => array
    (
        'BackgroundColorRight' => (strlen($themeOptions["templateOptions"]["BackgroundColorRight"])>0?
                                   $themeOptions["templateOptions"]["BackgroundColorRight"]:
                                   $theme["default"]["templateOptions"]["BackgroundColorRight"])
                                   ,
        'FontColorRight' => (strlen($themeOptions["templateOptions"]["FontColorRight"])>0?
                             $themeOptions["templateOptions"]["FontColorRight"]:
                             $theme["default"]["templateOptions"]["FontColorRight"])
                             ,
        'BackgroundColorLeft' => (strlen($themeOptions["templateOptions"]["BackgroundColorLeft"])>0?
                                  $themeOptions["templateOptions"]["BackgroundColorLeft"]:
                                  $theme["default"]["templateOptions"]["BackgroundColorLeft"])
                                  ,
        'FontColorLeft' => (strlen($themeOptions["templateOptions"]["FontColorLeft"])>0?
                            $themeOptions["templateOptions"]["FontColorLeft"]:
                            $theme["default"]["templateOptions"]["FontColorLeft"])
                            ,
        'FontFamily' => (strlen($themeOptions["templateOptions"]["FontFamily"])>0?
                         $themeOptions["templateOptions"]["FontFamily"]:
                         $theme["default"]["templateOptions"]["FontFamily"])
    )
);

$photosExist = (isset($photos["photos"][0])&&strlen($photos["photos"][0])>0?TRUE:FALSE);
$showImgOpen = "var thumbnailContainer = document.getElementsByClassName('photo-thumbnail');var largeContainer = document.getElementById('photo-large-container');var largePhoto = document.getElementById('photo-large');var imageSource = '";
$showImgClose = "';for(var i=0;i<thumbnailContainer.length;i++) {thumbnailContainer[i].style.display = 'none';}largePhoto.setAttribute('src', imageSource);largeContainer.style.display = 'block';";
$hideImg = "var thumbnailContainer = document.getElementsByClassName('photo-thumbnail');var largeContainer = document.getElementById('photo-large-container');largeContainer.style.display = 'none';for(var i=0;i<thumbnailContainer.length;i++){thumbnailContainer[i].style.display = '';}";

$paymentOptionsExist = (isset($description["paymentOptions"][0])&&strlen($description["paymentOptions"][0])>0?TRUE:FALSE);
?>
<!DOCTYPE html>
<html>
<head>
    <title></title>
    <style>
        *{padding:0;margin:0;line-height:0;}
        body{font-family:<?php echo $themeSelection["TemplateOptions"]["FontFamily"]; ?>;}
        h3{padding:8px 24px 8px 8px;margin-top:9px;text-align:right;color:<?php echo $themeSelection["TemplateOptions"]["FontColorLeft"]; ?>;}
        p{padding:8px 8px 8px 16px;font-weight:normal;font-size:1em;line-height:1.4em;}
        table{background:<?php echo $themeSelection["TemplateOptions"]["BackgroundColorLeft"]; ?>;width:100%;}
        li{margin-left:16px;}
        a{color:<?php echo $themeSelection["TemplateOptions"]["BackgroundColorLeft"]; ?>;font-weight:bold;}

        #wrapper{float:left;background:#f5f5eb;width:100%;margin:auto;}
        #title-header{
            float:left;
            background:<?php echo $themeSelection["TitleBar"]["BackgroundColor"]; ?>;
            color:<?php echo $themeSelection["TitleBar"]["FontColor"]; ?>;
            width:100%;
            padding:24px 0 24px 24px;
        }
        #titleH2{color:<?php echo $themeSelection["TemplateOptions"]["FontColorLeft"]; ?>;font-size:1.35em;font-weight:normal;}

        .item-name{float:left;color:#4a4a4a;width:30%;vertical-align:top;}
        .item-description{
            float:left;
            background:<?php echo $themeSelection["TemplateOptions"]["BackgroundColorRight"]; ?>;
            color:<?php echo $themeSelection["TemplateOptions"]["FontColorRight"]; ?>;
            width:70%;
            vertical-align:top;
        }
        .tr-background{background:<?php echo $themeSelection["TemplateOptions"]["BackgroundColorLeft"]; ?>;}
        #tr-noBackground{background:none;}

        .clearer{clear:both;}
        .underline{text-decoration:underline;}

        .psuedoTdRight{float:left;width:30%;background:<?php echo $themeSelection["SpecificationsTable"]["BackgroundColorLeft"]; ?>;margin-left:16px;padding-right:16px;color:#ffffff;font-weight:bold;text-align:right;}
        .psuedoTdLeft{float:left;width:57%;background:<?php echo $themeSelection["SpecificationsTable"]["BackgroundColorRight"]; ?>;margin-right:16px;font-weight:bold;}

        #item-name-photos{padding-top:8px;}
        #photo-thumbnail-container{float:left;margin:22px 8px 8px 16px; max-width:661px;}
        .photo-thumbnail{border:4px solid <?php echo $themeSelection["SpecificationsTable"]["BackgroundColorLeft"]; ?>;cursor:pointer;float:left;margin-left:16px;padding:4px;}
        .photo-thumbnail:hover{border:4px solid <?php echo $themeSelection["TemplateOptions"]["BackgroundColorLeft"]; ?>;}
        .thumbnail-first{margin-left:0 !important;}
        .thumbnail-notRowOne{margin-top:16px;}

        #photo-large-container{border:4px solid <?php echo $themeSelection["SpecificationsTable"]["BackgroundColorLeft"]; ?>;cursor:pointer;display:none;float:left;padding:4px;}
        #photo-large-container:hover{border:4px solid <?php echo $themeSelection["TemplateOptions"]["BackgroundColorLeft"]; ?>;}
    </style>
</head>
<body>
<?php //var_dump($themeOptions); ?>
<table cellspacing="0" cellpadding="0" border="0" id="title-header">
    <tr id="tr-noBackground">
        <td>
            <span id="titleH2"><?php echo $description["title"]; ?></span>
        </td>
    </tr>
</table>
<table cellspacing="0" cellpadding="0" border="0" id="wrapper">
        <!-- PHOTOS -->
        <?php if($photos["toggle"]=="true" && $photosExist == TRUE): ?>
        <tr class="tr-background">
            <td id="item-name-photos" class="item-name">
                <h3 class="underline">Additional Photos</h3>
            </td>
            <td class="item-description">
                <div id="photo-thumbnail-container">
                    <div id="photo-large-container" onclick="<?php echo $hideImg; ?>">
                        <img id="photo-large" src="" width="644" title="Click To Close"/>
                    </div>
                    <?php for($photos_i=0;$photos_i<count($photos["photos"]);$photos_i++): ?>
                        <?php if($photos_i<3): ?>
                        <div class="photo-thumbnail <?php echo ($photos_i == 0 ? "thumbnail-first":""); ?>" onclick="<?php echo $showImgOpen.$photos["photos"][$photos_i].$showImgClose; ?>">
                            <img src="<?php echo $photos["photos"][$photos_i]; ?>" width="193" height="193" title="Click To Expand"/>
                        </div>
                        <?php endif; ?>
                        <?php if($photos_i>=3):?>
                        <div class="photo-thumbnail <?php echo (is_int($photos_i/3)?"thumbnail-first thumbnail-notRowOne":"thumbnail-notRowOne"); ?>" onclick="<?php echo $showImgOpen.$photos["photos"][$photos_i].$showImgClose; ?>">
                            <img src="<?php echo $photos["photos"][$photos_i]; ?>" width="193" height="193" title="Click To Expand"/>
                        </div>
                        <?php endif; ?>
                    <?php endfor; ?>
                </div>
            </td>
        </tr>
        <?php endif; ?>

        <!-- ITEM INTRODUCTION :: DESCRIPTION -->
        <?php if($description["toggle"]=="true"): ?>
        <tr class="tr-background">
            <td class="item-name">
                <h3 class="underline" <?php echo ($photos["toggle"]=="true"?"":'style="padding-top:20px;"'); ?>>Seller Notes</h3>
            </td>
            <td class="item-description">
                <p <?php echo ($photos["toggle"]=="true"?"":'style="padding-top:20px;"'); ?>>
                    <?php echo $description["sellerNotes"]; ?>
                </p>
            </td>
        </tr>
        <?php endif; ?>

        <!-- ITEM INTRODUCTION :: DESCRIPTION -->
        <?php if($features["toggle"]=="true"): ?>
        <tr class="tr-background">
            <td class="item-name">
                <h3 class="underline">Product Information</h3>
            </td>
            <td class="item-description">
                <?php for($i=0;$i<$totalFeatures;$i++): ?>
                <p>
                    <li><?php echo $features["features"][$i];?></li>
                </p>
                <?php endfor; ?>
            </td>
        </tr>
        <?php endif; ?>

        <!-- ITEM SPECIFICATIONS :: DESCRIPTION -->
        <?php if($specifications["toggle"]=="true"): ?>
        <tr class="tr-background">
            <td class="item-name">
                <h3 class="underline">Specifications</h3>
            </td>
            <td class="item-description">
                <p></p>
                <?php for($i1=0;$i1<$totalSpecifications;$i1++): ?>
                <p class="psuedoTdRight"><?php echo $specifications["title"][$i1];?></p>
                <p class="psuedoTdLeft"><?php echo $specifications["label"][$i1];?></p>
                <?php endfor; ?>
            </td>
        </tr>
        <?php endif; ?>

        <!-- SHIPPING FAQ :: DESCRIPTION -->
        <?php if($FAQ["toggle"]=="true"): ?>
            <?php for($i2=0;$i2<$totalFAQ;$i2++): ?>
            <tr class="tr-background">
                <td class="item-name" <?php echo ($i2==0 && $specifications["toggle"]=="false"?"":'style="padding-top:20px;"'); ?>>
                    <h3>Question <?php echo $i2+1;?>:</h3>
                </td>
                <td class="item-description"  <?php echo ($i2==0 && $FAQ["toggle"]=="false"?"":'style="padding-top:20px;"'); ?>>
                    <p><strong><?php echo $FAQ["question"][$i2]; ?></strong></p>
                </td>
            </tr>
            <tr class="tr-background">
                <td class="item-name">
                    <h3></h3>
                </td>
                <td class="item-description">
                    <p><?php echo $FAQ["answer"][$i2]; ?></p>
                </td>
            </tr>
            <?php endfor; ?>
        <?php endif; ?>

        <!-- RETURNS :: DESCRIPTION -->

        <?php if($paymentOptionsExist==TRUE): ?>
        <tr class="tr-background">
            <td class="item-name">
                <h3 class="underline">Payment Options</h3>
            </td>
            <td class="item-description">
                <p><strong><?php echo (!isset($description["paymentOptions"][1])?ucfirst($description["paymentOptions"][0])." only":ucfirst($description["paymentOptions"][0])." and ".ucfirst($description["paymentOptions"][1])); ?></strong></p>
            </td>
        </tr>
        <?php endif; ?>

        <tr class="tr-background">
            <td class="item-name">
                <h3></h3>
            </td>
            <td class="item-description">
                <p> </p>
            </td>
        </tr>
        <tr class="tr-background">
            <td class="item-name">
                <h3></h3>
            </td>
            <td class="item-description">
                <p>
                    <strong>Powered by:</strong> <a href="http://ebayhtmlgenerator.com/" title="eBay HTML Generator">eBay HTML Generator</a>
                </p>
            </td>
        </tr>
</table>
</body>
</html>