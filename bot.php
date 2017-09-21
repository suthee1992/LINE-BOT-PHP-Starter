<?php
$access_token = 'Q4vKwU4O16JSqf6NGP1eiXT40QfJy6kJFKoWzC2PvpjDbT5Q6N18fZZKOwQJB84YVJWc0xgM5hxjfjUcalLz8Yckdbv43OrnKbRAJlj5eL9/8wD1LqLtGSkSLQLZ43RM31KzeW9+8lizK8nDM7/RBAdB04t89/1O/w1cDnyilFU=';

// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			// Get text sent
			$text = $event['message']['text'];
			// Get replyToken
			$replyToken = $event['replyToken'];

			// Build message to reply back
			$messages = [
				'type' => 'text',
				'text' => $text
			];

			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/reply';
			$data = [
				'replyToken' => $replyToken,
				'messages' => [$messages],
			];
			$post = json_encode($data);
			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);

			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			$result = curl_exec($ch);
			curl_close($ch);

			echo $result . "\r\n";

			$data = json_decode($post ,true);
			//echo "<pre>";
			//var_dump($data);
			//echo "</pre>";


			$text = $data['messages'][0]['text']."\n\r";
			$myfile = fopen("file.txt", "a+") or die("Unable to open file!");
			fwrite($myfile,$text);
			fclose($myfile);
			
			
		
		}
	}
}
echo "OK";
