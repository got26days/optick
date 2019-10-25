<?php
// sitemap/analiz.php ver 1.3
// ���� ��� ��������� ������������ sitemap.xml
// ��� ��������� ��������� �� ��������� � ��������� ����� ������� ������������ ������ http://htmlweb.ru/analiz/sitemap.php
// �������� ������������� � ���������� ��. http://htmlweb.ru/analiz/sitemap_online.php
//
// ��� ����� ����������� ����������� ������� ������������(KDG).
// ������� � ��������� ���������� �� kdg@htmlweb.ru
// ��������� ������������ ����� GET-������:
//	?debug=1 - ���������� �����, ������ �������� ��������� �� ����� ��� ���������, ���������� �� ����������
//	?b=1	 - ��� ������ �������, ��� �������, ������� ���������� ������ ����� �����.

$_Mail='admin@�����.ru';	// ���� ����� ��� ����������� �� �������
$_period=7;	// ����� ������� ����� ������������� ����� �����
		// ��� ����������� ������ �� ������� ������ 7, ����� ������ ������ ����� �������
//////////////////////////////////

$_filename_inc=$_SERVER['DOCUMENT_ROOT'].'/sitemap/sitemap.inc';// ��� ����� ��� ������������ ����� ������ ��� �����
$_Debug=isset($_GET['debug']);
if($_Debug){
	header("Cache-Control: no-cache, must-revalidate");
	header("Pragma: no-cache");
}else{
	header("Cache-control: public, max-age = ". $_period); // ����������� � ������� t ������
	header("Expires: " . gmdate('D, d M Y H:i:s', time()+$_period) . ' GMT');
}

if(@filesize('sitemap.log')>50000){@unlink('sitemap.bak');rename('sitemap.log','sitemap.bak');}
if(file_put_contents('sitemap.log', "\n\n", FILE_APPEND )<1) out("\n�� ���� �������� � ���� ��������� sitemap.log");

$SERVER_NAME=$_SERVER['HTTP_HOST'];
$SERVER_NAME=preg_replace('/^www\./', '', $SERVER_NAME);// ��� ��������� � ����� ������ ��� WWW

$r='http://'.strtolower($SERVER_NAME).'/';
$root_len=strlen($r);

$filename1=$_SERVER['DOCUMENT_ROOT'].'/sitemap.xml';
$filename=$_SERVER['DOCUMENT_ROOT'].'/sitemap/sitemap.xml';
if (file_exists($filename1)){
   if (file_exists($filename))@unlink($filename1); // ���� ���, ������, ������� � �����
   else rename($filename1, $filename);
   }

$url_sitemap=$r.substr($filename, strlen($_SERVER['DOCUMENT_ROOT'])+1); // URL ���� � sitemap.xml
$t_filename=substr($filename,0,-3).'txt';

