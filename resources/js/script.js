$(function () {
    $('.search-toggler').on('click', function(){
        $( ".searchCol > .container-max" ).slideToggle( "slow", function() { });
        return false;
    });
});