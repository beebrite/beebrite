<?php
$image_url = $_GET['img'];
$ch = curl_init();
$timeout = 0;
curl_setopt ($ch, CURLOPT_URL, $image_url);
curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);

// Getting binary data
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);

$image = curl_exec($ch);
curl_close($ch);

// output to browser
header("Content-type: image/jpeg");
print $image;
?>
