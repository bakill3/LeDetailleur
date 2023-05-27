<?php
header('Content-Type: text/html; charset=utf-8');
$link = mysqli_connect("localhost", "ledetail_gabriel", "WzFfBVCF1MYZ", "ledetail_alex_cars");
if ($link ==FALSE) {
	die("Nao foi possivel estabelecer uma conexao" . mysqli_error());
	exit;
}
mysqli_set_charset($link, "UTF8");
$escolheBD = mysqli_select_db($link, "ledetail_alex_cars");
if ($escolheBD==FALSE) {
	echo ("Não foi possível ligar à base de dados");
	mysqli_error();
	exit;
}
?>