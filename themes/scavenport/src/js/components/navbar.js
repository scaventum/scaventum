import $ from 'jquery'

export default function navbar() {
    $(document).ready(function () {
        $('.navbar-toggler').on('click', function () {
            $('.animated-icon').toggleClass('open')
        })
    })
}