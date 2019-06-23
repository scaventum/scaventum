$(document).ready(function() {
    $("#btn-key-copy").click(function() {
        copyToClipboard("#Form-field-Client-key")
    })

    $("#btn-key-generate").click(function() {
        $("#Form-field-Client-key").val(makeRandomString(20))
    })
})

function makeRandomString(length) {
    var result = ""
    var characters =
        "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789"
    var charactersLength = characters.length
    for (var i = 0; i < length; i++) {
        result += characters.charAt(
            Math.floor(Math.random() * charactersLength)
        )
    }
    return result
}

function copyToClipboard(query) {
    var copyText = $(query)[0]
    copyText.select()
    document.execCommand("copy")
}
