$(document).ready(function() {
    $("#Lists").on('change','.theme-columns-active',function() {
        let active = 0
        if($(this).find('input').is(':checked') == true){
            active = 1
        }
        $.request('onToggleActive', {
            data: {
                id: $(this).data('id'),
                active: active
            },
            loading: $.oc.stripeLoadIndicator
        })
    })
})
