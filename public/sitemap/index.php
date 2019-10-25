<html>
<head>
<title>Карта сайта <?=$_SERVER['HTTP_HOST']; ?></title>
<style>
ul {
font-size: 11px;
padding: 10px 0px 10px 20px;
list-style-type: none;
display:block;
}
ul li {
padding: 0px 0px;
display:block;
}
ul li.root {
display:block;
font-size: 14px;
letter-spacing: 0px;
font-weight: 100;
padding : 15px 0px 5px 0px;
}
ul li a {
color: #B4241B;
text-decoration: none;
font-weight: 600;
}
ul li a:hover {
color: #000000;
text-decoration: underline;
}
</style>
</head>
<body>

<h1>Карта сайта <?=$_SERVER['HTTP_HOST']; ?></h1> <!--для людей-->

<?
@include_once($_SERVER['DOCUMENT_ROOT'].'/sitemap/sitemap.inc');
?>

</body>
</html>