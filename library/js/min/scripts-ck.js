if (!window.getComputedStyle) {
    window.getComputedStyle = function(t, e) {
        this.el = t;
        this.getPropertyValue = function(e) {
            var a = /(\-([a-z]){1})/g;
            if (e == "float") e = "styleFloat";
            if (a.test(e)) {
                e = e.replace(a, function() {
                    return arguments[2].toUpperCase();
                });
            }
            return t.currentStyle[e] ? t.currentStyle[e] : null;
        };
        return this;
    };
}

jQuery(document).ready(function(t) {
    var e = t(window).width();
    if (e < 481) {}
    if (e > 481) {}
    if (e >= 768) {
        t(".comment img[data-gravatar]").each(function() {
            t(this).attr("src", t(this).attr("data-gravatar"));
        });
    }
    if (e > 1030) {}
    t(function() {
        var e = t(".mobile-toggle");
        var a = t("nav.mobile > ul");
        var n = a.height();
        t(e).on("click", function(t) {
            t.preventDefault();
            a.slideToggle();
        });
        t(window).resize(function() {
            var e = t(window).width();
            if (e > 768 && a.is(":hidden")) {
                a.removeAttr("style");
            }
        });
    });
    t.simpleWeather({
        woeid: "2424766",
        unit: "f",
        success: function(e) {
            html = '<i class="icon-' + e.code + '"></i><span>' + e.currently + " and " + e.temp + "&deg;" + e.units.temp + " currently in " + e.city + ", " + e.region + '<span class="attribution">from <a href="' + e.link + '">Yahoo! Weather</a></span>' + "</span>";
            t("#weather").html(html);
        },
        error: function(e) {
            t("#weather").html("<p>" + e + "</p>");
        }
    });
    t("#weather").hover(function() {
        t(".attribution").delay(250).fadeIn();
    }, function() {
        t(".attribution").fadeOut();
    });
    t("a[href*=#]").click(function() {
        if (location.pathname.replace(/^\//, "") == this.pathname.replace(/^\//, "") && location.hostname == this.hostname) {
            var e = t(this.hash);
            e = e.length && e || t("[name=" + this.hash.slice(1) + "]");
            if (e.length) {
                var a = e.offset().top - 175;
                t("html,body").animate({
                    scrollTop: a
                }, 1e3);
                return false;
            }
        }
    });
    t(".single .tribe-events-nav-previous a").addClass("gray clear button left");
    t(".single .tribe-events-nav-next a").addClass("gray clear button right");
});

var mainNav = jQuery("nav.main-nav"), mainNavOffset = jQuery("nav.main-nav").offset().top, mainNavHeight = jQuery("nav.main-nav").height();

if (jQuery("nav.sub-nav").length) {
    var subNav = jQuery("nav.sub-nav"), subNavOffset = jQuery("nav.sub-nav").offset().top;
}

jQuery(window).scroll(function() {
    mainNav.toggleClass("sticky", jQuery(window).scrollTop() > mainNavOffset);
    if (jQuery("nav.sub-nav").length) {
        subNav.toggleClass("sticky", jQuery(window).scrollTop() > subNavOffset - 52);
    }
});

(function(t) {
    if (!(/iPhone|iPad|iPod/.test(navigator.platform) && navigator.userAgent.indexOf("AppleWebKit") > -1)) {
        return;
    }
    var e = t.document;
    if (!e.querySelector) {
        return;
    }
    var a = e.querySelector("meta[name=viewport]"), n = a && a.getAttribute("content"), i = n + ",maximum-scale=1", r = n + ",maximum-scale=10", o = true, s, u, l, f;
    if (!a) {
        return;
    }
    function c() {
        a.setAttribute("content", r);
        o = true;
    }
    function v() {
        a.setAttribute("content", i);
        o = false;
    }
    function h(e) {
        f = e.accelerationIncludingGravity;
        s = Math.abs(f.x);
        u = Math.abs(f.y);
        l = Math.abs(f.z);
        if (!t.orientation && (s > 7 || (l > 6 && u < 8 || l < 8 && u > 6) && s > 5)) {
            if (o) {
                v();
            }
        } else if (!o) {
            c();
        }
    }
    t.addEventListener("orientationchange", c, false);
    t.addEventListener("devicemotion", h, false);
})(this);