$(document).ready(function()
{
    var is_selection = 0;

    var counter  = setInterval(countdownTimer, 1000);
    var downloadFree = $('#downloadTemplate-free');
    var countdown    = 60;

    var tabCount = ($('.tab-content-toggle').length != 0?$('.tab-content').length:($('.tab-content').length)-1);
    var defaultTab = 0;
    var isOpen = 0;

    var calculateHeight = function()
    {
        var headerHeight = $('#top-bar-live').height();
        $('#livePreview').height($(window).height() - headerHeight - 10);
    };


    // Disable scroll bar (Chrome Fix)
    $('#liveBody').css("overflow","hidden");
    // Get default #livePreview iFrame height
    calculateHeight();
    // Update #livePreview iFrame height
    $(window).resize(function()
    {
        calculateHeight();
    }).load(function(){
        calculateHeight();
    });
    setDefaultTab(defaultTab);
    if(downloadFree.length>0){}


    $('#toggleTabs').live('click',function(){toggleTemplateOptions();});
    // Change tab and display corresponding <section>
    $('.tab-content').live('click',function(){
        var tabContentID = ($(this).attr('id').split('-'))[1];

        setUnselectedStyles();
        setSelectedStyles(tabContentID);
    });
    // Highlight HTML embed
    $('#copyToClipboard').live('click',function(){copyToClipboard();});

    // Download page <textarea> delay
    function countdownTimer()
    {
        countdown=countdown-1;
        if(countdown<=0)
        {
            clearInterval(counter);
            downloadFree.val("Your template is ready!");
            $('#download-templateWait').hide();
            $('#download-templateNow').fadeIn(700);
            return;
        }
        downloadFree.val("Please wait... "+countdown+" seconds");
    }
    // Toggle 'template options' menu visibility
    function toggleTemplateOptions()
    {
        var toggleTabsText  = $('#toggleTabs_text');
        var previewTabs     = $('.previewTab');

        var previewOptionsContainer = $('#previewOptions-container');
        var livePreview = $('#livePreview');

        if(isOpen===0)
        {
            var headerHeight                  = $('#top-bar-live').height() - 10;
            var previewOptionsContainerHeight = 165 + 36 + 36 + 36 + 36;
            var viewportHeight                = $(window).height();

            var livePreviewHeight = viewportHeight - (headerHeight + previewOptionsContainerHeight);

            is_selection = 0;

            previewTabs.show();
            toggleTabsText.text("Hide Options");
            previewOptionsContainer.show();
            livePreview.height(livePreviewHeight);
            isOpen = 1;
        }
        else if(isOpen===1)
        {
            previewTabs.hide();
            toggleTabsText.text("Show Options");
            calculateHeight();
            previewOptionsContainer.hide();
            isOpen = 0;
        }
        console.log(isOpen);
    }
    // Remove classes for each component of a given tab
    function removeClasses(id)
    {
        var tbl = '#tbl-'+id;
        var tab = '#tab-'+id;
        var tbr = '#tbr-'+id;

        $(tbl).removeClass();
        $(tab).removeClass();
        $(tbr).removeClass();
    }
    // Reset all tab styles onClick
    function setUnselectedStyles()
    {
        var tabContent = "tab-content black cream-font";
        var tabBorder = "tab-border black";
        var tabDivider = "divider-tab";
        var i = 0;

        if(tabCount>2)
        {
            for(i;i<tabCount;i++)
            {
                if(i==0)
                {
                    removeClasses(i);
                    $('#tbr-'+i).addClass(tabDivider);
                    $('#tab-'+i).addClass(tabContent);
                    $('#tbl-'+i).addClass(tabBorder);
                }
                if(i==1)
                {
                    removeClasses(i);
                    $('#tbr-'+i).addClass(tabDivider);
                    $('#tab-'+i).addClass(tabContent);
                }
                if(i==2)
                {
                    removeClasses(i);
                    $('#tbr-'+i).addClass(tabBorder);
                    $('#tab-'+i).addClass(tabContent);
                }
            }
        }
        else
        {
            removeClasses(0);
            removeClasses(1);

            $('#tbr-0').addClass(tabDivider);
            $('#tab-0').addClass(tabContent);
            $('#tbl-0').addClass(tabBorder);

            $('#tbr-1').addClass(tabBorder);
            $('#tab-1').addClass(tabContent);
        }
    }

    /*
     * Apply 'select' styles to a specified tab, and
     * also hide the previous <section> and fade in
     * the new one.
     */
    function setSelectedStyles(id)
    {
        var tabContent = "tab-content light-grey black-font";
        var tabBorder = "tab-border light-grey";
        var neighborBorder = "tab-border black";

        var incrementId = parseInt(id)+1;
        var decrementId = parseInt(id)-1;

        // Style the specified tab
        function styleTab(styleId)
        {
            removeClasses(styleId);
            $('#tbl-'+styleId).addClass(tabBorder);
            $('#tab-'+styleId).addClass(tabContent);
            $('#tbr-'+styleId).addClass(tabBorder);
        }
        function styleTabMain(styleId)
        {
            removeClasses(styleId);
            $('#tbl-'+styleId).addClass("tab-border grey");
            $('#tab-'+styleId).addClass("tab-content grey");
            $('#tbr-'+styleId).addClass("tab-border grey");
        }
        // Close previous section and open current
        function changeSection(sectionId)
        {
            var parseId = parseInt(sectionId);
            $('#s'+is_selection).hide();
            $('#s'+parseId).fadeIn(700);
        }

        // Apply the specified tab's styles, and adjust nearest neighbor's borders.
        if(tabCount>2)
        {
            if(id==0)
            {
                styleTab(id);

                $('#tbl-1').removeClass();
                $('#tbl-1').addClass(neighborBorder);

                changeSection(id);
                is_selection = id;
            }
            if(id==1)
            {
                styleTab(id);
                $('#tbl-'+incrementId).removeClass();
                $('#tbr-'+decrementId).removeClass();

                $('#tbl-'+incrementId).addClass(neighborBorder);
                $('#tbr-'+decrementId).addClass(neighborBorder);

                changeSection(id);
                is_selection = id;
            }
            if(id==2)
            {
                styleTab(id);
                $('#tbr-'+decrementId).removeClass();

                $('#tbr-'+decrementId).addClass(neighborBorder);

                changeSection(id);
                is_selection = id;
            }
        }
        else
        {
            if(id==0)
            {
                styleTabMain(id);

                $('#tbl-1').removeClass();
                $('#tbl-1').addClass(neighborBorder);

                changeSection(id);
                is_selection = id;
            }
            else
            {
                styleTabMain(id);
                $('#tbr-'+decrementId).removeClass();

                $('#tbr-'+decrementId).addClass(neighborBorder);

                changeSection(id);
                is_selection = id;
            }
        }

    }
    // Set Default Tab
    function setDefaultTab(id)
    {
        setUnselectedStyles();
        setSelectedStyles(id);
    }
    // Copy template to clipbaord
    function copyToClipboard()
    {
        $('#templateTextarea').select();
    }
});