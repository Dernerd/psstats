/* Psstats Javascript - cb=482038ef2a3202cc80e97d43c495f456*/

/*!
 * PS Stats - kostenlose/freie Analyseplattform
 *
 * @link http://psstats.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */
(function() {
    jQuery.htmlPrefilter = function(html) { return html; };
    $(document).ready(function() {
        window.Materialize = window.M;
        $.fn.sideNav = $.fn.sidenav;
        $.fn.material_select = $.fn.formSelect;
        M.initializeJqueryWrapper(M.Tabs, 'tabs', 'M_Tabs');
        M.initializeJqueryWrapper(M.Modal, 'modal', 'M_Modal');
    });
})();
/*!
 * jQuery Browser Plugin 0.1.0
 * https://github.com/gabceb/jquery-browser-plugin
 *
 * Original jquery-browser code Copyright 2005, 2015 jQuery Foundation, Inc. and other contributors
 * http://jquery.org/license
 *
 * Modifications Copyright 2015 Gabriel Cebrian
 * https://github.com/gabceb
 *
 * Released under the MIT license
 *
 * Date: 23-11-2015
 */
! function(a) { "function" == typeof define && define.amd ? define(["jquery"], function(b) { return a(b) }) : "object" == typeof module && "object" == typeof module.exports ? module.exports = a(require("jquery")) : a(window.jQuery) }(function(a) {
    "use strict";

    function b(a) {
        void 0 === a && (a = window.navigator.userAgent), a = a.toLowerCase();
        var b = /(edge)\/([\w.]+)/.exec(a) || /(opr)[\/]([\w.]+)/.exec(a) || /(chrome)[ \/]([\w.]+)/.exec(a) || /(iemobile)[\/]([\w.]+)/.exec(a) || /(version)(applewebkit)[ \/]([\w.]+).*(safari)[ \/]([\w.]+)/.exec(a) || /(webkit)[ \/]([\w.]+).*(version)[ \/]([\w.]+).*(safari)[ \/]([\w.]+)/.exec(a) || /(webkit)[ \/]([\w.]+)/.exec(a) || /(opera)(?:.*version|)[ \/]([\w.]+)/.exec(a) || /(msie) ([\w.]+)/.exec(a) || a.indexOf("trident") >= 0 && /(rv)(?::| )([\w.]+)/.exec(a) || a.indexOf("compatible") < 0 && /(mozilla)(?:.*? rv:([\w.]+)|)/.exec(a) || [],
            c = /(ipad)/.exec(a) || /(ipod)/.exec(a) || /(windows phone)/.exec(a) || /(iphone)/.exec(a) || /(kindle)/.exec(a) || /(silk)/.exec(a) || /(android)/.exec(a) || /(win)/.exec(a) || /(mac)/.exec(a) || /(linux)/.exec(a) || /(cros)/.exec(a) || /(playbook)/.exec(a) || /(bb)/.exec(a) || /(blackberry)/.exec(a) || [],
            d = {},
            e = { browser: b[5] || b[3] || b[1] || "", version: b[2] || b[4] || "0", versionNumber: b[4] || b[2] || "0", platform: c[0] || "" };
        if (e.browser && (d[e.browser] = !0, d.version = e.version, d.versionNumber = parseInt(e.versionNumber, 10)), e.platform && (d[e.platform] = !0), (d.android || d.bb || d.blackberry || d.ipad || d.iphone || d.ipod || d.kindle || d.playbook || d.silk || d["windows phone"]) && (d.mobile = !0), (d.cros || d.mac || d.linux || d.win) && (d.desktop = !0), (d.chrome || d.opr || d.safari) && (d.webkit = !0), d.rv || d.iemobile) {
            var f = "msie";
            e.browser = f, d[f] = !0
        }
        if (d.edge) {
            delete d.edge;
            var g = "msedge";
            e.browser = g, d[g] = !0
        }
        if (d.safari && d.blackberry) {
            var h = "blackberry";
            e.browser = h, d[h] = !0
        }
        if (d.safari && d.playbook) {
            var i = "playbook";
            e.browser = i, d[i] = !0
        }
        if (d.bb) {
            var j = "blackberry";
            e.browser = j, d[j] = !0
        }
        if (d.opr) {
            var k = "opera";
            e.browser = k, d[k] = !0
        }
        if (d.safari && d.android) {
            var l = "android";
            e.browser = l, d[l] = !0
        }
        if (d.safari && d.kindle) {
            var m = "kindle";
            e.browser = m, d[m] = !0
        }
        if (d.safari && d.silk) {
            var n = "silk";
            e.browser = n, d[n] = !0
        }
        return d.name = e.browser, d.platform = e.platform, d
    }
    return window.jQBrowser = b(window.navigator.userAgent), window.jQBrowser.uaMatch = b, a && (a.browser = window.jQBrowser), window.jQBrowser
});;
(function(root, factory) {
    if (typeof define === 'function' && define.amd) {
        define(['jquery'], factory);
    } else if (typeof exports === 'object') {
        module.exports = factory(require('jquery'));
    } else {
        root.jquery_dotdotdot_js = factory(root.jQuery);
    }
}(this, function(jQuery) {
    /*
     *	jQuery dotdotdot 3.2.3
     *	@requires jQuery 1.7.0 or later
     *
     *	dotdotdot.frebsite.nl
     *
     *	Copyright (c) Fred Heusschen
     *	www.frebsite.nl
     *
     *	License: CC-BY-NC-4.0
     *	http://creativecommons.org/licenses/by-nc/4.0/
     */
    ! function(a) {
        "use strict";
        var d, t, n, s, o = "dotdotdot",
            e = "3.2.3";
        a[o] && a[o].version > e || (a[o] = function(t, e) { this.$dot = t, this.api = ["getInstance", "truncate", "restore", "destroy", "watch", "unwatch"], this.opts = e; var i = this.$dot.data(o); return i && i.destroy(), this.init(), this.truncate(), this.opts.watch && this.watch(), this }, a[o].version = e, a[o].uniqueId = 0, a[o].defaults = { ellipsis: "… ", callback: function(t) {}, truncate: "word", tolerance: 0, keep: null, watch: "window", height: null }, a[o].prototype = {
            init: function() { this.watchTimeout = null, this.watchInterval = null, this.uniqueId = a[o].uniqueId++, this.originalStyle = this.$dot.attr("style") || "", this.originalContent = this._getOriginalContent(), "break-word" !== this.$dot.css("word-wrap") && this.$dot.css("word-wrap", "break-word"), "nowrap" === this.$dot.css("white-space") && this.$dot.css("white-space", "normal"), null === this.opts.height && (this.opts.height = this._getMaxHeight()), "string" == typeof this.opts.ellipsis && (this.opts.ellipsis = document.createTextNode(this.opts.ellipsis)) },
            getInstance: function() { return this },
            truncate: function() { this.$inner = this.$dot.wrapInner("<div />").children().css({ display: "block", height: "auto", width: "auto", border: "none", padding: 0, margin: 0 }), this.$inner.empty().append(this.originalContent.clone(!0)), this.maxHeight = this._getMaxHeight(); var t = !1; return this._fits() || (t = !0, this._truncateToNode(this.$inner[0])), this.$dot[t ? "addClass" : "removeClass"](d.truncated), this.$inner.replaceWith(this.$inner.contents()), this.$inner = null, this.opts.callback.call(this.$dot[0], t), t },
            restore: function() { this.unwatch(), this.$dot.empty().append(this.originalContent).attr("style", this.originalStyle).removeClass(d.truncated) },
            destroy: function() { this.restore(), this.$dot.data(o, null) },
            watch: function() {
                var e = this;
                this.unwatch();
                var i = {};
                "window" == this.opts.watch ? s.on(n.resize + e.uniqueId, function(t) { e.watchTimeout && clearTimeout(e.watchTimeout), e.watchTimeout = setTimeout(function() { i = e._watchSizes(i, s, "width", "height") }, 100) }) : this.watchInterval = setInterval(function() { i = e._watchSizes(i, e.$dot, "innerWidth", "innerHeight") }, 500)
            },
            unwatch: function() { s.off(n.resize + this.uniqueId), this.watchInterval && clearInterval(this.watchInterval), this.watchTimeout && clearTimeout(this.watchTimeout) },
            _api: function() {
                var i = this,
                    n = {};
                return a.each(this.api, function(t) {
                    var e = this;
                    n[e] = function() { var t = i[e].apply(i, arguments); return void 0 === t ? n : t }
                }), n
            },
            _truncateToNode: function(t) {
                var i = [],
                    n = [];
                if (a(t).contents().each(function() {
                        var t = a(this);
                        if (!t.hasClass(d.keep)) {
                            var e = document.createComment("");
                            t.replaceWith(e), n.push(this), i.push(e)
                        }
                    }), n.length) {
                    for (var e = 0; e < n.length; e++) { a(i[e]).replaceWith(n[e]), a(n[e]).append(this.opts.ellipsis); var s = this._fits(); if (a(this.opts.ellipsis, n[e]).remove(), !s) { if ("node" == this.opts.truncate && 1 < e) return void a(n[e - 2]).remove(); break } }
                    for (var o = e; o < i.length; o++) a(i[o]).remove();
                    var r = n[Math.max(0, Math.min(e, n.length - 1))];
                    if (1 == r.nodeType) {
                        var h = a("<" + r.nodeName + " />");
                        h.append(this.opts.ellipsis), a(r).replaceWith(h), this._fits() ? h.replaceWith(r) : (h.remove(), r = n[Math.max(0, e - 1)])
                    }
                    1 == r.nodeType ? this._truncateToNode(r) : this._truncateToWord(r)
                }
            },
            _truncateToWord: function(t) {
                for (var e = t, i = this, n = this.__getTextContent(e), s = -1 !== n.indexOf(" ") ? " " : "　", o = n.split(s), r = "", h = o.length; 0 <= h; h--)
                    if (r = o.slice(0, h).join(s), i.__setTextContent(e, i._addEllipsis(r)), i._fits()) { "letter" == i.opts.truncate && (i.__setTextContent(e, o.slice(0, h + 1).join(s)), i._truncateToLetter(e)); break }
            },
            _truncateToLetter: function(t) { for (var e = this, i = this.__getTextContent(t).split(""), n = "", s = i.length; 0 <= s && (!(n = i.slice(0, s).join("")).length || (e.__setTextContent(t, e._addEllipsis(n)), !e._fits())); s--); },
            _fits: function() { return this.$inner.innerHeight() <= this.maxHeight + this.opts.tolerance },
            _addEllipsis: function(t) { for (var e = [" ", "　", ",", ";", ".", "!", "?"]; - 1 < a.inArray(t.slice(-1), e);) t = t.slice(0, -1); return t += this.__getTextContent(this.opts.ellipsis) },
            _getOriginalContent: function() {
                var i = this;
                return this.$dot.find("script, style").addClass(d.keep), this.opts.keep && this.$dot.find(this.opts.keep).addClass(d.keep), this.$dot.find("*").not("." + d.keep).add(this.$dot).contents().each(function() {
                    var t = this,
                        e = a(this);
                    if (3 == t.nodeType) { if ("" == a.trim(i.__getTextContent(t))) { if (e.parent().is("table, thead, tbody, tfoot, tr, dl, ul, ol, video")) return void e.remove(); if (e.prev().is("div, p, table, td, td, dt, dd, li")) return void e.remove(); if (e.next().is("div, p, table, td, td, dt, dd, li")) return void e.remove(); if (!e.prev().length) return void e.remove(); if (!e.next().length) return void e.remove() } } else 8 == t.nodeType && e.remove()
                }), this.$dot.contents()
            },
            _getMaxHeight: function() {
                if ("number" == typeof this.opts.height) return this.opts.height;
                for (var t = ["maxHeight", "height"], e = 0, i = 0; i < t.length; i++)
                    if ("px" == (e = window.getComputedStyle(this.$dot[0])[t[i]]).slice(-2)) { e = parseFloat(e); break }
                t = [];
                switch (this.$dot.css("boxSizing")) {
                    case "border-box":
                        t.push("borderTopWidth"), t.push("borderBottomWidth");
                    case "padding-box":
                        t.push("paddingTop"), t.push("paddingBottom")
                }
                for (i = 0; i < t.length; i++) { var n = window.getComputedStyle(this.$dot[0])[t[i]]; "px" == n.slice(-2) && (e -= parseFloat(n)) }
                return Math.max(e, 0)
            },
            _watchSizes: function(t, e, i, n) { if (this.$dot.is(":visible")) { var s = { width: e[i](), height: e[n]() }; return t.width == s.width && t.height == s.height || this.truncate(), s } return t },
            __getTextContent: function(t) {
                for (var e = ["nodeValue", "textContent", "innerText"], i = 0; i < e.length; i++)
                    if ("string" == typeof t[e[i]]) return t[e[i]];
                return ""
            },
            __setTextContent: function(t, e) { for (var i = ["nodeValue", "textContent", "innerText"], n = 0; n < i.length; n++) t[i[n]] = e }
        }, a.fn[o] = function(t) { return i(), t = a.extend(!0, {}, a[o].defaults, t), this.each(function() { a(this).data(o, new a[o](a(this), t)._api()) }) });

        function i() { s = a(window), d = {}, t = {}, n = {}, a.each([d, t, n], function(t, n) { n.add = function(t) { for (var e = 0, i = (t = t.split(" ")).length; e < i; e++) n[t[e]] = n.ddd(t[e]) } }), d.ddd = function(t) { return "ddd-" + t }, d.add("truncated keep"), t.ddd = function(t) { return "ddd-" + t }, n.ddd = function(t) { return t + ".ddd" }, n.add("resize"), i = function() {} }
    }(jQuery);
    return true;
}));

