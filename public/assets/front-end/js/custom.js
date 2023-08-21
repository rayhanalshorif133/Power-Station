$(document).ready(function () {
    handleMobile_menu_btn();
   
});
 
function handleMobile_menu_btn() { 
    $('#open_mobile_menu_button').click(function () {
       $('#mobile_menu').addClass('block');
       $('#mobile_menu').removeClass('hidden');
   });
   $('#close_mobile_menu_button').click(function () {
       $('#mobile_menu').removeClass('block');
       $('#mobile_menu').addClass('hidden');
   });
}

