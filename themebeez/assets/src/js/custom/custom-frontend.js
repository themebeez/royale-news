(function($) {

    "use strict";

    jQuery(document).ready(function() {


        // Retina js


        retinajs();


        // Main navigation


        $('.main-navigation').meanmenu({
            meanMenuContainer: '.menu-container',
            meanScreenWidth: "768",
            meanRevealPosition: "right",
        });


        // Sticky sidebar


        jQuery('.sticky-section').theiaStickySidebar({
            additionalMarginTop: 0
        });


        // Scroll to top

        $('#scroll-top').click(function() {
            $('html, body').animate({ scrollTop: 0 }, 600);
            return false;
        });


        // Search icon 



        $('.search-icon').click(function() {
            $('.search-form-container').fadeToggle();
        });


        // News ticket 


        $('.ticker-news-carousel').owlCarousel({
            items: 1,
            animateOut: 'fadeOutUp',
            animateIn: 'fadeInUp',
            autoplay: true,
            loop: true,
            nav: false
        });


        // News carousel

        $('.highlight-carousel').owlCarousel({
            items: 2,
            animateIn: 'fadeIn',
            autoplay: true,
            loop: true,
            responsive: {
                0: {
                    items: 1
                },
                767: {
                    items: 2
                },
                991: {
                    items: 2
                },
                1199: {
                    items: 3
                }
            }
        });


        // News carousel


        $('.highlight-left-carousel').owlCarousel({
            items: 1,
            autoplay: true,
            loop: true,
            nav: true,
        });


        // News carousel


        $('.news-section-carousel').owlCarousel({
            items: 2,
            animateIn: 'fadeIn',
            autoplay: true,
            loop: false,
            nav: true,
            rewind: true,
            responsive: {
                0: {
                    items: 1
                },
                767: {
                    items: 2
                },
                991: {
                    items: 2
                },
                1199: {
                    items: 2
                }
            }
        })
    });


    // Scroll to top

    $(window).scroll(function() {
        if ($(this).scrollTop() > 100) {
            $('.scroll-top').fadeIn(600);
        } else {
            $('.scroll-top').fadeOut(600);
        }
    });


})(jQuery);