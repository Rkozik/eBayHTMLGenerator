$(document).ready(function() {
    var is_selection = 0;
    var isLoaded     = -1;

    var tabCount   = ($('.tab-content').length)-1;
    //var defaultTab = getFirstValidationError();

    var lastFeature, lastPhoto, lastSpecification, lastShippingFAQ = 0;

    var validationErrorContainer = $('.validationError-container');
    var errorCount               = document.getElementsByClassName('validationError-tabIcon').length;
    var loginErrorCount          = document.getElementsByClassName('halfWidth-validationError-container').length;

    var archivesRowContainer = $('.archives-row-container');
    var template             = "#template-";

    window.onload = function(){isLoaded++;};

    // Chrome 'overflow:scroll' bug-fix
    $('body').css("overflow-y","scroll");

    // Set default tab and corresponding <section>
    setDefaultTab(getFirstValidationError());

    // Set validation error icon(s)
    if(validationErrorContainer.length>0){validationErrorIcon();}

    // <blink> error indicators
    if(errorCount>0){tabIconBlink();}
    //if(loginErrorCount>0){loginErrorBlink();}
    $('.halfWidth-validationError-removeBtn').live('click',function(){loginValidationError($(this))});

    // Change tab and display corresponding <section>
    $('.tab-content').live('click',function(){
        var tabContentID = ($(this).attr('id').split('-'))[1];

        setUnselectedStyles();
        setSelectedStyles(tabContentID);
    });
    $('.nextButton').live('click',function(){
        var nextButtonID = (($(this).attr('id')).split("next"))[1];

        nextTab(nextButtonID);
    });
    $('#changeTemplate').live('click',function(){changeTemplate()});

    // Add user-input fields
    $('#add-feature').live('click',function(){addFeature();});
    $('#add-photo').live('click',function(){addPhoto();});
    $('#add-specification').live('click',function(){addSpecification();});
    $('#add-shipping').live('click',function(){addShippingFAQ();});

    // Remove user-input field
    $('.remove-item-icon').live('click',function(){$(this).closest('.feature').remove();});
    $('.remove-item-icon').live('click',function(){$(this).closest('.photo').remove();});
    $('.remove-item-icon').live('click',function(){$(this).closest('.specification').remove();});
    $('.remove-item-icon').live('click',function(){$(this).closest('.shipping').remove();});

    // Editor quick submit
    $('#editor-submit').click(function(){
        $('#editor').submit();
    });

    // Dismiss validation error message
    $('.validationError-removeBtn').live('click',function(){
        $(this).closest('.validationError-container').fadeOut(function(){
            $(this).closest('.validationError-container').remove();
        });
    });

    // (Legacy) Toggle styles tab
    $('#styles-tab').live('click',function(){
        $('#styles-content').animate({width:'toggle'},900);
    });

    // Clear 'header_login' defaults
    $('#login-username').live('click',function(){clearInputDefault($(this),"username");});
    $('#login-password').live('click',function(){clearInputDefault($(this),"password");});

    // Clear 'reset password' defaults
    $('input[name="username_forgot"]').live('click',function(){clearInputDefault($(this),"Enter Username");});
    $('input[name="email_forgot"]').live('click',function(){clearInputDefault($(this),"Enter E-mail");});

    // Clear 'contact-us' defaults
    $('input[name="contactName"]').live('click',function(){clearInputDefault($(this),"Who do you want to be addressed as?");});
    $('input[name="contactEmail"]').live('click',function(){clearInputDefault($(this),"Your.email@provider.com");});
    $('input[name="contactSubject"]').live('click',function(){clearInputDefault($(this),"Enter subject of enquiry.");});
    $('textarea[name="contactMessage"]').live('click',function(){clearInputDefault($(this),"Type out what you've got to say.");});

    // Clear 'create-new-account' defaults
    var newPassword =              $('#input_password');
    var newPasswordConfirmation =  $('#input_passwordConfirmation');
    var hiddenPassword =           $('#hidden_password');

    $('#input_username').live('click',function(){clearInputDefault($(this),"Enter Username");});
    if(hiddenPassword.val()==="TRUE"){
        newPassword.clone().attr('type','password').insertAfter(newPassword).prev().remove();
        newPasswordConfirmation.clone().attr('type','password').insertAfter(newPasswordConfirmation).prev().remove();
    }
    newPassword.click(function(){
        $(this).val($(this).val()==="Password"? "": $(this).val());
        newPassword.clone().attr('type','password').insertAfter(newPassword).prev().remove();
    });
    newPasswordConfirmation.click(function(){
        $(this).val($(this).val()==="Re-enter Password"? "": $(this).val());
        newPasswordConfirmation.clone().attr('type','password').insertAfter(newPasswordConfirmation).prev().remove();
    });
    $('#input_email').live('click',function(){clearInputDefault($(this),"Enter your@email.com");});
    $('#input_emailConfirmation').live('click',function(){clearInputDefault($(this),"Re-enter your@email.com");});

    // Load an archived template
    archivesRowContainer.click(function(){loadArchiveSelection($(this));});

    // Navigate the archive's pages
    $('.next-page').click(function(){nextArchivePage($(this));});
    $('.previous-page').click(function(){previousArchivePage($(this))});

    // Save Template
    $('#saveTemplate').live('click',function(){saveTemplate()});
    // Load an example
    $('#loadExample').live('click',function(){loadExampleTemplate();});
    // Reset Template
    $('#newTemplate').live('click',function(){startNewTemplate();});
    // Highlight HTML embed
    $('#copyToClipboard').live('click',function(){copyToClipboard();});

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
        var tabContent = "tab-content black";
        var tabBorder = "tab-border black";
        var tabDivider = "divider-tab";
        var i = 0;

        if(tabCount>2)
        {
            for (i; i < tabCount; i++)
            {
                if (i == 0) {
                    removeClasses(i);
                    $('#tbr-' + i).addClass(tabDivider);
                    $('#tab-' + i).addClass(tabContent);
                    $('#tbl-' + i).addClass(tabBorder);
                }
                if (i >= 1 && i < tabCount - 1)
                {
                    removeClasses(i);
                    $('#tbr-' + i).addClass(tabDivider);
                    $('#tab-' + i).addClass(tabContent);
                }
                if (i == tabCount - 1)
                {
                    removeClasses(i);
                    $('#tbr-' + i).addClass(tabBorder);
                    $('#tab-' + i).addClass(tabContent);
                }
            }
        }
        else
        {
            for (i; i < tabCount+1; i++)
            {
                if (i == 0)
                {
                    removeClasses(i);
                    $('#tbr-' + i).addClass(tabDivider);
                    $('#tab-' + i).addClass(tabContent);
                    $('#tbl-' + i).addClass(tabBorder);
                }
                if(i == 1)
                {
                    removeClasses(i);

                    $('#tbr-1').addClass(tabBorder);
                    $('#tab-1').addClass(tabContent);
                }
            }
        }
    }

    /*
     * Apply 'select' styles to a specified tab, and
     * also hide the previous <section> and fade in
     * the new one.
     */
    function setSelectedStyles(id)
    {
        var tabContent = "tab-content grey";
        var tabBorder = "tab-border grey";
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
            if(id>0 && id<=tabCount-2)
            {
                styleTab(id);
                $('#tbl-'+incrementId).removeClass();
                $('#tbr-'+decrementId).removeClass();

                $('#tbl-'+incrementId).addClass(neighborBorder);
                $('#tbr-'+decrementId).addClass(neighborBorder);

                changeSection(id);
                is_selection = id;
            }
            if(id==tabCount-1)
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
                styleTab(id);

                $('#tbl-1').removeClass();
                $('#tbl-1').addClass(neighborBorder);

                changeSection(id);
                is_selection = id;
            }
            if(id==1)
            {
                styleTab(id);

                $('#tbr-0').removeClass();
                $('#tbr-0').addClass(neighborBorder);

                changeSection(id);
                is_selection = id;
            }
        }
    }
    // Change tab and corresponding <section> onClick
    function nextTab(id)
    {
        var idInt = parseInt(id);
        if(idInt != tabCount-1)
        {
            setUnselectedStyles();
            setSelectedStyles(idInt+1);
        }
    }
    // Set Default Tab
    function setDefaultTab(id)
    {
        setUnselectedStyles();
        setSelectedStyles(id);
    }
    function changeTemplate()
    {
        setUnselectedStyles();
        setSelectedStyles(1);
    }

    // Add user-input fields
    function addFeature()
    {
        lastFeature++;
        var openAddItemWrapper =    '<div class="left mt18 feature">';
        var addItemInput =          '<div class="tab-input-border cream"></div>'+
            '<input type="text" name="features[]" class="left w900 p9" value=""/>'+
            '<div class="tab-input-border cream"></div>';
        var removeItemInput =       '<div class="remove-item-wrapper">'+
            '<input type="button" class="remove-item-icon" />'+
            '</div>';
        var closeAddItemWrapper =   '</div>';
        var insertClearFloat =      '<div class="clearer"></div>';

        $('#features-list').append(
            openAddItemWrapper +
            addItemInput +
            removeItemInput +
            closeAddItemWrapper +
            insertClearFloat
        );
    }
    function addPhoto()
    {
        lastPhoto++;
        var openAddItemWrapper =    '<div class="left mt18 photo">';
        var addItemInput =          '<div class="tab-input-border cream"></div>'+
            '<input type="text" name="photos[]" class="left w900 p9" value=""/>'+
            '<div class="tab-input-border cream"></div>';
        var removeItemInput =       '<div class="remove-item-wrapper">'+
            '<input type="button" class="remove-item-icon" />'+
            '</div>';
        var closeAddItemWrapper =   '</div>';
        var insertClearFloat =      '<div class="clearer"></div>';

        $('#photo-list').append(
            openAddItemWrapper +
            addItemInput +
            removeItemInput +
            closeAddItemWrapper +
            insertClearFloat
        );
    }
    function addSpecification()
    {
        lastSpecification++;
        var openAddSpecificationWrapper =  '<div class="left mt18 specification">';
        var addSpecificationLeft =         '<div class="left w456">'+
            '<div class="tab-input-border cream"></div>'+
            '<input type="text" class="left w434 p9" name="specification_title[]" value=""/>'+
            '<div class="tab-input-border cream"></div>'+
            '</div>';
        var addSpecificationRight =        '<div class="left w456 ml10">'+
            '<div class="tab-input-border cream"></div>'+
            '<input type="text" class="left w434 p9" name="specification_label[]" value=""/>'+
            '<div class="tab-input-border cream"></div>'+
            '</div>';
        var removeSpecificationRow =       '<div class="remove-item-wrapper">'+
            '<input type="button" class="remove-item-icon" />'+
            '</div>';
        var closeAddSpecificationWrapper = '</div>';
        var insertClearFloat =             '<div class="clearer"></div>';

        $('#specifications-list').append(
            openAddSpecificationWrapper +
            addSpecificationLeft +
            addSpecificationRight +
            removeSpecificationRow +
            closeAddSpecificationWrapper +
            insertClearFloat
        );
    }
    function addShippingFAQ()
    {
        lastShippingFAQ++;
        var openAddShippingWrapper =       '<div class="left mt18 shipping">';
        var addShippingQuestion =          '<div class="tab-input-border cream"></div>'+
            '<input type="text" class="left w900 p9" name="FAQ_question[]" value=""/>'+
            '<div class="tab-input-border cream"></div>';
        var removeShippingRow =            '<div class="remove-item-wrapper">'+
            '<input type="button" class="remove-item-icon" />'+
            '</div>';

        var ShippingAnswer_ContainerOpen = '<div class="left w922">';
        var addShippingAnswer =            '<div class="tab-textarea-border cream"></div>'+
            '<textarea class="left w902 h120 mt18 p9" name="FAQ_answer[]"></textarea>';
        var closeAddShippingWrapper =      '</div>';

        var insertClearFloat =             '<div class="clearer"></div>';
        var ShippingAnser_ContainerClose = '</div>';
        $('#shipping-list').append(
            openAddShippingWrapper+
            addShippingQuestion+
            removeShippingRow+
            ShippingAnswer_ContainerOpen+
            addShippingAnswer+
            closeAddShippingWrapper+
            ShippingAnser_ContainerClose+
            insertClearFloat
        );
    }
    // If validation error exist append an icon to the corresponding tab-content
    function validationErrorIcon()
    {
        var errorCodes = {
            errorDescription:"#tab-0",
            errorFeatures:"#tab-t1",
            errorPhotos:"#tab-2",
            errorSpecifications:"#tab-3",
            errorShipping:"#tab-4"
        };
        function setValidationErrorIndication(id)
        {
            return '<span class="validationError-tabIcon" id="'+id+'"></span>';
        }
        ($('#errorDescription').length>0?$(errorCodes["errorDescription"]).append(setValidationErrorIndication("errorDescriptionIndicator")):"");
        ($('#errorFeatures').length>0?$(errorCodes["errorFeatures"]).append(setValidationErrorIndication("errorFeaturesIndicator")):"");
        ($('#errorPhotos').length>0?$(errorCodes["errorPhotos"]).append(setValidationErrorIndication("errorPhotosIndicator")):"");
        ($('#errorSpecifications').length>0?$(errorCodes["errorSpecifications"]).append(errorIndicator):"");
        ($('#errorShipping').length>0?$(errorCodes["errorSipping"]).append(errorIndicator):"");
    }
    function getFirstValidationError()
    {
        var firstErrorID = (typeof validationErrorContainer == 'undefined'?undefined:validationErrorContainer.parent().attr('id'));
        return (firstErrorID == undefined?0:firstErrorID.charAt(1));
    }
    // Validation error indicators
    function tabIconBlink()
    {
        var validationError_tabIcon = $('.validationError-tabIcon');

        for (var s = 0; s <= 2; s++) {
            validationError_tabIcon.fadeTo('slow', 0.5).fadeTo('slow', 1.0);
        }
    }
    function loginErrorBlink()
    {
        var loginError = $('.halfWidth-validationError-container');
        var userLogin  = $('#login-topbar');

        userLogin.hide();
        for(var s2=0;s2<=1;s2++){
            loginError.fadeTo('500', 0.5).fadeTo('500', 1.0);
        }
        setTimeout(function(){
            loginError.fadeOut(600);
            setTimeout(function(){
                userLogin.fadeIn(200);
            }, 600);
        }, 2000);
    }
    // Dashboard archive functions
    function loadArchiveSelection(selector)
    {

        var openTemplate         = $('#open-template');
        var openTemplateID       = $('#open-templateId');

        var archiveRow         = selector.attr('id');
        var archiveRow_split   = archiveRow.split('-');
        var archiveRowID       = archiveRow_split[2];
        var archiveRadioSelect = "#archive-radio-"+archiveRowID;

        var templateValue      = $(template+archiveRowID).text();

        $(archiveRadioSelect).attr('checked', 'checked');
        openTemplate.val(templateValue);
        openTemplateID.val(templateValue);
    }
    function nextArchivePage(selector)
    {
        var currentID       = selector.attr('id');
        var currentID_split = currentID.split('-');
        var theID           = parseInt(currentID_split[1]);
        var archivesPage    = '#archives-page-';

        $(archivesPage+(theID-1)).hide();
        $(archivesPage+theID).fadeIn(700);
    }
    function previousArchivePage(selector)
    {
        var currentID       = selector.attr('id');
        var currentID_split = currentID.split('-');
        var theID           = parseInt(currentID_split[1]);
        var archivesPage    = '#archives-page-';

        $(archivesPage+(theID+1)).hide();
        $(archivesPage+theID).fadeIn(700);
    }

    /**
     * Save or update a template
     */
    function saveTemplate()
    {
        $('.validationError-container').remove();
        $('.validationSuccess-container').remove();

        var url = $('#saveCurrentTemplate').attr("action");
        var data = $('#saveCurrentTemplate').serialize();
        $.ajax({
            url:url,
            type:"post",
            data:data,
            success: function(data){
                var response = $(data).text();

                var validationOpen_Error  = '<div class="validationError-container" id="errorDescription"><div class="tab-input-border dark-grey"></div><div class="validationError-icon-container"><div class="validationError-icon"></div></div><div class="fullWidth-validationError" ><p>';
                var validationClose_Error = '</p></div><div class="validationError-closeBtn-container"><input type="button" class="validationError-removeBtn"/></div><div class="tab-input-border dark-grey"></div></div><div class="clearer"></div>';

                var validationOpen_Success  = '<div class="validationError-container"><div class="tab-input-border dark-grey"></div><div class="validationSuccess-icon-container"><div class="validationSuccess-icon"></div></div><div class="fullWidth-validationSuccess"><p>';
                var validationClose_Success = '</p></div><div class="validationSuccess-closeBtn-container"><div class="validationSuccess-removeBtn"></div></div><div class="tab-input-border dark-grey"></div></div><div class="clearer"></div>';


                var validationComplete = (response == "Your template has been saved!"?validationOpen_Success+response+validationClose_Success:validationOpen_Error+response+validationClose_Error);
                $('#saveCurrentTemplate').prepend(validationComplete);
            }
        });
    }
    /**
     *
     */
    function loadExampleTemplate()
    {
        var response = confirm("If you don't save your current template all your progress will be lost. Do you wish to continue?");
        if(response === true)
        {
            $('#loadExampleTemplate').submit();
        }

    }
    /**
     *
     */
    function startNewTemplate()
    {
        var response = confirm("Want to start a new template from scratch? All unsaved data will be lost");
        if(response === true)
        {
            $('#startNewTemplate').submit();
        }

    }
    // Copy template to clipbaord
    function copyToClipboard()
    {
        $('#templateTextarea').select();
    }
    // Clear input defaults
    function clearInputDefault(selector,defaultValue)
    {
        selector.val(selector.val()===defaultValue? "": selector.val());
    }
    // Login failure
    function loginValidationError(selector)
    {
        var forgotPasswordText = '<a href="create-new-account/" class="cream-font underline-on">did you lose your password?</a>';
        var getCurrentID = (typeof (selector.attr('id')) =='undefined'?undefined:selector.attr('id'));

        if(getCurrentID == undefined)
        {
            $('#loginError-message').text("By chance, ");
            $('#loginError-message').append(forgotPasswordText);
            selector.attr('id','loginErrorMessage');
        }
        else
        {
            $('.halfWidth-validationError-container').hide();
            $('#login-topbar-container').fadeIn(700);
        }
    }
});

