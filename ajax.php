<?php
require_once 'db.php';

function url_exist($url)
{
    $c=curl_init();
    curl_setopt($c,CURLOPT_URL,$url);
    curl_setopt($c,CURLOPT_HEADER,1);
    curl_setopt($c,CURLOPT_NOBODY,1);
    curl_setopt($c,CURLOPT_RETURNTRANSFER,1);
    if(!curl_exec($c)){
        return false;
    }else{
        return true;
    }
}

function shorteURLFromID ($integer)
{
    $base = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$length = strlen($base);
	while($integer > $length - 1)
	{
		$out = $base[fmod($integer, $length)] . $out;
		$integer = floor( $integer / $length );
	}
	return $base[$integer];
}

if(isset($_POST['url']))
{
	$url = trim(strip_tags($_POST['url']));
	$url = str_replace(array("http://", "http://www.", "www."), array('', '', ''), $url);
	if(strlen($url) < 3) die("URL Por favor");
	if(url_exist($url))
	{

		$rs = mysql_query("SELECT string FROM enclinks WHERE destination = '".mysql_real_escape_string($url)."'");
		if(@mysql_num_rows($rs)) {
			$row=@mysql_fetch_object($rs);
			$string = $row->string;
			print "http://".$_SERVER['SERVER_NAME']."/enc/r.php?short=".$string;
		}else{
			$rs = mysql_query("INSERT INTO enclinks (destination, added, ip) VALUES
			('".mysql_real_escape_string($url)."', '".time()."', '".ip2long($_SERVER['REMOTE_ADDR'])."')");
			if($rs) {
				$string = shorteURLFromID(mysql_insert_id());
				$rs = mysql_query("UPDATE enclinks SET string = '$string' WHERE linkID = '".mysql_insert_id()."'");
				print "http://".$_SERVER['SERVER_NAME']."/enc/r.php?short=".$string;
			}else{
				print "Não foi possível encurtar o criar o link k".mysql_error();
			}
		}

	}else{
		print "URL incorreta!";
	}
}else{
	print 'URL não recebido<br/>';
}

?>
