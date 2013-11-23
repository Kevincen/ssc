/**
 * Created by koovincen on 13-11-2.
 */
/*! jQuery v1.7.1 jquery.com | jquery.org/license */
(function (a, b) {
    function cy(a) {
        return f.isWindow(a) ? a : a.nodeType === 9 ? a.defaultView || a.parentWindow : !1
    }

    function cv(a) {
        if (!ck[a]) {
            var b = c.body, d = f("<" + a + ">").appendTo(b), e = d.css("display");
            d.remove();
            if (e === "none" || e === "") {
                cl || (cl = c.createElement("iframe"), cl.frameBorder = cl.width = cl.height = 0), b.appendChild(cl);
                if (!cm || !cl.createElement)cm = (cl.contentWindow || cl.contentDocument).document, cm.write((c.compatMode === "CSS1Compat" ? "<!doctype html>" : "") + "<html><body>"), cm.close();
                d = cm.createElement(a), cm.body.appendChild(d), e = f.css(d, "display"), b.removeChild(cl)
            }
            ck[a] = e
        }
        return ck[a]
    }

    function cu(a, b) {
        var c = {};
        f.each(cq.concat.apply([], cq.slice(0, b)), function () {
            c[this] = a
        });
        return c
    }

    function ct() {
        cr = b
    }

    function cs() {
        setTimeout(ct, 0);
        return cr = f.now()
    }

    function cj() {
        try {
            return new a.ActiveXObject("Microsoft.XMLHTTP")
        } catch (b) {
        }
    }

    function ci() {
        try {
            return new a.XMLHttpRequest
        } catch (b) {
        }
    }

    function cc(a, c) {
        a.dataFilter && (c = a.dataFilter(c, a.dataType));
        var d = a.dataTypes, e = {}, g, h, i = d.length, j, k = d[0], l, m, n, o, p;
        for (g = 1; g < i; g++) {
            if (g === 1)for (h in a.converters)typeof h == "string" && (e[h.toLowerCase()] = a.converters[h]);
            l = k, k = d[g];
            if (k === "*")k = l; else if (l !== "*" && l !== k) {
                m = l + " " + k, n = e[m] || e["* " + k];
                if (!n) {
                    p = b;
                    for (o in e) {
                        j = o.split(" ");
                        if (j[0] === l || j[0] === "*") {
                            p = e[j[1] + " " + k];
                            if (p) {
                                o = e[o], o === !0 ? n = p : p === !0 && (n = o);
                                break
                            }
                        }
                    }
                }
                !n && !p && f.error("No conversion from " + m.replace(" ", " to ")), n !== !0 && (c = n ? n(c) : p(o(c)))
            }
        }
        return c
    }

    function cb(a, c, d) {
        var e = a.contents, f = a.dataTypes, g = a.responseFields, h, i, j, k;
        for (i in g)i in d && (c[g[i]] = d[i]);
        while (f[0] === "*")f.shift(), h === b && (h = a.mimeType || c.getResponseHeader("content-type"));
        if (h)for (i in e)if (e[i] && e[i].test(h)) {
            f.unshift(i);
            break
        }
        if (f[0]in d)j = f[0]; else {
            for (i in d) {
                if (!f[0] || a.converters[i + " " + f[0]]) {
                    j = i;
                    break
                }
                k || (k = i)
            }
            j = j || k
        }
        if (j) {
            j !== f[0] && f.unshift(j);
            return d[j]
        }
    }

    function ca(a, b, c, d) {
        if (f.isArray(b))f.each(b, function (b, e) {
            c || bE.test(a) ? d(a, e) : ca(a + "[" + (typeof e == "object" || f.isArray(e) ? b : "") + "]", e, c, d)
        }); else if (!c && b != null && typeof b == "object")for (var e in b)ca(a + "[" + e + "]", b[e], c, d); else d(a, b)
    }

    function b_(a, c) {
        var d, e, g = f.ajaxSettings.flatOptions || {};
        for (d in c)c[d] !== b && ((g[d] ? a : e || (e = {}))[d] = c[d]);
        e && f.extend(!0, a, e)
    }

    function b$(a, c, d, e, f, g) {
        f = f || c.dataTypes[0], g = g || {}, g[f] = !0;
        var h = a[f], i = 0, j = h ? h.length : 0, k = a === bT, l;
        for (; i < j && (k || !l); i++)l = h[i](c, d, e), typeof l == "string" && (!k || g[l] ? l = b : (c.dataTypes.unshift(l), l = b$(a, c, d, e, l, g)));
        (k || !l) && !g["*"] && (l = b$(a, c, d, e, "*", g));
        return l
    }

    function bZ(a) {
        return function (b, c) {
            typeof b != "string" && (c = b, b = "*");
            if (f.isFunction(c)) {
                var d = b.toLowerCase().split(bP), e = 0, g = d.length, h, i, j;
                for (; e < g; e++)h = d[e], j = /^\+/.test(h), j && (h = h.substr(1) || "*"), i = a[h] = a[h] || [], i[j ? "unshift" : "push"](c)
            }
        }
    }

    function bC(a, b, c) {
        var d = b === "width" ? a.offsetWidth : a.offsetHeight, e = b === "width" ? bx : by, g = 0, h = e.length;
        if (d > 0) {
            if (c !== "border")for (; g < h; g++)c || (d -= parseFloat(f.css(a, "padding" + e[g])) || 0), c === "margin" ? d += parseFloat(f.css(a, c + e[g])) || 0 : d -= parseFloat(f.css(a, "border" + e[g] + "Width")) || 0;
            return d + "px"
        }
        d = bz(a, b, b);
        if (d < 0 || d == null)d = a.style[b] || 0;
        d = parseFloat(d) || 0;
        if (c)for (; g < h; g++)d += parseFloat(f.css(a, "padding" + e[g])) || 0, c !== "padding" && (d += parseFloat(f.css(a, "border" + e[g] + "Width")) || 0), c === "margin" && (d += parseFloat(f.css(a, c + e[g])) || 0);
        return d + "px"
    }

    function bp(a, b) {
        b.src ? f.ajax({url: b.src, async: !1, dataType: "script"}) : f.globalEval((b.text || b.textContent || b.innerHTML || "").replace(bf, "/*$0*/")), b.parentNode && b.parentNode.removeChild(b)
    }

    function bo(a) {
        var b = c.createElement("div");
        bh.appendChild(b), b.innerHTML = a.outerHTML;
        return b.firstChild
    }

    function bn(a) {
        var b = (a.nodeName || "").toLowerCase();
        b === "input" ? bm(a) : b !== "script" && typeof a.getElementsByTagName != "undefined" && f.grep(a.getElementsByTagName("input"), bm)
    }

    function bm(a) {
        if (a.type === "checkbox" || a.type === "radio")a.defaultChecked = a.checked
    }

    function bl(a) {
        return typeof a.getElementsByTagName != "undefined" ? a.getElementsByTagName("*") : typeof a.querySelectorAll != "undefined" ? a.querySelectorAll("*") : []
    }

    function bk(a, b) {
        var c;
        if (b.nodeType === 1) {
            b.clearAttributes && b.clearAttributes(), b.mergeAttributes && b.mergeAttributes(a), c = b.nodeName.toLowerCase();
            if (c === "object")b.outerHTML = a.outerHTML; else if (c !== "input" || a.type !== "checkbox" && a.type !== "radio") {
                if (c === "option")b.selected = a.defaultSelected; else if (c === "input" || c === "textarea")b.defaultValue = a.defaultValue
            } else a.checked && (b.defaultChecked = b.checked = a.checked), b.value !== a.value && (b.value = a.value);
            b.removeAttribute(f.expando)
        }
    }

    function bj(a, b) {
        if (b.nodeType === 1 && !!f.hasData(a)) {
            var c, d, e, g = f._data(a), h = f._data(b, g), i = g.events;
            if (i) {
                delete h.handle, h.events = {};
                for (c in i)for (d = 0, e = i[c].length; d < e; d++)f.event.add(b, c + (i[c][d].namespace ? "." : "") + i[c][d].namespace, i[c][d], i[c][d].data)
            }
            h.data && (h.data = f.extend({}, h.data))
        }
    }

    function bi(a, b) {
        return f.nodeName(a, "table") ? a.getElementsByTagName("tbody")[0] || a.appendChild(a.ownerDocument.createElement("tbody")) : a
    }

    function U(a) {
        var b = V.split("|"), c = a.createDocumentFragment();
        if (c.createElement)while (b.length)c.createElement(b.pop());
        return c
    }

    function T(a, b, c) {
        b = b || 0;
        if (f.isFunction(b))return f.grep(a, function (a, d) {
            var e = !!b.call(a, d, a);
            return e === c
        });
        if (b.nodeType)return f.grep(a, function (a, d) {
            return a === b === c
        });
        if (typeof b == "string") {
            var d = f.grep(a, function (a) {
                return a.nodeType === 1
            });
            if (O.test(b))return f.filter(b, d, !c);
            b = f.filter(b, d)
        }
        return f.grep(a, function (a, d) {
            return f.inArray(a, b) >= 0 === c
        })
    }

    function S(a) {
        return!a || !a.parentNode || a.parentNode.nodeType === 11
    }

    function K() {
        return!0
    }

    function J() {
        return!1
    }

    function n(a, b, c) {
        var d = b + "defer", e = b + "queue", g = b + "mark", h = f._data(a, d);
        h && (c === "queue" || !f._data(a, e)) && (c === "mark" || !f._data(a, g)) && setTimeout(function () {
            !f._data(a, e) && !f._data(a, g) && (f.removeData(a, d, !0), h.fire())
        }, 0)
    }

    function m(a) {
        for (var b in a) {
            if (b === "data" && f.isEmptyObject(a[b]))continue;
            if (b !== "toJSON")return!1
        }
        return!0
    }

    function l(a, c, d) {
        if (d === b && a.nodeType === 1) {
            var e = "data-" + c.replace(k, "-$1").toLowerCase();
            d = a.getAttribute(e);
            if (typeof d == "string") {
                try {
                    d = d === "true" ? !0 : d === "false" ? !1 : d === "null" ? null : f.isNumeric(d) ? parseFloat(d) : j.test(d) ? f.parseJSON(d) : d
                } catch (g) {
                }
                f.data(a, c, d)
            } else d = b
        }
        return d
    }

    function h(a) {
        var b = g[a] = {}, c, d;
        a = a.split(/\s+/);
        for (c = 0, d = a.length; c < d; c++)b[a[c]] = !0;
        return b
    }

    var c = a.document, d = a.navigator, e = a.location, f = function () {
        function J() {
            if (!e.isReady) {
                try {
                    c.documentElement.doScroll("left")
                } catch (a) {
                    setTimeout(J, 1);
                    return
                }
                e.ready()
            }
        }

        var e = function (a, b) {
            return new e.fn.init(a, b, h)
        }, f = a.jQuery, g = a.$, h, i = /^(?:[^#<]*(<[\w\W]+>)[^>]*$|#([\w\-]*)$)/, j = /\S/, k = /^\s+/, l = /\s+$/, m = /^<(\w+)\s*\/?>(?:<\/\1>)?$/, n = /^[\],:{}\s]*$/, o = /\\(?:["\\\/bfnrt]|u[0-9a-fA-F]{4})/g, p = /"[^"\\\n\r]*"|true|false|null|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?/g, q = /(?:^|:|,)(?:\s*\[)+/g, r = /(webkit)[ \/]([\w.]+)/, s = /(opera)(?:.*version)?[ \/]([\w.]+)/, t = /(msie) ([\w.]+)/, u = /(mozilla)(?:.*? rv:([\w.]+))?/, v = /-([a-z]|[0-9])/ig, w = /^-ms-/, x = function (a, b) {
            return(b + "").toUpperCase()
        }, y = d.userAgent, z, A, B, C = Object.prototype.toString, D = Object.prototype.hasOwnProperty, E = Array.prototype.push, F = Array.prototype.slice, G = String.prototype.trim, H = Array.prototype.indexOf, I = {};
        e.fn = e.prototype = {constructor: e, init: function (a, d, f) {
            var g, h, j, k;
            if (!a)return this;
            if (a.nodeType) {
                this.context = this[0] = a, this.length = 1;
                return this
            }
            if (a === "body" && !d && c.body) {
                this.context = c, this[0] = c.body, this.selector = a, this.length = 1;
                return this
            }
            if (typeof a == "string") {
                a.charAt(0) !== "<" || a.charAt(a.length - 1) !== ">" || a.length < 3 ? g = i.exec(a) : g = [null, a, null];
                if (g && (g[1] || !d)) {
                    if (g[1]) {
                        d = d instanceof e ? d[0] : d, k = d ? d.ownerDocument || d : c, j = m.exec(a), j ? e.isPlainObject(d) ? (a = [c.createElement(j[1])], e.fn.attr.call(a, d, !0)) : a = [k.createElement(j[1])] : (j = e.buildFragment([g[1]], [k]), a = (j.cacheable ? e.clone(j.fragment) : j.fragment).childNodes);
                        return e.merge(this, a)
                    }
                    h = c.getElementById(g[2]);
                    if (h && h.parentNode) {
                        if (h.id !== g[2])return f.find(a);
                        this.length = 1, this[0] = h
                    }
                    this.context = c, this.selector = a;
                    return this
                }
                return!d || d.jquery ? (d || f).find(a) : this.constructor(d).find(a)
            }
            if (e.isFunction(a))return f.ready(a);
            a.selector !== b && (this.selector = a.selector, this.context = a.context);
            return e.makeArray(a, this)
        }, selector: "", jquery: "1.7.1", length: 0, size: function () {
            return this.length
        }, toArray: function () {
            return F.call(this, 0)
        }, get: function (a) {
            return a == null ? this.toArray() : a < 0 ? this[this.length + a] : this[a]
        }, pushStack: function (a, b, c) {
            var d = this.constructor();
            e.isArray(a) ? E.apply(d, a) : e.merge(d, a), d.prevObject = this, d.context = this.context, b === "find" ? d.selector = this.selector + (this.selector ? " " : "") + c : b && (d.selector = this.selector + "." + b + "(" + c + ")");
            return d
        }, each: function (a, b) {
            return e.each(this, a, b)
        }, ready: function (a) {
            e.bindReady(), A.add(a);
            return this
        }, eq: function (a) {
            a = +a;
            return a === -1 ? this.slice(a) : this.slice(a, a + 1)
        }, first: function () {
            return this.eq(0)
        }, last: function () {
            return this.eq(-1)
        }, slice: function () {
            return this.pushStack(F.apply(this, arguments), "slice", F.call(arguments).join(","))
        }, map: function (a) {
            return this.pushStack(e.map(this, function (b, c) {
                return a.call(b, c, b)
            }))
        }, end: function () {
            return this.prevObject || this.constructor(null)
        }, push: E, sort: [].sort, splice: [].splice}, e.fn.init.prototype = e.fn, e.extend = e.fn.extend = function () {
            var a, c, d, f, g, h, i = arguments[0] || {}, j = 1, k = arguments.length, l = !1;
            typeof i == "boolean" && (l = i, i = arguments[1] || {}, j = 2), typeof i != "object" && !e.isFunction(i) && (i = {}), k === j && (i = this, --j);
            for (; j < k; j++)if ((a = arguments[j]) != null)for (c in a) {
                d = i[c], f = a[c];
                if (i === f)continue;
                l && f && (e.isPlainObject(f) || (g = e.isArray(f))) ? (g ? (g = !1, h = d && e.isArray(d) ? d : []) : h = d && e.isPlainObject(d) ? d : {}, i[c] = e.extend(l, h, f)) : f !== b && (i[c] = f)
            }
            return i
        }, e.extend({noConflict: function (b) {
            a.$ === e && (a.$ = g), b && a.jQuery === e && (a.jQuery = f);
            return e
        }, isReady: !1, readyWait: 1, holdReady: function (a) {
            a ? e.readyWait++ : e.ready(!0)
        }, ready: function (a) {
            if (a === !0 && !--e.readyWait || a !== !0 && !e.isReady) {
                if (!c.body)return setTimeout(e.ready, 1);
                e.isReady = !0;
                if (a !== !0 && --e.readyWait > 0)return;
                A.fireWith(c, [e]), e.fn.trigger && e(c).trigger("ready").off("ready")
            }
        }, bindReady: function () {
            if (!A) {
                A = e.Callbacks("once memory");
                if (c.readyState === "complete")return setTimeout(e.ready, 1);
                if (c.addEventListener)c.addEventListener("DOMContentLoaded", B, !1), a.addEventListener("load", e.ready, !1); else if (c.attachEvent) {
                    c.attachEvent("onreadystatechange", B), a.attachEvent("onload", e.ready);
                    var b = !1;
                    try {
                        b = a.frameElement == null
                    } catch (d) {
                    }
                    c.documentElement.doScroll && b && J()
                }
            }
        }, isFunction: function (a) {
            return e.type(a) === "function"
        }, isArray: Array.isArray || function (a) {
            return e.type(a) === "array"
        }, isWindow: function (a) {
            return a && typeof a == "object" && "setInterval"in a
        }, isNumeric: function (a) {
            return!isNaN(parseFloat(a)) && isFinite(a)
        }, type: function (a) {
            return a == null ? String(a) : I[C.call(a)] || "object"
        }, isPlainObject: function (a) {
            if (!a || e.type(a) !== "object" || a.nodeType || e.isWindow(a))return!1;
            try {
                if (a.constructor && !D.call(a, "constructor") && !D.call(a.constructor.prototype, "isPrototypeOf"))return!1
            } catch (c) {
                return!1
            }
            var d;
            for (d in a);
            return d === b || D.call(a, d)
        }, isEmptyObject: function (a) {
            for (var b in a)return!1;
            return!0
        }, error: function (a) {
            throw new Error(a)
        }, parseJSON: function (b) {
            if (typeof b != "string" || !b)return null;
            b = e.trim(b);
            if (a.JSON && a.JSON.parse)return a.JSON.parse(b);
            if (n.test(b.replace(o, "@").replace(p, "]").replace(q, "")))return(new Function("return " + b))();
            e.error("Invalid JSON: " + b)
        }, parseXML: function (c) {
            var d, f;
            try {
                a.DOMParser ? (f = new DOMParser, d = f.parseFromString(c, "text/xml")) : (d = new ActiveXObject("Microsoft.XMLDOM"), d.async = "false", d.loadXML(c))
            } catch (g) {
                d = b
            }
            (!d || !d.documentElement || d.getElementsByTagName("parsererror").length) && e.error("Invalid XML: " + c);
            return d
        }, noop: function () {
        }, globalEval: function (b) {
            b && j.test(b) && (a.execScript || function (b) {
                a.eval.call(a, b)
            })(b)
        }, camelCase: function (a) {
            return a.replace(w, "ms-").replace(v, x)
        }, nodeName: function (a, b) {
            return a.nodeName && a.nodeName.toUpperCase() === b.toUpperCase()
        }, each: function (a, c, d) {
            var f, g = 0, h = a.length, i = h === b || e.isFunction(a);
            if (d) {
                if (i) {
                    for (f in a)if (c.apply(a[f], d) === !1)break
                } else for (; g < h;)if (c.apply(a[g++], d) === !1)break
            } else if (i) {
                for (f in a)if (c.call(a[f], f, a[f]) === !1)break
            } else for (; g < h;)if (c.call(a[g], g, a[g++]) === !1)break;
            return a
        }, trim: G ? function (a) {
            return a == null ? "" : G.call(a)
        } : function (a) {
            return a == null ? "" : (a + "").replace(k, "").replace(l, "")
        }, makeArray: function (a, b) {
            var c = b || [];
            if (a != null) {
                var d = e.type(a);
                a.length == null || d === "string" || d === "function" || d === "regexp" || e.isWindow(a) ? E.call(c, a) : e.merge(c, a)
            }
            return c
        }, inArray: function (a, b, c) {
            var d;
            if (b) {
                if (H)return H.call(b, a, c);
                d = b.length, c = c ? c < 0 ? Math.max(0, d + c) : c : 0;
                for (; c < d; c++)if (c in b && b[c] === a)return c
            }
            return-1
        }, merge: function (a, c) {
            var d = a.length, e = 0;
            if (typeof c.length == "number")for (var f = c.length; e < f; e++)a[d++] = c[e]; else while (c[e] !== b)a[d++] = c[e++];
            a.length = d;
            return a
        }, grep: function (a, b, c) {
            var d = [], e;
            c = !!c;
            for (var f = 0, g = a.length; f < g; f++)e = !!b(a[f], f), c !== e && d.push(a[f]);
            return d
        }, map: function (a, c, d) {
            var f, g, h = [], i = 0, j = a.length, k = a instanceof e || j !== b && typeof j == "number" && (j > 0 && a[0] && a[j - 1] || j === 0 || e.isArray(a));
            if (k)for (; i < j; i++)f = c(a[i], i, d), f != null && (h[h.length] = f); else for (g in a)f = c(a[g], g, d), f != null && (h[h.length] = f);
            return h.concat.apply([], h)
        }, guid: 1, proxy: function (a, c) {
            if (typeof c == "string") {
                var d = a[c];
                c = a, a = d
            }
            if (!e.isFunction(a))return b;
            var f = F.call(arguments, 2), g = function () {
                return a.apply(c, f.concat(F.call(arguments)))
            };
            g.guid = a.guid = a.guid || g.guid || e.guid++;
            return g
        }, access: function (a, c, d, f, g, h) {
            var i = a.length;
            if (typeof c == "object") {
                for (var j in c)e.access(a, j, c[j], f, g, d);
                return a
            }
            if (d !== b) {
                f = !h && f && e.isFunction(d);
                for (var k = 0; k < i; k++)g(a[k], c, f ? d.call(a[k], k, g(a[k], c)) : d, h);
                return a
            }
            return i ? g(a[0], c) : b
        }, now: function () {
            return(new Date).getTime()
        }, uaMatch: function (a) {
            a = a.toLowerCase();
            var b = r.exec(a) || s.exec(a) || t.exec(a) || a.indexOf("compatible") < 0 && u.exec(a) || [];
            return{browser: b[1] || "", version: b[2] || "0"}
        }, sub: function () {
            function a(b, c) {
                return new a.fn.init(b, c)
            }

            e.extend(!0, a, this), a.superclass = this, a.fn = a.prototype = this(), a.fn.constructor = a, a.sub = this.sub, a.fn.init = function (d, f) {
                f && f instanceof e && !(f instanceof a) && (f = a(f));
                return e.fn.init.call(this, d, f, b)
            }, a.fn.init.prototype = a.fn;
            var b = a(c);
            return a
        }, browser: {}}), e.each("Boolean Number String Function Array Date RegExp Object".split(" "), function (a, b) {
            I["[object " + b + "]"] = b.toLowerCase()
        }), z = e.uaMatch(y), z.browser && (e.browser[z.browser] = !0, e.browser.version = z.version), e.browser.webkit && (e.browser.safari = !0), j.test(" ") && (k = /^[\s\xA0]+/, l = /[\s\xA0]+$/), h = e(c), c.addEventListener ? B = function () {
            c.removeEventListener("DOMContentLoaded", B, !1), e.ready()
        } : c.attachEvent && (B = function () {
            c.readyState === "complete" && (c.detachEvent("onreadystatechange", B), e.ready())
        });
        return e
    }(), g = {};
    f.Callbacks = function (a) {
        a = a ? g[a] || h(a) : {};
        var c = [], d = [], e, i, j, k, l, m = function (b) {
            var d, e, g, h, i;
            for (d = 0, e = b.length; d < e; d++)g = b[d], h = f.type(g), h === "array" ? m(g) : h === "function" && (!a.unique || !o.has(g)) && c.push(g)
        }, n = function (b, f) {
            f = f || [], e = !a.memory || [b, f], i = !0, l = j || 0, j = 0, k = c.length;
            for (; c && l < k; l++)if (c[l].apply(b, f) === !1 && a.stopOnFalse) {
                e = !0;
                break
            }
            i = !1, c && (a.once ? e === !0 ? o.disable() : c = [] : d && d.length && (e = d.shift(), o.fireWith(e[0], e[1])))
        }, o = {add: function () {
            if (c) {
                var a = c.length;
                m(arguments), i ? k = c.length : e && e !== !0 && (j = a, n(e[0], e[1]))
            }
            return this
        }, remove: function () {
            if (c) {
                var b = arguments, d = 0, e = b.length;
                for (; d < e; d++)for (var f = 0; f < c.length; f++)if (b[d] === c[f]) {
                    i && f <= k && (k--, f <= l && l--), c.splice(f--, 1);
                    if (a.unique)break
                }
            }
            return this
        }, has: function (a) {
            if (c) {
                var b = 0, d = c.length;
                for (; b < d; b++)if (a === c[b])return!0
            }
            return!1
        }, empty: function () {
            c = [];
            return this
        }, disable: function () {
            c = d = e = b;
            return this
        }, disabled: function () {
            return!c
        }, lock: function () {
            d = b, (!e || e === !0) && o.disable();
            return this
        }, locked: function () {
            return!d
        }, fireWith: function (b, c) {
            d && (i ? a.once || d.push([b, c]) : (!a.once || !e) && n(b, c));
            return this
        }, fire: function () {
            o.fireWith(this, arguments);
            return this
        }, fired: function () {
            return!!e
        }};
        return o
    };
    var i = [].slice;
    f.extend({Deferred: function (a) {
        var b = f.Callbacks("once memory"), c = f.Callbacks("once memory"), d = f.Callbacks("memory"), e = "pending", g = {resolve: b, reject: c, notify: d}, h = {done: b.add, fail: c.add, progress: d.add, state: function () {
            return e
        }, isResolved: b.fired, isRejected: c.fired, then: function (a, b, c) {
            i.done(a).fail(b).progress(c);
            return this
        }, always: function () {
            i.done.apply(i, arguments).fail.apply(i, arguments);
            return this
        }, pipe: function (a, b, c) {
            return f.Deferred(function (d) {
                f.each({done: [a, "resolve"], fail: [b, "reject"], progress: [c, "notify"]}, function (a, b) {
                    var c = b[0], e = b[1], g;
                    f.isFunction(c) ? i[a](function () {
                        g = c.apply(this, arguments), g && f.isFunction(g.promise) ? g.promise().then(d.resolve, d.reject, d.notify) : d[e + "With"](this === i ? d : this, [g])
                    }) : i[a](d[e])
                })
            }).promise()
        }, promise: function (a) {
            if (a == null)a = h; else for (var b in h)a[b] = h[b];
            return a
        }}, i = h.promise({}), j;
        for (j in g)i[j] = g[j].fire, i[j + "With"] = g[j].fireWith;
        i.done(function () {
            e = "resolved"
        }, c.disable, d.lock).fail(function () {
            e = "rejected"
        }, b.disable, d.lock), a && a.call(i, i);
        return i
    }, when: function (a) {
        function m(a) {
            return function (b) {
                e[a] = arguments.length > 1 ? i.call(arguments, 0) : b, j.notifyWith(k, e)
            }
        }

        function l(a) {
            return function (c) {
                b[a] = arguments.length > 1 ? i.call(arguments, 0) : c, --g || j.resolveWith(j, b)
            }
        }

        var b = i.call(arguments, 0), c = 0, d = b.length, e = Array(d), g = d, h = d, j = d <= 1 && a && f.isFunction(a.promise) ? a : f.Deferred(), k = j.promise();
        if (d > 1) {
            for (; c < d; c++)b[c] && b[c].promise && f.isFunction(b[c].promise) ? b[c].promise().then(l(c), j.reject, m(c)) : --g;
            g || j.resolveWith(j, b)
        } else j !== a && j.resolveWith(j, d ? [a] : []);
        return k
    }}), f.support = function () {
        var b, d, e, g, h, i, j, k, l, m, n, o, p, q = c.createElement("div"), r = c.documentElement;
        q.setAttribute("className", "t"), q.innerHTML = "   <link/><table></table><a href='/a' style='top:1px;float:left;opacity:.55;'>a</a><input type='checkbox'/>", d = q.getElementsByTagName("*"), e = q.getElementsByTagName("a")[0];
        if (!d || !d.length || !e)return{};
        g = c.createElement("select"), h = g.appendChild(c.createElement("option")), i = q.getElementsByTagName("input")[0], b = {leadingWhitespace: q.firstChild.nodeType === 3, tbody: !q.getElementsByTagName("tbody").length, htmlSerialize: !!q.getElementsByTagName("link").length, style: /top/.test(e.getAttribute("style")), hrefNormalized: e.getAttribute("href") === "/a", opacity: /^0.55/.test(e.style.opacity), cssFloat: !!e.style.cssFloat, checkOn: i.value === "on", optSelected: h.selected, getSetAttribute: q.className !== "t", enctype: !!c.createElement("form").enctype, html5Clone: c.createElement("nav").cloneNode(!0).outerHTML !== "<:nav></:nav>", submitBubbles: !0, changeBubbles: !0, focusinBubbles: !1, deleteExpando: !0, noCloneEvent: !0, inlineBlockNeedsLayout: !1, shrinkWrapBlocks: !1, reliableMarginRight: !0}, i.checked = !0, b.noCloneChecked = i.cloneNode(!0).checked, g.disabled = !0, b.optDisabled = !h.disabled;
        try {
            delete q.test
        } catch (s) {
            b.deleteExpando = !1
        }
        !q.addEventListener && q.attachEvent && q.fireEvent && (q.attachEvent("onclick", function () {
            b.noCloneEvent = !1
        }), q.cloneNode(!0).fireEvent("onclick")), i = c.createElement("input"), i.value = "t", i.setAttribute("type", "radio"), b.radioValue = i.value === "t", i.setAttribute("checked", "checked"), q.appendChild(i), k = c.createDocumentFragment(), k.appendChild(q.lastChild), b.checkClone = k.cloneNode(!0).cloneNode(!0).lastChild.checked, b.appendChecked = i.checked, k.removeChild(i), k.appendChild(q), q.innerHTML = "", a.getComputedStyle && (j = c.createElement("div"), j.style.width = "0", j.style.marginRight = "0", q.style.width = "2px", q.appendChild(j), b.reliableMarginRight = (parseInt((a.getComputedStyle(j, null) || {marginRight: 0}).marginRight, 10) || 0) === 0);
        if (q.attachEvent)for (o in{submit: 1, change: 1, focusin: 1})n = "on" + o, p = n in q, p || (q.setAttribute(n, "return;"), p = typeof q[n] == "function"), b[o + "Bubbles"] = p;
        k.removeChild(q), k = g = h = j = q = i = null, f(function () {
            var a, d, e, g, h, i, j, k, m, n, o, r = c.getElementsByTagName("body")[0];
            !r || (j = 1, k = "position:absolute;top:0;left:0;width:1px;height:1px;margin:0;", m = "visibility:hidden;border:0;", n = "style='" + k + "border:5px solid #000;padding:0;'", o = "<div " + n + "><div></div></div>" + "<table " + n + " cellpadding='0' cellspacing='0'>" + "<tr><td></td></tr></table>", a = c.createElement("div"), a.style.cssText = m + "width:0;height:0;position:static;top:0;margin-top:" + j + "px", r.insertBefore(a, r.firstChild), q = c.createElement("div"), a.appendChild(q), q.innerHTML = "<table><tr><td style='padding:0;border:0;display:none'></td><td>t</td></tr></table>", l = q.getElementsByTagName("td"), p = l[0].offsetHeight === 0, l[0].style.display = "", l[1].style.display = "none", b.reliableHiddenOffsets = p && l[0].offsetHeight === 0, q.innerHTML = "", q.style.width = q.style.paddingLeft = "1px", f.boxModel = b.boxModel = q.offsetWidth === 2, typeof q.style.zoom != "undefined" && (q.style.display = "inline", q.style.zoom = 1, b.inlineBlockNeedsLayout = q.offsetWidth === 2, q.style.display = "", q.innerHTML = "<div style='width:4px;'></div>", b.shrinkWrapBlocks = q.offsetWidth !== 2), q.style.cssText = k + m, q.innerHTML = o, d = q.firstChild, e = d.firstChild, h = d.nextSibling.firstChild.firstChild, i = {doesNotAddBorder: e.offsetTop !== 5, doesAddBorderForTableAndCells: h.offsetTop === 5}, e.style.position = "fixed", e.style.top = "20px", i.fixedPosition = e.offsetTop === 20 || e.offsetTop === 15, e.style.position = e.style.top = "", d.style.overflow = "hidden", d.style.position = "relative", i.subtractsBorderForOverflowNotVisible = e.offsetTop === -5, i.doesNotIncludeMarginInBodyOffset = r.offsetTop !== j, r.removeChild(a), q = a = null, f.extend(b, i))
        });
        return b
    }();
    var j = /^(?:\{.*\}|\[.*\])$/, k = /([A-Z])/g;
    f.extend({cache: {}, uuid: 0, expando: "jQuery" + (f.fn.jquery + Math.random()).replace(/\D/g, ""), noData: {embed: !0, object: "clsid:D27CDB6E-AE6D-11cf-96B8-444553540000", applet: !0}, hasData: function (a) {
        a = a.nodeType ? f.cache[a[f.expando]] : a[f.expando];
        return!!a && !m(a)
    }, data: function (a, c, d, e) {
        if (!!f.acceptData(a)) {
            var g, h, i, j = f.expando, k = typeof c == "string", l = a.nodeType, m = l ? f.cache : a, n = l ? a[j] : a[j] && j, o = c === "events";
            if ((!n || !m[n] || !o && !e && !m[n].data) && k && d === b)return;
            n || (l ? a[j] = n = ++f.uuid : n = j), m[n] || (m[n] = {}, l || (m[n].toJSON = f.noop));
            if (typeof c == "object" || typeof c == "function")e ? m[n] = f.extend(m[n], c) : m[n].data = f.extend(m[n].data, c);
            g = h = m[n], e || (h.data || (h.data = {}), h = h.data), d !== b && (h[f.camelCase(c)] = d);
            if (o && !h[c])return g.events;
            k ? (i = h[c], i == null && (i = h[f.camelCase(c)])) : i = h;
            return i
        }
    }, removeData: function (a, b, c) {
        if (!!f.acceptData(a)) {
            var d, e, g, h = f.expando, i = a.nodeType, j = i ? f.cache : a, k = i ? a[h] : h;
            if (!j[k])return;
            if (b) {
                d = c ? j[k] : j[k].data;
                if (d) {
                    f.isArray(b) || (b in d ? b = [b] : (b = f.camelCase(b), b in d ? b = [b] : b = b.split(" ")));
                    for (e = 0, g = b.length; e < g; e++)delete d[b[e]];
                    if (!(c ? m : f.isEmptyObject)(d))return
                }
            }
            if (!c) {
                delete j[k].data;
                if (!m(j[k]))return
            }
            f.support.deleteExpando || !j.setInterval ? delete j[k] : j[k] = null, i && (f.support.deleteExpando ? delete a[h] : a.removeAttribute ? a.removeAttribute(h) : a[h] = null)
        }
    }, _data: function (a, b, c) {
        return f.data(a, b, c, !0)
    }, acceptData: function (a) {
        if (a.nodeName) {
            var b = f.noData[a.nodeName.toLowerCase()];
            if (b)return b !== !0 && a.getAttribute("classid") === b
        }
        return!0
    }}), f.fn.extend({data: function (a, c) {
        var d, e, g, h = null;
        if (typeof a == "undefined") {
            if (this.length) {
                h = f.data(this[0]);
                if (this[0].nodeType === 1 && !f._data(this[0], "parsedAttrs")) {
                    e = this[0].attributes;
                    for (var i = 0, j = e.length; i < j; i++)g = e[i].name, g.indexOf("data-") === 0 && (g = f.camelCase(g.substring(5)), l(this[0], g, h[g]));
                    f._data(this[0], "parsedAttrs", !0)
                }
            }
            return h
        }
        if (typeof a == "object")return this.each(function () {
            f.data(this, a)
        });
        d = a.split("."), d[1] = d[1] ? "." + d[1] : "";
        if (c === b) {
            h = this.triggerHandler("getData" + d[1] + "!", [d[0]]), h === b && this.length && (h = f.data(this[0], a), h = l(this[0], a, h));
            return h === b && d[1] ? this.data(d[0]) : h
        }
        return this.each(function () {
            var b = f(this), e = [d[0], c];
            b.triggerHandler("setData" + d[1] + "!", e), f.data(this, a, c), b.triggerHandler("changeData" + d[1] + "!", e)
        })
    }, removeData: function (a) {
        return this.each(function () {
            f.removeData(this, a)
        })
    }}), f.extend({_mark: function (a, b) {
        a && (b = (b || "fx") + "mark", f._data(a, b, (f._data(a, b) || 0) + 1))
    }, _unmark: function (a, b, c) {
        a !== !0 && (c = b, b = a, a = !1);
        if (b) {
            c = c || "fx";
            var d = c + "mark", e = a ? 0 : (f._data(b, d) || 1) - 1;
            e ? f._data(b, d, e) : (f.removeData(b, d, !0), n(b, c, "mark"))
        }
    }, queue: function (a, b, c) {
        var d;
        if (a) {
            b = (b || "fx") + "queue", d = f._data(a, b), c && (!d || f.isArray(c) ? d = f._data(a, b, f.makeArray(c)) : d.push(c));
            return d || []
        }
    }, dequeue: function (a, b) {
        b = b || "fx";
        var c = f.queue(a, b), d = c.shift(), e = {};
        d === "inprogress" && (d = c.shift()), d && (b === "fx" && c.unshift("inprogress"), f._data(a, b + ".run", e), d.call(a, function () {
            f.dequeue(a, b)
        }, e)), c.length || (f.removeData(a, b + "queue " + b + ".run", !0), n(a, b, "queue"))
    }}), f.fn.extend({queue: function (a, c) {
        typeof a != "string" && (c = a, a = "fx");
        if (c === b)return f.queue(this[0], a);
        return this.each(function () {
            var b = f.queue(this, a, c);
            a === "fx" && b[0] !== "inprogress" && f.dequeue(this, a)
        })
    }, dequeue: function (a) {
        return this.each(function () {
            f.dequeue(this, a)
        })
    }, delay: function (a, b) {
        a = f.fx ? f.fx.speeds[a] || a : a, b = b || "fx";
        return this.queue(b, function (b, c) {
            var d = setTimeout(b, a);
            c.stop = function () {
                clearTimeout(d)
            }
        })
    }, clearQueue: function (a) {
        return this.queue(a || "fx", [])
    }, promise: function (a, c) {
        function m() {
            --h || d.resolveWith(e, [e])
        }

        typeof a != "string" && (c = a, a = b), a = a || "fx";
        var d = f.Deferred(), e = this, g = e.length, h = 1, i = a + "defer", j = a + "queue", k = a + "mark", l;
        while (g--)if (l = f.data(e[g], i, b, !0) || (f.data(e[g], j, b, !0) || f.data(e[g], k, b, !0)) && f.data(e[g], i, f.Callbacks("once memory"), !0))h++, l.add(m);
        m();
        return d.promise()
    }});
    var o = /[\n\t\r]/g, p = /\s+/, q = /\r/g, r = /^(?:button|input)$/i, s = /^(?:button|input|object|select|textarea)$/i, t = /^a(?:rea)?$/i, u = /^(?:autofocus|autoplay|async|checked|controls|defer|disabled|hidden|loop|multiple|open|readonly|required|scoped|selected)$/i, v = f.support.getSetAttribute, w, x, y;
    f.fn.extend({attr: function (a, b) {
        return f.access(this, a, b, !0, f.attr)
    }, removeAttr: function (a) {
        return this.each(function () {
            f.removeAttr(this, a)
        })
    }, prop: function (a, b) {
        return f.access(this, a, b, !0, f.prop)
    }, removeProp: function (a) {
        a = f.propFix[a] || a;
        return this.each(function () {
            try {
                this[a] = b, delete this[a]
            } catch (c) {
            }
        })
    }, addClass: function (a) {
        var b, c, d, e, g, h, i;
        if (f.isFunction(a))return this.each(function (b) {
            f(this).addClass(a.call(this, b, this.className))
        });
        if (a && typeof a == "string") {
            b = a.split(p);
            for (c = 0, d = this.length; c < d; c++) {
                e = this[c];
                if (e.nodeType === 1)if (!e.className && b.length === 1)e.className = a; else {
                    g = " " + e.className + " ";
                    for (h = 0, i = b.length; h < i; h++)~g.indexOf(" " + b[h] + " ") || (g += b[h] + " ");
                    e.className = f.trim(g)
                }
            }
        }
        return this
    }, removeClass: function (a) {
        var c, d, e, g, h, i, j;
        if (f.isFunction(a))return this.each(function (b) {
            f(this).removeClass(a.call(this, b, this.className))
        });
        if (a && typeof a == "string" || a === b) {
            c = (a || "").split(p);
            for (d = 0, e = this.length; d < e; d++) {
                g = this[d];
                if (g.nodeType === 1 && g.className)if (a) {
                    h = (" " + g.className + " ").replace(o, " ");
                    for (i = 0, j = c.length; i < j; i++)h = h.replace(" " + c[i] + " ", " ");
                    g.className = f.trim(h)
                } else g.className = ""
            }
        }
        return this
    }, toggleClass: function (a, b) {
        var c = typeof a, d = typeof b == "boolean";
        if (f.isFunction(a))return this.each(function (c) {
            f(this).toggleClass(a.call(this, c, this.className, b), b)
        });
        return this.each(function () {
            if (c === "string") {
                var e, g = 0, h = f(this), i = b, j = a.split(p);
                while (e = j[g++])i = d ? i : !h.hasClass(e), h[i ? "addClass" : "removeClass"](e)
            } else if (c === "undefined" || c === "boolean")this.className && f._data(this, "__className__", this.className), this.className = this.className || a === !1 ? "" : f._data(this, "__className__") || ""
        })
    }, hasClass: function (a) {
        var b = " " + a + " ", c = 0, d = this.length;
        for (; c < d; c++)if (this[c].nodeType === 1 && (" " + this[c].className + " ").replace(o, " ").indexOf(b) > -1)return!0;
        return!1
    }, val: function (a) {
        var c, d, e, g = this[0];
        {
            if (!!arguments.length) {
                e = f.isFunction(a);
                return this.each(function (d) {
                    var g = f(this), h;
                    if (this.nodeType === 1) {
                        e ? h = a.call(this, d, g.val()) : h = a, h == null ? h = "" : typeof h == "number" ? h += "" : f.isArray(h) && (h = f.map(h, function (a) {
                            return a == null ? "" : a + ""
                        })), c = f.valHooks[this.nodeName.toLowerCase()] || f.valHooks[this.type];
                        if (!c || !("set"in c) || c.set(this, h, "value") === b)this.value = h
                    }
                })
            }
            if (g) {
                c = f.valHooks[g.nodeName.toLowerCase()] || f.valHooks[g.type];
                if (c && "get"in c && (d = c.get(g, "value")) !== b)return d;
                d = g.value;
                return typeof d == "string" ? d.replace(q, "") : d == null ? "" : d
            }
        }
    }}), f.extend({valHooks: {option: {get: function (a) {
        var b = a.attributes.value;
        return!b || b.specified ? a.value : a.text
    }}, select: {get: function (a) {
        var b, c, d, e, g = a.selectedIndex, h = [], i = a.options, j = a.type === "select-one";
        if (g < 0)return null;
        c = j ? g : 0, d = j ? g + 1 : i.length;
        for (; c < d; c++) {
            e = i[c];
            if (e.selected && (f.support.optDisabled ? !e.disabled : e.getAttribute("disabled") === null) && (!e.parentNode.disabled || !f.nodeName(e.parentNode, "optgroup"))) {
                b = f(e).val();
                if (j)return b;
                h.push(b)
            }
        }
        if (j && !h.length && i.length)return f(i[g]).val();
        return h
    }, set: function (a, b) {
        var c = f.makeArray(b);
        f(a).find("option").each(function () {
            this.selected = f.inArray(f(this).val(), c) >= 0
        }), c.length || (a.selectedIndex = -1);
        return c
    }}}, attrFn: {val: !0, css: !0, html: !0, text: !0, data: !0, width: !0, height: !0, offset: !0}, attr: function (a, c, d, e) {
        var g, h, i, j = a.nodeType;
        if (!!a && j !== 3 && j !== 8 && j !== 2) {
            if (e && c in f.attrFn)return f(a)[c](d);
            if (typeof a.getAttribute == "undefined")return f.prop(a, c, d);
            i = j !== 1 || !f.isXMLDoc(a), i && (c = c.toLowerCase(), h = f.attrHooks[c] || (u.test(c) ? x : w));
            if (d !== b) {
                if (d === null) {
                    f.removeAttr(a, c);
                    return
                }
                if (h && "set"in h && i && (g = h.set(a, d, c)) !== b)return g;
                a.setAttribute(c, "" + d);
                return d
            }
            if (h && "get"in h && i && (g = h.get(a, c)) !== null)return g;
            g = a.getAttribute(c);
            return g === null ? b : g
        }
    }, removeAttr: function (a, b) {
        var c, d, e, g, h = 0;
        if (b && a.nodeType === 1) {
            d = b.toLowerCase().split(p), g = d.length;
            for (; h < g; h++)e = d[h], e && (c = f.propFix[e] || e, f.attr(a, e, ""), a.removeAttribute(v ? e : c), u.test(e) && c in a && (a[c] = !1))
        }
    }, attrHooks: {type: {set: function (a, b) {
        if (r.test(a.nodeName) && a.parentNode)f.error("type property can't be changed"); else if (!f.support.radioValue && b === "radio" && f.nodeName(a, "input")) {
            var c = a.value;
            a.setAttribute("type", b), c && (a.value = c);
            return b
        }
    }}, value: {get: function (a, b) {
        if (w && f.nodeName(a, "button"))return w.get(a, b);
        return b in a ? a.value : null
    }, set: function (a, b, c) {
        if (w && f.nodeName(a, "button"))return w.set(a, b, c);
        a.value = b
    }}}, propFix: {tabindex: "tabIndex", readonly: "readOnly", "for": "htmlFor", "class": "className", maxlength: "maxLength", cellspacing: "cellSpacing", cellpadding: "cellPadding", rowspan: "rowSpan", colspan: "colSpan", usemap: "useMap", frameborder: "frameBorder", contenteditable: "contentEditable"}, prop: function (a, c, d) {
        var e, g, h, i = a.nodeType;
        if (!!a && i !== 3 && i !== 8 && i !== 2) {
            h = i !== 1 || !f.isXMLDoc(a), h && (c = f.propFix[c] || c, g = f.propHooks[c]);
            return d !== b ? g && "set"in g && (e = g.set(a, d, c)) !== b ? e : a[c] = d : g && "get"in g && (e = g.get(a, c)) !== null ? e : a[c]
        }
    }, propHooks: {tabIndex: {get: function (a) {
        var c = a.getAttributeNode("tabindex");
        return c && c.specified ? parseInt(c.value, 10) : s.test(a.nodeName) || t.test(a.nodeName) && a.href ? 0 : b
    }}}}), f.attrHooks.tabindex = f.propHooks.tabIndex, x = {get: function (a, c) {
        var d, e = f.prop(a, c);
        return e === !0 || typeof e != "boolean" && (d = a.getAttributeNode(c)) && d.nodeValue !== !1 ? c.toLowerCase() : b
    }, set: function (a, b, c) {
        var d;
        b === !1 ? f.removeAttr(a, c) : (d = f.propFix[c] || c, d in a && (a[d] = !0), a.setAttribute(c, c.toLowerCase()));
        return c
    }}, v || (y = {name: !0, id: !0}, w = f.valHooks.button = {get: function (a, c) {
        var d;
        d = a.getAttributeNode(c);
        return d && (y[c] ? d.nodeValue !== "" : d.specified) ? d.nodeValue : b
    }, set: function (a, b, d) {
        var e = a.getAttributeNode(d);
        e || (e = c.createAttribute(d), a.setAttributeNode(e));
        return e.nodeValue = b + ""
    }}, f.attrHooks.tabindex.set = w.set, f.each(["width", "height"], function (a, b) {
        f.attrHooks[b] = f.extend(f.attrHooks[b], {set: function (a, c) {
            if (c === "") {
                a.setAttribute(b, "auto");
                return c
            }
        }})
    }), f.attrHooks.contenteditable = {get: w.get, set: function (a, b, c) {
        b === "" && (b = "false"), w.set(a, b, c)
    }}), f.support.hrefNormalized || f.each(["href", "src", "width", "height"], function (a, c) {
        f.attrHooks[c] = f.extend(f.attrHooks[c], {get: function (a) {
            var d = a.getAttribute(c, 2);
            return d === null ? b : d
        }})
    }), f.support.style || (f.attrHooks.style = {get: function (a) {
        return a.style.cssText.toLowerCase() || b
    }, set: function (a, b) {
        return a.style.cssText = "" + b
    }}), f.support.optSelected || (f.propHooks.selected = f.extend(f.propHooks.selected, {get: function (a) {
        var b = a.parentNode;
        b && (b.selectedIndex, b.parentNode && b.parentNode.selectedIndex);
        return null
    }})), f.support.enctype || (f.propFix.enctype = "encoding"), f.support.checkOn || f.each(["radio", "checkbox"], function () {
        f.valHooks[this] = {get: function (a) {
            return a.getAttribute("value") === null ? "on" : a.value
        }}
    }), f.each(["radio", "checkbox"], function () {
        f.valHooks[this] = f.extend(f.valHooks[this], {set: function (a, b) {
            if (f.isArray(b))return a.checked = f.inArray(f(a).val(), b) >= 0
        }})
    });
    var z = /^(?:textarea|input|select)$/i, A = /^([^\.]*)?(?:\.(.+))?$/, B = /\bhover(\.\S+)?\b/, C = /^key/, D = /^(?:mouse|contextmenu)|click/, E = /^(?:focusinfocus|focusoutblur)$/, F = /^(\w*)(?:#([\w\-]+))?(?:\.([\w\-]+))?$/, G = function (a) {
        var b = F.exec(a);
        b && (b[1] = (b[1] || "").toLowerCase(), b[3] = b[3] && new RegExp("(?:^|\\s)" + b[3] + "(?:\\s|$)"));
        return b
    }, H = function (a, b) {
        var c = a.attributes || {};
        return(!b[1] || a.nodeName.toLowerCase() === b[1]) && (!b[2] || (c.id || {}).value === b[2]) && (!b[3] || b[3].test((c["class"] || {}).value))
    }, I = function (a) {
        return f.event.special.hover ? a : a.replace(B, "mouseenter$1 mouseleave$1")
    };
    f.event = {add: function (a, c, d, e, g) {
        var h, i, j, k, l, m, n, o, p, q, r, s;
        if (!(a.nodeType === 3 || a.nodeType === 8 || !c || !d || !(h = f._data(a)))) {
            d.handler && (p = d, d = p.handler), d.guid || (d.guid = f.guid++), j = h.events, j || (h.events = j = {}), i = h.handle, i || (h.handle = i = function (a) {
                return typeof f != "undefined" && (!a || f.event.triggered !== a.type) ? f.event.dispatch.apply(i.elem, arguments) : b
            }, i.elem = a), c = f.trim(I(c)).split(" ");
            for (k = 0; k < c.length; k++) {
                l = A.exec(c[k]) || [], m = l[1], n = (l[2] || "").split(".").sort(), s = f.event.special[m] || {}, m = (g ? s.delegateType : s.bindType) || m, s = f.event.special[m] || {}, o = f.extend({type: m, origType: l[1], data: e, handler: d, guid: d.guid, selector: g, quick: G(g), namespace: n.join(".")}, p), r = j[m];
                if (!r) {
                    r = j[m] = [], r.delegateCount = 0;
                    if (!s.setup || s.setup.call(a, e, n, i) === !1)a.addEventListener ? a.addEventListener(m, i, !1) : a.attachEvent && a.attachEvent("on" + m, i)
                }
                s.add && (s.add.call(a, o), o.handler.guid || (o.handler.guid = d.guid)), g ? r.splice(r.delegateCount++, 0, o) : r.push(o), f.event.global[m] = !0
            }
            a = null
        }
    }, global: {}, remove: function (a, b, c, d, e) {
        var g = f.hasData(a) && f._data(a), h, i, j, k, l, m, n, o, p, q, r, s;
        if (!!g && !!(o = g.events)) {
            b = f.trim(I(b || "")).split(" ");
            for (h = 0; h < b.length; h++) {
                i = A.exec(b[h]) || [], j = k = i[1], l = i[2];
                if (!j) {
                    for (j in o)f.event.remove(a, j + b[h], c, d, !0);
                    continue
                }
                p = f.event.special[j] || {}, j = (d ? p.delegateType : p.bindType) || j, r = o[j] || [], m = r.length, l = l ? new RegExp("(^|\\.)" + l.split(".").sort().join("\\.(?:.*\\.)?") + "(\\.|$)") : null;
                for (n = 0; n < r.length; n++)s = r[n], (e || k === s.origType) && (!c || c.guid === s.guid) && (!l || l.test(s.namespace)) && (!d || d === s.selector || d === "**" && s.selector) && (r.splice(n--, 1), s.selector && r.delegateCount--, p.remove && p.remove.call(a, s));
                r.length === 0 && m !== r.length && ((!p.teardown || p.teardown.call(a, l) === !1) && f.removeEvent(a, j, g.handle), delete o[j])
            }
            f.isEmptyObject(o) && (q = g.handle, q && (q.elem = null), f.removeData(a, ["events", "handle"], !0))
        }
    }, customEvent: {getData: !0, setData: !0, changeData: !0}, trigger: function (c, d, e, g) {
        if (!e || e.nodeType !== 3 && e.nodeType !== 8) {
            var h = c.type || c, i = [], j, k, l, m, n, o, p, q, r, s;
            if (E.test(h + f.event.triggered))return;
            h.indexOf("!") >= 0 && (h = h.slice(0, -1), k = !0), h.indexOf(".") >= 0 && (i = h.split("."), h = i.shift(), i.sort());
            if ((!e || f.event.customEvent[h]) && !f.event.global[h])return;
            c = typeof c == "object" ? c[f.expando] ? c : new f.Event(h, c) : new f.Event(h), c.type = h, c.isTrigger = !0, c.exclusive = k, c.namespace = i.join("."), c.namespace_re = c.namespace ? new RegExp("(^|\\.)" + i.join("\\.(?:.*\\.)?") + "(\\.|$)") : null, o = h.indexOf(":") < 0 ? "on" + h : "";
            if (!e) {
                j = f.cache;
                for (l in j)j[l].events && j[l].events[h] && f.event.trigger(c, d, j[l].handle.elem, !0);
                return
            }
            c.result = b, c.target || (c.target = e), d = d != null ? f.makeArray(d) : [], d.unshift(c), p = f.event.special[h] || {};
            if (p.trigger && p.trigger.apply(e, d) === !1)return;
            r = [
                [e, p.bindType || h]
            ];
            if (!g && !p.noBubble && !f.isWindow(e)) {
                s = p.delegateType || h, m = E.test(s + h) ? e : e.parentNode, n = null;
                for (; m; m = m.parentNode)r.push([m, s]), n = m;
                n && n === e.ownerDocument && r.push([n.defaultView || n.parentWindow || a, s])
            }
            for (l = 0; l < r.length && !c.isPropagationStopped(); l++)m = r[l][0], c.type = r[l][1], q = (f._data(m, "events") || {})[c.type] && f._data(m, "handle"), q && q.apply(m, d), q = o && m[o], q && f.acceptData(m) && q.apply(m, d) === !1 && c.preventDefault();
            c.type = h, !g && !c.isDefaultPrevented() && (!p._default || p._default.apply(e.ownerDocument, d) === !1) && (h !== "click" || !f.nodeName(e, "a")) && f.acceptData(e) && o && e[h] && (h !== "focus" && h !== "blur" || c.target.offsetWidth !== 0) && !f.isWindow(e) && (n = e[o], n && (e[o] = null), f.event.triggered = h, e[h](), f.event.triggered = b, n && (e[o] = n));
            return c.result
        }
    }, dispatch: function (c) {
        c = f.event.fix(c || a.event);
        var d = (f._data(this, "events") || {})[c.type] || [], e = d.delegateCount, g = [].slice.call(arguments, 0), h = !c.exclusive && !c.namespace, i = [], j, k, l, m, n, o, p, q, r, s, t;
        g[0] = c, c.delegateTarget = this;
        if (e && !c.target.disabled && (!c.button || c.type !== "click")) {
            m = f(this), m.context = this.ownerDocument || this;
            for (l = c.target; l != this; l = l.parentNode || this) {
                o = {}, q = [], m[0] = l;
                for (j = 0; j < e; j++)r = d[j], s = r.selector, o[s] === b && (o[s] = r.quick ? H(l, r.quick) : m.is(s)), o[s] && q.push(r);
                q.length && i.push({elem: l, matches: q})
            }
        }
        d.length > e && i.push({elem: this, matches: d.slice(e)});
        for (j = 0; j < i.length && !c.isPropagationStopped(); j++) {
            p = i[j], c.currentTarget = p.elem;
            for (k = 0; k < p.matches.length && !c.isImmediatePropagationStopped(); k++) {
                r = p.matches[k];
                if (h || !c.namespace && !r.namespace || c.namespace_re && c.namespace_re.test(r.namespace))c.data = r.data, c.handleObj = r, n = ((f.event.special[r.origType] || {}).handle || r.handler).apply(p.elem, g), n !== b && (c.result = n, n === !1 && (c.preventDefault(), c.stopPropagation()))
            }
        }
        return c.result
    }, props: "attrChange attrName relatedNode srcElement altKey bubbles cancelable ctrlKey currentTarget eventPhase metaKey relatedTarget shiftKey target timeStamp view which".split(" "), fixHooks: {}, keyHooks: {props: "char charCode key keyCode".split(" "), filter: function (a, b) {
        a.which == null && (a.which = b.charCode != null ? b.charCode : b.keyCode);
        return a
    }}, mouseHooks: {props: "button buttons clientX clientY fromElement offsetX offsetY pageX pageY screenX screenY toElement".split(" "), filter: function (a, d) {
        var e, f, g, h = d.button, i = d.fromElement;
        a.pageX == null && d.clientX != null && (e = a.target.ownerDocument || c, f = e.documentElement, g = e.body, a.pageX = d.clientX + (f && f.scrollLeft || g && g.scrollLeft || 0) - (f && f.clientLeft || g && g.clientLeft || 0), a.pageY = d.clientY + (f && f.scrollTop || g && g.scrollTop || 0) - (f && f.clientTop || g && g.clientTop || 0)), !a.relatedTarget && i && (a.relatedTarget = i === a.target ? d.toElement : i), !a.which && h !== b && (a.which = h & 1 ? 1 : h & 2 ? 3 : h & 4 ? 2 : 0);
        return a
    }}, fix: function (a) {
        if (a[f.expando])return a;
        var d, e, g = a, h = f.event.fixHooks[a.type] || {}, i = h.props ? this.props.concat(h.props) : this.props;
        a = f.Event(g);
        for (d = i.length; d;)e = i[--d], a[e] = g[e];
        a.target || (a.target = g.srcElement || c), a.target.nodeType === 3 && (a.target = a.target.parentNode), a.metaKey === b && (a.metaKey = a.ctrlKey);
        return h.filter ? h.filter(a, g) : a
    }, special: {ready: {setup: f.bindReady}, load: {noBubble: !0}, focus: {delegateType: "focusin"}, blur: {delegateType: "focusout"}, beforeunload: {setup: function (a, b, c) {
        f.isWindow(this) && (this.onbeforeunload = c)
    }, teardown: function (a, b) {
        this.onbeforeunload === b && (this.onbeforeunload = null)
    }}}, simulate: function (a, b, c, d) {
        var e = f.extend(new f.Event, c, {type: a, isSimulated: !0, originalEvent: {}});
        d ? f.event.trigger(e, null, b) : f.event.dispatch.call(b, e), e.isDefaultPrevented() && c.preventDefault()
    }}, f.event.handle = f.event.dispatch, f.removeEvent = c.removeEventListener ? function (a, b, c) {
        a.removeEventListener && a.removeEventListener(b, c, !1)
    } : function (a, b, c) {
        a.detachEvent && a.detachEvent("on" + b, c)
    }, f.Event = function (a, b) {
        if (!(this instanceof f.Event))return new f.Event(a, b);
        a && a.type ? (this.originalEvent = a, this.type = a.type, this.isDefaultPrevented = a.defaultPrevented || a.returnValue === !1 || a.getPreventDefault && a.getPreventDefault() ? K : J) : this.type = a, b && f.extend(this, b), this.timeStamp = a && a.timeStamp || f.now(), this[f.expando] = !0
    }, f.Event.prototype = {preventDefault: function () {
        this.isDefaultPrevented = K;
        var a = this.originalEvent;
        !a || (a.preventDefault ? a.preventDefault() : a.returnValue = !1)
    }, stopPropagation: function () {
        this.isPropagationStopped = K;
        var a = this.originalEvent;
        !a || (a.stopPropagation && a.stopPropagation(), a.cancelBubble = !0)
    }, stopImmediatePropagation: function () {
        this.isImmediatePropagationStopped = K, this.stopPropagation()
    }, isDefaultPrevented: J, isPropagationStopped: J, isImmediatePropagationStopped: J}, f.each({mouseenter: "mouseover", mouseleave: "mouseout"}, function (a, b) {
        f.event.special[a] = {delegateType: b, bindType: b, handle: function (a) {
            var c = this, d = a.relatedTarget, e = a.handleObj, g = e.selector, h;
            if (!d || d !== c && !f.contains(c, d))a.type = e.origType, h = e.handler.apply(this, arguments), a.type = b;
            return h
        }}
    }), f.support.submitBubbles || (f.event.special.submit = {setup: function () {
        if (f.nodeName(this, "form"))return!1;
        f.event.add(this, "click._submit keypress._submit", function (a) {
            var c = a.target, d = f.nodeName(c, "input") || f.nodeName(c, "button") ? c.form : b;
            d && !d._submit_attached && (f.event.add(d, "submit._submit", function (a) {
                this.parentNode && !a.isTrigger && f.event.simulate("submit", this.parentNode, a, !0)
            }), d._submit_attached = !0)
        })
    }, teardown: function () {
        if (f.nodeName(this, "form"))return!1;
        f.event.remove(this, "._submit")
    }}), f.support.changeBubbles || (f.event.special.change = {setup: function () {
        if (z.test(this.nodeName)) {
            if (this.type === "checkbox" || this.type === "radio")f.event.add(this, "propertychange._change", function (a) {
                a.originalEvent.propertyName === "checked" && (this._just_changed = !0)
            }), f.event.add(this, "click._change", function (a) {
                this._just_changed && !a.isTrigger && (this._just_changed = !1, f.event.simulate("change", this, a, !0))
            });
            return!1
        }
        f.event.add(this, "beforeactivate._change", function (a) {
            var b = a.target;
            z.test(b.nodeName) && !b._change_attached && (f.event.add(b, "change._change", function (a) {
                this.parentNode && !a.isSimulated && !a.isTrigger && f.event.simulate("change", this.parentNode, a, !0)
            }), b._change_attached = !0)
        })
    }, handle: function (a) {
        var b = a.target;
        if (this !== b || a.isSimulated || a.isTrigger || b.type !== "radio" && b.type !== "checkbox")return a.handleObj.handler.apply(this, arguments)
    }, teardown: function () {
        f.event.remove(this, "._change");
        return z.test(this.nodeName)
    }}), f.support.focusinBubbles || f.each({focus: "focusin", blur: "focusout"}, function (a, b) {
        var d = 0, e = function (a) {
            f.event.simulate(b, a.target, f.event.fix(a), !0)
        };
        f.event.special[b] = {setup: function () {
            d++ === 0 && c.addEventListener(a, e, !0)
        }, teardown: function () {
            --d === 0 && c.removeEventListener(a, e, !0)
        }}
    }), f.fn.extend({on: function (a, c, d, e, g) {
        var h, i;
        if (typeof a == "object") {
            typeof c != "string" && (d = c, c = b);
            for (i in a)this.on(i, c, d, a[i], g);
            return this
        }
        d == null && e == null ? (e = c, d = c = b) : e == null && (typeof c == "string" ? (e = d, d = b) : (e = d, d = c, c = b));
        if (e === !1)e = J; else if (!e)return this;
        g === 1 && (h = e, e = function (a) {
            f().off(a);
            return h.apply(this, arguments)
        }, e.guid = h.guid || (h.guid = f.guid++));
        return this.each(function () {
            f.event.add(this, a, e, d, c)
        })
    }, one: function (a, b, c, d) {
        return this.on.call(this, a, b, c, d, 1)
    }, off: function (a, c, d) {
        if (a && a.preventDefault && a.handleObj) {
            var e = a.handleObj;
            f(a.delegateTarget).off(e.namespace ? e.type + "." + e.namespace : e.type, e.selector, e.handler);
            return this
        }
        if (typeof a == "object") {
            for (var g in a)this.off(g, c, a[g]);
            return this
        }
        if (c === !1 || typeof c == "function")d = c, c = b;
        d === !1 && (d = J);
        return this.each(function () {
            f.event.remove(this, a, d, c)
        })
    }, bind: function (a, b, c) {
        return this.on(a, null, b, c)
    }, unbind: function (a, b) {
        return this.off(a, null, b)
    }, live: function (a, b, c) {
        f(this.context).on(a, this.selector, b, c);
        return this
    }, die: function (a, b) {
        f(this.context).off(a, this.selector || "**", b);
        return this
    }, delegate: function (a, b, c, d) {
        return this.on(b, a, c, d)
    }, undelegate: function (a, b, c) {
        return arguments.length == 1 ? this.off(a, "**") : this.off(b, a, c)
    }, trigger: function (a, b) {
        return this.each(function () {
            f.event.trigger(a, b, this)
        })
    }, triggerHandler: function (a, b) {
        if (this[0])return f.event.trigger(a, b, this[0], !0)
    }, toggle: function (a) {
        var b = arguments, c = a.guid || f.guid++, d = 0, e = function (c) {
            var e = (f._data(this, "lastToggle" + a.guid) || 0) % d;
            f._data(this, "lastToggle" + a.guid, e + 1), c.preventDefault();
            return b[e].apply(this, arguments) || !1
        };
        e.guid = c;
        while (d < b.length)b[d++].guid = c;
        return this.click(e)
    }, hover: function (a, b) {
        return this.mouseenter(a).mouseleave(b || a)
    }}), f.each("blur focus focusin focusout load resize scroll unload click dblclick mousedown mouseup mousemove mouseover mouseout mouseenter mouseleave change select submit keydown keypress keyup error contextmenu".split(" "), function (a, b) {
        f.fn[b] = function (a, c) {
            c == null && (c = a, a = null);
            return arguments.length > 0 ? this.on(b, null, a, c) : this.trigger(b)
        }, f.attrFn && (f.attrFn[b] = !0), C.test(b) && (f.event.fixHooks[b] = f.event.keyHooks), D.test(b) && (f.event.fixHooks[b] = f.event.mouseHooks)
    }), function () {
        function x(a, b, c, e, f, g) {
            for (var h = 0, i = e.length; h < i; h++) {
                var j = e[h];
                if (j) {
                    var k = !1;
                    j = j[a];
                    while (j) {
                        if (j[d] === c) {
                            k = e[j.sizset];
                            break
                        }
                        if (j.nodeType === 1) {
                            g || (j[d] = c, j.sizset = h);
                            if (typeof b != "string") {
                                if (j === b) {
                                    k = !0;
                                    break
                                }
                            } else if (m.filter(b, [j]).length > 0) {
                                k = j;
                                break
                            }
                        }
                        j = j[a]
                    }
                    e[h] = k
                }
            }
        }

        function w(a, b, c, e, f, g) {
            for (var h = 0, i = e.length; h < i; h++) {
                var j = e[h];
                if (j) {
                    var k = !1;
                    j = j[a];
                    while (j) {
                        if (j[d] === c) {
                            k = e[j.sizset];
                            break
                        }
                        j.nodeType === 1 && !g && (j[d] = c, j.sizset = h);
                        if (j.nodeName.toLowerCase() === b) {
                            k = j;
                            break
                        }
                        j = j[a]
                    }
                    e[h] = k
                }
            }
        }

        var a = /((?:\((?:\([^()]+\)|[^()]+)+\)|\[(?:\[[^\[\]]*\]|['"][^'"]*['"]|[^\[\]'"]+)+\]|\\.|[^ >+~,(\[\\]+)+|[>+~])(\s*,\s*)?((?:.|\r|\n)*)/g, d = "sizcache" + (Math.random() + "").replace(".", ""), e = 0, g = Object.prototype.toString, h = !1, i = !0, j = /\\/g, k = /\r\n/g, l = /\W/;
        [0, 0].sort(function () {
            i = !1;
            return 0
        });
        var m = function (b, d, e, f) {
            e = e || [], d = d || c;
            var h = d;
            if (d.nodeType !== 1 && d.nodeType !== 9)return[];
            if (!b || typeof b != "string")return e;
            var i, j, k, l, n, q, r, t, u = !0, v = m.isXML(d), w = [], x = b;
            do {
                a.exec(""), i = a.exec(x);
                if (i) {
                    x = i[3], w.push(i[1]);
                    if (i[2]) {
                        l = i[3];
                        break
                    }
                }
            } while (i);
            if (w.length > 1 && p.exec(b))if (w.length === 2 && o.relative[w[0]])j = y(w[0] + w[1], d, f); else {
                j = o.relative[w[0]] ? [d] : m(w.shift(), d);
                while (w.length)b = w.shift(), o.relative[b] && (b += w.shift()), j = y(b, j, f)
            } else {
                !f && w.length > 1 && d.nodeType === 9 && !v && o.match.ID.test(w[0]) && !o.match.ID.test(w[w.length - 1]) && (n = m.find(w.shift(), d, v), d = n.expr ? m.filter(n.expr, n.set)[0] : n.set[0]);
                if (d) {
                    n = f ? {expr: w.pop(), set: s(f)} : m.find(w.pop(), w.length === 1 && (w[0] === "~" || w[0] === "+") && d.parentNode ? d.parentNode : d, v), j = n.expr ? m.filter(n.expr, n.set) : n.set, w.length > 0 ? k = s(j) : u = !1;
                    while (w.length)q = w.pop(), r = q, o.relative[q] ? r = w.pop() : q = "", r == null && (r = d), o.relative[q](k, r, v)
                } else k = w = []
            }
            k || (k = j), k || m.error(q || b);
            if (g.call(k) === "[object Array]")if (!u)e.push.apply(e, k); else if (d && d.nodeType === 1)for (t = 0; k[t] != null; t++)k[t] && (k[t] === !0 || k[t].nodeType === 1 && m.contains(d, k[t])) && e.push(j[t]); else for (t = 0; k[t] != null; t++)k[t] && k[t].nodeType === 1 && e.push(j[t]); else s(k, e);
            l && (m(l, h, e, f), m.uniqueSort(e));
            return e
        };
        m.uniqueSort = function (a) {
            if (u) {
                h = i, a.sort(u);
                if (h)for (var b = 1; b < a.length; b++)a[b] === a[b - 1] && a.splice(b--, 1)
            }
            return a
        }, m.matches = function (a, b) {
            return m(a, null, null, b)
        }, m.matchesSelector = function (a, b) {
            return m(b, null, null, [a]).length > 0
        }, m.find = function (a, b, c) {
            var d, e, f, g, h, i;
            if (!a)return[];
            for (e = 0, f = o.order.length; e < f; e++) {
                h = o.order[e];
                if (g = o.leftMatch[h].exec(a)) {
                    i = g[1], g.splice(1, 1);
                    if (i.substr(i.length - 1) !== "\\") {
                        g[1] = (g[1] || "").replace(j, ""), d = o.find[h](g, b, c);
                        if (d != null) {
                            a = a.replace(o.match[h], "");
                            break
                        }
                    }
                }
            }
            d || (d = typeof b.getElementsByTagName != "undefined" ? b.getElementsByTagName("*") : []);
            return{set: d, expr: a}
        }, m.filter = function (a, c, d, e) {
            var f, g, h, i, j, k, l, n, p, q = a, r = [], s = c, t = c && c[0] && m.isXML(c[0]);
            while (a && c.length) {
                for (h in o.filter)if ((f = o.leftMatch[h].exec(a)) != null && f[2]) {
                    k = o.filter[h], l = f[1], g = !1, f.splice(1, 1);
                    if (l.substr(l.length - 1) === "\\")continue;
                    s === r && (r = []);
                    if (o.preFilter[h]) {
                        f = o.preFilter[h](f, s, d, r, e, t);
                        if (!f)g = i = !0; else if (f === !0)continue
                    }
                    if (f)for (n = 0; (j = s[n]) != null; n++)j && (i = k(j, f, n, s), p = e ^ i, d && i != null ? p ? g = !0 : s[n] = !1 : p && (r.push(j), g = !0));
                    if (i !== b) {
                        d || (s = r), a = a.replace(o.match[h], "");
                        if (!g)return[];
                        break
                    }
                }
                if (a === q)if (g == null)m.error(a); else break;
                q = a
            }
            return s
        }, m.error = function (a) {
            throw new Error("Syntax error, unrecognized expression: " + a)
        };
        var n = m.getText = function (a) {
            var b, c, d = a.nodeType, e = "";
            if (d) {
                if (d === 1 || d === 9) {
                    if (typeof a.textContent == "string")return a.textContent;
                    if (typeof a.innerText == "string")return a.innerText.replace(k, "");
                    for (a = a.firstChild; a; a = a.nextSibling)e += n(a)
                } else if (d === 3 || d === 4)return a.nodeValue
            } else for (b = 0; c = a[b]; b++)c.nodeType !== 8 && (e += n(c));
            return e
        }, o = m.selectors = {order: ["ID", "NAME", "TAG"], match: {ID: /#((?:[\w\u00c0-\uFFFF\-]|\\.)+)/, CLASS: /\.((?:[\w\u00c0-\uFFFF\-]|\\.)+)/, NAME: /\[name=['"]*((?:[\w\u00c0-\uFFFF\-]|\\.)+)['"]*\]/, ATTR: /\[\s*((?:[\w\u00c0-\uFFFF\-]|\\.)+)\s*(?:(\S?=)\s*(?:(['"])(.*?)\3|(#?(?:[\w\u00c0-\uFFFF\-]|\\.)*)|)|)\s*\]/, TAG: /^((?:[\w\u00c0-\uFFFF\*\-]|\\.)+)/, CHILD: /:(only|nth|last|first)-child(?:\(\s*(even|odd|(?:[+\-]?\d+|(?:[+\-]?\d*)?n\s*(?:[+\-]\s*\d+)?))\s*\))?/, POS: /:(nth|eq|gt|lt|first|last|even|odd)(?:\((\d*)\))?(?=[^\-]|$)/, PSEUDO: /:((?:[\w\u00c0-\uFFFF\-]|\\.)+)(?:\((['"]?)((?:\([^\)]+\)|[^\(\)]*)+)\2\))?/}, leftMatch: {}, attrMap: {"class": "className", "for": "htmlFor"}, attrHandle: {href: function (a) {
            return a.getAttribute("href")
        }, type: function (a) {
            return a.getAttribute("type")
        }}, relative: {"+": function (a, b) {
            var c = typeof b == "string", d = c && !l.test(b), e = c && !d;
            d && (b = b.toLowerCase());
            for (var f = 0, g = a.length, h; f < g; f++)if (h = a[f]) {
                while ((h = h.previousSibling) && h.nodeType !== 1);
                a[f] = e || h && h.nodeName.toLowerCase() === b ? h || !1 : h === b
            }
            e && m.filter(b, a, !0)
        }, ">": function (a, b) {
            var c, d = typeof b == "string", e = 0, f = a.length;
            if (d && !l.test(b)) {
                b = b.toLowerCase();
                for (; e < f; e++) {
                    c = a[e];
                    if (c) {
                        var g = c.parentNode;
                        a[e] = g.nodeName.toLowerCase() === b ? g : !1
                    }
                }
            } else {
                for (; e < f; e++)c = a[e], c && (a[e] = d ? c.parentNode : c.parentNode === b);
                d && m.filter(b, a, !0)
            }
        }, "": function (a, b, c) {
            var d, f = e++, g = x;
            typeof b == "string" && !l.test(b) && (b = b.toLowerCase(), d = b, g = w), g("parentNode", b, f, a, d, c)
        }, "~": function (a, b, c) {
            var d, f = e++, g = x;
            typeof b == "string" && !l.test(b) && (b = b.toLowerCase(), d = b, g = w), g("previousSibling", b, f, a, d, c)
        }}, find: {ID: function (a, b, c) {
            if (typeof b.getElementById != "undefined" && !c) {
                var d = b.getElementById(a[1]);
                return d && d.parentNode ? [d] : []
            }
        }, NAME: function (a, b) {
            if (typeof b.getElementsByName != "undefined") {
                var c = [], d = b.getElementsByName(a[1]);
                for (var e = 0, f = d.length; e < f; e++)d[e].getAttribute("name") === a[1] && c.push(d[e]);
                return c.length === 0 ? null : c
            }
        }, TAG: function (a, b) {
            if (typeof b.getElementsByTagName != "undefined")return b.getElementsByTagName(a[1])
        }}, preFilter: {CLASS: function (a, b, c, d, e, f) {
            a = " " + a[1].replace(j, "") + " ";
            if (f)return a;
            for (var g = 0, h; (h = b[g]) != null; g++)h && (e ^ (h.className && (" " + h.className + " ").replace(/[\t\n\r]/g, " ").indexOf(a) >= 0) ? c || d.push(h) : c && (b[g] = !1));
            return!1
        }, ID: function (a) {
            return a[1].replace(j, "")
        }, TAG: function (a, b) {
            return a[1].replace(j, "").toLowerCase()
        }, CHILD: function (a) {
            if (a[1] === "nth") {
                a[2] || m.error(a[0]), a[2] = a[2].replace(/^\+|\s*/g, "");
                var b = /(-?)(\d*)(?:n([+\-]?\d*))?/.exec(a[2] === "even" && "2n" || a[2] === "odd" && "2n+1" || !/\D/.test(a[2]) && "0n+" + a[2] || a[2]);
                a[2] = b[1] + (b[2] || 1) - 0, a[3] = b[3] - 0
            } else a[2] && m.error(a[0]);
            a[0] = e++;
            return a
        }, ATTR: function (a, b, c, d, e, f) {
            var g = a[1] = a[1].replace(j, "");
            !f && o.attrMap[g] && (a[1] = o.attrMap[g]), a[4] = (a[4] || a[5] || "").replace(j, ""), a[2] === "~=" && (a[4] = " " + a[4] + " ");
            return a
        }, PSEUDO: function (b, c, d, e, f) {
            if (b[1] === "not")if ((a.exec(b[3]) || "").length > 1 || /^\w/.test(b[3]))b[3] = m(b[3], null, null, c); else {
                var g = m.filter(b[3], c, d, !0 ^ f);
                d || e.push.apply(e, g);
                return!1
            } else if (o.match.POS.test(b[0]) || o.match.CHILD.test(b[0]))return!0;
            return b
        }, POS: function (a) {
            a.unshift(!0);
            return a
        }}, filters: {enabled: function (a) {
            return a.disabled === !1 && a.type !== "hidden"
        }, disabled: function (a) {
            return a.disabled === !0
        }, checked: function (a) {
            return a.checked === !0
        }, selected: function (a) {
            a.parentNode && a.parentNode.selectedIndex;
            return a.selected === !0
        }, parent: function (a) {
            return!!a.firstChild
        }, empty: function (a) {
            return!a.firstChild
        }, has: function (a, b, c) {
            return!!m(c[3], a).length
        }, header: function (a) {
            return/h\d/i.test(a.nodeName)
        }, text: function (a) {
            var b = a.getAttribute("type"), c = a.type;
            return a.nodeName.toLowerCase() === "input" && "text" === c && (b === c || b === null)
        }, radio: function (a) {
            return a.nodeName.toLowerCase() === "input" && "radio" === a.type
        }, checkbox: function (a) {
            return a.nodeName.toLowerCase() === "input" && "checkbox" === a.type
        }, file: function (a) {
            return a.nodeName.toLowerCase() === "input" && "file" === a.type
        }, password: function (a) {
            return a.nodeName.toLowerCase() === "input" && "password" === a.type
        }, submit: function (a) {
            var b = a.nodeName.toLowerCase();
            return(b === "input" || b === "button") && "submit" === a.type
        }, image: function (a) {
            return a.nodeName.toLowerCase() === "input" && "image" === a.type
        }, reset: function (a) {
            var b = a.nodeName.toLowerCase();
            return(b === "input" || b === "button") && "reset" === a.type
        }, button: function (a) {
            var b = a.nodeName.toLowerCase();
            return b === "input" && "button" === a.type || b === "button"
        }, input: function (a) {
            return/input|select|textarea|button/i.test(a.nodeName)
        }, focus: function (a) {
            return a === a.ownerDocument.activeElement
        }}, setFilters: {first: function (a, b) {
            return b === 0
        }, last: function (a, b, c, d) {
            return b === d.length - 1
        }, even: function (a, b) {
            return b % 2 === 0
        }, odd: function (a, b) {
            return b % 2 === 1
        }, lt: function (a, b, c) {
            return b < c[3] - 0
        }, gt: function (a, b, c) {
            return b > c[3] - 0
        }, nth: function (a, b, c) {
            return c[3] - 0 === b
        }, eq: function (a, b, c) {
            return c[3] - 0 === b
        }}, filter: {PSEUDO: function (a, b, c, d) {
            var e = b[1], f = o.filters[e];
            if (f)return f(a, c, b, d);
            if (e === "contains")return(a.textContent || a.innerText || n([a]) || "").indexOf(b[3]) >= 0;
            if (e === "not") {
                var g = b[3];
                for (var h = 0, i = g.length; h < i; h++)if (g[h] === a)return!1;
                return!0
            }
            m.error(e)
        }, CHILD: function (a, b) {
            var c, e, f, g, h, i, j, k = b[1], l = a;
            switch (k) {
                case"only":
                case"first":
                    while (l = l.previousSibling)if (l.nodeType === 1)return!1;
                    if (k === "first")return!0;
                    l = a;
                case"last":
                    while (l = l.nextSibling)if (l.nodeType === 1)return!1;
                    return!0;
                case"nth":
                    c = b[2], e = b[3];
                    if (c === 1 && e === 0)return!0;
                    f = b[0], g = a.parentNode;
                    if (g && (g[d] !== f || !a.nodeIndex)) {
                        i = 0;
                        for (l = g.firstChild; l; l = l.nextSibling)l.nodeType === 1 && (l.nodeIndex = ++i);
                        g[d] = f
                    }
                    j = a.nodeIndex - e;
                    return c === 0 ? j === 0 : j % c === 0 && j / c >= 0
            }
        }, ID: function (a, b) {
            return a.nodeType === 1 && a.getAttribute("id") === b
        }, TAG: function (a, b) {
            return b === "*" && a.nodeType === 1 || !!a.nodeName && a.nodeName.toLowerCase() === b
        }, CLASS: function (a, b) {
            return(" " + (a.className || a.getAttribute("class")) + " ").indexOf(b) > -1
        }, ATTR: function (a, b) {
            var c = b[1], d = m.attr ? m.attr(a, c) : o.attrHandle[c] ? o.attrHandle[c](a) : a[c] != null ? a[c] : a.getAttribute(c), e = d + "", f = b[2], g = b[4];
            return d == null ? f === "!=" : !f && m.attr ? d != null : f === "=" ? e === g : f === "*=" ? e.indexOf(g) >= 0 : f === "~=" ? (" " + e + " ").indexOf(g) >= 0 : g ? f === "!=" ? e !== g : f === "^=" ? e.indexOf(g) === 0 : f === "$=" ? e.substr(e.length - g.length) === g : f === "|=" ? e === g || e.substr(0, g.length + 1) === g + "-" : !1 : e && d !== !1
        }, POS: function (a, b, c, d) {
            var e = b[2], f = o.setFilters[e];
            if (f)return f(a, c, b, d)
        }}}, p = o.match.POS, q = function (a, b) {
            return"\\" + (b - 0 + 1)
        };
        for (var r in o.match)o.match[r] = new RegExp(o.match[r].source + /(?![^\[]*\])(?![^\(]*\))/.source), o.leftMatch[r] = new RegExp(/(^(?:.|\r|\n)*?)/.source + o.match[r].source.replace(/\\(\d+)/g, q));
        var s = function (a, b) {
            a = Array.prototype.slice.call(a, 0);
            if (b) {
                b.push.apply(b, a);
                return b
            }
            return a
        };
        try {
            Array.prototype.slice.call(c.documentElement.childNodes, 0)[0].nodeType
        } catch (t) {
            s = function (a, b) {
                var c = 0, d = b || [];
                if (g.call(a) === "[object Array]")Array.prototype.push.apply(d, a); else if (typeof a.length == "number")for (var e = a.length; c < e; c++)d.push(a[c]); else for (; a[c]; c++)d.push(a[c]);
                return d
            }
        }
        var u, v;
        c.documentElement.compareDocumentPosition ? u = function (a, b) {
            if (a === b) {
                h = !0;
                return 0
            }
            if (!a.compareDocumentPosition || !b.compareDocumentPosition)return a.compareDocumentPosition ? -1 : 1;
            return a.compareDocumentPosition(b) & 4 ? -1 : 1
        } : (u = function (a, b) {
            if (a === b) {
                h = !0;
                return 0
            }
            if (a.sourceIndex && b.sourceIndex)return a.sourceIndex - b.sourceIndex;
            var c, d, e = [], f = [], g = a.parentNode, i = b.parentNode, j = g;
            if (g === i)return v(a, b);
            if (!g)return-1;
            if (!i)return 1;
            while (j)e.unshift(j), j = j.parentNode;
            j = i;
            while (j)f.unshift(j), j = j.parentNode;
            c = e.length, d = f.length;
            for (var k = 0; k < c && k < d; k++)if (e[k] !== f[k])return v(e[k], f[k]);
            return k === c ? v(a, f[k], -1) : v(e[k], b, 1)
        }, v = function (a, b, c) {
            if (a === b)return c;
            var d = a.nextSibling;
            while (d) {
                if (d === b)return-1;
                d = d.nextSibling
            }
            return 1
        }), function () {
            var a = c.createElement("div"), d = "script" + (new Date).getTime(), e = c.documentElement;
            a.innerHTML = "<a name='" + d + "'/>", e.insertBefore(a, e.firstChild), c.getElementById(d) && (o.find.ID = function (a, c, d) {
                if (typeof c.getElementById != "undefined" && !d) {
                    var e = c.getElementById(a[1]);
                    return e ? e.id === a[1] || typeof e.getAttributeNode != "undefined" && e.getAttributeNode("id").nodeValue === a[1] ? [e] : b : []
                }
            }, o.filter.ID = function (a, b) {
                var c = typeof a.getAttributeNode != "undefined" && a.getAttributeNode("id");
                return a.nodeType === 1 && c && c.nodeValue === b
            }), e.removeChild(a), e = a = null
        }(), function () {
            var a = c.createElement("div");
            a.appendChild(c.createComment("")), a.getElementsByTagName("*").length > 0 && (o.find.TAG = function (a, b) {
                var c = b.getElementsByTagName(a[1]);
                if (a[1] === "*") {
                    var d = [];
                    for (var e = 0; c[e]; e++)c[e].nodeType === 1 && d.push(c[e]);
                    c = d
                }
                return c
            }), a.innerHTML = "<a href='#'></a>", a.firstChild && typeof a.firstChild.getAttribute != "undefined" && a.firstChild.getAttribute("href") !== "#" && (o.attrHandle.href = function (a) {
                return a.getAttribute("href", 2)
            }), a = null
        }(), c.querySelectorAll && function () {
            var a = m, b = c.createElement("div"), d = "__sizzle__";
            b.innerHTML = "<p class='TEST'></p>";
            if (!b.querySelectorAll || b.querySelectorAll(".TEST").length !== 0) {
                m = function (b, e, f, g) {
                    e = e || c;
                    if (!g && !m.isXML(e)) {
                        var h = /^(\w+$)|^\.([\w\-]+$)|^#([\w\-]+$)/.exec(b);
                        if (h && (e.nodeType === 1 || e.nodeType === 9)) {
                            if (h[1])return s(e.getElementsByTagName(b), f);
                            if (h[2] && o.find.CLASS && e.getElementsByClassName)return s(e.getElementsByClassName(h[2]), f)
                        }
                        if (e.nodeType === 9) {
                            if (b === "body" && e.body)return s([e.body], f);
                            if (h && h[3]) {
                                var i = e.getElementById(h[3]);
                                if (!i || !i.parentNode)return s([], f);
                                if (i.id === h[3])return s([i], f)
                            }
                            try {
                                return s(e.querySelectorAll(b), f)
                            } catch (j) {
                            }
                        } else if (e.nodeType === 1 && e.nodeName.toLowerCase() !== "object") {
                            var k = e, l = e.getAttribute("id"), n = l || d, p = e.parentNode, q = /^\s*[+~]/.test(b);
                            l ? n = n.replace(/'/g, "\\$&") : e.setAttribute("id", n), q && p && (e = e.parentNode);
                            try {
                                if (!q || p)return s(e.querySelectorAll("[id='" + n + "'] " + b), f)
                            } catch (r) {
                            } finally {
                                l || k.removeAttribute("id")
                            }
                        }
                    }
                    return a(b, e, f, g)
                };
                for (var e in a)m[e] = a[e];
                b = null
            }
        }(), function () {
            var a = c.documentElement, b = a.matchesSelector || a.mozMatchesSelector || a.webkitMatchesSelector || a.msMatchesSelector;
            if (b) {
                var d = !b.call(c.createElement("div"), "div"), e = !1;
                try {
                    b.call(c.documentElement, "[test!='']:sizzle")
                } catch (f) {
                    e = !0
                }
                m.matchesSelector = function (a, c) {
                    c = c.replace(/\=\s*([^'"\]]*)\s*\]/g, "='$1']");
                    if (!m.isXML(a))try {
                        if (e || !o.match.PSEUDO.test(c) && !/!=/.test(c)) {
                            var f = b.call(a, c);
                            if (f || !d || a.document && a.document.nodeType !== 11)return f
                        }
                    } catch (g) {
                    }
                    return m(c, null, null, [a]).length > 0
                }
            }
        }(), function () {
            var a = c.createElement("div");
            a.innerHTML = "<div class='test e'></div><div class='test'></div>";
            if (!!a.getElementsByClassName && a.getElementsByClassName("e").length !== 0) {
                a.lastChild.className = "e";
                if (a.getElementsByClassName("e").length === 1)return;
                o.order.splice(1, 0, "CLASS"), o.find.CLASS = function (a, b, c) {
                    if (typeof b.getElementsByClassName != "undefined" && !c)return b.getElementsByClassName(a[1])
                }, a = null
            }
        }(), c.documentElement.contains ? m.contains = function (a, b) {
            return a !== b && (a.contains ? a.contains(b) : !0)
        } : c.documentElement.compareDocumentPosition ? m.contains = function (a, b) {
            return!!(a.compareDocumentPosition(b) & 16)
        } : m.contains = function () {
            return!1
        }, m.isXML = function (a) {
            var b = (a ? a.ownerDocument || a : 0).documentElement;
            return b ? b.nodeName !== "HTML" : !1
        };
        var y = function (a, b, c) {
            var d, e = [], f = "", g = b.nodeType ? [b] : b;
            while (d = o.match.PSEUDO.exec(a))f += d[0], a = a.replace(o.match.PSEUDO, "");
            a = o.relative[a] ? a + "*" : a;
            for (var h = 0, i = g.length; h < i; h++)m(a, g[h], e, c);
            return m.filter(f, e)
        };
        m.attr = f.attr, m.selectors.attrMap = {}, f.find = m, f.expr = m.selectors, f.expr[":"] = f.expr.filters, f.unique = m.uniqueSort, f.text = m.getText, f.isXMLDoc = m.isXML, f.contains = m.contains
    }();
    var L = /Until$/, M = /^(?:parents|prevUntil|prevAll)/, N = /,/, O = /^.[^:#\[\.,]*$/, P = Array.prototype.slice, Q = f.expr.match.POS, R = {children: !0, contents: !0, next: !0, prev: !0};
    f.fn.extend({find: function (a) {
        var b = this, c, d;
        if (typeof a != "string")return f(a).filter(function () {
            for (c = 0, d = b.length; c < d; c++)if (f.contains(b[c], this))return!0
        });
        var e = this.pushStack("", "find", a), g, h, i;
        for (c = 0, d = this.length; c < d; c++) {
            g = e.length, f.find(a, this[c], e);
            if (c > 0)for (h = g; h < e.length; h++)for (i = 0; i < g; i++)if (e[i] === e[h]) {
                e.splice(h--, 1);
                break
            }
        }
        return e
    }, has: function (a) {
        var b = f(a);
        return this.filter(function () {
            for (var a = 0, c = b.length; a < c; a++)if (f.contains(this, b[a]))return!0
        })
    }, not: function (a) {
        return this.pushStack(T(this, a, !1), "not", a)
    }, filter: function (a) {
        return this.pushStack(T(this, a, !0), "filter", a)
    }, is: function (a) {
        return!!a && (typeof a == "string" ? Q.test(a) ? f(a, this.context).index(this[0]) >= 0 : f.filter(a, this).length > 0 : this.filter(a).length > 0)
    }, closest: function (a, b) {
        var c = [], d, e, g = this[0];
        if (f.isArray(a)) {
            var h = 1;
            while (g && g.ownerDocument && g !== b) {
                for (d = 0; d < a.length; d++)f(g).is(a[d]) && c.push({selector: a[d], elem: g, level: h});
                g = g.parentNode, h++
            }
            return c
        }
        var i = Q.test(a) || typeof a != "string" ? f(a, b || this.context) : 0;
        for (d = 0, e = this.length; d < e; d++) {
            g = this[d];
            while (g) {
                if (i ? i.index(g) > -1 : f.find.matchesSelector(g, a)) {
                    c.push(g);
                    break
                }
                g = g.parentNode;
                if (!g || !g.ownerDocument || g === b || g.nodeType === 11)break
            }
        }
        c = c.length > 1 ? f.unique(c) : c;
        return this.pushStack(c, "closest", a)
    }, index: function (a) {
        if (!a)return this[0] && this[0].parentNode ? this.prevAll().length : -1;
        if (typeof a == "string")return f.inArray(this[0], f(a));
        return f.inArray(a.jquery ? a[0] : a, this)
    }, add: function (a, b) {
        var c = typeof a == "string" ? f(a, b) : f.makeArray(a && a.nodeType ? [a] : a), d = f.merge(this.get(), c);
        return this.pushStack(S(c[0]) || S(d[0]) ? d : f.unique(d))
    }, andSelf: function () {
        return this.add(this.prevObject)
    }}), f.each({parent: function (a) {
        var b = a.parentNode;
        return b && b.nodeType !== 11 ? b : null
    }, parents: function (a) {
        return f.dir(a, "parentNode")
    }, parentsUntil: function (a, b, c) {
        return f.dir(a, "parentNode", c)
    }, next: function (a) {
        return f.nth(a, 2, "nextSibling")
    }, prev: function (a) {
        return f.nth(a, 2, "previousSibling")
    }, nextAll: function (a) {
        return f.dir(a, "nextSibling")
    }, prevAll: function (a) {
        return f.dir(a, "previousSibling")
    }, nextUntil: function (a, b, c) {
        return f.dir(a, "nextSibling", c)
    }, prevUntil: function (a, b, c) {
        return f.dir(a, "previousSibling", c)
    }, siblings: function (a) {
        return f.sibling(a.parentNode.firstChild, a)
    }, children: function (a) {
        return f.sibling(a.firstChild)
    }, contents: function (a) {
        return f.nodeName(a, "iframe") ? a.contentDocument || a.contentWindow.document : f.makeArray(a.childNodes)
    }}, function (a, b) {
        f.fn[a] = function (c, d) {
            var e = f.map(this, b, c);
            L.test(a) || (d = c), d && typeof d == "string" && (e = f.filter(d, e)), e = this.length > 1 && !R[a] ? f.unique(e) : e, (this.length > 1 || N.test(d)) && M.test(a) && (e = e.reverse());
            return this.pushStack(e, a, P.call(arguments).join(","))
        }
    }), f.extend({filter: function (a, b, c) {
        c && (a = ":not(" + a + ")");
        return b.length === 1 ? f.find.matchesSelector(b[0], a) ? [b[0]] : [] : f.find.matches(a, b)
    }, dir: function (a, c, d) {
        var e = [], g = a[c];
        while (g && g.nodeType !== 9 && (d === b || g.nodeType !== 1 || !f(g).is(d)))g.nodeType === 1 && e.push(g), g = g[c];
        return e
    }, nth: function (a, b, c, d) {
        b = b || 1;
        var e = 0;
        for (; a; a = a[c])if (a.nodeType === 1 && ++e === b)break;
        return a
    }, sibling: function (a, b) {
        var c = [];
        for (; a; a = a.nextSibling)a.nodeType === 1 && a !== b && c.push(a);
        return c
    }});
    var V = "abbr|article|aside|audio|canvas|datalist|details|figcaption|figure|footer|header|hgroup|mark|meter|nav|output|progress|section|summary|time|video", W = / jQuery\d+="(?:\d+|null)"/g, X = /^\s+/, Y = /<(?!area|br|col|embed|hr|img|input|link|meta|param)(([\w:]+)[^>]*)\/>/ig, Z = /<([\w:]+)/, $ = /<tbody/i, _ = /<|&#?\w+;/, ba = /<(?:script|style)/i, bb = /<(?:script|object|embed|option|style)/i, bc = new RegExp("<(?:" + V + ")", "i"), bd = /checked\s*(?:[^=]|=\s*.checked.)/i, be = /\/(java|ecma)script/i, bf = /^\s*<!(?:\[CDATA\[|\-\-)/, bg = {option: [1, "<select multiple='multiple'>", "</select>"], legend: [1, "<fieldset>", "</fieldset>"], thead: [1, "<table>", "</table>"], tr: [2, "<table><tbody>", "</tbody></table>"], td: [3, "<table><tbody><tr>", "</tr></tbody></table>"], col: [2, "<table><tbody></tbody><colgroup>", "</colgroup></table>"], area: [1, "<map>", "</map>"], _default: [0, "", ""]}, bh = U(c);
    bg.optgroup = bg.option, bg.tbody = bg.tfoot = bg.colgroup = bg.caption = bg.thead, bg.th = bg.td, f.support.htmlSerialize || (bg._default = [1, "div<div>", "</div>"]), f.fn.extend({text: function (a) {
        if (f.isFunction(a))return this.each(function (b) {
            var c = f(this);
            c.text(a.call(this, b, c.text()))
        });
        if (typeof a != "object" && a !== b)return this.empty().append((this[0] && this[0].ownerDocument || c).createTextNode(a));
        return f.text(this)
    }, wrapAll: function (a) {
        if (f.isFunction(a))return this.each(function (b) {
            f(this).wrapAll(a.call(this, b))
        });
        if (this[0]) {
            var b = f(a, this[0].ownerDocument).eq(0).clone(!0);
            this[0].parentNode && b.insertBefore(this[0]), b.map(function () {
                var a = this;
                while (a.firstChild && a.firstChild.nodeType === 1)a = a.firstChild;
                return a
            }).append(this)
        }
        return this
    }, wrapInner: function (a) {
        if (f.isFunction(a))return this.each(function (b) {
            f(this).wrapInner(a.call(this, b))
        });
        return this.each(function () {
            var b = f(this), c = b.contents();
            c.length ? c.wrapAll(a) : b.append(a)
        })
    }, wrap: function (a) {
        var b = f.isFunction(a);
        return this.each(function (c) {
            f(this).wrapAll(b ? a.call(this, c) : a)
        })
    }, unwrap: function () {
        return this.parent().each(function () {
            f.nodeName(this, "body") || f(this).replaceWith(this.childNodes)
        }).end()
    }, append: function () {
        return this.domManip(arguments, !0, function (a) {
            this.nodeType === 1 && this.appendChild(a)
        })
    }, prepend: function () {
        return this.domManip(arguments, !0, function (a) {
            this.nodeType === 1 && this.insertBefore(a, this.firstChild)
        })
    }, before: function () {
        if (this[0] && this[0].parentNode)return this.domManip(arguments, !1, function (a) {
            this.parentNode.insertBefore(a, this)
        });
        if (arguments.length) {
            var a = f.clean(arguments);
            a.push.apply(a, this.toArray());
            return this.pushStack(a, "before", arguments)
        }
    }, after: function () {
        if (this[0] && this[0].parentNode)return this.domManip(arguments, !1, function (a) {
            this.parentNode.insertBefore(a, this.nextSibling)
        });
        if (arguments.length) {
            var a = this.pushStack(this, "after", arguments);
            a.push.apply(a, f.clean(arguments));
            return a
        }
    }, remove: function (a, b) {
        for (var c = 0, d; (d = this[c]) != null; c++)if (!a || f.filter(a, [d]).length)!b && d.nodeType === 1 && (f.cleanData(d.getElementsByTagName("*")), f.cleanData([d])), d.parentNode && d.parentNode.removeChild(d);
        return this
    }, empty: function () {
        for (var a = 0, b; (b = this[a]) != null; a++) {
            b.nodeType === 1 && f.cleanData(b.getElementsByTagName("*"));
            while (b.firstChild)b.removeChild(b.firstChild)
        }
        return this
    }, clone: function (a, b) {
        a = a == null ? !1 : a, b = b == null ? a : b;
        return this.map(function () {
            return f.clone(this, a, b)
        })
    }, html: function (a) {
        if (a === b)return this[0] && this[0].nodeType === 1 ? this[0].innerHTML.replace(W, "") : null;
        if (typeof a == "string" && !ba.test(a) && (f.support.leadingWhitespace || !X.test(a)) && !bg[(Z.exec(a) || ["", ""])[1].toLowerCase()]) {
            a = a.replace(Y, "<$1></$2>");
            try {
                for (var c = 0, d = this.length; c < d; c++)this[c].nodeType === 1 && (f.cleanData(this[c].getElementsByTagName("*")), this[c].innerHTML = a)
            } catch (e) {
                this.empty().append(a)
            }
        } else f.isFunction(a) ? this.each(function (b) {
            var c = f(this);
            c.html(a.call(this, b, c.html()))
        }) : this.empty().append(a);
        return this
    }, replaceWith: function (a) {
        if (this[0] && this[0].parentNode) {
            if (f.isFunction(a))return this.each(function (b) {
                var c = f(this), d = c.html();
                c.replaceWith(a.call(this, b, d))
            });
            typeof a != "string" && (a = f(a).detach());
            return this.each(function () {
                var b = this.nextSibling, c = this.parentNode;
                f(this).remove(), b ? f(b).before(a) : f(c).append(a)
            })
        }
        return this.length ? this.pushStack(f(f.isFunction(a) ? a() : a), "replaceWith", a) : this
    }, detach: function (a) {
        return this.remove(a, !0)
    }, domManip: function (a, c, d) {
        var e, g, h, i, j = a[0], k = [];
        if (!f.support.checkClone && arguments.length === 3 && typeof j == "string" && bd.test(j))return this.each(function () {
            f(this).domManip(a, c, d, !0)
        });
        if (f.isFunction(j))return this.each(function (e) {
            var g = f(this);
            a[0] = j.call(this, e, c ? g.html() : b), g.domManip(a, c, d)
        });
        if (this[0]) {
            i = j && j.parentNode, f.support.parentNode && i && i.nodeType === 11 && i.childNodes.length === this.length ? e = {fragment: i} : e = f.buildFragment(a, this, k), h = e.fragment, h.childNodes.length === 1 ? g = h = h.firstChild : g = h.firstChild;
            if (g) {
                c = c && f.nodeName(g, "tr");
                for (var l = 0, m = this.length, n = m - 1; l < m; l++)d.call(c ? bi(this[l], g) : this[l], e.cacheable || m > 1 && l < n ? f.clone(h, !0, !0) : h)
            }
            k.length && f.each(k, bp)
        }
        return this
    }}), f.buildFragment = function (a, b, d) {
        var e, g, h, i, j = a[0];
        b && b[0] && (i = b[0].ownerDocument || b[0]), i.createDocumentFragment || (i = c), a.length === 1 && typeof j == "string" && j.length < 512 && i === c && j.charAt(0) === "<" && !bb.test(j) && (f.support.checkClone || !bd.test(j)) && (f.support.html5Clone || !bc.test(j)) && (g = !0, h = f.fragments[j], h && h !== 1 && (e = h)), e || (e = i.createDocumentFragment(), f.clean(a, i, e, d)), g && (f.fragments[j] = h ? e : 1);
        return{fragment: e, cacheable: g}
    }, f.fragments = {}, f.each({appendTo: "append", prependTo: "prepend", insertBefore: "before", insertAfter: "after", replaceAll: "replaceWith"}, function (a, b) {
        f.fn[a] = function (c) {
            var d = [], e = f(c), g = this.length === 1 && this[0].parentNode;
            if (g && g.nodeType === 11 && g.childNodes.length === 1 && e.length === 1) {
                e[b](this[0]);
                return this
            }
            for (var h = 0, i = e.length; h < i; h++) {
                var j = (h > 0 ? this.clone(!0) : this).get();
                f(e[h])[b](j), d = d.concat(j)
            }
            return this.pushStack(d, a, e.selector)
        }
    }), f.extend({clone: function (a, b, c) {
        var d, e, g, h = f.support.html5Clone || !bc.test("<" + a.nodeName) ? a.cloneNode(!0) : bo(a);
        if ((!f.support.noCloneEvent || !f.support.noCloneChecked) && (a.nodeType === 1 || a.nodeType === 11) && !f.isXMLDoc(a)) {
            bk(a, h), d = bl(a), e = bl(h);
            for (g = 0; d[g]; ++g)e[g] && bk(d[g], e[g])
        }
        if (b) {
            bj(a, h);
            if (c) {
                d = bl(a), e = bl(h);
                for (g = 0; d[g]; ++g)bj(d[g], e[g])
            }
        }
        d = e = null;
        return h
    }, clean: function (a, b, d, e) {
        var g;
        b = b || c, typeof b.createElement == "undefined" && (b = b.ownerDocument || b[0] && b[0].ownerDocument || c);
        var h = [], i;
        for (var j = 0, k; (k = a[j]) != null; j++) {
            typeof k == "number" && (k += "");
            if (!k)continue;
            if (typeof k == "string")if (!_.test(k))k = b.createTextNode(k); else {
                k = k.replace(Y, "<$1></$2>");
                var l = (Z.exec(k) || ["", ""])[1].toLowerCase(), m = bg[l] || bg._default, n = m[0], o = b.createElement("div");
                b === c ? bh.appendChild(o) : U(b).appendChild(o), o.innerHTML = m[1] + k + m[2];
                while (n--)o = o.lastChild;
                if (!f.support.tbody) {
                    var p = $.test(k), q = l === "table" && !p ? o.firstChild && o.firstChild.childNodes : m[1] === "<table>" && !p ? o.childNodes : [];
                    for (i = q.length - 1; i >= 0; --i)f.nodeName(q[i], "tbody") && !q[i].childNodes.length && q[i].parentNode.removeChild(q[i])
                }
                !f.support.leadingWhitespace && X.test(k) && o.insertBefore(b.createTextNode(X.exec(k)[0]), o.firstChild), k = o.childNodes
            }
            var r;
            if (!f.support.appendChecked)if (k[0] && typeof (r = k.length) == "number")for (i = 0; i < r; i++)bn(k[i]); else bn(k);
            k.nodeType ? h.push(k) : h = f.merge(h, k)
        }
        if (d) {
            g = function (a) {
                return!a.type || be.test(a.type)
            };
            for (j = 0; h[j]; j++)if (e && f.nodeName(h[j], "script") && (!h[j].type || h[j].type.toLowerCase() === "text/javascript"))e.push(h[j].parentNode ? h[j].parentNode.removeChild(h[j]) : h[j]); else {
                if (h[j].nodeType === 1) {
                    var s = f.grep(h[j].getElementsByTagName("script"), g);
                    h.splice.apply(h, [j + 1, 0].concat(s))
                }
                d.appendChild(h[j])
            }
        }
        return h
    }, cleanData: function (a) {
        var b, c, d = f.cache, e = f.event.special, g = f.support.deleteExpando;
        for (var h = 0, i; (i = a[h]) != null; h++) {
            if (i.nodeName && f.noData[i.nodeName.toLowerCase()])continue;
            c = i[f.expando];
            if (c) {
                b = d[c];
                if (b && b.events) {
                    for (var j in b.events)e[j] ? f.event.remove(i, j) : f.removeEvent(i, j, b.handle);
                    b.handle && (b.handle.elem = null)
                }
                g ? delete i[f.expando] : i.removeAttribute && i.removeAttribute(f.expando), delete d[c]
            }
        }
    }});
    var bq = /alpha\([^)]*\)/i, br = /opacity=([^)]*)/, bs = /([A-Z]|^ms)/g, bt = /^-?\d+(?:px)?$/i, bu = /^-?\d/, bv = /^([\-+])=([\-+.\de]+)/, bw = {position: "absolute", visibility: "hidden", display: "block"}, bx = ["Left", "Right"], by = ["Top", "Bottom"], bz, bA, bB;
    f.fn.css = function (a, c) {
        if (arguments.length === 2 && c === b)return this;
        return f.access(this, a, c, !0, function (a, c, d) {
            return d !== b ? f.style(a, c, d) : f.css(a, c)
        })
    }, f.extend({cssHooks: {opacity: {get: function (a, b) {
        if (b) {
            var c = bz(a, "opacity", "opacity");
            return c === "" ? "1" : c
        }
        return a.style.opacity
    }}}, cssNumber: {fillOpacity: !0, fontWeight: !0, lineHeight: !0, opacity: !0, orphans: !0, widows: !0, zIndex: !0, zoom: !0}, cssProps: {"float": f.support.cssFloat ? "cssFloat" : "styleFloat"}, style: function (a, c, d, e) {
        if (!!a && a.nodeType !== 3 && a.nodeType !== 8 && !!a.style) {
            var g, h, i = f.camelCase(c), j = a.style, k = f.cssHooks[i];
            c = f.cssProps[i] || i;
            if (d === b) {
                if (k && "get"in k && (g = k.get(a, !1, e)) !== b)return g;
                return j[c]
            }
            h = typeof d, h === "string" && (g = bv.exec(d)) && (d = +(g[1] + 1) * +g[2] + parseFloat(f.css(a, c)), h = "number");
            if (d == null || h === "number" && isNaN(d))return;
            h === "number" && !f.cssNumber[i] && (d += "px");
            if (!k || !("set"in k) || (d = k.set(a, d)) !== b)try {
                j[c] = d
            } catch (l) {
            }
        }
    }, css: function (a, c, d) {
        var e, g;
        c = f.camelCase(c), g = f.cssHooks[c], c = f.cssProps[c] || c, c === "cssFloat" && (c = "float");
        if (g && "get"in g && (e = g.get(a, !0, d)) !== b)return e;
        if (bz)return bz(a, c)
    }, swap: function (a, b, c) {
        var d = {};
        for (var e in b)d[e] = a.style[e], a.style[e] = b[e];
        c.call(a);
        for (e in b)a.style[e] = d[e]
    }}), f.curCSS = f.css, f.each(["height", "width"], function (a, b) {
        f.cssHooks[b] = {get: function (a, c, d) {
            var e;
            if (c) {
                if (a.offsetWidth !== 0)return bC(a, b, d);
                f.swap(a, bw, function () {
                    e = bC(a, b, d)
                });
                return e
            }
        }, set: function (a, b) {
            if (!bt.test(b))return b;
            b = parseFloat(b);
            if (b >= 0)return b + "px"
        }}
    }), f.support.opacity || (f.cssHooks.opacity = {get: function (a, b) {
        return br.test((b && a.currentStyle ? a.currentStyle.filter : a.style.filter) || "") ? parseFloat(RegExp.$1) / 100 + "" : b ? "1" : ""
    }, set: function (a, b) {
        var c = a.style, d = a.currentStyle, e = f.isNumeric(b) ? "alpha(opacity=" + b * 100 + ")" : "", g = d && d.filter || c.filter || "";
        c.zoom = 1;
        if (b >= 1 && f.trim(g.replace(bq, "")) === "") {
            c.removeAttribute("filter");
            if (d && !d.filter)return
        }
        c.filter = bq.test(g) ? g.replace(bq, e) : g + " " + e
    }}), f(function () {
        f.support.reliableMarginRight || (f.cssHooks.marginRight = {get: function (a, b) {
            var c;
            f.swap(a, {display: "inline-block"}, function () {
                b ? c = bz(a, "margin-right", "marginRight") : c = a.style.marginRight
            });
            return c
        }})
    }), c.defaultView && c.defaultView.getComputedStyle && (bA = function (a, b) {
        var c, d, e;
        b = b.replace(bs, "-$1").toLowerCase(), (d = a.ownerDocument.defaultView) && (e = d.getComputedStyle(a, null)) && (c = e.getPropertyValue(b), c === "" && !f.contains(a.ownerDocument.documentElement, a) && (c = f.style(a, b)));
        return c
    }), c.documentElement.currentStyle && (bB = function (a, b) {
        var c, d, e, f = a.currentStyle && a.currentStyle[b], g = a.style;
        f === null && g && (e = g[b]) && (f = e), !bt.test(f) && bu.test(f) && (c = g.left, d = a.runtimeStyle && a.runtimeStyle.left, d && (a.runtimeStyle.left = a.currentStyle.left), g.left = b === "fontSize" ? "1em" : f || 0, f = g.pixelLeft + "px", g.left = c, d && (a.runtimeStyle.left = d));
        return f === "" ? "auto" : f
    }), bz = bA || bB, f.expr && f.expr.filters && (f.expr.filters.hidden = function (a) {
        var b = a.offsetWidth, c = a.offsetHeight;
        return b === 0 && c === 0 || !f.support.reliableHiddenOffsets && (a.style && a.style.display || f.css(a, "display")) === "none"
    }, f.expr.filters.visible = function (a) {
        return!f.expr.filters.hidden(a)
    });
    var bD = /%20/g, bE = /\[\]$/, bF = /\r?\n/g, bG = /#.*$/, bH = /^(.*?):[ \t]*([^\r\n]*)\r?$/mg, bI = /^(?:color|date|datetime|datetime-local|email|hidden|month|number|password|range|search|tel|text|time|url|week)$/i, bJ = /^(?:about|app|app\-storage|.+\-extension|file|res|widget):$/, bK = /^(?:GET|HEAD)$/, bL = /^\/\//, bM = /\?/, bN = /<script\b[^<]*(?:(?!<\/script>)<[^<]*)*<\/script>/gi, bO = /^(?:select|textarea)/i, bP = /\s+/, bQ = /([?&])_=[^&]*/, bR = /^([\w\+\.\-]+:)(?:\/\/([^\/?#:]*)(?::(\d+))?)?/, bS = f.fn.load, bT = {}, bU = {}, bV, bW, bX = ["*/"] + ["*"];
    try {
        bV = e.href
    } catch (bY) {
        bV = c.createElement("a"), bV.href = "", bV = bV.href
    }
    bW = bR.exec(bV.toLowerCase()) || [], f.fn.extend({load: function (a, c, d) {
        if (typeof a != "string" && bS)return bS.apply(this, arguments);
        if (!this.length)return this;
        var e = a.indexOf(" ");
        if (e >= 0) {
            var g = a.slice(e, a.length);
            a = a.slice(0, e)
        }
        var h = "GET";
        c && (f.isFunction(c) ? (d = c, c = b) : typeof c == "object" && (c = f.param(c, f.ajaxSettings.traditional), h = "POST"));
        var i = this;
        f.ajax({url: a, type: h, dataType: "html", data: c, complete: function (a, b, c) {
            c = a.responseText, a.isResolved() && (a.done(function (a) {
                c = a
            }), i.html(g ? f("<div>").append(c.replace(bN, "")).find(g) : c)), d && i.each(d, [c, b, a])
        }});
        return this
    }, serialize: function () {
        return f.param(this.serializeArray())
    }, serializeArray: function () {
        return this.map(function () {
            return this.elements ? f.makeArray(this.elements) : this
        }).filter(function () {
            return this.name && !this.disabled && (this.checked || bO.test(this.nodeName) || bI.test(this.type))
        }).map(function (a, b) {
            var c = f(this).val();
            return c == null ? null : f.isArray(c) ? f.map(c, function (a, c) {
                return{name: b.name, value: a.replace(bF, "\r\n")}
            }) : {name: b.name, value: c.replace(bF, "\r\n")}
        }).get()
    }}), f.each("ajaxStart ajaxStop ajaxComplete ajaxError ajaxSuccess ajaxSend".split(" "), function (a, b) {
        f.fn[b] = function (a) {
            return this.on(b, a)
        }
    }), f.each(["get", "post"], function (a, c) {
        f[c] = function (a, d, e, g) {
            f.isFunction(d) && (g = g || e, e = d, d = b);
            return f.ajax({type: c, url: a, data: d, success: e, dataType: g})
        }
    }), f.extend({getScript: function (a, c) {
        return f.get(a, b, c, "script")
    }, getJSON: function (a, b, c) {
        return f.get(a, b, c, "json")
    }, ajaxSetup: function (a, b) {
        b ? b_(a, f.ajaxSettings) : (b = a, a = f.ajaxSettings), b_(a, b);
        return a
    }, ajaxSettings: {url: bV, isLocal: bJ.test(bW[1]), global: !0, type: "GET", contentType: "application/x-www-form-urlencoded", processData: !0, async: !0, accepts: {xml: "application/xml, text/xml", html: "text/html", text: "text/plain", json: "application/json, text/javascript", "*": bX}, contents: {xml: /xml/, html: /html/, json: /json/}, responseFields: {xml: "responseXML", text: "responseText"}, converters: {"* text": a.String, "text html": !0, "text json": f.parseJSON, "text xml": f.parseXML}, flatOptions: {context: !0, url: !0}}, ajaxPrefilter: bZ(bT), ajaxTransport: bZ(bU), ajax: function (a, c) {
        function w(a, c, l, m) {
            if (s !== 2) {
                s = 2, q && clearTimeout(q), p = b, n = m || "", v.readyState = a > 0 ? 4 : 0;
                var o, r, u, w = c, x = l ? cb(d, v, l) : b, y, z;
                if (a >= 200 && a < 300 || a === 304) {
                    if (d.ifModified) {
                        if (y = v.getResponseHeader("Last-Modified"))f.lastModified[k] = y;
                        if (z = v.getResponseHeader("Etag"))f.etag[k] = z
                    }
                    if (a === 304)w = "notmodified", o = !0; else try {
                        r = cc(d, x), w = "success", o = !0
                    } catch (A) {
                        w = "parsererror", u = A
                    }
                } else {
                    u = w;
                    if (!w || a)w = "error", a < 0 && (a = 0)
                }
                v.status = a, v.statusText = "" + (c || w), o ? h.resolveWith(e, [r, w, v]) : h.rejectWith(e, [v, w, u]), v.statusCode(j), j = b, t && g.trigger("ajax" + (o ? "Success" : "Error"), [v, d, o ? r : u]), i.fireWith(e, [v, w]), t && (g.trigger("ajaxComplete", [v, d]), --f.active || f.event.trigger("ajaxStop"))
            }
        }

        typeof a == "object" && (c = a, a = b), c = c || {};
        var d = f.ajaxSetup({}, c), e = d.context || d, g = e !== d && (e.nodeType || e instanceof f) ? f(e) : f.event, h = f.Deferred(), i = f.Callbacks("once memory"), j = d.statusCode || {}, k, l = {}, m = {}, n, o, p, q, r, s = 0, t, u, v = {readyState: 0, setRequestHeader: function (a, b) {
            if (!s) {
                var c = a.toLowerCase();
                a = m[c] = m[c] || a, l[a] = b
            }
            return this
        }, getAllResponseHeaders: function () {
            return s === 2 ? n : null
        }, getResponseHeader: function (a) {
            var c;
            if (s === 2) {
                if (!o) {
                    o = {};
                    while (c = bH.exec(n))o[c[1].toLowerCase()] = c[2]
                }
                c = o[a.toLowerCase()]
            }
            return c === b ? null : c
        }, overrideMimeType: function (a) {
            s || (d.mimeType = a);
            return this
        }, abort: function (a) {
            a = a || "abort", p && p.abort(a), w(0, a);
            return this
        }};
        h.promise(v), v.success = v.done, v.error = v.fail, v.complete = i.add, v.statusCode = function (a) {
            if (a) {
                var b;
                if (s < 2)for (b in a)j[b] = [j[b], a[b]]; else b = a[v.status], v.then(b, b)
            }
            return this
        }, d.url = ((a || d.url) + "").replace(bG, "").replace(bL, bW[1] + "//"), d.dataTypes = f.trim(d.dataType || "*").toLowerCase().split(bP), d.crossDomain == null && (r = bR.exec(d.url.toLowerCase()), d.crossDomain = !(!r || r[1] == bW[1] && r[2] == bW[2] && (r[3] || (r[1] === "http:" ? 80 : 443)) == (bW[3] || (bW[1] === "http:" ? 80 : 443)))), d.data && d.processData && typeof d.data != "string" && (d.data = f.param(d.data, d.traditional)), b$(bT, d, c, v);
        if (s === 2)return!1;
        t = d.global, d.type = d.type.toUpperCase(), d.hasContent = !bK.test(d.type), t && f.active++ === 0 && f.event.trigger("ajaxStart");
        if (!d.hasContent) {
            d.data && (d.url += (bM.test(d.url) ? "&" : "?") + d.data, delete d.data), k = d.url;
            if (d.cache === !1) {
                var x = f.now(), y = d.url.replace(bQ, "$1_=" + x);
                d.url = y + (y === d.url ? (bM.test(d.url) ? "&" : "?") + "_=" + x : "")
            }
        }
        (d.data && d.hasContent && d.contentType !== !1 || c.contentType) && v.setRequestHeader("Content-Type", d.contentType), d.ifModified && (k = k || d.url, f.lastModified[k] && v.setRequestHeader("If-Modified-Since", f.lastModified[k]), f.etag[k] && v.setRequestHeader("If-None-Match", f.etag[k])), v.setRequestHeader("Accept", d.dataTypes[0] && d.accepts[d.dataTypes[0]] ? d.accepts[d.dataTypes[0]] + (d.dataTypes[0] !== "*" ? ", " + bX + "; q=0.01" : "") : d.accepts["*"]);
        for (u in d.headers)v.setRequestHeader(u, d.headers[u]);
        if (d.beforeSend && (d.beforeSend.call(e, v, d) === !1 || s === 2)) {
            v.abort();
            return!1
        }
        for (u in{success: 1, error: 1, complete: 1})v[u](d[u]);
        p = b$(bU, d, c, v);
        if (!p)w(-1, "No Transport"); else {
            v.readyState = 1, t && g.trigger("ajaxSend", [v, d]), d.async && d.timeout > 0 && (q = setTimeout(function () {
                v.abort("timeout")
            }, d.timeout));
            try {
                s = 1, p.send(l, w)
            } catch (z) {
                if (s < 2)w(-1, z); else throw z
            }
        }
        return v
    }, param: function (a, c) {
        var d = [], e = function (a, b) {
            b = f.isFunction(b) ? b() : b, d[d.length] = encodeURIComponent(a) + "=" + encodeURIComponent(b)
        };
        c === b && (c = f.ajaxSettings.traditional);
        if (f.isArray(a) || a.jquery && !f.isPlainObject(a))f.each(a, function () {
            e(this.name, this.value)
        }); else for (var g in a)ca(g, a[g], c, e);
        return d.join("&").replace(bD, "+")
    }}), f.extend({active: 0, lastModified: {}, etag: {}});
    var cd = f.now(), ce = /(\=)\?(&|$)|\?\?/i;
    f.ajaxSetup({jsonp: "callback", jsonpCallback: function () {
        return f.expando + "_" + cd++
    }}), f.ajaxPrefilter("json jsonp", function (b, c, d) {
        var e = b.contentType === "application/x-www-form-urlencoded" && typeof b.data == "string";
        if (b.dataTypes[0] === "jsonp" || b.jsonp !== !1 && (ce.test(b.url) || e && ce.test(b.data))) {
            var g, h = b.jsonpCallback = f.isFunction(b.jsonpCallback) ? b.jsonpCallback() : b.jsonpCallback, i = a[h], j = b.url, k = b.data, l = "$1" + h + "$2";
            b.jsonp !== !1 && (j = j.replace(ce, l), b.url === j && (e && (k = k.replace(ce, l)), b.data === k && (j += (/\?/.test(j) ? "&" : "?") + b.jsonp + "=" + h))), b.url = j, b.data = k, a[h] = function (a) {
                g = [a]
            }, d.always(function () {
                a[h] = i, g && f.isFunction(i) && a[h](g[0])
            }), b.converters["script json"] = function () {
                g || f.error(h + " was not called");
                return g[0]
            }, b.dataTypes[0] = "json";
            return"script"
        }
    }), f.ajaxSetup({accepts: {script: "text/javascript, application/javascript, application/ecmascript, application/x-ecmascript"}, contents: {script: /javascript|ecmascript/}, converters: {"text script": function (a) {
        f.globalEval(a);
        return a
    }}}), f.ajaxPrefilter("script", function (a) {
        a.cache === b && (a.cache = !1), a.crossDomain && (a.type = "GET", a.global = !1)
    }), f.ajaxTransport("script", function (a) {
        if (a.crossDomain) {
            var d, e = c.head || c.getElementsByTagName("head")[0] || c.documentElement;
            return{send: function (f, g) {
                d = c.createElement("script"), d.async = "async", a.scriptCharset && (d.charset = a.scriptCharset), d.src = a.url, d.onload = d.onreadystatechange = function (a, c) {
                    if (c || !d.readyState || /loaded|complete/.test(d.readyState))d.onload = d.onreadystatechange = null, e && d.parentNode && e.removeChild(d), d = b, c || g(200, "success")
                }, e.insertBefore(d, e.firstChild)
            }, abort: function () {
                d && d.onload(0, 1)
            }}
        }
    });
    var cf = a.ActiveXObject ? function () {
        for (var a in ch)ch[a](0, 1)
    } : !1, cg = 0, ch;
    f.ajaxSettings.xhr = a.ActiveXObject ? function () {
        return!this.isLocal && ci() || cj()
    } : ci, function (a) {
        f.extend(f.support, {ajax: !!a, cors: !!a && "withCredentials"in a})
    }(f.ajaxSettings.xhr()), f.support.ajax && f.ajaxTransport(function (c) {
        if (!c.crossDomain || f.support.cors) {
            var d;
            return{send: function (e, g) {
                var h = c.xhr(), i, j;
                c.username ? h.open(c.type, c.url, c.async, c.username, c.password) : h.open(c.type, c.url, c.async);
                if (c.xhrFields)for (j in c.xhrFields)h[j] = c.xhrFields[j];
                c.mimeType && h.overrideMimeType && h.overrideMimeType(c.mimeType), !c.crossDomain && !e["X-Requested-With"] && (e["X-Requested-With"] = "XMLHttpRequest");
                try {
                    for (j in e)h.setRequestHeader(j, e[j])
                } catch (k) {
                }
                h.send(c.hasContent && c.data || null), d = function (a, e) {
                    var j, k, l, m, n;
                    try {
                        if (d && (e || h.readyState === 4)) {
                            d = b, i && (h.onreadystatechange = f.noop, cf && delete ch[i]);
                            if (e)h.readyState !== 4 && h.abort(); else {
                                j = h.status, l = h.getAllResponseHeaders(), m = {}, n = h.responseXML, n && n.documentElement && (m.xml = n), m.text = h.responseText;
                                try {
                                    k = h.statusText
                                } catch (o) {
                                    k = ""
                                }
                                !j && c.isLocal && !c.crossDomain ? j = m.text ? 200 : 404 : j === 1223 && (j = 204)
                            }
                        }
                    } catch (p) {
                        e || g(-1, p)
                    }
                    m && g(j, k, m, l)
                }, !c.async || h.readyState === 4 ? d() : (i = ++cg, cf && (ch || (ch = {}, f(a).unload(cf)), ch[i] = d), h.onreadystatechange = d)
            }, abort: function () {
                d && d(0, 1)
            }}
        }
    });
    var ck = {}, cl, cm, cn = /^(?:toggle|show|hide)$/, co = /^([+\-]=)?([\d+.\-]+)([a-z%]*)$/i, cp, cq = [
        ["height", "marginTop", "marginBottom", "paddingTop", "paddingBottom"],
        ["width", "marginLeft", "marginRight", "paddingLeft", "paddingRight"],
        ["opacity"]
    ], cr;
    f.fn.extend({show: function (a, b, c) {
        var d, e;
        if (a || a === 0)return this.animate(cu("show", 3), a, b, c);
        for (var g = 0, h = this.length; g < h; g++)d = this[g], d.style && (e = d.style.display, !f._data(d, "olddisplay") && e === "none" && (e = d.style.display = ""), e === "" && f.css(d, "display") === "none" && f._data(d, "olddisplay", cv(d.nodeName)));
        for (g = 0; g < h; g++) {
            d = this[g];
            if (d.style) {
                e = d.style.display;
                if (e === "" || e === "none")d.style.display = f._data(d, "olddisplay") || ""
            }
        }
        return this
    }, hide: function (a, b, c) {
        if (a || a === 0)return this.animate(cu("hide", 3), a, b, c);
        var d, e, g = 0, h = this.length;
        for (; g < h; g++)d = this[g], d.style && (e = f.css(d, "display"), e !== "none" && !f._data(d, "olddisplay") && f._data(d, "olddisplay", e));
        for (g = 0; g < h; g++)this[g].style && (this[g].style.display = "none");
        return this
    }, _toggle: f.fn.toggle, toggle: function (a, b, c) {
        var d = typeof a == "boolean";
        f.isFunction(a) && f.isFunction(b) ? this._toggle.apply(this, arguments) : a == null || d ? this.each(function () {
            var b = d ? a : f(this).is(":hidden");
            f(this)[b ? "show" : "hide"]()
        }) : this.animate(cu("toggle", 3), a, b, c);
        return this
    }, fadeTo: function (a, b, c, d) {
        return this.filter(":hidden").css("opacity", 0).show().end().animate({opacity: b}, a, c, d)
    }, animate: function (a, b, c, d) {
        function g() {
            e.queue === !1 && f._mark(this);
            var b = f.extend({}, e), c = this.nodeType === 1, d = c && f(this).is(":hidden"), g, h, i, j, k, l, m, n, o;
            b.animatedProperties = {};
            for (i in a) {
                g = f.camelCase(i), i !== g && (a[g] = a[i], delete a[i]), h = a[g], f.isArray(h) ? (b.animatedProperties[g] = h[1], h = a[g] = h[0]) : b.animatedProperties[g] = b.specialEasing && b.specialEasing[g] || b.easing || "swing";
                if (h === "hide" && d || h === "show" && !d)return b.complete.call(this);
                c && (g === "height" || g === "width") && (b.overflow = [this.style.overflow, this.style.overflowX, this.style.overflowY], f.css(this, "display") === "inline" && f.css(this, "float") === "none" && (!f.support.inlineBlockNeedsLayout || cv(this.nodeName) === "inline" ? this.style.display = "inline-block" : this.style.zoom = 1))
            }
            b.overflow != null && (this.style.overflow = "hidden");
            for (i in a)j = new f.fx(this, b, i), h = a[i], cn.test(h) ? (o = f._data(this, "toggle" + i) || (h === "toggle" ? d ? "show" : "hide" : 0), o ? (f._data(this, "toggle" + i, o === "show" ? "hide" : "show"), j[o]()) : j[h]()) : (k = co.exec(h), l = j.cur(), k ? (m = parseFloat(k[2]), n = k[3] || (f.cssNumber[i] ? "" : "px"), n !== "px" && (f.style(this, i, (m || 1) + n), l = (m || 1) / j.cur() * l, f.style(this, i, l + n)), k[1] && (m = (k[1] === "-=" ? -1 : 1) * m + l), j.custom(l, m, n)) : j.custom(l, h, ""));
            return!0
        }

        var e = f.speed(b, c, d);
        if (f.isEmptyObject(a))return this.each(e.complete, [!1]);
        a = f.extend({}, a);
        return e.queue === !1 ? this.each(g) : this.queue(e.queue, g)
    }, stop: function (a, c, d) {
        typeof a != "string" && (d = c, c = a, a = b), c && a !== !1 && this.queue(a || "fx", []);
        return this.each(function () {
            function h(a, b, c) {
                var e = b[c];
                f.removeData(a, c, !0), e.stop(d)
            }

            var b, c = !1, e = f.timers, g = f._data(this);
            d || f._unmark(!0, this);
            if (a == null)for (b in g)g[b] && g[b].stop && b.indexOf(".run") === b.length - 4 && h(this, g, b); else g[b = a + ".run"] && g[b].stop && h(this, g, b);
            for (b = e.length; b--;)e[b].elem === this && (a == null || e[b].queue === a) && (d ? e[b](!0) : e[b].saveState(), c = !0, e.splice(b, 1));
            (!d || !c) && f.dequeue(this, a)
        })
    }}), f.each({slideDown: cu("show", 1), slideUp: cu("hide", 1), slideToggle: cu("toggle", 1), fadeIn: {opacity: "show"}, fadeOut: {opacity: "hide"}, fadeToggle: {opacity: "toggle"}}, function (a, b) {
        f.fn[a] = function (a, c, d) {
            return this.animate(b, a, c, d)
        }
    }), f.extend({speed: function (a, b, c) {
        var d = a && typeof a == "object" ? f.extend({}, a) : {complete: c || !c && b || f.isFunction(a) && a, duration: a, easing: c && b || b && !f.isFunction(b) && b};
        d.duration = f.fx.off ? 0 : typeof d.duration == "number" ? d.duration : d.duration in f.fx.speeds ? f.fx.speeds[d.duration] : f.fx.speeds._default;
        if (d.queue == null || d.queue === !0)d.queue = "fx";
        d.old = d.complete, d.complete = function (a) {
            f.isFunction(d.old) && d.old.call(this), d.queue ? f.dequeue(this, d.queue) : a !== !1 && f._unmark(this)
        };
        return d
    }, easing: {linear: function (a, b, c, d) {
        return c + d * a
    }, swing: function (a, b, c, d) {
        return(-Math.cos(a * Math.PI) / 2 + .5) * d + c
    }}, timers: [], fx: function (a, b, c) {
        this.options = b, this.elem = a, this.prop = c, b.orig = b.orig || {}
    }}), f.fx.prototype = {update: function () {
        this.options.step && this.options.step.call(this.elem, this.now, this), (f.fx.step[this.prop] || f.fx.step._default)(this)
    }, cur: function () {
        if (this.elem[this.prop] != null && (!this.elem.style || this.elem.style[this.prop] == null))return this.elem[this.prop];
        var a, b = f.css(this.elem, this.prop);
        return isNaN(a = parseFloat(b)) ? !b || b === "auto" ? 0 : b : a
    }, custom: function (a, c, d) {
        function h(a) {
            return e.step(a)
        }

        var e = this, g = f.fx;
        this.startTime = cr || cs(), this.end = c, this.now = this.start = a, this.pos = this.state = 0, this.unit = d || this.unit || (f.cssNumber[this.prop] ? "" : "px"), h.queue = this.options.queue, h.elem = this.elem, h.saveState = function () {
            e.options.hide && f._data(e.elem, "fxshow" + e.prop) === b && f._data(e.elem, "fxshow" + e.prop, e.start)
        }, h() && f.timers.push(h) && !cp && (cp = setInterval(g.tick, g.interval))
    }, show: function () {
        var a = f._data(this.elem, "fxshow" + this.prop);
        this.options.orig[this.prop] = a || f.style(this.elem, this.prop), this.options.show = !0, a !== b ? this.custom(this.cur(), a) : this.custom(this.prop === "width" || this.prop === "height" ? 1 : 0, this.cur()), f(this.elem).show()
    }, hide: function () {
        this.options.orig[this.prop] = f._data(this.elem, "fxshow" + this.prop) || f.style(this.elem, this.prop), this.options.hide = !0, this.custom(this.cur(), 0)
    }, step: function (a) {
        var b, c, d, e = cr || cs(), g = !0, h = this.elem, i = this.options;
        if (a || e >= i.duration + this.startTime) {
            this.now = this.end, this.pos = this.state = 1, this.update(), i.animatedProperties[this.prop] = !0;
            for (b in i.animatedProperties)i.animatedProperties[b] !== !0 && (g = !1);
            if (g) {
                i.overflow != null && !f.support.shrinkWrapBlocks && f.each(["", "X", "Y"], function (a, b) {
                    h.style["overflow" + b] = i.overflow[a]
                }), i.hide && f(h).hide();
                if (i.hide || i.show)for (b in i.animatedProperties)f.style(h, b, i.orig[b]), f.removeData(h, "fxshow" + b, !0), f.removeData(h, "toggle" + b, !0);
                d = i.complete, d && (i.complete = !1, d.call(h))
            }
            return!1
        }
        i.duration == Infinity ? this.now = e : (c = e - this.startTime, this.state = c / i.duration, this.pos = f.easing[i.animatedProperties[this.prop]](this.state, c, 0, 1, i.duration), this.now = this.start + (this.end - this.start) * this.pos), this.update();
        return!0
    }}, f.extend(f.fx, {tick: function () {
        var a, b = f.timers, c = 0;
        for (; c < b.length; c++)a = b[c], !a() && b[c] === a && b.splice(c--, 1);
        b.length || f.fx.stop()
    }, interval: 13, stop: function () {
        clearInterval(cp), cp = null
    }, speeds: {slow: 600, fast: 200, _default: 400}, step: {opacity: function (a) {
        f.style(a.elem, "opacity", a.now)
    }, _default: function (a) {
        a.elem.style && a.elem.style[a.prop] != null ? a.elem.style[a.prop] = a.now + a.unit : a.elem[a.prop] = a.now
    }}}), f.each(["width", "height"], function (a, b) {
        f.fx.step[b] = function (a) {
            f.style(a.elem, b, Math.max(0, a.now) + a.unit)
        }
    }), f.expr && f.expr.filters && (f.expr.filters.animated = function (a) {
        return f.grep(f.timers,function (b) {
            return a === b.elem
        }).length
    });
    var cw = /^t(?:able|d|h)$/i, cx = /^(?:body|html)$/i;
    "getBoundingClientRect"in c.documentElement ? f.fn.offset = function (a) {
        var b = this[0], c;
        if (a)return this.each(function (b) {
            f.offset.setOffset(this, a, b)
        });
        if (!b || !b.ownerDocument)return null;
        if (b === b.ownerDocument.body)return f.offset.bodyOffset(b);
        try {
            c = b.getBoundingClientRect()
        } catch (d) {
        }
        var e = b.ownerDocument, g = e.documentElement;
        if (!c || !f.contains(g, b))return c ? {top: c.top, left: c.left} : {top: 0, left: 0};
        var h = e.body, i = cy(e), j = g.clientTop || h.clientTop || 0, k = g.clientLeft || h.clientLeft || 0, l = i.pageYOffset || f.support.boxModel && g.scrollTop || h.scrollTop, m = i.pageXOffset || f.support.boxModel && g.scrollLeft || h.scrollLeft, n = c.top + l - j, o = c.left + m - k;
        return{top: n, left: o}
    } : f.fn.offset = function (a) {
        var b = this[0];
        if (a)return this.each(function (b) {
            f.offset.setOffset(this, a, b)
        });
        if (!b || !b.ownerDocument)return null;
        if (b === b.ownerDocument.body)return f.offset.bodyOffset(b);
        var c, d = b.offsetParent, e = b, g = b.ownerDocument, h = g.documentElement, i = g.body, j = g.defaultView, k = j ? j.getComputedStyle(b, null) : b.currentStyle, l = b.offsetTop, m = b.offsetLeft;
        while ((b = b.parentNode) && b !== i && b !== h) {
            if (f.support.fixedPosition && k.position === "fixed")break;
            c = j ? j.getComputedStyle(b, null) : b.currentStyle, l -= b.scrollTop, m -= b.scrollLeft, b === d && (l += b.offsetTop, m += b.offsetLeft, f.support.doesNotAddBorder && (!f.support.doesAddBorderForTableAndCells || !cw.test(b.nodeName)) && (l += parseFloat(c.borderTopWidth) || 0, m += parseFloat(c.borderLeftWidth) || 0), e = d, d = b.offsetParent), f.support.subtractsBorderForOverflowNotVisible && c.overflow !== "visible" && (l += parseFloat(c.borderTopWidth) || 0, m += parseFloat(c.borderLeftWidth) || 0), k = c
        }
        if (k.position === "relative" || k.position === "static")l += i.offsetTop, m += i.offsetLeft;
        f.support.fixedPosition && k.position === "fixed" && (l += Math.max(h.scrollTop, i.scrollTop), m += Math.max(h.scrollLeft, i.scrollLeft));
        return{top: l, left: m}
    }, f.offset = {bodyOffset: function (a) {
        var b = a.offsetTop, c = a.offsetLeft;
        f.support.doesNotIncludeMarginInBodyOffset && (b += parseFloat(f.css(a, "marginTop")) || 0, c += parseFloat(f.css(a, "marginLeft")) || 0);
        return{top: b, left: c}
    }, setOffset: function (a, b, c) {
        var d = f.css(a, "position");
        d === "static" && (a.style.position = "relative");
        var e = f(a), g = e.offset(), h = f.css(a, "top"), i = f.css(a, "left"), j = (d === "absolute" || d === "fixed") && f.inArray("auto", [h, i]) > -1, k = {}, l = {}, m, n;
        j ? (l = e.position(), m = l.top, n = l.left) : (m = parseFloat(h) || 0, n = parseFloat(i) || 0), f.isFunction(b) && (b = b.call(a, c, g)), b.top != null && (k.top = b.top - g.top + m), b.left != null && (k.left = b.left - g.left + n), "using"in b ? b.using.call(a, k) : e.css(k)
    }}, f.fn.extend({position: function () {
        if (!this[0])return null;
        var a = this[0], b = this.offsetParent(), c = this.offset(), d = cx.test(b[0].nodeName) ? {top: 0, left: 0} : b.offset();
        c.top -= parseFloat(f.css(a, "marginTop")) || 0, c.left -= parseFloat(f.css(a, "marginLeft")) || 0, d.top += parseFloat(f.css(b[0], "borderTopWidth")) || 0, d.left += parseFloat(f.css(b[0], "borderLeftWidth")) || 0;
        return{top: c.top - d.top, left: c.left - d.left}
    }, offsetParent: function () {
        return this.map(function () {
            var a = this.offsetParent || c.body;
            while (a && !cx.test(a.nodeName) && f.css(a, "position") === "static")a = a.offsetParent;
            return a
        })
    }}), f.each(["Left", "Top"], function (a, c) {
        var d = "scroll" + c;
        f.fn[d] = function (c) {
            var e, g;
            if (c === b) {
                e = this[0];
                if (!e)return null;
                g = cy(e);
                return g ? "pageXOffset"in g ? g[a ? "pageYOffset" : "pageXOffset"] : f.support.boxModel && g.document.documentElement[d] || g.document.body[d] : e[d]
            }
            return this.each(function () {
                g = cy(this), g ? g.scrollTo(a ? f(g).scrollLeft() : c, a ? c : f(g).scrollTop()) : this[d] = c
            })
        }
    }), f.each(["Height", "Width"], function (a, c) {
        var d = c.toLowerCase();
        f.fn["inner" + c] = function () {
            var a = this[0];
            return a ? a.style ? parseFloat(f.css(a, d, "padding")) : this[d]() : null
        }, f.fn["outer" + c] = function (a) {
            var b = this[0];
            return b ? b.style ? parseFloat(f.css(b, d, a ? "margin" : "border")) : this[d]() : null
        }, f.fn[d] = function (a) {
            var e = this[0];
            if (!e)return a == null ? null : this;
            if (f.isFunction(a))return this.each(function (b) {
                var c = f(this);
                c[d](a.call(this, b, c[d]()))
            });
            if (f.isWindow(e)) {
                var g = e.document.documentElement["client" + c], h = e.document.body;
                return e.document.compatMode === "CSS1Compat" && g || h && h["client" + c] || g
            }
            if (e.nodeType === 9)return Math.max(e.documentElement["client" + c], e.body["scroll" + c], e.documentElement["scroll" + c], e.body["offset" + c], e.documentElement["offset" + c]);
            if (a === b) {
                var i = f.css(e, d), j = parseFloat(i);
                return f.isNumeric(j) ? j : i
            }
            return this.css(d, typeof a == "string" ? a : a + "px")
        }
    }), a.jQuery = a.$ = f, typeof define == "function" && define.amd && define.amd.jQuery && define("jquery", [], function () {
        return f
    })
})(window);
var G = {PopOpenList: [], PupExpandList: [], RequestQueue: {}, RequestTimmer: 0, AutoNumber: 0, LoadingCss: "g-loading-on", GlobalLoading: "<div id='GlobalLoading' pclass='g-loading' style='display:none;bottom:1px;right:1px'></div>", GlobalLoadingCounter: 0, ResultSplitChar: "êêê", Channel: ["marquee"], errlog: ""};
var P = {};
$.CL = {};
$.UT = {};
P.Mod = {};
P.Utl = {};
P.Set = {};
G.cache = $.data(document.body, "cache", {htmlCache: {}, jsonCache: {}});
$.ajaxSetup({cache: false, global: false, beforeSend: function (b) {
    b.setRequestHeader("ajax", "true")
}});
if (document.uniqueID && !window.XMLHttpRequest) {
    try {
        document.execCommand("BackgroundImageCache", false, true)
    } catch (e) {
    }
}
$(window).bind("resize", function (c, g) {
    var b, f;
    if (G.PopOpenList[0] && G.PopOpenList.length) {
        for (b = 0; b < G.PopOpenList.length; b++) {
            f = $("#" + G.PopOpenList[b]).data("Dialog");
            if (f) {
                f.refreshPos()
            }
        }
    }
    if (G.errlog) {
        G.errlog.setCenter();
        G.errlog.window.offset({top: 0})
    }
});
(function () {
    var b;
    window.onresize = function () {
        if (!b) {
            b = setTimeout(function () {
                b = 0;
                $(window).triggerHandler("sizeChange", {clientHeight: document.documentElement.clientHeight, clientWidth: document.documentElement.clientWidth})
            }, 1000)
        }
    }
}());
Number.prototype.toFixed = function (m) {
    var h = this + "";
    if (!m) {
        m = 0
    }
    if (h.indexOf(".") == -1) {
        h += "."
    }
    h += new Array(m + 1).join("0");
    if (new RegExp("^(-|\\+)?(\\d+(\\.\\d{0," + (m + 1) + "})?)\\d*$").test(h)) {
        var h = "0" + RegExp.$2, g = RegExp.$1, d = RegExp.$3.length, c = true;
        if (d == m + 2) {
            d = h.match(/\d/g);
            if (parseInt(d[d.length - 1]) > 4) {
                for (var f = d.length - 2; f >= 0; f--) {
                    d[f] = parseInt(d[f]) + 1;
                    if (d[f] == 10) {
                        d[f] = 0;
                        c = f != 1
                    } else {
                        break
                    }
                }
            }
            h = d.join("").replace(new RegExp("(\\d+)(\\d{" + m + "})\\d$"), "$1.$2")
        }
        if (c) {
            h = h.substr(1)
        }
        return(g + h).replace(/\.$/, "")
    }
    return this
};
$(document).ready(function () {
    $(document.body).bind("mousedown", function (c) {
        var b, d;
        for (b in G.PupExpandList) {
            d = G.PupExpandList[b];
            if (!$.UT.InContainer(c.target, d.dom[0])) {
                d.close()
            } else {
                return true
            }
        }
        G.PupExpandList = []
    })
});
$.CL.Request = function (b) {
    this.cnet = "ajax";
    this.module = "index";
    this.action = "init";
    this.url = "";
    this.post = null;
    this.get = null;
    this.successCallback = $.UT.DefaultSuccessCallback;
    this.errorCallback = $.UT.DefaultErrorCallback;
    this.cache = false;
    this.timeout = 35000;
    this.timeoutTimer = 0;
    this.timeBegin = 0;
    this.iframe = null;
    this.iform = null;
    this.net = null;
    this.netForm = null;
    this.button = null;
    this.merge = {};
    this.mergeKey = "";
    this.globlLoadingObj = null;
    if (b) {
        $.extend(this, b)
    }
};
$.CL.Request.prototype = {resultCall: function (c) {
    var d, b = [];
    if (this.timeoutTimer) {
        clearInterval(this.timeoutTimer)
    }
    if (c.state == 1) {
        if (this.mergeKey === "") {
            this.successCallback(c.data, c.attach)
        } else {
            this.successCallback(c.data, c.attach, this.mergeKey)
        }
        b = [this.successCallback];
        for (d in this.merge) {
            var f = this.merge[d].successCallback;
            if ($.inArray(f, b) == -1) {
                b.push(f);
                f(c.data[d], c.attach)
            }
        }
    } else {
        if (c.data == "") {
            c.data = {requestUrl: this.url}
        }
        this.errorCallback(c.errors, c.data, c.state);
        b = [this.errorCallback];
        for (d in this.merge) {
            var f = this.merge[d].errorCallback;
            if ($.inArray(f, b) == -1) {
                b.push(f);
                f(c.errors, c.data, c.state)
            }
        }
    }
}, abort: function (b) {
    if (this.timeoutTimer) {
        clearInterval(this.timeoutTimer)
    }
    if (b) {
        this.successCallback = function (c) {
        };
        this.errorCallback = function (c) {
        }
    }
    if (this.net) {
        if (this.net.abort) {
            this.net.abort()
        } else {
            this.net.src = "about:blank";
            $(this.net).triggerHandler("abort")
        }
    }
}};
$.CL.Result = function (b) {
    this.state = 0;
    this.data = "";
    this.errors = null;
    this.attach = [];
    this.source = b;
    if (b) {
        this.decode(b)
    }
};
$.CL.Result.prototype = {setErrors: function (f, d) {
    var c, b;
    this.state = 0;
    this.data = "";
    this.errors = {};
    for (c in f) {
        b = f[c];
        if (b.nid != "") {
            b.eid = P.Set.ErrorMapping[b.nid][b.eid];
            b.nid = ""
        }
        this.errors[b.eid] = b
    }
}, decode: function (p) {
    var b = G.ResultSplitChar;
    var g = p.split(b);
    var h = g.length - 1, c;
    if (h > 1) {
        c = $.UT.JsonDecode(g[h]);
        g.splice(h, 1)
    }
    var r = $.UT.JsonDecode(g[0]);
    g.shift();
    if (!r || !r.hasOwnProperty("state") || !r.hasOwnProperty("data")) {
        this.setErrors([
            {nid: "framework", eid: "resultDecodeError", file: "$.CL.Result", line: 0, note: ""}
        ]);
        return false
    }
    r.state = Number(r.state);
    if (r.state != 1 && r.state != 3) {
        var q = [];
        var f;
        for (f in r.errors) {
            var o = r.errors[f];
            if (o.nid) {
                o.eid = P.Set.ErrorMapping[o.nid][o.eid]
            }
            q.push(o)
        }
    }
    if (r.state == 3) {
        var n = document.getElementById("state3");
        if (!n) {
            var n = document.createElement("div");
            n.id = "state3";
            document.body.appendChild(n);
            n.innerHTML = new Function(g[0])()
        }
        return false
    }
    this.state = r.state;
    this.data = r.data;
    this.data.cookies = $.UT.Cookie();
    this.errors = q;
    this.attach = g;
    if (c && c.hasOwnProperty("tail")) {
        var m = c.tail;
        $.UT.EndDataFun(m)
    }
}};
$.CL.Dialog = function (h, d) {
    var c, g, m = this, f;
    h = $(h);
    if (!h[0]) {
        return false
    }
    if (h.data("Dialog")) {
        return false
    }
    this.dom = h;
    this.options = {mask: true, cssClass: "", title: "Dialog", offset: {left: 0, top: 0, right: null, bottom: null}, region: document.body, resize: false, normalWidth: 0, normalHeight: 0, button: null, bodyDom: document.body, loadingM: null, maskRender: '<div class="g-dialog-mask"><!--[if lte IE 6.5]><iframe style="position:absolute;top:0;left:0;z-index:-1;width:100%;height:100%;filter:mask();"></iframe><![endif]--></div>', windowRender: '<div class="g-dialog-win elem-dialog"><div class="pop-border"><div dom="head" class="pop-hd"><h4 dom="title"></h4><a href="javascript:void(0)" dom="headico" class="headico"></a><a href="javascript:void(0)" dom="close" class="close"></a><a href="javascript:void(0)" dom="toggleSize" class="maxsize"></a></div><div class="pop-bd"><div dom="container" class="pop-container"></div></div><div class="pop-ft"></div></div></div>', color: null};
    $.extend(this.options, d);
    this.options.cssClass = h.attr("pclass") || this.options.cssClass;
    this.options.title = h.attr("ptitle") || this.options.title;
    this.options.normalWidth = h.attr("normal-width") || this.options.normalWidth;
    this.options.normalHeight = h.attr("normal-height") || this.options.normalHeight;
    h.css("display", "block");
    if (this.options.mask) {
        var b = $(".g-dialog-mask:hidden");
        var m = this;
        b.each(function (n, o) {
            if (!$(o).attr("name")) {
                m.mask = $(o);
                return false
            }
        });
        if (!this.mask) {
            this.mask = $(this.options.maskRender).appendTo(document.body)
        }
        if (this.options.color) {
            this.mask.css({background: "#000", opacity: 0.5})
        }
        if (this.options.loadingM) {
            this.mask.attr("name", this.options.loadingM)
        }
        this.mask.addClass(this.options.cssClass)
    }
    this.window = $(this.options.windowRender).appendTo(this.options.bodyDom);
    this.window.css("display", "none");
    f = $.UT.DomSelector($("*", this.window));
    this.container = $(f.container);
    this.container.append(h);
    this.head = $(f.head);
    this.title = $(f.title);
    this.body = h;
    this.toggleSizeBtn = $(f.toggleSize);
    this.toggleSize = 0;
    this.closeBtn = $(f.close);
    this.openData = null;
    this.region = null;
    this.title.html(this.options.title);
    this.window.addClass(this.options.cssClass);
    this.setResizeAble(this.options.resize, this.options.normalWidth, this.options.normalHeight);
    this.closeBtn.click(function (n) {
        m.close();
        return false
    });
    this.toggleSizeBtn.click(function (n) {
        m.toggleSize();
        return false
    });
    h.data("Dialog", this)
};
$.CL.Dialog.prototype = {setResizeAble: function (b, d, c) {
    this.options.resize = b;
    this.options.normalWidth = Number(d);
    this.options.normalHeight = Number(c);
    if (b) {
        this.toggleSizeBtn.show();
        this.container[0].style.width = this.options.normalWidth + "px";
        this.container[0].style.height = this.options.normalHeight + "px"
    } else {
        this.toggleSizeBtn.hide()
    }
}, setCssClass: function (b) {
    if (b) {
        this.window.removeClass(this.options.cssClass);
        this.mask.removeClass(this.options.cssClass);
        this.options.cssClass = b;
        this.window.addClass(b);
        this.mask.addClass(b);
        this.windowPos = {paddingWidth: this.window.width() - this.container.width(), paddingHeight: this.window.height() - this.container.height()}
    }
}, getContent: function () {
    var b = (this.body.data("ModuleLoader")) ? this.body.data("ModuleLoader") : null;
    if (b && b.module) {
        return b.module.dom
    } else {
        return this.body
    }
}, setNormalSize: function () {
    this.window.removeClass("maxsize");
    this.window.addClass("normalsize");
    this.toggleSize = 0;
    if (this.options.normalWidth) {
        this.container[0].style.width = this.options.normalWidth + "px"
    }
    if (this.options.normalHeight) {
        this.container[0].style.height = this.options.normalHeight + "px"
    }
    if (!this.options.button) {
        this.setCenter()
    } else {
        if (this.options.button != "invalid") {
            this.setFollow()
        } else {
            if (this.options.offset.right != null) {
                this.setCustomPos()
            } else {
                this.setFixed()
            }
        }
    }
}, setMaxSize: function () {
    this.window.removeClass("normalsize");
    this.window.addClass("maxsize");
    this.toggleSize = 1;
    this.window[0].style.left = 0;
    this.window[0].style.top = 0;
    this.container[0].style.width = document.documentElement.clientWidth - this.windowPos.paddingWidth + "px";
    this.container[0].style.height = document.documentElement.clientHeight - this.windowPos.paddingHeight + "px"
}, toggleSize: function () {
    if (this.toggleSize) {
        this.setNormalSize()
    } else {
        setMaxSize()
    }
}, open: function (m, v, f, c, q, h, g) {
    var s, d, n, r, b, p, o, t;
    if (this.isOpen() && !q) {
        return true
    }
    if (v === undefined) {
        v = this.options.mask
    }
    if (m !== undefined) {
        m = $(m);
        if (m[0]) {
            this.options.button = m
        } else {
            this.options.button = "invalid"
        }
    }
    if (c) {
        this.options.offset = c
    }
    this.openData = f;
    p = parseInt((+new Date()).toString().substring(4), 10);
    p++;
    if (this.mask) {
        if (v) {
            this.mask[0].style.zIndex = p;
            this.mask[0].style.display = "block"
        } else {
            this.mask[0].style.display = "none"
        }
    }
    this.window[0].style.zIndex = p + 10;
    this.toggleSize = 0;
    this.refreshPos();
    if (h) {
        this.draggable()
    }
    this.window.show();
    G.PopOpenList.push(this.body[0].id);
    this.getContent().triggerHandler("open", f, this)
}, _setMaskSize: function () {
    if (this.options.mask) {
        var b = (document.body.offsetHeight < document.documentElement.clientHeight) ? document.documentElement.clientHeight : document.body.offsetHeight;
        this.mask[0].style.height = b + "px"
    }
}, setTitle: function (b) {
    if (b) {
        this.options.title = b;
        this.title.html(b)
    }
}, setCenter: function () {
    this.window[0].style.position = "absolute";
    var b = "left", c = "top";
    if (this.window[0].style.right != "") {
        b = "right";
        c = "bottom"
    }
    this.window[0].style[b] = (document.documentElement.clientWidth - this.window.width()) / 2 + "px";
    this.window[0].style[c] = (document.documentElement.clientHeight - this.window.height()) / 2 + document.documentElement.scrollTop + "px"
}, setCustomPos: function () {
    this.window[0].style.position = "absolute";
    var b = "left", c = "top", d = "right", f = "bottom";
    if (this.options.offset.right != null) {
        b = "right";
        c = "bottom";
        d = "left", f = "top"
    }
    this.window[0].style[b] = this.options.offset[b] + "px";
    this.window[0].style[c] = this.options.offset[c] + "px";
    this.window[0].style[d] = "";
    this.window[0].style[f] = ""
}, _countRegion: function () {
    if (this.options.region) {
        if (this.options.region.left) {
            this.region = this.options.region
        } else {
            this.region = $(this.options.region);
            var g = this.region.offset();
            if (this.options.bodyDom != document.body) {
                var f = $(this.options.bodyDom).offset();
                var d = this.options.bodyDom.scrollTop;
                var c = $(this.window[0]).width();
                var b = $(this.options.bodyDom).width();
                g.left = g.left - f.left;
                if ((g.left + c) > (b - 22)) {
                    g.left = b - c - 22
                }
                g.top = g.top - f.top;
                g.top = g.top + d
            }
            this.region = {left: g.left, top: g.top, right: g.left, bottom: g.top + this.region.height()}
        }
    } else {
        this.region = null
    }
}, setFixed: function () {
    this.window[0].style.position = "absolute";
    this.window[0].style.left = this.body[0].style.left;
    this.window[0].style.right = this.body[0].style.right;
    this.window[0].style.top = this.body[0].style.top;
    this.window[0].style.bottom = this.body[0].style.bottom
}, setFollow: function () {
    if (this.region) {
        this.window[0].style.position = "absolute";
        var d = this.options.button.offset();
        if (this.options.bodyDom != document.body) {
            var c = $(this.options.bodyDom).offset();
            var b = this.options.bodyDom.scrollTop;
            d.left = d.left - c.left;
            d.top = d.top - c.top;
            d.top = d.top + b
        }
        d.top = d.top + this.options.button.height();
        d.left = d.left + this.options.offset.left;
        d.top = d.top + this.options.offset.top;
        if (d.left < this.region.left) {
            d.left = this.region.left
        }
        if (d.left > this.region.right) {
            d.left = this.region.right
        }
        if (d.top < this.region.top) {
            d.top = this.region.top
        }
        if (d.top > this.region.bottom) {
            d.top = this.region.bottom
        }
        this.window[0].style.left = d.left + "px";
        this.window[0].style.top = d.top + "px"
    }
}, refreshPos: function () {
    this._countRegion();
    if (this.toggleSize) {
        this.setMaxSize()
    } else {
        this.setNormalSize()
    }
    this._setMaskSize()
}, close: function () {
    if (this.mask) {
        this.mask.hide()
    }
    this.window.hide();
    this.openData = null;
    var b = $.inArray(this.body[0].id, G.PopOpenList);
    if (b > -1) {
        G.PopOpenList.splice(b, 1)
    }
    this.getContent().triggerHandler("close")
}, isOpen: function () {
    return this.window.css("display") != "none"
}, draggable: function () {
    var b = this.window.Widget("Drag");
    b.setHandler(this.head)
}};
$.CL.Drag = function (c, b) {
    var d = this;
    this.dom = $(c);
    this.options = {allowBubbling: false};
    this.isMouseDown = false;
    this.currentElement = null;
    this.dropCallbacks = {};
    this.dragCallbacks = {};
    this.bubblings = {};
    this.lastMouseX = 0;
    this.lastMouseY = 0;
    this.lastElemTop = 0;
    this.lastElemLeft = 0;
    this.dragStatus = {};
    this.holdingHandler = false;
    this.win = $(window);
    $.extend(this.options, b);
    this.dsddrag(d.dom, d.options.allowBubbling);
    this.mouseupcallback = function (f) {
        if (d.isMouseDown && d.dragStatus[d.currentElement.id] != "false") {
            d.isMouseDown = false;
            d.holdingHandler = false;
            if (d.dropCallbacks[d.currentElement.id] != undefined) {
                d.dropCallbacks[d.currentElement.id](f, d.currentElement)
            }
            if (d.currentElement.releaseCapture) {
                $(d.currentElement).unbind("losecapture", d.mouseupcallback);
                d.currentElement.releaseCapture()
            } else {
                d.win.unbind("blur", d.mouseupcallback)
            }
            $(document).unbind("mousemove", d.mousemovecallback);
            $(document).unbind("mouseup", d.mouseupcallback);
            return false
        }
    };
    this.mousemovecallback = function (f) {
        if (d.isMouseDown && d.dragStatus[d.currentElement.id] != "false") {
            d.updatePosition(f, d.currentElement);
            if (d.dragCallbacks[d.currentElement.id] != undefined) {
                d.dragCallbacks[d.currentElement.id](f, d.currentElement)
            }
            d.dom.triggerHandler("drag", d);
            return false
        }
    }
};
$.CL.Drag.prototype = {dsddrag: function (c, b) {
    var d = this;
    return c.each(function () {
        if (undefined == c[0].id || !c[0].id.length) {
            c[0].id = "dsddrag" + (new Date().getTime())
        }
        d.bubblings[c[0].id] = b ? true : false;
        d.dragStatus[c[0].id] = "on";
        c.css("cursor", "move");
        c.mousedown(function (f) {
            if ((d.dragStatus[c[0].id] == "off") || (d.dragStatus[c[0].id] == "handler" && !d.holdingHandler)) {
                return d.bubblings[c[0].id]
            }
            c.css("position", "absolute");
            d.isMouseDown = true;
            d.currentElement = c[0];
            if (d.currentElement.setCapture) {
                $(d.currentElement).bind("losecapture", d.mouseupcallback);
                d.currentElement.setCapture()
            } else {
                d.win.blur(d.mouseupcallback)
            }
            $(document).mousemove(d.mousemovecallback);
            $(document).mouseup(d.mouseupcallback);
            var g = d.getMousePosition(f);
            d.lastMouseX = g.x;
            d.lastMouseY = g.y;
            d.lastElemTop = c[0].offsetTop;
            d.lastElemLeft = c[0].offsetLeft;
            d.updatePosition(f, d.currentElement);
            return d.bubblings[c[0].id]
        })
    })
}, getMousePosition: function (c) {
    var b = 0, d = 0;
    if (!c) {
        var c = window.event
    }
    if (c.pageX || c.pageY) {
        b = c.pageX;
        d = c.pageY
    } else {
        if (c.clientX || c.clientY) {
            b = c.clientX + document.body.scrollLeft + document.documentElement.scrollLeft;
            d = c.clientY + document.body.scrollTop + document.documentElement.scrollTop
        }
    }
    return{x: b, y: d}
}, updatePosition: function (d, g) {
    if (window.getSelection) {
        window.getSelection().removeAllRanges()
    } else {
        document.selection.empty()
    }
    var g = $(g), b = this.win.width() + this.win.scrollLeft() - g.width(), m = this.win.height() + this.win.scrollTop() - g.height();
    var h = this.getMousePosition(d);
    var f = this.lastElemLeft + h.x - this.lastMouseX;
    var c = this.lastElemTop + h.y - this.lastMouseY;
    if (f > b) {
        f = b
    }
    if (f < 0) {
        f = 0
    }
    if (c < 0) {
        c = 0
    }
    if (c > m) {
        c = m
    }
    g.css({top: c, left: f})
}, ondrag: function (c) {
    var b = this;
    return this.dom.each(function () {
        b.dragCallbacks[dom[0].id] = c
    })
}, ondrop: function (c) {
    var b = this;
    return this.dom.each(function () {
        b.dropCallbacks[dom[0].id] = c
    })
}, dragOff: function () {
    var b = this;
    return b.dom.each(function () {
        b.dragStatus[dom[0].id] = "off"
    })
}, dragOn: function () {
    return this.each(function () {
        _this.dragStatus[dom[0].id] = "on"
    })
}, setHandler: function (b) {
    var c = this;
    b = (typeof b == "string") ? $("#" + b) : b;
    return this.dom.each(function () {
        var d = c.dom;
        c.bubblings[c.dom[0].id] = true;
        d.css("cursor", "");
        c.dragStatus[d[0].id] = "handler";
        b.css("cursor", "move");
        b.mousedown(function (f) {
            c.holdingHandler = true;
            d.trigger("mousedown", f)
        })
    })
}};
$.CL.Module = function (b) {
    this.dom = b
};
$.CL.ModuleLoader = function (b) {
    b = $(b);
    if (!b[0]) {
        return false
    }
    if ($.data(b[0], "ModuleLoader")) {
        return false
    }
    this.dom = b;
    this.moduleID = "";
    this.module = null;
    this.htmlSource = {};
    this.jsonSource = {};
    this.unified = {};
    this.romances = {};
    this.htmlCacheUpdated = {};
    this.jsonCacheUpdated = {};
    this.htmlRequest = null;
    this.jsonRequest = null;
    this.cacheType = {};
    this.historys = [];
    this.domclone = null;
    $.data(b[0], "ModuleLoader", this)
};
$.CL.ModuleLoader.prototype = {clearJsonCache: function (b) {
    G.cache.jsonCache[b] = null;
    this.jsonCacheUpdated[b] = true
}, clearHtmlCache: function (b) {
    G.cache.htmlCache[b] = null;
    this.htmlCacheUpdated[b] = true
}, changeModule: function (c, b, g, h, f, d) {
    this.isGoback = false;
    this._requestModule(c, b, g, h, f, d)
}, goBack: function (m, b, f, h, d, c) {
    this.isGoback = true;
    var g;
    if ((typeof m) == "number") {
        g = this.historys[m]
    } else {
        if ((typeof m) == "string") {
            if (jQuery.inArray(m, this.historys) != -1) {
                g = m
            }
        }
    }
    if (g) {
        this._requestModule(g, b, f, h, d, c);
        this.historys.unshift(g);
        this.historys.length = 20
    }
}, _requestModule: function (m, f, g, d, p, h) {
    var b = this, c;
    if (this.htmlRequest) {
        this.htmlRequest.abort(true);
        this.htmlRequest = null
    }
    if (this.jsonRequest) {
        this.jsonRequest.abort(true);
        this.jsonRequest = null
    }
    if (this.moduleID != m) {
        this.htmlCacheUpdated[m] = true
    }
    if (!m) {
        this._uninstall();
        return true
    }
    this.unified[m] = p;
    this.romances[m] = h;
    if (!G.cache.htmlCache[m]) {
        this.cacheType[m] = d || this.cacheType[m] || "dom";
        if (f instanceof $.CL.Request) {
            var o = f.successCallback;
            var n = f.errorCallback;
            f.successCallback = function (w, s, v) {
                b.htmlRequest = null;
                if (v) {
                    var r, q;
                    for (var t in w) {
                        r = s[w[t]];
                        q = $(r);
                        if (q.attr("tmp")) {
                            G.cache.htmlCache[t] = r
                        } else {
                            if (b.cacheType[m] != "code") {
                                G.cache.htmlCache[t] = q[0]
                            } else {
                                G.cache.htmlCache[t] = r
                            }
                        }
                    }
                } else {
                    w = s[w];
                    if (b.romances[m]) {
                        G.cache.htmlCache[m] = w
                    } else {
                        if (b.cacheType[m] != "code") {
                            G.cache.htmlCache[m] = $(w)[0]
                        } else {
                            G.cache.htmlCache[m] = w
                        }
                    }
                }
                b.htmlCacheUpdated[m] = true;
                b._doChange(m);
                if (o && o != $.UT.DefaultSuccessCallback) {
                    o(w, s)
                }
            };
            f.errorCallback = function (s, r, q) {
                b.htmlRequest = null;
                if (n && n != $.UT.DefaultErrorCallback) {
                    n(s, r, q)
                } else {
                    $.UT.DefaultErrorCallback(s, r, q)
                }
            }
        }
        this.htmlSource[m] = f || this.htmlSource[m] || '<div id="' + m + '">new module</div>';
        d = this.cacheType[m];
        f = this.htmlSource[m];
        if (f instanceof $.CL.Request) {
            this.htmlRequest = $.UT.GetActionData(f)
        } else {
            if (d == "code") {
                if (f.nodeName) {
                    c = document.createElement("div");
                    c.appendChild(f);
                    G.cache.htmlCache[m] = c.innerHTML
                } else {
                    G.cache.htmlCache[m] = f
                }
            } else {
                G.cache.htmlCache[m] = ((f.nodeName) ? f : $(f)[0])
            }
            this.htmlCacheUpdated[m] = true
        }
    }
    if (!G.cache.jsonCache[m]) {
        if (g instanceof $.CL.Request) {
            var o = g.successCallback;
            var n = g.errorCallback;
            g.successCallback = function (r, q) {
                b.jsonRequest = null;
                G.cache.jsonCache[m] = r;
                b.jsonCacheUpdated[m] = true;
                b._doChange(m);
                if (o && o != $.UT.DefaultSuccessCallback) {
                    o(r, q)
                }
            };
            g.errorCallback = function (s, r, q) {
                b.jsonRequest = null;
                if (n && n != $.UT.DefaultErrorCallback) {
                    G.cache.jsonCache[m] = r;
                    b.jsonCacheUpdated[m] = true;
                    b._doChange(m);
                    n(s, r, q)
                } else {
                    $.UT.DefaultErrorCallback(s, r, q)
                }
            }
        }
        this.jsonSource[m] = g || this.jsonSource[m] || {};
        g = this.jsonSource[m];
        if (g instanceof $.CL.Request) {
            this.jsonRequest = $.UT.GetActionData(g)
        } else {
            G.cache.jsonCache[m] = g;
            this.jsonCacheUpdated[m] = true
        }
    }
    this._doChange(m)
}, isLoading: function () {
    if (this.htmlRequest || this.jsonRequest) {
        return true
    } else {
        return false
    }
}, _doChange: function (d) {
    if (this.unified[d]) {
        if (this.htmlRequest || this.jsonRequest) {
            return false
        }
    } else {
        if (this.htmlRequest) {
            return false
        }
    }
    var c = G.cache.htmlCache[d], b = G.cache.jsonCache[d];
    if (c && this.htmlCacheUpdated[d]) {
        if (this.romances[d]) {
            this._autoRomances(d)
        } else {
            this._installHtmlCache(d)
        }
    }
    var f = this;
    setTimeout(function () {
        if (b && f.jsonCacheUpdated[d]) {
            if (f.romances[d]) {
                f._autoRomances(d)
            } else {
                f._installJsonCache(d)
            }
        }
        if (!f.jsonCacheUpdated[d] && !f.htmlCacheUpdated[d]) {
        }
    }, 0);
    f.dom.triggerHandler("changeModule", d)
}, _installHtmlCache: function (f) {
    var d, c, b, h = this;
    d = G.cache.htmlCache[f];
    if (this.isGoback) {
        this.isGoback = false
    } else {
        this.historys.unshift(f);
        this.historys.length = 20
    }
    if (d) {
        this._uninstall();
        if (d.nodeName) {
            this.dom[0].appendChild(d);
            c = d
        } else {
            this.dom[0].innerHTML = d;
            c = this.dom.children()[0]
        }
        var g = null;
        if (g) {
            setTimeout(function () {
                b = $.data(c, "Module");
                if (!b) {
                    b = $(c).Module();
                    b.parentLoader = h
                } else {
                    if (b.rebind) {
                        b.rebind()
                    }
                }
                h.module = b;
                h.moduleID = f;
                h.htmlCacheUpdated[f] = false
            }, 0)
        } else {
            b = $.data(c, "Module");
            if (!b) {
                b = $(c).Module();
                b.parentLoader = this
            } else {
                if (b.rebind) {
                    b.rebind()
                }
            }
            this.module = b;
            this.moduleID = f;
            this.htmlCacheUpdated[f] = false
        }
    }
}, _installJsonCache: function (d) {
    var c, b;
    b = G.cache.jsonCache[d];
    if (b && this.module.setData) {
        this.module.setData(b)
    }
    G.cache.jsonCache[d] = null;
    this.jsonCacheUpdated[d] = false
}, _autoRomances: function (g) {
    var d, c;
    c = G.cache.jsonCache[g];
    d = G.cache.htmlCache[g];
    var b = $(d)[0].getAttribute("tmp");
    if (b && b == g) {
        if (!c) {
            return false
        }
        var f = template.compile(d);
        var h = f(c);
        this._installRomances(g, h);
        G.cache.jsonCache[g] = null;
        this.jsonCacheUpdated[g] = false
    } else {
        this._installRomances(g, d, true)
    }
    c = null;
    d = null
}, _installRomances: function (g, f, b) {
    var d, c, m = this;
    if (this.isGoback) {
        this.isGoback = false
    } else {
        this.historys.unshift(g);
        this.historys.length = 20
    }
    if (f) {
        this._uninstall();
        if (f.nodeName) {
            this.dom[0].appendChild(f);
            d = f
        } else {
            this.dom[0].innerHTML = f;
            d = this.dom.children()[0]
        }
        var h = null;
        if (h) {
            setTimeout(function () {
                c = $.data(d, "Module");
                if (!c) {
                    c = $(d).Module();
                    c.bdata = $("[bdata]", d);
                    c.parentLoader = m;
                    m.addEvent(c)
                }
                m.module = c;
                m.moduleID = g;
                m.htmlCacheUpdated[g] = false
            }, 0)
        } else {
            c = $.data(d, "Module");
            if (!c) {
                c = $(d).Module();
                c.bdata = $("[bdata]", d);
                c.parentLoader = this;
                m.addEvent(c)
            } else {
                if (c.rebind) {
                    c.rebind()
                }
            }
            this.module = c;
            this.moduleID = g;
            this.htmlCacheUpdated[g] = false
        }
        if (b) {
            this.romancesData(g)
        }
        if (G.cache.jsonCache[g]) {
            this.module.data = G.cache.jsonCache[g];
            G.cache.jsonCache[g] = null;
            this.jsonCacheUpdated[g] = false
        }
    }
}, romancesData: function (f) {
    var d = this.module.dom, c, h = this;
    c = G.cache.jsonCache[f];
    if (!c) {
        return false
    }
    var b = this.module.bdata;
    var g = this.module.data || {};
    b.each(function (p, q) {
        var n = q.getAttribute("bdata").split(",");
        var m = n[3] ? new Function("return" + n[3])() : null;
        if (c[n[0]]) {
            if ($.isArray(c[n[0]]) && c[n[0]].length > 0) {
                if (!m.rules) {
                    console.log("没有相应的渲染规则");
                    return false
                }
                h.module[m.rules](q, c[n[0]])
            }
            if (typeof c[n[0]] == "object" && !$.isArray(c[n[0]])) {
                var o = c[n[0]][n[3]];
                var r = g[n[0]];
                if (o && o.split("_")[0] == "status") {
                }
                if ($.isArray(o)) {
                }
                if (typeof o == "string") {
                    if (!r || (r && o != r[n[3]])) {
                    }
                }
            }
            if (typeof c[n[0]] == "string" && c[n[0]] != g[n[0]]) {
                if (m && m.rules) {
                    h.module[m.rules](q, c[n[0]])
                } else {
                    switch (q.nodeName) {
                        case"INPUT":
                            q.value = c[n[0]];
                            break;
                        case"BUTTON":
                            break;
                        case"SELECT":
                            break;
                        default:
                            q.innerHTML = c[n[0]]
                    }
                }
            }
            if (n[0].split("_")[0] == "status" && c[n[0]] != g[n[0]]) {
                $(q).triggerHandler(n[0], c[n[0]])
            }
        }
        m = null;
        delete m
    });
    c = null;
    b = null;
    delete c;
    delete b
}, addEvent: function (d) {
    var f = d.dom;
    var c = d.bdata;
    d.events = "";
    var b = [];
    c.each(function (m, n) {
        var h = n.getAttribute("bdata").split(",");
        if (h[1]) {
            var o = h[1].split(" "), g = o.length, m = 0;
            for (; m < g; m++) {
                if (d.events.indexOf(o[m]) == -1) {
                    d.events += " " + o[m]
                }
            }
            b.push(n)
        }
    });
    $(f).delegate(b, d.events, function (m, n) {
        var g = m.target.getAttribute("bdata"), h;
        if (g) {
            h = g.split(",")
        }
        if (g && g.indexOf(m.type) != -1) {
            d[h[2]](m, n)
        }
        return false
    });
    f = null;
    c = null;
    b = [];
    delete b;
    delete c
}, delEvent: function (b) {
    if (b) {
        var c = b.dom;
        $(c).undelegate(b.bdata, b.events);
        b.events = ""
    }
    c = null
}, _uninstall: function (b) {
    var c = this.module, d = this.moduleID;
    if (c) {
        if (c.unbind) {
            c.unbind()
        }
        if (!this.romances[d]) {
            if (this.cacheType[d] != "code") {
                G.cache.htmlCache[d] = this.dom[0].removeChild(this.dom[0].firstChild)
            } else {
                G.cache.htmlCache[d] = this.dom[0].innerHTML;
                this.dom[0].innerHTML = ""
            }
        } else {
            if (!this.dom.children().attr("tmp")) {
                G.cache.htmlCache[d] = this.dom[0].removeChild(this.dom[0].firstChild)
            } else {
                this.delEvent(c);
                this.dom[0].innerHTML = ""
            }
        }
    } else {
        this.dom[0].innerHTML = ""
    }
    this.module = "";
    this.moduleID = ""
}};
$.CL.Validator = function (n, g) {
    n = $(n);
    if (!n[0]) {
        return false
    }
    if ($.data(n[0], "Validator")) {
        if (g) {
            $.extend(this.options, g)
        }
        return false
    }
    this.dom = n;
    this.options = {rules: {}, singleRule: true, onblur: false, callBack: {initErrors: function (o, p) {
    }, itemError: function (o) {
    }, formError: function (o) {
    }}, methods: {}};
    var c = g.methods;
    delete g.methods;
    $.extend(this.options, g);
    $.extend(this.options.methods, this.defaultMethods, c);
    this.els = $.UT.DomSelector($("input, select, textarea", n), "vname");
    var h = this;
    var f;
    var m = function (o) {
        h.verify(o.target.getAttribute("vname"))
    };
    var d = function (o) {
        h.prompt(o.target.getAttribute("vname"))
    };
    for (f in this.options.rules) {
        this.options.callBack.initErrors(f, this.els[f], this.options.rules[f]);
        var b = this.options.rules[f].events || {};
        if (this.options.onblur || b.onblur) {
            $(this.els[f]).bind("blur", m);
            $(this.els[f]).bind("focus", d)
        }
    }
    $.data(this.dom[0], "Validator", this)
};
$.CL.Validator.prototype = {formUtil: {CheckAble: function (b, d) {
    var c = d[b];
    return(c.type == "radio" || c.type == "checkbox")
}, GetLength: function (c) {
    if (c[0].nodeName == "SELECT") {
        return $("option:selected", c[0]).length
    } else {
        if (c[0].type == "text" || c[0].type == "password" || c[0].nodeName == "TEXTAREA") {
            var b = c[0].value.length;
            if (c[0].value.match(/[\u4E00-\u9FA5]/g)) {
                b += c[0].value.match(/[\u4E00-\u9FA5]/g).length
            }
            return b
        } else {
            return $("input:checked", c).length
        }
    }
}}, defaultMethods: {required: function (c, d, b) {
    return $.CL.Validator.prototype.formUtil.GetLength(c) > 0
}, minLength: function (c, d, b) {
    return $.CL.Validator.prototype.formUtil.GetLength(c) >= d
}, maxLength: function (c, d, b) {
    return $.CL.Validator.prototype.formUtil.GetLength(c) <= d
}, rangeLength: function (c, f, b) {
    var d = $.CL.Validator.prototype.formUtil.GetLength(c);
    return(d >= f[0] && d <= f[1])
}, min: function (c, d, b) {
    return Number($(c).val()) >= d
}, max: function (c, d, b) {
    return Number($(c).val()) <= d
}, range: function (c, f, b) {
    var d = Number($(c).val());
    return(d >= f[0] && d <= f[1])
}, equalTo: function (c, g, b) {
    var d = $(c).val();
    var f = $(b.els[g]).val();
    return(d == f)
}, notEqualTo: function (c, g, b) {
    var d = $(c).val();
    var f = $(b.els[g]).val();
    return(d != f)
}, attribute: function (c, f, b) {
    var d = $(c).attr(f[0]);
    return(d == f[1])
}, regExp: function (c, f, b) {
    var d = $(c).val();
    return new RegExp(f).test(d)
}, weibo_length: function (c, f, b) {
    var d = $.trim($("#" + f[0]).val());
    return d.length <= f[1] && d != f[2] && d.length != 0
}, lessThan: function (c, g, b) {
    var d = Number($(c).val());
    var f = Number($(b.els[g]).val());
    return(d <= f)
}, moreThan: function (c, g, b) {
    var d = Number($(c).val());
    var f = Number($(b.els[g]).val());
    return(d >= f)
}, isDate: function (c, f, b) {
    var d = $(c).val();
    return !/Invalid|NaN/.test(new Date(d))
}, isEmail: function (c, f, b) {
    var d = $(c).val();
    return/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i.test(d)
}, isHttp: function (c, f, b) {
    var d = $(c).val();
    return/^http:\/\/[\w\./]+\w\/$/i.test(d)
}, isNumber: function (c, f, b) {
    var d = $(c).val();
    return/^[0-9.]+$/i.test(d)
}, oddInput: function (d, g, c) {
    var f = $(d).val();
    var b = (f > g[0] && f < g[1]);
    var h = /^[1-9]\d{0,3}(\.\d{1,2})?$/.test(f);
    return b && h
}, lessThanSum: function (d, m, c) {
    var g = Number($(d).val()), b = Number($(c.els[m[0]]).val()), h = Number($(c.els[m[1]]).val()), f = g + b;
    return f <= h
}, changeNumber: function (c, d, b) {
    return true
}}, validateFields: function (b) {
    var f = this.options.rules[b];
    var h;
    var d;
    for (d in f) {
        var g = this.options.methods[d];
        var c = f[d];
        if (!g(this.els[b], c, this)) {
            if (!h) {
                h = {}
            }
            h[d] = c;
            if (this.options.singleRule) {
                break
            }
        }
    }
    if (h) {
        return h
    } else {
        return true
    }
}, verifyForm: function () {
    var d;
    var b;
    for (b in this.options.rules) {
        var c = this.validateFields(b);
        if (c !== true) {
            if (!d) {
                d = {}
            }
            d[b] = c;
            if (this.options.singleRule) {
                break
            }
        }
    }
    if (d) {
        return d
    } else {
        return true
    }
}, verify: function (c) {
    var b;
    if (c) {
        b = this.validateFields(c);
        this.options.callBack.itemError(c, b)
    } else {
        b = this.verifyForm();
        this.options.callBack.formError(b)
    }
    return b
}, prompt: function (b) {
    this.options.callBack.itemPrompt(b)
}};
$.CL.SimpleValidator = function (c, b) {
    this.validatorTooltips = {};
    this.validatorStatus = {};
    this.els = {};
    this.rules = {};
    this.vdtMsgDom = {};
    this.options = b || $.UT.JsonDecode(decodeURIComponent(c.attr("validate")));
    this.options.layout = this.options.layout || $("#layout");
    var d = this;
    this.options.errorMessages = this.options.errorMessages || {};
    this.options.callBack = {initErrors: function (f, g, p) {
        if (!g) {
            return false
        }
        d.el = g[0];
        d.els[f] = $(g[0]);
        var o = d.el.getAttribute("vmessage");
        o = o || "请输入有效数据";
        d.validatorStatus[f] = $('<span class="g-vd-status"></span>').insertAfter(d.el);
        d.rules[f] = p;
        if (p.changeNumber) {
            var n = new P.Utl.changeNumber(d.els[f].val()), h = n.pri_ary(), m = o;
            o = o + '</br><span style="color:red">' + h + "</span>&nbsp;";
            d.els[f].bind("keyup", function (r) {
                this.value = parseInt(this.value, 10).toString() != "NaN" ? parseInt(this.value, 10) : "";
                if (d.vdtMsgDom[f]) {
                    var s = new P.Utl.changeNumber(this.value), q = s.pri_ary();
                    d.validatorTooltips[f] = m + '</br><span style="color:red">' + q + "</span>&nbsp;";
                    d.vdtMsgDom[f].children("p").html(d.validatorTooltips[f]);
                    d.rePosition()
                }
            })
        }
        d.validatorTooltips[f] = o
    }, itemPrompt: function (f) {
        d.showPrompt(f)
    }, formError: function (f) {
        var m, h;
        for (m in d.validatorTooltips) {
            if (f.hasOwnProperty(m)) {
                var o = [];
                var g = d.options.errorMessages[m];
                if (g) {
                    for (var n in f[m]) {
                        if (g[n]) {
                            o.push(g[n])
                        }
                    }
                } else {
                    o.push(d.validatorTooltips[m])
                }
                d.createVdt(m, o.join("；"), 2)
            } else {
                d.removeVdt(m)
            }
        }
        return false
    }, itemError: function (h, f) {
        if (f === true) {
            d.removeVdt(h);
            d.showIco(h, true)
        } else {
            var n = [];
            var g = d.options.errorMessages[h];
            if (g) {
                for (var m in f) {
                    if (g[m]) {
                        n.push(g[m])
                    }
                }
            } else {
                n.push(d.validatorTooltips[h])
            }
            d.createVdt(h, n.join("；"), 2)
        }
        return false
    }};
    this.validator = new $.CL.Validator(c, this.options);
    this.remove = function () {
        this.hideTips();
        this.removeIco();
        $(c).removeData()
    }, c.bind("click", function (g) {
        var f = g.target.nodeName;
        if (f != "INPUT" && f != "SELECT" && f != "TEXTAREA" && f != "A" && f != "BUTTON") {
            d.hideTips()
        }
    });
    $(window).bind("scroll", function (f) {
        d.hideTips()
    });
    $(window).bind("resize", function (f) {
        d.rePosition()
    });
    d.options.layout.bind("scroll", function (f) {
        d.hideTips()
    })
};
$.CL.SimpleValidator.prototype = {verifyForm: function () {
    return this.validator.verify()
}, showPrompt: function (b) {
    if (b) {
        this.createVdt(b, this.validatorTooltips[b], 0, true)
    } else {
        for (b in this.validatorTooltips) {
            this.createVdt(b, this.validatorTooltips[b], 0, true)
        }
    }
}, hideTips: function (b) {
    if (b) {
        this.removeVdt(b)
    } else {
        for (b in this.validatorTooltips) {
            this.removeVdt(b)
        }
    }
}, hideIco: function (b) {
    if (b) {
        this.validatorStatus[b][0].className = "g-vd-status"
    } else {
        for (b in this.validatorTooltips) {
            this.validatorStatus[b][0].className = "g-vd-status"
        }
    }
}, showIco: function (b, c) {
    if (c) {
        this.validatorStatus[b][0].className = "g-vd-status g-vd-s-pass"
    } else {
        this.validatorStatus[b][0].className = "g-vd-status g-vd-s-error"
    }
}, removeIco: function (b, c) {
    if (b) {
        this.validatorStatus[b].remove();
        delete this.validatorStatus[b]
    } else {
        for (b in this.validatorTooltips) {
            this.validatorStatus[b].remove();
            delete this.validatorStatus[b]
        }
    }
}, createVdt: function (b, f, c, d) {
    this.removeVdt(b);
    this.vdtMsgDom[b] = $('<span class="g-vd-tooltip vdtId=' + b + '"><p>' + f + "</p><i></i></span>").clone().appendTo(document.body);
    if (d) {
        this.vdtMsgDom[b][0].className = "g-vd-tooltip g-vd-prompt"
    } else {
        this.vdtMsgDom[b][0].className = "g-vd-tooltip g-vd-error"
    }
    this.autoPosition(b);
    switch (c) {
        case 0:
            this.hideIco(b);
            break;
        case 1:
            this.showIco(b, true);
            break;
        case 2:
            this.showIco(b, false);
            break
    }
}, removeVdt: function (b, c) {
    if (this.vdtMsgDom[b]) {
        this.vdtMsgDom[b].remove();
        this.vdtMsgDom[b] = null
    }
}, autoPosition: function (d) {
    var c = $(window).width();
    var h = $(document).scrollLeft();
    if (d) {
        var f = this.vdtMsgDom[d];
        var g = this.els[d];
        if (f) {
            if (g.length > 0 && (g.offset().left + f.width()) >= (c + h)) {
                var b = (c + h - g.offset().left - 5);
                if (b < g.width()) {
                    f[0].style.width = g.width() + "px"
                } else {
                    f[0].style.width = b + "px"
                }
            }
            f[0].style.zIndex = parseInt((+new Date()).toString().substring(4), 10) + 10;
            f[0].style.top = (g.offset().top - f.height()) + "px";
            f[0].style.left = g.offset().left + "px"
        } else {
        }
    }
}, rePosition: function (b) {
    if (b) {
        this.autoPosition(b)
    } else {
        for (b in this.validatorTooltips) {
            if (this.vdtMsgDom[b]) {
                this.autoPosition(b)
            }
        }
    }
}};
$.UT.DefValue = function (b) {
    if (b.attr("dvalue")) {
        b.bind("focus", function (c) {
            if ($.trim(c.target.value) == c.target.getAttribute("dvalue")) {
                c.target.value = ""
            }
        });
        b.bind("blur", function (c) {
            if ($.trim(c.target.value) == "") {
                c.target.value = c.target.getAttribute("dvalue")
            }
        });
        b.val(b.attr("dvalue"))
    }
};
$.UT.GetActionData = function (c) {
    if (c.button) {
        c.button = $(c.button);
        if (c.button.hasClass(G.LoadingCss)) {
            return false
        } else {
            c.button.addClass(G.LoadingCss)
        }
    }
    var f = P.Set.ActionMapping[c.module][c.action], d, b;
    if (f.url) {
        c.url = f.url
    }
    if (f.hasOwnProperty("mergeKey")) {
        c.mergeKey = f.mergeKey
    }
    if (typeof(c.post) == "function") {
        c.post = c.post()
    }
    if (typeof(c.get) == "function") {
        c.get = c.get()
    }
    if (typeof(c.post) == "string") {
        c.post = $.UT.UnParam(c.post)
    }
    if (typeof(c.get) == "string") {
        c.get = $.UT.UnParam(c.get)
    }
    if (f.post) {
        c.post = f.post(c.post)
    }
    if (f.get) {
        c.get = f.get(c.get)
    }
    d = new $.CL.Request(c);
    d.cnet = d.cnet.toLowerCase();
    d.method = ((d.post) ? "post" : "get");
    if (G.RequestQueue[d.url]) {
        if (d.mergeKey) {
            G.RequestQueue[c.url].merge[d.mergeKey] = d;
            d = G.RequestQueue[c.url]
        } else {
            return false
        }
    } else {
        G.RequestQueue[d.url] = d
    }
    if (!G.RequestTimmer) {
        G.RequestTimmer = setTimeout(function () {
            var g;
            G.RequestTimmer = 0;
            for (g in G.RequestQueue) {
                $.UT.GetRemoteData(G.RequestQueue[g])
            }
            G.RequestQueue = {}
        }, 1)
    }
    return d
};
$.UT.GetRemoteData = function (m) {
    var h, g, f, d, c, n, b = m.module + ":" + m.action;
    if (m.globalLoading) {
        $.UT.GlobalLoading(true, m.globalLoadingMask, m.globlLoadingObj, b)
    }
    n = m.mergeKey;
    for (c in m.merge) {
        n += "," + m.merge[c].mergeKey;
        $.extend(m.get, m.merge[c].get);
        $.extend(m.post, m.merge[c].post);
        m.iframe = m.iframe || m.merge[c].iframe;
        m.iform = m.iform || m.merge[c].iform
    }
    m.url = m.url + ((m.url.indexOf("?") > -1) ? "&" : "?") + ((m.get) ? $.param(m.get) + "&" : "") + ((n !== "") ? "___=" + n + "&" : "");
    if (!m.cache) {
        if (m.action !== "get_html") {
            m.url = m.url + "&_=" + new Date().getTime()
        } else {
            m.url = m.url + "version_=" + P.Set.version
        }
    }
    m.url = m.url + "__" + m.cnet;
    m.net = $.ajax({type: m.method, url: m.url, data: m.post, timeout: m.timeout, cache: true, success: function (q, r) {
        var o, p;
        if (m.button) {
            m.button.removeClass(G.LoadingCss)
        }
        if (m.globalLoading) {
            $.UT.GlobalLoading(false, b)
        }
        o = new $.CL.Result(q);
        p = P.Set.ActionMapping[m.module][m.action];
        if (o.state && p.result) {
            o.data = p.result(o.data)
        }
        if (!o.state && p.error) {
            o.data = p.error(o.data)
        }
        m.resultCall(o)
    }, error: function (r, t, s) {
        var o, q, p;
        if (m.button) {
            m.button.removeClass(G.LoadingCss)
        }
        if (m.globalLoading) {
            $.UT.GlobalLoading(false, b)
        }
        o = new $.CL.Result();
        o.setErrors([
            {nid: "framework", eid: t, file: "mdf-full.js", line: 0, note: ""}
        ]);
        q = P.Set.ActionMapping[m.module][m.action];
        if (o.state && q.result) {
            o.data = q.result(o.data)
        }
        if (!o.state && q.error) {
            o.data = q.error(o.data)
        }
        m.resultCall(o)
    }})
};
$.UT.AutoNumber = function () {
    G.AutoNumber++;
    return G.AutoNumber
};
$.UT.CreateRequest = function (b) {
    return new $.CL.Request(b)
};
$.fn.Widget = function (c, d) {
    if (!this[0]) {
        return null
    }
    var b = $.data(this[0], c);
    if (b) {
        return b
    } else {
        b = new $.CL[c](this, d);
        $.data(this[0], c, b);
        b.dom = this;
        return b
    }
};
$.fn.Module = function (c, d) {
    if (!this[0] || !this[0].id) {
        return null
    }
    var b = $.data(this[0], "Module");
    if (b) {
        return b
    } else {
        var f;
        if (typeof c == "string") {
            f = P.Mod[c]
        } else {
            if (typeof c == "function") {
                f = c
            } else {
                f = P.Mod[this[0].id] || P.Mod[this.attr("module")]
            }
        }
        f = f || $.CL.Module;
        b = new f(this, d);
        $.data(this[0], "Module", b);
        b.dom = this;
        return b
    }
};
$.UT.DomSelector = function (h, b) {
    var d = {}, g, f, c;
    b = b || "dom";
    for (f = 0, c = h.length; f < c; f++) {
        g = h[f].getAttribute(b);
        if (g) {
            if (d[g]) {
                d[g].push(h[f])
            } else {
                d[g] = [h[f]]
            }
        }
    }
    return d
};
$.UT.InContainer = function (d, b) {
    var c = d;
    while (c != document.body) {
        if (c == b) {
            return true
        } else {
            c = c.parentNode
        }
    }
    return false
};
$.UT.MappingKey = function (c, b) {
    var f = typeof c, g, d;
    if (f == "object") {
        if (Array == c.constructor) {
            g = []
        } else {
            g = {}
        }
        for (d in c) {
            if (b[d]) {
                g[b[d]] = $.UT.MappingKey(c[d], b)
            } else {
                g[d] = $.UT.MappingKey(c[d], b)
            }
        }
    } else {
        g = c
    }
    return g
};
$.UT.GetModuleContent = function (d) {
    var c, b;
    c = /<div([\s\S]*?)>([\s\S]*)<\/div>/i;
    b = c.exec(d);
    return b[2]
};
$.UT.Param = function (b) {
    return decodeURIComponent($.param(b))
};
$.UT.UnParam = function (d) {
    d = decodeURIComponent(d);
    var c = {};
    var b = false;
    d.replace(/([^?=&]+)=([^&#]*)/g, function (f, g, h) {
        b = true;
        c[g] = h
    });
    return(b) ? c : null
};
$.UT.JsonDecode = function (c, b) {
    try {
        var f = new Function("return" + c)()
    } catch (d) {
        return null
    }
    return f
};
$.UT.Alert = function (h) {
    if (!h) {
        return false
    }
    var b = {};
    b.text = "";
    b.booLean = true;
    b.title = "用户提示";
    b.width = "400";
    b.determineCallback = null;
    b.cancelCallback = null;
    b.validate = null;
    b.buttonBL = true;
    b.closeBL = true;
    b.openCallback = null;
    b.dom = null;
    b.close = true;
    b.cFunction = null;
    b.mask = true;
    b.offset = null;
    b.CustomPos = undefined;
    b.drag = true;
    b.height = null;
    b.color = null;
    b.region = document.body;
    b.button = null;
    b.bodyDom = document.body;
    $.extend(b, h);
    var m = b.height ? b.height + "px" : "auto";
    var g = $('<div id="popLoader" class="pop_loader" ><div class="requestData" style="height:' + m + '">' + b.text + '</div><div class="btn-line"><span  autofocus="autofocus" class="yellow-btn" name="determine" tabindex="1">确 定</span><span  class="white-btn" name="cancel" tabindex="2">取消</span></div></div>');
    var f = g.Widget("Dialog", {mask: b.mask, region: b.region, button: b.button, bodyDom: b.bodyDom, color: b.color});
    g.attr("id", +new Date());
    var o = $("span[name=determine]", g), n = $("span[name=cancel]", g), c = $(".requestData", g);
    if (!b.booLean) {
        n.hide()
    } else {
        n.show()
    }
    g.bind("open close", function (q, p) {
        switch (q.type) {
            case"open":
                if (b.openCallback != null) {
                    b.openCallback(p)
                }
                o.focus().select();
                break;
            case"close":
                if (b.cancelCallback != null) {
                    b.cancelCallback()
                }
                d ? d.hideTips() : "";
                o.unbind("keydown click");
                f.window.empty();
                f.window.remove();
                if (b.color) {
                    f.mask.remove()
                }
                g.unbind();
                o.unbind();
                n.unbind();
                $.each(f, function (r, s) {
                    f.i = null;
                    delete f.i
                });
                $.each(b, function (r, s) {
                    b.i = null;
                    delete b.i
                });
                $.each(h, function (r, s) {
                    h.i = null;
                    delete h.i
                });
                G.errlog && G.errlog.window.offset({top: 0});
                b = h = null;
                f = null;
                c = null;
                o = null;
                n = null;
                g = null;
                d = null;
                p = null;
                delete g;
                delete h;
                delete b;
                delete f;
                delete o;
                delete c;
                delete n;
                delete d;
                delete p;
                q = null;
                delete q;
                P.Set.alerterror = null
        }
    });
    f.setTitle(b.title);
    f.open(b.CustomPos, undefined, null, b.offset, null, b.drag);
    b.close ? f.closeBtn.show() : f.closeBtn.hide();
    f.container[0].style.width = b.width + "px";
    if (b.height) {
        c.height(b.height)
    }
    if (b.offset) {
        f.setCustomPos()
    } else {
        f.setCenter()
    }
    f.determine = o;
    f.cancel = n;
    f.determine.focus().select();
    var d;
    if (b.validate && !b.waidiao) {
        b.validate.layout = $("body");
        d = c.children().Widget("SimpleValidator", b.validate)
    }
    o.bind("keydown click", function (r) {
        if (r.keyCode == 13 && r.type == "keydown" || r.type == "click") {
            if (b.determineCallback) {
                if (b.validate != null) {
                    if (b.waidiao) {
                        b.validate.layout = $("body");
                        var q = b.waidiao(b.validate, c);
                        d && d.remove();
                        d = c.children().Widget("SimpleValidator", q)
                    }
                    var p = d.verifyForm();
                    if (p == true) {
                        b.determineCallback();
                        if (b.buttonBL == true) {
                            f.close()
                        }
                    } else {
                        if (typeof b.cFunction === "function") {
                            b.cFunction()
                        }
                    }
                } else {
                    b.determineCallback();
                    if (b.buttonBL == true) {
                        f.close()
                    }
                }
            } else {
                f.close()
            }
        }
        if (r.keyCode == 9) {
            n.focus()
        }
        return false
    });
    n.bind("click keydown", function (p) {
        if (p.keyCode == 13 && p.type == "keydown" || p.type == "click") {
            if (b.closeBL == true) {
                f.close()
            }
        }
        if (p.keyCode == 9) {
            o.focus()
        }
        $(".g-vd-error", g).remove();
        return false
    });
    f.window.bind("drag", function (q, p) {
        d ? d.hideTips() : ""
    });
    try {
        return f
    } finally {
    }
};
$.UT.DefaultSuccessCallback = function (c, b) {
    $.UT.Alert({text: "数据接收成功，未解析（解折失败）或返回state状态问题！", booLean: false})
};
$.UT.DefaultErrorCallback = function (o, f, c, n, p, q) {
    if (!o) {
        return false
    }
    var r = "", g, m, d, h, b = 0;
    for (g in o) {
        m = o[g];
        h = m.eid;
        d = P.Set.ErrorMapping[h];
        r += d;
        if ((h + "").slice(0, 1) == "E") {
            return false
        } else {
            if (m.note) {
                r += m.note + "<br />"
            }
            b = 0
        }
    }
    if (!p) {
        booLean = false
    }
    if (q == null) {
        q = true
    } else {
        q = q
    }
    if (b == 1 && P.Set.alerterror) {
        return false
    }
    P.Set.alerterror = $.UT.Alert({text: r, booLean: booLean, close: q, determineCallback: n, cancelCallback: p})
};
$.UT.NetErrorCallback = function (o, f, c, n, p, q) {
    if (!o) {
        return false
    }
    var r = "", g, m, d, h, b = 0;
    for (g in o) {
        m = o[g];
        h = m.eid;
        d = P.Set.ErrorMapping[h];
        r += d;
        if ((h + "").slice(0, 1) == "E") {
            if (m.note) {
                r += m.note
            }
            r += "(错误码：" + h + ")";
            b = 1;
            $.log_error(r + "||" + f.requestUrl + "||");
            if (!G.errlog) {
                G.errlog = $("<span>" + r + "</span>").Widget("Dialog", {region: document.body, windowRender: '<div id="erralert" style="margin:0px auto;"><span dom="container" style="float:left;height:20px;line-height:20px;border:1px solid #dddd99; background:#ffffbf;padding:0 5px;"></span><a href="javascript:void(0)" dom="close" style="float:left;width:35px;height:20px;line-height:20px;border:1px solid #dddd99; background:#ffffbf;text-align:center;color:#CD8939;font-weight:600;font-size:14px;">X</a></div>'})
            }
            G.errlog.open("absolute", false, r);
            G.errlog.setCenter();
            G.errlog.window.offset({top: 0});
            clearTimeout(G.errlog.ttt);
            G.errlog.ttt = setTimeout(function () {
                G.errlog.close();
                clearTimeout(G.errlog.ttt)
            }, 3000);
            return false
        } else {
            if (m.note) {
                r += m.note + "<br />"
            }
            b = 0
        }
    }
    if (!p) {
        booLean = false
    }
    if (q == null) {
        q = true
    } else {
        q = q
    }
    if (b == 1 && P.Set.alerterror) {
        return false
    }
    P.Set.alerterror = $.UT.Alert({text: r, booLean: booLean, close: q, determineCallback: n, cancelCallback: p})
};
$.UT.FormatString = function (f, g, d) {
    if (!d) {
        d = ["{", "}"]
    }
    var c = new RegExp("\\" + d[0] + "([^\\" + d[0] + "\\" + d[1] + "]*)\\" + d[1], "g");
    var b = function (h, m) {
        return h.replace(c, function (o, n) {
            var p = m[n];
            return(p !== undefined) ? p : o
        })
    };
    if (c.test(f)) {
        f = b(f, g)
    }
    return f
};
$.UT.GlobalLoading = function (c, b, f, d) {
    f = f || null;
    var g = '<span class="loading"></span><span>数据加载中...</span>', h;
    if (!(G.GlobalLoading instanceof $.CL.Dialog)) {
        G.GlobalLoading = $(G.GlobalLoading).Widget("Dialog", {loadingM: "loading"})
    }
    if (!G.GlobalLoading.mActions) {
        G.GlobalLoading.mActions = {}
    }
    if (f && f.data) {
        g = f.data;
        h = f.offset
    }
    if (c) {
        G.GlobalLoadingCounter++
    } else {
        G.GlobalLoadingCounter--
    }
    if (c) {
        G.GlobalLoading.container.html(g);
        G.GlobalLoading.mActions[d] = setTimeout(function () {
            G.GlobalLoading.open("absolute", b, g, h, false, false, true);
            if (f && f.data) {
                G.GlobalLoading.setCenter()
            }
        }, 2000)
    } else {
        clearTimeout(G.GlobalLoading.mActions[b]);
        G.GlobalLoading.close()
    }
};
$.UT.Cookie = function (c, o, s) {
    if (typeof o != "undefined") {
        s = s || {};
        if (o === null) {
            o = "";
            s = $.extend({}, s);
            s.expires = -1
        }
        var f = "";
        if (s.expires && (typeof s.expires == "number" || s.expires.toUTCString)) {
            var g;
            if (typeof s.expires == "number") {
                g = new Date();
                g.setTime(g.getTime() + (s.expires * 24 * 60 * 60 * 1000))
            } else {
                g = s.expires
            }
            f = "; expires=" + g.toUTCString()
        }
        var r = s.path ? "; path=" + (s.path) : "";
        var h = s.domain ? "; domain=" + (s.domain) : "";
        var b = s.secure ? "; secure" : "";
        document.cookie = [c, "=", encodeURIComponent(o), f, r, h, b].join("")
    } else {
        var q = {};
        if (document.cookie && document.cookie != "") {
            var p = document.cookie.split(";");
            var m;
            for (m = 0; m < p.length; m++) {
                var d = jQuery.trim(p[m]);
                var n = d.split("=");
                q[n[0]] = decodeURIComponent(n[1])
            }
            if (!c) {
                try {
                    return q
                } finally {
                    q = null
                }
            } else {
                try {
                    return q[c]
                } finally {
                    q = null
                }
            }
        }
    }
};
$.UT.Templetes = function (f) {
    var b = $.UT.DomSelector($("div,tbody", f), "templete");
    var d = $.UT.DomSelector($("textarea", f), "templete");
    for (var c in b) {
        if (d[c]) {
            $(b[c]).setTemplate(d[c][0].value)
        }
    }
    try {
        return b
    } finally {
        b = null
    }
};
$.UT.EndDataFun = function (f) {
    var d = "";
    for (var c in f) {
        var h = c.toString();
        var b = f[c].toString();
        d += "<p><b>" + h + ":</b><span>" + b + "</span></p>"
    }
    var g = $.UT.Alert({text: d, booLean: false});
    window.setTimeout(function () {
        g.closeBtn.click();
        delete g
    }, 12000)
};
$.UT.Butian = function (m, b, d, c) {
    m = m.toString();
    b = (typeof b == "number") ? b : 0;
    d = (typeof d == "string") ? d : " ";
    c = (/left|right|both/i).test(c) ? c : "right";
    var g = function (p, n) {
        var o = "";
        while (o.length < n) {
            o += p
        }
        return o.substr(0, n)
    };
    var h = b - m.length;
    if (h > 0) {
        switch (c) {
            case"left":
                m = "" + g(d, h) + m;
                break;
            case"both":
                var f = g(d, Math.ceil(h / 2));
                m = (f + m + f).substr(1, b);
                break;
            default:
                m = "" + m + g(d, h)
        }
    }
    try {
        return m
    } finally {
        m = null
    }
};
$.UT.FormatString = function (f, g, d) {
    if (!d) {
        d = ["{", "}"]
    }
    var c = new RegExp("\\" + d[0] + "([^\\" + d[0] + "\\" + d[1] + "]*)\\" + d[1], "g");
    var b = function (h, m) {
        return h.replace(c, function (o, n) {
            var p = m[n];
            return(p !== undefined) ? p : o
        })
    };
    if (c.test(f)) {
        f = b(f, g)
    }
    return f
};
$.CL.EventD = function (b) {
    this.eName = [];
    this.efun = null;
    if (b) {
        $.extend(this, b)
    }
};
$.CL.EventD.prototype = {entrances: function () {
}, exports: function () {
}};
P.Utl.publicChengeModule = function (p, o, c, n, m, v, q, t, b) {
    if (!p) {
        return false
    }
    var g = {FError: $.UT.DefaultErrorCallback, BError: $.UT.DefaultErrorCallback, button: null};
    t = t || false;
    $.extend(g, b);
    c = c || "";
    o = o || "";
    if (typeof p == "string") {
        p = document.getElementById(p)
    }
    var r = $(p).Widget("ModuleLoader");
    var h = "", f = "", s = {cnet: o, module: c, button: g.button, globalLoading: true, globalLoadingMask: false, action: null, errorCallback: g.FError};
    if (n) {
        s.action = n;
        h = $.UT.CreateRequest(s);
        if (q) {
            P.Set.ActionMapping[c][n].post = q
        }
    }
    if (m) {
        s.action = m;
        s.errorCallback = g.BError;
        if (typeof v == "function") {
            P.Set.ActionMapping[c][m].post = v
        }
        if (typeof v == "object") {
            s.post = v
        }
        f = $.UT.CreateRequest(s)
    }
    var d = null;
    if (t) {
        r.clearHtmlCache(c)
    }
    r.clearJsonCache(c);
    r.changeModule(c, h, f, d, null, g.romances)
};
$.UT.publicGetAction = function (d, h, s, m, o, f, c, g) {
    actionstr = m || "get_json";
    var r = P.Set.ActionMapping[d][actionstr].post, b = {}, n, q, p;
    if (r) {
        P.Set.ActionMapping[d][actionstr].post = null
    }
    f = !(f == null) ? f : false;
    c = !(c == null) ? c : false;
    g = g || null;
    n = n || null;
    if (g) {
        if (g.data) {
            b.data = g.data;
            b.offset = g.offset || null
        } else {
            b = null
        }
        n = g.button ? g.button : null;
        q = g.timeOut || undefined;
        p = g.getBiao || null
    }
    $.UT.GetActionData({module: d, action: actionstr, post: h, get: p || null, button: n, timeout: q, globalLoading: f, globalLoadingMask: c, globlLoadingObj: b, successCallback: s || function (v) {
        var t = $("#" + d).Module();
        if (v && t) {
            t.setData(v)
        }
    }, errorCallback: o || function (y, x, w) {
        $.UT.DefaultErrorCallback(y, x, w);
        if (x.requestUrl) {
            delete x.requestUrl
        }
        var t = $("#" + d).Module();
        var v = jQuery.isEmptyObject(x);
        if ((v == false) && t) {
            t.setData(x)
        }
    }});
    h = null
};
$("#logout").bind("click", function (c) {
    var b = c.target;
    $.UT.Alert({text: "你确定要退出吗?", determineCallback: function () {
        var f = "/" + location.pathname.split("/")[1] + "/";
        var d = P.Utl.severTime().hours > 22 || P.Utl.severTime().hours < 3 ? "ssc" : "klc";
        $.UT.Cookie("sysinfo", d + "|0|b|uc|beishu100", {path: f});
        window.location.href = b.getAttribute("href")
    }});
    return false
});
$.UT.PagerRender = function (d, f, b, c) {
    $(d).val(parseInt(b, 10) || 1);
    $(f).html(parseInt(c, 10) || 1)
};
$.UT.Pager = function (g) {
    if ($(g.dom).attr("pager")) {
        return
    } else {
        $(g.dom).attr("pager", true)
    }
    var d = parseInt($("span", g.dom).html(), 10), b;
    var f = $("input", g.dom), c = {first: function (h) {
        if (h == 1) {
            return false
        }
        return 1
    }, previous: function (h) {
        if (h == 1) {
            return false
        }
        h = (h <= 1 ? 1 : h - 1);
        return h
    }, next: function (h) {
        if (h == d) {
            return false
        }
        h = (h >= d ? d : h + 1);
        return h
    }, last: function (h) {
        if (h == d) {
            return false
        }
        return d
    }, num: function (h) {
        h = parseInt(h, 10);
        if (h > d || !/^[1-9][0-9]*$/.test(h)) {
            alert("您输入的数字只能在 1 ～ " + d + "之间的正整数，请重新输入");
            f.val(f.attr("or"));
            return false
        } else {
            f.val(h);
            f.attr("or", h);
            return true
        }
    }};
    $("li", g.dom).bind("click", function (n) {
        var h = $(n.target);
        if (g.clk_count > 0) {
            return false
        }
        g.clk_count = 1;
        setTimeout(function () {
            g.clk_count = 0
        }, 500);
        if (n.target.nodeName == "LI" && h.attr("class") != "other") {
            d = parseInt($("span", g.dom).html(), 10);
            b = parseInt(f.val(), 10);
            if (isNaN(b)) {
                return
            }
            try {
                var o = c[h.attr("id")](b)
            } catch (m) {
                return false
            }
            if (o != false) {
                f.val(o);
                g.callBack({pager: f.val(), otype: h.attr("id")})
            }
        }
    });
    f.bind("focus", function (h) {
        var m = parseInt(f.val(), 10);
        d = parseInt($("span", g.dom).html(), 10);
        if (!isNaN(m) && 0 < m && m <= d) {
            f.attr("or", f.val())
        }
    });
    f.bind("keypress", function (h) {
        if (h.keyCode == 13 && h.type == "keypress") {
            d = parseInt($("span", g.dom).html(), 10);
            if (isNaN(d) || d <= 1) {
                f.val(f.attr("or"));
                return
            }
            b = f.val();
            if (c.num(b)) {
                g.callBack({pager: f.val()})
            }
        }
    })
};
$.UT.HoverList = function (b) {
    $(b.container).delegate(b.el, "mouseenter mouseleave", function (d) {
        var f = b.newClass ? b.newClass : "bc";
        d.type == "mouseenter" ? $(this).addClass(f) : $(this).removeClass(f)
    })
};
$.UT.defaultVaule = function (d, c) {
    var b = d, f = d[0];
    c = c + "";
    if (f.nodeName == "INPUT") {
        if (f.type == "radio") {
            b.removeAttr("checked");
            b.attr("defaultChecked", false);
            var h = $("[value=" + user[u] + "]", b);
            h.attr("checked", true);
            h.attr("defaultChecked", true)
        }
        if (f.type == "text") {
            b.attr("defaultValue", user[u]);
            b.val(user[u])
        }
    }
    if (f.nodeName == "SELECT") {
        var g = $("option", b);
        g.removeAttr("selected");
        g.attr("defaultSelected", false);
        $("option[value=" + user[u] + "]", b).attr("defaultSelected", true);
        b.val(user[u])
    }
    if (f.nodeName = "TEXTAREA") {
        b.attr("defaultValue", user[u]);
        b.val(user[u])
    }
};
P.Utl.tab = function (f) {
    var b = $("li", f.dom), d = 0;
    if (f.f >= 0) {
        b[f.f].className = "on"
    }
    b.bind("click", {opt: f}, function (g) {
        var c = $(g.target);
        if (c.attr("class") != "on") {
            c.siblings(".on").removeClass("on");
            c.addClass("on")
        }
        if (f.callBack) {
            g.data.opt.callBack({index: b.index(c)})
        }
    })
};
P.Utl.changeColor = function (g, b, n, r, q) {
    if (!g) {
        return false
    }
    var h = 0, o, m = "red", t = g.data("odds");
    var d = g.attr("firstLogin");
    var p = r || "red", f = q || "green", s = function () {
        g.css({color: p})
    };
    if (!t) {
        t = ""
    }
    if (t != b) {
        if (d) {
            g.css({color: f})
        } else {
            g.css({color: p}).attr("firstLogin", 1)
        }
        setTimeout(s, 3000);
        g.data({odds: b})
    } else {
        g.css({color: p})
    }
    g.html(b)
};
P.Utl.compareObjects = function (c, g) {
    var b = {};
    var f = {};
    if (jQuery.isEmptyObject(c)) {
        b = {new_obj: g, change_obj: ""};
        return b
    }
    for (var d in g) {
        if (c.hasOwnProperty(d)) {
            if (c[d] != g[d]) {
                c[d] = g[d];
                f[d] = g[d]
            }
        } else {
            f[d] = g[d];
            c[d] = g[d]
        }
    }
    b = {new_obj: c, change_obj: f};
    return b
};
P.Utl.isValueChange = function (g, b) {
    var d = $("#" + g);
    var f = "", c = d.data("valuelist");
    inputs = $("input", d), selects = $("select", d), textareas = $("textarea", d);
    inputs.each(function () {
        switch (this.type) {
            case"text":
            case"hidden":
                f += $.trim(this.value) + "#";
                break;
            case"radio":
            case"checkbox":
                f += (this.checked == true ? "true" : "false") + "#";
                break
        }
    });
    selects.each(function (h, m) {
        f += this.value + "#"
    });
    textareas.each(function () {
        f += $.trim(this.value) + "#"
    });
    if (b) {
        d.data("valuelist", f)
    }
    if (c) {
        if (f != c) {
            return true
        }
        if (!b) {
            $.UT.Alert({text: "请完成数据的修改，再提交！谢谢", booLean: false});
            return false
        }
    }
};
P.Utl.memuMask = function (b) {
    if (!G.menuMask) {
        G.menuMask = document.createElement("div")
    }
    var f = $(b);
    G.menuMask.style.cssText = "*filter:alpha(opacity=0);*background:white;position:absolute;width:" + f.width() + "px;height:" + f.height() + "px;top:" + f.offset().top + "px;left:" + f.offset().left + "px;z-index:100";
    document.body.appendChild(G.menuMask);
    setTimeout(function () {
        $(G.menuMask).remove()
    }, 500)
};
P.Utl.CountDown = function (m, g, h) {
    if (!g) {
        g = 0
    }
    if (g == 0) {
        return
    }
    var d = $("body").attr("CountDown"), c = arguments.callee, f = $(m), n = f.attr("id");
    f.attr("nc", g);
    d = d ? d : "";
    if (d.indexOf("&" + n + "&") == -1) {
        b(m);
        return
    }
    function b(s) {
        var v = $(s), o = v.attr("id"), q, t = $("body").attr("CountDown");
        t = t ? t : "";
        if (t.indexOf("&" + o + "&") == -1) {
            t = t + "&" + o + "&";
            $("body").attr("CountDown", t)
        }
        if (!v[0]) {
            $("body").removeAttr("CountDown");
            return false
        }
        q = parseInt(v.attr("nc"), 10);
        q--;
        var x = q;
        if (q < 0 || isNaN(q)) {
            q = 0
        }
        var w = parseInt((q / 3600), 10), r = parseInt(((q % 3600) / 60), 10), p = parseInt((q % 60), 10);
        w = w < 10 ? "0" + w : w;
        r = r < 10 ? "0" + r : r;
        p = p < 10 ? "0" + p : p;
        w = w == "00" ? "" : w + ":";
        v.html(w + r + ":" + p);
        v.attr("nc", q);
        if (q == 0) {
            t = t.replace("&" + o + "&", "");
            $("body").attr("CountDown", t);
            if (h && x >= 0) {
                $(h).trigger("CountDownStop", [o])
            }
            return false
        }
        c[o] = setTimeout(function () {
            if (c[o]) {
                clearTimeout(c[o])
            }
            b(s)
        }, 1000)
    }
};
$.CL.AutoRefresh = function (c, b) {
    this.id = this.id || c[0].id || "AutoRefresh";
    this.dom = c;
    this.interval = null;
    $.extend(this, this.defaultObjs, b)
};
$.CL.AutoRefresh.prototype = {defaultObjs: {stopping: 1, timenow: 0, Time: 10, urlId: "", data: null, action: "get_json", stopTimes: 0, keepOn: true, callback: $.UT.DefaultSuccessCallback, errbackfun: function (n, f, c) {
    if (!n) {
        return false
    }
    var o = "", g, m, d, h, b = 0;
    for (g in n) {
        m = n[g];
        h = m.eid;
        d = P.Set.ErrorMapping[h];
        o += d;
        if ((h + "").slice(0, 1) == "E") {
            if (m.note) {
                o += m.note
            }
            o += "(错误码：" + h + ")<br />";
            b = 1;
            $.log_error(o + "||" + f.requestUrl + "||")
        }
    }
}}, show: function (b, c) {
    var d = this;
    if (c) {
        d.data = {};
        $.extend(d.data, c)
    }
    b = b == undefined ? this.Time : b;
    if (b != 0) {
        d.Time = b - 1;
        d.intervalfun(d.Time)
    }
    d.stopping = 1;
    d.timenow = b;
    this.dom.triggerHandler("show", c, this)
}, hide: function () {
    if (this.interval) {
        clearTimeout(this.interval)
    }
    this.interval = null;
    this.stopping = 0
}, stop: function () {
    var b = this;
    if (b.stopTimes > 5 && b.keepOn === false) {
        b.stopTimes = 0;
        $.UT.Alert({text: "系统忙，请稍后重试！", booLean: false})
    } else {
        if (!b.stp) {
            b.stp = setTimeout(function () {
                b.show(b.timenow);
                delete b.stp
            }, 30000)
        }
        b.stopTimes++
    }
    b.hide()
}, intervalfun: function (b) {
    var c = this;
    c.timeValue = b;
    if (c.interval != null) {
        clearTimeout(c.interval);
        c.interval = null
    }
    if (!document.getElementById(c.urlId)) {
        c.hide()
    }
    c.interval = setTimeout(function () {
        var d = $.UT.Cookie("sysinfo") || "", g = d.split("|"), f = g[0], h = typeof P.Set.level;
        if (f != P.Set.systype && h == "undefined" && c.id != "guendanRefresh") {
            window.location.href = sysInfo().loginUrl
        }
        if (c.dom[0].tagName == "INPUT") {
            c.dom[0].value = c.timeValue
        } else {
            c.dom[0].innerHTML = c.timeValue
        }
        if (c.stopping == 1) {
            if (c.timeValue == 0) {
                $.UT.GetActionData({module: c.urlId, action: c.action, post: c.data, cnet: "autorefresh", successCallback: c.callback, errorCallback: c.errbackfun});
                c.intervalfun(c.Time)
            } else {
                c.intervalfun(c.timeValue);
                c.timeValue--
            }
        } else {
            clearTimeout(c.interval)
        }
    }, 1000)
}};
(function () {
    var d = 0;
    $("a", "#select_sys").bind("click", function (g) {
        var h = g.target.id, f = /^(klc_sys|ssc_sys|pk10_sys|nc_sys|ks_sys)$/;
        if (f.test(h)) {
            d = 1;
            c(g);
            return false
        }
    });
    function c(h) {
        P.Utl.memuMask("#select_sys");
        var f = $("#side_left").data("Module");
        if (f && f.alertOrder) {
            var g = "你确定取消注单,切换系统吗？";
            $.UT.Alert({text: g, determineCallback: function () {
                G.RequestQueue = {};
                b(h);
                f.alertOrder.close();
                f.alertOrder = null;
                if (f.alertOrderK) {
                    f.alertOrderK.close();
                    f.alertOrderK = null
                }
            }, cancelCallback: function () {
                if (f.alertOrder) {
                    f.alertOrder.determine.focus().select()
                }
            }})
        } else {
            G.RequestQueue = {};
            b(h);
            if (f && f.alertOrderK) {
                f.alertOrderK.close();
                f.alertOrderK = null
            }
        }
    }

    function b(q) {
        var o = $("#layout").Module(), f = q.target.id;
        $(".switch-on").removeClass("switch-on");
        $(q.target).addClass("switch-on");
        var s = "/" + window.location.pathname.split("/")[1] + "/", h = $.UT.Cookie("sysinfo") || "", r = h.split("|");
        var p = P.Set.navNumber;
        $(".seeresults").hide();
        var m = f.split("_")[0];
        P.Set.navNumber = P.Set["navNumber_" + m];
        P.Set.systype = m;
        r[0] = m;
        $("." + m + "-results").show();
        for (var g in P.Set.navNumber) {
            if (p[g] == P.Set.navNum) {
                o.setLayout(P.Set.navNumber[g])
            }
        }
        $.UT.Cookie("sysinfo", r.join("|"), {path: s});
        $("#select_sys").triggerHandler("changesys", P.Set.systype)
    }
})();
(function () {
    var d = $(".more_announcement"), b = function (g, f) {
        if (f) {
            return g.replace(/"/g, "ahrrncj2012")
        } else {
            return g.replace(/ahrrncj2012/g, '"')
        }
    }, c = function (g) {
        var n = {text: "<table class='bet-table z3-table more_announcement'><tr><th style='width:110px'>时间</th><th>公告详情</th></tr><tbody class='more_ann_box'><tr><td colspan='2'></td></tr></tbody></table><div id='comment'></div>", title: "历史公告", booLean: false, width: 750, height: 350};
        var f = {};
        n.color = typeof g === "string" ? g : null;
        if (typeof g === "string") {
            n.height = 0;
            if (P.Set.noticeBox == 0) {
                return
            }
        } else {
            f.action = "more"
        }
        var h = $.UT.Alert(n);
        $.UT.publicGetAction("header", f, function (r) {
            var v = r.announcement, o = v.length || 0, t = "", s;
            if (o && o > 0) {
                for (var q = 0; q < o; q++) {
                    s = v[q];
                    t += "<tr><td>" + s[0] + "</td><td style='text-align:left;text-indent:2em;'>" + b(s[1], 0) + "</td></tr>"
                }
                $(".more_ann_box").html(t);
                $.UT.HoverList({container: ".more_announcement", el: "tr"})
            }
        }, "more_announcement");
        var m = function (p) {
            var q = p.keyCode, o = arguments.callee;
            if (q == 13 && h) {
                h.close();
                if (document.removeEventListener) {
                    document.removeEventListener("keypress", o, false)
                }
                if (document.detachEvent) {
                    document.detachEvent("onkeypress", o)
                }
            }
        };
        if (document.addEventListener) {
            document.addEventListener("keypress", m, false)
        }
        if (document.attachEvent) {
            document.attachEvent("onkeypress", m)
        }
        if (h.determine && h.determine.focus) {
            h.determine.focus()
        }
        return h
    };
    d.bind("click", c);
    P.Utl.announcement = c
})();
P.Utl.playmp3 = function (b, c, q, r) {
    var g = document.domain;
    c = c || null;
    q = q || false;
    r = r || 3000;
    if (!b) {
        return false
    }
    if (c) {
        var p = "/wav/" + c;
        var m = '<div id="player" style="display:none"><!--[if lte IE 8]><bgsound src="' + p + '.mp3"  autostart=true loop=1 /> <![endif]--><audio autoplay><source src="' + p + '.mp3"><source src="' + p + '.ogg"></audio></div>';
        if ($("#player")[0]) {
            var o = $("#player").children("bgsound"), h = $("#player").children("audio");
            if (o[0]) {
                var d = false;
                o.each(function (s, t) {
                    var v = $(t).attr("src");
                    if (v == p + ".mp3") {
                        $(t).attr("src", p + ".mp3");
                        d = true;
                        return
                    }
                });
                if (!d) {
                    var n = '<bgsound src="' + p + '.mp3"  autostart=true loop=1 />';
                    $("#player").append(n)
                }
            } else {
                if (h[0]) {
                    var d = false;
                    h.each(function (t, v) {
                        var s = v.currentSrc;
                        if (s == p + ".mp3" || s == p + ".ogg") {
                            if (v.play) {
                                v.play();
                                d = true;
                                return
                            }
                        }
                    });
                    if (!d) {
                        var n = '<audio autoplay><source src="' + p + '.mp3"><source src="' + p + '.ogg"></audio>';
                        $("#player").append(n)
                    }
                }
            }
        } else {
            $("body").append(m)
        }
    }
    if (!q) {
        var f = $.UT.Alert({mask: false, width: "300", text: b, booLean: false, offset: {right: 0, bottom: 0}, drag: false, CustomPos: "custom"});
        window.setTimeout(function () {
            f.closeBtn.click();
            delete f
        }, 10000)
    }
};
P.Utl.severTime = function () {
    var c = P.Set.tt, t = {}, z = 86400000;
    var q = new Date(Number(c));
    if (q.getHours() < 5) {
        q = new Date(q - z)
    }
    var h = q.getDay();
    var v = q.getDate();
    var f = q.getMonth();
    var o = q.getFullYear();

    function r(d) {
        var C = d.getFullYear();
        var E = d.getMonth() + 1;
        var D = d.getDate();
        if (E < 10) {
            E = "0" + E
        }
        if (D < 10) {
            D = "0" + D
        }
        return(C + "-" + E + "-" + D)
    }

    function A(D) {
        var d = new Date(o, D, 1);
        var C = new Date(o, D + 1, 1);
        var E = (C - d) / (1000 * 60 * 60 * 24);
        return E
    }

    function B() {
        var d;
        if (h == 0) {
            d = new Date(o, f, v - h - 6)
        } else {
            d = new Date(o, f, v - h + 1)
        }
        return r(d)
    }

    function g() {
        var d;
        if (h == 0) {
            d = new Date(o, f, v + (6 - h) - 6)
        } else {
            d = new Date(o, f, v + (6 - h) + 1)
        }
        return r(d)
    }

    function s() {
        var d;
        if (h == 0) {
            d = new Date(o, f, v - h - 13)
        } else {
            d = new Date(o, f, v - h - 6)
        }
        return r(d)
    }

    function x() {
        var d;
        if (h == 0) {
            d = new Date(o, f, (v - 13) + (6 - h))
        } else {
            d = new Date(o, f, (v - 6) + (6 - h))
        }
        return r(d)
    }

    function y() {
        var d = new Date(o, f, 1);
        return r(d)
    }

    function b() {
        var d = new Date(o, f, A(f));
        return r(d)
    }

    t.day = r(q);
    var w = new Date(q - z);
    t.b_day = r(w);
    var n = new Date(Number(+q + z));
    t.n_day = r(n);
    t.week_b = B();
    t.week_e = g();
    t.b_week_b = s();
    t.b_week_e = x();
    t.month_b = y();
    t.month_e = b();
    var p = new Date(o, f - 1, 1);
    t.b_month_b = r(p);
    var m = new Date(o, f - 1, A(f - 1));
    t.b_month_e = r(m);
    t.hours = q.getHours();
    return t
};
function letterformat(c, b) {
    if (b) {
        return c.replace(/"/g, "ahrrncj2012")
    } else {
        return c.replace(/ahrrncj2012/g, '"')
    }
}
document.body.oncontextmenu = function () {
    return false
};
P.Utl.winSetData = function (d) {
    if (!d) {
        return false
    }
    var b = document.getElementById("win"), c = "";
    if (d.hasOwnProperty("win") && b) {
        if (d.win) {
            P.Set.win = d.win
        }
        if (P.Set.win.toString().indexOf("-") > -1) {
            c = "reder"
        }
        b.className = c + " bold";
        b.innerHTML = P.Set.win
    }
};
P.Utl.nCLBindData = function (f) {
    var m = f.betnotice;
    if (m) {
        var h = m.resultnum;
        if (h.length > 0) {
            var b = $("#resultnum").children();
            $(h).each(function (d) {
                $(b[d]).removeClass();
                if (h[d]) {
                    $(b[d]).addClass("number num" + parseInt(h[d], 10))
                }
            })
        } else {
            var b = $("#resultnum").children();
            b.each(function (d) {
                this.className = ""
            })
        }
    }
    if (f.changlong && f.changlong.length > 0) {
        var o = [], q = f.changlong, g = 0;
        if (f.changlong[0].length == 6) {
            var n = q.length;
            for (; g < n; g++) {
                var c = q[g];
                var p = ['<tr style="background:#EBF5FF;" style="font-weight:normal"><td class="bg-pink" style="color:black;font-weight:normal;background:#FFD0D0">', c[0], '</td><td colspan="4" style="text-align:center"><code class="number num', c[1], '"></code><code class="number num', c[2], '"></code><code class="number num', c[3], '"></code></td><td>', c[4], '</td><td style="color:', c[5] == "大" ? "red" : c[5] == "小" ? "" : "green", '">', c[5], "</td></tr>"];
                o.push(p.join(""))
            }
        } else {
            for (; g < q.length; g++) {
                txt = ['<tr><td class="grey blue" style="border-right:none;width:38%;">', q[g][0], '</td><td class="grey blue" style="border-left:none;width:32%;">', q[g][1], '</td><td class="bg-pink bg-pink2" style="width:30%;">', q[g][2], "</td></tr>"];
                o.push(txt.join(""))
            }
        }
        $("#changlong").html(o.join(""))
    } else {
        $("#changlong").html('<tr><td class="align-c">暂无数据</td></tr>')
    }
};
var _change = {ary0: ["零", "一", "二", "三", "四", "五", "六", "七", "八", "九"], ary1: ["", "十", "百", "千"], ary2: ["", "万", "亿", "兆"], init: function (b) {
    this.name = b
}, strrev: function () {
    if (!this.name || (/^0|\D/.test(this.name) && parseInt(this.name, 10) != 0)) {
        return false
    }
    var c = [];
    for (var b = this.name.length; b >= 0; b--) {
        c.push(this.name.charAt(b))
    }
    return c.join("")
}, pri_ary: function () {
    var m = this;
    var f = this.strrev();
    if (!f) {
        return""
    }
    if (Number(f) == 0) {
        return this.ary0[0]
    }
    var g = "";
    var b = "";
    var c = -1;
    var h = "";
    for (var d = 0; d < f.length; d++) {
        if (d % 4 == 0) {
            c++;
            b = this.ary2[c] + b;
            if (d >= 8 && b.charAt(1) == this.ary2[c - 1]) {
                b = b.replace(b.charAt(1), "")
            }
            g = ""
        }
        if (f.charAt(d) == "0") {
            switch (d % 4) {
                case 0:
                    break;
                case 1:
                case 2:
                case 3:
                    if (f.charAt(d - 1) != "0") {
                        g = "零"
                    }
                    break
            }
            b = g + b;
            g = ""
        } else {
            b = !parseInt(f.charAt(d)) ? "" : this.ary0[parseInt(f.charAt(d))] + this.ary1[d % 4] + b
        }
    }
    if (b.indexOf("零") == 0) {
        b = b.substr(1)
    }
    return b
}};
P.Utl.changeNumber = function () {
    this.init.apply(this, arguments)
};
P.Utl.changeNumber.prototype = _change;
window.onunload = function () {
    for (var b in G.cache.htmlCache) {
        $(G.cache.htmlCache[b]).remove();
        G.cache.htmlCache[b] = ""
    }
    G.cache = null
};
var indexData = sysInfo();
P.Set = {Errors: "", ErrorMapping: "", LanguageMapping: {}, Domain: document.domain, DomainOK: "", RemoteService: "", ActionMapping: {}, UserLoginUrl: "", Platform: "3D", status: document.body.getAttribute("status"), permis: document.body.getAttribute("showList"), moduleNav: parseInt(document.body.getAttribute("navNum"), 10) || 8, firstLogin: parseInt(document.body.getAttribute("firstLogin"), 10) || 0, reE: /^(?:(?!0000)[0-9]{4}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-8])|(?:0[13-9]|1[0-2])-(?:29|30)|(?:0[13578]|1[02])-31)|(?:[0-9]{2}(?:0[48]|[2468][048]|[13579][26])|(?:0[48]|[2468][048]|[13579][26])00)-02-29)$/, level: indexData.level, report: indexData.report, version: indexData.version, dat: indexData.day, limitDay: indexData.limitDay, masterId: indexData.masterId, sID: indexData.sID, ac: indexData.ac, pw: indexData.pw, tt: indexData.tt, pa: indexData.pa, ip: indexData.ip, tk: indexData.tk, cid: indexData.cid, cn: indexData.cn, rs: indexData.rs, ui: indexData.ui, win: indexData.win, noticeBox: indexData.noticeBox, navNum: parseInt(document.body.getAttribute("navNum"), 10), onlineRefresh: indexData.onlineRefresh + "000", online: indexData.online, drawStatus: -1, systype: "klc", porttype: indexData.porttype, isShowRollOrder: indexData.isShowRollOrder || 0, pk10Times: indexData.pk10Times, log4jsonoff: indexData.log4jsonoff, lines: indexData.lines, qajaxT: (new Date().getHours() >= 22 || new Date().getHours() < 2) ? 120 : 420};
indexData = null;
(function () {
    var c = location.href.split("//")[1];
    P.Set.Domain = c.split("/")[0];
    P.Set.DomainOK = 1;
    var d = P.Set.Domain;
    try {
        if (!document.toSource) {
            document.domain = P.Set.Domain
        }
    } catch (b) {
        P.Set.DomainOK = 0
    }
}());
P.Set.RemoteService = "http://" + P.Set.Domain + "/";
P.Set.UserLoginUrl = "http://" + P.Set.Domain + "/";
(function () {
    if (!P.Set.sID) {
        return
    }
    var d = "/" + location.pathname.split("/")[1] + "/", f = $.UT.Cookie("sysinfo");
    if (!f || f == 0) {
        var b = P.Utl.severTime().hours > 22 || P.Utl.severTime().hours < 3 ? "ssc" : "klc";
        $.UT.Cookie("sysinfo", b + "|0|b|uc|beishu100", {path: d})
    }
})();
P.Utl.valModule = function (b) {
    if (b.parentLoader.moduleID !== b.dom[0].id) {
        return false
    } else {
        return true
    }
};
P.Utl.getValCtl = function (d) {
    var f, g;
    for (var h in d) {
        f = h
    }
    for (var b in d[f]) {
        g = b
    }
    return{ctl: f, msg: g}
};
P.Utl.accountCheck = function (b) {
    $(".accountError").remove();
    $("input[name='account']").focusout(function (g) {
        var f = $(this).val();
        var d = {};
        var c = $(this).prop("readonly");
        if (f.length < 1 || c == true) {
            $(".accountError").remove();
            return false
        }
        d.account = f;
        $.UT.publicGetAction(b, d, function (p) {
            if (p.Already == false) {
                $(".accountError").remove();
                return
            }
            var n = '<span class="g-vd-tooltip g-vd-error accountError" style="z-index: 99999999999; top: 42px; left: 603px;" id="accountError"><p>您输入的账号已经存在！</p><i></i></span>';
            $(n).appendTo($("#user_info"));
            var m = $(window).width();
            var r = $(document).scrollLeft();
            var o = $(".accountError");
            var q = $("input[name='account']");
            if (q.length > 0 && (q.offset().left + o.width()) >= (m + r)) {
                var h = (m + r - q.offset().left - 5);
                if (h < q.width()) {
                    o[0].style.width = q.width() + "px"
                } else {
                    o[0].style.width = h + "px"
                }
            }
            o[0].style.zIndex = parseInt((+new Date()).toString().substring(4), 10) + 10;
            o[0].style.top = (q.position().top - o.height()) + "px";
            o[0].style.left = q.offset().left + "px"
        }, "check_user")
    });
    $("input[name='account']").focusin(function () {
        $(".accountError").remove()
    })
};
P.Utl.renderUser = function (C, v, w) {
    var h = $("#user_info"), p = "", z, E = C.user || {}, o = {};
    $.extend(true, o, v);
    if (w !== 0) {
        if (!E.credit) {
            E.credit = 0
        }
    }
    if (w === 5) {
        o.errorMessages.credit.min = o.errorMessages.credit.min.replace("上级信用总额必须大于下级信用总额之和", "信用额度不能小于会员可回收金额");
        delete o.errorMessages.share_total;
        delete o.rules.share_total
    }
    if (w == 1) {
        delete o.errorMessages.share_up;
        delete o.rules.share_up
    }
    if (!C.maxShareTotal) {
        C.maxShareTotal = [100, 0]
    }
    if (C.userid) {
        if (o.rules && o.rules.password && o.rules.repassword) {
            delete o.rules.password.required;
            delete o.rules.repassword.required
        }
        $("input:password", h).attr("vmessage", "6~16位数字、字母组成！(为空表示密码不修改)")
    }
    E.share_total = E.share_total === undefined ? 0 : parseInt(E.share_total, 10);
    E.share_up = E.share_up === undefined ? 0 : parseInt(E.share_up, 10);
    for (var q in E) {
        z = $("[name=" + q + "]", h);
        if (z.length == 0) {
            continue
        }
        switch (q) {
            case"name":
            case"account":
                E[q] = E[q] + "";
                z.prop("defaultValue", E[q]);
                z.val(E[q]);
                break;
            case"share_flag":
            case"corpRptFlag":
            case"short_covering":
            case"ylchFlag":
            case"isDgdShare":
            case"detRptFlag":
            case"beishu_set":
                E[q] = E[q] + "";
                z.removeAttr("checked").prop("defaultChecked", false);
                if (q == "detRptFlag") {
                }
                if (q == "beishu_set") {
                    if (!E["p_" + q]) {
                        z.attr("disabled", true)
                    } else {
                        z.removeAttr("disabled")
                    }
                }
                for (var y = 0; y < z.length; y++) {
                    if (z[y].value == E[q]) {
                        var x = $(z[y]);
                        x.attr("checked", true).prop("defaultChecked", true);
                        break
                    }
                }
                break;
            case"credit":
                C.minCredit = parseInt(C.minCredit, 10);
                C.maxCredit = parseInt(C.maxCredit, 10);
                if (!isNaN(C.minCredit) && o.rules) {
                    o.rules.credit.min = C.minCredit;
                    o.errorMessages.credit.min = o.errorMessages.credit.min.replace(":0", ":" + C.minCredit)
                }
                if (!isNaN(C.maxCredit) && o.rules) {
                    o.rules.credit.max = C.maxCredit;
                    o.errorMessages.credit.max = o.errorMessages.credit.max.replace(":999999999", ":" + C.maxCredit)
                }
                if (o.rules) {
                    $("input[name=credit]", h).attr("vmessage", o.rules.credit.min + "~" + o.rules.credit.max).attr("title", o.rules.credit.min + "~" + o.rules.credit.max)
                }
                E[q] = E[q] + "";
                z.prop("defaultValue", E[q]).val(E[q]);
                break;
            case"odds_set":
                E[q] = E[q] + "";
                var m = "C";
                if (C.superior) {
                    m = C.superior[2]
                }
                z.html(P.Utl.oddSetGet(m, E[q]));
                break;
            case"status":
                E[q] = parseInt(E[q], 10);
                $("option", z).remove();
                var c = ["停用", "启用", "停押", "禁止登录"], D = "", d = 3, b = "";
                if (E[q] == 3) {
                    d = 4
                }
                for (var n = 0; n < d; n++) {
                    if (E[q] == n) {
                        D = "selected"
                    } else {
                        D = ""
                    }
                    b += "<option value='" + n + "' " + D + ">" + c[n] + "</option>"
                }
                z.html(b);
                break;
            case"share_total":
                p = "";
                var g = C.maxShareTotal[1], f = C.maxShareTotal[0] - E.share_up, y;
                E[q] = parseInt(E[q], 10);
                if (E[q] > f) {
                    E[q] = f
                }
                if (g % 5 == 0) {
                    y = g
                } else {
                    y = Math.ceil(g / 5) * 5
                }
                for (; y <= f; y = y + 5) {
                    p += "<li>" + y + "</li>"
                }
                $("#share_total_list").html(p);
                z.prop("defaultValue", E[q]).val(E[q]);
                break;
            case"share_up":
                p = "";
                var g = 0, f = C.maxShareTotal[0] - C.maxShareTotal[1];
                for (y = 0; y <= f; y = y + 5) {
                    p += "<li>" + y + "</li>"
                }
                $("#share_up_list").html(p);
                z.prop("defaultValue", E[q]).val(E[q]);
                break;
            case"set_water":
                var B = E.set_water, p = "", A, t = "";
                p += "<option " + (B == 0 ? "selected" : "") + " value='0'>水全退到底</option>";
                p += "<option " + (B == 100 ? "selected" : "") + " value='100'>赚取所有退水</option>";
                for (var y = 5; y < 35; y = y + 5) {
                    A = y / 100;
                    t = "";
                    if (A == B) {
                        t = "selected"
                    }
                    p += "<option " + t + " value='" + A + "'>赚取" + A + "%退水</option>"
                }
                z.html(p);
                break
        }
    }
    P.Utl.xselect(w, C.maxShareTotal);
    if (C.user && C.user.isShareGray) {
        $("#share_flag2").attr("disabled", "disabled")
    }
    if (w == 1 || w == 5) {
        $(".share_up_div input").bind("keyup", function (F) {
            var r = F.keyCode;
            if (r != 13) {
                var s = this.value;
                if (/\D/g.test(s)) {
                    this.value = s.slice(0, s.length - 1)
                }
                s = parseInt(s, 10);
                if (s > C.maxShareTotal[0]) {
                    this.value = C.maxShareTotal[0]
                }
            }
        })
    }
    if (!!C.isDisabled) {
        $("input[name=share_flag],input[name=share_total]", h).attr("disabled", true)
    }
    z = null;
    h = null;
    return o
};
P.Utl.oddSetGet = function (m, c) {
    var n = ["A", "B", "C"], h = "<option vlaue='{oddset}' {selected}>{oddset}</option>", g = "", b = n.length;
    for (var f = 0; f < b; f++) {
        var d = n[f] === c ? "selected" : "";
        g += h.replace(/{oddset}/g, n[f]).replace("{selected}", d);
        if (n[f] === m) {
            break
        }
    }
    return g
};
P.Utl.commonRelues = {rules: {name: {required: 1, maxLength: 16, regExp: /^[a-zA-Z0-9_\.\u4e00-\u9fa5]{1,16}$/}, account: {required: 1, regExp: /^[a-z0-9A-Z][a-z0-9A-Z_]{0,11}$/}, credit: {required: 1, isNumber: 1, min: 0, max: 999999999, regExp: /^0$|^[1-9]{1}[0-9]{0,8}$/, changeNumber: true}, password: {required: 1, notEqualTo: "account", regExp: /^\s{0}$|^[0-9a-zA-Z]{6,16}$/}, repassword: {required: 1, regExp: /^\s{0}$|^[0-9a-zA-Z]{6,16}$/, equalTo: "password"}}, onblur: true, errorMessages: {name: {required: "请输入用户名称！", maxLength: "名称由汉字的简繁体(一个汉字2位字符)、圆点（.）、字母、数字、下划线组成，长度不超过16个英文字符或8个汉字！", regExp: "名称由汉字的简繁体(一个汉字2位字符)、圆点（.）、字母、数字、下划线组成，长度不超过16个英文字符或8个汉字！"}, account: {required: "请输入用户账号！", regExp: "账号由1-12位英文字母、数字、下划线组成，且第一位不能是下划线!"}, credit: {isNumber: "信用额度由不大于9位的整数组成", required: "请输入信用额度！", regExp: "信用额度由不大于9位的整数组成", min: "上级信用总额必须大于下级信用总额之和:0", max: "下级信用总额不能超过上级剩余信用总额度:999999999"}, password: {required: "请输入密码！", notEqualTo: "为了账号安全，密码不能和账号相同", regExp: "密码由6~16位数字、字母组成！"}, repassword: {required: "请输入密码！", regExp: "密码由6~16位数字、字母组成！", equalTo: "两次输入的密码不一致！"}}};
P.Utl.buhuoRules = {rules: {discount: {regExp: /^0(\.\d{1,2})?$|^[1-9]\d?(\.\d{1,2})?$/}, odd: {min: 0, regExp: /^(?:0|[1-9]\d{0,3})(\.\d{1,3})?$/}, sum: {regExp: /^[1-9]\d{0,8}$/}}, onblur: false, errorMessages: {discount: {regExp: "退水由小于100的整数组成，允许输入两位小数"}, odd: {min: "赔率大于等于0，长度为1-4的整数，允许最多带三位小数", regExp: "赔率大于等于0，长度为1-4的整数，允许最多带三位小数"}, sum: {regExp: "金额由不大于9位的正整数组成"}}};
P.Utl.renderGame = function (h, b, d) {
    var f = {rules: {}, onblur: false, errorMessages: {}}, c, p, n, d = d || {klc: 1, ssc: 1, pk10: 1, nc: 1, ks: 1};
    var o = function (Q, g, z, K, B) {
        if (z) {
            for (var M in z) {
                if (!B[M]) {
                    B[M] = []
                }
                if (!K[M]) {
                    K[M] = []
                }
                var F = document.getElementsByName(Q + M);
                if (F.length === 0) {
                    continue
                }
                var C = z[M], v = Q + "ordermin" + M, x = Q + "ordermax" + M, q = Q + "ordermaxtmp" + M, L = Q + "item" + M, E = B[M][0] ? B[M][0] : 0, H = K[M][0] ? K[M][0] : 999999999, s = B[M][1] ? B[M][1] : 0, t = K[M][1] ? K[M][1] : 999999999, A = B[M][2] ? B[M][2] : 0, D = K[M][2] ? K[M][2] : 999999999, N = g === 1 ? ["单注最低不能高于下级单注最高", "单注最高不能低于下级单注最低", "单注最高必须小于等于系统设定单注最高", "单项最高必须小于等于系统设定单项最高"] : ["单注最低必须小于或等于下级的单注最高", "单注最高必须大于或等于下级的单注最低", "单注最高必须小于或等于上级的单注最高", "单项最高必须小于或等于上级的单项最高"];
                $(F[0]).prop("defaultValue", C[0]);
                $(F[1]).prop("defaultValue", C[1]);
                $(F[2]).prop("defaultValue", C[2]);
                F[0].value = C[0];
                F[1].value = C[1];
                F[2].value = C[2];
                f.rules[v] = {regExp: /^[1-9]\d{0,8}$/, lessThan: x, min: E, max: H};
                f.rules[x] = {regExp: /^[1-9]\d{0,8}$/, lessThan: L, min: s, max: t};
                f.rules[L] = {regExp: /^[1-9]\d{0,8}$/, min: A, max: D};
                f.errorMessages[v] = {regExp: "单注最低由不大于9位的正整数组成", lessThan: "单注最低必须小于或等于单注最高", min: "单注最低必须大于或等于上级的单注最低" + E, max: N[0] + H};
                f.errorMessages[x] = {regExp: "单注最高由不大于9位的正整数组成", lessThan: "单注最高必须小于或等于单项最高", min: N[1] + s, max: N[2] + t};
                f.errorMessages[L] = {regExp: "单项最高由不大于9位的正整数组成", min: "单项最高必须大于或等于下级的单项最高" + A, max: N[3] + D};
                var O = 3;
                for (var I = O; I < C.length; I++) {
                    var J = "";
                    if (!F[I]) {
                        continue
                    }
                    J = ["", "", "", "A", "B", "C"][I];
                    var r = Q + "discount" + J + M, w = B[M][I] ? B[M][I] : 0, y = (K[M][I] != null && K[M][I] !== "" && K[M][I] != undefined) ? K[M][I] : 100;
                    $(F[I]).prop("defaultValue", C[I]);
                    F[I].value = C[I];
                    f.rules[r] = {regExp: /^0(\.\d{1,2})?$|^[1-9]\d?(\.\d{1,2})?$/, min: w, max: y};
                    f.errorMessages[r] = {regExp: "退水由小于100的整数组成，允许输入两位小数", min: "退水必须大于或等于下级最大退水" + w + "%", max: "退水必须小于或等于上级退水" + y + "%"};
                    F[I].setAttribute("minValue", w);
                    F[I].setAttribute("maxValue", y)
                }
            }
        }
        F = null
    };
    for (var m in d) {
        if (h[m]) {
            c = h[m].userData;
            p = $.isPlainObject(h[m].minValue) ? h[m].minValue : {};
            n = $.isPlainObject(h[m].maxValue) ? h[m].maxValue : {};
            o(m, b, c, n, p)
        }
    }
    return f
};
P.Utl.spaner = function (g) {
    var f = false, c = false, b = 1000, d = null;
    var m = function (n, s) {
        var p, r = $(n), h, q;
        if (n.name == "down" || n.name == "up") {
            r = r.siblings("input")
        }
        if (!r.attr("readonly")) {
            step = {up: 0.01, down: -0.01}[s];
            p = parseFloat(r.val()) + step;
            h = Number(r.attr("maxValue"));
            q = Number(r.attr("minValue"));
            if (p < q || p > h) {
                c = false
            } else {
                if (isNaN(p)) {
                    p = r.attr("defaultValue")
                }
                r.val(Number(p).toFixed(2))
            }
            if (c) {
                d = setTimeout(function () {
                    m(n, s)
                }, b)
            }
        }
    };
    $(".spaning", g).bind("keydown keyup mousedown mouseup mouseout change", function (n) {
        var h = n.target;
        if (h.name == "up" || h.name == "down") {
            if (n.type == "mousedown") {
                m(h, h.name);
                f = true;
                setTimeout(function () {
                    if (f) {
                        c = true;
                        b = 50;
                        m(h, h.name)
                    }
                }, b)
            }
        }
        if (n.keyCode == 38 || n.keyCode == 40) {
            if (n.type == "keydown") {
                var o = n.keyCode == 38 ? "up" : "down";
                m(h, o)
            }
        }
        if (n.type == "mouseup" || n.type == "keyup" || n.type == "mouseout") {
            c = false;
            f = false;
            b = 1000;
            clearTimeout(d)
        }
    })
};
P.Utl.isChangeForm = function (d) {
    var b = false;
    var f = $("input,select,textarea", d);
    for (var c = 0; c < f.length; c++) {
        b = P.Utl.isCtlChange(f[c]);
        if (b) {
            break
        }
    }
    f = null;
    return b
};
P.Utl.isGameChange = function (c) {
    var m = $("input", c), h = {isChanged: false, name: {}}, d = 0, f = m.length, b = false, g;
    for (; d < f; d++) {
        g = m[d];
        if (!h.name[g.getAttribute("name")]) {
            b = P.Utl.isCtlChange(g);
            if (b) {
                h.name[g.getAttribute("name")] = true;
                h.isChanged = true
            }
        }
    }
    m = null;
    return h
};
P.Utl.isCtlChange = function (c) {
    var g = c, f = g.nodeName, b = false;
    if (f == "INPUT") {
        if (g.type == "radio" || g.type == "checkbox") {
            if (g.checked != g.defaultChecked) {
                b = true
            }
        } else {
            if (g.type != "hidden" && g.value != g.defaultValue) {
                b = true
            }
        }
    } else {
        if (f == "SELECT" && g.style.display != "none") {
            for (var d = 0; d < g.options.length; d++) {
                if (g.options[d].selected != g.options[d].defaultSelected) {
                    b = true
                }
            }
        } else {
            if (f == "TEXTAREA") {
                if (g.value != g.defaultValue) {
                    b = true
                }
            }
        }
    }
    g = null;
    return b
};
P.Utl.superior = function (p, r, v) {
    var c = p.superior, d = parseInt(p.level, 10), r = document.getElementById(r), h = document.createElement("option"), q = document.createDocumentFragment(), x, o;
    h.innerHTML = v;
    h.value = "";
    q.appendChild(h);
    $("option,optgroup", r).remove();
    if (c) {
        if (5 == d) {
            o = ["管理员", "分公司", "股东", "总代理", "代理", "会员"];
            x = function (s, z) {
                var t = document.createElement("optgroup");
                t.setAttribute("label", o[s]);
                for (var f = 0; f < z.length; f++) {
                    var y = document.createElement("option");
                    y.value = z[f][0];
                    y.innerHTML = z[f][1];
                    t.appendChild(y)
                }
                return t
            };
            if (p.loginuser) {
                var g = p.loginuser[0] + "";
                c[g] = [
                    [p.loginuser[1], p.loginuser[2]]
                ]
            }
            for (var n = 1; n < 5; n++) {
                var w = n + "";
                if (c[w]) {
                    q.appendChild(x(w, c[w]))
                }
            }
        } else {
            for (var n = 0, m = c.length; n < m; n++) {
                var b = document.createElement("option");
                b.value = c[n][0];
                b.innerHTML = c[n][1];
                q.appendChild(b)
            }
        }
    }
    if (r) {
        r.appendChild(q)
    }
};
P.Utl.subInfo = function (r) {
    var c = function (g) {
        var t = {}, s = [];
        s = $(g).serializeArray();
        for (var n = 0; n < s.length; n++) {
            t[s[n].name] = s[n].value
        }
        return t
    }, m = c("#user_info");
    if (r) {
        var p, o, q = {ordermin: 0, ordermax: 1, item: 2, discountA: 3, discountB: 4, discountC: 5}, d;
        for (var h in r) {
            p = document.getElementsByName(h);
            for (var f = 0, b = p.length; f < b; f++) {
                o = p[f];
                d = h.replace(/([a-z]+\d{0,2})(\d\d)/, "$1[$2]");
                if (!m[d]) {
                    m[d] = []
                }
                m[d][q[o.getAttribute("vname").replace(/\w+(ordermin|ordermax|item|discountA|discountB|discountC)\d\d/, "$1")]] = p[f].value
            }
        }
        p = null;
        o = null
    }
    return m
};
P.Utl.allCheck = function (d) {
    var c = $("input:checkbox", d.allCheckbox), b = $("input:checkbox", d.listCheckbox);
    c.bind("click", {list: b}, function (f) {
        if (f.target.checked) {
            f.data.list.prop("checked", true)
        } else {
            f.data.list.prop("checked", false)
        }
    });
    b.bind("click", {all: c, list: b}, function (g) {
        var m = 0, f = g.data.list.length;
        for (var h = 0; h < g.data.list.length; h++) {
            if (g.data.list[h].checked) {
                m++
            }
        }
        if (m == f) {
            g.data.all.prop("checked", true)
        } else {
            g.data.all.prop("checked", false)
        }
    })
};
P.Utl.getSearch = function (h) {
    var f = $("#status", h).val(), c = $("#se_con", h).val(), g = $("#superior_se:visible", h), b = {search: {status: f, key: c}};
    if (g[0]) {
        b.search.superiorid = g.val()
    }
    if (G.condition) {
        G.condition.pager = 1
    }
    return b
};
P.Utl.getCondition = function (g, b, c) {
    var f = P.Utl.getSearch(g).search;
    f.pager = $("#current_page", g).val();
    G.condition = f;
    if (b !== undefined) {
        G.condition.level = b
    }
    if (c) {
        G.condition.superid = c
    }
};
$.UT.filterChar = function (h, f, g) {
    var d = f || new RegExp("[-$&\"*%+'\\(),<>]", "g"), c = g || "您的输入包含非法字符，请重新输入", b = d.exec(h);
    if (b) {
        $.UT.Alert({text: c, booLean: false})
    }
    return !b
};
P.Utl.renderCondition = function (b) {
    if (b.key) {
        $("#se_con").val(b.key)
    } else {
        $("#se_con").val("")
    }
    if (b.status) {
        setTimeout(function () {
            $("#status").val(b.status)
        }, 5)
    } else {
        setTimeout(function () {
            $("#status").val("")
        }, 5)
    }
    if (b.superiorid) {
        setTimeout(function () {
            document.getElementById("superior_se").value = b.superiorid
        }, 5)
    } else {
        setTimeout(function () {
            $("#superior_se").val("")
        }, 5)
    }
};
P.Utl.memeberBind = function (event, m) {
    var _this = m, tag = event.target, layout = $("#layout").Module();
    var str = "";
    if (event.type == "keyup" && tag.id == "se_con" && event.keyCode == 13) {
        _this.callBack(P.Utl.getSearch(_this.dom))
    }
    if (event.type == "change") {
        if (tag.nodeName == "SELECT") {
            if (tag.id == "superior_se") {
                delete G.condition.superid
            }
            _this.callBack(P.Utl.getSearch(_this.dom))
        }
    }
    if (event.type == "click") {
        var ie =
            /*@cc_on !@*/
            false;
        if (ie && tag.parentNode.className == "op") {
            _this.opNode = tag.parentNode
        }
        if (tag.getAttribute("edit") !== null && tag.nodeName == "A") {
            var p = tag.parentNode.parentNode.id;
            switch (_this.level) {
                case"0":
                    P.Utl.publicChengeModule(layout.right, "ajax", "guanliyuan", "get_html", "get_json", {userid: p});
                    break;
                case"1":
                    P.Utl.publicChengeModule(layout.right, "ajax", "dagudong", "get_html", "get_json", {userid: p});
                    str = "dagudong";
                    break;
                case"2":
                case"3":
                case"4":
                    var i = _this.level || 0;
                    P.Utl.publicChengeModule(layout.right, "ajax", "member", "get_html", "get_json", {level: i, userid: p});
                    str = "member";
                    break;
                case"5":
                    P.Utl.publicChengeModule(layout.right, "ajax", "huiyuan", "get_html", "get_json", {userid: p});
                    str = "huiyuan";
                    break
            }
            $("#" + str).trigger("waterSet", ["edit"])
        }
        if (tag.id == "add") {
            _this.level = $("li.on", "#nav").attr("level");
            switch (_this.level) {
                case"0":
                    P.Utl.publicChengeModule(layout.right, "ajax", "guanliyuan", "get_html", "get_json", false, "", false, {BError: function (e, d, s) {
                        $.UT.DefaultErrorCallback(e, d, s, function () {
                            if (e[0].isback == true || d.isback == true) {
                                $("li[level=" + _this.level + "]", "#nav").trigger("click", [G.condition])
                            }
                        })
                    }});
                    $("#account_nav").trigger("openclose");
                    break;
                case"1":
                    P.Utl.publicChengeModule(layout.right, "ajax", "dagudong", "get_html", "get_json", "", "", false, {BError: function (e, d, s) {
                        $.UT.DefaultErrorCallback(e, d, s, function () {
                            if (e[0].isback == true || d.isback == true) {
                                $("li[level=" + _this.level + "]", "#nav").trigger("click", [G.condition])
                            }
                        })
                    }});
                    $("#account_nav").trigger("openclose");
                    str = "dagudong";
                    break;
                case"2":
                case"3":
                case"4":
                case"5":
                    var ac = "get_json", action = "member", child = (parseInt(P.Set.level, 10) + 1).toString(), isChild = false;
                    if (_this.level == child) {
                        isChild = true
                    }
                    if (isChild) {
                        if (_this.level == "5") {
                            action = "huiyuan"
                        }
                        P.Utl.publicChengeModule(layout.right, "ajax", action, "get_html", "get_json", {level: _this.level}, "", false, {BError: function (e, d, s) {
                            $.UT.DefaultErrorCallback(e, d, s, function () {
                                if (e[0].isback == true || d.isback == true) {
                                    $("#nav [level=" + _this.level + "]").trigger("click", [G.condition])
                                }
                            })
                        }});
                        $("#account_nav").trigger("openclose");
                        str = action
                    } else {
                        if (_this.level == "5") {
                            ac = "huiyuan"
                        }
                        P.Utl.publicChengeModule(layout.right, "ajax", "superior", "get_html", ac, {level: _this.level}, "", false, {BError: function (e, d, s) {
                            $.UT.DefaultErrorCallback(e, d, s, function () {
                                if (e[0].isback == true || d.isback == true) {
                                    $("#nav [level=" + _this.level + "]").trigger("click", [G.condition])
                                }
                            })
                        }})
                    }
                    break
            }
            $("#" + str).trigger("waterSet", ["add"])
        }
        if (tag.getAttribute("log") !== null && tag.nodeName == "A") {
            P.Utl.publicChengeModule(layout.right, "ajax", "log", "get_html", "get_json", {userid: tag.getAttribute("log")}, "", false);
            G.temp = tag.getAttribute("account_name")
        }
        if (tag.getAttribute("record") !== null && tag.nodeName == "A") {
            P.Utl.publicChengeModule(layout.right, "ajax", "record", "get_html", "get_json", {userid: tag.getAttribute("record")}, "", false);
            G.temp = tag.getAttribute("account_name")
        }
        "edit,log,record,".replace(/[a-z]+\,/g, function (w) {
            if (tag.getAttribute(w.replace(",", ""))) {
                $("#account_nav").trigger("openclose")
            }
        });
        if (tag.id == "search") {
            _this.callBack(P.Utl.getSearch(_this.dom))
        }
        if (tag.id == "all_sel") {
            if (!_this.del) {
                return
            }
            if (tag.checked) {
                $(":checkbox", _this.dom).attr("checked", true)
            } else {
                $(":checkbox", _this.dom).attr("checked", false)
            }
        }
        if (tag.name == "account") {
            if (event.target.checked) {
                var cked = $(":checked", "#accounts_tb").length;
                var ck = $(":checkbox", "#accounts_tb").length;
                if (cked == ck) {
                    $("#all_sel", _this.dom).attr("checked", true)
                }
            } else {
                $("#all_sel", _this.dom).attr("checked", false)
            }
        }
        if (tag.id == "del") {
            var ch = $("tbody :checked", _this.dom), d = [], t = [];
            if (ch.length == 0) {
                $.UT.Alert({text: "请选择要删除的账号!", booLean: false})
            } else {
                $.UT.Alert({text: "确定删除选定账户吗？", determineCallback: function () {
                    for (var c = 0; c < ch.length; c++) {
                        var x = ch[c];
                        d.push(x.value);
                        t.push($(x).parents("tr")[0].getAttribute("account"))
                    }
                    _this.callBack({del: d, user_account: t.join("&nbsp;&nbsp;删除成功<br/>") + "&nbsp;&nbsp;删除成功", type: "nosingle"})
                }})
            }
        }
        if (tag.getAttribute("del") != null) {
            var ln = [], msg = "";
            ln = _this.levelName[_this.level], user = tag.parentNode.parentNode;
            msg = "确定删除" + ln + ":" + user.getAttribute("account") + "吗？删除后不可恢复！";
            $.UT.Alert({text: msg, determineCallback: function () {
                _this.callBack({del: [tag.getAttribute("del")], user_account: user.getAttribute("account"), type: "single"})
            }})
        }
        if (tag.getAttribute("status") != null && tag.nodeName == "A") {
            var status = {"0": "停用", "1": "启用", "2": "停押"}[tag.getAttribute("status")], ln = _this.levelName[_this.level], user = tag.parentNode.parentNode;
            var msg = "确定" + status + ln + ":" + user.getAttribute("account") + "吗？";
            $.UT.Alert({text: msg, determineCallback: function () {
                _this.callBack({status: {userid: user.id, st: tag}})
            }})
        }
        if (tag.getAttribute("lower") !== null && tag.nodeName == "A") {
            var lower = parseInt(_this.level, 10) + 1, pdata = {superiorid: tag.getAttribute("lower")};
            if (tag.getAttribute("lower_level")) {
                lower = tag.getAttribute("lower_level");
                pdata = {superid: tag.getAttribute("lower")}
            }
            $("#nav li[level=" + lower + "]").trigger("click", [pdata])
        }
        if (tag.id == "list_back" && tag.nodeName == "A") {
            $("#account_nav").trigger("listBack")
        }
    }
};
P.Utl.memberCallback = function (h) {
    var g = this, c, b = {}, f = "数据提交中";
    if (h.status) {
        $.extend(b, h.status);
        h.status.status = b.st.getAttribute("status");
        delete h.status.st;
        c = {action: "status_change", post: h.status, successCallback: function (m) {
            if (m.success == true) {
                g.statusChange(b.userid, b.st, g.del)
            }
        }}
    }
    if (h.del) {
        c = {action: "delete_account", post: {userid: h.del}, successCallback: function (n) {
            if (n.success == true) {
                var m = P.Utl.getSearch(g.dom);
                g.callBack(m);
                if (h.type == "single") {
                    $.UT.Alert({text: "删除账号  " + h.user_account + " 成功!", booLean: false})
                } else {
                    $.UT.Alert({text: h.user_account, booLean: false})
                }
            }
        }}
    }
    if (h.search) {
        if ($.UT.filterChar(h.search.key)) {
            b = $.extend(G.condition, h.search);
            c = {action: "get_json", post: b, successCallback: function (m) {
                g.setData(m)
            }}
        } else {
            P.Utl.renderCondition(G.condition);
            return
        }
    }
    if (h.pager) {
        if (G.condition.hasOwnProperty("superiorid") == true) {
            if (G.condition.superiorid == "") {
                G.condition.superiorid = $("#superior_se").val()
            }
        }
        var d = G.condition;
        d.pager = h.pager;
        c = {action: "get_json", post: {}, successCallback: function (m) {
            g.setData(m)
        }};
        $.extend(c.post, d);
        f = "数据请求中"
    }
    if (h !== undefined) {
        if (g.level != "0") {
            c.post.level = g.level
        }
        $.UT.publicGetAction(g.dom[0].id, c.post, c.successCallback, c.action, false)
    }
};
P.Utl.memberRender = function (r, t, c, h) {
    var m = "<tr id='" + r[0] + "' account='" + r[2] + "'>", p = "", b = "<td></td>", v = "", o = "", d = 3, q = ["g", "b", "z"], w, f = ["停用", "启用", "停押", "禁止登录", "全部"];
    w = parseInt(r[c], 10), delst = r[r.length - 3], online = "<td id='" + r[0] + "_isonline' class='offline' title='最后一次登录IP：" + r[r.length - 1] + "'></td>", jump = 0, l = parseInt(P.Set.level, 10), ll = parseInt($("li.on", "#nav").attr("level"), 10), lowerJump = 0, account_name = r[1].replace(/\[(.+,?)+\]/, "");
    if (l > 0) {
        jump = l
    }
    lowerJump = ll;
    if (r[r.length - 2] >= 1) {
        online = "<td id='" + r[0] + "_isonline' class='online' title='当前登录IP：" + r[r.length - 1] + "'></td>"
    }
    if (w != 1) {
        v = "<td name='cur_status' ct='" + w + "' class='reder' delst='" + delst + "'>" + f[w] + "</td>";
        o = "<a status='1' href='javascript:void(0)'>" + f[1] + "</a>/";
        o += "<a status='" + (2 - w) + "' href='javascript:void(0)'>" + f[2 - w] + "</a>/"
    } else {
        v = "<td name='cur_status' ct='" + w + "' delst='" + delst + "'>" + f[w] + "</td>"
    }
    if (w == 3) {
        o = "<a status='1' href='javascript:void(0)'>" + f[1] + "</a>/";
        o += "<a status='0' href='javascript:void(0)'>" + f[0] + "</a>/";
        o += "<a status='2' href='javascript:void(0)'>" + f[2] + "</a>/"
    }
    if (w == 1) {
        o = "<a status='0' href='javascript:void(0)'>" + f[0] + "</a>/";
        o += "<a status='2' href='javascript:void(0)'>" + f[2] + "</a>/"
    }
    if (t == true && w == 0 && delst == 1) {
        o += "<a del='" + r[0] + "' href='javascript:void(0)'>删除</a>/";
        b = "<td><input value='" + r[0] + "' type='checkbox' name='account'/></td>"
    }
    if (h == true) {
        r[1] = "<a href='javascript:void(0)' lower='" + r[0] + "' class='bold'>" + account_name + "</a>" + r[1].replace(account_name, "")
    } else {
        r[1] = "<span class='bluer bold'>" + account_name + "</span>" + r[1].replace(account_name, "")
    }
    p += "<td class='t-l'>" + r[1] + "</td>";
    for (var g = 2; g < c; g++) {
        if (g > 5 && g < (c - 1) && lowerJump != 0) {
            lowerJump -= 1
        } else {
            if (lowerJump == 0 && g < (c - 1) && r[g] != "0" && c != 6 && /^[1-9]\d*$/.test(r[g])) {
                r[g] = "<a href='javascript:void(0)' lower='" + r[0] + "' lower_level='" + (g - 5) + "' >" + r[g] + "</a>"
            }
        }
        if ((c == 12 || c == 11) && g > 5 && jump != 0) {
            jump -= 1;
            continue
        }
        if (ll === 1 && (r[g] === true || r[g] === false) && d !== 0) {
            r[g] = "<p class='fgs " + q[d - 1] + (r[g] ? "on" : "un") + "''></p>";
            d -= 1
        }
        p += "<td>" + r[g] + "</td>"
    }
    m += b + online + p + v + "<td class='op'>" + o + "<a href='javascript:void(0)'  edit='" + r[0] + "'>修改</a>/<a  account_name='" + account_name + "' log='" + r[0] + "' href='javascript:void(0)'>日志</a>/<a  account_name='" + account_name + "' record='" + r[0] + "' href='javascript:void(0)'>记录</a></td></tr>";
    return m
};
P.Utl.statusChange = function (g, q, n) {
    var m = $("[name=cur_status]", "#" + g)[0], r = "", o = "", b = q.parentNode, h = b.getElementsByTagName("a"), f = h && h[h.length - 1] && h[h.length - 1].getAttribute("account_name");
    if (q.getAttribute("status") == "1") {
        m.className = ""
    } else {
        m.className = "reder"
    }
    m.innerHTML = q.innerHTML;
    m.setAttribute("ct", q.getAttribute("status"));
    var c = ["停用", "启用", "停押", "禁止登录", "全部"], d = "";
    r = parseInt(q.getAttribute("status"), 10);
    if (r != 1) {
        d = "<a status='1' href='javascript:void(0)'>" + c[1] + "</a>/";
        d += "<a status='" + (2 - r) + "' href='javascript:void(0)'>" + c[2 - r] + "</a>/"
    }
    if (r == 3) {
        d = "<a status='1' href='javascript:void(0)'>" + c[1] + "</a>/";
        d += "<a status='0' href='javascript:void(0)'>" + c[0] + "</a>/";
        d += "<a status='2' href='javascript:void(0)'>" + c[2] + "</a>/"
    }
    if (r == 1) {
        d = "<a status='0' href='javascript:void(0)'>" + c[0] + "</a>/";
        d += "<a status='2' href='javascript:void(0)'>" + c[2] + "</a>/"
    }
    if (n == true && m.getAttribute("delst") == "1") {
        if (m.getAttribute("ct") == "0") {
            d += "<a del='" + g + "' href='javascript:void(0)'>删除</a>/";
            $("td:first", "#" + g).html("<input value='" + g + "' type='checkbox' name='account'/>")
        } else {
            $("td:first", "#" + g).html("")
        }
    }
    d += "<a href='javascript:void(0)' edit='" + g + "'>修改</a>/<a  log='" + g + "' href='javascript:void(0)' account_name='" + f + "'>日志</a>/<a  record='" + g + "' href='javascript:void(0)' account_name='" + f + "'>记录</a>";
    $(b).html(d)
};
P.Utl.accessControl = function (g) {
    var f = P.Set.permis.split(","), c = P.Set.status, h = P.Set.level;
    var b = $("li[show]", g);
    b.hide();
    for (var d = 0; d < f.length; d++) {
        $("li[show=" + f[d] + "]").show()
    }
    f = null;
    b = null
};
P.Utl.buhuoset = function (c, d) {
    var n = $(".buhuoset input"), o = $(".buhuoset input:text"), m = o.length, g = 0, h = {rules: {}, onblur: true, errorMessages: {}};
    for (; g < m; g++) {
        h.rules["buhuoset" + (g + 1)] = {regExp: /^\d{0,9}$/};
        h.errorMessages["buhuoset" + (g + 1)] = {regExp: "金额由不大于9位的正整数组成"};
        o.eq(g).attr("vname", "buhuoset" + (g + 1))
    }
    var b = $("#" + c).Widget("SimpleValidator", h), f = d || "buhuoset";
    n.bind("keydown click", function (w) {
        var s = w.target, x = s.type, q = w.keyCode, y = w.type;
        if ((x == "text" && q == 13) || (y == "click" && x == "button")) {
            var p = b.verifyForm();
            if (p == true) {
                var z = s.parentNode.getElementsByTagName("input")[0], v = z.value, t = $(z).attr("bh");
                if (t && t != v) {
                    $.UT.publicGetAction(c, {buhuoset: v, action: "bothside"}, function (r) {
                    }, f, function (B, A, r) {
                        $.UT.DefaultErrorCallback(B, A, r);
                        $(z).attr("bh", $(z).val());
                        z = null
                    })
                } else {
                    $.UT.Alert({text: "请改变数值后再提交", title: "补货设定", booLean: false})
                }
            }
        }
    })
};
P.Utl.sscTimesChange = function (n, q, h, g) {
    var p = '<option value="all">全部</option>';
    var s = h, f, t, r = P.Utl.severTime();
    var b = function (w) {
        return w < 10 ? "0" + w : w
    };
    if (q) {
        if (!s) {
            f = r.day.split("-");
            t = r.n_day.split("-")
        } else {
            f = [];
            t = []
        }
        if (g) {
            f = g.split("-");
            var v = new Date(Number(+new Date(g.replace(/-/g, "/"))) + 86400000);
            t = [v.getFullYear().toString(), b(v.getMonth() + 1).toString(), b(v.getDate()).toString()]
        }
        if (q >= 25) {
            for (var o = q; o >= 25; o--) {
                var c = (o / Math.pow(10, 3)).toFixed(3).substr(2);
                var m = f[0] + f[1] + f[2] + c;
                p += '<option value="' + m + '">' + m + "</option>"
            }
        } else {
            if (q == 24 && r.hours >= 5 && r.hours < 10 && r.day == g) {
            } else {
                for (var o = q; o >= 1; o--) {
                    var c = (o / Math.pow(10, 3)).toFixed(3).substr(2);
                    var m = t[0] + t[1] + t[2] + c;
                    p += '<option value="' + m + '">' + m + "</option>"
                }
                for (var o = 120; o >= 25; o--) {
                    var c = (o / Math.pow(10, 3)).toFixed(3).substr(2);
                    var m = f[0] + f[1] + f[2] + c;
                    p += '<option value="' + m + '">' + m + "</option>"
                }
            }
        }
    }
    n.html(p)
};
P.Utl.klcTimesChange = function (m, p, g, f) {
    var o = '<option value="all">全部</option>';
    var q = g, c;
    if (p) {
        if (!q) {
            c = P.Utl.severTime().day.split("-")
        } else {
            c = []
        }
        if (f) {
            c = f.split("-")
        }
        for (var n = p; n >= 1; n--) {
            var b = (n / Math.pow(10, 2)).toFixed(2).substr(2);
            var h = c[0] + c[1] + c[2] + b;
            o += '<option value="' + h + '">' + h + "</option>"
        }
    }
    m.html(o)
};
P.Utl.pk10TimesChange = function (o, f, c, b) {
    var m = '<option value="all">全部</option>';
    var n = Number(b) || Number(P.Set.pk10Times);
    if (f) {
        if (c && c != P.Utl.severTime().day) {
            n = Number(P.Set.pk10Times) - 179 * ((new Date(P.Utl.severTime().day.replace(/-/g, "/")).getTime() - new Date(c.replace(/-/g, "/")).getTime()) / 86400000)
        }
        for (var h = f - 1; h >= 0; h--) {
            var g = (n + h).toString();
            m += '<option value="' + g + '">' + g + "</option>"
        }
    }
    o.html(m)
};
P.Utl.ksTimesChange = function (m, p, g, f) {
    var o = '<option value="all">全部</option>';
    var q = g, c;
    if (p) {
        if (!q) {
            c = P.Utl.severTime().day.split("-")
        } else {
            c = []
        }
        if (f) {
            c = f.split("-")
        }
        for (var n = p; n >= 1; n--) {
            var b = (n / Math.pow(10, 2)).toFixed(2).substr(2);
            var h = c[0] + c[1] + c[2] + b;
            o += '<option value="' + h + '">' + h + "</option>"
        }
    }
    m.html(o)
};
P.Utl.ncTimesChange = function (n, q, h, g) {
    var p = '<option value="all">全部</option>';
    var s = h, f, t, r = P.Utl.severTime();
    var b = function (w) {
        return w < 10 ? "0" + w : w
    };
    if (q) {
        if (q > 97) {
            n.html(p);
            return
        }
        if (!s) {
            f = r.day.split("-");
            t = r.n_day.split("-")
        } else {
            f = [];
            t = []
        }
        if (g) {
            f = g.split("-");
            var v = new Date(Number(+new Date(g.replace(/-/g, "/"))) + 86400000);
            t = [v.getFullYear().toString(), b(v.getMonth() + 1).toString(), b(v.getDate()).toString()]
        }
        if (q >= 14) {
            for (var o = q; o >= 14; o--) {
                var c = (o / Math.pow(10, 2)).toFixed(2).substr(2);
                var m = f[0] + f[1] + f[2] + c;
                p += '<option value="' + m + '">' + m + "</option>"
            }
        } else {
            if (q == 14 && r.hours >= 2 && r.hours < 9 && r.day == g) {
            } else {
                for (var o = q; o >= 1; o--) {
                    var c = (o / Math.pow(10, 2)).toFixed(2).substr(2);
                    var m = t[0] + t[1] + t[2] + c;
                    p += '<option value="' + m + '">' + m + "</option>"
                }
                for (var o = 97; o >= 14; o--) {
                    var c = (o / Math.pow(10, 2)).toFixed(2).substr(2);
                    var m = f[0] + f[1] + f[2] + c;
                    p += '<option value="' + m + '">' + m + "</option>"
                }
            }
        }
    }
    n.html(p)
};
P.Utl.quickAjax = function (m, b) {
    var d = m.Module();
    if (!d) {
        return false
    }
    var g = P.Set.systype, c, h = $("#quickAjax");
    if (g == "pk10") {
        P.Set.qajaxT = 120
    } else {
        P.Set.qajaxT = (new Date().getHours() >= 22 || new Date().getHours() < 2) ? 120 : 420
    }
    if (h.length == 0) {
        h = $('<span id="quickAjax" style="display:none;"></span>').appendTo("body")
    }
    c = P.Set.systype ? "get_" + P.Set.systype : "get_json";
    if (!d.getResults) {
        var f = {urlId: "quickAjax", action: c, callback: function (n) {
            if (n && d) {
                var o = n.betnotice;
                if (o && n.betnotice.status == 1 && n.drawStatus == 1 || o.timeopen < P.Set.qajaxT) {
                    if (d.getResults) {
                        d.getResults.hide();
                        d.getResults = null
                    }
                }
                if (n.sys == P.Set.systype) {
                    b ? d.bindData(n) : d.setData(n)
                }
            }
        }};
        d.getResults = h.Widget("AutoRefresh", f)
    } else {
        d.getResults.hide();
        d.getResults.action = c
    }
    d.getResults.show(Math.floor(Math.random() * 3 + 1))
};
P.Utl.xselect = function (d, b) {
    function c() {
        if (d == 1 || d == 5 || d == 0) {
            return
        }
        var t = $(".share_up_div input[name=share_total]"), m = parseInt($(".share_up_div input[name=share_up]").val(), 10), q = parseInt(t.val(), 10), h, n, s = "", o;
        if (isNaN(m)) {
            return false
        }
        h = b[1];
        var p = b[0] - m;
        n = p >= h ? p : 100;
        if (p < h) {
            return false
        }
        if (h % 5 == 0) {
            o = h
        } else {
            o = Math.ceil(h / 5) * 5
        }
        for (; o <= n; o = o + 5) {
            s += "<li>" + o + "</li>"
        }
        var r = q > n ? n : q;
        t.val(isNaN(r) ? h : r);
        $("#share_total_list").html(s);
        $("#share_total_list li").hover(function () {
            this.style.background = "#3399FF"
        },function () {
            this.style.background = ""
        }).click(function () {
            $("input", this.parentNode.parentNode).val(this.innerHTML);
            $(".share_up_list").hide()
        })
    }

    $(".share_up_list li").hover(function () {
        this.style.background = "#3399FF"
    },function () {
        this.style.background = ""
    }).click(function () {
        $("input", this.parentNode.parentNode).val(this.innerHTML);
        $(".share_up_list").hide();
        c()
    });
    var f = $(".share_up_div input[name=share_up]");
    var g = $(".share_up_div input[name=share_total]");
    f.bind("change", c);
    f.bind("keyup keydown", function (n) {
        var h = n.keyCode;
        if (h != 13) {
            var m = this.value;
            if (/\D/g.test(m)) {
                this.value = m.slice(0, m.length - 1)
            }
            m = parseInt(m, 10);
            this.value = m;
            if (!m) {
                this.value = "0"
            }
            if (m > b[0]) {
                this.value = b[0]
            }
            g.value = b[0] - parseInt(this.value, 10)
        }
    });
    g.bind("keyup keydown", function (n) {
        var h = n.keyCode;
        if (h != 13) {
            var m = this.value;
            if (/\D/g.test(m)) {
                this.value = m.slice(0, m.length - 1)
            }
            m = parseInt(m, 10), vv = parseInt(f.val(), 10);
            this.value = m;
            if (!m) {
                this.value = "0"
            }
            if (m > b[0] - vv) {
                this.value = b[0] - vv
            }
        }
    })
};
P.Utl.quickSet = function (v, F, n) {
    var g = $("#" + v).Module();
    var f = g.quickSet, t;
    if (f) {
        t = f.verifyForm();
        if (t !== true) {
            var d = P.Utl.getValCtl(t), y = f.options.errorMessages[d.ctl][d.msg];
            $.UT.Alert({text: y, cancelCallback: function () {
                $("input[vname=" + d.ctl + "]", "#general_info").select()
            }, booLean: false});
            return
        }
    }
    var c = F.parentNode.parentNode, h = c.getElementsByTagName("input"), K = Number(h[0].value), q = Number(h[1].value), m = Number(h[2].value), z = document, N, M, J, b = [K, q, m];
    N = h[3].getAttribute("readonly");
    M = h[4].getAttribute("readonly");
    J = h[5].getAttribute("readonly");
    var o = [N, M, J], I = [Number(h[3].value), Number(h[4].value), Number(h[5].value)];
    var E = z.getElementById("klc").getElementsByTagName("tr"), w = z.getElementById("ssc").getElementsByTagName("tr"), D = z.getElementById("pk10").getElementsByTagName("tr"), p = z.getElementById("nc").getElementsByTagName("tr"), L = z.getElementById("ks").getElementsByTagName("tr");
    var H = g.gameRule;
    if (!H) {
        return
    }
    var s = g.gameRule.rules;
    switch (n) {
        case 1:
            for (var C = 0; C < 3; C++) {
                if (!o[C]) {
                    $("input", E[2].cells[4 + C]).quickSet(s, I[C]);
                    $("input", E[3].cells[4 + C]).quickSet(s, I[C]);
                    $("input", w[2].cells[4 + C]).quickSet(s, I[C]);
                    $("input", D[2].cells[4 + C]).quickSet(s, I[C]);
                    $("input", p[2].cells[4 + C]).quickSet(s, I[C]);
                    $("input", p[3].cells[4 + C]).quickSet(s, I[C])
                }
            }
            for (var B = 1; B < 4; B++) {
                var A = (B == 2 || B == 3) ? $("input", E[2].cells[B - 1]) : "";
                $("input", E[2].cells[B]).quickSet(s, b[B - 1], A, B);
                var A = (B == 2 || B == 3) ? $("input", E[3].cells[B - 1]) : "";
                $("input", E[3].cells[B]).quickSet(s, b[B - 1], A, B);
                var A = (B == 2 || B == 3) ? $("input", w[2].cells[B - 1]) : "";
                $("input", w[2].cells[B]).quickSet(s, b[B - 1], A, B);
                var A = (B == 2 || B == 3) ? $("input", D[2].cells[B - 1]) : "";
                $("input", D[2].cells[B]).quickSet(s, b[B - 1], A, B);
                var A = (B == 2 || B == 3) ? $("input", p[2].cells[B - 1]) : "";
                $("input", p[2].cells[B]).quickSet(s, b[B - 1], A, B);
                var A = (B == 2 || B == 3) ? $("input", p[3].cells[B - 1]) : "";
                $("input", p[3].cells[B]).quickSet(s, b[B - 1], A, B)
            }
            break;
        case 2:
            for (var C = 3; C < 5; C++) {
                for (var r = 0; r < 3; r++) {
                    if (!o[r]) {
                        $("input", E[C + 1].cells[r + 4]).quickSet(s, I[r]);
                        $("input", w[C].cells[r + 4]).quickSet(s, I[r]);
                        $("input", D[C].cells[r + 4]).quickSet(s, I[r]);
                        $("input", p[C + 1].cells[r + 4]).quickSet(s, I[r])
                    }
                }
                for (var B = 1; B < 4; B++) {
                    var A = (B == 2 || B == 3) ? $("input", E[C + 1].cells[B - 1]) : "";
                    $("input", E[C + 1].cells[B]).quickSet(s, b[B - 1], A, B);
                    var A = (B == 2 || B == 3) ? $("input", w[C].cells[B - 1]) : "";
                    $("input", w[C].cells[B]).quickSet(s, b[B - 1], A, B);
                    var A = (B == 2 || B == 3) ? $("input", D[C].cells[B - 1]) : "";
                    $("input", D[C].cells[B]).quickSet(s, b[B - 1], A, B);
                    var A = (B == 2 || B == 3) ? $("input", p[C + 1].cells[B - 1]) : "";
                    $("input", p[C + 1].cells[B]).quickSet(s, b[B - 1], A, B)
                }
            }
            for (var r = 0; r < 3; r++) {
                if (!o[r]) {
                    $("input", L[2].cells[r + 4]).quickSet(s, I[r]);
                    $("input", L[3].cells[r + 4]).quickSet(s, I[r])
                }
            }
            for (var B = 1; B < 4; B++) {
                var A = (B == 2 || B == 3) ? $("input", L[2].cells[B - 1]) : "";
                $("input", L[2].cells[B]).quickSet(s, b[B - 1], A, B);
                var A = (B == 2 || B == 3) ? $("input", L[3].cells[B - 1]) : "";
                $("input", L[3].cells[B]).quickSet(s, b[B - 1], A, B)
            }
            for (var C = 0; C < 3; C++) {
                if (!o[C]) {
                    $("input", E[8].cells[4 + C]).quickSet(s, I[C]);
                    $("input", p[8].cells[4 + C]).quickSet(s, I[C]);
                    $("input", w[5].cells[4 + C]).quickSet(s, I[C]);
                    $("input", D[2].cells[12 + C]).quickSet(s, I[C]);
                    $("input", D[3].cells[12 + C]).quickSet(s, I[C])
                }
            }
            for (var B = 1; B < 4; B++) {
                var A = (B == 2 || B == 3) ? $("input", E[8].cells[B - 1]) : "";
                $("input", E[8].cells[B]).quickSet(s, b[B - 1], A, B);
                var A = (B == 2 || B == 3) ? $("input", p[8].cells[B - 1]) : "";
                $("input", p[8].cells[B]).quickSet(s, b[B - 1], A, B);
                var A = (B == 2 || B == 3) ? $("input", w[5].cells[B - 1]) : "";
                $("input", w[5].cells[B]).quickSet(s, b[B - 1], A, B);
                var A = (B == 2 || B == 3) ? $("input", D[2].cells[B + 7]) : "";
                $("input", D[2].cells[B + 8]).quickSet(s, b[B - 1], A, B);
                var A = (B == 2 || B == 3) ? $("input", D[3].cells[B + 7]) : "";
                $("input", D[3].cells[B + 8]).quickSet(s, b[B - 1], A, B)
            }
            break;
        case 3:
            for (var C = 2; C < 8; C++) {
                for (var B = 1; B < 4; B++) {
                    var A = (B == 2 || B == 3) ? $("input", E[C].cells[B + 7]) : "";
                    $("input", E[C].cells[8 + B]).quickSet(s, b[B - 1], A, B);
                    var A = (B == 2 || B == 3) ? $("input", p[C].cells[B + 7]) : "";
                    $("input", p[C].cells[8 + B]).quickSet(s, b[B - 1], A, B);
                    if (!o[B - 1]) {
                        $("input", E[C].cells[11 + B]).quickSet(s, I[B - 1]);
                        $("input", p[C].cells[11 + B]).quickSet(s, I[B - 1])
                    }
                }
            }
            for (var B = 1; B < 4; B++) {
                var A = (B == 2 || B == 3) ? $("input", p[8].cells[B + 7]) : "";
                $("input", p[8].cells[8 + B]).quickSet(s, b[B - 1], A, B);
                if (!o[B - 1]) {
                    $("input", p[8].cells[11 + B]).quickSet(s, I[B - 1])
                }
            }
            for (var B = 1; B < 4; B++) {
                if (!o[B - 1]) {
                    $("input", L[3].cells[11 + B]).quickSet(s, I[B - 1]);
                    $("input", L[4].cells[11 + B]).quickSet(s, I[B - 1])
                }
                var A = (B == 2 || B == 3) ? $("input", L[3].cells[B + 7]) : "";
                $("input", L[3].cells[8 + B]).quickSet(s, b[B - 1], A, B);
                var A = (B == 2 || B == 3) ? $("input", L[4].cells[B + 7]) : "";
                $("input", L[4].cells[8 + B]).quickSet(s, b[B - 1], A, B);
                var A = (B == 2 || B == 3) ? $("input", L[4].cells[B - 1]) : "";
                $("input", L[4].cells[B]).quickSet(s, b[B - 1], A, B);
                var A = (B == 2 || B == 3) ? $("input", L[5].cells[B - 1]) : "";
                $("input", L[5].cells[B]).quickSet(s, b[B - 1], A, B)
            }
            for (var r = 0; r < 3; r++) {
                if (!o[r]) {
                    $("input", L[4].cells[r + 4]).quickSet(s, I[r]);
                    $("input", L[5].cells[r + 4]).quickSet(s, I[r])
                }
            }
            break;
        case 4:
            for (var C = 6; C < 8; C++) {
                for (var B = 1; B < 4; B++) {
                    var A = (B == 2 || B == 3) ? $("input", E[C].cells[B - 1]) : "";
                    $("input", E[C].cells[B]).quickSet(s, b[B - 1], A, B);
                    var A = (B == 2 || B == 3) ? $("input", p[C].cells[B - 1]) : "";
                    $("input", p[C].cells[B]).quickSet(s, b[B - 1], A, B);
                    if (!o[B - 1]) {
                        $("input", E[C].cells[3 + B]).quickSet(s, I[B - 1]);
                        $("input", p[C].cells[3 + B]).quickSet(s, I[B - 1])
                    }
                }
            }
            for (var B = 0; B < 3; B++) {
                if (!o[B]) {
                    $("input", D[4].cells[12 + B]).quickSet(s, I[B]);
                    $("input", w[6].cells[4 + B]).quickSet(s, I[B])
                }
            }
            for (var B = 1; B < 4; B++) {
                var A = (B == 2 || B == 3) ? $("input", D[4].cells[B + 7]) : "";
                $("input", D[4].cells[B + 8]).quickSet(s, b[B - 1], A, B)
            }
            for (var B = 1; B < 4; B++) {
                var A = (B == 2 || B == 3) ? $("input", w[6].cells[B - 1]) : "";
                $("input", w[6].cells[B]).quickSet(s, b[B - 1], A, B)
            }
            for (var C = 2; C < 6; C++) {
                for (var B = 0; B < 3; B++) {
                    if (!o[B]) {
                        $("input", w[C].cells[12 + B]).quickSet(s, I[B])
                    }
                }
                for (var B = 1; B < 4; B++) {
                    var A = (B == 2 || B == 3) ? $("input", w[C].cells[B + 7]) : "";
                    $("input", w[C].cells[8 + B]).quickSet(s, b[B - 1], A, B)
                }
            }
            for (var B = 1; B < 4; B++) {
                var A = (B == 2 || B == 3) ? $("input", L[2].cells[B + 7]) : "";
                $("input", L[2].cells[8 + B]).quickSet(s, b[B - 1], A, B);
                if (!o[B - 1]) {
                    $("input", L[2].cells[11 + B]).quickSet(s, I[B - 1])
                }
            }
            break
    }
};
jQuery.fn.quickSet = function (h, c, p, f) {
    var o = this.attr("vname");
    if (p && p.length) {
        var m = p.attr("vname")
    }
    if (o && h[o]) {
        var d = Number(h[o].min), n = Number(h[o].max);
        if (c < d) {
            c = d
        }
        if (c > n) {
            c = n
        }
    }
    if (f == 2 && m && h[m] && c < p.val()) {
        var g = Number(h[o].min), b = Number(h[o].max);
        if (c < g) {
            c = p.val()
        }
        if (c >= g) {
            p.val(c)
        }
    }
    if (f == 3 && m) {
        if (c < p.val()) {
            c = p.val()
        }
    }
    this.val(c).addClass("quickset");
    return this
};
P.Set.LanguageMapping = {global: {}, welcome: {}};
P.Set.ErrorMapping = {framework: {parsererror: "E100", crossDomain: "E101", timeout: "E102", abort: "E103", resultDecodeError: "E104", error: "E105"}, errors: {E102: "网络故障，本次处理异常，请到下注明细中确认注单！."}, E100: "网络异常.", E101: "网络异常.", E102: "请求超时，网络异常或服务器繁忙", E103: "网络异常.", E104: "返回信息格式错误.", E105: "服务器异常", "1010": "密码更新失败.", "1011": "请输入旧密码.", "1012": "新密码不能与旧密码相同.", "1013": "旧密码不正确.", "1014": "修改密码成功.", "1015": "两次输入的密码不能相同.", "1016": "为了账号安全，密码不能和账号相同.", "1200": "新增账号成功.", "1201": "该账号已存在.", "1202": "对不起，指定修改的会员账号不存在，或者已经被删除", "1203": "修改资料成功.", "1204": "该父级用户不存在,请重新确认.", "1205": "非法操作，不可以修改会员的上级ID", "1206": "上级停押，下级只能被停押、停用", "1207": "上级停用，不能修改下级状态", "1208": "账号不可以修改.", "1209": "本期开奖前不能修改名称.", "1210": "本期开奖前不能修改占成.", "1211": "本期开奖前不能修改盘口.", "1212": "不能修改是否允许补货.", "1213": "不能修改占成.", "1214": "踢出用户及子账号失败.", "1215": "下级存在B盘账号，不能修改成A盘", "1215": "更新信用额度不成功，请重试", "1216": "停押下线不成功，请重试", "1217": "更新退水失败，请重新再试.", "1218": "占成必须大于等于下级最高占成.", "1219": "退水不能低于下级的退水.", "1220": "信用总额不能小于投注总额.", "1221": "更新资料不成功，请重新再试", "1222": "新增资料不成功，请重试", "1223": "父级ID选择错误.", "1224": "输入无效.", "1225": "对此会员的占成不能大于上级可以分配的最大占成.", "1226": "上级账号已停用.", "1227": "信用额度必须小于等于上级剩余信用额度.", "1228": "单注最高不能小于单注最低.", "1229": "单项最高不能小于单注最高.", "1230": "单注最高不能大于上级的单注最高.", "1231": "单注最低不能小于上级的单注最低.", "1232": "单项最高不能大于上级的单项最高.", "1233": "单注最高不能小于下级的单注最高.", "1234": "单注最低不能大于下级的单注最低.", "1235": "单项最高不能小于下级的单项最高.", "1236": "退水不能高于上级的退水.", "1237": "退水不能高于上级的退水.", "1238": "正在开奖计算中,请稍候新增或修改账号", "1239": "会员数已达到最大限制,如有疑问请联系后台管理员.", "1240": "会员数已达到最大限制,如有疑问请联系系统人员.", "1241": "新增补货占成关系不成功，请重试", "1242": "修改失败，目前修改的账号不存在或已经被删除", "1243": "请选择权限.", "1250": "异常请求.", "1251": "权限不够，无法执行相关操作", "1252": "异常返回.", "1253": "获取数据异常.", "1260": "后台不存在.", "1261": "更新操作失败.", "1262": "上级账号未启用,修改失败.", "1263": "有找到符合条件的数据.", "1264": "未能获取该用户信息.", "1265": "名称不能为空.", "1266": "确认密码不一致.", "1267": "信用额度不能超过9位数.", "1268": "取得用户下一级信息异常.", "1269": "修改后的信用额度不能低于下级已分配的信用额度 .", "1270": "用户退水信息异常 .", "1271": "用户退水不能小于0大于100.", "1272": "用户退水不能低于下级退水值.", "1273": "单注最低，单注最高，单项最高由不大于9位的正整数组成，不允许为空、为0.", "1274": "单注最低不能大于单注最高，单注最高不能大于单项最高.", "1275": "单注最低不能高于下级.", "1276": "单注最高不能底于下级.", "1277": "单项最高不能底于下级.", "1278": "下级占成值不能低于已设的下级占成总和.", "1279": "联动调水上调失败.", "1280": "联动调水下调失败.", "1281": "更新信用额度失败.", "1282": "更新本级退水失败.", "1283": "更新投注限制失败.", "1284": "账号不允许为空，由数字、英文字母、下划线组成，不能使用其它特殊字符。长度为1~12个字符。.", "1285": "信用额度不能超过9位数.", "1286": "初始化 会员下注状态表失败.", "1287": "初始化补货设定表失败.", "1288": "初始化 用户信息表表失败.", "1289": "取得下级和直属会员异常.", "1290": "取得上级用户异常.", "1291": "信用额度超过限制.", "1292": "上级退水异常.", "1293": "占成不能高于上级的share_total .", "1294": "用户已分配出的信用额度异常 .", "1295": "存在下级账号，请先删除下级账号.", "1296": "上级账号未启用，修改失败 .", "1297": "删除session失败 .", "1298": "名称由汉字的简繁体(一个汉字2位字符)、圆点（.）、字母、数字、下划线组成，长度不超过16个英文字符或8个汉字.", "1299": "提示:", "2200": "", "2010": "信用额度模式只能在02:00 - 08:30修改.", "2201": "被删除的帐户无法操作.", "2202": "受上级帐户状态限制无法完成操作.", "2203": "会员数已达到最大限制,如有疑问请联系后台管理员.", "2204": "开盘期间不能修改会员信用额度小于已下金额.", "2205": "未结算账户不允许删除.", "2206": "关盘之后2：00-8：30才能删除账号.", "2207": "只有停用状态的帐户才能被删除.", "2208": "上级用户状态为停用或删除，不能建下级.", "2209": "上级用户状态为停押，不能建启用的下级.", "2210": "关盘之后2：00-8：30才能修改帐号占成信息.", "2211": "关盘之后2：00-8：30才能修改帐号退水信息.", "2212": "账号不能使用关键字.", "2213": "关盘之后2：00-8：30才能修改账户所属盘口信息.", "2214": "上级盘口信息发生变化，从重新编辑账户.", "2215": "快乐彩新增用户投注限制配置表异常.", "2216": "快乐彩新增用户金额异常.", "2217": "快乐彩新增用户投注限制异常.", "2218": "快乐彩退水配置表异常.", "2219": "快乐彩新增退水异常.", "2220": "快乐彩初始化会员下注状态表异常.", "2221": "快乐彩玩法类别及退水表异常.", "2222": "快乐彩玩法表异常.", "2223": "快乐彩初始化收付统计玩法汇总异常.", "2224": "快乐彩初始化补货设定表异常.", "2225": "编辑子账户权限异常.", "2226": "上级ID级别匹配异常.", "2227": "子账户无此权限.", "2228": "该账号已经删除，请不要重复删除.", "2229": "账号或名称搜索可输入由汉字的简繁体(一个汉字2位字符)、圆点（.）、字母、数字、下划线组成，长度不超过16个英文字符或8个汉字.", "2230": "分公司剩余占成，不可以设置股东补货是否占成为否.", "2231": "封盘时间提前范围只能60-120秒整数.", "1300": "调整赔率成功.", "1301": "超出盘口权限范围.", "1401": "停押失败.", "1500": "补货成功.", "1501": "补货失败,赔率不一致.", "1502": "补货失败,高于单注最高金额.", "1503": "补货失败,低于单注最低金额.", "1504": "补货失败，高于过关封顶金额.", "1505": "补货失败,高于用户最高信用额度.", "1506": "补货的球号标识不正确.", "1507": "玩法ID不正确.", "1508": "单注限制数据不存在，不能补货.", "1509": "对不起，尚未开盘，不允许补货.", "1510": "对不起，该球号已停押，不允许补货.", "1511": "A盘用户非特码只能补货到A盘.", "1512": "本次补货操作时间过长，请检查补仓明细查看是否补货已经成功.", "1513": "对不起，已经进行了开奖计算，需要在开奖管理中，执行清除结果操作后才可以继续补货.", "1514": "输入的赔率个数不够.", "1515": "请输入单个最终赔率.", "1516": "补货失败，原因:补货超时.", "1517": "赔率不一致，被补货后台的赔率正在重新获取，请稍后再补货.", "1518": "补货失败,补货注单参数异常.", "1519": "用户状态异常,不允许补货.", "1520": "当前没有可补货金额.", "1521": "补货失败.", "1600": "新建期数成功.", "1601": "已有一期状态为开盘或等待开盘.", "1602": "当天已存在一期，请选择其他开盘日期.", "1603": "今天已开一盘.", "1604": "只能快速开盘当天状态为等待开盘的期数.", "1605": "该期不存在，请检查.", "1606": "新增期数的开盘时间必须晚于最近一期的开盘时间.", "1607": "已设置过号码，不能重新开盘.", "1608": "当前状态是等待开盘或已经开盘，不允许重新开盘.", "1609": "目前没有期数，不允许重新开盘.", "1610": "需要重新启用停押的玩法.", "1611": "期数日期不可以修改，如需新开不同日期期数，请删除或关盘后新开一期.", "1612": "该期已经关盘，不能编辑.", "1613": "该期已经开盘，不能修改开盘时间.", "1614": "开盘成功.", "1615": "关盘时间不能早于当前时间.", "1616": "新建期数表失败.", "1617": "修改期数数据失败，请重新再试.", "1618": "更新期数资料不成功，请重新再试.", "1619": "保存期数失败.", "1620": "初始开奖数数据失败.", "1621": "启用玩法失败.", "1622": "停押玩法失败.", "1623": "期数不存在.", "1624": "不能查看今天之后的数据.", "1700": "开盘成功.", "1701": "开盘失败.", "1702": "重新开盘成功! 需要重新启用停押的玩法.", "1703": "关盘成功.", "1704": "关盘失败.", "1705": "已开盘.", "1706": "已关盘.", "1707": "已结束.", "1708": "还未到开盘时间，等待开盘.", "1709": "今天期数已结束.", "1710": "", "1711": "", "1712": "当前小期不存在.", "1800": "计算结束，可以查看相关报表.", "1801": "清除结果.", "1802": "期数不能为空.", "1803": "请先关盘.", "1804": "报表计算中，请稍候.", "1805": "只能对当前期执行此操作.", "1806": "请依次输入球号.", "1807": "开奖计算中,不能清除开奖球号.", "1808": "保存数据失败，请重新再试.", "1809": "本次计算不成功，稍后再试.", "1810": "开盘中，不能计算期数报表.", "1811": "只能对当前期执行此操作.", "1901": "请选择注单类型再进行查询.", "1902": "该期不存在.", "1903": "没有下注补货记录.", "2000": "保存成功.", "2001": "保存失败.", "2002": "请输入完整信息.", "2003": "请输入正确的天数.", "2004": "请输入正确的数据.", "2005": "单注最低不能大于单注最高.", "2006": "单注最高不能大于单项最高.", "2007": "赔率必须小于最高赔率，大于最低赔率.", "2008": "最低赔率必须大于1.", "2009": "最低赔率必须小于赔率.", "2011": "最低赔率必须小于当前最低赔率.", "2012": "删除失败!", "2013": "不能大于1000个字符！", "2301": "金额由不大于9位的正整数组成.", "2302": "补货类型格式不对.", "2402": "优先顺序必须为1-999的整数.", "2403": "已取消与该补货后台的补货关系.", "2404": "账号不存在，或者用户名和密码不一致.", "2405": "网络请求错误，添加补货员失败.", "2406": "账号已经存在.", "2407": "该补货后台尚未启用或不存在，不可以增加补货账号.", "2408": "后台信息为空.", "2409": "补货后台信息为空.", "2410": "账号长度必须1-12位字符,请重新输入.", "2411": "密码长度必须大于等于4位且小于等于12位,请重新输入.", "2500": "保存设置成功.", "2501": "数据输入有误，保存设置失败.", "2502": "保存设置失败.", "2600": "没有任何数据.", "2601": "数据有误.", "2602": "没有可更新数据.", "2603": "修改失败.", "2604": "启用成功.", "2605": "停押成功.", "2606": "还没有开盘，请开盘后再试.", "2607": "赔率大于等于0，长度为1-4位整数，允许最多带三位小数.", "2608": "不能大于最大赔率限制.", "2609": "不能小于最小赔率限制.", "2701": "用户不合法.", "2702": "超出查询时间范围,请重新输入.", "2703": "查询失败!", "2704": "没有期数数据.", "2705": "输入数据无效！.", "2706": "报表计算中，请稍候...", "2707": "不能跨月查询，请重新输入.", "2801": "账号由1-12位英文字母、数字、下划线组成，且第一位不能是下划线", "2802": "密码由6-16位数字、字母组成", "2803": "优先顺序由1-999的整数组成", "2804": "参数不完整", "2805": "该补货公司尚未启用或不存在，不可以添加补货账号！保存失败！", "2806": "该补货公司尚未启用或不存在，不可以添加补货账号！保存失败！", "2807": "补货会员没启用！保存失败！", "2808": "用户名和密码不一致！保存失败！", "2809": "添加补货会员失败！", "2810": "保存成功！", "2811": "添加的不是会员账户", "2812": "提交的数据异常", "2813": "", "3000": "您已经在其它地方登录或登录已超时"};
P.Set.playType = {"000": "第一球:", "001": "第二球:", "002": "第三球:", "003": "第四球:", "004": "第五球:", "005": "第六球:", "006": "第七球:", "007": "第八球:", "008": "第一球:", "009": "第二球:", "010": "第三球:", "011": "第四球:", "012": "第五球:", "013": "第六球:", "014": "第七球:", "015": "第八球:", "016": "第一球:", "017": "第二球:", "018": "第三球:", "019": "第四球:", "020": "第五球:", "021": "第六球:", "022": "第七球:", "023": "第八球:", "024": "第一球:", "025": "第二球:", "026": "第三球:", "027": "第四球:", "028": "第五球:", "029": "第六球:", "030": "第七球:", "031": "第八球:", "032": "第一球:", "033": "第二球:", "034": "第三球:", "035": "第四球:", "036": "第五球:", "037": "第六球:", "038": "第七球:", "039": "第八球:", "040": "", "041": "", "042": "", "043": "第一球:", "044": "第二球:", "045": "第三球:", "046": "第四球:", "047": "第五球:", "048": "第六球:", "049": "第七球:", "050": "第八球:", "051": "第一球:", "052": "第二球:", "053": "第三球:", "054": "第四球:", "055": "第五球:", "056": "第六球:", "057": "第七球:", "058": "第八球:", "059": "第一球", "060": "第一球", "061": "任选二:", "062": "选二连直:", "063": "选二连组:", "064": "任选三:", "065": "选三前直:", "066": "选三前组:", "067": "任选四:", "068": "任选五:", "069": "第二球", "070": "第二球", "071": "第三球", "072": "第三球", "073": "第四球", "074": "第四球", "075": "正码"};
P.Set.category = {"000": "00", "001": "01", "002": "02", "003": "03", "004": "04", "005": "05", "006": "06", "007": "07", "008": "08", "009": "08", "010": "08", "011": "08", "012": "08", "013": "08", "014": "08", "015": "08", "016": "09", "017": "09", "018": "09", "019": "09", "020": "09", "021": "09", "022": "09", "023": "09", "024": "10", "025": "10", "026": "10", "027": "10", "028": "10", "029": "10", "030": "10", "031": "10", "032": "11", "033": "11", "034": "11", "035": "11", "036": "11", "037": "11", "038": "11", "039": "11", "040": "12", "041": "13", "042": "14", "043": "15", "044": "15", "045": "15", "046": "15", "047": "15", "048": "15", "049": "15", "050": "15", "051": "16", "052": "16", "053": "16", "054": "16", "055": "16", "056": "16", "057": "16", "058": "16", "059": "17", "060": "17", "061": "18", "062": "19", "063": "20", "064": "21", "065": "22", "066": "23", "067": "24", "068": "25", "069": "17", "070": "17", "071": "17", "072": "17", "073": "17", "074": "17"};
P.Set.playBall = {"01": "01", "02": "02", "03": "03", "04": "04", "05": "05", "06": "06", "07": "07", "08": "08", "09": "09", "10": "10", "11": "11", "12": "12", "13": "13", "14": "14", "15": "15", "16": "16", "17": "17", "18": "18", "19": "19", "20": "20", "21": "单", "22": "双", "23": "大", "24": "小", "25": "尾大", "26": "尾小", "27": "合数 单", "28": "合数 双", "29": "总和 单", "30": "总和 双", "31": "总和 大", "32": "总和 小", "33": "总和 尾大", "34": "总和 尾小", "35": "中", "36": "发", "37": "白", "38": "东", "39": "南", "40": "西", "41": "北", "42": "龙", "43": "虎"};
P.Set.playType_sc = {"000": "第一球 ", "001": "第二球 ", "002": "第三球 ", "003": "第四球 ", "004": "第五球 ", "005": "第一球 ", "006": "第二球 ", "007": "第三球 ", "008": "第四球 ", "009": "第五球 ", "010": "", "011": "", "012": "", "013": "", "014": " 前三 ", "015": " 中三 ", "016": "后三 ", "017": " 前三 ", "018": " 中三 ", "019": "后三 ", "020": "前三 ", "021": "中三 ", "022": "后三 ", "023": "前三 ", "024": "中三 ", "025": "后三 ", "026": "前三 ", "027": "中三 ", "028": "后三 "};
P.Set.category_sc = {"000": "00", "001": "00", "002": "00", "003": "00", "004": "00", "005": "01", "006": "01", "007": "01", "008": "01", "009": "01", "010": "01", "011": "02", "012": "02", "013": "03", "014": "04", "015": "04", "016": "04", "017": "05", "018": "05", "019": "05", "020": "06", "021": "06", "022": "06", "023": "07", "024": "07", "025": "07", "026": "08", "027": "08", "028": "08"};
P.Set.Playtype_pk10 = {"000": "冠军", "001": "亚军", "002": "第三名", "003": "第四名", "004": "第五名", "005": "第六名", "006": "第七名", "007": "第八名", "008": "第九名", "009": "第十名", "010": "冠军", "011": "亚军", "012": "第三名", "013": "第四名", "014": "第五名", "015": "第六名", "016": "第七名", "017": "第八名", "018": "第九名", "019": "第十名", "020": "冠军", "021": "亚军", "022": "第三名", "023": "第四名", "024": "第五名", "025": "第六名", "026": "第七名", "027": "第八名", "028": "第九名", "029": "第十名", "030": "冠军", "031": "亚军", "032": "第三名", "033": "第四名", "034": "第五名", "035": "冠亚大小", "036": "冠亚单双", "037": "冠亚和"};
P.Set.gametype_pk10 = {"0001": "冠军 1", "0002": "冠军 2", "0003": "冠军 3", "0004": "冠军 4", "0005": "冠军 5", "0006": "冠军 6", "0007": "冠军 7", "0008": "冠军 8", "0009": "冠军 9", "00010": "冠军 10", "0011": "亚军 1", "0012": "亚军 2", "0013": "亚军 3", "0014": "亚军 4", "0015": "亚军 5", "0016": "亚军 6", "0017": "亚军 7", "0018": "亚军 8", "0019": "亚军 9", "00110": "亚军 10", "0021": "第三名 1", "0022": "第三名 2", "0023": "第三名 3", "0024": "第三名 4", "0025": "第三名 5", "0026": "第三名 6", "0027": "第三名 7", "0028": "第三名 8", "0029": "第三名 9", "00210": "第三名 10", "0031": "第四名 1", "0032": "第四名 2", "0033": "第四名 3", "0034": "第四名 4", "0035": "第四名 5", "0036": "第四名 6", "0037": "第四名 7", "0038": "第四名 8", "0039": "第四名 9", "00310": "第四名 10", "0041": "第五名 1", "0042": "第五名 2", "0043": "第五名 3", "0044": "第五名 4", "0045": "第五名 5", "0046": "第五名 6", "0047": "第五名 7", "0048": "第五名 8", "0049": "第五名 9", "00410": "第五名 10", "0051": "第六名 1", "0052": "第六名 2", "0053": "第六名 3", "0054": "第六名 4", "0055": "第六名 5", "0056": "第六名 6", "0057": "第六名 7", "0058": "第六名 8", "0059": "第六名 9", "00510": "第六名 10", "0061": "第七名 1", "0062": "第七名 2", "0063": "第七名 3", "0064": "第七名 4", "0065": "第七名 5", "0066": "第七名 6", "0067": "第七名 7", "0068": "第七名 8", "0069": "第七名 9", "00610": "第七名 10", "0071": "第八名 1", "0072": "第八名 2", "0073": "第八名 3", "0074": "第八名 4", "0075": "第八名 5", "0076": "第八名 6", "0077": "第八名 7", "0078": "第八名 8", "0079": "第八名 9", "00710": "第八名 10", "03719": "冠亚和 19", "03718": "冠亚和 18", "03717": "冠亚和 17", "03716": "冠亚和 16", "03715": "冠亚和 15", "03714": "冠亚和 14", "03713": "冠亚和 13", "03712": "冠亚和 12", "03711": "冠亚和 11", "03710": "冠亚和 10", "0379": "冠亚和 9", "0378": "冠亚和 8", "0377": "冠亚和 7", "0376": "冠亚和 6", "0375": "冠亚和 5", "0374": "冠亚和 4", "0373": "冠亚和 3", "0361": "冠亚 双", "0360": "冠亚 单", "0351": "冠亚 小", "0350": "冠亚 大", "0341": "第五名 虎", "0340": "第五名 龙", "0331": "第四名 虎", "0330": "第四名 龙", "0321": "第三名 虎", "0320": "第三名 龙", "0311": "亚军 虎", "0310": "亚军 龙", "0301": "冠军 虎", "0300": "冠军 龙", "0291": "第十名 双", "0290": "第十名 单", "0281": "第九名 双", "0280": "第九名 单", "0271": "第八名 双", "0270": "第八名 单", "0261": "第七名 双", "0260": "第七名 单", "0251": "第六名 双", "0250": "第六名 单", "0241": "第五名 双", "0240": "第五名 单", "0231": "第四名 双", "0230": "第四名 单", "0221": "第三名 双", "0220": "第三名 单", "0211": "亚军 双", "0210": "亚军 单", "0201": "冠军 双", "0200": "冠军 单", "0191": "第十名 小", "0190": "第十名 大", "0181": "第九名 小", "0180": "第九名 大", "0171": "第八名 小", "0170": "第八名 大", "0161": "第七名 小", "0160": "第七名 大", "0151": "第六名 小", "0150": "第六名 大", "00910": "第十名 10", "0099": "第十名 9", "0098": "第十名 8", "0097": "第十名 7", "0096": "第十名 6", "0095": "第十名 5", "0094": "第十名 4", "0093": "第十名 3", "0092": "第十名 2", "0091": "第十名 1", "0141": "第五名 小", "0140": "第五名 大", "0131": "第四名 小", "0130": "第四名 大", "0121": "第三名 小", "0120": "第三名 大", "0111": "亚军 小", "0110": "亚军 大", "0101": "冠军 小", "0100": "冠军 大", "00810": "第九名 10", "0089": "第九名 9", "0088": "第九名 8", "0087": "第九名 7", "0086": "第九名 6", "0085": "第九名 5", "0084": "第九名 4", "0083": "第九名 3", "0082": "第九名 2", "0081": "第九名 1"};
P.Set.category_pk10 = {"000": "00", "001": "01", "002": "02", "003": "03", "004": "04", "005": "05", "006": "06", "007": "07", "008": "08", "009": "09", "010": "10", "011": "10", "012": "10", "013": "10", "014": "10", "015": "10", "016": "10", "017": "10", "018": "10", "019": "10", "020": "11", "021": "11", "022": "11", "023": "11", "024": "11", "025": "11", "026": "11", "027": "11", "028": "11", "029": "11", "030": "12", "031": "12", "032": "12", "033": "12", "034": "12", "035": "13", "036": "14", "037": "15"};
P.Set.category_nc = {"000": "00", "001": "01", "002": "02", "003": "03", "004": "04", "005": "05", "006": "06", "007": "07", "008": "08", "009": "08", "010": "08", "011": "08", "012": "08", "013": "08", "014": "08", "015": "08", "016": "09", "017": "09", "018": "09", "019": "09", "020": "09", "021": "09", "022": "09", "023": "09", "024": "10", "025": "10", "026": "10", "027": "10", "028": "10", "029": "10", "030": "10", "031": "10", "032": "11", "033": "11", "034": "11", "035": "11", "036": "11", "037": "11", "038": "11", "039": "11", "040": "12", "041": "13", "042": "14", "043": "15", "044": "15", "045": "15", "046": "15", "047": "15", "048": "15", "049": "15", "050": "15", "051": "16", "052": "16", "053": "16", "054": "16", "055": "16", "056": "16", "057": "16", "058": "16", "059": "17", "060": "18", "061": "19", "062": "20", "063": "21", "064": "22", "065": "23", "066": "24", "067": "25", "068": "26", "069": "27", "070": "17", "071": "17", "072": "17"};
P.Set.playBall_nc = {"01": "01", "02": "02", "03": "03", "04": "04", "05": "05", "06": "06", "07": "07", "08": "08", "09": "09", "10": "10", "11": "11", "12": "12", "13": "13", "14": "14", "15": "15", "16": "16", "17": "17", "18": "18", "19": "19", "20": "20", "21": "单", "22": "双", "23": "大", "24": "小", "25": "尾大", "26": "尾小", "27": "合数 单", "28": "合数 双", "29": "总和 单", "30": "总和 双", "31": "总和 大", "32": "总和 小", "33": "总和 尾大", "34": "总和  尾小", "35": "中", "36": "发", "37": "白", "38": "东", "39": "南", "40": "西", "41": "北", "42": "龙", "43": "虎"};
P.Set.playType_nc = {"000": "第一球 ", "001": "第二球 ", "002": "第三球 ", "003": "第四球 ", "004": "第五球 ", "005": "第六球 ", "006": "第七球 ", "007": "第八球 ", "008": "第一球 ", "009": "第二球 ", "010": "第三球 ", "011": "第四球 ", "012": "第五球 ", "013": "第六球 ", "014": "第七球 ", "015": "第八球 ", "016": "第一球 ", "017": "第二球 ", "018": "第三球 ", "019": "第四球 ", "020": "第五球 ", "021": "第六球 ", "022": "第七球 ", "023": "第八球 ", "024": "第一球 ", "025": "第二球 ", "026": "第三球 ", "027": "第四球 ", "028": "第五球 ", "029": "第六球 ", "030": "第七球 ", "031": "第八球 ", "032": "第一球 ", "033": "第二球 ", "034": "第三球 ", "035": "第四球 ", "036": "第五球 ", "037": "第六球 ", "038": "第七球 ", "039": "第八球 ", "040": "", "041": "", "042": "", "043": "第一球 ", "044": "第二球 ", "045": "第三球 ", "046": "第四球 ", "047": "第五球 ", "048": "第六球 ", "049": "第七球 ", "050": "第八球 ", "051": "第一球 ", "052": "第二球 ", "053": "第三球 ", "054": "第四球 ", "055": "第五球 ", "056": "第六球 ", "057": "第七球 ", "058": "第八球 ", "059": "", "060": "果蔬单选", "061": "动物单选", "062": "任选二", "063": "选二连组", "064": "选二连直", "065": "任选三", "066": "三全中", "067": "三连中", "068": "任选四", "069": "任选五", "070": "第二球", "071": "第三球", "072": "第四球", "073": "正码", "074": "选三前组"};
P.Set.category_ks = {"000": "00", "001": "01", "002": "02", "003": "03", "004": "04", "005": "05", "006": "06"};
P.Set.playType_ks = {"000": "大小 ", "001": "三军 ", "002": "围骰 ", "003": "全骰 ", "004": "点数 ", "005": "长牌 ", "006": "短牌 "};
P.Utl.number_pk10 = function (c, b) {
    var f = P.Set.Playtype_pk10[c], d = parseInt(c, 10);
    if (d <= 9 || d == 37) {
        return[f, b]
    }
    if (d <= 19 || d == 35) {
        f = d == 35 ? "两面" : f;
        return b == 1 ? [f, d == 35 ? "冠亚小" : "小"] : [f, d == 35 ? "冠亚大" : "大"]
    }
    if (d <= 29 || d == 36) {
        f = d == 36 ? "两面" : f;
        return b == 1 ? [f, d == 36 ? "冠亚双" : "双"] : [f, d == 36 ? "冠亚单" : "单"]
    }
    if (d <= 34) {
        return b == 1 ? [f, "虎"] : [f, "龙"]
    }
    return a.join(",")
};
P.Utl.number_sc = function (g, h) {
    var v = ["第一球", "第二球", "第三球", "第四球", "第五球"], f = parseInt(g, 10), r = ["单", "双", "大", "小"], m = ["龙", "虎", "和"], t, s, q, o, n;
    if (f <= 4) {
        return[v[f], h, "单码"]
    }
    if (f <= 9) {
        return[v[f - 5], r[h], "两面"]
    }
    if (f <= 13) {
        t = f == 10 ? "总" + r[h] : m[f - 11];
        s = f == 10 ? "两面" : "龙虎";
        return["总和-龙虎和", t, s]
    }
    if (f > 13) {
        var q = parseInt(P.Set.category_sc[g], 10) - 4, o = ["豹子", "顺子", "对子", "半顺", "杂六"][q], n = P.Set.playType_sc[g];
        return[n, o, n]
    }
};
P.Utl.number_ks = function (g, f) {
    var h = {"000": ["", "大", "小"], "001": ["", "1", "2", "3", "4", "5", "6"], "002": ["", "111", "222", "333", "444", "555", "666"], "003": ["", ""], "004": ["", "4点", "5点", "6点", "7点", "8点", "9点", "10点", "11点", "12点", "13点", "14点", "15点", "16点", "17点"], "005": ["", "12", "13", "14", "15", "16", "23", "24", "25", "26", "34", "35", "36", "45", "46", "56"], "006": ["", "11", "22", "33", "44", "55", "66"]};
    var m = parseInt(f, 10);
    var c = h[g][m];
    var b = P.Set.playType_ks[g], d;
    switch (g) {
        case"004":
            d = c;
            break;
        case"000":
            d = c;
            break;
        case"003":
            c = P.Set.playType_ks[g];
            d = c;
            break;
        default:
            d = b + c
    }
    return[b, c, d]
};
P.Set.ActionMapping = {header: {get_json_ssc: {url: "ssc/header/index/"}, get_json_klc: {url: "klc/header/index/"}, get_json_pk10: {url: "pk/header/index/"}, get_json_nc: {url: "nc/header/index/"}, get_json_ks: {url: "ks/header/index/"}, on_off_draws_ssc: {url: "ssc/draws/index"}, on_off_draws_klc: {url: "klc/draws/index"}, on_off_draws_pk10: {url: "pk/draws/index"}, on_off_draws_nc: {url: "nc/draws/index"}, on_off_draws_ks: {url: "ks/draws/index"}, more_announcement: {url: "klc/Notice/index"}}, quickAjax: {get_ssc: {url: "ssc/header/ajax/"}, get_klc: {url: "klc/header/ajax/"}, get_pk10: {url: "pk/header/ajax/"}, get_nc: {url: "nc/header/ajax/"}, get_ks: {url: "ks/header/ajax/"}}, notice: {get_html: {url: "/webssc/htmlback/klc/notice.html"}, get_json: {url: "klc/msg/index"}}, change_password: {get_html: {url: "/webssc/htmlback/klc/change_password.html"}, get_json: {url: "klc/Account/ReSetPassword"}}, infop: {get_html: {url: "/webssc/htmlback/klc/infop.html"}, get_json_klc: {url: "klc/userInfo/Index"}, get_json_ssc: {url: "ssc/userInfo/Index"}, get_json_pk10: {url: "pk/userInfo/Index"}, get_json_nc: {url: "nc/userInfo/Index"}, get_json_ks: {url: "ks/userInfo/Index"}}, account_nav: {get_html: {url: "/webssc/htmlback/klc/account_nav.html", mergeKey: "account_nav"}, get_json: {url: "klc/UserOnlineInfo/index"}}, log: {get_html: {url: "/webssc/htmlback/klc/log.html", mergeKey: "log"}, get_json: {url: "klc/user/loginLog"}}, record: {get_html: {url: "/webssc/htmlback/klc/record.html", mergeKey: "record"}, get_json: {url: "klc/user/operationLog"}}, guanliyuanList: {get_html: {url: "/webssc/htmlback/klc/guanliyuanList.html", mergeKey: "guanliyuanList"}, get_json: {url: "klc/admin/index/"}, status_change: {url: "klc/admin/status/"}, delete_account: {url: "klc/admin/delete/"}}, guanliyuan: {get_html: {url: "/webssc/htmlback/klc/guanliyuan.html"}, get_json: {url: "klc/admin/edit/"}, submit: {url: "klc/admin/save/"}, check_user: {url: "klc/user/CheckUser/"}}, huiyuanList: {get_html: {url: "/webssc/htmlback/klc/huiyuanList.html", mergeKey: "huiyuanList"}, get_json: {url: "klc/member/index/"}, status_change: {url: "klc/member/status/"}, delete_account: {url: "klc/member/delete/"}}, huiyuan: {get_html: {url: "/webssc/htmlback/klc/huiyuan.html"}, get_json: {url: "klc/member/edit/"}, submit: {url: "klc/member/save/"}, other: {url: "ssc/member/edit/"}, other_submit: {url: "ssc/member/save/"}, pk10: {url: "pk/member/edit/"}, pk10_submit: {url: "pk/member/save/"}, nc: {url: "nc/member/edit/"}, nc_submit: {url: "nc/member/save/"}, ks: {url: "ks/member/edit/"}, ks_submit: {url: "ks/member/save/"}, check_user: {url: "klc/user/CheckUser/"}}, memberList: {get_html: {url: "/webssc/htmlback/klc/memberList.html", mergeKey: "memberList"}, get_json: {url: "klc/user/index/"}, status_change: {url: "klc/user/status/"}, delete_account: {url: "klc/user/delete/"}}, dagudong: {get_html: {url: "/webssc/htmlback/klc/dagudong.html"}, get_json: {url: "klc/user/edit/"}, submit: {url: "klc/user/save/"}, other: {url: "ssc/user/edit/"}, other_submit: {url: "ssc/user/save/"}, pk10: {url: "pk/user/edit/"}, pk10_submit: {url: "pk/user/save/"}, nc: {url: "nc/user/edit/"}, nc_submit: {url: "nc/user/save/"}, ks: {url: "ks/user/edit/"}, ks_submit: {url: "ks/user/save/"}, check_user: {url: "klc/user/CheckUser/"}}, member: {get_html: {url: "/webssc/htmlback/klc/member.html"}, get_json: {url: "klc/user/aedit/"}, submit: {url: "klc/user/asave/"}, other: {url: "ssc/user/aedit/"}, other_submit: {url: "ssc/user/asave/"}, pk10: {url: "pk/user/aedit/"}, pk10_submit: {url: "pk/user/asave/"}, ks: {url: "ks/user/aedit/"}, ks_submit: {url: "ks/user/asave/"}, check_user: {url: "klc/user/CheckUser/"}}, superior: {get_html: {url: "/webssc/htmlback/klc/superior.html"}, get_json: {url: "klc/user/superior/"}, huiyuan: {url: "klc/member/superior/"}}, rule: {get_html_klc: {url: "/webssc/htmlback/klc/rule.html"}, get_html_ssc: {url: "/webssc/htmlback/ssc/rule.html"}, get_html_pk10: {url: "/webssc/htmlback/pk10/rule.html"}, get_html_nc: {url: "/webssc/htmlback/nc/rule.html"}, get_html_ks: {url: "/webssc/htmlback/ks/rule.html"}}, operationRecord: {get_html: {url: "/webssc/htmlback/klc/operation_record.html"}, get_json_klc: {url: "klc/operationRecord/index/"}, get_json_ssc: {url: "ssc/operationRecord/index/"}, get_json_pk10: {url: "pk/operationRecord/index/"}, get_json_nc: {url: "nc/operationRecord/index/"}, get_json_ks: {url: "ks/operationRecord/index/"}}, settingsNav: {get_html: {url: "/webssc/htmlback/klc/settings_nav.html"}}, basicSettings: {get_html: {url: "/webssc/htmlback/klc/settings.html", mergeKey: "basicSettings"}, get_json: {url: "klc/SysConfig/Basicupdate/"}}, marqueeSettings: {get_html: {url: "/webssc/htmlback/klc/settings.html", mergeKey: "marqueeSettings"}, get_json: {url: "klc/sysConfig/marqueeupdate"}, get_json_ssc: {url: "klc/sysConfig/marqueeupdate"}, get_json_pk10: {url: "klc/sysConfig/marqueeupdate"}, get_json_nc: {url: "klc/sysConfig/marqueeupdate"}, get_json_ks: {url: "klc/sysConfig/marqueeupdate"}}, waterLevel: {get_html: {url: "/webssc/htmlback/klc/settings.html", mergeKey: "waterLevel"}, get_json: {url: "klc/SysConfig/Oddsupdate/"}}, bettingLimits: {get_html: {url: "/webssc/htmlback/klc/settings.html", mergeKey: "basicSettings"}, get_json: {url: "klc/SysConfig/Betupdate/"}}, autoOdds: {get_html: {url: "/webssc/htmlback/klc/settings.html", mergeKey: "autoOdds"}, get_json: {url: "klc/SysConfig/Autooddsupdate/"}}, replenishment: {get_html: {url: "/webssc/htmlback/klc/settings.html", mergeKey: "replenishment"}, get_json: {url: "klc/SysConfig/Replenishment/"}}, oddReduce: {get_html: {url: "/webssc/htmlback/klc/settings.html", mergeKey: "oddReduce"}, get_json: {url: "klc/SysConfig/AutoTwoUpdate"}}, result: {get_html: {url: "/webssc/htmlback/klc/result.html"}, get_json_klc: {url: "klc/result/index"}, get_json_ssc: {url: "ssc/result/index"}, get_json_pk10: {url: "pk/result/index"}}, result_klc: {get_html: {url: "/webssc/htmlback/klc/result.html", mergeKey: "result_klc"}, get_json: {url: "klc/result/index"}}, result_ssc: {get_html: {url: "/webssc/htmlback/klc/result.html", mergeKey: "result_ssc"}, get_json: {url: "ssc/result/index"}}, result_pk10: {get_html: {url: "/webssc/htmlback/klc/result.html", mergeKey: "result_pk10"}, get_json: {url: "pk/result/index"}}, result_nc: {get_html: {url: "/webssc/htmlback/klc/result.html", mergeKey: "result_nc"}, get_json: {url: "nc/result/index"}}, result_ks: {get_html: {url: "/webssc/htmlback/klc/result.html", mergeKey: "result_ks"}, get_json: {url: "ks/result/index"}}, reportForm: {get_html: {url: "/webssc/htmlback/klc/report_form.html"}, get_json: {url: "klc/report/getCurrDraws"}}, reportForm_con: {get_json: {url: "klc/report/index"}}, timeManage: {get_html: {url: "/webssc/htmlback/klc/time_manage.html"}, get_json_klc: {url: "klc/draws/index"}, get_json_ssc: {url: "ssc/draws/index"}, get_json_pk10: {url: "pk/draws/index"}, get_json_nc: {url: "nc/draws/index"}, get_json_ks: {url: "ks/draws/index"}}, tongji_nav: {get_html: {url: "/webssc/htmlback/klc/tongji_nav.html", mergeKey: "tongji_nav"}, get_json: {url: "klc/ReceiveStatis/MenuDatas"}}, tongji: {get_html: {url: "/webssc/htmlback/klc/tongji.html", mergeKey: "tongji"}, get_json: {url: "klc/ReceiveStatis/StatisDatas"}, odd_set: {url: "klc/monitor/ajax/"}, detail: {url: "klc/OrderDetail/List/"}, get_buhuo_corp: {url: "klc/shortCoveringCorp/ShortView/"}, get_buhuo_user: {url: "klc/shortCoveringUser/ShortView/"}, gb: {url: "klc/shortCoveringCorp/shortcovering/"}, xb: {url: "klc/shortCoveringUser/shortcovering/"}}, bucang: {get_html: {url: "/webssc/htmlback/klc/bucang.html", mergeKey: "bucang"}, get_json: {url: "klc/shortCoveringDetail/List/"}, change_status: {url: "klc/orderModify/modify/"}}, supervision: {get_html: {url: "/webssc/htmlback/klc/super.html", mergeKey: "supervision"}, get_json: {url: "klc/monitor/ajax/"}, change_odds: {url: "klc/monitor/ajax/?changeodds"}, get_buhuo_corp: {url: "klc/shortCoveringCorp/ShortView/"}, gb: {url: "klc/shortCoveringCorp/shortcovering/"}, detail: {url: "klc/OrderDetail/List/"}, gundan: {url: "../../klc/monitor/RollOrder/"}, download: {url: "../../klc/common/DownloadOrder/"}, buhuoset: {url: "klc/SysConfig/Replenishment/"}, get_json_zjs: {url: "klc/ReceiveStatis/ajax/"}, get_buhuo_corp_zjs: {url: "klc/shortCoveringUser/ShortView/"}, gb_zjs: {url: "klc/shortCoveringUser/shortcovering/"}, detail_zjs: {url: "klc/OrderDetail/List/"}, buhuoset_zjs: {url: "klc/SysConfig/Replenishment/"}}, supervision_nav: {get_html: {url: "/webssc/htmlback/klc/super.html", mergeKey: "supervision_nav"}}, ylch: {get_html: {url: "/webssc/htmlback/klc/ylch.html"}, get_json: {url: "klc/Ylch/Index/"}}, basicSettings_sc: {get_html: {url: "/webssc/htmlback/ssc/settings.html", mergeKey: "basicSettings_sc"}, get_json: {url: "ssc/SysConfig/Basicupdate/"}}, waterLevel_sc: {get_html: {url: "/webssc/htmlback/ssc/settings.html", mergeKey: "waterLevel_sc"}, get_json: {url: "ssc/SysConfig/Oddsupdate/"}}, bettingLimits_sc: {get_html: {url: "/webssc/htmlback/ssc/settings.html", mergeKey: "bettingLimits_sc"}, get_json: {url: "ssc/SysConfig/Betupdate/"}}, autoOdds_sc: {get_html: {url: "/webssc/htmlback/ssc/settings.html", mergeKey: "autoOdds_sc"}, get_json: {url: "ssc/SysConfig/Autooddsupdate/"}}, replenishment_sc: {get_html: {url: "/webssc/htmlback/ssc/settings.html", mergeKey: "replenishment_sc"}, get_json: {url: "ssc/SysConfig/Replenishment/"}}, oddReduce_sc: {get_html: {url: "/webssc/htmlback/ssc/settings.html", mergeKey: "oddReduce_sc"}, get_json: {url: "ssc/SysConfig/AutoTwoUpdate"}}, tongji_nav_sc: {get_html: {url: "/webssc/htmlback/ssc/tongji_nav.html", mergeKey: "tongji_nav_sc"}, get_json: {url: "ssc/ReceiveStatis/MenuDatas"}}, tongji_sc: {get_html: {url: "/webssc/htmlback/ssc/tongji.html", mergeKey: "tongji_sc"}, get_json: {url: "ssc/ReceiveStatis/StatisDatas"}, odd_set: {url: "ssc/monitor/ajax/"}, detail: {url: "ssc/OrderDetail/List/"}, get_buhuo_corp: {url: "ssc/shortCoveringCorp/ShortView/"}, get_buhuo_user: {url: "ssc/shortCoveringUser/ShortView/"}, gb: {url: "ssc/shortCoveringCorp/shortcovering/"}, xb: {url: "ssc/shortCoveringUser/shortcovering/"}}, bucang_sc: {get_html: {url: "/webssc/htmlback/ssc/bucang.html", mergeKey: "bucang_sc"}, get_json: {url: "ssc/shortCoveringDetail/List/"}, change_status: {url: "ssc/orderModify/modify/"}}, supervision_sc: {get_html: {url: "/webssc/htmlback/ssc/super.html", mergeKey: "supervision_sc"}, get_json: {url: "ssc/monitor/ajax/"}, change_odds: {url: "ssc/monitor/ajax/?changeodds"}, get_buhuo_corp: {url: "ssc/shortCoveringCorp/ShortView/"}, gb: {url: "ssc/shortCoveringCorp/shortcovering/"}, detail: {url: "ssc/OrderDetail/List/"}, gundan: {url: "../../ssc/monitor/RollOrder/"}, download: {url: "../../klc/common/DownloadOrder/"}, buhuoset: {url: "ssc/SysConfig/Replenishment/"}, get_json_zjs: {url: "ssc/ReceiveStatis/ajax/"}, get_buhuo_corp_zjs: {url: "ssc/shortCoveringUser/ShortView/"}, gb_zjs: {url: "ssc/shortCoveringUser/shortcovering/"}, detail_zjs: {url: "ssc/OrderDetail/List/"}, buhuoset_zjs: {url: "ssc/SysConfig/Replenishment/"}}, supervision_nav_sc: {get_html: {url: "/webssc/htmlback/ssc/super.html", mergeKey: "supervision_nav_sc"}}, ylch_sc: {get_html: {url: "/webssc/htmlback/ssc/ylch.html"}, get_json: {url: "ssc/Ylch/Index"}}, supervision_nav_pk10: {get_html: {url: "/webssc/htmlback/pk10/super.html", mergeKey: "supervision_nav_pk10"}}, supervision_pk10: {get_html: {url: "/webssc/htmlback/pk10/super.html", mergeKey: "supervision_pk10"}, get_json: {url: "pk/monitor/ajax/"}, change_odds: {url: "pk/monitor/ajax/?changeodds"}, get_buhuo_corp: {url: "pk/shortCoveringCorp/ShortView/"}, gb: {url: "pk/shortCoveringCorp/shortcovering/"}, detail: {url: "pk/OrderDetail/List/"}, gundan: {url: "../../pk/monitor/RollOrder/"}, download: {url: "../../pk/common/DownloadOrder/"}, buhuoset: {url: "pk/SysConfig/Replenishment/"}, get_json_zjs: {url: "pk/ReceiveStatis/ajax/"}, get_buhuo_corp_zjs: {url: "pk/shortCoveringUser/ShortView/"}, gb_zjs: {url: "pk/shortCoveringUser/shortcovering/"}, detail_zjs: {url: "pk/OrderDetail/List/"}, buhuoset_zjs: {url: "pk/SysConfig/Replenishment/"}}, tongji_nav_pk10: {get_html: {url: "/webssc/htmlback/pk10/tongji_nav.html", mergeKey: "tongji_nav"}, get_json: {url: "pk/ReceiveStatis/MenuDatas"}}, tongji_pk10: {get_html: {url: "/webssc/htmlback/pk10/tongji.html", mergeKey: "tongji"}, get_json: {url: "pk/ReceiveStatis/StatisDatas"}, odd_set: {url: "pk/monitor/ajax/"}, detail: {url: "pk/OrderDetail/List/"}, get_buhuo_corp: {url: "pk/shortCoveringCorp/ShortView/"}, get_buhuo_user: {url: "pk/shortCoveringUser/ShortView/"}, gb: {url: "pk/shortCoveringCorp/shortcovering/"}, xb: {url: "pk/shortCoveringUser/shortcovering/"}}, bucang_pk10: {get_html: {url: "/webssc/htmlback/pk10/bucang.html", mergeKey: "bucang"}, get_json: {url: "pk/shortCoveringDetail/List/"}, change_status: {url: "pk/orderModify/modify/"}}, basicSettings_pk10: {get_html: {url: "/webssc/htmlback/pk10/settings.html", mergeKey: "basicSettings_pk10"}, get_json: {url: "pk/SysConfig/Basicupdate/"}}, waterLevel_pk10: {get_html: {url: "/webssc/htmlback/pk10/settings.html", mergeKey: "waterLevel_pk10"}, get_json: {url: "pk/SysConfig/Oddsupdate/"}}, bettingLimits_pk10: {get_html: {url: "/webssc/htmlback/pk10/settings.html", mergeKey: "bettingLimits_pk10"}, get_json: {url: "pk/SysConfig/Betupdate/"}}, autoOdds_pk10: {get_html: {url: "/webssc/htmlback/pk10/settings.html", mergeKey: "autoOdds_pk10"}, get_json: {url: "pk/SysConfig/Autooddsupdate/"}}, replenishment_pk10: {get_html: {url: "/webssc/htmlback/pk10/settings.html", mergeKey: "replenishment_pk10"}, get_json: {url: "pk/SysConfig/Replenishment/"}}, oddReduce_pk10: {get_html: {url: "/webssc/htmlback/pk10/settings.html", mergeKey: "oddReduce_pk10"}, get_json: {url: "pk/SysConfig/AutoTwoUpdate"}}, tongji_nav_nc: {get_html: {url: "/webssc/htmlback/nc/tongji_nav.html", mergeKey: "tongji_nav_nc"}, get_json: {url: "php/nc/tongji_nav.php"}}, tongji_nc: {get_html: {url: "/webssc/htmlback/nc/tongji.html", mergeKey: "tongji"}, get_json: {url: "nc/ReceiveStatis/StatisDatas"}, odd_set: {url: "nc/monitor/ajax/"}, detail: {url: "nc/OrderDetail/List/"}, get_buhuo_corp: {url: "nc/shortCoveringCorp/ShortView/"}, get_buhuo_user: {url: "nc/shortCoveringUser/ShortView/"}, gb: {url: "nc/shortCoveringCorp/shortcovering/"}, xb: {url: "nc/shortCoveringUser/shortcovering/"}}, bucang_nc: {get_html: {url: "/webssc/htmlback/nc/bucang.html", mergeKey: "bucang"}, get_json: {url: "nc/shortCoveringDetail/List/"}, change_status: {url: "nc/orderModify/modify/"}}, supervision_nav_nc: {get_html: {url: "/webssc/htmlback/nc/super.html", mergeKey: "supervision_nav_nc"}}, supervision_nc: {get_html: {url: "/webssc/htmlback/nc/super.html", mergeKey: "supervision_nc"}, get_json: {url: "nc/monitor/ajax/"}, change_odds: {url: "nc/monitor/ajax/?changeodds"}, get_buhuo_corp: {url: "nc/shortCoveringCorp/ShortView/"}, gb: {url: "nc/shortCoveringCorp/shortcovering/"}, detail: {url: "nc/OrderDetail/List/"}, gundan: {url: "../../nc/monitor/RollOrder/"}, download: {url: "../../nc/common/DownloadOrder/"}, buhuoset: {url: "nc/SysConfig/Replenishment/"}, get_json_zjs: {url: "nc/ReceiveStatis/ajax/"}, get_buhuo_corp_zjs: {url: "nc/shortCoveringUser/ShortView/"}, gb_zjs: {url: "nc/shortCoveringUser/shortcovering/"}, detail_zjs: {url: "nc/OrderDetail/List/"}, buhuoset_zjs: {url: "nc/SysConfig/Replenishment/"}}, pre_htmlcache: {get_html: {url: "/webssc/htmlback/klc/all.html", mergeKey: "pre_htmlcache"}}, basicSettings_nc: {get_html: {url: "/webssc/htmlback/nc/settings.html", mergeKey: "basicSettings_nc"}, get_json: {url: "nc/SysConfig/Basicupdate/"}}, waterLevel_nc: {get_html: {url: "htmlback/nc/settings.html", mergeKey: "waterLevel_nc"}, get_json: {url: "nc/SysConfig/Oddsupdate/"}}, bettingLimits_nc: {get_html: {url: "htmlback/nc/settings.html", mergeKey: "bettingLimits_nc"}, get_json: {url: "nc/SysConfig/Betupdate/"}}, autoOdds_nc: {get_html: {url: "htmlback/nc/settings.html", mergeKey: "autoOdds_nc"}, get_json: {url: "nc/SysConfig/Autooddsupdate/"}}, replenishment_nc: {get_html: {url: "/webssc/htmlback/nc/settings.html", mergeKey: "replenishment_nc"}, get_json: {url: "nc/SysConfig/Replenishment/"}}, oddReduce_nc: {get_html: {url: "htmlback/nc/settings.html", mergeKey: "oddReduce_nc"}, get_json: {url: "nc/SysConfig/AutoTwoUpdate"}}, tongji_nav_ks: {get_html: {url: "/webssc/htmlback/ks/tongji_nav.html", mergeKey: "tongji_nav_ks"}, get_json: {url: "php/ks/tongji_nav.php"}}, tongji_ks: {get_html: {url: "/webssc/htmlback/ks/tongji.html", mergeKey: "tongji"}, get_json: {url: "ks/ReceiveStatis/StatisDatas"}, odd_set: {url: "ks/monitor/ajax/"}, detail: {url: "ks/OrderDetail/List/"}, get_buhuo_corp: {url: "ks/shortCoveringCorp/ShortView/"}, get_buhuo_user: {url: "ks/shortCoveringUser/ShortView/"}, gb: {url: "ks/shortCoveringCorp/shortcovering/"}, xb: {url: "ks/shortCoveringUser/shortcovering/"}}, bucang_ks: {get_html: {url: "/webssc/htmlback/ks/bucang.html", mergeKey: "bucang"}, get_json: {url: "ks/shortCoveringDetail/List/"}, change_status: {url: "ks/orderModify/modify/"}}, supervision_nav_ks: {get_html: {url: "/webssc/htmlback/ks/super.html", mergeKey: "supervision_nav_ks"}}, supervision_ks: {get_html: {url: "/webssc/htmlback/ks/super.html", mergeKey: "supervision_ks"}, get_json: {url: "ks/monitor/ajax/"}, change_odds: {url: "ks/monitor/ajax/?changeodds"}, get_buhuo_corp: {url: "ks/shortCoveringCorp/ShortView/"}, gb: {url: "ks/shortCoveringCorp/shortcovering/"}, detail: {url: "ks/OrderDetail/List/"}, gundan: {url: "../../ks/monitor/RollOrder/"}, download: {url: "../../ks/common/DownloadOrder/"}, buhuoset: {url: "ks/SysConfig/Replenishment/"}, get_json_zjs: {url: "ks/ReceiveStatis/ajax/"}, get_buhuo_corp_zjs: {url: "ks/shortCoveringUser/ShortView/"}, gb_zjs: {url: "ks/shortCoveringUser/shortcovering/"}, detail_zjs: {url: "ks/OrderDetail/List/"}, buhuoset_zjs: {url: "ks/SysConfig/Replenishment/"}}, basicSettings_ks: {get_html: {url: "/webssc/htmlback/ks/settings.html", mergeKey: "basicSettings_ks"}, get_json: {url: "ks/SysConfig/Basicupdate/"}}, waterLevel_ks: {get_html: {url: "htmlback/ks/settings.html", mergeKey: "waterLevel_ks"}, get_json: {url: "ks/SysConfig/Oddsupdate/"}}, bettingLimits_ks: {get_html: {url: "htmlback/ks/settings.html", mergeKey: "bettingLimits_ks"}, get_json: {url: "ks/SysConfig/Betupdate/"}}, autoOdds_ks: {get_html: {url: "htmlback/ks/settings.html", mergeKey: "autoOdds_ks"}, get_json: {url: "ks/SysConfig/Autooddsupdate/"}}, replenishment_ks: {get_html: {url: "/webssc/htmlback/ks/settings.html", mergeKey: "replenishment_ks"}, get_json: {url: "ks/SysConfig/Replenishment/"}}, oddReduce_ks: {get_html: {url: "htmlback/ks/settings.html", mergeKey: "oddReduce_ks"}, get_json: {url: "ks/SysConfig/AutoTwoUpdate"}}, statusmanage: {get_html: {url: "/webssc/htmlback/klc/statusmanage.html"}, get_json_klc: {url: "klc/OrderManage/List/"}, get_json_ssc: {url: "ssc/OrderManage/List/"}, get_json_pk10: {url: "pk/OrderManage/List/"}, get_json_nc: {url: "nc/OrderManage/List/"}, get_json_ks: {url: "ks/OrderManage/List/"}, lianma_klc: {url: "klc/orderManage/OrderDetail/"}, lianma_ssc: {url: "ssc/orderManage/OrderDetail/"}, lianma_pk10: {url: "pk/orderManage/OrderDetail/"}, lianma_nc: {url: "nc/orderManage/OrderDetail/"}, lianma_ks: {url: "ks/orderManage/OrderDetail/"}, action_klc: {url: "klc/orderManage/modify/"}, action_ssc: {url: "ssc/orderManage/modify/"}, action_pk10: {url: "pk/orderManage/modify/"}, action_nc: {url: "nc/orderManage/modify/"}, action_ks: {url: "ks/orderManage/modify/"}}, corporationBH: {get_html: {url: "/webssc/htmlback/klc/settings.html", mergeKey: "corporationBH"}, get_json: {url: "klc/SysConfig/ShowCorpCovering"}, get_json_klc: {url: "klc/SysConfig/ShowCorpCovering"}, get_json_ssc: {url: "klc/SysConfig/ShowCorpCovering"}, get_json_pk10: {url: "klc/SysConfig/ShowCorpCovering"}, get_json_nc: {url: "klc/SysConfig/ShowCorpCovering"}, get_json_ks: {url: "klc/SysConfig/ShowCorpCovering"}, setCompany_klc: {url: "klc/SysConfig/SetCorpCovering"}, setCompany_ssc: {url: "klc/SysConfig/SetCorpCovering"}, setCompany_pk10: {url: "klc/SysConfig/SetCorpCovering"}, setCompany_nc: {url: "klc/SysConfig/SetCorpCovering"}, setCompany_ks: {url: "klc/SysConfig/SetCorpCovering"}, delMember_klc: {url: "klc/SysConfig/DelCoverMember"}, delMember_ssc: {url: "klc/SysConfig/DelCoverMember"}, delMember_pk10: {url: "klc/SysConfig/DelCoverMember"}, delMember_nc: {url: "klc/SysConfig/DelCoverMember"}, delMember_ks: {url: "klc/SysConfig/DelCoverMember"}, addMember_klc: {url: "klc/SysConfig/AddCoveringUser"}, addMember_ssc: {url: "klc/SysConfig/AddCoveringUser"}, addMember_pk10: {url: "klc/SysConfig/AddCoveringUser"}, addMember_nc: {url: "klc/SysConfig/AddCoveringUser"}, addMember_ks: {url: "klc/SysConfig/AddCoveringUser"}, saveLevel_klc: {url: "klc/SysConfig/UpdateMemberSort"}, saveLevel_ssc: {url: "klc/SysConfig/UpdateMemberSort"}, saveLevel_pk10: {url: "klc/SysConfig/UpdateMemberSort"}, saveLevel_nc: {url: "klc/SysConfig/UpdateMemberSort"}, saveLevel_ks: {url: "klc/SysConfig/UpdateMemberSort"}}};
P.Set.navNumber_klc = {account_nav: 1, supervision: 2, tongji: 3, timeManage: 4, reportForm: 5, result: 6, seting: 7, operationRecord: 8, rule: 9, changePassword: 10, infop: 11, notice: 12};
P.Set.navNumber_ssc = {account_nav: 1, supervision: 15, tongji: 16, timeManage: 17, reportForm: 5, result: 18, seting: 19, operationRecord: 20, rule: 21, changePassword: 10, infop: 22, notice: 12};
P.Set.navNumber_pk10 = {account_nav: 1, supervision: 24, tongji: 25, timeManage: 29, reportForm: 5, result: 26, seting: 28, operationRecord: 30, rule: 31, changePassword: 10, infop: 27, notice: 12};
P.Set.navNumber_nc = {account_nav: 1, supervision: 33, tongji: 32, timeManage: 34, reportForm: 5, result: 35, seting: 36, operationRecord: 38, rule: 39, changePassword: 10, infop: 37, notice: 12};
P.Set.navNumber_ks = {account_nav: 1, supervision: 53, tongji: 52, timeManage: 54, reportForm: 5, result: 55, seting: 56, operationRecord: 58, rule: 59, changePassword: 10, infop: 57, notice: 12};
var sys = $(".switch-on", "#select_sys");
if (sys.length > 0) {
    P.Set.navNumber = P.Set["navNumber_" + sys[0].id.split("_")[0]]
}
$.fn.dateBox = function (p) {
    var d, q = this, y, C, F, r, A, s;
    var h, w, n, D, v, z, g;
    if (p) {
        var b = p.onClose || function (t) {
            return false
        }
    }
    var o = '<dl class="boxDay" style="display:none"><dt><a class="l" href="#">&lt;&lt;</a><a class="r" href="#">&gt;&gt;</a><b><span name="reyear"></span>年<span name="remouth"></span>月</b></dt><dd class="hd"><span>日</span><span>一</span><span>二</span><span>三</span><span>四</span><span>五</span><span>六</span></dd><dd name="content" class="bd"></dd></dl>';
    var B = $(o).appendTo("body");

    function f(L, H) {
        $("[name='content']", B).empty();
        $("[name='reyear']", B).text(L);
        $("[name='remouth']", B).text(H);
        var M = new Date(), I = "", t, O = 0;

        function J(R, Q) {
            this.year = R;
            this.mouth = Q;
            this.maxDay = function () {
                return(new Date(this.year, this.mouth, 0)).getDate()
            };
            this.minDay = function () {
                return(new Date(new Date(this.year, this.mouth, 0).setDate(1))).getDay()
            }
        }

        var N = new J(L, H);
        for (t = 0; t <= (N.maxDay() + N.minDay() - 1); t++) {
            if (t >= N.minDay()) {
                O = O + 1;
                var K;
                if (O == g && L == v && H == z) {
                    K = "on"
                } else {
                    K = ""
                }
                if (O == M.getUTCDate() && L == M.getUTCFullYear() && H == (M.getUTCMonth() + 1)) {
                    I += '<a name="' + O + '" href="#" class="now ' + K + '">' + O + "</a>"
                } else {
                    I += '<a name="' + O + '" href="#" class="' + K + '">' + O + "</a>"
                }
            } else {
                I += '<a href="#" class="def"></a>'
            }
        }
        $("[name='content']", B).append(I);
        B.data("dateYears", (L + "-" + H + "-"))
    }

    B.click(function (H) {
        var t = H.target;
        if (t.tagName == "A" && Number(t.name) > 0) {
            $('[name="content"] a[name]', B).removeClass("on");
            $(t).addClass("on");
            if (t.name.length == 1) {
                t.name = "0" + t.name
            }
            D = B.data("dateYears") + t.name;
            $(q).val(D);
            m();
            clearTimeout(r);
            r = setTimeout(function () {
                clearTimeout(r);
                r = null;
                B.triggerHandler("hidden")
            }, 0);
            if (typeof b == "function") {
                b(D)
            }
            $(q).triggerHandler("change");
            return false
        }
        if (t.className == "l") {
            clearTimeout(r);
            r = null;
            w = $("[name='reyear']", B).text();
            n = Number($("[name='remouth']", B).text()) - 1;
            if (n === 0) {
                n = 12;
                w = Number(w) - 1
            }
            if (n.toString().length == 1) {
                n = "0" + n
            }
            f(w, n)
        }
        if (t.className == "r") {
            clearTimeout(r);
            r = null;
            w = $("[name='reyear']", B).text();
            n = Number($("[name='remouth']", B).text()) + 1;
            if (n === 13) {
                n = 1;
                w = Number(w) + 1
            }
            if (n.toString().length == 1) {
                n = "0" + n
            }
            f(w, n)
        }
        s = 1;
        return false
    });
    B.mouseover(function () {
        A = 1;
        clearTimeout(r);
        r = null
    }).mouseout(function () {
        A = 0;
        clearTimeout(r);
        r = setTimeout(function () {
            clearTimeout(r);
            r = null;
            B.triggerHandler("hidden")
        }, 1000)
    });
    function E(H, t) {
        h = t.value.split(/\D+/);
        v = h[0];
        z = h[1];
        g = h[2];
        f(v, z);
        d = $(t).offset();
        B.css({left: d.left, top: d.top + 20}).fadeIn("fast");
        c()
    }

    B.bind("show", E);
    function x() {
        B.hide();
        s = 0
    }

    function c() {
        var K = document.getElementsByTagName("select"), H = K.length, J = B[0].getBoundingClientRect(), t, L;
        for (var I = 0; I < H; I++) {
            t = K[I];
            L = t.getBoundingClientRect();
            if (!(J.left >= L.right || J.top >= L.bottom || J.bottom <= L.top || J.right <= L.left)) {
                t.style.visibility = "hidden"
            }
        }
    }

    function m() {
        $("select").css("visibility", "visible")
    }

    $(q).focus(function () {
        q = this;
        B.unbind("hidden", x);
        $(".boxDay").hide();
        B.triggerHandler("show", [q])
    }).blur(function () {
        B.bind("hidden", x);
        c();
        clearTimeout(r);
        if (A) {
            return
        }
        r = setTimeout(function () {
            clearTimeout(r);
            r = null;
            B.triggerHandler("hidden")
        }, 0);
        m()
    });
    $(document).bind("click", function () {
        x();
        m()
    });
    $(q).click(function (t) {
        return false
    });
    $(".boxDay").click(function () {
        return false
    })
};
var template = function (c, b) {
    return template[typeof b === "object" ? "render" : "compile"].apply(template, arguments)
};
(function (b, d) {
    b.version = "2.0.0";
    b.openTag = "<%";
    b.closeTag = "%>";
    b.isEscape = true;
    b.isCompress = false;
    b.parser = null;
    b.render = function (o, n) {
        var m = h(o);
        if (m === undefined) {
            return f({id: o, name: "Render Error", message: "No Template"})
        }
        return m(n)
    };
    b.compile = function (t, q) {
        var s = arguments;
        var n = s[2];
        var p = "anonymous";
        if (typeof q !== "string") {
            n = s[1];
            q = s[0];
            t = p
        }
        try {
            var m = c(q, n)
        } catch (r) {
            r.id = t || q;
            r.name = "Syntax Error";
            return f(r)
        }
        function o(v) {
            try {
                return new m(v) + ""
            } catch (w) {
                if (!n) {
                    return b.compile(t, q, true)(v)
                }
                w.id = t || q;
                w.name = "Render Error";
                w.source = q;
                return f(w)
            }
        }

        o.prototype = m.prototype;
        o.toString = function () {
            return m.toString()
        };
        if (t !== p) {
            g[t] = o
        }
        return o
    };
    b.helper = function (m, n) {
        b.prototype[m] = n
    };
    b.onerror = function (n) {
        var m = "[template]:\n" + n.id + "\n\n[name]:\n" + n.name;
        if (n.message) {
            m += "\n\n[message]:\n" + n.message
        }
        if (n.line) {
            m += "\n\n[line]:\n" + n.line;
            m += "\n\n[source]:\n" + n.source.split(/\n/)[n.line - 1].replace(/^[\s\t]+/, "")
        }
        if (n.temp) {
            m += "\n\n[temp]:\n" + n.temp
        }
        if (d.console) {
            console.error(m)
        }
    };
    var g = {};
    var h = function (p) {
        var m = g[p];
        if (m === undefined && "document" in d) {
            var n = document.getElementById(p);
            if (n) {
                var o = n.value || n.innerHTML;
                return b.compile(p, o.replace(/^\s*|\s*$/g, ""))
            }
        } else {
            if (g.hasOwnProperty(p)) {
                return m
            }
        }
    };
    var f = function (n) {
        b.onerror(n);
        function m() {
            return m + ""
        }

        m.toString = function () {
            return"{Template Error}"
        };
        return m
    };
    var c = (function () {
        b.prototype = {$render: b.render, $escape: function (r) {
            return typeof r === "string" ? r.replace(/&(?![\w#]+;)|[<>"']/g, function (t) {
                return{"<": "&#60;", ">": "&#62;", '"': "&#34;", "'": "&#39;", "&": "&#38;"}[t]
            }) : r
        }, $string: function (r) {
            if (typeof r === "string" || typeof r === "number") {
                return r
            } else {
                if (typeof r === "function") {
                    return r()
                } else {
                    return""
                }
            }
        }};
        var m = Array.prototype.forEach || function (v, s) {
            var r = this.length >>> 0;
            for (var t = 0; t < r; t++) {
                if (t in this) {
                    v.call(s, this[t], t, this)
                }
            }
        };
        var p = function (s, r) {
            m.call(s, r)
        };
        var q = "break,case,catch,continue,debugger,default,delete,do,else,false,finally,for,function,if,in,instanceof,new,null,return,switch,this,throw,true,try,typeof,var,void,while,with,abstract,boolean,byte,char,class,const,double,enum,export,extends,final,float,goto,implements,import,int,interface,long,native,package,private,protected,public,short,static,super,synchronized,throws,transient,volatile,arguments,let,yield,undefined";
        var n = new RegExp(["/\\*(.|\n)*?\\*/|//[^\n]*\n|//[^\n]*$", "'[^']*'|\"[^\"]*\"", "\\.[s\t\n]*[\\$\\w]+", "\\b" + q.replace(/,/g, "\\b|\\b") + "\\b"].join("|"), "g");
        var o = function (r) {
            r = r.replace(n, ",").replace(/[^\w\$]+/g, ",").replace(/^,|^\d+|,\d+|,$/g, "");
            return r ? r.split(",") : []
        };
        return function (I, K) {
            var F = b.openTag;
            var A = b.closeTag;
            var w = b.parser;
            var s = I;
            var v = "";
            var C = 1;
            var H = {$data: true, $helpers: true, $out: true, $line: true};
            var J = b.prototype;
            var E = {};
            var z = "var $helpers=this," + (K ? "$line=0," : "");
            var N = "".trim;
            var Q = N ? ["$out='';", "$out+=", ";", "$out"] : ["$out=[];", "$out.push(", ");", "$out.join('')"];
            var y = N ? "if(content!==undefined){$out+=content;return content}" : "$out.push(content);";
            var x = "function(content){" + y + "}";
            var r = "function(id,data){if(data===undefined){data=$data}var content=$helpers.$render(id,data);" + y + "}";
            p(s.split(F), function (U, T) {
                U = U.split(A);
                var S = U[0];
                var R = U[1];
                if (U.length === 1) {
                    v += B(S)
                } else {
                    v += L(S);
                    if (R) {
                        v += B(R)
                    }
                }
            });
            s = v;
            if (K) {
                s = "try{" + s + "}catch(e){e.line=$line;throw e}"
            }
            s = "'use strict';" + z + Q[0] + s + "return new String(" + Q[3] + ")";
            try {
                var O = new Function("$data", s);
                O.prototype = E;
                return O
            } catch (M) {
                M.temp = "function anonymous($data) {" + s + "}";
                throw M
            }
            function B(R) {
                C += R.split(/\n/).length - 1;
                if (b.isCompress) {
                    R = R.replace(/[\n\r\t\s]+/g, " ")
                }
                R = R.replace(/('|\\)/g, "\\$1").replace(/\r/g, "\\r").replace(/\n/g, "\\n");
                R = Q[1] + "'" + R + "'" + Q[2];
                return R + "\n"
            }

            function L(T) {
                var U = C;
                if (w) {
                    T = w(T)
                } else {
                    if (K) {
                        T = T.replace(/\n/g, function () {
                            C++;
                            return"$line=" + C + ";"
                        })
                    }
                }
                if (T.indexOf("=") === 0) {
                    var S = T.indexOf("==") !== 0;
                    T = T.replace(/^=*|[\s;]*$/g, "");
                    if (S && b.isEscape) {
                        var R = T.replace(/\s*\([^\)]+\)/, "");
                        if (!J.hasOwnProperty(R) && !/^(include|print)$/.test(R)) {
                            T = "$escape($string(" + T + "))"
                        }
                    } else {
                        T = "$string(" + T + ")"
                    }
                    T = Q[1] + T + Q[2]
                }
                if (K) {
                    T = "$line=" + U + ";" + T
                }
                D(T);
                return T + "\n"
            }

            function D(R) {
                R = o(R);
                p(R, function (S) {
                    if (!H.hasOwnProperty(S)) {
                        t(S);
                        H[S] = true
                    }
                })
            }

            function t(R) {
                var S;
                if (R === "print") {
                    S = x
                } else {
                    if (R === "include") {
                        E["$render"] = J["$render"];
                        S = r
                    } else {
                        S = "$data." + R;
                        if (J.hasOwnProperty(R)) {
                            E[R] = J[R];
                            if (R.indexOf("$") === 0) {
                                S = "$helpers." + R
                            } else {
                                S = S + "===undefined?$helpers." + R + ":" + S
                            }
                        }
                    }
                }
                z += R + "=" + S + ","
            }
        }
    })()
})(template, this);
if (typeof define === "function") {
    define(function (c, b, d) {
        d.exports = template
    })
} else {
    if (typeof exports !== "undefined") {
        module.exports = template
    }
}
P.Mod.account_nav = function (b) {
    var c = this;
    this.dom = b;
    this.listHistory = [];
    b.bind("click mouseover mouseout", function (g, f) {
        var d = $(g.target);
        if (g.target.nodeName == "LI" || d.parent("li")[0]) {
            d = d.parent("li")[0] ? $(d.parent("li")[0]) : d;
            if (g.type == "click") {
                c.level = d.attr("level");
                if (!d.hasClass("on")) {
                    d.siblings(".on").removeClass("on").end().addClass("on");
                    c.dom.attr("cl", d.attr("level"))
                }
                c.changeList(c.level, f)
            }
            g.type == "mouseover" && d.addClass("hover");
            g.type == "mouseout" && d.removeClass("hover")
        }
    });
    b.bind("changeaccount", function (g, h) {
        var m = parseInt(P.Set.level, 10) + 1, f = parseInt(P.Set.masterId, 10);
        if (h.accounts) {
            !f && (document.getElementById("accounts0").innerHTML = h.accounts[m - 1]);
            for (i = m; i < 6; i++) {
                document.getElementById("accounts" + i).innerHTML = h.accounts[i]
            }
        }
        if (h.number) {
            for (j = 0, k = h.number.length; j < k; j++) {
                document.getElementById("num" + j).innerHTML = h.number[j]
            }
        }
    });
    b.bind("listBack", function (f) {
        c.listHistory.pop();
        var d = c.listHistory.pop();
        d && $("li[level=" + d.level + "]", c.dom).trigger("click", [d]);
        d = null
    });
    b.bind("openclose", function () {
        var d = c.parentLoader.dom;
        if (d[0].style.display === "block") {
            d[0].style.display = "none"
        } else {
            d.show()
        }
    });
    this.getStatus()
};
P.Mod.account_nav.prototype.changeList = function (g, b) {
    b = b || {};
    var c = {}, d;
    var f = $("#list_back");
    if (f[0]) {
        f[0].style.display = "none"
    }
    switch (g) {
        case"0":
            d = "guanliyuanList";
            break;
        case"1":
        case"2":
        case"3":
        case"4":
            b.level = g;
            this.listHistory.push(b);
            d = "memberList";
            break;
        case"5":
            b.level = "5";
            this.listHistory.push(b);
            d = "huiyuanList";
            break
    }
    b.status = "1";
    P.Utl.publicChengeModule("rightLoader", "ajax", d, "get_html", "get_json", b);
    this.listHistory.length == 11 && this.listHistory.shift();
    ((b.hasOwnProperty("superiorid") && b.superiorid !== "") || (b.hasOwnProperty("superid") && b.superid !== "")) && $("#list_back").show()
};
P.Mod.account_nav.prototype.getStatus = function () {
    var b = this;
    this.wheel = setInterval(function () {
        b.getStatusfun()
    }, parseInt(P.Set.onlineRefresh, 10))
};
P.Mod.account_nav.prototype.getStatusfun = function () {
    var m = this;
    var f = document.getElementById("accounts_tb");
    if (!f) {
        return
    }
    var d = $("tr", f), c = 0, b = d.length, h = [], g = "";
    for (; c < b; c++) {
        h[c] = d[c].id
    }
    g = h.join(",");
    if (g === "") {
        return
    }
    $.UT.publicGetAction("account_nav", {tid: g}, function (o) {
        var r, q, n = o.onlineSatus || {};
        for (r in n) {
            q = document.getElementById(r + "_isonline");
            var p = parseInt($("#nav .on").attr("level"), 10);
            if (q) {
                if (p != 0) {
                    $(q).nextAll()[3].innerHTML = n[r][2]
                }
                q.methodName = ["offline", "online"][parseInt(n[r][0], 10)];
                q.className = q.methodName;
                if (parseInt(n[r][0], 10)) {
                    q.setAttribute("title", "当前登录IP：" + n[r][1])
                } else {
                    q.setAttribute("title", q.getAttribute("title").replace("当前登录IP：", "最后一次登录IP："))
                }
            }
        }
        m.cpsdata(o);
        q = null;
        r = null;
        n = null
    }, "get_json", function (o, p, n) {
    });
    f = null;
    d = null;
    h = null;
    g = null
};
P.Mod.account_nav.prototype.rebind = function () {
    this.getStatus()
};
P.Mod.account_nav.prototype.setData = function (h) {
    var q = this, r = this.dom, m, g, f, p = "", c = parseInt(P.Set.level, 10) + 1, b = parseInt(P.Set.masterId, 10);
    var o = ["管理员", "分公司", "股东", "总代理", "代理", "会员"];
    q.changeList(c + "", {level: c});
    if (!document.getElementById("nav").getElementsByTagName("li").length) {
        if (!b) {
            p += '<li level="0">' + o[0] + '<em id="accounts0">0</em></li>'
        }
        for (m = c; m < 6; m++) {
            p += '<li level="' + m + '">' + o[m] + '<em id="accounts' + m + '">0</em></li>'
        }
        q.nav = $("#nav", r).html(p)
    }
    var d = 1;
    if (b) {
        d = 0
    }
    var s = $("#account_nav li").removeClass("on").eq(d);
    s.addClass("on")
};
P.Mod.account_nav.prototype.cpsdata = function (c) {
    if (c.account) {
        var b;
        for (j = 0, k = c.account.length; j < k; j++) {
            b = document.getElementById("num" + j);
            b && (b.innerHTML = c.account[j])
        }
    }
};
P.Mod.account_nav.prototype.unbind = function () {
    clearInterval(this.wheel);
    delete this.wheel
};
P.Mod.log = function (b) {
    var c = this;
    b.delegate("tbody tr", "mouseover mouseout", function (f) {
        var d = f.target;
        if (f.type === "mouseover") {
            this.methodName = "bc"
        }
        if (f.type === "mouseout") {
            this.methodName = ""
        }
    });
    $("#reback").click(function () {
        $("#account_nav").trigger("openclose");
        c.parentLoader.goBack(1)
    })
};
P.Mod.log.prototype.setData = function (f, p, n) {
    var h = "<tbody>", o, m, g, c = [], p = p || "log", n = n || 4;
    if (f instanceof Array && f.length) {
        o = 0;
        m = f.length;
        for (; o < m; o++) {
            g = f[o];
            c = ["<tr><td>", g[0], "</td><td>", g[1], "</td><td>", g[2], "</td><td>", g[3], "</td>"];
            if (g.length > 4) {
                c.push("<td>", g[4], "</td><td>", g[5], "</td><td>", g[6], "</td><td>", g[7], "</td>")
            }
            c.push("</tr>");
            h += c.join("")
        }
    } else {
        h += "<tr><td colspan='" + n + "'>暂无数据！</td></tr>"
    }
    h += "</tbody>";
    $("#" + p + "_tb", this.dom).append(h);
    var b = parseInt($("#nav li.on").attr("level"), 10);
    document.getElementById("account_name").innerHTML = ["管理员", "分公司", "股东", "总代理", "代理", "会员"][b] + ": " + G.temp
};
P.Mod.log.prototype.unbind = function () {
    $("tbody", "#log_tb").remove();
    document.getElementById("account_name").innerHTML = "";
    delete G.temp
};
P.Mod.record = function (b) {
    var c = this;
    b.delegate("tbody tr", "mouseover mouseout", function (f) {
        var d = f.target;
        if (f.type === "mouseover") {
            this.methodName = "bc"
        }
        if (f.type === "mouseout") {
            this.methodName = ""
        }
    });
    $("#reback").click(function () {
        $("#account_nav").trigger("openclose");
        c.parentLoader.goBack(1)
    })
};
P.Mod.record.prototype.setData = function (b) {
    P.Mod.log.prototype.setData.call(this, b, "record", 8)
};
P.Mod.record.prototype.unbind = function () {
    $("tbody", "#record_tb").remove();
    document.getElementById("account_name").innerHTML = "";
    delete G.temp
};
P.Mod.guanliyuan = function (f) {
    this.dom = f;
    var h = this;
    this.rights = ["ZHGL", "XCJD", "SFTJ", "CPJL", "BACX", "QSGL", "KJGL", "XTSD"];
    if (P.Set.level == "0") {
        this.rights.push("ZDGL")
    }
    P.Utl.allCheck({allCheckbox: "caption", listCheckbox: "tbody"});
    f.bind("click keypress", function (o) {
        var m = o.target, n = $("#layout").Module();
        if (o.type == "keypress" && o.keyCode == 13 && (m.id !== "reset" && m.id !== "reback")) {
            h.submit()
        }
        if (o.type == "click") {
            if (m.id == "reback" || m.id == "reset") {
                $("#account_nav").trigger("openclose");
                h.parentLoader.goBack("guanliyuanList")
            }
            if (m.id == "submit") {
                h.submit()
            }
        }
    });
    P.Utl.accountCheck(h.dom[0].id);
    this.condition = G.condition || {};
    this.level = P.Set.level;
    this.condition.level = P.Set.level;
    if (this.level != "0" || this.level != 0) {
        this.rights = this.rights.join(",").replace("XCJD,", "").replace("CPJL,", "").replace("QSGL,", "").split(",")
    } else {
        $("#ylch_t").html("是否查看预留吃货报表");
        $("#ylch_c").html('<label for="ylchFlag2"><input id="ylchFlag2" value="true"  name="ylchFlag" type="radio"  />允许</label> <label for="ylchFlag1"><input id="ylchFlag1" value="false" name="ylchFlag" type="radio" checked  />不允许</label>')
    }
    var d = "", g = document.getElementById("rights"), b = $("td[right]", g);
    for (var c = 0; c < b.length; c++) {
        d = b[c].getAttribute("right");
        if (jQuery.inArray(d, this.rights) == -1) {
            g.removeChild(b[c])
        }
    }
    g = null;
    b = null
};
P.Mod.guanliyuan.prototype.rebind = function () {
    var b = this;
    this.condition = G.condition || {};
    this.level = P.Set.level;
    this.condition.level = P.Set.level;
    P.Utl.accountCheck(b.dom[0].id)
};
P.Mod.guanliyuan.prototype.setData = function (b) {
    if (b.userid !== undefined) {
        this.userid = b.userid;
        document.getElementsByName("account")[0].readOnly = true;
        document.getElementsByName("account")[0].className = "gray1";
        document.getElementById("account_name").innerHTML = "修改管理员" + b.account;
        this.successInfo = "修改成功"
    } else {
        document.getElementById("account_name").innerHTML = "新增管理员";
        setTimeout(function () {
            $("select[name='status']").val(1)
        }, 20);
        this.successInfo = "新增成功"
    }
    this.createRight(this.rights, b.right);
    this.rules = this.renderUser({userid: b.userid, user: b}, P.Utl.commonRelues);
    delete this.rules.rules.credit;
    delete this.rules.rules.share_total;
    delete this.rules.rules.share_up;
    this.vRules = $("#user_info").Widget("SimpleValidator", this.rules);
    document.getElementById("selectAll").focus()
};
P.Mod.guanliyuan.prototype.renderUser = P.Utl.renderUser;
P.Mod.guanliyuan.prototype.subInfo = P.Utl.subInfo;
P.Mod.guanliyuan.prototype.createRight = function (g, c) {
    var f = "", h = document.getElementById("rights"), b = $("td[right]", h);
    for (var d = 0; d < b.length; d++) {
        f = b[d].getAttribute("right");
        if (c !== undefined) {
            if (jQuery.inArray(f, c) == -1) {
                $("#" + f).attr("checked", false).prop("defaultChecked", false)
            } else {
                $("#" + f).attr("checked", true).prop("defaultChecked", true)
            }
            if (g.length != c.length) {
                $("#selectAll").attr("checked", false).prop("defaultChecked", false)
            }
        }
    }
    h = null;
    b = null
};
P.Mod.guanliyuan.prototype.submit = function () {
    var h = this, m = this.dom, p, d = [], c;
    var o = P.Utl.isChangeForm(m);
    if (!o) {
        $.UT.Alert({text: "请做修改后，再保存", booLean: false});
        return
    }
    var p = h.vRules.verifyForm();
    if (p !== true) {
        var n = P.Utl.getValCtl(p), f = h.rules.errorMessages[n.ctl][n.msg];
        $.UT.Alert({text: f, cancelCallback: function () {
            $("input[vname=" + n.ctl + "]", h.dom).select()
        }, booLean: false});
        return
    }
    d = h.subInfo();
    if (h.userid !== undefined) {
        d.userid = h.userid
    } else {
        h.condition.pager = 1
    }
    if (h.level !== undefined) {
        d.level = h.level;
        c = h.level
    }
    d.rights = [];
    var g = $("#rights :checked");
    for (var b = 0; b < g.length; b++) {
        d.rights.push(g[b].id)
    }
    $.UT.publicGetAction(h.dom[0].id, d, function (r) {
        if (true === r.success) {
            var q = $("#layout").Module();
            P.Utl.publicChengeModule(q.right, "ajax", "guanliyuanList", "get_html", "get_json", h.condition);
            $.UT.Alert({text: h.successInfo, booLean: false})
        }
        $("#account_nav").trigger("openclose")
    }, "submit", false, true, true, {button: "#submit", data: '<span class="loading"></span><span class="L_H32">数据提交中，请稍候...</span>'})
};
P.Mod.guanliyuan.prototype.unbind = function () {
    delete this.userid;
    delete this.condition;
    delete this.rules;
    if (this.vRules) {
        this.vRules.hideTips();
        this.vRules.hideIco();
        $.removeData(this.vRules.dom[0]);
        delete this.vRules
    }
    $("input[name=account]", document.getElementById("user_info")).removeAttr("readOnly").removeClass("gray1");
    var b = ["name", "account", "password", "repassword"];
    if (P.Set.level === "0") {
        b.push("ylchFlag")
    }
    P.Utl.defaultValue(b, "0");
    delete this.level;
    $("input:checkbox", $("table.right")).attr("checked", true).prop("defaultChecked", true);
    document.getElementById("account_name").innerHTML = ""
};
P.Mod.dagudong = function (b) {
    this.dom = b;
    this.level = 1;
    P.Utl.spaner("#games_info");
    P.Utl.spaner("#general_info");
    var d = this, c = b[0].id;
    b.bind("click keypress change", function (m) {
        var g = m.target, h;
        if (m.type == "keypress" && m.keyCode == 13 && (g.id !== "reset" && g.id !== "reback")) {
            var f = g.getAttribute("vname") || "";
            if (f.indexOf("general") == -1 && g.nodeName != "A") {
                d.submit()
            }
        }
        if (m.type === "click") {
            if (g.id === "reback" || g.id === "reset") {
                $("#account_nav").trigger("openclose");
                d.parentLoader.goBack("memberList")
            }
            if (g.id === "submit") {
                d.submit()
            }
            if (g.id == "share_total") {
                $("#share_total_list").toggle()
            } else {
                if ($("#share_total_list").css("display") != "none") {
                    $("#share_total_list").css("display", "none")
                }
            }
            if (g.id === "g00") {
                P.Utl.quickSet(c, g, 1)
            }
            if (g.id == "g01") {
                P.Utl.quickSet(c, g, 2)
            }
            if (g.id === "g02") {
                P.Utl.quickSet(c, g, 3)
            }
            if (g.id == "g03") {
                P.Utl.quickSet(c, g, 4)
            }
        }
        if (m.type == "change" && g.getAttribute("name") == "corpRptFlag") {
            if (g.value == "true") {
                d.detRptFlag.removeAttr("disabled")
            } else {
                d.detRptFlag.filter("#detRptFlag1").click().end().attr("disabled", "disabled")
            }
        }
        if (m.type === "change" && g.className.indexOf("quickset") > -1) {
            $(g).removeClass("quickset")
        }
        if (m.type === "change" && g.getAttribute("name") === "set_water") {
            var n = g.value;
            P.Utl.water_set(n, b)
        }
    });
    P.Utl.accountCheck(d.dom[0].id);
    this.condition = G.condition || {};
    this.condition.level = "1";
    this.detRptFlag = $("#detRptFlag1,#detRptFlag2", b);
    P.Utl.water_event(b)
};
P.Mod.dagudong.prototype.rebind = function () {
    var b = this;
    this.condition = G.condition || {};
    this.condition.level = "1";
    P.Utl.accountCheck(b.dom[0].id)
};
P.Mod.dagudong.prototype.setData = function (b) {
    this.maxShareTotal = b.maxShareTotal || [100, 0];
    P.Utl.accountRender.call(this, b, 1);
    if (b.hasOwnProperty("user") && b.user.hasOwnProperty("corpRptFlag") && b.user.corpRptFlag.toString() === "true") {
        this.detRptFlag.removeAttr("disabled")
    }
    this.data = b
};
P.Mod.dagudong.prototype.submit = function () {
    P.Utl.accountSubmit.call(this)
};
P.Mod.dagudong.prototype.unbind = function () {
    delete this.userid;
    delete this.rules;
    delete this.gameRule;
    delete this.otherRule;
    delete this.condition;
    delete this.stepData;
    if (this.vRules) {
        this.vRules.hideTips();
        this.vRules.hideIco();
        $.removeData(this.vRules.dom[0]);
        delete this.vRules
    }
    if (this.vgRules) {
        $.removeData(this.vgRules.dom[0], "Validator");
        delete this.vgRules
    }
    $("input[name=account]", document.getElementById("user_info")).removeAttr("readOnly").removeClass("gray1");
    var b = ["name", "account", "password", "repassword", "credit", "odds_set", "status", "short_covering", "share_total", "corpRptFlag", "isDgdShare", "detRptFlag", "share_flag", "savedefault"];
    P.Utl.defaultValue(b, "1");
    document.getElementById("account_name").innerHTML = "";
    this.detRptFlag.attr("disabled", "disabled");
    $("#share_up_list").hide();
    $("#share_toatl_list").hide();
    $("#games_info .quickset").removeClass("quickset");
    $(".g-vd-error").remove();
    $(".set_water_t").hide();
    $("#set_water_td").html("")
};
P.Utl.accountRender = function (g, h) {
    var c = ["管理员", "分公司", "股东", "总代理", "代理", "会员"];
    var f = g.userid ? "reset" : "new";
    if (g.userid) {
        this.userid = g.userid;
        document.getElementsByName("account")[0].readOnly = true;
        document.getElementsByName("account")[0].className = "gray1";
        document.getElementById("account_name").innerHTML = "修改" + c[h] + g.user.account + "   ";
        this.successInfo = "修改成功";
        var b = document.getElementById("games_info").getElementsByTagName("input")[0]
    } else {
        document.getElementById("account_name").innerHTML = "新增" + c[h] + "   ";
        this.successInfo = "新增成功";
        this.condition.pager = 1;
        var b = document.getElementById("user_info").getElementsByTagName("input")[0]
    }
    b.select();
    b.focus();
    b = null;
    if (g.superior) {
        g.superior[0] = ["管理员", "分公司", "股东", "总代理", "代理", "会员"][parseInt(g.superior[0], 10)];
        $("#superior").html(g.superior[0] + ":" + g.superior[1])
    }
    if (g.superiorid) {
        this.superiorid = g.superiorid
    }
    this.rules = P.Utl.renderUser(g, P.Utl.commonRelues, h);
    this.vRules = $("#user_info").Widget("SimpleValidator", this.rules);
    this.gameRule = P.Utl.renderGame(g, h);
    this.vgRules = $("#games_info").Widget("Validator", this.gameRule);
    var d = P.Utl.renderGame(g, h, {general: 1});
    this.quickSet = $("#general_info").Widget("Validator", d)
};
P.Utl.accountSubmit = function (c) {
    var g = this, c = {}, p = 0, s = true, f = false;
    var h = document.getElementById("savedefault");
    s = P.Utl.isChangeForm("#user_info");
    f = P.Utl.isGameChange("#games_info");
    if (h) {
        if (h.checked) {
            p = 1
        }
    }
    if (!s && !f.isChanged && p == 0) {
        $.UT.Alert({text: "请做修改后，再保存", booLean: false});
        return
    }
    var n = g.maxShareTotal || [100, 0];
    if (g.level == 1) {
        var t = $("input[name=share_total]").zhanc(n);
        if (t === true) {
            return
        }
    }
    if (g.level == 5) {
        var r = $("input[name=share_up]").zhanc(n);
        if (r === true) {
            return
        }
    }
    if (g.level > 1 && g.level < 5) {
        var b = n[0] - n[1], t = $("input[name=share_up]").zhanc([b, 0]), r = $("input[name=share_total]");
        if (t === true) {
            return
        }
        var q = n[0] - parseInt(t.val(), 10);
        var o = r.zhanc([q, n[1]]);
        if (o === true) {
            return
        }
    }
    var w = g.vRules.verifyForm();
    if (w !== true) {
        var m = P.Utl.getValCtl(w), d = g.rules.errorMessages[m.ctl][m.msg];
        $.UT.Alert({text: d, cancelCallback: function () {
            $("input[vname=" + m.ctl + "]", g.dom).select()
        }, booLean: false});
        return
    }
    var v = g.vgRules.verifyForm();
    if (v !== true) {
        var m = P.Utl.getValCtl(v), d = g.gameRule.errorMessages[m.ctl][m.msg];
        $.UT.Alert({text: d, cancelCallback: function () {
            setTimeout(function () {
                $("input[vname=" + m.ctl + "]", "#game_info").select()
            }, 20)
        }, booLean: false});
        return
    }
    c = P.Utl.subInfo(f.name);
    if (g.level) {
        c.level = g.level
    }
    if (g.superiorid) {
        c.superiorid = g.superiorid
    }
    if (this.userid) {
        c.userid = this.userid
    }
    if (this.level == 5) {
        c.share_flag = false
    }
    if (h) {
        if (h.checked) {
            c.savedefault = 1
        }
    }
    this.stepData = c;
    if (!s && !f.isChanged && this.type == "edit") {
        $.UT.publicGetAction(g.dom[0].id, {userid: g.userid}, function (x) {
            g.OthersetData(x);
            g.game = "#other_info";
            $("input[vname='ordermin00']", g.dom)[1].select()
        }, "other", false, true, true, {button: "#submit"});
        return
    }
    $.UT.publicGetAction(g.dom[0].id, c, function (z) {
        if (true === z.success) {
            var x = $("#layout").Module();
            var y = g.level == 5 ? "huiyuanList" : "memberList";
            P.Utl.publicChengeModule(x.right, "ajax", y, "get_html", "get_json", g.condition);
            $.UT.Alert({text: g.successInfo, booLean: false})
        }
        $("#account_nav").trigger("openclose")
    }, "submit", false, true, true, {button: "#submit", data: '<span class="loading"></span><span class="L_H32">数据提交中，请稍候...</span>'})
};
jQuery.fn.zhanc = function (b) {
    var d = this.val(), c = /^0$|^100$|^[1-9]\d{0,1}$/g;
    var f = this;
    if (c.test(d)) {
        d = parseInt(d, 10);
        if ((d - b[1]) * (b[0] - d) < 0) {
            $.UT.Alert({text: "占成为" + b[1] + "~" + b[0] + "之间的整数", booLean: false, determineCallback: function () {
                $(f).select()
            }});
            return true
        }
    } else {
        $.UT.Alert({text: "占成数输入不正确", booLean: false, determineCallback: function () {
            $(f).select()
        }});
        return true
    }
    return this
};
P.Utl.defaultValue = function (d, b) {
    var o = document.getElementById("user_info"), c, f, p = 0, m = d.length, n;
    for (; p < m; p++) {
        n = d[p];
        switch (n) {
            case"name":
            case"account":
            case"password":
            case"repassword":
            case"credit":
            case"share_up":
            case"share_total":
                $("input[name=" + n + "]", o).val("").prop("defaultValue", "").unbind();
                break;
            case"short_covering":
            case"corpRptFlag":
            case"isDgdShare":
            case"ylchFlag":
            case"detRptFlag":
                $("#" + n + "2").removeAttr("checked").prop("defaultChecked", false);
                $("#" + n + "1").attr("checked", true).prop("defaultChecked", true);
                break;
            case"share_flag":
                if (b == 5) {
                    $("#" + n + "1").removeAttr("checked").prop("defaultChecked", false);
                    $("#" + n + "2").attr("checked", true).prop("defaultChecked", true)
                } else {
                    $("#" + n + "2").removeAttr("checked").prop("defaultChecked", false);
                    $("#" + n + "1").attr("checked", true).prop("defaultChecked", true)
                }
                break;
            case"odds_set":
                if (!b) {
                    $("select[name=" + n + "]", o).find("option").remove()
                } else {
                    if (n === "odds_set") {
                        f = '<option value="A" selected>A</option><option value="B" >B</option><option value="C" >C</option>'
                    }
                    $("select[name=" + n + "]", o).html(f)
                }
                break;
            case"set_water":
                break;
            case"status":
                $("select[name=status]", o).html(' <option value="0">停用</option><option value="2">停押</option><option value="1" selected>启用</option>');
                break
        }
    }
    $(".share_up_list li").unbind();
    $(".share_up_div input").unbind();
    var g = document.getElementById("savedefault");
    if (g) {
        g.checked = false;
        $(g).prop("defaultChecked", false)
    }
    $("span.g-vd-tooltip,span.g-vd-status", o).remove();
    o = null
};
P.Utl.water_set = function (b, d) {
    var c = $(d).Module().data;
    b = Number(b);
    if (c) {
        switch (b) {
            case -1:
                P.Utl.water_set_data(c, "userData", 3);
                break;
            case 0:
                P.Utl.water_set_data(c, "pUserData", 0);
                break;
            case 100:
                $("#games_info  .spaning input").val(0).prop("defaultValue", "0");
                break;
            default:
                P.Utl.water_set_data(c, "pUserData", 0, b)
        }
    }
};
P.Utl.water_set_data = function (o, p, g, v) {
    var t = ["klc", "ssc", "pk10", "nc", "ks"], h, q, m, f, r = document, c, b, w;
    for (var n = 0; n < t.length; n++) {
        h = o[t[n]];
        if (h && h[p]) {
            for (var s in h[p]) {
                f = r.getElementsByName(t[n] + s);
                m = h[p][s] || [];
                c = m[g];
                b = m[g + 1];
                w = m[g + 2];
                if (v) {
                    c = (Number(c, 10) * 1000 - v * 1000) / 1000;
                    b = (Number(b, 10) * 1000 - v * 1000) / 1000;
                    w = (Number(w, 10) * 1000 - v * 1000) / 1000;
                    c = c > 0 ? c : 0;
                    b = b > 0 ? b : 0;
                    w = w > 0 ? w : 0;
                    c = Number(c.toFixed(3));
                    b = Number(b.toFixed(3));
                    w = Number(w.toFixed(3))
                }
                $(f[3]).val(c).prop("defaultValue", c);
                $(f[4]).val(b).prop("defaultValue", b);
                $(f[5]).val(w).prop("defaultValue", w)
            }
        }
    }
};
P.Utl.water_event = function (b) {
    $(b).bind("waterSet", function (c, d) {
        if (d == "edit") {
            $(".set_water_t, #set_water_tr").hide();
            $("#set_water_td").html("")
        } else {
            $(".set_water_t, #set_water_tr").show();
            $("#set_water_td").html("<select name='set_water'></select>")
        }
    })
};
P.Mod.superior = function (c) {
    this.dom = c;
    this.sup = ["管理员", "分公司", "股东", "总代理", "代理", "会员"];
    var d = this, b = "";
    c.bind("change", function (m) {
        var f = m.target;
        if (f.id == "superior_new") {
            var g = $(f).val(), h = $("#layout").Module(), n = {level: d.level, superiorid: g};
            if (d.level != "5") {
                P.Utl.publicChengeModule(h.right, "ajax", "member", "get_html", "get_json", n);
                b = "member"
            } else {
                P.Utl.publicChengeModule(h.right, "ajax", "huiyuan", "get_html", "get_json", n, function () {
                    try {
                        $("#huiyuan").trigger("waterSet", ["add"])
                    } catch (o) {
                    }
                });
                b = "huiyuan"
            }
            $("#account_nav").trigger("openclose");
            $("#" + b).trigger("waterSet", ["add"])
        }
    })
};
P.Mod.superior.prototype.setData = function (d) {
    _this = this;
    _this.level = d.level + "";
    if (d.superior) {
        var c = d.superior, b = parseInt(d.level, 10);
        P.Utl.superior(d, "superior_new", "选择上级");
        document.getElementById("account_name").innerHTML = _this.sup[d.level];
        if (b != 5) {
            document.getElementById("superior_name").innerHTML = _this.sup[b - 1]
        }
    }
};
P.Mod.superior.prototype.create = function (c, g) {
    var h = this;
    var d = document.createElement("optgroup");
    d.setAttribute("label", h.sup[c]);
    for (var b = 0; b < g.length; b++) {
        var f = document.createElement("option");
        f.value = g[b][0];
        f.innerHTML = g[b][1];
        d.appendChild(f)
    }
    return d
};
P.Mod.superior.prototype.unbind = function () {
    document.getElementById("account_name").innerHTML = "";
    document.getElementById("superior_name").innerHTML = "";
    $("#superior_new").html("")
};
P.Mod.tongji_nav = function (d, c) {
    this.dom = d;
    this.cl = "00";
    this.timesold = $("#timesold", d);
    this.resultnum = $("#resultnum", d);
    this.timesnow = $("#num", d);
    var f = this;
    $("li", d).bind("click", function (m) {
        var g = $(this);
        if (!g.hasClass("on")) {
            g.siblings(".on").removeClass("on");
            g.addClass("on")
        }
        var h = g.children("p").attr("id").replace("type_", "");
        f.callBack({cat: h});
        P.Utl.memuMask(".tongji_nav")
    });
    var b = P.Set.systype;
    P.Utl.winSetData(P.Set);
    $("#top" + b).bind("CountDownStop", function (g, h) {
        setTimeout(function () {
            P.Utl.quickAjax(f.dom, f.bindData)
        }, c || 60000)
    });
    this.bindData = function (g) {
        var h = g.betnotice;
        if (h) {
            $("#timesold").html(h.timesold ? h.timesold : "");
            $("#num").html(h.timesnow ? h.timesnow : "");
            if (h.timeclose == h.timeopen && h.timeopen == 0) {
                P.Utl.CountDown("#tmklc", 1);
                P.Utl.CountDown("#topklc", 1)
            } else {
                if (h.timeclose !== undefined) {
                    P.Utl.CountDown("#tmklc", h.timeclose, "#tongji")
                }
                if (h.timeopen !== undefined) {
                    P.Utl.CountDown("#topklc", h.timeopen, "#tongji,#topklc")
                }
            }
        }
        P.Utl.nCLBindData(g);
        if (h && h.status == 0 && g.drawStatus == 1) {
            if (h.timeopen > P.Set.qajaxT) {
                P.Utl.quickAjax(this.dom, this.bindData)
            }
        }
        P.Utl.winSetData(g.win ? g : P.Set)
    }
};
P.Mod.tongji_nav.prototype.setData = function () {
    this.callBack({cat: "00"});
    $("li", this.dom).removeClass("on").first().addClass("on");
    $("body").trigger("cpschanel", ["win", "add", P.Utl.winSetData])
};
P.Mod.tongji_nav.prototype.callBack = function (g) {
    var f = this, b = P.Set.systype, d = "";
    if (b == "klc") {
    } else {
        if (b == "ssc") {
            d = "_sc"
        } else {
            d = "_" + b
        }
    }
    $("#autoRefresh").val($("#timeValue").val());
    f.tongji = $("#tongji" + d).Module();
    if (f.tongji) {
        f.tongji.autoRefresh.hide();
        if (b != "ssc") {
            f.tongji.cat = null
        }
    }
    var c = $("#layout").Module();
    G.RequestQueue = {};
    P.Utl.publicChengeModule(c.main, "ajax", "tongji" + d, "get_html", "get_json", g)
};
P.Mod.tongji_nav.prototype.unbind = function () {
    delete this.tongji;
    $("body").trigger("cpschanel", ["win", "del"]);
    if (this.getResults) {
        this.getResults.hide();
        this.getResults = null
    }
    $("#tmklc,#topklc,#tm,#top,#tmpk10,#toppk10,#tmnc,#topnc,#tmks,#topks").html("")
};
P.Mod.tongji_nav_pk10 = function (b) {
    P.Mod.tongji_nav.call(this, b, 10000);
    this.bindData = function (c) {
        var f = c.betnotice;
        if (f) {
            $("#timesold").html(f.timesold ? f.timesold : "");
            $("#num").html(f.timesnow ? f.timesnow : "");
            if (f.timeclose == f.timeopen && f.timeopen == 0) {
                P.Utl.CountDown("#tmpk10", 1);
                P.Utl.CountDown("#toppk10", 1)
            } else {
                if (f.timeclose !== undefined) {
                    P.Utl.CountDown("#tmpk10", f.timeclose, "#tongji_pk10")
                }
                if (f.timeopen !== undefined) {
                    P.Utl.CountDown("#toppk10", f.timeopen, "#tongji_pk10,#toppk10")
                }
            }
        }
        P.Utl.nCLBindData(c);
        if (f && f.status == 0 && c.drawStatus == 1) {
            if (f.timeopen > P.Set.qajaxT) {
                P.Utl.quickAjax(this.dom, this.bindData)
            }
        }
        P.Utl.winSetData(c.win ? c : P.Set)
    }
};
P.Mod.tongji_nav_pk10.prototype = P.Mod.tongji_nav.prototype;
P.Mod.tongji_nav_nc = function (b) {
    P.Mod.tongji_nav.call(this, b, 10000);
    this.bindData = function (c) {
        var f = c.betnotice;
        if (f) {
            $("#timesold").html(f.timesold ? f.timesold : "");
            $("#num").html(f.timesnow ? f.timesnow : "");
            if (f.timeclose == f.timeopen && f.timeopen == 0) {
                P.Utl.CountDown("#tmnc", 1);
                P.Utl.CountDown("#topnc", 1)
            } else {
                if (f.timeclose !== undefined) {
                    P.Utl.CountDown("#tmnc", f.timeclose, "#tongji_nc")
                }
                if (f.timeopen !== undefined) {
                    P.Utl.CountDown("#topnc", f.timeopen, "#tongji_nc,#topnc")
                }
            }
        }
        P.Utl.nCLBindData(c);
        if (f && f.status == 0 && c.drawStatus == 1) {
            if (f.timeopen > P.Set.qajaxT) {
                P.Utl.quickAjax(this.dom, this.bindData)
            }
        }
        P.Utl.winSetData(c.win ? c : P.Set)
    }
};
P.Mod.tongji_nav_nc.prototype = P.Mod.tongji_nav.prototype;
P.Mod.tongji_parent = function (c) {
    this.dom = c;
    this.cat = "00";
    this.handicap = "A";
    this.oddset = "C";
    this.s = ["恢复", "取消", "恢复"];
    this.s2 = {"0": "取消", "1": "正常"};
    this.timeValue = $("#timeValue");
    var d = this;
    switch (P.Set.systype) {
        case"klc":
            d.category = {"00": "yidan", "01": "ermian", "02": "yidan", "03": "yidan", "05": "lianma"};
            break;
        case"pk10":
            d.category = {"00": "yidan", "01": "ermian", "02": "guanyahezhi"};
            break;
        case"nc":
            d.category = {"00": "yidan", "01": "ermian", "02": "yidan", "03": "yidan", "05": "lianma"};
            break;
        case"ks":
            d.category = {"00": "yidan"};
            break
    }
    var b = function (g) {
        var f = d.getParm();
        f.handicap = $("#handicap").val();
        $.UT.publicGetAction(d.dom[0].id, f, function (h) {
            d.setData(h)
        }, "get_json", g ? function () {
        } : null);
        d.autoRefresh.show(d.timeValue.val())
    };
    this.header = $("#header").Module();
    this.header.dom.bind("resultnum", function (f) {
        if (document.getElementById(d.dom[0].id)) {
            b(true)
        }
    });
    this.buhuo_flag = true;
    c.bind("click", function (h) {
        var f = h.target;
        if (f.getAttribute("name") == "up" || f.getAttribute("name") == "down") {
            var p = {number: 0, playtype: ""};
            p.playtype = f.parentNode.parentNode.getAttribute("game");
            if (d.cat == "05") {
                p.number = "01"
            } else {
                p.number = f.parentNode.parentNode.getAttribute("num")
            }
            p.action = f.getAttribute("name");
            p.cat = d.cat;
            p.odds = $("#odd_step").val();
            p.handicap = $("#handicap").val();
            $.UT.publicGetAction(d.dom[0].id, p, function (r) {
                if (r.supervision) {
                    var q = $(f).siblings(".oddlist");
                    if (P.Set.systype == "pk10") {
                        var t = p.playtype + "|" + p.number;
                        P.Utl.changeColor(q, r.supervision[t][0])
                    } else {
                        P.Utl.changeColor(q, r.supervision[p.playtype + p.number][0])
                    }
                }
            }, "odd_set", function (s, r, q) {
                $.UT.NetErrorCallback(s, r, q)
            })
        }
        if (f.id == "reflash") {
            b()
        }
        if (f.getAttribute("name") == "detail") {
            var p = {number: 0, game: ""}, m = f.innerHTML;
            p.game = f.parentNode.parentNode.getAttribute("game");
            p.number = f.parentNode.parentNode.getAttribute("num");
            p.cat = d.cat;
            d.zdetail(p, m)
        }
        if (f.getAttribute("name") == "buhuo") {
            var p = {};
            p.game = f.parentNode.parentNode.getAttribute("game");
            p.number = f.parentNode.parentNode.getAttribute("num");
            p.num = f.parentNode.parentNode.getAttribute("num");
            var m = f.parentNode.parentNode.getElementsByTagName("a")[0].innerHTML;
            p.cat = d.cat;
            p.money = f.innerHTML;
            if (d.level == "0") {
                d.gbuhuo(p, m)
            } else {
                d.xbuhuo(p, m)
            }
        }
        if (f.type == "radio" && f.nodeName == "INPUT") {
            var n = d.getParm();
            G.RequestQueue = {};
            d.autoRefresh.show(d.timeValue.val());
            P.Utl.memuMask("#game_type");
            $.UT.publicGetAction(d.dom[0].id, n, function (q) {
                d.setData(q)
            })
        }
        if (f.id == "bucang") {
            P.Utl.tongji = "all";
            var g = $("#layout").Module(), o = "";
            if (P.Set.systype != "klc") {
                o = "_" + P.Set.systype
            }
            P.Utl.publicChengeModule(g.main, "ajax", "bucang" + o, "get_html", "get_json", {pager: 1, play: "all"})
        }
    });
    P.Mod.tongji.prototype.common_method.call(this);
    $("#handicap").bind("change", function () {
        var f = d.getParm();
        f.handicap = $("#handicap").val();
        G.RequestQueue = {};
        if (d.timeValue.val() == 0) {
            d.autoRefresh.hide()
        } else {
            d.autoRefresh.show(d.timeValue.val())
        }
        $.UT.publicGetAction(d.dom[0].id, f, function (g) {
            d.autoRefresh.data.handicap = $("#handicap").val();
            d.setData(g)
        })
    });
    $.UT.Pager({dom: ".tongji-title .pager", callBack: function (g) {
        var f = d.getParm(g);
        G.RequestQueue = {};
        if (d.timeValue.val() == 0) {
            d.autoRefresh.hide()
        } else {
            d.autoRefresh.show(d.timeValue.val())
        }
        f.handicap = $("#handicap").val();
        $.UT.publicGetAction(d.dom[0].id, f, function (h) {
            d.autoRefresh.data.handicap = d.handicap;
            d.setData(h)
        })
    }});
    $("#tongji,#tongji_pk10,#tongji_nc,#tongji_ks").bind("CountDownStop", function (h, o) {
        var n = P.Set.drawStatus;
        if (o == "tm" + P.Set.systype) {
            $("#tongji_tb > tbody").addClass("tg")
        }
        if (o == "tm" + P.Set.systype && n != 1) {
            return
        }
        if (o == "top" + P.Set.systype && n == 1) {
            return
        }
        var m = {}, g = d.getParm();
        m.handicap = $("#handicap").val();
        m.cat = d.cat;
        m.game = g.game || "";
        var f = function () {
            $.UT.publicGetAction(d.dom[0].id, m, function (r) {
                var q = r.drawStatus, p = "";
                if (q == n || q == 0) {
                    if (P.Set.systype != "klc") {
                        p = "_" + P.Set.systype
                    }
                    $("#tongji" + p).trigger("CountDownStop", [o])
                } else {
                    d.setData(r)
                }
            }, "get_json", function () {
            })
        };
        setTimeout(f, Math.floor(Math.random() * 3000 + 1000))
    })
};
P.Mod.tongji_parent.prototype = {common_method: function () {
    var c = this, b = {};
    b = {urlId: c.dom[0].id, action: "get_json", callback: function (d) {
        c.setData(d)
    }};
    if (P.Set.systype != "ssc") {
        b.data = c.getParm()
    } else {
        if (b.data) {
            delete b.data
        }
    }
    c.autoRefresh = $("#autoRefresh", c.dom).Widget("AutoRefresh", b);
    c.timeValue.bind("change", function () {
        if (c.timeValue.val() == 0) {
            c.autoRefresh.hide()
        } else {
            c.autoRefresh.show(c.timeValue.val())
        }
    });
    if (P.Set.level !== undefined) {
        c.level = P.Set.level + "";
        c.rules = P.Utl.buhuoRules;
        if (c.level != "0") {
            if (c.timeValue[0].options.length == 9) {
                c.timeValue[0].options[1] = null;
                c.timeValue[0].options[1] = null;
                c.timeValue[0].options[1] = null
            }
            $(".ylch").hide();
            c.rules = P.Utl.buhuoRules;
            delete c.rules.rules.odd;
            delete c.rules.rules.discount;
            delete c.rules.errorMessages.odd;
            delete c.rules.errorMessages.discount;
            $(".tongji-odd", c.dom).remove()
        }
        c.timeValue.val("30")
    }
}, getParm: function (b) {
    var f = this, d = {cat: "", game: []}, c = parseInt($("#game_type :radio:checked").attr("id"), 10);
    d.level = f.level;
    d.cat = f.cat;
    if (f.game[d.cat]) {
        d.game = f.game[d.cat][c]
    }
    if (f.cat === "05") {
        if (b) {
            d.pager = b.pager
        } else {
            d.pager = 1
        }
    }
    return d
}, setData: function (m) {
    var v = "", g = P.Set.systype;
    if (g != "klc") {
        v = "_" + g
    }
    var f = document.getElementById("tongji" + v);
    if (!f) {
        return
    }
    if (!P.Utl.valModule(this)) {
        return
    }
    if (m.drawStatus) {
        P.Set.drawStatus = m.drawStatus
    }
    var n = this, h, q, o, b, p = {}, r = m.betnotice;
    if (r) {
        var s = $("#tongji_nav" + v).Module();
        if (s) {
            s.bindData({betnotice: r, drawStatus: m.drawStatus, changlong: m.changlong});
            s = null
        }
    }
    if (!m.cat) {
        return
    }
    if (m.cat != n.cat) {
        n.cat = m.cat;
        if (n.category[n.cat]) {
            var d = document.getElementById(n.category[n.cat]).value;
            document.getElementById("game_type").innerHTML = d
        } else {
            document.getElementById("game_type").innerHTML = ""
        }
    }
    if (m) {
        if (n.cat == "05") {
            $("#scje,.scjex").hide();
            $(".ylch").hide();
            if (m.pager) {
                $.UT.PagerRender("#current_tj", "#total_tj", m.pager.current, m.pager.total)
            }
            $(".tongji-title .pager").show();
            if (m.pager) {
                p = n.getParm({pager: m.pager.current})
            }
        } else {
            $("#scje,.scjex").show();
            if (n.level == "0") {
                $(".ylch").show()
            }
            $(".tongji-title .pager").hide();
            p = n.getParm()
        }
        if (m.nowtime) {
            p.nowtime = m.nowtime
        }
        p.handicap = $("#handicap").val();
        n.autoRefresh.show(n.timeValue.val(), p);
        h = n.render(m.list || [], n.level, n.cat, m.corps || {});
        if (g == "ks" && n.cat == "00" && m.game == "001") {
            $("#scje", "#tongji_tb").hide();
            $(".scje", "#tongji_tb").show()
        } else {
            if (n.cat != "05") {
                $("#scje", "#tongji_tb").show()
            }
            $(".scje", "#tongji_tb").hide()
        }
        $("#tongji_tb tbody").remove();
        $("#tongji_tb").append(h);
        $.UT.HoverList({container: "#tongji_tb tbody", el: "tr"})
    }
    if (m.total) {
        $("#total").html(m.total[0]);
        $("#sum").html(m.total[1]);
        $("#share").html(m.total[2]);
        $("#comm").html(m.total[3])
    } else {
        $("#total").html(0);
        $("#sum").html(0);
        $("#share").html(0);
        if (0 === parseInt(P.Set.level, 10)) {
            $("#comm").html(0);
            $("#ylch").html(0)
        } else {
            $("#comm").html(0)
        }
    }
    if (m.share) {
        for (var w in m.share) {
            if (m.share[w] !== "") {
                $("#type_" + w).html(m.share[w])
            }
        }
        var c = $("#type_" + m.cat).parent();
        if (!c.hasClass("on")) {
            c.siblings().removeClass("on");
            c.addClass("on")
        }
    }
    $("#handicap").val(m.handicap)
}, corpsOdds: function (c, m) {
    var b = [];
    if (c.length > 0) {
        var g = c.length, d = c[0].length || m, n = "";
        for (var h = 0; h < g; h++) {
            for (var f = 0; f < d; f++) {
                b[f] = b[f] ? b[f] : "";
                b[f] += c[h][f] !== undefined ? "<td>" + c[h][f] + "</td>" : "<td></td>"
            }
        }
    }
    return b
}, render: function (v, c, g, h) {
    var s = "<tbody>", t = "";
    var f = "", m = [], y = "", q = [], d = 0;
    if (P.Set.level == "0") {
        if (h) {
            for (var p in h) {
                if (h.hasOwnProperty(p)) {
                    f += "<th class='corpsExit'>" + p + "</th>";
                    y += "<td class='corpsExit'>&nbsp;</td>";
                    m.push(h[p]);
                    d++
                }
            }
            $("#tongji_tb .corpsExit").remove();
            $("#tongji_tb thead tr").append(f);
            $("#tongji_tb tfoot tr").append(y)
        }
        q = this.corpsOdds(m, v.length)
    }
    if (!v.length) {
        if (P.Set.systype == "ks") {
            s += '<tr><td colspan="' + (13 + d) + '">暂无数据！</td></tr>'
        } else {
            var x = this.cat == "05" ? 11 : 12;
            s += '<tr><td colspan="' + (x + d) + '">暂无数据！</td></tr>'
        }
    } else {
        for (var r = 0; r < v.length; r++) {
            var o = v[r], z = o[2], w = "";
            if (P.Set.level == "0") {
                o[12] = "<span  name='up' class='odd_set up' ></span><span class='oddlist'>" + o[12] + "</span><span  name='down' class='odd_set down' ></span>"
            }
            if (g != "05") {
                if (o[10].toString().indexOf("-") > -1) {
                    t = "reder"
                } else {
                    t = "blue"
                }
                if (P.Set.systype == "ks" && g == "00" && o[0] == "001") {
                    o[10] = "<td class='" + t + "'>" + o[10][0] + "</td><td class='" + t + "'>" + o[10][1] + "</td><td class='" + t + "'>" + o[10][2] + "</td>"
                } else {
                    o[10] = "<td class='" + t + "'>" + o[10] + "</td>"
                }
            } else {
                o[10] = "";
                o[6] = ""
            }
            if (Number(o[11]) < 0) {
                o[11] = "<span class='reder'>" + o[11] + "</span>"
            }
            if (!o[13]) {
                w = "class='tg'"
            }
            o[6] = "";
            var n;
            if (P.Set.level == "0") {
                if (q[r] != undefined) {
                    n = q[r]
                } else {
                    n = ""
                }
            } else {
                n = ""
            }
            s += "<tr game='" + o[0] + "' num='" + o[1] + "' " + w + "><td>" + (r + 1) + "</td><td><a name='detail' href='javascript:void(0)'>" + z + "</a></td><td>" + o[3] + "</td><td>" + o[4] + "</td><td>" + o[5] + "</td>" + o[6] + "<td>" + o[7] + "</td><td>" + o[8] + "</td><td>" + o[9] + "</td>" + o[10] + "<td><a href='javascript:void(0)' name='buhuo' class='buhuo-op'>" + o[11] + "</a></td><td>" + o[12] + "</td>" + n + "</tr>"
        }
    }
    s += "</tbody>";
    return s
}, zdetail: function (h, f) {
    var g = this, b = "";
    var d = $("#num").html(), c = d + "期  注单明细 [" + f + "]";
    if (P.Set.systype == "ssc") {
        c = d + "期  注单明细 [" + f.replace("单码 ", "") + "]"
    }
    if (!g.popLoader) {
        g.popLoader = $.UT.Alert({text: "<table id='supervision_alert_3'><tr class='like-th'><td>注单号</td><td>盘口</td><td>玩法</td><td>会员</td><td>代理</td><td>总代理</td> <td>股东</td> <td>分公司</td> <td>时间</td><td>下注金额</td><td>赔率</td> <td>退水(%)</td> <td>占成收入</td>  <td>补货</td> <td>注单状态</td> </tr></table>", booLean: false, title: c, width: 950, cancelCallback: function () {
            $("#zdetail li").unbind();
            g.popLoader.dom.unbind("click");
            g.popLoader = null;
            delete g.popLoader
        }, openCallback: function () {
            $(".requestData").height(331)
        }})
    }
    $.UT.publicGetAction(g.dom[0].id, h, function (q) {
        if (q.list) {
            b = g.zdetailR(q.list, h)
        }
        if (!q.total) {
            q.total = [0, 0]
        }
        if (g.popLoader || g.popLoader.options.title.indexOf("注单明细") == -1) {
            var p = $("#detailh_ta").val(), n = $("#num").html();
            p = p.replace("ééé", b);
            if (P.Set.systype == "ssc") {
                p = p.replace("é", b)
            }
            p = p.replace("{x1}", q.pager_total[0]);
            p = p.replace("{x2}", q.pager_total[1]);
            p = p.replace("{t1}", q.total[0]);
            p = p.replace("{t2}", q.total[1]);
            $(".requestData", g.popLoader.dom).html(p);
            $.UT.Pager({dom: "#zdetail", callBack: function (r) {
                h.pager = r.pager;
                g.zdetail(h, f)
            }});
            if (g.level == "0") {
                g.popLoader.dom.bind("click", function (t) {
                    var r = t.target;
                    if (r.nodeName == "A") {
                        if (confirm("确定" + r.innerHTML + "注单吗")) {
                            var s = {num: r.id, status: r.getAttribute("status")};
                            $.UT.publicGetAction(g.dom[0].id, s, function (x) {
                                if (x.succ == true) {
                                    var w = parseInt(r.getAttribute("status"), 10);
                                    $("#c" + r.id).html(g.s2[w + ""]);
                                    $(r).html(g.s[w - 1]);
                                    var v = [document.getElementById("x" + r.id).innerHTML, document.getElementById("s" + r.id).innerHTML];
                                    g.updateTotal(r.getAttribute("status"), v);
                                    g.changeDel(r.id, r.getAttribute("status"));
                                    r.setAttribute("status", (3 - w));
                                    $.UT.Alert({text: g.s[w] + "成功", booLean: false})
                                }
                            }, "change_detail")
                        }
                    }
                })
            } else {
                $("thead th:last,.total th:last,.alltotal th:last", g.popLoader.dom).hide()
            }
        } else {
            $("tbody", g.popLoader.dom).remove();
            $("table", g.popLoader.dom).append(b);
            var m = document.getElementsByName("x");
            var o = document.getElementsByName("t");
            $(m[0]).html(q.pager_total[0]);
            $(m[1]).html(q.pager_total[1]);
            $(o[0]).html(q.total[0]);
            $(o[1]).html(q.total[1])
        }
        $.UT.HoverList({container: ".detail tbody", el: "tr"});
        if (q.pager) {
            if (P.Set.systype != "ssc") {
                $.UT.PagerRender("#current_page", "#total_page", q.pager.current, q.pager.total)
            } else {
                $("#current_page").val(q.pager.current);
                $("#total_page").html(q.pager.total)
            }
        }
    }, "detail", null, true, true, {data: "<span>数据加载中，请稍后...</span>", offset: {left: 1000, top: 0}})
}, zdetailR: function (m, r) {
    var h = this, n = "", v = [], g, b, p, d = "", o = [0, 0], f = "";
    v = h.s;
    n = "<tbody>";
    if (m.length) {
        for (var c = 0; c < m.length; c++) {
            var q = "";
            p = m[c];
            p[14] = p[14] + "";
            if (p[14] == "0") {
                q = "class = del"
            }
            n += "<tr><td>" + p[0] + "</td><td>" + p[1] + "盘</td><td>" + p[2] + "</td><td>" + p[3] + "</td><td>" + p[4] + "</td><td>" + p[5] + "</td><td>" + p[6] + "</td><td>" + p[7] + "</td><td>" + p[8] + "</td><td id='x" + p[0] + "' " + q + ">" + p[9] + "</td><td>" + p[10] + "</td><td>" + p[11] + "</td><td id='s" + p[0] + "' " + q + ">" + p[12] + "</td><td>" + p[13] + "</td><td id='c" + p[0] + "'>" + h.s2[p[14] + ""] + "</td>" + d + "</tr>"
        }
    } else {
        n = "<tr><td colspan='15'>暂无数据！</td></tr>"
    }
    n += "</tbody>";
    f = n;
    return f
}, updateTotal: function (g, c) {
    var d = function (m, o) {
        var h = parseInt(m.innerHTML, 10);
        if (!isNaN(h)) {
            $(m).html(h + o)
        }
    }, b = document.getElementsByName("x"), f = document.getElementsByName("t");
    if (g == "1") {
        c[0] = 0 - parseInt(c[0], 10);
        c[1] = 0 - parseInt(c[1], 10)
    }
    if (g == "2") {
        c[0] = parseInt(c[0], 10);
        c[1] = parseInt(c[1], 10)
    }
    d(b[0], c[0]);
    d(b[1], c[1]);
    d(f[0], c[0]);
    d(f[1], c[1])
}, changeDel: function (c, b) {
    if (b == "1") {
        document.getElementById("x" + c).className = "del";
        document.getElementById("s" + c).className = "del"
    }
    if (b == "2") {
        document.getElementById("x" + c).className = "";
        document.getElementById("s" + c).className = ""
    }
}, checkUn: function (b) {
    if (b === undefined || b == "") {
        b = ""
    }
    return b
}, gbuhuo: function (g, c) {
    var m = this;
    var d = document.getElementById("gb").value, p = "后台补货", o = g;
    var n = m.buhuoTitle(g.cat, c), b = {data: "补货中，请不要刷新页面！"};
    if (P.Set.systype != "ssc") {
        if (b.button) {
            delete b.button
        }
    }
    var f = {rules: {water: {regExp: /^0(\.\d{1,2})?$|^[1-9]\d?(\.\d{1,2})?$/}, odds: {regExp: /^(?:0|[1-9]\d{0,3})(\.\d{1,3})?$/}, money: {regExp: /^[1-9]\d{0,8}$/}}, onblur: false, errorMessages: {}};
    f.errorMessages = {water: {regExp: "退水由小于100的数组成，允许输入两位小数！"}, odds: {regExp: "赔率大于等于0，长度为1-4的整数，允许最多带三位小数"}, money: {regExp: "金额由小于10位的正整数组成！"}};
    m.popLoader = $.UT.Alert({text: d, title: p, buttonBL: false, width: 500, validate: f, waidiao: function (h, r) {
        if (m.level == 0) {
            var s = $("#waidiaoradio").attr("checked");
            if (!s) {
                var q = {rules: {money: {regExp: /^[1-9]\d{0,8}$/}}, onblur: false, errorMessages: {money: {regExp: "金额由小于10位的正整数组成！"}}};
                return q
            } else {
                return h
            }
        }
        return h
    }, determineCallback: function () {
        delete o.money;
        var s = $("input:checked", m.popLoader.dom), q, t;
        if (s) {
            q = s[0];
            t = q.parentNode.parentNode;
            if (q.id == "waidiaoradio") {
                o.discount = $("#alert_2_water").val();
                o.odd = $("#alert_2_odds").val();
                o.type = "waidiao";
                o.oddset = $("#pankou").html()
            } else {
                var h = $("select", t).val().split("|");
                o.discount = h[2];
                o.odd = h[3];
                o.type = "corp";
                o.corp_id = h[6];
                o.oddset = h[1];
                o.mem_id = h[4]
            }
        }
        o.sum = $("#alert_2_money").val();
        o.operating = "true";
        o.version_number = m.version_number;
        if (m.buhuo_flag == false) {
            return false
        }
        m.buhuo_flag = false;
        var r = function (x, w, v) {
            $.UT.publicGetAction(x, w, function (y) {
                if (y.success) {
                    m.buhuo_flag = true;
                    $("#reflash").click();
                    $.UT.Alert({text: "提交成功", booLean: false, determineCallback: function () {
                        if (m.popLoader) {
                            m.popLoader.close();
                            m.popLoader = null;
                            delete m.popLoader
                        }
                        $("#reflash", m.dom).click();
                        $("span[name=determine]").focus()
                    }})
                }
            }, "gb", function (z, A, y) {
                m.buhuo_flag = true;
                m.errors(z, A, y);
                if (y == 2) {
                    P.Utl.buhuoTbody(A, "waidaoCor")
                }
                if (y == 0 && m.popLoader) {
                    m.popLoader.close();
                    delete m.popLoader
                }
            }, true, true, v)
        };
        if (o.type == "corp") {
            $.UT.Alert({text: "您选择了【公司间补货】<br/>补货金额:" + o.sum + " 被补货公司:" + h[5] + "<br/>确认提交此次补货?", title: "公司间补货", determineCallback: function () {
                r(m.dom[0].id, o, b)
            }, cancelCallback: function () {
                m.buhuo_flag = true
            }})
        } else {
            r(m.dom[0].id, o, b)
        }
    }, cancelCallback: function () {
        m.popLoader = null;
        delete m.popLoader
    }});
    $("#play_title").html(n + "后台补货");
    $.UT.publicGetAction(m.dom[0].id, g, function (h) {
        P.Utl.buhuoTbody(h, "waidaoCor");
        m.keypress($("#buhuo input"), $("span[name=determine]", m.popLoader.dom));
        m.version_number = h.version_number
    }, "get_buhuo_corp", $.UT.NetErrorCallback)
}, xbuhuo: function (o, g) {
    var n = this;
    var d = document.getElementById("xb").value, c = "下级给上级补货", f = o;
    var m = n.buhuoTitle(o.cat, g);
    var b = {};
    if (P.Set.systype != "ssc") {
        if (n.popLoader) {
            return
        }
    }
    n.popLoader = $.UT.Alert({text: d, title: c, buttonBL: false, width: 500, validate: n.rules, openCallback: function (h) {
        $("div.requestData").delegate("select", "change", function (p) {
            n.xbuhuoRender(n.xbdata, this.value)
        })
    }, determineCallback: function () {
        delete f.money;
        delete f.cat;
        f.odd = document.getElementById("play_odd").innerHTML;
        f.discount = document.getElementById("play_discount").innerHTML;
        f.sum = document.getElementById("play_sum").value;
        f.operating = "true";
        f.version_number = n.version_number;
        f.oddset = $("#play_oddset select").val();
        $.UT.publicGetAction(n.dom[0].id, f, function (h) {
            $("#reflash").click();
            $.UT.Alert({text: "提交成功", booLean: false, determineCallback: function () {
                if (n.popLoader) {
                    n.popLoader.close();
                    n.popLoader = null;
                    delete n.popLoader
                }
                $("#reflash", n.dom).click();
                $("span[name=determine]").focus()
            }})
        }, "xb", function (p, q, h) {
            n.errors(p, q, h);
            if (n.popLoader) {
                n.popLoader.close();
                n.popLoader = null;
                delete n.popLoader
            }
        }, true, true, {data: "补货中，请不要刷新页面！", button: $("span[name=determine]", n.popLoader.dom)})
    }, cancelCallback: function () {
        $(".requestData").undelegate();
        delete n.xbdata;
        n.popLoader = null;
        delete n.popLoader
    }});
    $("#play_title").html(m + "下级给上级补货");
    if (P.Set.systype != "ssc") {
        n.keypress($("#buhuo input"), $("span[name=determine]", n.popLoader.dom))
    } else {
        n.keypress($("#play_sum"), $("span[name=determine]", n.popLoader.dom))
    }
    $.UT.publicGetAction(n.dom[0].id, o, function (h) {
        n.xbuhuoRender(h, "A");
        if (P.Set.systype != "ssc") {
            $("#play_sum").val(h.sum).select()
        } else {
            $("#play_sum").val(h.sum)
        }
        n.version_number = h.version_number;
        n.xbdata = h;
        $("#xbselect").removeAttr("disabled")
    }, "get_buhuo_user", $.UT.NetErrorCallback)
}, xbuhuoRender: function (c, b) {
    $("#play_discount").html(c.discount[b]);
    $("#play_odd").html(c.odd[b])
}, unbind: function () {
    this.handicap = "A";
    delete this.gb;
    delete this.xb;
    $("#tongji_tb tbody").remove();
    this.autoRefresh.hide();
    delete this.popLoader;
    delete this.cat;
    $("#handicap").val("A");
    $("body").attr("CountDown", "");
    $("#autoRefresh").val(1)
}, errors: function (g, d, c, b) {
    var f = this;
    if (c == 2) {
        if (d) {
            if (d.discount) {
                if (P.Set.level == "0") {
                } else {
                    $("#play_discount").html(d.discount);
                    $("#play_odd").html(d.odd);
                    f.xbdata.discount[d.oddset] = d.discount;
                    f.xbdata.odd[d.oddset] = d.odd
                }
            }
            if (d.version_number) {
                f.version_number = d.version_number
            }
        }
    }
    $.UT.NetErrorCallback(g, d, c);
    $("#reflash", f.dom).click()
}, keypress: function (b, c) {
    b.bind("keypress", function (f) {
        var d = f.keyCode;
        if (d == 13) {
            c.click()
        }
    })
}};
P.Mod.tongji = function (b) {
    this.game = {"00": [
        ["000"],
        ["001"],
        ["002"],
        ["003"],
        ["004"],
        ["005"],
        ["006"],
        ["007"]
    ], "01": [
        ["008", "016", "024", "032"],
        ["009", "017", "025", "033"],
        ["010", "018", "026", "034"],
        ["011", "019", "027", "035"],
        ["012", "020", "028", "036"],
        ["013", "021", "029", "037"],
        ["014", "022", "030", "038"],
        ["015", "023", "031", "039"],
        ["040", "041", "042"]
    ], "02": [
        ["043"],
        ["044"],
        ["045"],
        ["046"],
        ["047"],
        ["048"],
        ["049"],
        ["050"]
    ], "03": [
        ["051"],
        ["052"],
        ["053"],
        ["054"],
        ["055"],
        ["056"],
        ["057"],
        ["058"]
    ], "04": [
        ["059"],
        ["060"]
    ], "05": [
        ["061"],
        ["062"],
        ["063"],
        ["064"],
        ["065"],
        ["066"],
        ["067"],
        ["068"]
    ]};
    this.buhuoTitle = function (c, d) {
        var f = "";
        switch (c) {
            case"00":
                f = "单码&nbsp;&nbsp;" + d;
                break;
            case"01":
                f = "两面&nbsp;&nbsp;&nbsp;&nbsp;" + d;
                break;
            case"02":
                f = "中发白&nbsp;&nbsp;" + d;
                break;
            case"03":
                f = "方位&nbsp;&nbsp;" + d;
                break;
            case"04":
                f = "龙虎&nbsp;&nbsp;" + d;
                break;
            case"05":
                f = "连码&nbsp;&nbsp;" + d;
                break;
            case"29":
                f = d;
                break
        }
        return"<span class='reder'>[</span>" + f + "<span class='reder'>]</span>&nbsp;&nbsp;"
    };
    P.Mod.tongji_parent.call(this, b)
};
P.Mod.tongji.prototype = P.Mod.tongji_parent.prototype;
P.Mod.tongji_sc = function (c) {
    this.dom = c;
    this.cat = "00";
    this.game = "000";
    this.oddset = "C";
    this.s = ["恢复", "取消", "恢复"];
    this.s2 = {"0": "取消", "1": "正常"};
    this.timeValue = $("#timeValue");
    var d = this;
    d.cats = {"00": d.yidan, "01": d.ermian, "02": d.longhuhe};
    var b = function (g) {
        var f = {};
        f.cat = d.cat;
        if (d.game) {
            f.game = d.game
        }
        f.handicap = $("#handicap").val();
        $.UT.publicGetAction(d.dom[0].id, f, function (h) {
            d.setData(h)
        }, "get_json", g ? function () {
        } : null);
        d.autoRefresh.show(d.timeValue.val())
    };
    this.header = $("#header").data("Module");
    this.header.dom.bind("resultnum", function (f) {
        if (document.getElementById(d.dom[0].id)) {
            b(true)
        }
    });
    $(c).bind("click", function (h) {
        var f = h.target;
        if (f.getAttribute("name") == "up" || f.getAttribute("name") == "down") {
            var o = {number: 0};
            if (d.game) {
                o.playtype = d.game;
                o.number = f.parentNode.parentNode.id.slice(-1)
            } else {
                o.playtype = f.parentNode.parentNode.id.slice(0, 3)
            }
            o.action = f.getAttribute("name");
            o.odds = $("#odd_step").val();
            o.handicap = $("#handicap").val();
            $.UT.publicGetAction(d.dom[0].id, o, function (q) {
                if (q.supervision) {
                    var p = $(f).siblings(".oddlist");
                    P.Utl.changeColor(p, q.supervision[o.playtype + o.number][0])
                }
            }, "odd_set", function (r, q, p) {
                $.UT.NetErrorCallback(r, q, p)
            })
        }
        if (f.id == "reflash") {
            b()
        }
        if (f.getAttribute("name") == "detail") {
            var o = {}, m = f.innerHTML;
            if (d.game) {
                o.game = d.game;
                o.num = f.parentNode.parentNode.id.slice(-1)
            } else {
                o.game = f.parentNode.parentNode.id.slice(0, 3)
            }
            o.cat = d.cat;
            d.zdetail(o, m)
        }
        if (f.getAttribute("name") == "buhuo") {
            var o = {};
            if (d.game) {
                o.game = d.game
            } else {
                o.game = f.parentNode.parentNode.id.slice(0, 3)
            }
            if (f.parentNode.parentNode.id.length == 4) {
                o.num = f.parentNode.parentNode.id.slice(-1)
            } else {
                o.num = "0"
            }
            var m = f.parentNode.parentNode.getElementsByTagName("a")[0].innerHTML;
            o.cat = d.cat;
            o.money = f.innerHTML;
            if (d.level == "0") {
                d.gbuhuo(o, m)
            } else {
                d.xbuhuo(o, m)
            }
        }
        if (f.type == "radio" && f.nodeName == "INPUT") {
            d.game = f.id;
            var n = {cat: d.cat, game: d.game};
            G.RequestQueue = {};
            d.autoRefresh.show(d.timeValue.val());
            P.Utl.memuMask("#game_type");
            $.UT.publicGetAction(d.dom[0].id, n, function (p) {
                d.setData(p)
            })
        }
        if (f.id == "bucang") {
            P.Utl.tongji = "all";
            var g = $("#layout").Module();
            P.Utl.publicChengeModule(g.main, "ajax", "bucang_sc", "get_html", "get_json", {pager: 1, play: "all"})
        }
    });
    P.Mod.tongji.prototype.common_method.call(this);
    $("#handicap").bind("change", function () {
        var f = {};
        f.handicap = $("#handicap").val();
        f.cat = d.cat;
        f.game = d.game || "";
        G.RequestQueue = {};
        if (d.timeValue.val() == 0) {
            d.autoRefresh.hide()
        } else {
            d.autoRefresh.show(d.timeValue.val())
        }
        $.UT.publicGetAction(d.dom[0].id, f, function (g) {
            d.autoRefresh.data.handicap = $("#handicap").val();
            d.setData(g)
        })
    });
    $("#tongji_sc").bind("CountDownStop", function (g, n) {
        var m = P.Set.drawStatus;
        if (n == "tm" && m != 1) {
            return
        }
        if (n == "top" && m == 1) {
            return
        }
        $("#tongji_tb > tbody").addClass("tg");
        var h = {};
        h.handicap = $("#handicap").val();
        h.cat = d.cat;
        h.game = d.game || "";
        var f = function () {
            $.UT.publicGetAction(d.dom[0].id, h, function (p) {
                var o = p.drawStatus;
                if (o == m || o == 0) {
                    $("#tongji_sc").trigger("CountDownStop", [n])
                } else {
                    d.setData(p)
                }
            }, "get_json", function () {
            })
        };
        setTimeout(f, Math.floor(Math.random() * 3000 + 1000))
    })
};
P.Mod.tongji_sc.prototype.setData = function (o) {
    var d = document.getElementById("tongji_sc");
    if (!d) {
        return
    }
    if (!P.Utl.valModule(this)) {
        return
    }
    if (o.drawStatus) {
        P.Set.drawStatus = o.drawStatus
    }
    var p = this, h, s, r, b, v = {};
    navData = o.betnotice;
    if (navData) {
        var x = $("#tongji_nav_sc").Module();
        if (x) {
            x.bindData({betnotice: navData, drawStatus: o.drawStatus, changlong: o.changlong});
            x = null
        }
    }
    if (o.cat !== undefined) {
        p.cat = o.cat;
        if (p.cat == "00" || p.cat == "01") {
            var n = document.getElementsByName("game");
            $("#game_type").show();
            if (p.cat == "00" && n.length) {
                $("#game_type label:last").hide();
                b = ["000", "001", "002", "003", "004"];
                for (var m = 0; m < b.length; m++) {
                    n[m].setAttribute("id", b[m]);
                    $(n[m]).closest("label").attr("for", b[m])
                }
            }
            if (p.cat == "01" && n.length) {
                $("#game_type label:last").show();
                b = ["005", "006", "007", "008", "009", "010"];
                for (var m = 0; m < b.length; m++) {
                    n[m].setAttribute("id", b[m]);
                    $(n[m]).closest("label").attr("for", b[m])
                }
            }
            $("#game_type").show();
            if (o.game) {
                p.game = o.game;
                $("#" + p.game).attr("checked", "checked")
            }
            if (o.bucang_num >= 0) {
                $("#bucang_num").html("(" + o.bucang_num + ")")
            }
        } else {
            delete p.game;
            $("#game_type").hide();
            $("#bucang_num").html("")
        }
    }
    if (o) {
        if (typeof p.cats[p.cat] == "function") {
            s = p.cats[p.cat]
        } else {
            s = p.other;
            s = p.other
        }
        h = p.render(o.list || [], p.game, s, p.level, o.corps || {});
        $("#tongji_tb tbody").remove();
        $("#tongji_tb").append(h);
        $.UT.HoverList({container: "#tongji_tb tbody", el: "tr"})
    }
    var q = 0, f = 0, g = 0, w = 0;
    if (o.total) {
        q = o.total[0];
        f = o.total[1];
        g = o.total[2];
        w = o.total[3]
    }
    $("#total").html(q);
    $("#sum").html(f);
    $("#share").html(g);
    $("#comm").html(w);
    if (o.share) {
        for (var y in o.share) {
            if (o.share[y] !== "") {
                $("#type_" + y).html(o.share[y])
            }
        }
        var c = $("#type_" + o.cat).parent();
        if (!c.hasClass("on")) {
            c.siblings().removeClass("on");
            c.addClass("on")
        }
    }
    if (p.game) {
        v.game = p.game
    }
    v.cat = p.cat;
    v.handicap = $("#handicap").val();
    p.autoRefresh.show(p.timeValue.val(), v);
    $("#handicap").val(o.handicap)
};
P.Mod.tongji_sc.prototype.corpsOdds = function (c, m) {
    var b = [];
    if (c.length > 0) {
        var g = c.length, d = c[0].length || m, n = "";
        for (var h = 0; h < g; h++) {
            for (var f = 0; f < d; f++) {
                b[f] = b[f] ? b[f] : "";
                b[f] += c[h][f] !== undefined ? "<td>" + c[h][f] + "</td>" : "<td></td>"
            }
        }
    }
    return b
};
P.Mod.tongji_sc.prototype.render = function (B, z, A, c, n) {
    var y = "<tbody>", q = z;
    var m = "", o = [], D = "", v = [], d = 0;
    if (P.Set.level == "0") {
        if (n) {
            for (var s in n) {
                if (n.hasOwnProperty(s)) {
                    m += "<th class='corpsExit'>" + s + "</th>";
                    D += "<td class='corpsExit'></td>";
                    o.push(n[s]);
                    d++
                }
            }
            $("#tongji_tb .corpsExit").remove();
            $("#tongji_tb thead tr").append(m);
            $("#tongji_tb tfoot tr").append(D)
        }
        v = this.corpsOdds(o, B.length)
    }
    if (!B.length) {
        y += '<tr><td colspan="' + (12 + d) + '">没有任何数据！</td></tr>'
    } else {
        for (var w = 0; w < B.length; w++) {
            var r = B[w], h = parseInt(r[0].slice(-2), 10), E = A(h, q), C = "", x = "";
            var p;
            if (P.Set.level == "0") {
                if (v[w] != undefined) {
                    p = v[w]
                } else {
                    p = ""
                }
            } else {
                p = ""
            }
            if (P.Set.level == "0") {
                if (r[9] < 0) {
                    r[9] = "<span class='reder'>" + r[9] + "</span>"
                }
                if (r[8].toString().indexOf("-") > -1) {
                    x = "reder"
                } else {
                    x = "green"
                }
                r[10] = "<span  name='up' class='odd_set up' ></span><span class='oddlist'>" + r[10] + "</span><span  name='down' class='odd_set down' ></span>";
                if (!r[11]) {
                    C = "class='tg'"
                }
                r[4] = "";
                y += "<tr id='" + r[0] + "' " + C + "><td>" + (w + 1) + "</td><td><a name='detail' href='javascript:void(0)'>" + E + "</a></td><td>" + r[1] + "</td><td>" + r[2] + "</td><td>" + r[3] + "</td>" + r[4] + "<td>" + r[5] + "</td><td>" + r[6] + "</td><td>" + r[7] + "</td><td class='" + x + "'>" + r[8] + "</td><td><a href='javascript:void(0)' name='buhuo' class='buhuo-op'>" + r[9] + "</a></td><td>" + r[10] + "</td>" + p + "</tr>"
            } else {
                if (r[8] < 0) {
                    r[8] = "<span class='reder'>" + r[8] + "</span>"
                }
                if (c == "0") {
                    r[9] = "<input type='button' name='down' class='odd_set' value='-' /><span class='oddlist'>" + r[9] + "</span><input type='button' name='up' class='odd_set' value='+' />"
                } else {
                    r[9] = "<span class='oddlist'>" + r[9] + "</span>"
                }
                if (!r[10]) {
                    C = "class='tg'"
                }
                y += "<tr id='" + r[0] + "' " + C + "><td>" + (w + 1) + "</td><td><a name='detail' href='javascript:void(0)'>" + E + "</a></td><td>" + r[1] + "</td><td>" + r[2] + "</td><td>" + r[3] + "</td><td>" + r[4] + "</td><td>" + r[5] + "</td><td>" + r[6] + "</td><td>" + r[7] + "</td><td><a href='javascript:void(0)' name='buhuo' class='buhuo-op'>" + r[8] + "</a></td><td>" + r[9] + "</td></tr>"
            }
        }
    }
    y += "</tbody>";
    return y
};
P.Mod.tongji_sc.prototype.yidan = function (b, c) {
    if (b > 9) {
        b = (b + "").slice(-1)
    }
    var d = {"000": "第一球 " + b, "001": "第二球 " + b, "002": "第三球 " + b, "003": "第四球 " + b, "004": "第五球 " + b}[c];
    return d
};
P.Mod.tongji_sc.prototype.ermian = function (b, d) {
    var f = "", c = "";
    b = parseInt((b + "").slice(-1), 10);
    if (d == "010") {
        f = ["总和 单", "总和 双", "总和 大", "总和 小"][b]
    } else {
        d = parseInt(d, 10) - 5;
        c = "第" + ["一", "二", "三", "四", "五"][d] + "球 ";
        f = c + ["单", "双", "大", "小"][b]
    }
    return f
};
P.Mod.tongji_sc.prototype.longhuhe = function (b) {
    return["龙", "虎", "和"][b - 11]
};
P.Mod.tongji_sc.prototype.other = function (c, b) {
    c = parseInt(c, 10);
    if (b) {
        b = {"03": "前三", "04": "中三", "05": "后三"}[b]
    } else {
        b = ""
    }
    if (13 < c && c < 17) {
        return"豹子 " + b
    }
    if (16 < c && c < 20) {
        return"顺子 " + b
    }
    if (19 < c && c < 23) {
        return"对子 " + b
    }
    if (22 < c && c < 26) {
        return"半顺 " + b
    }
    if (25 < c && c < 29) {
        return"杂六 " + b
    }
};
P.Mod.tongji_sc.prototype.zdetail = function (c, b) {
    P.Mod.tongji_parent.prototype.zdetail.call(this, c, b)
};
P.Mod.tongji_sc.prototype.zdetailR = function (c, b) {
    return P.Mod.tongji_parent.prototype.zdetailR.call(this, c, b)
};
P.Mod.tongji_sc.prototype.updateTotal = function (c, b) {
    P.Mod.tongji_parent.prototype.updateTotal.call(this, c, b)
};
P.Mod.tongji_sc.prototype.changeDel = function (c, b) {
    P.Mod.tongji_parent.prototype.changeDel.call(this, c, b)
};
P.Mod.tongji_sc.prototype.checkUn = function (b) {
    P.Mod.tongji_parent.prototype.checkUn.call(this, b)
};
P.Mod.tongji_sc.prototype.gbuhuo = function (c, b) {
    P.Mod.tongji_parent.prototype.gbuhuo.call(this, c, b)
};
P.Mod.tongji_sc.prototype.xbuhuo = function (c, b) {
    P.Mod.tongji_parent.prototype.xbuhuo.call(this, c, b)
};
P.Mod.tongji_sc.prototype.xbuhuoRender = function (c, b) {
    P.Mod.tongji_parent.prototype.xbuhuoRender.call(this, c, b)
};
P.Mod.tongji_sc.prototype.unbind = function () {
    delete this.game;
    delete this.gb;
    delete this.xb;
    $("#tongji_tb tbody").remove();
    this.autoRefresh.hide();
    delete this.popLoader;
    $("#handicap").val("A");
    $("#autoRefresh").val(1)
};
P.Mod.tongji_sc.prototype.errors = function (d, c, b) {
    P.Mod.tongji_parent.prototype.errors.call(this, d, c, b)
};
P.Mod.tongji_sc.prototype.keypress = function (b, c) {
    P.Mod.tongji_parent.prototype.keypress.call(this, b, c)
};
P.Mod.tongji_sc.prototype.buhuoTitle = function (b, c) {
    var d = "";
    switch (b) {
        case"00":
            d = "单码&nbsp;&nbsp;" + c;
            break;
        case"01":
            d = "两面&nbsp;&nbsp;&nbsp;&nbsp;" + c;
            break;
        case"02":
            d = "龙虎&nbsp;&nbsp;" + c;
            break;
        case"03":
            d = "前三&nbsp;&nbsp;" + c;
            break;
        case"04":
            d = "中三&nbsp;&nbsp;" + c;
            break;
        case"05":
            d = "后三&nbsp;&nbsp;" + c;
            break
    }
    return"<span class='reder'>[</span>" + d + "<span class='reder'>]</span>&nbsp;&nbsp;"
};
P.Mod.tongji_pk10 = function (b) {
    this.game = {"00": [
        ["000"],
        ["001"],
        ["002"],
        ["003"],
        ["004"],
        ["005"],
        ["006"],
        ["007"],
        ["008"],
        ["009"]
    ], "01": [
        ["035", "036"],
        ["010", "020", "030"],
        ["011", "021", "031"],
        ["012", "022", "032"],
        ["013", "023", "033"],
        ["014", "024", "034"],
        ["015", "025"],
        ["016", "026"],
        ["017", "027"],
        ["018", "028"],
        ["019", "029"]
    ], "02": [
        ["043"],
        ["044"],
        ["045"],
        ["046"],
        ["047"],
        ["048"],
        ["049"],
        ["050"]
    ], "03": [
        ["051"],
        ["052"],
        ["053"],
        ["054"],
        ["055"],
        ["056"],
        ["057"],
        ["058"]
    ], "04": [
        ["059"],
        ["060"]
    ], "05": [
        ["061"],
        ["062"],
        ["063"],
        ["064"],
        ["065"],
        ["066"],
        ["067"],
        ["068"]
    ]};
    this.buhuoTitle = function (c, d) {
        var f = "";
        switch (c) {
            case"00":
                f = "单码&nbsp;&nbsp;" + d;
                break;
            case"01":
                f = "两面&nbsp;&nbsp;&nbsp;&nbsp;" + d;
                break;
            case"02":
                f = "冠亚和值&nbsp;&nbsp;" + d;
                break
        }
        return"<span class='reder'>[</span>" + f + "<span class='reder'>]</span>&nbsp;&nbsp;"
    };
    P.Mod.tongji_parent.call(this, b)
};
P.Mod.tongji_pk10.prototype = P.Mod.tongji_parent.prototype;
P.Mod.tongji_nc = function (b) {
    this.game = {"00": [
        ["000"],
        ["001"],
        ["002"],
        ["003"],
        ["004"],
        ["005"],
        ["006"],
        ["007"]
    ], "01": [
        ["008", "016", "024", "032"],
        ["009", "017", "025", "033"],
        ["010", "018", "026", "034"],
        ["011", "019", "027", "035"],
        ["012", "020", "028", "036"],
        ["013", "021", "029", "037"],
        ["014", "022", "030", "038"],
        ["015", "023", "031", "039"],
        ["040", "041", "042"]
    ], "02": [
        ["043"],
        ["044"],
        ["045"],
        ["046"],
        ["047"],
        ["048"],
        ["049"],
        ["050"]
    ], "03": [
        ["051"],
        ["052"],
        ["053"],
        ["054"],
        ["055"],
        ["056"],
        ["057"],
        ["058"]
    ], "04": [
        ["059"]
    ], "05": [
        ["060"],
        ["061"],
        ["062"],
        ["063"],
        ["064"],
        ["065"],
        ["066"],
        ["067"],
        ["068"],
        ["069"],
        ["074"],
    ]};
    this.buhuoTitle = function (c, d) {
        var f = "";
        switch (c) {
            case"00":
                f = "单码&nbsp;&nbsp;" + d;
                break;
            case"01":
                f = "两面&nbsp;&nbsp;&nbsp;&nbsp;" + d;
                break;
            case"02":
                f = "中发白&nbsp;&nbsp;" + d;
                break;
            case"03":
                f = "东南西北&nbsp;&nbsp;" + d;
                break;
            case"04":
                f = "龙虎&nbsp;&nbsp;" + d;
                break;
            case"05":
                f = "连码&nbsp;&nbsp;" + d;
                break;
            case"29":
                f = d;
                break
        }
        return"<span class='reder'>[</span>" + f + "<span class='reder'>]</span>&nbsp;&nbsp;"
    };
    P.Mod.tongji_parent.call(this, b)
};
P.Mod.tongji_nc.prototype = P.Mod.tongji_parent.prototype;
P.Mod.tongji_ks = function (b) {
    this.game = {"00": [
        ["000"],
        ["001"]
    ], "01": [
        ["002"],
        ["003"]
    ], "02": [
        ["004"]
    ], "03": [
        ["005"]
    ], "04": [
        ["006"]
    ]};
    this.buhuoTitle = function (c, d) {
        var f = "";
        switch (c) {
            case"00":
                f = "三军-大小&nbsp;&nbsp;" + d;
                break;
            case"01":
                f = "围骰-全骰&nbsp;&nbsp;&nbsp;&nbsp;" + d;
                break;
            case"02":
                f = "点数&nbsp;&nbsp;" + d;
                break;
            case"03":
                f = "长牌&nbsp;&nbsp;" + d;
                break;
            case"04":
                f = "短牌&nbsp;&nbsp;" + d;
                break
        }
        return"<span class='reder'>[</span>" + f + "<span class='reder'>]</span>&nbsp;&nbsp;"
    };
    P.Mod.tongji_parent.call(this, b)
};
P.Mod.tongji_ks.prototype = P.Mod.tongji_parent.prototype;
P.Mod.bucang = function (b) {
    this.dom = b;
    this.s = ["恢复", "取消"];
    this.s2 = {"0": "取消", "1": "正常", "2": "正常"};
    this.s3 = ["reset", "cancel", "show_view", "modify"];
    this.select = $("#play");
    var c = this;
    $(b).bind("click change", function (h) {
        var d = h.target, f;
        if (h.type == "change" && d.id == "play") {
            c.callBack()
        }
        if (d.nodeName == "A" && h.type == "click") {
            if (c.level == "0") {
                if (d.getAttribute("status") !== null) {
                    f = "确定" + d.innerHTML + "注单吗";
                    $.UT.Alert({text: f, determineCallback: function () {
                        var m = {id: d.id, op: c.s3[d.getAttribute("status")]};
                        $.UT.publicGetAction(c.dom[0].id, m, null, "change_status", function (p, q, o) {
                            var n = parseInt(d.getAttribute("status"), 10);
                            if (o == 2) {
                                n = (n == 0) ? 1 : 0;
                                d.setAttribute("status", n);
                                document.getElementById("c" + d.id).innerHTML = c.s2[n];
                                if (n == 1) {
                                    $("a[update=" + d.id + "]").show()
                                } else {
                                    $("a[update=" + d.id + "]").hide()
                                }
                                d.innerHTML = c.s[n]
                            }
                            $.UT.NetErrorCallback(p, q, o)
                        }, "", $.UT.NetErrorCallback)
                    }})
                }
                if (d.getAttribute("update")) {
                    f = "修改" + d.getAttribute("update") + "注单";
                    c.pop = $.UT.Alert({title: f, text: $("#update").val(), buttonBL: false, width: 500, validate: P.Utl.buhuoRules, determineCallback: function () {
                        var n = P.Utl.isChangeForm("#buhuo");
                        if (!n) {
                            $.UT.Alert({text: "请做修改后，再保存", booLean: false});
                            return
                        }
                        var m = {id: d.getAttribute("update"), op: c.s3[3]};
                        if (c.sop) {
                            var m = c.sop;
                            m.op = c.s3[3];
                            var o = c.pop.dom;
                            m.discount = $("#play_discount", o).val();
                            m.odds = $("#play_odd", o).val();
                            m.amount = $("#play_sum", o).val();
                            $.UT.publicGetAction(c.dom[0].id, m, null, "change_status", function (q, r, p) {
                                if (p == 2) {
                                    $.UT.publicGetAction(c.dom[0].id, null, function (s) {
                                        $("#play", c.dom).val("all");
                                        c.setData(s)
                                    }, "", $.UT.NetErrorCallback);
                                    c.pop.close()
                                }
                                $.UT.NetErrorCallback(q, r, p)
                            }, "", $.UT.NetErrorCallback)
                        }
                    }});
                    var g = {id: d.getAttribute("update"), op: c.s3[2]};
                    $.UT.publicGetAction(c.dom[0].id, g, function (o) {
                        c.sop = o;
                        var m = c.pop.dom, n = P.Set.playBall[o.number];
                        if (P.Set.systype == "pk10") {
                            n = P.Set.gametype_pk10[o.game_id + o.number]
                        } else {
                            if (P.Set.systype == "nc") {
                                n = P.Set.playBall_nc[o.number]
                            } else {
                                if (P.Set.systype == "ks") {
                                    n = P.Utl.number_ks(o.game_id, o.number)[2]
                                }
                            }
                        }
                        $("#bID", m).html(d.getAttribute("update"));
                        if (!n) {
                            if (P.Set.systype == "pk10") {
                                n = P.Set.Playtype_pk10[o.game_id] + o.number
                            } else {
                                if (P.Set.systype == "klc") {
                                    n = o.number
                                } else {
                                    if (P.Set.systype == "ks") {
                                        n = P.Utl.number_ks(o.game_id, o.number)[2]
                                    } else {
                                        n = P.Set.playType_nc[o.game_id] + o.number
                                    }
                                }
                            }
                        }
                        if (P.Set.systype == "pk10") {
                            $("#play_type", m).html(n)
                        } else {
                            if (P.Set.systype == "klc") {
                                $("#play_type", m).html(P.Set.playType[o.game_id] + n)
                            } else {
                                $("#play_type", m).html(n)
                            }
                        }
                        $("#play_oddset", m).html(o.play_oddset);
                        $("#play_discount", m).val(o.discount).attr("defaultValue", o.discount);
                        $("#play_odd", m).val(o.odds).attr("defaultValue", o.odds);
                        $("#play_sum", m).val(o.amount).attr("defaultValue", o.amount).select();
                        c.keypress($("#buhuo input"), $("span[name=determine]"))
                    }, "change_status", $.UT.NetErrorCallback)
                }
            }
        }
    })
};
P.Mod.bucang.prototype = {keypress: function (b, c) {
    b.bind("keypress", function (d) {
        d.keyCode == 13 && c.click()
    })
}, setData: function (g) {
    var n = this, d = "", f, c = document.createElement("tbody"), m = "13", b = "";
    n.login();
    if (P.Set.systype != "klc") {
        b = P.Set.systype
    }
    $("#tongji_nav" + b + " .on").removeClass();
    n.level = g.level + "";
    if (n.level != "0") {
        if (!$("[name=g]", n.dom).hasClass("hidden")) {
            $("[name=g]", n.dom).addClass("hidden")
        }
        m = "9"
    }
    if (g.pager) {
        document.getElementById("current_page").value = g.pager.current;
        document.getElementById("total_page").innerHTML = g.pager.total
    }
    if (g.list) {
        d = n.render(g.list);
        $.UT.HoverList({container: "#date_tb", el: "tr"});
        if (!$("#pager").attr("f")) {
            $.UT.Pager({dom: "#pager", callBack: function (h) {
                n.callBack(h)
            }});
            $("#pager").attr("f", "f")
        }
    } else {
        d = "<tbody ><tr><td colspan='" + m + "'>暂无数据！</td></tr></tbody>"
    }
    $("tbody", n.dom).remove();
    $("table", n.dom).append(d);
    $.UT.HoverList({container: "#date_tb tbody", el: "tr"})
}, callBack: function (d) {
    var c = this, b = {};
    d === undefined ? b.pager = 1 : b = d;
    P.Set.systype == "ssc" ? b.play = $("#play").val() : b.cat = $("#play").val();
    $.UT.publicGetAction(c.dom[0].id, b, function (f) {
        c.setData(f)
    })
}, render: function (m) {
    var h = this, n = "<tbody>", d, o, c = "", b, g = "", f = "";
    for (d = 0; d < m.length; d++) {
        o = m[d];
        b = o.length - 1;
        o[1] = parseInt(o[1], 10);
        if (h.level == "0") {
            if (o[1] == 3) {
                g = "class='gray' ";
                f = "class='gray' "
            } else {
                g = 'status="' + o[11] + '" ';
                f = 'update="' + o[0] + '" '
            }
            o[1] = ["手动外调补货", "公司间手动补货", "后台间自动补货", "预留吃货"][o[1]];
            if (o[11] == "0") {
                c = "<td><a href='javascript:void(0)' id='" + o[0] + "' " + g + ">" + h.s[o[11]] + "</a> <a href='javascript:void(0)' " + f + " style='display:none' >修改</a></td>"
            } else {
                if (o[11] == "1") {
                    c = "<td><a href='javascript:void(0)' id='" + o[0] + "' " + g + ">" + h.s[o[11]] + "</a> <a href='javascript:void(0)' " + f + " >修改</a></td>"
                } else {
                    if (o[11] == "2") {
                        c = "<td>-</td>"
                    }
                }
            }
        } else {
            o[1] = ["上下级手动补货", "", "上下级自动补货"][o[1]]
        }
        o[o.length - 1] = "<td id='c" + o[0] + "'>" + h.s2[o[o.length - 1] + ""] + "</td>";
        n += "<tr>";
        for (var p = 0; p < b; p++) {
            n += "<td>" + o[p] + "</td>"
        }
        n += o[o.length - 1];
        n += c;
        n += "</tr>"
    }
    n += "</tbody>";
    try {
        return n
    } finally {
        n = null
    }
}, unbind: function () {
    delete this.level;
    delete this.pop;
    $("#pager").removeAttr("f")
}, login: function () {
    if (P.Utl.tongji) {
        if (P.Utl.tongji == "all") {
            document.getElementById("play").options[0].selected = true;
            P.Utl.tongji = null
        }
    }
}};
P.Mod.bucang_sc = function (b) {
    this.dom = b;
    this.s = ["恢复", "取消"];
    this.s2 = {"0": "取消", "1": "正常", "2": "正常"};
    this.s3 = ["reset", "cancel", "show_view", "modify"];
    this.select = $("#play");
    var c = this;
    c.cats = {"00": c.yidan, "01": c.ermian, "02": c.longhu, "03": c.he, "04": "豹子 ", "05": "顺子 ", "06": "对子 ", "07": "半顺 ", "08": "杂六 "};
    $(b).bind("click change", function (h) {
        var d = h.target, f;
        if (h.type == "change" && d.id == "play") {
            c.callBack()
        }
        if (d.nodeName == "A" && h.type == "click") {
            if (c.level == "0") {
                if (d.getAttribute("status") !== null) {
                    f = "确定" + d.innerHTML + "注单吗";
                    $.UT.Alert({text: f, determineCallback: function () {
                        var m = {id: d.id, op: c.s3[d.getAttribute("status")]};
                        $.UT.publicGetAction(c.dom[0].id, m, null, "change_status", function (p, q, o) {
                            var n = parseInt(d.getAttribute("status"), 10);
                            if (o == 2) {
                                n = (n == 0) ? 1 : 0;
                                d.setAttribute("status", n);
                                document.getElementById("c" + d.id).innerHTML = c.s2[n];
                                if (n == 1) {
                                    $("a[update=" + d.id + "]").show()
                                } else {
                                    $("a[update=" + d.id + "]").hide()
                                }
                                d.innerHTML = c.s[n]
                            }
                            $.UT.NetErrorCallback(p, q, o)
                        }, "", $.UT.NetErrorCallback)
                    }})
                }
                if (d.getAttribute("update")) {
                    f = "修改" + d.getAttribute("update") + "注单";
                    c.pop = $.UT.Alert({title: f, text: $("#update").val(), buttonBL: false, width: 500, validate: P.Utl.buhuoRules, determineCallback: function () {
                        var m = {id: d.getAttribute("update"), op: c.s3[3]};
                        if (c.sop) {
                            var m = c.sop;
                            m.op = c.s3[3];
                            var n = c.pop.dom;
                            m.discount = $("#play_discount", n).val();
                            m.odds = $("#play_odd", n).val();
                            m.amount = $("#play_sum", n).val();
                            $.UT.publicGetAction(c.dom[0].id, m, null, "change_status", function (p, q, o) {
                                if (o == 2) {
                                    $.UT.publicGetAction(c.dom[0].id, null, function (r) {
                                        c.setData(r)
                                    }, "", $.UT.NetErrorCallback);
                                    c.pop.close()
                                }
                                $.UT.DefaultErrorCallback(p, q, o)
                            }, "", $.UT.NetErrorCallback)
                        }
                    }});
                    var g = {id: d.getAttribute("update"), op: c.s3[2]};
                    c.keypress($("#buhuo input"), $("span[name=determine]"));
                    $.UT.publicGetAction(c.dom[0].id, g, function (p) {
                        c.sop = p;
                        var n = c.pop.dom, m = parseInt(p.game_id, 10), o = parseInt(p.number, 10);
                        if (4 < m && m < 11) {
                            o = ["单", "双", "大", "小"][o]
                        }
                        if (10 < m) {
                            o = ""
                        }
                        $("#bID", n).html(d.getAttribute("update"));
                        $("#play_type", n).html(P.Set.playType_sc[p.game_id] + o);
                        $("#play_oddset", n).html(p.play_oddset);
                        $("#play_discount", n).val(p.discount).select();
                        $("#play_odd", n).val(p.odds);
                        $("#play_sum", n).val(p.amount)
                    }, "change_status", $.UT.NetErrorCallback)
                }
            }
        }
    });
    $.UT.Pager({dom: "#pager", callBack: function (d) {
        c.callBack(d)
    }})
};
P.Mod.bucang_sc.prototype.keypress = function (b, c) {
    b.bind("keypress", function (d) {
        d.keyCode == 13 && c.click()
    })
};
P.Mod.bucang_sc.prototype.setData = function (g) {
    var o = this, d = "", f, c = document.createElement("tbody"), n = "13";
    o.login();
    $("#tongji_nav_sc .on").removeClass();
    o.level = g.level + "";
    if (o.level != "0") {
        if (!$("[name=g]", o.dom).hasClass("hidden")) {
            $("[name=g]", o.dom).addClass("hidden")
        }
        n = "9"
    }
    if (g.list) {
        d = o.render(g.list);
        $.UT.HoverList({container: "#date_tb", el: "tr"})
    } else {
        d = "<tbody ><tr><td colspan='" + n + "'>暂无数据！</td></tr></tbody>"
    }
    var b = 1, m = 1;
    if (g.pager) {
        b = g.pager.current;
        m = g.pager.total
    }
    document.getElementById("current_page").value = b;
    document.getElementById("total_page").innerHTML = m;
    $("tbody", o.dom).remove();
    $("table", o.dom).append(d);
    $.UT.HoverList({el: "tr", container: "#date_tb tbody"})
};
P.Mod.bucang_sc.prototype.callBack = function (d) {
    var c = this, b = {};
    if (d === undefined) {
        b.pager = 1
    } else {
        b = d
    }
    b.play = $("#play").val();
    $.UT.publicGetAction(c.dom[0].id, b, function (f) {
        c.setData(f)
    })
};
P.Mod.bucang_sc.prototype.render = function (b) {
    return P.Mod.bucang.prototype.render.call(this, b)
};
P.Mod.bucang_sc.prototype.unbind = function () {
    delete this.level;
    delete this.pop
};
P.Mod.bucang_sc.prototype.login = function () {
    P.Mod.bucang.prototype.login.call(this)
};
P.Mod.bucang_pk10 = P.Mod.bucang;
P.Mod.bucang_nc = P.Mod.bucang;
P.Mod.bucang_ks = P.Mod.bucang;
P.Mod.huiyuanList = function (c) {
    this.dom = c;
    this.level = "5";
    this.status = ["停用", "停押", "启用", "全部"];
    var f = this, b = $("#memeber_tb th[ln]"), d = parseInt(P.Set.level, 10);
    f.levelName = ["管理员", "分公司", "股东", "总代理", "代理", "会员"];
    c.bind("click keyup change", function (g) {
        P.Utl.memeberBind(g, f)
    });
    $("#del").hide();
    $.UT.Pager({dom: "#huiyuanList .pager", callBack: function (g) {
        f.callBack(g)
    }});
    $("#huiyuanList").delegate("tbody tr", "mouseover mouseout", function (h) {
        var g = h.target;
        if (h.type === "mouseover") {
            this.className = "bc"
        }
        if (h.type === "mouseout") {
            this.className = ""
        }
    });
    b.addClass(function (g) {
        if ((g + 1) < d) {
            return"hidden"
        }
    })
};
P.Mod.huiyuanList.prototype.callBack = P.Utl.memberCallback;
P.Mod.huiyuanList.prototype.statusChange = P.Utl.statusChange;
P.Mod.huiyuanList.prototype.setData = function (m) {
    if (!P.Utl.valModule(this)) {
        return
    }
    var d = $("#all_sel");
    if (d.length > 0) {
        d[0].checked = false
    }
    $("#account_nav").trigger("changeaccount", [m]);
    var b, c = "";
    var n = [], g = "", f = 0;
    if (m.list) {
        c = "<tbody id='accounts_tb'>";
        f = m.list.length;
        for (b = 0; b < f; b++) {
            g = m.list[b][1];
            if (/.*(?=\[)/.test(g)) {
                n.push(g.replace(/.*(?=\[)/, "").replace(/\[|\]/g, ""))
            }
            c += P.Utl.memberRender(m.list[b], m.del, 10)
        }
        c += "</tbody>";
        $("#memeber_tb tbody").remove();
        $("#memeber_tb").append(c)
    }
    if (m.del == true) {
        $("#del").show()
    } else {
        $("#del").hide()
    }
    if (m.superior) {
        P.Utl.superior(m, "superior_se", "全部");
        $("#superior").removeClass("hidden")
    } else {
        $("#superior").addClass("hidden")
    }
    this.del = m.del;
    if (m.pager) {
        $.UT.PagerRender("#current_page", "#total_page", m.pager.current, m.pager.total)
    }
    if (m.superiorid) {
        $("#superior_se").val(m.superiorid)
    }
    P.Utl.renderCondition(m);
    if (m.level != "1" && n.join(",").replace(new RegExp(n[0], "g"), "").replace(/,/g, "") === "" && m.superid) {
        $("#superior_se", this.dom).val(m.superid)
    }
    P.Utl.getCondition(this.dom, "5", m.superid)
};
P.Mod.huiyuanList.prototype.rebind = function () {
    var ie =
        /*@cc_on !@*/
        false, ahover = "";
    if (ie) {
        if (this.opNode) {
            this.opNode.innerHTML = this.opNode.innerHTML;
            delete this.opNode
        }
    }
};
P.Mod.huiyuan = function (b) {
    this.dom = b;
    var d = b[0].id, c = this;
    P.Utl.spaner("#games_info");
    P.Utl.spaner("#general_info");
    this.level = 5;
    this.spaner = $(".spaning input", b);
    this.condition = G.condition || {};
    this.condition.level = "5";
    b.bind("click keypress change", function (m) {
        var g = m.target, h = $("#layout").Module();
        if (m.type == "keypress" && m.keyCode == 13 && (g.id !== "reset" && g.id !== "reback")) {
            var f = g.getAttribute("vname") || "";
            if (f.indexOf("general") == -1) {
                c.submit()
            }
        }
        if (m.type === "click") {
            if (g.id === "reback" || g.id === "reset") {
                $("#account_nav").trigger("openclose");
                c.parentLoader.goBack(d + "List")
            }
            if (g.id === "submit") {
                c.submit()
            }
            if (g.id == "share_up") {
                $("#share_up_list").toggle()
            } else {
                if ($("#share_up_list").css("display") != "none") {
                    $("#share_up_list").css("display", "none")
                }
            }
            if (g.id === "g00") {
                P.Utl.quickSet(d, g, 1)
            }
            if (g.id == "g01") {
                P.Utl.quickSet(d, g, 2)
            }
            if (g.id === "g02") {
                P.Utl.quickSet(d, g, 3)
            }
            if (g.id == "g03") {
                P.Utl.quickSet(d, g, 4)
            }
        }
        if (m.type === "change" && g.getAttribute("name") === "odds_set") {
            c.changOddSet($("select[name=odds_set]").val())
        }
        if (m.type === "change" && g.getAttribute("name") === "set_water") {
            var n = g.value;
            P.Utl.water_set(n, b)
        }
        if (m.type === "change" && g.className.indexOf("quickset") > -1) {
            $(g).removeClass("quickset")
        }
    });
    P.Utl.water_event(b);
    P.Utl.accountCheck(c.dom[0].id)
};
P.Mod.huiyuan.prototype.rebind = function () {
    this.condition = G.condition || {};
    this.condition.level = "5";
    var b = this;
    P.Utl.accountCheck(b.dom[0].id)
};
P.Mod.huiyuan.prototype.setData = function (b) {
    this.changOddSet(b.user.odds_set);
    P.Utl.accountRender.call(this, b, 5);
    this.data = b
};
P.Mod.huiyuan.prototype.changOddSet = function (f) {
    var b = this.spaner.length, g, h = 0, c;
    for (; h < b; h++) {
        c = this.spaner[h];
        g = c.getAttribute("vname");
        if (g.indexOf(f) === -1) {
            c.setAttribute("readOnly", "readonly");
            c.className = "gray1"
        } else {
            c.removeAttribute("readOnly");
            c.className = ""
        }
    }
};
P.Mod.huiyuan.prototype.submit = function () {
    P.Utl.accountSubmit.call(this)
};
P.Mod.huiyuan.prototype.unbind = function () {
    var b = ["name", "account", "password", "repassword", "credit", "odds_set", "status", "share_up", "share_flag", "set_water", "share_total"];
    P.Utl.defaultValue(b, 5);
    this.cUnbind();
    $("#share_flag1").removeAttr("checked");
    $("#share_flag2").attr("checked", "checked");
    $("#share_up_list").hide();
    $("#games_info .quickset").removeClass("quickset");
    $("#share_up_list").hide();
    $("#share_toatl_list").hide();
    $(".set_water_t").hide();
    $("#set_water_td").html("")
};
P.Mod.huiyuan.prototype.cUnbind = function () {
    delete this.superiorid;
    delete this.userid;
    delete this.rules;
    delete this.gameRule;
    delete this.condition;
    this.data = null;
    if (this.vRules) {
        this.vRules.hideTips();
        this.vRules.hideIco();
        $.removeData(this.vRules.dom[0]);
        delete this.vRules
    }
    if (this.vgRules) {
        $.removeData(this.vgRules.dom[0], "Validator");
        delete this.vgRules
    }
    $("input[name=account]", document.getElementById("user_info")).removeAttr("readOnly").removeClass("gray1");
    document.getElementById("account_name").innerHTML = "";
    document.getElementById("superior").innerHTML = "";
    this.posttype = null;
    $(".g-vd-error").remove();
    this.quickSet = null
};
P.Mod.memberList = function (b) {
    this.dom = b;
    this.status = ["停用", "停押", "启用", "全部"];
    var d = this, c = b[0].id;
    d.levelName = ["管理员", "分公司", "股东", "总代理", "代理", "会员"];
    b.bind("click keyup change", function (f) {
        P.Utl.memeberBind(f, d)
    });
    $("#del").hide();
    $.UT.Pager({dom: "#" + c + " .pager", callBack: function (f) {
        d.callBack(f)
    }});
    b.delegate("tbody tr", "mouseover mouseout", function (f) {
        if (f.type === "mouseover") {
            this.className = "bc"
        }
        if (f.type === "mouseout") {
            this.className = ""
        }
    })
};
P.Mod.memberList.prototype.callBack = P.Utl.memberCallback;
P.Mod.memberList.prototype.statusChange = P.Utl.statusChange;
P.Mod.memberList.prototype.setData = function (g) {
    this.common(g);
    var b, d = "", n = parseInt(P.Set.level, 10);
    this.level = g.level + "";
    if (g.del && g.del == true) {
        $("#del").show()
    } else {
        $("#del").hide()
    }
    var m = [], f = "", c = 12;
    if (this.level == "1") {
        c = 15;
        $("th[name=fgs]", this.dom).removeClass("hidden");
        $("th[name=level_name]", this.dom).removeClass("hidden")
    } else {
        $("th[name=fgs]", this.dom).addClass("hidden");
        $("th[name=level_name]", this.dom).addClass(function () {
            var h = parseInt(this.getAttribute("ln"), 10);
            if (parseInt(P.Set.level, 10) >= h) {
                return"hidden"
            }
            return""
        })
    }
    if (g.list) {
        d = "<tbody id='accounts_tb'>";
        for (b = 0; b < g.list.length; b++) {
            f = g.list[b][1];
            if (/.*(?=\[)/.test(f)) {
                m.push(f.replace(/.*(?=\[)/, "").replace(/\[|\]/g, ""))
            }
            d += P.Utl.memberRender(g.list[b], g.del, c, true)
        }
        d += "</tbody>";
        $("#memeber_tb tbody").remove();
        $("#memeber_tb").append(d)
    }
    $("span[name=account_name]", this.dom).html(this.levelName[g.level]);
    if (g.level != "1" && g.superior) {
        P.Utl.superior(g, "superior_se", "全部");
        $("#superior").removeClass("hidden")
    } else {
        $("#superior").addClass("hidden")
    }
    if (g.superiorid) {
        setTimeout(function () {
            $("#superior_se", this.dom).val(g.superiorid)
        }, 5)
    }
    P.Utl.getCondition(this.dom, g.level, g.superid);
    $("#account_nav").Module().getStatusfun()
};
P.Mod.memberList.prototype.common = function (c) {
    if (!P.Utl.valModule(this)) {
        return
    }
    var b = $("#all_sel");
    if (b.length > 0) {
        b[0].checked = false
    }
    $("#account_nav").trigger("changeaccount", [c]);
    c.del == true ? $("#del").show() : $("#del").hide();
    this.del = c.del;
    if (c.pager) {
        $.UT.PagerRender("#current_page", "#total_page", c.pager.current, c.pager.total)
    }
    P.Utl.renderCondition(c)
};
P.Mod.memberList.prototype.rebind = function () {
    var ie =
        /*@cc_on !@*/
        false, ahover = "";
    if (ie) {
        if (this.opNode) {
            this.opNode.innerHTML = this.opNode.innerHTML;
            delete this.opNode
        }
    }
};
P.Mod.memberList.prototype.unbind = function () {
    $("span[name=account_name]", this.dom).html("")
};
P.Mod.huiyuanList = function (b) {
    P.Mod.memberList.call(this, b);
    this.level = "5";
    var c = parseInt(P.Set.level, 10);
    $("#memeber_tb th[ln]").addClass(function (d) {
        if ((d + 1) < c) {
            return"hidden"
        }
    })
};
P.Mod.huiyuanList.prototype.callBack = P.Utl.memberCallback;
P.Mod.huiyuanList.prototype.statusChange = P.Utl.statusChange;
P.Mod.huiyuanList.prototype.setData = function (g) {
    P.Mod.memberList.prototype.common.call(this, g);
    var b, c = "";
    if (g.del && g.del == true) {
        $("#del").show()
    } else {
        $("#del").hide()
    }
    var m = [], f = "", d = 0;
    if (this.level == "0") {
        $("th[name=level_name]", this.dom).removeClass("hidden")
    } else {
        $("th[name=level_name]", this.dom).addClass(function () {
            var h = parseInt(this.getAttribute("ln"), 10);
            if (parseInt(P.Set.level, 10) >= h) {
                return"hidden"
            }
            return""
        })
    }
    if (g.list) {
        c = "<tbody id='accounts_tb'>";
        d = g.list.length;
        for (b = 0; b < d; b++) {
            f = g.list[b][1];
            if (/.*(?=\[)/.test(f)) {
                m.push(f.replace(/.*(?=\[)/, "").replace(/\[|\]/g, ""))
            }
            c += P.Utl.memberRender(g.list[b], g.del, 11)
        }
        c += "</tbody>";
        $("#memeber_tb tbody").remove();
        $("#memeber_tb").append(c)
    }
    if (g.superior) {
        P.Utl.superior(g, "superior_se", "全部");
        $("#superior").removeClass("hidden")
    } else {
        $("#superior").addClass("hidden")
    }
    if (g.superiorid) {
        setTimeout(function () {
            $("#superior_se").val(g.superiorid)
        }, 5)
    }
    P.Utl.getCondition(this.dom, "5", g.superid);
    $("#account_nav").Module().getStatusfun()
};
P.Mod.huiyuanList.prototype.rebind = function () {
    P.Mod.memberList.prototype.rebind.call(this)
};
P.Mod.guanliyuanList = function (b) {
    P.Mod.memberList.call(this, b);
    this.level = "0"
};
P.Mod.guanliyuanList.prototype.callBack = P.Utl.memberCallback;
P.Mod.guanliyuanList.prototype.statusChange = P.Utl.statusChange;
P.Mod.guanliyuanList.prototype.setData = function (d) {
    P.Mod.memberList.prototype.common.call(this, d);
    var b, c = "";
    if (d.del && d.del == true) {
        $("#del").show()
    } else {
        $("#del").hide()
    }
    if (d.list) {
        c = "<tbody id='accounts_tb'>";
        for (b = 0; b < d.list.length; b++) {
            c += P.Utl.memberRender(d.list[b], d.del, 6)
        }
        c += "</tbody>";
        $("#memeber_tb tbody").remove();
        $("#memeber_tb").append(c)
    }
    P.Utl.getCondition(this.dom, P.Set.level)
};
P.Mod.guanliyuanList.prototype.rebind = function () {
    P.Mod.memberList.prototype.rebind.call(this)
};
P.Mod.member = function (b) {
    var d = this, c = b[0].id;
    this.level = null;
    this.levelName = ["管理员", "分公司", "股东", "总代理", "代理", "会员"];
    b.bind("click keypress change", function (m) {
        var s = m.target, g = $("#layout").Module();
        if (m.type == "keypress" && m.keyCode == 13 && (s.id !== "reset" && s.id !== "reback")) {
            var n = d.maxShareTotal, v = $(".share_up_div input[name=share_total]"), r = $(".share_up_div input[name=share_up]"), q = parseInt(v.val(), 10), p = parseInt(r.val(), 10), o = n[0] - p;
            if (q + p > n[0] && o > 0) {
                v.val(o)
            }
            var h = s.getAttribute("vname") || "";
            if (h.indexOf("general") == -1) {
                d.submit()
            }
            $(s).blur()
        }
        if (m.type === "click") {
            if (s.id === "reback" || s.id === "reset") {
                $("#account_nav").trigger("openclose");
                d.parentLoader.goBack(b[0].id + "List")
            }
            if (s.id === "submit") {
                d.submit()
            }
            if (s.id == "share_up") {
                $("#share_up_list").toggle()
            } else {
                if ($("#share_up_list").css("display") != "none") {
                    $("#share_up_list").css("display", "none")
                }
            }
            if (s.id == "share_total") {
                $("#share_total_list").toggle()
            } else {
                if ($("#share_total_list").css("display") != "none") {
                    $("#share_total_list").css("display", "none")
                }
            }
            if (s.id === "g00") {
                P.Utl.quickSet(c, s, 1)
            }
            if (s.id == "g01") {
                P.Utl.quickSet(c, s, 2)
            }
            if (s.id === "g02") {
                P.Utl.quickSet(c, s, 3)
            }
            if (s.id == "g03") {
                P.Utl.quickSet(c, s, 4)
            }
        }
        if (m.type === "change" && s.className.indexOf("quickset") > -1) {
            $(s).removeClass("quickset")
        }
        if (m.type === "change" && s.getAttribute("name") === "set_water") {
            var f = s.value;
            P.Utl.water_set(f, b)
        }
    });
    P.Utl.accountCheck(c);
    P.Utl.spaner("#games_info");
    P.Utl.spaner("#general_info");
    P.Utl.water_event(b)
};
P.Mod.member.prototype.rebind = function () {
    var b = this;
    this.condition = G.condition || {};
    P.Utl.accountCheck(b.dom[0].id)
};
P.Mod.member.prototype.setData = function (b) {
    var c = ["", "", ["分公司占成(%)", "股东及下级占成权限总和(%)"], ["股东实际占成数(%)", "总代理及下级占成权限总和(%)"], ["总代理实际占成数(%)", "代理及下级占成权限总和(%)"], ""];
    this.condition = G.condition || {};
    this.level = $("#nav .on").attr("level");
    this.condition.level = this.level;
    if (b.maxShareTotal !== undefined) {
        this.maxShareTotal = b.maxShareTotal
    }
    $("th[name='parentname']", this.dom).html(c[this.level][0]);
    $("th[name='currentname']", this.dom).html(c[this.level][1]);
    P.Utl.accountRender.call(this, b, parseInt(this.level, 10));
    this.data = b
};
P.Mod.member.prototype.submit = function () {
    P.Utl.accountSubmit.call(this)
};
P.Mod.member.prototype.unbind = function () {
    P.Mod.huiyuan.prototype.cUnbind.call(this);
    $("#share_flag2").removeAttr("checked");
    $("#share_flag1").attr("checked", "checked");
    delete this.level;
    var b = ["name", "account", "password", "repassword", "credit", "odds_set", "status", "short_covering", "share_total", "corpRptFlag", "share_up", "share_flag", "beishu_set", "set_water"];
    P.Utl.defaultValue(b);
    document.getElementById("share_flag2").removeAttribute("disabled");
    $("#share_up_list").hide();
    $("#share_toatl_list").hide();
    $("#games_info .quickset").removeClass("quickset");
    $(".g-vd-error").remove();
    $(".set_water_t").hide();
    $("#set_water_td").html("")
};
P.Mod.autoOdds = function (c) {
    var d = this;
    this.dom = c;
    this.id = c[0].id;
    this.input = $("table input", c);
    var b = {rules: {}, onblur: true, errorMessages: {}};
    this.input.each(function (f, g) {
        var m = {}, n = {}, h = g.getAttribute("vname");
        if (h.indexOf("zc") > -1) {
            m.regExp = /^[1-9]\d{0,8}$/;
            n.regExp = "金额由不大于9位的正整数组成";
            g.setAttribute("vmessage", "金额由不大于9位的正整数组成")
        }
        if (h.indexOf("bj") > -1) {
            m.regExp = /^0(\.\d{1,3})?$|^[1-9]\d?(\.\d{1,3})?$/;
            n.regExp = "自动跳水下调步阶由0-99组成，允许最多带三位小数";
            g.setAttribute("vmessage", "下调步阶由0-99组成，允许最多带三位小数")
        }
        if (h.indexOf("zd") > -1) {
            m.regExp = /^(?:0|[1-9]\d{0,3})(\.\d{1,3})?$/;
            m.min = 0;
            n.regExp = "赔率大于等于0，长度为1-4的整数，允许最多带三位小数";
            n.min = "赔率大于等于0，长度为1-4的整数，允许最多带三位小数";
            g.setAttribute("vmessage", "赔率大于等于0，长度为1-4的整数，允许最多带三位小数")
        }
        b.rules[h] = m;
        b.errorMessages[h] = n
    });
    if (P.Set.systype != "ks") {
        b.rules.autotimes = {max: 100, regExp: /^[1-9]\d{0,2}$/, min: 1}
    }
    b.errorMessages.autotimes = {max: "最大比例不能超过100", min: "最小比例不能少于1", regExp: "比例必须为整数"};
    d.validator = $(c).Widget("SimpleValidator", b);
    $("#submit", c).bind("click", function (q) {
        var h = P.Utl.isChangeForm("#" + d.id), t, o = {};
        if (h) {
            t = d.validator.verifyForm()
        } else {
            $.UT.Alert({text: "请做修改后，再保存", booLean: false});
            return
        }
        if (t != true) {
            return
        }
        for (var f = 0; f < 32; f++) {
            var p = (f / Math.pow(10, 2)).toFixed(2).substr(2), s;
            s = document.getElementsByName(p);
            for (var r = 0, m = s.length; r < m; r++) {
                o[s[r].getAttribute("vname")] = s[r].value
            }
        }
        if ($("#autoisuse").attr("checked") == "checked") {
            o.isuse = 1
        } else {
            o.isuse = 0
        }
        if (P.Set.systype != "ks") {
            o.times = $("#autotimes").val()
        }
        $.UT.publicGetAction(d.dom[0].id, o, function (z) {
            var y = {};
            $.UT.Alert({text: z.succ, booLean: false});
            for (var B = 0; B < 32; B++) {
                var A = (B / Math.pow(10, 2)).toFixed(2).substr(2), x, v = 0;
                x = document.getElementsByName(A);
                v = x.length;
                y[A] = [];
                for (var w = 0; w < v; w++) {
                    y[A].push(x[w].value)
                }
            }
            y.isuse = $("#autoisuse").prop("checked");
            if (P.Set.systype != "ks") {
                y.times = $("#autotimes").val()
            }
            y.success = true;
            d.setData(y)
        })
    });
    $("#reset", c).bind("click", function (f) {
        $(".g-vd-s-error").removeClass("g-vd-s-error");
        d.setData(d.data)
    });
    c.delegate("input", "keypress", function (f) {
        if (f.keyCode == 13) {
            $("#submit").click()
        }
    })
};
P.Mod.autoOdds.prototype.setData = function (d) {
    var g = this;
    if (d.success) {
        this.data = d
    }
    if (d.isuse != undefined && d.isuse == 1) {
        $("#autoisuse").attr("checked", true).prop("defaultChecked", true)
    } else {
        $("#autoisuse").removeAttr("checked").prop("defaultChecked", false)
    }
    if (d.times != undefined) {
        $("#autotimes").attr("value", d.times).prop("defaultValue", d.times)
    }
    for (var f = 0, b = g.input.length; f < b; f++) {
        var o = g.input[f], m = o.getAttribute("vname"), n = m.slice(-2), h = {zc: 0, bj: 1, zd: 2}[m.slice(0, 2)];
        try {
            $(o).prop("defaultValue", d[n][h]);
            o.value = d[n][h]
        } catch (c) {
        }
    }
};
P.Mod.autoOdds.prototype.unbind = function () {
    P.Mod.setunbind.call(this)
};
P.Mod.autoOdds_sc = function (c) {
    var d = this;
    this.dom = c;
    this.id = c[0].id;
    this.input = $("table input", c);
    P.Utl.tab({dom: "#tab_menu", f: this.flag, callBack: this.callBack});
    var b = {rules: {}, onblur: true, errorMessages: {}};
    this.input.each(function (f, g) {
        var h = {}, m = {};
        if (f < 9) {
            h.regExp = /^[1-9]\d{0,8}$/;
            m.regExp = "金额由不大于9位的正整数组成";
            g.setAttribute("vmessage", "金额由不大于9位的正整数组成")
        }
        if (8 < f && f < 18) {
            h.regExp = /^0(\.\d{1,3})?$|^[1-9]\d?(\.\d{1,3})?$/;
            m.regExp = "自动跳水下调步阶由0-99组成，允许最多带三位小数";
            g.setAttribute("vmessage", "下调步阶由0-99组成，允许最多带三位小数")
        }
        if (17 < f) {
            h.regExp = /^(?:0|[1-9]\d{0,3})(\.\d{1,3})?$/;
            h.min = 0;
            m.regExp = "赔率大于等于0，长度为1-4的整数，允许最多带三位小数";
            m.min = "赔率大于等于0，长度为1-4的整数，允许最多带三位小数";
            g.setAttribute("vmessage", "赔率大于等于0，长度为1-4的整数，允许最多带三位小数")
        }
        b.rules["p" + f] = h;
        b.errorMessages["p" + f] = m
    });
    b.rules.autotimes = {max: 100, regExp: /^[1-9]\d{0,2}$/, min: 1};
    b.errorMessages.autotimes = {max: "最大比例不能超过100", min: "最小比例不能少于1", regExp: "比例必须为整数"};
    this.validator = $(c).Widget("SimpleValidator", b);
    $("#submit", c).bind("click", function (m) {
        var g = d.validator.verifyForm();
        if (g != true) {
            return
        }
        var h = P.Utl.isValueChange(d.id);
        if (!h) {
            return false
        }
        var f = {};
        d.input.each(function (n, o) {
            var p = o.id;
            f[p] = o.value
        });
        if ($("#autoisuse").attr("checked") == "checked") {
            f.isuse = 1
        } else {
            f.isuse = 0
        }
        f.times = $("#autotimes").val();
        d.arr = f;
        $.UT.publicGetAction(d.dom[0].id, f, function (n) {
            d.data = d.arr;
            delete d.arr;
            $.UT.Alert({text: n.succ, booLean: false});
            P.Utl.isValueChange(d.id, 1)
        })
    });
    $("#reset", c).bind("click", function (f) {
        d.setData(d.data)
    });
    c.delegate("input", "keypress", function (f) {
        if (f.keyCode == 13) {
            $("#submit").click()
        }
    })
};
P.Mod.autoOdds_sc.prototype.setData = function (b) {
    var c = this;
    if (b.success != "undefined") {
        if (b.success == false) {
            return false
        }
    }
    this.data = b;
    if (b.isuse != undefined && b.isuse == 1) {
        $("#autoisuse").attr("checked", "checked")
    } else {
        $("#autoisuse").removeAttr("checked")
    }
    if (b.times != undefined) {
        $("#autotimes").val(b.times)
    }
    c.input.each(function (d, f) {
        var g = f.id;
        if (b[g] != null) {
            f.value = b[g]
        }
    });
    this.cacheValue = 1;
    if (this.cacheValue == 1) {
        P.Utl.isValueChange(c.id, 1);
        this.cacheValue == 0
    }
};
P.Mod.autoOdds_sc.prototype.callBack = function (c) {
    var f = $("#autoOdds").data("Module"), d, b = {};
    $.UT.publicGetAction(f.dom[0].id, b, function (g) {
        f.setData(g)
    }, "get_json", function (p, n) {
        var m = "", h, g, o;
        for (h in p) {
            g = p[h];
            o = P.Set.ErrorMapping[g.eid];
            m += o;
            if (g.note) {
                m += g.note + "</br>"
            }
        }
        if (!cfun) {
            booLean = false
        }
        if (n) {
            f.setData(n)
        }
    })
};
P.Mod.autoOdds_sc.prototype.unbind = function () {
    P.Mod.setunbind.call(this)
};
P.Mod.autoOdds_pk10 = P.Mod.autoOdds;
P.Mod.autoOdds_nc = P.Mod.autoOdds;
P.Mod.autoOdds_ks = P.Mod.autoOdds;
P.Mod.bettingLimits = function (b) {
    var c = this;
    this.dom = b;
    this.id = b[0].id;
    this.input = $("input", b);
    $("#submit", b).bind("click", function (p) {
        var s = P.Utl.isChangeForm(c.dom), m = {};
        if (!s) {
            $.UT.Alert({text: "请做修改后，再保存", booLean: false});
            return
        }
        var t = c.validator.verifyForm();
        if (t != true) {
            return
        }
        for (var f = 0; f < 32; f++) {
            var o = (f / Math.pow(10, 2)).toFixed(2).substr(2), r;
            r = document.getElementsByName(o);
            for (var q = 0, h = r.length; q < h; q++) {
                m[r[q].getAttribute("vname")] = r[q].value
            }
        }
        $.UT.publicGetAction(c.dom[0].id, m, function (x) {
            var w = {userData: {}};
            delete c.arr;
            $.UT.Alert({text: x.succ, booLean: false});
            for (var z = 0; z < 32; z++) {
                var y = (z / Math.pow(10, 2)).toFixed(2).substr(2), v;
                if (P.Set.systype == "klc") {
                    v = $("#bettingLimits  input[name='" + y + "']")
                } else {
                    if (P.Set.systype == "nc") {
                        v = $("#bettingLimits_nc  input[name='" + y + "']")
                    } else {
                        if (P.Set.systype == "pk10") {
                            v = $("#bettingLimits_pk10  input[name='" + y + "']")
                        } else {
                            if (P.Set.systype == "ks") {
                                v = $("#bettingLimits_ks  input[name='" + y + "']")
                            }
                        }
                    }
                }
                try {
                    if (v.length) {
                        if (v[0].value && v[1].value && v[2].value) {
                            w.userData[y] = [v[0].value, v[1].value, v[2].value, v[3].value, v[4].value]
                        }
                    }
                } catch (d) {
                }
            }
            c.data = w;
            c.setData(c.data)
        }, null, null, null, null, {button: "#submit"})
    });
    $("#reset", b).bind("click", function (d) {
        $(".g-vd-s-error").removeClass("g-vd-s-error");
        c.setData(c.data)
    });
    b.delegate("input", "keypress", function (d) {
        if (d.keyCode == 13) {
            $("#submit").click()
        }
    });
    $("input[vname^='item']").not("input[vname^='itemtmp']").bind("change keyup", function (g) {
        if (g.keyCode == 13) {
            return false
        }
        var d = $(this).attr("name");
        var f = $(this).val();
        $("input[vname='itemtmp" + d + "']").val(f)
    });
    $("input[vname^='ordermax']").not("input[vname^='ordermaxtmp']").bind("change keyup", function (g) {
        if (g.keyCode == 13) {
            return false
        }
        var d = $(this).attr("name");
        var f = $(this).val();
        $("input[vname='ordermaxtmp" + d + "']").val(f)
    })
};
P.Mod.bettingLimits.prototype.setData = function (f) {
    var m = this, c, b;
    m.data = f;
    var h = P.Utl.renderGame_btL(f, "", "#" + this.id);
    h.onblur = true;
    this.validator = $(m.dom).Widget("SimpleValidator", h);
    if (f.userData) {
        userData = f.userData;
        for (var g in userData) {
            b = document.getElementsByName(g);
            if (b.length) {
                $(b[0]).prop("defaultValue", userData[g][0]).val(userData[g][0]);
                $(b[1]).prop("defaultValue", userData[g][1]).val(userData[g][1]);
                $(b[2]).prop("defaultValue", userData[g][2]).val(userData[g][2]);
                $(b[3]).prop("defaultValue", userData[g][3]).val(userData[g][3]);
                $(b[4]).prop("defaultValue", userData[g][4]).val(userData[g][4])
            }
        }
    }
};
P.Utl.renderGame_btL = function (R, b, O) {
    var g = false, Q = false, q = {rules: {}, onblur: false, errorMessages: {}}, w = R.userData, A = R.minValue ? R.minValue : {}, J = R.maxValue ? R.maxValue : {};
    if (w) {
        for (var L in w) {
            if (!A[L]) {
                A[L] = []
            }
            if (!J[L]) {
                J[L] = []
            }
            var E = $("input[name=" + L + "]", O), B = w[L], o = "ordermin" + L, s = "ordermax" + L, c = "ordermaxtmp" + L, K = "item" + L, x = "itemtmp" + L, D = A[L][0] ? A[L][0] : 0, F = J[L][0] ? J[L][0] : 999999999, h = A[L][1] ? A[L][1] : 0, m = J[L][1] ? J[L][1] : 999999999, z = A[L][2] ? A[L][2] : 0, C = J[L][2] ? J[L][2] : 999999999;
            if (E.length === 0) {
                continue
            }
            $(E[0]).prop("defaultValue", B[0]);
            $(E[1]).prop("defaultValue", B[1]);
            $(E[2]).prop("defaultValue", B[2]);
            E[0].value = B[0];
            E[1].value = B[1];
            E[2].value = B[2];
            q.rules[o] = {regExp: /^[1-9]\d{0,8}$/, lessThan: s, min: D, max: F};
            q.rules[s] = {regExp: /^[1-9]\d{0,8}$/, lessThan: K, min: h, max: m};
            q.rules[K] = {regExp: /^[1-9]\d{0,8}$/, min: z, max: C};
            q.errorMessages[o] = {regExp: "单注最低由不大于9位的正整数组成", lessThan: "单注最低必须小于或等于单注最高", min: "单注最低必须大于或等于上级的单注最低" + D, max: "单注最低必须小于或等于下级的单注最高" + F};
            q.errorMessages[s] = {regExp: "单注最高由不大于9位的正整数组成", lessThan: "单注最高必须小于或等于单项最高", min: "单注最高必须大于或等于下级的单注最高" + h, max: "单注最高必须小于或等于上级的单注最高" + m};
            q.errorMessages[K] = {regExp: "单项最高由不大于9位的正整数组成", min: "单项最高必须大于或等于下级的单项最高" + z, max: "单项最高必须小于或等于上级的单项最高" + C};
            var y = $("#bettingLimits").Module();
            var S = $("#bettingLimits_sc").Module();
            var t = $("#bettingLimits_pk10").Module();
            var n = $("#bettingLimits_nc").Module();
            var N = $("#bettingLimits_ks").Module();
            var M = 3;
            if (y || S || t || n || N) {
                $(E[3]).prop("defaultValue", B[3]);
                $(E[4]).prop("defaultValue", B[4]);
                E[3].value = B[3];
                E[4].value = B[4];
                q.rules[c] = {regExp: /^[1-9]\d{0,8}$/, lessThan: s, moreThan: o};
                q.errorMessages[c] = {regExp: "临时单注最高由不大于9位的正整数组成", lessThan: "临时单注最高必须小于或等于单注最高", moreThan: "临时单注最高必须大于或等于单注最低"};
                q.rules[x] = {regExp: /^[1-9]\d{0,8}$/, lessThan: K, moreThan: s};
                q.errorMessages[x] = {regExp: "临时单项最高由不大于9位的正整数组成", lessThan: "临时单项最高必须小于等于单项最高", moreThan: "临时单项最高必须大于等于单注最高"};
                M = 5
            }
            for (var H = M; H < B.length; H++) {
                var I = "";
                if (!E[H]) {
                    continue
                }
                I = ["", "", "", "A", "B", "C"][H];
                var f = "discount" + I + L, r = A[L][H] ? A[L][H] : 0, v = (J[L][H] != null && J[L][H] !== "" && J[L][H] != undefined) ? J[L][H] : 100;
                $(E[H]).prop("defaultValue", B[H]);
                E[H].value = B[H];
                q.rules[f] = {regExp: /^0(\.\d{1,2})?$|^[1-9]\d?(\.\d{1,2})?$/, min: r, max: v};
                q.errorMessages[f] = {regExp: "退水由小于100的整数组成，允许输入两位小数", min: "退水必须大于或等于下级最大退水" + r + "%", max: "退水必须小于或等于上级退水" + v + "%"};
                E[H].setAttribute("minValue", r);
                E[H].setAttribute("maxValue", v)
            }
        }
    }
    E = null;
    return q
};
P.Mod.bettingLimits.prototype.unbind = function () {
    P.Mod.setunbind.call(this)
};
P.Mod.bettingLimits_sc = function (c) {
    var d = this;
    this.dom = c;
    this.id = c[0].id;
    this.input = $("input", c);
    P.Utl.tab({dom: "#tab_menu", f: this.flag, callBack: this.callBack});
    var b = this.vRules(c);
    this.validator = $(c).Widget("SimpleValidator", b);
    $("#submit", c).bind("click", function (m) {
        var g = d.validator.verifyForm();
        if (g == true) {
            var h = P.Utl.isValueChange(d.id);
            if (!h) {
                return false
            }
            var f = {};
            d.input.each(function (n, o) {
                var p = o.id;
                f[p] = o.value
            });
            d.arr = f;
            $.UT.publicGetAction(d.dom[0].id, f, function (n) {
                d.data = d.arr;
                delete d.arr;
                $.UT.Alert({text: n.succ, booLean: false});
                P.Utl.isValueChange(d.id, 1)
            })
        } else {
            return
        }
    });
    $("#reset", c).bind("click", function (f) {
        d.setData(d.data)
    });
    $("input[id^='zd']").not("input[id^='zdtmp']").bind("change keyup", function (h) {
        if (h.keyCode == 13) {
            return false
        }
        var m = $(this).attr("id");
        var f = m.split("zd")[1];
        var g = $(this).val();
        $("input[id='zdtmp" + f + "']").val(g)
    });
    $("input[id^='bj']").not("input[id^='bjtmp']").bind("change keyup", function (h) {
        if (h.keyCode == 13) {
            return false
        }
        var m = $(this).attr("id");
        var f = m.split("bj")[1];
        var g = $(this).val();
        $("input[id='bjtmp" + f + "']").val(g)
    });
    c.delegate("input", "keypress", function (f) {
        if (f.keyCode == 13) {
            $("#submit").click()
        }
    })
};
P.Mod.bettingLimits_sc.prototype.setData = function (b) {
    var c = this;
    this.data = b;
    c.input = $("input", c.dom);
    c.input.each(function (d, f) {
        var g = f.id;
        if (b[g]) {
            f.value = b[g]
        }
    });
    this.cacheValue = 1;
    if (this.cacheValue == 1) {
        P.Utl.isValueChange(c.id, 1);
        this.cacheValue == 0
    }
};
P.Mod.bettingLimits_sc.prototype.vRules = function (g) {
    var c = {rules: {}, onblur: true, errorMessages: {}};
    for (var m = 1; m <= 9; m++) {
        var p = "0" + m;
        var h = "fz" + p, q = "bj" + p, w = "bjtmp" + p, s = "zd" + p, o = "zdtmp" + p, r = 0, b = 999999999, v = 0, f = 999999999, n = 0, t = 999999999;
        c.rules[h] = {regExp: /^[1-9]\d{0,8}$/, lessThan: q, min: r, max: b};
        c.rules[q] = {regExp: /^[1-9]\d{0,8}$/, lessThan: s, min: v, max: f};
        c.rules[s] = {regExp: /^[1-9]\d{0,8}$/, min: n, max: t};
        c.errorMessages[h] = {regExp: "单注最低由不大于9位的正整数组成", lessThan: "单注最低必须小于或等于单注最高", min: "单注最低必须大于或等于上级的单注最低" + r, max: "单注最低必须小于或等于下级的单注最高" + b};
        c.errorMessages[q] = {regExp: "单注最高由不大于9位的正整数组成", lessThan: "单注最高必须小于或等于单项最高", min: "单注最高必须大于或等于下级的单注最高" + v, max: "单注最高必须小于或等于上级的单注最高" + f};
        c.errorMessages[s] = {regExp: "单项最高由不大于9位的正整数组成", min: "单项最高必须大于或等于下级的单项最高" + n, max: "单项最高必须小于或等于上级的单项最高" + t};
        c.rules[w] = {regExp: /^[1-9]\d{0,8}$/, lessThan: q, moreThan: h};
        c.errorMessages[w] = {regExp: "临时单注最高由不大于9位的正整数组成", lessThan: "临时单注最高必须小于或等于单注最高", moreThan: "临时单注最高必须大于或等于单注最低"};
        c.rules[o] = {regExp: /^[1-9]\d{0,8}$/, lessThan: s, moreThan: q};
        c.errorMessages[o] = {regExp: "临时单项最高由不大于9位的正整数组成", lessThan: "临时单项最高必须小于等于单项最高", moreThan: "临时单项最高必须大于等于单注最高"}
    }
    return c
};
P.Mod.bettingLimits_sc.prototype.callBack = function (c) {
    var f = $("#bettingLimits").data("Module"), d, b = {};
    $.UT.publicGetAction(f.dom[0].id, b, f.setData)
};
P.Mod.bettingLimits_sc.prototype.unbind = function (b) {
    P.Mod.setunbind.call(this)
};
P.Mod.bettingLimits_pk10 = P.Mod.bettingLimits;
P.Mod.bettingLimits_nc = P.Mod.bettingLimits;
P.Mod.bettingLimits_ks = P.Mod.bettingLimits;
P.Mod.replenishment = function (c) {
    var d = this;
    this.dom = c;
    this.id = c[0].id;
    this.input = $("input[vname]", c);
    var b = {rules: {}, onblur: true, errorMessages: {}};
    this.input.each(function (g, h) {
        var m = h.getAttribute("vname"), f = parseInt(h.name, 10);
        b.rules[m] = {regExp: /^0$|^[1-9]{1}[0-9]{0,8}$/};
        b.errorMessages[m] = {regExp: "金额由不大于9位的正整数组成"};
        if (8 < f && f < 15 && P.Set.systype == "klc") {
            b.rules[m] = {regExp: /^0$|^[1-9]{1}[0-9]{0,8}$/, equalTo: "zc" + ((f - 1) / Math.pow(10, 2)).toFixed(2).substr(2)};
            b.errorMessages[m] = {regExp: "金额由不大于9位的正整数组成", equalTo: "两面补货设置必须相同"}
        }
    });
    this.liangmian_text = this.input.filter(function (g) {
        var f = parseInt(this.getAttribute("name"), 10);
        if (P.Set.systype == "klc" || P.Set.systype == "nc") {
            return(7 < f && f < 15) && this.type == "text"
        } else {
            if (P.Set.systype == "pk10") {
                return(f == 10 || f == 11 || f == 13 || f == 14) && this.type == "text"
            } else {
                if (P.Set.systype == "ks") {
                    return(f == 0 || f == 1) && this.type == "text"
                }
            }
        }
    }).bind("keyup", function (f) {
        d.liangmian_text.val(f.target.value)
    });
    this.liangmian_radio = $("input:radio", "#replenishment, #replenishment_nc,#replenishment_ks").filter(function (g) {
        var f = parseInt(this.getAttribute("name"), 10);
        if (P.Set.systype != "ks") {
            return(7 < f && f < 15) && this.type == "radio"
        } else {
            return(f == 0 || f == 1) && this.type == "radio"
        }
    }).bind("change", function (h) {
        var f = h.target.id.slice(-1), g = d.liangmian_radio.length - 1, m;
        for (; g >= 0; g--) {
            m = $(d.liangmian_radio[g]);
            if (m.attr("id").slice(-1) == f) {
                m.prop("checked", true)
            } else {
                m.prop("checked", false)
            }
        }
    });
    d.optinos = b;
    this.validator = $(c).Widget("SimpleValidator", d.optinos);
    $("#submit", c).bind("click", function (s) {
        var q = P.Utl.isChangeForm("#" + d.id), x, r = {}, m;
        if (q != true) {
            $.UT.Alert({text: "请做修改后，再保存", booLean: false});
            return
        }
        x = d.validator.verifyForm();
        if (x != true) {
            return
        }
        m = $("input", ".games");
        var w = 32;
        if (P.Set.systype == "klc") {
            w = 32
        } else {
            if (P.Set.systype == "nc") {
                w = 32
            } else {
                if (P.Set.systype == "pk10") {
                    w = 16
                } else {
                    if (P.Set.systype == "ks") {
                        w = 8
                    }
                }
            }
        }
        for (var p = 0, f = m.length; p < w; p++) {
            var g = (p / Math.pow(10, 2)).toFixed(2).substr(2), h = $("input[name='" + g + "'][type='text']", c), o = $("#type" + g + "1"), t = false, v = "set" + g;
            if (h.val() !== h.prop("defaultValue")) {
                t = true
            }
            if (o.attr("checked") !== o.prop("defaultChecked")) {
                t = true
            }
            if (t) {
                r[v] = [];
                r[v].push(h.val());
                r[v].push($("[name=" + g + "]:checked", ".games").val())
            }
        }
        r.action = "submit";
        $.UT.publicGetAction(d.dom[0].id, {arr: r}, function (C) {
            var B = {};
            $.UT.Alert({text: C.succ, booLean: false});
            for (var E = 0; E < w; E++) {
                var D = (E / Math.pow(10, 2)).toFixed(2).substr(2), A, y = 0;
                A = document.getElementsByName(D);
                y = A.length;
                B[D] = ["", ""];
                for (var z = 0; z < y; z++) {
                    if (A[z].getAttribute("type") == "radio") {
                        if (A[z].checked) {
                            B[D][1] = A[z].value
                        }
                    } else {
                        B[D][0] = A[z].value
                    }
                }
            }
            d.data = B;
            d.setData(d.data)
        }, "", "", "", "", {button: "#submit"})
    });
    $(".all_sel input:radio").bind("change", function (g) {
        var f = g.target, h;
        if (f.id == "auto") {
            d.allSel("1")
        }
        if (f.id == "manul") {
            d.allSel("0")
        }
    });
    $(".games input:radio").bind("click", function () {
        $(".all_sel input:radio").attr("checked", false)
    });
    $("#reset", c).bind("click", function (f) {
        $(".g-vd-s-error").removeClass("g-vd-s-error");
        $(".all_sel input:radio").removeAttr("checked");
        d.setData(d.data)
    });
    c.delegate("input", "keypress", function (f) {
        if (f.keyCode == 13) {
            setTimeout(function () {
                $("#submit").click()
            }, 10)
        }
    })
};
P.Mod.replenishment.prototype.allSel = function (b) {
    $(":radio", ".games").each(function (c, d) {
        var f = d.value;
        if (f == b) {
            $(d).attr("checked", true)
        }
    })
};
P.Mod.replenishment.prototype.setData = function (g) {
    var n = this;
    this.data = g;
    if (g) {
        for (var m in n.data) {
            var h = document.getElementsByName(m);
            if (h.length > 0) {
                try {
                    $(h[0]).prop("defaultValue", g[m][0]).val(g[m][0])
                } catch (f) {
                    $(h[0]).prop("defaultValue", g[m][0])
                }
                g[m][1] = g[m][1] + "";
                var d = $(h[1]), b = $(h[2]);
                d.attr("checked", false).prop("defaultChecked", false);
                b.attr("checked", false).prop("defaultChecked", false);
                if (g[m][1] == "1") {
                    d.prop("defaultChecked", true).attr("checked", true)
                }
                if (g[m][1] == "0") {
                    b.prop("defaultChecked", true).attr("checked", true)
                }
            }
        }
    } else {
        $.UT.Alert({text: "系统出错，请联系管理员!", booLean: false})
    }
};
P.Mod.replenishment.prototype.unbind = function (b) {
    $(".all_sel input:radio").removeAttr("checked")
};
P.Mod.replenishment_sc = function (c) {
    var d = this;
    this.dom = c;
    this.id = c[0].id;
    this.input = $("input[id]", c);
    P.Utl.tab({dom: "#tab_menu", f: this.flag, callBack: this.callBack});
    var b = {rules: {}, onblur: true, errorMessages: {}};
    this.input.each(function (f, g) {
        b.rules["p" + f] = {regExp: /^0$|^[1-9]{1}[0-9]{0,8}$/};
        b.errorMessages["p" + f] = {regExp: "金额由不大于9位的正整数组成"}
    });
    this.radio = $("td:has(label)", d.dom);
    this.validator = $(c).Widget("SimpleValidator", b);
    $("[name=typeAll]:radio", c).bind("click", function (g) {
        var f = g.target;
        if ($(f).attr("nav") == "allmanual") {
            $("input[nav=manual]", d.radio).attr("checked", "checked")
        } else {
            $("input[nav=auto]", d.radio).attr("checked", "checked")
        }
    });
    $("#submit", c).bind("click", function (p) {
        var s = d.validator.verifyForm();
        if (s == true) {
            var r = P.Utl.isValueChange(d.id);
            if (!r) {
                return false
            }
            var o = {};
            o.action = "submit";
            for (var h in d.data.list) {
                var g = h;
                var n = $("td[number=" + h.slice(-2) + "]", d.dom);
                var q = $("input[type=text]", n).val();
                var m = $("input:checked", n);
                var f;
                if (m.attr("nav") == "auto") {
                    f = 1
                }
                if (m.attr("nav") == "manual") {
                    f = 0
                }
                if (f != d.data.list[h][1] || q != d.data.list[h][0]) {
                    d.data.list[h].splice(0, 1, q);
                    d.data.list[h].splice(1, 1, f);
                    o[g] = d.data.list[h]
                }
            }
            d.data = {arr: o};
            $.UT.publicGetAction(d.dom[0].id, {arr: o}, function (t) {
                $.UT.Alert({text: t.succ, booLean: false});
                P.Utl.isValueChange(d.id, 1)
            }, "", "", "", {button: "#submit"});
            o = null
        } else {
            return
        }
    });
    $("#reset", c).bind("click", function (f) {
        d.setData(d.data)
    });
    $("table input:radio").bind("change", function (g) {
        var f = g.target;
        if ($(f).attr("name") != "typeAll") {
            $("[name=typeAll]:radio").removeAttr("checked")
        }
    });
    c.delegate("input", "keypress", function (f) {
        if (f.keyCode == 13) {
            $("#submit").click()
        }
    })
};
P.Mod.replenishment_sc.prototype.setData = function (b) {
    var f = this;
    this.data = b;
    this.list = b.list;
    var d = $("td[number]", f.dom);
    $("input[nav=allauto]", f.dom).attr("checked", false);
    $("input[nav=allmanual]", f.dom).attr("checked", false);
    if (b) {
        if (f.list) {
            for (var c in f.list) {
                var d = $("td[number=" + c.slice(-2) + "]", f.dom);
                $("input[type=text]", d).val(f.list[c][0]);
                if (f.list[c][1] == 0) {
                    $("input[nav=manual]", d).attr("checked", "checked")
                } else {
                    $("input[nav=auto]", d).attr("checked", "checked")
                }
            }
        }
    } else {
        $.UT.Alert({test: "系统出错，请联系管理员!", booLean: false})
    }
    this.cacheValue = 1;
    if (this.cacheValue == 1) {
        P.Utl.isValueChange(f.id, 1);
        this.cacheValue == 0
    }
};
P.Mod.replenishment_sc.prototype.callBack = function (c) {
    var f = $("#replenishment").data("Module"), d, b = {};
    $.UT.publicGetAction(f.dom[0].id, b, f.setData)
};
P.Mod.replenishment_sc.prototype.unbind = function (b) {
    $("[name=typeAll]:radio").removeAttr("checked")
};
P.Mod.replenishment_pk10 = P.Mod.replenishment;
P.Mod.replenishment_nc = P.Mod.replenishment;
P.Mod.replenishment_ks = P.Mod.replenishment;
P.Mod.result_ks = function (b) {
    var c = this;
    this.dom = $("#result_" + P.Set.systype);
    this.tableform = $("#tableform", c.dom);
    this.dateSelectdom = $("input[id^='dateSelect_']");
    this.resiltList = $("#resiltList", c.dom);
    this.dateSelectdom.dateBox();
    $.UT.HoverList({container: c.resiltList, el: "tr"});
    this.dateSelectdom.bind("change", this.dateSelect)
};
P.Mod.result_ks.prototype.topSelectFun = function (d) {
    var c = d.target;
    var b = c.value;
    P.Utl.publicChengeModule(P.Set.layout.main, "ajax", "result_" + b, "get_html", "get_json", null, null, null, {romances: true})
};
P.Mod.result_ks.prototype.dateSelect = function (g, h) {
    var m = this, b = {}, c;
    var f = g.target.id.split("_")[1];
    b.datePhases = this.value;
    c = "get_json";
    P.Utl.publicChengeModule(P.Set.layout.main, "ajax", "result_" + f, "get_html", "get_json", b, null, null, {romances: true})
};
P.Mod.result_ks.prototype.timesSelect = function (g, h) {
    var m = this;
    var b = g.target, f = b.value;
    var c = $("#" + f).children();
    var h = m.data.list;
    if (h && h.length > 0) {
        $("td.qiuhao").each(function (d, n) {
            if (c[d]) {
                $(n).html(c[d].outerHTML)
            } else {
                $("td.qiuhao").html("")
            }
        })
    } else {
        $("td.qiuhao").html("")
    }
};
P.Mod.result_klc = P.Mod.result_ks;
P.Mod.result_ssc = P.Mod.result_ks;
P.Mod.result_pk10 = P.Mod.result_ks;
P.Mod.result_nc = P.Mod.result_ks;
P.Mod.reportForm_con = function (b) {
    var c = this;
    this.dom = b;
    this.id = c.dom[0].id;
    this.layout = $("#layout").Module();
    this.moduleLoader = $(c.layout.main).Widget("ModuleLoader");
    this.table = $(".reportForm-table", b);
    c.sh = $(".sh", c.table);
    c.sh.hide();
    c.hc = $(".sh", c.table);
    $(b).bind("click", function (m) {
        c.moduleLoader.clearHtmlCache(c.id);
        var d = m.target;
        if (d.tagName === "A" || $(d).parent("a")[0]) {
            var h = d.tagName == "A" ? d : $(d).parent("a")[0];
            if ($(h).parent()[0].id == "sysselect") {
                P.Utl.memuMask("#sysselect");
                $(h).addClass("sysYBtn").siblings("a").removeClass("sysYBtn")
            }
            var o = $(h).attr("nav"), n = $(h).attr("alert");
            if (o) {
                P.Utl.publicChengeModule(c.layout.main, "ajax", c.id, "get_json", "", "", function () {
                    return $.UT.UnParam(o)
                }, true, {FError: function (w, v, r) {
                    var t = v.getback || null, q;
                    if (t == 1) {
                        q = function () {
                            P.Utl.publicChengeModule(c.layout.main, "ajax", "reportForm", "get_html")
                        }
                    }
                    $.UT.NetErrorCallback(w, v, r, q)
                }})
            }
            if (n) {
                var g = '<div id="reportAlert" class="reportAlert"></div>';
                $.UT.Alert({title: "玩法明细", width: "659", text: g, booLean: false});
                $.UT.publicGetAction(c.id, $.UT.UnParam(n), function (r, q) {
                    $("#reportAlert").html(q[0])
                }, "get_json", $.UT.NetErrorCallback)
            }
        }
        if (d.id == "getBack") {
            P.Utl.publicChengeModule(c.layout.main, "ajax", "reportForm", "get_html")
        }
        if (d.tagName == "TD") {
            var f = d.parentNode, p = $(f).attr("bg");
            if (p == "1") {
                $(f).attr("bg", "0").removeAttr("style")
            } else {
                f.style.background = "#cad9ff";
                $(f).attr("bg", "1")
            }
        }
    });
    this.getBack = function (g) {
        var f = g.getback || null;
        if (f == 1) {
            P.Utl.publicChengeModule(c.layout.main, "ajax", "reportForm", "get_html")
        }
    };
    $.UT.HoverList({container: c.table.children().children("tbody"), el: "tr", newClass: "orange"});
    $.UT.Pager({dom: "#reportForm_con .pager", callBack: this.callBack});
    c.reportHideCol(c.table)
};
P.Mod.reportForm_con.prototype.reportHideCol = function (b) {
    var c = this;
    if (!b) {
        return false
    }
    $("thead .hc", b).click(function (g) {
        var f = g.target;
        var d = $("." + f.id);
        if ($(d[0]).css("display") == "none") {
            d.show()
        } else {
            d.hide()
        }
    })
};
P.Mod.reportForm_con.prototype.callBack = function (c) {
    var g = $("#reportForm_con").data("Module"), d, b = {};
    var f = $(".pager").attr("nav");
    $.extend(b, $.UT.UnParam(f));
    if (!c.pager) {
        c.pager = "1"
    }
    g.pager = b.pager = c.pager;
    g.moduleLoader.clearHtmlCache(g.id);
    P.Utl.publicChengeModule(g.layout.main, "ajax", g.id, "get_json", "", "", function () {
        return b
    }, true, {FError: $.UT.NetErrorCallback})
};
P.Mod.reportForm_con.prototype.setData = function () {
};
P.Mod.reportForm = function (f) {
    var g = this;
    this.dom = f;
    this.id = g.dom[0].id;
    this.layout = $("#layout").Module();
    this.moduleLoader = $(g.layout.main).Widget("ModuleLoader");
    this.timesnum = $("#timesNum", f);
    this.beforeDate = $("#beforeDate", f);
    this.laterDate = $("#laterDate", f);
    this.table = $(".reportForm-table", f);
    $("span.re-btn", f).bind("click", function (o) {
        g.moduleLoader.clearHtmlCache(g.id);
        var m = this.id;
        var h = P.Utl.severTime();
        P.Utl.klcTimesChange(g.timesnum);
        var n = $("#allClass").val();
        switch (m) {
            case"thisToday":
                g.beforeDate.val(h.day);
                g.laterDate.val(h.day);
                if (n != "allClass") {
                    $.UT.publicGetAction(g.id, {cpClass: n}, function (p) {
                        if (p.newTimes && n == "sscClass") {
                            P.Utl.sscTimesChange(g.timesnum, p.newTimes)
                        } else {
                            if (p.newTimes && n == "klcClass") {
                                P.Utl.klcTimesChange(g.timesnum, p.newTimes)
                            } else {
                                if (p.newTimes && n == "pk10Class") {
                                    P.Utl.pk10TimesChange(g.timesnum, p.newTimes)
                                } else {
                                    if (p.newTimes && n == "ncClass") {
                                        P.Utl.ncTimesChange(g.timesnum, p.newTimes)
                                    } else {
                                        if (p.newTimes && n == "ksClass") {
                                            P.Utl.ksTimesChange(g.timesnum, p.newTimes)
                                        }
                                    }
                                }
                            }
                        }
                    }, "get_json", $.UT.NetErrorCallback)
                }
                break;
            case"thisYesterday":
                g.beforeDate.val(h.b_day);
                g.laterDate.val(h.b_day);
                if (n == "sscClass") {
                    P.Utl.sscTimesChange(g.timesnum, 24, null, h.b_day)
                } else {
                    if (n == "klcClass") {
                        P.Utl.klcTimesChange(g.timesnum, 84, null, h.b_day)
                    } else {
                        if (n == "pk10Class") {
                            P.Utl.pk10TimesChange(g.timesnum, 179, h.b_day)
                        } else {
                            if (n == "ncClass") {
                                P.Utl.ncTimesChange(g.timesnum, 13, null, h.b_day)
                            } else {
                                if (n == "ksClass") {
                                    P.Utl.ksTimesChange(g.timesnum, 82, null, h.b_day)
                                }
                            }
                        }
                    }
                }
                break;
            case"thisWeek":
                g.beforeDate.val(h.week_b);
                g.laterDate.val(h.week_e);
                break;
            case"lastWeek":
                g.beforeDate.val(h.b_week_b);
                g.laterDate.val(h.b_week_e);
                break;
            case"thisMonth":
                g.beforeDate.val(h.month_b);
                g.laterDate.val(h.month_e);
                break;
            case"lastMonth":
                g.beforeDate.val(h.b_month_b);
                g.laterDate.val(h.b_month_e);
                break
        }
    });
    var d = {rules: {beforeDate: {required: 1, regExp: P.Set.reE}, laterDate: {required: 1, regExp: P.Set.reE}}, onblur: true};
    var b = $(f).Widget("SimpleValidator", d);
    $("#submit", f).bind("click", function (r) {
        var m = b.verifyForm();
        g.moduleLoader.clearHtmlCache(g.id);
        if (m == true) {
            var h = {};
            h.cpClass = $("#allClass").val();
            h.type = $("input[name=type]:checked", g.dom).attr("nav");
            h.beforeDate = $("#beforeDate", g.dom).val();
            h.laterDate = $("#laterDate", g.dom).val();
            h.settlement = $("input[name=settlement]:checked", g.dom).attr("nav");
            h.crf = P.Set.porttype;
            g.beforeDateVal = $("#beforeDate", f).val();
            g.laterDateVal = $("#laterDate", f).val();
            if (g.beforeDateVal === g.laterDateVal) {
                h.times = $("#timesNum", g.dom).val()
            }
            var s = 86400000;
            var o = g.beforeDateVal.split("-");
            var q = g.laterDateVal.split("-");
            var n = +new Date(o[0], o[1] - 1, o[2]);
            var p = +new Date(q[0], q[1] - 1, q[2]);
            if (p < n) {
                $.UT.Alert({text: "开始时间不能大于结束时间!", booLean: false})
            } else {
                P.Utl.publicChengeModule(g.layout.main, "ajax", "reportForm_con", "get_json", "", "", function () {
                    return h
                }, true, {FError: $.UT.NetErrorCallback})
            }
        } else {
            $.UT.Alert({text: "日期验证失败！请确认日期填写正确！", booLean: false})
        }
    });
    $("#laterDate, #beforeDate", g.dom).dateBox({onClose: function () {
        g.valDate()
    }});
    $("#beforeDate", g.dom).dateBox({onClose: function () {
        g.valDate()
    }});
    var c = P.Set.isShowRollOrder;
    if (c == 1) {
        $("#gundandown").css("visibility", "visible");
        $("#guendan,#guendan1").bind("click mouseover mouseout", function (m) {
            var h = "";
            switch (m.type) {
                case"mouseover":
                    $(m.target).addClass("gundan_over");
                    break;
                case"mouseout":
                    $(m.target).removeClass("gundan_over");
                    break;
                case"click":
                    if (m.target.id == "guendan") {
                        $(m.target).removeClass("gundan_over");
                        $(m.target).addClass("gundan_end");
                        h = P.Set.ActionMapping.supervision.download.url.slice(4);
                        if (h) {
                            window.open(h, "_blank")
                        }
                        h = "";
                        $(this).unbind()
                    } else {
                        h = "./klc/common/RollOrderHelp/";
                        window.open(h, "_blank")
                    }
                    break
            }
        })
    } else {
        $("#gundandown").remove()
    }
    this.rebind()
};
P.Mod.reportForm.prototype.valDate = function () {
    var c = new Date(this.beforeDate.val().replace(/-/g, "/"));
    var b = new Date(this.laterDate.val().replace(/-/g, "/"));
    if (c > b) {
        $.UT.Alert({text: "开始时间不能大于结束时间!", booLean: false});
        return false
    }
    return true
};
P.Mod.reportForm.prototype.rebind = function () {
    var b = this;
    setTimeout(function () {
        $("#allClass").val("allClass")
    }, 2);
    $("input[nav=1]", b.dom).attr("checked", true);
    $("input[nav=total]", b.dom).attr("checked", true);
    P.Utl.klcTimesChange(b.timesnum);
    b.b = P.Utl.severTime();
    this.beforeDate.val(b.b.day);
    this.laterDate.val(b.b.day);
    $("#beforeDate,#laterDate,#allClass", b.dom).bind("change", function (d) {
        b.b = P.Utl.severTime();
        var c = $("input[name=cClass]", b.dom);
        var f = $("#allClass").val();
        c.attr("disabled", true);
        P.Utl.klcTimesChange(b.timesnum);
        switch (f) {
            case"allClass":
                break;
            case"sscClass":
            case"klcClass":
            case"pk10Class":
            case"ksClass":
            case"ncClass":
                if (b.beforeDate.val() === b.laterDate.val()) {
                    if (b.beforeDate.val() == b.b.day) {
                        $.UT.publicGetAction(b.id, {cpClass: f}, function (g) {
                            if (g.newTimes && f == "sscClass") {
                                P.Utl.sscTimesChange(b.timesnum, g.newTimes)
                            } else {
                                if (g.newTimes && f == "klcClass") {
                                    P.Utl.klcTimesChange(b.timesnum, g.newTimes)
                                } else {
                                    if (g.newTimes && f == "pk10Class") {
                                        P.Utl.pk10TimesChange(b.timesnum, g.newTimes)
                                    } else {
                                        if (g.newTimes && f == "ncClass") {
                                            P.Utl.ncTimesChange(b.timesnum, g.newTimes)
                                        } else {
                                            if (g.newTimes && f == "ksClass") {
                                                P.Utl.ksTimesChange(b.timesnum, g.newTimes)
                                            }
                                        }
                                    }
                                }
                            }
                            c.removeAttr("disabled")
                        }, "get_json", function (h, m, g) {
                            $.UT.NetErrorCallback(h, m, g);
                            c.removeAttr("disabled")
                        })
                    } else {
                        if (b.beforeDate.val() > b.b.day) {
                            P.Utl.klcTimesChange(b.timesnum)
                        } else {
                            if (f == "sscClass") {
                                P.Utl.sscTimesChange(b.timesnum, 24, null, b.beforeDate.val())
                            } else {
                                if (f == "klcClass") {
                                    P.Utl.klcTimesChange(b.timesnum, 84, null, b.beforeDate.val())
                                } else {
                                    if (f == "pk10Class") {
                                        P.Utl.pk10TimesChange(b.timesnum, 179, b.beforeDate.val())
                                    } else {
                                        if (f == "ncClass") {
                                            P.Utl.ncTimesChange(b.timesnum, 13, null, b.beforeDate.val())
                                        } else {
                                            if (f == "ksClass") {
                                                P.Utl.ksTimesChange(b.timesnum, 82, null, b.beforeDate.val())
                                            }
                                        }
                                    }
                                }
                            }
                        }
                        c.removeAttr("disabled")
                    }
                } else {
                    c.removeAttr("disabled")
                }
                break
        }
    })
};
P.Mod.timeManage = function (b) {
    var c = this;
    this.dom = b;
    this.urlParam = {};
    this.viewPage = $("#viewPage", b);
    this.thisDom = $("#timelist", c.dom);
    this.id = c.dom[0].id;
    $.UT.Pager({dom: ".pager", callBack: c.callBack});
    this.dataJSON = "get_json_" + P.Set.systype;
    $.UT.HoverList({container: c.dom, el: "tr"})
};
P.Mod.timeManage.prototype.openlist = function (f, g) {
    var c = {}, b = f.target, h = this;
    c.key = "subDrawsList";
    c.id = b.id;
    P.Utl.publicChengeModule(P.Set.layout.main, "ajax", "timeManage", "get_html", h.dataJSON, c, null, null, {romances: true})
};
P.Mod.timeManage.prototype.resetOpen = function (f, g) {
    var c = {}, b = f.target, h = this;
    c.key = "open";
    c.id = b.id;
    text = "确定重新开盘吗?";
    $.UT.Alert({text: text, determineCallback: function () {
        if (c !== null) {
            $.UT.publicGetAction(h.id, c, function (d) {
                h.setData(d)
            }, h.dataJSON);
            c = null
        }
    }})
};
P.Mod.timeManage.prototype.closeID = function (f, g) {
    var c = {}, b = f.target, h = this;
    c.key = "close";
    c.id = b.id;
    text = "确定关盘吗?";
    $.UT.Alert({text: text, determineCallback: function () {
        if (c !== null) {
            $.UT.publicGetAction(h.id, c, function (d) {
                h.setData(d)
            }, h.dataJSON);
            c = null
        }
    }})
};
P.Mod.timeManage.prototype.viewComeback = function (f, g) {
    var c = {}, b = f.target, h = this;
    c.key = "drawsList";
    P.Utl.publicChengeModule(P.Set.layout.main, "ajax", "timeManage", "get_html", h.dataJSON, c, null, null, {romances: true})
};
P.Mod.timeManage.prototype.setData = function (g) {
    var m = this, c;
    var p = g.fastOperating || null;
    m.thisDom = $("#timelist", m.dom);
    var h = "";
    if (p) {
        var n = $("tr", m.thisDom)[1];
        var d = $("td", n);
        var q = new Date();
        var f = q.getMonth() >= 9 ? +(q.getMonth() + 1) : "0" + (q.getMonth() + 1);
        var o = q.getDate() >= 10 ? +q.getDate() : "0" + q.getDate();
        var r = q.getFullYear() + "-" + f + "-" + o;
        dateTime = $(d[0]).children().html();
        if (n) {
            if (p == "2") {
                if (r === dateTime) {
                    d.last().html('<a href="javascript:void(0)" id="' + dateTime + '"  bdata="' + dateTime + ',click,resetOpen">开盘</a>');
                    d[3].innerHTML = "关盘"
                }
                $(".fastopening").addClass("fast-opening").removeClass("fast-closing").attr("operate", "yes");
                $(".fastclosing").addClass("fast-closing").removeClass("fast-opening").attr("operate", "no")
            } else {
                if (p == "1" || p == "0") {
                    if (p == "0") {
                        if (r === dateTime) {
                            d.last().html('<a href="javascript:void(0)" id="' + dateTime + '" bdata="' + dateTime + ',click,closeID">关盘</a>');
                            d[3].innerHTML = "等待开盘"
                        }
                    } else {
                        if (r === dateTime) {
                            d.last().html('<a href="javascript:void(0)" id="' + dateTime + '" bdata="' + dateTime + ',click,closeID">关盘</a>');
                            d[3].innerHTML = "开盘"
                        }
                    }
                    $(".fastopening").addClass("fast-closing").removeClass("fast-opening").attr("operate", "no");
                    $(".fastclosing").addClass("fast-opening").removeClass("fast-closing").attr("operate", "yes")
                }
            }
        }
    }
};
P.Mod.timeManage.prototype.callBack = function (c) {
    var f = $("#timeManage").data("Module"), d, b = {};
    if (!c.pager) {
        c.pager = "1"
    }
    f.pager = b.pager = c.pager;
    P.Utl.publicChengeModule(P.Set.layout.main, "ajax", "timeManage", "get_html", f.dataJSON, b, null, null, {romances: true})
};
P.Mod.operationRecord = function (c) {
    var d = this, b = P.Utl.severTime();
    this.dom = c;
    this.urlParam = {};
    $(".bet-table", this.dom).hide();
    $("#selectChange", this.dom).hide();
    this.selectPlay = $("#selectPlay", c);
    this.selectPlaybox = $("#selectPlaybox", c);
    this.sysOPClass = $("#sysOPClass", c);
    this.sysOPClassbox = $("#sysOPClassbox", c);
    this.dateName = $("#dateName", c);
    this.selectTimes = $("#selectTimes", c);
    this.selectTimesbox = $("#selectTimesbox", c);
    this.date = b.day;
    this.b_date = b.b_day;
    this.dateName.val(d.date);
    this.selectType = $("#selectType", c);
    this.sysOPClassbox.hide();
    this.dateName.dateBox();
    setTimeout(function () {
        $.UT.Pager({dom: ".pager", clk_count: 0, callBack: function (f) {
            d.callBack(f)
        }})
    }, 20);
    this.timesChange = function (h, n) {
        if ($("#selectTimes:hidden", c).length > 0) {
            return false
        }
        var g = $("#selectTimes", d.dom), m = "";
        var f = $("#dateName", d.dom).val();
        switch (P.Set.systype) {
            case"klc":
                n = n || "all";
                P.Utl.klcTimesChange(g, h, null, f, n);
                break;
            case"ssc":
                n = n || "all";
                P.Utl.sscTimesChange(g, h, null, f, n);
                break;
            case"pk10":
                n = n || "all";
                P.Utl.pk10TimesChange(g, h, f);
                break;
            case"nc":
                n = n || "all";
                P.Utl.ncTimesChange(g, h, null, f, n);
                break;
            case"ks":
                n = n || "all";
                P.Utl.ksTimesChange(g, h, null, f, n);
                break
        }
        setTimeout(function () {
            var o = P.Utl.severTime();
            if (h) {
                g.val(n);
                if (P.Set.systype == "ssc") {
                    if (h == 24 && o.hours >= 5 && o.hours < 10 && o.day == f) {
                        g.val("all")
                    }
                } else {
                    if (P.Set.systype == "nc") {
                        if (h == 14 && o.hours >= 2 && o.hours < 9 && o.day == f) {
                            g.val("all")
                        }
                    }
                }
            } else {
                g.val("all")
            }
        }, 1)
    };
    $("#dateName", c).bind("change", function (f) {
        d.selectTimes.val("all")
    });
    d.autoOdds_text = $("#sysOPClass option[value='autoOdds']").clone();
    $("#dateName,#selectType,#selectTimes,#selectPlay,#sysOPClass", c).on("change", function (g) {
        G.RequestQueue = {};
        d.urlParam.dateName = (d.dateName.val() == "") ? d.date : d.dateName.val();
        if (!(g.target.id == "selectType")) {
            d.urlParam.selectTimes = d.selectTimes.val()
        }
        $("#sysOPClass option[value='autoOdds']").remove();
        d.urlParam.selectType = d.selectType.val();
        $(".bet-table", c).hide();
        $("#selectChange", c).hide();
        d.selectTimesbox.show();
        d.selectTimes.show();
        d.selectPlaybox.css("display", "none");
        d.sysOPClassbox.hide();
        switch (d.urlParam.selectType) {
            case"oddsChange":
                d.thisDom = $("#oddsChange", c);
                d.selectPlaybox.show();
                break;
            case"stopRecord":
                d.thisDom = $("#stopRecord", c);
                d.selectPlaybox.show();
                break;
            case"memberManage":
                d.thisDom = $("#memberManage", c);
                $("#selectTimesbox", d.dom).hide();
                d.selectTimes.css("display", "none");
                break;
            case"memberManage_new":
                d.thisDom = $("#memberManage_new", c);
                $("#selectTimesbox", d.dom).hide();
                d.selectTimes.css("display", "none");
                break;
            case"openRecord":
                d.thisDom = $("#openRecord", c);
                break;
            case"lotteryResults":
                d.thisDom = $("#lotteryResults", c);
                break;
            case"redeploymentLog":
                d.thisDom = $("#redeploymentLog", c);
                d.sysOPClassbox.hide();
                d.selectPlaybox.show();
                break;
            case"syssetting":
                $("#selectTimesbox").hide();
                d.selectTimes.hide();
                d.thisDom = $("#syssetting", c);
                d.selectPlaybox.show();
                d.sysOPClassbox.show();
                if (P.Set.systype != "ks") {
                    $("#sysOPClass").append(d.autoOdds_text)
                }
                delete d.urlParam.selectTimes;
                break;
            case"statusmanage":
                d.thisDom = $("#statusmanage", c);
                d.selectPlaybox.show();
                break
        }
        if ($(".selectPlay_klc").css("display") != "none" || $(".selectPlay_ssc").css("display") != "none" || $(".selectPlay_pk10").css("display") != "none" || $(".selectPlay_nc").css("display") != "none" || $(".selectPlay_ks").css("display") != "none") {
            d.urlParam.selectPlay = $(".selectPlay_" + P.Set.systype).val()
        } else {
            delete d.urlParam.selectPlay
        }
        if (d.selectType.val() == "memberManage_new") {
            d.urlParam.mtype = 1
        } else {
            delete d.urlParam.mtype
        }
        if (d.sysOPClassbox.css("display") != "none") {
            d.urlParam.sysOPClass = $("#sysOPClass").val();
            switch (d.urlParam.sysOPClass) {
                case"basic":
                case"autoOdds":
                case"covering":
                    d.thisDom = $("#syssetting1", c);
                    d.selectPlaybox.hide();
                    delete d.urlParam.selectPlay;
                    break;
                case"water":
                case"autoDiving":
                case"bettingLimit":
                case"replenishment":
                    d.thisDom = $("#syssetting", c);
                    d.selectPlaybox.show();
                    d.urlParam.selectPlay = $(".selectPlay_" + P.Set.systype).val();
                    break
            }
        } else {
            delete d.urlParam.sysOPClass
        }
        d.thisDom.show().siblings("table").hide();
        var f = "get_json";
        f = "get_json_" + P.Set.systype;
        $.UT.publicGetAction(d.dom[0].id, d.urlParam, function (h) {
            d.setData(h)
        }, f);
        d.did = d.thisDom[0].id
    });
    if (P.Set.level != "0") {
        $("option[value!=memberManage]", this.selectType).remove();
        $(".bet-table", d.dom).hide();
        d.selectTimes.hide();
        d.selectTimesbox.hide();
        d.selectPlaybox.hide();
        $("#memberManage", c).show()
    } else {
        $("#oddsChange", c).show()
    }
    this.thisDom = $("#oddsChange", c);
    this.did = this.thisDom[0].id
};
P.Mod.operationRecord.prototype.setData = function (m) {
    $("select[class^='selectPlay']").hide();
    if ($(".selectPlay_" + P.Set.systype).css("display") == "none") {
        $(".selectPlay_" + P.Set.systype).show()
    }
    if (this.did != this.thisDom[0].id) {
        return false
    }
    var p = m.list;
    var c = m.level;
    var d = $("#total_page", this.dom);
    var f = $("#current_page", this.dom);
    if (d) {
        var r = m.pager;
        d.html(r)
    }
    var s = m.pageNow || null;
    if (f && s) {
        f.val(s)
    } else {
        f.val("1")
    }
    var n = m.timesNum || null;
    var b = m.times || null;
    if (b) {
        this.timesChange(n, b)
    } else {
        this.timesChange(n)
    }
    this.thisDom = $(".bet-table:visible", this.dom);
    var o = "";
    if (p) {
        for (var h = 0; h < p.length; h++) {
            o += "<tr>";
            for (var g = 0; g < p[h].length; g++) {
                o += "<td>" + p[h][g] + "</td>"
            }
            o += "</tr>"
        }
        $("tbody", this.thisDom).html(o)
    } else {
        $("tbody", this.thisDom).html("");
        var q = $("th", this.thisDom).length;
        $("tbody", this.thisDom).html('<tr><td colspan="' + q + '">没有记录</td></tr>');
        $("#selectTimes", this.dom).val("all")
    }
    $.UT.HoverList({container: this.thisDom, el: "tr"});
    if (m.maxid) {
        this.maxid = m.maxid
    }
    if (m.minid) {
        this.minid = m.minid
    }
};
P.Mod.operationRecord.prototype.callBack = function (g) {
    var m = this;
    var h, f = {};
    var b = $("#selectType", this.dom);
    if (!g.pager) {
        g.pager = "1"
    }
    this.pager = f.pager = g.pager;
    f.sysOPClass = $("#sysOPClass:visible", this.dom).val();
    f.dateName = m.urlParam.dateName || $("#dateName", m.dom).val();
    f.selectType = m.urlParam.selectType || $("#selectType", m.dom).val();
    f.selectTimes = m.urlParam.selectTimes || $("#selectTimes", m.dom).val();
    f.selectPlay = m.urlParam.selectPlay || $("#selectPlay", m.dom).val();
    if (f.selectType == "memberManage_new") {
        f.mtype = m.urlParam.mtype
    }
    if (g.otype) {
        var d = g.otype;
        if (d == "previous") {
            f.minid = this.minid || null
        }
        if (d == "next") {
            f.maxid = this.maxid || null
        }
    }
    var c = "get_json_" + P.Set.systype;
    $.UT.publicGetAction(this.dom[0].id, f, null, c)
};
P.Mod.operationRecord.prototype.rebind = function () {
    if (P.Set.level == "0") {
        $("table", this.dom).hide();
        $("#oddsChange", this.dom).show();
        $("#dateName", this.dom).val(this.date);
        $("#selectType", this.dom).val("oddsChange");
        $("#selectTimes", this.dom).val("all").show();
        $("#selectPlay", this.dom).val("allplay");
        $("#sysOPClassbox", this.dom).hide();
        this.selectPlaybox.show();
        this.selectTimesbox.show();
        $("#current_page", this.dom).val(1);
        $("#total_page", this.dom).html(1)
    }
    var b = this;
    b.thisDom = $("#oddsChange", b.dom);
    b.thisDom[0].id = "oddsChange";
    b.did = b.thisDom[0].id;
    delete b.urlParam.dateName;
    delete b.urlParam.selectType;
    delete b.urlParam.selectTimes;
    delete b.urlParam.selectPlay;
    $("#current_page", this.dom).val(1);
    $("#total_page", this.dom).html(1)
};
P.Mod.operationRecord.prototype.unbind = function () {
    if (P.Set.level == "0") {
        $(".bet-type").first().attr("selected", true);
        $(".bet-type span").show();
        $("#dateName", this.dom).val(this.date);
        $("#sysOPClassbox").hide()
    }
};
P.Mod.basicSettings = function (f) {
    var h = this, d;
    this.dom = f;
    this.id = f[0].id;
    if (P.Set.systype == "ssc") {
        this.closetimeb = $("#closetimeb", f);
        this.closetimeh = $("#closetimeh", f);
        d = {rules: {vdinput10: {max: 120, regExp: /^[1-9]\d{1,2}$/, min: 60}, vdinput11: {max: 120, regExp: /^[1-9]\d{1,2}$/, min: 60}}, onblur: true, errorMessages: {vdinput10: {max: "时间范围为60~120", min: "时间范围为60~120", regExp: "时间为正整数"}, vdinput11: {max: "时间范围为60~120", min: "时间范围为60~120", regExp: "时间为正整数"}}}
    } else {
        this.theme = $("#theme", f);
        this.closetime = $("#closetime", f);
        var c = 120, g = 60;
        if (P.Set.systype == "ks") {
            c = 180;
            g = 60
        }
        d = {rules: {vdinput10: {max: c, min: g, regExp: /^[1-9]\d{1,2}$/}}, onblur: true, errorMessages: {vdinput10: {max: "时间范围为" + g + "~" + c, min: "时间范围为" + g + "~" + c, regExp: "时间为正整数"}}, methods: {more: function (n, q, m) {
            var o = Number($(n).val());
            var p = Number($(m.els[q]).val());
            return(o > p)
        }}}
    }
    var b = f.Widget("SimpleValidator", d);
    $("#sbmit", f).bind("click", function (p) {
        var n = b.verifyForm();
        this.delLowerUser = $("input[name='delLowerUser']:checked", f);
        if (n != true) {
            return
        }
        var o = P.Utl.isValueChange(h.id);
        if (!o) {
            return false
        }
        var m = {};
        if (P.Set.systype == "ssc") {
            m.creditModel = 0;
            m.closetimeb = h.closetimeb.val();
            m.closetimeh = h.closetimeh.val()
        } else {
            m.theme = h.theme.val();
            m.lianma = 10;
            m.creditModel = 0;
            m.closetime = h.closetime.val()
        }
        m.delLowerUser = this.delLowerUser.attr("id").substring(12);
        if (document.getElementById("model1").checked == true) {
            m.creditModel = 1
        }
        $.UT.publicGetAction(h.dom[0].id, m, function (q) {
            $.UT.Alert({text: q.succ, booLean: false});
            P.Utl.isValueChange(h.id, 1)
        }, "", "", "", "", {button: "#sbmit"})
    });
    f.delegate("input", "keypress", function (m) {
        if (m.keyCode == 13) {
            $("#sbmit").click()
        }
    })
};
P.Mod.basicSettings.prototype.setData = function (b) {
    this.first = 1;
    var c = this;
    if (b != null) {
        if (P.Set.systype == "ssc" && b.closetimeb && b.closetimeh) {
            c.closetimeb.val(b.closetimeb);
            c.closetimeh.val(b.closetimeh)
        } else {
            if (b.theme && b.closetime) {
                c.theme.val(b.theme);
                c.closetime.val(b.closetime)
            }
            if (b.closetime) {
                c.closetime.val(b.closetime)
            }
        }
    }
    if (b.creditModel) {
        if (b.creditModel == 1) {
            document.getElementById("model1").checked = true
        } else {
            document.getElementById("model2").checked = true
        }
    }
    if (b.delLowerUser && b.delLowerUser == 1) {
        document.getElementById("delLowerUser1").checked = true
    } else {
        document.getElementById("delLowerUser0").checked = true
    }
    this.cacheValue = 1;
    if (this.cacheValue == 1) {
        $("#basicSettings").data("valuelist", "");
        P.Utl.isValueChange(c.id, 1);
        this.cacheValue == 0
    }
};
P.Mod.basicSettings_pk10 = P.Mod.basicSettings;
P.Mod.basicSettings_sc = P.Mod.basicSettings;
P.Mod.basicSettings_nc = P.Mod.basicSettings;
P.Mod.basicSettings_ks = P.Mod.basicSettings;
P.Mod.marqueeSettings = function (d) {
    var f = this;
    this.dom = d;
    this.id = d[0].id;
    var c = {rules: {newannouncement: {weibo_length: ["newannouncement", 1000, ""]}}, onblur: false, errorMessages: {newannouncement: {weibo_length: "公告设置已超过1000个字符！"}}};
    var b = "<select><option value='-1'>所有人</option><option value='0'>管理层</option><option value='1'>分公司</option><option value='2'>股东</option><option value='3'>总代理</option><option value='4'>代理</option><option value='5'>会员</option></select>  ";
    $(".new", d).bind("click", function () {
        var g = P.Set.systype, h = g == "klc" ? "get_json" : g == "ssc" ? "get_json_ssc" : g == "pk10" ? "get_json_pk10" : "get_json_nc";
        var m = $.UT.Alert({text: "<textarea id='newannouncement' class='announcement-textarea' vname='newannouncement' vmessage=''></textarea><p>剩余字数:<span class='reder fontsizec'>1000</span></p><p class='aa'>" + b + "<input type='checkbox' checked='checked' id='alertbox1'/>&nbsp;登录弹窗</p><p class='reder'>公告设置不超过1000个字符！</p>", title: "新增公告信息", booLean: false, validate: c, determineCallback: function () {
            var o = letterformat($("#newannouncement").val(), 1), n = $("#alertbox1").attr("checked") == "checked" ? "true" : "false", p = $(".aa select").val();
            $.UT.publicGetAction(f.dom[0].id, {action: "new", text: $.trim(o), popup: n, level: p}, function (q) {
                f.setData(q)
            }, h)
        }, cFunction: function () {
            var n = $.trim($("#newannouncement").val());
            if (n.length > 1000) {
                alert("公告设置已超过1000个字符")
            } else {
                if (n.length == 0) {
                    alert("公告设置不为空")
                }
            }
        }, width: 600, height: 380});
        $("#newannouncement").bind("keyup", function (r) {
            var p = r.keyCode;
            if (p != 13) {
                var n = $.trim(this.value).length, q = 1000 - n;
                $(".fontsizec").html(q > 0 ? q : 0)
            } else {
                var s = $.trim($("#newannouncement").val()), o = $("#alertbox1").attr("checked") == "checked" ? "true" : "false", t = $(".aa select").val();
                if (s.length > 0 && s.length < 1001) {
                    $.UT.publicGetAction(f.dom[0].id, {action: "new", text: letterformat(s, 1), popup: o, level: t}, function (v) {
                        f.setData(v)
                    }, h);
                    m.close()
                } else {
                    if (s.length >= 1001) {
                        alert("公告设置已超过1000个字符")
                    }
                }
            }
        })
    });
    $("#announcementbox", d).bind("click", function (t) {
        var p = t.target, q = p.className, v = p.parentNode, g = v.parentNode, n = g.id, w = P.Set.systype, y = w == "klc" ? "get_json" : w == "ssc" ? "get_json_ssc" : w == "pk10" ? "get_json_pk10" : "get_json_nc";
        if (g.cells) {
            var z = g.cells[1].getElementsByTagName("div")[0].innerHTML, r = {action: q};
            switch (q) {
                case"view":
                    $.UT.Alert({text: "<textarea disabled='disabled' class='announcement-textarea'>" + z + "</textarea>", title: "查看公告信息", booLean: false, width: 600, height: 380});
                    break;
                case"set":
                    var m = $("input", g).attr("checked") == "checked" ? "checked='checked'" : "", x = $("input", g).attr("checked") == "checked" ? "true" : "false", o = $(g).attr("level"), s = $.UT.Alert({text: "<textarea id='newannouncement' class='announcement-textarea'>" + z + "</textarea><p>剩余字数:<span class='reder fontsizec'>" + (1000 - parseInt(z.length, 10)) + "</span></p><p class='aa'>" + b + "<input type='checkbox' " + m + " id='alertbox1'/>&nbsp;登录弹窗</p><p class='reder'>公告设置不超过1000个字符！</p>", title: "修改公告信息", validate: {rules: {newannouncement: {weibo_length: ["newannouncement", 1000, z]}}, onblur: false, errorMessages: {newannouncement: {weibo_length: "公告设置已超过1000个字符！"}}}, determineCallback: function () {
                        var B = letterformat($("#newannouncement").val(), 1), A = $("#alertbox1").attr("checked") == "checked" ? "true" : "false", C = $(".aa select").val();
                        $.UT.publicGetAction(f.dom[0].id, {action: "set", id: n, text: $.trim(B), popup: A, level: C}, function (D) {
                            f.setData(D);
                            s.close()
                        }, y)
                    }, buttonBL: false, width: 600, height: 380, cFunction: function () {
                        var B = $.trim($("#newannouncement").val()), D = $(".aa select").val(), A = $("#alertbox1").attr("checked") == "checked" ? "true" : "false";
                        if (B.length == 0) {
                            alert("公告内容不能为空！")
                        }
                        if (B.length > 1000) {
                            alert("公告设置已超过1000个字符")
                        } else {
                            if (o != D || A != x) {
                                var C = letterformat(B, 1);
                                $.UT.publicGetAction(f.dom[0].id, {action: "set", id: n, text: C, popup: A, level: D}, function (E) {
                                    s.close();
                                    f.setData(E)
                                }, y)
                            } else {
                                alert("请做修改后再保存")
                            }
                        }
                    }});
                    $(".aa select").val(o);
                    $("#newannouncement").bind("keyup", function (E) {
                        var C = E.keyCode;
                        if (C != 13) {
                            var A = $.trim(this.value).length, D = 1000 - A;
                            $(".fontsizec").html(D > 0 ? D : 0)
                        } else {
                            var F = $.trim($("#newannouncement").val()), B = $("#alertbox1").attr("checked") == "checked" ? "true" : "false", H = $(".aa select").val();
                            if (F.length > 0 && F.length < 1001) {
                                if (o != H || B != x || F != z) {
                                    $.UT.publicGetAction(f.dom[0].id, {action: "set", id: n, text: letterformat(F, 1), popup: B, level: H}, function (I) {
                                        f.setData(I)
                                    }, y);
                                    s.close()
                                } else {
                                    alert("请做修改后再保存")
                                }
                            } else {
                                if (F.length >= 1001) {
                                    alert("公告设置已超过1000个字符")
                                }
                            }
                        }
                    });
                    break;
                case"delete":
                    $.UT.Alert({text: "确认删除这条公告信息！", title: "删除公告信息", determineCallback: function () {
                        $.UT.publicGetAction(f.dom[0].id, {action: "del", id: n, pager: $("#current_page").val()}, function (A) {
                            f.setData(A)
                        }, y)
                    }});
                    break;
                case"popup":
                    var h = $(p).attr("checked") == "checked" ? "true" : "false";
                    $.UT.publicGetAction(f.dom[0].id, {action: "popup", id: n, popup: h, pager: $("#current_page").val()}, function (A) {
                        f.setData(A)
                    }, y);
                    break
            }
        }
    });
    $(".m-a-box input").bind("click", function () {
        var g = this.className;
        if (g == "announcement-btn") {
            $(".marqueesetbox").hide();
            $(".announcementsetBox").show()
        } else {
            $(".marqueesetbox").show();
            $(".announcementsetBox").hide()
        }
    });
    $.UT.Pager({dom: ".pager", callBack: f.callBack})
};
P.Mod.marqueeSettings.prototype.callBack = function (c) {
    var g = $("#marqueeSettings").data("Module"), f, b = {}, d = P.Set.systype == "klc" ? "get_json" : "get_json_ssc";
    if (!c.pager) {
        c.pager = "1"
    }
    g.pager = b.pager = c.pager;
    $.UT.publicGetAction(g.dom[0].id, b, g.setData, d)
};
P.Mod.marqueeSettings.prototype.setData = function (c) {
    var f = this, o = "";
    if (c.announcement) {
        var p = c.announcement, g = p.length, m = ["所有人", "管理层", "分公司", "股东", "总代理", "代理", "会员"];
        for (var d = 0; d < g; d++) {
            var n = p[d], b = parseInt(n[4]), h = m[b + 1];
            o += "<tr id='" + n[0] + "' level='" + b + "'><td>" + n[1] + "</td><td><div class='infos'>" + letterformat(n[2], 0) + "</div></td><td>" + h + "</td><td><input type='checkbox' " + (n[3] == "true" ? "checked='checked'" : "") + " class='popup'/></td><td class='fixedwidth105'><span class='view'>查看</span><span class='set'>修改</span><span class='delete'>删除</span></td></tr>"
        }
        $("#announcementbox").html(o);
        $.UT.HoverList({container: "#announcementbox", el: "tr"})
    }
    $("#current_page").val(c.pageNow || 1);
    $("#total_page").html(c.pager || 1)
};
function letterformat(c, b) {
    if (b) {
        return c.replace(/"/g, "ahrrncj2012")
    } else {
        return c.replace(/ahrrncj2012/g, '"')
    }
}
P.Mod.settingsNav = function (b) {
    var c = this;
    this.dom = b;
    this.Li = $("li", b);
    c.Li.hide();
    this.layout = $("#layout").data("Module");
    $(b).bind("click", function (g) {
        var f = g.target, d = f.getAttribute("subnav");
        if (f.nodeName === "LI") {
            $(f).addClass("on").siblings().removeClass("on")
        }
        c.changeSubNav(d)
    });
    $.UT.HoverList({container: c.dom, el: "li"})
};
P.Mod.settingsNav.prototype.setData = function (b) {
    var d = this, c = P.Set.level;
    if (c == "0") {
        $(d.Li[0]).addClass("on").siblings().removeClass("on");
        d.Li.show();
        d.changeSubNav("basic")
    } else {
        $(d.Li[5]).show().addClass("on").siblings().remove();
        d.changeSubNav("replenishment")
    }
    if (P.Set.systype == "ks") {
        $("li[subnav='oddReduce']").hide()
    }
};
P.Mod.settingsNav.prototype.changeSubNav = function (f) {
    var h = this, g = "", d = "", c = "get_json";
    switch (P.Set.systype) {
        case"klc":
            g = "";
            d = "span";
            break;
        case"ssc":
            g = "_sc";
            d = "";
            c = "get_json_ssc";
            break;
        case"pk10":
            g = "_pk10";
            d = "";
            c = "get_json_pk10";
            break;
        case"nc":
            g = "_nc";
            d = "";
            c = "get_json_nc";
            break;
        case"ks":
            g = "_ks";
            d = "";
            c = "get_json_ks"
    }
    switch (f) {
        case"basic":
            P.Utl.publicChengeModule(h.layout.right, "ajax", "basicSettings" + g, "get_html", "get_json");
            break;
        case"marquee":
            P.Utl.publicChengeModule(h.layout.right, "ajax", "marqueeSettings", "get_html", c);
            break;
        case"water":
            P.Utl.publicChengeModule(h.layout.right, "ajax", "waterLevel" + g, "get_html", "get_json");
            break;
        case"autoOdds":
            P.Utl.publicChengeModule(h.layout.right, "ajax", "autoOdds" + g, "get_html", "get_json");
            break;
        case"bettingLimits":
            P.Utl.publicChengeModule(h.layout.right, "ajax", "bettingLimits" + g, "get_html", "get_json");
            break;
        case"replenishment":
            P.Utl.publicChengeModule(h.layout.right, "ajax", "replenishment" + g, "get_html", "get_json");
            break;
        case"oddReduce":
            P.Utl.publicChengeModule(h.layout.right, "ajax", "oddReduce" + g, "get_html", "get_json");
            break;
        case"corporationBH":
            P.Utl.publicChengeModule(h.layout.right, "ajax", "corporationBH", "get_html", c);
            var b = $("#corporationBH").Module();
            if (b) {
                b.rebind()
            }
            break
    }
    $(d + ".g-vd-error").removeClass("g-vd-error");
    $(d + ".g-vd-s-error").removeClass("g-vd-s-error");
    $(d + ".g-vd-s-pass").removeClass("g-vd-s-pass")
};
P.Mod.change_password = function (c) {
    var d = this, b = c.Widget("SimpleValidator");
    this.dom = c;
    this.oldpassword = $("#oldpassword", c).focus();
    this.newpassword = $("#newpassword", c);
    this.renewpassword = $("#renewpassword", c);
    this.submit = $("#submit", c).bind("click", function (m) {
        var f = b.verifyForm();
        if (f == true) {
            var g = $("#layout").data("Module"), h = {};
            h.oldpassword = d.oldpassword.val();
            h.newpassword = d.newpassword.val();
            h.renewpassword = d.renewpassword.val();
            $.UT.publicGetAction(d.dom[0].id, h, null, null, function (o, p, n) {
                if (n == 2) {
                    $.UT.DefaultErrorCallback(o, p, n, function () {
                        if (P.Set.firstLogin) {
                            $(".main-nav ul li").show();
                            $("#select_sys").show();
                            $(".fast-closing,.fast-opening").show();
                            g.setLayout(P.Set.moduleNav);
                            if (P.Set.navNum == 12) {
                                $(".main-nav ul li.on").removeClass("on")
                            }
                            P.Utl.accessControl();
                            if (p.pa) {
                                P.Set.pa = p.pa
                            }
                            if (p.ui) {
                                P.Set.ui = p.ui
                            }
                            if (p.pw) {
                                P.Set.pw = p.pw
                            }
                        } else {
                            P.Set.firstLogin = 0
                        }
                    }, null, false)
                } else {
                    $.UT.DefaultErrorCallback(o, p, n)
                }
            })
        } else {
            return false
        }
    });
    if (P.Set.firstLogin === 1) {
        $("#reset", c).html("取消");
        this.reset = $("#reset", c).bind("click", function () {
            var f = $("#logout").attr("href");
            window.location.href = f;
            return false
        })
    } else {
        $("#reset", c).html("重置");
        this.reset = $("#reset", c).bind("click", function () {
            d.oldpassword.val("");
            d.newpassword.val("");
            d.renewpassword.val("");
            $(".g-vd-s-error").removeClass("g-vd-s-error")
        })
    }
    $(c).bind("keypress", function (f) {
        if (13 === f.keyCode && f.target.id !== "reset") {
            d.submit.click()
        }
    })
};
P.Mod.change_password.prototype.unbind = function () {
    $("input", this.dom).val("");
    $("#header a[nav=changePassword]").closest("li").removeClass("on")
};
P.Mod.infop = function (b) {
    this.dom = b;
    $.UT.HoverList({container: "#infop", el: "td"});
    this.changemod = function () {
        var c = P.Set.systype;
        if (c == "ssc") {
            $("#infop_ssc").show().siblings().hide()
        } else {
            $("#infop_klc").show().siblings().hide()
        }
    };
    this.changemod();
    $("#select_sys").bind("changesys", this.changemod)
};
P.Mod.notice = function (b) {
    var c = this;
    this.dom = b;
    $("#notice_rule", b).bind("click", function () {
        $("#notice_rule_txt").toggleClass("hidden")
    })
};
P.Mod.notice.prototype.setData = function (h) {
    var g, d, c, n, b, f = "";
    if (h.list) {
        $("#newNotice").html("");
        for (g = 0, d = h.list.length; g < d; g++) {
            b = h.list[g];
            f += "<div class='title'>" + b.date + "</div>";
            f += "<ul class='txt'>";
            for (c = 0, n = b.content.length; c < n; c++) {
                f += "<li>" + b.content[c] + "</li>"
            }
            f += "</ul>"
        }
        $("#newNotice").html(f)
    }
    if (h.cname) {
        document.getElementById("company_name").innerHTML = h.cname
    }
};
P.Mod.supervision = function (h) {
    this.play = "sumDT";
    this.playname = "正码";
    this.sortdataObject = {};
    P.Mod.supervision_sc.prototype.init.call(this, h);
    $("#showYk").bind("change", function () {
        var f = this.value;
        if (f == 1) {
            $(".numbersort").show();
            $(".number18 table").width("33.1%");
            $(".ycsort div")[0].innerHTML = "<b class='reder'>按亏损排行</b>";
            $(".ycsort").css({background: "#FCF7BF"})
        } else {
            if (f == 2) {
                $(".numbersort").hide();
                $(".number18 table").width("49.8%");
                $(".ycsort div")[0].innerHTML = "<ul><li class='s-m-w-1 s-m-w-1-color'>号码</li><li class='s-m-w-2 s-m-w-1-color'>赔率</li><li class='s-m-w-3 s-m-w-1-color'>注额</li><li class='s-m-w-3 s-m-w-1-color'>盈亏</li></ul>";
                $(".ycsort").css({background: "none"})
            }
        }
    });
    var q = $("tr[number]", ".numbersort"), p = $(".lmianlhlm tr[number]", ".number18"), n = q.length, o = {};
    var c = $("tr[number]", ".longhu_zm"), r = {};
    for (var g = 0; g < n; g++) {
        var b = q[g];
        o["tr" + b.getAttribute("number")] = b
    }
    for (var m = 0, d = p.length; m < d; m++) {
        var b = p[m];
        o["tr" + b.getAttribute("number")] = b
    }
    for (var m = 0, d = c.length; m < d; m++) {
        var b = c[m];
        r["tr" + b.getAttribute("number")] = b
    }
    this.alltr = o;
    this.longhu = r
};
P.Mod.supervision.prototype.setData = function (h) {
    P.Mod.supervision_sc.prototype.cSetData.call(this, h);
    var p = h.supervision;
    if (h.omission) {
        var f = $("#yilou").val();
        $("#yilouContain").html(f);
        var s = $(".omission");
        var o = h.omission.length;
        if (o > 0) {
            for (var m = 0, d, r; m < o; m++) {
                d = h.omission[m];
                r = parseInt(d) >= 5 ? "<strong class='reder'>" + d + "</strong>" : d;
                s[m] ? s[m].innerHTML = r : ""
            }
        }
    }
    if (p) {
        var g = p, m;
        for (m in g) {
            var d = g[m], q = $(".longhu_zm").css("display") == "block" ? this.longhu["tr" + m.slice(3, 5)] : this.alltr["tr" + m.slice(3, 5)];
            if (q) {
                q.setAttribute("playtype", m.slice(0, 3));
                var b = $(".sup-line", q);
                P.Utl.changeColor($(b[0]), d[0], null, "#001188", "red");
                if (d.length >= 4) {
                    q.style.background = "none";
                    q.setAttribute("status", 1);
                    b[1].innerHTML = d[1];
                    b[2].innerHTML = d[2];
                    parseInt(d[2]) < 0 ? $(b[2]).css("color", "red") : $(b[2]).css("color", "#000");
                    if (d[3] == "0") {
                        q.style.background = "#E1D6AB";
                        q.setAttribute("status", 0)
                    }
                    $(b[2]).attr("buhuo_sum", d[4] || 0)
                } else {
                    if (d.length == 2) {
                        q.style.background = "none";
                        if (d[1] == "0") {
                            q.style.background = "#E1D6AB";
                            q.setAttribute("status", 0)
                        }
                    }
                }
            }
        }
    }
    if (h.evencode) {
        var g = h.evencode;
        $.each(g, function (t, x) {
            var w = $("tr[playtype=" + t.slice(0, 3) + "]");
            if (w.length == 0) {
                return
            }
            var v = $(".sup-line", w);
            P.Utl.changeColor($(v[0]), x[0], null, "#001188", "red");
            if (x.length >= 4) {
                w[0].style.background = "none";
                $(v[1]).html(x[1]);
                w.attr("status", 1);
                if (x[3] == "0") {
                    w.css("background", "#E1D6AB").attr("status", 0)
                }
            } else {
                if (x.length == 2) {
                    w.css("background", "none").attr("status", 1);
                    if (x[1] == "0") {
                        w.css("background", "#E1D6AB").attr("status", 0)
                    }
                }
            }
        })
    }
    if (h.sortdata) {
        var c = h.tongji || 0;
        this.sortdata(h.sortdata, c)
    }
    h = null
};
P.Mod.supervision.prototype.sortdata = function (B, f) {
    var h = $(".ycsort tr[number]"), v = B.length;
    if (v > 0) {
        for (var r = 0; r < 20; r++) {
            var p = B[r], b = this.alltr["tr" + p[0].slice(3, 5)];
            if (b) {
                b.setAttribute("playtype", p[0].slice(0, 3));
                var q = $(".sup-line", b);
                q[0].innerHTML = p[1];
                P.Utl.changeColor($(q[0]), p[1], null, "#001188", "red");
                if (p.length >= 5) {
                    b.style.background = "none";
                    b.setAttribute("status", 1);
                    q[1].innerHTML = p[2];
                    q[2].innerHTML = p[3];
                    parseInt(p[3]) < 0 ? $(q[2]).css("color", "red") : $(q[2]).css("color", "#000");
                    if (p[4] == "0") {
                        b.style.background = "#E1D6AB";
                        b.setAttribute("status", 0)
                    }
                    $(q[2]).attr("buhuo_sum", p[5] || 0)
                } else {
                    if (p.length == 3) {
                        b.style.background = "none";
                        b.setAttribute("status", 1);
                        if (p[2] == "0") {
                            b.style.background = "#E1D6AB";
                            b.setAttribute("status", 0)
                        }
                    }
                }
            }
        }
        B.sort(function (C, n) {
            return parseInt((C[3] + "").replace(/,/g, "")) - parseInt((n[3] + "").replace(/,/g, ""))
        });
        var x = new Date();
        var y = {};
        for (var d = 0; d < 20; d++) {
            var g = B[d][0].slice(3, 5);
            y[B[d][0]] = B[d][1]
        }
        var o = P.Utl.compareObjects(this.sortdataObject, y);
        this.sortdataObject = o.new_obj;
        for (var s = 0; s < 20; s++) {
            var p = B[s], b = h[s];
            if (b) {
                var c = p[0].slice(3, 5);
                b.setAttribute("playtype", p[0].slice(0, 3));
                b.setAttribute("number", c);
                var w = b.cells[0];
                w.innerHTML = c;
                w.className = parseInt(c) >= 19 ? "ball-color ball-bc" : "ball-color";
                var q = $(".sup-line", b);
                q[0].innerHTML = p[1];
                q[0].style.color = "#001188";
                if (p.length >= 5) {
                    b.style.background = "none";
                    b.setAttribute("status", 1);
                    q[1].innerHTML = p[2];
                    q[2].innerHTML = p[3];
                    parseInt(p[3]) < 0 ? $(q[2]).css("color", "red") : $(q[2]).css("color", "#000");
                    if (p[4] == "0") {
                        b.style.background = "#E1D6AB";
                        b.setAttribute("status", 0)
                    }
                    $(q[2]).attr("buhuo_sum", p[5] || 0)
                } else {
                    if (p.length == 3) {
                        b.style.background = "none";
                        b.setAttribute("status", 1);
                        if (p[2] == "0") {
                            b.style.background = "#E1D6AB";
                            b.setAttribute("status", 0)
                        }
                    }
                }
            }
        }
        if (!jQuery.isEmptyObject(o.change_obj)) {
            for (var t in o.change_obj) {
                var c = t.slice(3, 5);
                var z = $(".ycsort tr[number='" + c + "']").find(".line1")[0];
                z.style.color = "red";
                var m = setTimeout(function () {
                    z.style.color = "#001188";
                    clearTimeout(m)
                }, 3000)
            }
        }
        var A = $(".total-tongji b");
        if (A && A[0]) {
            A[0].innerHTML = f;
            A[1].innerHTML = B[0][3];
            A[2].innerHTML = B[19][3]
        }
    }
};
P.Mod.supervision.prototype.setDataOnly = function (d) {
    var b = d.supervision, h = this;
    if (b) {
        for (i in b) {
            var g = b[i], c;
            if ($(".longhu_zm").css("display") == "block") {
                c = $(".longhu_zm tr[number=" + i.slice(3, 5) + "]")
            } else {
                c = $("tr[number=" + i.slice(3, 5) + "]")
            }
            if (c.length > 0) {
                var f = c.find(".line1");
                f.html(g[0]);
                P.Utl.changeColor(f, g[0], null, "#001188", "red");
                if (g.length > 1) {
                    c.css("background", "none").attr("status", 1);
                    if (g[1] == "0") {
                        c.css("background", "#E1D6AB").attr("status", 0)
                    }
                }
            }
        }
    }
    if (d.evencode) {
        var b = d.evencode;
        $.each(b, function (m, q) {
            var o = $("tr[playtype=" + m.slice(0, 3) + "]");
            if (h.level == 0) {
                if (o.length > 0) {
                    o.css("background", "none").attr("status", 1);
                    if (q[1] && q[1] != "1") {
                        o.css("background", "#E1D6AB").attr("status", 0)
                    }
                    var p = $(".sup-line", o);
                    P.Utl.changeColor($(p[0]), q[0], null, "#001188", "red")
                }
            } else {
                if (o.length > 1) {
                    o.css("background", "none").attr("status", 1);
                    if (q[1] == "0") {
                        o.css("background", "#E1D6AB").attr("status", 0)
                    }
                    var p = $(".sup-line", o);
                    P.Utl.changeColor($(p[0]), q[0], null, "#001188", "red")
                }
            }
        })
    }
};
P.Mod.supervision.prototype.timeRefresh = function (b) {
    var f = this, d = {handicap: f.handicap, buhuoStatus: f.buhuoStatus};
    f.play ? d.play = f.play : "";
    var c = this.level == 0 ? "get_json" : "get_json_zjs";
    $.UT.publicGetAction(f.id, d, function (g) {
        f.setData(g)
    }, c, b ? function () {
    } : null);
    if (f.autoRefresh) {
        f.autoRefresh.show(f.timeValue.val())
    }
};
P.Mod.supervision.prototype.ajax_getPage = function (b, f) {
    var g = this, c = this.level == 0 ? "detail" : "detail_zjs";
    $.UT.publicGetAction(g.id, f, function (d) {
        var h = g.zdetail(d);
        $(".requestData .data-contain", g.alert.dom).html(h);
        $.UT.HoverList({container: ".requestData", el: "tr"})
    }, c)
};
P.Mod.supervision.prototype.getPage = function (b, g) {
    var h = this;
    var c = parseInt($("#total_page").text());
    var f = parseInt($("#current_page").val());
    $(".first").click(function () {
        g.pager = 1;
        h.ajax_getPage(b, g)
    });
    $(".last").click(function () {
        var d = parseInt($("#total_page").text());
        g.pager = d;
        h.ajax_getPage(b, g)
    });
    $(".next").click(function () {
        var d = parseInt($("#total_page").text());
        var m = parseInt($("#current_page").val());
        if (m < d) {
            g.pager = m + 1;
            h.ajax_getPage(b, g)
        }
    });
    $(".previous").click(function () {
        var d = parseInt($("#current_page").val());
        if (d > 1) {
            g.pager = d - 1;
            h.ajax_getPage(b, g)
        }
    });
    $("#current_page")[0].onkeypress = function (n) {
        var d = (window.event || n).keyCode;
        if (d == 13) {
            var m = parseInt($("#total_page").text());
            f = parseInt(this.value);
            if (f > 0 && f <= m && !isNaN(f)) {
                g.pager = f;
                h.ajax_getPage(b, g)
            } else {
                alert("您输入的数字只能在 1 ～ " + m + "之间的正整数，请重新输入")
            }
        }
    }
};
P.Mod.supervision.prototype.zdetail = function (n) {
    var g = n.pager ? n.pager["total"] : 1, q = n.list || [], h = "", p = q.length, c = n.total ? n.total[0] : 0, w = n.total ? n.total[1] : 0, v = n.pager_total ? n.pager_total[0] : 0, s = n.pager_total ? n.pager_total[1] : 0, o = n.pager ? n.pager["current"] : "1";
    if (p > 0) {
        for (var m = 0; m < p; m++) {
            var t = "";
            li = q[m];
            if (li[14] == "0") {
                t = "class = del"
            }
            var r = li[14] == "1" ? "正常" : "取消";
            h += "<tr><td>" + li[0] + "</td><td>" + li[1] + "盘</td><td>" + li[2] + "</td><td>" + li[3] + "</td><td>" + li[4] + "</td><td>" + li[5] + "</td><td>" + li[6] + "</td><td>" + li[7] + "</td><td>" + li[8] + "</td><td id='x" + li[0] + "' " + t + ">" + li[9] + "</td><td>" + li[10] + "</td><td>" + li[11] + "</td><td id='s" + li[0] + "' " + t + ">" + li[12] + "</td><td>" + li[13] + "</td><td id='c" + li[0] + "'>" + r + "</td></tr>"
        }
    }
    $("#current_page").val(o);
    $("#total_page").html(g);
    var f = "<table id='supervision_alert_3' class='clear-table'><thead><tr class='like-th'><td>注单号</td><td>盘口</td><td>玩法</td><td>会员</td><td>代理</td><td>总代理</td> <td>股东</td> <td>分公司</td> <td>时间</td><td>下注金额</td><td>赔率</td> <td>退水(%)</td> <td>占成收入</td>  <td>补货</td> <td>注单状态</td> </tr></thead>";
    var d = "<tfoot><tr ><th colspan='5'>小计</th><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>" + v + "</td><td>&nbsp;</td><td>&nbsp;</td><td>" + s + "</td><td>&nbsp;</td><td>&nbsp;</td></tr>";
    var b = "<tr ><th colspan='5'>总计</th><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>" + c + "</td><td>&nbsp;</td><td>&nbsp;</td><td>" + w + "</td><td>&nbsp;</td><td>&nbsp;</td></tr></tfoot>";
    return f + h + d + b
};
P.Mod.supervision.prototype.unbind = function () {
    var c = this, b = P.Set.systype;
    if (c.autoRefresh) {
        c.autoRefresh.hide()
    }
    if (c.alert) {
        delete c.alert
    }
    c.autoRefresh.data.play = "sumDT";
    c.autoRefresh.data.handicap = "A";
    c.handicap = "A";
    c.play = "sumDT";
    c.playname = b == "klc" ? "正码" : "正码";
    c.buhuoStatus = 1;
    $("#showYk")[0].options[0].selected = true;
    $(".line1").removeData("odds").removeAttr("firstLogin").html("");
    $(".opts").html($("#longhu_opt").val());
    $(".numbersort").show();
    $(".number18 table").width("33.1%");
    $(".ycsort div")[0].innerHTML = "<b class='reder'>按亏损排行</b>";
    $(".ycsort").css({background: "#FCF7BF"});
    $(".c-area").hide();
    $(".longhu_zm").show();
    $("#handicap")[0].options[0].selected = true;
    $("#buhuoStatus")[0].options[0].selected = true;
    c.autoRefresh.data.buhuoStatus = 1;
    if (this.level == 0) {
        $("#zhangdan").hide();
        $(".s-left").show();
        $(".s-right").show();
        $("div.supervision-title").show();
        $("#sumDT").addClass("active").siblings().removeClass("active")
    } else {
        c.changeNav("sumDT")
    }
};
P.Mod.supervision.prototype.keypress = function (b, c) {
    P.Mod.supervision_sc.prototype.keypress.call(this, b, c)
};
P.Mod.supervision.prototype.errors = function (d, c, b) {
    P.Mod.supervision_sc.prototype.errors.call(this, d, c, b)
};
P.Mod.supervision.prototype.changeNav = function (p) {
    var n = this;
    if (p != "lizhangdan") {
        n.play = p
    }
    var h = {play: n.play, handicap: n.handicap, buhuoStatus: n.buhuoStatus}, s = P.Set.systype;
    $(".c-area").hide();
    $(".line1").removeData("odds").removeAttr("firstLogin").html("");
    var f = $("div.s-left", n.dom), g = $("div.s-right", n.dom), o = $("div.supervision-title", n.dom), b = $("#zhangdan");
    switch (p) {
        case"evenCode":
            f.show();
            g.show();
            o.show();
            b.hide();
            $(".lianma").show();
            n.playname = "连码";
            $(".opts").html($("#lianma_opt").val());
            break;
        case"sumDT":
            f.show();
            g.show();
            o.show();
            b.hide();
            $(".longhu_zm").show();
            n.playname = "正码";
            $(".opts").html($("#longhu_opt").val());
            break;
        case"lizhangdan":
            f.hide();
            g.hide();
            o.hide();
            b.show();
            break;
        default:
            f.show();
            g.show();
            o.show();
            b.hide();
            $(".number18").show();
            var m = parseInt(("" + p).slice(-1)) - 1;
            n.playname = "第" + ["一", "二", "三", "四", "五", "六", "七", "八"][m] + "球";
            var d = ["00", "01", "02", "03", "04", "05", "06", "07"][m];
            m < 4 ? $(".longhu1_4").show() : $(".longhu1_4").hide();
            var r = m < 4 ? "<option value='17'>龙虎</option>" : "";
            n.cat_1to8 = d;
            var q = "东南西北";
            $(".opts").html("<option value='all'>全部</option><option value='" + d + "'>" + n.playname + "</option><option value='08|09|10|11'>两面</option><option value='15'>中发白</option><option value='16'>" + q + "</option>" + r)
    }
    $(".g-vd-error").removeClass("g-vd-error");
    $(".g-vd-s-error").removeClass("g-vd-s-error");
    if (p != "lizhangdan") {
        n.autoRefresh.data.play = n.play;
        var c = n.level == 0 ? "get_json" : "get_json_zjs";
        $.UT.publicGetAction(n.id, h, function (t) {
            n.setData(t)
        }, c)
    }
    $("#" + p).addClass("active").siblings().removeClass("active")
};
P.Mod.oddReduce = function (d) {
    this.dom = d;
    this.id = d[0].id;
    var f = this;
    var c = {rules: {}, onblur: true, errorMessages: {}};
    this.input = $("input", d);
    this.input.each(function (n, o) {
        if (o.type == "text" && o.id != "scale") {
            var q = {}, r = {}, p = o.getAttribute("vname"), m = p.slice(0, 2), h = parseInt(p.replace(m, ""), 10), g = h - 1;
            switch (m) {
                case"mc":
                    q.regExp = /^0(\.\d{0,3})?$/;
                    r.regExp = "输入数字大于等于0小于1，允许三位小数";
                    o.setAttribute("vmessage", "输入数字大于等于0小于1，允许三位小数");
                    c.rules[p] = q;
                    c.errorMessages[p] = r;
                    break;
                case"lc":
                    q.regExp = /^0(\.\d{0,3})?$/;
                    r.regExp = "输入数字大于等于0小于1，允许三位小数";
                    o.setAttribute("vmessage", "输入数字大于等于0小于1，允许三位小数");
                    c.rules[p] = q;
                    c.errorMessages[p] = r;
                    break;
                case"yl":
                    q.regExp = /^0(\.\d{0,3})?$|^[1-9](\.\d{0,3})?$|^1\d?(\.\d{0,3})?$|^20$/;
                    r.regExp = "输入数字大于等于0小于等于20，允许三位小数";
                    o.setAttribute("vmessage", "输入数字大于等于0小于等于20，允许三位小数");
                    c.rules[p] = q;
                    c.errorMessages[p] = r;
                    break
            }
        }
    });
    var b = document.getElementById("scale");
    c.rules.scale = {regExp: /^0$|^[1-9]\d?$|^100$/};
    c.errorMessages.scale = {regExp: "赔率比例范围为大于等于0小于等于100"};
    b.setAttribute("vname", "scale");
    f.optinos = c;
    this.validator = $(d).Widget("SimpleValidator", f.optinos);
    $("#submit").bind("click", function () {
        var p = P.Utl.isChangeForm("#" + f.id), h, q = {};
        if (p == true) {
            h = f.validator.verifyForm()
        } else {
            $.UT.Alert({text: "请做修改后，再保存", booLean: false});
            return
        }
        if (h == true) {
            q = {lmflag: $("[name=lmflag]:checked", d).val(), ylflag: $("[name=ylflag]:checked", d).val()};
            for (var n = 0, g = f.input.length; n < g; n++) {
                var o = f.input[n], m = o.getAttribute("vname");
                if (!!m) {
                    q[m] = o.value
                }
            }
            $.UT.publicGetAction(f.dom[0].id, q, function (t) {
                $.UT.Alert({text: t.succ, booLean: false});
                var r = {scale: document.getElementById("scale").value, lmflag: $("[name=lmflag]:checked").val(), ylflag: $("[name=ylflag]:checked").val(), mc: [], lc: [], yl: []};
                var x = $("ul input");
                for (var A = 0, w = x.length; A < w; A++) {
                    var s = x[A], z = s.getAttribute("vname"), y = z.slice(0, 2), v = parseInt(z.replace(y, ""), 10);
                    if (y == "yl") {
                        v = v - 3
                    } else {
                        v = v - 1
                    }
                    r[y][v] = s.value
                }
                f.setData(r)
            }, "", "", "", "", {button: "#submit"})
        } else {
            return
        }
    });
    $("#reset", d).bind("click", function (g) {
        $(".g-vd-s-error").removeClass("g-vd-s-error");
        f.setData(f.data)
    });
    d.delegate("input", "keypress", function (g) {
        if (g.keyCode == 13) {
            $("#submit").click()
        }
    })
};
P.Mod.oddReduce.prototype.setData = function (c) {
    var g = this, h = "";
    this.data = c;
    for (var d = 0, n = g.input.length; d < n; d++) {
        var o = g.input[d], m = o.getAttribute("vname"), b, f;
        if (!!m) {
            switch (m.replace(/\d+/, "")) {
                case"mc":
                case"lc":
                case"yl":
                    b = m.replace(/\d+/, "");
                    f = parseInt(m.slice(2), 10);
                    if (b == "yl") {
                        f = f - 3
                    } else {
                        f = f - 1
                    }
                    if (c[b] !== undefined && c[b][f] !== undefined) {
                        o.value = c[b][f];
                        $(o).prop("defaultValue", c[b][f])
                    }
                    break;
                case"scale":
                    if (c.scale !== undefined) {
                        o.value = c.scale;
                        $(o).prop("defaultValue", c.scale)
                    }
                    break
            }
        }
    }
    c.lmflag === undefined ? c.lmflag = 1 : "";
    $("#" + g.id + ":radio").attr("checked", false).prop("defaultChecked", false);
    $("input[id^='lmflag']").removeAttr("checked");
    $("#lmflag" + c.lmflag).attr("checked", true).prop("defaultChecked", true);
    c.ylflag === undefined ? c.ylflag = 1 : "";
    $("input[id^='ylflag']").removeAttr("checked");
    $("#ylflag" + c.ylflag).attr("checked", true).prop("defaultChecked", true)
};
P.Mod.oddReduce.prototype.unbind = function (b) {
    P.Mod.setunbind.call(this)
};
P.Mod.oddReduce_sc = function (f) {
    this.dom = f;
    this.id = this.dom[0].id;
    var g = this;
    var d = {rules: {}, onblur: true, errorMessages: {}};
    var b = $(".oddreduce-right li input");
    b.each(function (n) {
        var q = {}, r = {}, o = n - 2 > 0 ? "p" + (n - 2) : "p0", m, h;
        if (n % 2) {
            m = Math.ceil(n / 2);
            h = m - 1
        } else {
            m = Math.ceil((n + 1) / 2);
            h = m - 1
        }
        q = {required: 1, regExp: /^0(\.\d{0,3})?$/};
        r = {required: "请输入赔率！", regExp: "输入数字大于等于0小于1，允许三位小数"};
        this.setAttribute("vname", "p" + n);
        d.rules["p" + n] = q;
        d.errorMessages["p" + n] = r
    });
    var c = document.getElementById("scale");
    d.rules.scale = {regExp: /^0$|^[1-9]\d?$|^100$/};
    d.errorMessages.scale = {regExp: "赔率比例范围为大于等于0小于等于100的整数"};
    c.setAttribute("vname", "scale");
    this.validator = $(f).Widget("SimpleValidator", d);
    $("#submit", f).bind("click", function () {
        var m = g.validator.verifyForm();
        if (m == true) {
            var n = P.Utl.isValueChange(g.id);
            if (!n) {
                return false
            }
            var h = {scale: document.getElementById("scale").value, permit: document.getElementById("oddreduceOn").checked == true ? "1" : "0", odds: []};
            $(".oddreduce-right li").each(function (p) {
                var o = $("input", this);
                if (o.length) {
                    h.odds[p] = [o[0].value, o[1].value]
                }
            });
            g.arr = h;
            $.UT.publicGetAction(g.dom[0].id, h, function (o) {
                g.data = g.arr;
                delete g.arr;
                $.UT.Alert({text: o.succ, booLean: false});
                P.Utl.isValueChange(g.id, 1)
            }, "", "", "", "", {button: "#submit"})
        } else {
            return
        }
    });
    $("#reset", f).bind("click", function (h) {
        g.setData(g.data)
    });
    f.delegate("input", "keypress", function (h) {
        if (h.keyCode == 13) {
            $("#submit").click()
        }
    })
};
P.Mod.oddReduce_sc.prototype.setData = function (c) {
    var d = this;
    this.data = c;
    if (c.scale) {
        $("#scale").val(c.scale)
    }
    if (c.permit) {
        $("#oddreduceOn").removeAttr("checked");
        $("#oddreduceOff").removeAttr("checked");
        if (c.permit == "1") {
            document.getElementById("oddreduceOn").checked = true
        } else {
            document.getElementById("oddreduceOff").checked = true
        }
    }
    if (c.odds) {
        var b = $(".oddreduce-right li");
        b.each(function (g) {
            var h = c.odds[g];
            if (h && h.length > 0) {
                var f = $("input", this);
                if (f.length) {
                    f[0].value = h[0];
                    f[1].value = h[1]
                }
            }
        })
    }
    this.cacheValue = 1;
    if (this.cacheValue == 1) {
        P.Utl.isValueChange(d.id, 1);
        this.cacheValue == 0
    }
};
P.Mod.oddReduce_sc.prototype.unbind = function (b) {
    P.Mod.setunbind.call(this)
};
P.Mod.oddReduce_pk10 = P.Mod.oddReduce;
P.Mod.oddReduce_nc = P.Mod.oddReduce;
P.Mod.tongji_nav_sc = function (b) {
    P.Mod.tongji_nav.call(this, b, 10000);
    this.bindData = function (c) {
        var f = c.betnotice;
        if (f) {
            $("#timesold").html(f.timesold ? f.timesold : "");
            $("#num").html(f.timesnow ? f.timesnow : "");
            if (f.timeclose == f.timeopen && f.timeopen == 0) {
                P.Utl.CountDown("#tm", 1);
                P.Utl.CountDown("#top", 1)
            } else {
                if (f.timeclose !== undefined) {
                    P.Utl.CountDown("#tm", f.timeclose, "#tongji_sc")
                }
                if (f.timeopen !== undefined) {
                    P.Utl.CountDown("#top", f.timeopen, "#tongji_sc,#top")
                }
            }
        }
        P.Utl.nCLBindData(c);
        if (f && f.status == 0 && c.drawStatus == 1) {
            if (f.timeopen > P.Set.qajaxT) {
                P.Utl.quickAjax(this.dom, this.bindData)
            }
        }
        P.Utl.winSetData(c.win ? c : P.Set)
    }
};
P.Mod.tongji_nav_sc.prototype = P.Mod.tongji_nav.prototype;
P.Mod.tongji_nav_sc.prototype.playtype = function (b) {
    var c;
    switch (b) {
        case"00":
            c = "000";
            break;
        case"01":
            c = "005";
            break;
        case"02":
            c = "011";
            break;
        case"03":
            c = "014";
            break;
        case"04":
            c = "015";
            break;
        case"05":
            c = "016";
            break
    }
    P.Utl.tongji = c
};
P.Mod.tongji_nav_ks = function (b) {
    P.Mod.tongji_nav.call(this, b, 10000);
    this.bindData = function (c) {
        var f = c.betnotice;
        if (f) {
            $("#timesold").html(f.timesold ? f.timesold : "");
            $("#num").html(f.timesnow ? f.timesnow : "");
            if (f.timeclose == f.timeopen && f.timeopen == 0) {
                P.Utl.CountDown("#tmks", 1);
                P.Utl.CountDown("#topks", 1)
            } else {
                if (f.timeclose !== undefined) {
                    P.Utl.CountDown("#tmks", f.timeclose, "#tongji_ks")
                }
                if (f.timeopen !== undefined) {
                    P.Utl.CountDown("#topks", f.timeopen, "#tongji_ks,#topks")
                }
            }
        }
        P.Utl.nCLBindData(c);
        if (f && f.status == 0 && c.drawStatus == 1) {
            if (f.timeopen > P.Set.qajaxT) {
                P.Utl.quickAjax(this.dom, this.bindData)
            }
        }
        P.Utl.winSetData(c.win ? c : P.Set)
    }
};
P.Mod.tongji_nav_ks.prototype = P.Mod.tongji_nav.prototype;
P.Mod.waterLevel = function (d) {
    var f = this;
    this.dom = d;
    this.input = $("input", d);
    P.Mod.waterLevelVal.call(this, d);
    var c = "26", b = "zg15";
    if (P.Set.systype === "nc") {
        c = "28"
    } else {
        if (P.Set.systype === "ks") {
            c = "00";
            b = "zg00"
        }
    }
    f.optinos.rules["ap" + c].lessThan = b;
    $("#ap15,#ap26", d).bind("change", function (n) {
        var o = $("#ap15"), m = $("#ap" + c), h = parseInt(o.val(), 10), g = parseInt(m.val(), 10);
        if (h < g) {
            f.validator.options.rules.bp15.lessThanSum[0] = "ap" + c;
            f.validator.options.rules.cp15.lessThanSum[0] = "ap" + c
        } else {
            f.validator.options.rules.bp15.lessThanSum[0] = "ap15";
            f.validator.options.rules.cp15.lessThanSum[0] = "ap15"
        }
    });
    $("#submit", d).bind("click", function (s) {
        var p = P.Utl.isGameChange("#game_info"), x, q = {};
        if (p.isChanged) {
            x = f.validator.verifyForm()
        } else {
            $.UT.Alert({text: "请做修改后，再保存", booLean: false});
            return
        }
        if (x != true) {
            return
        }
        for (var m in p.name) {
            var w;
            if (m == c) {
                w = $("input[name=15],input[name=" + c + "]", f.dom)
            } else {
                w = $("input[name=" + m + "]", f.dom)
            }
            if (m == 15) {
                w = $("input[name=15],input[name=" + c + "]", f.dom)
            }
            if (P.Set.systype == "ks") {
                switch (m) {
                    case"07":
                    case"08":
                    case"09":
                    case"10":
                    case"11":
                        w = $("input[name=04],input[name=" + m + "]", f.dom);
                        break;
                    default:
                        w = $("input[name=" + m + "]", f.dom);
                        break
                }
            }
            for (var v = 0, r = w.length; v < r; v++) {
                q[w[v].getAttribute("vname")] = w[v].value;
                var h = w[v].getAttribute("vname").substring(2);
                var t = $("input[vname='at13']").val();
                var o = $("input[vname='bt13']").val();
                var g = $("input[vname='ct13']").val();
                if (P.Set.systype == "klc" || P.Set.systype == "nc") {
                    switch (w[v].getAttribute("vname")) {
                        case"ap12":
                        case"ap14":
                        case"ap30":
                        case"ap31":
                        case"ap32":
                            q["at" + h] = t;
                            q["bt" + h] = o;
                            q["ct" + h] = g;
                            break;
                        case"at13":
                        case"bt13":
                        case"ct13":
                            q.at12 = t;
                            q.ap12 = $("input[vname='ap12']").val();
                            q.bt12 = o;
                            q.bp12 = $("input[vname='bp12']").val();
                            q.ct12 = g;
                            q.cp12 = $("input[vname='cp12']").val();
                            q.zg12 = $("input[vname='zg12']").val();
                            q.at14 = t;
                            q.ap14 = $("input[vname='ap14']").val();
                            q.bt14 = o;
                            q.bp14 = $("input[vname='bp14']").val();
                            q.ct14 = g;
                            q.cp14 = $("input[vname='cp14']").val();
                            q.zg14 = $("input[vname='zg14']").val();
                            q.at30 = t;
                            q.ap30 = $("input[vname='ap30']").val();
                            q.bt30 = o;
                            q.bp30 = $("input[vname='bp30']").val();
                            q.ct30 = g;
                            q.cp30 = $("input[vname='cp30']").val();
                            q.zg30 = $("input[vname='zg30']").val();
                            q.at31 = t;
                            q.ap31 = $("input[vname='ap31']").val();
                            q.bt31 = o;
                            q.bp31 = $("input[vname='bp31']").val();
                            q.ct31 = g;
                            q.cp31 = $("input[vname='cp31']").val();
                            q.zg31 = $("input[vname='zg31']").val();
                            q.at32 = t;
                            q.ap32 = $("input[vname='ap32']").val();
                            q.bt32 = o;
                            q.bp32 = $("input[vname='bp32']").val();
                            q.ct32 = g;
                            q.cp32 = $("input[vname='cp32']").val();
                            q.zg32 = $("input[vname='zg32']").val();
                            break
                    }
                }
            }
        }
        $.UT.publicGetAction(f.dom[0].id, q, function (D) {
            var C = {};
            $.UT.Alert({text: D.succ, booLean: false});
            var y = 0, B = 29;
            if (P.Set.systype == "ks") {
                y = 7;
                B = 13
            }
            if (P.Set.systype == "klc" || P.Set.systype == "nc") {
                B = 35
            }
            for (var F = 0; F < B; F++) {
                var E = (F / Math.pow(10, 2)).toFixed(2).substr(2), A;
                A = $("input[name=" + E + "]");
                y = A.length;
                C[E] = [];
                for (var z = 0; z < y; z++) {
                    if (P.Set.systype == "ks" && E > "06" && E < "12") {
                        C[E][0] = A[0].value;
                        C[E][1] = "";
                        C[E][2] = A[1].value;
                        C[E][3] = "";
                        C[E][4] = A[2].value;
                        C[E][5] = "";
                        C[E][6] = A[3].value
                    } else {
                        if ((P.Set.systype == "klc" || P.Set.systype == "nc") && (E == 12 || E == 14 || E == 30 || E == 31 || E == 32)) {
                            C[E][0] = A[0].value;
                            C[E][1] = "";
                            C[E][2] = A[1].value;
                            C[E][3] = "";
                            C[E][4] = A[2].value;
                            C[E][5] = "";
                            C[E][6] = A[3].value
                        } else {
                            C[E].push(A[z].value)
                        }
                    }
                }
            }
            f.setData(C)
        }, "", "", "", "", {button: "#submit"})
    });
    $.UT.HoverList({container: "#game_info tbody", el: "tr"})
};
P.Mod.waterLevel.prototype.setData = function (c, b) {
    P.Mod.waterLevelData.call(this, c, b)
};
P.Mod.waterLevel.prototype.unbind = function () {
    P.Mod.setunbind.call(this)
};
P.Mod.waterLevel_nc = P.Mod.waterLevel;
P.Mod.waterLevel_ks = P.Mod.waterLevel;
P.Mod.waterLevel_sc = function (b) {
    var c = this;
    this.dom = b;
    this.id = b[0].id;
    this.input = $("input", b);
    P.Utl.tab({dom: "#tab_menu", f: this.flag, callBack: this.callBack});
    P.Mod.waterLevelVal.call(this, b);
    $("#submit", b).bind("click", function (h) {
        var f = c.validator.verifyForm();
        if (f == true) {
            var g = P.Utl.isValueChange(c.id);
            if (!g) {
                return false
            }
            var d = {};
            c.input.each(function (m, n) {
                var o = n.id;
                d[o] = n.value
            });
            c.arr = d;
            $.UT.publicGetAction(c.dom[0].id, d, function (m) {
                c.data = c.arr;
                delete c.arr;
                $.UT.Alert({text: m.succ, booLean: false});
                P.Utl.isValueChange(c.id, 1)
            }, "", "", "", "", {button: "#submit"})
        } else {
            return
        }
    })
};
P.Mod.waterLevel_sc.prototype.setData = function (c, b) {
    var d = this;
    this.data = c;
    d.input.each(function (h, m) {
        var o = m.id, f = "", n = m.getAttribute("vname"), g;
        if (c[o] != null) {
            m.value = c[o]
        }
        if (o.indexOf("bp") > -1 || o.indexOf("cp") > -1) {
            f = o.replace(/bp|cp/, "");
            if (c.min && c.min[f] !== undefined) {
                g = document.getElementById("ap" + f).getAttribute("vname");
                d.optinos.rules[n].moreThanSum = [g, c.min[f]];
                d.optinos.errorMessages[n].moreThanSum = "差分加A盘赔率必须大于或等于最小赔率" + c.min[f]
            }
        }
    });
    this.validator = this.dom.Widget("SimpleValidator", this.optinos);
    if (b) {
        return
    }
    this.cacheValue = 1;
    if (this.cacheValue == 1) {
        P.Utl.isValueChange(d.id, 1);
        this.cacheValue == 0
    }
};
P.Mod.waterLevel_sc.prototype.unbind = function () {
    $.data(this.dom[0], "SimpleValidator").hideTips();
    P.Mod.setunbind.call(this)
};
P.Mod.waterLevel_sc.prototype.callBack = function (c) {
    var f = $("#waterLevel").data("Module"), d, b = {};
    $.UT.publicGetAction(f.dom[0].id, b, f.setData)
};
P.Mod.waterLevel_pk10 = function (b) {
    var c = this;
    this.dom = b;
    this.input = $("input", b);
    P.Mod.waterLevelVal.call(this, b);
    c.optinos.rules.ap20.lessThan = "zg13";
    c.optinos.rules.ap21.lessThan = "zg14";
    c.optinos.rules.ap22.lessThan = "zg22";
    c.optinos.rules.ap23.lessThan = "zg23";
    c.optinos.rules.ap24.lessThan = "zg24";
    c.optinos.rules.ap25.lessThan = "zg25";
    $("#submit", b).bind("click", function (m) {
        var h = P.Utl.isGameChange("#game_info"), f, r = {};
        if (h.isChanged) {
            f = c.validator.verifyForm()
        } else {
            $.UT.Alert({text: "请做修改后，再保存", booLean: false});
            return
        }
        if (f == true) {
            for (var q in h.name) {
                var g;
                switch (q) {
                    case"13":
                    case"20":
                        g = $("input[name=13],input[name=20]", c.dom);
                        break;
                    case"14":
                    case"21":
                        g = $("input[name=14],input[name=21]", c.dom);
                        break;
                    case"22":
                        g = $("input[name=15],input[name=22]", c.dom);
                        break;
                    case"23":
                        g = $("input[name=15],input[name=23]", c.dom);
                        break;
                    case"24":
                        g = $("input[name=15],input[name=24]", c.dom);
                        break;
                    case"25":
                        g = $("input[name=15],input[name=25]", c.dom);
                        break;
                    default:
                        g = $("input[name=" + q + "]", c.dom);
                        break
                }
                for (var p = 0, o = g.length; p < o; p++) {
                    r[g[p].getAttribute("vname")] = g[p].value
                }
            }
            $.UT.publicGetAction(c.dom[0].id, r, function (t) {
                var d = {};
                $.UT.Alert({text: t.succ, booLean: false});
                var z = {ap: 0, at: 1, bp: 2, bt: 3, cp: 4, ct: 5, zg: 6};
                for (var y = 0; y < 27; y++) {
                    var s = (y / Math.pow(10, 2)).toFixed(2).substr(2), w, x = 0;
                    w = $("input[name=" + s + "]");
                    x = w.length;
                    d[s] = [];
                    d[s].length = 7;
                    for (var v = 0; v < x; v++) {
                        var A = $(w[v]).attr("vname").slice(0, 2);
                        d[s].splice(z[A], 1, w[v].value)
                    }
                }
                c.setData(d)
            }, "", "", "", "", {button: "#submit"})
        } else {
        }
    });
    $.UT.HoverList({container: "#game_info tbody", el: "tr"})
};
P.Mod.waterLevel_pk10.prototype.setData = function (d, c) {
    for (var b in d.Topasia) {
        $("#Topasia_" + b).html(d.Topasia[b])
    }
    P.Mod.waterLevelData.call(this, d, c)
};
P.Mod.waterLevel_pk10.prototype.unbind = function () {
    P.Mod.setunbind.call(this)
};
P.Mod.waterLevelVal = function (c) {
    var b = P.Set.systype;
    var d = this;
    this.optinos = {rules: {}, onblur: true, errorMessages: {}, methods: {moreThanSum: function (m, q, h) {
        var o = Number($(m).val()), g = Number($(h.els[q[0]]).val()), p = Number(q[1]), n = (o * 1000 + g * 1000) / 1000, f;
        if (q[2]) {
            f = Number($(h.els[q[2]]).val()), sum1 = (o * 1000 + f * 1000) / 1000;
            return(n >= p) && (sum1 >= p)
        } else {
            return n >= p
        }
    }}};
    this.input.each(function (n, s) {
        var q = {}, o = {}, h, g;
        if (b == "ssc") {
            h = s.id;
            g = s.getAttribute("vname")
        } else {
            h = s.getAttribute("vname");
            g = h
        }
        if (h.indexOf("ap") > -1) {
            var p = b == "ssc" ? "zg" + h.replace("ap", "") : "zg" + h.slice(-2);
            q.regExp = /^(?:0|[1-9]\d{0,3})(\.\d{1,3})?$/;
            q.min = 0;
            q.lessThan = $("#" + p).attr("vname"), o.regExp = "赔率大于等于0，长度为1-4的整数，允许最多带三位小数";
            o.min = "赔率大于等于0，长度为1-4的整数，允许最多带三位小数";
            o.lessThan = "赔率必须小于或等于最高赔率";
            s.setAttribute("vmessage", "赔率大于等于0，长度为1-4的整数，允许最多带三位小数")
        }
        if (h.indexOf("bp") > -1 || h.indexOf("cp") > -1) {
            var m = b == "ssc" ? h.replace(/bp|cp/, "") : h.slice(-2), f = document.getElementById("ap" + m).getAttribute("vname"), r = document.getElementById("zg" + m).getAttribute("vname");
            q.regExp = /^-?\d{1,4}(\.\d{1,3})?$/;
            q.lessThanSum = [f, r], o.regExp = "差分长度为1-4位整数，允许最多可带三位小数";
            o.lessThanSum = "差分加A盘赔率必须小于或等于最高赔率";
            s.setAttribute("vmessage", "差分长度为1-4位整数，允许最多可带三位小数")
        }
        if (h.indexOf("zg") > -1) {
            q.regExp = /^(?:0|[1-9]\d{0,3})(\.\d{1,3})?$/;
            q.min = 0;
            o.regExp = "赔率大于等于0，长度为1-4的整数，允许最多带三位小数";
            o.min = "赔率大于等于0，长度为1-4的整数，允许最多带三位小数";
            s.setAttribute("vmessage", "赔率大于等于0，长度为1-4的整数，允许最多带三位小数")
        }
        if (h.indexOf("t") > -1) {
            q.regExp = /^0(\.\d{1,2})?$|^[1-9]\d?(\.\d{1,2})?$/;
            o.regExp = "退水由小于100的整数组成，允许输入两位小数";
            s.setAttribute("vmessage", "退水由小于100的整数组成，允许输入两位小数")
        }
        d.optinos.rules[g] = q;
        d.optinos.errorMessages[g] = o
    });
    $("#reset", c).bind("click", function (f) {
        $(".g-vd-s-error").removeClass("g-vd-s-error");
        d.setData(d.data, "reset")
    });
    c.delegate("input", "keypress", function (f) {
        if (f.keyCode == 13) {
            $("#submit").click()
        }
    })
};
P.Mod.waterLevelData = function (c, b) {
    var d = this;
    this.data = c;
    this.input.each(function (n, s) {
        var q = s.getAttribute("vname"), f, g = "", r = q.slice(-2), h = $(s).parents("tr")[0].id, o = {ap: 0, at: 1, bp: 2, bt: 3, cp: 4, ct: 5, zg: 6}[q.slice(0, 2)];
        if (c[r]) {
            $(s).prop("defaultValue", c[r][o]);
            s.value = c[r][o]
        }
        if (q.indexOf("bp") > -1 || q.indexOf("cp") > -1) {
            if (P.Set.systype == "klc" || P.Set.systype == "nc") {
                if (c.min) {
                    c.min["30"] = c.min["12"];
                    c.min["31"] = c.min["13"];
                    c.min["32"] = c.min["14"]
                }
            }
            if (P.Set.systype == "ks") {
                if (c.min) {
                    c.min["07"] = c.min["04"];
                    c.min["08"] = c.min["04"];
                    c.min["09"] = c.min["04"];
                    c.min["10"] = c.min["04"];
                    c.min["11"] = c.min["04"]
                }
            }
            if (c.min && c.min[h] !== undefined) {
                var p = document.getElementById("ap" + r);
                var m = $("#ap" + r).nextAll("input")[0];
                f = p.getAttribute("vname");
                if (m) {
                    if (m.getAttribute("apname") && p.getAttribute("apname") == m.getAttribute("apname")) {
                        g = !m ? "" : m.getAttribute("vname")
                    }
                }
                d.optinos.rules[q].moreThanSum = [f, c.min[h], g];
                d.optinos.errorMessages[q].moreThanSum = "差分加A盘赔率必须大于或等于最小赔率" + c.min[h]
            }
        }
    });
    this.validator = this.dom.Widget("SimpleValidator", this.optinos);
    if (b) {
        return
    }
};
P.Mod.setunbind = function () {
    if (this.validator) {
        this.validator.hideTips();
        this.validator.hideIco()
    }
};
P.Mod.supervision_sc = function (g) {
    this.init(g);
    var f = $("tr[pnum]"), b = f.length, h = {};
    for (var c = 0; c < b; c++) {
        var d = f[c];
        h["tr" + d.getAttribute("pnum")] = d
    }
    this.trcache = h
};
P.Mod.supervision_sc.prototype.setData = function (g) {
    this.cSetData(g);
    var f = g.supervision;
    if (f) {
        var c = {};
        c.supervision = f;
        this.setDataOnly(c)
    }
    if (g.gameSum) {
        var h = $(".sup-th"), m = g.gameSum, b = m.length, n;
        for (var d = 0; d < b; d++) {
            n = h[d];
            if (n) {
                n.innerHTML = m[n.id]
            }
        }
    }
    g = null
};
P.Mod.supervision_sc.prototype.cSetData = function (f) {
    var n = f.betnotice, b = f.intoAccount;
    if (f.drawStatus) {
        P.Set.drawStatus = f.drawStatus
    }
    if (!document.getElementById(this.id)) {
        if (this.autoRefresh) {
            this.autoRefresh.hide()
        }
        return
    }
    if (n || b) {
        var o = P.Set.systype, m = "";
        if (o != "klc") {
            m = o == "ssc" ? "_sc" : "_" + o
        }
        var p = $("#supervision_nav" + m).Module();
        if (p) {
            p.setData({betnotice: n, intoAccount: b, drawStatus: f.drawStatus, changlong: f.changlong});
            p = null
        }
    }
    if (f.buhuoset) {
        if (document.activeElement && document.activeElement.nodeName.toLowerCase() != "input") {
            $(".buhuoset input[vname]").val(f.buhuoset[0]).attr("bh", f.buhuoset[0])
        }
    }
    if (b) {
        var g = 0, c = b, h = c.length, d = $("span.greener");
        if (h > 0) {
            for (; g < h; g++) {
                if (d[g]) {
                    d[g].innerHTML = c[g] ? c[g] : 0
                }
            }
        } else {
            d.html("0")
        }
    }
    this.autoRefresh.show(this.timeValue.val())
};
P.Mod.supervision_sc.prototype.setDataOnly = function (f) {
    var d = f.supervision;
    if (d) {
        for (var b in d) {
            var h = d[b], c = this.trcache["tr" + b];
            if (c) {
                var g = c.getElementsByTagName("a");
                c.setAttribute("status", 1);
                P.Utl.changeColor($(g[0]), h[0], null, "#001188", "red");
                if (h.length >= 4) {
                    c.style.background = "none";
                    g[1].innerHTML = h[1];
                    if (typeof(h[2]) == "object") {
                        g[2].innerHTML = h[2][0];
                        parseInt(h[2][0]) < 0 ? g[2].style.color = "red" : g[2].style.color = "black";
                        g[3].innerHTML = h[2][1];
                        $(g[3]).attr("buhuo_sum", h[4] || 0);
                        parseInt(h[2][1]) < 0 ? g[3].style.color = "red" : g[3].style.color = "black";
                        g[4].innerHTML = h[2][2];
                        $(g[4]).attr("buhuo_sum", h[4] || 0);
                        parseInt(h[2][2]) < 0 ? g[4].style.color = "red" : g[4].style.color = "black"
                    } else {
                        g[2].innerHTML = h[2];
                        parseInt(h[2]) < 0 ? g[2].style.color = "red" : g[2].style.color = "black"
                    }
                    if (h[3] == "0") {
                        c.style.background = "#E1D6AB";
                        c.setAttribute("status", 0)
                    }
                    $(g[2]).attr("buhuo_sum", h[4] || 0)
                } else {
                    if (h.length == 2) {
                        c.style.background = "none";
                        if (h[1] == "0") {
                            c.style.background = "#E1D6AB";
                            c.setAttribute("status", 0)
                        }
                    }
                }
            }
        }
        d = null
    }
};
P.Mod.supervision_sc.prototype.timeRefresh = function (b) {
    P.Mod.supervision.prototype.timeRefresh.call(this, b)
};
P.Mod.supervision_sc.prototype.ajax_getPage = function (b, c) {
    P.Mod.supervision.prototype.ajax_getPage.call(this, b, c)
};
P.Mod.supervision_sc.prototype.getPage = function (b, c) {
    P.Mod.supervision.prototype.getPage.call(this, b, c)
};
P.Mod.supervision_sc.prototype.zdetail = function (b) {
    return P.Mod.supervision.prototype.zdetail.call(this, b)
};
P.Mod.supervision_sc.prototype.unbind = function () {
    var b = this;
    if (b.autoRefresh) {
        b.autoRefresh.data.handicap = "A";
        b.autoRefresh.data.buhuoStatus = 1;
        b.autoRefresh.hide()
    }
    if (b.alert) {
        delete b.alert
    }
    $(".opts").val("all");
    b.handicap = "A";
    $("#handicap")[0].options[0].selected = true;
    $("#buhuoStatus")[0].options[0].selected = true;
    b.buhuoStatus = 1;
    this.changeNav()
};
P.Mod.supervision_sc.prototype.keypress = function (b, c) {
    b.bind("keypress",function (f) {
        var d = f.keyCode;
        if (d == 13) {
            c.click()
        }
    }).focus()
};
P.Mod.supervision_sc.prototype.errors = function (f, c, b) {
    var d = this;
    if (b == 2) {
        if (c) {
            if (c.version_number) {
                d.version_number = c.version_number
            }
            if (c.discount && d.level > 0) {
                $("#alert_2_water").val(c.discount);
                $("#alert_2_money").val(c.sum);
                $("#alert_2_odds").val(c.odd);
                $("#pankou").text(c.oddset)
            } else {
                P.Utl.buhuoTbody(c, "waidaoCor")
            }
        }
    }
    $.UT.NetErrorCallback(f, c, b)
};
P.Mod.supervision_sc.prototype.changeNav = function (c) {
    var g = this;
    var f = $("#sup_control", g.dom), d = $("#twoGall_Num", g.dom), b = $("#zhangdan");
    zengheli = $("#zenghe");
    switch (c) {
        case"lizhangdan":
            f.hide();
            d.hide();
            b.show();
            break;
        default:
            f.show();
            d.show();
            b.hide();
            zengheli.siblings().removeClass("active");
            zengheli.addClass("active")
    }
    $(".g-vd-error").removeClass("g-vd-error");
    $(".g-vd-s-error").removeClass("g-vd-s-error")
};
P.Mod.supervision_sc.prototype.init = function (g) {
    var h = this;
    this.level = P.Set.level;
    this.dom = g;
    this.timeValue = $("#timeValue", g);
    this.id = g[0].id;
    this.alert = "";
    this.handicap = "A";
    this.buhuoStatus = 1;
    this.header = $("#header").data("Module");
    this.header.dom.bind("resultnum", function (m) {
        if (document.getElementById(h.id)) {
            h.timeRefresh(true)
        }
    });
    h.timeValue.bind("change", function (n) {
        var m = h.timeValue.val();
        m == 0 ? h.autoRefresh.hide() : h.autoRefresh.show(m)
    });
    var d = {handicap: h.handicap, buhuoStatus: h.buhuoStatus}, f = this.level == 0 ? "get_json" : "get_json_zjs";
    h.play ? d.play = h.play : "";
    this.autoRhObj = {urlId: h.id, action: f, data: d, callback: function (m) {
        h.setData(m)
    }};
    h.autoRefresh = $("#autoRefresh", g).Widget("AutoRefresh", h.autoRhObj);
    if (this.level == 0) {
        $("#timeValue option").slice(5, 11).remove();
        $("#timeValue").val(5);
        $(".zhangdan-zjs").remove();
        $(".zhangdan_zjs").remove();
        $(".sup-line").hover(function () {
            this.style.textDecoration = "underline"
        }, function () {
            this.style.textDecoration = ""
        })
    } else {
        $("#timeValue option").slice(0, 5).remove();
        $("#timeValue").val(30);
        $(".not-zjs").remove();
        $(".odd_set").remove();
        $(".zhangdan-sys").remove();
        $(".zhangdan_sys").remove();
        $(".sup-line").not(".line1").hover(function () {
            this.style.textDecoration = "underline"
        }, function () {
            this.style.textDecoration = ""
        })
    }
    $(g).bind("click", function (p) {
        var v = p.target;
        if (v.id == "refresh") {
            h.timeRefresh();
            return
        }
        if (h.level == 0) {
            var q = {};
            q.handicap = $("#handicap").val();
            q.action = v.id;
            h.play ? q.play = h.play : "";
            switch (v.id) {
                case"adjustment":
                    var t = $(v).prevAll("select");
                    q.odds = t[1].value;
                    q.key = t[0].value;
                    if (q.key == "all") {
                        var s = "您将调整所有玩法的赔率，请确认";
                        $.UT.Alert({text: s, determineCallback: function () {
                            $.UT.publicGetAction(h.id, q, function (w) {
                                h.setDataOnly(w)
                            }, "get_json", $.UT.NetErrorCallback)
                        }})
                    } else {
                        $.UT.publicGetAction(h.id, q, function (w) {
                            h.setDataOnly(w)
                        }, "", $.UT.NetErrorCallback)
                    }
                    break;
                case"stopCharge":
                    var n = $("#part_stopCharge")[0];
                    var s = "是否停押'<span class='reder'>" + n.options[n.selectedIndex].innerHTML + "</span>'";
                    $.UT.Alert({text: s, determineCallback: function () {
                        var w = $(v).next("select");
                        q.key = $(w[0]).val();
                        $.UT.publicGetAction(h.id, q, function (x) {
                            if (P.Set.systype != "klc") {
                                h.timeRefresh()
                            } else {
                                x.success ? h.timeRefresh() : h.setDataOnly(x)
                            }
                        }, "", $.UT.NetErrorCallback)
                    }});
                    break;
                case"opening":
                    var n = $("#part_opening")[0];
                    var s = "是否开放'<span class='reder'>" + n.options[n.selectedIndex].innerHTML + "</span>'";
                    $.UT.Alert({text: s, determineCallback: function () {
                        var w = $(v).next("select");
                        q.key = w[0].value;
                        $.UT.publicGetAction(h.id, q, function (x) {
                            if (P.Set.systype != "klc") {
                                h.timeRefresh()
                            } else {
                                x.success ? h.timeRefresh() : h.setDataOnly(x)
                            }
                        }, "", $.UT.NetErrorCallback)
                    }});
                    break;
                case"allstopCharge":
                    $.UT.Alert({text: "是否全部停押？", determineCallback: function () {
                        delete q.play;
                        $.UT.publicGetAction(h.id, q, function (w) {
                            if (P.Set.systype != "klc") {
                                h.timeRefresh()
                            } else {
                                w.success ? h.timeRefresh() : h.setDataOnly(w)
                            }
                            h.alert = $.UT.Alert({text: "修改成功", booLean: false})
                        }, "", $.UT.NetErrorCallback)
                    }});
                    break;
                case"allOpening":
                    $.UT.Alert({text: "是否全部开放？", determineCallback: function () {
                        delete q.play;
                        $.UT.publicGetAction(h.id, q, function (w) {
                            if (P.Set.systype != "klc") {
                                h.timeRefresh()
                            } else {
                                w.success ? h.timeRefresh() : h.setDataOnly(w)
                            }
                            h.alert = $.UT.Alert({text: "修改成功", booLean: false})
                        }, "", $.UT.NetErrorCallback)
                    }});
                    break
            }
            var m = v.getAttribute("name");
            if (m == "down" || m == "up") {
                var r, o;
                switch (P.Set.systype) {
                    case"pk10":
                        r = $(v).parents("tr").first().attr("name"), o = r.split("|");
                        q.playtype = o[0];
                        q.number = o[1];
                        break;
                    default:
                        r = $(v).parents("tr").first();
                        q.playtype = r.attr("playtype");
                        q.number = r.attr("number");
                        break
                }
                q.action = m;
                q.odds = $("#odds").val();
                $.UT.publicGetAction(h.id, q, function (w) {
                    h.setDataOnly(w)
                }, "", $.UT.NetErrorCallback)
            }
        }
    });
    $(".sup-line").bind("click", function (B) {
        var I = B.target, r = I.className.match(/\d/g)[0], o = $(I).parents("tr").first(), s = "", q = o.children()[0].innerHTML, z = "", C = {}, A, p = P.Set.systype;
        C.game = o.attr("playtype");
        C.cat = o.attr("cat");
        C.handicap = $("#handicap").val();
        if (p == "ssc") {
            C.num = o.attr("number");
            C.number = o.attr("number");
            s = P.Utl.number_sc(C.game, C.num)
        }
        if (p == "klc" || p == "nc") {
            C.number = o.attr("number");
            C.num = o.attr("number");
            C.play = h.play
        }
        if (p == "pk10") {
            A = o.attr("name").split("|");
            C.game = A[0];
            C.number = A[1];
            C.num = A[1];
            s = P.Utl.number_pk10(A[0], A[1]);
            delete C.cat
        }
        if (p == "ks") {
            C.number = o.attr("number");
            C.num = o.attr("number");
            s = P.Utl.number_ks(C.game, C.num)
        }
        if (r == 1) {
            if (h.level > 0) {
                return
            }
            if (p == "klc" || p == "nc") {
                var m = h.playname;
                if (C.game == "040" || C.game == "041" || C.game == "042") {
                    m = ""
                }
                var z = $("#odd_alert").val().replace("$a$", m).replace("$b$", q).replace("$c$", h.handicap)
            } else {
                var z = $("#peilv").val().replace("$table_title", s[0]).replace("$wanfa", s[1]).replace("$handicap", h.handicap)
            }
            $.UT.Alert({text: z, title: "修改赔率", validate: h.validate3d1, determineCallback: function () {
                var t = $("#supervision_odds_alert input");
                if (t[0]) {
                    C.action = "changeOneOdds";
                    C.playtype = C.game;
                    C.odds = t[0].value;
                    C.bill = t[1].checked == true ? t[1].value : t[2].value;
                    if (p == "ssc" || p == "ks") {
                        C.number = C.num
                    }
                    delete C.game;
                    delete C.num;
                    delete C.cat;
                    $.UT.publicGetAction(h.id, C, function (x) {
                        h.setDataOnly(x)
                    }, "change_odds", $.UT.NetErrorCallback)
                }
            }, width: "260"});
            $("#wanwei").val(I.innerHTML);
            if (p == "klc" || p == "nc") {
                var F = $(".radiobox input")
            } else {
                var F = $(".rad-c input")
            }
            o.attr("status") == 0 ? F[0].checked = "true" : F[1].checked = "true";
            h.keypress($("#wanwei"), $("span[name=determine]"))
        } else {
            if (r == 2) {
                var E = h.level == 0 ? "detail" : "detail_zjs";
                C.action = "mini2";
                C.pager = 1;
                if (p == "ks") {
                    C.number = C.num
                }
                h.alert = $.UT.Alert({text: $("#zdmx").val(), title: "注单明细", width: "950", height: "331", booLean: false});
                h.getPage(I, C);
                $.UT.publicGetAction(h.id, C, function (t) {
                    var x = h.zdetail(t);
                    $(".requestData .data-contain", h.alert.dom).html(x);
                    $.UT.HoverList({container: ".requestData tbody", el: "tr"})
                }, E, $.UT.NetErrorCallback)
            } else {
                if (r == 3) {
                    var y = "后台补货", w = "get_buhuo_corp", n = h.level == 0 ? "gsxz" : "gsxz_zjs", v = $(I).attr("buhuo_sum") || 0, z;
                    var D = {num: C.num, game: C.game, cat: C.cat, type: "monitor", handicap: h.handicap, play: h.play, number: C.number};
                    if (p == "ssc") {
                        var H = parseInt(C.cat, 10) < 2 && parseInt(C.game, 10) < 10 ? s[2] + "&emsp;" + s[0] + "&emsp;" + s[1] : s[2] + "&emsp;" + s[1];
                        delete D.number;
                        delete D.play
                    }
                    if (p == "klc" || p == "nc") {
                        var m = h.playname;
                        if (C.game == "040" || C.game == "041" || C.game == "042") {
                            m = ""
                        }
                        var H = m + "&nbsp;&nbsp;&nbsp;" + q;
                        delete D.num
                    }
                    if (p == "pk10") {
                        var H = s.join("   ");
                        delete D.num;
                        delete D.cat;
                        delete D.play
                    }
                    if (p == "ks") {
                        var H = s[2];
                        delete D.number;
                        delete D.play
                    }
                    if (h.level > 0) {
                        y = "下级给上级补货";
                        w = "get_buhuo_corp_zjs";
                        delete D.type;
                        delete D.handicap;
                        D.money = v
                    }
                    z = $("#" + n).val().replace("$title$", H);
                    h.submitTimes = 0;
                    h.buhuoAlert = $.UT.Alert({text: z, title: y, validate: h.validate3d3, waidiao: function (t, J) {
                        if (h.level == 0) {
                            var K = $("#waidiaoradio").attr("checked");
                            if (!K) {
                                var x = {rules: {money: {regExp: /^[1-9]\d{0,8}$/}}, onblur: false, errorMessages: {money: {regExp: "金额由小于10位的正整数组成！"}}};
                                return x
                            } else {
                                return t
                            }
                        }
                        return t
                    }, determineCallback: function () {
                        if (h.submitTimes > 0) {
                            return
                        }
                        h.submitTimes++;
                        C.version_number = h.version_number;
                        C.sum = $("#alert_2_money").val();
                        var L = "gb";
                        if (h.level == 0) {
                            C.operating = "true";
                            var J = $("input:checked"), x, K;
                            if (J) {
                                x = J[0];
                                K = x.parentNode.parentNode;
                                if (x.id == "waidiaoradio") {
                                    C.discount = $("#alert_2_water").val();
                                    C.odd = $("#alert_2_odds").val();
                                    C.type = "waidiao";
                                    C.oddset = $("#pankou").html()
                                } else {
                                    var t = $("select", K).val().split("|");
                                    C.discount = t[2];
                                    C.odd = t[3];
                                    C.type = "corp";
                                    C.corp_id = t[6];
                                    C.oddset = t[1];
                                    C.mem_id = t[4]
                                }
                            }
                        } else {
                            L = "gb_zjs";
                            C.discount = $("#alert_2_water").html();
                            C.odd = $("#alert_2_odds").html();
                            C.oddset = $("#pankou").val()
                        }
                        if (h.level == 0 && C.type == "corp") {
                            h.submitTimes = 0;
                            $.UT.Alert({text: "您选择了【公司间补货】<br/>补货金额:" + C.sum + " 被补货公司:" + t[5] + "<br/>确认提交此次补货?", title: "公司间补货", determineCallback: function () {
                                $.UT.publicGetAction(h.id, C, function (M) {
                                    h.timeRefresh();
                                    $.UT.Alert({text: "提交成功！", booLean: false})
                                }, L, function (N, O, M) {
                                    h.errors(N, O, M);
                                    if (M == 0 && h.buhuoAlert) {
                                        h.buhuoAlert.close();
                                        delete h.buhuoAlert
                                    }
                                })
                            }, cancelCallback: function () {
                            }})
                        } else {
                            $.UT.publicGetAction(h.id, C, function (M) {
                                h.timeRefresh();
                                $.UT.Alert({text: "提交成功！", booLean: false});
                                if (h.buhuoAlert) {
                                    h.buhuoAlert.close();
                                    delete h.buhuoAlert
                                }
                            }, L, function (N, O, M) {
                                h.errors(N, O, M);
                                if (M == 0 && h.buhuoAlert) {
                                    h.buhuoAlert.close();
                                    delete h.buhuoAlert
                                }
                                if (M == 2) {
                                    h.submitTimes = 0
                                }
                            })
                        }
                    }, width: "530", buttonBL: false});
                    h.keypress($("#alert_2_money"), $("span[name=determine]"));
                    $.UT.publicGetAction(h.id, D, function (J) {
                        if (h.level == 0) {
                            P.Utl.buhuoTbody(J, "waidaoCor");
                            h.keypress($("input", h.buhuoAlert.dom), $("span[name=determine]"))
                        } else {
                            $("#alert_2_money").val(v);
                            if (J.oddset) {
                                var t = J.oddset;
                                $("#alert_2_water").html(J.discount.A);
                                $("#alert_2_odds").html(J.odd.A)
                            }
                            c("#pankou", J)
                        }
                        h.version_number = J.version_number
                    }, w, function (x, J, t) {
                        h.errors(x, J, t);
                        if (t == 0 && h.buhuoAlert) {
                            h.buhuoAlert.close();
                            delete h.buhuoAlert
                        }
                    })
                }
            }
        }
    });
    function c(n, m) {
        $(n).bind("change", function () {
            var o = this.options[this.selectedIndex].id;
            $("#alert_2_water").html(m.discount[o]);
            $("#alert_2_odds").html(m.odd[o])
        })
    }

    $("#handicap,#buhuoStatus").bind("change", function (n) {
        var m = {}, o = n.target.id;
        o == "handicap" ? h.handicap = this.value : h.buhuoStatus = this.value;
        m.handicap = h.handicap;
        m.buhuoStatus = h.buhuoStatus;
        h.play ? m.play = h.play : "";
        $.UT.publicGetAction(h.id, m, function (p) {
            h.autoRefresh.data.handicap = h.handicap;
            h.autoRefresh.data.buhuoStatus = h.buhuoStatus;
            $(".line1").removeData("odds").removeAttr("firstLogin").html("");
            h.setData(p)
        }, f)
    });
    $("#zhangdan tbody tr").hover(function (m) {
        $(this).addClass("on")
    }, function (m) {
        $(this).removeClass("on")
    });
    $.UT.HoverList({container: ".super-box-child,.ul_pk10,.c-area tbody", el: "tr"});
    var b = this.level == 0 ? "buhuoset" : "buhuoset_zjs";
    P.Utl.buhuoset(h.id, b);
    $("#" + h.id).bind("CountDownStop", function (n, t) {
        var r = P.Set.drawStatus, s = "", o = P.Set.systype;
        if (o != "ssc") {
            s = o == "pk10" ? "_pk10" : o == "klc" ? "klc" : "_nc"
        }
        if (t == ("timeclose" + s) && r != 1) {
            return
        }
        if (t == ("timeopen" + s) && r == 1) {
            return
        }
        var q = {};
        q.handicap = h.handicap;
        h.play ? q.play = h.play : "";
        q.buhuoStatus = h.buhuoStatus;
        var m = function () {
            $.UT.publicGetAction(h.id, q, function (v) {
                var p = v.drawStatus;
                if (p == r || p == 0) {
                    $("#" + h.id).trigger("CountDownStop", [t])
                } else {
                    P.Utl.winSetData(v.win ? v : P.Set);
                    if (P.Set.systype == "klc" || P.Set.systype == "nc") {
                        h.setData(v)
                    } else {
                        h.setDataOnly(v)
                    }
                }
            }, f, function () {
            })
        };
        setTimeout(m, Math.floor(Math.random() * 3000 + 1000))
    });
    $("#guendan").bind("click", function () {
        var m = P.Set.systype == "pk10" ? "pk" : P.Set.systype;
        window.open(m + "/monitor/rollOrder?" + P.Set.version, "_blank", "width=950,height=600,resizable=yes,location=no,scrollbars=yes")
    });
    if (P.Set.systype != "ssc") {
        $(".cell-left tr span").bind("click", function () {
            var o = this.parentNode.parentNode.getAttribute("href"), m = P.Set.systype, n = m == "klc" ? "" : m == "pk10" ? "pk10" : "nc";
            h.changeNav(o)
        })
    }
    if (this.level == 0) {
        h.validate3d3 = {rules: {water: {regExp: /^0(\.\d{1,2})?$|^[1-9]\d?(\.\d{1,2})?$/}, odds: {regExp: /^(?:0|[1-9]\d{0,3})(\.\d{1,3})?$/}, money: {regExp: /^[1-9]\d{0,8}$/}}, onblur: false, errorMessages: {}};
        h.validate3d3.errorMessages = {water: {regExp: "退水由小于100的数组成，允许输入两位小数！"}, odds: {regExp: "赔率大于等于0，长度为1-4的整数，允许最多带三位小数"}, money: {regExp: "金额由小于10位的正整数组成！"}};
        h.validate3d1 = {rules: {wanwei: {regExp: /^(?:0|[1-9]\d{0,3})(\.\d{1,3})?$/}}, onblur: false, errorMessages: {wanwei: {regExp: "赔率大于等于0，长度为1-4的整数，允许最多带三位小数"}}}
    } else {
        h.validate3d3 = {rules: {money: {regExp: /^[1-9]\d{0,8}$/}}, onblur: false, errorMessages: {}};
        h.validate3d3.errorMessages = {money: {regExp: "数值大于0，长度为1-9位的整数"}}
    }
};
P.Utl.buhuoTbody = function (R, C) {
    var r = R.corps, b = "", f, w, g, B, z = "", D, q, H = 0, N = R.others;
    var x = document.createDocumentFragment();
    var E = jQuery.isEmptyObject(r), A = jQuery.isEmptyObject(N);
    var o = function (T, W) {
        var V = "";
        if (T && T.length > 0) {
            for (var U = 0, S = T.length; U < S; U++) {
                var c = T[U].join("|") + "|" + W;
                V += "<option value='" + c + "'>" + T[U][0] + "</option>"
            }
            return"<select>" + V + "</select>"
        }
        return V
    };
    var p = function (U) {
        var T = 0, c, t = 0;
        if (U.hasOwnProperty("corps")) {
            c = U.corps;
            for (var S in c) {
                if (c.hasOwnProperty(S)) {
                    T++;
                    t++
                }
            }
        }
        if (U.hasOwnProperty("others")) {
            c = U.others;
            for (var S in c) {
                if (c.hasOwnProperty(S)) {
                    T++
                }
            }
        }
        if (U.hasOwnProperty("wd")) {
            T++
        }
        return[T, t]
    };
    var J = p(R), Q = J[0], K = J[1], d = K == 0 ? R.sum : 0, h = "<td rowspan='" + Q + "'><input  value='" + R.sum + "'  id='alert_2_money' vmessage='请输入数字' vname='money' maxLength='9' style='width:60px'/></td>", v, M = [], y;
    if (r) {
        for (var O in r) {
            w = H == 0 ? "checked='checked'" : "";
            if (r.hasOwnProperty(O) && r[O].length > 0) {
                B = r[O];
                q = B[0];
                var n = parseInt(O.split("_")[0]);
                v = O.split("_")[1];
                D = o(B, v);
                g = H == 0 ? h : "";
                y = "<tr><td>" + q[5] + "</td><td>" + D + "</td><td>" + q[1] + "</td><td>" + q[2] + "</td><td>" + parseFloat(q[3]) + "</td><td><input type='radio' name='caoz' value='" + v + "' " + w + "></td>" + g + "</tr>";
                M[n] = y;
                H++
            }
        }
        z += M.join("")
    }
    if (N) {
        for (var O in N) {
            if (N.hasOwnProperty(O) && N[O].length > 0) {
                for (var F = 0, m = N[O].length; F < m; F++) {
                    g = H == 0 ? h : "";
                    w = N[O];
                    z += "<tr><td>" + w[F][2] + "</td><td></td><td>" + w[F][0] + "</td><td></td><td>" + parseFloat(w[F][1]) + "</td><td></td>" + g + "</tr>"
                }
                H++
            }
        }
    }
    var s = R.wd;
    if (s) {
        tr = document.createElement("tr");
        w = E ? "checked='checked'" : "";
        g = H == 0 ? h : "";
        z += "<tr><td>外调补货</td><td>&nbsp;</td><td id='pankou'>" + s[0] + "</td><td><input  value='" + s[1] + "' id='alert_2_water' vmessage='请输入数字' vname='water'/></td><td><input  value='" + s[2] + "' id='alert_2_odds' vmessage='请输入数字' vname='odds'/></td><td><input type='radio' name='caoz'  id='waidiaoradio' " + w + "/></td>" + g + "</tr>";
        x.appendChild(tr)
    }
    var L = document.getElementById(C);
    if (L) {
        $(L).html(z);
        var I = "corps";
        $("tr", L).bind("change click", function (T) {
            var c = T.target, t, S = c.parentNode.parentNode;
            if (c.nodeName == "SELECT" && T.type == "change") {
                t = c.value.split("|");
                S.cells[2].innerHTML = t[1];
                S.cells[3].innerHTML = t[2];
                S.cells[4].innerHTML = parseFloat(t[3])
            }
        })
    }
};
P.Mod.supervision_nav_sc = function (g, b) {
    var h = this;
    this.dom = g;
    this.timesold = $("#timesold", g);
    this.timesnow = $("#timesnow", g);
    this.level = P.Set.level;
    P.Utl.winSetData(P.Set);
    var f = P.Set.systype, d = "", c = "";
    switch (f) {
        case"klc":
            d = "klc";
            c = "";
            break;
        case"ssc":
            d = "";
            c = "_sc";
            break;
        case"pk10":
            d = c = "_pk10";
            break;
        case"nc":
            d = c = "_nc";
            break;
        case"ks":
            d = c = "_ks";
            break
    }
    $("li", this.dom).bind("click", function (n) {
        if (P.Set.systype != "pk10") {
            $(this).siblings().removeClass("active");
            $(this).addClass("active")
        }
        G.RequestQueue = {};
        var m = $("#supervision" + c).Module();
        if (m) {
            m.changeNav(this.id)
        }
    });
    $("#timeopen" + d).bind("CountDownStop", function (m, n) {
        setTimeout(function () {
            P.Utl.quickAjax(h.dom)
        }, b || 10000)
    })
};
P.Mod.supervision_nav_sc.prototype.setData = function (h) {
    var c = document.getElementById(this.dom[0].id);
    if (!c) {
        return
    }
    var g = "", b = "", f = P.Set.systype;
    switch (f) {
        case"klc":
            g = "";
            b = "klc";
            break;
        case"ssc":
            g = "_sc";
            b = "";
            break;
        case"pk10":
            g = b = "_pk10";
            break;
        case"nc":
            g = b = "_nc";
            break;
        case"ks":
            g = b = "_ks";
            break
    }
    var m = h.betnotice;
    if (m) {
        this.timesold.html(m.timesold ? m.timesold : "");
        this.timesnow.html(m.timesnow ? m.timesnow : "");
        if (m.timeclose == m.timeopen && m.timeopen == 0) {
            P.Utl.CountDown("#timeclose" + b, 1);
            P.Utl.CountDown("#timeopen" + b, 1)
        } else {
            if (m.timeclose !== undefined) {
                P.Utl.CountDown("#timeclose" + b, m.timeclose, "#supervision" + g)
            }
            if (m.timeopen !== undefined) {
                P.Utl.CountDown("#timeopen" + b, m.timeopen, "#supervision" + g + ",#timeopen" + b)
            }
        }
    } else {
        P.Utl.CountDown("#timeclose" + b, 1);
        P.Utl.CountDown("#timeopen" + b, 1)
    }
    if (h.intoAccount) {
        $("#navIntegrate", this.dom).html(h.intoAccount.integrate)
    }
    $("body").trigger("cpschanel", ["win", "add", P.Utl.winSetData]);
    P.Utl.nCLBindData(h);
    if (m && m.status == 0 && h.drawStatus == 1) {
        if (m.timeopen > P.Set.qajaxT && (f == "klc" ? m.timeopen <= 540 : true)) {
            P.Utl.quickAjax(this.dom)
        }
    }
    P.Utl.winSetData(h.win ? h : P.Set)
};
P.Mod.supervision_nav_sc.prototype.unbind = function () {
    P.Mod.supervision_nav.prototype.unbind.call(this)
};
P.Mod.supervision_nav_sc.prototype.rebind = function () {
    P.Mod.supervision_nav.prototype.rebind.call(this)
};
P.Mod.supervision_nav = function (b) {
    P.Mod.supervision_nav_sc.call(this, b, 60000)
};
P.Mod.supervision_nav.prototype.setData = function (b) {
    P.Mod.supervision_nav_sc.prototype.setData.call(this, b)
};
P.Mod.supervision_nav.prototype.unbind = function () {
    $("body").trigger("cpschanel", ["win", "del"]);
    if (this.getResults) {
        this.getResults.hide();
        this.getResults = null
    }
    this.changeNav_focus && this.changeNav_focus("sumDT");
    $("#timecloseklc,#timeopenklc,#timeclose,#timeopen,#timeclose_pk10,#timeopen_pk10,#timeclose_nc,#timeopen_nc").html("")
};
P.Mod.supervision_nav.prototype.rebind = function () {
    G.RequestQueue = {};
    if (this.level == 0) {
        $("body").trigger("cpschanel", ["win", "del"])
    }
};
P.Mod.supervision_nav.prototype.changeNav_focus = function (c) {
    var b = this;
    $("li", b.dom).removeClass("active");
    $("#" + c).addClass("active")
};
P.Mod.supervision_nav_pk10 = function (b) {
    P.Mod.supervision_nav_sc.call(this, b)
};
P.Mod.supervision_nav_pk10.prototype.setData = function (b) {
    P.Mod.supervision_nav_sc.prototype.setData.call(this, b)
};
P.Mod.supervision_nav_pk10.prototype.unbind = function () {
    P.Mod.supervision_nav.prototype.unbind.call(this)
};
P.Mod.supervision_nav_pk10.prototype.rebind = function () {
    P.Mod.supervision_nav.prototype.rebind.call(this)
};
P.Mod.supervision_nav_nc = function (b) {
    P.Mod.supervision_nav_sc.call(this, b)
};
P.Mod.supervision_nav_nc.prototype.setData = function (b) {
    P.Mod.supervision_nav_sc.prototype.setData.call(this, b)
};
P.Mod.supervision_nav_nc.prototype.unbind = function () {
    P.Mod.supervision_nav.prototype.unbind.call(this)
};
P.Mod.supervision_nav_nc.prototype.rebind = function () {
    P.Mod.supervision_nav.prototype.rebind.call(this)
};
P.Mod.supervision_nav_nc.prototype.changeNav_focus = function (b) {
    P.Mod.supervision_nav.prototype.changeNav_focus.call(this, b)
};
P.Mod.supervision_nav_ks = function (b) {
    P.Mod.supervision_nav_sc.call(this, b)
};
P.Mod.supervision_nav_ks.prototype.setData = function (b) {
    P.Mod.supervision_nav_sc.prototype.setData.call(this, b)
};
P.Mod.supervision_nav_ks.prototype.unbind = function () {
    P.Mod.supervision_nav.prototype.unbind.call(this)
};
P.Mod.supervision_nav_ks.prototype.rebind = function () {
    P.Mod.supervision_nav.prototype.rebind.call(this)
};
P.Mod.supervision_pk10 = function (g) {
    this.play = "li1_pk10";
    P.Mod.supervision_sc.prototype.init.call(this, g);
    var f = $("tr[name]"), b = f.length, h = {};
    for (var c = 0; c < b; c++) {
        var d = f[c];
        h["tr" + d.getAttribute("name")] = d
    }
    this.trcache = h
};
P.Mod.supervision_pk10.prototype.setData = function (d) {
    P.Mod.supervision_sc.prototype.cSetData.call(this, d);
    var c = d.supervision;
    if (c) {
        var b = {};
        b.supervision = c;
        this.setDataOnly(b)
    }
    d = null
};
P.Mod.supervision_pk10.prototype.setDataOnly = function (b) {
    P.Mod.supervision_sc.prototype.setDataOnly.call(this, b)
};
P.Mod.supervision_pk10.prototype.timeRefresh = function (b) {
    P.Mod.supervision.prototype.timeRefresh.call(this, b)
};
P.Mod.supervision_pk10.prototype.ajax_getPage = function (b, c) {
    P.Mod.supervision.prototype.ajax_getPage.call(this, b, c)
};
P.Mod.supervision_pk10.prototype.getPage = function (b, c) {
    P.Mod.supervision.prototype.getPage.call(this, b, c)
};
P.Mod.supervision_pk10.prototype.zdetail = function (b) {
    return P.Mod.supervision.prototype.zdetail.call(this, b)
};
P.Mod.supervision_pk10.prototype.unbind = function () {
    var b = this;
    if (b.autoRefresh) {
        b.autoRefresh.data.handicap = "A";
        b.autoRefresh.data.buhuoStatus = 1;
        b.autoRefresh.data.play = "li1_pk10";
        b.autoRefresh.hide()
    }
    if (b.alert) {
        delete b.alert
    }
    b.handicap = "A";
    b.buhuoStatus = 1;
    this.changeNav("li1_pk10");
    this.play = "li1_pk10";
    $("#buhuoStatus")[0].options[0].selected = true;
    $("#handicap")[0].options[0].selected = true
};
P.Mod.supervision_pk10.prototype.keypress = function (b, c) {
    P.Mod.supervision_sc.prototype.keypress.call(this, b, c)
};
P.Mod.supervision_pk10.prototype.errors = function (d, c, b) {
    P.Mod.supervision_sc.prototype.errors.call(this, d, c, b)
};
P.Mod.supervision_pk10.prototype.changeNav = function (d) {
    var m = this;
    var h = $(".supervision-title", m.dom).show(), g = $(".s-left", m.dom).show(), f = $(".s-right", m.dom).show(), b = $("#zhangdan").show(), c = {};
    c.li1_pk10 = "<option value='all'>全部</option><option value='037'>冠亚和</option><option value='035|036'>两面</option>";
    c.li2_pk10 = "<option value='all'>全部</option><option value='000|010|020|030'>冠军</option><option value='001|011|021|031'>亚军</option><option value='002|012|022|032'>第三名</option><option value='003|013|023|033'>第四名</option><option value='004|014|024|034'>第五名</option>";
    c.li3_pk10 = "<option value='all'>全部</option><option value='005|015|025'>第六名</option><option value='006|016|026'>第七名</option><option value='007|017|027'>第八名</option><option value='008|018|028'>第九名</option><option value='009|019|029'>第十名</option>";
    $("#" + d).addClass("active").siblings().removeClass("active");
    switch (d) {
        case"lizhangdan":
            h.hide();
            g.hide();
            f.hide();
            break;
        default:
            b.hide();
            $(".ul_pk10 li").hide();
            $("." + d).show();
            $(".opts").html(c[d]);
            this.play = d;
            this.autoRefresh.data.play = d;
            this.timeRefresh()
    }
    $(".g-vd-error").removeClass("g-vd-error");
    $(".g-vd-s-error").removeClass("g-vd-s-error")
};
P.Mod.supervision_nc = function (b) {
    P.Mod.supervision.call(this, b)
};
P.Mod.supervision_nc.prototype.setData = function (b) {
    P.Mod.supervision.prototype.setData.call(this, b)
};
P.Mod.supervision_nc.prototype.sortdata = function (b, c) {
    P.Mod.supervision.prototype.sortdata.call(this, b, c)
};
P.Mod.supervision_nc.prototype.setDataOnly = function (b) {
    P.Mod.supervision.prototype.setDataOnly.call(this, b)
};
P.Mod.supervision_nc.prototype.timeRefresh = function (b) {
    P.Mod.supervision.prototype.timeRefresh.call(this, b)
};
P.Mod.supervision_nc.prototype.ajax_getPage = function (b, c) {
    P.Mod.supervision.prototype.ajax_getPage.call(this, b, c)
};
P.Mod.supervision_nc.prototype.getPage = function (b, c) {
    P.Mod.supervision.prototype.getPage.call(this, b, c)
};
P.Mod.supervision_nc.prototype.zdetail = function (b) {
    return P.Mod.supervision.prototype.zdetail.call(this, b)
};
P.Mod.supervision_nc.prototype.keypress = function (b, c) {
    P.Mod.supervision_sc.prototype.keypress.call(this, b, c)
};
P.Mod.supervision_nc.prototype.unbind = function () {
    P.Mod.supervision.prototype.unbind.call(this)
};
P.Mod.supervision_nc.prototype.errors = function (d, c, b) {
    P.Mod.supervision_sc.prototype.errors.call(this, d, c, b)
};
P.Mod.supervision_nc.prototype.changeNav = function (b) {
    P.Mod.supervision.prototype.changeNav.call(this, b)
};
P.Mod.supervision_ks = function (b) {
    P.Mod.supervision_sc.call(this, b)
};
P.Mod.supervision_ks.prototype.setData = function (f) {
    P.Mod.supervision_sc.prototype.cSetData.call(this, f);
    var n = f.supervision;
    if (n) {
        var o = {};
        o.supervision = n;
        this.setDataOnly(o)
    }
    if (f.gameSum) {
        var b = $(".sup-th"), q = f.gameSum, m = q.length, r;
        for (var g = 0; g < m; g++) {
            r = b[g];
            if (r) {
                r.innerHTML = q[r.id]
            }
        }
    }
    if (f.gameSum1) {
        var p = $(".sup-th1"), c = f.gameSum1, d = c.length, h;
        for (var g = 0; g < d; g++) {
            h = p[g];
            if (h) {
                h.innerHTML = c[parseInt(h.id, 10)]
            }
        }
    }
    f = null
};
P.Mod.supervision_ks.prototype.setDataOnly = function (b) {
    P.Mod.supervision_sc.prototype.setDataOnly.call(this, b)
};
P.Mod.supervision_ks.prototype.timeRefresh = function (b) {
    P.Mod.supervision.prototype.timeRefresh.call(this, b)
};
P.Mod.supervision_ks.prototype.ajax_getPage = function (b, c) {
    P.Mod.supervision.prototype.ajax_getPage.call(this, b, c)
};
P.Mod.supervision_ks.prototype.getPage = function (b, c) {
    P.Mod.supervision.prototype.getPage.call(this, b, c)
};
P.Mod.supervision_ks.prototype.zdetail = function (b) {
    return P.Mod.supervision.prototype.zdetail.call(this, b)
};
P.Mod.supervision_ks.prototype.unbind = function () {
    P.Mod.supervision_sc.prototype.unbind.call(this)
};
P.Mod.supervision_ks.prototype.keypress = function (b, c) {
    P.Mod.supervision_sc.prototype.keypress.call(this, b, c)
};
P.Mod.supervision_ks.prototype.errors = function (d, c, b) {
    P.Mod.supervision_sc.prototype.errors.call(this, d, c, b)
};
P.Mod.supervision_ks.prototype.changeNav = function (b) {
    P.Mod.supervision_sc.prototype.changeNav.call(this, b)
};
P.Mod.supervision_ks.prototype.init = function (b) {
    P.Mod.supervision_sc.prototype.init.call(this, b)
};
P.Mod.corporationBH = function (d) {
    this.dom = d;
    var g = this, o = d[0].id, n = this.change, b = this.getdata, p = this.resetoption, c = $("#cortable"), h = $("#memtable"), f = function (r) {
        var t;
        for (var s = 0, q = r.length; s < q; s++) {
            t = r[s];
            if (t.type == "text") {
                t.defaultValue = t.value
            } else {
                if (t.type == "checkbox") {
                    t.defaultChecked = t.checked
                }
            }
        }
    }, m = {rules: {account: {required: 1, regExp: /^[a-z0-9A-Z][a-z0-9A-Z_]{0,11}$/}, password: {required: 1, regExp: /^[0-9a-zA-Z]{6,16}$/}, newpassword: {required: 1, regExp: /^[0-9a-zA-Z]{6,16}$/, equalTo: "password"}, order: {required: 1, regExp: /^[1-9]\d{0,2}$/}}, onblur: false, errorMessages: {account: {required: "请输入账号！", regExp: "账号由1-12位英文字母、数字、下划线组成，且第一位不能是下划线"}, password: {required: "请输入密码！", regExp: "密码必须为6~16位的数字或字母组成！"}, newpassword: {required: "请输入确认密码！", regExp: "密码必须为6~16位的数字或字母组成", equalTo: "密码与确认密码须一致！"}, order: {required: "请输入优先顺序", regExp: "优先顺序由1-999的整数组成"}}};
    d.bind("click", function (H) {
        var L = H.target, A = L.id, E = false, J = L.className;
        var v = P.Set.systype;
        if (A == "submit_cor") {
            E = n("#company", function (Q, S, O) {
                var N = b(Q);
                var R = N[0];
                $.UT.publicGetAction(o, R, function (T) {
                    S(R, O);
                    f(Q);
                    $.UT.Alert({text: "保存成功", booLean: false});
                    if (T) {
                        g.setData(T)
                    }
                }, "setCompany_" + v)
            }, p, g.cache);
            return
        }
        if (A == "submit_mem") {
            var t = $("#member input");
            var q = b(t);
            var y = q[0];
            var E = n(h);
            if (y && E) {
                $.UT.publicGetAction(o, {id: q[1]}, function (N) {
                    f(t);
                    $.UT.Alert({text: "保存成功", booLean: false});
                    if (N) {
                        g.setData(N)
                    }
                }, "saveLevel_" + v)
            }
        }
        if (J == "delete") {
            var w = L.getAttribute("cid");
            var F = L.getAttribute("delflag");
            if (F == "1") {
                return
            }
            $.UT.Alert({text: "确定要删除吗？", determineCallback: function () {
                L.setAttribute("delflag", "1");
                var N = {id: w};
                $.UT.publicGetAction(o, N, function (O) {
                    $(L.parentNode.parentNode).remove();
                    if (O) {
                        g.setData(O)
                    }
                }, "delMember_" + v)
            }})
        }
        if (A == "addMember") {
            var C = $("#buhuolist"), M = C.val();
            if (M == "-1") {
                $.UT.Alert({text: "请选择补货公司", booLean: false})
            } else {
                var z = $("#template").val();
                var x = $.UT.Alert({text: z, title: "可补货公司", validate: m, determineCallback: function () {
                    var O = {companyId: M, account: $("#account").val(), password: $("#password").val(), level: $("#level").val()};
                    var N = document.getElementById(M).innerHTML;
                    $.UT.publicGetAction(o, O, function (Q) {
                        if (Q) {
                            g.setData(Q)
                        }
                    }, "addMember_" + v)
                }, width: 350});
                var r = C[0].options[C[0].selectedIndex].innerHTML;
                $("#corpName").html(r);
                $("input", x.dom).bind("keydown", function (N) {
                    if (N.keyCode == 13) {
                        x.determine.click()
                    }
                })
            }
        }
        if (A == "allcheck") {
            var I = L.checked;
            var s = $("#company input"), B = s.length, K;
            if (B > 0) {
                for (var D = 0; D < B; D++) {
                    K = s[D];
                    if (K.checked != I) {
                        K.checked = I
                    }
                }
            }
        }
    })
};
P.Mod.corporationBH.prototype.setData = function (b) {
    this.corp(b);
    this.member(b)
};
P.Mod.corporationBH.prototype.corp = function (n) {
    $("#allcheck").removeAttr("checked");
    var c = n.company || [], m = "", h = c.length, b = ['<option value="-1">请选择补货公司</option>'], d = {};
    if (h > 0) {
        c = $.map(c, function (p, o) {
            var q = p[2] == 1 ? "checked='true'" : "";
            if (q) {
                b.push("<option id='" + p[0] + "' value='" + p[0] + "'>" + p[1] + "</option>")
            }
            d[p[0]] = p[1];
            return"<th><input type='checkbox' cid='" + p[0] + "'" + q + "/></th><td>" + p[1] + "</td>"
        });
        var g = "<th>&nbsp;</th><td>&nbsp;</td>";
        for (var f = 0; f < h; f += 4) {
            m += "<tr>" + c[f] + (c[f + 1] || g) + (c[f + 2] || g) + (c[f + 3] || g) + "</tr>"
        }
    } else {
        m = "<tr><td colspan='8'>暂无数据</td></tr>"
    }
    this.cache = d;
    $("#company").html(m);
    $("#buhuolist").html(b.join(""))
};
P.Mod.corporationBH.prototype.member = function (f) {
    var h = f.member || [], g;
    var d = "";
    if (h.length > 0) {
        for (var c = 0, b = h.length; c < b; c++) {
            g = h[c];
            g[3] = (g[3] == "停押" || g[3] == "停用") ? "<span class='reder'>" + g[3] + "</span>" : g[3];
            d += "<tr><th>" + g[1] + "</th><td>" + g[2] + "</td><td>" + g[3] + "</td><td>" + g[4] + "</td><td><a  cid='" + g[0] + "'  class='delete' href='javascript:'>删除</a></td><td><input value='" + g[5] + "'  val='" + g[5] + "'  cid='" + g[0] + "'/></td></tr>"
        }
    } else {
        d = "<tr id='nodata_bhc'><td colspan='6'>暂无数据</td></tr>"
    }
    $("#member").html(d)
};
P.Mod.corporationBH.prototype.change = function (n, o, m, b) {
    var f = $("input", n), c, p = false, g = [];
    if (f.length > 0) {
        for (var d = 0, h = f.length; d < h; d++) {
            c = f[d];
            if (c.type == "checkbox") {
                if (c.checked != c.defaultChecked) {
                    p = true;
                    g.push(c)
                }
            }
            if (c.type == "text") {
                if (c.defaultValue != c.value) {
                    p = true;
                    g.push(c)
                }
            }
        }
        if (o && p) {
            o.call(null, g, m, b)
        }
    }
    if (!p) {
        $.UT.Alert({text: "请做修改后再保存", booLean: false})
    }
    return p
};
P.Mod.corporationBH.prototype.getdata = function (f) {
    var h = {}, d, n, m, c = [];
    for (var g = 0, b = f.length; g < b; g++) {
        d = f[g];
        n = d.getAttribute("cid");
        if (d.type == "checkbox") {
            m = d.checked ? 1 : 0;
            c.push(n)
        }
        if (d.type == "text") {
            m = d.value;
            if (!(/^[1-9]\d{0,2}$/.test(m))) {
                $.UT.Alert({text: "优先顺序由1-999的整数组成", booLean: false, determineCallback: function () {
                    d.select()
                }});
                return false
            }
            c.push([n, m])
        }
        h[n] = m
    }
    return[h, c]
};
P.Mod.corporationBH.prototype.resetoption = function (f, c) {
    var h = this, d = "";
    for (var g in f) {
        if (f.hasOwnProperty(g)) {
            if (f[g] == 0) {
                $("#" + g).remove()
            } else {
                d += "<option id='" + g + "' value='" + g + "'>" + c[g] + "</option>"
            }
        }
    }
    $("#buhuolist").append(d);
    var b = $("#cortable input:checked").length;
    if (b == 0) {
    }
};
P.Mod.corporationBH.prototype.rebind = function () {
    $("#allcheck").removeAttr("checked");
    $("#buhuolist option").slice(1).remove()
};
P.Mod.corporationBH.prototype.insertRow = function (h, o) {
    var f = $("#member")[0], p = f.rows, n, b = 0;
    for (var d = 0, g = p.length; d < g; d++) {
        n = $("input", p[d]).attr("val");
        if (parseInt(h, 10) < parseInt(n, 10)) {
            b = d;
            break
        }
        if (d == g - 1) {
            b = g
        }
    }
    var m = f.insertRow(b);
    $(m).html(o)
};
$.extend({logjs: null, log4js_cfg: {css_path: "/webssc/js/plugins/log4js.css", js_path: "/webssc/js/plugins/", ajax_path: "klc/frontendlog/", ajax_timer: 300 * 1000, log4js_type: 4, log4js_level: "error"}, log_debug: function (b) {
    $.log4js(b, "debug")
}, log_info: function (b) {
    $.log4js(b, "info")
}, log_error: function (b) {
    $.log4js(b, "error")
}, log4js: function (c, d) {
    if (!$.log4js_cfg.log4js_type) {
        return
    }
    d = d ? d : "info";
    var b = self == top ? $.logjs : parent.$.logjs;
    if (b == null) {
        return
    }
    switch (d) {
        case"trace":
            b.trace(c);
            break;
        case"debug":
            b.debug(c);
            break;
        case"info":
            b.info(c);
            break;
        case"warn":
            b.warn(c);
            break;
        case"error":
            b.error(c);
            break;
        case"fatal":
            b.fatal(c);
            break;
        default:
            b.info(c);
            break
    }
}, initLog4js: function () {
    $.log4js_cfg.ajax_path = "klc/frontendlog/?=ajax", timeHander = setTimeout(function () {
        timeHander = null;
        $._initLog4js()
    }, 10000)
}, _initLog4js: function () {
    if (!$.log4js_cfg.log4js_type) {
        return
    }
    var b = null;
    switch ($.log4js_cfg.log4js_type) {
        case 1:
            b = "log4javascript_uncompressed.js";
            break;
        case 2:
            b = "log4javascript_lite.js";
            break;
        case 3:
            b = "log4javascript.js";
            break;
        case 4:
            b = "log4javascript_ajax_min.js";
            break
    }
    var c = function () {
        cssfile = document.createElement("link");
        cssfile.setAttribute("rel", "stylesheet");
        cssfile.setAttribute("type", "text/css");
        cssfile.setAttribute("href", $.log4js_cfg.css_path)
    };
    if ($.log4js_cfg.log4js_type != 4) {
        c()
    }
    $.ajax({type: "GET", url: $.log4js_cfg.js_path + b + "?" + P.Set.version, dataType: "script", success: function (g) {
        var d = null;
        var h = log4javascript.Level[$.log4js_cfg.log4js_level.toUpperCase()];
        switch ($.log4js_cfg.log4js_type) {
            case 1:
                $.logjs = log4javascript.getLogger("main");
                $.logjs.setLevel(h);
                d = new log4javascript.InPageAppender();
                $.logjs.addAppender(d);
                break;
            case 2:
                $.logjs = log4javascript.getDefaultLogger();
                $.logjs.setLevel(h);
                break;
            case 3:
                $.logjs = log4javascript.getLogger("main");
                $.logjs.setLevel(h);
                d = new log4javascript.PopUpAppender();
                var f = new log4javascript.PatternLayout("%d{HH:mm:ss-SSS} %-5p - %m%n");
                d.setLayout(f);
                $.logjs.addAppender(d);
                break;
            case 4:
                $.logjs = log4javascript.getLogger();
                $.logjs.setLevel(h);
                d = new log4javascript.AjaxAppender($.log4js_cfg.ajax_path);
                d.setWaitForResponse(true);
                d.setBatchSize(10);
                d.setLayout(new log4javascript.JsonLayout());
                d.setTimed(true);
                d.setTimerInterval($.log4js_cfg.ajax_timer);
                $.logjs.addAppender(d);
                break
        }
    }})
}});
P.Mod.header = function (y) {
    this.dom = y;
    var v = this;
    this.Time = 0;
    this.consolealert = [];
    this.layout = $("#layout").data("Module");
    $(".fastopening").bind("click", function () {
        var H = {key: "open"}, E = P.Set.systype;
        var x = "on_off_draws_" + E;
        var D = $(".fastopening").attr("operate");
        if (!D || D == "no") {
            return false
        }
        var F = "确定快速开盘？";
        $.UT.Alert({text: F, determineCallback: function () {
            $.UT.publicGetAction(v.dom[0].id, H, function (I) {
                v.setData(I)
            }, x)
        }})
    });
    $(".fastclosing").bind("click", function () {
        var H = {key: "close"}, E = P.Set.systype;
        var x = "on_off_draws_" + E;
        var D = $(".fastclosing").attr("operate");
        if (!D || D == "no") {
            return false
        }
        var F = "确定快速关盘？";
        $.UT.Alert({text: F, determineCallback: function () {
            $.UT.publicGetAction(v.dom[0].id, H, function (I) {
                v.setData(I)
            }, x)
        }})
    });
    this.marqueeDom = $("#marqueeBox", y);
    $("div.main-nav li", y).bind("click", function (E) {
        var x = E.target;
        x = x.nodeName == "LI" ? x : x.parentNode;
        var F = $(x).children("a")[0].getAttribute("nav");
        if (F) {
            var D = $("#sub_nav").data("Module");
            if (D) {
                $(D.Li[0]).addClass("on").siblings().removeClass("on")
            }
            v.changeNav(F, x)
        }
        return false
    });
    $("#lineSelect").bind("click", function (H) {
        if (document.getElementById("lineSelectBox").style.display == "block") {
            return false
        }
        if (P.Set.lines) {
            var x = P.Set.lines, D = "";
            if (x.length > 0) {
                for (var E = 0; E < x.length; E++) {
                    D += "<li><span>线路" + (E + 1) + ':&nbsp;</span><span class="timebox">反应时间:</span><input type="button" line="' + x[E] + '" value="选择" height="24" /></li>'
                }
                $("ul", "#lineSelectBox").html(D)
            } else {
                $("ul", "#lineSelectBox").html("")
            }
        }
        document.getElementById("lineSelectBox").style.display = "block";
        var F = document.getElementById("lineBoxMask");
        if (F) {
            F.style.display = "block";
            $(F).height($(document.body).height())
        }
        $(window).bind("resize", function (I, J) {
            $(F).height($(document.body).height())
        });
        setTimeout(function () {
            d();
            z(0)
        }, 0)
    });
    $("#lineSelectBox").bind("click", function (F) {
        var x = $(F.target);
        if (x[0].nodeName == "INPUT") {
            var D = x.attr("line") + "?" + $.UT.Param($.UT.Cookie()) + "&navNum=" + P.Set.navNum + "&portty=" + P.Set.porttype;
            window.location.href = D
        }
        if (x[0].id == "lineSelClose") {
            document.getElementById("lineSelectBox").style.display = "none";
            var E = document.getElementById("lineBoxMask");
            if (E) {
                E.style.display = "none"
            }
        }
        if (x[0].id == "lineTestSudu" && !x.attr("disabled")) {
            d();
            z(0)
        }
    });
    var p, t, f = 0, g = document.getElementById("lineTestSudu"), w = document.getElementById("speed");
    var q = [], m = null;
    var d = function () {
        p = $("li", "#lineSelectBox");
        var E = "";
        for (var D = 0; D < p.length; D++) {
            var x = {};
            E = D + "";
            x.img = document.createElement("img");
            x.url = $("input", p[D]).attr("line").split("/").slice(0, 3).join("/") + "/speed.gif?";
            x.time = 0;
            x.number = 0;
            x.img.onerror = c;
            x.img.onload = B;
            x.img.id = E;
            x.loadTime = [];
            x.stop = false;
            q[D] = x
        }
    };
    var s = function (D) {
        clearTimeout(m);
        p = $("li", "#lineSelectBox");
        m = null;
        if (!D) {
            for (var x = p.length - 1; x >= 0; x--) {
                if ($("font", p[x]).length) {
                    $("font", p[x])[0].innerHTML = ""
                }
            }
        }
    };
    var z = function (D) {
        s(D);
        p = $("li", "#lineSelectBox");
        g.setAttribute("disabled", "disabled");
        $(g).removeClass("yellow-btn btn_m elem_btn");
        var x = "";
        if (q.length > 0 && q[D]) {
            if ($(".timebox font", p[D]).length > 0) {
                $(".timebox font", p[D])[0].innerHTML = "測速中";
                $(".timebox font", p[D])[0].id = D + "m"
            } else {
                $(".timebox", p[D]).append('<font id="' + D + 'm">測速中</font>');
                w.appendChild(q[D].img)
            }
            q[D].img.src = q[D].url + (Math.random() + "").replace("0.", "");
            q[D].time = new Date().getTime();
            q[D].stop = false;
            m = setTimeout(function () {
                c.call(q[D].img, D)
            }, 5000)
        } else {
            g.removeAttribute("disabled");
            $(g).addClass("yellow-btn btn_m elem_btn")
        }
    };

    function c(D) {
        var x = this.id;
        if (typeof D === "number") {
            x = D
        }
        x = parseInt(x, 10);
        if (document.getElementById(this.id + "m")) {
            if (!q[parseInt(x, 10)].stop) {
                q[parseInt(x, 10)].number = 0;
                q[parseInt(x, 10)].stop = true;
                if (document.getElementById(x + "m").innerHTML != "超时" || document.getElementById(x + "m").innerHTML == "测速中") {
                    document.getElementById(x + "m").innerHTML = "无法连接"
                }
            }
            setTimeout(function () {
                z(x + 1)
            }, 500)
        }
    }

    function B() {
        var D = new Date().getTime(), K = parseInt(this.id, 10), H = q[K], J = H.number ? D - q[K].time : D - q[K].time, F = 0;
        q[K].loadTime.push(J);
        q[K].number += 1;
        if (q[K].stop) {
            return
        }
        if (q[K].number < 2) {
            setTimeout(function () {
                z(K)
            }, 500)
        } else {
            for (var I = 0; I < 2; I++) {
                F += H.loadTime[I]
            }
            var E = (F / 2).toFixed(2), x = document.getElementById(K + "m");
            if (E > 50) {
                x.style.color = "red"
            } else {
                x.style.color = "green"
            }
            x.innerHTML = E + "毫秒";
            f -= 1;
            q[K].number = 0;
            q[K].loadTime.length = 0;
            q[K].stop = true;
            setTimeout(function () {
                z(K + 1)
            }, 500)
        }
    }

    if (P.Set.navNum == 12) {
        $(".main-nav ul li.on", y).removeClass("on")
    }
    if (P.Set.firstLogin != 1) {
        this.layout.setLayout(P.Set.navNum);
        $("li").not($("li[show]")).show();
        P.Utl.accessControl(y)
    } else {
        $("li[show]").hide();
        $("#select_sys").hide();
        $(".fast-closing,.fast-opening").hide();
        this.layout.setLayout(10)
    }
    var n = $.UT.Cookie("sysinfo"), C = "/" + window.location.pathname.split("/")[1] + "/", h = "get_json_klc";
    if (n && n.length > 1) {
        var r = n.split("|");
        if (r.length > 1) {
            P.Set.systype = r[0];
            $.UT.Cookie("sysinfo", r[0] + "|" + r[1] + "|a|0|0", {path: C});
            var b = $(".switch");
            P.Set.navNumber = P.Set["navNumber_" + P.Set.systype];
            $(".switch-on").removeClass("switch-on");
            h = "get_json_" + P.Set.systype;
            $("#" + P.Set.systype + "_sys")[0].className = "switch-on switch";
            var A = $("#layout").data("Module");
            if (P.Set.firstLogin != 1) {
                A.setLayout(P.Set.navNum)
            }
            if (r[2] != "a" && P.Set.noticeBox == "1") {
                P.Utl.announcement("#333")
            }
            $.UT.publicGetAction("header", {sys: P.Set.systype}, function (x) {
                v.setData(x)
            }, h)
        }
    } else {
        $.UT.Cookie("sysinfo", (P.Utl.severTime().hours > 22 || P.Utl.severTime().hours < 3 ? "ssc" : "klc") + "|1|a|0|0", {path: C})
    }
    var o = $("li[show=QSGL]", y);
    if (o.css("display") == "none") {
        $(".fastopening, .fastclosing", y).hide()
    }
    if ($(window).width() < 1015) {
        document.body.style.cssText = "width:1015px";
        $("html").css("overflow-x", "")
    } else {
        document.body.style.cssText = "";
        $("html").css("overflow-x", "hidden")
    }
    $("#layout").height($(window).height() - 83);
    $(window).resize(function (x) {
        if ($(window).width() < 1015) {
            document.body.style.cssText = "width:1015px";
            $("html").css("overflow-x", "")
        } else {
            document.body.style.cssText = "";
            $("html").css("overflow-x", "hidden")
        }
        $("#layout").height($(window).height() - 83)
    });
    this.autoRhObj = {urlId: v.dom[0].id, action: h, data: {key: G.Channel}, keepOn: true, callback: function (x) {
        v.setData(x)
    }};
    this.marqueeRefresh = $("#marqueeRefresh", y).Widget("AutoRefresh", v.autoRhObj);
    if (v.t) {
        v.marqueeRefresh.show(v.t)
    } else {
        v.marqueeRefresh.show(5)
    }
    this.marqueeDom.bind("mouseover",function () {
        this.stop()
    }).bind("mouseout", function () {
        this.start()
    });
    $("body").bind("cpschanel", function (E, H, F, D) {
        if (F == "add") {
            if (jQuery.inArray(H, G.Channel) == -1) {
                G.Channel.push(H);
                $("body").bind("cpsdata." + H, function (I, J) {
                    D(J)
                })
            }
        }
        if (F == "del") {
            if (jQuery.inArray(H, G.Channel) != -1) {
                $("body").unbind("cpsdata." + H);
                var x = G.Channel.join("|") + "|";
                H = H + "|";
                x = x.replace(H, "");
                G.Channel = x.split("|");
                if (x.charAt(x.length - 1) == "|") {
                    G.Channel.pop()
                }
            }
        }
        v.autoRhObj.data.key = G.Channel
    });
    document.getElementById("online_num").innerHTML = P.Set.online || 0;
    $("#select_sys").bind("changesys", function () {
        var D = P.Set.systype, x;
        x = "get_json_" + D;
        v.marqueeRefresh.action = x;
        $.UT.publicGetAction("header", {sys: D}, function (E) {
            v.setData(E)
        }, x)
    })
};
P.Mod.header.prototype.setData = function (c) {
    var h = this;
    h.text = "";
    if (!c) {
        return
    }
    for (var d = 0; d < G.Channel.length; d++) {
        $("body").trigger("cpsdata." + G.Channel[d], [c])
    }
    if (c.fastOperating) {
        var g = $("#timeManage").Module();
        if (g && g.thisDom) {
            g.setData(c)
        } else {
            if (c.fastOperating == "2") {
                $(".fastopening").addClass("fast-opening").removeClass("fast-closing").attr("operate", "yes");
                $(".fastclosing").addClass("fast-closing").removeClass("fast-opening").attr("operate", "no")
            } else {
                $(".fastopening").addClass("fast-closing").removeClass("fast-opening").attr("operate", "no");
                $(".fastclosing").addClass("fast-opening").removeClass("fast-closing").attr("operate", "yes")
            }
        }
    }
    if (c.marquee) {
        $("#marqueeBox").html(letterformat(c.marquee, 0))
    }
    if (c.marqueeTime) {
        h.marqueeRefresh.hide();
        h.t = parseInt(c.marqueeTime);
        if (isNaN(h.t)) {
            return
        }
        h.marqueeRefresh.show(h.t)
    }
    if (c.tt) {
        P.Set.tt = c.tt
    }
    if (c.tk) {
        P.Set.tk = c.tk
    }
    var b = c.consolealert;
    if (b && b[0]) {
        if (h.consolealert[0] && h.consolealert[2] == P.Set.systype) {
            if (h.consolealert[0] == b[0]) {
                if (b[1] != h.consolealert[1] && h.consolealert[1] != "2") {
                    if (b[1] && (b[1] == "2" || b[1] == "3")) {
                        var f = b[0] + "期数己开奖完毕。";
                        P.Utl.playmp3(f, "kaijiang", true, 2000);
                        h.dom.triggerHandler("resultnum")
                    }
                }
            } else {
                if (b[1] && (b[1] == "2" || b[1] == "3")) {
                    var f = b[0] + "期数己开奖完毕。";
                    P.Utl.playmp3(f, "kaijiang", true, 2000);
                    h.dom.triggerHandler("resultnum")
                }
            }
        }
        b.push(P.Set.systype);
        h.consolealert = b
    }
    if (c.online) {
        document.getElementById("online_num").innerHTML = c.online
    }
    if (c.lines) {
        P.Set.lines = c.lines
    }
};
P.Mod.header.prototype.changeNav = function (c, b) {
    $(b).addClass("on").siblings().removeClass("on");
    G.RequestQueue = {};
    if (c === "reportForm") {
        P.Set.porttype = b.getAttribute("show") === "ZBACX" ? 0 : 1
    }
    this.layout.setLayout(P.Set.navNumber[c])
};
P.Mod.layout = function (b) {
    this.cols = $.UT.DomSelector($("div", b));
    this.main = this.cols.main;
    this.left = this.cols.left;
    this.right = this.cols.right;
    this.main_nav = this.cols.main_nav;
    P.Set.layout = this;
    P.Utl.publicChengeModule(this.main);
    P.Utl.publicChengeModule(this.right);
    P.Utl.publicChengeModule(this.left);
    P.Utl.publicChengeModule(this.main_nav);
    var c = this;
    $(this.main).bind("changeModule", function (f, d) {
        switch (d) {
            case"supervision":
            case"supervision_sc":
            case"supervision_pk10":
            case"supervision_nc":
            case"supervision_ks":
                $(c.main_nav).show();
                $(c.main).show();
                $(c.right).hide();
                $(c.left).hide();
                P.Utl.publicChengeModule(c.right);
                P.Utl.publicChengeModule(c.left);
                break;
            case"timeManage":
            case"reportForm":
            case"result":
            case"result_pk10":
            case"result_klc":
            case"result_ssc":
            case"result_nc":
            case"result_ks":
            case"operationRecord":
            case"statusmanage":
            case"rule":
            case"change_password":
            case"infop":
            case"notice":
            case"ylch":
            case"timeManage_sc":
            case"rule_sc":
            case"rule_nc":
            case"infop_sc":
            case"infop_pk10":
            case"notice_sc":
            case"ylch_sc":
                $(c.main).show();
                $(c.right).hide();
                $(c.left).hide();
                $(c.main_nav).hide();
                P.Utl.publicChengeModule(c.right);
                P.Utl.publicChengeModule(c.left);
                P.Utl.publicChengeModule(c.main_nav);
                break
        }
    });
    $(this.left).bind("changeModule", function (f, d) {
        switch (d) {
            case"account_nav":
            case"settingsNav":
            case"settingsNav_sc":
                $(c.right).show();
                $(c.left).show();
                $(c.main).hide();
                $(c.main_nav).hide();
                P.Utl.publicChengeModule(c.main);
                P.Utl.publicChengeModule(c.main_nav);
                break
        }
    });
    $(this.main_nav).bind("changeModule", function (f, d) {
        switch (d) {
            case"tongji_nav":
            case"tongji_nav_sc":
            case"tongji_nav_pk10":
            case"tongji_nav_nc":
            case"tongji_nav_ks":
                $(c.main_nav).show();
                $(c.main).show();
                $(c.right).hide();
                $(c.left).hide();
                P.Utl.publicChengeModule(c.right);
                P.Utl.publicChengeModule(c.left);
                break
        }
    })
};
P.Mod.layout.prototype.setLayout = function (f) {
    var m = this;
    G.RequestQueue = {}, sys = P.Set.systype == "klc" ? "klc" : P.Set.systype == "ssc" ? "ssc" : "";
    switch (f) {
        case 1:
            P.Utl.publicChengeModule(m.left, "ajax", "account_nav", "get_html");
            break;
        case 2:
            var d = P.Set.level == 0 ? "get_json" : "get_json_zjs";
            P.Utl.publicChengeModule(m.main_nav, "ajax", "supervision_nav", "get_html");
            P.Utl.publicChengeModule(m.main, "ajax", "supervision", "get_html", d);
            var b = $("#supervision").Module();
            if (b) {
                b.unbind();
                var h = $("#supervision_nav").Module();
                if (h) {
                    h.changeNav_focus("sumDT")
                }
            }
            break;
        case 3:
            P.Utl.publicChengeModule(m.main_nav, "ajax", "tongji_nav", "get_html");
            break;
        case 4:
            P.Utl.publicChengeModule(m.main, "ajax", "timeManage", "get_html", "get_json_klc", {key: "drawsList"}, null, null, {romances: true});
            break;
        case 5:
            P.Utl.publicChengeModule(m.main, "ajax", "reportForm", "get_html", null, function () {
            });
            break;
        case 6:
            P.Utl.publicChengeModule(m.main, "ajax", "result_klc", "get_html", "get_json", null, null, null, {romances: true});
            break;
        case 7:
            P.Utl.publicChengeModule(m.left, "ajax", "settingsNav", "get_html");
            break;
        case 8:
            P.Utl.publicChengeModule(m.main, "ajax", "operationRecord", "get_html", "get_json_klc");
            var g = $("#operationRecord").Module();
            if (g) {
                g.rebind()
            }
            break;
        case 9:
            delete G.cache.htmlCache.rule;
            P.Utl.publicChengeModule(m.main, "ajax", "rule", "get_html_klc");
            break;
        case 10:
            P.Utl.publicChengeModule(m.main, "ajax", "change_password", "get_html");
            break;
        case 11:
            P.Utl.publicChengeModule(m.main, "ajax", "infop", "get_html", "get_json_klc", null, null, null, {romances: true});
            break;
        case 12:
            P.Utl.publicChengeModule(m.main, "ajax", "notice", "get_html", "get_json");
            break;
        case 13:
            P.Utl.publicChengeModule(m.main, "ajax", "ylch", "get_html", "get_json");
            var c = $("#ylch").Module();
            if (c) {
                c.rebind()
            }
            break;
        case 15:
            var d = P.Set.level == 0 ? "get_json" : "get_json_zjs";
            P.Utl.publicChengeModule(m.main_nav, "ajax", "supervision_nav_sc", "get_html");
            P.Utl.publicChengeModule(m.main, "ajax", "supervision_sc", "get_html", d);
            var g = $("#supervision_sc").Module();
            if (g) {
                g.unbind()
            }
            break;
        case 16:
            P.Utl.publicChengeModule(m.main_nav, "ajax", "tongji_nav_sc", "get_html");
            break;
        case 17:
            P.Utl.publicChengeModule(m.main, "ajax", "timeManage", "get_html", "get_json_ssc", {key: "drawsList"}, null, null, {romances: true});
            break;
        case 18:
            P.Utl.publicChengeModule(m.main, "ajax", "result_ssc", "get_html", "get_json", null, null, null, {romances: true});
            break;
        case 19:
            P.Utl.publicChengeModule(m.left, "ajax", "settingsNav", "get_html");
            break;
        case 20:
            P.Utl.publicChengeModule(m.main, "ajax", "operationRecord", "get_html", "get_json_ssc");
            var g = $("#operationRecord").Module();
            if (g) {
                g.rebind()
            }
            break;
        case 21:
            delete G.cache.htmlCache.rule;
            P.Utl.publicChengeModule(m.main, "ajax", "rule", "get_html_ssc");
            break;
        case 22:
            P.Utl.publicChengeModule(m.main, "ajax", "infop", "get_html", "get_json_ssc", null, null, null, {romances: true});
            break;
        case 23:
            P.Utl.publicChengeModule(m.main, "ajax", "ylch_sc", "get_html", "get_json");
            break;
        case 24:
            var d = P.Set.level == 0 ? "get_json" : "get_json_zjs";
            P.Utl.publicChengeModule(m.main_nav, "ajax", "supervision_nav_pk10", "get_html");
            P.Utl.publicChengeModule(m.main, "ajax", "supervision_pk10", "get_html", d);
            var g = $("#supervision_pk10").Module();
            if (g) {
                g.unbind()
            }
            break;
        case 25:
            P.Utl.publicChengeModule(m.main_nav, "ajax", "tongji_nav_pk10", "get_html");
            break;
        case 26:
            P.Utl.publicChengeModule(m.main, "ajax", "result_pk10", "get_html", "get_json", null, null, null, {romances: true});
            break;
        case 27:
            P.Utl.publicChengeModule(m.main, "ajax", "infop", "get_html", "get_json_pk10", null, null, null, {romances: true});
            break;
        case 28:
            P.Utl.publicChengeModule(m.left, "ajax", "settingsNav", "get_html");
            break;
        case 29:
            P.Utl.publicChengeModule(m.main, "ajax", "timeManage", "get_html", "get_json_pk10", {key: "drawsList"}, null, null, {romances: true});
            break;
        case 30:
            P.Utl.publicChengeModule(m.main, "ajax", "operationRecord", "get_html", "get_json_pk10");
            var g = $("#operationRecord").Module();
            if (g) {
                g.rebind()
            }
            break;
        case 31:
            delete G.cache.htmlCache.rule;
            P.Utl.publicChengeModule(m.main, "ajax", "rule", "get_html_pk10");
            break;
        case 32:
            P.Utl.publicChengeModule(m.main_nav, "ajax", "tongji_nav_nc", "get_html");
            break;
        case 33:
            var d = P.Set.level == 0 ? "get_json" : "get_json_zjs";
            P.Utl.publicChengeModule(m.main_nav, "ajax", "supervision_nav_nc", "get_html");
            P.Utl.publicChengeModule(m.main, "ajax", "supervision_nc", "get_html", d);
            var g = $("#supervision_nc").Module();
            if (g) {
                g.unbind()
            }
            break;
        case 34:
            P.Utl.publicChengeModule(m.main, "ajax", "timeManage", "get_html", "get_json_nc", {key: "drawsList"}, null, null, {romances: true});
            break;
        case 35:
            P.Utl.publicChengeModule(m.main, "ajax", "result_nc", "get_html", "get_json", null, null, null, {romances: true});
            break;
        case 36:
            P.Utl.publicChengeModule(m.left, "ajax", "settingsNav", "get_html");
            break;
        case 37:
            P.Utl.publicChengeModule(m.main, "ajax", "infop", "get_html", "get_json_nc", null, null, null, {romances: true});
            break;
        case 38:
            P.Utl.publicChengeModule(m.main, "ajax", "operationRecord", "get_html", "get_json_nc");
            var g = $("#operationRecord").Module();
            if (g) {
                g.rebind()
            }
            break;
        case 39:
            delete G.cache.htmlCache.rule;
            P.Utl.publicChengeModule(m.main, "ajax", "rule", "get_html_nc");
            break;
        case 52:
            P.Utl.publicChengeModule(m.main_nav, "ajax", "tongji_nav_ks", "get_html");
            break;
        case 53:
            var d = P.Set.level == 0 ? "get_json" : "get_json_zjs";
            P.Utl.publicChengeModule(m.main_nav, "ajax", "supervision_nav_ks", "get_html");
            P.Utl.publicChengeModule(m.main, "ajax", "supervision_ks", "get_html", d);
            var g = $("#supervision_ks").Module();
            if (g) {
                g.unbind()
            }
            break;
        case 54:
            P.Utl.publicChengeModule(m.main, "ajax", "timeManage", "get_html", "get_json_ks", {key: "drawsList"}, null, null, {romances: true});
            break;
        case 55:
            P.Utl.publicChengeModule(m.main, "ajax", "result_ks", "get_html", "get_json", null, null, null, {romances: true});
            break;
        case 56:
            P.Utl.publicChengeModule(m.left, "ajax", "settingsNav", "get_html");
            break;
        case 57:
            P.Utl.publicChengeModule(m.main, "ajax", "infop", "get_html", "get_json_ks", null, null, null, {romances: true});
            break;
        case 58:
            P.Utl.publicChengeModule(m.main, "ajax", "operationRecord", "get_html", "get_json_ks");
            var g = $("#operationRecord").Module();
            if (g) {
                g.rebind()
            }
            break;
        case 59:
            delete G.cache.htmlCache.rule;
            P.Utl.publicChengeModule(m.main, "ajax", "rule", "get_html_ks");
            break
    }
    P.Set.navNum = f;
    $(".g-vd-error").removeClass("g-vd-error");
    $(".g-vd-s-error").removeClass("g-vd-s-error");
    $(".g-vd-s-pass").removeClass("g-vd-s-pass");
    setTimeout(function () {
        if (!$("#htmlcachelayout")[0]) {
            $("body").append('<div id="htmlcachelayout" style="display:none"></div>');
            P.Utl.publicChengeModule($("#htmlcachelayout")[0], "ajax", "pre_htmlcache", "get_html", null, null, null, null, {FError: function () {
            }})
        }
    }, 500)
};
$("#layout").Module();
$("#header").Module();
try {
    if (P.Set.log4jsonoff === 1) {
        $.initLog4js()
    }
} catch (e) {
}
;