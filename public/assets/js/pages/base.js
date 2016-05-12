$(document).ready(function() {
    $(".sub_category").click(function(e) {
        e.preventDefault();
        category = $(this).closest('ul').siblings('a').children('span').text();
        sub_category = $(this).text();
        // $(this).attr('href', function(i, h) {
        //     return h + (h.indexOf('?') != -1 ? "&category=" + category + "&sub_category=" + sub_category : "?category=" + category + "&sub_category=" + sub_category);
        // });
        $.get("plans-manager", {'category': category, 'sub_category': sub_category});
    });
});