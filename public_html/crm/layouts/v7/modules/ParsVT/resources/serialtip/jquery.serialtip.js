/*!
 * jQuery serialtip
 * https://github.com/kevinmeunier/jquery-serialtip
 *
 * Copyright 2022 Meunier Kévin
 * https://www.meunierkevin.com
 *
 * Released under the MIT license
 */
(function ($) {
    'use strict';

    const clickEvent = (('ontouchstart' in window) || (window.DocumentTouch && document instanceof DocumentTouch))
        ? 'touchstart.serialtip'
        : 'click.serialtip';
    const mouseEnterEvent = 'mouseenter.serialtip';
    const mouseLeaveEvent = 'mouseleave.serialtip';
    const resizeEvent = 'resize.serialtip';
    const $window = $(window);
    const $html = $('html');
    let plugininit = false;
    let $wrapper;
    let $lastTarget;
    let timer;
    let menu = '<div data-serialtip-target="INPUTNAME" class="serialtip-default" >\n' +
        '<div class="serialtip-options-container">' +
        '<div class="serialtip-container">\n' +
        '    <div class="selector">\n' +
        '        <div class="selector-item" onclick="selectorClicked(\'radio1\')">\n' +
        '            <input type="radio" id="radio1" name="selector" class="selector-item_radio radio1" >\n' +
        '            <label for="radio1" class="selector-item_label"> '+app.vtranslate('Equal fixed value')+' </label>\n' +
        '        </div>\n' +
        '        <div class="selector-item" onclick="selectorClicked(\'radio2\')">\n' +
        '            <input type="radio" id="radio2" name="selector" class="selector-item_radio radio2">\n' +
        '            <label for="radio2" class="selector-item_label"> '+app.vtranslate('Not equal fixed value')+'</label>\n' +
        '        </div>\n' +
        '        <div class="selector-item"  onclick="selectorClicked(\'radio3\')">\n' +
        '            <input type="radio" id="radio3" name="selector" class="selector-item_radio radio3">\n' +
        '            <label for="radio3" class="selector-item_label"> '+app.vtranslate('Between')+'</label>\n' +
        '        </div>\n'
        + '      <div class="selector-item" onclick="selectorClicked(\'radio4\')">\n' +
        '            <input type="radio" id="radio4" name="selector" class="selector-item_radio radio4">\n' +
        '            <label for="radio4" class="selector-item_label"> '+app.vtranslate('Not between')+'</label>\n' +
        '        </div>\n' +
        '    </div>\n' +
        '</div>' +
        '<input data-active-input="INPUTNAME" data-active-tab="radio1"  name="eq" value="START" min="0"  class="serialtip-input d-none text1"/>' +
        '<input data-active-input="INPUTNAME" data-active-tab="radio2"   name="nq" value="START" min="0"  class="serialtip-input d-none text1"/>' +
        '<div class="input-container d-none">' +
        '<input data-active-input="INPUTNAME" data-active-tab="radio3"  name="fbt" placeholder="'+app.vtranslate('From')+'" min="0" value="START"  class="serialtip-input text1"/>' +
        '<input data-active-input="INPUTNAME" data-active-tab="radio3"   name="tbt" placeholder="'+app.vtranslate('To')+'" value="END" class="serialtip-input text1"/>' +
        '</div>' +
        '<div style="text-align: center">' +
        '<span class="serialtip-close" style="opacity: 0; width: 0; height: 0"></span>'+
        '<button class="btn btn-danger btn-sm serialtip-btn"  onclick="return closeSerialtip();">'+app.vtranslate('Close')+'</button>&nbsp;'+
        '<button  data-active-input="INPUTNAME"  onclick="selectorSubmited(\'INPUTNAME\')" class="btn btn-success btn-sm serialtip-btn btn-submit-INPUTNAME">'+app.vtranslate('Ok')+'</button>'+
        '</div></div>';
    let menu2 = '<div class="serialtip-options-container">' +
        '<div class="serialtip-container">\n' +
        '    <div class="selector">\n' +
        '        <div class="selector-item" onclick="selectorClicked(\'radio1\')">\n' +
        '            <input type="radio" id="radio1" name="selector" class="selector-item_radio radio1" >\n' +
        '            <label for="radio1" class="selector-item_label"> '+app.vtranslate('Equal fixed value')+' </label>\n' +
        '        </div>\n' +
        '        <div class="selector-item" onclick="selectorClicked(\'radio2\')">\n' +
        '            <input type="radio" id="radio2" name="selector" class="selector-item_radio radio2">\n' +
        '            <label for="radio2" class="selector-item_label"> '+app.vtranslate('Not equal fixed value')+'</label>\n' +
        '        </div>\n' +
        '        <div class="selector-item"  onclick="selectorClicked(\'radio3\')">\n' +
        '            <input type="radio" id="radio3" name="selector" class="selector-item_radio radio3">\n' +
        '            <label for="radio3" class="selector-item_label"> '+app.vtranslate('Between')+'</label>\n' +
        '        </div>\n'
        + '      <div class="selector-item" onclick="selectorClicked(\'radio4\')">\n' +
        '            <input type="radio" id="radio4" name="selector" class="selector-item_radio radio4">\n' +
        '            <label for="radio4" class="selector-item_label"> '+app.vtranslate('Not between')+'</label>\n' +
        '        </div>\n' +
        '    </div>\n' +
        '</div>' +
        '<input data-active-input="INPUTNAME" data-active-tab="radio1" name="eq" value="START" min="0"  class="serialtip-input d-none text1"/>' +
        '<input data-active-input="INPUTNAME" data-active-tab="radio2"   name="nq" value="START" min="0"  class="serialtip-input d-none text1"/>' +
        '<div class="input-container d-none">' +
        '<input data-active-input="INPUTNAME" data-active-tab="radio3"  name="fbt" placeholder="'+app.vtranslate('From')+'" min="0" value="START"  class="serialtip-input text1"/>' +
        '<input data-active-input="INPUTNAME" data-active-tab="radio3"   name="tbt" placeholder="'+app.vtranslate('To')+'" value="END" class="serialtip-input text1"/>' +
        '</div>' +
        '<div style="text-align: center">' +
        '<span class="serialtip-close" style="opacity: 0; width: 0; height: 0"></span>'+
        '<button class="btn btn-danger btn-sm serialtip-btn" onclick="return closeSerialtip();">'+app.vtranslate('Close')+'</button>&nbsp;'+
        '<button  data-active-input="INPUTNAME"  onclick="selectorSubmited(\'INPUTNAME\')" class="btn btn-success btn-sm serialtip-btn btn-submit-INPUTNAME">'+app.vtranslate('Ok')+'</button>'+
        '</div>';

    $.fn.serialtip = function (options) {
        const settings = $.extend({}, $.fn.serialtip.defaults, options);
        const base = this;

        $.extend(this, {
            IsDecimal: function (num) {
                return ((num.toString().split('.').length) <= 2 && num.toString().match(/^[\+\-]?\d*\.?\d+(?:[Ee][\+\-]?\d+)?$/)) ? (!isNaN(Number.parseFloat(num))) : false ;
            },
            IsInteger: function (num) {
                return ((num.toString().split('.').length) == 1 && num.toString().match(/^[\-]?\d+$/)) ? (!isNaN(Number.parseInt(num))) : false ;
            },
            onload: function () {
                $wrapper = $('<div id="serialtip" />').appendTo('body');
                plugininit = true;
            },

            init: function () {
                if (plugininit == false)
                    this.onload();

                // Hide the target on load and bind proper events
                this.each(function () {
                    const $trigger = $(this);
                    const $target = settings.getTarget($trigger);

                    // Store the trigger and hide the target
                    $target
                        .appendTo($wrapper)
                        .data('serialtip', $trigger);

                    // Manage click event
                    if (settings.event == 'click') {
                        $trigger.off(clickEvent).on(clickEvent, function () {
                            const action = base.getAction($trigger);
                            base[action ? 'open' : 'close']($target);
                            return false;
                        });

                        // Manage hover event
                    } else if (settings.event == 'hover') {
                        $trigger.off(mouseEnterEvent).on(mouseEnterEvent, function () {
                            clearTimeout(timer);
                            base.open($target);
                        });

                        $target.off(mouseEnterEvent).on(mouseEnterEvent, function () {
                            clearTimeout(timer);
                        });

                        $trigger.add($target).off(mouseLeaveEvent).on(mouseLeaveEvent, function () {
                            timer = setTimeout(function () {
                                base.close();
                            }, settings.delay);
                        });
                    }
                });

                // Manage event for close link
                $('.' + settings.closeClass).off(clickEvent).on(clickEvent, function () {
                    base.close();
                });
                if (settings.event == 'click') {
                    // Manage click outside the close link
                    $html
                        .off(clickEvent)
                        .on(clickEvent, function (event) {
                            if ($lastTarget && event.target.id != 'serialtip' && !$wrapper.find(event.target).length)
                                base.close();
                        });

                    // Close the tooltip on resize to avoid any bug
                    $window.off(resizeEvent).on(resizeEvent, function () {
                        if ($lastTarget)
                            setTimeout(function () {
                                base.setPosition($lastTarget);
                            }, 500);
                    });
                }
            },

            getAction: function ($trigger) {
                return !$trigger.hasClass(settings.activeClass);
            },

            getPosition: function ($trigger, offset) {
                const position = $trigger.data('serialtip-position') || settings.position;
                return {
                    placement: (typeof position === 'string' && position.split(' ')[0]) || 'bottom',
                    alignment: (typeof position === 'string' && position.split(' ')[1]) || 'center'
                };
            },

            getOffset: function (trigger) {
                const clientRect = trigger.getBoundingClientRect();
                const scrollTop = $window.scrollTop();
                const offset = {
                    top: clientRect.top + scrollTop,
                    right: clientRect.right,
                    bottom: clientRect.bottom + scrollTop,
                    left: clientRect.left
                };

                // IE8 and below doesn't provide clientRect.width and clientRect.height and crashes while trying to define them
                offset.width = offset.right - offset.left;
                offset.height = offset.bottom - offset.top;

                return offset;
            },

            setCurrent: function ($trigger, action) {
                $trigger[action ? 'addClass' : 'removeClass'](settings.activeClass);
            },

            setPosition: function ($target) {
                const $trigger = $target.data('serialtip');
                const offset = base.getOffset($trigger[0]);
                const position = base.getPosition($trigger, offset);
                let style = {top: 'auto', right: 'auto', bottom: 'auto', left: 'auto'};

                var currentValue = $trigger.val();
                var StartValue = "";
                var EndValue = "";
                if (currentValue != "") {
                    if (currentValue.includes(",")) {
                        var valueParams = currentValue.split(",");
                        StartValue = (valueParams[0] === undefined && (this.IsDecimal(valueParams[0]) || this.IsInteger(valueParams[0])) ? 0 : valueParams[0]);
                        EndValue = (valueParams[1] === undefined && (this.IsDecimal(valueParams[1]) || this.IsInteger(valueParams[1])) ? "" : valueParams[1]);
                    } else {
                        StartValue = (currentValue === undefined && (this.IsDecimal(currentValue) || this.IsInteger(currentValue)) ? 0 : currentValue);
                        EndValue = (currentValue === undefined && (this.IsDecimal(currentValue) || this.IsInteger(currentValue)) ? 0 : currentValue);
                    }
                }
                var targetcontent = menu2;
                targetcontent = targetcontent.replaceAll("START", StartValue);
                targetcontent = targetcontent.replaceAll("END", EndValue);
                targetcontent = targetcontent.replaceAll("INPUTNAME", $trigger.attr('name'));
                $target.html(targetcontent);
                // Add position class
                const positionClass = 'is-placement-' + position.placement + ' is-alignment-' + position.alignment;
                $target.data('serialtip-class', positionClass).addClass(positionClass);

                // Calculate the placement
                switch (position.placement) {
                    case 'top':
                        style.bottom = $window.height() - offset.top;
                        break;
                    case 'right':
                        style.left = offset.right;
                        break;
                    case 'bottom':
                        style.top = offset.bottom;
                        break;
                    case 'left':
                        style.right = $window.width() - offset.left;
                        break;
                }

                // Calculate the alignment
                switch (position.alignment) {
                    case 'top':
                        style.bottom = $window.height() - offset.bottom;
                        break;
                    case 'right':
                        style.right = $window.width() - offset.left - offset.width;
                        break;
                    case 'bottom':
                        style.top = offset.top;
                        break;
                    case 'left':
                        style.left = offset.left;
                        break;
                    case 'center':
                        (position.placement == 'top' || position.placement == 'bottom')
                            ? style.left = offset.left - ($target.outerWidth(true) - offset.width) / 2
                            : style.top = offset.top - ($target.outerHeight(true) - offset.height) / 2;
                        break;
                }

                // Fix position in order to fit well with small screens
                for (var attr in style)
                    if (style[attr] < 0)
                        style[attr] = 0;

                // Apply final style
                $target.css(style);



            },

            open: function ($target) {
                // Hide the previous target if exists
                if ($lastTarget && !$lastTarget.is($target))
                    base.close();

                // No behavior if the target is already visible
                if ($target.is(':visible'))
                    return;

                // Set absolute positioning
                this.setPosition($target);

                // Show the target
                $target.stop(false, true).fadeIn();

                // Add the current state
                const $trigger = $target.data('serialtip');
                this.setCurrent($trigger, true);

                let comprator = $trigger.closest('th').find('input.operatorValue').val();

                switch (comprator) {
                    case "e":
                        selectorClicked("radio1");
                        break;
                    case "n":
                        selectorClicked("radio2");
                        break;
                    case "bw":
                        selectorClicked("radio3");
                        break;
                    case "notequal":
                        selectorClicked("radio4");
                        break;
                    default:
                        selectorClicked("radio1");
                }
                // Define globally the last target
                $lastTarget = $target;
            },

            close: function () {
                const $target = $lastTarget;
                if (!$target)
                    return;

                // Retrieve the trigger from the target
                const $trigger = $target.data('serialtip');

                // Hide the target
                $target.stop(false, true).fadeOut(function () {
                    // Remove position class
                    const positionClass = $target.data('serialtip-class');
                    $target.removeClass(positionClass);
                });

                // Add the current state
                this.setCurrent($trigger, false);

                // Global reset of the last target
                $lastTarget = false;
            }
        });

        // Init and maintain chainability
        this.init();
        return this;
    };

    $.fn.serialtip.defaults = {
        delay: 300,
        event: 'click',
        // content: menu,
        position: 'bottom center',
        closeClass: 'serialtip-close',
        activeClass: 'is-active',
        getTarget: function ($trigger) {
            var currentValue = $trigger.val();
            var StartValue = "";
            var EndValue = "";
            if (currentValue != "") {
                if (currentValue.includes(",")) {
                    var valueParams = currentValue.split(",");
                    StartValue = (valueParams[0] === undefined && (this.IsDecimal(valueParams[0]) || this.IsInteger(valueParams[0])) ? 0 : valueParams[0]);
                    EndValue = (valueParams[1] === undefined && (this.IsDecimal(valueParams[1]) || this.IsInteger(valueParams[1])) ? "" : valueParams[1]);
                } else {
                    StartValue = (currentValue === undefined && (this.IsDecimal(currentValue) || this.IsInteger(currentValue)) ? 0 : currentValue);
                    EndValue = (currentValue === undefined && (this.IsDecimal(currentValue) || this.IsInteger(currentValue)) ? 0 : currentValue);
                }
            }
            var targetcontent = menu;
            targetcontent = targetcontent.replaceAll("START", StartValue);
            targetcontent = targetcontent.replaceAll("END", EndValue);
            targetcontent = targetcontent.replaceAll("INPUTNAME", $trigger.attr('name'));

            return $(targetcontent);
        }
    };
})(jQuery);

