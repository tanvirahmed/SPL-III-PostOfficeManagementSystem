/**
 * Created by Khondoker on 10/30/2017.
 */
(function ($){
    'use strict';
     $("#add-entity").click(function () {
         var $this =$(this);
         var dialog=showDialog({text:$($this.data('t')).tmpl({}).html(),positive:{'title':'add',onClick:function(){$(dialog).find("form").submit()}}})
     });
    $("#edit-entity").click(function () {
        var selected=$(window.datatable.rows().nodes()).filter('.selected');
        if(selected.length==0) {
            $.toast({title:'Select branch or branches'});
            return;
        }
        var ids = [];
        selected.each(function(){ids[ids.length]=$(this).data("id")});
        $('#edit-form input[name="ids"]').val(JSON.stringify(ids));
        $('#edit-form').submit();
    });
    $("#delete-entity").click(function () {
        var selected=$(window.datatable.rows().nodes()).filter('.selected');
        if(selected.length==0) {
            $.toast({title:'Select branch or branches'});
            return;
        }
        showDialog({
            text: 'Are you sure to delete?', positive: {
                title: 'YES', onClick: function () {
                    showLoading();
                    var ids = [];
                    selected.each(function () {
                        ids[ids.length] = $(this).data("id")
                    });
                    $('#delete-form input[name="ids"]').val(JSON.stringify(ids));
                    $('#delete-form').submit();
                }
            }
        ,negative:{title:'cancel'}});

    });

})(jQuery);
