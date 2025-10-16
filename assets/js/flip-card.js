// jQuery(document).ready(function($) {
//     let isFlipped = false;
//     let flipTimeout;

//     // Handle card hover
//     $('.card').hover(
//         function() {
//             // Mouse enter
//             clearTimeout(flipTimeout);
//             $(this).addClass('flipped');
//             isFlipped = true;
//         },
//         function() {
//             // Mouse leave
//             const $card = $(this);
//             flipTimeout = setTimeout(function() {
//                 $card.removeClass('flipped');
//                 isFlipped = false;
//             }, 100); // Small delay to prevent accidental flips
//         }
//     );

//     // Add touch support for mobile devices
//     $('.card').on('touchstart', function(e) {
//         e.preventDefault();
//         const $card = $(this);
//         if (!isFlipped) {
//             $card.addClass('flipped');
//             isFlipped = true;
//         } else {
//             $card.removeClass('flipped');
//             isFlipped = false;
//         }
//     });
// }); 
