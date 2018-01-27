<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport"content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"/>
	<script src="jquery.min.js"></script>
    <script>
	<?php

$file_name=$_GET["p"];
if($file_name!=""){
	$tmp_str=file_get_contents($file_name);
	if(strpos($tmp_str,"v0.6vv_20170214_fbi")!==false){
		$dir="./20170214/";
		$file_path=$dir."replace.php";
	}elseif(strpos($tmp_str,"v0.6vv_20170919_fbi_wxs")!==false){
		$dir="./20170919/";
		$file_path=$dir."replace.php";
	}elseif(strpos($tmp_str,"v0.6vv_20171201_cua_xc")!==false){
		$dir="./20171201/";
		$file_path=$dir."replace.php";
    }elseif(strpos($tmp_str,"v0.6vv_20171208_cua_xc")!==false){
		$dir="./20171208/";
		$file_path=$dir."replace.php";
	}elseif(strpos($tmp_str,"v0.6vv_20180104_fbi")!==false){
		$dir="./20180104/";
		$file_path=$dir."replace.php";
	}elseif(strpos($tmp_str,"v0.6vv_20180111_fbi")!==false){
		$dir="./20180111/";
		$file_path=$dir."replace.php";
	}else{
		echo "alert(无法识别该版本);";
		exit;
	}
	echo "var version='".$dir."';\n";
}
?>
       <?php
	   include($file_path);
	   ?>
    </script>
</head>

<body>
<div contenteditable="true" style="width:100%">
<pre id="app" style="white-space: pre-wrap;">

</pre>
</div>
<button onclick="format()">格式化代码</button>
<!--<button onclick="savefile()">保存</button>-->
</body>
<script src="ana.js"></script>
<script>
    var node=$gwx('<?php
	echo $_GET["path"];
	?>')();
	var app=document.getElementById("app");
	app.innerText=""+ana(node)+"";
	function format(){
		app.innerText=formatXml(app.innerText);
	}
	/*暂时不做
	function savefile(){
		console.log(app.innerText);
		$.post("savefile.php",app.innerText,function(result){
			console.log(result);
		});
	}*/
</script>
<script>


</script>
</html>
