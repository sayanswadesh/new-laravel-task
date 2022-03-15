$(document).ready(function() {
    var CurrentURL = window.location.href.split('?')[0];

    $("body").on("click", "a[data-confirm], button[data-confirm]", function(ev) {
        var href = $(this).attr('href');
        var title = $(this).attr("data-title");

        if (!$('#dataConfirmModal').length) {
            $('body').append('<div id="dataConfirmModal" class="modal" role="dialog" aria-labelledby="dataConfirmLabel" aria-hidden="true"><div class="modal-dialog modal-sm" style="width: 50%;"><div class="modal-content"><div class="modal-header"><h5 id="dataConfirmLabel" class="modal-title">' + title + '</h5><button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button></div><div class="modal-body"></div><div class="modal-footer"><button class="btn btn-sm btn-secondary btn-sm" data-dismiss="modal" aria-hidden="true"><i class="fa fa-close"></i> Cancel</button><a class="btn btn-sm btn-success btn-sm" id="dataConfirmOK"> Yes</a></div></div></div></div>');
        }
        $('#dataConfirmModal').find('.modal-body').html($(this).attr('data-confirm'));
        $('#dataConfirmOK').attr('href', href);
        $('#dataConfirmModal').modal({ show: true });
        return false;
    });

    //Header Search bar  select option
    $('.search-panel .dropdown-menu').find('a').click(function(e) {
        e.preventDefault();
        var param = $(this).attr("href").replace("#", "");
        var concept = $(this).text();
        $('.search-panel span#search_concept').text(concept);
        $('.input-group #search_param').val(param);
    });

    //Sidebar Menu Active
    $.each($('.sidebar-menu li a'), function(index, value) {
        if ($(this).attr('href') == CurrentURL) {
            $(this).parent('li').addClass('active');
            $(this).parent().parent('ul').show();
            $(this).parent().parent().parent('li').addClass('menu-open');
        }
    });


    //Setting Sidebar Menu Active
    $.each($('.settingSidebar li a'), function(index, value) {
        if ($(this).attr('href') == CurrentURL) {
            $(this).parent('li').addClass('active');
        }
    });

    //Setting Profile Tab Active
    $.each($('.profile-tab .nav-tabs li a'), function(index, value) {
        if ($(this).attr('href') == CurrentURL) {
            $(this).parent('li').addClass('active');
        }
    });

    //Tab Menu Active
    $.each($('.CustomTab .nav-tabs li a'), function(index, value) {
        if ($(this).attr('href') == CurrentURL) {
            $(this).parent('li').addClass('active');
        }
    });

    //Ajax Load Content
    var FailedFetchHtmlModel = '<div class="modal-body"><div class="callout callout-danger"><p><i class="fa fa-times"></i> Failed to fetch the data</p></div></div><div class="modal-footer"><button type="button" class="btn btn-default" data-dismiss="modal"><span class="fa fa-close"></span> Close</button></div>';
    $("body").on("click", "[data-act=ajax-modal]", function() {
        var url = $(this).attr("data-action-url");
        var title = $(this).attr("data-title");
        var appendID = $(this).attr("data-append-id");

        var loaderHtml = '<div class="modal-body shop text-center"><img src="' + settings.LoaderGif + '"></div>';
        $('#' + appendID).html(loaderHtml);

        $('#AjaxModelTitle').html(title);
        $('#AjaxModel').modal({
            backdrop: 'static'
        });
        $.ajax({
            type: "GET",
            url: url,
            data: '',
            success: function(data) {
                $('#' + appendID).html(data);
            },
            error: function() {
                $('#' + appendID).html(FailedFetchHtmlModel);
            }
        });
    });
});

function alert(Msg = '', Title = 'Alert') {
    if (!$('#alertModal').length) {
        $('body').append('<div id="alertModal" class="modal" role="dialog" aria-labelledby="dataConfirmLabel" aria-hidden="true"><div class="modal-dialog" style="width: 50%;"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button><h3 id="dataConfirmLabel"></h3></div><div class="modal-body"></div><div class="modal-footer"><button class="btn btn-primary btn-flat" data-dismiss="modal" aria-hidden="true"><i class="fa fa-check-circle"></i> OK</button></div></div></div></div>');
    }
    $('#alertModal').find('#dataConfirmLabel').html(Title);
    $('#alertModal').find('.modal-body').html(Msg);
    $('#alertModal').modal({ show: true });
    return false;
}


//toaster popup message
toastr.options = {
    "closeButton": true,
    "debug": false,
    "newestOnTop": false,
    "progressBar": true,
    "positionClass": "toast-bottom-right",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
};

$(document).on("click", "i.del", function() {
    $(this).parent().remove();
});