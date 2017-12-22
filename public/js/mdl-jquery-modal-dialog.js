function showLoading() {
    document.body.style.overflow="hidden";
    // remove existing loaders
    $('.loading-container').remove();
    $('<div id="orrsLoader" class="loading-container"><div><div class="mdl-spinner mdl-js-spinner is-active"></div></div></div>').appendTo("body");

    componentHandler.upgradeElements($('.mdl-spinner').get());
    setTimeout(function () {
        $('#orrsLoader').css({opacity: 1});
    }, 1);
}

function hideLoading() {
    document.body.style.overflow="unset";
    $('#orrsLoader').css({opacity: 0});
    setTimeout(function () {
        $('#orrsLoader').remove();
    }, 400);
}

function showDialog(options) {
    var dialog=null;
    options = $.extend({
        id: 'orrsDiag',
        title: null,
        text: null,
        maxWidth:500,
        neutral: false,
        negative: false,
        positive: false,
        cancelable: true,
        contentStyle: null,
        onLoaded: false,
        onHidden: false,
        hideOther: true
    }, options);

    if (options.hideOther) {
        // remove existing dialogs
        $('.dialog-container').remove();
        $(document).unbind("keyup.dialog");
    }

    $('<div id="' + options.id + '" class="dialog-container"><div class="mdl-card mdl-shadow--16dp" id="' + options.id + '_content" style="max-width: '+options.maxWidth+'px"></div></div>').appendTo("body");
    dialog = $('#' + options.id);
    var content = dialog.find('.mdl-card');
    if (options.contentStyle != null) content.css(options.contentStyle);
    if (options.title != null) {
        $('<h5>' + options.title + '</h5>').appendTo(content);
    }
    if (options.text != null) {
        $('<p>' + options.text + '</p>').appendTo(content);
    }

    if (options.neutral || options.negative || options.positive) {
        var buttonBar = $('<div class="mdl-card__actions dialog-button-bar"></div>');
        if (options.neutral) {
            options.neutral = $.extend({
                id: 'neutral',
                title: 'Neutral',
                onClick: null
            }, options.neutral);
            var neuButton = $('<button class="mdl-button mdl-js-button mdl-js-ripple-effect" id="' + options.neutral.id + '">' + options.neutral.title + '</button>');
            neuButton.click(function (e) {
                e.preventDefault();
                if (options.neutral.onClick == null || !options.neutral.onClick(e,dialog))
                    hideDialog(dialog, options.onHidden)
            });
            neuButton.appendTo(buttonBar);
        }
        if (options.negative) {
            options.negative = $.extend({
                id: 'negative',
                title: 'Cancel',
                onClick: null
            }, options.negative);
            var negButton = $('<button class="mdl-button mdl-js-button mdl-js-ripple-effect" id="' + options.negative.id + '">' + options.negative.title + '</button>');
            negButton.click(function (e) {
                e.preventDefault();
                if (options.negative.onClick == null || !options.negative.onClick(e))
                    hideDialog(dialog, options.onHidden)
            });
            negButton.appendTo(buttonBar);
        }
        if (options.positive) {
            options.positive = $.extend({
                id: 'positive',
                title: 'OK',
                onClick: null
            }, options.positive);
            var posButton = $('<button class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" id="' + options.positive.id + '">' + options.positive.title + '</button>');
            posButton.click(function (e) {
                e.preventDefault();
                var okay=true;
                $(dialog).find('select,input,textarea').filter(':visible').each(function () {
                    if(this.value.length==0) {
                        okay=false;
                        return
                    }
                });
                if(okay) {
                    if (options.positive.onClick == null || !options.positive.onClick(e, dialog))


                        hideDialog(dialog, options.onHidden);
                } else {
                    $.toast({title:'Please fill all fields'});
                }
            });
            posButton.appendTo(buttonBar);
        }
        buttonBar.appendTo(content);

    }
    componentHandler.upgradeDom();
    if (options.cancelable) {
        dialog.click(function () {
            hideDialog(dialog, options.onHidden);
        });
        $(document).bind("keyup.dialog", function (e) {
            if (e.which == 27)
                hideDialog(dialog, options.onHidden);
        });
        content.click(function (e) {
            e.stopPropagation();
        });
    }
    setTimeout(function () {
        dialog.css({opacity: 1});
        if (options.onLoaded)
            options.onLoaded();
    }, 1);
    document.body.style.overflow="hidden";
    return dialog;
}
function showModal(options,selector) {
    options = $.extend({
        id: 'orrsDiag',
        title: null,
        text: null,
        neutral: false,
        negative: false,
        positive: false,
        cancelable: true,
        contentStyle: null,
        onLoaded: false,
        onHidden: false,
        hideOther: true
    }, options);

    if (options.hideOther) {
        // remove existing dialogs
        $('.dialog-container').remove();
        $(document).unbind("keyup.dialog");
    }

    var $some = $('<div id="' + options.id + '" class="dialog-container"><div class="mdl-card mdl-shadow--16dp modal-content" id="' + options.id + '_content" ></div></div>').appendTo("body");

$some.find('.modal-content').append($(selector));
    var dialog = $('#' + options.id);
    var content = dialog.find('.mdl-card');
    if (options.contentStyle != null) content.css(options.contentStyle);
    // if (options.title != null) {
    //     $('<h5>' + options.title + '</h5>').appendTo(content);
    // }
    // if (options.text != null) {
    //     $('<p>' + options.text + '</p>').appendTo(content);
    // }
    if (options.neutral || options.negative || options.positive) {
        var buttonBar = $('<div class="mdl-card__actions dialog-button-bar"></div>');
        if (options.neutral) {
            options.neutral = $.extend({
                id: 'neutral',
                title: 'Neutral',
                onClick: null
            }, options.neutral);
            var neuButton = $('<button class="mdl-button mdl-js-button mdl-js-ripple-effect" id="' + options.neutral.id + '">' + options.neutral.title + '</button>');
            neuButton.click(function (e) {
                e.preventDefault();
                if (options.neutral.onClick == null || !options.neutral.onClick(e))
                    hideDialog(dialog, options.onHidden)
            });
            neuButton.appendTo(buttonBar);
        }
        if (options.negative) {
            options.negative = $.extend({
                id: 'negative',
                title: 'Cancel',
                onClick: null
            }, options.negative);
            var negButton = $('<button class="mdl-button mdl-js-button mdl-js-ripple-effect" id="' + options.negative.id + '">' + options.negative.title + '</button>');
            negButton.click(function (e) {
                e.preventDefault();
                if (options.negative.onClick == null || !options.negative.onClick(e))
                    hideDialog(dialog, options.onHidden)
            });
            negButton.appendTo(buttonBar);
        }
        if (options.positive) {
            options.positive = $.extend({
                id: 'positive',
                title: 'OK',
                onClick: null
            }, options.positive);
            var posButton = $('<button class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" id="' + options.positive.id + '">' + options.positive.title + '</button>');
            posButton.click(function (e) {
                e.preventDefault();
                if (options.positive.onClick == null || !options.positive.onClick(e))
                    hideDialog(dialog, options.onHidden)
            });
            posButton.appendTo(buttonBar);
        }
        buttonBar.appendTo(content);
    }
    componentHandler.upgradeDom();
    if (options.cancelable) {
        dialog.click(function () {
            hideDialog(dialog, options.onHidden);
        });
        $(document).bind("keyup.dialog", function (e) {
            if (e.which == 27)
                hideDialog(dialog, options.onHidden);
        });
        content.click(function (e) {
            e.stopPropagation();
        });
    }
    setTimeout(function () {
        dialog.css({opacity: 1});
        if (options.onLoaded)
            options.onLoaded();
    }, 1);
}

function hideDialog(dialog, callback) {
    document.body.style.overflow="unset";
    $(document).unbind("keyup.dialog");
    dialog.css({opacity: 0});
    setTimeout(function () {
        dialog.remove();
        if (callback)
            callback();
    }, 400);
}