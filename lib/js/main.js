// Set jQuery $ variable
(function ($) {
   $(document);

//Enable smooth scroll
$(function() {
      if (SmoothScroll.scroll == '1') {
        //do nothing
    } else {
  $('a[href*=#]:not([href=#])').click(function() {
    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
      if (target.length) {
        $('html,body').animate({
          scrollTop: target.offset().top - 50
        }, 500);
        return false;
      }
    }
  });
  }
});

// Enable responsive menus
( function( window, $, undefined ) {
  'use strict';
 
  $( 'nav' ).before( '<button class="menu-toggle" role="button" aria-pressed="false"></button>' ); // Add toggles to menus
  $( 'nav .sub-menu' ).before( '<button class="sub-menu-toggle" role="button" aria-pressed="false"></button>' ); // Add toggles to sub menus
 
  // Show/hide the navigation
  $( '.menu-toggle, .sub-menu-toggle' ).on( 'click', function() {
    var $this = $( this );
    $this.attr( 'aria-pressed', function( index, value ) {
      return 'false' === value ? 'true' : 'false';
    });
 
    $this.toggleClass( 'activated' );
    $this.next( 'nav, .sub-menu' ).slideToggle( 'fast' );
 
  });
 
})( this, jQuery );

//Init Masonry
var container = document.querySelector('#collection-container');
if ( container != null ){
var msnry = new Masonry( container, {
  // options
  itemSelector: '.item',
  columnWidth: container.querySelector('.grid-sizer'),
  gutter: container.querySelector('.gutter-sizer')
});
// layout Masonry again after all images have loaded
imagesLoaded( container, function() {
  msnry.layout();
});
}

//Enable background-position fixed on mobile
$(window).scroll(function() {
  var scrolledY = $(window).scrollTop();
  $('.site-header').css('background-position', 'center ' + ((scrolledY)) + 'px');
});



//Isotope 1

var portfolio_1 = $('.grid-ctr-1').isotope({
  itemSelector: '.item-ctr-1',
  percentPosition: true,
  masonry: {
        columnWidth: '.grid-sizer-ctr-1',
        gutter: '.gutter-sizer-ctr-1'
       }
});
        
$('.filters-button-group-ctr-1').on( 'click', 'button', function() {
  var filterValue = $(this).attr('data-filter');
  portfolio_1.isotope({ filter: filterValue });
});
          
        
// change is-checked class on buttons
$('.button-group-ctr-1').each( function( i, buttonGroup ) {
  var buttonGroup = $( buttonGroup );
  buttonGroup.on( 'click', 'button', function() {
  buttonGroup.find('.is-checked').removeClass('is-checked');
    $( this ).addClass('is-checked');
  });
});

portfolio_1.imagesLoaded().progress( function() {
  portfolio_1.isotope('layout');
      $( ".item-ctr-1" ).addClass( "visible" )
});

//Isotope 2

var portfolio_2 = $('.grid-ctr-2').isotope({
  itemSelector: '.item-ctr-2',
  percentPosition: true,
  masonry: {
        columnWidth: '.grid-sizer-ctr-2',
        gutter: '.gutter-sizer-ctr-2'
       }
});
        
$('.filters-button-group-ctr-2').on( 'click', 'button', function() {
  var filterValue = $(this).attr('data-filter');
  portfolio_2.isotope({ filter: filterValue });
});
          
        
// change is-checked class on buttons
$('.button-group-ctr-2').each( function( i, buttonGroup ) {
  var buttonGroup = $( buttonGroup );
  buttonGroup.on( 'click', 'button', function() {
  buttonGroup.find('.is-checked').removeClass('is-checked');
    $( this ).addClass('is-checked');
  });
});

portfolio_2.imagesLoaded().progress( function() {
  portfolio_2.isotope('layout');
      $( ".item-ctr-2" ).addClass( "visible" )
});

//Isotope 3

var portfolio_3 = $('.grid-ctr-3').isotope({
  itemSelector: '.item-ctr-3',
  percentPosition: true,
  masonry: {
        columnWidth: '.grid-sizer-ctr-3',
        gutter: '.gutter-sizer-ctr-3'
       }
});
        
$('.filters-button-group-ctr-3').on( 'click', 'button', function() {
  var filterValue = $(this).attr('data-filter');
  portfolio_3.isotope({ filter: filterValue });
});
          
        
// change is-checked class on buttons
$('.button-group-ctr-3').each( function( i, buttonGroup ) {
  var buttonGroup = $( buttonGroup );
  buttonGroup.on( 'click', 'button', function() {
  buttonGroup.find('.is-checked').removeClass('is-checked');
    $( this ).addClass('is-checked');
  });
});

portfolio_3.imagesLoaded().progress( function() {
  portfolio_3.isotope('layout');
      $( ".item-ctr-3" ).addClass( "visible" )
});

//Isotope 4

var portfolio_4 = $('.grid-ctr-4').isotope({
  itemSelector: '.item-ctr-4',
  percentPosition: true,
  masonry: {
        columnWidth: '.grid-sizer-ctr-4',
        gutter: '.gutter-sizer-ctr-4'
       }
});
        
$('.filters-button-group-ctr-4').on( 'click', 'button', function() {
  var filterValue = $(this).attr('data-filter');
  portfolio_4.isotope({ filter: filterValue });
});
          
        
// change is-checked class on buttons
$('.button-group-ctr-4').each( function( i, buttonGroup ) {
  var buttonGroup = $( buttonGroup );
  buttonGroup.on( 'click', 'button', function() {
  buttonGroup.find('.is-checked').removeClass('is-checked');
    $( this ).addClass('is-checked');
  });
});

portfolio_4.imagesLoaded().progress( function() {
  portfolio_4.isotope('layout');
      $( ".item-ctr-4" ).addClass( "visible" )
});

//Isotope 5

var portfolio_5 = $('.grid-ctr-5').isotope({
  itemSelector: '.item-ctr-5',
  percentPosition: true,
  masonry: {
        columnWidth: '.grid-sizer-ctr-5',
        gutter: '.gutter-sizer-ctr-5'
       }
});
        
$('.filters-button-group-ctr-5').on( 'click', 'button', function() {
  var filterValue = $(this).attr('data-filter');
  portfolio_5.isotope({ filter: filterValue });
});
          
        
// change is-checked class on buttons
$('.button-group-ctr-5').each( function( i, buttonGroup ) {
  var buttonGroup = $( buttonGroup );
  buttonGroup.on( 'click', 'button', function() {
  buttonGroup.find('.is-checked').removeClass('is-checked');
    $( this ).addClass('is-checked');
  });
});

portfolio_5.imagesLoaded().progress( function() {
  portfolio_5.isotope('layout');
      $( ".item-ctr-5" ).addClass( "visible" )
});

//Enable or Disable sticky for secondary menu
$(document).ready(function() {
    if (SecondaryNavParams.sticky != '1') {
      $( ".nav-container" ).addClass( "nav-sticky" );
      $( ".site-header" ).addClass( "nav-sticky" );
  }
});

//Change sticky nav background on scroll
$(document).ready(function () {
    if (SecondaryNavParams.transparency == '1') {
        $(".nav-container").removeClass("nav-transparent");
    }
  if (SecondaryNavParams.transparency != '1'){
    $(window).scroll(function () { 
        if ($(document).scrollTop() > 5 ) {
            $(".nav-container").removeClass("nav-transparent");
        } else {
            $(".nav-container").addClass("nav-transparent");
        }
    });
  }
});

}(jQuery));