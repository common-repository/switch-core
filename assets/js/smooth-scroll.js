! function(e) {
    e.extend({
        browserSelector: function() {
            var e = navigator.userAgent,
                t = e.toLowerCase(),
                o = function(e) {
                    return t.indexOf(e) > -1
                },
                r = "gecko",
                n = "webkit",
                a = "safari",
                i = "opera",
                l = document.documentElement,
                u = [!/opera|webtv/i.test(t) && /msie\s(\d)/.test(t) ? "ie ie" + parseFloat(navigator.appVersion.split("MSIE")[1]) : o("firefox/2") ? r + " ff2" : o("firefox/3.5") ? r + " ff3 ff3_5" : o("firefox/3") ? r + " ff3" : o("gecko/") ? r : o("opera") ? i + (/version\/(\d+)/.test(t) ? " " + i + RegExp.jQuery1 : /opera(\s|\/)(\d+)/.test(t) ? " " + i + RegExp.jQuery2 : "") : o("konqueror") ? "konqueror" : o("chrome") ? n + " chrome" : o("iron") ? n + " iron" : o("applewebkit/") ? n + " " + a + (/version\/(\d+)/.test(t) ? " " + a + RegExp.jQuery1 : "") : o("mozilla/") ? r : "", o("j2me") ? "mobile" : o("iphone") ? "iphone" : o("ipod") ? "ipod" : o("mac") ? "mac" : o("darwin") ? "mac" : o("webtv") ? "webtv" : o("win") ? "win" : o("freebsd") ? "freebsd" : o("x11") || o("linux") ? "linux" : "", "js"];
            c = u.join(" "), l.className += " " + c
        }
    })
}(jQuery),
function(e) {
    e.extend({
        smoothScroll: function() {
            function e() {
                var e = !1;
                if (document.URL.indexOf("google.com/reader/view") > -1 && (e = !0), b.excluded) {
                    var t = b.excluded.split(/[,\n] ?/);
                    t.push("mail.google.com");
                    for (var o = t.length; o--;)
                        if (document.URL.indexOf(t[o]) > -1) {
                            g && g.disconnect(), u("mousewheel", r), e = !0, y = !0;
                            break
                        }
                }
                e && u("keydown", n), b.keyboardSupport && !e && c("keydown", n)
            }

            function t() {
                if (document.body) {
                    var t = document.body,
                        o = document.documentElement,
                        r = window.innerHeight,
                        n = t.scrollHeight;
                    if (M = document.compatMode.indexOf("CSS") >= 0 ? o : t, w = t, e(), S = !0, top != self) x = !0;
                    else if (n > r && (t.offsetHeight <= r || o.offsetHeight <= r)) {
                        var a = !1,
                            i = function() {
                                a || o.scrollHeight == document.height || (a = !0, setTimeout(function() {
                                    o.style.height = document.height + "px", a = !1
                                }, 500))
                            };
                        o.style.height = "auto", setTimeout(i, 10);
                        var l = {
                            attributes: !0,
                            childList: !0,
                            characterData: !1
                        };
                        if (g = new z(i), g.observe(t, l), M.offsetHeight <= r) {
                            var c = document.createElement("div");
                            c.style.clear = "both", t.appendChild(c)
                        }
                    }
                    if (document.URL.indexOf("mail.google.com") > -1) {
                        var u = document.createElement("style");
                        u.innerHTML = ".iu { visibility: hidden }", (document.getElementsByTagName("head")[0] || o).appendChild(u)
                    } else if (document.URL.indexOf("www.facebook.com") > -1) {
                        var s = document.getElementById("home_stream");
                        s && (s.style.webkitTransform = "translateZ(0)")
                    }
                    b.fixedBackground || y || (t.style.backgroundAttachment = "scroll", o.style.backgroundAttachment = "scroll")
                }
            }

            function o(e, t, o, r) {
                if (r || (r = 1e3), d(t, o), 1 != b.accelerationMax) {
                    var n = +new Date,
                        a = n - L;
                    if (a < b.accelerationDelta) {
                        var i = (1 + 30 / a) / 2;
                        i > 1 && (i = Math.min(i, b.accelerationMax), t *= i, o *= i)
                    }
                    L = +new Date
                }
                if (E.push({
                        x: t,
                        y: o,
                        lastX: t < 0 ? .99 : -.99,
                        lastY: o < 0 ? .99 : -.99,
                        start: +new Date
                    }), !T) {
                    var l = e === document.body,
                        c = function(n) {
                            for (var a = +new Date, i = 0, u = 0, s = 0; s < E.length; s++) {
                                var d = E[s],
                                    f = a - d.start,
                                    m = f >= b.animationTime,
                                    p = m ? 1 : f / b.animationTime;
                                b.pulseAlgorithm && (p = h(p));
                                var w = d.x * p - d.lastX >> 0,
                                    g = d.y * p - d.lastY >> 0;
                                i += w, u += g, d.lastX += w, d.lastY += g, m && (E.splice(s, 1), s--)
                            }
                            l ? window.scrollBy(i, u) : (i && (e.scrollLeft += i), u && (e.scrollTop += u)), t || o || (E = []), E.length ? j(c, e, r / b.frameRate + 1) : T = !1
                        };
                    j(c, e, 0), T = !0
                }
            }

            function r(e) {
                S || t();
                var r = e.target,
                    n = l(r);
                if (!n || e.defaultPrevented || s(w, "embed") || s(r, "embed") && /\.pdf/i.test(r.src)) return !0;
                var a = e.wheelDeltaX || 0,
                    i = e.wheelDeltaY || 0;
                return a || i || (i = e.wheelDelta || 0), !(b.touchpadSupport || !f(i)) || (Math.abs(a) > 1.2 && (a *= b.stepSize / 120), Math.abs(i) > 1.2 && (i *= b.stepSize / 120), o(n, -a, -i), void e.preventDefault())
            }

            function n(e) {
                var t = e.target,
                    r = e.ctrlKey || e.altKey || e.metaKey || e.shiftKey && e.keyCode !== H.spacebar;
                if (/input|textarea|select|embed/i.test(t.nodeName) || t.isContentEditable || e.defaultPrevented || r) return !0;
                if (s(t, "button") && e.keyCode === H.spacebar) return !0;
                var n, a = 0,
                    i = 0,
                    c = l(w),
                    u = c.clientHeight;
                switch (c == document.body && (u = window.innerHeight), e.keyCode) {
                    case H.up:
                        i = -b.arrowScroll;
                        break;
                    case H.down:
                        i = b.arrowScroll;
                        break;
                    case H.spacebar:
                        n = e.shiftKey ? 1 : -1, i = -n * u * .9;
                        break;
                    case H.pageup:
                        i = .9 * -u;
                        break;
                    case H.pagedown:
                        i = .9 * u;
                        break;
                    case H.home:
                        i = -c.scrollTop;
                        break;
                    case H.end:
                        var d = c.scrollHeight - c.scrollTop - u;
                        i = d > 0 ? d + 10 : 0;
                        break;
                    case H.left:
                        a = -b.arrowScroll;
                        break;
                    case H.right:
                        a = b.arrowScroll;
                        break;
                    default:
                        return !0
                }
                o(c, a, i), e.preventDefault()
            }

            function a(e) {
                w = e.target
            }

            function i(e, t) {
                for (var o = e.length; o--;) C[N(e[o])] = t;
                return t
            }

            function l(e) {
                var t = [],
                    o = M.scrollHeight;
                do {
                    var r = C[N(e)];
                    if (r) return i(t, r);
                    if (t.push(e), o === e.scrollHeight) {
                        if (!x || M.clientHeight + 10 < o) return i(t, document.body)
                    } else if (e.clientHeight + 10 < e.scrollHeight && (overflow = getComputedStyle(e, "").getPropertyValue("overflow-y"), "scroll" === overflow || "auto" === overflow)) return i(t, e)
                } while (e = e.parentNode)
            }

            function c(e, t, o) {
                window.addEventListener(e, t, o || !1)
            }

            function u(e, t, o) {
                window.removeEventListener(e, t, o || !1)
            }

            function s(e, t) {
                return (e.nodeName || "").toLowerCase() === t.toLowerCase()
            }

            function d(e, t) {
                e = e > 0 ? 1 : -1, t = t > 0 ? 1 : -1, k.x === e && k.y === t || (k.x = e, k.y = t, E = [], L = 0)
            }

            function f(e) {
                if (e) {
                    e = Math.abs(e), D.push(e), D.shift(), clearTimeout(R);
                    var t = D[0] == D[1] && D[1] == D[2],
                        o = m(D[0], 120) && m(D[1], 120) && m(D[2], 120);
                    return !(t || o)
                }
            }

            function m(e, t) {
                return Math.floor(e / t) == e / t
            }

            function p(e) {
                var t, o, r;
                return e *= b.pulseScale, e < 1 ? t = e - (1 - Math.exp(-e)) : (o = Math.exp(-1), e -= 1, r = 1 - Math.exp(-e), t = o + r * (1 - o)), t * b.pulseNormalize
            }

            function h(e) {
                return e >= 1 ? 1 : e <= 0 ? 0 : (1 == b.pulseNormalize && (b.pulseNormalize /= p(1)), p(e))
            }
            var w, g, v = {
                    frameRate: 150,
                    animationTime: 750,
                    stepSize: 80,
                    pulseAlgorithm: !0,
                    pulseScale: 8,
                    pulseNormalize: 1,
                    accelerationDelta: 20,
                    accelerationMax: 1,
                    keyboardSupport: !0,
                    arrowScroll: 50,
                    touchpadSupport: !0,
                    fixedBackground: !0,
                    excluded: ""
                },
                b = v,
                y = !1,
                x = !1,
                k = {
                    x: 0,
                    y: 0
                },
                S = !1,
                M = document.documentElement,
                D = [120, 120, 120],
                H = {
                    left: 37,
                    up: 38,
                    right: 39,
                    down: 40,
                    spacebar: 32,
                    pageup: 33,
                    pagedown: 34,
                    end: 35,
                    home: 36
                },
                E = [],
                T = !1,
                L = +new Date,
                C = {};
            setInterval(function() {
                C = {}
            }, 1e4);
            var R, N = function() {
                    var e = 0;
                    return function(t) {
                        return t.uniqueID || (t.uniqueID = e++)
                    }
                }(),
                j = function() {
                    return window.requestAnimationFrame || window.webkitRequestAnimationFrame || function(e, t, o) {
                        window.setTimeout(e, o || 1e3 / 60)
                    }
                }(),
                z = window.MutationObserver || window.WebKitMutationObserver;
            c("mousedown", a), c("mousewheel", r), c("load", t)
        }
    })
}(jQuery);