if(@$_GET['b']=='1'){
	BuildSiteMap(); // ������ ���������� ����� �����
	ret();// ����� ������
}else
if(file_exists($t_filename)){
   // ���� ������ �� ���������� ��������� ������� ��������� �� ������, ��
   // ������ �� ���������� ��� ���������, ������ ����� ��������� �����
   if (@filemtime($filename)<filemtime($t_filename) && filesize($t_filename)>100 ){	// ����� ���������� ����� ������ ������� ����� ����������� �������
	BuildSiteMap(); // ������ ���������� ����� �����
	ret();// ����� ������
	}	
   $time_expires=filemtime($t_filename)+($_period*60*60*24); // �������� � �������;
   if($time_expires > time()){
   if(!$_Debug){
	header("Cache-control: public, max-age = ". $time_expires-time()); // ����������� � ������� t ������
	header("Expires: " . gmdate('D, d M Y H:i:s', $time_expires) . ' GMT');
	ret();// ����� ������
	}
   ret("�������� ������������� ���������� ����� ����� �������������� ���� ��� � ".$_period." �����!<br>
��������� ���������� ���� ".date('d M Y H:i:s', filemtime($t_filename)).",
��������� ����� �� ����� ".date('d M Y H:i:s', $time_expires)."<br>
��� �������� ���������� ����� ������� <a href='?b=1'>�����</a>");
   }
   out("��������� ���������� ���� ".date('d M Y H:i:s', filemtime($t_filename)).",
������� ����� ".date('d M Y H:i:s', $time_expires));
}
ignore_user_abort(true);
$time_end=3000*1.5; // 1.5 ��� �� ��������
set_time_limit($time_end+100);	$time_start=time(); $time_end+=$time_start;	// ����� �� ����� ��������


$html=@file_get_contents($filename);
if(strlen($html)<300){ret('��� ����� ����� ����� '.$url_sitemap.'<br>
���������� ������� ��������� ������ ����� �����.<br>
�������������� �������� <a href="http://htmlweb.ru/analiz/sitemap.php?url='.$r.'">http://htmlweb.ru/analiz/sitemap.php</a><br>
���� � ��� ��������� ����, �� ������ ��������������� ������� <a href="?b=1">�������� ����������� �����</a><br>
');}



$dom = new DOMDocument('1.0', 'UTF-8');  
@$dom->loadXML($html);
if(!$dom)ret('���� ����� ����� '.$url_sitemap." ��������, - ����������� ������ ����� �����!
�������������� �������� <a href='http://htmlweb.ru/analiz/sitemap.php?url=".$r."'>http://htmlweb.ru/analiz/sitemap.php</a><br>
���� � ��� ��������� ����, �� ������ ��������������� ������� <a href='?b=1&debug=1'>�������� ����������� �����</a><br>
");

$ForMail='';

// �������� ������ �� sitemap � robots.txt
if(!is_file($f_robots=$_SERVER['DOCUMENT_ROOT'].'/robots.txt')){
  if(@file_put_contents($f_robots, "sitemap: ".$url_sitemap."\n", FILE_APPEND)<10){
		$ForMail.="\n�� ������� �������� ���� � sitemap � robots.txt";
		out('�� ������� �������� ���� � sitemap � robots.txt');}
}else{
  $html=@file_get_contents($f_robots);

  if (stripos( $html, "sitemap:" )!==false){
     if (stripos( $html, "sitemap: ".$url_sitemap )===false){ // ���� ���� �� ����������
	out('<br>����� ���� � sitemap: '.$url_sitemap.' � '.$f_robots);
	if(@file_put_contents($f_robots, preg_replace("|sitemap: (.*?)\n|ims", $url_sitemap, $html."\n") )<10){
		$ForMail.="\n�� ������� �������� ���� � sitemap � robots.txt";
		out('�� ������� �������� ���� � sitemap � robots.txt');}
     }
  }else{
	out('�������� ������ �� sitemap: '.$url_sitemap.' � '.$f_robots);
	if(@file_put_contents($f_robots, "\n\nSitemap: ".$url_sitemap, FILE_APPEND)<10){
		$ForMail.="\n�� ������� �������� ���� � sitemap � robots.txt";
		out('�� ������� �������� ���� � sitemap � robots.txt');}
	}
}
$root=$dom->documentElement;
$nodelist=$root->childNodes;    //������ ����� 1-�� ������
$f_Modifi=false;
$ListPage='';
foreach ($nodelist as $child) {
    if ($child->nodeType==XML_ELEMENT_NODE){
        $loc=$lastmod=false;
	foreach ($child->childNodes as $child2)
    	if ($child2->nodeType==XML_ELEMENT_NODE){
    		if ($child2->nodeName=='loc')$loc=$child2->nodeValue;
    		elseif ($child2->nodeName=='lastmod')$lastmod=$child2;
		}
	if(!$loc || !$lastmod)continue;
	out('�������� <b>'.$loc.'</b> ������� ��������� '.$lastmod->nodeValue);
   // �������� ��������� � ��������� ���� ���������
   $curl = curl_init($loc);
   curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
   curl_setopt($curl, CURLOPT_HEADER, 1);	// �������� header � �����
   curl_setopt($curl, CURLOPT_NOBODY, 1);	// ������ ������ ��������� ��� ����
   curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 0 );	// ��������� ������ "Location: " header
   curl_setopt($curl, CURLOPT_TIMEOUT, 20);	// ������������ ����� � ��������, ��� ������ CURL-�������.
   $headers = curl_exec($curl);
   $short_loc=substr($loc, $root_len);
   if( curl_error($curl) || curl_getinfo($curl, CURLINFO_HTTP_CODE)=='404'){	//CURLE_OPERATION_TIMEDOUT
	out("\t�������� ����������, ������ � �� sitemap");
	$ForMail.="\n".$short_loc.' - �������� �� �������� � ������� �� ����� �����.';
	$ListPage.="\n".$short_loc."\t-";
	$root->removeChild($child);}
   else
	if (strlen($headers)>20){
	if (preg_match("|Last-Modified: (.*)\n|imsU", $headers, $results)){
		if (($time2 = strtotime($results[1])) === -1){
	        out("\t������������ ����� <b>".$results[1].'</b> � ��������� '.$loc);
		$ForMail.="\n".$short_loc.' - ������������ ����� <b>'.$results[1].'</b> � ��������� ��������!';
		$ListPage.="\n".$short_loc."\t2";}
	   elseif (date('Y-m-d',$time2)>$lastmod->nodeValue){
		$lastmod->nodeValue=date('Y-m-d',$time2);
		out("\tModified <b>".date('Y-m-d H:i:s',$time2)."</b>!");
		$ListPage.="\n".$short_loc."\t1\t".date('Y-m-d H:i:s',$time2); $f_Modifi=true;
		}
	   else {out("\t�� ��������� � ".date('Y-m-d H:i:s',$time2).'!');
		 $ListPage.="\n".$short_loc."\t0\t".date('Y-m-d H:i:s',$time2);}
	   }
	elseif (preg_match("|Content-Length: (.*)\n|imsU", $headers, $results)){	//Content-Length: 95
		out("\t� ��������� ��� Last-Modified, �������� �� �������!");
	      $ListPage.="\n".$short_loc."\t3\t".$results[1];}
	else {out("\t<b>� ��������� ��� Last-Modified � ��� Content-Length!</b>");
	      $ListPage.="\n".$short_loc."\t4";}
	} else {out("\t<b>��������� ������!</b>");
	      $ListPage.="\n".$short_loc."\t4";}
    curl_close ($curl);
    }
}
//file_put_contents($filename.'1','<?xml version="1.0" encoding="UTF-8"?'.'>'."\n".$dom->saveXML($root));

if($f_Modifi){
// ��������� � �������, �� ������� �������
 if(file_put_contents($t_filename, substr($ListPage,1) )>0){
   $f_url=$r.substr($t_filename, strlen($_SERVER['DOCUMENT_ROOT'])+1); // URL ���� � txt �����
   out("������� �� ������ ������ ���������� ������� ".$f_url);	// ������� ����� ����� � ����
   $html=ReadUrl('http://htmlweb.ru/analiz/sm_txt.php?url='.$f_url,60);
   if( ($err=curl_getinfo($curl, CURLINFO_HTTP_CODE))!='200' ){
	out("\t������ ������ sm_txt: ".$html);
	$ForMail.="\n������ ������ sm_txt: ".$html;
   }else{
      out("\t�������!");
      if($html){$ForMail.="\n".$html; out("\t".$html);}
      BuildSiteMap();
   }
 }else{
    out("������ ������ � ".$t_filename);
    $ForMail.="\n������ ������ � ".$t_filename;
  }
}else {touch($t_filename); // ���������� ����� ������� � ����������� �����, ���� ���� �� ����������, �� ��������
	out("��� ���������� �������!");
	}	

if($ForMail && $_Mail){
   $ForMail='<html><body>'.str_replace("\n", "<br>\n", $ForMail)."\n</body></html>";
   if($_Debug)echo '<br>ForMail:'.$ForMail;
   elseif(@mail($_Mail, 'SiteMap Generate Error', $err,
	     "From: <sitemap@".$SERVER_NAME.">\nContent-Type: text/html; charset=windows-1251"))
	{out("��������� �� ������� ���������� �� ".$_Mail);}
   else	out("��������� �� ������� �� ���������� �� ".$_Mail);
}
ret();

function ret($mes='')
{// ���� mes ������ ������ ����������� ������, ����� ���������
if(!empty($mes))die($mes);
global $filename, $_Debug;
if($_Debug)exit;
$g_filename=substr($filename,0,-3).'gif';
if (!file_exists( $g_filename ))copy('http://htmlweb.ru/pic/sitemap.gif', $g_filename);
if (file_exists( $g_filename )){
   if(!headers_sent())header("Content-type: image/gif");
   if(!$_Debug)readfile($g_filename);
}elseif(!headers_sent()) header("location: http://htmlweb.ru/pic/sitemap.gif");
if(file_put_contents('sitemap.log', strip_tags($mes), FILE_APPEND )<1) out("\n�� ���� �������� � ���� ��������� sitemap.log");
exit;
}

function out($mes=''){
global $_Debug;
if($_Debug)echo "<br>\n".nl2br($mes);
file_put_contents('sitemap.log', "\n".$mes, FILE_APPEND );
}

function BuildSiteMap(){
global $filename, $_Debug, $r, $ForMail, $_filename_inc, $url_sitemap;
      out("����� ������ ��������� ����� ����� ".$r." � ������� XML");	// ������� ����� ����� � ����
      // �������� ����� ����� ����� � ������� ��������� �������� � � ���������
      $html=ReadUrl('http://htmlweb.ru/analiz/sm.php?url='.$r.'&s=pxml&p='.$url_sitemap.'&prf=1&lm=1&robot=1&moved=1&tit=1',3600);
      if($html) {
	if(file_put_contents($filename, $html)<20)out("\t�� ���� �������� ����� ����� � ".$filename);
	out("\t����� ����� ������� ���������!");
      }else{
	out("\t����� ����� �� ���������, ������ ������ sm!\n".$html);
	$ForMail.="\n������ ������ sm!";
        // ����� ����������� ��������� ����� ����� ��������� �����
	return;
	}

      out("����� ������ ������ �����: ".$r);	// ������� ����� ����� � ����
      // �������� ����� ����� ������
      $html=ReadUrl('http://htmlweb.ru/analiz/sm.php?url='.$r.'&s=ptree&prf=1&lm=1&robot=1&moved=1&tit=1');
      if($html) {
	if(file_put_contents($_filename_inc, $html)<20)out("\t�� ���� �������� ������ ������ � ".$filename_inc);
	out("������ ������ ������� ���������!");
      }else{
	out("������ ������ �� ���������!\n������ ������ smt:\n".$html);
	$ForMail.="\n������ ������ smt ".$html.'!';
	}
}

function ReadUrl($site,$timeout=600){
$curl = curl_init($site);
curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
curl_setopt($curl, CURLOPT_HEADER, 0);	// �������� header � �����
curl_setopt($curl, CURLOPT_FAILONERROR, true);
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 0 );	// ��������� ������ "Location: " header
curl_setopt($curl, CURLOPT_TIMEOUT, $timeout);	// ������������ ����� � ��������, ������� �� �������� ��� ������ CURL-�������.
$html = curl_exec($curl);
$http_code=curl_getinfo($curl, CURLINFO_HTTP_CODE);
curl_close($curl);
if (strlen($html)<20 || ($http_code <> '200')) return '';
return $html;
}

?>