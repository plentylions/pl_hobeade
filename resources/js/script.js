$(function () {
    $('.search-toggler').on('click', function(){
        $( ".searchCol .search-box-inner" ).slideToggle( "slow", function() { });
        return false;
    });

    if ($('#page-header').attr('data-sticky') == 'true') {
        // Check the initial Poistion of the Sticky Header
        var stickyHeaderTop = $('#page-header').offset().top;

        $(window).scroll(function () {
            if ($(window).scrollTop() > stickyHeaderTop && $('#page-header').is(':visible')) {
                $('body').css("margin-top", $('#page-header').height());
                $('#page-header').addClass('sticky');
            } else {
                $('#page-header').removeClass('sticky');
                $('body').css("margin-top", 0);
            }
        });
    }
});