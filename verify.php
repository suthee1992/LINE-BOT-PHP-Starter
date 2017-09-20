<?php
$access_token = 'Q4vKwU4O16JSqf6NGP1eiXT40QfJy6kJFKoWzC2PvpjDbT5Q6N18fZZKOwQJB84YVJWc0xgM5hxjfjUcalLz8Yckdbv43OrnKbRAJlj5eL9/8wD1LqLtGSkSLQLZ43RM31KzeW9+8lizK8nDM7/RBAdB04t89/1O/w1cDnyilFU=';

$url = 'https://api.line.me/v1/oauth/verify';

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;
