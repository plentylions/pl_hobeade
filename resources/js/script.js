$(function () {
    $('.search-toggler').on('click', function(){
        $( ".searchCol .search-box-inner" ).slideToggle( "slow", function() { });
        return false;
    });
});