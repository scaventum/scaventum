$(document).ready(function() {
    $.request("onCheckClientSelector", {
        success: function(response) {
            if (response.name) {
                var clientSelector = $(
                    "<div id='layout-facelessapi-client-selector'><i class='icon-user'></i>" +
                        "&emsp;<a target='_blank' href='" +
                        response.config.site_address +
                        "'" +
                        " id='layout-facelessapi-client-selector-site-address'>" +
                        response.name +
                        "</a></div>"
                ).hide()

                $("#layout-mainmenu")
                    .parent()
                    .append(clientSelector)

                clientSelector.slideDown()
            }
        }
    })
})
