<?
if ($_POST['m_user_phone'] == '') die();
$title = 'Заказ с сайта 1.kuhni-cherry.by';
$from = $_POST['m_user_name'];
$user_phone = $_POST['m_user_phone'];
$n = $_POST['m_n'];
$form_title = $_POST['m_title'];
$city = $_POST['m_city'];
$from_email = 'info@1.kuhni-cherry.by';
//$to_email = 'sales@kuhni-cherry.by';
$to_email2 = 'vitaminiby@ya.ru';
$ip = $_SERVER['REMOTE_ADDR'];

$facade_type = $_POST['m_facade_type'];
$kitchen_type = $_POST['m_kitchen_type'];
$size_x = $_POST['m_size_x'];
$size_y = $_POST['m_size_y'];
$size_z = $_POST['m_size_z'];
$complectation = $_POST['m_complectation'];




// Get UTM.

$utm_source = $_POST['m_utm_source'];
$utm_medium = $_POST['m_utm_medium'];
$utm_campaign = $_POST['m_utm_campaign'];
$utm_term = $_POST['m_utm_term'];
$utm_content = $_POST['m_utm_content'];
$utm_keyword = $_POST['m_utm_keyword'];
$utm_term = urldecode($utm_term);

$whitelist = array("jpg", "jpeg", "xls", "xlsx", "doc", "pdf", "png", "txt", "docx", "csv","zip","rar","ico");
$name = $_FILES['upload_file']['name'];
if (in_array(end(explode(".", $name)), $whitelist)) {
    $tmp_name = $_FILES['upload_file']['tmp_name'];
    $dir = $_SERVER['DOCUMENT_ROOT'] . '/files/';
    $fdata = pathinfo($dir.$name);
    $newname = date('YmdHis').'.'.$fdata['extension'];
    move_uploaded_file($tmp_name, $dir . $newname);
    $uploadedPath = 'https://1.kuhni-cherry.by/files/'.$newname;
}


$headers =  "Content-type: text/plain; charset=utf-8 \r\n" .
                    "From: =?utf-8?B?". base64_encode($from). "?= <".$from_email.">\n";
                    "Reply-To: ".$from_email." \r\n" .
                    "X-Mailer: PHP/" . phpversion();
$title = "=?utf-8?B?". base64_encode($title). "?=";
$message = "Заказ с сайта 1.kuhni-cherry\n\nФорма № $n ($form_title)\n\nИмя: $from\nТелефон: $user_phone";
if ($n == 4) {$message .= "\n\nТип фасада: $facade_type\nТип кухонного гарнитура: $kitchen_type\nРазмеры кухни: X:$size_x м; Y:$size_y м; Z:$size_z м\nКомплектация: $complectation\nФайл: $uploadedPath";}
if ($n == 5 AND $city != '') {$message .= "\nГород: ".$city;}
$message .= "\n\nIP-адрес: $ip";
$message .= "\n\nutm_source: $utm_source\nutm_medium: $utm_medium\nutm_campaign: $utm_campaign\nutm_term: $utm_term\nutm_content: $utm_content\nutm_keyword: $utm_keyword";


$message2 = "Заказ с сайта 1.kuhni-cherry\n\nФорма № $n ($form_title)\n\nИмя: $from\nТелефон: $user_phone";
if ($n == 4) {$message2 .= "\n\nТип фасада: $facade_type\nТип кухонного гарнитура: $kitchen_type\nРазмеры кухни: X:$size_x м; Y:$size_y м; Z:$size_z м\nКомплектация: $complectation\nФайл: $uploadedPath";}
if ($n == 5 AND $city != '') {$message2 .= "\nГород: ".$city;}
$message2 .= "\n\nutm_source: $utm_source\nutm_medium: $utm_medium\nutm_campaign: $utm_campaign\nutm_term: $utm_term\nutm_content: $utm_content\nutm_keyword: $utm_keyword";


mail($to_email, $title, $message, $headers);
mail($to_email2, $title, $message2, $headers);



?>