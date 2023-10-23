(function ($) {

	"use strict";

	// Team 
	$('.team-carousel').owlCarousel({
		rtl: true,
		loop: true,
		autoplay: true,
		autoplayHoverPause: true,
		autoplaySpeed: 1500,
		smartSpeed: 1500,
		margin: 30,
		nav: true,
		navText: ["<i class='fa fa-caret-left'></i>", "<i class='fa fa-caret-right'></i>"],
		responsive: {
			0: {
				items: 1
			},
			460: {
				items: 2
			},
			576: {
				items: 2
			},
			768: {
				items: 3
			},
			991: {
				items: 3
			},
			1000: {
				items: 4
			}
		}
	});

	// Slider
	$('.slide-carousel').owlCarousel({
		rtl: true,
		loop: true,
		autoplay: true,
		autoplayHoverPause: true,
		autoplaySpeed: 1500,
		smartSpeed: 1500,
		margin: 0,
		animateIn: 'fadeIn',
		animateOut: 'fadeOut',
		dots: false,
		nav: true,
		navText: ["<i class='fa fa-caret-left'></i>", "<i class='fa fa-caret-right'></i>"],
		responsive: {
			0: {
				items: 1
			},
			576: {
				items: 1
			},
			1000: {
				items: 1
			}
		}
	});

	// Testimonial
	$('.testimonial-carousel').owlCarousel({
		rtl: true,
		loop: true,
		autoplay: true,
		autoplayHoverPause: true,
		autoplaySpeed: 1500,
		smartSpeed: 1500,
		margin: 30,
		nav: false,
		navText: ["<i class='fa fa-caret-left'></i>", "<i class='fa fa-caret-right'></i>"],
		responsive: {
			0: {
				items: 1,
				dots: false,
				nav: true,
			},
			768: {
				items: 2
			},
			992: {
				items: 2
			}
		}
	});

	// Blog
	$('.blog-carousel').owlCarousel({
		rtl: true,
		loop: true,
		autoplay: true,
		autoplayHoverPause: true,
		autoplaySpeed: 1500,
		smartSpeed: 1500,
		margin: 30,
		nav: true,
		navText: ["<i class='fa fa-caret-left'></i>", "<i class='fa fa-caret-right'></i>"],
		responsive: {
			0: {
				items: 1
			},
			768: {
				items: 2
			},
			992: {
				items: 3
			}
		}
	});

	// Brand
	$('.brand-carousel').owlCarousel({
		rtl: true,
		loop: true,
		autoplay: true,
		autoplayHoverPause: true,
		autoplaySpeed: 1500,
		smartSpeed: 1500,
		margin: 30,
		nav: false,
		navText: ["<i class='fa fa-caret-left'></i>", "<i class='fa fa-caret-right'></i>"],
		responsive: {
			0: {
				items: 2
			},
			768: {
				items: 3
			},
			992: {
				items: 4
			},
			1200: {
				items: 5
			}
		}
	});

	// Event
	$('.event-carousel').owlCarousel({
		rtl: true,
		loop: true,
		autoplay: true,
		autoplayHoverPause: true,
		autoplaySpeed: 1500,
		smartSpeed: 1500,
		animateIn: 'fadeIn',
		animateOut: 'fadeOut',
		margin: 0,
		nav: true,
		navText: ["<i class='fa fa-caret-left'></i>", "<i class='fa fa-caret-right'></i>"],
		responsive: {
			0: {
				items: 1
			},
			576: {
				items: 1
			},
			992: {
				items: 1
			}
		}
	});

	// Single-Service
	$('.single-ser-carousel').owlCarousel({
		rtl: true,
		loop: true,
		autoplay: true,
		autoplayHoverPause: true,
		autoplaySpeed: 1500,
		smartSpeed: 1500,
		animateIn: 'fadeIn',
		animateOut: 'fadeOut',
		margin: 0,
		nav: true,
		navText: ["<i class='fa fa-caret-left'></i>", "<i class='fa fa-caret-right'></i>"],
		responsive: {
			0: {
				items: 1
			},
			576: {
				items: 1
			},
			992: {
				items: 1
			}
		}
	});

	// Portfolio
	$('.portfolio-carousel').owlCarousel({
		rtl: true,
		loop: true,
		autoplay: true,
		autoplayHoverPause: true,
		autoplaySpeed: 1500,
		smartSpeed: 1500,
		animateIn: 'fadeIn',
		animateOut: 'fadeOut',
		margin: 0,
		nav: true,
		navText: ["<i class='fa fa-caret-left'></i>", "<i class='fa fa-caret-right'></i>"],
		responsive: {
			0: {
				items: 1
			},
			768: {
				items: 1
			},
			992: {
				items: 1
			}
		}
	});

	// Project
	$('.project-carousel').owlCarousel({
		rtl: true,
		loop: true,
		autoplay: true,
		autoplayHoverPause: true,
		autoplaySpeed: 1500,
		smartSpeed: 1500,
		margin: 25,
		nav: true,
		navText: ["<i class='fa fa-caret-left'></i>", "<i class='fa fa-caret-right'></i>"],
		responsive: {
			0: {
				items: 1
			},
			768: {
				items: 2
			},
			992: {
				items: 3
			},
			1200: {
				items: 3
			}
		}
	});

})(jQuery);