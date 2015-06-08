        <section id="s2">
            <?php
            $attributes = array('class'=>'tab-content-wrapper');
            /*
                    echo '<pre>';
                    var_dump($savedTemplates);
                    echo '</pre>';
            */
            ?>
            <div class="tab-content-wrapper">
                <div class="mt18">
                    <div class="tab-input-border cream"></div>
                    <input type="text" class="left w722 p9 disabled" disabled="disabled" value="<?php echo ($currentTemplateName==""?"Currently loaded: Unsaved Template":"Currently loaded: ".$currentTemplateName); ?>"/>
                    <div class="tab-input-border cream"></div>
                </div>
                <div class="mt18 ml10">
                    <div class="tab-input-border black right"></div>
                    <input type="button" class="w196 p9 black bold cream-font right pointer" id="changeTemplate" value="Change Template"/>
                    <div class="tab-input-border black right"></div>
                </div>
                <div class="clearer"></div>
                <div class="left one-whole mt18">
                    <div class="tab-textarea-border cream mt2"></div>
                    <textarea class="left w940 h120 p9" id="templateTextarea"><?php echo ($currentTemplateName==""?"":$template); ?></textarea>
                </div>
                <div class="clearer"></div>
                <div class="left one-whole mt18">
                    <div class="tab-input-border black"></div>
                    <input type="button" class="left w956 p9 black cream-font bold" id="copyToClipboard" value="Click To Highlight HTML"/>
                    <div class="tab-input-border black"></div>
                </div>
            </div>
        </section>
</article>