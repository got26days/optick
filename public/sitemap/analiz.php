<?php
// sitemap/analiz.php ver 1.3
// Этот код обновляет существующий sitemap.xml
// Для обрабатки изменений на страницах и появления новых страниц используется сервис http://htmlweb.ru/analiz/sitemap.php
// Описание использования и параметров см. http://htmlweb.ru/analiz/sitemap_online.php
//
// Все права принадлежат Колесникову Дмитрию Геннадьевичу(KDG).
// Вопросы и пожелания присылайте на kdg@htmlweb.ru
// Параметры передаваемые через GET-запрос:
//	?debug=1 - отладочный режим, вместо картинки выводятся на экран все сообщения, информация не кешируется
//	?b=1	 - при первом запуске, для ленивых, платное построение полной карты сайта.

$_Mail='admin@домен.ru';	// ваша почта для уведомления об ошибках
$_period=7;	// через сколько суток перестраивать карту сайта
		// для бесплатного режима не ставьте меньше 7, иначе будете терять часть страниц
//////////////////////////////////

$_filename_inc=$_SERVER['DOCUMENT_ROOT'].'/sitemap/sitemap.inc';// имя файла для формирования карты ссылок для людей
$_Debug=isset($_GET['debug']);
if($_Debug){
	header("Cache-Control: no-cache, must-revalidate");
	header("Pragma: no-cache");
}else{
	header("Cache-control: public, max-age = ". $_period); // Кеширование в течение t секунд
	header("Expires: " . gmdate('D, d M Y H:i:s', time()+$_period) . ' GMT');
}

if(@filesize('sitemap.log')>50000){@unlink('sitemap.bak');rename('sitemap.log','sitemap.bak');}
if(file_put_contents('sitemap.log', "\n\n", FILE_APPEND )<1) out("\nНе смог записать в файл протокола sitemap.log");

$SERVER_NAME=$_SERVER['HTTP_HOST'];
$SERVER_NAME=preg_replace('/^www\./', '', $SERVER_NAME);// все обращения к сайту делаем без WWW

$r='http://'.strtolower($SERVER_NAME).'/';
$root_len=strlen($r);

$filename1=$_SERVER['DOCUMENT_ROOT'].'/sitemap.xml';
$filename=$_SERVER['DOCUMENT_ROOT'].'/sitemap/sitemap.xml';
if (file_exists($filename1)){
   if (file_exists($filename))@unlink($filename1); // есть два, удаляю, который в корне
   else rename($filename1, $filename);
   }

$url_sitemap=$r.substr($filename, strlen($_SERVER['DOCUMENT_ROOT'])+1); // URL путь к sitemap.xml
$t_filename=substr($filename,0,-3).'txt';

