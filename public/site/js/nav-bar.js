
$(function () {    initilizeMenus();

    var a = $('.link-item:has(a[href="'+window.location+'"])');
    a.addClass('active');
    a.find('a').attr("href","#");

});
function initilizeMenus() {


    var $now_a = $('#nav-bar a[href^="' + getHtmlName() + '"]').first();

    var $now_a_excact = $('a[href="' + getHtmlName(true).split('#')[0] + '"]');
    var $list = $("#nav-bar ul li");

    console.log(getHtmlName(), getHtmlName(true));
    if ($now_a_excact) {
        $now_a_excact.attr('href', '#');
        var $now_li = $now_a_excact.parents('li:first');
        var $now_div = $now_a_excact.parents('.link-item:first');
        $now_li.addClass('active');
        $now_div.addClass('active');
        var $now_li_parent = $now_li.parents('li').addClass('active');
    }
    if ($now_a) {
        $now_a.attr('href', '#');
        var $now_li = $now_a.parents('li:first');
        var $now_div = $now_a.parents('.link-item:first');
        $now_li.addClass('active');
        $now_div.addClass('active');
        var $now_li_parent = $now_li.parents('li').addClass('active');
    }
    $('[class*="sub-menu-level-"]').each(function () {
        var $parent_sub_menu = $(this).parents('.sub-menu');
            var a = parseInt(this.className.split("level-")[1]);
        console.log('class',a);
        this.style.left = $parent_sub_menu.css('width') + "px";
//var $a = $(this).siblings().first();
//            this.style.top=($a.offsetParent().top-44)+"px";
    });
    $list.hover(
        function () {

            var $submenu = $(this).find('ul.sub-menu:first');
            if($submenu.hasClass("collapsing")) return;
            $submenu.slideDown('fast');
        },
        function () {
            var $submenu = $(this).find('ul.sub-menu:first');
            $submenu.addClass("collapsing");
            $submenu.slideUp('medium',function () {
                $submenu.removeClass("collapsing");
            });
        }
    );
    $("#nav-bar li.active").parents('li').addClass('active')
}
function getHtmlName(b) {
    var a = location.href.split('/');
    if(a[a.length-1].length==0) return'index.html';
if(b) return a[a.length-1];
    return a[a.length-1].split('?')[0].split('#')[0];
}
function getJsonFromUrl() {
    var query = location.search.substr(1);
    var result = {};
    query.split("&").forEach(function(part) {
        var item = part.split("=");
        result[item[0]] = decodeURIComponent(item[1]);
    });
    return result;
}/**
 * Created by Khondoker on 25-06-17.
 */
