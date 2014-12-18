$(document).delegate('*[data-toggle="lightbox"]', 'click', function(event) {
    event.preventDefault();
    $(this).ekkoLightbox();
});

$(function() {
    // Change items order
    $('#sort').on('change', function() {
        // If siteUrl exists
        if (typeof window.siteUrl == 'string' ) {
            location.href = siteUrl + '&sort=' + $(this).val();
        }
    })

    // Delete item
    $('.item-delete').on('click', function(event) {
        event.preventDefault();
        if (confirm('Are you sure you want to delete this item ? ')) {
            location.href = $(this).attr('href');
        }
    })

    // Delete category
    $('.category-table .delete-category-link').on('click', function(event) {
        event.preventDefault();
        if (confirm('Are you sure you want to delete category ?')) {
            location.href = $(this).attr('href');
        }
    })
})

