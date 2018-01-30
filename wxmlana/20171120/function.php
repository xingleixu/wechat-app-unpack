<?php
$func_var=<<< EOT
//wx:if 
var wxif=[];
//template de data属性
var temdate=[];
//每个block的标号，与wxif[mm]对应
var mm=0;
//去掉第一个字符、、用于去掉路劲的第一个点
function removefirstdot(value){
	return value.substring(1,value.length)
}
//去掉非数字的''
function  remove(value){
	if(typeof(value)=='number'||typeof(value)=="boolean"){
		return value;
	}
	else{
		return value.replace("{{","").replace("}}","");
	}
};

EOT;

$func_v=<<< EOT
function _v(k) {
    if (typeof (k) != 'undefined') {
        return {
            tag: 'block',
            'wx:for': k,
            children: []
        };
    }
    return {
        tag: 'block',
        children: [],
        mm: mm
    };
}

EOT;

$func_n=<<< EOT
function _n(tag) {
    \$gwxc++;
    if (\$gwxc >= 16000) {
        throw 'Dom limit exceeded, please check if there\'s any mistake you\'ve made.'
    };
    return {
        tag: tag.substr(0, 3) == 'wx-' ? tag : '' + tag,
        attr: {},
        children: [],
        n: []
    }
}

EOT;

