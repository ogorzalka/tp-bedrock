/**
 * initializeBlock
 */
var initializeBlock = function( block ) {

  console.log('initialize block');
  // if it's the acf objet
  if (block instanceof jQuery) {
    block = block.get(0);
  }

  let $slider = block.classList.contains('swiper') ? block : block.querySelector('.swiper');

  new Swiper($slider, {
    loop: true,
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    }
  });
}

// Vanilla
document.addEventListener("DOMContentLoaded", function() {
  document.querySelectorAll('.swiper').forEach(el => {
    initializeBlock(el);
  });
});


// Initialize dynamic block preview (editor).
if( window.acf ) {
  window.acf.addAction( 'render_block_preview/type=slider', initializeBlock );
  window.acf.addAction( 'remount', initializeBlock );
}
