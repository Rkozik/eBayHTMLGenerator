<?php
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
?>
<iframe id="livePreview" src="<?php echo base_url(); ?>index.php/preview/ebayContainer/"></iframe>
<nav id="middle-bar" style="background:none;padding-top:0;margin-top:-28px;">
    <div id="tab-wrapper" class="w1067">
        <!-- current tab -->
        <div class="previewTab">
            <div class="tab-border black" id="tbl-0"></div>
            <div class="tab-content black" id="tab-0">
                <span class="tab-title" id="tc0">Template Options</span>
            </div>
            <div class="tab-border black" id="tbr-0"></div>
        </div>
        <div class="previewTab">
            <div class="tab-border black" id="tbl-1"></div>
            <div class="tab-content black" id="tab-1">
                <span class="tab-title" id="tc1">Title Bar</span>
            </div>
            <div class="divider-tab" id="tbr-1"></div>
        </div>
        <div class="previewTab">
            <div id="tbl-2"></div>
            <div class="tab-content black" id="tab-2">
                <span class="tab-title" id="tc2">Specifications Table</span>
            </div>
            <div class="tab-border black" id="tbr-2"></div>
        </div>
        <div id="toggleTabs">
            <div class="tab-border dark-grey" id="tbl3"></div>
            <div class="tab-content-toggle dark-grey" id="t3">
                <span class="tab-title cream-font" id="toggleTabs_text">Show Options</span>
            </div>
            <div class="tab-border dark-grey" id="tbr3"></div>
        </div>

    </div>