$func_gwt=<<< EOT
function \$gwrt(should_pass_type_info) {
    function ArithmeticEv(ops, e, s, g, o) {
        var rop = ops[0][1];
        var _a, _b, _c, _d, _aa, _bb;
        switch (rop) {
            case '?:':
                _a = rev(ops[1], e, s, g, o);
                _c = should_pass_type_info && (wh.hn(_a) === 'h');
                _d = wh.rv(_a) ? rev(ops[2], e, s, g, o) : rev(ops[3], e, s, g, o);
                _d = _c && wh.hn(_d) === 'n' ? wh.nh(_d, 'c') : _d;
                if (typeof (_a) != "boolean" && typeof (_a) != "number" && _a != "") {
                    _a = _a.replace("{{", "").replace("}}", "");
                }
                //console.log(rev(ops[3], e, s, g, o)+"--------------------case?");
                return "{{" + _a + "?" + remove((rev(ops[2], e, s, g, o))) + ":" + remove((rev(ops[3], e, s, g, o))) + "}}";
                break;
            case '&&':
                _a = rev(ops[1], e, s, g, o);
                _c = should_pass_type_info && (wh.hn(_a) === 'h');
                _d = wh.rv(_a) ? rev(ops[2], e, s, g, o) : wh.rv(_a);
                _d = _c && wh.hn(_d) === 'n' ? wh.nh(_d, 'c') : _d;
                if (typeof (_a) != "boolean" && typeof (_a) != "number" && _a != "") {
                    _a = _a.replace("{{", "").replace("}}", "");
                }
                _b = rev(ops[2], e, s, g, o);
                if (typeof (_b) != "boolean" && typeof (_b) != "number" && _b != "") {
                    _b = _b.replace("{{", "").replace("}}", "");
                }
                return "{{" + _a + "&&" + _b + "}}";
                break;
            case '||':
                _a = rev(ops[1], e, s, g, o);
                _c = should_pass_type_info && (wh.hn(_a) === 'h');
                _d = wh.rv(_a) ? wh.rv(_a) : rev(ops[2], e, s, g, o);
                _d = _c && wh.hn(_d) === 'n' ? wh.nh(_d, 'c') : _d;
                if (typeof (_a) != "boolean" && typeof (_a) != "number" && _a != "") {
                    _a = _a.replace("{{", "").replace("}}", "");
                }
                _b = rev(ops[2], e, s, g, o);
                if (typeof (_b) != "boolean" && typeof (_b) != "number" && _b != "") {
                    _b = _b.replace("{{", "").replace("}}", "");
                }
                return _a + "||" + _b;
                break;
            case '+':
            case '*':
            case '/':
            case '%':
            case '|':
            case '^':
            case '&':
            case '===':
            case '==':
            case '!=':
            case '!==':
            case '>=':
            case '<=':
            case '>':
            case '<':
            case '<<':
            case '>>':
                _a = rev(ops[1], e, s, g, o);
                if (typeof (_a) != "boolean" && typeof (_a) != "number" && _a != "") {
                    _a == null ? _a = "" : _a = _a.replace("{{", "").replace("}}", "");
                }
                _b = rev(ops[2], e, s, g, o);
                if (typeof (_b) != "boolean" && typeof (_b) != "number" && _b != "") {
                    _b == null ? _b = "" : _b = _b.replace("{{", "").replace("}}", "");
                }
                _c = should_pass_type_info && (wh.hn(_a) === 'h' || wh.hn(_b) === 'h');
                switch (rop) {
                    case '+':
                        _d = wh.rv(_a) + wh.rv(_b);
                        break;
                    case '*':
                        _d = wh.rv(_a) * wh.rv(_b);
                        break;
                    case '/':
                        _d = wh.rv(_a) / wh.rv(_b);
                        break;
                    case '%':
                        _d = wh.rv(_a) % wh.rv(_b);
                        break;
                    case '|':
                        _d = wh.rv(_a) | wh.rv(_b);
                        break;
                    case '^':
                        _d = wh.rv(_a) ^ wh.rv(_b);
                        break;
                    case '&':
                        _d = wh.rv(_a) & wh.rv(_b);
                        break;
                    case '===':
                        _d = wh.rv(_a) === wh.rv(_b);
                        break;
                    case '==':
                        _d = wh.rv(_a) == wh.rv(_b);
                        break;
                    case '!=':
                        _d = wh.rv(_a) != wh.rv(_b);
                        break;
                    case '!==':
                        _d = wh.rv(_a) !== wh.rv(_b);
                        break;
                    case '>=':
                        _d = wh.rv(_a) >= wh.rv(_b);
                        break;
                    case '<=':
                        _d = wh.rv(_a) <= wh.rv(_b);
                        break;
                    case '>':
                        _d = wh.rv(_a) > wh.rv(_b);
                        break;
                    case '<':
                        _d = wh.rv(_a) < wh.rv(_b);
                        break;
                    case '<<':
                        _d = wh.rv(_a) << wh.rv(_b);
                        break;
                    case '>>':
                        _d = wh.rv(_a) >> wh.rv(_b);
                        break;
                    default:
                        break;
                }
                return "{{" + _a + rop + _b + "}}";
                break;
            case '-':
                _a = ops.length === 3 ? rev(ops[1], e, s, g, o) : 0;
                _b = ops.length === 3 ? rev(ops[2], e, s, g, o) : rev(ops[1], e, s, g, o);
                _c = should_pass_type_info && (wh.hn(_a) === 'h' || wh.hn(_b) === 'h');
                _d = _c ? wh.rv(_a) - wh.rv(_b) : _a - _b;
                if (typeof (_b) == "number") {
                    return "{{" + _a.replace("{{", "").replace("}}", "") + rop + _b + "}}";
                }
                return "{{" + _a.replace("{{", "").replace("}}", "") + rop + _b.replace("{{", "").replace("}}", "") + "}}";

                break;
            case '!':
                _a = rev(ops[1], e, s, g, o);
                if (typeof (_a) != "boolean" && typeof (_a) != "number" && _a != "") {
                    _a = _a.replace("{{", "").replace("}}", "");
                }
                _c = should_pass_type_info && (wh.hn(_a) == 'h');
                _d = !wh.rv(_a);
                return "{{" + rop + _a + "}}";
            case '~':
                _a = rev(ops[1], e, s, g, o);
                if (typeof (_a) != "boolean" && typeof (_a) != "number" && _a != "") {
                    _a = _a.replace("{{", "").replace("}}", "");
                }
                _c = should_pass_type_info && (wh.hn(_a) == 'h');
                _d = ~wh.rv(_a);
                return "" + rop + _a + "";
            default:
                \$gwn('unrecognized op' + rop);
        }
    }

    function rev(ops, e, s, g, o) {
        var op = ops[0];
        if (typeof (op) === 'object') {
            var vop = op[0];
            var _a, _aa, _b, _bb, _c, _d, _s, _e, _ta, _tb, _td;
            switch (vop) {
                case 2:
                    var dd = ArithmeticEv(ops, e, s, g, o);
                    //console.log(dd)
                    return dd.replace("!!", "");
                    break;
                case 4:
                    return rev(ops[1], e, s, g, o);
                    break;
                case 5:
                    switch (ops.length) {
                        case 2:
                            return should_pass_type_info ? [rev(ops[1], e, s, g, o)] : [wh.rv(rev(ops[1], e, s, g, o))];
                            break;
                        case 1:
                            return [];
                            break;
                        default:
                            _a = rev(ops[1], e, s, g, o);
                            _a.push(should_pass_type_info ? rev(ops[2], e, s, g, o) : wh.rv(rev(ops[2], e, s, g, o)));
                            return _a;
                            break;
                    }
                    break;
                case 6:
                    _a = rev(ops[1], e, s, g, o);
                    if (typeof (_a) != "boolean" && typeof (_a) != "number" && _a != "") {
                        _a = _a.replace("{{", "").replace("}}", "");
                    }
                    _b = rev(ops[2], e, s, g, o);
                    if (typeof (_b) != "boolean" && typeof (_b) != "number" && _b != "") {
                        _b = _b.replace("{{", "").replace("}}", "");
                    }
                    if (typeof (_b) == "number") {
                        return "{{" + _a + "[" + _b + "]}}";
                    }
                    return "{{" + _a + "." + _b.replace("'", "").replace("'", "") + "}}";

                case 7:
                    switch (ops[1][0]) {
                        case 11:
                            o.is_affected |= wh.hn(g) === 'h';
                            return g;
                        case 3:
                            _s = wh.rv(s);
                            _e = wh.rv(e);
                            _b = ops[1][1];
                            _a = _s && _s.hasOwnProperty(_b) ? s : _e && (_e.hasOwnProperty(_b) ? e : undefined);
                            if (should_pass_type_info) {
                                if (_a) {
                                    _ta = wh.hn(_a) === 'h';
                                    _aa = _ta ? wh.rv(_a) : _a;
                                    _d = _aa[_b];
                                    _td = wh.hn(_d) === 'h';
                                    o.is_affected |= _ta || _td;
                                    _d = _ta && !_td ? wh.nh(_d, 'e') : _d;
                                    return "" + ops[1][1] + "";
                                }
                            } else {
                                if (_a) {
                                    _ta = wh.hn(_a) === 'h';
                                    _aa = _ta ? wh.rv(_a) : _a;
                                    _d = _aa[_b];
                                    _td = wh.hn(_d) === 'h';
                                    o.is_affected |= _ta || _td;
                                    if (!new RegExp("{{").test(_d)) {
                                        return "{{" + ops[1][1] + "}}";
                                    }
                                    return "" + ops[1][1] + "";
                                }
                            }
                            return "{{" + ops[1][1] + "}}";
                    }
                    break;
                case 8:
                    _a = {};
                    //_a[ops[1]] = rev(ops[2], e, s, g, o);
                    _a["{{" + ops[1] + "}}"] = "{{" + ops[1] + "}}";
                    temdate[mm - 1] = temdate[mm - 1] || "data=\"{{";
                    temdate[mm - 1] = temdate[mm - 1].replace("}}\"", "") + ops[1] + ":" + ((rev(ops[2], e, s, g, o)) + ",").replace("{{", "").replace("}}", "");
                    temdate[mm] = temdate[mm] || "data=\"{{";
                    temdate[mm] = temdate[mm].replace("}}\"", "") + ops[1] + ":" + ((rev(ops[2], e, s, g, o)) + ",").replace("{{", "").replace("}}", "");
                    //temdate[mm-1]=temdate[mm-1].replace("}}\"", "")+(ops[1]+":"+((rev(ops[2], e, s, g, o)).indexOf("{{")>-1?rev(ops[2], e, s, g, o):"'"+rev(ops[2], e, s, g, o)+"'")+",").replace("{{", "").replace("}}", "");
                    //console.log(temdate[mm-1]);
                    //console.log(mm);
                    //						return "{{" + ops[1] + "}}";
                    //console.log("------data="+ops[1]+rev(ops[2], e, s, g, o));
                    return _a;
                    break;
                case 9:
                    _a = rev(ops[1], e, s, g, o);
                    _b = rev(ops[2], e, s, g, o);
                    function merge(_a, _b, _ow) {
                        _ta = wh.hn(_a) === 'h';
                        _tb = wh.hn(_b) === 'h';
                        _aa = wh.rv(_a);
                        _bb = wh.rv(_b);
                        if (should_pass_type_info) {
                            if (_tb) {
                                for (var k in _bb) {
                                    if (_ow || !_aa.hasOwnProperty(k))
                                        _aa[k] = wh.nh(_bb[k], 'e');
                                }
                            } else {
                                for (var k in _bb) {
                                    if (_ow || !_aa.hasOwnProperty(k)) {

                                        _aa[k] = _bb[k];
                                    }
                                }
                            }
                        } else {
                            for (var k in _bb) {
                                if (_ow || _aa.hasOwnProperty(k)) {

                                    _aa[k] = wh.rv(_bb[k]);
                                }
                            }
                        }
                        return _a;
                    }
                    var _c = _a
                    var _ow = true
                    if (typeof (ops[1][0]) === "object" && ops[1][0][0] === 10) {
                        _a = _b
                        _b = _c
                        _ow = false
                    }
                    if (typeof (ops[1][0]) === "object" && ops[1][0][0] === 10) {
                        var _r = {}
                        return merge(merge(_r, _a, _ow), _b, _ow);
                    } else
                        return merge(_a, _b, _ow);
                    break;
                case 10:
                    temdate[mm - 1] = temdate[mm - 1] || "data=\"{{";
                    temdate[mm - 1] = temdate[mm - 1].replace("}}\"", "") + ("..." + wh.rv(rev(ops[1], e, s, g, o)) + ",").replace("{{", "").replace("}}", "");
                    temdate[mm] = temdate[mm] || "data=\"{{";
                    temdate[mm] = temdate[mm].replace("}}\"", "") + ("..." + wh.rv(rev(ops[1], e, s, g, o)) + ",").replace("{{", "").replace("}}", "");
                    //console.log("--case--10"+rev(ops[1], e, s, g, o)+"----"+wh.rv(rev(ops[1], e, s, g, o)));
                    return should_pass_type_info ? rev(ops[1], e, s, g, o) : wh.rv(rev(ops[1], e, s, g, o));
            }
        } else {
            if (op === 3) {
                return ops[1];
            } else if (op === 1) {
                if (typeof (ops[1]) == 'number' || typeof (ops[1]) == 'boolean' || ops[1] == null) {
                    return ops[1];
                } else {
                    return "'" + ops[1] + "'";
                }
            } else if (op === 11) {
                var _a = '';
                for (var i = 1; i < ops.length; i++) {
                    var xp = wh.rv(rev(ops[i], e, s, g, o));
                    _a += typeof (xp) === 'undefined' ? '' : xp;
                }
                return _a;
            }
        }
    }
    return rev;
}

