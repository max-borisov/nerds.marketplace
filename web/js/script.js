$(function(){
    $('#sort').on('change', function() {
        if (typeof window.siteUrl == 'string' ) {
            location.href = siteUrl + '&sort=' + $(this).val();
        }
    })
})