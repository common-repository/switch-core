! function(e) {
    window.lightcase = {
        cache: {},
        support: {},
        labels: {
            errorMessage: "Source could not be found...",
            "sequenceInfo.of": " of ",
            close: "Close",
            "navigator.prev": "Prev",
            "navigator.next": "Next",
            "navigator.play": "Play",
            "navigator.pause": "Pause"
        },
        init: function(t) {
            return this.each(function() {
                e(this).unbind("click").click(function(i) {
                    i.preventDefault(), e(this).lightcase("start", t)
                })
            })
        },
        start: function(t) {
            lightcase.settings = e.extend(!0, {
                idPrefix: "lightcase-",
                classPrefix: "lightcase-",
                transition: "elastic",
                transitionIn: null,
                transitionOut: null,
                cssTransitions: !0,
                speedIn: 250,
                speedOut: 250,
                maxWidth: 800,
                maxHeight: 500,
                forceWidth: !1,
                forceHeight: !1,
                liveResize: !0,
                fullScreenModeForMobile: !0,
                mobileMatchExpression: /(iphone|ipod|ipad|android|blackberry|symbian)/,
                disableShrink: !1,
                shrinkFactor: .75,
                overlayOpacity: .9,
                slideshow: !1,
                timeout: 5e3,
                swipe: !0,
                useKeys: !0,
                navigateEndless: !0,
                closeOnOverlayClick: !0,
                title: null,
                caption: null,
                showTitle: !0,
                showCaption: !0,
                showSequenceInfo: !0,
                inline: {
                    width: "auto",
                    height: "auto"
                },
                ajax: {
                    width: "auto",
                    height: "auto",
                    type: "get",
                    dataType: "html",
                    data: {}
                },
                iframe: {
                    width: 800,
                    height: 500,
                    frameborder: 0
                },
                flash: {
                    width: 400,
                    height: 205,
                    wmode: "transparent"
                },
                video: {
                    width: 400,
                    height: 225,
                    poster: "",
                    preload: "auto",
                    controls: !0,
                    autobuffer: !0,
                    autoplay: !0,
                    loop: !1
                },
                type: null,
                typeMapping: {
                    image: "jpg,jpeg,gif,png,bmp",
                    flash: "swf",
                    video: "mp4,mov,ogv,ogg,webm",
                    iframe: "html,php",
                    ajax: "json,txt",
                    inline: "#"
                },
                errorMessage: function() {
                    return '<p class="' + lightcase.settings.classPrefix + 'error">' + lightcase.labels.errorMessage + "</p>"
                },
                markup: function() {
                    e("body").append($overlay = e('<div id="' + lightcase.settings.idPrefix + 'overlay"></div>'), $loading = e('<div id="' + lightcase.settings.idPrefix + 'loading" class="' + lightcase.settings.classPrefix + 'icon-spin"></div>'), $case = e('<div id="' + lightcase.settings.idPrefix + 'case" aria-hidden="true" role="dialog"></div>')), $case.after($nav = e('<div id="' + lightcase.settings.idPrefix + 'nav"></div>')), $nav.append($close = e('<a href="#" class="' + lightcase.settings.classPrefix + 'icon-close"><span>' + lightcase.labels.close + "</span></a>"), $prev = e('<a href="#" class="' + lightcase.settings.classPrefix + 'icon-prev"><span>' + lightcase.labels["navigator.prev"] + "</span></a>").hide(), $next = e('<a href="#" class="' + lightcase.settings.classPrefix + 'icon-next"><span>' + lightcase.labels["navigator.next"] + "</span></a>").hide(), $play = e('<a href="#" class="' + lightcase.settings.classPrefix + 'icon-play"><span>' + lightcase.labels["navigator.play"] + "</span></a>").hide(), $pause = e('<a href="#" class="' + lightcase.settings.classPrefix + 'icon-pause"><span>' + lightcase.labels["navigator.pause"] + "</span></a>").hide()), $case.append($content = e('<div class="' + lightcase.settings.classPrefix + 'content"></div>'), $info = e('<div class="' + lightcase.settings.classPrefix + 'info"></div>')), $content.append($contentInner = e('<div class="' + lightcase.settings.classPrefix + 'contentInner"></div>')), $info.append($sequenceInfo = e('<div class="' + lightcase.settings.classPrefix + 'sequenceInfo"></div>'), $title = e('<h4 class="' + lightcase.settings.classPrefix + 'title"></h4>'), $caption = e('<p class="' + lightcase.settings.classPrefix + 'caption"></p>'))
                },
                onInit: {},
                onStart: {},
                onFinish: {}
            }, t), lightcase.callHooks(lightcase.settings.onInit), lightcase.objectData = lightcase.getObjectData(this), lightcase.addElements(), lightcase.lightcaseOpen(), lightcase.dimensions = lightcase.getDimensions()
        },
        getObjectData: function(t) {
            var i = {
                $link: t,
                title: lightcase.settings.title || t.attr("title"),
                caption: lightcase.settings.caption || t.children("img").attr("alt"),
                url: lightcase.verifyDataUrl(t.attr("data-href") || t.attr("href")),
                requestType: lightcase.settings.ajax.type,
                requestData: lightcase.settings.ajax.data,
                requestDataType: lightcase.settings.ajax.dataType,
                rel: t.attr("data-rel"),
                type: lightcase.settings.type || lightcase.verifyDataType(t.attr("data-href") || t.attr("href")),
                isPartOfSequence: lightcase.isPartOfSequence(t.attr("data-rel"), ":"),
                isPartOfSequenceWithSlideshow: lightcase.isPartOfSequence(t.attr("data-rel"), ":slideshow"),
                currentIndex: e('[data-rel="' + t.attr("data-rel") + '"]').index(t),
                sequenceLength: e('[data-rel="' + t.attr("data-rel") + '"]').length
            };
            return i.sequenceInfo = i.currentIndex + 1 + lightcase.labels["sequenceInfo.of"] + i.sequenceLength, i
        },
        isPartOfSequence: function(t, i) {
            var s = e('[data-rel="' + t + '"]'),
                a = new RegExp(i);
            return !!(a.test(t) && s.length > 1)
        },
        isSlideshowEnabled: function() {
            return !(!lightcase.objectData.isPartOfSequence || lightcase.settings.slideshow !== !0 && lightcase.objectData.isPartOfSequenceWithSlideshow !== !0)
        },
        loadContent: function() {
            lightcase.cache.originalObject && lightcase.restoreObject(), lightcase.createObject()
        },
        createObject: function() {
            var t;
            switch (lightcase.objectData.type) {
                case "image":
                    t = e(new Image), t.attr({
                        src: lightcase.objectData.url,
                        alt: lightcase.objectData.title
                    });
                    break;
                case "inline":
                    t = e('<div class="' + lightcase.settings.classPrefix + 'inlineWrap"></div>'), t.html(lightcase.cloneObject(e(lightcase.objectData.url))), e.each(lightcase.settings.inline, function(e, i) {
                        t.attr("data-" + e, i)
                    });
                    break;
                case "ajax":
                    t = e('<div class="' + lightcase.settings.classPrefix + 'inlineWrap"></div>'), e.each(lightcase.settings.ajax, function(e, i) {
                        "data" !== e && t.attr("data-" + e, i)
                    });
                    break;
                case "flash":
                    t = e('<embed src="' + lightcase.objectData.url + '" type="application/x-shockwave-flash"></embed>'), e.each(lightcase.settings.flash, function(e, i) {
                        t.attr(e, i)
                    });
                    break;
                case "video":
                    t = e("<video></video>"), t.attr("src", lightcase.objectData.url), e.each(lightcase.settings.video, function(e, i) {
                        t.attr(e, i)
                    });
                    break;
                default:
                    t = e("<iframe></iframe>"), t.attr({
                        src: lightcase.objectData.url
                    }), e.each(lightcase.settings.iframe, function(e, i) {
                        t.attr(e, i)
                    })
            }
            lightcase.addObject(t), lightcase.loadObject(t)
        },
        addObject: function(e) {
            $contentInner.html(e), lightcase.loading("start"), lightcase.callHooks(lightcase.settings.onStart), lightcase.settings.showSequenceInfo === !0 && lightcase.objectData.isPartOfSequence ? ($sequenceInfo.html(lightcase.objectData.sequenceInfo), $sequenceInfo.show()) : ($sequenceInfo.empty(), $sequenceInfo.hide()), lightcase.settings.showTitle === !0 && void 0 !== lightcase.objectData.title && "" !== lightcase.objectData.title ? ($title.html(lightcase.objectData.title), $title.show()) : ($title.empty(), $title.hide()), lightcase.settings.showCaption === !0 && void 0 !== lightcase.objectData.caption && "" !== lightcase.objectData.caption ? ($caption.html(lightcase.objectData.caption), $caption.show()) : ($caption.empty(), $caption.hide())
        },
        loadObject: function(t) {
            switch (lightcase.objectData.type) {
                case "inline":
                    e(lightcase.objectData.url) ? lightcase.showContent(t) : lightcase.error();
                    break;
                case "ajax":
                    e.ajax(e.extend({}, lightcase.settings.ajax, {
                        url: lightcase.objectData.url,
                        type: lightcase.objectData.requestType,
                        dataType: lightcase.objectData.requestDataType,
                        data: lightcase.objectData.requestData,
                        success: function(e) {
                            "json" === lightcase.objectData.requestDataType ? lightcase.objectData.data = e : t.html(e), lightcase.showContent(t)
                        },
                        error: function() {
                            lightcase.error()
                        }
                    }));
                    break;
                case "flash":
                    lightcase.showContent(t);
                    break;
                case "video":
                    "function" == typeof t.get(0).canPlayType || 0 === $case.find("video").length ? lightcase.showContent(t) : lightcase.error();
                    break;
                default:
                    lightcase.objectData.url ? (t.load(function() {
                        lightcase.showContent(t)
                    }), t.error(function() {
                        lightcase.error()
                    })) : lightcase.error()
            }
        },
        error: function() {
            lightcase.objectData.type = "error";
            var t = e('<div class="' + lightcase.settings.classPrefix + 'inlineWrap"></div>');
            t.html(lightcase.settings.errorMessage), $contentInner.html(t), lightcase.showContent($contentInner)
        },
        calculateDimensions: function(e) {
            lightcase.cleanupDimensions();
            var t = {
                objectWidth: e.attr(e.attr("width") ? "width" : "data-width"),
                objectHeight: e.attr(e.attr("height") ? "height" : "data-height"),
                maxWidth: parseInt(lightcase.dimensions.windowWidth * lightcase.settings.shrinkFactor),
                maxHeight: parseInt(lightcase.dimensions.windowHeight * lightcase.settings.shrinkFactor)
            };
            if (!lightcase.settings.disableShrink) switch (t.maxWidth > lightcase.settings.maxWidth && (t.maxWidth = lightcase.settings.maxWidth), t.maxHeight > lightcase.settings.maxHeight && (t.maxHeight = lightcase.settings.maxHeight), t.differenceWidthAsPercent = parseInt(100 / t.maxWidth * t.objectWidth), t.differenceHeightAsPercent = parseInt(100 / t.maxHeight * t.objectHeight), lightcase.objectData.type) {
                case "image":
                case "flash":
                case "video":
                    t.differenceWidthAsPercent > 100 && t.differenceWidthAsPercent > t.differenceHeightAsPercent && (t.objectWidth = t.maxWidth, t.objectHeight = parseInt(t.objectHeight / t.differenceWidthAsPercent * 100)), t.differenceHeightAsPercent > 100 && t.differenceHeightAsPercent > t.differenceWidthAsPercent && (t.objectWidth = parseInt(t.objectWidth / t.differenceHeightAsPercent * 100), t.objectHeight = t.maxHeight), t.differenceHeightAsPercent > 100 && t.differenceWidthAsPercent < t.differenceHeightAsPercent && (t.objectWidth = parseInt(t.maxWidth / t.differenceHeightAsPercent * t.differenceWidthAsPercent), t.objectHeight = t.maxHeight);
                    break;
                case "error":
                    !isNaN(t.objectWidth) && t.objectWidth > t.maxWidth && (t.objectWidth = t.maxWidth);
                    break;
                default:
                    (isNaN(t.objectWidth) || t.objectWidth > t.maxWidth) && !lightcase.settings.forceWidth && (t.objectWidth = t.maxWidth), (isNaN(t.objectHeight) && "auto" !== t.objectHeight || t.objectHeight > t.maxHeight) && !lightcase.settings.forceHeight && (t.objectHeight = t.maxHeight)
            }
            lightcase.adjustDimensions(e, t)
        },
        adjustDimensions: function(e, t) {
            e.css({
                width: t.objectWidth,
                height: t.objectHeight,
                "max-width": e.attr("data-max-width") ? e.attr("data-max-width") : t.maxWidth,
                "max-height": e.attr("data-max-height") ? e.attr("data-max-height") : t.maxHeight
            }), $contentInner.css({
                width: e.outerWidth(),
                height: e.outerHeight(),
                "max-width": "100%"
            }), $case.css({
                width: $contentInner.outerWidth()
            }), $case.css({
                "margin-top": parseInt(-($case.outerHeight() / 2)),
                "margin-left": parseInt(-($case.outerWidth() / 2))
            })
        },
        loading: function(e) {
            "start" === e ? ($case.addClass(lightcase.settings.classPrefix + "loading"), $loading.show()) : "end" === e && ($case.removeClass(lightcase.settings.classPrefix + "loading"), $loading.hide())
        },
        getDimensions: function() {
            return {
                windowWidth: e(window).innerWidth(),
                windowHeight: e(window).innerHeight()
            }
        },
        verifyDataUrl: function(e) {
            return !(!e || void 0 === e || "" === e) && (e.indexOf("#") > -1 && (e = e.split("#"), e = "#" + e[e.length - 1]), e)
        },
        verifyDataType: function(e) {
            var e = lightcase.verifyDataUrl(e),
                t = lightcase.settings.typeMapping;
            if (e)
                for (var i in t)
                    for (var s = t[i].split(","), a = 0; a < s.length; a++) {
                        var n = s[a],
                            c = new RegExp(".(" + n + ")$", "i"),
                            l = e.split("?")[0].substr(-5);
                        if (c.test(l) === !0) return i;
                        if ("inline" === i && (e.indexOf(n) > -1 || !e)) return i
                    }
            return "iframe"
        },
        addElements: function() {
            e('[id^="' + lightcase.settings.idPrefix + '"]').length || lightcase.settings.markup()
        },
        showContent: function(e) {
            switch ($case.attr("data-type", lightcase.objectData.type), lightcase.cache.object = e, lightcase.calculateDimensions(e), lightcase.callHooks(lightcase.settings.onFinish), lightcase.settings.transitionIn) {
                case "scrollTop":
                case "scrollRight":
                case "scrollBottom":
                case "scrollLeft":
                case "scrollHorizontal":
                case "scrollVertical":
                    lightcase.transition.scroll($case, "in", lightcase.settings.speedIn), lightcase.transition.fade($contentInner, "in", lightcase.settings.speedIn);
                    break;
                case "elastic":
                    $case.css("opacity") < 1 && (lightcase.transition.zoom($case, "in", lightcase.settings.speedIn), lightcase.transition.fade($contentInner, "in", lightcase.settings.speedIn));
                case "fade":
                case "fadeInline":
                    lightcase.transition.fade($case, "in", lightcase.settings.speedIn), lightcase.transition.fade($contentInner, "in", lightcase.settings.speedIn);
                    break;
                default:
                    lightcase.transition.fade($case, "in", 0)
            }
            lightcase.loading("end"), lightcase.busy = !1
        },
        processContent: function() {
            switch (lightcase.busy = !0, lightcase.settings.transitionOut) {
                case "scrollTop":
                case "scrollRight":
                case "scrollBottom":
                case "scrollLeft":
                case "scrollVertical":
                case "scrollHorizontal":
                    $case.is(":hidden") ? (lightcase.transition.fade($case, "out", 0, 0, function() {
                        lightcase.loadContent()
                    }), lightcase.transition.fade($contentInner, "out", 0)) : lightcase.transition.scroll($case, "out", lightcase.settings.speedOut, function() {
                        lightcase.loadContent()
                    });
                    break;
                case "fade":
                    $case.is(":hidden") ? lightcase.transition.fade($case, "out", 0, 0, function() {
                        lightcase.loadContent()
                    }) : lightcase.transition.fade($case, "out", lightcase.settings.speedOut, 0, function() {
                        lightcase.loadContent()
                    });
                    break;
                case "fadeInline":
                case "elastic":
                    $case.is(":hidden") ? lightcase.transition.fade($case, "out", 0, 0, function() {
                        lightcase.loadContent()
                    }) : lightcase.transition.fade($contentInner, "out", lightcase.settings.speedOut, 0, function() {
                        lightcase.loadContent()
                    });
                    break;
                default:
                    lightcase.transition.fade($case, "out", 0, 0, function() {
                        lightcase.loadContent()
                    })
            }
        },
        handleEvents: function() {
            lightcase.unbindEvents(), $nav.children().not($close).hide(), lightcase.isSlideshowEnabled() && ($nav.hasClass(lightcase.settings.classPrefix + "paused") ? lightcase.stopTimeout() : lightcase.startTimeout()), lightcase.settings.liveResize && e(window).resize(lightcase.resize), $close.click(function(e) {
                e.preventDefault(), lightcase.lightcaseClose()
            }), lightcase.settings.closeOnOverlayClick === !0 && $overlay.css("cursor", "pointer").click(function(e) {
                e.preventDefault(), lightcase.lightcaseClose()
            }), lightcase.settings.useKeys === !0 && lightcase.addKeyEvents(), lightcase.objectData.isPartOfSequence && ($nav.attr("data-ispartofsequence", !0), lightcase.nav = lightcase.setNavigation(), $prev.click(function(e) {
                e.preventDefault(), $prev.unbind("click"), lightcase.cache.action = "prev", lightcase.nav.$prevItem.click(), lightcase.isSlideshowEnabled() && lightcase.stopTimeout()
            }), $next.click(function(e) {
                e.preventDefault(), $next.unbind("click"), lightcase.cache.action = "next", lightcase.nav.$nextItem.click(), lightcase.isSlideshowEnabled() && lightcase.stopTimeout()
            }), lightcase.isSlideshowEnabled() && ($play.click(function(e) {
                e.preventDefault(), lightcase.startTimeout()
            }), $pause.click(function(e) {
                e.preventDefault(), lightcase.stopTimeout()
            })), lightcase.settings.swipe === !0 && (e.isPlainObject(e.event.special.swipeleft) && $case.on("swipeleft", function(e) {
                e.preventDefault(), $next.click(), lightcase.isSlideshowEnabled() && lightcase.stopTimeout()
            }), e.isPlainObject(e.event.special.swiperight) && $case.on("swiperight", function(e) {
                e.preventDefault(), $prev.click(), lightcase.isSlideshowEnabled() && lightcase.stopTimeout()
            })))
        },
        addKeyEvents: function() {
            e(document).keyup(function(e) {
                if (!lightcase.busy) switch (e.keyCode) {
                    case 27:
                        $close.click();
                        break;
                    case 37:
                        lightcase.objectData.isPartOfSequence && $prev.click();
                        break;
                    case 39:
                        lightcase.objectData.isPartOfSequence && $next.click()
                }
            })
        },
        startTimeout: function() {
            $play.hide(), $pause.show(), lightcase.cache.action = "next", $nav.removeClass(lightcase.settings.classPrefix + "paused"), lightcase.timeout = setTimeout(function() {
                lightcase.nav.$nextItem.click()
            }, lightcase.settings.timeout)
        },
        stopTimeout: function() {
            $play.show(), $pause.hide(), $nav.addClass(lightcase.settings.classPrefix + "paused"), clearTimeout(lightcase.timeout)
        },
        setNavigation: function() {
            var t = e('[data-rel="' + lightcase.objectData.rel + '"]'),
                i = lightcase.objectData.currentIndex,
                s = i - 1,
                a = i + 1,
                n = lightcase.objectData.sequenceLength - 1,
                c = {
                    $prevItem: t.eq(s),
                    $nextItem: t.eq(a)
                };
            return i > 0 ? $prev.show() : c.$prevItem = t.eq(n), n >= a ? $next.show() : c.$nextItem = t.eq(0), lightcase.settings.navigateEndless === !0 && ($prev.show(), $next.show()), c
        },
        cloneObject: function(e) {
            var t = e.clone(),
                i = e.attr("id");
            return e.is(":hidden") ? (lightcase.cacheObjectData(e), e.attr("id", lightcase.settings.idPrefix + "temp-" + i).empty()) : t.removeAttr("id"), t.show()
        },
        isMobileDevice: function() {
            var e = navigator.userAgent.toLowerCase(),
                t = e.match(lightcase.settings.mobileMatchExpression);
            return !!t
        },
        isTransitionSupported: function() {
            var t = e("body").get(0),
                i = !1,
                s = {
                    transition: "",
                    WebkitTransition: "-webkit-",
                    MozTransition: "-moz-",
                    OTransition: "-o-",
                    MsTransition: "-ms-"
                };
            for (var a in s) s.hasOwnProperty(a) && a in t.style && (lightcase.support.transition = s[a], i = !0);
            return i
        },
        transition: {
            fade: function(e, t, i, s, a) {
                var n = "in" === t,
                    c = {},
                    l = e.css("opacity"),
                    o = {},
                    r = s ? s : n ? 1 : 0;
                (lightcase.open || !n) && (c.opacity = l, o.opacity = r, e.css(c).show(), lightcase.support.transitions ? (o[lightcase.support.transition + "transition"] = i + "ms ease", setTimeout(function() {
                    e.css(o), setTimeout(function() {
                        e.css(lightcase.support.transition + "transition", ""), !a || !lightcase.open && n || a()
                    }, i)
                }, 15)) : (e.stop(), e.animate(o, i, a)))
            },
            scroll: function(e, t, i, s) {
                var a = "in" === t,
                    n = a ? lightcase.settings.transitionIn : lightcase.settings.transitionOut,
                    c = "left",
                    l = {},
                    o = a ? 0 : 1,
                    r = a ? "-50%" : "50%",
                    h = {},
                    g = a ? 1 : 0,
                    d = a ? "50%" : "-50%";
                if (lightcase.open || !a) {
                    switch (n) {
                        case "scrollTop":
                            c = "top";
                            break;
                        case "scrollRight":
                            r = a ? "150%" : "50%", d = a ? "50%" : "150%";
                            break;
                        case "scrollBottom":
                            c = "top", r = a ? "150%" : "50%", d = a ? "50%" : "150%";
                            break;
                        case "scrollHorizontal":
                            r = a ? "150%" : "50%", d = a ? "50%" : "-50%";
                            break;
                        case "scrollVertical":
                            c = "top", r = a ? "-50%" : "50%", d = a ? "50%" : "150%"
                    }
                    if ("prev" === lightcase.cache.action) switch (n) {
                        case "scrollHorizontal":
                            r = a ? "-50%" : "50%", d = a ? "50%" : "150%";
                            break;
                        case "scrollVertical":
                            r = a ? "150%" : "50%", d = a ? "50%" : "-50%"
                    }
                    l.opacity = o, l[c] = r, h.opacity = g, h[c] = d, e.css(l).show(), lightcase.support.transitions ? (h[lightcase.support.transition + "transition"] = i + "ms ease", setTimeout(function() {
                        e.css(h), setTimeout(function() {
                            e.css(lightcase.support.transition + "transition", ""), !s || !lightcase.open && a || s()
                        }, i)
                    }, 15)) : (e.stop(), e.animate(h, i, s))
                }
            },
            zoom: function(e, t, i, s) {
                var a = "in" === t,
                    n = {},
                    c = e.css("opacity"),
                    l = a ? "scale(0.75)" : "scale(1)",
                    o = {},
                    r = a ? 1 : 0,
                    h = a ? "scale(1)" : "scale(0.75)";
                (lightcase.open || !a) && (n.opacity = c, n[lightcase.support.transition + "transform"] = l, o.opacity = r, e.css(n).show(), lightcase.support.transitions ? (o[lightcase.support.transition + "transform"] = h, o[lightcase.support.transition + "transition"] = i + "ms ease", setTimeout(function() {
                    e.css(o), setTimeout(function() {
                        e.css(lightcase.support.transition + "transform", ""), e.css(lightcase.support.transition + "transition", ""), !s || !lightcase.open && a || s()
                    }, i)
                }, 15)) : (e.stop(), e.animate(o, i, s)))
            }
        },
        callHooks: function(t) {
            "object" == typeof t && e.each(t, function(e, t) {
                "function" == typeof t && t()
            })
        },
        cacheObjectData: function(t) {
            e.data(t, "cache", {
                id: t.attr("id"),
                content: t.html()
            }), lightcase.cache.originalObject = t
        },
        restoreObject: function() {
            var t = e('[id^="' + lightcase.settings.idPrefix + 'temp-"]');
            t.attr("id", e.data(lightcase.cache.originalObject, "cache").id), t.html(e.data(lightcase.cache.originalObject, "cache").content)
        },
        resize: function() {
            lightcase.open && (lightcase.isSlideshowEnabled() && lightcase.stopTimeout(), lightcase.dimensions = lightcase.getDimensions(), lightcase.calculateDimensions(lightcase.cache.object))
        },
        switchToFullScreenMode: function() {
            lightcase.settings.shrinkFactor = 1, lightcase.settings.overlayOpacity = 1, e("html").addClass(lightcase.settings.classPrefix + "fullScreenMode")
        },
        lightcaseOpen: function() {
            switch (lightcase.open = !0, lightcase.support.transitions = !!lightcase.settings.cssTransitions && lightcase.isTransitionSupported(), lightcase.support.mobileDevice = lightcase.isMobileDevice(), lightcase.support.mobileDevice && (e("html").addClass(lightcase.settings.classPrefix + "isMobileDevice"), lightcase.settings.fullScreenModeForMobile && lightcase.switchToFullScreenMode()), lightcase.settings.transitionIn || (lightcase.settings.transitionIn = lightcase.settings.transition), lightcase.settings.transitionOut || (lightcase.settings.transitionOut = lightcase.settings.transition), lightcase.settings.transitionIn) {
                case "fade":
                case "fadeInline":
                case "elastic":
                case "scrollTop":
                case "scrollRight":
                case "scrollBottom":
                case "scrollLeft":
                case "scrollVertical":
                case "scrollHorizontal":
                    $case.is(":hidden") && ($close.css("opacity", 0), $overlay.css("opacity", 0), $case.css("opacity", 0), $contentInner.css("opacity", 0)), lightcase.transition.fade($overlay, "in", lightcase.settings.speedIn, lightcase.settings.overlayOpacity, function() {
                        lightcase.transition.fade($close, "in", lightcase.settings.speedIn), lightcase.handleEvents(), lightcase.processContent()
                    });
                    break;
                default:
                    lightcase.transition.fade($overlay, "in", 0, lightcase.settings.overlayOpacity, function() {
                        lightcase.transition.fade($close, "in", 0), lightcase.handleEvents(), lightcase.processContent()
                    })
            }
            e("html").addClass(lightcase.settings.classPrefix + "open"), $case.attr("aria-hidden", "false")
        },
        lightcaseClose: function() {
            switch (lightcase.open = !1, $loading.hide(), lightcase.unbindEvents(), e(window).off("resize", lightcase.resize), e("html").removeClass(lightcase.settings.classPrefix + "open"), $case.attr("aria-hidden", "true"), $nav.children().hide(), lightcase.settings.transitionOut) {
                case "fade":
                case "fadeInline":
                case "scrollTop":
                case "scrollRight":
                case "scrollBottom":
                case "scrollLeft":
                case "scrollHorizontal":
                case "scrollVertical":
                    lightcase.transition.fade($case, "out", lightcase.settings.speedOut, 0, function() {
                        lightcase.transition.fade($overlay, "out", lightcase.settings.speedOut, 0, function() {
                            lightcase.cleanup()
                        })
                    });
                    break;
                case "elastic":
                    lightcase.transition.zoom($case, "out", lightcase.settings.speedOut, function() {
                        lightcase.transition.fade($overlay, "out", lightcase.settings.speedOut, 0, function() {
                            lightcase.cleanup()
                        })
                    });
                    break;
                default:
                    lightcase.cleanup()
            }
        },
        unbindEvents: function() {
            $overlay.unbind("click"), e(document).unbind("keyup"), $case.unbind("swipeleft").unbind("swiperight"), $nav.children("a").unbind("click"), $close.unbind("click")
        },
        cleanupDimensions: function() {
            var e = $contentInner.css("opacity");
            $case.css({
                width: "",
                height: "",
                top: "",
                left: "",
                "margin-top": "",
                "margin-left": ""
            }), $contentInner.removeAttr("style").css("opacity", e), $contentInner.children().removeAttr("style")
        },
        cleanup: function() {
            lightcase.cleanupDimensions(), lightcase.isSlideshowEnabled() && (lightcase.stopTimeout(), $nav.removeClass(lightcase.settings.classPrefix + "paused")), $loading.hide(), $overlay.hide(), $case.hide(), $nav.children().hide(), $case.removeAttr("data-type"), $nav.removeAttr("data-ispartofsequence"), $contentInner.empty().hide(), $info.children().empty(), lightcase.cache.originalObject && lightcase.restoreObject(), lightcase.cache = {}
        }
    }, e.fn.lightcase = function(t) {
        return lightcase[t] ? lightcase[t].apply(this, Array.prototype.slice.call(arguments, 1)) : "object" != typeof t && t ? void e.error("Method " + t + " does not exist on jQuery.lightcase") : lightcase.init.apply(this, arguments)
    }
}(jQuery);