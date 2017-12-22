/**
 * Created by Khondoker on 10/30/2017.
 */
(function ($) {
    'use strict';
    $("#add-entity").click(function () {
        var $this = $(this);
        var dialog = showDialog({
            id: 'add_track', maxWidth: '600', text: $($this.data('t')).tmpl({}).html(), positive: {
                'title': 'add', onClick: function () {
                    var newTrack = {};
                    $("#add_track_content").find('select,input').each(function () {
                        newTrack[this.name] = this.value;
                    });
                    var url = $("#add_track_content [data-action]").data("action");
                    http({url: url, method: 'post', data: newTrack}).done(function (data) {
                        if(data.update) {


                            window.datatable.row($(window.datatable.rows().nodes()).filter('[data-id="'+data.track.id+'"]')[0]).remove().draw()
                        }
                        window.datatable.row.add($("#track-row").tmpl(data.track)[0]).draw();

                        var nodes = window.datatable.rows().nodes();
                        $("#current").html(nodes[nodes.length - 1].cells[1].textContent);
                    }).preExecute(function () {
                        showLoading();
                    }).always(function () {
                        hideLoading()
                    }).execute();
                }
            }
        })
    });
    $("#show-in-map").click(function () {
        showLoading();
        $("#map-form").submit()
    })
    $("#edit-entity").click(function () {
        var selected = $(window.datatable.rows().nodes()).filter('.selected');
        if (selected.length == 0) {
            $.toast({title: 'Select branch or branches'});
            return;
        }
        var ids = [];
        selected.each(function () {
            ids[ids.length] = $(this).data("id")
        });
        $('#edit-form input[name="ids"]').val(JSON.stringify(ids));
        $('#edit-form').submit();
    });
    $("#delete-entity").click(function () {
        var selected = $(window.datatable.rows().nodes()).filter('.selected');
        if (selected.length == 0) {
            $.toast({title: 'Select branch or branches'});
            return;
        }
        var dialog = showDialog({
            text: 'Are you sure to delete?', positive: {
                title: 'YES', onClick: function () {
                    showLoading();
                    var ids = [];
                    selected.each(function () {
                        ids[ids.length] = $(this).data("id")
                    });
                    http({url: delete_url, method: 'post', data: {ids: ids}}).done(function (data) {
                        window.datatable.rows($(window.datatable.rows().nodes()).filter('.selected')).remove();
                        window.datatable.draw();
                        var nodes = window.datatable.rows().nodes();
                        if (nodes.length == 0) {
                            $("#current").html($("#source").html());
                        } else {

                            $("#current").html(nodes[nodes.length - 1].cells[1].textContent);
                        }
                        // window.location.reload();
                    }).preExecute(function () {
                        showLoading();
                    }).always(function () {
                        hideLoading()
                    }).execute();
                }
            }
            , negative: {title: 'cancel'}
        });

    });

})(jQuery);