if(@$_GET['b']=='1'){
	BuildSiteMap(); // полное построение карты сайта
	ret();// молча выхожу
}else
if(file_exists($t_filename)){
   // если данные об измененных страницах успешно загружены на сервер, но
   // запрос на построение был неудачный, пробую сразу построить карту
   if (@filemtime($filename)<filemtime($t_filename) && filesize($t_filename)>100 ){	// время построения карты меньше времени файла обновленных страниц
	BuildSiteMap(); // полное построение карты сайта
	ret();// молча выхожу
	}	
   $time_expires=filemtime($t_filename)+($_period*60*60*24); // перевожу в секунды;
   if($time_expires > time()){
   if(!$_Debug){
	header("Cache-control: public, max-age = ". $time_expires-time()); // Кеширование в течение t секунд
	header("Expires: " . gmdate('D, d M Y H:i:s', $time_expires) . ' GMT');
	ret();// молча выхожу
	}
   ret("Проверка необходимости обновления карты сайта осуществляется один раз в ".$_period." суток!<br>
Последнее обновление было ".date('d M Y H:i:s', filemtime($t_filename)).",
следующее будет не ранее ".date('d M Y H:i:s', $time_expires)."<br>
Для платного построения карты нажмите <a href='?b=1'>здесь</a>");
   }
   out("Последнее обновление было ".date('d M Y H:i:s', filemtime($t_filename)).",
текущее после ".date('d M Y H:i:s', $time_expires));
}
ignore_user_abort(true);
$time_end=3000*1.5; // 1.5 сек на страницу
set_time_limit($time_end+100);	$time_start=time(); $time_end+=$time_start;	// запас на сброс буфферов


$html=@file_get_contents($filename);
if(strlen($html)<300){ret('Нет файла карты сайта '.$url_sitemap.'<br>
Необходимо сначала построить полную карту сайта.<br>
Воспользуйтесь сервисом <a href="http://htmlweb.ru/analiz/sitemap.php?url='.$r.'">http://htmlweb.ru/analiz/sitemap.php</a><br>
Если у Вас небольшой сайт, Вы можете воспользоваться платным <a href="?b=1">Экспресс построением карты</a><br>
');}



$dom = new DOMDocument('1.0', 'UTF-8');  
@$dom->loadXML($html);
if(!$dom)ret('Файл карты сайта '.$url_sitemap." испорчен, - сформируйте полную карту сайта!
Воспользуйтесь сервисом <a href='http://htmlweb.ru/analiz/sitemap.php?url=".$r."'>http://htmlweb.ru/analiz/sitemap.php</a><br>
Если у Вас небольшой сайт, Вы можете воспользоваться платным <a href='?b=1&debug=1'>Экспресс построением карты</a><br>
");

$ForMail='';

// добавляю ссылку на sitemap в robots.txt
if(!is_file($f_robots=$_SERVER['DOCUMENT_ROOT'].'/robots.txt')){
  if(@file_put_contents($f_robots, "sitemap: ".$url_sitemap."\n", FILE_APPEND)<10){
		$ForMail.="\nНе удалось записать путь к sitemap в robots.txt";
		out('Не удалось записать путь к sitemap в robots.txt');}
}else{
  $html=@file_get_contents($f_robots);

  if (stripos( $html, "sitemap:" )!==false){
     if (stripos( $html, "sitemap: ".$url_sitemap )===false){ // если путь не правильный
	out('<br>Меняю путь к sitemap: '.$url_sitemap.' в '.$f_robots);
	if(@file_put_contents($f_robots, preg_replace("|sitemap: (.*?)\n|ims", $url_sitemap, $html."\n") )<10){
		$ForMail.="\nНе удалось изменить путь к sitemap в robots.txt";
		out('Не удалось изменить путь к sitemap в robots.txt');}
     }
  }else{
	out('Добавляю ссылку на sitemap: '.$url_sitemap.' в '.$f_robots);
	if(@file_put_contents($f_robots, "\n\nSitemap: ".$url_sitemap, FILE_APPEND)<10){
		$ForMail.="\nНе удалось записать путь к sitemap в robots.txt";
		out('Не удалось записать путь к sitemap в robots.txt');}
	}
}
$root=$dom->documentElement;
$nodelist=$root->childNodes;    //список узлов 1-го уровня
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
	out('Проверяю <b>'.$loc.'</b> прошлое изменение '.$lastmod->nodeValue);
   // считываю заголовок и сравниваю даты изменения
   $curl = curl_init($loc);
   curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
   curl_setopt($curl, CURLOPT_HEADER, 1);	// включать header в вывод
   curl_setopt($curl, CURLOPT_NOBODY, 1);	// читать ТОЛЬКО заголовок без тела
   curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 0 );	// следовать любому "Location: " header
   curl_setopt($curl, CURLOPT_TIMEOUT, 20);	// максимальное время в секундах, для работы CURL-функций.
   $headers = curl_exec($curl);
   $short_loc=substr($loc, $root_len);
   if( curl_error($curl) || curl_getinfo($curl, CURLINFO_HTTP_CODE)=='404'){	//CURLE_OPERATION_TIMEDOUT
	out("\tстраница недоступна, удаляю её из sitemap");
	$ForMail.="\n".$short_loc.' - страница не доступна и удалена из карты сайта.';
	$ListPage.="\n".$short_loc."\t-";
	$root->removeChild($child);}
   else
	if (strlen($headers)>20){
	if (preg_match("|Last-Modified: (.*)\n|imsU", $headers, $results)){
		if (($time2 = strtotime($results[1])) === -1){
	        out("\tНедопустимое время <b>".$results[1].'</b> в заголовке '.$loc);
		$ForMail.="\n".$short_loc.' - Недопустимое время <b>'.$results[1].'</b> в заголовке страницы!';
		$ListPage.="\n".$short_loc."\t2";}
	   elseif (date('Y-m-d',$time2)>$lastmod->nodeValue){
		$lastmod->nodeValue=date('Y-m-d',$time2);
		out("\tModified <b>".date('Y-m-d H:i:s',$time2)."</b>!");
		$ListPage.="\n".$short_loc."\t1\t".date('Y-m-d H:i:s',$time2); $f_Modifi=true;
		}
	   else {out("\tне изменялся с ".date('Y-m-d H:i:s',$time2).'!');
		 $ListPage.="\n".$short_loc."\t0\t".date('Y-m-d H:i:s',$time2);}
	   }
	elseif (preg_match("|Content-Length: (.*)\n|imsU", $headers, $results)){	//Content-Length: 95
		out("\tв заголовке нет Last-Modified, проверяю по размеру!");
	      $ListPage.="\n".$short_loc."\t3\t".$results[1];}
	else {out("\t<b>в заголовке нет Last-Modified и нет Content-Length!</b>");
	      $ListPage.="\n".$short_loc."\t4";}
	} else {out("\t<b>заголовок пустой!</b>");
	      $ListPage.="\n".$short_loc."\t4";}
    curl_close ($curl);
    }
}
//file_put_contents($filename.'1','<?xml version="1.0" encoding="UTF-8"?'.'>'."\n".$dom->saveXML($root));

if($f_Modifi){
// обращаюсь к серверу, со списком страниц
 if(file_put_contents($t_filename, substr($ListPage,1) )>0){
   $f_url=$r.substr($t_filename, strlen($_SERVER['DOCUMENT_ROOT'])+1); // URL путь к txt файлу
   out("Передаю на сервер список измененных страниц ".$f_url);	// обновим карту сайта в базе
   $html=ReadUrl('http://htmlweb.ru/analiz/sm_txt.php?url='.$f_url,60);
   if( ($err=curl_getinfo($curl, CURLINFO_HTTP_CODE))!='200' ){
	out("\tОшибка вызова sm_txt: ".$html);
	$ForMail.="\nОшибка вызова sm_txt: ".$html;
   }else{
      out("\tуспешно!");
      if($html){$ForMail.="\n".$html; out("\t".$html);}
      BuildSiteMap();
   }
 }else{
    out("Ошибка записи в ".$t_filename);
    $ForMail.="\nОшибка записи в ".$t_filename;
  }
}else {touch($t_filename); // Устанавить время доступа и модификации файла, если файл не существует, он создаётся
	out("Нет измененных страниц!");
	}	

if($ForMail && $_Mail){
   $ForMail='<html><body>'.str_replace("\n", "<br>\n", $ForMail)."\n</body></html>";
   if($_Debug)echo '<br>ForMail:'.$ForMail;
   elseif(@mail($_Mail, 'SiteMap Generate Error', $err,
	     "From: <sitemap@".$SERVER_NAME.">\nContent-Type: text/html; charset=windows-1251"))
	{out("Сообщения об ошибках отправлены на ".$_Mail);}
   else	out("Сообщения об ошибках НЕ отправлены на ".$_Mail);
}
ret();

function ret($mes='')
{// если mes пустое вывожу изображение кнопки, иначе сообщение
if(!empty($mes))die($mes);
global $filename, $_Debug;
if($_Debug)exit;
$g_filename=substr($filename,0,-3).'gif';
if (!file_exists( $g_filename ))copy('http://htmlweb.ru/pic/sitemap.gif', $g_filename);
if (file_exists( $g_filename )){
   if(!headers_sent())header("Content-type: image/gif");
   if(!$_Debug)readfile($g_filename);
}elseif(!headers_sent()) header("location: http://htmlweb.ru/pic/sitemap.gif");
if(file_put_contents('sitemap.log', strip_tags($mes), FILE_APPEND )<1) out("\nНе смог записать в файл протокола sitemap.log");
exit;
}

function out($mes=''){
global $_Debug;
if($_Debug)echo "<br>\n".nl2br($mes);
file_put_contents('sitemap.log', "\n".$mes, FILE_APPEND );
}

function BuildSiteMap(){
global $filename, $_Debug, $r, $ForMail, $_filename_inc, $url_sitemap;
      out("Прошу сервер построить карту сайта ".$r." в формате XML");	// обновим карту сайта в базе
      // построим новую карту сайта и соощить поисковым системам о её обовлении
      $html=ReadUrl('http://htmlweb.ru/analiz/sm.php?url='.$r.'&s=pxml&p='.$url_sitemap.'&prf=1&lm=1&robot=1&moved=1&tit=1',3600);
      if($html) {
	if(file_put_contents($filename, $html)<20)out("\tНе смог записать карту сайта в ".$filename);
	out("\tКарта сайта успешно обновлена!");
      }else{
	out("\tКарта сайта не обновлена, ошибка вызова sm!\n".$html);
	$ForMail.="\nОшибка вызова sm!";
        // нужно попробовать запросить карту через некоторое время
	return;
	}

      out("Строю дерево ссылок сайта: ".$r);	// обновим карту сайта в базе
      // построим новую карту ссылок
      $html=ReadUrl('http://htmlweb.ru/analiz/sm.php?url='.$r.'&s=ptree&prf=1&lm=1&robot=1&moved=1&tit=1');
      if($html) {
	if(file_put_contents($_filename_inc, $html)<20)out("\tНе смог записать дерево ссылок в ".$filename_inc);
	out("Дерево ссылок успешно обновлено!");
      }else{
	out("Дерево ссылок НЕ обновлено!\nОшибка вызова smt:\n".$html);
	$ForMail.="\nОшибка вызова smt ".$html.'!';
	}
}

function ReadUrl($site,$timeout=600){
$curl = curl_init($site);
curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
curl_setopt($curl, CURLOPT_HEADER, 0);	// включать header в вывод
curl_setopt($curl, CURLOPT_FAILONERROR, true);
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 0 );	// следовать любому "Location: " header
curl_setopt($curl, CURLOPT_TIMEOUT, $timeout);	// максимальное время в секундах, которое вы отводите для работы CURL-функций.
$html = curl_exec($curl);
$http_code=curl_getinfo($curl, CURLINFO_HTTP_CODE);
curl_close($curl);
if (strlen($html)<20 || ($http_code <> '200')) return '';
return $html;
}

?>