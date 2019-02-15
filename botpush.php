<?php



require "vendor/autoload.php";

$access_token = 'BAE/tNsRpxyb/W1gf+R9fISBYIbW9CG3t0kWfe882V5CaWpqFn1ElTWkWhHEOo59hddigwwRPRzJ0cZtyXXBpaKjKiqdwQbNrGUMYGu3YgLZkctGd4nqCxYXnAcF/PvEkPZDLYBGw23vKXpGdEyINgdB04t89/1O/w1cDnyilFU=';

$channelSecret = 'eeafc7a4758dea7d8a666d214f88855e';

$pushID = '';

$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($access_token);
$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => $channelSecret]);

$textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('hello world');
$response = $bot->pushMessage($pushID, $textMessageBuilder);

echo $response->getHTTPStatus() . ' ' . $response->getRawBody();







