$(document).ready(function() {

    $(".page-fields-template_id").change(function() {
        $.request("onRefreshBlocks", {
            loading: $.oc.stripeLoadIndicator,
            success: function(response) {
               
            }
        });
    });
});