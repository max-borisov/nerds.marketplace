$(function(){
    // Change items order
    $('#sort').on('change', function() {
        // If siteUrl exists
        if (typeof window.siteUrl == 'string' ) {
            location.href = siteUrl + '&sort=' + $(this).val();
        }
    })
})

$(document).delegate('*[data-toggle="lightbox"]', 'click', function(event) {
    event.preventDefault();
    $(this).ekkoLightbox();
});