</nav>
<footer id="previewOptions-container">
    <?php //var_dump($session_data["temp_template"]);?>
    <form method="post" action="<?php echo base_url(); ?>index.php/preview/" class="ma w1067">
        <section id="s0">
            <div id="templateOptions-row_0">
                <!-- Background Color (Left) -->
                <div class="left mt18">
                    <div class="tab-input-border white"></div>
                    <div id="templateOptions-row_0-backgroundColorLeft-pos_1" class="left swatch" style="background-color:<?php echo $themeSelection["TemplateOptions"]["BackgroundColorLeft"]; ?>;"></div>
                    <div class="tab-input-border white"></div>
                </div>
                <div class="left mt18 ml10">
                    <div class="tab-input-border white"></div>
                    <input type="text" name="templateOptions-backgroundColorLeft-input" class="left w452 p9 white" value="Background Color (Left): <?php echo $themeSelection["TemplateOptions"]["BackgroundColorLeft"]; ?>"/>
                    <div class="tab-input-border white"></div>
                </div>
                <!-- Font Color (Left) -->
                <div class="left mt18 ml10">
                    <div class="tab-input-border white"></div>
                    <div id="templateOptions-row_0-fontColorLeft-pos_2" class="left swatch" style="background-color:<?php echo $themeSelection["TemplateOptions"]["FontColorLeft"]; ?>;"></div>
                    <div class="tab-input-border white"></div>
                </div>
                <div class="left mt18 ml10">
                    <div class="tab-input-border white"></div>
                    <input type="text" name="templateOptions-fontColorLeft-input" class="left w452 p9 white" value="Font Color (Left): <?php echo $themeSelection["TemplateOptions"]["FontColorLeft"]; ?>"/>
                    <div class="tab-input-border white"></div>
                </div>
            </div>

            <div id="templateOptions-row_1">
                <!-- Background Color (Left) -->
                <div class="left mt18">
                    <div class="tab-input-border white"></div>
                    <div id="templateOptions-row_1-backgroundColorRight-pos_1" class="left swatch" style="background-color:<?php echo $themeSelection["TemplateOptions"]["BackgroundColorRight"]; ?>;"></div>
                    <div class="tab-input-border white"></div>
                </div>
                <div class="left mt18 ml10">
                    <div class="tab-input-border white"></div>
                    <input type="text" name="templateOptions-backgroundColorRight-input" class="left w452 p9 white" value="Background Color (Right): <?php echo $themeSelection["TemplateOptions"]["BackgroundColorRight"]; ?>"/>
                    <div class="tab-input-border white"></div>
                </div>
                <!-- Font Color (Left) -->
                <div class="left mt18 ml10">
                    <div class="tab-input-border white"></div>
                    <div id="templateOptions-row_1-fontColorRight-pos_2" class="left swatch" style="background-color:<?php echo $themeSelection["TemplateOptions"]["FontColorRight"]; ?>;"></div>
                    <div class="tab-input-border white"></div>
                </div>
                <div class="left mt18 ml10">
                    <div class="tab-input-border white"></div>
                    <input type="text" name="templateOptions-fontColorRight-input" class="left w452 p9 white" value="Font Color (Right): <?php echo $themeSelection["TemplateOptions"]["FontColorRight"]; ?>"/>
                    <div class="tab-input-border white"></div>
                </div>
            </div>

            <div id="templateOptions-row_2">
                <div class="left mt18">
                    <div class="left">
                        <div class="tab-input-border white"></div>
                        <input type="text" name="templateOptions-fontFamily" class="left w1030 white p9"  value="Font-Family:<?php echo $themeSelection["TemplateOptions"]["FontFamily"]; ?>"/>
                        <div class="tab-input-border white"></div>
                    </div>
                </div>
            </div>
        </section>

        <section id="s1">
            <div id="titleBar-row_0">
                <div class="left mt18">
                    <div class="left">
                        <div class="tab-input-border white"></div>
                        <div id="titleBar-row_0-backgroundColor-pos_1" class="left swatch" style="background-color:<?php echo $themeSelection["TitleBar"]["BackgroundColor"]; ?>;"></div>
                        <div class="tab-input-border white"></div>
                    </div>
                    <div class="left ml10">
                        <div class="tab-input-border white"></div>
                        <input type="text" name="titleBar-backgroundColor-input" class="left w984 p9 white" value="Background Color: <?php echo $themeSelection["TitleBar"]["BackgroundColor"]; ?>"/>
                        <div class="tab-input-border white"></div>
                    </div>
                </div>
            </div>

            <div id="titleBar-row_1">
                <div class="left mt18">
                    <div class="left">
                        <div class="tab-input-border white"></div>
                        <div id="titleBar-row_1-fontColor-pos_1" class="left swatch" style="background-color:<?php echo $themeSelection["TitleBar"]["FontColor"]; ?>;"></div>
                        <div class="tab-input-border white"></div>
                    </div>
                    <div class="left ml10">
                        <div class="tab-input-border white"></div>
                        <input type="text" name="titleBar-fontColor-input" class="left w984 p9 white" value="Font Color: <?php echo $themeSelection["TitleBar"]["FontColor"]; ?>"/>
                        <div class="tab-input-border white"></div>
                    </div>
                </div>
            </div>
        </section>

        <section id="s2">
            <div id="specificationsTable-row_0">
                <div class="left mt18">
                    <div class="left">
                        <div class="tab-input-border white"></div>
                        <div id="specificationsTable-row_0-backgroundColorLeft-pos_1" class="left swatch" style="background-color:<?php echo $themeSelection["SpecificationsTable"]["BackgroundColorLeft"]; ?>;"></div>
                        <div class="tab-input-border white"></div>
                    </div>
                    <div class="left ml10">
                        <div class="tab-input-border white"></div>
                        <input type="text" name="specificationsTable-backgroundColorLeft-input" class="left w452 white p9" value="Background Color (Left): <?php echo $themeSelection["SpecificationsTable"]["BackgroundColorLeft"]; ?>"/>
                        <div class="tab-input-border white"></div>
                    </div>

                    <div class="left ml10">
                        <div class="tab-input-border white"></div>
                        <div id="specificationsTable-row_0-fontColorLeft-pos_2" class="left swatch" style="background-color:<?php echo $themeSelection["SpecificationsTable"]["FontColorLeft"]; ?>;"></div>
                        <div class="tab-input-border white"></div>
                    </div>
                    <div class="left ml10">
                        <div class="tab-input-border white"></div>
                        <input type="text" name="specificationsTable-fontColorLeft-input" class="left w452 white p9" value="Font Color (Left): <?php echo $themeSelection["SpecificationsTable"]["FontColorLeft"]; ?>"/>
                        <div class="tab-input-border white"></div>
                    </div>
                </div>
            </div>
            <div id="specificationsTable-row_1">
                <div class="left mt18">
                    <div class="left">
                        <div class="tab-input-border white"></div>
                        <div id="specificationsTable-row_1-backgroundColorRight-pos_1" class="left swatch" style="background-color:<?php echo $themeSelection["SpecificationsTable"]["BackgroundColorRight"]; ?>;"></div>
                        <div class="tab-input-border white"></div>
                    </div>
                    <div class="left ml10">
                        <div class="tab-input-border white"></div>
                        <input type="text" name="specificationsTable-backgroundColorRight-input" class="left w452 white p9" value="Background Color (Right): <?php echo $themeSelection["SpecificationsTable"]["BackgroundColorRight"]; ?>"/>
                        <div class="tab-input-border white"></div>
                    </div>

                    <div class="left ml10">
                        <div class="tab-input-border white"></div>
                        <div id="specificationsTable-row_1-fontColorRight-pos_2" class="left swatch" style="background-color:<?php echo $themeSelection["SpecificationsTable"]["FontColorRight"]; ?>;"></div>
                        <div class="tab-input-border white"></div>
                    </div>
                    <div class="left ml10">
                        <div class="tab-input-border white"></div>
                        <input type="text" name="specificationsTable-fontColorRight-input" class="left w452 white p9" value="Font Color (Right): <?php echo $themeSelection["SpecificationsTable"]["FontColorRight"]; ?>"/>
                        <div class="tab-input-border white"></div>
                    </div>
                </div>
            </div>
        </section>

        <div class="left mt18">
            <div class="tab-input-border black"></div>
            <input type="submit" class="left w1048 p9 black bold cream-font pointer" value="Click Here To Update Template"/>
            <div class="tab-input-border black"></div>
        </div>
    </form>
        <form method="post" action="<?php echo base_url(); ?>index.php/preview/resetTemplateOptions/" class="ma w1067">
            <div class="left mt18">
                <div class="tab-input-border dark-grey"></div>
                <input type="submit" class="left w1048 p9 dark-grey bold cream-font pointer" value="Revert To Default Options"/>
                <div class="tab-input-border dark-grey"></div>
            </div>
        </form>
</footer>
</body>
</html>
