<?
$name = $_POST['name'];
	$phone = $_POST['phone'];
$str = "'.$name.' sd'.$phone.'";
//открываем файл для записи.Если файл не существует-он будет создан
$fopen  =  fopen('oders.txt', 'a+');
//записываем строку
fputs ($fopen, $str);
//закрываем файл
fclose ($fopen);
	header('Location: success.html');