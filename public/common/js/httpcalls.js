/**
 * Created by Khondoker on 9/4/2017.
 */
var __http ={};
function httpSetup(http) {
    __http=http;
}
function http(options) {
    var a;
    if(__http!=undefined) options=$.extend(options,__http);


    return a = $.extend({
        setUrl: function (url) {
            a.url = url;
            return a;
        },
        getUrl: function () {
            return a.url ;

        },
        getData: function () {
            return a.data ;

        },
        setElement: function (element) {
            a.triggeredElement = element;
            return a;
        },
        setMethod: function (method) {
            a.method = method;
            return a;
        },
        setData: function (data) {
            a.data = data;
            console.log(data);
            return a;
        },

        setRequestBody: function (data) {
            a.data = JSON.stringify(data);
            return a;
        },
        preExecute: function (callback) {
            if (typeof(callback) === "function") a.preCallback = callback;
            return a;
        },
        done:function (callback) {
            if (typeof(callback) === "function") a.doneCallback = callback;
            return a;
        },
        fail:function (callback) {
            if (typeof(callback) === "function") a.failCallback = callback;
            return a;
        },
        always:function (callback) {
            if (typeof(callback) === "function") a.alwaysCallback = callback;
            return a;
        },
        progress:function (callback) {
            if (typeof(callback) === "function") a.progressCallback = callback;
            return a;
        },
        execute: function () {
            a.isBusy=true;

            if(a.loader!=null) a.loader.remove();
            if(a.preCallback!=null)a.preCallback(a);
            if(a.triggeredElement!=null && a.triggeredElement.nodeType == Node.ELEMENT_NODE) {
                $(a.triggeredElement).addClass('not-clickable');
                var offset = $(a.triggeredElement).offset();
                var height =  parseInt($(a.triggeredElement).css("height"));
                var width =  parseInt($(a.triggeredElement).css("width"));
                var position= "absolute";
                var fixedParent = $(a.triggeredElement).parents('.position-fixed').first();
                if(fixedParent) if(fixedParent.css("position")&& fixedParent.css("position").toLowerCase().indexOf("fixed")==0) position="fixed";
                a.loader = $('<div class="loader8" style="width:'+width+'px;margin:0;margin-top:-2px;position: '+position+';z-index: 20000;;left:'+offset.left+'px;top:'+(height+offset.top)+'px"> </div>')
                $(document.body).append(a.loader);
            }
            a.ajax = $.ajax({
                type: a.method?a.method:"GET",
                data: a.data,
                url: a.url,
                xhr: function() {
                    var xhr = new window.XMLHttpRequest();

                    xhr.upload.addEventListener("progress", function(evt) {
                        if (evt.lengthComputable) {
                            var percentComplete = evt.loaded / evt.total;
                            percentComplete = parseInt(percentComplete * 100);
                            console.log(percentComplete);
                            if(a.progressCallback!=null) a.progressCallback(evt,percentComplete);

                            a.isBusy=true;
                            if (percentComplete === 100) {

                            }

                        }
                    }, false);

                    return xhr;
                },
            });
            a.ajax.done(function (response) {if(a.doneCallback!=null) a.doneCallback(response,a);return a })
            a.ajax.fail(function ( jqXHR, textStatus, errorThrown ) {if(a.failCallback!=null) a.failCallback( jqXHR, textStatus, errorThrown );return a })
            a.ajax.always(function() {a.isBusy=false; if(a.alwaysCallback!=null)a.alwaysCallback(a);if(a.loader!=null)a.loader.remove();;if(a.triggeredElement!=null && a.triggeredElement.nodeType == Node.ELEMENT_NODE) $(a.triggeredElement).removeClass('not-clickable');return a;  });

            a.ajax.progress(function (event) {console.log(event)});
            return a;
        }
    },options);
}