function selectorClicked(data) {
    $(".activelabel").removeClass("activelabel");
    $("." + $.trim(data)).parent().children().addClass("activelabel");
    if (data == "radio1") {
        $('input[name="eq"]').css("display", "inline-block");
        $('input[name="nq"]').css("display", "none");
        $('.input-container').css("display", "none");
        $(".serialtip-btn").attr('data-active-tab', "radio1");
    }
    if (data == "radio2") {
        $(".serialtip-btn").attr('data-active-tab', "radio2");
        $('input[name="nq"]').css("display", "inline-block");
        $('input[name="eq"]').css("display", "none");
        $('.input-container').css("display", "none");
    }
    if (data == "radio3") {
        $(".serialtip-btn").attr('data-active-tab', "radio3");
        $('input[name="eq"]').css("display", "none");
        $('input[name="nq"]').css("display", "none");
        $('.input-container').css("display", "flex").children().attr('data-active-tab', 'radio3');
    }
    if (data == "radio4") {
        $(".serialtip-btn").attr('data-active-tab', "radio4");
        $('input[name="eq"]').css("display", "none");
        $('input[name="nq"]').css("display", "none");
        $('.input-container').css("display", "flex").children().attr('data-active-tab', 'radio4');
    }
}


function selectorSubmited(data) {
    let activetab = $('.btn-submit-' + data).attr("data-active-tab");
    let activeInput = $('.btn-submit-' + data).attr("data-active-input");
    let value = $('input[data-active-tab="' + activetab + '"][data-active-input="' + activeInput + '"]').val();
    value= value.replace(/[^0-9]/g, '');
    if (activetab == 'radio1' || activetab == 'radio2') {
        if (value==""){
            $('.serialtip-close').trigger('click');
            return;
        }
        if (activetab == "radio1") {
            $('input[name="' + activeInput + '"]').closest('th').find('input.operatorValue').val('e');
        }
        if (activetab == "radio2") {
            $('input[name="' + activeInput + '"]').closest('th').find('input.operatorValue').val('n');
        }
        $('input[name="' + activeInput + '"]').val(value);
    } else if (activetab == 'radio3' || activetab == 'radio4') {
        value = $('input[data-active-tab="' + activetab + '"][data-active-input="' + activeInput + '"][name="fbt"]').val();
        let value1 = $('input[data-active-tab="' + activetab + '"][data-active-input="' + activeInput + '"][name="tbt"]').val();
        value= value.replace(/[^0-9]/g, '');
        value1= value1.replace(/[^0-9]/g, '');

        if (value=="" && value1!=""){
        value=value1;
        }
        if (value1=="" && value!=""){
            value1=value;
        }
        if (value>value1){
            let temp=value;
            value=value1;
            value1=temp;
        }
        if (value=="" && value1==""){
            $('.serialtip-close').trigger('click');
            return;
        }
        if (activetab == "radio3") {
            $('input[name="' + activeInput + '"]').closest('th').find('input.operatorValue').val('bw');
        }
        if (activetab == "radio4") {
            $('input[name="' + activeInput + '"]').closest('th').find('input.operatorValue').val('notequal');
        }
         $('input[data-active-tab="' + activetab + '"][data-active-input="' + activeInput + '"][name="tbt"]').val("");
        $('input[name="' + activeInput + '"]').val(value + ',' + value1);
    }
    $('input[data-active-tab="' + activetab + '"][data-active-input="' + activeInput + '"]').val("");
    closeSerialtip();
}


$(document).on('keyup', ".serialtip-input", function(){
    value=$(this).val();
    value=value.replaceAll(",","");
    $(this).val(commafy(value));
});

function closeSerialtip() {
    $('.serialtip-close').trigger('click');
}

function commafy( num ) {
    var str = num.toString().split('.');
    if (str[0].length >= 3) {
        str[0] = str[0].replaceAll(/(\d)(?=(\d{3})+$)/g, '$1,');
    }
    if (str[1] && str[1].length >= 3) {
        str[1] = str[1].replaceAll(/(\d{3})/g, '$1 ');
    }
    return str.join('.');
}