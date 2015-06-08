$(document).ready(function() {

    $('.swatch').click(function(){
        var colorTableHTML = '<div id="colorTable-container"> <div id="colorTable-container-borderLeft"></div><div id="colorTable-container-navigation"> <div class="colorTable-tab"> <span id="colorTable-title">Color Table</span> </div><div class="colorTable-tab-border"></div><div id="colorTable-tab-revert-container"> <div class="colorTable-tab-border" id="revert-borderLeft"></div><div class="colorTable-tab" id="colorTable-tab-revert"> <div id="colorTable-tab-revertIco"></div></div><div class="colorTable-tab-border" id="revert-borderRight"></div></div></div><div id="colorTable-container-inner"> <div id="colorTable-tab-exitBtn"> <div class="colorTable-tab-exitBtn-borderOuter"></div><div class="colorTable-tab-exitBtn-borderInner"></div><div id="colorTable-tab-exitBtn-content"> <div id="colorTable-tab-exitBtn-content-ico"></div></div><div class="colorTable-tab-exitBtn-borderInner"></div><div class="colorTable-tab-exitBtn-borderOuter"></div></div><div id="colorTable-table-container"> <div class="colorTable-row"> <input type="button" class="colorTable-swatch colorTable-swatch-first" id="red_9"/> <input type="button" class="colorTable-swatch " id="red_8"/> <input type="button" class="colorTable-swatch " id="red_7"/> <input type="button" class="colorTable-swatch " id="red_6"/> <input type="button" class="colorTable-swatch " id="red_5"/> <input type="button" class="colorTable-swatch " id="red_4"/> <input type="button" class="colorTable-swatch " id="red_3"/> <input type="button" class="colorTable-swatch " id="red_2"/> <input type="button" class="colorTable-swatch " id="red_1"/> <input type="button" class="colorTable-swatch " id="red_0"/> </div><div style="background-color:#f0f0f0;float:left;height:2px;margin-top:-17px;width:2px;"></div><div style="background-color:#f0f0f0;float:right;height:2px;margin-top:-17px;width:2px;"></div><div class="colorTable-row"> <input type="button" class="colorTable-swatch colorTable-swatch-first" id="pink_9"/> <input type="button" class="colorTable-swatch " id="pink_8"/> <input type="button" class="colorTable-swatch " id="pink_7"/> <input type="button" class="colorTable-swatch " id="pink_6"/> <input type="button" class="colorTable-swatch " id="pink_5"/> <input type="button" class="colorTable-swatch " id="pink_4"/> <input type="button" class="colorTable-swatch " id="pink_3"/> <input type="button" class="colorTable-swatch " id="pink_2"/> <input type="button" class="colorTable-swatch " id="pink_1"/> <input type="button" class="colorTable-swatch " id="pink_0"/> </div><div class="colorTable-row"> <input type="button" class="colorTable-swatch colorTable-swatch-first" id="purple_9"/> <input type="button" class="colorTable-swatch " id="purple_8"/> <input type="button" class="colorTable-swatch " id="purple_7"/> <input type="button" class="colorTable-swatch " id="purple_6"/> <input type="button" class="colorTable-swatch " id="purple_5"/> <input type="button" class="colorTable-swatch " id="purple_4"/> <input type="button" class="colorTable-swatch " id="purple_3"/> <input type="button" class="colorTable-swatch " id="purple_2"/> <input type="button" class="colorTable-swatch " id="purple_1"/> <input type="button" class="colorTable-swatch " id="purple_0"/> </div><div class="colorTable-row"> <input type="button" class="colorTable-swatch colorTable-swatch-first" id="blue_9"/> <input type="button" class="colorTable-swatch " id="blue_8"/> <input type="button" class="colorTable-swatch " id="blue_7"/> <input type="button" class="colorTable-swatch " id="blue_6"/> <input type="button" class="colorTable-swatch " id="blue_5"/> <input type="button" class="colorTable-swatch " id="blue_4"/> <input type="button" class="colorTable-swatch " id="blue_3"/> <input type="button" class="colorTable-swatch " id="blue_2"/> <input type="button" class="colorTable-swatch " id="blue_1"/> <input type="button" class="colorTable-swatch " id="blue_0"/> </div><div class="colorTable-row"> <input type="button" class="colorTable-swatch colorTable-swatch-first" id="green_9"/> <input type="button" class="colorTable-swatch " id="green_8"/> <input type="button" class="colorTable-swatch " id="green_7"/> <input type="button" class="colorTable-swatch " id="green_6"/> <input type="button" class="colorTable-swatch " id="green_5"/> <input type="button" class="colorTable-swatch " id="green_4"/> <input type="button" class="colorTable-swatch " id="green_3"/> <input type="button" class="colorTable-swatch " id="green_2"/> <input type="button" class="colorTable-swatch " id="green_1"/> <input type="button" class="colorTable-swatch " id="green_0"/> </div><div class="colorTable-row"> <input type="button" class="colorTable-swatch colorTable-swatch-first" id="yellow_9"/> <input type="button" class="colorTable-swatch " id="yellow_8"/> <input type="button" class="colorTable-swatch " id="yellow_7"/> <input type="button" class="colorTable-swatch " id="yellow_6"/> <input type="button" class="colorTable-swatch " id="yellow_5"/> <input type="button" class="colorTable-swatch " id="yellow_4"/> <input type="button" class="colorTable-swatch " id="yellow_3"/> <input type="button" class="colorTable-swatch " id="yellow_2"/> <input type="button" class="colorTable-swatch " id="yellow_1"/> <input type="button" class="colorTable-swatch " id="yellow_0"/> </div><div class="colorTable-row"> <input type="button" class="colorTable-swatch colorTable-swatch-first" id="orange_9"/> <input type="button" class="colorTable-swatch " id="orange_8"/> <input type="button" class="colorTable-swatch " id="orange_7"/> <input type="button" class="colorTable-swatch " id="orange_6"/> <input type="button" class="colorTable-swatch " id="orange_5"/> <input type="button" class="colorTable-swatch " id="orange_4"/> <input type="button" class="colorTable-swatch " id="orange_3"/> <input type="button" class="colorTable-swatch " id="orange_2"/> <input type="button" class="colorTable-swatch " id="orange_1"/> <input type="button" class="colorTable-swatch " id="orange_0"/> </div><div class="colorTable-row"> <input type="button" class="colorTable-swatch colorTable-swatch-first" id="greyscale_9" value="#f8f8f8" style="background-color:#f8f8f8;"/> <input type="button" class="colorTable-swatch" id="greyscale_8" value="#cccccc" style="background-color:#cccccc;"/> <input type="button" class="colorTable-swatch" id="greyscale_7" value="#b3b3b3" style="background-color:#b3b3b3;"/> <input type="button" class="colorTable-swatch" id="greyscale_6" value="#999999" style="background-color:#999999;"/> <input type="button" class="colorTable-swatch" id="greyscale_5" value="#808080" style="background-color:#808080;"/> <input type="button" class="colorTable-swatch" id="greyscale_4" value="#676767" style="background-color:#676767;"/> <input type="button" class="colorTable-swatch" id="greyscale_3" value="#4d4d4d" style="background-color:#4d4d4d;"/> <input type="button" class="colorTable-swatch" id="greyscale_2" value="#343434" style="background-color:#343434;"/> <input type="button" class="colorTable-swatch" id="greyscale_1" value="#1a1a1a" style="background-color:#1a1a1a;"/> <input type="button" class="colorTable-swatch" id="greyscale_0" value="#000000" style="background-color:#000000;"/> </div><div style="background-color:#f0f0f0;float:left;height:2px;margin-top:-2px;width:2px;"></div><div style="background-color:#f0f0f0;float:right;height:2px;margin-top:-2px;width:2px;"></div></div><div id="colorTable-selection-container"> <div class="colorTable-selection-border-bottomTop"></div><div id="colorTable-selection-content"> <div id="colorTable-selection-swatch"></div><input type="text" id="colorTable-selection-hexcode" value="#777777"/> <input type="button" id="colorTable-selection-selectBtn" value="Select"/> </div><div class="colorTable-selection-border-bottomTop"></div></div></div><div id="colorTable-container-inner-borderRight"></div><div id="colorTable-container-outer"> <div id="colorTable-outer-pointer"></div></div></div>';
        var swatchID = $(this).attr('id');
        var splitSwatchID = swatchID.split("-");
        var colorTablePositions = {
            pos_1:"-28px",
            pos_2:"502px"
        };
        if(document.getElementById("colorTable-container")){
            $('#colorTable-container').remove();
        }
        $('#'+splitSwatchID[0]+'-'+splitSwatchID[1]).append(colorTableHTML);
        $('#colorTable-container').css('margin-left',colorTablePositions[splitSwatchID[3]]);
        createColorTable(swatchID);
    });
    // Given HSV values create an array(10 long) of ascending hexadecimal color values.
    function hexArray(base_color)
    {
        var hex_values = [];
        var newSaturation, tempRGB;

        function rgbToHex(red, green, blue)
        {
            function componentToHex(component)
            {
                var hex = component.toString(16);
                return hex.length == 1 ? "0" + hex : hex;
            }
            return "#" + componentToHex(red) + componentToHex(green) + componentToHex(blue);
        }
        function hsvToRgb(h, s, v) {
            var r, g, b;
            var i;
            var f, p, q, t;

            h = Math.max(0, Math.min(360, h));
            s = Math.max(0, Math.min(100, s));
            v = Math.max(0, Math.min(100, v));

            s /= 100;
            v /= 100;

            if(s == 0) {
                r = g = b = v;
                return [Math.round(r * 255), Math.round(g * 255), Math.round(b * 255)];
            }

            h /= 60;
            i = Math.floor(h);
            f = h - i;
            p = v * (1 - s);
            q = v * (1 - s * f);
            t = v * (1 - s * (1 - f));

            switch (i % 6) {
                case 0: r = v, g = t, b = p; break;
                case 1: r = q, g = v, b = p; break;
                case 2: r = p, g = v, b = t; break;
                case 3: r = p, g = q, b = v; break;
                case 4: r = t, g = p, b = v; break;
                case 5: r = v, g = p, b = q; break;
            }
            return [Math.round(r * 255), Math.round(g * 255), Math.round(b * 255)];
        }

        for(var i2=0;i2<=9;i2++)
        {
            if(i2!=9)
            {
                newSaturation = base_color[1]-(i2*10);
                tempRGB = hsvToRgb(base_color[0],newSaturation,base_color[2]);
                hex_values.push(rgbToHex(tempRGB[0],tempRGB[1],tempRGB[2]));
            }
            else
            {
                newSaturation = base_color[1]-85;
                tempRGB = hsvToRgb(base_color[0],newSaturation,base_color[2]);
                hex_values.push(rgbToHex(tempRGB[0],tempRGB[1],tempRGB[2]));
            }
        }
        return hex_values;
    }
    /*
     * @param    base_blue   The base HSV value for blue
     *
     */
    function createColorTable(swatchID){
        var splitSwatchID = swatchID.split("-");

        var base_red    = [0,100,89];
        var base_pink   = [329,100,89];
        var base_purple = [277,100,89];
        var base_blue   = [213,100,89];
        var base_green  = [83,100,89];
        var base_yellow = [55,100,89];
        var base_orange = [35,100,89];


        var red_values    = hexArray(base_red);
        var pink_values   = hexArray(base_pink);
        var purple_values = hexArray(base_purple);
        var blue_values   = hexArray(base_blue);
        var green_values  = hexArray(base_green);
        var yellow_values = hexArray(base_yellow);
        var orange_values = hexArray(base_orange);

        var greyscale_values = ["#000000", "#1a1a1a", "#343434", "#4d4d4d", "#676767", "#808080", "#999999", "#b3b3b3", "#cccccc", "#f8f8f8"];
        var color_values =
        {
            red:red_values,
            pink:pink_values,
            purple:purple_values,
            blue:blue_values,
            green:green_values,
            yellow:yellow_values,
            orange:orange_values,
            greyscale:greyscale_values
        };

        var id_red    = "#red_";
        var id_pink   = "#pink_";
        var id_purple = "#purple_";
        var id_blue   = "#blue_";
        var id_green  = "#green_";
        var id_yellow = "#yellow_";
        var id_orange = "#orange_";

        for(var i3=0;i3<=9;i3++)
        {
            $(id_red+i3).css('background-color', red_values[i3]);
            $(id_red+i3).attr('value', red_values[i3]);

            $(id_pink+i3).css('background-color', pink_values[i3]);
            $(id_pink+i3).attr('value', pink_values[i3]);

            $(id_purple+i3).css('background-color', purple_values[i3]);
            $(id_purple+i3).attr('value', purple_values[i3]);

            $(id_blue+i3).css('background-color', blue_values[i3]);
            $(id_blue+i3).attr('value', blue_values[i3]);

            $(id_green+i3).css('background-color', green_values[i3]);
            $(id_green+i3).attr('value', green_values[i3]);

            $(id_yellow+i3).css('background-color', yellow_values[i3]);
            $(id_yellow+i3).attr('value', yellow_values[i3]);

            $(id_orange+i3).css('background-color', orange_values[i3]);
            $(id_orange+i3).attr('value', orange_values[i3]);
        }
        var colorTableSwatch = $('.colorTable-swatch');
        var selectionHexcode = $('#colorTable-selection-hexcode');
        var selectionContent = $('#colorTable-selection-content');
        /*var assocInput = $('input[name="'+splitSwatchID[0]+'-'+splitSwatchID[2]+'-input'+'"]');
         var splitAssocInput = assocInput.val().split(":");
         var previousColor    = splitAssocInput[1];*/
        var swatchSelection,splitSwatchSelection,currentColor,currentColorLighterShade;

        function lighterShade(swatchSelection, color_values)
        {
            splitSwatchSelection = swatchSelection.split("_");
            var reverseIndex = [0,1,2,3,4,5,6,7,8,9];
            var newIndex = (reverseIndex[splitSwatchSelection[1]]+2 >=9?9:reverseIndex[splitSwatchSelection[1]]+2);
            return color_values[splitSwatchSelection[0]][newIndex];
        }

        colorTableSwatch.click(function(){
            currentColor    = $(this).val();
            swatchSelection = $(this).attr('id');

            $('#colorTable-title').css('color', currentColor);

            $('#revert-borderLeft').css('background-color', lighterShade(swatchSelection,color_values));
            $('#colorTable-tab-revert').css('background-color', lighterShade(swatchSelection,color_values));
            $('#revert-borderRight').css('background-color', lighterShade(swatchSelection,color_values));

            $('#colorTable-tab-exitBtn-content').css('background-color', currentColor);
            $('.colorTable-tab-exitBtn-borderInner').css('background-color', currentColor);
            $('.colorTable-tab-exitBtn-borderOuter').css('background-color', currentColor);


            $('.colorTable-selection-border-bottomTop').css('background-color', currentColor);
            selectionContent.css('border-left', '2px solid '+currentColor);
            selectionContent.css('border-right', '2px solid '+currentColor);

            $('#colorTable-selection-swatch').css('background-color', currentColor);

            selectionHexcode.val(currentColor);
            selectionHexcode.css('color', currentColor);
            selectionHexcode.css('border-left', '2px solid '+currentColor);
            selectionHexcode.css('border-right', '2px solid '+currentColor);

            $('#colorTable-selection-selectBtn').css('background-color', currentColor);
        });

        var exitBtnContainer   = $('#colorTable-tab-exitBtn');
        var revertContainer    = $('#colorTable-tab-revert-container');
        var selectBtnContainer = $('#colorTable-selection-selectBtn');

        exitBtnContainer.hover(function(event){
            $('#colorTable-tab-exitBtn-content').css('background-color', event.type === "mouseenter"?lighterShade(swatchSelection,color_values):currentColor);
            $('.colorTable-tab-exitBtn-borderInner').css('background-color', event.type === "mouseenter"?lighterShade(swatchSelection,color_values):currentColor);
            $('.colorTable-tab-exitBtn-borderOuter').css('background-color', event.type === "mouseenter"?lighterShade(swatchSelection,color_values):currentColor);
        });

        exitBtnContainer.click(function(){
            $('#colorTable-container').remove();
        });

        revertContainer.hover(function(event){
            $('#revert-borderLeft').css('background-color', event.type === "mouseenter"?currentColor:lighterShade(swatchSelection,color_values));
            $('#colorTable-tab-revert').css('background-color', event.type === "mouseenter"?currentColor:lighterShade(swatchSelection,color_values));
            $('#revert-borderRight').css('background-color', event.type === "mouseenter"?currentColor:lighterShade(swatchSelection,color_values));
        });
        revertContainer.click(function(){
            $('#colorTable-container').remove();
        });

        selectBtnContainer.hover(function(event){
            $('#colorTable-selection-selectBtn').css('text-decoration', event.type === "mouseenter"?"underline":"none");
        });

        function inputLabel(inputName){
            var splitInput = inputName.split('-');
            var labels =
            {
                backgroundColor: "Background Color: ",
                backgroundColorLeft: "Background Color (Left): ",
                backgroundColorRight: "Background Color (Right): ",
                fontColorLeft: "Font Color (Left): ",
                fontColorRight: "Font Color (Right): ",
                fontColor: "Font Color: "
            };
            return labels[splitInput[1]];
        }

        selectBtnContainer.click(function(){
            var assocInput = splitSwatchID[0]+'-'+splitSwatchID[2]+'-input';
            $('input[name="'+assocInput+'"]').val(inputLabel(assocInput)+selectionHexcode.val());
            $('#'+swatchID).css('background-color',currentColor);
            $('#colorTable-container').remove();
        });
    }
});
