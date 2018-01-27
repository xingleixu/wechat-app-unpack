<?php
//v0.6vv_20170214_fbi

	$file_name=$_GET["p"];


$z=array();
function Z($ops){
	$z[]=$ops;
    //return $ops;
}

$return_root=array();
$raw_str=file_get_contents($file_name);
$raw_str=substr($raw_str,strpos($raw_str,"(function(z){"));
$raw_str=substr($raw_str,0,strpos($raw_str,"if(path&&e_[path]){"));
$raw_z_len=strpos($raw_str,"})(z);")+7;
$raw_z=substr($raw_str,0,$raw_z_len);
$raw_wxml=substr($raw_str,$raw_z_len);
$raw_x=substr($raw_wxml,strpos($raw_wxml,"var x=")+4);
$raw_x=substr($raw_x,0,strpos($raw_x,"];")+2);
$raw_x="$".$raw_x;
eval("".$raw_x."return \$x;");
$raw_z=str_replace("\n","",$raw_z);
preg_match_all('/Z\(\[(.*)\]\)/U', $raw_z, $raw_z_func);
$raw_z_arr=$raw_z_func[0];
foreach($raw_z_arr as $id=>$tmp){
	$tmp=str_replace("Z(","Z(\"",$tmp);
    $tmp=str_replace("idx_st_+","",$tmp);
    $tmp=str_replace("a,","11,",$tmp);
    //$tmp=str_replace("z[","\$z[",$tmp);
	$tmp=str_replace("])","]\")",$tmp);
	//echo $tmp;
    eval("".$tmp.";");
}

$return_root["z"]=$z;
//echo json_encode($z);

$raw_wxml_func=explode("\n",$raw_wxml);
$sum_str="";
$d=array();
$m=array();
$e=array();
for($i=0;$i<count($raw_wxml_func);$i++){
    $tmp_str=$raw_wxml_func[$i];
    if(strpos($tmp_str,"var")!==false&&strpos($tmp_str,"function(e,s,r,gg){")!==false){
        $sum_str="";
        $str_type=1;
    }
    if(strpos($tmp_str,"d_[")!==false){
        $sum_str="";
        $str_type=2;
        if(strpos($tmp_str,"{}")!==false){
            $d[]=trim(" ".$tmp_str);
            $str_type=0;
			continue;
        }
    }
    if(strpos($tmp_str,"e_[\"")!==false){
        $sum_str="".$tmp_str;
        $str_type=3;
        //continue;
    }
    $sum_str.=$tmp_str."\n";
    if(strpos($tmp_str,"return r")!==false){
        switch($str_type){
            case 1:$m[]=" ".$sum_str."}";break;
            case 2:$d[]=trim(" ".$sum_str."}");break;
        }
        $sum_str="";
        $str_type=0;
		continue;
    }
    if(strpos($tmp_str,"ic:[")!==false){
        $e[]=trim(" ".$sum_str."}");
        $sum_str="";
        $str_type=0;
    }
}

$d_func=array();
$pre_d=array();
foreach($d as $idx=>$tmp_d){
	if(strpos($tmp_d,"function(e,s,r,gg){")===false){
		continue;
	}
    $d_func["d".$idx]=explode("\n",$tmp_d);
	$t_num=0;
	$tmp_str="";
	$tmp_str.="<pre>";
	foreach($d_func["d".$idx] as $tmp_d_func){
		if(strpos($tmp_d_func,"}")!==false&&strpos($tmp_d_func,"}}")===false){
			$t_num--;
		}
		for($i=0;$i<$t_num;$i++){
			$tmp_str.="\t";
		}
		$tmp_d_func=trim($tmp_d_func);
		$tmp_str.=$tmp_d_func."\n";
		if(strpos($tmp_d_func,"{")!==false&&strpos($tmp_d_func,"{{")===false){
			$t_num++;
		}
	}
	$tmp_str.="</pre>";
	$tmp_str.="<br/>";
	$pre_d[]=$tmp_str;
}

$return_root["d"]=$d;
$return_root["pre_d"]=$pre_d;

$path=array();
foreach($e as $tmp_e){
	$tmp_e=trim($tmp_e);
	$tmp_e=substr($tmp_e,4,strpos($tmp_e,"\"]")-4);
	$path[]=$tmp_e;
}

$return_root["e"]=$e;
$return_root["path"]=$x;

$m_func=array();
$pre=array();
foreach($m as $idx=>$tmp_m){
    $m_func["m".$idx]=explode("\n",$tmp_m);
	$t_num=0;
	$tmp_str="";
	$tmp_str.="<pre style=\"white-space: pre-wrap;\">";
	foreach($m_func["m".$idx] as $tmp_m_func){
		if(strpos($tmp_m_func,"}")!==false&&strpos($tmp_m_func,"}}")===false){
			$t_num--;
		}
		for($i=0;$i<$t_num;$i++){
			$tmp_str.="  ";
		}
		$tmp_m_func=trim($tmp_m_func);
		if(strpos($tmp_m_func,"_n(")!==false){
			$tmp_m_func.="  //创建节点";
		}
		if(strpos($tmp_m_func,"_r(")!==false){
			$tmp_m_func.="  //给节点添加属性";
		}
		if(strpos($tmp_m_func,"_v(")!==false){
			$tmp_m_func.="  //创建block节点";
		}
		if(strpos($tmp_m_func,"_(")!==false){
			$tmp_m_func.="  //合并节点";
		}
		if(strpos($tmp_m_func,"_ai(")!==false){
			$tmp_m_func.="  //引入template";
		}
		if(strpos($tmp_m_func,"_2(")!==false){
			$tmp_m_func.="  //渲染wx:for列表";
		}
		if(strpos($tmp_m_func,"_o(")!==false){
			$tmp_m_func.="  //获取z数组中对应位置的值";
		}
		if(strpos($tmp_m_func,"_m(")!==false){
			$tmp_m_func.="  //创建非容器类节点";
		}
		
		
		$tmp_str.=$tmp_m_func."\n";
		if(strpos($tmp_m_func,"{")!==false&&strpos($tmp_m_func,"{{")===false){
			$t_num++;
		}
	}
	$tmp_str.="</pre>";
	$tmp_str.="<br/>";
	$pre[$idx]=$tmp_str;
}
$return_root["pre"]=$pre;

echo rawurlencode(json_encode($return_root,JSON_UNESCAPED_UNICODE ));
?>