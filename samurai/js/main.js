// jQuery(document).ready(function($) {

//     scrollTo = {
//         target: $('.menu a, .btn-go, .goup'),
//         root: $('html, body'),
//         init: function() {
//             scrollTo.target.click(function() {
//                 scrollTo.root.animate({
//                     scrollTop: $($.attr(this, 'href')).offset().top - 120
//                 }, 500);
//                 return false;
//             });
//         }
//     }

//     scrollTo.init();

//     popup = $('.popup-demo');

//     if(popup.length){
//         popupClose = $('.popup-close');
//         popup.fadeIn('fast', function() {
            
//         });

//         popupClose.on('click',function(){
//             $(this).closest('.popup-demo').fadeOut('fast', function() {
//                 $(this).remove();
//             });
//         });
//     }

// });