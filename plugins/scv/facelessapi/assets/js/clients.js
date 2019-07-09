$(document).ready(function() {
    $("#btn-key-copy").click(function() {
        copyToClipboard("#Form-field-Client-key")
    })

    $("#btn-key-generate").click(function() {
        $.request('onGenerateKey', {
            loading: $.oc.stripeLoadIndicator,
            success: function(response) {
                $(".input-key").val(response.result);
            }
        })
    })

    $("#Lists").on('change','.client-selector-columns-active',function() {
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

function copyToClipboard(query) {
    var copyText = $(query)[0]
    copyText.select()
    document.execCommand("copy")
}
