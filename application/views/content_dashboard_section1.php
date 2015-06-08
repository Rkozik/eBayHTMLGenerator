<section id="s1">
    <?php
    $validationError_firstHalf =    '<div class="validationError-container" id="errorDescription"><div class="tab-input-border dark-grey"></div><div class="validationError-icon-container"><div class="validationError-icon"></div></div><div class="fullWidth-validationError" ><p>';
    $validationError_secondHalf =   '</p></div><div class="validationError-closeBtn-container"><input type="button" class="validationError-removeBtn"/></div><div class="tab-input-border dark-grey"></div></div><div class="clearer"></div>';
    $sellerNotes_default =          "Write a little bit about the condition of the item you're listing.\r\n".
        "For example,\r\n".
        "\r\n".
        "Only used like once or twice, and aside from a minor cosmetic blemish the unit is like-new. Also, I went ahead included a couple of 1/4 inch to 8mm cables that are perfect for getting audio to(and from) your computer.\r\n".
        "\r\n".
        '* NOTE: We call the text in this box, "Seller Notes".';

        $attributes = array('class'=>'tab-content-wrapper');
/*
        echo '<pre>';
        var_dump($savedTemplates);
        echo '</pre>';
*/
        $total_templates = count($templateNames);
        $archivePages = ceil(($total_templates/6));
        $start_keys = array();

        for($p=0;$p<$archivePages;$p++)
        {
            $start_keys[$p] = ($p != 0 ?$start_keys[$p-1] + 6:0);
        }

    function getItemsOnPage($pageNumber,$archivePages,$total_templates)
    {
        $full_page = ($pageNumber+1)*6;
        return ($full_page>$total_templates?$total_templates:$full_page);
    }

    //var_dump($templateNames);
    ?>
    <?php echo form_error('templateSelection_id', $validationError_firstHalf, $validationError_secondHalf); ?>
    <?php echo form_error('templateSelection_name', $validationError_firstHalf, $validationError_secondHalf); ?>
    <?php echo form_open('dashboard/loadTemplate/',$attributes);?>
    <div class="mt18">
        <div class="tab-input-border dark-grey left"></div>
        <input type="submit" class="w196 p9 dark-grey bold cream-font left pointer" value="Load Template"/>
        <div class="tab-input-border dark-grey left"></div>
    </div>
    <div class="mt18 ml10">
        <input type="hidden" name="templateSelection_id" id="open-templateId" value= "<?php echo $currentTemplateName;?>"/>
        <div class="tab-input-border cream right"></div>
        <input type="text" class="w722 p9 disabled right" name="templateSelection_name" id="open-template" disabled="disabled" value="<?php echo "Currently working on: ".($currentTemplateName==""?"An unsaved template.":$currentTemplateName); ?>"/>
        <div class="tab-input-border cream right"></div>
    </div>
    <div class="clearer"></div>


    <div id="archives-container">
        <div id="archives-heading-container">
            <div class="archives-heading-border"></div>
            <div class="archives-cell" id="archives-heading-id">Id</div>
            <div class="archives-cell-divider"></div>
            <div class="archives-cell" id="archives-heading-date">Date</div>
            <div class="archives-cell-divider"></div>
            <div class="archives-cell" id="archives-heading-name">Listing Name</div>
            <div class="archives-cell-divider"></div>
            <div class="archives-cell" id="archives-heading-delete">Choose One</div>
            <div class="archives-heading-border"></div>
        </div>
        <div class="clearer"></div>
        <?php for($page=0;$page<$archivePages;$page++):?>
        <div id="archives-page-<?php echo $page; ?>" <?php echo ($page!=0?' style="display:none;"':''); ?>>
            <?php for($i=$start_keys[$page];$i<($start_keys[$page]+6);$i++): ?>
                <div class="archives-row-container" <?php echo (isset($templateNames[$i])?' id="archive-row-'.$i.'"':""); ?>>
                    <div class="archives-cell archives-row-id"><?php echo (isset($templateNames[$i])?$i+1:""); ?></div>
                    <div class="archives-cell-divider"></div>
                    <div class="archives-cell archives-row-date"><?php echo (isset($templateNames[$i])?$savedTemplates[$templateNames[$i]]["notes"][0]["time"]:""); ?></div>
                    <div class="archives-cell-divider"></div>
                    <div class="archives-cell archives-row-name" ><?php echo (isset($templateNames[$i])?'<span id="template-'.$i.'">'.$templateNames[$i]."</span>":""); ?></div>
                    <div class="archives-cell-divider"></div>
                    <div class="archives-cell archives-row-delete">
                        <?php if(isset($templateNames[$i])): ?>
                            <p class="radio" style="width:24px;">
                                <input type="radio" name="select-archiveTemplate" id="archive-radio-<?php echo $i; ?>" value="<?php echo $i; ?>" <?php echo ($templateNames[$i]==$currentTemplateName?'checked="checked"':""); ?>/>
                                <label for="archive-radio-<?php echo $i; ?>" style="margin:-2px 0 0 44px;"></label>
                            </p>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="clearer"></div>
            <?php endfor; ?>
            <div class="left w960 mt18">
                <input type="button" class="<?php echo ($page-1==-1?'':"previous-page"); ?> archives-pagination <?php echo ($page-1==-1?'page-previousNone':'page-previousTrue'); ?>" id="page-<?php echo ($page-1==-1?"NA":$page-1); ?>" <?php echo ($page-1==-1?'disabled="disabled"':""); ?>  title="<?php echo ($page-1==-1?'You are on page one!':'Previous page.'); ?>"/>
                <span class="archives-page-number">Displaying <?php echo getItemsOnPage($page,$archivePages,$total_templates); ?> of <?php echo count($templateNames); ?> Saved Templates</span>
                <input type="button" class=" <?php echo (($page+1)<=($archivePages-1)?"next-page":''); ?> archives-pagination <?php echo (($page+1)<=($archivePages-1)?"page-nextTrue":'page-nextNone'); ?>" id="page-<?php echo (($page+1)<=($archivePages-1)?$page+1:"NA"); ?>" <?php echo (($page+1)<=($archivePages-1)?"":'disabled="disabled"'); ?> title="<?php echo (($page+1)<=($archivePages-1)?"Next page.":'You are on the last page!'); ?> " />
            </div>
        </div>
        <?php endfor; ?>
    </div>
    <?php echo form_close(); ?>
</section>