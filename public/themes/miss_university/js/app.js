import $ from 'jquery';
global.$ = global.jQuery = require('jquery');
import 'popper.js';
import 'bootstrap';
import 'slick-carousel';
let owl_carousel = require('owl.carousel');
window.fn = owl_carousel;
$(document).ready(function(){
    $('.header-banners').slick({items: 1, infinite: true, autoplay: true, dots: false, arrows: false});
    $('.unit-logo').each(function(){$(this).owlCarousel({items: 8, loop: true, autoplay: true, dots: false, autoWidth: true, nav: false})});
    $('.activity-program .slider').slick({
        items: 1,
        infinite: true,
        autoplay: true,
        dots: false,
        arrows: true,
        mobileFirst: true,
        nextArrow: $('.activity-program .activity-next'),
        prevArrow: $('.activity-program .activity-prev'),
        responsive: [
            {

                breakpoint: 480,
                settings: {
                    slidesToShow: 2,
                }

            },
            {

                breakpoint: 768,
                settings: {
                    slidesToShow: 3,
                }

            },
            {

                breakpoint: 1200,
                settings: {
                    slidesToShow: 4,
                }

            }
        ]
    });
    function elimination_round_carousel_active() {
        if ($(window).width() < 1024) {
            $('.owl-elimination-round').addClass('owl-carousel owl-theme');
            $('.owl-elimination-round').owlCarousel({
                items: 2,
                autoPlay: 3000,
                nav: false,
                loop: false,
                dots: false,
                autoWidth: true,
                freeDrag: true,
                responsive: {
                    0: {
                        items: 1
                    },
                    480: {
                        items: 3
                    },
                    768: {
                        items: 4
                    },
                    991: {
                        items: 4,
                        center: true
                    }
                }
            });
        } else {
            $('.owl-elimination-round').owlCarousel('destroy');
            $('.owl-elimination-round').removeClass('owl-carousel owl-theme');
        }
    }
    // elimination_round_carousel_active();
    // $(window).resize(function() {
    //     elimination_round_carousel_active();
    // })
});