EOT;

$func_da=<<< EOT
function _da(node, attrname, opindex, value, o, valuekey) {
if ( typeof(global.lastvalues[valuekey]) ==='undefined' )
global.lastvalues[valuekey]=[];
if ( typeof(global.newvalues[valuekey]) ==='undefined' )
global.newvalues[valuekey]=[];
var lastvalue = global.lastvalues[valuekey][opindex + idx_st_];
var isaffected = false;
if( o.is_affected ) isaffected = true;
else if (typeof lastvalue === "object" || typeof value === "object")
{
if (JSON.stringify(lastvalue) !== JSON.stringify(value))
isaffected = true;
}
else if ( lastvalue !== value ) 
isaffected = true;
if ( isaffected ) node.n.push( attrname );
value = \$gdc( value, "" );
global.newvalues[valuekey][opindex + idx_st_] = value;
return value;
}

EOT;

$func_o=<<< EOT
function _o(opindex, env, scope, global) {
    global.opindex = opindex + idx_st_;
    var nothing = {};
    wxif[mm] = grb(z[opindex + idx_st_], env, scope, global, nothing);
    //console.log("_O-----"+grb(z[opindex + idx_st_], env, scope, global, nothing));
    //return grb(z[opindex + idx_st_], env, scope, global, nothing);
    var dd = wxif[mm];
    mm += 1;
    return dd;
}

