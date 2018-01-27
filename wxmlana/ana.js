var t_num=0;
function ana(raw) {
    var str = "";
    for (var i in raw) {
        if (i == "tag") {
            if (raw[i] != "block") {
                str += (raw[i] == "wx-page" ? "" : "<" + raw[i]);
            } else {
                if (raw["wxXCkey"] != undefined && raw["wxXCkey"] == "2") {
                    if (raw["children"] != undefined) {

                        for (var k in raw["children"]) {
                            if (typeof (raw["children"][k]) == "object") {
                                str += ana(raw["children"][k]);
                            } else {
                                str += raw["children"][k];
                            }
                        }
                        continue;
                    }
                }
                if (raw["wxXCkey"] != undefined && raw["wxXCkey"] == "3") {

                    str += "<template";
                } else {
                    str += "<" + raw[i];
                }

                if (raw["wxVkey"] == "2") {

                    str += " wx:if=\"" + wxif[raw["mm"]] + "\" >";
                    for (var k in raw["children"]) {
                        if (k == 1) {
                            str += "<block wx:else>"
                        }
                        if (k === 2) {
                            str += "<!--  不确定  -->"
                        }
                        if (typeof (raw["children"][k]) == "object") {
                            str += ana(raw["children"][k]);
                        } else {
                            str += raw["children"][k];
                        }
                        if (k == 0) {
                            str += "</block>"
                        }
                    }
                    str += "</block>";
                    continue;
                }
                if (raw["wxVkey"] == "1") {
                    str += " wx:if=\"" + wxif[raw["mm"]] + "\"";
                }
            }
            if (raw["wx:for"] != undefined) {
                str += " wx:for=\"" + raw["wx:for"] + "\"";
            }
            if (raw["name"] != undefined) {
                str += " name=\"" + raw["name"] + "\"";
            }
            if (raw["wx:key"] != undefined) {
                str += raw["wx:key"] != "" ? " wx:key=\"" + raw["wx:key"] + "\"" : "";
            }
            if (raw["wx:for-item"] != undefined) {
                str += " wx:for-item=\"" + raw["wx:for-item"] + "\"";
            }
            if (raw["attr"] != undefined) {
                for (var j in raw["attr"]) {
                    str += " " + j + "=\"" + raw["attr"][j] + "\"";
                }
            }
            if (raw["wxVkey"] != undefined) {
            }
            if (raw["mm"] != undefined) {
                if (raw["wxXCkey"] != undefined) {
                    if (raw["wxXCkey"] == "3") {
                        if (temdate[raw["mm"]] != undefined) {
                            str += "  " + (temdate[raw["mm"]].lastIndexOf(",") > -1 ? temdate[raw["mm"]].substring(0, temdate[raw["mm"]].length  -  1) : temdate[raw["mm"]])  + "}}\"";
                        }
                        if (raw["wxVkey"] != undefined) {
                            str += " is=\"" + raw["wxVkey"].split(":")[1] + "\" " + "/>";
                        }
                        continue;
                    }
                }
            }
            if (raw[i] != "wx-page") {
                str += ">";
            }
            if (raw["children"] != undefined) {
                for (var k in raw["children"]) {
                    if (typeof (raw["children"][k]) == "object") {
                        str += ana(raw["children"][k]);
                    } else {
                        str += raw["children"][k];
                    }
                }
            }
            if (raw[i] != "11") {
                if (raw["wxXCkey"] != undefined) {
                    if (raw["wxXCkey"] == "3") {
                        str += "</template>";
                    } else {
                        str += raw[i] == "wx-page" ? "" : "</" + raw[i] + ">";
                    }
                } else {
                    str += raw[i] == "wx-page" ? "" : "</" + raw[i] + ">";
                }
            }
        }
    }
    return str;

    console(str);
}



function formatXml(text) {
        //去掉多余的空格
        text = '\n' + text.replace(/(<\w+)(\s.*?>)/g, function ($0, name, props) {
                    return name + ' ' + props.replace(/\s+(\w+=)/g, " $1");
                }).replace(/>\s*?</g, ">\n<");

        //把注释编码
        text = text.replace(/\n/g, '\r').replace(/<!--(.+?)-->/g, function ($0, text) {
            var ret = '<!--' + escape(text) + '-->';
            //alert(ret);
            return ret;
        }).replace(/\r/g, '\n');

        //调整格式
        var rgx = /\n(<(([^\?]).+?)(?:\s|\s*?>|\s*?(\/)>)(?:.*?(?:(?:(\/)>)|(?:<(\/)\2>)))?)/mg;
        var nodeStack = [];
        var output = text.replace(rgx, function ($0, all, name, isBegin, isCloseFull1, isCloseFull2, isFull1, isFull2) {
            var isClosed = (isCloseFull1 == '/') || (isCloseFull2 == '/' ) || (isFull1 == '/') || (isFull2 == '/');
            //alert([all,isClosed].join('='));
            var prefix = '';
            if (isBegin == '!') {
                prefix = getPrefix(nodeStack.length);
            }
            else {
                if (isBegin != '/') {
                    prefix = getPrefix(nodeStack.length);
                    if (!isClosed) {
                        nodeStack.push(name);
                    }
                }
                else {
                    nodeStack.pop();
                    prefix = getPrefix(nodeStack.length);
                }

            }
            var ret = '\n' + prefix + all;
            return ret;
        });

        var prefixSpace = -1;
        var outputText = output.substring(1);
        //alert(outputText);

        //把注释还原并解码，调格式
        outputText = outputText.replace(/\n/g, '\r').replace(/(\s*)<!--(.+?)-->/g, function ($0, prefix, text) {
            //alert(['[',prefix,']=',prefix.length].join(''));
            if (prefix.charAt(0) == '\r')
                prefix = prefix.substring(1);
            text = unescape(text).replace(/\r/g, '\n');
            var ret = '\n' + prefix + '<!--' + text.replace(/^\s*/mg, prefix) + '-->';
            //alert(ret);
            return ret;
        });

        return outputText.replace(/\s+$/g, '').replace(/\r/g, '\r\n');
    }
    function getPrefix(prefixIndex) {
        var span = '  ';
        var output = [];
        for (var i = 0; i < prefixIndex; ++i) {
            output.push(span);
        }

        return output.join('');
    }