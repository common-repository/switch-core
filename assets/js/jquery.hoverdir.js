! function(t, e, i) {
    "use strict";
    t.HoverDir = function(e, i) {
        this.$el = t(i), this._init(e)
    }, t.HoverDir.defaults = {
        speed: 300,
        easing: "ease",
        hoverDelay: 0,
        inverse: !1
    }, t.HoverDir.prototype = {
        _init: function(e) {
            this.options = t.extend(!0, {}, t.HoverDir.defaults, e), this.transitionProp = "all " + this.options.speed + "ms " + this.options.easing, this.support = Modernizr.csstransitions, this._loadEvents()
        },
        _loadEvents: function() {
            var e = this;
            this.$el.on("mouseenter.hoverdir, mouseleave.hoverdir", function(i) {
                var o = t(this),
                    n = o.find("div"),
                    s = e._getDir(o, {
                        x: i.pageX,
                        y: i.pageY
                    }),
                    r = e._getStyle(s);
                "mouseenter" === i.type ? (n.hide().css(r.from), clearTimeout(e.tmhover), e.tmhover = setTimeout(function() {
                    n.show(0, function() {
                        var i = t(this);
                        e.support && i.css("transition", e.transitionProp), e._applyAnimation(i, r.to, e.options.speed)
                    })
                }, e.options.hoverDelay)) : (e.support && n.css("transition", e.transitionProp), clearTimeout(e.tmhover), e._applyAnimation(n, r.from, e.options.speed))
            })
        },
        _getDir: function(t, e) {
            var i = t.width(),
                o = t.height(),
                n = (e.x - t.offset().left - i / 2) * (i > o ? o / i : 1),
                s = (e.y - t.offset().top - o / 2) * (o > i ? i / o : 1),
                r = Math.round((Math.atan2(s, n) * (180 / Math.PI) + 180) / 90 + 3) % 4;
            return r
        },
        _getStyle: function(t) {
            var e, i, o = {
                    left: "0px",
                    top: "-100%"
                },
                n = {
                    left: "0px",
                    top: "100%"
                },
                s = {
                    left: "-100%",
                    top: "0px"
                },
                r = {
                    left: "100%",
                    top: "0px"
                },
                a = {
                    top: "0px"
                },
                p = {
                    left: "0px"
                };
            switch (t) {
                case 0:
                    e = this.options.inverse ? n : o, i = a;
                    break;
                case 1:
                    e = this.options.inverse ? s : r, i = p;
                    break;
                case 2:
                    e = this.options.inverse ? o : n, i = a;
                    break;
                case 3:
                    e = this.options.inverse ? r : s, i = p
            }
            return {
                from: e,
                to: i
            }
        },
        _applyAnimation: function(e, i, o) {
            t.fn.applyStyle = this.support ? t.fn.css : t.fn.animate, e.stop().applyStyle(i, t.extend(!0, [], {
                duration: o + "ms"
            }))
        }
    };
    var o = function(t) {
        e.console && e.console.error(t)
    };
    t.fn.hoverdir = function(e) {
        var i = t.data(this, "hoverdir");
        if ("string" == typeof e) {
            var n = Array.prototype.slice.call(arguments, 1);
            this.each(function() {
                return i ? t.isFunction(i[e]) && "_" !== e.charAt(0) ? void i[e].apply(i, n) : void o("no such method '" + e + "' for hoverdir instance") : void o("cannot call methods on hoverdir prior to initialization; attempted to call method '" + e + "'")
            })
        } else this.each(function() {
            i ? i._init() : i = t.data(this, "hoverdir", new t.HoverDir(e, this))
        });
        return i
    }
}(jQuery, window);