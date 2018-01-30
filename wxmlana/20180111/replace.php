<?php

$file_name=$_GET["p"];


include("function.php");

$raw_str=file_get_contents($file_name);
$raw_str=substr($raw_str,strpos($raw_str,"<script>")+8);
$raw_str=substr($raw_str,0,strpos($raw_str,"</script>"));
$raw_str=$func_var."\n".$raw_str;

$re_vn=substr($raw_str,0,strpos($raw_str,"function _v("));
$raw_str=$re_vn.$func_v.$func_n.substr($raw_str,strpos($raw_str,"function _p("));

$re_gwrt=substr($raw_str,0,strpos($raw_str,"function \$gwrt("));
$raw_str=$re_gwrt.$func_gwt.substr($raw_str,strpos($raw_str,"gra=\$gwrt(true);"));

$re_da=substr($raw_str,0,strpos($raw_str,"function _da("));
$raw_str=$re_da.$func_da.substr($raw_str,strpos($raw_str,"function _r("));

$re_o=substr($raw_str,0,strpos($raw_str,"function _o("));
$raw_str=$re_o.$func_o.substr($raw_str,strpos($raw_str,"function _1("));

$re_wfor=substr($raw_str,0,strpos($raw_str,"function wfor("));
$raw_str=$re_wfor.$func_wfor.substr($raw_str,strpos($raw_str,"function _ca("));

$re_path=substr($raw_str,0,strpos($raw_str,"if(path&&e_[path]){"));
$raw_str=$re_path.$func_path."}\n".substr($raw_str,strpos($raw_str,"var BASE_DEVICE_WIDTH"));

$raw_arr=array();
preg_match_all('/else\{(.*)\.wxVkey/U',$raw_str,$raw_arr);
foreach($raw_arr[0] as $tmp_arr){
	$tmp_str_s=substr($raw_str,0,strpos($raw_str,$tmp_arr));
	$tmp_str_e=substr($raw_str,strpos($raw_str,$tmp_arr)+4);
	$raw_str=$tmp_str_s."if(1==1)".$tmp_str_e;
}

/*function str_replace_limit($search, $replace, $subject, $limit=-1){  
    if(is_array($search)){  
        foreach($search as $k=>$v){  
            $search[$k] = '`'. preg_quote($search[$k], '`'). '`';  
        }  
    }else{  
        $search = '`'. preg_quote($search, '`'). '`';  
    }  
    return preg_replace($search, $replace, $subject, $limit);  
} 

$raw_arr=array();
preg_match_all('/else(.*)\{(.*)\.wxVkey/U',$raw_str,$raw_arr);
foreach($raw_arr[0] as $tmp_arr){
	$tmp_str_s=substr($raw_str,0,strpos($raw_str,$tmp_arr));
	$tmp_str_e=substr($raw_str,strpos($raw_str,$tmp_arr)+8);
	$tmp_str_e=str_replace_limit("){",";",$tmp_str_e,1);
	$a_s=strpos($tmp_str_e,";")+1;
	$a_e=strpos($tmp_str_e,"wxVkey");
	$tmp_str_var=substr($tmp_str_e,$a_s,$a_e-$a_s);
	$tmp_str_e=$tmp_str_var."tiaojian=".$tmp_str_e;
	$raw_str=$tmp_str_s."if(1==1){".$tmp_str_e;
}*/

//preg_match_all('/else\{(.*)\.wxVkey/U',$raw_str,$raw_arr);
//var_dump($raw_arr[0]);

//$raw_str=preg_replace('/else(.*)\{(.*)\.wxVkey/U','if(1==1){',$raw_str);
//var_dump($a_rr);
//preg_replace('/else\s+({\s+\w+\.wxVkey)/','if (1==1)',$raw_str);
//$raw_str=str_replace("<","&lt;",$raw_str);
//$raw_str=str_replace(">","&gt;",$raw_str);
//echo "<pre>".$raw_str."</pre>";
echo $raw_str."\n";

?>