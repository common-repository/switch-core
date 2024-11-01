jQuery(document).ready(function(e) {
    function o() {
        "use strict";
        try {
            e.browserSelector(), e("html").hasClass("chrome") && e.smoothScroll()
        } catch (e) {}
    }
     jQuery(window).load(function() {
        $portfolio_selectors = e(".portfolio-filter>li>a"), $portfolio_selectors.on("click", function() {
            $portfolio_selectors.removeClass("active"), e(this).addClass("active");
            e(this).attr("data-filter");
            return !1
        })
    }), e(".da-thumbs").mixItUp(), jQuery(document).ready(function() {
        e("a[data-rel^='lightcase']").lightcase(), e("#da-thumbs .item").each(function() {
            e(this).hoverdir()
        })
    }), e("#hero-unit .carousel-inner .item").css({
        height: e(window).height() + "px"
    }), e(window).resize(function() {
        e("#hero-unit .carousel-inner .item").css({
            height: e(window).height() + "px"
        })
    }),  e(window).load(function() {
        setTimeout(function() {
            e("#preloader").fadeOut(500)
        }, 500)
    });
    var t = new WOW({
        mobile: !1
    });
 jQuery(".testimonial-slider").addClass("owl-carousel").owlCarousel({
        pagination: !0,
        dots: !0,
        loop: !0,
        items: 1,
        nav: !1,
        autoHeight: !1,
        autoplay: !0,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            },
            1e3: {
                items: 1
            }
        }
    })
});