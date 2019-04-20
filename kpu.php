<?php
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://pemilu2019.kpu.go.id/static/json/hhcw/ppwp.json');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

$headers   = array();
$headers[] = 'Accept: application/json, text/plain, */*';
$headers[] = 'Referer: https://pemilu2019.kpu.go.id/';
$headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result  = curl_exec($ch);
$json    = json_decode($result, true);
$hitung1 = $json['chart'][21]/($json['chart'][21]+$json['chart'][22])*100;
$hitung2 = $json['chart'][22]/($json['chart'][21]+$json['chart'][22])*100;
$hitung3 = $json['progress']['proses']/$json['progress']['total']*100;
//print_r($json);
echo "Perolehan Jokowi-Amin: ".$json['chart'][21]." [ ".number_format($hitung1,2)."% ]";
echo "<br>";
echo "Perolehan Prabowo-Sandi: ".$json['chart'][22]." [ ".number_format($hitung2,2)."% ]";
echo "<br><br>";
echo "Jumlah data yang masuk adalah ".$json['progress']['proses']." TPS dari total ".$json['progress']['total']." TPS [ ".number_format($hitung3,5)."% ]";

 ?>