/*! sprintf-js v1.1.2 | Copyright (c) 2007-present, Alexandru Mărășteanu <hello@alexei.ro> | BSD-3-Clause */
! function() {
    "use strict";
    var g = { not_string: /[^s]/, not_bool: /[^t]/, not_type: /[^T]/, not_primitive: /[^v]/, number: /[diefg]/, numeric_arg: /[bcdiefguxX]/, json: /[j]/, not_json: /[^j]/, text: /^[^\x25]+/, modulo: /^\x25{2}/, placeholder: /^\x25(?:([1-9]\d*)\$|\(([^)]+)\))?(\+)?(0|'[^$])?(-)?(\d+)?(?:\.(\d+))?([b-gijostTuvxX])/, key: /^([a-z_][a-z_\d]*)/i, key_access: /^\.([a-z_][a-z_\d]*)/i, index_access: /^\[(\d+)\]/, sign: /^[+-]/ };

    function y(e) {
        return function(e, t) {
            var r, n, i, s, a, o, p, c, l, u = 1,
                f = e.length,
                d = "";
            for (n = 0; n < f; n++)
                if ("string" == typeof e[n]) d += e[n];
                else if ("object" == typeof e[n]) {
                if ((s = e[n]).keys)
                    for (r = t[u], i = 0; i < s.keys.length; i++) {
                        if (null == r) throw new Error(y('[sprintf] Cannot access property "%s" of undefined value "%s"', s.keys[i], s.keys[i - 1]));
                        r = r[s.keys[i]]
                    } else r = s.param_no ? t[s.param_no] : t[u++];
                if (g.not_type.test(s.type) && g.not_primitive.test(s.type) && r instanceof Function && (r = r()), g.numeric_arg.test(s.type) && "number" != typeof r && isNaN(r)) throw new TypeError(y("[sprintf] expecting number but found %T", r));
                switch (g.number.test(s.type) && (c = 0 <= r), s.type) {
                    case "b":
                        r = parseInt(r, 10).toString(2);
                        break;
                    case "c":
                        r = String.fromCharCode(parseInt(r, 10));
                        break;
                    case "d":
                    case "i":
                        r = parseInt(r, 10);
                        break;
                    case "j":
                        r = JSON.stringify(r, null, s.width ? parseInt(s.width) : 0);
                        break;
                    case "e":
                        r = s.precision ? parseFloat(r).toExponential(s.precision) : parseFloat(r).toExponential();
                        break;
                    case "f":
                        r = s.precision ? parseFloat(r).toFixed(s.precision) : parseFloat(r);
                        break;
                    case "g":
                        r = s.precision ? String(Number(r.toPrecision(s.precision))) : parseFloat(r);
                        break;
                    case "o":
                        r = (parseInt(r, 10) >>> 0).toString(8);
                        break;
                    case "s":
                        r = String(r), r = s.precision ? r.substring(0, s.precision) : r;
                        break;
                    case "t":
                        r = String(!!r), r = s.precision ? r.substring(0, s.precision) : r;
                        break;
                    case "T":
                        r = Object.prototype.toString.call(r).slice(8, -1).toLowerCase(), r = s.precision ? r.substring(0, s.precision) : r;
                        break;
                    case "u":
                        r = parseInt(r, 10) >>> 0;
                        break;
                    case "v":
                        r = r.valueOf(), r = s.precision ? r.substring(0, s.precision) : r;
                        break;
                    case "x":
                        r = (parseInt(r, 10) >>> 0).toString(16);
                        break;
                    case "X":
                        r = (parseInt(r, 10) >>> 0).toString(16).toUpperCase()
                }
                g.json.test(s.type) ? d += r : (!g.number.test(s.type) || c && !s.sign ? l = "" : (l = c ? "+" : "-", r = r.toString().replace(g.sign, "")), o = s.pad_char ? "0" === s.pad_char ? "0" : s.pad_char.charAt(1) : " ", p = s.width - (l + r).length, a = s.width && 0 < p ? o.repeat(p) : "", d += s.align ? l + r + a : "0" === o ? l + a + r : a + l + r)
            }
            return d
        }(function(e) {
            if (p[e]) return p[e];
            var t, r = e,
                n = [],
                i = 0;
            for (; r;) {
                if (null !== (t = g.text.exec(r))) n.push(t[0]);
                else if (null !== (t = g.modulo.exec(r))) n.push("%");
                else {
                    if (null === (t = g.placeholder.exec(r))) throw new SyntaxError("[sprintf] unexpected placeholder");
                    if (t[2]) {
                        i |= 1;
                        var s = [],
                            a = t[2],
                            o = [];
                        if (null === (o = g.key.exec(a))) throw new SyntaxError("[sprintf] failed to parse named argument key");
                        for (s.push(o[1]);
                            "" !== (a = a.substring(o[0].length));)
                            if (null !== (o = g.key_access.exec(a))) s.push(o[1]);
                            else {
                                if (null === (o = g.index_access.exec(a))) throw new SyntaxError("[sprintf] failed to parse named argument key");
                                s.push(o[1])
                            }
                        t[2] = s
                    } else i |= 2;
                    if (3 === i) throw new Error("[sprintf] mixing positional and named placeholders is not (yet) supported");
                    n.push({ placeholder: t[0], param_no: t[1], keys: t[2], sign: t[3], pad_char: t[4], align: t[5], width: t[6], precision: t[7], type: t[8] })
                }
                r = r.substring(t[0].length)
            }
            return p[e] = n
        }(e), arguments)
    }

    function e(e, t) { return y.apply(null, [e].concat(t || [])) }
    var p = Object.create(null);
    "undefined" != typeof exports && (exports.sprintf = y, exports.vsprintf = e), "undefined" != typeof window && (window.sprintf = y, window.vsprintf = e, "function" == typeof define && define.amd && define(function() { return { sprintf: y, vsprintf: e } }))
}();
//# 

/**
 * Copyright (c) 2007-2015 Ariel Flesler - aflesler<a>gmail<d>com | http://flesler.blogspot.com
 * Licensed under MIT
 * @author Ariel Flesler
 * @version 2.1.2
 */
;
(function(f) { "use strict"; "function" === typeof define && define.amd ? define(["jquery"], f) : "undefined" !== typeof module && module.exports ? module.exports = f(require("jquery")) : f(jQuery) })(function($) {
    "use strict";

    function n(a) { return !a.nodeName || -1 !== $.inArray(a.nodeName.toLowerCase(), ["iframe", "#document", "html", "body"]) }

    function h(a) { return $.isFunction(a) || $.isPlainObject(a) ? a : { top: a, left: a } }
    var p = $.scrollTo = function(a, d, b) { return $(window).scrollTo(a, d, b) };
    p.defaults = { axis: "xy", duration: 0, limit: !0 };
    $.fn.scrollTo = function(a, d, b) {
        "object" === typeof d && (b = d, d = 0);
        "function" === typeof b && (b = { onAfter: b });
        "max" === a && (a = 9E9);
        b = $.extend({}, p.defaults, b);
        d = d || b.duration;
        var u = b.queue && 1 < b.axis.length;
        u && (d /= 2);
        b.offset = h(b.offset);
        b.over = h(b.over);
        return this.each(function() {
            function k(a) {
                var k = $.extend({}, b, { queue: !0, duration: d, complete: a && function() { a.call(q, e, b) } });
                r.animate(f, k)
            }
            if (null !== a) {
                var l = n(this),
                    q = l ? this.contentWindow || window : this,
                    r = $(q),
                    e = a,
                    f = {},
                    t;
                switch (typeof e) {
                    case "number":
                    case "string":
                        if (/^([+-]=?)?\d+(\.\d+)?(px|%)?$/.test(e)) { e = h(e); break }
                        e = l ? $(e) : $(e, q);
                    case "object":
                        if (e.length === 0) return;
                        if (e.is || e.style) t = (e = $(e)).offset()
                }
                var v = $.isFunction(b.offset) && b.offset(q, e) || b.offset;
                $.each(b.axis.split(""), function(a, c) {
                    var d = "x" === c ? "Left" : "Top",
                        m = d.toLowerCase(),
                        g = "scroll" + d,
                        h = r[g](),
                        n = p.max(q, c);
                    t ? (f[g] = t[m] + (l ? 0 : h - r.offset()[m]), b.margin && (f[g] -= parseInt(e.css("margin" + d), 10) || 0, f[g] -= parseInt(e.css("border" + d + "Width"), 10) || 0), f[g] += v[m] || 0, b.over[m] && (f[g] += e["x" === c ? "width" : "height"]() * b.over[m])) : (d = e[m], f[g] = d.slice && "%" === d.slice(-1) ? parseFloat(d) / 100 * n : d);
                    b.limit && /^\d+$/.test(f[g]) && (f[g] = 0 >= f[g] ? 0 : Math.min(f[g], n));
                    !a && 1 < b.axis.length && (h === f[g] ? f = {} : u && (k(b.onAfterFirst), f = {}))
                });
                k(b.onAfter)
            }
        })
    };
    p.max = function(a, d) {
        var b = "x" === d ? "Width" : "Height",
            h = "scroll" + b;
        if (!n(a)) return a[h] - $(a)[b.toLowerCase()]();
        var b = "client" + b,
            k = a.ownerDocument || a.document,
            l = k.documentElement,
            k = k.body;
        return Math.max(l[h], k[h]) - Math.min(l[b], k[b])
    };
    $.Tween.propHooks.scrollLeft = $.Tween.propHooks.scrollTop = {
        get: function(a) { return $(a.elem)[a.prop]() },
        set: function(a) {
            var d = this.get(a);
            if (a.options.interrupt && a._last && a._last !== d) return $(a.elem).stop();
            var b = Math.round(a.now);
            d !== b && ($(a.elem)[a.prop](b), a._last = this.get(a))
        }
    };
    return p
});
/* mousetrap v1.6.5 craig.is/killing/mice */
(function(q, u, c) {
    function v(a, b, g) { a.addEventListener ? a.addEventListener(b, g, !1) : a.attachEvent("on" + b, g) }

    function z(a) {
        if ("keypress" == a.type) {
            var b = String.fromCharCode(a.which);
            a.shiftKey || (b = b.toLowerCase());
            return b
        }
        return n[a.which] ? n[a.which] : r[a.which] ? r[a.which] : String.fromCharCode(a.which).toLowerCase()
    }

    function F(a) {
        var b = [];
        a.shiftKey && b.push("shift");
        a.altKey && b.push("alt");
        a.ctrlKey && b.push("ctrl");
        a.metaKey && b.push("meta");
        return b
    }

    function w(a) {
        return "shift" == a || "ctrl" == a || "alt" == a ||
            "meta" == a
    }

    function A(a, b) {
        var g, d = [];
        var e = a;
        "+" === e ? e = ["+"] : (e = e.replace(/\+{2}/g, "+plus"), e = e.split("+"));
        for (g = 0; g < e.length; ++g) {
            var m = e[g];
            B[m] && (m = B[m]);
            b && "keypress" != b && C[m] && (m = C[m], d.push("shift"));
            w(m) && d.push(m)
        }
        e = m;
        g = b;
        if (!g) {
            if (!p) { p = {}; for (var c in n) 95 < c && 112 > c || n.hasOwnProperty(c) && (p[n[c]] = c) }
            g = p[e] ? "keydown" : "keypress"
        }
        "keypress" == g && d.length && (g = "keydown");
        return { key: m, modifiers: d, action: g }
    }

    function D(a, b) { return null === a || a === u ? !1 : a === b ? !0 : D(a.parentNode, b) }

    function d(a) {
        function b(a) {
            a =
                a || {};
            var b = !1,
                l;
            for (l in p) a[l] ? b = !0 : p[l] = 0;
            b || (x = !1)
        }

        function g(a, b, t, f, g, d) {
            var l, E = [],
                h = t.type;
            if (!k._callbacks[a]) return [];
            "keyup" == h && w(a) && (b = [a]);
            for (l = 0; l < k._callbacks[a].length; ++l) {
                var c = k._callbacks[a][l];
                if ((f || !c.seq || p[c.seq] == c.level) && h == c.action) {
                    var e;
                    (e = "keypress" == h && !t.metaKey && !t.ctrlKey) || (e = c.modifiers, e = b.sort().join(",") === e.sort().join(","));
                    e && (e = f && c.seq == f && c.level == d, (!f && c.combo == g || e) && k._callbacks[a].splice(l, 1), E.push(c))
                }
            }
            return E
        }

        function c(a, b, c, f) {
            k.stopCallback(b,
                b.target || b.srcElement, c, f) || !1 !== a(b, c) || (b.preventDefault ? b.preventDefault() : b.returnValue = !1, b.stopPropagation ? b.stopPropagation() : b.cancelBubble = !0)
        }

        function e(a) {
            "number" !== typeof a.which && (a.which = a.keyCode);
            var b = z(a);
            b && ("keyup" == a.type && y === b ? y = !1 : k.handleKey(b, F(a), a))
        }

        function m(a, g, t, f) {
            function h(c) {
                return function() {
                    x = c;
                    ++p[a];
                    clearTimeout(q);
                    q = setTimeout(b, 1E3)
                }
            }

            function l(g) {
                c(t, g, a);
                "keyup" !== f && (y = z(g));
                setTimeout(b, 10)
            }
            for (var d = p[a] = 0; d < g.length; ++d) {
                var e = d + 1 === g.length ? l : h(f ||
                    A(g[d + 1]).action);
                n(g[d], e, f, a, d)
            }
        }

        function n(a, b, c, f, d) {
            k._directMap[a + ":" + c] = b;
            a = a.replace(/\s+/g, " ");
            var e = a.split(" ");
            1 < e.length ? m(a, e, b, c) : (c = A(a, c), k._callbacks[c.key] = k._callbacks[c.key] || [], g(c.key, c.modifiers, { type: c.action }, f, a, d), k._callbacks[c.key][f ? "unshift" : "push"]({ callback: b, modifiers: c.modifiers, action: c.action, seq: f, level: d, combo: a }))
        }
        var k = this;
        a = a || u;
        if (!(k instanceof d)) return new d(a);
        k.target = a;
        k._callbacks = {};
        k._directMap = {};
        var p = {},
            q, y = !1,
            r = !1,
            x = !1;
        k._handleKey = function(a,
            d, e) {
            var f = g(a, d, e),
                h;
            d = {};
            var k = 0,
                l = !1;
            for (h = 0; h < f.length; ++h) f[h].seq && (k = Math.max(k, f[h].level));
            for (h = 0; h < f.length; ++h) f[h].seq ? f[h].level == k && (l = !0, d[f[h].seq] = 1, c(f[h].callback, e, f[h].combo, f[h].seq)) : l || c(f[h].callback, e, f[h].combo);
            f = "keypress" == e.type && r;
            e.type != x || w(a) || f || b(d);
            r = l && "keydown" == e.type
        };
        k._bindMultiple = function(a, b, c) { for (var d = 0; d < a.length; ++d) n(a[d], b, c) };
        v(a, "keypress", e);
        v(a, "keydown", e);
        v(a, "keyup", e)
    }
    if (q) {
        var n = {
                8: "backspace",
                9: "tab",
                13: "enter",
                16: "shift",
                17: "ctrl",
                18: "alt",
                20: "capslock",
                27: "esc",
                32: "space",
                33: "pageup",
                34: "pagedown",
                35: "end",
                36: "home",
                37: "left",
                38: "up",
                39: "right",
                40: "down",
                45: "ins",
                46: "del",
                91: "meta",
                93: "meta",
                224: "meta"
            },
            r = { 106: "*", 107: "+", 109: "-", 110: ".", 111: "/", 186: ";", 187: "=", 188: ",", 189: "-", 190: ".", 191: "/", 192: "`", 219: "[", 220: "\\", 221: "]", 222: "'" },
            C = { "~": "`", "!": "1", "@": "2", "#": "3", $: "4", "%": "5", "^": "6", "&": "7", "*": "8", "(": "9", ")": "0", _: "-", "+": "=", ":": ";", '"': "'", "<": ",", ">": ".", "?": "/", "|": "\\" },
            B = {
                option: "alt",
                command: "meta",
                "return": "enter",
                escape: "esc",
                plus: "+",
                mod: /Mac|iPod|iPhone|iPad/.test(navigator.platform) ? "meta" : "ctrl"
            },
            p;
        for (c = 1; 20 > c; ++c) n[111 + c] = "f" + c;
        for (c = 0; 9 >= c; ++c) n[c + 96] = c.toString();
        d.prototype.bind = function(a, b, c) {
            a = a instanceof Array ? a : [a];
            this._bindMultiple.call(this, a, b, c);
            return this
        };
        d.prototype.unbind = function(a, b) { return this.bind.call(this, a, function() {}, b) };
        d.prototype.trigger = function(a, b) { if (this._directMap[a + ":" + b]) this._directMap[a + ":" + b]({}, a); return this };
        d.prototype.reset = function() {
            this._callbacks = {};
            this._directMap = {};
            return this
        };
        d.prototype.stopCallback = function(a, b) {
            if (-1 < (" " + b.className + " ").indexOf(" mousetrap ") || D(b, this.target)) return !1;
            if ("composedPath" in a && "function" === typeof a.composedPath) {
                var c = a.composedPath()[0];
                c !== a.target && (b = c)
            }
            return "INPUT" == b.tagName || "SELECT" == b.tagName || "TEXTAREA" == b.tagName || b.isContentEditable
        };
        d.prototype.handleKey = function() { return this._handleKey.apply(this, arguments) };
        d.addKeycodes = function(a) {
            for (var b in a) a.hasOwnProperty(b) && (n[b] = a[b]);
            p = null
        };
        d.init = function() {
            var a = d(u),
                b;
            for (b in a) "_" !== b.charAt(0) && (d[b] = function(b) { return function() { return a[b].apply(a, arguments) } }(b))
        };
        d.init();
        q.Mousetrap = d;
        "undefined" !== typeof module && module.exports && (module.exports = d);
        "function" === typeof define && define.amd && define(function() { return d })
    }
})("undefined" !== typeof window ? window : null, "undefined" !== typeof window ? document : null);

/*
 AngularJS v1.8.2
 (c) 2010-2020 Google LLC. http://angularjs.org
 License: MIT
*/
(function(z) {
    'use strict';

    function ve(a) {
        if (D(a)) w(a.objectMaxDepth) && (Xb.objectMaxDepth = Yb(a.objectMaxDepth) ? a.objectMaxDepth : NaN), w(a.urlErrorParamsEnabled) && Ga(a.urlErrorParamsEnabled) && (Xb.urlErrorParamsEnabled = a.urlErrorParamsEnabled);
        else return Xb
    }

    function Yb(a) { return X(a) && 0 < a }

    function F(a, b) {
        b = b || Error;
        return function() {
            var d = arguments[0],
                c;
            c = "[" + (a ? a + ":" : "") + d + "] http://errors.angularjs.org/1.8.2/" + (a ? a + "/" : "") + d;
            for (d = 1; d < arguments.length; d++) {
                c = c + (1 == d ? "?" : "&") + "p" + (d - 1) + "=";
                var e = encodeURIComponent,
                    f;
                f = arguments[d];
                f = "function" == typeof f ? f.toString().replace(/ \{[\s\S]*$/, "") : "undefined" == typeof f ? "undefined" : "string" != typeof f ? JSON.stringify(f) : f;
                c += e(f)
            }
            return new b(c)
        }
    }

    function za(a) { if (null == a || $a(a)) return !1; if (H(a) || C(a) || x && a instanceof x) return !0; var b = "length" in Object(a) && a.length; return X(b) && (0 <= b && b - 1 in a || "function" === typeof a.item) }

    function r(a, b, d) {
        var c, e;
        if (a)
            if (B(a))
                for (c in a) "prototype" !== c && "length" !== c && "name" !== c && a.hasOwnProperty(c) && b.call(d, a[c], c, a);
            else if (H(a) ||
            za(a)) {
            var f = "object" !== typeof a;
            c = 0;
            for (e = a.length; c < e; c++)(f || c in a) && b.call(d, a[c], c, a)
        } else if (a.forEach && a.forEach !== r) a.forEach(b, d, a);
        else if (Pc(a))
            for (c in a) b.call(d, a[c], c, a);
        else if ("function" === typeof a.hasOwnProperty)
            for (c in a) a.hasOwnProperty(c) && b.call(d, a[c], c, a);
        else
            for (c in a) ta.call(a, c) && b.call(d, a[c], c, a);
        return a
    }

    function Qc(a, b, d) { for (var c = Object.keys(a).sort(), e = 0; e < c.length; e++) b.call(d, a[c[e]], c[e]); return c }

    function Zb(a) { return function(b, d) { a(d, b) } }

    function we() { return ++qb }

    function $b(a, b, d) {
        for (var c = a.$$hashKey, e = 0, f = b.length; e < f; ++e) {
            var g = b[e];
            if (D(g) || B(g))
                for (var k = Object.keys(g), h = 0, l = k.length; h < l; h++) {
                    var m = k[h],
                        p = g[m];
                    d && D(p) ? ha(p) ? a[m] = new Date(p.valueOf()) : ab(p) ? a[m] = new RegExp(p) : p.nodeName ? a[m] = p.cloneNode(!0) : ac(p) ? a[m] = p.clone() : "__proto__" !== m && (D(a[m]) || (a[m] = H(p) ? [] : {}), $b(a[m], [p], !0)) : a[m] = p
                }
        }
        c ? a.$$hashKey = c : delete a.$$hashKey;
        return a
    }

    function S(a) { return $b(a, Ha.call(arguments, 1), !1) }

    function xe(a) { return $b(a, Ha.call(arguments, 1), !0) }

    function fa(a) {
        return parseInt(a,
            10)
    }

    function bc(a, b) { return S(Object.create(a), b) }

    function E() {}

    function Ta(a) { return a }

    function ia(a) { return function() { return a } }

    function cc(a) { return B(a.toString) && a.toString !== la }

    function A(a) { return "undefined" === typeof a }

    function w(a) { return "undefined" !== typeof a }

    function D(a) { return null !== a && "object" === typeof a }

    function Pc(a) { return null !== a && "object" === typeof a && !Rc(a) }

    function C(a) { return "string" === typeof a }

    function X(a) { return "number" === typeof a }

    function ha(a) { return "[object Date]" === la.call(a) }

    function H(a) { return Array.isArray(a) || a instanceof Array }

    function dc(a) {
        switch (la.call(a)) {
            case "[object Error]":
                return !0;
            case "[object Exception]":
                return !0;
            case "[object DOMException]":
                return !0;
            default:
                return a instanceof Error
        }
    }

    function B(a) { return "function" === typeof a }

    function ab(a) { return "[object RegExp]" === la.call(a) }

    function $a(a) { return a && a.window === a }

    function bb(a) { return a && a.$evalAsync && a.$watch }

    function Ga(a) { return "boolean" === typeof a }

    function ye(a) { return a && X(a.length) && ze.test(la.call(a)) }

    function ac(a) { return !(!a || !(a.nodeName || a.prop && a.attr && a.find)) }

    function Ae(a) {
        var b = {};
        a = a.split(",");
        var d;
        for (d = 0; d < a.length; d++) b[a[d]] = !0;
        return b
    }

    function ua(a) { return K(a.nodeName || a[0] && a[0].nodeName) }

    function cb(a, b) {
        var d = a.indexOf(b);
        0 <= d && a.splice(d, 1);
        return d
    }

    function Ia(a, b, d) {
        function c(a, b, c) {
            c--;
            if (0 > c) return "...";
            var d = b.$$hashKey,
                f;
            if (H(a)) { f = 0; for (var g = a.length; f < g; f++) b.push(e(a[f], c)) } else if (Pc(a))
                for (f in a) b[f] = e(a[f], c);
            else if (a && "function" === typeof a.hasOwnProperty)
                for (f in a) a.hasOwnProperty(f) &&
                    (b[f] = e(a[f], c));
            else
                for (f in a) ta.call(a, f) && (b[f] = e(a[f], c));
            d ? b.$$hashKey = d : delete b.$$hashKey;
            return b
        }

        function e(a, b) {
            if (!D(a)) return a;
            var d = g.indexOf(a);
            if (-1 !== d) return k[d];
            if ($a(a) || bb(a)) throw oa("cpws");
            var d = !1,
                e = f(a);
            void 0 === e && (e = H(a) ? [] : Object.create(Rc(a)), d = !0);
            g.push(a);
            k.push(e);
            return d ? c(a, e, b) : e
        }

        function f(a) {
            switch (la.call(a)) {
                case "[object Int8Array]":
                case "[object Int16Array]":
                case "[object Int32Array]":
                case "[object Float32Array]":
                case "[object Float64Array]":
                case "[object Uint8Array]":
                case "[object Uint8ClampedArray]":
                case "[object Uint16Array]":
                case "[object Uint32Array]":
                    return new a.constructor(e(a.buffer),
                        a.byteOffset, a.length);
                case "[object ArrayBuffer]":
                    if (!a.slice) {
                        var b = new ArrayBuffer(a.byteLength);
                        (new Uint8Array(b)).set(new Uint8Array(a));
                        return b
                    }
                    return a.slice(0);
                case "[object Boolean]":
                case "[object Number]":
                case "[object String]":
                case "[object Date]":
                    return new a.constructor(a.valueOf());
                case "[object RegExp]":
                    return b = new RegExp(a.source, a.toString().match(/[^/]*$/)[0]), b.lastIndex = a.lastIndex, b;
                case "[object Blob]":
                    return new a.constructor([a], { type: a.type })
            }
            if (B(a.cloneNode)) return a.cloneNode(!0)
        }
        var g = [],
            k = [];
        d = Yb(d) ? d : NaN;
        if (b) {
            if (ye(b) || "[object ArrayBuffer]" === la.call(b)) throw oa("cpta");
            if (a === b) throw oa("cpi");
            H(b) ? b.length = 0 : r(b, function(a, c) { "$$hashKey" !== c && delete b[c] });
            g.push(a);
            k.push(b);
            return c(a, b, d)
        }
        return e(a, d)
    }

    function ec(a, b) { return a === b || a !== a && b !== b }

    function va(a, b) {
        if (a === b) return !0;
        if (null === a || null === b) return !1;
        if (a !== a && b !== b) return !0;
        var d = typeof a,
            c;
        if (d === typeof b && "object" === d)
            if (H(a)) {
                if (!H(b)) return !1;
                if ((d = a.length) === b.length) {
                    for (c = 0; c < d; c++)
                        if (!va(a[c],
                                b[c])) return !1;
                    return !0
                }
            } else {
                if (ha(a)) return ha(b) ? ec(a.getTime(), b.getTime()) : !1;
                if (ab(a)) return ab(b) ? a.toString() === b.toString() : !1;
                if (bb(a) || bb(b) || $a(a) || $a(b) || H(b) || ha(b) || ab(b)) return !1;
                d = T();
                for (c in a)
                    if ("$" !== c.charAt(0) && !B(a[c])) {
                        if (!va(a[c], b[c])) return !1;
                        d[c] = !0
                    }
                for (c in b)
                    if (!(c in d) && "$" !== c.charAt(0) && w(b[c]) && !B(b[c])) return !1;
                return !0
            }
        return !1
    }

    function db(a, b, d) { return a.concat(Ha.call(b, d)) }

    function Va(a, b) {
        var d = 2 < arguments.length ? Ha.call(arguments, 2) : [];
        return !B(b) || b instanceof
        RegExp ? b : d.length ? function() { return arguments.length ? b.apply(a, db(d, arguments, 0)) : b.apply(a, d) } : function() { return arguments.length ? b.apply(a, arguments) : b.call(a) }
    }

    function Sc(a, b) { var d = b; "string" === typeof a && "$" === a.charAt(0) && "$" === a.charAt(1) ? d = void 0 : $a(b) ? d = "$WINDOW" : b && z.document === b ? d = "$DOCUMENT" : bb(b) && (d = "$SCOPE"); return d }

    function eb(a, b) { if (!A(a)) return X(b) || (b = b ? 2 : null), JSON.stringify(a, Sc, b) }

    function Tc(a) { return C(a) ? JSON.parse(a) : a }

    function fc(a, b) {
        a = a.replace(Be, "");
        var d = Date.parse("Jan 01, 1970 00:00:00 " +
            a) / 6E4;
        return Y(d) ? b : d
    }

    function Uc(a, b) {
        a = new Date(a.getTime());
        a.setMinutes(a.getMinutes() + b);
        return a
    }

    function gc(a, b, d) {
        d = d ? -1 : 1;
        var c = a.getTimezoneOffset();
        b = fc(b, c);
        return Uc(a, d * (b - c))
    }

    function Aa(a) { a = x(a).clone().empty(); var b = x("<div></div>").append(a).html(); try { return a[0].nodeType === Pa ? K(b) : b.match(/^(<[^>]+>)/)[1].replace(/^<([\w-]+)/, function(a, b) { return "<" + K(b) }) } catch (d) { return K(b) } }

    function Vc(a) { try { return decodeURIComponent(a) } catch (b) {} }

    function hc(a) {
        var b = {};
        r((a || "").split("&"),
            function(a) {
                var c, e, f;
                a && (e = a = a.replace(/\+/g, "%20"), c = a.indexOf("="), -1 !== c && (e = a.substring(0, c), f = a.substring(c + 1)), e = Vc(e), w(e) && (f = w(f) ? Vc(f) : !0, ta.call(b, e) ? H(b[e]) ? b[e].push(f) : b[e] = [b[e], f] : b[e] = f))
            });
        return b
    }

    function Ce(a) {
        var b = [];
        r(a, function(a, c) { H(a) ? r(a, function(a) { b.push(ba(c, !0) + (!0 === a ? "" : "=" + ba(a, !0))) }) : b.push(ba(c, !0) + (!0 === a ? "" : "=" + ba(a, !0))) });
        return b.length ? b.join("&") : ""
    }

    function ic(a) { return ba(a, !0).replace(/%26/gi, "&").replace(/%3D/gi, "=").replace(/%2B/gi, "+") }

    function ba(a,
        b) { return encodeURIComponent(a).replace(/%40/gi, "@").replace(/%3A/gi, ":").replace(/%24/g, "$").replace(/%2C/gi, ",").replace(/%3B/gi, ";").replace(/%20/g, b ? "%20" : "+") }

    function De(a, b) {
        var d, c, e = Qa.length;
        for (c = 0; c < e; ++c)
            if (d = Qa[c] + b, C(d = a.getAttribute(d))) return d;
        return null
    }

    function Ee(a, b) {
        var d, c, e = {};
        r(Qa, function(b) { b += "app";!d && a.hasAttribute && a.hasAttribute(b) && (d = a, c = a.getAttribute(b)) });
        r(Qa, function(b) { b += "app"; var e;!d && (e = a.querySelector("[" + b.replace(":", "\\:") + "]")) && (d = e, c = e.getAttribute(b)) });
        d && (Fe ? (e.strictDi = null !== De(d, "strict-di"), b(d, c ? [c] : [], e)) : z.console.error("AngularJS: disabling automatic bootstrap. <script> protocol indicates an extension, document.location.href does not match."))
    }

    function Wc(a, b, d) {
        D(d) || (d = {});
        d = S({ strictDi: !1 }, d);
        var c = function() {
                a = x(a);
                if (a.injector()) { var c = a[0] === z.document ? "document" : Aa(a); throw oa("btstrpd", c.replace(/</, "&lt;").replace(/>/, "&gt;")); }
                b = b || [];
                b.unshift(["$provide", function(b) { b.value("$rootElement", a) }]);
                d.debugInfoEnabled && b.push(["$compileProvider",
                    function(a) { a.debugInfoEnabled(!0) }
                ]);
                b.unshift("ng");
                c = fb(b, d.strictDi);
                c.invoke(["$rootScope", "$rootElement", "$compile", "$injector", function(a, b, c, d) {
                    a.$apply(function() {
                        b.data("$injector", d);
                        c(b)(a)
                    })
                }]);
                return c
            },
            e = /^NG_ENABLE_DEBUG_INFO!/,
            f = /^NG_DEFER_BOOTSTRAP!/;
        z && e.test(z.name) && (d.debugInfoEnabled = !0, z.name = z.name.replace(e, ""));
        if (z && !f.test(z.name)) return c();
        z.name = z.name.replace(f, "");
        ca.resumeBootstrap = function(a) { r(a, function(a) { b.push(a) }); return c() };
        B(ca.resumeDeferredBootstrap) &&
            ca.resumeDeferredBootstrap()
    }

    function Ge() {
        z.name = "NG_ENABLE_DEBUG_INFO!" + z.name;
        z.location.reload()
    }

    function He(a) { a = ca.element(a).injector(); if (!a) throw oa("test"); return a.get("$$testability") }

    function Xc(a, b) { b = b || "_"; return a.replace(Ie, function(a, c) { return (c ? b : "") + a.toLowerCase() }) }

    function Je() {
        var a;
        if (!Yc) {
            var b = rb();
            (sb = A(b) ? z.jQuery : b ? z[b] : void 0) && sb.fn.on ? (x = sb, S(sb.fn, { scope: Wa.scope, isolateScope: Wa.isolateScope, controller: Wa.controller, injector: Wa.injector, inheritedData: Wa.inheritedData })) :
                x = U;
            a = x.cleanData;
            x.cleanData = function(b) {
                for (var c, e = 0, f; null != (f = b[e]); e++)(c = (x._data(f) || {}).events) && c.$destroy && x(f).triggerHandler("$destroy");
                a(b)
            };
            ca.element = x;
            Yc = !0
        }
    }

    function Ke() { U.legacyXHTMLReplacement = !0 }

    function gb(a, b, d) { if (!a) throw oa("areq", b || "?", d || "required"); return a }

    function tb(a, b, d) {
        d && H(a) && (a = a[a.length - 1]);
        gb(B(a), b, "not a function, got " + (a && "object" === typeof a ? a.constructor.name || "Object" : typeof a));
        return a
    }

    function Ja(a, b) {
        if ("hasOwnProperty" === a) throw oa("badname",
            b);
    }

    function Le(a, b, d) {
        if (!b) return a;
        b = b.split(".");
        for (var c, e = a, f = b.length, g = 0; g < f; g++) c = b[g], a && (a = (e = a)[c]);
        return !d && B(a) ? Va(e, a) : a
    }

    function ub(a) {
        for (var b = a[0], d = a[a.length - 1], c, e = 1; b !== d && (b = b.nextSibling); e++)
            if (c || a[e] !== b) c || (c = x(Ha.call(a, 0, e))), c.push(b);
        return c || a
    }

    function T() { return Object.create(null) }

    function jc(a) {
        if (null == a) return "";
        switch (typeof a) {
            case "string":
                break;
            case "number":
                a = "" + a;
                break;
            default:
                a = !cc(a) || H(a) || ha(a) ? eb(a) : a.toString()
        }
        return a
    }

    function Me(a) {
        function b(a,
            b, c) { return a[b] || (a[b] = c()) }
        var d = F("$injector"),
            c = F("ng");
        a = b(a, "angular", Object);
        a.$$minErr = a.$$minErr || F;
        return b(a, "module", function() {
            var a = {};
            return function(f, g, k) {
                var h = {};
                if ("hasOwnProperty" === f) throw c("badname", "module");
                g && a.hasOwnProperty(f) && (a[f] = null);
                return b(a, f, function() {
                    function a(b, c, d, f) { f || (f = e); return function() { f[d || "push"]([b, c, arguments]); return t } }

                    function b(a, c, d) {
                        d || (d = e);
                        return function(b, e) {
                            e && B(e) && (e.$$moduleName = f);
                            d.push([a, c, arguments]);
                            return t
                        }
                    }
                    if (!g) throw d("nomod",
                        f);
                    var e = [],
                        n = [],
                        s = [],
                        G = a("$injector", "invoke", "push", n),
                        t = {
                            _invokeQueue: e,
                            _configBlocks: n,
                            _runBlocks: s,
                            info: function(a) {
                                if (w(a)) {
                                    if (!D(a)) throw c("aobj", "value");
                                    h = a;
                                    return this
                                }
                                return h
                            },
                            requires: g,
                            name: f,
                            provider: b("$provide", "provider"),
                            factory: b("$provide", "factory"),
                            service: b("$provide", "service"),
                            value: a("$provide", "value"),
                            constant: a("$provide", "constant", "unshift"),
                            decorator: b("$provide", "decorator", n),
                            animation: b("$animateProvider", "register"),
                            filter: b("$filterProvider", "register"),
                            controller: b("$controllerProvider",
                                "register"),
                            directive: b("$compileProvider", "directive"),
                            component: b("$compileProvider", "component"),
                            config: G,
                            run: function(a) { s.push(a); return this }
                        };
                    k && G(k);
                    return t
                })
            }
        })
    }

    function ja(a, b) {
        if (H(a)) { b = b || []; for (var d = 0, c = a.length; d < c; d++) b[d] = a[d] } else if (D(a))
            for (d in b = b || {}, a)
                if ("$" !== d.charAt(0) || "$" !== d.charAt(1)) b[d] = a[d];
        return b || a
    }

    function Ne(a, b) {
        var d = [];
        Yb(b) && (a = ca.copy(a, null, b));
        return JSON.stringify(a, function(a, b) {
            b = Sc(a, b);
            if (D(b)) {
                if (0 <= d.indexOf(b)) return "...";
                d.push(b)
            }
            return b
        })
    }

    function Oe(a) {
        S(a, { errorHandlingConfig: ve, bootstrap: Wc, copy: Ia, extend: S, merge: xe, equals: va, element: x, forEach: r, injector: fb, noop: E, bind: Va, toJson: eb, fromJson: Tc, identity: Ta, isUndefined: A, isDefined: w, isString: C, isFunction: B, isObject: D, isNumber: X, isElement: ac, isArray: H, version: Pe, isDate: ha, callbacks: { $$counter: 0 }, getTestability: He, reloadWithDebugInfo: Ge, UNSAFE_restoreLegacyJqLiteXHTMLReplacement: Ke, $$minErr: F, $$csp: Ba, $$encodeUriSegment: ic, $$encodeUriQuery: ba, $$lowercase: K, $$stringify: jc, $$uppercase: vb });
        lc = Me(z);
        lc("ng", ["ngLocale"], ["$provide", function(a) {
            a.provider({ $$sanitizeUri: Qe });
            a.provider("$compile", Zc).directive({
                a: Re,
                input: $c,
                textarea: $c,
                form: Se,
                script: Te,
                select: Ue,
                option: Ve,
                ngBind: We,
                ngBindHtml: Xe,
                ngBindTemplate: Ye,
                ngClass: Ze,
                ngClassEven: $e,
                ngClassOdd: af,
                ngCloak: bf,
                ngController: cf,
                ngForm: df,
                ngHide: ef,
                ngIf: ff,
                ngInclude: gf,
                ngInit: hf,
                ngNonBindable: jf,
                ngPluralize: kf,
                ngRef: lf,
                ngRepeat: mf,
                ngShow: nf,
                ngStyle: of,
                ngSwitch: pf,
                ngSwitchWhen: qf,
                ngSwitchDefault: rf,
                ngOptions: sf,
                ngTransclude: tf,
                ngModel: uf,
                ngList: vf,
                ngChange: wf,
                pattern: ad,
                ngPattern: ad,
                required: bd,
                ngRequired: bd,
                minlength: cd,
                ngMinlength: cd,
                maxlength: dd,
                ngMaxlength: dd,
                ngValue: xf,
                ngModelOptions: yf
            }).directive({ ngInclude: zf, input: Af }).directive(wb).directive(ed);
            a.provider({
                $anchorScroll: Bf,
                $animate: Cf,
                $animateCss: Df,
                $$animateJs: Ef,
                $$animateQueue: Ff,
                $$AnimateRunner: Gf,
                $$animateAsyncRun: Hf,
                $browser: If,
                $cacheFactory: Jf,
                $controller: Kf,
                $document: Lf,
                $$isDocumentHidden: Mf,
                $exceptionHandler: Nf,
                $filter: fd,
                $$forceReflow: Of,
                $interpolate: Pf,
                $interval: Qf,
                $$intervalFactory: Rf,
                $http: Sf,
                $httpParamSerializer: Tf,
                $httpParamSerializerJQLike: Uf,
                $httpBackend: Vf,
                $xhrFactory: Wf,
                $jsonpCallbacks: Xf,
                $location: Yf,
                $log: Zf,
                $parse: $f,
                $rootScope: ag,
                $q: bg,
                $$q: cg,
                $sce: dg,
                $sceDelegate: eg,
                $sniffer: fg,
                $$taskTrackerFactory: gg,
                $templateCache: hg,
                $templateRequest: ig,
                $$testability: jg,
                $timeout: kg,
                $window: lg,
                $$rAF: mg,
                $$jqLite: ng,
                $$Map: og,
                $$cookieReader: pg
            })
        }]).info({ angularVersion: "1.8.2" })
    }

    function xb(a, b) { return b.toUpperCase() }

    function yb(a) { return a.replace(qg, xb) }

    function mc(a) {
        a =
            a.nodeType;
        return 1 === a || !a || 9 === a
    }

    function gd(a, b) {
        var d, c, e, f = b.createDocumentFragment(),
            g = [],
            k;
        if (nc.test(a)) {
            d = f.appendChild(b.createElement("div"));
            c = (rg.exec(a) || ["", ""])[1].toLowerCase();
            e = U.legacyXHTMLReplacement ? a.replace(sg, "<$1></$2>") : a;
            if (10 > wa)
                for (c = hb[c] || hb._default, d.innerHTML = c[1] + e + c[2], k = c[0]; k--;) d = d.firstChild;
            else {
                c = qa[c] || [];
                for (k = c.length; - 1 < --k;) d.appendChild(z.document.createElement(c[k])), d = d.firstChild;
                d.innerHTML = e
            }
            g = db(g, d.childNodes);
            d = f.firstChild;
            d.textContent = ""
        } else g.push(b.createTextNode(a));
        f.textContent = "";
        f.innerHTML = "";
        r(g, function(a) { f.appendChild(a) });
        return f
    }

    function U(a) {
        if (a instanceof U) return a;
        var b;
        C(a) && (a = V(a), b = !0);
        if (!(this instanceof U)) { if (b && "<" !== a.charAt(0)) throw oc("nosel"); return new U(a) }
        if (b) {
            b = z.document;
            var d;
            a = (d = tg.exec(a)) ? [b.createElement(d[1])] : (d = gd(a, b)) ? d.childNodes : [];
            pc(this, a)
        } else B(a) ? hd(a) : pc(this, a)
    }

    function qc(a) { return a.cloneNode(!0) }

    function zb(a, b) {
        !b && mc(a) && x.cleanData([a]);
        a.querySelectorAll && x.cleanData(a.querySelectorAll("*"))
    }

    function id(a) {
        for (var b in a) return !1;
        return !0
    }

    function jd(a) {
        var b = a.ng339,
            d = b && Ka[b],
            c = d && d.events,
            d = d && d.data;
        d && !id(d) || c && !id(c) || (delete Ka[b], a.ng339 = void 0)
    }

    function kd(a, b, d, c) {
        if (w(c)) throw oc("offargs");
        var e = (c = Ab(a)) && c.events,
            f = c && c.handle;
        if (f) {
            if (b) {
                var g = function(b) {
                    var c = e[b];
                    w(d) && cb(c || [], d);
                    w(d) && c && 0 < c.length || (a.removeEventListener(b, f), delete e[b])
                };
                r(b.split(" "), function(a) {
                    g(a);
                    Bb[a] && g(Bb[a])
                })
            } else
                for (b in e) "$destroy" !== b && a.removeEventListener(b, f), delete e[b];
            jd(a)
        }
    }

    function rc(a, b) {
        var d = a.ng339;
        if (d =
            d && Ka[d]) b ? delete d.data[b] : d.data = {}, jd(a)
    }

    function Ab(a, b) {
        var d = a.ng339,
            d = d && Ka[d];
        b && !d && (a.ng339 = d = ++ug, d = Ka[d] = { events: {}, data: {}, handle: void 0 });
        return d
    }

    function sc(a, b, d) {
        if (mc(a)) {
            var c, e = w(d),
                f = !e && b && !D(b),
                g = !b;
            a = (a = Ab(a, !f)) && a.data;
            if (e) a[yb(b)] = d;
            else { if (g) return a; if (f) return a && a[yb(b)]; for (c in b) a[yb(c)] = b[c] }
        }
    }

    function Cb(a, b) { return a.getAttribute ? -1 < (" " + (a.getAttribute("class") || "") + " ").replace(/[\n\t]/g, " ").indexOf(" " + b + " ") : !1 }

    function Db(a, b) {
        if (b && a.setAttribute) {
            var d =
                (" " + (a.getAttribute("class") || "") + " ").replace(/[\n\t]/g, " "),
                c = d;
            r(b.split(" "), function(a) {
                a = V(a);
                c = c.replace(" " + a + " ", " ")
            });
            c !== d && a.setAttribute("class", V(c))
        }
    }

    function Eb(a, b) {
        if (b && a.setAttribute) {
            var d = (" " + (a.getAttribute("class") || "") + " ").replace(/[\n\t]/g, " "),
                c = d;
            r(b.split(" "), function(a) { a = V(a); - 1 === c.indexOf(" " + a + " ") && (c += a + " ") });
            c !== d && a.setAttribute("class", V(c))
        }
    }

    function pc(a, b) {
        if (b)
            if (b.nodeType) a[a.length++] = b;
            else {
                var d = b.length;
                if ("number" === typeof d && b.window !== b) {
                    if (d)
                        for (var c =
                                0; c < d; c++) a[a.length++] = b[c]
                } else a[a.length++] = b
            }
    }

    function ld(a, b) { return Fb(a, "$" + (b || "ngController") + "Controller") }

    function Fb(a, b, d) {
        9 === a.nodeType && (a = a.documentElement);
        for (b = H(b) ? b : [b]; a;) {
            for (var c = 0, e = b.length; c < e; c++)
                if (w(d = x.data(a, b[c]))) return d;
            a = a.parentNode || 11 === a.nodeType && a.host
        }
    }

    function md(a) { for (zb(a, !0); a.firstChild;) a.removeChild(a.firstChild) }

    function Gb(a, b) {
        b || zb(a);
        var d = a.parentNode;
        d && d.removeChild(a)
    }

    function vg(a, b) {
        b = b || z;
        if ("complete" === b.document.readyState) b.setTimeout(a);
        else x(b).on("load", a)
    }

    function hd(a) {
        function b() {
            z.document.removeEventListener("DOMContentLoaded", b);
            z.removeEventListener("load", b);
            a()
        }
        "complete" === z.document.readyState ? z.setTimeout(a) : (z.document.addEventListener("DOMContentLoaded", b), z.addEventListener("load", b))
    }

    function nd(a, b) { var d = Hb[b.toLowerCase()]; return d && od[ua(a)] && d }

    function wg(a, b) {
        var d = function(c, d) {
            c.isDefaultPrevented = function() { return c.defaultPrevented };
            var f = b[d || c.type],
                g = f ? f.length : 0;
            if (g) {
                if (A(c.immediatePropagationStopped)) {
                    var k =
                        c.stopImmediatePropagation;
                    c.stopImmediatePropagation = function() {
                        c.immediatePropagationStopped = !0;
                        c.stopPropagation && c.stopPropagation();
                        k && k.call(c)
                    }
                }
                c.isImmediatePropagationStopped = function() { return !0 === c.immediatePropagationStopped };
                var h = f.specialHandlerWrapper || xg;
                1 < g && (f = ja(f));
                for (var l = 0; l < g; l++) c.isImmediatePropagationStopped() || h(a, c, f[l])
            }
        };
        d.elem = a;
        return d
    }

    function xg(a, b, d) { d.call(a, b) }

    function yg(a, b, d) {
        var c = b.relatedTarget;
        c && (c === a || zg.call(a, c)) || d.call(a, b)
    }

    function ng() {
        this.$get =
            function() { return S(U, { hasClass: function(a, b) { a.attr && (a = a[0]); return Cb(a, b) }, addClass: function(a, b) { a.attr && (a = a[0]); return Eb(a, b) }, removeClass: function(a, b) { a.attr && (a = a[0]); return Db(a, b) } }) }
    }

    function La(a, b) {
        var d = a && a.$$hashKey;
        if (d) return "function" === typeof d && (d = a.$$hashKey()), d;
        d = typeof a;
        return d = "function" === d || "object" === d && null !== a ? a.$$hashKey = d + ":" + (b || we)() : d + ":" + a
    }

    function pd() {
        this._keys = [];
        this._values = [];
        this._lastKey = NaN;
        this._lastIndex = -1
    }

    function qd(a) {
        a = Function.prototype.toString.call(a).replace(Ag,
            "");
        return a.match(Bg) || a.match(Cg)
    }

    function Dg(a) { return (a = qd(a)) ? "function(" + (a[1] || "").replace(/[\s\r\n]+/, " ") + ")" : "fn" }

    function fb(a, b) {
        function d(a) {
            return function(b, c) {
                if (D(b)) r(b, Zb(a));
                else return a(b, c)
            }
        }

        function c(a, b) { Ja(a, "service"); if (B(b) || H(b)) b = n.instantiate(b); if (!b.$get) throw Ca("pget", a); return p[a + "Provider"] = b }

        function e(a, b) { return function() { var c = t.invoke(b, this); if (A(c)) throw Ca("undef", a); return c } }

        function f(a, b, d) { return c(a, { $get: !1 !== d ? e(a, b) : b }) }

        function g(a) {
            gb(A(a) ||
                H(a), "modulesToLoad", "not an array");
            var b = [],
                c;
            r(a, function(a) {
                function d(a) {
                    var b, c;
                    b = 0;
                    for (c = a.length; b < c; b++) {
                        var e = a[b],
                            f = n.get(e[0]);
                        f[e[1]].apply(f, e[2])
                    }
                }
                if (!m.get(a)) {
                    m.set(a, !0);
                    try { C(a) ? (c = lc(a), t.modules[a] = c, b = b.concat(g(c.requires)).concat(c._runBlocks), d(c._invokeQueue), d(c._configBlocks)) : B(a) ? b.push(n.invoke(a)) : H(a) ? b.push(n.invoke(a)) : tb(a, "module") } catch (e) {
                        throw H(a) && (a = a[a.length - 1]), e.message && e.stack && -1 === e.stack.indexOf(e.message) && (e = e.message + "\n" + e.stack), Ca("modulerr",
                            a, e.stack || e.message || e);
                    }
                }
            });
            return b
        }

        function k(a, c) {
            function d(b, e) { if (a.hasOwnProperty(b)) { if (a[b] === h) throw Ca("cdep", b + " <- " + l.join(" <- ")); return a[b] } try { return l.unshift(b), a[b] = h, a[b] = c(b, e), a[b] } catch (f) { throw a[b] === h && delete a[b], f; } finally { l.shift() } }

            function e(a, c, f) {
                var g = [];
                a = fb.$$annotate(a, b, f);
                for (var h = 0, k = a.length; h < k; h++) {
                    var l = a[h];
                    if ("string" !== typeof l) throw Ca("itkn", l);
                    g.push(c && c.hasOwnProperty(l) ? c[l] : d(l, f))
                }
                return g
            }
            return {
                invoke: function(a, b, c, d) {
                    "string" === typeof c &&
                        (d = c, c = null);
                    c = e(a, c, d);
                    H(a) && (a = a[a.length - 1]);
                    d = a;
                    if (wa || "function" !== typeof d) d = !1;
                    else {
                        var f = d.$$ngIsClass;
                        Ga(f) || (f = d.$$ngIsClass = /^class\b/.test(Function.prototype.toString.call(d)));
                        d = f
                    }
                    return d ? (c.unshift(null), new(Function.prototype.bind.apply(a, c))) : a.apply(b, c)
                },
                instantiate: function(a, b, c) {
                    var d = H(a) ? a[a.length - 1] : a;
                    a = e(a, b, c);
                    a.unshift(null);
                    return new(Function.prototype.bind.apply(d, a))
                },
                get: d,
                annotate: fb.$$annotate,
                has: function(b) { return p.hasOwnProperty(b + "Provider") || a.hasOwnProperty(b) }
            }
        }
        b = !0 === b;
        var h = {},
            l = [],
            m = new Ib,
            p = {
                $provide: {
                    provider: d(c),
                    factory: d(f),
                    service: d(function(a, b) { return f(a, ["$injector", function(a) { return a.instantiate(b) }]) }),
                    value: d(function(a, b) { return f(a, ia(b), !1) }),
                    constant: d(function(a, b) {
                        Ja(a, "constant");
                        p[a] = b;
                        s[a] = b
                    }),
                    decorator: function(a, b) {
                        var c = n.get(a + "Provider"),
                            d = c.$get;
                        c.$get = function() { var a = t.invoke(d, c); return t.invoke(b, null, { $delegate: a }) }
                    }
                }
            },
            n = p.$injector = k(p, function(a, b) { ca.isString(b) && l.push(b); throw Ca("unpr", l.join(" <- ")); }),
            s = {},
            G = k(s, function(a, b) { var c = n.get(a + "Provider", b); return t.invoke(c.$get, c, void 0, a) }),
            t = G;
        p.$injectorProvider = { $get: ia(G) };
        t.modules = n.modules = T();
        var N = g(a),
            t = G.get("$injector");
        t.strictDi = b;
        r(N, function(a) { a && t.invoke(a) });
        t.loadNewModules = function(a) { r(g(a), function(a) { a && t.invoke(a) }) };
        return t
    }

    function Bf() {
        var a = !0;
        this.disableAutoScrolling = function() { a = !1 };
        this.$get = ["$window", "$location", "$rootScope", function(b, d, c) {
            function e(a) {
                var b = null;
                Array.prototype.some.call(a, function(a) {
                    if ("a" ===
                        ua(a)) return b = a, !0
                });
                return b
            }

            function f(a) {
                if (a) {
                    a.scrollIntoView();
                    var c;
                    c = g.yOffset;
                    B(c) ? c = c() : ac(c) ? (c = c[0], c = "fixed" !== b.getComputedStyle(c).position ? 0 : c.getBoundingClientRect().bottom) : X(c) || (c = 0);
                    c && (a = a.getBoundingClientRect().top, b.scrollBy(0, a - c))
                } else b.scrollTo(0, 0)
            }

            function g(a) {
                a = C(a) ? a : X(a) ? a.toString() : d.hash();
                var b;
                a ? (b = k.getElementById(a)) ? f(b) : (b = e(k.getElementsByName(a))) ? f(b) : "top" === a && f(null) : f(null)
            }
            var k = b.document;
            a && c.$watch(function() { return d.hash() }, function(a, b) {
                a ===
                    b && "" === a || vg(function() { c.$evalAsync(g) })
            });
            return g
        }]
    }

    function ib(a, b) {
        if (!a && !b) return "";
        if (!a) return b;
        if (!b) return a;
        H(a) && (a = a.join(" "));
        H(b) && (b = b.join(" "));
        return a + " " + b
    }

    function Eg(a) {
        C(a) && (a = a.split(" "));
        var b = T();
        r(a, function(a) { a.length && (b[a] = !0) });
        return b
    }

    function ra(a) { return D(a) ? a : {} }

    function Fg(a, b, d, c, e) {
        function f() {
            pa = null;
            k()
        }

        function g() {
            t = y();
            t = A(t) ? null : t;
            va(t, P) && (t = P);
            N = P = t
        }

        function k() {
            var a = N;
            g();
            if (v !== h.url() || a !== t) v = h.url(), N = t, r(J, function(a) { a(h.url(), t) })
        }
        var h = this,
            l = a.location,
            m = a.history,
            p = a.setTimeout,
            n = a.clearTimeout,
            s = {},
            G = e(d);
        h.isMock = !1;
        h.$$completeOutstandingRequest = G.completeTask;
        h.$$incOutstandingRequestCount = G.incTaskCount;
        h.notifyWhenNoOutstandingRequests = G.notifyWhenNoPendingTasks;
        var t, N, v = l.href,
            kc = b.find("base"),
            pa = null,
            y = c.history ? function() { try { return m.state } catch (a) {} } : E;
        g();
        h.url = function(b, d, e) {
            A(e) && (e = null);
            l !== a.location && (l = a.location);
            m !== a.history && (m = a.history);
            if (b) {
                var f = N === e;
                b = ga(b).href;
                if (v === b && (!c.history || f)) return h;
                var k = v && Da(v) === Da(b);
                v = b;
                N = e;
                !c.history || k && f ? (k || (pa = b), d ? l.replace(b) : k ? (d = l, e = b, f = e.indexOf("#"), e = -1 === f ? "" : e.substr(f), d.hash = e) : l.href = b, l.href !== b && (pa = b)) : (m[d ? "replaceState" : "pushState"](e, "", b), g());
                pa && (pa = b);
                return h
            }
            return (pa || l.href).replace(/#$/, "")
        };
        h.state = function() { return t };
        var J = [],
            I = !1,
            P = null;
        h.onUrlChange = function(b) {
            if (!I) {
                if (c.history) x(a).on("popstate", f);
                x(a).on("hashchange", f);
                I = !0
            }
            J.push(b);
            return b
        };
        h.$$applicationDestroyed = function() {
            x(a).off("hashchange popstate",
                f)
        };
        h.$$checkUrlChange = k;
        h.baseHref = function() { var a = kc.attr("href"); return a ? a.replace(/^(https?:)?\/\/[^/]*/, "") : "" };
        h.defer = function(a, b, c) {
            var d;
            b = b || 0;
            c = c || G.DEFAULT_TASK_TYPE;
            G.incTaskCount(c);
            d = p(function() {
                delete s[d];
                G.completeTask(a, c)
            }, b);
            s[d] = c;
            return d
        };
        h.defer.cancel = function(a) {
            if (s.hasOwnProperty(a)) {
                var b = s[a];
                delete s[a];
                n(a);
                G.completeTask(E, b);
                return !0
            }
            return !1
        }
    }

    function If() {
        this.$get = ["$window", "$log", "$sniffer", "$document", "$$taskTrackerFactory", function(a, b, d, c, e) {
            return new Fg(a,
                c, b, d, e)
        }]
    }

    function Jf() {
        this.$get = function() {
            function a(a, c) {
                function e(a) { a !== p && (n ? n === a && (n = a.n) : n = a, f(a.n, a.p), f(a, p), p = a, p.n = null) }

                function f(a, b) { a !== b && (a && (a.p = b), b && (b.n = a)) }
                if (a in b) throw F("$cacheFactory")("iid", a);
                var g = 0,
                    k = S({}, c, { id: a }),
                    h = T(),
                    l = c && c.capacity || Number.MAX_VALUE,
                    m = T(),
                    p = null,
                    n = null;
                return b[a] = {
                    put: function(a, b) {
                        if (!A(b)) {
                            if (l < Number.MAX_VALUE) {
                                var c = m[a] || (m[a] = { key: a });
                                e(c)
                            }
                            a in h || g++;
                            h[a] = b;
                            g > l && this.remove(n.key);
                            return b
                        }
                    },
                    get: function(a) {
                        if (l < Number.MAX_VALUE) {
                            var b =
                                m[a];
                            if (!b) return;
                            e(b)
                        }
                        return h[a]
                    },
                    remove: function(a) {
                        if (l < Number.MAX_VALUE) {
                            var b = m[a];
                            if (!b) return;
                            b === p && (p = b.p);
                            b === n && (n = b.n);
                            f(b.n, b.p);
                            delete m[a]
                        }
                        a in h && (delete h[a], g--)
                    },
                    removeAll: function() {
                        h = T();
                        g = 0;
                        m = T();
                        p = n = null
                    },
                    destroy: function() {
                        m = k = h = null;
                        delete b[a]
                    },
                    info: function() { return S({}, k, { size: g }) }
                }
            }
            var b = {};
            a.info = function() {
                var a = {};
                r(b, function(b, e) { a[e] = b.info() });
                return a
            };
            a.get = function(a) { return b[a] };
            return a
        }
    }

    function hg() { this.$get = ["$cacheFactory", function(a) { return a("templates") }] }

    function Zc(a, b) {
        function d(a, b, c) {
            var d = /^([@&]|[=<](\*?))(\??)\s*([\w$]*)$/,
                e = T();
            r(a, function(a, f) {
                a = a.trim();
                if (a in p) e[f] = p[a];
                else {
                    var g = a.match(d);
                    if (!g) throw $("iscp", b, f, a, c ? "controller bindings definition" : "isolate scope definition");
                    e[f] = { mode: g[1][0], collection: "*" === g[2], optional: "?" === g[3], attrName: g[4] || f };
                    g[4] && (p[a] = e[f])
                }
            });
            return e
        }

        function c(a) { var b = a.charAt(0); if (!b || b !== K(b)) throw $("baddir", a); if (a !== a.trim()) throw $("baddir", a); }

        function e(a) {
            var b = a.require || a.controller &&
                a.name;
            !H(b) && D(b) && r(b, function(a, c) {
                var d = a.match(l);
                a.substring(d[0].length) || (b[c] = d[0] + c)
            });
            return b
        }
        var f = {},
            g = /^\s*directive:\s*([\w-]+)\s+(.*)$/,
            k = /(([\w-]+)(?::([^;]+))?;?)/,
            h = Ae("ngSrc,ngSrcset,src,srcset"),
            l = /^(?:(\^\^?)?(\?)?(\^\^?)?)?/,
            m = /^(on[a-z]+|formaction)$/,
            p = T();
        this.directive = function pa(b, d) {
            gb(b, "name");
            Ja(b, "directive");
            C(b) ? (c(b), gb(d, "directiveFactory"), f.hasOwnProperty(b) || (f[b] = [], a.factory(b + "Directive", ["$injector", "$exceptionHandler", function(a, c) {
                var d = [];
                r(f[b], function(f,
                    g) {
                    try {
                        var h = a.invoke(f);
                        B(h) ? h = { compile: ia(h) } : !h.compile && h.link && (h.compile = ia(h.link));
                        h.priority = h.priority || 0;
                        h.index = g;
                        h.name = h.name || b;
                        h.require = e(h);
                        var k = h,
                            l = h.restrict;
                        if (l && (!C(l) || !/[EACM]/.test(l))) throw $("badrestrict", l, b);
                        k.restrict = l || "EA";
                        h.$$moduleName = f.$$moduleName;
                        d.push(h)
                    } catch (m) { c(m) }
                });
                return d
            }])), f[b].push(d)) : r(b, Zb(pa));
            return this
        };
        this.component = function y(a, b) {
            function c(a) {
                function e(b) {
                    return B(b) || H(b) ? function(c, d) { return a.invoke(b, this, { $element: c, $attrs: d }) } :
                        b
                }
                var f = b.template || b.templateUrl ? b.template : "",
                    g = { controller: d, controllerAs: Gg(b.controller) || b.controllerAs || "$ctrl", template: e(f), templateUrl: e(b.templateUrl), transclude: b.transclude, scope: {}, bindToController: b.bindings || {}, restrict: "E", require: b.require };
                r(b, function(a, b) { "$" === b.charAt(0) && (g[b] = a) });
                return g
            }
            if (!C(a)) return r(a, Zb(Va(this, y))), this;
            var d = b.controller || function() {};
            r(b, function(a, b) { "$" === b.charAt(0) && (c[b] = a, B(d) && (d[b] = a)) });
            c.$inject = ["$injector"];
            return this.directive(a,
                c)
        };
        this.aHrefSanitizationTrustedUrlList = function(a) { return w(a) ? (b.aHrefSanitizationTrustedUrlList(a), this) : b.aHrefSanitizationTrustedUrlList() };
        Object.defineProperty(this, "aHrefSanitizationWhitelist", { get: function() { return this.aHrefSanitizationTrustedUrlList }, set: function(a) { this.aHrefSanitizationTrustedUrlList = a } });
        this.imgSrcSanitizationTrustedUrlList = function(a) { return w(a) ? (b.imgSrcSanitizationTrustedUrlList(a), this) : b.imgSrcSanitizationTrustedUrlList() };
        Object.defineProperty(this, "imgSrcSanitizationWhitelist", { get: function() { return this.imgSrcSanitizationTrustedUrlList }, set: function(a) { this.imgSrcSanitizationTrustedUrlList = a } });
        var n = !0;
        this.debugInfoEnabled = function(a) { return w(a) ? (n = a, this) : n };
        var s = !1;
        this.strictComponentBindingsEnabled = function(a) { return w(a) ? (s = a, this) : s };
        var G = 10;
        this.onChangesTtl = function(a) { return arguments.length ? (G = a, this) : G };
        var t = !0;
        this.commentDirectivesEnabled = function(a) { return arguments.length ? (t = a, this) : t };
        var N = !0;
        this.cssClassDirectivesEnabled = function(a) {
            return arguments.length ?
                (N = a, this) : N
        };
        var v = T();
        this.addPropertySecurityContext = function(a, b, c) {
            var d = a.toLowerCase() + "|" + b.toLowerCase();
            if (d in v && v[d] !== c) throw $("ctxoverride", a, b, v[d], c);
            v[d] = c;
            return this
        };
        (function() {
            function a(b, c) { r(c, function(a) { v[a.toLowerCase()] = b }) }
            a(W.HTML, ["iframe|srcdoc", "*|innerHTML", "*|outerHTML"]);
            a(W.CSS, ["*|style"]);
            a(W.URL, "area|href area|ping a|href a|ping blockquote|cite body|background del|cite input|src ins|cite q|cite".split(" "));
            a(W.MEDIA_URL, "audio|src img|src img|srcset source|src source|srcset track|src video|src video|poster".split(" "));
            a(W.RESOURCE_URL, "*|formAction applet|code applet|codebase base|href embed|src frame|src form|action head|profile html|manifest iframe|src link|href media|src object|codebase object|data script|src".split(" "))
        })();
        this.$get = ["$injector", "$interpolate", "$exceptionHandler", "$templateRequest", "$parse", "$controller", "$rootScope", "$sce", "$animate", function(a, b, c, e, p, M, L, u, R) {
            function q() {
                try {
                    if (!--Ja) throw Ua = void 0, $("infchng", G);
                    L.$apply(function() {
                        for (var a = 0, b = Ua.length; a < b; ++a) try { Ua[a]() } catch (d) { c(d) }
                        Ua =
                            void 0
                    })
                } finally { Ja++ }
            }

            function ma(a, b) {
                if (!a) return a;
                if (!C(a)) throw $("srcset", b, a.toString());
                for (var c = "", d = V(a), e = /(\s+\d+x\s*,|\s+\d+w\s*,|\s+,|,\s+)/, e = /\s/.test(d) ? e : /(,)/, d = d.split(e), e = Math.floor(d.length / 2), f = 0; f < e; f++) var g = 2 * f,
                    c = c + u.getTrustedMediaUrl(V(d[g])),
                    c = c + (" " + V(d[g + 1]));
                d = V(d[2 * f]).split(/\s/);
                c += u.getTrustedMediaUrl(V(d[0]));
                2 === d.length && (c += " " + V(d[1]));
                return c
            }

            function w(a, b) {
                if (b) {
                    var c = Object.keys(b),
                        d, e, f;
                    d = 0;
                    for (e = c.length; d < e; d++) f = c[d], this[f] = b[f]
                } else this.$attr = {};
                this.$$element = a
            }

            function O(a, b, c) {
                Fa.innerHTML = "<span " + b + ">";
                b = Fa.firstChild.attributes;
                var d = b[0];
                b.removeNamedItem(d.name);
                d.value = c;
                a.attributes.setNamedItem(d)
            }

            function sa(a, b) { try { a.addClass(b) } catch (c) {} }

            function da(a, b, c, d, e) {
                a instanceof x || (a = x(a));
                var f = Xa(a, b, a, c, d, e);
                da.$$addScopeClass(a);
                var g = null;
                return function(b, c, d) {
                    if (!a) throw $("multilink");
                    gb(b, "scope");
                    e && e.needsNewScope && (b = b.$parent.$new());
                    d = d || {};
                    var h = d.parentBoundTranscludeFn,
                        k = d.transcludeControllers;
                    d = d.futureParentElement;
                    h && h.$$boundTransclude && (h = h.$$boundTransclude);
                    g || (g = (d = d && d[0]) ? "foreignobject" !== ua(d) && la.call(d).match(/SVG/) ? "svg" : "html" : "html");
                    d = "html" !== g ? x(ja(g, x("<div></div>").append(a).html())) : c ? Wa.clone.call(a) : a;
                    if (k)
                        for (var l in k) d.data("$" + l + "Controller", k[l].instance);
                    da.$$addScopeInfo(d, b);
                    c && c(d, b);
                    f && f(b, d, d, h);
                    c || (a = f = null);
                    return d
                }
            }

            function Xa(a, b, c, d, e, f) {
                function g(a, c, d, e) {
                    var f, k, l, m, p, I, t;
                    if (n)
                        for (t = Array(c.length), m = 0; m < h.length; m += 3) f = h[m], t[f] = c[f];
                    else t = c;
                    m = 0;
                    for (p = h.length; m <
                        p;) k = t[h[m++]], c = h[m++], f = h[m++], c ? (c.scope ? (l = a.$new(), da.$$addScopeInfo(x(k), l)) : l = a, I = c.transcludeOnThisElement ? ka(a, c.transclude, e) : !c.templateOnThisElement && e ? e : !e && b ? ka(a, b) : null, c(f, l, k, d, I)) : f && f(a, k.childNodes, void 0, e)
                }
                for (var h = [], k = H(a) || a instanceof x, l, m, p, I, n, t = 0; t < a.length; t++) {
                    l = new w;
                    11 === wa && jb(a, t, k);
                    m = tc(a[t], [], l, 0 === t ? d : void 0, e);
                    (f = m.length ? aa(m, a[t], l, b, c, null, [], [], f) : null) && f.scope && da.$$addScopeClass(l.$$element);
                    l = f && f.terminal || !(p = a[t].childNodes) || !p.length ? null : Xa(p,
                        f ? (f.transcludeOnThisElement || !f.templateOnThisElement) && f.transclude : b);
                    if (f || l) h.push(t, f, l), I = !0, n = n || f;
                    f = null
                }
                return I ? g : null
            }

            function jb(a, b, c) {
                var d = a[b],
                    e = d.parentNode,
                    f;
                if (d.nodeType === Pa)
                    for (;;) {
                        f = e ? d.nextSibling : a[b + 1];
                        if (!f || f.nodeType !== Pa) break;
                        d.nodeValue += f.nodeValue;
                        f.parentNode && f.parentNode.removeChild(f);
                        c && f === a[b + 1] && a.splice(b + 1, 1)
                    }
            }

            function ka(a, b, c) {
                function d(e, f, g, h, k) {
                    e || (e = a.$new(!1, k), e.$$transcluded = !0);
                    return b(e, f, {
                        parentBoundTranscludeFn: c,
                        transcludeControllers: g,
                        futureParentElement: h
                    })
                }
                var e = d.$$slots = T(),
                    f;
                for (f in b.$$slots) e[f] = b.$$slots[f] ? ka(a, b.$$slots[f], c) : null;
                return d
            }

            function tc(a, b, d, e, f) {
                var g = d.$attr,
                    h;
                switch (a.nodeType) {
                    case 1:
                        h = ua(a);
                        Y(b, xa(h), "E", e, f);
                        for (var l, m, n, t, J, s = a.attributes, v = 0, G = s && s.length; v < G; v++) {
                            var P = !1,
                                N = !1,
                                r = !1,
                                y = !1,
                                u = !1,
                                M;
                            l = s[v];
                            m = l.name;
                            t = l.value;
                            n = xa(m.toLowerCase());
                            (J = n.match(Ra)) ? (r = "Attr" === J[1], y = "Prop" === J[1], u = "On" === J[1], m = m.replace(rd, "").toLowerCase().substr(4 + J[1].length).replace(/_(.)/g, function(a, b) { return b.toUpperCase() })) :
                            (M = n.match(Sa)) && ca(M[1]) && (P = m, N = m.substr(0, m.length - 5) + "end", m = m.substr(0, m.length - 6));
                            if (y || u) d[n] = t, g[n] = l.name, y ? Ea(a, b, n, m) : b.push(sd(p, L, c, n, m, !1));
                            else {
                                n = xa(m.toLowerCase());
                                g[n] = m;
                                if (r || !d.hasOwnProperty(n)) d[n] = t, nd(a, n) && (d[n] = !0);
                                Ia(a, b, t, n, r);
                                Y(b, n, "A", e, f, P, N)
                            }
                        }
                        "input" === h && "hidden" === a.getAttribute("type") && a.setAttribute("autocomplete", "off");
                        if (!Qa) break;
                        g = a.className;
                        D(g) && (g = g.animVal);
                        if (C(g) && "" !== g)
                            for (; a = k.exec(g);) n = xa(a[2]), Y(b, n, "C", e, f) && (d[n] = V(a[3])), g = g.substr(a.index +
                                a[0].length);
                        break;
                    case Pa:
                        na(b, a.nodeValue);
                        break;
                    case 8:
                        if (!Oa) break;
                        F(a, b, d, e, f)
                }
                b.sort(ia);
                return b
            }

            function F(a, b, c, d, e) {
                try {
                    var f = g.exec(a.nodeValue);
                    if (f) {
                        var h = xa(f[1]);
                        Y(b, h, "M", d, e) && (c[h] = V(f[2]))
                    }
                } catch (k) {}
            }

            function U(a, b, c) {
                var d = [],
                    e = 0;
                if (b && a.hasAttribute && a.hasAttribute(b)) {
                    do {
                        if (!a) throw $("uterdir", b, c);
                        1 === a.nodeType && (a.hasAttribute(b) && e++, a.hasAttribute(c) && e--);
                        d.push(a);
                        a = a.nextSibling
                    } while (0 < e)
                } else d.push(a);
                return x(d)
            }

            function W(a, b, c) {
                return function(d, e, f, g, h) {
                    e = U(e[0],
                        b, c);
                    return a(d, e, f, g, h)
                }
            }

            function Z(a, b, c, d, e, f) { var g; return a ? da(b, c, d, e, f) : function() { g || (g = da(b, c, d, e, f), b = c = f = null); return g.apply(this, arguments) } }

            function aa(a, b, d, e, f, g, h, k, l) {
                function m(a, b, c, d) {
                    if (a) {
                        c && (a = W(a, c, d));
                        a.require = u.require;
                        a.directiveName = Q;
                        if (s === u || u.$$isolateScope) a = Ba(a, { isolateScope: !0 });
                        h.push(a)
                    }
                    if (b) {
                        c && (b = W(b, c, d));
                        b.require = u.require;
                        b.directiveName = Q;
                        if (s === u || u.$$isolateScope) b = Ba(b, { isolateScope: !0 });
                        k.push(b)
                    }
                }

                function p(a, e, f, g, l) {
                    function m(a, b, c, d) {
                        var e;
                        bb(a) ||
                            (d = c, c = b, b = a, a = void 0);
                        N && (e = P);
                        c || (c = N ? Q.parent() : Q);
                        if (d) { var f = l.$$slots[d]; if (f) return f(a, b, e, c, R); if (A(f)) throw $("noslot", d, Aa(Q)); } else return l(a, b, e, c, R)
                    }
                    var n, u, L, y, G, P, M, Q;
                    b === f ? (g = d, Q = d.$$element) : (Q = x(f), g = new w(Q, d));
                    G = e;
                    s ? y = e.$new(!0) : t && (G = e.$parent);
                    l && (M = m, M.$$boundTransclude = l, M.isSlotFilled = function(a) { return !!l.$$slots[a] });
                    J && (P = ea(Q, g, M, J, y, e, s));
                    s && (da.$$addScopeInfo(Q, y, !0, !(v && (v === s || v === s.$$originalDirective))), da.$$addScopeClass(Q, !0), y.$$isolateBindings = s.$$isolateBindings,
                        u = Da(e, g, y, y.$$isolateBindings, s), u.removeWatches && y.$on("$destroy", u.removeWatches));
                    for (n in P) {
                        u = J[n];
                        L = P[n];
                        var Hg = u.$$bindings.bindToController;
                        L.instance = L();
                        Q.data("$" + u.name + "Controller", L.instance);
                        L.bindingInfo = Da(G, g, L.instance, Hg, u)
                    }
                    r(J, function(a, b) {
                        var c = a.require;
                        a.bindToController && !H(c) && D(c) && S(P[b].instance, X(b, c, Q, P))
                    });
                    r(P, function(a) {
                        var b = a.instance;
                        if (B(b.$onChanges)) try { b.$onChanges(a.bindingInfo.initialChanges) } catch (d) { c(d) }
                        if (B(b.$onInit)) try { b.$onInit() } catch (e) { c(e) }
                        B(b.$doCheck) &&
                            (G.$watch(function() { b.$doCheck() }), b.$doCheck());
                        B(b.$onDestroy) && G.$on("$destroy", function() { b.$onDestroy() })
                    });
                    n = 0;
                    for (u = h.length; n < u; n++) L = h[n], Ca(L, L.isolateScope ? y : e, Q, g, L.require && X(L.directiveName, L.require, Q, P), M);
                    var R = e;
                    s && (s.template || null === s.templateUrl) && (R = y);
                    a && a(R, f.childNodes, void 0, l);
                    for (n = k.length - 1; 0 <= n; n--) L = k[n], Ca(L, L.isolateScope ? y : e, Q, g, L.require && X(L.directiveName, L.require, Q, P), M);
                    r(P, function(a) {
                        a = a.instance;
                        B(a.$postLink) && a.$postLink()
                    })
                }
                l = l || {};
                for (var n = -Number.MAX_VALUE,
                        t = l.newScopeDirective, J = l.controllerDirectives, s = l.newIsolateScopeDirective, v = l.templateDirective, L = l.nonTlbTranscludeDirective, G = !1, P = !1, N = l.hasElementTranscludeDirective, y = d.$$element = x(b), u, Q, M, R = e, q, ma = !1, Jb = !1, O, sa = 0, C = a.length; sa < C; sa++) {
                    u = a[sa];
                    var E = u.$$start,
                        jb = u.$$end;
                    E && (y = U(b, E, jb));
                    M = void 0;
                    if (n > u.priority) break;
                    if (O = u.scope) u.templateUrl || (D(O) ? (ba("new/isolated scope", s || t, u, y), s = u) : ba("new/isolated scope", s, u, y)), t = t || u;
                    Q = u.name;
                    if (!ma && (u.replace && (u.templateUrl || u.template) || u.transclude &&
                            !u.$$tlb)) {
                        for (O = sa + 1; ma = a[O++];)
                            if (ma.transclude && !ma.$$tlb || ma.replace && (ma.templateUrl || ma.template)) { Jb = !0; break }
                        ma = !0
                    }!u.templateUrl && u.controller && (J = J || T(), ba("'" + Q + "' controller", J[Q], u, y), J[Q] = u);
                    if (O = u.transclude)
                        if (G = !0, u.$$tlb || (ba("transclusion", L, u, y), L = u), "element" === O) N = !0, n = u.priority, M = y, y = d.$$element = x(da.$$createComment(Q, d[Q])), b = y[0], oa(f, Ha.call(M, 0), b), R = Z(Jb, M, e, n, g && g.name, { nonTlbTranscludeDirective: L });
                        else {
                            var ka = T();
                            if (D(O)) {
                                M = z.document.createDocumentFragment();
                                var Xa =
                                    T(),
                                    F = T();
                                r(O, function(a, b) {
                                    var c = "?" === a.charAt(0);
                                    a = c ? a.substring(1) : a;
                                    Xa[a] = b;
                                    ka[b] = null;
                                    F[b] = c
                                });
                                r(y.contents(), function(a) {
                                    var b = Xa[xa(ua(a))];
                                    b ? (F[b] = !0, ka[b] = ka[b] || z.document.createDocumentFragment(), ka[b].appendChild(a)) : M.appendChild(a)
                                });
                                r(F, function(a, b) { if (!a) throw $("reqslot", b); });
                                for (var K in ka) ka[K] && (R = x(ka[K].childNodes), ka[K] = Z(Jb, R, e));
                                M = x(M.childNodes)
                            } else M = x(qc(b)).contents();
                            y.empty();
                            R = Z(Jb, M, e, void 0, void 0, { needsNewScope: u.$$isolateScope || u.$$newScope });
                            R.$$slots = ka
                        }
                    if (u.template)
                        if (P = !0, ba("template", v, u, y), v = u, O = B(u.template) ? u.template(y, d) : u.template, O = Na(O), u.replace) {
                            g = u;
                            M = nc.test(O) ? td(ja(u.templateNamespace, V(O))) : [];
                            b = M[0];
                            if (1 !== M.length || 1 !== b.nodeType) throw $("tplrt", Q, "");
                            oa(f, y, b);
                            C = { $attr: {} };
                            O = tc(b, [], C);
                            var Ig = a.splice(sa + 1, a.length - (sa + 1));
                            (s || t) && fa(O, s, t);
                            a = a.concat(O).concat(Ig);
                            ga(d, C);
                            C = a.length
                        } else y.html(O);
                    if (u.templateUrl) P = !0, ba("template", v, u, y), v = u, u.replace && (g = u), p = ha(a.splice(sa, a.length - sa), y, d, f, G && R, h, k, {
                        controllerDirectives: J,
                        newScopeDirective: t !==
                            u && t,
                        newIsolateScopeDirective: s,
                        templateDirective: v,
                        nonTlbTranscludeDirective: L
                    }), C = a.length;
                    else if (u.compile) try {
                        q = u.compile(y, d, R);
                        var Y = u.$$originalDirective || u;
                        B(q) ? m(null, Va(Y, q), E, jb) : q && m(Va(Y, q.pre), Va(Y, q.post), E, jb)
                    } catch (ca) { c(ca, Aa(y)) }
                    u.terminal && (p.terminal = !0, n = Math.max(n, u.priority))
                }
                p.scope = t && !0 === t.scope;
                p.transcludeOnThisElement = G;
                p.templateOnThisElement = P;
                p.transclude = R;
                l.hasElementTranscludeDirective = N;
                return p
            }

            function X(a, b, c, d) {
                var e;
                if (C(b)) {
                    var f = b.match(l);
                    b = b.substring(f[0].length);
                    var g = f[1] || f[3],
                        f = "?" === f[2];
                    "^^" === g ? c = c.parent() : e = (e = d && d[b]) && e.instance;
                    if (!e) {
                        var h = "$" + b + "Controller";
                        e = "^^" === g && c[0] && 9 === c[0].nodeType ? null : g ? c.inheritedData(h) : c.data(h)
                    }
                    if (!e && !f) throw $("ctreq", b, a);
                } else if (H(b))
                    for (e = [], g = 0, f = b.length; g < f; g++) e[g] = X(a, b[g], c, d);
                else D(b) && (e = {}, r(b, function(b, f) { e[f] = X(a, b, c, d) }));
                return e || null
            }

            function ea(a, b, c, d, e, f, g) {
                var h = T(),
                    k;
                for (k in d) {
                    var l = d[k],
                        m = { $scope: l === g || l.$$isolateScope ? e : f, $element: a, $attrs: b, $transclude: c },
                        p = l.controller;
                    "@" ===
                    p && (p = b[l.name]);
                    m = M(p, m, !0, l.controllerAs);
                    h[l.name] = m;
                    a.data("$" + l.name + "Controller", m.instance)
                }
                return h
            }

            function fa(a, b, c) { for (var d = 0, e = a.length; d < e; d++) a[d] = bc(a[d], { $$isolateScope: b, $$newScope: c }) }

            function Y(b, c, e, g, h, k, l) {
                if (c === h) return null;
                var m = null;
                if (f.hasOwnProperty(c)) {
                    h = a.get(c + "Directive");
                    for (var p = 0, n = h.length; p < n; p++)
                        if (c = h[p], (A(g) || g > c.priority) && -1 !== c.restrict.indexOf(e)) {
                            k && (c = bc(c, { $$start: k, $$end: l }));
                            if (!c.$$bindings) {
                                var I = m = c,
                                    t = c.name,
                                    u = { isolateScope: null, bindToController: null };
                                D(I.scope) && (!0 === I.bindToController ? (u.bindToController = d(I.scope, t, !0), u.isolateScope = {}) : u.isolateScope = d(I.scope, t, !1));
                                D(I.bindToController) && (u.bindToController = d(I.bindToController, t, !0));
                                if (u.bindToController && !I.controller) throw $("noctrl", t);
                                m = m.$$bindings = u;
                                D(m.isolateScope) && (c.$$isolateBindings = m.isolateScope)
                            }
                            b.push(c);
                            m = c
                        }
                }
                return m
            }

            function ca(b) {
                if (f.hasOwnProperty(b))
                    for (var c = a.get(b + "Directive"), d = 0, e = c.length; d < e; d++)
                        if (b = c[d], b.multiElement) return !0;
                return !1
            }

            function ga(a, b) {
                var c =
                    b.$attr,
                    d = a.$attr;
                r(a, function(d, e) { "$" !== e.charAt(0) && (b[e] && b[e] !== d && (d = d.length ? d + (("style" === e ? ";" : " ") + b[e]) : b[e]), a.$set(e, d, !0, c[e])) });
                r(b, function(b, e) { a.hasOwnProperty(e) || "$" === e.charAt(0) || (a[e] = b, "class" !== e && "style" !== e && (d[e] = c[e])) })
            }

            function ha(a, b, d, f, g, h, k, l) {
                var m = [],
                    p, n, t = b[0],
                    u = a.shift(),
                    J = bc(u, { templateUrl: null, transclude: null, replace: null, $$originalDirective: u }),
                    s = B(u.templateUrl) ? u.templateUrl(b, d) : u.templateUrl,
                    L = u.templateNamespace;
                b.empty();
                e(s).then(function(c) {
                    var e,
                        I;
                    c = Na(c);
                    if (u.replace) {
                        c = nc.test(c) ? td(ja(L, V(c))) : [];
                        e = c[0];
                        if (1 !== c.length || 1 !== e.nodeType) throw $("tplrt", u.name, s);
                        c = { $attr: {} };
                        oa(f, b, e);
                        var v = tc(e, [], c);
                        D(u.scope) && fa(v, !0);
                        a = v.concat(a);
                        ga(d, c)
                    } else e = t, b.html(c);
                    a.unshift(J);
                    p = aa(a, e, d, g, b, u, h, k, l);
                    r(f, function(a, c) { a === e && (f[c] = b[0]) });
                    for (n = Xa(b[0].childNodes, g); m.length;) {
                        c = m.shift();
                        I = m.shift();
                        var y = m.shift(),
                            P = m.shift(),
                            v = b[0];
                        if (!c.$$destroyed) {
                            if (I !== t) {
                                var G = I.className;
                                l.hasElementTranscludeDirective && u.replace || (v = qc(e));
                                oa(y,
                                    x(I), v);
                                sa(x(v), G)
                            }
                            I = p.transcludeOnThisElement ? ka(c, p.transclude, P) : P;
                            p(n, c, v, f, I)
                        }
                    }
                    m = null
                }).catch(function(a) { dc(a) && c(a) });
                return function(a, b, c, d, e) {
                    a = e;
                    b.$$destroyed || (m ? m.push(b, c, d, a) : (p.transcludeOnThisElement && (a = ka(b, p.transclude, e)), p(n, b, c, d, a)))
                }
            }

            function ia(a, b) { var c = b.priority - a.priority; return 0 !== c ? c : a.name !== b.name ? a.name < b.name ? -1 : 1 : a.index - b.index }

            function ba(a, b, c, d) {
                function e(a) { return a ? " (module: " + a + ")" : "" }
                if (b) throw $("multidir", b.name, e(b.$$moduleName), c.name, e(c.$$moduleName),
                    a, Aa(d));
            }

            function na(a, c) {
                var d = b(c, !0);
                d && a.push({
                    priority: 0,
                    compile: function(a) {
                        a = a.parent();
                        var b = !!a.length;
                        b && da.$$addBindingClass(a);
                        return function(a, c) {
                            var e = c.parent();
                            b || da.$$addBindingClass(e);
                            da.$$addBindingInfo(e, d.expressions);
                            a.$watch(d, function(a) { c[0].nodeValue = a })
                        }
                    }
                })
            }

            function ja(a, b) {
                a = K(a || "html");
                switch (a) {
                    case "svg":
                    case "math":
                        var c = z.document.createElement("div");
                        c.innerHTML = "<" + a + ">" + b + "</" + a + ">";
                        return c.childNodes[0].childNodes;
                    default:
                        return b
                }
            }

            function qa(a, b) {
                if ("srcdoc" ===
                    b) return u.HTML;
                if ("src" === b || "ngSrc" === b) return -1 === ["img", "video", "audio", "source", "track"].indexOf(a) ? u.RESOURCE_URL : u.MEDIA_URL;
                if ("xlinkHref" === b) return "image" === a ? u.MEDIA_URL : "a" === a ? u.URL : u.RESOURCE_URL;
                if ("form" === a && "action" === b || "base" === a && "href" === b || "link" === a && "href" === b) return u.RESOURCE_URL;
                if ("a" === a && ("href" === b || "ngHref" === b)) return u.URL
            }

            function ya(a, b) { var c = b.toLowerCase(); return v[a + "|" + c] || v["*|" + c] }

            function za(a) { return ma(u.valueOf(a), "ng-prop-srcset") }

            function Ea(a, b, c,
                d) {
                if (m.test(d)) throw $("nodomevents");
                a = ua(a);
                var e = ya(a, d),
                    f = Ta;
                "srcset" !== d || "img" !== a && "source" !== a ? e && (f = u.getTrusted.bind(u, e)) : f = za;
                b.push({
                    priority: 100,
                    compile: function(a, b) {
                        var e = p(b[c]),
                            g = p(b[c], function(a) { return u.valueOf(a) });
                        return {
                            pre: function(a, b) {
                                function c() {
                                    var g = e(a);
                                    b[0][d] = f(g)
                                }
                                c();
                                a.$watch(g, c)
                            }
                        }
                    }
                })
            }

            function Ia(a, c, d, e, f) {
                var g = ua(a),
                    k = qa(g, e),
                    l = h[e] || f,
                    p = b(d, !f, k, l);
                if (p) {
                    if ("multiple" === e && "select" === g) throw $("selmulti", Aa(a));
                    if (m.test(e)) throw $("nodomevents");
                    c.push({
                        priority: 100,
                        compile: function() {
                            return {
                                pre: function(a, c, f) {
                                    c = f.$$observers || (f.$$observers = T());
                                    var g = f[e];
                                    g !== d && (p = g && b(g, !0, k, l), d = g);
                                    p && (f[e] = p(a), (c[e] || (c[e] = [])).$$inter = !0, (f.$$observers && f.$$observers[e].$$scope || a).$watch(p, function(a, b) { "class" === e && a !== b ? f.$updateClass(a, b) : f.$set(e, a) }))
                                }
                            }
                        }
                    })
                }
            }

            function oa(a, b, c) {
                var d = b[0],
                    e = b.length,
                    f = d.parentNode,
                    g, h;
                if (a)
                    for (g = 0, h = a.length; g < h; g++)
                        if (a[g] === d) {
                            a[g++] = c;
                            h = g + e - 1;
                            for (var k = a.length; g < k; g++, h++) h < k ? a[g] = a[h] : delete a[g];
                            a.length -= e - 1;
                            a.context === d &&
                                (a.context = c);
                            break
                        }
                f && f.replaceChild(c, d);
                a = z.document.createDocumentFragment();
                for (g = 0; g < e; g++) a.appendChild(b[g]);
                x.hasData(d) && (x.data(c, x.data(d)), x(d).off("$destroy"));
                x.cleanData(a.querySelectorAll("*"));
                for (g = 1; g < e; g++) delete b[g];
                b[0] = c;
                b.length = 1
            }

            function Ba(a, b) { return S(function() { return a.apply(null, arguments) }, a, b) }

            function Ca(a, b, d, e, f, g) { try { a(b, d, e, f, g) } catch (h) { c(h, Aa(d)) } }

            function ra(a, b) { if (s) throw $("missingattr", a, b); }

            function Da(a, c, d, e, f) {
                function g(b, c, e) {
                    B(d.$onChanges) &&
                        !ec(c, e) && (Ua || (a.$$postDigest(q), Ua = []), m || (m = {}, Ua.push(h)), m[b] && (e = m[b].previousValue), m[b] = new Kb(e, c))
                }

                function h() {
                    d.$onChanges(m);
                    m = void 0
                }
                var k = [],
                    l = {},
                    m;
                r(e, function(e, h) {
                    var m = e.attrName,
                        n = e.optional,
                        I, t, u, s;
                    switch (e.mode) {
                        case "@":
                            n || ta.call(c, m) || (ra(m, f.name), d[h] = c[m] = void 0);
                            n = c.$observe(m, function(a) { if (C(a) || Ga(a)) g(h, a, d[h]), d[h] = a });
                            c.$$observers[m].$$scope = a;
                            I = c[m];
                            C(I) ? d[h] = b(I)(a) : Ga(I) && (d[h] = I);
                            l[h] = new Kb(uc, d[h]);
                            k.push(n);
                            break;
                        case "=":
                            if (!ta.call(c, m)) {
                                if (n) break;
                                ra(m,
                                    f.name);
                                c[m] = void 0
                            }
                            if (n && !c[m]) break;
                            t = p(c[m]);
                            s = t.literal ? va : ec;
                            u = t.assign || function() { I = d[h] = t(a); throw $("nonassign", c[m], m, f.name); };
                            I = d[h] = t(a);
                            n = function(b) { s(b, d[h]) || (s(b, I) ? u(a, b = d[h]) : d[h] = b); return I = b };
                            n.$stateful = !0;
                            n = e.collection ? a.$watchCollection(c[m], n) : a.$watch(p(c[m], n), null, t.literal);
                            k.push(n);
                            break;
                        case "<":
                            if (!ta.call(c, m)) {
                                if (n) break;
                                ra(m, f.name);
                                c[m] = void 0
                            }
                            if (n && !c[m]) break;
                            t = p(c[m]);
                            var v = t.literal,
                                L = d[h] = t(a);
                            l[h] = new Kb(uc, d[h]);
                            n = a[e.collection ? "$watchCollection" : "$watch"](t,
                                function(a, b) {
                                    if (b === a) {
                                        if (b === L || v && va(b, L)) return;
                                        b = L
                                    }
                                    g(h, a, b);
                                    d[h] = a
                                });
                            k.push(n);
                            break;
                        case "&":
                            n || ta.call(c, m) || ra(m, f.name);
                            t = c.hasOwnProperty(m) ? p(c[m]) : E;
                            if (t === E && n) break;
                            d[h] = function(b) { return t(a, b) }
                    }
                });
                return { initialChanges: l, removeWatches: k.length && function() { for (var a = 0, b = k.length; a < b; ++a) k[a]() } }
            }
            var Ma = /^\w/,
                Fa = z.document.createElement("div"),
                Oa = t,
                Qa = N,
                Ja = G,
                Ua;
            w.prototype = {
                $normalize: xa,
                $addClass: function(a) { a && 0 < a.length && R.addClass(this.$$element, a) },
                $removeClass: function(a) {
                    a &&
                        0 < a.length && R.removeClass(this.$$element, a)
                },
                $updateClass: function(a, b) {
                    var c = ud(a, b);
                    c && c.length && R.addClass(this.$$element, c);
                    (c = ud(b, a)) && c.length && R.removeClass(this.$$element, c)
                },
                $set: function(a, b, d, e) {
                    var f = nd(this.$$element[0], a),
                        g = vd[a],
                        h = a;
                    f ? (this.$$element.prop(a, b), e = f) : g && (this[g] = b, h = g);
                    this[a] = b;
                    e ? this.$attr[a] = e : (e = this.$attr[a]) || (this.$attr[a] = e = Xc(a, "-"));
                    "img" === ua(this.$$element) && "srcset" === a && (this[a] = b = ma(b, "$set('srcset', value)"));
                    !1 !== d && (null === b || A(b) ? this.$$element.removeAttr(e) :
                        Ma.test(e) ? f && !1 === b ? this.$$element.removeAttr(e) : this.$$element.attr(e, b) : O(this.$$element[0], e, b));
                    (a = this.$$observers) && r(a[h], function(a) { try { a(b) } catch (d) { c(d) } })
                },
                $observe: function(a, b) {
                    var c = this,
                        d = c.$$observers || (c.$$observers = T()),
                        e = d[a] || (d[a] = []);
                    e.push(b);
                    L.$evalAsync(function() { e.$$inter || !c.hasOwnProperty(a) || A(c[a]) || b(c[a]) });
                    return function() { cb(e, b) }
                }
            };
            var Ka = b.startSymbol(),
                La = b.endSymbol(),
                Na = "{{" === Ka && "}}" === La ? Ta : function(a) { return a.replace(/\{\{/g, Ka).replace(/}}/g, La) },
                Ra =
                /^ng(Attr|Prop|On)([A-Z].*)$/,
                Sa = /^(.+)Start$/;
            da.$$addBindingInfo = n ? function(a, b) {
                var c = a.data("$binding") || [];
                H(b) ? c = c.concat(b) : c.push(b);
                a.data("$binding", c)
            } : E;
            da.$$addBindingClass = n ? function(a) { sa(a, "ng-binding") } : E;
            da.$$addScopeInfo = n ? function(a, b, c, d) { a.data(c ? d ? "$isolateScopeNoTemplate" : "$isolateScope" : "$scope", b) } : E;
            da.$$addScopeClass = n ? function(a, b) { sa(a, b ? "ng-isolate-scope" : "ng-scope") } : E;
            da.$$createComment = function(a, b) {
                var c = "";
                n && (c = " " + (a || "") + ": ", b && (c += b + " "));
                return z.document.createComment(c)
            };
            return da
        }]
    }

    function Kb(a, b) {
        this.previousValue = a;
        this.currentValue = b
    }

    function xa(a) { return a.replace(rd, "").replace(Jg, function(a, d, c) { return c ? d.toUpperCase() : d }) }

    function ud(a, b) {
        var d = "",
            c = a.split(/\s+/),
            e = b.split(/\s+/),
            f = 0;
        a: for (; f < c.length; f++) {
            for (var g = c[f], k = 0; k < e.length; k++)
                if (g === e[k]) continue a;
            d += (0 < d.length ? " " : "") + g
        }
        return d
    }

    function td(a) {
        a = x(a);
        var b = a.length;
        if (1 >= b) return a;
        for (; b--;) {
            var d = a[b];
            (8 === d.nodeType || d.nodeType === Pa && "" === d.nodeValue.trim()) && Kg.call(a, b, 1)
        }
        return a
    }

    function Gg(a, b) { if (b && C(b)) return b; if (C(a)) { var d = wd.exec(a); if (d) return d[3] } }

    function Kf() {
        var a = {};
        this.has = function(b) { return a.hasOwnProperty(b) };
        this.register = function(b, d) {
            Ja(b, "controller");
            D(b) ? S(a, b) : a[b] = d
        };
        this.$get = ["$injector", function(b) {
            function d(a, b, d, g) {
                if (!a || !D(a.$scope)) throw F("$controller")("noscp", g, b);
                a.$scope[b] = d
            }
            return function(c, e, f, g) {
                var k, h, l;
                f = !0 === f;
                g && C(g) && (l = g);
                if (C(c)) {
                    g = c.match(wd);
                    if (!g) throw xd("ctrlfmt", c);
                    h = g[1];
                    l = l || g[3];
                    c = a.hasOwnProperty(h) ? a[h] : Le(e.$scope,
                        h, !0);
                    if (!c) throw xd("ctrlreg", h);
                    tb(c, h, !0)
                }
                if (f) return f = (H(c) ? c[c.length - 1] : c).prototype, k = Object.create(f || null), l && d(e, l, k, h || c.name), S(function() {
                    var a = b.invoke(c, k, e, h);
                    a !== k && (D(a) || B(a)) && (k = a, l && d(e, l, k, h || c.name));
                    return k
                }, { instance: k, identifier: l });
                k = b.instantiate(c, e, h);
                l && d(e, l, k, h || c.name);
                return k
            }
        }]
    }

    function Lf() { this.$get = ["$window", function(a) { return x(a.document) }] }

    function Mf() {
        this.$get = ["$document", "$rootScope", function(a, b) {
            function d() { e = c.hidden }
            var c = a[0],
                e = c && c.hidden;
            a.on("visibilitychange", d);
            b.$on("$destroy", function() { a.off("visibilitychange", d) });
            return function() { return e }
        }]
    }

    function Nf() { this.$get = ["$log", function(a) { return function(b, d) { a.error.apply(a, arguments) } }] }

    function vc(a) { return D(a) ? ha(a) ? a.toISOString() : eb(a) : a }

    function Tf() {
        this.$get = function() {
            return function(a) {
                if (!a) return "";
                var b = [];
                Qc(a, function(a, c) { null === a || A(a) || B(a) || (H(a) ? r(a, function(a) { b.push(ba(c) + "=" + ba(vc(a))) }) : b.push(ba(c) + "=" + ba(vc(a)))) });
                return b.join("&")
            }
        }
    }

    function Uf() {
        this.$get =
            function() {
                return function(a) {
                    function b(a, e, f) { H(a) ? r(a, function(a, c) { b(a, e + "[" + (D(a) ? c : "") + "]") }) : D(a) && !ha(a) ? Qc(a, function(a, c) { b(a, e + (f ? "" : "[") + c + (f ? "" : "]")) }) : (B(a) && (a = a()), d.push(ba(e) + "=" + (null == a ? "" : ba(vc(a))))) }
                    if (!a) return "";
                    var d = [];
                    b(a, "", !0);
                    return d.join("&")
                }
            }
    }

    function wc(a, b) {
        if (C(a)) {
            var d = a.replace(Lg, "").trim();
            if (d) {
                var c = b("Content-Type"),
                    c = c && 0 === c.indexOf(yd),
                    e;
                (e = c) || (e = (e = d.match(Mg)) && Ng[e[0]].test(d));
                if (e) try { a = Tc(d) } catch (f) { if (!c) return a; throw Lb("baddata", a, f); }
            }
        }
        return a
    }

    function zd(a) {
        var b = T(),
            d;
        C(a) ? r(a.split("\n"), function(a) {
            d = a.indexOf(":");
            var e = K(V(a.substr(0, d)));
            a = V(a.substr(d + 1));
            e && (b[e] = b[e] ? b[e] + ", " + a : a)
        }) : D(a) && r(a, function(a, d) {
            var f = K(d),
                g = V(a);
            f && (b[f] = b[f] ? b[f] + ", " + g : g)
        });
        return b
    }

    function Ad(a) { var b; return function(d) { b || (b = zd(a)); return d ? (d = b[K(d)], void 0 === d && (d = null), d) : b } }

    function Bd(a, b, d, c) {
        if (B(c)) return c(a, b, d);
        r(c, function(c) { a = c(a, b, d) });
        return a
    }

    function Sf() {
        var a = this.defaults = {
                transformResponse: [wc],
                transformRequest: [function(a) {
                    return D(a) &&
                        "[object File]" !== la.call(a) && "[object Blob]" !== la.call(a) && "[object FormData]" !== la.call(a) ? eb(a) : a
                }],
                headers: { common: { Accept: "application/json, text/plain, */*" }, post: ja(xc), put: ja(xc), patch: ja(xc) },
                xsrfCookieName: "XSRF-TOKEN",
                xsrfHeaderName: "X-XSRF-TOKEN",
                paramSerializer: "$httpParamSerializer",
                jsonpCallbackParam: "callback"
            },
            b = !1;
        this.useApplyAsync = function(a) { return w(a) ? (b = !!a, this) : b };
        var d = this.interceptors = [],
            c = this.xsrfTrustedOrigins = [];
        Object.defineProperty(this, "xsrfWhitelistedOrigins", { get: function() { return this.xsrfTrustedOrigins }, set: function(a) { this.xsrfTrustedOrigins = a } });
        this.$get = ["$browser", "$httpBackend", "$$cookieReader", "$cacheFactory", "$rootScope", "$q", "$injector", "$sce", function(e, f, g, k, h, l, m, p) {
            function n(b) {
                function c(a, b) {
                    for (var d = 0, e = b.length; d < e;) {
                        var f = b[d++],
                            g = b[d++];
                        a = a.then(f, g)
                    }
                    b.length = 0;
                    return a
                }

                function d(a, b) {
                    var c, e = {};
                    r(a, function(a, d) { B(a) ? (c = a(b), null != c && (e[d] = c)) : e[d] = a });
                    return e
                }

                function f(a) {
                    var b = S({}, a);
                    b.data = Bd(a.data, a.headers, a.status, g.transformResponse);
                    a = a.status;
                    return 200 <= a && 300 > a ? b : l.reject(b)
                }
                if (!D(b)) throw F("$http")("badreq", b);
                if (!C(p.valueOf(b.url))) throw F("$http")("badreq", b.url);
                var g = S({ method: "get", transformRequest: a.transformRequest, transformResponse: a.transformResponse, paramSerializer: a.paramSerializer, jsonpCallbackParam: a.jsonpCallbackParam }, b);
                g.headers = function(b) {
                    var c = a.headers,
                        e = S({}, b.headers),
                        f, g, h, c = S({}, c.common, c[K(b.method)]);
                    a: for (f in c) {
                        g = K(f);
                        for (h in e)
                            if (K(h) === g) continue a;
                        e[f] = c[f]
                    }
                    return d(e, ja(b))
                }(b);
                g.method =
                    vb(g.method);
                g.paramSerializer = C(g.paramSerializer) ? m.get(g.paramSerializer) : g.paramSerializer;
                e.$$incOutstandingRequestCount("$http");
                var h = [],
                    k = [];
                b = l.resolve(g);
                r(v, function(a) {
                    (a.request || a.requestError) && h.unshift(a.request, a.requestError);
                    (a.response || a.responseError) && k.push(a.response, a.responseError)
                });
                b = c(b, h);
                b = b.then(function(b) {
                    var c = b.headers,
                        d = Bd(b.data, Ad(c), void 0, b.transformRequest);
                    A(d) && r(c, function(a, b) { "content-type" === K(b) && delete c[b] });
                    A(b.withCredentials) && !A(a.withCredentials) &&
                        (b.withCredentials = a.withCredentials);
                    return s(b, d).then(f, f)
                });
                b = c(b, k);
                return b = b.finally(function() { e.$$completeOutstandingRequest(E, "$http") })
            }

            function s(c, d) {
                function e(a) {
                    if (a) {
                        var c = {};
                        r(a, function(a, d) {
                            c[d] = function(c) {
                                function d() { a(c) }
                                b ? h.$applyAsync(d) : h.$$phase ? d() : h.$apply(d)
                            }
                        });
                        return c
                    }
                }

                function k(a, c, d, e, f) {
                    function g() { m(c, a, d, e, f) }
                    R && (200 <= a && 300 > a ? R.put(O, [a, c, zd(d), e, f]) : R.remove(O));
                    b ? h.$applyAsync(g) : (g(), h.$$phase || h.$apply())
                }

                function m(a, b, d, e, f) {
                    b = -1 <= b ? b : 0;
                    (200 <= b && 300 >
                        b ? L.resolve : L.reject)({ data: a, status: b, headers: Ad(d), config: c, statusText: e, xhrStatus: f })
                }

                function s(a) { m(a.data, a.status, ja(a.headers()), a.statusText, a.xhrStatus) }

                function v() { var a = n.pendingRequests.indexOf(c); - 1 !== a && n.pendingRequests.splice(a, 1) }
                var L = l.defer(),
                    u = L.promise,
                    R, q, ma = c.headers,
                    x = "jsonp" === K(c.method),
                    O = c.url;
                x ? O = p.getTrustedResourceUrl(O) : C(O) || (O = p.valueOf(O));
                O = G(O, c.paramSerializer(c.params));
                x && (O = t(O, c.jsonpCallbackParam));
                n.pendingRequests.push(c);
                u.then(v, v);
                !c.cache && !a.cache ||
                    !1 === c.cache || "GET" !== c.method && "JSONP" !== c.method || (R = D(c.cache) ? c.cache : D(a.cache) ? a.cache : N);
                R && (q = R.get(O), w(q) ? q && B(q.then) ? q.then(s, s) : H(q) ? m(q[1], q[0], ja(q[2]), q[3], q[4]) : m(q, 200, {}, "OK", "complete") : R.put(O, u));
                A(q) && ((q = kc(c.url) ? g()[c.xsrfCookieName || a.xsrfCookieName] : void 0) && (ma[c.xsrfHeaderName || a.xsrfHeaderName] = q), f(c.method, O, d, k, ma, c.timeout, c.withCredentials, c.responseType, e(c.eventHandlers), e(c.uploadEventHandlers)));
                return u
            }

            function G(a, b) {
                0 < b.length && (a += (-1 === a.indexOf("?") ?
                    "?" : "&") + b);
                return a
            }

            function t(a, b) {
                var c = a.split("?");
                if (2 < c.length) throw Lb("badjsonp", a);
                c = hc(c[1]);
                r(c, function(c, d) { if ("JSON_CALLBACK" === c) throw Lb("badjsonp", a); if (d === b) throw Lb("badjsonp", b, a); });
                return a += (-1 === a.indexOf("?") ? "?" : "&") + b + "=JSON_CALLBACK"
            }
            var N = k("$http");
            a.paramSerializer = C(a.paramSerializer) ? m.get(a.paramSerializer) : a.paramSerializer;
            var v = [];
            r(d, function(a) { v.unshift(C(a) ? m.get(a) : m.invoke(a)) });
            var kc = Og(c);
            n.pendingRequests = [];
            (function(a) {
                r(arguments, function(a) {
                    n[a] =
                        function(b, c) { return n(S({}, c || {}, { method: a, url: b })) }
                })
            })("get", "delete", "head", "jsonp");
            (function(a) { r(arguments, function(a) { n[a] = function(b, c, d) { return n(S({}, d || {}, { method: a, url: b, data: c })) } }) })("post", "put", "patch");
            n.defaults = a;
            return n
        }]
    }

    function Wf() { this.$get = function() { return function() { return new z.XMLHttpRequest } } }

    function Vf() { this.$get = ["$browser", "$jsonpCallbacks", "$document", "$xhrFactory", function(a, b, d, c) { return Pg(a, c, a.defer, b, d[0]) }] }

    function Pg(a, b, d, c, e) {
        function f(a, b, d) {
            a = a.replace("JSON_CALLBACK",
                b);
            var f = e.createElement("script"),
                m = null;
            f.type = "text/javascript";
            f.src = a;
            f.async = !0;
            m = function(a) {
                f.removeEventListener("load", m);
                f.removeEventListener("error", m);
                e.body.removeChild(f);
                f = null;
                var g = -1,
                    s = "unknown";
                a && ("load" !== a.type || c.wasCalled(b) || (a = { type: "error" }), s = a.type, g = "error" === a.type ? 404 : 200);
                d && d(g, s)
            };
            f.addEventListener("load", m);
            f.addEventListener("error", m);
            e.body.appendChild(f);
            return m
        }
        return function(e, k, h, l, m, p, n, s, G, t) {
            function N(a) {
                J = "timeout" === a;
                pa && pa();
                y && y.abort()
            }

            function v(a,
                b, c, e, f, g) {
                w(P) && d.cancel(P);
                pa = y = null;
                a(b, c, e, f, g)
            }
            k = k || a.url();
            if ("jsonp" === K(e)) var q = c.createCallback(k),
                pa = f(k, q, function(a, b) {
                    var d = 200 === a && c.getResponse(q);
                    v(l, a, d, "", b, "complete");
                    c.removeCallback(q)
                });
            else {
                var y = b(e, k),
                    J = !1;
                y.open(e, k, !0);
                r(m, function(a, b) { w(a) && y.setRequestHeader(b, a) });
                y.onload = function() {
                    var a = y.statusText || "",
                        b = "response" in y ? y.response : y.responseText,
                        c = 1223 === y.status ? 204 : y.status;
                    0 === c && (c = b ? 200 : "file" === ga(k).protocol ? 404 : 0);
                    v(l, c, b, y.getAllResponseHeaders(), a, "complete")
                };
                y.onerror = function() { v(l, -1, null, null, "", "error") };
                y.ontimeout = function() { v(l, -1, null, null, "", "timeout") };
                y.onabort = function() { v(l, -1, null, null, "", J ? "timeout" : "abort") };
                r(G, function(a, b) { y.addEventListener(b, a) });
                r(t, function(a, b) { y.upload.addEventListener(b, a) });
                n && (y.withCredentials = !0);
                if (s) try { y.responseType = s } catch (I) { if ("json" !== s) throw I; }
                y.send(A(h) ? null : h)
            }
            if (0 < p) var P = d(function() { N("timeout") }, p);
            else p && B(p.then) && p.then(function() { N(w(p.$$timeoutId) ? "timeout" : "abort") })
        }
    }

    function Pf() {
        var a =
            "{{",
            b = "}}";
        this.startSymbol = function(b) { return b ? (a = b, this) : a };
        this.endSymbol = function(a) { return a ? (b = a, this) : b };
        this.$get = ["$parse", "$exceptionHandler", "$sce", function(d, c, e) {
            function f(a) { return "\\\\\\" + a }

            function g(c) { return c.replace(p, a).replace(n, b) }

            function k(a, b, c, d) { var e = a.$watch(function(a) { e(); return d(a) }, b, c); return e }

            function h(f, h, n, p) {
                function v(a) { try { return a = n && !r ? e.getTrusted(n, a) : e.valueOf(a), p && !w(a) ? a : jc(a) } catch (b) { c(Ma.interr(f, b)) } }
                var r = n === e.URL || n === e.MEDIA_URL;
                if (!f.length ||
                    -1 === f.indexOf(a)) {
                    if (h) return;
                    h = g(f);
                    r && (h = e.getTrusted(n, h));
                    h = ia(h);
                    h.exp = f;
                    h.expressions = [];
                    h.$$watchDelegate = k;
                    return h
                }
                p = !!p;
                for (var q, y, J = 0, I = [], P, Q = f.length, M = [], L = [], u; J < Q;)
                    if (-1 !== (q = f.indexOf(a, J)) && -1 !== (y = f.indexOf(b, q + l))) J !== q && M.push(g(f.substring(J, q))), J = f.substring(q + l, y), I.push(J), J = y + m, L.push(M.length), M.push("");
                    else { J !== Q && M.push(g(f.substring(J))); break }
                u = 1 === M.length && 1 === L.length;
                var R = r && u ? void 0 : v;
                P = I.map(function(a) { return d(a, R) });
                if (!h || I.length) {
                    var x = function(a) {
                        for (var b =
                                0, c = I.length; b < c; b++) {
                            if (p && A(a[b])) return;
                            M[L[b]] = a[b]
                        }
                        if (r) return e.getTrusted(n, u ? M[0] : M.join(""));
                        n && 1 < M.length && Ma.throwNoconcat(f);
                        return M.join("")
                    };
                    return S(function(a) {
                        var b = 0,
                            d = I.length,
                            e = Array(d);
                        try { for (; b < d; b++) e[b] = P[b](a); return x(e) } catch (g) { c(Ma.interr(f, g)) }
                    }, {
                        exp: f,
                        expressions: I,
                        $$watchDelegate: function(a, b) {
                            var c;
                            return a.$watchGroup(P, function(d, e) {
                                var f = x(d);
                                b.call(this, f, d !== e ? c : f, a);
                                c = f
                            })
                        }
                    })
                }
            }
            var l = a.length,
                m = b.length,
                p = new RegExp(a.replace(/./g, f), "g"),
                n = new RegExp(b.replace(/./g,
                    f), "g");
            h.startSymbol = function() { return a };
            h.endSymbol = function() { return b };
            return h
        }]
    }

    function Qf() {
        this.$get = ["$$intervalFactory", "$window", function(a, b) {
            var d = {},
                c = function(a) {
                    b.clearInterval(a);
                    delete d[a]
                },
                e = a(function(a, c, e) {
                    a = b.setInterval(a, c);
                    d[a] = e;
                    return a
                }, c);
            e.cancel = function(a) {
                if (!a) return !1;
                if (!a.hasOwnProperty("$$intervalId")) throw Qg("badprom");
                if (!d.hasOwnProperty(a.$$intervalId)) return !1;
                a = a.$$intervalId;
                var b = d[a],
                    e = b.promise;
                e.$$state && (e.$$state.pur = !0);
                b.reject("canceled");
                c(a);
                return !0
            };
            return e
        }]
    }

    function Rf() {
        this.$get = ["$browser", "$q", "$$q", "$rootScope", function(a, b, d, c) {
            return function(e, f) {
                return function(g, k, h, l) {
                    function m() { p ? g.apply(null, n) : g(s) }
                    var p = 4 < arguments.length,
                        n = p ? Ha.call(arguments, 4) : [],
                        s = 0,
                        G = w(l) && !l,
                        t = (G ? d : b).defer(),
                        r = t.promise;
                    h = w(h) ? h : 0;
                    r.$$intervalId = e(function() {
                        G ? a.defer(m) : c.$evalAsync(m);
                        t.notify(s++);
                        0 < h && s >= h && (t.resolve(s), f(r.$$intervalId));
                        G || c.$apply()
                    }, k, t, G);
                    return r
                }
            }
        }]
    }

    function Cd(a, b) {
        var d = ga(a);
        b.$$protocol = d.protocol;
        b.$$host =
            d.hostname;
        b.$$port = fa(d.port) || Rg[d.protocol] || null
    }

    function Dd(a, b, d) {
        if (Sg.test(a)) throw kb("badpath", a);
        var c = "/" !== a.charAt(0);
        c && (a = "/" + a);
        a = ga(a);
        for (var c = (c && "/" === a.pathname.charAt(0) ? a.pathname.substring(1) : a.pathname).split("/"), e = c.length; e--;) c[e] = decodeURIComponent(c[e]), d && (c[e] = c[e].replace(/\//g, "%2F"));
        d = c.join("/");
        b.$$path = d;
        b.$$search = hc(a.search);
        b.$$hash = decodeURIComponent(a.hash);
        b.$$path && "/" !== b.$$path.charAt(0) && (b.$$path = "/" + b.$$path)
    }

    function yc(a, b) {
        return a.slice(0,
            b.length) === b
    }

    function ya(a, b) { if (yc(b, a)) return b.substr(a.length) }

    function Da(a) { var b = a.indexOf("#"); return -1 === b ? a : a.substr(0, b) }

    function zc(a, b, d) {
        this.$$html5 = !0;
        d = d || "";
        Cd(a, this);
        this.$$parse = function(a) {
            var d = ya(b, a);
            if (!C(d)) throw kb("ipthprfx", a, b);
            Dd(d, this, !0);
            this.$$path || (this.$$path = "/");
            this.$$compose()
        };
        this.$$normalizeUrl = function(a) { return b + a.substr(1) };
        this.$$parseLinkUrl = function(c, e) {
            if (e && "#" === e[0]) return this.hash(e.slice(1)), !0;
            var f, g;
            w(f = ya(a, c)) ? (g = f, g = d && w(f = ya(d, f)) ?
                b + (ya("/", f) || f) : a + g) : w(f = ya(b, c)) ? g = b + f : b === c + "/" && (g = b);
            g && this.$$parse(g);
            return !!g
        }
    }

    function Ac(a, b, d) {
        Cd(a, this);
        this.$$parse = function(c) {
            var e = ya(a, c) || ya(b, c),
                f;
            A(e) || "#" !== e.charAt(0) ? this.$$html5 ? f = e : (f = "", A(e) && (a = c, this.replace())) : (f = ya(d, e), A(f) && (f = e));
            Dd(f, this, !1);
            c = this.$$path;
            var e = a,
                g = /^\/[A-Z]:(\/.*)/;
            yc(f, e) && (f = f.replace(e, ""));
            g.exec(f) || (c = (f = g.exec(c)) ? f[1] : c);
            this.$$path = c;
            this.$$compose()
        };
        this.$$normalizeUrl = function(b) { return a + (b ? d + b : "") };
        this.$$parseLinkUrl = function(b,
            d) { return Da(a) === Da(b) ? (this.$$parse(b), !0) : !1 }
    }

    function Ed(a, b, d) {
        this.$$html5 = !0;
        Ac.apply(this, arguments);
        this.$$parseLinkUrl = function(c, e) {
            if (e && "#" === e[0]) return this.hash(e.slice(1)), !0;
            var f, g;
            a === Da(c) ? f = c : (g = ya(b, c)) ? f = a + d + g : b === c + "/" && (f = b);
            f && this.$$parse(f);
            return !!f
        };
        this.$$normalizeUrl = function(b) { return a + d + b }
    }

    function Mb(a) { return function() { return this[a] } }

    function Fd(a, b) {
        return function(d) {
            if (A(d)) return this[a];
            this[a] = b(d);
            this.$$compose();
            return this
        }
    }

    function Yf() {
        var a = "!",
            b = { enabled: !1, requireBase: !0, rewriteLinks: !0 };
        this.hashPrefix = function(b) { return w(b) ? (a = b, this) : a };
        this.html5Mode = function(a) {
            if (Ga(a)) return b.enabled = a, this;
            if (D(a)) {
                Ga(a.enabled) && (b.enabled = a.enabled);
                Ga(a.requireBase) && (b.requireBase = a.requireBase);
                if (Ga(a.rewriteLinks) || C(a.rewriteLinks)) b.rewriteLinks = a.rewriteLinks;
                return this
            }
            return b
        };
        this.$get = ["$rootScope", "$browser", "$sniffer", "$rootElement", "$window", function(d, c, e, f, g) {
            function k(a, b) { return a === b || ga(a).href === ga(b).href }

            function h(a,
                b, d) {
                var e = m.url(),
                    f = m.$$state;
                try { c.url(a, b, d), m.$$state = c.state() } catch (g) { throw m.url(e), m.$$state = f, g; }
            }

            function l(a, b) { d.$broadcast("$locationChangeSuccess", m.absUrl(), a, m.$$state, b) }
            var m, p;
            p = c.baseHref();
            var n = c.url(),
                s;
            if (b.enabled) {
                if (!p && b.requireBase) throw kb("nobase");
                s = n.substring(0, n.indexOf("/", n.indexOf("//") + 2)) + (p || "/");
                p = e.history ? zc : Ed
            } else s = Da(n), p = Ac;
            var r = s.substr(0, Da(s).lastIndexOf("/") + 1);
            m = new p(s, r, "#" + a);
            m.$$parseLinkUrl(n, n);
            m.$$state = c.state();
            var t = /^\s*(javascript|mailto):/i;
            f.on("click", function(a) {
                var e = b.rewriteLinks;
                if (e && !a.ctrlKey && !a.metaKey && !a.shiftKey && 2 !== a.which && 2 !== a.button) {
                    for (var g = x(a.target);
                        "a" !== ua(g[0]);)
                        if (g[0] === f[0] || !(g = g.parent())[0]) return;
                    if (!C(e) || !A(g.attr(e))) {
                        var e = g.prop("href"),
                            h = g.attr("href") || g.attr("xlink:href");
                        D(e) && "[object SVGAnimatedString]" === e.toString() && (e = ga(e.animVal).href);
                        t.test(e) || !e || g.attr("target") || a.isDefaultPrevented() || !m.$$parseLinkUrl(e, h) || (a.preventDefault(), m.absUrl() !== c.url() && d.$apply())
                    }
                }
            });
            m.absUrl() !==
                n && c.url(m.absUrl(), !0);
            var N = !0;
            c.onUrlChange(function(a, b) {
                yc(a, r) ? (d.$evalAsync(function() {
                    var c = m.absUrl(),
                        e = m.$$state,
                        f;
                    m.$$parse(a);
                    m.$$state = b;
                    f = d.$broadcast("$locationChangeStart", a, c, b, e).defaultPrevented;
                    m.absUrl() === a && (f ? (m.$$parse(c), m.$$state = e, h(c, !1, e)) : (N = !1, l(c, e)))
                }), d.$$phase || d.$digest()) : g.location.href = a
            });
            d.$watch(function() {
                if (N || m.$$urlUpdatedByLocation) {
                    m.$$urlUpdatedByLocation = !1;
                    var a = c.url(),
                        b = m.absUrl(),
                        f = c.state(),
                        g = m.$$replace,
                        n = !k(a, b) || m.$$html5 && e.history && f !==
                        m.$$state;
                    if (N || n) N = !1, d.$evalAsync(function() {
                        var b = m.absUrl(),
                            c = d.$broadcast("$locationChangeStart", b, a, m.$$state, f).defaultPrevented;
                        m.absUrl() === b && (c ? (m.$$parse(a), m.$$state = f) : (n && h(b, g, f === m.$$state ? null : m.$$state), l(a, f)))
                    })
                }
                m.$$replace = !1
            });
            return m
        }]
    }

    function Zf() {
        var a = !0,
            b = this;
        this.debugEnabled = function(b) { return w(b) ? (a = b, this) : a };
        this.$get = ["$window", function(d) {
            function c(a) {
                dc(a) && (a.stack && f ? a = a.message && -1 === a.stack.indexOf(a.message) ? "Error: " + a.message + "\n" + a.stack : a.stack : a.sourceURL &&
                    (a = a.message + "\n" + a.sourceURL + ":" + a.line));
                return a
            }

            function e(a) {
                var b = d.console || {},
                    e = b[a] || b.log || E;
                return function() {
                    var a = [];
                    r(arguments, function(b) { a.push(c(b)) });
                    return Function.prototype.apply.call(e, b, a)
                }
            }
            var f = wa || /\bEdge\//.test(d.navigator && d.navigator.userAgent);
            return { log: e("log"), info: e("info"), warn: e("warn"), error: e("error"), debug: function() { var c = e("debug"); return function() { a && c.apply(b, arguments) } }() }
        }]
    }

    function Tg(a) { return a + "" }

    function Ug(a, b) {
        return "undefined" !== typeof a ? a :
            b
    }

    function Gd(a, b) { return "undefined" === typeof a ? b : "undefined" === typeof b ? a : a + b }

    function Vg(a, b) {
        switch (a.type) {
            case q.MemberExpression:
                if (a.computed) return !1;
                break;
            case q.UnaryExpression:
                return 1;
            case q.BinaryExpression:
                return "+" !== a.operator ? 1 : !1;
            case q.CallExpression:
                return !1
        }
        return void 0 === b ? Hd : b
    }

    function Z(a, b, d) {
        var c, e, f = a.isPure = Vg(a, d);
        switch (a.type) {
            case q.Program:
                c = !0;
                r(a.body, function(a) {
                    Z(a.expression, b, f);
                    c = c && a.expression.constant
                });
                a.constant = c;
                break;
            case q.Literal:
                a.constant = !0;
                a.toWatch = [];
                break;
            case q.UnaryExpression:
                Z(a.argument, b, f);
                a.constant = a.argument.constant;
                a.toWatch = a.argument.toWatch;
                break;
            case q.BinaryExpression:
                Z(a.left, b, f);
                Z(a.right, b, f);
                a.constant = a.left.constant && a.right.constant;
                a.toWatch = a.left.toWatch.concat(a.right.toWatch);
                break;
            case q.LogicalExpression:
                Z(a.left, b, f);
                Z(a.right, b, f);
                a.constant = a.left.constant && a.right.constant;
                a.toWatch = a.constant ? [] : [a];
                break;
            case q.ConditionalExpression:
                Z(a.test, b, f);
                Z(a.alternate, b, f);
                Z(a.consequent, b, f);
                a.constant = a.test.constant &&
                    a.alternate.constant && a.consequent.constant;
                a.toWatch = a.constant ? [] : [a];
                break;
            case q.Identifier:
                a.constant = !1;
                a.toWatch = [a];
                break;
            case q.MemberExpression:
                Z(a.object, b, f);
                a.computed && Z(a.property, b, f);
                a.constant = a.object.constant && (!a.computed || a.property.constant);
                a.toWatch = a.constant ? [] : [a];
                break;
            case q.CallExpression:
                c = d = a.filter ? !b(a.callee.name).$stateful : !1;
                e = [];
                r(a.arguments, function(a) {
                    Z(a, b, f);
                    c = c && a.constant;
                    e.push.apply(e, a.toWatch)
                });
                a.constant = c;
                a.toWatch = d ? e : [a];
                break;
            case q.AssignmentExpression:
                Z(a.left,
                    b, f);
                Z(a.right, b, f);
                a.constant = a.left.constant && a.right.constant;
                a.toWatch = [a];
                break;
            case q.ArrayExpression:
                c = !0;
                e = [];
                r(a.elements, function(a) {
                    Z(a, b, f);
                    c = c && a.constant;
                    e.push.apply(e, a.toWatch)
                });
                a.constant = c;
                a.toWatch = e;
                break;
            case q.ObjectExpression:
                c = !0;
                e = [];
                r(a.properties, function(a) {
                    Z(a.value, b, f);
                    c = c && a.value.constant;
                    e.push.apply(e, a.value.toWatch);
                    a.computed && (Z(a.key, b, !1), c = c && a.key.constant, e.push.apply(e, a.key.toWatch))
                });
                a.constant = c;
                a.toWatch = e;
                break;
            case q.ThisExpression:
                a.constant = !1;
                a.toWatch = [];
                break;
            case q.LocalsExpression:
                a.constant = !1, a.toWatch = []
        }
    }

    function Id(a) { if (1 === a.length) { a = a[0].expression; var b = a.toWatch; return 1 !== b.length ? b : b[0] !== a ? b : void 0 } }

    function Jd(a) { return a.type === q.Identifier || a.type === q.MemberExpression }

    function Kd(a) { if (1 === a.body.length && Jd(a.body[0].expression)) return { type: q.AssignmentExpression, left: a.body[0].expression, right: { type: q.NGValueParameter }, operator: "=" } }

    function Ld(a) { this.$filter = a }

    function Md(a) { this.$filter = a }

    function Nb(a, b, d) {
        this.ast =
            new q(a, d);
        this.astCompiler = d.csp ? new Md(b) : new Ld(b)
    }

    function Bc(a) { return B(a.valueOf) ? a.valueOf() : Wg.call(a) }

    function $f() {
        var a = T(),
            b = { "true": !0, "false": !1, "null": null, undefined: void 0 },
            d, c;
        this.addLiteral = function(a, c) { b[a] = c };
        this.setIdentifierFns = function(a, b) {
            d = a;
            c = b;
            return this
        };
        this.$get = ["$filter", function(e) {
            function f(b, c) {
                var d, f;
                switch (typeof b) {
                    case "string":
                        return f = b = b.trim(), d = a[f], d || (d = new Ob(G), d = (new Nb(d, e, G)).parse(b), a[f] = p(d)), s(d, c);
                    case "function":
                        return s(b, c);
                    default:
                        return s(E,
                            c)
                }
            }

            function g(a, b, c) { return null == a || null == b ? a === b : "object" !== typeof a || (a = Bc(a), "object" !== typeof a || c) ? a === b || a !== a && b !== b : !1 }

            function k(a, b, c, d, e) {
                var f = d.inputs,
                    h;
                if (1 === f.length) {
                    var k = g,
                        f = f[0];
                    return a.$watch(function(a) {
                        var b = f(a);
                        g(b, k, f.isPure) || (h = d(a, void 0, void 0, [b]), k = b && Bc(b));
                        return h
                    }, b, c, e)
                }
                for (var l = [], m = [], n = 0, p = f.length; n < p; n++) l[n] = g, m[n] = null;
                return a.$watch(function(a) {
                    for (var b = !1, c = 0, e = f.length; c < e; c++) { var k = f[c](a); if (b || (b = !g(k, l[c], f[c].isPure))) m[c] = k, l[c] = k && Bc(k) }
                    b &&
                        (h = d(a, void 0, void 0, m));
                    return h
                }, b, c, e)
            }

            function h(a, b, c, d, e) {
                function f() { h(m) && k() }

                function g(a, b, c, d) {
                    m = u && d ? d[0] : n(a, b, c, d);
                    h(m) && a.$$postDigest(f);
                    return s(m)
                }
                var h = d.literal ? l : w,
                    k, m, n = d.$$intercepted || d,
                    s = d.$$interceptor || Ta,
                    u = d.inputs && !n.inputs;
                g.literal = d.literal;
                g.constant = d.constant;
                g.inputs = d.inputs;
                p(g);
                return k = a.$watch(g, b, c, e)
            }

            function l(a) {
                var b = !0;
                r(a, function(a) { w(a) || (b = !1) });
                return b
            }

            function m(a, b, c, d) { var e = a.$watch(function(a) { e(); return d(a) }, b, c); return e }

            function p(a) {
                a.constant ?
                    a.$$watchDelegate = m : a.oneTime ? a.$$watchDelegate = h : a.inputs && (a.$$watchDelegate = k);
                return a
            }

            function n(a, b) {
                function c(d) { return b(a(d)) }
                c.$stateful = a.$stateful || b.$stateful;
                c.$$pure = a.$$pure && b.$$pure;
                return c
            }

            function s(a, b) {
                if (!b) return a;
                a.$$interceptor && (b = n(a.$$interceptor, b), a = a.$$intercepted);
                var c = !1,
                    d = function(d, e, f, g) { d = c && g ? g[0] : a(d, e, f, g); return b(d) };
                d.$$intercepted = a;
                d.$$interceptor = b;
                d.literal = a.literal;
                d.oneTime = a.oneTime;
                d.constant = a.constant;
                b.$stateful || (c = !a.inputs, d.inputs = a.inputs ?
                    a.inputs : [a], b.$$pure || (d.inputs = d.inputs.map(function(a) { return a.isPure === Hd ? function(b) { return a(b) } : a })));
                return p(d)
            }
            var G = { csp: Ba().noUnsafeEval, literals: Ia(b), isIdentifierStart: B(d) && d, isIdentifierContinue: B(c) && c };
            f.$$getAst = function(a) { var b = new Ob(G); return (new Nb(b, e, G)).getAst(a).ast };
            return f
        }]
    }

    function bg() {
        var a = !0;
        this.$get = ["$rootScope", "$exceptionHandler", function(b, d) { return Nd(function(a) { b.$evalAsync(a) }, d, a) }];
        this.errorOnUnhandledRejections = function(b) {
            return w(b) ? (a = b, this) :
                a
        }
    }

    function cg() {
        var a = !0;
        this.$get = ["$browser", "$exceptionHandler", function(b, d) { return Nd(function(a) { b.defer(a) }, d, a) }];
        this.errorOnUnhandledRejections = function(b) { return w(b) ? (a = b, this) : a }
    }

    function Nd(a, b, d) {
        function c() { return new e }

        function e() {
            var a = this.promise = new f;
            this.resolve = function(b) { h(a, b) };
            this.reject = function(b) { m(a, b) };
            this.notify = function(b) { n(a, b) }
        }

        function f() { this.$$state = { status: 0 } }

        function g() {
            for (; !w && x.length;) {
                var a = x.shift();
                if (!a.pur) {
                    a.pur = !0;
                    var c = a.value,
                        c = "Possibly unhandled rejection: " +
                        ("function" === typeof c ? c.toString().replace(/ \{[\s\S]*$/, "") : A(c) ? "undefined" : "string" !== typeof c ? Ne(c, void 0) : c);
                    dc(a.value) ? b(a.value, c) : b(c)
                }
            }
        }

        function k(c) {
            !d || c.pending || 2 !== c.status || c.pur || (0 === w && 0 === x.length && a(g), x.push(c));
            !c.processScheduled && c.pending && (c.processScheduled = !0, ++w, a(function() {
                var e, f, k;
                k = c.pending;
                c.processScheduled = !1;
                c.pending = void 0;
                try {
                    for (var l = 0, n = k.length; l < n; ++l) {
                        c.pur = !0;
                        f = k[l][0];
                        e = k[l][c.status];
                        try { B(e) ? h(f, e(c.value)) : 1 === c.status ? h(f, c.value) : m(f, c.value) } catch (p) {
                            m(f,
                                p), p && !0 === p.$$passToExceptionHandler && b(p)
                        }
                    }
                } finally {--w, d && 0 === w && a(g) }
            }))
        }

        function h(a, b) { a.$$state.status || (b === a ? p(a, v("qcycle", b)) : l(a, b)) }

        function l(a, b) {
            function c(b) { g || (g = !0, l(a, b)) }

            function d(b) { g || (g = !0, p(a, b)) }

            function e(b) { n(a, b) }
            var f, g = !1;
            try {
                if (D(b) || B(b)) f = b.then;
                B(f) ? (a.$$state.status = -1, f.call(b, c, d, e)) : (a.$$state.value = b, a.$$state.status = 1, k(a.$$state))
            } catch (h) { d(h) }
        }

        function m(a, b) { a.$$state.status || p(a, b) }

        function p(a, b) {
            a.$$state.value = b;
            a.$$state.status = 2;
            k(a.$$state)
        }

        function n(c,
            d) {
            var e = c.$$state.pending;
            0 >= c.$$state.status && e && e.length && a(function() {
                for (var a, c, f = 0, g = e.length; f < g; f++) {
                    c = e[f][0];
                    a = e[f][3];
                    try { n(c, B(a) ? a(d) : d) } catch (h) { b(h) }
                }
            })
        }

        function s(a) {
            var b = new f;
            m(b, a);
            return b
        }

        function G(a, b, c) { var d = null; try { B(c) && (d = c()) } catch (e) { return s(e) } return d && B(d.then) ? d.then(function() { return b(a) }, s) : b(a) }

        function t(a, b, c, d) {
            var e = new f;
            h(e, a);
            return e.then(b, c, d)
        }

        function q(a) {
            if (!B(a)) throw v("norslvr", a);
            var b = new f;
            a(function(a) { h(b, a) }, function(a) { m(b, a) });
            return b
        }
        var v = F("$q", TypeError),
            w = 0,
            x = [];
        S(f.prototype, {
            then: function(a, b, c) {
                if (A(a) && A(b) && A(c)) return this;
                var d = new f;
                this.$$state.pending = this.$$state.pending || [];
                this.$$state.pending.push([d, a, b, c]);
                0 < this.$$state.status && k(this.$$state);
                return d
            },
            "catch": function(a) { return this.then(null, a) },
            "finally": function(a, b) { return this.then(function(b) { return G(b, y, a) }, function(b) { return G(b, s, a) }, b) }
        });
        var y = t;
        q.prototype = f.prototype;
        q.defer = c;
        q.reject = s;
        q.when = t;
        q.resolve = y;
        q.all = function(a) {
            var b = new f,
                c =
                0,
                d = H(a) ? [] : {};
            r(a, function(a, e) {
                c++;
                t(a).then(function(a) { d[e] = a;--c || h(b, d) }, function(a) { m(b, a) })
            });
            0 === c && h(b, d);
            return b
        };
        q.race = function(a) {
            var b = c();
            r(a, function(a) { t(a).then(b.resolve, b.reject) });
            return b.promise
        };
        return q
    }

    function mg() {
        this.$get = ["$window", "$timeout", function(a, b) {
            var d = a.requestAnimationFrame || a.webkitRequestAnimationFrame,
                c = a.cancelAnimationFrame || a.webkitCancelAnimationFrame || a.webkitCancelRequestAnimationFrame,
                e = !!d,
                f = e ? function(a) { var b = d(a); return function() { c(b) } } :
                function(a) { var c = b(a, 16.66, !1); return function() { b.cancel(c) } };
            f.supported = e;
            return f
        }]
    }

    function ag() {
        function a(a) {
            function b() {
                this.$$watchers = this.$$nextSibling = this.$$childHead = this.$$childTail = null;
                this.$$listeners = {};
                this.$$listenerCount = {};
                this.$$watchersCount = 0;
                this.$id = ++qb;
                this.$$ChildScope = null;
                this.$$suspended = !1
            }
            b.prototype = a;
            return b
        }
        var b = 10,
            d = F("$rootScope"),
            c = null,
            e = null;
        this.digestTtl = function(a) { arguments.length && (b = a); return b };
        this.$get = ["$exceptionHandler", "$parse", "$browser",
            function(f, g, k) {
                function h(a) { a.currentScope.$$destroyed = !0 }

                function l(a) {
                    9 === wa && (a.$$childHead && l(a.$$childHead), a.$$nextSibling && l(a.$$nextSibling));
                    a.$parent = a.$$nextSibling = a.$$prevSibling = a.$$childHead = a.$$childTail = a.$root = a.$$watchers = null
                }

                function m() {
                    this.$id = ++qb;
                    this.$$phase = this.$parent = this.$$watchers = this.$$nextSibling = this.$$prevSibling = this.$$childHead = this.$$childTail = null;
                    this.$root = this;
                    this.$$suspended = this.$$destroyed = !1;
                    this.$$listeners = {};
                    this.$$listenerCount = {};
                    this.$$watchersCount =
                        0;
                    this.$$isolateBindings = null
                }

                function p(a) {
                    if (v.$$phase) throw d("inprog", v.$$phase);
                    v.$$phase = a
                }

                function n(a, b) { do a.$$watchersCount += b; while (a = a.$parent) }

                function s(a, b, c) { do a.$$listenerCount[c] -= b, 0 === a.$$listenerCount[c] && delete a.$$listenerCount[c]; while (a = a.$parent) }

                function G() {}

                function t() {
                    for (; y.length;) try { y.shift()() } catch (a) { f(a) }
                    e = null
                }

                function q() { null === e && (e = k.defer(function() { v.$apply(t) }, null, "$applyAsync")) }
                m.prototype = {
                    constructor: m,
                    $new: function(b, c) {
                        var d;
                        c = c || this;
                        b ? (d = new m,
                            d.$root = this.$root) : (this.$$ChildScope || (this.$$ChildScope = a(this)), d = new this.$$ChildScope);
                        d.$parent = c;
                        d.$$prevSibling = c.$$childTail;
                        c.$$childHead ? (c.$$childTail.$$nextSibling = d, c.$$childTail = d) : c.$$childHead = c.$$childTail = d;
                        (b || c !== this) && d.$on("$destroy", h);
                        return d
                    },
                    $watch: function(a, b, d, e) {
                        var f = g(a);
                        b = B(b) ? b : E;
                        if (f.$$watchDelegate) return f.$$watchDelegate(this, b, d, f, a);
                        var h = this,
                            k = h.$$watchers,
                            l = { fn: b, last: G, get: f, exp: e || a, eq: !!d };
                        c = null;
                        k || (k = h.$$watchers = [], k.$$digestWatchIndex = -1);
                        k.unshift(l);
                        k.$$digestWatchIndex++;
                        n(this, 1);
                        return function() {
                            var a = cb(k, l);
                            0 <= a && (n(h, -1), a < k.$$digestWatchIndex && k.$$digestWatchIndex--);
                            c = null
                        }
                    },
                    $watchGroup: function(a, b) {
                        function c() { h = !1; try { k ? (k = !1, b(e, e, g)) : b(e, d, g) } finally { for (var f = 0; f < a.length; f++) d[f] = e[f] } }
                        var d = Array(a.length),
                            e = Array(a.length),
                            f = [],
                            g = this,
                            h = !1,
                            k = !0;
                        if (!a.length) {
                            var l = !0;
                            g.$evalAsync(function() { l && b(e, e, g) });
                            return function() { l = !1 }
                        }
                        if (1 === a.length) return this.$watch(a[0], function(a, c, f) {
                            e[0] = a;
                            d[0] = c;
                            b(e, a === c ? e : d, f)
                        });
                        r(a, function(a,
                            b) {
                            var d = g.$watch(a, function(a) {
                                e[b] = a;
                                h || (h = !0, g.$evalAsync(c))
                            });
                            f.push(d)
                        });
                        return function() { for (; f.length;) f.shift()() }
                    },
                    $watchCollection: function(a, b) {
                        function c(a) {
                            e = a;
                            var b, d, g, h;
                            if (!A(e)) {
                                if (D(e))
                                    if (za(e))
                                        for (f !== n && (f = n, t = f.length = 0, l++), a = e.length, t !== a && (l++, f.length = t = a), b = 0; b < a; b++) h = f[b], g = e[b], d = h !== h && g !== g, d || h === g || (l++, f[b] = g);
                                    else {
                                        f !== p && (f = p = {}, t = 0, l++);
                                        a = 0;
                                        for (b in e) ta.call(e, b) && (a++, g = e[b], h = f[b], b in f ? (d = h !== h && g !== g, d || h === g || (l++, f[b] = g)) : (t++, f[b] = g, l++));
                                        if (t > a)
                                            for (b in l++,
                                                f) ta.call(e, b) || (t--, delete f[b])
                                    }
                                else f !== e && (f = e, l++);
                                return l
                            }
                        }
                        c.$$pure = g(a).literal;
                        c.$stateful = !c.$$pure;
                        var d = this,
                            e, f, h, k = 1 < b.length,
                            l = 0,
                            m = g(a, c),
                            n = [],
                            p = {},
                            s = !0,
                            t = 0;
                        return this.$watch(m, function() {
                            s ? (s = !1, b(e, e, d)) : b(e, h, d);
                            if (k)
                                if (D(e))
                                    if (za(e)) { h = Array(e.length); for (var a = 0; a < e.length; a++) h[a] = e[a] } else
                                        for (a in h = {}, e) ta.call(e, a) && (h[a] = e[a]);
                            else h = e
                        })
                    },
                    $digest: function() {
                        var a, g, h, l, m, n, s, r = b,
                            q, y = w.length ? v : this,
                            N = [],
                            A, z;
                        p("$digest");
                        k.$$checkUrlChange();
                        this === v && null !== e && (k.defer.cancel(e),
                            t());
                        c = null;
                        do {
                            s = !1;
                            q = y;
                            for (n = 0; n < w.length; n++) {
                                try { z = w[n], l = z.fn, l(z.scope, z.locals) } catch (C) { f(C) }
                                c = null
                            }
                            w.length = 0;
                            a: do {
                                if (n = !q.$$suspended && q.$$watchers)
                                    for (n.$$digestWatchIndex = n.length; n.$$digestWatchIndex--;) try {
                                        if (a = n[n.$$digestWatchIndex])
                                            if (m = a.get, (g = m(q)) !== (h = a.last) && !(a.eq ? va(g, h) : Y(g) && Y(h))) s = !0, c = a, a.last = a.eq ? Ia(g, null) : g, l = a.fn, l(g, h === G ? g : h, q), 5 > r && (A = 4 - r, N[A] || (N[A] = []), N[A].push({ msg: B(a.exp) ? "fn: " + (a.exp.name || a.exp.toString()) : a.exp, newVal: g, oldVal: h }));
                                            else if (a === c) {
                                            s = !1;
                                            break a
                                        }
                                    } catch (E) { f(E) }
                                if (!(n = !q.$$suspended && q.$$watchersCount && q.$$childHead || q !== y && q.$$nextSibling))
                                    for (; q !== y && !(n = q.$$nextSibling);) q = q.$parent
                            } while (q = n);
                            if ((s || w.length) && !r--) throw v.$$phase = null, d("infdig", b, N);
                        } while (s || w.length);
                        for (v.$$phase = null; J < x.length;) try { x[J++]() } catch (D) { f(D) }
                        x.length = J = 0;
                        k.$$checkUrlChange()
                    },
                    $suspend: function() { this.$$suspended = !0 },
                    $isSuspended: function() { return this.$$suspended },
                    $resume: function() { this.$$suspended = !1 },
                    $destroy: function() {
                        if (!this.$$destroyed) {
                            var a =
                                this.$parent;
                            this.$broadcast("$destroy");
                            this.$$destroyed = !0;
                            this === v && k.$$applicationDestroyed();
                            n(this, -this.$$watchersCount);
                            for (var b in this.$$listenerCount) s(this, this.$$listenerCount[b], b);
                            a && a.$$childHead === this && (a.$$childHead = this.$$nextSibling);
                            a && a.$$childTail === this && (a.$$childTail = this.$$prevSibling);
                            this.$$prevSibling && (this.$$prevSibling.$$nextSibling = this.$$nextSibling);
                            this.$$nextSibling && (this.$$nextSibling.$$prevSibling = this.$$prevSibling);
                            this.$destroy = this.$digest = this.$apply =
                                this.$evalAsync = this.$applyAsync = E;
                            this.$on = this.$watch = this.$watchGroup = function() { return E };
                            this.$$listeners = {};
                            this.$$nextSibling = null;
                            l(this)
                        }
                    },
                    $eval: function(a, b) { return g(a)(this, b) },
                    $evalAsync: function(a, b) {
                        v.$$phase || w.length || k.defer(function() { w.length && v.$digest() }, null, "$evalAsync");
                        w.push({ scope: this, fn: g(a), locals: b })
                    },
                    $$postDigest: function(a) { x.push(a) },
                    $apply: function(a) {
                        try { p("$apply"); try { return this.$eval(a) } finally { v.$$phase = null } } catch (b) { f(b) } finally {
                            try { v.$digest() } catch (c) {
                                throw f(c),
                                    c;
                            }
                        }
                    },
                    $applyAsync: function(a) {
                        function b() { c.$eval(a) }
                        var c = this;
                        a && y.push(b);
                        a = g(a);
                        q()
                    },
                    $on: function(a, b) {
                        var c = this.$$listeners[a];
                        c || (this.$$listeners[a] = c = []);
                        c.push(b);
                        var d = this;
                        do d.$$listenerCount[a] || (d.$$listenerCount[a] = 0), d.$$listenerCount[a]++; while (d = d.$parent);
                        var e = this;
                        return function() { var d = c.indexOf(b); - 1 !== d && (delete c[d], s(e, 1, a)) }
                    },
                    $emit: function(a, b) {
                        var c = [],
                            d, e = this,
                            g = !1,
                            h = {
                                name: a,
                                targetScope: e,
                                stopPropagation: function() { g = !0 },
                                preventDefault: function() {
                                    h.defaultPrevented = !0
                                },
                                defaultPrevented: !1
                            },
                            k = db([h], arguments, 1),
                            l, m;
                        do {
                            d = e.$$listeners[a] || c;
                            h.currentScope = e;
                            l = 0;
                            for (m = d.length; l < m; l++)
                                if (d[l]) try { d[l].apply(null, k) } catch (n) { f(n) } else d.splice(l, 1), l--, m--;
                            if (g) break;
                            e = e.$parent
                        } while (e);
                        h.currentScope = null;
                        return h
                    },
                    $broadcast: function(a, b) {
                        var c = this,
                            d = this,
                            e = { name: a, targetScope: this, preventDefault: function() { e.defaultPrevented = !0 }, defaultPrevented: !1 };
                        if (!this.$$listenerCount[a]) return e;
                        for (var g = db([e], arguments, 1), h, k; c = d;) {
                            e.currentScope = c;
                            d = c.$$listeners[a] || [];
                            h = 0;
                            for (k = d.length; h < k; h++)
                                if (d[h]) try { d[h].apply(null, g) } catch (l) { f(l) } else d.splice(h, 1), h--, k--;
                            if (!(d = c.$$listenerCount[a] && c.$$childHead || c !== this && c.$$nextSibling))
                                for (; c !== this && !(d = c.$$nextSibling);) c = c.$parent
                        }
                        e.currentScope = null;
                        return e
                    }
                };
                var v = new m,
                    w = v.$$asyncQueue = [],
                    x = v.$$postDigestQueue = [],
                    y = v.$$applyAsyncQueue = [],
                    J = 0;
                return v
            }
        ]
    }

    function Qe() {
        var a = /^\s*(https?|s?ftp|mailto|tel|file):/,
            b = /^\s*((https?|ftp|file|blob):|data:image\/)/;
        this.aHrefSanitizationTrustedUrlList = function(b) {
            return w(b) ?
                (a = b, this) : a
        };
        this.imgSrcSanitizationTrustedUrlList = function(a) { return w(a) ? (b = a, this) : b };
        this.$get = function() {
            return function(d, c) {
                var e = c ? b : a,
                    f = ga(d && d.trim()).href;
                return "" === f || f.match(e) ? d : "unsafe:" + f
            }
        }
    }

    function Xg(a) {
        if ("self" === a) return a;
        if (C(a)) {
            if (-1 < a.indexOf("***")) throw Ea("iwcard", a);
            a = Od(a).replace(/\\\*\\\*/g, ".*").replace(/\\\*/g, "[^:/.?&;]*");
            return new RegExp("^" + a + "$")
        }
        if (ab(a)) return new RegExp("^" + a.source + "$");
        throw Ea("imatcher");
    }

    function Pd(a) {
        var b = [];
        w(a) && r(a, function(a) { b.push(Xg(a)) });
        return b
    }

    function eg() {
        this.SCE_CONTEXTS = W;
        var a = ["self"],
            b = [];
        this.trustedResourceUrlList = function(b) { arguments.length && (a = Pd(b)); return a };
        Object.defineProperty(this, "resourceUrlWhitelist", { get: function() { return this.trustedResourceUrlList }, set: function(a) { this.trustedResourceUrlList = a } });
        this.bannedResourceUrlList = function(a) { arguments.length && (b = Pd(a)); return b };
        Object.defineProperty(this, "resourceUrlBlacklist", {
            get: function() { return this.bannedResourceUrlList },
            set: function(a) {
                this.bannedResourceUrlList =
                    a
            }
        });
        this.$get = ["$injector", "$$sanitizeUri", function(d, c) {
            function e(a, b) { var c; "self" === a ? (c = Cc(b, Qd)) || (z.document.baseURI ? c = z.document.baseURI : (Na || (Na = z.document.createElement("a"), Na.href = ".", Na = Na.cloneNode(!1)), c = Na.href), c = Cc(b, c)) : c = !!a.exec(b.href); return c }

            function f(a) {
                var b = function(a) { this.$$unwrapTrustedValue = function() { return a } };
                a && (b.prototype = new a);
                b.prototype.valueOf = function() { return this.$$unwrapTrustedValue() };
                b.prototype.toString = function() { return this.$$unwrapTrustedValue().toString() };
                return b
            }
            var g = function(a) { throw Ea("unsafe"); };
            d.has("$sanitize") && (g = d.get("$sanitize"));
            var k = f(),
                h = {};
            h[W.HTML] = f(k);
            h[W.CSS] = f(k);
            h[W.MEDIA_URL] = f(k);
            h[W.URL] = f(h[W.MEDIA_URL]);
            h[W.JS] = f(k);
            h[W.RESOURCE_URL] = f(h[W.URL]);
            return {
                trustAs: function(a, b) { var c = h.hasOwnProperty(a) ? h[a] : null; if (!c) throw Ea("icontext", a, b); if (null === b || A(b) || "" === b) return b; if ("string" !== typeof b) throw Ea("itype", a); return new c(b) },
                getTrusted: function(d, f) {
                    if (null === f || A(f) || "" === f) return f;
                    var k = h.hasOwnProperty(d) ?
                        h[d] : null;
                    if (k && f instanceof k) return f.$$unwrapTrustedValue();
                    B(f.$$unwrapTrustedValue) && (f = f.$$unwrapTrustedValue());
                    if (d === W.MEDIA_URL || d === W.URL) return c(f.toString(), d === W.MEDIA_URL);
                    if (d === W.RESOURCE_URL) {
                        var k = ga(f.toString()),
                            n, s, r = !1;
                        n = 0;
                        for (s = a.length; n < s; n++)
                            if (e(a[n], k)) { r = !0; break }
                        if (r)
                            for (n = 0, s = b.length; n < s; n++)
                                if (e(b[n], k)) { r = !1; break }
                        if (r) return f;
                        throw Ea("insecurl", f.toString());
                    }
                    if (d === W.HTML) return g(f);
                    throw Ea("unsafe");
                },
                valueOf: function(a) {
                    return a instanceof k ? a.$$unwrapTrustedValue() :
                        a
                }
            }
        }]
    }

    function dg() {
        var a = !0;
        this.enabled = function(b) { arguments.length && (a = !!b); return a };
        this.$get = ["$parse", "$sceDelegate", function(b, d) {
            if (a && 8 > wa) throw Ea("iequirks");
            var c = ja(W);
            c.isEnabled = function() { return a };
            c.trustAs = d.trustAs;
            c.getTrusted = d.getTrusted;
            c.valueOf = d.valueOf;
            a || (c.trustAs = c.getTrusted = function(a, b) { return b }, c.valueOf = Ta);
            c.parseAs = function(a, d) { var e = b(d); return e.literal && e.constant ? e : b(d, function(b) { return c.getTrusted(a, b) }) };
            var e = c.parseAs,
                f = c.getTrusted,
                g = c.trustAs;
            r(W,
                function(a, b) {
                    var d = K(b);
                    c[("parse_as_" + d).replace(Dc, xb)] = function(b) { return e(a, b) };
                    c[("get_trusted_" + d).replace(Dc, xb)] = function(b) { return f(a, b) };
                    c[("trust_as_" + d).replace(Dc, xb)] = function(b) { return g(a, b) }
                });
            return c
        }]
    }

    function fg() {
        this.$get = ["$window", "$document", function(a, b) {
            var d = {},
                c = !((!a.nw || !a.nw.process) && a.chrome && (a.chrome.app && a.chrome.app.runtime || !a.chrome.app && a.chrome.runtime && a.chrome.runtime.id)) && a.history && a.history.pushState,
                e = fa((/android (\d+)/.exec(K((a.navigator || {}).userAgent)) || [])[1]),
                f = /Boxee/i.test((a.navigator || {}).userAgent),
                g = b[0] || {},
                k = g.body && g.body.style,
                h = !1,
                l = !1;
            k && (h = !!("transition" in k || "webkitTransition" in k), l = !!("animation" in k || "webkitAnimation" in k));
            return {
                history: !(!c || 4 > e || f),
                hasEvent: function(a) {
                    if ("input" === a && wa) return !1;
                    if (A(d[a])) {
                        var b = g.createElement("div");
                        d[a] = "on" + a in b
                    }
                    return d[a]
                },
                csp: Ba(),
                transitions: h,
                animations: l,
                android: e
            }
        }]
    }

    function gg() { this.$get = ia(function(a) { return new Yg(a) }) }

    function Yg(a) {
        function b() {
            var a = e.pop();
            return a &&
                a.cb
        }

        function d(a) { for (var b = e.length - 1; 0 <= b; --b) { var c = e[b]; if (c.type === a) return e.splice(b, 1), c.cb } }
        var c = {},
            e = [],
            f = this.ALL_TASKS_TYPE = "$$all$$",
            g = this.DEFAULT_TASK_TYPE = "$$default$$";
        this.completeTask = function(e, h) {
            h = h || g;
            try { e() } finally {
                var l;
                l = h || g;
                c[l] && (c[l]--, c[f]--);
                l = c[h];
                var m = c[f];
                if (!m || !l)
                    for (l = m ? d : b; m = l(h);) try { m() } catch (p) { a.error(p) }
            }
        };
        this.incTaskCount = function(a) {
            a = a || g;
            c[a] = (c[a] || 0) + 1;
            c[f] = (c[f] || 0) + 1
        };
        this.notifyWhenNoPendingTasks = function(a, b) {
            b = b || f;
            c[b] ? e.push({ type: b, cb: a }) :
                a()
        }
    }

    function ig() {
        var a;
        this.httpOptions = function(b) { return b ? (a = b, this) : a };
        this.$get = ["$exceptionHandler", "$templateCache", "$http", "$q", "$sce", function(b, d, c, e, f) {
            function g(k, h) {
                g.totalPendingRequests++;
                if (!C(k) || A(d.get(k))) k = f.getTrustedResourceUrl(k);
                var l = c.defaults && c.defaults.transformResponse;
                H(l) ? l = l.filter(function(a) { return a !== wc }) : l === wc && (l = null);
                return c.get(k, S({ cache: d, transformResponse: l }, a)).finally(function() { g.totalPendingRequests-- }).then(function(a) { return d.put(k, a.data) },
                    function(a) { h || (a = Zg("tpload", k, a.status, a.statusText), b(a)); return e.reject(a) })
            }
            g.totalPendingRequests = 0;
            return g
        }]
    }

    function jg() {
        this.$get = ["$rootScope", "$browser", "$location", function(a, b, d) {
            return {
                findBindings: function(a, b, d) {
                    a = a.getElementsByClassName("ng-binding");
                    var g = [];
                    r(a, function(a) {
                        var c = ca.element(a).data("$binding");
                        c && r(c, function(c) { d ? (new RegExp("(^|\\s)" + Od(b) + "(\\s|\\||$)")).test(c) && g.push(a) : -1 !== c.indexOf(b) && g.push(a) })
                    });
                    return g
                },
                findModels: function(a, b, d) {
                    for (var g = ["ng-",
                            "data-ng-", "ng\\:"
                        ], k = 0; k < g.length; ++k) { var h = a.querySelectorAll("[" + g[k] + "model" + (d ? "=" : "*=") + '"' + b + '"]'); if (h.length) return h }
                },
                getLocation: function() { return d.url() },
                setLocation: function(b) { b !== d.url() && (d.url(b), a.$digest()) },
                whenStable: function(a) { b.notifyWhenNoOutstandingRequests(a) }
            }
        }]
    }

    function kg() {
        this.$get = ["$rootScope", "$browser", "$q", "$$q", "$exceptionHandler", function(a, b, d, c, e) {
            function f(f, h, l) {
                B(f) || (l = h, h = f, f = E);
                var m = Ha.call(arguments, 3),
                    p = w(l) && !l,
                    n = (p ? c : d).defer(),
                    s = n.promise,
                    r;
                r = b.defer(function() {
                    try { n.resolve(f.apply(null, m)) } catch (b) { n.reject(b), e(b) } finally { delete g[s.$$timeoutId] }
                    p || a.$apply()
                }, h, "$timeout");
                s.$$timeoutId = r;
                g[r] = n;
                return s
            }
            var g = {};
            f.cancel = function(a) {
                if (!a) return !1;
                if (!a.hasOwnProperty("$$timeoutId")) throw $g("badprom");
                if (!g.hasOwnProperty(a.$$timeoutId)) return !1;
                a = a.$$timeoutId;
                var c = g[a],
                    d = c.promise;
                d.$$state && (d.$$state.pur = !0);
                c.reject("canceled");
                delete g[a];
                return b.defer.cancel(a)
            };
            return f
        }]
    }

    function ga(a) {
        if (!C(a)) return a;
        wa && (aa.setAttribute("href",
            a), a = aa.href);
        aa.setAttribute("href", a);
        a = aa.hostname;
        !ah && -1 < a.indexOf(":") && (a = "[" + a + "]");
        return { href: aa.href, protocol: aa.protocol ? aa.protocol.replace(/:$/, "") : "", host: aa.host, search: aa.search ? aa.search.replace(/^\?/, "") : "", hash: aa.hash ? aa.hash.replace(/^#/, "") : "", hostname: a, port: aa.port, pathname: "/" === aa.pathname.charAt(0) ? aa.pathname : "/" + aa.pathname }
    }

    function Og(a) { var b = [Qd].concat(a.map(ga)); return function(a) { a = ga(a); return b.some(Cc.bind(null, a)) } }

    function Cc(a, b) {
        a = ga(a);
        b = ga(b);
        return a.protocol ===
            b.protocol && a.host === b.host
    }

    function lg() { this.$get = ia(z) }

    function Rd(a) {
        function b(a) { try { return decodeURIComponent(a) } catch (b) { return a } }
        var d = a[0] || {},
            c = {},
            e = "";
        return function() {
            var a, g, k, h, l;
            try { a = d.cookie || "" } catch (m) { a = "" }
            if (a !== e)
                for (e = a, a = e.split("; "), c = {}, k = 0; k < a.length; k++) g = a[k], h = g.indexOf("="), 0 < h && (l = b(g.substring(0, h)), A(c[l]) && (c[l] = b(g.substring(h + 1))));
            return c
        }
    }

    function pg() { this.$get = Rd }

    function fd(a) {
        function b(d, c) {
            if (D(d)) {
                var e = {};
                r(d, function(a, c) { e[c] = b(c, a) });
                return e
            }
            return a.factory(d +
                "Filter", c)
        }
        this.register = b;
        this.$get = ["$injector", function(a) { return function(b) { return a.get(b + "Filter") } }];
        b("currency", Sd);
        b("date", Td);
        b("filter", bh);
        b("json", ch);
        b("limitTo", dh);
        b("lowercase", eh);
        b("number", Ud);
        b("orderBy", Vd);
        b("uppercase", fh)
    }

    function bh() {
        return function(a, b, d, c) {
            if (!za(a)) { if (null == a) return a; throw F("filter")("notarray", a); }
            c = c || "$";
            var e;
            switch (Ec(b)) {
                case "function":
                    break;
                case "boolean":
                case "null":
                case "number":
                case "string":
                    e = !0;
                case "object":
                    b = gh(b, d, c, e);
                    break;
                default:
                    return a
            }
            return Array.prototype.filter.call(a,
                b)
        }
    }

    function gh(a, b, d, c) {
        var e = D(a) && d in a;
        !0 === b ? b = va : B(b) || (b = function(a, b) {
            if (A(a)) return !1;
            if (null === a || null === b) return a === b;
            if (D(b) || D(a) && !cc(a)) return !1;
            a = K("" + a);
            b = K("" + b);
            return -1 !== a.indexOf(b)
        });
        return function(f) { return e && !D(f) ? Fa(f, a[d], b, d, !1) : Fa(f, a, b, d, c) }
    }

    function Fa(a, b, d, c, e, f) {
        var g = Ec(a),
            k = Ec(b);
        if ("string" === k && "!" === b.charAt(0)) return !Fa(a, b.substring(1), d, c, e);
        if (H(a)) return a.some(function(a) { return Fa(a, b, d, c, e) });
        switch (g) {
            case "object":
                var h;
                if (e) {
                    for (h in a)
                        if (h.charAt &&
                            "$" !== h.charAt(0) && Fa(a[h], b, d, c, !0)) return !0;
                    return f ? !1 : Fa(a, b, d, c, !1)
                }
                if ("object" === k) {
                    for (h in b)
                        if (f = b[h], !B(f) && !A(f) && (g = h === c, !Fa(g ? a : a[h], f, d, c, g, g))) return !1;
                    return !0
                }
                return d(a, b);
            case "function":
                return !1;
            default:
                return d(a, b)
        }
    }

    function Ec(a) { return null === a ? "null" : typeof a }

    function Sd(a) {
        var b = a.NUMBER_FORMATS;
        return function(a, c, e) {
            A(c) && (c = b.CURRENCY_SYM);
            A(e) && (e = b.PATTERNS[1].maxFrac);
            var f = c ? /\u00A4/g : /\s*\u00A4\s*/g;
            return null == a ? a : Wd(a, b.PATTERNS[1], b.GROUP_SEP, b.DECIMAL_SEP, e).replace(f,
                c)
        }
    }

    function Ud(a) { var b = a.NUMBER_FORMATS; return function(a, c) { return null == a ? a : Wd(a, b.PATTERNS[0], b.GROUP_SEP, b.DECIMAL_SEP, c) } }

    function hh(a) {
        var b = 0,
            d, c, e, f, g; - 1 < (c = a.indexOf(Xd)) && (a = a.replace(Xd, ""));
        0 < (e = a.search(/e/i)) ? (0 > c && (c = e), c += +a.slice(e + 1), a = a.substring(0, e)) : 0 > c && (c = a.length);
        for (e = 0; a.charAt(e) === Fc; e++);
        if (e === (g = a.length)) d = [0], c = 1;
        else {
            for (g--; a.charAt(g) === Fc;) g--;
            c -= e;
            d = [];
            for (f = 0; e <= g; e++, f++) d[f] = +a.charAt(e)
        }
        c > Yd && (d = d.splice(0, Yd - 1), b = c - 1, c = 1);
        return { d: d, e: b, i: c }
    }

    function ih(a,
        b, d, c) {
        var e = a.d,
            f = e.length - a.i;
        b = A(b) ? Math.min(Math.max(d, f), c) : +b;
        d = b + a.i;
        c = e[d];
        if (0 < d) { e.splice(Math.max(a.i, d)); for (var g = d; g < e.length; g++) e[g] = 0 } else
            for (f = Math.max(0, f), a.i = 1, e.length = Math.max(1, d = b + 1), e[0] = 0, g = 1; g < d; g++) e[g] = 0;
        if (5 <= c)
            if (0 > d - 1) {
                for (c = 0; c > d; c--) e.unshift(0), a.i++;
                e.unshift(1);
                a.i++
            } else e[d - 1]++;
        for (; f < Math.max(0, b); f++) e.push(0);
        if (b = e.reduceRight(function(a, b, c, d) {
                b += a;
                d[c] = b % 10;
                return Math.floor(b / 10)
            }, 0)) e.unshift(b), a.i++
    }

    function Wd(a, b, d, c, e) {
        if (!C(a) && !X(a) || isNaN(a)) return "";
        var f = !isFinite(a),
            g = !1,
            k = Math.abs(a) + "",
            h = "";
        if (f) h = "\u221e";
        else {
            g = hh(k)
        }
    }
});