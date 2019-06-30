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
})

function copyToClipboard(query) {
    var copyText = $(query)[0]
    copyText.select()
    document.execCommand("copy")
}
