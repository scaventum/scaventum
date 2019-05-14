import $ from 'jquery'
import platform from '../helpers/platform'

// Figure out and save aspect ratio for each video
function setVideoResolution(videos){
    videos.each(function() {

		$(this)
			.data('aspectRatio', this.height / this.width)		
			// and remove the hard coded width/height
			.removeAttr('height')
            .removeAttr('width')

	});
}

// Resize all videos according to their own and disregarding container aspect ratio
function resizeVideo(videos,container = $(window)){
    // Resized container size
    var newWidth = container.width(),
        newHeight = container.height(),
        // Container aspect ratio
        screenAspectRatio = newHeight/newWidth

    videos.each(function() {
        var $el = $(this)
    
        // Keep full background video disregarding container aspect ratio
        if(screenAspectRatio > $el.data('aspectRatio')) {
            $el
                .width(newHeight / $el.data('aspectRatio'))
                .height(newHeight);
        }else{
            $el
                .width(newWidth)
                .height(newWidth * $el.data('aspectRatio'))
        }

    });
}

export default function landing() {

    if( platform.isMobile()){
        $(".landing--video-link").hide()
    }

	// Find all linked videos
    var $linkVideos = $(".landing--video-link"),   
	    // Find all uploaded videos
        $uploadVideos = $(".landing--video-upload"),
	    // The element that is fluid width
        $container = $(".landing")

    setVideoResolution($linkVideos)
    setVideoResolution($uploadVideos)
	
	// When the window is resized
	// (You'll probably want to debounce this)
	$(window).resize(function() {

        resizeVideo($linkVideos,$container)
        resizeVideo($uploadVideos,$container)
		
	// Kick off one resize to fix all videos on page load
	}).resize()

}