EOT;

$func_wfor=<<< EOT
function wfor(to_iter, func, env, _s, global, father, itemname, indexname, keyname) {
    var _n = wh.hn(to_iter) === 'n';
    var scope = wh.rv(_s);
    var has_old_item = scope.hasOwnProperty(itemname);
    var has_old_index = scope.hasOwnProperty(indexname);
    var old_item = scope[itemname];
    var old_index = scope[indexname];
    var full = Object.prototype.toString.call(wh.rv(to_iter));
    var type = full[8];
    if (type === 'N' && full[10] === 'l') type = 'X';
    var _y;
    if (_n) {
        if (type === 'A') {
            for (var i = 0; i < to_iter.length; i++) {
                scope[itemname] = to_iter[i];
                scope[indexname] = _n ? i : wh.nh(i, 'h');
                var key = keyname ? (keyname === "*this" ? wh.rv(to_iter[i]) : wh.rv(wh.rv(to_iter[i])[keyname])) : undefined;
                _y = _v(key);
                _(father, _y);
                global.valuekey.push(key ? key : i);
                func(env, scope, _y, global);
                global.valuekey.pop();
            }
        } else if (type === 'O') {
            var i = 0;
            for (var k in to_iter) {
                scope[itemname] = to_iter[k];
                scope[indexname] = _n ? k : wh.nh(k, 'h');
                var key = keyname ? (keyname === "*this" ? wh.rv(to_iter[k]) : wh.rv(wh.rv(to_iter[k])[keyname])) : undefined;
                _y = _v(key);
                _(father, _y);
                global.valuekey.push(key ? key : i);
                func(env, scope, _y, global);
                global.valuekey.pop();
                i++;
            }
        } else if (type === 'S') {
            for (var i = 0; i < 1; i++) {
                scope[itemname] = itemname;
                scope[indexname] = indexname; //wx:key
                _y = _v(to_iter);
                _y["wx:key"] = keyname;
                _y["wx:for-item"] = itemname;
                _(father, _y);
                //global.valuekey.push(to_iter[i] + i);
                func(env, scope, _y, global);
                //global.valuekey.pop();
            }
        } else if (type === 'N') {
            for (var i = 0; i < to_iter; i++) {
                scope[itemname] = i;
                scope[indexname] = _n ? i : wh.nh(i, 'h');
                _y = _v(i);
                _(father, _y);
                global.valuekey.push(i);
                func(env, scope, _y, global);
                global.valuekey.pop();
            }
        } else {}
    } else {
        var r_to_iter = wh.rv(to_iter);
        var r_iter_item, iter_item;
        if (type === 'A') {
            for (var i = 0; i < r_to_iter.length; i++) {
                iter_item = r_to_iter[i];
                iter_item = wh.hn(iter_item) === 'n' ? wh.nh(iter_item, 'h') : iter_item;
                r_iter_item = wh.rv(iter_item);
                scope[itemname] = iter_item
                scope[indexname] = _n ? i : wh.nh(i, 'h');
                var key = keyname ? (keyname === "*this" ? r_iter_item : wh.rv(r_iter_item[keyname])) : undefined;
                _y = _v(key);
                _(father, _y);
                global.valuekey.push(key ? key : i);
                func(env, scope, _y, global);
                global.valuekey.pop();
            }
        } else if (type === 'O') {
            var i = 0;
            for (var k in r_to_iter) {
                iter_item = r_to_iter[k];
                iter_item = wh.hn(iter_item) === 'n' ? wh.nh(iter_item, 'h') : iter_item;
                r_iter_item = wh.rv(iter_item);
                scope[itemname] = iter_item;
                scope[indexname] = _n ? k : wh.nh(k, 'h');
                var key = keyname ? (keyname === "*this" ? r_iter_item : wh.rv(r_iter_item[keyname])) : undefined;
                _y = _v(key);
                _(father, _y);
                global.valuekey.push(key ? key : i);
                func(env, scope, _y, global);
                global.valuekey.pop();
                i++
            }
        } else if (type === 'S') {
            for (var i = 0; i < r_to_iter.length; i++) {
                iter_item = wh.nh(r_to_iter[i], 'h');
                scope[itemname] = iter_item;
                scope[indexname] = _n ? i : wh.nh(i, 'h');
                _y = _v(to_iter[i] + i);
                _(father, _y);
                global.valuekey.push(to_iter[i] + i);
                func(env, scope, _y, global);
                global.valuekey.pop();
            }
        } else if (type === 'N') {
            for (var i = 0; i < r_to_iter; i++) {
                iter_item = wh.nh(i, 'h');
                scope[itemname] = iter_item;
                scope[indexname] = _n ? i : wh.nh(i, 'h');
                _y = _v(i);
                _(father, _y);
                global.valuekey.push(i);
                func(env, scope, _y, global);
                global.valuekey.pop();
            }
        } else {}
    }
    if (has_old_item) {
        scope[itemname] = old_item;
    } else {
        delete scope[itemname];
    }
    if (has_old_index) {
        scope[indexname] = old_index;
    } else {
        delete scope[indexname];
    }
}
EOT;

