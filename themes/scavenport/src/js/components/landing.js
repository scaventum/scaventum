import $ from 'jquery'

export default function landing() {
    // By Chris Coyier & tweaked by Mathias Bynens
    var isMobile = {
        Android: function() {
            return navigator.userAgent.match(/Android/i);
        },
        BlackBerry: function() {
            return navigator.userAgent.match(/BlackBerry/i);
        },
        iOS: function() {
            return navigator.userAgent.match(/iPhone|iPad|iPod/i);
        },
        Opera: function() {
            return navigator.userAgent.match(/Opera Mini/i);
        },
        Windows: function() {
            return navigator.userAgent.match(/IEMobile/i) || navigator.userAgent.match(/WPDesktop/i);
        },
        any: function() {
            return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
        }
    };

    if( isMobile.any() ){
        $(".landing--video-link").hide();
    }

	// Find all YouTube videos
	var $allVideos = $("iframe[src^='https://www.youtube.com']"),
	// The element that is fluid width
    $fluidEl = $(".landing")
    
	// Figure out and save aspect ratio for each video
	$allVideos.each(function() {

		$(this)
			.data('aspectRatio', this.height / this.width)
			
			// and remove the hard coded width/height
			.removeAttr('height')
            .removeAttr('width');

	});

	// When the window is resized
	// (You'll probably want to debounce this)
	$(window).resize(function() {
		var newWidth = $fluidEl.width();
        var newHeight = $fluidEl.height();
        
        var screenAspectRation = newHeight/newWidth;
		
		// Resize all videos according to their own aspect ratio
		$allVideos.each(function() {
            
            var $el = $(this);
            
            if(screenAspectRation > $el.data('aspectRatio')) {
                $el
                    .width(newHeight / $el.data('aspectRatio'))
                    .height(newHeight);
            }else{
                $el
                    .width(newWidth)
                    .height(newWidth * $el.data('aspectRatio'));
            }

		});

	// Kick off one resize to fix all videos on page load
	}).resize();

}