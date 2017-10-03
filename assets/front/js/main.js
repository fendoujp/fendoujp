(function ($) {
    "use strict";

    jQuery(document).ready(function ($) {
    	//微信分享消失
    	$("#chat_tips_btn").on('click',function(){
    		$("#chat_tips").show();
    	});
    	$("#chat_tips").on('click',function(){
	  		$(this).fadeOut();
    	});

        //Activated Testimonial Carousel

        $('.testimonial-active').owlCarousel({
            items: 3,
            margin: 30,
            autoplay: true,
            autoplayTimeout: 2000,
            smartSpeed: 500,
            autoplaySpeed: 3000,
            loop: true,
            responsive: {
                992: {
                    item: 3
                },
                768: {
                    items: 2
                },
                320: {
                    items: 1
                }
            }
        });

        //Activated Clients Logo Carousel

        $('.clients-active').owlCarousel({
            items: 6,
            margin: 40,
            autoplay: true,
            smartSpeed: 500,
            autoplaySpeed: 3000,
            loop: true,
            responsive: {
                992: {
                    item: 4
                },
                768: {
                    items: 3,
                    margin:130
                },
                556: {
                    items: 2,
                    margin: 20
                },
                320: {
                    items: 1
                }

            }
        });

        //Activated Gallery Photos Carousel

        $('.gallery-wrap').owlCarousel({
            items: 1,
            autoplay: true,
            smartSpeed: 500,
            autoplaySpeed: 3000,
            loop: true
        });

        //Activated Testimonial Widget Carousel

        $('.widget-testimonial').owlCarousel({
            items: 1,
            autoplay: true,
            loop: true,
            animateOut: 'fadeOut',
            animateIn: 'fadeIn'
        });

        //Activated Main Slider

        $(".Modern-Slider").slick({
            autoplay: true,
            autoplaySpeed: 10000,
            speed: 600,
            slidesToShow: 1,
            slidesToScroll: 1,
            pauseOnHover: false,
            dots: true,
            pauseOnDotsHover: true,
            cssEase: 'linear',
            fade: true,
            //   draggable: true,
            prevArrow: '<button class="PrevArrow"></button>',
            nextArrow: '<button class="NextArrow"></button>',
        });

        //Accordion JS

        var dd = $('dd');
        dd.filter(':nth-child(n+4)').hide();
        $('dl.accordion').on('click', 'dt', function () {
            $(this)
                .toggleClass('active')
                .siblings('dt')
                .removeClass('active');

            $(this)
                .next()
                .slideToggle(200)
                .siblings('dd')
                .slideUp(300);

        });

        //Activated jQuery LightBox PrettyPhoto

        $('.light-box').prettyPhoto({'social_tools':""});

        //Activated jQuery CounterUp

        $('.counter').counterUp({
            delay: 10,
            time: 5000
        });

        //MobileMenu Activated

        $('.mainmenu-area nav').meanmenu();

        // Sticky Menu
        $(function(){
            $(window).scroll(function() {
                if ($(this).scrollTop() >= 120) {
                    $('.head-bottom-area').addClass('stickya');
                }
                else {
                    $('.head-bottom-area').removeClass('stickya');
                }
            });
        });

        // Sticky Menu Mobile
        $(function(){
            $(window).scroll(function() {
                if ($(this).scrollTop() >= 0) {
                    $('.mean-bar').addClass('sticky-moba');
                }
                else {
                    $('.mean-bar').removeClass('sticky-moba');
                }
            });
        });
        $(".head-bottom-area").sticky({topSpacing:0});

    });

}(jQuery));