$func_path=<<< EOT
if ((path && e_[path]) || (path == "666") || e_["." + path] || path == "all") {
    window.__wxml_comp_version__ = 0.02;
    return function (env, dd, global) {
        if (path == "all") {
            for (var ijk in d_) console.log(ijk);
        } else if (path == "666") {
            for (var ijk in d_) {
                tmp_path = ijk;
                \$gwxc = 0;
                var root = {
                    "tag": "wx-page"
                };
                root.children = [];
                var main = e_[tmp_path].f;
                if (typeof (window.__webview_engine_version__) != "undefined" && window.__webview_engine_version__ + 0.000001 >= 0.02 + 0.000001 && window.__mergeData__) {
                    env = window.__mergeData__(env, dd)
                }
                if (typeof global === "undefined") {
                    global = {}
                }
                global.f = f_[tmp_path];
                if (typeof (global.valuekey) === "undefined") {
                    global.valuekey = [];
                }
                try {
                    main(env, {}, root, global);
                    if (typeof (window.__webview_engine_version__) == "undefined" || window.__webview_engine_version__ + 0.000001 < 0.01 + 0.000001) {
                        _ev(root)
                    }
                } catch (err) {
                    console.log(err)
                }
                console.warn("%c\\n<-- ----------------------------页面分割------------------- -->", "color:red");
                console.group(removefirstdot(ijk));
                console.log("<!-- 本页的所有内容");
                var importstr = "";
                for (var tempath in e_[tmp_path].ti) {
                    importstr += '<import  src="' + e_[tmp_path].ti[tempath] + '"  />\\n'
                }
                var templatestr = "";
                for (var temid in d_[tmp_path]) {
                    if (temid) {
                        if (typeof (d_[tmp_path][temid]) == "function") {
                            templatestr += "<!--   " + temid + "    -->\\n" + ana(d_[tmp_path][temid]({}, {}, {
                                tag: "template",
                                children: [],
                                name: temid
                            }, global)) + "\\n"
                        }
                    }
                }
                console.log("------------- -->\\n" + importstr + ana(root) + "\\n" + templatestr);
                console.groupEnd()
            }
        } else {
            \$gwxc = 0;
            var root = {
                "tag": "wx-page"
            };
            root.children = [];
            path = path.indexOf(".") == 0 ? path : "." + path;
            var main = e_[path].f;
            if (typeof (window.__webview_engine_version__) != "undefined" && window.__webview_engine_version__ + 0.000001 >= 0.02 + 0.000001 && window.__mergeData__) {
                env = window.__mergeData__(env, dd)
            }
            if (typeof global === "undefined") {
                global = {}
            }
            global.f = f_[path];
            if (typeof (global.valuekey) === "undefined") {
                global.valuekey = [];
            }
            try {
                main(env, {}, root, global);
                if (typeof (window.__webview_engine_version__) == "undefined" || window.__webview_engine_version__ + 0.000001 < 0.01 + 0.000001) {
                    _ev(root)
                }
            } catch (err) {
                console.log(err)
            }
            console.warn("%c\\n<-- ----------------------------页面分割------------------- -->", "color:red");
            console.group(removefirstdot(path));
            console.log("<!-- 本页的所有内容");
            var importstr = "";
            for (var tempath in e_[path].ti) {
                importstr += '<import  src="' + e_[path].ti[tempath] + '"  />\\n'
            }
            var templatestr = "";
            for (var temid in d_[path]) {
                if (temid) {
                    if (typeof (d_[path][temid]) == "function") {
                        templatestr += "<!--   " + temid + "    -->\\n" + ana(d_[path][temid]({}, {}, {
                            tag: "template",
                            children: [],
                            name: temid
                        }, global)) + "\\n"
                    }
                }
            }
            console.log("------------- -->\\n" + importstr + ana(root) + "\\n" + templatestr);
            console.groupEnd()
			return importstr + ana(root) + templatestr;
        };
    }
}

EOT;

?>