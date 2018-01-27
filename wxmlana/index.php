<html>
<head>
<title>wxml分析器</title>
<script>
<?php
$file_name="page-frame.html";
/*if($_GET["p"]!=""){
$file_name=$_GET["p"];
}*/
if($file_name!=""){
	$tmp_str=file_get_contents($file_name);
	if(strpos($tmp_str,"v0.6vv_20170214_fbi")!==false){
		$dir="./20170214/";
		$file_path=$dir."v8.php";
	}elseif(strpos($tmp_str,"v0.6vv_20170919_fbi_wxs")!==false){
		$dir="./20170919/";
		$file_path=$dir."v8.php";
	}elseif(strpos($tmp_str,"v0.6vv_20171201_cua_xc")!==false){
		$dir="./20171201/";
		$file_path=$dir."v8.php";
    }elseif(strpos($tmp_str,"v0.6vv_20171208_cua_xc")!==false){
		$dir="./20171208/";
		$file_path=$dir."v8.php";
	}elseif(strpos($tmp_str,"v0.6vv_20180104_fbi")!==false){
		$dir="./20180104/";
		$file_path=$dir."v8.php";
	}elseif(strpos($tmp_str,"v0.6vv_20180111_fbi")!==false){
		$dir="./20180111/";
		$file_path=$dir."v8.php";
	}else{
		echo "alert(无法识别该版本);";
		exit;
	}
	echo "var version='".$dir."';\n";
}
?>
var raw=decodeURIComponent("<?php
	include($file_path);
?>");
var root=JSON.parse(raw);
var z=[];
eval(root["z"]);
</script>
</head>
<body>
<span>版本：<?php echo $dir?></span>
<!--<input id="file_path" type="text" placeholder="请输入相对文件路径"/><button onclick="redirect();">分析</button>-->
<br>
<select id="path" onclick="choosepath(this.value)" style="float:left;">

</select>
<div style="float:left;">
<div style="float:left;">输入z数组id:(_m函数第二个参数[]中的id(除其第一个外)需加上其第一个id的和才是真正的id)</div>
<input id="zz" type="text" onchange="findz(this.value)" style="float:left;"/>
<div id="z_" style="float:left;">
</div>
</div>
<div style="clear:both;"></div>
<div style="width:100%;padding:0;margin:0;">
<div style="float:left;width:50%;padding:0;margin:0;">
<span>混淆代码</span>
<div id="code">
待选择路径
</div>
</div>
<div style="float:left;width:50%;padding:0;margin:0;">
<span>还原wxml</span>
<iframe id="node" style="width:100%;height:700px;padding:0;margin:0;" scrolling="yes">

</iframe>
</div>
</div>
<script>
function redirect(){
	var file_path=document.getElementById("file_path");
	window.location.href=window.location.href+"?p="+file_path.value;
}
var div_code=document.getElementById("code");
//div_code.innerHTML=root["pre"][0];
var select_path=document.getElementById("path");
var tmp=document.createElement("option");
tmp.innerText="请选择路径";
tmp.value="none";
select_path.appendChild(tmp);

for(var i=0;i<root["path"].length;i++){
	var tmp=document.createElement("option");
	tmp.innerText=root["path"][i];
	tmp.value=i;
	select_path.appendChild(tmp);
}

var ifr_node=document.getElementById("node");
function choosepath(val){
	div_code.innerHTML=root["pre"][val];
	ifr_node.src="node.php?p=<?php echo $file_name;?>&path="+root["path"][val];
}

function findz(val){
	var div_z=document.getElementById("z_");
	div_z.innerHTML=JSON.stringify(z[val]);
}
</script>
</body>
</html>